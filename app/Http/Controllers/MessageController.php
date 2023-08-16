<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Images;
use App\Models\Ticket;

class MessageController extends Controller
{
     /**
      * Ticket message between user and admin
      *
      * @param Illuminate\Http\Request\MessageRequest $request
      * @param int $ticketId
      *
      * @return RedirectResponse
      */
      public function userMessage(MessageRequest $request, $ticketId)
     {
        $this->updateTicktTable($ticketId);

         $message = new Message();
         $message->message = $request->message;
         $message->user_id = auth()->user()->id;
         $message->ticket_id = $ticketId;
         $message->save();

         $message = Message::where('ticket_id', $ticketId)->latest()->first();

            if ($message) {
                $message->user_view = 3;
                $message->admin_view = 1;
                $message->user_flag = true;
                $message->save();
            }

         if($request->hasFile('images')){
             $files = $request->file('images');
             foreach($files as $file){
                 $fileName = rand().'.'.$file->getClientOriginalExtension();
                 $filePath = 'upload/images/' . $fileName;
                 Storage::disk('public')->put($filePath, file_get_contents($file));
                 $file->move('upload/images/',$fileName);
                 $images = new Images();
                 $images->user_id = auth()->user()->id;
                 $images->ticket_id = $ticketId;
                 $images->message_id = $message->id;
                 $images->images = $fileName;
                 $images->save();
             }
         }
         if(auth()->user()->role == 1){

            return redirect()->route('open.ticket', ['ticketId' => $ticketId]);
         }else{

            return redirect()->route('view.ticket',['ticketId' => $ticketId]);
         }
     }

     public function adminMessage(MessageRequest $request, $ticketId)
     {
        $this->updateTicktTable($ticketId);

         $message = new Message();
         $message->message = $request->message;
         $message->user_id = auth()->user()->id;
         $message->ticket_id = $ticketId;
         $message->save();

         $message = Message::where('ticket_id', $ticketId)->latest()->first();

            if ($message) {
                $message->user_view = 1;
                $message->admin_view = 3;
                $message->admin_flag = true;
                $message->save();
            }

         if($request->hasFile('images')){
             $files = $request->file('images');
             foreach($files as $file){
                 $fileName = rand().'.'.$file->getClientOriginalExtension();
                 $filePath = 'upload/images/' . $fileName;
                 Storage::disk('public')->put($filePath, file_get_contents($file));
                 $file->move('upload/images/',$fileName);
                 $images = new Images();
                 $images->user_id = auth()->user()->id;
                 $images->ticket_id = $ticketId;
                 $images->message_id = $message->id;
                 $images->images = $fileName;
                 $images->save();
             }
         }
         if(auth()->user()->role == 1){

            return redirect()->route('open.ticket', ['ticketId' => $ticketId]);
         }else{

            return redirect()->route('view.ticket',['ticketId' => $ticketId]);
         }
     }


     protected function updateTicktTable($ticketId)
     {
         $ticket = Ticket::findOrfail($ticketId);

         if(!is_null($ticket->reassigned) && !is_null($ticket->reassigned_time))
         {
            $ticket->reassigned = NULL;
            $ticket->reassigned_time = NULL;
            $ticket->save();
         }
     }
}

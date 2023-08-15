<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\Images;

class MessageController extends Controller
{
     //messege from admin and user
     public function message(MessageRequest $request, $ticketId)
     {
         $message = new Message();
         $message->message = $request->message;
         $message->user_id = auth()->user()->id;
         $message->ticket_id = $ticketId;
         $message->save();

         if($request->hasFile('images')){
             $files = $request->file('images');
             foreach($files as $file){
                 $fileName = rand().'.'.$file->getClientOriginalExtension();
                 $file->move('upload/images/',$fileName);
                 $images = new Images();
                 $images->user_id = auth()->user()->id;
                 $images->ticket_id = $ticketId;
                 $images->message_id = $message->id;
                 $images->images = $fileName;
                 $images->save();
             }
         }
         return back();
     }
}

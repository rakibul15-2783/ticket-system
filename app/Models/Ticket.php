<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $filable = [
        'user_id','name','email','subject','category','des','assignto','status'
    ];

    public function user(){
        {
            return $this->belongsTo(User::class);
        }
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}

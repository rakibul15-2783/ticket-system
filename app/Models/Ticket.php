<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $filable = [
        'user_id','name','email','subject','category','des','assignto','status','flag'
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
    public function images()
    {
        return $this->hasMany(Images::class);
    }
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignto');
    }
    public function latestMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }


}

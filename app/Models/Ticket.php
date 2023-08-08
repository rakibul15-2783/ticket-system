<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $filable = [
        'user_id','name','email','subject','category','des',
    ];

    public function user(){
        {
            return $this->belongsTo(User::class);
        }
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(){
        return $this->belongsToMany(User::class,"user_conversation");
    }
    public function messages(){
        return $this->belongsTo(Message::class);
    }
}

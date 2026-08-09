<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LetterRequest extends Model
{
    protected $fillable = ['user_id', 'letter_type', 'purpose', 'status'];
    public function user(){
        return $this->belongsTo(User::class);
    }
}

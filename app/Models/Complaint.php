<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Pastikan user_id masuk ke dalam array fillable ini!
    protected $fillable = [
        'user_id', 
        'title', 
        'description', 
        'photo', 
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
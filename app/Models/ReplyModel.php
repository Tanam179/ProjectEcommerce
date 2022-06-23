<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyModel extends Model
{
    use HasFactory;
    protected $table = 'replies';
    protected $fillable = [
        'comment_id', 'user_id', 'message'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}

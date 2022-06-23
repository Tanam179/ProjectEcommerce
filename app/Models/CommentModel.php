<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'product_id', 'user_id', 'message'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }
}

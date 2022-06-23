<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = [
        'user_id', 'phone_number', 'address', 'ward', 'district', 'country'
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getOrderItemsRelationShip(){
        return $this->hasMany(OrderItems::class, 'order_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_size',
        'product_quantity'
    ];

    public function order(){
        return $this->belongsTo(OrderDetailModel::class);
    }
    
    public function product(){
        return $this->belongsTo(ProductModel::class);
    }
}

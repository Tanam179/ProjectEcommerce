<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'name', 'price', 'img', 'img_relate', 'size', 'description', 'sale', 'sale_percent', 'status', 'cate_id'
    ];

    public function cate() {
        return $this->belongsTo(CategoryModel::class);
    }

}

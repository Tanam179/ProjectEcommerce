<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'name', 'image'
    ];

    public function getRelationship() {
        return $this->hasMany(ProductModel::class, 'cate_id', 'id');
    }
}

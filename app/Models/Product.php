<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['id', 'name', 'created_by', 'price', 'description', 'price', 'stock', 'category_id', 'image'];
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
}

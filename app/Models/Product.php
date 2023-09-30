<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, useUUID, SoftDeletes;
    protected $fillable = ['id', 'name', 'created_by', 'price', 'description', 'price', 'stock', 'category_id', 'image'];
    protected $hidden = ['created_by'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    public function category()
    {
        return $this->belongsTo(CategoryProduct::class, 'category_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }
}

<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class   Cart extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['id', 'product_id', 'qty', 'order_id',  'status_cart', 'created_by', 'singular_price', 'cart_price'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['id', 'created_by', 'status_transaction', 'total_price'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    /**
     * Relation to cart
     */
    public function carts()
    {
        return $this->hasMany(Cart::class, 'order_id');
    }
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
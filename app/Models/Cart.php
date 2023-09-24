<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['id', 'product_id', 'total_rice', 'qty', 'order_id'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

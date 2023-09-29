<?php

namespace App\Models;

use App\Traits\useUUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, useUUID;
    protected $fillable = ['id', 'created_by', 'product_id', 'rating'];
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}

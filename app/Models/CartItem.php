<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'quantity',
        'product_id',
    ];


    function user(){
        return $this->belongsTo(User::class,'user_id');
    }


    function products(){
        return $this->hasMany(product::class);
    }
}

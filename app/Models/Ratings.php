<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'rating'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

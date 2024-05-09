<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
                    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'date_of_delivery',
        'location_id',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    function user(){
        return $this->belongsTo(user::class,'user_id');
    }
    function location(){
        return $this->belongsTo(location::class,'location_id');
    }
    function items(){
        return $this->hasMany(OrderItems::class);
    }
}

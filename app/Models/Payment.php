<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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
        'payment_gateway',
        'payment_process_number',
        'payment_phone_number',
        'order_id',

    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }
}

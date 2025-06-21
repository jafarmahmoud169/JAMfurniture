<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ratings;

class product extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'amount',
        'discount',
        'is_trendy',
        'is_available',
        'image',
        'category_id',
        "dimensions",
        "colors",
        "material"
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

    function category()
    {
        return $this->belongsTo(category::class, 'category_id');
    }

    public function ratings()
    {
        return $this->hasMany(Ratings::class);
    }
    public function averageRating()
    {
        $average = $this->ratings()->avg('rating');
        $count = $this->ratings()->count();
        return json_encode(['average' => $average, 'count' => $count]);
    }
    public function updateTrendStatus()
    {
        if ($this->ratings()->count() >= 20 && $this->ratings()->avg('rating') >= 4.0) {
            $this->is_trendy = 1;
        } else {
            $this->is_trendy = 0;
        }

        $this->save();
    }
    public function final_price() {
        return $this->price - $this->discount;
    }
}

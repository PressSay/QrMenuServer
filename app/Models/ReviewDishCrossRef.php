<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewDishCrossRef extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'reviewId',
        'dishId',
        'customerId'
    ];

    public $incrementing = false;
    protected $primaryKey = ['reviewId', 'dishId'];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class, 'dishId', 'dishId');
    }

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'reviewId', 'reviewId');
    }
}

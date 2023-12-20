<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewDish extends Model
{
    use HasFactory, softDeletes;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'customerId',
        'dishId',
        'description',
        'star'
    ];

    protected $primaryKey = ['reviewId', 'dishId'];


    public function customerDishCrossRef(): BelongsTo
    {
        return $this->belongsTo(customerDishCrossRef::class, ['reviewId', 'dishId'], ['reviewId', 'dishId']);
    }
}

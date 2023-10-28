<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'star',
        'description',
    ];

    protected $primaryKey = 'reviewId';

    public function reviewDishCrossRef(): HasMany
    {
        return $this->hasMany(ReviewDishCrossRef::class, 'reviewId', 'reviewId');
    }

    public function reviewCustomer(): HasMany
    {
        return $this->hasMany(reviewCustomerCrossRef::class, 'reviewId', 'reviewId');
    }
}

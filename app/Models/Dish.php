<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dish extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'dishId';

    public $timestamps = false;

    public $fillable = [
        'name',
        'description',
        'cost',
        'numberOfTimesCalled',
        'categoryId'
    ];

    public function reviewDishCrossRefs(): HasMany
    {
        return $this->hasMany(ReviewDishCrossRef::class, 'dishId', 'dishId');
    }

    public function customerDishCrossRefs(): HasMany
    {
        return $this->hasMany(CustomerDishCrossRef::class, 'dishId', 'dishId');
    }

    public function imageDish(): HasMany
    {
        return $this->hasMany(ImageDish::class, 'dishId', 'dishId');
    }

    public function cateogry(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }
}

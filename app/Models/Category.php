<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'categoryId';

    public $timestamps = false;

    public $fillable = [
        'name',
        'menuId'
    ];

    public function dishes(): HasMany
    {
        return $this->hasMany(Dish::class, 'categoryId', 'categoryId');
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'menuId', 'menuId');
    }
}

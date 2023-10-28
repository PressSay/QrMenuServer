<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageDish extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'dishId',
        'imageId',
    ];

    public $incrementing = false;

    protected $primaryKey = ['imageId', 'dishId'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'imageId', 'imageId');
    }

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class, 'dishId', 'dishId');
    }
}

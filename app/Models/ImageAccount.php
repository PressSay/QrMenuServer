<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageAccount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'userId',
        'imageId',
    ];

    public $incrementing = false;

    protected $primaryKey = ['imageId', 'userId'];

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'imageId', 'imageId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}

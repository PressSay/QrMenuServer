<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Image extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'source'
    ];

    protected $primaryKey = 'imageId';

    public function imageDishes(): HasMany
    {
        return $this->hasMany(ImageDish::class, 'imageId', 'imageId');
    }

    public function imageAccounts(): HasMany
    {
        return $this->hasMany(ImageAccount::class, 'imageId', 'imageId');
    }
}

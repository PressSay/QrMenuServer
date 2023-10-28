<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'isUsed',
        'name',
    ];

    protected $primaryKey = 'menuId';

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'menuId', 'menuId');
    }
}

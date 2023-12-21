<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReviewDish extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'customerId',
        'dishId',
        'description',
        'star'
    ];

    protected $primaryKey = ['customerId', 'dishId'];

}

<?php

namespace App\Models;

use App\Models\ReviewDish;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerDishCrossRef extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    public $fillable = [
        'customerId',
        'dishId',
        'amount',
        'promotion',
    ];

    public $incrementing = false;

    protected $primaryKey = ['customerId', 'dishId'];

    public function dish(): BelongsTo
    {
        return $this->belongsTo(Dish::class, 'dishId', 'dishId');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customerId', 'customerId');
    }

}

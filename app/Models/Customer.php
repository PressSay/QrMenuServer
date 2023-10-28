<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $primaryKey = 'customerId';

    public $fillable = [
        'userId',
        'dateExpireCode',
        'name',
        'code',
        'phoneNumber',
        'address'
    ];

    public function reviewDishCrossRefs(): HasMany
    {
        return $this->hasMany(ReviewDishCrossRef::class, 'customerId', 'customerId');
    }

    public function reviewCustomerCrossRefs(): HasMany
    {
        return $this->hasMany(ReviewCustomerCrossRef::class, 'customerId', 'customerId');
    }

    public function customerDishCrossRefs(): HasMany
    {
        return $this->hasMany(CustomerDishCrossRef::class, 'customerId', 'customerId');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'customerId', 'customerId');
    }

}

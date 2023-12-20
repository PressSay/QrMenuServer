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
        'address',
        'created_at'
    ];

    public function reviewBill(): HasOne
    {
        return $this->hasOne(ReviewCustomerCrossRef::class, 'customerId', 'customerId');
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

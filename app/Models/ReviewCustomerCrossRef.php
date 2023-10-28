<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewCustomerCrossRef extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'reviewId',
        'customerId',
    ];

    protected $primaryKey = 'reviewId';

    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class, 'reviewId', 'reviewId');
    }

    public function customer(): BelongsTo
    {
        return $this->belongTo(Customer::class, 'customerId', 'customerId');
    }
}

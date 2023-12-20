<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewBill extends Model
{
    use HasFactory, softDeletes;

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'customerId',
    ];

    protected $primaryKey = 'reviewId';

    public function customer(): BelongsTo
    {
        return $this->belongTo(Customer::class, 'customerId', 'customerId');
    }
}

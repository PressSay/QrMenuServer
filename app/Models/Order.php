<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'customerId';

    public $fillable = [
        'customerId',
        'status',
        'promotion',
        'payments',
        'nameTable',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'userId', 'id');
    }
}

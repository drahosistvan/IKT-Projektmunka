<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'customer_id',
        'billing_name',
        'billing_country',
        'billing_street',
        'billing_city',
        'billing_zip',
        'shipping_name',
        'shipping_country',
        'shipping_street',
        'shipping_city',
        'shipping_zip',
        'total_price',
        'shipping_price',
        'shipping_method',
        'notes',
    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}

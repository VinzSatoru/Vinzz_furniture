<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'shipping_address',
        'shipping_phone',
        'shipping_name',
        'status',
        'payment_status',
        'total_amount'
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . strtoupper(uniqid());
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_details')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function calculateTotal()
    {
        $total = $this->orderDetails->sum(function ($detail) {
            return $detail->price * $detail->quantity;
        });
        
        $this->update(['total_amount' => $total]);
        return $total;
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'warning',
            'paid' => 'success',
            'failed' => 'danger',
            default => 'secondary'
        };
    }
} 
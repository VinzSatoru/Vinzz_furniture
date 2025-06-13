<?php

namespace App\Observers;

use App\Models\Order;

class OrderObserver
{
    public function saved(Order $order)
    {
        $order->calculateTotal();
    }
} 
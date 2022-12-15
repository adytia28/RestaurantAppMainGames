<?php

namespace App\Http\Livewire\Cms\Order;

use App\Models\Order;
use Livewire\Component;

class Show extends Component
{
    public $reference;
    public $orders = [];

    public function mount() {
        $this->orders = Order::with(['orderDetail', 'orderPayment'])->where('reference_order', $this->reference)->first();
    }

    public function render()
    {
        return view('livewire.cms.order.show');
    }
}

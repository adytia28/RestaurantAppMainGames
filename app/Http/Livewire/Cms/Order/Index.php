<?php

namespace App\Http\Livewire\Cms\Order;

use App\Models\Order;
use Livewire\Component;

class Index extends Component
{
    public $status = 'unpaid';
    public $showOrder;
    public $typeOrder = 'all';

    public function mount() {
        $this->typeOrder = session('typeOrder') ?? 'all';
    }

    public function showOrder($ref) {
       $this->showOrder = $ref;
    }

    public function updateOrder() {
        if($this->showOrder) {
            $order = Order::select('reference_order', 'id')->where('reference_order', $this->showOrder)->first();
            $order->payment_status = 'paid';
            $order->save();

            session()->flash('orderSuccess', "Order with ref. order $this->showOrder has paid");
            return redirect()->route('order.index');
        }

    }

    public function render()
    {
        $now = date('Y-m-d H:i:s');
        $weeklyDate = date('Y-m-d H:i:s', strtotime("-7 day", strtotime(date('Y-m-d H:i:s'))));
        $monthlyDate = date('Y-m-d H:i:s', strtotime("-1 month", strtotime(date('Y-m-d H:i:s'))));
        $annualDate = date('Y-m-d H:i:s', strtotime("-1 year", strtotime(date('Y-m-d H:i:s'))));

        if($this->typeOrder == 'all') {
            $orders = Order::select('id', 'reference_order', 'payment_status')
                            ->where('payment_status', $this->status)
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
        } elseif($this->typeOrder == 'daily') {
            $orders = Order::select('id', 'reference_order', 'payment_status')
                            ->whereBetween('created_at', [date('Y-m-d 00:00:00'), $now])
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
        } elseif($this->typeOrder == 'weekly') {
            $orders = Order::select('id', 'reference_order', 'payment_status')
                            ->whereBetween('created_at', [$monthlyDate, $now])->paginate(10)
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
        } else {
            $orders = Order::select('id', 'reference_order', 'payment_status')
                            ->whereBetween('created_at', [$annualDate, $now])
                            ->orderBy('id', 'DESC')
                            ->paginate(10);
        }

        return view('livewire.cms.order.index', [
            'orders' => $orders,
        ]);
    }
}

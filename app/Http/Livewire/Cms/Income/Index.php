<?php

namespace App\Http\Livewire\Cms\Income;

use App\Models\Order;
use App\Models\OrderPayment;
use Livewire\Component;

class Index extends Component
{
    public $typeIncome = 'weekly';

    public function mount() {
        $this->typeIncome = session('typeIncome');;
    }

    public function render()
    {
        $orders = Order::select('id', 'payment_status', 'created_at')->where('payment_status', 'paid');
        $ordersArray = $orders->get()->pluck('id')->toArray();

        $now = date('Y-m-d H:i:s');
        $weeklyDate = date('Y-m-d H:i:s', strtotime("-7 day", strtotime(date('Y-m-d H:i:s'))));
        $monthlyDate = date('Y-m-d H:i:s', strtotime("-1 month", strtotime(date('Y-m-d H:i:s'))));
        $annualDate = date('Y-m-d H:i:s', strtotime("-1 year", strtotime(date('Y-m-d H:i:s'))));

        if($this->typeIncome == 'weekly') {
            $income = OrderPayment::with('order')->select('orders_id', 'total_order')
                                            ->whereIn('orders_id', $ordersArray)
                                            ->whereBetween('created_at', [$weeklyDate, $now])
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(10);
        } elseif($this->typeIncome == 'monthly') {
            $income = OrderPayment::with('order')->select('orders_id', 'total_order')
                                            ->whereIn('orders_id', $ordersArray)
                                            ->whereBetween('created_at', [$monthlyDate, $now])
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(10);
        } else {
            $income = OrderPayment::with('order')->select('orders_id', 'total_order')
                                            ->whereIn('orders_id', $ordersArray)
                                            ->whereBetween('created_at', [$annualDate, $now])
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(10);
        }

        return view('livewire.cms.income.index', [
            'income' => $income,
        ]);
    }
}

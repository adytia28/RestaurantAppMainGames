<?php

namespace App\Http\Livewire\Cms\Dashboard;

use App\Models\Order;
use App\Models\OrderPayment;
use Livewire\Component;

class Index extends Component
{

    public function showListIncome($type) {
        session(['typeIncome' => $type]);
        return redirect()->route('income.index');
    }

    public function showListOrder($type) {
        session()->flash('typeOrder', $type);
        return redirect()->route('order.index');
    }

    public function render() {
        $orders = Order::select('id', 'payment_status', 'created_at')->where('payment_status', 'paid');
        $ordersArray = $orders->get()->pluck('id')->toArray();

        $now = date('Y-m-d H:i:s');
        $weeklyDate = date('Y-m-d H:i:s', strtotime("-7 day", strtotime(date('Y-m-d H:i:s'))));
        $monthlyDate = date('Y-m-d H:i:s', strtotime("-1 month", strtotime(date('Y-m-d H:i:s'))));
        $annualDate = date('Y-m-d H:i:s', strtotime("-1 year", strtotime(date('Y-m-d H:i:s'))));

        $weeklyIncome = OrderPayment::select('orders_id', 'total_order')
                                        ->whereIn('orders_id', $ordersArray)
                                        ->whereBetween('created_at', [$weeklyDate, $now])
                                        ->get()->sum('total_order');

        $monthlyIncome = OrderPayment::select('orders_id', 'total_order')
                                        ->whereIn('orders_id', $ordersArray)
                                        ->whereBetween('created_at', [$monthlyDate, $now])
                                        ->get()->sum('total_order');

        $annualIncome = OrderPayment::select('orders_id', 'total_order')
                                        ->whereIn('orders_id', $ordersArray)
                                        ->whereBetween('created_at', [$annualDate, $now])
                                        ->get()->sum('total_order');

        $dailyOrder = Order::whereBetween('created_at', [date('Y-m-d 00:00:00'), $now])->count();
        $monthlyOrder = Order::whereBetween('created_at', [$monthlyDate, $now])->count();
        $annualOrder = Order::whereBetween('created_at', [$annualDate, $now])->count();

        return view('livewire.cms.dashboard.index', [
            'weeklyIncome' => $weeklyIncome,
            'monthlyIncome' => $monthlyIncome,
            'annualIncome' => $annualIncome,
            'dailyOrder' => $dailyOrder,
            'monthlyOrder' => $monthlyOrder,
            'annualOrder' => $annualOrder,
        ]);
    }
}

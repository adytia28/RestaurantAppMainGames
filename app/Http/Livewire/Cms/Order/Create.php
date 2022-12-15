<?php

namespace App\Http\Livewire\Cms\Order;

use App\Models\Category;
use App\Models\Menu;
use App\Models\MenuVariant;
use App\Models\MenuVariantDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderPayment;
use Livewire\Component;

class Create extends Component
{
    public $category = [];
    public $menu = [];
    public $menuVariant = [];
    public $selectCategory;
    public $selectMenu;
    public $selectMenuVariant;
    public $menuOrder = [];
    public $total = 1;
    public $totalPrice = 0;
    public $stockOrderId = [];

    public function rules() {
        return [
            'selectMenu' => 'required',
            'selectMenuVariant' => 'required',
            'selectCategory' => 'required'
        ];
    }

    public function mount() {
        $this->category = Category::select('id', 'name')->get();
    }

    public function addMenu() {
        $this->validate();
        $menu = $this->menu[$this->selectMenu]->toArray();
        $menuVariant = $this->menuVariant[$this->selectMenuVariant]->toArray();


        $this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['category'] = $this->category[$this->selectCategory]->toArray();

        if(isset($this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['total']))
        $this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['total'] += $this->total;
        else
        $this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['total'] = $this->total;

        $this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['menu'] = $this->menu[$this->selectMenu]->toArray();
        $this->menuOrder[$this->category[$this->selectCategory]['name']][$menu['name']][$menuVariant['name']]['menuVariant'] = $this->menuVariant[$this->selectMenuVariant]->toArray();

        $price = $this->total *( $this->menu[$this->selectMenu]->toArray()['price'] + $this->menuVariant[$this->selectMenuVariant]->toArray()['menu_variant_detail']['price']);
        $this->totalPrice += $price;

        if(isset($this->stockOrderId[$this->menuVariant[$this->selectMenuVariant]['id']]))
        $this->stockOrderId[$this->menuVariant[$this->selectMenuVariant]['id']] += $this->total;
        else
        $this->stockOrderId[$this->menuVariant[$this->selectMenuVariant]['id']] = $this->total;

        $this->selectCategory = null;
        $this->selectMenu = null;
        $this->selectMenuVariant = null;
        $this->menu = [];
        $this->menuVariant = [];
    }

    public function deleteMenu($type, $menu, $menuVariant, $menuVariantId) {
        $menus = $this->menuOrder[$type][$menu][$menuVariant];
        $price = $menus['total'] * ($menus['menu']['price'] +$menus['menuVariant']['menu_variant_detail']['price']);
        $this->totalPrice -= $price;

        if(count($this->menuOrder[$type]) > 1) {
            unset($this->menuOrder[$type][$menu][$menuVariant]);
            array_values($this->menuOrder);
        } else {
            unset($this->menuOrder[$type]);
        }
        unset($this->stockOrderId[$menuVariantId]);
    }

    public function setCategory($key, $id) {
        $this->selectCategory = $key;
        $this->menu = Menu::select('categories_id', 'name', 'id', 'price')->where('categories_id', $id)->get();
        $this->selectMenu = null;
        $this->selectMenuVariant = null;
    }

    public function setMenu($key, $id) {
        $this->selectMenu = $key;
        $this->menuVariant = MenuVariant::with('menuVariantDetail')->select('menus_id', 'id', 'name')->where('menus_id', $id)->get();
        $this->selectMenuVariant = null;
    }

    public function setMenuVariant($key) {
        $this->selectMenuVariant = $key;
    }

    public function order() {
        $order = new Order;
        $order->reference_order = $this->generateOrderNumber();
        $order->payment_status = 'unpaid';
        $order->created_by = auth()->id();
        $order->updated_by = auth()->id();
        $order->save();

        foreach($this->menuOrder as $item) {
            foreach($item as  $subItem) {
                foreach($subItem as $subChildItem) {
                    $orderDetail = new OrderDetail;
                    $orderDetail->orders_id = $order->id;
                    $orderDetail->menu_variants_id = $subChildItem['menuVariant']['id'];
                    $orderDetail->amount = $subChildItem['menuVariant']['menu_variant_detail']['price'];
                    $orderDetail->total_item = $subChildItem['total'];
                    $orderDetail->save();

                    $this->updateStockMenu($subChildItem['menuVariant']['id'], $subChildItem['total']);
                }
            }
        }

        $orderPayment = new OrderPayment;
        $orderPayment->orders_id = $order->id;
        $orderPayment->total_order = $this->totalPrice;
        $orderPayment->save();

        session()->flash('orderSuccess', "Order has process");
        return redirect()->route('order.index');
    }

    public function updateStockMenu($variantId, $totalItem) {
        $menuVariantDetail = MenuVariantDetail::where('menu_variants_id', $variantId)->first();
        $menuVariantDetail->stock -= $totalItem;
        $menuVariantDetail->save();
    }

    private function generateOrderNumber() {
        $number = '';
        $date = date('ymd');

        $order = Order::latest()->first() ?? [];

        if($order) {
            $splitNumber = substr($order->reference_order, 4, 2);

            if(date('d') == $splitNumber) {
                $lastNumeric = substr($order->reference_order, -4);
                $lastNumeric += 1;
                $lastNumeric = str_pad($lastNumeric, 4, "0", STR_PAD_LEFT);
                $number = $date.$lastNumeric;
            } else {
                $lastNumeric = str_pad(1, 4, "0", STR_PAD_LEFT);
                $number = $date.$lastNumeric;
                $number;
            }
        } else {
            $lastNumeric = str_pad(1, 4, "0", STR_PAD_LEFT);
            $number = $date.$lastNumeric;
        }

        return $number;
    }

    public function render()
    {
        return view('livewire.cms.order.create');
    }
}

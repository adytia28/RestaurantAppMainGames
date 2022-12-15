<?php

namespace App\Http\Livewire\Cms\Stock;

use App\Models\MenuVariantDetail;
use Livewire\Component;

class Index extends Component
{
    public $showStock;
    public $addStock;

    public function showStock($id) {
        $this->showStock = $id;
    }

    public function updateStock() {
        $stock = MenuVariantDetail::find($this->showStock);
        $stock->stock += $this->addStock;
        $stock->save();

        session()->flash("updateSuccess", "Stock berhasil di update");
        return redirect()->route('stock.index');
    }

    public function render()
    {
        $stocks = MenuVariantDetail::select('stock', 'id','menu_variants_id')
                                    ->with('menuVariant')
                                    ->orderBy('stock', 'ASC')
                                    ->paginate(10);
        return view('livewire.cms.stock.index', compact('stocks'));
    }
}

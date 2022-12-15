<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuVariant extends Model
{
    use HasFactory;

    public function menu() {
        return $this->belongsTo(Menu::class, 'menus_id', 'id')->with('category');
    }

    public function menuVariantDetail() {
        return $this->belongsTo(MenuVariantDetail::class, 'id', 'menu_variants_id');
    }
}

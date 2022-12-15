<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuVariantDetail extends Model
{
    use HasFactory;

    public function menuVariant() {
        return $this->belongsTo(MenuVariant::class, 'menu_variants_id', 'id')->with('menu');
    }
}

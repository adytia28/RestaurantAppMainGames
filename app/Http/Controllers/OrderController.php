<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        return view('cms.order.index');
    }

    public function create() {
        return view('cms.order.create');
    }

    public function show($reference) {
        return view('cms.order.show', compact('reference'));
    }

    public function print() {
        return view('cms.order.print');
    }
}

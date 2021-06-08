<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $plans = Plan::get();
        $intent = $request->user()->createSetupIntent();

        return view('checkout', compact('plans', 'intent'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}

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
        $stripeKey = env('STRIPE_KEY');

        return view('checkout', compact('plans', 'intent', 'stripeKey'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'payment_method' => 'required',
            'plan' => 'required|exists:plans,id'
        ]);

        $plan = Plan::find($request->plan);

        try {
            $subscription = $request
                ->user()
                ->newSubscription('default', $plan->stripe_id)
                ->create($request->payment_method);
        } catch (\Laravel\Cashier\Exceptions\IncompletePayment $e) {
            return redirect()->route('cashier.payment', [
                $e->payment->id, 'redirect' => route('home')
            ]);
        }

        return view('payments.success');
    }
}

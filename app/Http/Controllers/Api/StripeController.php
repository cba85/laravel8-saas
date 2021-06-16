<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class StripeController extends Controller
{
    public function intent(Request $request)
    {
        return response()->json($request->user()->createSetupIntent());
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'payment_method' => 'required',
            'plan' => 'required|exists:plans,id',
            'coupon' => 'nullable'
        ]);
       
        $plan = Plan::find(1);
       
        try {
            $subscription = $request->user()
                ->newSubscription('default', $plan->stripe_id)
                ->withCoupon($request->coupon)
                ->create($request->payment_method);
            return response()->json($subscription);
        } catch (\Laravel\Cashier\Exceptions\IncompletePayment $e) {
            return response()->json($e->payment);
        }
    }
}

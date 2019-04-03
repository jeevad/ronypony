<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Database\Country;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Shipping\Facade as Shipping;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::all();

        $paymentOptions = Payment::all();
        $countries = Country::options();

        return view('checkout.index')
            ->with('cartItems', $cartItems)
            ->with('countries', $countries)
            ->with('paymentOptions', $paymentOptions);
    }

    public function checkoutFieldUpdated(Request $request)
    {
        $responseData = [];

        $data = $request->all();
        $shippingOptions = Shipping::all();
        foreach ($shippingOptions as $option) {
            $view = $option->calculate($data);
            if (null !== $view) {
                $responseData['shipping'][] = $view;
            }
        }
        //$paymentOptions = Payment::all();

        return $responseData;
    }
}

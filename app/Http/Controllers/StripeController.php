<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use Session;
use Stripe;
use Auth;
use Exception;
use Carbon\Carbon;
use App\Models\PaymentDetail;
use App\Models\PickDropLocation;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function store(Request $request)
    {
		$users = User::where('id', Auth::user()->id)->first();
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            'name' =>  $users->name . $users->last_name,
            'email' => $users->email,
            "source" => $request->stripeToken
        ));

        $response = Stripe\Charge::create ([
            "amount" => 100* 100,
            "currency" => 'usd',
            "description" => 'FITNEX Subscription',
            "customer" => $customer->id,
        ]);
         if($response){
            $order_number = rand(10000,10000);
            $payment = Payment::create([
                'customer_id' => Auth::user()->id,
                'order_number' =>$order_number,
                'total_payment' => '100',
                'paid' => '100',
                'dues' => '0',
                'payment_status' => $response['status'],
            ]);

            if($payment){
                PaymentDetail::create([
                    'order_number' => $order_number,
                    'transaction_id' => $response['source']['id'],
                    'transaction_status' => $response['status'],
                    'name_on_card' => $request->name_on_card,
                    'expiration_month' => $response['source']['exp_month'],
                    'expiration_year' => $response['source']['exp_year'],
                    'transaction_date' => date('Y-m-d'),
                ]);
            }
        }
        return redirect()->route('home');
    }
}

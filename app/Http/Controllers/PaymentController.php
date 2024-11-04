<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Set your Merchant Server Key
        Config::$serverKey = 'SB-Mid-server-dWHapRsQqkseTQ4p-XDkMYXN';
        
        // Set to Development/Sandbox Environment
        Config::$isProduction = false;
        
        // Set sanitization and 3DS for transactions
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Prepare the transaction parameters
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $request->gross_amount,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'last_name' => '',
                'email' => $request->email,
                'phone' => '',
                'kode_tiket' => $request->kode_tiket,
            ],
        ];

        // Generate the Snap token
        $snapToken = Snap::getSnapToken($params);

        // Store the snap token in session
        session(['snapToken' => $snapToken]);

        // Redirect to the index method
        return redirect()->route('payment.index');
    }

    public function index(Request $request)
    {
        // Retrieve the snap token from the session
        $snapToken = session('snapToken');

        // Render the Payment.vue component with the snap token
        return Inertia::render('Payment', ['snapToken' => $snapToken]);
    }
}

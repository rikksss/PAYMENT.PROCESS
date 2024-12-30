<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('auth.payment');
    }

    public function processPayment(Request $request)
    {
        return view('auth.payment'); // Ensure this matches the path to your Blade file
    }

    public function updateTransactionId(Request $request)
    {
        $transactionDetails = Session::get('transaction_details');
        $payment = new Payments();
        $payment->order_id = $transactionDetails['order_id'];
        $payment->payment_method = $transactionDetails['payment_method'];
        $payment->payment_status = 'Completed'; // Update status after payment
        $payment->transaction_id = $request->transaction_id;
        $payment->amount = $transactionDetails['amount'];
        $payment->save();
    
        return response()->json(['success' => true]);
    }
        public function saveTransaction(Request $request)
    {
        Session::put('transaction_details', $request->all());
        return response()->json(['success' => true]);
    }
}
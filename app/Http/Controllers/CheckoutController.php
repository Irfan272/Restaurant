<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use App\Helpers\MidtransHelper;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index');
    }

    public function submit(Request $request)
    {
        $total = 22000 * 2 + 20000 * 1;

        if ($request->metode_pembayaran === 'qris') {
            MidtransHelper::config();

            $orderId = 'ORDER-' . time();

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $total,
                ],
                'customer_details' => [
                    'first_name' => 'Customer',
                    'email' => 'customer@example.com',
                ],
                'enabled_payments' => ['qris'],
            ];

            $snapToken = Snap::getSnapToken($params);

            return view('checkout.qris', compact('snapToken'));
        }

        // Proses cash (misal simpan ke database)
        return redirect()->back()->with('status', 'Pembayaran cash berhasil.');
    }

    public function success()
    {
        return view('checkout.success');
    }
}

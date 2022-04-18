<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    /**
     * create transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        return view('transaction');
    }

    /**
     * process transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function processTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();


        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => number_format($request->get('amount'),2)
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            //Log::error($response);
            /* Create order */
            $user_order = new UserOrder();
            $user_order->amount = $request->get('amount');
            $user_order->payment_package_id = $request->get('payment_package_id');
            $user_order->user_id = Auth()->user()->id;
            $user_order->status=0;
            $user_order->reference=$response['id'];
            $user_order->save();
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('createTransaction')->with('error', 'Something went wrong.');

        } else {
            return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * success transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function successTransaction(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            //Mark as transaction complete

            //Log::error($response);
            $user_order = UserOrder::where('reference', $response['id'])->latest()->first();
            if($user_order!=null){
                $user_order->status=1;
                $user_order->save();

                $streaming_count = $user_order->payment_package->streaming_count;
                $user = User::find(Auth()->user()->id);
                $user->streaming_count = $user->streaming_count+$streaming_count;
                $user->save();

                $to = $user_order->user->email;
                $subject = "Payment Status";
                $txt = "Hi, your payment has Successfull..! Click Here : " . route('login') . " ";
                $headers = "From: info@chamathkaara.com" . "\r\n";

                mail($to, $subject, $txt, $headers);
            }


            return redirect()->route('createTransaction') ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('createTransaction')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * cancel transaction.
     *
     * @return \Illuminate\Http\Response
     */
    public function cancelTransaction(Request $request)
    {
        return redirect()
            ->route('createTransaction')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }
}

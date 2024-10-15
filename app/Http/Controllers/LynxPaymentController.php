<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Product_categories;
use App\Models\Imagetable;
use App\Models\Vendor;
use Session;
use Auth;
use Exception;
use App\Services\LynxPayment;


class LynxPaymentController extends Controller

{

    public function __construct()
    { 
        $categories = Product_categories::where("is_active", 1)->get();
        $logo = imagetable::where('table_name','logo')->latest()->first();
        View()->share('logo',$logo);
        $vendor = Vendor::where('is_active',1)->get();
        View()->share('vendor',$vendor);
        View()->share('config',$this->getConfig());
        View()->share('categories', $categories);
    }
    
    public function order_submit()
    {
        $order_upd = Orders::where('id', $_GET['order_id'])->update([
            'is_active' => 0,
            'pay_status' => $_GET['redirect_status'] == 'succeeded' ? 1 : 0,
            'order_response' => $_GET['payment_intent'],
        ]);

        $cart_data = Session::get('cart');
        $order = Orders::where('id', $_GET['order_id'])->first();
        $amount = $order->total_amount;

        $data = [
            'order' => $order,
        ];

        // Send order invoice email
        // Mail::send('email/order-invoice', ['data' => $data], function ($message) use ($order) {
        //     $message->from(env('MAIL_FROM_ADDRESS'));
        //     $message->to($order->email);
        //     $message->subject('Order Invoice');
        // });

        $order_id = $cart_data['order_id'];
        unset($cart_data['order_id']);
        $detail = OrderDetail::create([
            'order_id' => $order_id,
            'details' => serialize($cart_data),
        ]);
        Session::forget('cart');
        return redirect()->route('welcome')->with('notify_success', 'Payment Charged Successfully!');
    }

    public function paystatus(Request $request)
    {
        $status_codes = ["Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5];
        $payment_status = $request['payment_status'];

        $updateParam = $status_codes[$payment_status];

        $order_upd = Orders::where('id', $request['custom'])->update([
            'pay_status' => $updateParam,
            'order_response' => serialize($request->all()),
            'card_payment' => 'LYNX'
        ]);
    }

    public function placeorder(Request $request)
    {
        $request->validate([
            // 'fname' => 'required|string',
            // 'lname' => 'required|string',
            // 'email' => 'required|email',
            // 'phone' => 'required|string',
            // 'town' => 'required|string',
            // 'address' => 'required|string',
            // 'country' => 'required|string',
            // 'company' => 'required|string',
            // 'zip' => 'required|string',
        ]);

        $order = Orders::create([
            "user_id" => Auth::id(),
            "fname" => $request->fname,
            "product_id" => $request->product_id,
            "lname" => $request->lname,
            "email" => $request->email,
            "phone" => $request->phone,
            "note" => $request->note,
            "town" => $request->town,
            "address" => $request->address,
            "country" => $request->country,
            "company" => $request->company,
            "zip" => $request->zip,
            "total_amount" => $request->total_amount,
            "sub_amount" => $request->total_amount,
        ]);

        $cart_data = Session::get('cart');
        $cart_data['order_id'] = $order->id;
        Session::put('cart', $cart_data);
        $data = compact('cart_data');
        return redirect()->route('lynx.post')->with("notify_success", "Success!")->with($data);
    }

    public function lynxPost()
    {
        $cart_data = Session::get('cart');

        $tot = 0;
        foreach ($cart_data as $key => $value) {
            if ($key != 'order_id') {
                $rowid = $value['cart_id'];
                $tot += $cart_data[$rowid]['sub_total'] + $this->getConfig()['SHIPPINGPRICE'];
            }
        }

        $order = $cart_data['order_id'];
        $amount = $tot;

        try {
            // Initialize Lynx Payment
            // Assuming LynxPayment is a class you've created to handle Lynx payment gateway
            $lynx = new LynxPayment(env('LYNX_SECRET'));
            $paymentIntent = $lynx->createPaymentIntent([
                'amount' => $amount * 100,
                'currency' => 'usd',
                'transfer_group' => "ORDER_95",
            ]);
            $secret = $paymentIntent->client_secret;
            return view('lynxpaysecure')->with('notify_success', 'Payment Charged!')->with(compact('secret', 'amount', 'order'));
        } catch (Exception $e) {
            return back()->with('notify_error', $e->getMessage());
        }
    }

    public function checkout_landing()
    {
        return redirect()->route('home')->with('notify_success', 'Payment success!');
    }
}

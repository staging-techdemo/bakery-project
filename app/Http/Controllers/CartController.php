<?php

namespace App\Http\Controllers;
use Session;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\News;
use App\Models\Content;
use App\Models\Variation;
use App\Models\Keywords;
use App\Models\Testimonial;
use App\Models\Coupon;
use App\Models\Partner;
use App\Models\Album;
use App\Models\User;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Country;
use App\Models\OrderDetail;
use App\Models\Merchandise;
use App\Models\Meta;
use App\Models\Product_categories;
use App\Models\Referral;
use App\Models\Volet;
use App\Models\Package;
use App\Models\Plane;
use Stripe;

use Auth;

use App\Models\Vendor;
use Stripe\Customer;
use Stripe\Subscription;
use Stripe\Plan;
use Stripe\PaymentIntent;
use Illuminate\Support\Facades\Validator;
use Mail;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
class CartController extends Controller
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
        $order_upd = Orders::where('id',$_GET['order_id'])->update([
            'is_active' => 0,
            'pay_status' => $_GET['redirect_status']=='succeeded'?1:0,
            'order_response' => $_GET['payment_intent'],
        ]);
        $cart_data = Session::get('cart');
        $order = Orders::where('id',$_GET['order_id'])->first();
        $amount = $order->total_amount;
        
        
        $data = [
            'order' => $order,
        ];
        
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
        // return response()->json(['status' => 1]);
        return redirect()->route('welcome')->with('notify_success','Payment Charged Successfully!');
    }


    public function paystatus(Request $request)
    {
        $status_codes = array("Default" => 0, "Completed" => 1, "Pending" => 2, "Denied" => 3, "Failed" => 4, "Reversed" => 5);
        $payment_status = $request['payment_status'];

        $updateParam = $status_codes[$payment_status];

        $order_upd = Orders::where('id',$request['custom'])->update([
            'pay_status' => $updateParam,
            'order_response' => serialize($request->all()),
            'card_payment' => 'PAYPAL'
        ]);
            
    }

    public function placeorder(Request $request)
    {
        // Validate the request
        // $request->validate([
        //     'fname' => 'required|string',
        //     'lname' => 'required|string',
        //     'email' => 'required|email',
        //     'phone' => 'required|string',
        //     'town' => 'required|string',
        //     'address' => 'required|string',
        //     'country' => 'required|string',
        //     'company' => 'required|string',
        //     'zip' => 'required|string',
        //     'total_amount' => 'required|numeric', // Ensure total_amount is included and is numeric
        // ]);
    
        // Create the order with the total amount including shipping
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
            "total_amount" => $request->total_amount, // Save the total amount including shipping
            "sub_amount" => $request->total_amount,   // This could just be the subtotal without shipping
        ]);
    
        // Update cart data in session with the new order ID
        $cart_data = Session::get('cart');
        $cart_data['order_id'] = $order->id;
        Session::put('cart', $cart_data);
    
        // Update the session with the total amount including shipping
        Session::put('total_amount', $request->total_amount);
    
        // Pass the data to the Stripe payment gateway
        return redirect()->route('stripe.post')
            ->with("notify_success", "Success!")
            ->with('cart_data', $cart_data);
    }
    





    
    // public function stripePost()
    // {
    //     $cart_data = Session::get('cart');
        
    //     // Retrieve the total amount including shipping from the session
    //     $amount = Session::get('total_amount', 0); // Default to 0 if not set
    
    //     // Debug the values
    
    //     try {
    //         \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
    //         $stripe = \Stripe\PaymentIntent::create([
    //             'amount' => $amount * 100, // Amount in cents
    //             'currency' => 'usd',
    //             'transfer_group' => "ORDER_95",
    //         ]);
    
    //         $secret = $stripe->client_secret;
    //         return view('paysecure')->with('notify_success', 'Payment Charged!')->with(compact('secret', 'amount'));
    //     } catch (\Exception $e) {
    //         return back()->with('notify_error', $e->getMessage());
    //     }
    // }


    public function stripePost()
    {
        $cart_data = Session::get('cart');
        
    //     // Retrieve the total amount including shipping from the session
        $amount = Session::get('total_amount', 0); // Default to 0 if not set
        
        $order = $cart_data['order_id'];
        // $amount = $tot;
        
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
                
            $stripe = \Stripe\PaymentIntent::create([
                'amount' => $amount*100,
                'currency' => 'usd',
                'transfer_group' => "ORDER_95",
            ]);
            $secret = $stripe->client_secret;
            return view('paysecure')->with('notify_success','Payment Charged!')->with(compact('secret', 'amount', 'order'));
        } catch(\Stripe\Exception\CardException $e) {
            return back()->with('notify_error',"a ".$e->getError()->message);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return back()->with('notify_error',"b ".$e->getError()->message);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return back()->with('notify_error',"c ".$e->getError()->message);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return back()->with('notify_error',"d ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return back()->with('notify_error',"e ".$e->getError()->message);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return back()->with('notify_error',"f ".$e->getError()->message);
        } catch (Exception $e) {
            return back()->with('notify_error',"g ".$e->getError()->message);
        }
    }

    public function checkout_landing()
    {
        return redirect()->route('home')->with('notify_success','Payment success!');
    }

    

    
    
    public function subscription_create(Request $request)
    {
        $order_upd = Orders::where('id',$request['order'])->update([
            'is_active' => 1,
            'pay_status' => 1,
        ]);
        
        $order_data = Orders::where('id', $request['order'])->first();
        $package = Package::where('id', $order_data->pkg_id)->first();

        Mail::send('email/subscription', ['order_data' => $order_data,'package' => $package], function ($message) use ($order_data){
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($order_data->email);
            $message->subject('Thank You!');
        }); 
       
        return redirect()->route('home')->with('notify_success','Payment Charged Successfully!');
    }


    public function save_cart(Request $request)
    {
        if(Session::has('cart') && !empty(Session::get('cart')))
        {
           $rowid = null;
           $flag = 0;
           $cart_data = Session::get('cart');
            foreach ($cart_data as $key => $value) 
            {
                if($key == 'order_id'){
                    continue;
                }
                $product_id = $request->product_id;
                $cartId = $product_id;
                if((intval($value['product_id']) == intval($request['product_id'])) && $value['cart_id'] == $cartId)
                {
                    $flag = 1;
                    $rowid = $value['cart_id'];
                    $cart_data[$rowid]['quantity'] += $request['qty'];
                    $cart_data[$rowid]['sub_total'] = $cart_data[$rowid]['price']*$cart_data[$rowid]['quantity'];
       
                    Session::forget($rowid);
                    Session::put('cart',$cart_data); 

                    return redirect()->route('cart')->with('notify_success','Product Added To Cart Successfully!');
                }
            }
        }

        $product_id = $request->product_id;
        $qty = $request->qty;
        
        $cart = array();
        $cartId = $product_id;
        if(Session::has('cart')){
            $cart = Session::get('cart');
        }
        
        if($qty == 0){
            $qty = 1;
        }
        
        if(intval($qty) > 0)
        {
            if(!empty($cartId) && !empty($cart))
            {
                unset($cart[$cartId]);
            }
            $product = Products::where('id',$product_id)->first();
            $cart[$cartId]['price'] = $request->price;
            $cart[$cartId]['cart_id'] = $cartId;
            $cart[$cartId]['quantity'] = $qty;
            $cart[$cartId]['sub_total'] = floatval($request->price*$qty);
            $cart[$cartId]['product_id'] = $product_id;
            
            Session::put('cart',$cart);
            return redirect()->route('cart')->with('notify_success', 'Item Added to cart Successfully');
        }
        else
        {
            return back()->with('notify_error', 'Something Went Wrong, Please Try Again!');
        }
        
    }



    public function updatecart(Request $request)
    {
        $rowid = $request->rowid;
        $qty = $request->qty;
        $cart_data = Session::get('cart');
        $cart_data[$rowid]['quantity'] = $qty;
        
        $cart_data[$rowid]['sub_total'] = $request['price']*$qty;
        Session::forget($rowid);
        Session::put('cart',$cart_data);

        return response()->json(['status' , 1]);
    }

    public function removecart($cart_id , Request $request)
    {
        $rowid = $cart_id;
        $cart_data = Session::get('cart');
        unset($cart_data[$rowid]);
        Session::forget('cart');
        Session::put('cart',$cart_data);
        return redirect()->back()->with('notify_success', 'Item removed!');
    }
    
       
}


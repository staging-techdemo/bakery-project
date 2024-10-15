<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Imagetable;
use App\Models\Inquiry;
use App\Models\User;
use App\Models\Admin;
use App\Models\Wishlist;
use App\Models\Config;
use App\Models\Review;
use App\Models\Products;
use App\Models\Category;
use App\Models\Sub_category;
use App\Models\Product_categories;
use App\Models\Newsletter;

use App\Models\Password_resets;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Contest_participants;
use App\Models\Quote;
use Illuminate\Support\Facades\Crypt;


class UserController extends Controller
{
    public function __construct()
    {
        $categories = Product_categories::where("is_active", 1)->get();
        $logo = Imagetable::where('table_name', "logo")->latest()->first();
        View()->share('logo', $logo);
        View()->share('config', $this->getConfig());
        $route = \Request::route()->getName();
        $banner = Imagetable::where('table_name', $route)->where('type', 2)->where('is_active_img', 1)->first();
        View()->share('banner', $banner);
        View()->share('categories', $categories);
    }

    public function login_submit(Request $request)
    {
        $validator = $request->validate([
            'login_email' => 'required|email|max:255',
            'login_password' => 'required|max:50',
        ]);
    
        $current_user = User::where("email", $request->login_email)->first();
    
        if ($current_user) {
            if ($current_user->verified_user == 1) {
                // Attempt to authenticate the user
                if (Auth::attempt(['email' => $request->login_email, 'password' => $request->login_password])) {
                    // User is verified and authenticated, proceed to home
                    return redirect()->route('welcome')->with('notify_success', 'Logged In!');
                } else {
                    // Authentication failed, invalid credentials
                    return back()->with('notify_error', 'Invalid Credentials');
                }
            } else {
                // User is not verified, redirect to verification page with user_id
                $user_id = encrypt($current_user->id);
                return redirect()->route('user_verification', $user_id)->with('notify_error', 'Please verify your account.');
            }
        } else {
            // User not found, redirect to signup
            return redirect()->route('signup')->with('notify_error', 'Sign up Your account first.');
        }
    }
    


    public function signup_submit(Request $request)
    
    {
        $validator = $request->validate([
            'full_name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'sign_up_password' => 'required',
            
        ]);

        $user = User::create([
            'full_name' => $request['full_name'],
            'email' => $request['email'],
            // 'password' => bcrypt($request['password']),
            'password' => bcrypt($request['sign_up_password']),
        ]);
        Auth::login($user);
        return redirect()->route('welcome')->with('notify_success', 'Signup successfully');
    }
    
    // public function signup_submit(Request $request)
    
    // {
    //     $validator = $request->validate([
    //         'full_name' => 'required|max:255',
    //         'email' => 'required|email|unique:users|max:255',
    //         'sign_up_password' => 'required',
            
    //     ]);
    //     $otp = rand(100000, 999999);

    //     // Store hashed OTP directly in users table
    //     $user = User::create([
    //         'full_name' => $request['full_name'],
    //         'email' => $request['email'],
    //         'password' => bcrypt($request['sign_up_password']),
    //         'code' => $otp, // Store the hashed OTP directly
    //         'verified_user' => 0,
    //         'is_active' => 0
    //     ]);


    //     // Send OTP to user's email
    //     $user_id = encrypt($user->id);
    //     Mail::send('email.verify', ['otp' => $otp, 'user_id' => $user_id], function ($message) use ($request) {
    //         $message->from(env('MAIL_FROM_ADDRESS'));
    //         $message->to($request->email);
    //         $message->subject('OTP Verification');
    //     });

    //     return redirect()->route('user_verification',$user_id)->with('notify_success', 'Enter your OTP code');
    // }

    public function otp_submit(Request $request)
    {
        $userId = $request->user_id;
        $user = User::find($userId);
        if ($user && $user->code == $request->code) {
           
            $user->verified_user = 1;
            $user->is_active = 1;
            $user->save();
    
            Auth::loginUsingId($userId);
    
            return redirect()->route('welcome')->with('notify_success', 'Complete Email Verification'); // Redirect to home after successful verification
        }
        $user_id = encrypt($request->user_id);
        return redirect()->route('user_verification', $user_id)->with('notify_error', 'Invalid OTP code');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome')->with('notify_success', 'Logged Out!');
    }



    public function contact_us_submit(Request $request)
    {
        $validator = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            // 'phone' => 'required|string',
            'message' => 'required|string',
            // 'subject' => 'required|string'
        ]);

        $inquiry = Inquiry::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'message' => $request['message'],
            'phone' => $request['phone'],
            'subject' => $request['subject']
        ]);

        return redirect()->route('welcome')->with('notify_success', 'Inquiry Submitted!');
    }

    public function newsletter_submit(Request $request)
    {
        $validator = $request->validate([
            'email' => 'required|email|max:255|',
        ]);


        $newsletter = Newsletter::create([
            'email' => $request['email'],
            'name' => $request['name'],
        ]);

        return redirect()->route('welcome')->with('notify_success', 'Request Submitted!');
    }

    public function forget_password()
    {
        return view('forgot-password')->with('title', 'Recovrey');
    }
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('email/reset-password', ['token' => $token, 'request' => $request], function ($message) use ($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return redirect()->route('welcome')->with('notify_success', 'We have e-mailed your password reset link!');
    }

    public function forget_password_token($token)
    {
        $reset_email =  password_resets::where('token', $token)->first();
        if ($reset_email != null) {

            return view('forgot-password-form', ['token' => $token, 'email' => $reset_email])->with(compact('reset_email'))->with('title', 'Recovery');
        } else {
            return redirect()->route('welcome')->with('notify_error', 'Inavlid Token');
        }
    }


    public function forget_password_reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $updatePassword = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->latest()->first();

        if (!$updatePassword) {
            return back()->withInput()->with('notify_error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where(['email' => $request->email])->delete();
        return redirect()->route('login')->with('notify_success', 'Your password has been changed!');
    }



    public function addToWishlist(Request $request)
    {
        // dd($request->all());    
        $product =Products::where('id',$request['productid'])->where('is_active',1)->first();
        // dd($product);
        $wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$product->id)->first();
        // dd($wishlist);
 if(isset($wishlist) && !empty($wishlist)){
    // dd($wishlist);
         $wishlist = Wishlist::where('user_id',Auth::id())->where('product_id',$product->id)->delete();

        $param = ['status'=>2,'msg'=>'Product Removed From Wishlist'];
        return response()->json($param);

        }
        else{

     

            $wishlist = Wishlist::create([
                'user_id'=> Auth::id(),
                'product_id'=>$product->id,
                'name'=>$product->name,
                'price'=>$product->price,
                'img_path'=>$product->img_path,
                'slug'=>$product->slug,
                ]);
                
                
                    $param = ['status'=>1];
                    return response()->json($param);
        }
            
    }
    
     public function removeFromWishlist(Request $request)
    {
        // dd($request->all());
        
        $wishlist = Wishlist::where('product_id',$request->productid)->where('user_id',Auth::id())->delete();
            
        $param = array();
        $param = ['status'=>1,'msg'=>'Product Removed From Wishlist'];
          echo json_encode($param);
    }





    public function participant_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'img_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

   


        $contest_participant = Contest_participants::create([
            'name' => $request['name'],
            'contest_id' => $request['contest_id'],
            'user_id' => $request['user_id'],
        ]);

        if ($request->hasFile('img_path')) {
            $img_path = $request->file('img_path')->store('uploads/contest/participants/design-images', 'public');
            Contest_participants::where('id', $contest_participant->id)->update([
                'img_path' => $img_path
            ]);
        }


        return redirect()->route('welcome')->with('notify_success', 'You have been added as a participant.');
    }




    public function quote_submit(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'company_name' => 'required|string',
            'address' => 'required|string',
            'other_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
            'h_phone' => 'required|string',
            'phone' => 'required|string',
            'contact_method' => 'required|string',
            // 'e_date' => 'required|string',
            'e_location' => 'required|string',
            'about_us' => 'required|string',
            'e_planning' => 'required|string',
            'persons' => 'required|string',
            'message' => 'required|string',
            // 'd_date' => 'required|string',
            // 'd_time' => 'required|string',
            'pickup' => 'required|string',
            // 'p_time' => 'required|string',
        ]);

        $quote = Quote::create([
            'name' => $request['name'],
            'company_name' => $request['company_name'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'other_address' => $request['other_address'],
            'city' => $request['city'],
            'state' => $request['state'],
            'zip' => $request['zip'],
            'email' => $request['email'],
            'h_phone' => $request['h_phone'],
            'contact_method' => $request['contact_method'],
            'e_date' => $request['e_date'],
            'e_location' => $request['e_location'],
            'about_us' => $request['about_us'],
            'e_planning' => $request['e_planning'],
            'persons' => $request['persons'],
            'message' => $request['message'],
            'd_date' => $request['d_date'],
            'd_time' => $request['d_time'],
            'pickup' => $request['pickup'],
            'p_time' => $request['p_time'],
        ]);

        return redirect()->route('welcome')->with('notify_success', 'Quotation Inquiry Submitted!');
    }




}

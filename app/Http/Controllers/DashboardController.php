<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Support\Str;
use App\Models\inquiry;
use App\Models\Orderrequest;
use App\Models\Imagetable;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Route;
use Session;
use Illuminate\Support\Facades\DB;
use App\Models\Testimonial;
use App\Models\Partner;
use App\Models\Album;
use App\Models\Photos;
use App\Models\Blog;
use App\Models\Faq;
use App\Models\Matches;
use App\Models\Team;
use App\Models\Review;
use App\Models\ShopImage;
use App\Models\Products;
use App\Models\Merchandise;
use App\Models\categories;
use App\Models\Orders;
use App\Models\OrderDetail;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers;
use App\Models\Package;
use App\Models\Template;
use App\Models\Users_template;
use App\Models\Templates_inquiry;



class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $logo = imagetable::where('table_name', 'logo')->latest()->first();
        $user = User::where('id', Auth::id())->first();
        View()->share('logo', $logo);
        View()->share('user', $user);
        View()->share('config', $this->getConfig());
    }

    public function dashboard()
    {
        $user = User::where('id', Auth::id())->first();
        return view('userdash.dashboard.index')->with('title', 'My Dashboard')->with(compact('user'))
            ->with('dashMenu', true);
    }

    public function myProfile()
    {
        $user = User::where('id', Auth::id())->first();
        return view('userdash.dashboard.myprofile')->with('title', 'My Profile')->with(compact('user'))
            ->with('myProfileMenu', true);
    }

    public function editprofile()
    {
        $user = User::where('id', Auth::id())->first();
        return view('userdash.dashboard.edit-profile')->with('title', 'Edit Profile')->with(compact('user'))
            ->with('myProfileMenu', true);
    }

    public function saveprofile(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'country' => 'required',
        ]);
        $user = User::where('id', Auth::id())->update([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'country' => $request->country
        ]);

        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->store('Uploads/User/avatar' . $request->id . rand() . rand(10, 100), 'public');
            $image = User::where('id', $request->id)->update(

                [

                    'profile_img' => $avatar,

                ]
            );
        }
        return redirect()->route('dashboard.editProfile')->with('notify_success', 'Profile Updated!');
    }

    public function myorders()
    {
        $orders = Orders::where('user_id', Auth::id())->with('orderHasDetail')->get();
        return view('userdash.dashboard.mybooking')->with('title', 'My Orders')->with(compact('orders'))
            ->with('mybookingMenu', true);
    }

    public function vieworders($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $order = Orders::where('id', $decrypted)->where('user_id', Auth::id())->with('orderHasDetail')->first();
        $products = Products::where('is_active', 1)->get();

        if ($order->orderHasDetail) {
            $order_detail = unserialize($order->orderHasDetail->details);
        } else {
            // Handle the case where orderHasDetail is null
            $order_detail = [];
        }


        if ($order) {
            $package = Package::where('id', $order->pkg_id)->first();

            return view('userdash.dashboard.viewbooking')->with('title', 'View Order')->with(compact('order', 'package','products','order_detail'));
        } else {
            return back()->with('notify_error', 'No Details Found!');
        }
    }

    public function deleteorders($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $orders = Orders::where('id', $decrypted)->where('user_id', Auth::id())->with('orderHasDetail')->delete();
        return back()->with('notify_success', 'Order Deleted!');
    }

    public function mybookings()
    {
        $bookings = Booking::where('user_id', Auth::id())->get();
        return view('userdash.dashboard.orderbooking')->with('title', 'My Bookings')->with(compact('bookings'))
            ->with('orderbookingMenu', true);
    }

    public function viewbookings($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $bookings = Booking::where('id', $decrypted)->where('user_id', Auth::id())->first();
        return view('userdash.dashboard.vieworderbooking')->with('title', 'View Booking')->with(compact('bookings'))->with('orderbookingMenu', true);
    }

    public function deletebookings($decrypt)
    {
        $decrypted = Crypt::decryptString($decrypt);
        $bookings = Booking::where('id', $decrypted)->where('user_id', Auth::id())->delete();
        return back()->with('notify_success', 'Booking Deleted!');
    }

    public function passwordchange()
    {
        $user = User::where('id', Auth::id())->first();
        return view('userdash.dashboard.password-change')->with('title', 'Change Password')->with(compact('user'))->with('passChangeMenu', true);
    }

    public function updatepassword(Request $request)
    {
        $validator = $request->validate([
            'password' => 'required|min:4',
            'password_confirmation' => 'required|same:password',
        ]);
        $user = User::where('id', Auth::id())->first();
        $user->password = bcrypt($request['password']);
        $user->save();
        return redirect()->route('dashboard.passwordChange')->with('notify_success', 'Password Updated!');
    }

    public function myWishlist()
    {
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('userdash.dashboard.wishlist.index')->with('title', 'My Wishlist')->with('mywishlistMenu', true)->with(compact('wishlist'));
    }

    // public function refund()
    // {
    //     $orderrequest = Orderrequest::where(['user_id' => Auth::id() , 'request_type' => 2 ])->get();
    //     return view('userdash.dashboard.refund.index')->with('title','Refund Management')->with(compact('orderrequest'))->with('refundMenu',true);
    // }

    // public function request_form()
    // {
    //     return view('userdash.dashboard.refund.add')->with('title','Add Request')->with('refund')->with('refundMenu',true);
    // }

    // public function submitrequest(Request $request)
    // {
    //     $request->validate([
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'email' => 'required|email',
    //         'phone' => 'required|numeric',
    //         'reason' => 'required'
    //     ]);  

    //     $Orderrequest =Orderrequest::create([
    //         'request_type' => $request['request_type'],
    //         'order_id' => $request['order_id'],
    //         'firstname' => $request['firstname'],
    //         'lastname' => $request['lastname'],
    //         'email' => $request['email'],
    //         'phone' => $request['phone'],
    //         'reason' => $request['reason'],
    //         'user_id' => Auth::id(),
    //     ]);

    //     if($Orderrequest->request_type == 2){
    //         return redirect()->route('dashboard.refund')->with('notify_success','Request Generated Successfuly!!');
    //     }
    //     if($Orderrequest->request_type == 1){
    //         return redirect()->route('dashboard.return')->with('notify_success','Request Generated Successfuly!!');
    //     }
    //     if($Orderrequest->request_type == 0){
    //         return redirect()->route('dashboard.ordercancel')->with('notify_success','Request Generated Successfuly!!');
    //     }   
    // }

    public function return()
    {
        $orderrequest = Orderrequest::where(['user_id' => Auth::id(), 'request_type' => 1])->get();
        return view('userdash.dashboard.return.index')->with('title', 'Refund Management')->with(compact('orderrequest'))->with('returnMenu', true);
    }

    public function request_formreturn()
    {
        return view('userdash.dashboard.return.add')->with('title', 'Add Request')->with('refund')->with('returnMenu', true);
    }

    public function ordercancel()
    {
        $orderrequest = Orderrequest::where(['user_id' => Auth::id(), 'request_type' => 0])->get();
        return view('userdash.dashboard.cancel.index')->with('title', 'Order Cancel Management')->with(compact('orderrequest'))->with('cancelMenu', true);
    }

    public function request_formcancel()
    {
        return view('userdash.dashboard.cancel.add')->with('title', 'Add Request')->with('refund')->with('cancelMenu', true);
    }

    public function template_listing()
    {
        $templates = Template::where("is_active",1)->get();
        $user = Auth::user();
        $used_template = Users_template::where("user_id",$user->id)->first();
        return view('userdash.dashboard.templates-management.list')->with('title', 'All Templates')->with(compact('templates','used_template'))->with('templateMenu', true);
    }
    public function current_template()
    {
        $templates = Template::get();
        $user = Auth::user();
        $current_template = Users_template::where("user_id",$user->id)->first();
        if($current_template!=null){
            $template = Template::where("id",$current_template->template_id)->first();
        }
        else{
            $template = null;
        }
        return view('userdash.dashboard.templates-management.current')->with('title', 'My Template')->with(compact('template','current_template','user'))->with('myTemplateMenu', true);
    }


    public function use_template($id)
    {
        $user = Auth::user();
        $orders = Orders::where("user_id",$user->id)->where("pay_status",1)->get();
        if(!$orders->isEmpty()){
         $used_template = Users_template::where('user_id', $user->id)->first();
             if($used_template != null){
               $used_template->update([
                    'user_id' => $user->id,
                    'template_id' => $id,
                    'template_data' => null,
                ]);
                return redirect()->route('dashboard.current_template')->with('notify_success', 'Template Changed Successfully!');
            }
         else{
                $used_template = Users_template::create([
                    'user_id' => $user->id,
                    'template_id' => $id,
                    
                ]);
                return redirect()->route('dashboard.current_template')->with('notify_success', 'Template Used Successfully!');
            }   
        }
        else{
            return redirect()->route('pricing')->with('notify_error', 'To access templates, please subscribe to a package that includes this feature');
        }
     
    }

    public function edit_template($id)
    {
        $user = Auth::user();
        $template = Template::where('id', $id)->first();
        $used_template = Users_template::where('template_id', $id)->where('user_id', $user->id)->first();
        if($used_template->template_data !=null ){
            $template_data = unserialize($used_template->template_data);
            $template_data['receive_email'] = $used_template['receive_email'];
        }
        else{
            $template_data = null;
        }
        return view('userdash.dashboard.templates-management.edit')->with('title', 'Edit Template')->with(compact('template','used_template','user','template_data'));
    }
   

    public function update_template(Request $request)
    {
        $template_id = $request->template_id;
        $user_id = $request->user_id;
        $exists_user_template = Users_template::where("user_id",$user_id)->where("template_id",$template_id)->first();
        $exists_user_template_data = $exists_user_template->template_data;
        if($template_id == 1)   {
            $request->validate([
                'banner_logo' => $exists_user_template_data ==null ? 'required' : '',
                'main_heading' => 'required|max:100',
                'short_desc' => 'required',
                'banner_image' => $exists_user_template_data ==null ? 'required' : '',
                'form_heading' => 'required|max:100',
                'form_desc' => 'required',
                'form_banner_image' => $exists_user_template_data ==null ? 'required' : '',
                'copyright_text' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
            ]); 
        }
        else if($template_id == 2)   {
            $request->validate([
                'banner_logo' => $exists_user_template_data ==null ? 'required' : '',
                'sub_heading' => 'required|max:100',
                'main_heading' => 'required|max:100',
                'short_desc' => 'required',
                'long_desc' => 'required',
                'btn_text' => 'required',
                'btn_link' => 'required',
                'banner_image' => $exists_user_template_data == null ? 'required' : '',
                'copyright_text' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
            ]); 
        }
        else if($template_id == 3)   {
            $request->validate([
                'banner_logo' => $exists_user_template_data == null ? 'required' : '',
                'main_heading' => 'required|max:100',
                'short_desc' => 'required',
                'price' => 'required',
                'btn_text' => 'required',
                'form_heading' => 'required',
                'form_desc' => 'required',
                'banner_image' => $exists_user_template_data ==null ? 'required' : '',
                'copyright_text' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
            ]); 
        }
        else if($template_id == 4)   {
            $request->validate([
                'banner_logo' => $exists_user_template_data == null ? 'required' : '',
                'sub_heading' => 'required|max:100',
                'main_heading' => 'required|max:100',
                'short_desc' => 'required',
                'long_desc' => 'required',
                'btn_text' => 'required',
                'btn_link' => 'required',
                'banner_image' => $exists_user_template_data ==null ? 'required' : '',
                'copyright_text' => 'required',
                'facebook' => 'required',
                'twitter' => 'required',
                'linkedin' => 'required',
            ]); 
        }
         

        
        if (request()->hasFile('banner_logo')) {
            $banner_logo = request()->file('banner_logo')->store('Uploads/templtes/banner_logo' . $template_id . rand() . rand(10, 100), 'public');
        }
        else{
            $unserialize_data = unserialize($exists_user_template_data);
            $banner_logo = $unserialize_data['banner_logo'];
        }
        if (request()->hasFile('banner_image')) {
            $banner_image = request()->file('banner_image')->store('Uploads/templtes/banner_image' . $template_id . rand() . rand(10, 100), 'public');
        }
        else{
            $unserialize_data = unserialize($exists_user_template_data);
            $banner_image = $unserialize_data['banner_image'];
        }
        
        if($template_id == 1){
             if (request()->hasFile('form_banner_image')) {
                $form_banner_image = request()->file('form_banner_image')->store('Uploads/templtes/form_banner_image' . $template_id . rand() . rand(10, 100), 'public');
            }
             else{
                $unserialize_data = unserialize($exists_user_template_data);
                $form_banner_image = $unserialize_data['form_banner_image'];
            }   
        }
        
        $receive_email = $request->receive_email;
        $data = $request->except('_token', 'receive_email');
        $data['banner_logo'] = $banner_logo;
        
        $data['banner_image'] = $banner_image;
        
        if (request()->hasFile('form_banner_image')) {
            $data['form_banner_image'] = $form_banner_image;
        }
        
        
        $detail = Users_template::where("user_id",$user_id)->where("template_id",$template_id)->update([
            'template_data' => serialize($data),
            'receive_email' => $receive_email,
        ]);

        return redirect()->route('dashboard.current_template')->with('notify_success', 'Details Saved Successfuly!!');
    }
    
   public function template_inquiries()
    {
        
        $user = Auth::user();
        $inquiries = Templates_inquiry::where("user_id",$user->id)->get();
        return view('userdash.dashboard.templates-inquiries.list')->with('title', 'Template Inquiries')->with(compact('inquiries'))->with('templateInqMenu', true);
    }
   public function view_template_inquiry($id)
    {
        $inquiry = Templates_inquiry::where("id",$id)->first();
        $data = compact('inquiry');
        return view('userdash.dashboard.templates-inquiries.view')->with("title","View Inquiry")->with($data);
    }
   public function delete_template_inquiry($id)
    {
        $inquiry = Templates_inquiry::where("id",$id)->delete();
        return redirect()->route('dashboard.template_inquiries')->with("notify_succes","Inquiry Deleted Successfully!");
    }
   
}

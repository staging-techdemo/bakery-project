<?php

namespace App\Http\Controllers;

use Session;
use App\Models\Imagetable;
use App\Services\ShippoService;
use App\Models\Testimonial;
use App\Models\Products;
use App\Models\Product_images;
use App\Models\Services;
use App\Models\Wishlist;
use App\Models\Package;
use App\Models\Packages_perk;
use App\Models\Blog;
use App\Models\Review;
use App\Models\Template;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Contest;
use App\Models\Templates_inquiry;
use App\Models\Product_categories;
use App\Models\Users_template;
use Auth;
use Mail;
use Carbon\Carbon;
use Str;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Models\Vote;
use App\Models\Contest_participants;
use App\Models\Faq;
use App\Models\Party;
use App\Models\Planning;
use App\Models\Sub_category;
use Stripe\Product;

class IndexController extends Controller
{
    public function __construct()
    {
        $subcats = Sub_category::get();
        $categories = Product_categories::where("is_active", 1)->orderBy('title', 'asc')->get();
        $logo = Imagetable::where('table_name', "logo")->latest()->first();
        View()->share('logo', $logo);
        View()->share('config', $this->getConfig());
        $route = \Request::route()->getName();
        $banner = Imagetable::where('table_name', $route)->where('type', 2)->where('is_active_img', 1)->first();
        $testimonials = Testimonial::where("is_active", 1)->get();
        $services = Services::where("is_active", 1)->get();
        View()->share('banner', $banner);
        View()->share('testimonials', $testimonials);
        View()->share('services', $services);
        View()->share('categories', $categories);
        View()->share('subcats', $subcats);
    }


    // -----------All View Pages-------------


    public function getProductsByCategory($categoryId)
{
    $products = Products::where('category_id', $categoryId)->get();
    return response()->json($products);
}

    public function allfeatureProducts()
{
    $featuredProducts = Products::where('is_featured', 1)->get();
    return response()->json($featuredProducts);
}

    // public function allfeatureProducts()
    // {
    //     // Fetch only the products that are featured (is_featured = 1)
    //     $featuredProducts = Product::where('is_featured', 1)->get();
        
    //     // Return the fetched featured products as a JSON response
    //     return response()->json($featuredProducts);
    // }

    public function allProducts()
{
    $products = Products::all();

    return response()->json($products);
}

public function searchProducts(Request $request)
{
    $query = $request->input('q');

    if (!$query) {
        return response()->json(['error' => 'Query parameter "q" is required.'], 400);
    }

    $products = Products::where('title', 'LIKE', "%{$query}%")
                        ->orWhere('long_desc', 'LIKE', "%{$query}%")
                        ->get();

    return response()->json($products);
}

    public function allCategory()
{
    $product_cat = Product_categories::all();

    return response()->json($product_cat);
}

    public function services($slug = null)
    {
        $sliders = Imagetable::where('table_name', 'services')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('services')->with('title', 'Services')->with($data);
    }


    public function services_detail($slug = null)
    {
        $service= Services::all()->where('slug', $slug)->first();;
        $sliders = Imagetable::where('table_name', 'services')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders','service');
        return view('services-detail')->with('title', 'Services')->with($data);
    }

    public function wishlist()
    {
        $wishlist = Wishlist::where('user_id',Auth::id())->first();
        $banner = Imagetable::where('table_name','wishlist-banner')->where('type',2)->where('is_active_img',1)->first();
        return view('wishlist')->with('title','Wishlist')->with(compact('banner','wishlist'))->with('wishlistsmenu',true);
    }



    public function policy()
    {
        $sliders = Imagetable::where('table_name', 'policy')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('policy')->with('title', 'Policy')->with($data);
    }

    public function term()
    {
        $sliders = Imagetable::where('table_name', 'term')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('term')->with('title', 'Terms & Condition')->with($data);
    }
    public function black_white_check()
    {
        $sliders = Imagetable::where('table_name', 'black-white-check')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('black-white-check')->with('title', 'Black White Check')->with($data);
    }
    
    public function user_verification($user_id)
    {
        $sliders = Imagetable::where('table_name', 'cart')->where('type', 2)->where('is_active_img', 1)->get();
        $user_id = decrypt($user_id);
        return view('verification', compact('sliders', 'user_id'));
    }

    public function checkout($ref = null)
    {
        $sliders = Imagetable::where('table_name', 'checkout')->where('type', 2)->where('is_active_img', 1)->get();
        $sub_total = 0; // Initialize $sub_total
        $total = 0; // Initialize $total

        if (Auth::check()) {
            if (isset($_GET) && !empty($_GET)) {
                Session::forget('shipping');
            }

            if (Session::has('cart') && !empty(Session::get('cart'))) {
                $cart_data = Session::get('cart');

                // Calculate $sub_total and $total based on cart_data
                foreach ($cart_data as $key => $value) {
                    if ($key != 'order_id') {
                        $sub_total += $value['sub_total'];
                        $total += $value['sub_total']; // Assuming $total is based on the same logic as $sub_total
                    }
                }

                return view('checkout')->with('title', 'Checkout')->with(compact('cart_data', 'ref', 'sliders', 'sub_total', 'total'));
            } else {
                return redirect()->route('cart')->with('notify_error', 'Your Cart Is Empty!');
            }
        } else {
            return redirect()->route('login')->with('notify_error', 'You need to login first!');
        }
    }


//     public function updateShipping(Request $request)
// {
//     $from = [
//         'name' => 'Shippo',
//         'street1' => '215 Clayton St.',
//         'city' => 'San Francisco',
//         'state' => 'CA',
//         'zip' => '94117',
//         'country' => 'US',
//         'phone' => '+1 555 341 9393',
//         'email' => 'shippotle@shippo.com',
//     ];

//     $to = [
//         'name' => 'Customer',
//         'street1' => $request->input('address'),
//         'street2' => $request->input('address2'),
//         'city' => $request->input('city'),
//         'state' => $request->input('state'),
//         'zip' => $request->input('zip'),
//         'country' => 'US',
//     ];

//     $parcel = [
//         'length' => 10, // Adjust these values based on your actual parcel dimensions
//         'width' => 10,
//         'height' => 10,
//         'distance_unit' => 'in',
//         'weight' => 1, // Adjust these values based on your actual parcel weight
//         'mass_unit' => 'lb',
//     ];

//     try {
//         $shippo = new ShippoService();
//         $shipment = $shippo->createShipment($from, $to, $parcel);
//         $rates = $shippo->getRates($shipment['object_id']);
//         $shipping_price = $rates['rates'][0]['amount'] ?? 0;
//         $total_amount = $shipping_price + $sub_total;

//         return response()->json([
//             'shipping_price' => $shipping_price,
//             'total_amount' => $total_amount,
//         ]);
//     } catch (\Exception $e) {
//         // Log detailed error for debugging
//         \Log::error('Shippo API error:', ['error' => $e->getMessage()]);
//         return response()->json([
//             'error' => 'Unable to fetch shipping rates',
//             'message' => $e->getMessage()
//         ], 500);
//     }
// }




    // public function checkout()
    // {
    //     $sliders = Imagetable::where('table_name', 'checkout')->where('type', 2)->where('is_active_img', 1)->get();
    //     $data = compact('sliders');
    //     return view('checkout')->with('title', 'Checkout')->with($data);
    // }

    public function product_gallery()
    {
        $sliders =  Imagetable::where('table_name', 'gallery')->where('type', 2)->where('is_active_img', 1)->get();

        $galleries = Gallery::get();

        // Chunk the gallery IDs into sub-arrays of length 6
        $gallery_chunks = array_chunk($galleries->pluck('id')->toArray(), 6);

        // Fill the last sub-array with null values if needed
        $last_chunk_count = count($gallery_chunks[count($gallery_chunks) - 1]);
        if ($last_chunk_count < 6) {
            $gallery_chunks[count($gallery_chunks) - 1] = array_pad($gallery_chunks[count($gallery_chunks) - 1], 6, null);
        }
        $data = compact('gallery_chunks', 'galleries');
        return view('product-gallery', ['title' => 'Product gallery', 'galleries' => $galleries])->with($data);
    }


    // public function product_detail($slug = null)
    // {
    //     $product = Products::all()->where('slug', $slug)->first();
    //     $product_other_imgs = Product_images::where('product_id', $product->id)->get();
    //     $reviews = Review::where("is_active", 1)->where("product_id", $product->id)->get();
    //     $sliders = Imagetable::where('table_name', 'productDetail')->where('type', 2)->where('is_active_img', 1)->get();
    //     $data = compact('sliders', 'product', 'product_other_imgs', 'reviews');
    //     return view('product-detail')->with('title', 'Product Details')->with($data);
    // }
     public function product_detail($slug)
    {
        $faqs = Faq::get();
        $products = Products::all(); 
        $product = Products::all()->where('slug', $slug)->first();
        $product_other_imgs = Product_images::where('product_id', $product->id)->get();
        $reviews = Review::where("is_active", 1)->where("product_id", $product->id)->get();
        $sliders = Imagetable::where('table_name', 'productDetail')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders', 'product', 'product_other_imgs', 'reviews','faqs', 'products',);
        return view('product-detail')->with('title', 'Product Details')->with($data);
    }

    public function cart()
    {
        $sliders = Imagetable::where('table_name', 'cart')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('cart')->with('title', 'Cart')->with($data);
    }

    public function faq()
    {
        $faqs = Faq::all();
        $sliders = Imagetable::where('table_name', 'faq')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders', 'faqs');
        return view('faq')->with('title', 'Help & Faq,s')->with($data);
    }
    public function credit()
    {
        $sliders = Imagetable::where('table_name', 'credit')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('credit')->with('title', 'Credit')->with($data);
    }

    public function brochure()
    {
        $sliders = Imagetable::where('table_name', 'brochure')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('brochure')->with('title', 'Brochure')->with($data);
    }

    public function helpful()
    {
        $sliders = Imagetable::where('table_name', 'helpful')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('helpful')->with('title', 'Helpful')->with($data);
    }

    public function testimonial()
    {
        $sliders = Imagetable::where('table_name', 'testimonial')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('testimonial')->with('title', 'Testimonial')->with($data);
    }

    public function party_package()
    {
        $parties = Party::where('is_active', 1)->get();
        $sliders = Imagetable::where('table_name', 'partyPackage')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders', 'parties');
        return view('party-package')->with('title', 'Party Package')->with($data);
    }

    public function planning_tip()
    {
        $planning = Planning::where('is_active', 1)->get();
        $sliders = Imagetable::where('table_name', 'planningTip')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders', 'planning');
        return view('planning-tip')->with('title', 'Planning Tip')->with($data);
    }

    public function quote_request()
    {
        $sliders = Imagetable::where('table_name', 'quoteRequest')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('quote-request')->with('title', 'Quote Request')->with($data);
    }


    public function about()
    {
        $sliders = Imagetable::where('table_name', 'about')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('about')->with('title', 'About')->with($data);
    }

    public function blog_details($slug)
    {
        $blog = Blog::where('slug', $slug)->first();
        // $related_blogs = Blog::where('category_id', $blog->category_id)->with('get_categories')->get();
        $data = compact('blog');
        return view('blog-details')->with('title', 'Blog Details')->with($data);
    }
    public function blog()
    {
        $sliders = Imagetable::where('table_name', 'blog')->where('type', 2)->where('is_active_img', 1)->get();
        $blogs = Blog::where('is_active', 1)->get();
        $data = compact('blogs', 'sliders');
        return view('blog')->with('title', 'Blog')->with($data);
    }

    public function contact()
    {
        $sliders =  Imagetable::where('table_name', 'contact')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('contact')->with('title', 'Contact')->with($data);
    }

    public function gallery()
    {
        $sliders =  Imagetable::where('table_name', 'gallery')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        $galleries = Gallery::all();
        return view('gallery', ['title' => 'Gallery', 'galleries' => $galleries])->with($data);
    }

    public function contest()
    {
        $sliders =  Imagetable::where('table_name', 'contest')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        $contests = Contest::all();

        $contests = Contest::where('is_active', '1')->get();


        return view('contest')->with(['title' => 'Contest', 'contests' => $contests])->with($data);
    }

    public function news()
    {

        $sliders =  Imagetable::where('table_name', 'news')->where('type', 2)->where('is_active_img', 1)->get();
        $data = compact('sliders');
        return view('news')->with('title', 'News')->with($data);
    }


    public function contest_detail($slug)
    {
        $sliders = Imagetable::where('table_name', 'contestDetail')->where('type', 2)->where('is_active_img', 1)->get();

        $contest = Contest::where('slug', $slug)->first();
        $contest_participants = Contest_participants::where('contest_id', $contest->id)->where('is_active', 1)->get();

        $data = compact('sliders', 'contest_participants', 'contest');

        return view('contest-detail')->with([
            'title' => 'Contest Details',
        ])->with($data);
    }


    public function participant($slug)
    {
        $sliders = Imagetable::where('table_name', 'create')->where('type', 2)->where('is_active_img', 1)->get();

        if (Auth::check()) {
            $user = Auth::user();
            $contest = Contest::where('slug', $slug)->first();
            $existingParticipant = Contest_participants::where('user_id', $user->id)
                ->where('contest_id', $contest->id)
                ->first();
            if ($existingParticipant) {
                return redirect()->route('contest')->with('notify_error', 'You have already participated in this contest.');
            }

            $data = compact('sliders', 'contest', 'user');
            return view('create-design')->with('title', 'Create Design')->with($data);
        } else {
            return redirect()->route('login')->with("notify_error", "Login to Become a participant");
        }
    }

    public function add_review(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'product_id' => 'required',
                'full_name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'message' => 'required',
                'rating' => 'required',
            ]);
            $review = Review::create([
                'user_id' =>  Auth::id(),
                'product_id' =>  $request['product_id'],
                'full_name' =>  $request['full_name'],
                'email' =>  $request['email'],
                'message' =>  $request['message'],
                'rating' =>  $request['rating'],

            ]);
            return back()->with('notify_success', 'Review Pending For Admin Approval!');
        } else {
            return back()->with('notify_error', 'Please Login To Post Reviews!!');
        }
    }


    public function products($slug = null, $subSlug = null)
{
    
    $subcats = Sub_category::get();
    $search_query = isset($_GET['search']) ? $_GET['search'] : null;
    $activeCategories = Product_categories::where('is_active', 1)->orderBy('title', 'asc')->pluck('id');

    $productsQuery = Products::where('is_active', 1)->whereIn('category_id', $activeCategories);

    if ($slug) {
        $category = Product_categories::where('slug', $slug)->orderBy('title', 'asc')->first();

        if ($category && $category->is_active) {
            if ($category->has_subcategories) {
                // Redirect to products-cate.blade.php with category information
                return redirect()->route('products_cate', ['slug' => $slug]);
            }

            $productsQuery->where('category_id', $category->id);

            if ($subSlug) {
                $productsQuery->whereHas('subcategory', function ($query) use ($subSlug, $category) {
                    $query->where('slug', $subSlug)->where('category_id', $category->id)->where('is_active', 1);
                });
            }
        }
    }

    if ($search_query) {
        $productsQuery->where('title', 'like', '%' . $search_query . '%');
    }

    $products = $productsQuery->get();

    $sliders = Imagetable::where('table_name', 'products')->where('type', 2)->where('is_active_img', 1)->get();

    $data = compact('sliders', 'products', 'activeCategories', 'subcats');

    return view('products')->with('title', 'Products')->with($data);
}


public function productsCate($slug = null)
{
    $category = Product_categories::where('slug', $slug)->first();

    if (!$category || !$category->is_active) {
        // Handle non-existent or inactive category, redirect to a default page or show an error
        return redirect()->route('default_route');
    }

    $subcategories = Sub_category::where('category_id', $category->id)->where('is_active', 1)->get();

    return view('products-cate')->with('title', 'Products by Category')->with('category', $category)->with('subcategories', $subcategories);
}




    // public function products($slug = null, $subSlug = null)
    // {
    //     $subcats = Sub_category::get();
    //     $search_query = isset($_GET['search']) ? $_GET['search'] : null;
    //     $activeCategories = Product_categories::where('is_active', 1)->orderBy('title', 'asc')->pluck('id');
    
    //     $productsQuery = Products::where('is_active', 1)->whereIn('category_id', $activeCategories);
    
    //     if ($slug) {
    //         $category = Product_categories::where('slug', $slug)->orderBy('title', 'asc')->first();
    
    //         if ($category && $category->is_active) {
    //             $productsQuery->where('category_id', $category->id);
    
    //             if ($subSlug) {
    //                 $productsQuery->whereHas('subcategory', function ($query) use ($subSlug, $category) {
    //                     $query->where('slug', $subSlug)->where('category_id', $category->id)->where('is_active', 1);
    //                 });
    //             }
    //         }
    //     }
    
    //     if ($search_query) {
    //         $productsQuery->where('title', 'like', '%' . $search_query . '%');
    //     }
    
    //     $products = $productsQuery->get();
    
    //     $sliders = Imagetable::where('table_name', 'products')->where('type', 2)->where('is_active_img', 1)->get();
    
    //     $data = compact('sliders', 'products', 'activeCategories', 'subcats');
    
    //     return view('products')->with('title', 'Products')->with($data);
    // }
    

    public function index()
    {
        $reviews = Review::get();
        // Retrieve all active parties
        $parties = Party::get();

        // Retrieve featured and active products from active categories
        $activeCategories = Product_categories::where('is_active', 1)
    ->orderBy('title', 'asc')
    ->pluck('id');
        $products = Products::where('is_featured', 1)
            ->where('is_active', 1)
            ->whereIn('category_id', $activeCategories)
            ->get();

        // Retrieve active sliders for welcome-slider
        $sliders = Imagetable::where('table_name', 'welcome-slider')
            ->where('type', 3)
            ->where('is_active_img', 1)
            ->get();

        // Retrieve all testimonials
        $testimonial = Testimonial::all();

        // Retrieve the latest active blogs with categories
        $latest_blogs = Blog::where('is_active', 1)
            ->latest()
            ->with('get_categories')
            ->get();

        // Retrieve all galleries
        $galleries = Gallery::get();

        // Chunk the gallery IDs into sub-arrays of length 6
        $gallery_chunks = array_chunk($galleries->pluck('id')->toArray(), 6);

        // Fill the last sub-array with null values if needed
        $last_chunk_count = count($gallery_chunks[count($gallery_chunks) - 1]);
        if ($last_chunk_count < 6) {
            $gallery_chunks[count($gallery_chunks) - 1] = array_pad($gallery_chunks[count($gallery_chunks) - 1], 6, null);
        }

        // Pass data to the view
        $data = compact('latest_blogs', 'sliders', 'galleries', 'testimonial', 'products', 'reviews', 'gallery_chunks', 'galleries', 'parties');
        return view('index')->with('title', 'Home')->with($data);
    }

    public function login()
    {
        return view('login')->with('title', 'Login');
    }

    public function signup()
    {
        return view('signup')->with('title', 'Signup');
    }

    public function check_slug(Request $request)
    {
        $base_slug = Str::slug($request->title, '-');
        $slug = $base_slug;
        $count = 1;

        while (User::where('slug', $slug)->exists()) {
            $slug = $base_slug . '-' . $count;
            $count++;
        }

        return response()->json(['slug' => $slug]);
    }


    public function save_design_image(Request $request)
    {
        $testimonial = Testimonial::create([
            'name' => "test",
        ]);

        if (request()->hasFile('design_image_file')) {
            $thumbnail = request()->file('design_image_file')->store('Uploads/contests/participates/design-image/' . rand() . rand(10, 100), 'public');
            // Update the img_path directly on the created testimonial
            $testimonial->update([
                'img_path' => $thumbnail,
            ]);
        }

        $response = ['code' => 200, 'messages' => ["Successfully Uploaded!"]];

        return response()->json(['response' => $response]);
    }


    // -----------All View Pages-------------

}

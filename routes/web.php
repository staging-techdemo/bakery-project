<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\SiteSettingsController;
use App\Http\Controllers\FrontEndEditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ShippingController;





// ---------------------------------------All View Pages---------------------------------------





// ---------------------------------------delivery api---------------------------------------
Route::post('/update-shipping', [ShippingController::class, 'updateShipping'])->name('update-shipping');
// ---------------------------------------delivery api---------------------------------------




Route::get('/api/products/category/{categoryId}', [IndexController::class, 'getProductsByCategory']);
Route::get('/api/all-products', [IndexController::class, 'allProducts']);
Route::get('/api/all-feature-products', [IndexController::class, 'allFeatureProducts']);
Route::get('/api/all-category', [IndexController::class, 'allCategory']);
Route::get('/api/products/search', [IndexController::class, 'searchProducts']); // Add this line


// Route::get('/policy', [IndexController::class, 'policy'])->name('policy');
// Route::get('/terms', [IndexController::class, 'term'])->name('term');
// Route::get('/product-gallery', [IndexController::class, 'product_gallery'])->name('product-gallery');
// Route::get('/faq', [IndexController::class, 'faq'])->name('faq');
// Route::get('/credit', [IndexController::class, 'credit'])->name('credit');
// Route::get('/brochure', [IndexController::class, 'brochure'])->name('brochure');
// Route::get('/helpful', [IndexController::class, 'helpful'])->name('helpful');
// Route::get('/services/{slug?}', [IndexController::class, 'services'])->name('services');
// Route::get('/services-detail/{slug}', [IndexController::class, 'services_detail'])->name('services-detail');
// Route::get('/party-package', [IndexController::class, 'party_package'])->name('party-package');
// Route::get('/planning-tip', [IndexController::class, 'planning_tip'])->name('planning-tip');
// Route::get('/quote-request', [IndexController::class, 'quote_request'])->name('quote-request');
// Route::get('/news', [IndexController::class, 'news'])->name('news');
// Route::get('/gallery', [IndexController::class, 'gallery'])->name('gallery');
// Route::get('/contest', [IndexController::class, 'contest'])->name('contest');
// Route::get('/contest-detail/{slug}', [IndexController::class, 'contest_detail'])->name('contest-detail');
// Route::get('/contest-detail/participant/{slug}', [IndexController::class, 'participant'])->name('participant');
Route::get('/checkout/{ref?}', [IndexController::class, 'checkout'])->name('checkout');
Route::get('/product-detail/{slug?}', [IndexController::class, 'product_detail'])->name('product-detail');
Route::get('/black-white-check', [IndexController::class, 'black_white_check'])->name('black-white-check');
Route::get('/cart/{slug?}', [IndexController::class, 'cart'])->name('cart');
Route::get('/testimonial', [IndexController::class, 'testimonial'])->name('testimonial');
Route::get('/about', [IndexController::class, 'about'])->name('about');
Route::get('/products/{slug?}/{subSlug?}', [IndexController::class, 'products'])->name('products');
Route::get('/shop/{slug?}/{subSlug?}', [IndexController::class, 'products'])->name('shop');
Route::get('/special-offer/{slug?}/{subSlug?}', [IndexController::class, 'products'])->name('special-offer');
Route::get('/create-basket/{slug?}/{subSlug?}', [IndexController::class, 'products'])->name('create-basket');
Route::get('/products/subcategory/{slug?}', [IndexController::class, 'productsCate'])->name('products_cate');
Route::get('/blog-details/{slug?}', [IndexController::class, 'blog_details'])->name('blog-details');
Route::get('/blog', [IndexController::class, 'blog'])->name('blog');
Route::get('/contact', [IndexController::class, 'contact'])->name('contact');
Route::get('/index', [IndexController::class, 'index'])->name('index');
Route::get('/', [IndexController::class, 'index'])->name('welcome');
Route::get('/home', [IndexController::class, 'index'])->name('home');
Route::get('/login', [IndexController::class, 'login'])->name('login');
Route::get('/signup', [IndexController::class, 'signup'])->name('signup');
Route::get('/check-slug', [IndexController::class, 'check_slug'])->name('check_slug');
Route::post('/save-design-image', [IndexController::class, 'save_design_image']);

// ---------------------------------------All View Pages---------------------------------------
Route::get('/api/csrf-token', function () {
  return response()->json(['csrfToken' => csrf_token()]);
});
// ---------------------------------------All View Form---------------------------------------
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::post('/contact-us-submit', [UserController::class, 'contact_us_submit'])->name('contact-us-submit');
Route::post('/api/contact-us-submit', [UserController::class, 'contact_us_submit'])->name('new-contact-us-submit');
Route::post('/quote-submit', [UserController::class, 'quote_submit'])->name('quote-submit');
Route::post('/newsletter_submit', [UserController::class, 'newsletter_submit'])->name('newsletter_submit');
Route::post('/login', [UserController::class, 'login_submit'])->name('login-submit');
Route::post('/sign-up', [UserController::class, 'signup_submit'])->name('sign-up-submit');
Route::post('/participant-submit', [UserController::class, 'participant_submit'])->name('participant_submit');

Route::post('/add-review', [IndexController::class, 'add_review'])->name('add-review');
// ---------------------------------------All View Form---------------------------------------


// ---------------------------------------wishlist---------------------------------------
Route::post('add/wishlist',[UserController::class, 'addToWishlist'])->name('add.to.wishlist');
Route::post('remove/wishlist',[UserController::class, 'removeFromWishlist'])->name('remove.from.wishlist');
Route::get('/wishlist', [IndexController::class, 'wishlist'])->name('wishlist');
// ---------------------------------------wishlist---------------------------------------


// ---------------------------------------ORDERS Submitting---------------------------------------
Route::get('/order-submit', [CartController::class, 'order_submit'])->name('order.submit');
Route::post('/pay-status', [CartController::class, 'paystatus'])->name('paystatus');
Route::get('stripe', [CartController::class, 'stripePost'])->name('stripe.post');
Route::post('/subscription-create', [CartController::class, 'subscription_create'])->name('subscription.create');
Route::get('/payment-success', [CartController::class, 'checkout_landing'])->name('checkout_landing');
Route::get('/payment', [CartController::class, 'paysecure'])->name('paysecure');
Route::post('/pay-status', [CartController::class, 'paystatus'])->name('paystatus');
// ---------------------------------------ORDERS Submitting---------------------------------------


// ---------------------------------------Forget Password---------------------------------------
Route::get('/forget-password', [UserController::class, 'forget_password'])->name('forget-password');
Route::post('/forget-password-post', [UserController::class, 'forget_password_submit'])->name('forget_password_submit');
Route::get('/forget-password-token/{token}', [UserController::class, 'forget_password_token'])->name('forget-password-token');
Route::post('/forget-password-reset', [UserController::class, 'forget_password_reset'])->name('forget-password-reset');
// ---------------------------------------Forget Password---------------------------------------


// ---------------------------------------OTP VERIFICATION---------------------------------------
Route::get('/verification/{user_id}', [IndexController::class, 'user_verification'])->name('user_verification');
Route::post('/otp', [UserController::class, 'otp_submit'])->name('otp-submit');

// ---------------------------------------OTP VERIFICATION---------------------------------------




// ---------------------------------------Cart---------------------------------------
Route::post('update-cart',[CartController::class,'updatecart'])->name('update-cart');
Route::get('remove-cart/{cart_id}',[CartController::class,'removecart'])->name('remove-cart');
Route::post('/save-cart', [CartController::class, 'save_cart'])->name('save-cart');
Route::post('/place-order', [CartController::class, 'placeorder'])->name('placeorder');
// ---------------------------------------Cart---------------------------------------


// ---------------------------------------Admin---------------------------------------
Route::get('/admins', function () {
  return redirect('admin/login');
})->name('admin.admin');

Route::middleware(['guest'])->prefix('admin')->namespace('Admin')->group(function () {
  Route::get('/login', [AdminLoginController::class, 'get_login'])->name('admin.login');
  Route::post('/perform-login', [AdminLoginController::class, 'performLogin'])->name('admin.performLogin');
});

Route::middleware(['admin'])->prefix('admin')->namespace('admin')->group(function () {
  Route::get('/', function () {
    return redirect('/admin/dashboard');
  });
  Route::get('/dashboard', [AdminDashController::class, 'dashboard'])->name('admin.dashboard'); 


  // ---------------------------------------Inquiries---------------------------------------
  Route::get('/inquiries-listing', [AdminDashController::class, 'inquiries_listing'])->name('admin.inquiries_listing');
  Route::get('/inquiries-listing/view/{id}', [AdminDashController::class, 'inquiries_listing_view'])->name('admin.inquiries_listing_view');
  Route::get('/inquiries-listing/delete/{id}', [AdminDashController::class, 'inquiries_listing_delete'])->name('admin.inquiries_listing_delete');
  // ---------------------------------------Inquiries---------------------------------------

// ---------------------------------------Inquiries---------------------------------------
Route::get('/quotes-listing', [AdminDashController::class, 'quotes_listing'])->name('admin.quotes_listing');
Route::get('/quotes-listing/view/{id}', [AdminDashController::class, 'quotes_listing_view'])->name('admin.quotes_listing_view');
Route::get('/quotes-listing/delete/{id}', [AdminDashController::class, 'quotes_listing_delete'])->name('admin.quotes_listing_delete');
// ---------------------------------------Inquiries---------------------------------------


  // ---------------------------------------Users---------------------------------------
  Route::get('/users-listing', [AdminDashController::class, 'users_listing'])->name('admin.users_listing');
  Route::get('/add-users', [AdminDashController::class, 'add_users'])->name('admin.add_users');
  Route::post('/create-users', [AdminDashController::class, 'create_users'])->name('admin.create_users');
  Route::get('/edit-users/{id}', [AdminDashController::class, 'edit_user'])->name('admin.edit_user');
  Route::post('/edit-users', [AdminDashController::class, 'update_user'])->name('admin.update_user');
  Route::get('/suspend-user/{id}', [AdminDashController::class, 'suspend_user'])->name('admin.suspend_user');
  Route::get('/delete-user/{id}', [AdminDashController::class, 'delete_user'])->name('admin.delete_user');
  // ---------------------------------------Users---------------------------------------

  // ---------------------------------------Logo Management---------------------------------------
  Route::get('/logo-management', [SiteSettingsController::class, 'showLogo'])->name('admin.showLogo');
  Route::post('/logo-management-save', [SiteSettingsController::class, 'saveLogo'])->name('admin.saveLogo');
  // ---------------------------------------Logo Management---------------------------------------

  // ---------------------------------------Social Management---------------------------------------
  Route::get('/contact-social-info', [SiteSettingsController::class, 'socialInfo'])->name('admin.socialInfo');
  Route::post('/contact-social-info', [SiteSettingsController::class, 'saveSocialInfo'])->name('admin.saveSocialInfo');
  // ---------------------------------------Social Management---------------------------------------

  // ---------------------------------------Testimonial Management---------------------------------------
  Route::get('/testimonial-listing', [AdminDashController::class, 'testimonial_listing'])->name('admin.testimonial_listing');
  Route::get('/add-testimonial', [AdminDashController::class, 'add_testimonial'])->name('admin.add_testimonial');
  Route::post('/create-testimonial', [AdminDashController::class, 'create_testimonial'])->name('admin.create_testimonial');
  Route::get('/edit-testimonial/{id}', [AdminDashController::class, 'edit_testimonial'])->name('admin.edit_testimonial');
  Route::post('/edit-testimonial', [AdminDashController::class, 'savetestimonial'])->name('admin.savetestimonial');
  Route::get('/suspend-testimonial/{id}', [AdminDashController::class, 'suspend_testimonial'])->name('admin.suspend_testimonial');
  Route::get('/delete-testimonial/{id}', [AdminDashController::class, 'delete_testimonial'])->name('admin.delete_testimonial');
  // ---------------------------------------Testimonial Management---------------------------------------




  // ---------------------------------------Planning Tips Management---------------------------------------
  Route::get('/planning-listing', [AdminDashController::class, 'planning_listing'])->name('admin.planning_listing');
  Route::get('/add-planning', [AdminDashController::class, 'add_planning'])->name('admin.add_planning');
  Route::post('/create-planning', [AdminDashController::class, 'create_planning'])->name('admin.create_planning');
  Route::get('/edit-planning/{id}', [AdminDashController::class, 'edit_planning'])->name('admin.edit_planning');
  Route::post('/edit-planning', [AdminDashController::class, 'save_planning'])->name('admin.saveplanning');
  Route::get('/suspend-planning/{id}', [AdminDashController::class, 'suspend_planning'])->name('admin.suspend_planning');
  Route::get('/delete-planning/{id}', [AdminDashController::class, 'delete_planning'])->name('admin.delete_planning');
  // ---------------------------------------Planning Tips Management---------------------------------------
  
  
  // ---------------------------------------Invoice Management---------------------------------------
  Route::get('/invoice-listing', [AdminDashController::class, 'invoice_listing'])->name('admin.invoice_listing');
  Route::get('/add-invoice', [AdminDashController::class, 'add_invoice'])->name('admin.add_invoice');
  Route::post('/save-invoice', [AdminDashController::class, 'save_invoice'])->name('admin.save_invoice');
  Route::get('/delete-invoice/{id}', [AdminDashController::class, 'delete_invoice'])->name('admin.delete_invoice');
  // ---------------------------------------Invoice Management---------------------------------------


  // ---------------------------------------Services Management---------------------------------------
  Route::get('/services-listing', [AdminDashController::class, 'services_listing'])->name('admin.services_listing');
  Route::get('/add-service', [AdminDashController::class, 'add_service'])->name('admin.add_service');
  Route::post('/create-service', [AdminDashController::class, 'create_service'])->name('admin.create_service');
  Route::get('/edit-service/{id}', [AdminDashController::class, 'edit_service'])->name('admin.edit_service');
  Route::post('/edit-service', [AdminDashController::class, 'saveservice'])->name('admin.saveservice');
  Route::get('/suspend-service/{id}', [AdminDashController::class, 'suspend_service'])->name('admin.suspend_service');
  Route::get('/delete-service/{id}', [AdminDashController::class, 'delete_service'])->name('admin.delete_service');
  // ---------------------------------------Services Management---------------------------------------

    // ---------------------------------------Reviews Management---------------------------------------
    Route::get('/reviews-listing', [AdminDashController::class, 'reviews_listing'])->name('admin.reviews_listing');
    Route::get('/suspend-review/{id}', [AdminDashController::class, 'suspend_review'])->name('admin.suspend_review');
    Route::get('/delete-review/{id}', [AdminDashController::class, 'delete_review'])->name('admin.delete_review');
    // ---------------------------------------Reviews Management---------------------------------------


  // ---------------------------------------Newsletter Management---------------------------------------
  Route::get('/newsletter-listing', [AdminDashController::class, 'newsletter_listing'])->name('admin.newsletter_listing');
  Route::get('/newsletter-listing/view/{id}', [AdminDashController::class, 'newsletter_listing_view'])->name('admin.newsletter_listing_view');
  Route::get('/newsletter-listing/delete/{id}', [AdminDashController::class, 'newsletter_listing_delete'])->name('admin.newsletter_listing_delete');
  // ---------------------------------------Newsletter Management---------------------------------------

  // ---------------------------------------Blogs Management---------------------------------------
  Route::get('/blog-listing', [AdminDashController::class, 'blog_listing'])->name('admin.blog_listing');
  Route::get('/add-blog', [AdminDashController::class, 'add_blog'])->name('admin.add_blog');
  Route::post('/create-blog', [AdminDashController::class, 'create_blog'])->name('admin.create_blog');
  Route::get('/edit-blog/{id}', [AdminDashController::class, 'edit_blog'])->name('admin.edit_blog');
  Route::post('/edit-blog', [AdminDashController::class, 'saveblog'])->name('admin.saveblog');
  Route::get('/suspend-blog/{id}', [AdminDashController::class, 'suspend_blog'])->name('admin.suspend_blog');
  Route::get('/delete-blog/{id}', [AdminDashController::class, 'delete_blog'])->name('admin.delete_blog');
  // ---------------------------------------Blogs Management---------------------------------------

  // ---------------------------------------Course Management---------------------------------------
  Route::get('/course-listing', [AdminDashController::class, 'course_listing'])->name('admin.course_listing');
  Route::get('/add-course', [AdminDashController::class, 'add_course'])->name('admin.add_course');
  Route::post('/create-course', [AdminDashController::class, 'create_course'])->name('admin.create_course');
  Route::get('/edit-course/{id}', [AdminDashController::class, 'edit_course'])->name('admin.edit_course');
  Route::post('/edit-course', [AdminDashController::class, 'savecourse'])->name('admin.savecourse');
  Route::get('/suspend-course/{id}', [AdminDashController::class, 'suspend_course'])->name('admin.suspend_course');
  Route::get('/delete-course/{id}', [AdminDashController::class, 'delete_course'])->name('admin.delete_course');
  Route::get('/delete-course-video/{id}', [AdminDashController::class, 'delete_course_video'])->name('admin.delete_course_video');
  // ---------------------------------------Course Management---------------------------------------

  // ---------------------------------------News Management---------------------------------------
  Route::get('/news-listing', [AdminDashController::class, 'news_listing'])->name('admin.news_listing');
  Route::get('/add-news', [AdminDashController::class, 'add_news'])->name('admin.add_news');
  Route::post('/create-news', [AdminDashController::class, 'create_news'])->name('admin.create_news');
  Route::get('/edit-news/{id}', [AdminDashController::class, 'edit_news'])->name('admin.edit_news');
  Route::post('/edit-news', [AdminDashController::class, 'savenews'])->name('admin.savenews');
  Route::get('/suspend-news/{id}', [AdminDashController::class, 'suspend_news'])->name('admin.suspend_news');
  Route::get('/delete-news/{id}', [AdminDashController::class, 'delete_news'])->name('admin.delete_news');
  // ---------------------------------------News Management---------------------------------------

  // ---------------------------------------Products Management---------------------------------------
  Route::get('/products-listing', [ShopController::class, 'products_listing'])->name('admin.products_listing');
  Route::get('/getSubcategories', [ShopController::class, 'getSubcategories'])->name('getSubcategories');
  Route::get('/add-product', [ShopController::class, 'add_products'])->name('admin.add_products');
  Route::get('/get-products', [ShopController::class, 'get_products'])->name('admin.get_products');
  Route::post('/create-product', [ShopController::class, 'create_products'])->name('admin.create_products');
  Route::get('/edit-product/{slug}', [ShopController::class, 'edit_products'])->name('admin.edit_products');
  Route::post('/edit-product', [ShopController::class, 'saveproducts'])->name('admin.saveproducts');
  Route::get('/suspend-product/{id}', [ShopController::class, 'suspend_products'])->name('admin.suspend_products');
  Route::get('/delete-product/{id}', [ShopController::class, 'delete_products'])->name('admin.delete_products');
  Route::get('/delete-other-img/{id}', [ShopController::class, 'delete_other_img'])->name('admin.delete_other_img');
  // ---------------------------------------Products Management---------------------------------------

  // ---------------------------------------Partner Management---------------------------------------
  Route::get('/partner-listing', [AdminDashController::class, 'partner_listing'])->name('admin.partner_listing');
  Route::get('/add-partner', [AdminDashController::class, 'add_partner'])->name('admin.add_partner');
  Route::post('/create-partner', [AdminDashController::class, 'create_partner'])->name('admin.create_partner');
  Route::get('/edit-partner/{id}', [AdminDashController::class, 'edit_partner'])->name('admin.edit_partner');
  Route::post('/edit-partner', [AdminDashController::class, 'savepartner'])->name('admin.savepartner');
  Route::get('/suspend-partner/{id}', [AdminDashController::class, 'suspend_partner'])->name('admin.suspend_partner');
  Route::get('/delete-partner/{id}', [AdminDashController::class, 'delete_partner'])->name('admin.delete_partner');
  // ---------------------------------------Partner Management---------------------------------------

  // ---------------------------------------category Management---------------------------------------
  Route::get('/category-listing', [AdminDashController::class, 'category_listing'])->name('admin.category_listing');
  Route::get('/add-category', [AdminDashController::class, 'add_category'])->name('admin.add_category');
  Route::post('/create-category', [AdminDashController::class, 'create_category'])->name('admin.create_category');
  Route::get('/edit-category/{id}', [AdminDashController::class, 'edit_category'])->name('admin.edit_category');
  Route::post('/edit-category', [AdminDashController::class, 'savecategory'])->name('admin.savecategory');
  Route::get('/suspend-category/{id}', [AdminDashController::class, 'suspend_category'])->name('admin.suspend_category');
  Route::get('/delete-category/{id}', [AdminDashController::class, 'delete_category'])->name('admin.delete_category');
  // ---------------------------------------category Management---------------------------------------

// ---------------------------------------Blog_category Management---------------------------------------
Route::get('/blog_category-listing', [AdminDashController::class, 'blog_category_listing'])->name('admin.blog_category_listing');
Route::get('/add-blog_category', [AdminDashController::class, 'add_blog_category'])->name('admin.add_blog_category');
Route::post('/save-blog_category', [AdminDashController::class, 'save_blog_category'])->name('admin.save_blog_category');
Route::get('/edit-blog_category/{id}', [AdminDashController::class, 'edit_blog_category'])->name('admin.edit_blog_category');
Route::post('/update-blog_category', [AdminDashController::class, 'update_blog_category'])->name('admin.update_blog_category');
Route::get('/suspend-blog_category/{id}', [AdminDashController::class, 'suspend_blog_category'])->name('admin.suspend_blog_category');
Route::get('/delete-blog_category/{id}', [AdminDashController::class, 'delete_blog_category'])->name('admin.delete_blog_category');
// ---------------------------------------Blog_category Management---------------------------------------



// ---------------------------------------Product_category Management---------------------------------------
Route::get('/product_category-listing', [AdminDashController::class, 'product_category_listing'])->name('admin.product_category_listing');
Route::get('/add-product_category', [AdminDashController::class, 'add_product_category'])->name('admin.add_product_category');
Route::post('/save-product_category', [AdminDashController::class, 'save_product_category'])->name('admin.save_product_category');
Route::get('/edit-product_category/{id}', [AdminDashController::class, 'edit_product_category'])->name('admin.edit_product_category');
Route::post('/update-product_category', [AdminDashController::class, 'update_product_category'])->name('admin.update_product_category');
Route::get('/suspend-product_category/{id}', [AdminDashController::class, 'suspend_product_category'])->name('admin.suspend_product_category');
Route::get('/delete-product_category/{id}', [AdminDashController::class, 'delete_product_category'])->name('admin.delete_product_category');
// ---------------------------------------Product_category Management---------------------------------------

  
  // ---------------------------------------Subcategory Management---------------------------------------
  Route::get('/subcategory-listing', [AdminDashController::class, 'subcategory_listing'])->name('admin.subcategory_listing');
  Route::get('/add-subcategory', [AdminDashController::class, 'add_subcategory'])->name('admin.add_subcategory');
  Route::post('/create-subcategory', [AdminDashController::class, 'create_subcategory'])->name('admin.create_subcategory');
  Route::get('/edit-subcategory/{id}', [AdminDashController::class, 'edit_subcategory'])->name('admin.edit_subcategory');
  Route::get('/edit-subcategory/{id}', [AdminDashController::class, 'edit_subcategory'])->name('admin.edit_subcategory');
  Route::post('/edit-subcategory', [AdminDashController::class, 'savesubcategory'])->name('admin.savesubcategory');
  Route::get('/suspend-subcategory/{id}', [AdminDashController::class, 'suspend_subcategory'])->name('admin.suspend_subcategory');
  Route::get('/delete-subcategory/{id}', [AdminDashController::class, 'delete_subcategory'])->name('admin.delete_subcategory');
  Route::post('/getsubcategory', [AdminDashController::class, 'getsubcategory'])->name('admin.getsubcategory');

  // ---------------------------------------brand Management---------------------------------------
  Route::get('/brand-listing', [AdminDashController::class, 'brand_listing'])->name('admin.brand_listing');
  Route::get('/add-brand', [AdminDashController::class, 'add_brand'])->name('admin.add_brand');
  Route::post('/create-brand', [AdminDashController::class, 'create_brand'])->name('admin.create_brand');
  Route::get('/edit-brand/{id}', [AdminDashController::class, 'edit_brand'])->name('admin.edit_brand');
  Route::post('/edit-brand', [AdminDashController::class, 'savebrand'])->name('admin.savebrand');
  Route::get('/suspend-brand/{id}', [AdminDashController::class, 'suspend_brand'])->name('admin.suspend_brand');
  Route::get('/delete-brand/{id}', [AdminDashController::class, 'delete_brand'])->name('admin.delete_brand');
  // ---------------------------------------brand Management---------------------------------------

  // ---------------------------------------faq Management---------------------------------------
  Route::get('/faq-listing', [AdminDashController::class, 'faq_listing'])->name('admin.faq_listing');
  Route::get('/add-faq', [AdminDashController::class, 'add_faq'])->name('admin.add_faq');
  Route::post('/create-faq', [AdminDashController::class, 'create_faq'])->name('admin.create_faq');
  Route::get('/edit-faq/{id}', [AdminDashController::class, 'edit_faq'])->name('admin.edit_faq');
  Route::post('/edit-faq', [AdminDashController::class, 'savefaq'])->name('admin.savefaq');
  Route::get('/suspend-faq/{id}', [AdminDashController::class, 'suspend_faq'])->name('admin.suspend_faq');
  Route::get('/delete-faq/{id}', [AdminDashController::class, 'delete_faq'])->name('admin.delete_faq');

  Route::get('/admin/check_slug', 'AdminDashController@Faq')->name('admin.check_slug');
  // ---------------------------------------faq Management---------------------------------------

  // ---------------------------------------banner Management---------------------------------------
  Route::get('/banner', [SiteSettingsController::class, 'homeSlider'])->name('admin.homeSlider');
  Route::get('/add-banner', [SiteSettingsController::class, 'addhomeSlider'])->name('admin.addhomeSlider');
  Route::post('/add-banner', [SiteSettingsController::class, 'createhomeSlider'])->name('admin.createhomeSlider');
  Route::get('/edit-banner/{id}', [SiteSettingsController::class, 'edithomeSlider'])->name('admin.edithomeSlider');
  Route::post('/edit-banner', [SiteSettingsController::class, 'updatehomeSlider'])->name('admin.updatehomeSlider');
  Route::get('/delete-home-slider/{id}', [SiteSettingsController::class, 'deletehomeSlider'])->name('admin.deletehomeSlider');
  Route::get('/suspend-home-slider/{id}', [SiteSettingsController::class, 'suspendhomeSlider'])->name('admin.suspendhomeSlider');
  // ---------------------------------------banner Management---------------------------------------
  
// ---------------------------------------Orders Management---------------------------------------
  Route::get('/orders', [AdminDashController::class, 'orders_listing'])->name('admin.orders_listing');
  Route::get('/view-order/{id}', [AdminDashController::class, 'view_order'])->name('admin.view_order');
  Route::get('/delete-order/{id}', [AdminDashController::class, 'delete_order'])->name('admin.delete_order');
  Route::get('/order-status-update/{id}', [AdminDashController::class, 'order_status_update'])->name('admin.order_status_update');
  // ---------------------------------------Orders Management---------------------------------------

  // ---------------------------------------welcome slider Management---------------------------------------
  Route::get('/welcome-slider', [SiteSettingsController::class, 'welcomeSlider'])->name('admin.welcomeSlider');
  Route::get('/add-welcome-slider', [SiteSettingsController::class, 'addwelcomeSlider'])->name('admin.addwelcomeSlider');
  Route::post('/add-welcome-slider', [SiteSettingsController::class, 'createwelcomeSlider'])->name('admin.createwelcomeSlider');
  Route::get('/edit-welcome-slider/{id}', [SiteSettingsController::class, 'editwelcomeSlider'])->name('admin.editwelcomeSlider');
  Route::post('/edit-welcome-slider', [SiteSettingsController::class, 'updatewelcomeSlider'])->name('admin.updatewelcomeSlider');
  Route::get('/delete-welcome-slider/{id}', [SiteSettingsController::class, 'deletewelcomeSlider'])->name('admin.deletewelcomeSlider');
  Route::get('/suspend-welcome-slider/{id}', [SiteSettingsController::class, 'suspendwelcomeSlider'])->name('admin.suspendwelcomeSlider');
  // ---------------------------------------welcome slider Management---------------------------------------
  
  // ---------------------------------------Package Management---------------------------------------
Route::get('/packages-listing', [AdminDashController::class, 'packages_listing'])->name('admin.packages_listing');
Route::get('/add-packages', [AdminDashController::class, 'add_packages'])->name('admin.add_packages');
Route::post('/save-packages', [AdminDashController::class, 'save_packages'])->name('admin.save_packages');
Route::get('/edit-packages/{id}', [AdminDashController::class, 'edit_packages'])->name('admin.edit_packages');
Route::post('/update-packages', [AdminDashController::class, 'update_packages'])->name('admin.update_packages');
Route::get('/suspend-packages/{id}', [AdminDashController::class, 'suspend_packages'])->name('admin.suspend_packages');
Route::get('/delete-packages/{id}', [AdminDashController::class, 'delete_packages'])->name('admin.delete_packages');
Route::get('/delete-package-perk/{id}', [AdminDashController::class, 'delete_package_perk'])->name('admin.delete_package_perk');
// ---------------------------------------Package Management---------------------------------------

// ---------------------------------------Template Management---------------------------------------
Route::get('/template-listing', [AdminDashController::class, 'template_listing'])->name('admin.template_listing');
Route::get('/add-template', [AdminDashController::class, 'add_template'])->name('admin.add_template');
Route::post('/save-template', [AdminDashController::class, 'save_template'])->name('admin.save_template');
Route::get('/edit-template/{id}', [AdminDashController::class, 'edit_template'])->name('admin.edit_template');
Route::post('/update-template', [AdminDashController::class, 'update_template'])->name('admin.update_template');
Route::get('/suspend-template/{id}', [AdminDashController::class, 'suspend_template'])->name('admin.suspend_template');
Route::get('/delete-template/{id}', [AdminDashController::class, 'delete_template'])->name('admin.delete_template');


// ---------------------------------------Template Management---------------------------------------


// ---------------------------------------Gallery Management---------------------------------------
Route::get('/gallery-listing', [AdminDashController::class, 'gallery_listing'])->name('admin.gallery_listing');
Route::get('/add-gallery', [AdminDashController::class, 'add_gallery'])->name('admin.add_gallery');
Route::post('/save-gallery', [AdminDashController::class, 'save_gallery'])->name('admin.save_gallery');
Route::get('/edit-gallery/{id}', [AdminDashController::class, 'edit_gallery'])->name('admin.edit_gallery');
Route::post('/update-gallery', [AdminDashController::class, 'update_gallery'])->name('admin.update_gallery');
Route::get('/suspend-gallery/{id}', [AdminDashController::class, 'suspend_gallery'])->name('admin.suspend_gallery');
Route::get('/delete-gallery/{id}', [AdminDashController::class, 'delete_gallery'])->name('admin.delete_gallery');


// ---------------------------------------Gallery Management---------------------------------------

// ---------------------------------------Party Package Management---------------------------------------
Route::get('/party-listing', [AdminDashController::class, 'party_listing'])->name('admin.party_listing');
Route::get('/add-party', [AdminDashController::class, 'add_party'])->name('admin.add_party');
Route::post('/save-party', [AdminDashController::class, 'save_party'])->name('admin.save_party');
Route::get('/edit-party/{id}', [AdminDashController::class, 'edit_party'])->name('admin.edit_party');
Route::post('/update-party', [AdminDashController::class, 'update_party'])->name('admin.update_party');
Route::get('/suspend-party/{id}', [AdminDashController::class, 'suspend_party'])->name('admin.suspend_party');
Route::get('/delete-party/{id}', [AdminDashController::class, 'delete_party'])->name('admin.delete_party');


// ---------------------------------------Party Package Management---------------------------------------


// ---------------------------------------Contest Management---------------------------------------
Route::get('/contest-listing', [AdminDashController::class, 'contest_listing'])->name('admin.contest_listing');
Route::get('/add-contest', [AdminDashController::class, 'add_contest'])->name('admin.add_contest');
Route::post('/save-contest', [AdminDashController::class, 'save_contest'])->name('admin.save_contest');
Route::get('/edit-contest/{id}', [AdminDashController::class, 'edit_contest'])->name('admin.edit_contest');
Route::post('/update-contest', [AdminDashController::class, 'update_contest'])->name('admin.update_contest');
Route::get('/suspend-contest/{id}', [AdminDashController::class, 'suspend_contest'])->name('admin.suspend_contest');
Route::get('/delete-contest/{id}', [AdminDashController::class, 'delete_contest'])->name('admin.delete_contest');
Route::get('/delete-contest/{id}', [AdminDashController::class, 'delete_contest'])->name('admin.delete_contest');




// ---------------------------------------Contest Management---------------------------------------


    // ---------------------------------------Participant---------------------------------------

    Route::get('/participant-listing', [AdminDashController::class, 'listParticipants'])->name('admin.participant_listing');
    Route::get('/add-participant', [AdminDashController::class, 'addParticipant'])->name('admin.add_participant');
    Route::post('/save-participant', [AdminDashController::class, 'saveParticipant'])->name('admin.save_participant');
    Route::get('/edit-participant/{id}', [AdminDashController::class, 'editParticipant'])->name('admin.edit_participant');
    Route::post('/update-participant', [AdminDashController::class, 'updateParticipant'])->name('admin.update_participant');
    
    Route::get('/suspend-participant/{id}', [AdminDashController::class, 'suspendParticipant'])->name('admin.suspend_participant');
    Route::get('/delete-participant/{id}', [AdminDashController::class, 'deleteParticipant'])->name('admin.delete_participant');
    Route::get('/delete-participant/{id}', [AdminDashController::class, 'deleteParticipant'])->name('admin.delete_participant');


    
    // ---------------------------------------Participant---------------------------------------


  // ---------------------------------------cms  Management---------------------------------------
  Route::get('/cms-content', [SiteSettingsController::class, 'cms'])->name('admin.cms');
  Route::get('/cms-content-edit/{id}', [SiteSettingsController::class, 'edit_cms'])->name('admin.editCms');
  Route::post('/cms-content-update', [SiteSettingsController::class, 'update_cms'])->name('admin.updateCms');


  Route::post('/statusAjaxUpdateCustom', [FrontEndEditorController::class, 'statusAjaxUpdateCustom']);
  Route::post('/statusAjaxUpdate', [FrontEndEditorController::class, 'statusAjaxUpdate']);
  Route::post('/updateFlagOnKey', [FrontEndEditorController::class, 'updateFlagOnKey']);
  Route::post('/imageUpload', [FrontEndEditorController::class, 'imageUpload']);

  // ---------------------------------------cms Management---------------------------------------

  Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

  // ---------------------------------------Admin---------------------------------------
  
  
  
});


// ---------------------------------------User Dash---------------------------------------
  Route::group(['middleware' => 'auth'], function () {

    Route::get('/sign-out', [UserController::class, 'signout'])->name('signout');
    Route::get('dashboard/password_change', [DashboardController::class, 'passwordchange'])->name('dashboard.passwordChange');
    Route::post('dashboard/update/password', [DashboardController::class, 'updatepassword'])->name('update.account.password');

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
    Route::get('dashboard/my-profile', [DashboardController::class, 'myProfile'])->name('dashboard.myProfile');
    Route::get('dashboard/edit-profile', [DashboardController::class, 'editprofile'])->name('dashboard.editProfile');
    Route::post('dashboard/edit_profile', [DashboardController::class, 'saveprofile'])->name('dashboard.submitProfile');
    Route::get('dashboard/my-orders', [DashboardController::class, 'myorders'])->name('dashboard.myBookings');
    Route::get('dashboard/my-tickets', [DashboardController::class, 'mytickets'])->name('dashboard.mytickets');
    Route::get('dashboard/add-tickets', [DashboardController::class, 'addtickets'])->name('dashboard.addtickets');
    Route::post('dashboard/add-tickets-post', [DashboardController::class, 'createtickets'])->name('dashboard.createtickets');
    Route::post('dashboard/tickets-chat-post', [DashboardController::class, 'chatmessage'])->name('dashboard.chatmessage');
    Route::get('dashboard/view-ticket/{decrypt}', [DashboardController::class, 'viewticket'])->name('dashboard.viewticket');
    Route::get('dashboard/view-orders/{decrypt}', [DashboardController::class, 'vieworders'])->name('dashboard.viewAppointment');
    Route::get('/ticket-closed/{id}', [DashboardController::class, 'ticketclosed'])->name('dashboard.ticketclosed');
    Route::get('dashboard/delete-orders/{decrypt}', [DashboardController::class, 'deleteorders'])->name('dashboard.deleteAppointment');

    Route::get('dashboard/my-membership', [DashboardController::class, 'membership'])->name('dashboard.membership');
    Route::get('dashboard/get-membership', [DashboardController::class, 'getmembership'])->name('dashboard.getmembership');
    Route::post('dashboard/create-membership', [DashboardController::class, 'createmembership'])->name('dashboard.createmembership');
    Route::get('dashboard/deactivated/{decrypt}', [DashboardController::class, 'deactivated'])->name('dashboard.deactivated');
    Route::get('dashboard/edit-membership/{decrypt}', [DashboardController::class, 'editmembership'])->name('dashboard.editmembership');
    Route::post('dashboard/update-membership', [DashboardController::class, 'updatemembership'])->name('dashboard.updatemembership');
    Route::post('dashboard/submit-membership', [DashboardController::class, 'submitmembership'])->name('dashboard.submitmembership');
    
    Route::get('dashboard/my-volet', [DashboardController::class, 'myvolet'])->name('dashboard.myvolet');
    Route::get('dashboard/my-referral', [DashboardController::class, 'myreferral'])->name('dashboard.myreferral');
    
    Route::get('/stripe-payment', [DashboardController::class, 'stripe_payment'])->name('stripe.payment');
    
    
    Route::get('dashboard/my-bookings', [DashboardController::class, 'mybookings'])->name('dashboard.bookings');
    Route::get('dashboard/view-bookings/{decrypt}', [DashboardController::class, 'viewbookings'])->name('dashboard.viewbooking');
    Route::get('dashboard/delete-bookings/{decrypt}', [DashboardController::class, 'deletebookings'])->name('dashboard.deletebooking');

    
    // ---------------------------------------Template Management---------------------------------------
    Route::get('dashboard/template-listing', [DashboardController::class, 'template_listing'])->name('dashboard.template_listing');
    Route::get('dashboard/use-template/{id}', [DashboardController::class, 'use_template'])->name('dashboard.use_template');
    Route::get('dashboard/edit-template/{id}', [DashboardController::class, 'edit_template'])->name('dashboard.edit_template');
    Route::post('dashboard/update-template', [DashboardController::class, 'update_template'])->name('dashboard.update_template');
    Route::get('dashboard/current-template', [DashboardController::class, 'current_template'])->name('dashboard.current_template');
    Route::get('dashboard/template-inquiries', [DashboardController::class, 'template_inquiries'])->name('dashboard.template_inquiries');
    Route::get('dashboard/delete-template-inquiry/{id}', [DashboardController::class, 'delete_template_inquiry'])->name('dashboard.delete_template_inquiry');
    Route::get('dashboard/view-template-inquiry/{id}', [DashboardController::class, 'view_template_inquiry'])->name('dashboard.view_template_inquiry');
    // ---------------------------------------Template Management---------------------------------------



});
// ---------------------------------------User Dash---------------------------------------
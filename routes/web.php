<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminVendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Vendor\Auth\AuthController as VendorAuthController;
use App\Http\Controllers\Admin\Product\CompanyTermController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\BlogFooterController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\VendorController;
use App\Http\Controllers\Admin\Product\VendorTermController;
use App\Http\Controllers\Admin\NavigationMenuController;
use App\Http\Controllers\Admin\Product\ProductVariantController;
use App\Http\Controllers\Admin\CommissionController;;
use App\Http\Controllers\Admin\BlogNavigationController;
use App\Http\Controllers\Admin\FeaturedItemController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogDetailController;

use App\Http\Controllers\Admin\LocationScopeController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HeroCarouselController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\QuickCardController;
use App\Http\Controllers\Admin\TrendingProductController;
use App\Http\Controllers\Admin\PopularProductController;
use App\Http\Controllers\Admin\SupportSectionController;
use App\Http\Controllers\Admin\UnitTypeController;
use App\Http\Controllers\Admin\CategoryUnitMasterController;
use App\Http\Controllers\Admin\Product\NbvTermController;
use App\Http\Controllers\Admin\Product\ProductTypeController;
use App\Http\Controllers\Admin\Product\PromoController;
use App\Http\Controllers\Admin\Product\SalesPersonController;
use App\Http\Controllers\Admin\Report\ReviewReportController;
use App\Http\Controllers\SeoManagementController;
use App\Http\Controllers\User\MerchantController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\NewsletterController;
use App\Http\Controllers\User\SpecialistRequestController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\DealsController;
use App\Http\Controllers\User\StripePaymentController;
use App\Http\Controllers\Vendor\BookingManagementController;
use App\Http\Controllers\Vendor\PaymentManagementController;
use App\Http\Controllers\Vendor\ReportManagementController;
use App\Http\Controllers\Vendor\Auth\VendorForgotPasswordController;
use App\Http\Controllers\Vendor\Auth\VendorResetPasswordController;




function showCustomError($code)
{
    $errors = [
        400 => ['Bad Request', 'The request could not be understood by the server.'],
        401 => ['Unauthorized', 'You are not authorized to view this page.'],
        403 => ['Forbidden', 'Access to this resource is denied.'],
        404 => ['Page Not Found', 'The page you’re looking for doesn’t exist or has been moved.'],
        405 => ['Method Not Allowed', 'The requested HTTP method is not allowed.'],
        417 => ['Expectation Failed', 'The server cannot meet the requirements of the Expect header.'],
        419 => ['Page Expired', 'Your session has expired. Please refresh the page.'],
        429 => ['Too Many Requests', 'You have made too many requests in a short period.'],
        
    ];

    $title = $errors[$code][0] ?? 'Error';
    $message = $errors[$code][1] ?? 'An unexpected error occurred.';

    return response()->view('user.errors.custom', [
        'code' => $code,
        'title' => $title,
        'message' => $message,
    ], $code);
}

// Routes below here
Route::get('/test-error/{code}', function ($code) {
    return showCustomError((int) $code);
});

Route::fallback(function () {
    return showCustomError(404);
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy_policy');
Route::get('/terms-and-conditions', [HomeController::class, 'termsAndConditions'])->name('terms_and_conditions');
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('subscribe');
Route::name('user.')->group(function () {
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [UserProductController::class, 'index'])->name('index');
        Route::get('/list', [UserProductController::class, 'getProducts'])->name('filter');
        Route::get('dated/{id}', [UserProductController::class, 'dated'])->name('dated');
        Route::get('/{slug}', [UserProductController::class,'show'])->name('show');
        
        Route::get('/show-review/{id}', [UserProductController::class, 'showReview'])->name('show_review');

    });
    Route::get('deals', [DealsController::class, 'index'])->name('deals.index');
    Route::get('/deals/list', [DealsController::class, 'getDeals'])->name('deals.filter');
    Route::get('/merchant', [MerchantController::class, 'merchant'])->name('merchant');
    Route::post('/merchant-store', [MerchantController::class, 'storeMerchant'])->name('merchant_store');
});

Route::post('/specialist', [SpecialistRequestController::class, 'submit'])->name('specialist.submit');
Route::get('/contactus', [ContactController::class, 'contactus'])->name('contactus');
Route::post('/contact', [ContactController::class, 'submit'])->name('contactus.submit');


// ✅ User Routes

Route::name('user.')->group(function () {

    // ✅ Publicly Accessible Routes (Available to Everyone)
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
   

    // ✅ Guest Routes (Only for Unauthenticated Users)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'login'])->name('login');
        Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'loginsubmit'])->name('login.submit');

    });

    // ✅ Authenticated Routes (Only for Logged-in Users)
    Route::middleware('auth.custom')->group(function () {
        
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('products')->name('products.')->group(function () {
            Route::post('/store-review', [UserProductController::class, 'storeReview'])->name('store_review');
            Route::post('/add-cart', [UserProductController::class, 'addCart'])->name('add_cart');
        });
        // ✅ E-commerce & Booking Routes
        // web.php
       
            Route::get('/bookingconfirmation', [HomeController::class, 'bookingconfirmation'])->name('bookingconfirmation');
            Route::get('/cart', [UserProductController::class, 'cart'])->name('cart');
            Route::delete('/cart', [UserProductController::class, 'destroy'])->name('destroy');
            Route::post('/update-cart', [UserProductController::class, 'updateCart'])->name('update_cart');
            Route::post('/proceed-checkout', [CheckoutController::class, 'proceedCheckout'])->name('proceed_checkout');
            Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
            Route::get('/stripe', [CheckoutController::class, 'stripe'])->name('stripe');
            Route::get('/item/{item}/download-pdf', [HomeController::class, 'downloadPdfItem'])
            ->name('booking.item.download');
            // routes/web.php
          
                


            Route::get('/checkout-items', [CheckoutController::class, 'getCheckoutItems'])->name('checkout-items');
            Route::post('/update-checkout', [CheckoutController::class, 'updateCheckout'])->name('update_checkout');
            Route::post('/remove-checkout-item', [CheckoutController::class, 'removeCheckoutItem']);    

            Route::post('/apply-coupon', [CheckoutController::class, 'applyCoupon'])->name('apply_coupon'); 
            Route::post('/checkout-booking', [CheckoutController::class, 'checkoutBooking'])->name('checkout_booking'); 
            
        // ✅ Profile Management Routes
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'profile'])->name('index');
            Route::post('/update', [ProfileController::class, 'update'])->name('update');
            Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('change-password');
            Route::post('/uploadPicture', [ProfileController::class, 'uploadPicture'])->name('uploadPicture');
            Route::post('/update-password', [ProfileController::class, 'updatePassword'])->name('updatepassword');
            Route::get('/bookings/{id}/download', [ProfileController::class, 'download'])->name('download');
            Route::delete('/reviews/delete/{id}', [ProfileController::class, 'deleteReview'])->name('review.delete');
            Route::put('/reviews/update/{id}', [ProfileController::class, 'updateReview'])->name('review.update');
            

        });
    });
});



Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/login', [VendorAuthController::class, 'showVendorLogin'])->name('login');
    Route::post('/login', [VendorAuthController::class, 'login'])->name('login.submit');
    
    Route::get('password/reset', [VendorForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [VendorForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('password/reset/{token}', [VendorResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset', [VendorResetPasswordController::class, 'reset'])->name('password.update');

    Route::middleware(['auth.vendor'])->group(function () {
        Route::get('booking', [BookingManagementController::class, 'index'])->name('booking');
        Route::post('approve-booking', [BookingManagementController::class, 'approveBooking'])->name('approve_booking');
        Route::get('booking-history', [BookingManagementController::class, 'bookingHistory'])->name('booking_history');
        Route::get('payment', [PaymentManagementController::class, 'index'])->name('payment');
        Route::get('report', [ReportManagementController::class, 'index'])->name('report');
        Route::get('/report/download-pdf/{id}', [ReportManagementController::class, 'reportDownload'])->name('report.download_pdf');
        Route::post('logout', [VendorAuthController::class, 'logout'])->name('logout');
    });
});


    




    

 
    
// ✅ Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Authentication
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'adminLogin'])->name('login.post');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Admin Panel Routes (Requires Admin Middleware)
    Route::middleware(['admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('index');
            Route::get('/create', [ProductController::class, 'create'])->name('create'); 
            Route::post('/', [ProductController::class, 'store'])->name('store'); 
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('edit'); 
            Route::put('/{product}', [ProductController::class, 'update'])->name('update'); 
            Route::delete('/{product}', [ProductController::class, 'destroy'])->name('destroy'); 
            Route::post('/change-status', [ProductController::class, 'changeProductStatus'])->name('status');
            Route::get('/subcategories', [ProductController::class, 'getSubcategories'])->name('subcategories');
            Route::get('/vendorterms', [ProductController::class, 'getVendorTerms'])->name('vendorterms');
            Route::resource('nbv_terms', NbvTermController::class);
            Route::post('/nbv_terms/change-status', [NbvTermController::class, 'changeTermStatus'])->name('nbv_terms.status');
            Route::resource('vendors', VendorController::class);
            Route::post('/vendors/change-status', [VendorController::class, 'changeVendorStatus'])->name('vendors.status');
            Route::resource('vendor_terms', VendorTermController::class);
            Route::post('/vendor_terms/change-status', [VendorTermController::class, 'changeVendorTermStatus'])->name('vendor_terms.status');
            Route::resource('product_variants', ProductVariantController::class);
            Route::post('/product_variants/change-status', [ProductVariantController::class, 'changeVariantStatus'])->name('product_variants.status');
            Route::get('/unit-types', [ProductVariantController::class, 'getCategoryUnitTypes'])->name('unit_types');
            Route::resource('product_types', ProductTypeController::class);
            Route::post('/product_types/change-status', [ProductTypeController::class, 'changeTypeStatus'])->name('product_types.status');
            Route::resource('promos', PromoController::class);
            Route::post('/promos/change-status', [PromoController::class, 'changePromoStatus'])->name('promos.status');
            Route::resource('sales_person', SalesPersonController::class);
            Route::post('/sales_person/change-status', [SalesPersonController::class, 'changeSalesStatus'])->name('sales_person.status');
         
        });
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::resource('reviews', ReviewReportController::class);
            Route::post('/reviews/change-status', [ReviewReportController::class, 'changeReviewStatus'])->name('reviews.status');
        });
        Route::prefix('logos')->name('logos.')->group(function () {
            Route::get('/', [LogoController::class, 'index'])->name('index');
           
            Route::get('/edit/{id}', [LogoController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [LogoController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [LogoController::class, 'destroy'])->name('destroy');
        });

        // Navigation Menu Management Routes
        Route::prefix('navigation')->name('navigation.')->group(function () {
            Route::get('/', [NavigationMenuController::class, 'index'])->name('index');
            Route::get('/create', [NavigationMenuController::class, 'create'])->name('create');
            Route::post('/', [NavigationMenuController::class, 'store'])->name('store');
            Route::get('/{navigationMenu}/edit', [NavigationMenuController::class, 'edit'])->name('edit');
            Route::put('/{navigationMenu}', [NavigationMenuController::class, 'update'])->name('update');
            Route::delete('/{navigationMenu}', [NavigationMenuController::class, 'destroy'])->name('destroy');

        });

        Route::prefix('locations')->name('locations.')->group(function () {
            Route::get('/', [LocationScopeController::class, 'index'])->name('index');
            Route::get('/create', [LocationScopeController::class, 'create'])->name('create');
            Route::post('/', [LocationScopeController::class, 'store'])->name('store');
            Route::get('/{location}/edit', [LocationScopeController::class, 'edit'])->name('edit');
            Route::put('/{location}', [LocationScopeController::class, 'update'])->name('update');
            Route::delete('/{location}', [LocationScopeController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('footer')->name('footer.')->group(function () {
           
                Route::get('/', [FooterController::class, 'index'])->name('index');
                Route::post('/store', [FooterController::class, 'store'])->name('store');
                Route::post('/update/{id}', [FooterController::class, 'update'])->name('update');
                Route::delete('/delete/{id}', [FooterController::class, 'destroy'])->name('delete');
           
            

        });

        Route::prefix('hero-carousel')->name('hero-carousel.')->group(function () {
            Route::get('/', [HeroCarouselController::class, 'index'])->name('index');
            Route::get('/create', [HeroCarouselController::class, 'create'])->name('create');
            Route::post('/store', [HeroCarouselController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [HeroCarouselController::class, 'edit'])->name('edit');
            Route::post('/update/{id}', [HeroCarouselController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [HeroCarouselController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('categories')->name('categories.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::get('/create', [CategoryController::class, 'create'])->name('create');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
            
        });

       

        Route::prefix('subcategories')->name('subcategories.')->group(function () {
            Route::get('/', [SubCategoryController::class, 'index'])->name('index');
            Route::get('/create', [SubCategoryController::class, 'create'])->name('create');
            Route::post('/', [SubCategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [SubCategoryController::class, 'edit'])->name('edit');
            Route::post('/{id}', [SubCategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [SubCategoryController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('quick')->name('quick.')->group(function () {
            Route::get('/', [QuickCardController::class, 'index'])->name('index');
            Route::get('/create', [QuickCardController::class, 'create'])->name('create');
            Route::post('/', [QuickCardController::class, 'store'])->name('store');
            Route::get('/{quickCard}/edit', [QuickCardController::class, 'edit'])->name('edit');
            Route::put('/{quickCard}', [QuickCardController::class, 'update'])->name('update');
            Route::delete('/{quickCard}', [QuickCardController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('trending')->name('trending.')->group(function () {
            Route::get('/', [TrendingProductController::class, 'index'])->name('index');
            Route::get('/create', [TrendingProductController::class, 'create'])->name('create');
            Route::post('/', [TrendingProductController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [TrendingProductController::class, 'edit'])->name('edit');
            Route::put('/{id}', [TrendingProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [TrendingProductController::class, 'destroy'])->name('destroy');
        });
        Route::prefix('popular')->name('popular.')->group(function () {
            Route::get('/', [PopularProductController::class, 'index'])->name('index');
            Route::get('/create', [PopularProductController::class, 'create'])->name('create');
            Route::post('/', [PopularProductController::class, 'store'])->name('store');
            Route::get('/edit', [PopularProductController::class, 'edit'])->name('edit');
            Route::put('/update', [PopularProductController::class, 'update'])->name('update');
            Route::delete('/{id}', [PopularProductController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('support')->name('support.')->group(function () {
            Route::get('/', [SupportSectionController::class, 'index'])->name('index');
            Route::get('/create', [SupportSectionController::class, 'create'])->name('create');
            Route::post('/', [SupportSectionController::class, 'store'])->name('store');
            Route::get('/edit', [SupportSectionController::class, 'edit'])->name('edit');
            Route::put('/update', [SupportSectionController::class, 'update'])->name('update');
            Route::delete('/{id}', [SupportSectionController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('unit_types')->name('unit_types.')->group(function () {
        Route::get('/', [UnitTypeController::class, 'index'])->name('index'); 
        Route::get('/create', [UnitTypeController::class, 'create'])->name('create'); 
        Route::post('/', [UnitTypeController::class, 'store'])->name('store'); 
        Route::get('/{unitType}/edit', [UnitTypeController::class, 'edit'])->name('edit'); 
        Route::put('/{unitType}', [UnitTypeController::class, 'update'])->name('update'); 
        Route::delete('/{unitType}', [UnitTypeController::class, 'destroy'])->name('destroy'); 
        
       });
 
       Route::prefix('category_unit')->name('category_unit.')->group(function () {
        Route::get('/', [CategoryUnitMasterController::class, 'index'])->name('index'); 
        Route::get('/create', [CategoryUnitMasterController::class, 'create'])->name('create'); 
        Route::post('/', [CategoryUnitMasterController::class, 'store'])->name('store'); 
        Route::get('/{categoryUnitMaster}/edit', [CategoryUnitMasterController::class, 'edit'])->name('edit'); 
        Route::put('/{categoryUnitMaster}', [CategoryUnitMasterController::class, 'update'])->name('update'); 
        Route::delete('/{categoryUnitMaster}', [CategoryUnitMasterController::class, 'destroy'])->name('destroy'); 
    });
      
    Route::prefix('commission')->name('commission.')->group(function () {
        Route::get('/', [CommissionController::class, 'commission'])->name('commission');
        Route::get('/export-commissions',  [CommissionController::class, 'exportCommission'])->name('export');
       });
    Route::resource('seo', SeoManagementController::class);

    Route::resource('users', AdminUserController::class);

        Route::prefix('vendors')->name('vendors.')->group(function () {
            Route::get('/', [AdminVendorController::class, 'index'])->name('index');
            Route::get('/{id}/edit', [AdminVendorController::class, 'edit'])->name('edit'); 
            Route::put('/{id}', [AdminVendorController::class, 'update'])->name('update'); 
        });
    });

     Route::prefix('blog')->name('blog.')->group(function () {

        // Navigation Routes
    

        Route::prefix('blognavigation')->name('blognavigation.')->group(function () {
        Route::get('/', [BlogNavigationController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [BlogNavigationController::class, 'edit'])->name('edit');

        Route::post('/', [BlogNavigationController::class, 'store'])->name('store');
        Route::put('/{id}', [BlogNavigationController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogNavigationController::class, 'destroy'])->name('destroy');
     });

        // Featured Items Routes
        Route::prefix('featured-items')->name('featured-items.')->group(function () {
            Route::get('/', [FeaturedItemController::class, 'index'])->name('index');       
            Route::get('/create', [FeaturedItemController::class, 'create'])->name('create');
            Route::post('/', [FeaturedItemController::class, 'store'])->name('store'); 
            Route::get('/{featured_item}/edit', [FeaturedItemController::class,'edit'])->name('edit'); 
            Route::post('/{featured_item}', [FeaturedItemController::class, 'update'])->name('update');  
            Route::delete('/{featured_item}', [FeaturedItemController::class, 'destroy'])->name('destroy'); 
        });

        Route::prefix('blogs')->name('blogs.')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('index');
            Route::get('/create', [BlogController::class, 'create'])->name('create');
            Route::post('/', [BlogController::class, 'store'])->name('store');
            Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
            Route::put('/{blog}', [BlogController::class, 'update'])->name('update');
            Route::delete('/{blog}', [BlogController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('blog-details')->name('blog-details.')->group(function () {
            Route::get('/', [BlogDetailController::class, 'index'])->name('index');
            Route::get('/create', [BlogDetailController::class, 'create'])->name('create');
            Route::post('/', [BlogDetailController::class, 'store'])->name('store');
            Route::get('/{blog_detail}/edit', [BlogDetailController::class, 'edit'])->name('edit');
            Route::put('/{blog_detail}', [BlogDetailController::class, 'update'])->name('update');
            Route::delete('/{blog_detail}', [BlogDetailController::class, 'destroy'])->name('destroy');
        });

            Route::prefix('footer')->name('footer.')->group(function () {
        Route::get('/', [BlogFooterController::class, 'index'])->name('index');
        Route::get('/create', [BlogFooterController::class, 'create'])->name('create');
        Route::post('/', [BlogFooterController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BlogFooterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BlogFooterController::class, 'update'])->name('update');
        Route::delete('/{id}', [BlogFooterController::class, 'destroy'])->name('destroy');
    });

    
    });

    


});

 Route::prefix('vendor')->group(function () {
    // Only redirect specific paths that don't exist in your vendor routes
    Route::get('{any}', function ($any) {
        // Check if this is actually a 404 case for vendor routes
        $validVendorRoutes = ['login', 'booking', 'payment', 'report']; // Add your valid routes
        
        if (!in_array(explode('/', $any)[0], $validVendorRoutes)) {
            return redirect()->away("https://vendor.nearbyvouchers.com/{$any}");
        }
        
        abort(404); // Let Laravel handle the 404 normally
    })->where('any', '.*');
});



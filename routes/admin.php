<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\CustomPaymentController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\VisaFlagController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SnippetController;
use App\Http\Controllers\Admin\RedirectController;




Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {

     Route::post('/verify-password', function (Illuminate\Http\Request $request) {
        $superAdmin = \App\Models\Admin::role('Super Admin')->first();
            if (!$superAdmin) {
                return response()->json([
                    'success' => false,
                    'message' => 'Super Admin not found'
                ], 404);
            }
            if (!\Illuminate\Support\Facades\Hash::check($request->password, $superAdmin->password)) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Password is incorrect'
                ], 401);
            }

            return response()->json(['success' => true]);
        })->name('verify-admin-password');

        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('/pages', \App\Http\Controllers\Admin\PageController::class);

        Route::get('/pages/{id}/seo', [\App\Http\Controllers\Admin\PageController::class, 'seo']);
        Route::post('/pages/{id}/seo', [\App\Http\Controllers\Admin\PageController::class, 'seoStore']);
        // Blog Categories SEO routes
        Route::get('blog-categories/{id}/seo', [BlogCategoryController::class, 'seo'])->name('blog-categories.seo.get');
        Route::post('blog-categories/{id}/seo', [BlogCategoryController::class, 'seoStore'])->name('blog-categories.seo.save');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/faqs', FaqController::class)->except('show');
        Route::resource('/blogs', BlogController::class)->except('show');
        Route::resource('/blog-categories', BlogCategoryController::class);
        Route::resource('/flags', VisaFlagController::class);
        Route::resource('/users', AdminController::class);
        Route::resource('/roles', RoleController::class);
        Route::resource('/redirector', RedirectController::class);
        Route::resource('/snippets', SnippetController::class);
        Route::resource('/inquiries', InquiryController::class)->except('store');
        Route::get('roles/{role}/permissions', [RoleController::class, 'getPermissions'])->name('roles.permissions.get');
        Route::post('roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');
        Route::resource('/coupons', CouponController::class);
        Route::get('/booking/detail/{booking}', [BookingController::class, 'formDetail'])->name('booking.detail');
        Route::resource('/bookings', BookingController::class);
        Route::post('/admin/booking/approve', [BookingController::class, 'approve'])->name('booking.approve');
        Route::resource('/reviews', ReviewController::class)->except(['show', 'store']);
        Route::post('/reviews/status/{id}', [ReviewController::class, 'approve'])->name('reviews.approve');
        Route::post('/upload/image', [DashboardController::class, 'uploadImage'])->name('upload.image');

        Route::get('/profile', [AdminController::class, 'profile'])->name('profile.show');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::get('/custom-payments', [CustomPaymentController::class, 'index'])->name('custom.payments.index');
       

        Route::delete('delete-media/{media}', [GalleryController::class, 'deleteMedia'])->name('delete.media');
        Route::prefix('media-library')->name('media.')->group(function () {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::get('/{media}', [GalleryController::class, 'show'])->name('show');
            Route::post('/store', [GalleryController::class, 'store'])->name('store');
            Route::post('/upload', [GalleryController::class, 'upload'])->name('upload');
            Route::put('/{media}', [GalleryController::class, 'update'])->name('update');
            Route::delete('/{media}', [GalleryController::class, 'destroy'])->name('destroy');
        });


        Route::prefix('faqs')->name('faqs.')->group(function () {
            Route::get('/categories', [FaqCategoryController::class, 'index'])->name('categories.index');
            Route::post('/category', [FaqCategoryController::class, 'store'])->name('category.store');
            Route::put('/category/{id}', [FaqCategoryController::class, 'update'])->name('category.update');
            Route::delete('/category/{id}', [FaqCategoryController::class, 'destroy'])->name('category.destroy');
        });

        Route::post('redirects/upload', [RedirectController::class,'importCsv'])->name('redirect.store');
    });
});

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });
});

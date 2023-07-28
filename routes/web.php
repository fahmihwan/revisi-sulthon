<?php

use App\Http\Controllers\CMS\AuthAdminController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\ItemController;
use App\Http\Controllers\CMS\ListCustomerController;
use App\Http\Controllers\CMS\master_item\KategoriController;
use App\Http\Controllers\CMS\master_item\UkuranController;
use App\Http\Controllers\CMS\ReportController;
use App\Http\Controllers\CMS\TransactionController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\Toko\AlamatController;
use App\Http\Controllers\Toko\AuthUserController;
use App\Http\Controllers\Toko\Cart_WishlistController;
use App\Http\Controllers\Toko\CheckoutController;
use App\Http\Controllers\Toko\CustomerController;
use App\Http\Controllers\Toko\LandingpageController;
use App\Http\Controllers\Toko\RajaOngkirController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// // verify email
Route::middleware(['auth:web'])->group(function () {
    Route::get('/email/verify', [AuthUserController::class, 'verification_notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [AuthUserController::class, 'verification_handler'])->middleware(['signed'])->name('verification.verify');
    Route::post('/email/verification-notification', [AuthUserController::class, 'resend_verification'])->middleware(['throttle:6,1'])->name('verification.send');
    Route::post('/customer/account/logout', [AuthUserController::class, 'logout']);
});

// user
Route::middleware(['guest:web', 'preventBack'])->group(function () {
    Route::get('/customer/account/create', [AuthUserController::class, 'register']);
    Route::post('/customer/account/store', [AuthUserController::class, 'store_account']);
    Route::post('/customer/account/authenticate', [AuthUserController::class, 'authenticate']);
    Route::get('/customer/account/login', [AuthUserController::class, 'register_or_login']);

    Route::get('/customer/account/forgotpassword', [AuthUserController::class, 'forgot_password'])->name('password.request');
    Route::post('/customer/account/forgotpassword', [AuthUserController::class, 'send_forgot_password_email'])->name('password.email');
    Route::get('/customer/account/reset-password/{token}', [AuthUserController::class, 'reset_password'])->name('password.reset');
    Route::post('/customer/account/reset-password', [AuthUserController::class, 'update_password'])->name('password.update');
});

Route::middleware(['auth:web', 'verified', 'preventBack'])->group(function () {
    Route::get('/customer/account', [CustomerController::class, 'account']);
    Route::get('/customer/order-history', [CustomerController::class, 'pesanan']);
    Route::get('/customer/order-history/{id}/detail-pesanan', [CustomerController::class, 'lihat_detail_pesanan']);
    Route::post('/customer/oerder-history/{id}/pesan_ulang', [CustomerController::class, 'pesan_ulang']);
    Route::get('/customer/wish-list', [CustomerController::class, 'wish_list']);
    Route::get('/customer/address', [CustomerController::class, 'address']);
    Route::get('/customer/address/create', [CustomerController::class, 'create_address']);
    Route::delete('/customer/address/{id}/delete', [AlamatController::class, 'delete']);
    Route::get('/customer/address/{id}/edit', [AlamatController::class, 'edit']);
    Route::put('/customer/address/{id}/update', [AlamatController::class, 'update']);

    Route::get('/customer/account/edit', [CustomerController::class, 'informasi_account']);
    Route::post('/customer/account/update', [AuthUserController::class, 'update_account']);

    Route::post('/list-item/cart/{id}', [Cart_WishlistController::class, 'store_cart']);
    Route::delete('/list-item/cart/{id}/destroy', [Cart_WishlistController::class, 'destroy_cart']);
    Route::post('/list-item/wish_list/{id}', [Cart_WishlistController::class, 'store_wishlist']);
    Route::delete('/list-item/wish_list/{id}/destroy', [Cart_WishlistController::class, 'destroy_wish_list']);
    // checkout
    Route::get('/checkout/pengiriman', [CheckoutController::class, 'pengiriman']);
    Route::put('/checkout/pengiriman/{id_alamat}/set_alamat_primary', [CheckoutController::class, 'set_alamat_primary_customer']);
    Route::get('/checkout/alamat-pengiriman/province', [RajaOngkirController::class, 'get_province']);
    Route::get('/checkout/alamat-pengiriman/province/{id}/city', [RajaOngkirController::class, 'get_city']);
    Route::get('/checkout/alamat-pengiriman/province/{city_id}/city/{province_id}', [RajaOngkirController::class, 'get_postal_code']);
    Route::get('/checkout/alamat-pengiriman/{courier}/cost', [RajaOngkirController::class, 'get_cost']);
    Route::post('/checkout/store-session-from-ajax', [RajaOngkirController::class, 'retireve_sessoin_service']);

    Route::get('/checkout/cart', [CheckoutController::class, 'keranjang']);
    Route::put('/checkout/cart/{id}/ajax', [Cart_WishlistController::class, 'update_cart_ajax']);
    Route::get('/checkout/cart/{id}/edit-cart', [Cart_WishlistController::class, 'edit_cart']);

    // alaamt
    Route::post('/alamat', [AlamatController::class, 'store']);
    Route::get('/checkout/pembayaran', [CheckoutController::class, 'pembayaran']);
    Route::post('/checkout/pembayaran/pay', [CheckoutController::class, 'pay']);

    // print 
    Route::get('/customer/order-history/detail/{id}/print', [PdfController::class, 'print_pesanan_user']);
});

Route::get('/', [LandingpageController::class, 'landing_page'])->name('user.login');
Route::get('/list-item', [LandingpageController::class, 'list_item'])->name('list_item');
Route::post('/list-item-ajax', [LandingpageController::class, 'ajax_list_items']);
Route::get('/list-item/{id}/detail-item', [LandingpageController::class, 'detail_item']);
Route::post('/list-item/detail-item-stok-ajax', [LandingpageController::class, 'detail_item_stok_ajax']);

// admin
Route::middleware(['guest:webadmin', 'preventBack'])->group(function () {
    Route::get('/admin/auth/dashboard/login', [AuthAdminController::class, 'login'])->name('admin.login');
    Route::post('/admin/auth/dashboard/authenticate', [AuthAdminController::class, 'authenticate']);
});

// Halaman Dashboard
Route::middleware(['auth:webadmin'])->group(function () {
    Route::post('/admin/auth/dashboard/logout', [AuthAdminController::class, 'logout']);

    // dashboard master
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // master - KATEGORI
    Route::controller(KategoriController::class)->group(function () {
        Route::get('/admin/master-item/kategori', 'index')->middleware('hak_akses_dashboard:karyawan,owner');
        Route::post('/admin/master-item/kategori', 'store')->middleware('hak_akses_dashboard:karyawan');
        Route::get('/admin/master-item/kategori/{id}/edit', 'edit')->middleware('hak_akses_dashboard:karyawan');
        Route::put('/admin/master-item/kategori/{id}', 'update')->middleware('hak_akses_dashboard:karyawan');
        Route::delete('/admin/master-item/kategori/{id}', 'destroy')->middleware('hak_akses_dashboard:karyawan');
    });

    // master - UKURAN
    Route::controller(UkuranController::class)->group(function () {
        Route::get('/admin/master-item/ukuran', 'index')->middleware('hak_akses_dashboard:karyawan,owner');
        Route::post('/admin/master-item/ukuran', 'store')->middleware('hak_akses_dashboard:karyawan');
        Route::get('/admin/master-item/ukuran/{id}/edit', 'edit')->middleware('hak_akses_dashboard:karyawan');
        Route::put('/admin/master-item/ukuran/{id}', 'update')->middleware('hak_akses_dashboard:karyawan');
        Route::delete('/admin/master-item/ukuran/{id}', 'destroy')->middleware('hak_akses_dashboard:karyawan');
    });

    // item (CUSTOME ROUTES IN RESOURCE CONTROLLER)
    Route::controller(ItemController::class)->group(function () {
        Route::get('/admin/item', 'index')->middleware('hak_akses_dashboard:karyawan,owner');
        Route::post('/admin/item', 'store')->middleware('hak_akses_dashboard:karyawan,owner');
        Route::get('/admin/item/create', 'create')->middleware('hak_akses_dashboard:karyawan');
        Route::get('/admin/item/{id}/show', 'show')->middleware('hak_akses_dashboard:karyawan,owner');
        Route::get('/admin/item/{id}/edit', 'edit')->middleware('hak_akses_dashboard:karyawan');
        Route::put('/admin/item/{id}', 'update')->middleware('hak_akses_dashboard:karyawan');
        Route::delete('/admin/item/{id}', 'destroy')->middleware('hak_akses_dashboard:karyawan');
    });
    Route::middleware(['hak_akses_dashboard:karyawan'])->group(function () {
        Route::get('/admin/item/{id}/tambah-stok', [ItemController::class, 'tambah_stok_item']);
        Route::post('/admin/item/{id}/store-stok-item', [ItemController::class, 'store_stok_item']);
        Route::post('/admin/item/{id}/store-list-item', [ItemController::class, 'store_list_item']);
        Route::delete('/admin/item/{item}/{id}/hapus_list_ukuran', [ItemController::class, 'detroy_list_ukuran']);
    });

    // transaction
    Route::middleware(['hak_akses_dashboard:karyawan,owner'])->group(function () {
        Route::get("/admin/list-transaction", [TransactionController::class, 'index']);
        Route::get("/admin/list-transaction/{id}/detail", [TransactionController::class, 'detail_pembelian']);
        Route::put('/admin/list-transaction/{id}/konfirmasi', [TransactionController::class, 'konfirmasi_pembelian']);
    });


    //list customer
    Route::get('/admin/list-customer', [ListCustomerController::class, 'index']);
    Route::get('/admin/list-customer/{id}', [ListCustomerController::class, 'show']);
    Route::put('/admin/list-customer/{id}', [ListCustomerController::class, 'update']);

    // laporan  
    Route::middleware(['hak_akses_dashboard:owner'])->group(function () {
        Route::get('/admin/laporan/confirmed', [ReportController::class, 'confirmed']);
        Route::get('/admin/laporan/rejected', [ReportController::class, 'rejected']);
        Route::get('/admin/report-transaction/{id}/detail', [ReportController::class, 'detail']);
    });

    // print pdf 
    Route::middleware(['hak_akses_dashboard:owner'])->group(function () {
        Route::post('/admin/laporan-confirmed/print', [PdfController::class, 'print_admin_laporan_confirmed']);
        Route::post('/admin/laporan-rejected/print', [PdfController::class, 'print_admin_laporan_rejected']);
    });
});

// demo
Route::get('demo-admin', [AuthAdminController::class, 'demo']);
Route::resource('/admin/auth', AuthAdminController::class);

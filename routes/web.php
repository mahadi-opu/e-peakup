<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\HomeController;

// Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CountryController as AdminCountryController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PaymentmethodController as AdminPaymentmethodController;
use App\Http\Controllers\Admin\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\Admin\OfferController as AdminOfferController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\AdminController as AdminAdminController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\NoticeController as AdminNoticeController;
use App\Http\Controllers\Admin\IssueController as AdminIssueController;
use App\Http\Controllers\Admin\SubscribeController as AdminSubscribeController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\MailController as AdminMailController;
use App\Http\Controllers\Admin\SettingsController as AdminSettingsController;
use App\Http\Controllers\Admin\GlobalpaymentsController as AdminGlobalpaymentsController;

// Api's
use App\Http\Controllers\Frontend\ApiController as FrontendApiController;

// Frontend
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\SendController as FrontendSendController;
use App\Http\Controllers\Frontend\RecipientController as FrontendRecipientController;
use App\Http\Controllers\Frontend\PaymentController as FrontendPaymentController;
use App\Http\Controllers\Frontend\IssueController as FrontendIssueController;
use App\Http\Controllers\Frontend\SubscribeController as FrontendSubscribeController;

// Userpanel
use App\Http\Controllers\Userpanel\DashboardController as UserpanelDashboardController;
use App\Http\Controllers\Userpanel\ProfileController as UserpanelProfileController;
use App\Http\Controllers\Userpanel\TransactionController as UserpanelTransactionController;
use App\Http\Controllers\Userpanel\RecipientController as UserpanelRecipientController;
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

// Test routes
Route::get('go', function() {

    dd(session()->all());
});

Route::get('clear', function() {
    Artisan::call('optimize:clear');
    return redirect('/');
})->name('optimize');

Route::get('seed', function () {
    $tables = DB::select('show tables');
    if ($tables) return 'Tables already exists.';
    Artisan::call('db:seed');

    return 'Database seeding completed.';
});

Route::get('wipe', function () {
    $tables = DB::select('show tables');
    if (!$tables) return 'There are no tables in the database';
    Artisan::call('db:wipe');

    return 'Dropped all the tables.';
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

// Free routes
Route::get('admin/login', function() {
    return view('auth/admin_login');
});
Route::get('/', [FrontendHomeController::class, 'index'])->name('frontend_index');
Route::get('how-it-works', [FrontendHomeController::class, 'howItWorks'])->name('frontend_how_it_works');
Route::get('help', [FrontendHomeController::class, 'help'])->name('frontend_help');
Route::get('about-us', [FrontendHomeController::class, 'aboutUs'])->name('frontend_about_us');
Route::get('terms', [FrontendHomeController::class, 'terms'])->name('frontend_terms');
Route::post('issue/store', [FrontendIssueController::class, 'store'])->name('frontend_issue_store');
Route::post('subscribe', [FrontendSubscribeController::class, 'subscribe'])->name('frontend_subscribe');

// Api routes
Route::group(['prefix' => 'api'], function() {
    Route::get('payment-methods', [FrontendApiController::class, 'paymentMethods'])->name('frontend_api_payment_methods');
});

Auth::routes(['verify' => true]);

// Authenticated and Verified routes
Route::group(['middleware' => ['auth', 'verified']], function() {

    // Role Routes
    Route::group(['prefix' => 'admin', 'middleware' => 'role'], function() {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin_dashboard_index');
        
        Route::post('setting/store', [AdminSettingController::class, 'store'])->name('admin_setting_store');

        Route::group(['prefix' => 'orders'], function() {
            Route::get('/', [AdminOrderController::class, 'index'])->name('admin_order_index');
            Route::post('done', [AdminOrderController::class, 'done'])->name('admin_order_done');
            Route::post('mail-send/{id}', [AdminOrderController::class, 'mailSend'])->name('admin_order_mail_send');
        });

        Route::get('admin/profile', [AdminProfileController::class, 'index'])->name('admin_profile_index');
        Route::post('admin/profile/update', [AdminProfileController::class, 'update'])->name('admin_profile_update');
    });

    // Admin Routes
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
        Route::post('change-password', [HomeController::class, 'changePassword'])->name('admin_password_change');

        Route::group(['prefix' => 'users'], function() {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin_users_index');
            Route::post('/send-mail/{id}', [AdminUserController::class, 'sendMail'])->name('admin_users_send_mail');
            Route::delete('/delete/{id}', [AdminUserController::class, 'destroy'])->name('admin_users_destroy');
        });

        Route::group(['prefix' => 'settings'], function() {
            Route::get('/', [AdminSettingsController::class, 'index'])->name('admin_settings_index');
            Route::post('update', [AdminSettingsController::class, 'update'])->name('admin_settings_update');
        });

        Route::group(['prefix' => 'countries'], function() {
            Route::get('/', [AdminCountryController::class, 'index'])->name('admin_country_index');
            Route::post('store', [AdminCountryController::class, 'store'])->name('admin_country_store');
            Route::put('update/{id}', [AdminCountryController::class, 'update'])->name('admin_country_update');
            Route::delete('delete/{id}', [AdminCountryController::class, 'destroy'])->name('admin_country_delete');
        });

        Route::group(['prefix' => 'services'], function() {
            Route::get('/', [AdminServiceController::class, 'index'])->name('admin_service_index');
            Route::post('store', [AdminServiceController::class, 'store'])->name('admin_service_store');
            Route::put('update/{id}', [AdminServiceController::class, 'update'])->name('admin_service_update');
            Route::delete('delete/{id}', [AdminServiceController::class, 'destroy'])->name('admin_service_delete');
        });

        Route::group(['prefix' => 'payment-methods'], function() {
            Route::get('/', [AdminPaymentmethodController::class, 'index'])->name('admin_payment_method_index');
            Route::post('store', [AdminPaymentmethodController::class, 'store'])->name('admin_payment_method_store');
            Route::put('update/{id}', [AdminPaymentmethodController::class, 'update'])->name('admin_payment_method_update');
            Route::delete('delete/{id}', [AdminPaymentmethodController::class, 'destroy'])->name('admin_payment_method_delete');
        });

        Route::group(['prefix' => 'currencies'], function() {
            Route::get('/', [AdminCurrencyController::class, 'index'])->name('admin_currency_index');
            Route::post('store', [AdminCurrencyController::class, 'store'])->name('admin_currency_store');
            Route::put('update/{id}', [AdminCurrencyController::class, 'update'])->name('admin_currency_update');
            Route::delete('delete/{id}', [AdminCurrencyController::class, 'destroy'])->name('admin_currency_delete');
        });

        Route::group(['prefix' => 'offers'], function() {
            Route::get('/', [AdminOfferController::class, 'index'])->name('admin_offer_index');
            Route::post('store', [AdminOfferController::class, 'store'])->name('admin_offer_store');
            Route::put('update/{id}', [AdminOfferController::class, 'update'])->name('admin_offer_update');
            Route::delete('delete/{id}', [AdminOfferController::class, 'destroy'])->name('admin_offer_delete');
        });

        Route::get('live-chat', [AdminChatController::class, 'index'])->name('admin_live_chat');

        Route::group(['prefix' => 'admins'], function() {
            Route::get('/', [AdminAdminController::class, 'index'])->name('admin_admin_index');
            Route::post('store', [AdminAdminController::class, 'store'])->name('admin_admin_store');
            Route::put('update/{id}', [AdminAdminController::class, 'update'])->name('admin_admin_update');
            Route::delete('delete/{id}', [AdminAdminController::class, 'destroy'])->name('admin_admin_delete');
        });

        Route::group(['prefix' => 'roles'], function() {
            Route::get('/', [AdminRoleController::class, 'index'])->name('admin_role_index');
            Route::post('store', [AdminRoleController::class, 'store'])->name('admin_role_store');
            Route::put('update/{id}', [AdminRoleController::class, 'update'])->name('admin_role_update');
            Route::delete('delete/{id}', [AdminRoleController::class, 'destroy'])->name('admin_role_delete');
        });

        Route::group(['prefix' => 'sliders'], function() {
            Route::get('/', [AdminNoticeController::class, 'index'])->name('admin_notice_index');
            Route::post('store', [AdminNoticeController::class, 'store'])->name('admin_notice_store');
            Route::put('update/{id}', [AdminNoticeController::class, 'update'])->name('admin_notice_update');
            Route::delete('delete/{id}', [AdminNoticeController::class, 'destroy'])->name('admin_notice_delete');
        });

        Route::group(['prefix' => 'global-payments'], function() {
            Route::get('/', [AdminGlobalpaymentsController::class, 'index'])->name('admin_global_payments_index');
            Route::post('store', [AdminGlobalpaymentsController::class, 'store'])->name('admin_global_payments_store');
            Route::put('update/{id}', [AdminGlobalpaymentsController::class, 'update'])->name('admin_global_payments_update');
            Route::delete('delete/{id}', [AdminGlobalpaymentsController::class, 'destroy'])->name('admin_global_payments_delete');
        });

        Route::group(['prefix' => 'mails'], function() {
            Route::get('/', [AdminMailController::class, 'index'])->name('admin_mail_index');
            Route::post('store', [AdminMailController::class, 'store'])->name('admin_mail_store');
            Route::put('update/{id}', [AdminMailController::class, 'update'])->name('admin_mail_update');
            Route::delete('delete/{id}', [AdminMailController::class, 'destroy'])->name('admin_mail_delete');
        });

        Route::group(['prefix' => 'issues'], function() {
            Route::get('/', [AdminIssueController::class, 'index'])->name('admin_issue_index');
        });

        Route::group(['prefix' => 'subscribes'], function() {
            Route::get('/', [AdminSubscribeController::class, 'index'])->name('admin_subscribe_index');
        });
    });

    // Auth Routes for Customers
    Route::get('send', [FrontendHomeController::class, 'send'])->name('frontend_send');
    Route::post('send/post', [FrontendHomeController::class, 'sendPost'])->name('frontend_send_post');

    Route::group(['prefix' => 'recipient'], function() {
        Route::get('add', [FrontendRecipientController::class, 'add'])->name('frontend_recipient_add');
        Route::post('save', [FrontendRecipientController::class, 'save'])->name('frontend_recipient_save');
        Route::get('preview', [FrontendRecipientController::class, 'preview'])->name('frontend_recipient_preview');
    });

    Route::group(['prefix' => 'payment'], function() {
        Route::get('/', [FrontendPaymentController::class, 'index'])->name('frontend_payment_index');
        Route::post('store', [FrontendPaymentController::class, 'store'])->name('frontend_payment_store');
        Route::get('checkout/poli', [FrontendPaymentController::class, 'checkoutPoli'])->name('frontend_payment_checkout_poli');
        Route::get('checkout/paypal', [FrontendPaymentController::class, 'checkoutPaypal'])->name('frontend_payment_checkout_paypal');
        Route::get('checkout/success/{method}', [FrontendPaymentController::class, 'success'])->name('frontend_payment_success');
        Route::get('checkout/cancel', [FrontendPaymentController::class, 'cancel'])->name('frontend_payment_cancel');
    });

    Route::group(['prefix' => 'dashboard'], function() {
        Route::get('/', [UserpanelDashboardController::class, 'index'])->name('userpanel_dashboard_index');
    });

    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', [UserpanelProfileController::class, 'index'])->name('userpanel_profile_index');
        Route::post('update', [UserpanelProfileController::class, 'update'])->name('userpanel_profile_update');
        Route::post('password/update', [UserpanelProfileController::class, 'passwordUpdate'])->name('userpanel_profile_password_update');
        Route::post('profile-thumb', [UserpanelProfileController::class, 'profileThumb'])->name('userpanel_profile_thumb');
    });

    Route::group(['prefix' => 'transactions'], function() {
        Route::get('/', [UserpanelTransactionController::class, 'index'])->name('userpanel_transaction_index');
    });

    Route::group(['prefix' => 'recipients'], function() {
        Route::get('/', [UserpanelRecipientController::class, 'index'])->name('userpanel_recipient_index');
    });

});
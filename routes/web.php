<?php

use App\Http\Controllers\AamarpayController;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\StoreAnalytic;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductCategorieController;
use App\Http\Controllers\ProductTaxController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PageOptionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ProductCouponController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayfastController;
use App\Http\Controllers\LandingPageSectionsController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\PaymentWallPaymentController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\Customer\Auth\CustomerLoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ExpresscheckoutController;
use App\Http\Controllers\IyziPayController;
use App\Http\Controllers\SspayController;
use App\Http\Controllers\AiTemplateController;
use App\Http\Controllers\BenefitPaymentController;
use App\Http\Controllers\CashfreeController;
use App\Http\Controllers\PaytabController;
use App\Http\Controllers\WebhookController;
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

require __DIR__ . '/auth.php';



Route::get('/login/{lang?}', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::get('/register/{lang?}', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::get('/password/resets/{lang?}', [AuthenticatedSessionController::class, 'showLinkRequestForm'])->name('change.langPass');

Route::get('/', [DashboardController::class, 'index'])->middleware('XSS')->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('XSS', 'auth')->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::resource('stores', StoreController::class);
    Route::post('store-setting/{id}', [StoreController::class, 'savestoresetting'])->name('settings.store');
});

Route::middleware(['auth', 'XSS'])->group(function () {
    Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->name('change.language')->middleware(['auth', 'XSS']);
    Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->name('manage.language')->middleware(['auth', 'XSS']);
    Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->name('store.language.data')->middleware(['auth', 'XSS']);
    Route::post('disable-language',[LanguageController::class,'disableLang'])->name('disablelanguage')->middleware(['auth','XSS']);
    Route::get('create-language', [LanguageController::class, 'createLanguage'])->name('create.language')->middleware(['auth', 'XSS']);
    Route::post('store-language', [LanguageController::class, 'storeLanguage'])->name('store.language')->middleware(['auth', 'XSS']);
    Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->name('lang.destroy')->middleware(['auth', 'XSS']);
});

Route::middleware(['auth', 'XSS'])->group(function () {
    Route::get('store-grid/grid', [StoreController::class, 'grid'])->name('store.grid');
    Route::get('store-customDomain/customDomain', [StoreController::class, 'customDomain'])->name('store.customDomain');
    Route::get('store-subDomain/subDomain', [StoreController::class, 'subDomain'])->name('store.subDomain');
    Route::get('store-plan/{id}/plan', [StoreController::class, 'upgradePlan'])->name('plan.upgrade');
    Route::get('store-plan-active/{id}/plan/{pid}', [StoreController::class, 'activePlan'])->name('plan.active');
    Route::DELETE('store-delete/{id}', [StoreController::class, 'storedestroy'])->name('user.destroy');
    Route::DELETE('ownerstore-delete/{id}', [StoreController::class, 'ownerstoredestroy'])->name('ownerstore.destroy');
    Route::get('store-edit/{id}', [StoreController::class, 'storedit'])->name('user.edit');
    Route::Put('store-update/{id}', [StoreController::class, 'storeupdate'])->name('user.update');
});

Route::get('plan_request', [PlanRequestController::class, 'index'])->name('plan_request.index')->middleware(['auth', 'XSS']);
Route::get('request_frequency/{id}', [PlanRequestController::class, 'requestView'])->name('request.view')->middleware(['auth', 'XSS']);
Route::get('request_send/{id}', [PlanRequestController::class, 'userRequest'])->name('send.request')->middleware(['auth', 'XSS']);
Route::get('request_response/{id}/{response}', [PlanRequestController::class, 'acceptRequest'])->name('response.request')->middleware(['auth', 'XSS']);
Route::get('request_cancel/{id}', [PlanRequestController::class, 'cancelRequest'])->name('request.cancel')->middleware(['auth', 'XSS']);

Route::get('/store-change/{id}', [StoreController::class, 'changeCurrantStore'])->name('change_store')->middleware(['auth', 'XSS']);

Route::get('/change/mode', [DashboardController::class, 'changeMode'])->name('change.mode');
Route::get('profile', [DashboardController::class, 'profile'])->name('profile')->middleware(['auth', 'XSS']);

Route::put('change-password', [DashboardController::class, 'updatePassword'])->name('update.password');
Route::put('edit-profile', [DashboardController::class, 'editprofile'])->name('update.account')->middleware(['auth', 'XSS']);
Route::get('storeanalytic', [StoreAnalytic::class, 'index'])->name('storeanalytic')->middleware(['auth', 'XSS']);

Route::middleware(['auth', 'XSS'])->group(function () {

    Route::post('business-setting', [SettingController::class, 'saveBusinessSettings'])->name('business.setting');
    Route::post('company-setting', [SettingController::class, 'saveCompanySettings'])->name('company.setting');
    Route::post('email-setting', [SettingController::class, 'saveEmailSettings'])->name('email.setting');
    Route::post('system-setting', [SettingController::class, 'saveSystemSettings'])->name('system.setting');
    Route::post('pusher-setting', [SettingController::class, 'savePusherSettings'])->name('pusher.setting');


    Route::post('test-mail', [SettingController::class, 'testMail'])->name('test.mail')->middleware(['auth', 'XSS']);
    Route::get('test-mail', [SettingController::class, 'testMail'])->name('test.mail')->middleware(['auth', 'XSS']);
    Route::post('test-mail/send', [SettingController::class, 'testSendMail'])->name('test.send.mail')->middleware(['auth', 'XSS']);

    Route::get('settings', [SettingController::class, 'index'])->name('settings');
    Route::post('payment-setting', [SettingController::class, 'savePaymentSettings'])->name('payment.setting');
    Route::post('owner-payment-setting/{slug?}', [SettingController::class, 'saveOwnerPaymentSettings'])->name('owner.payment.setting');
    Route::post('owner-email-setting/{slug?}', [SettingController::class, 'saveOwneremailSettings'])->name('owner.email.setting');
    Route::post('owner-twilio-setting/{slug?}', [SettingController::class, 'saveOwnertwilioSettings'])->name('owner.twilio.setting');
    Route::get('pixels', [SettingController::class, 'index'])->name('pixel.index');
    Route::get('pixel/create', [SettingController::class, 'pixel_create'])->name('pixel.create');
    Route::post('pixel', [SettingController::class, 'pixel_store'])->name('pixel.store');
    Route::delete('pixel-delete/{id}', [SettingController::class, 'pixeldestroy'])->name('pixel.destroy');
});

Route::get('/config-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Clear Cache successfully.');
});

Route::post('cookie-setting', [SettingController::class, 'saveCookieSettings'])->name('cookie.setting');
Route::any('/cookie-consent', [SettingController::class, 'CookieConsent'])->name('cookie-consent');

Route::middleware(['auth', 'XSS'])->group(function () {

    Route::resource('product_categorie', ProductCategorieController::class);
});

Route::middleware(['auth', 'XSS'])->group(function () {

    Route::resource('product_tax', ProductTaxController::class);
});

Route::middleware(['auth', 'XSS'])->group(function () {

    Route::resource('shipping', ShippingController::class);
});

Route::resource('location', LocationController::class)->middleware('auth', 'XSS');
// Route::resource('page_options', PageOptionController::class)->middleware('auth', 'XSS');
// Route::resource('blog', BlogController::class)->middleware('auth', 'XSS');

// Route::get('blog-social', [BlogController::class, 'socialBlog'])->middleware('XSS', 'auth')->name('blog.social');
// Route::post('store-social-blog', [BlogController::class, 'storeSocialblog'])->middleware('XSS', 'auth')->name('store.socialblog');

Route::resource('webhook', WebhookController::class)->middleware(['auth', 'XSS',]);

Route::get('/plans', [PlanController::class, 'index'])->middleware('XSS', 'auth')->name('plans.index');

Route::get('/plans/create', [PlanController::class, 'create'])->middleware('XSS', 'auth')->name('plans.create');

Route::post('/plans', [PlanController::class, 'store'])->middleware('XSS', 'auth')->name('plans.store');

Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->middleware('XSS', 'auth')->name('plans.edit');

Route::put('/plans/{id}', [PlanController::class, 'update'])->middleware('XSS', 'auth')->name('plans.update');

Route::post('/user-plans/', [PlanController::class, 'userPlan'])->middleware('XSS', 'auth')->name('update.user.plan');

Route::get('themes', [themeController::class, 'index'])->name('themes.theme')->middleware(['auth', 'XSS']);

Route::post('pwa-settings/{id}', [StoreController::class, 'pwasetting'])->name('setting.pwa')->middleware(['auth', 'XSS']);

Route::resource('orders', OrderController::class)->middleware(['auth', 'XSS']);
Route::get('order-receipt/{id}', [OrderController::class, 'receipt'])->middleware('XSS', 'auth')->name('order.receipt');
Route::delete('oreder/product/{id}/{variant_id?}/{order_id}/{key}', [OrderController::class, 'delete_order_item'])->name('delete.order_item');

Route::middleware(['auth', 'XSS'])->group(function () {
    Route::get('/product-variants/create', [ProductController::class, 'productVariantsCreate'])->name('product.variants.create');
    Route::get('/product-variants/edit/{product_id}', [ProductController::class, 'productVariantsEdit'])->name('product.variants.edit');
    Route::post('/product-variants-possibilities/{product_id}', [ProductController::class, 'getProductVariantsPossibilities'])->name('product.variants.possibilities');
    Route::get('/get-product-variants-possibilities', [ProductController::class, 'getProductVariantsPossibilities'])->name('get.product.variants.possibilities');
    Route::get('product/grid', [ProductController::class, 'grid'])->name('product.grid');
    Route::delete('product/{id}/delete', [ProductController::class, 'fileDelete'])->name('products.file.delete');
    Route::delete('product/variant/{id}/{product_id}', [ProductController::class, 'VariantDelete'])->name('products.variant.delete');
});

Route::resource('product', ProductController::class)->middleware(['auth', 'XSS']);
Route::post('product/{id}/update', [ProductController::class, 'productUpdate'])->middleware('auth')->name('products.update');
Route::get('get-products-variant-quantity', [ProductController::class, 'getProductsVariantQuantity'])->name('get.products.variant.quantity');
Route::get('/store-resource/edit/display/{id}', [StoreController::class, 'storeenable'])->middleware('XSS', 'auth')->name('store-resource.edit.display');
Route::put('/store-resource/display/{id}', [StoreController::class, 'storeenableupdate'])->middleware('XSS', 'auth')->name('store-resource.display');

Route::middleware(['auth', 'XSS'])->group(function () {

    Route::resource('store-resource', StoreController::class);
});

Route::get('store/remove-session/{slug}', [StoreController::class, 'removeSession'])->name('remove.session');

Route::get('store/{slug?}/{view?}', [StoreController::class, 'storeSlug'])->name('store.slug');
Route::get('store-variant/{slug?}/product/{id}', [StoreController::class, 'storeVariant'])->name('store-variant.variant');
Route::post('user-product_qty/{slug?}/product/{id}/{variant_id?}', [StoreController::class, 'productqty'])->name('user-product_qty.product_qty');
Route::post('user-location/{slug}/location/{id}', [StoreController::class, 'UserLocation'])->name('user.location');
Route::post('user-shipping/{slug}/shipping/{id}', [StoreController::class, 'UserShipping'])->name('user.shipping');
Route::delete('delete_cart_item/{slug?}/product/{id}/{variant_id?}', [StoreController::class, 'delete_cart_item'])->name('delete.cart_item');


Route::get('store/{slug?}/product/{id}', [StoreController::class, 'productView'])->name('store.product.product_view');
Route::get('store-complete/{slug?}/{id}', [StoreController::class, 'complete'])->name('store-complete.complete');

Route::middleware(['XSS'])->group(function () {

    Route::get('order', [StripePaymentController::class, 'index'])->name('order.index');
    Route::get('/stripe/{code}', [StripePaymentController::class, 'stripe'])->name('stripe');
    Route::post('/stripe/{slug?}', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
    Route::post('stripe-payment', [StripePaymentController::class, 'addpayment'])->name('stripe.payment');
});

////////////////////
Route::post('pay-with-paypal/{slug?}', [PaypalController::class, 'PayWithPaypal'])->middleware('XSS')->name('pay.with.paypal');

Route::get('{id}/get-payment-status{slug?}', [PaypalController::class, 'GetPaymentStatus'])->middleware('XSS')->name('get.payment.status');



Route::get('{slug?}/order/{id}', [StoreController::class, 'userorder'])->name('user.order');

Route::post('{slug?}/whatsapp', [StoreController::class, 'whatsapp'])->name('user.whatsapp');
Route::post('{slug?}/telegram', [StoreController::class, 'telegram'])->name('user.telegram');

Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->middleware('XSS', 'auth')->name('apply.coupon');

Route::get('/apply-productcoupon', [ProductCouponController::class, 'applyProductCoupon'])->name('apply.productcoupon');

Route::resource('coupons', CouponController::class)->middleware('auth', 'XSS');

Route::post('prepare-payment', [PlanController::class, 'preparePayment'])->middleware('XSS', 'auth')->name('prepare.payment');

Route::post('/payment/{code}', [PlanController::class, 'payment'])->middleware('XSS', 'auth')->name('payment');

Route::post('plan-pay-with-paypal', [PaypalController::class, 'planPayWithPaypal'])->middleware('XSS', 'auth')->name('plan.pay.with.paypal');

Route::get('{id}/{amount}/get-store-payment-status', [PaypalController::class, 'storeGetPaymentStatus'])->middleware('XSS', 'auth')->name('get.store.payment.status');

Route::get(
    'qr-code',
    function () {
        return QrCode::generate();
    }
);

Route::get('change-language-store/{slug?}/{lang}', [LanguageController::class, 'changeLanquageStore'])->middleware('XSS')->name('change.languagestore');

Route::resource('product-coupon', ProductCouponController::class)->middleware(['auth', 'XSS']);

Route::post('store-product', [StoreController::class, 'filterproductview'])->name('filter.product.view');
Route::post('store/{slug?}', [StoreController::class, 'changeTheme'])->name('store.changetheme');


// Plan Purchase Payments methods
Route::get('plan/prepare-amount', [PlanController::class, 'planPrepareAmount'])->name('plan.prepare.amount');
Route::get('paystack-plan/{code}/{plan_id}', [PaymentController::class, 'paystackPlanGetPayment'])->middleware('auth')->name('paystack.plan.callback');
Route::get('flutterwave-plan/{code}/{plan_id}', [PaymentController::class, 'flutterwavePlanGetPayment'])->middleware('auth')->name('flutterwave.plan.callback');
Route::get('razorpay-plan/{code}/{plan_id}', [PaymentController::class, 'razorpayPlanGetPayment'])->middleware('auth')->name('razorpay.plan.callback');
Route::post('mercadopago-prepare-plan', [PaymentController::class, 'mercadopagoPaymentPrepare'])->middleware('auth')->name('mercadopago.prepare.plan');
Route::any('plan-mercado-callback/{plan_id}', [PaymentController::class, 'mercadopagoPaymentCallback'])->middleware('auth')->name('plan.mercado.callback');

Route::post('paytm-prepare-plan', [PaymentController::class, 'paytmPaymentPrepare'])->middleware('auth')->name('paytm.prepare.plan');
Route::post('paytm-payment-plan', [PaymentController::class, 'paytmPlanGetPayment'])->middleware('auth')->name('plan.paytm.callback');

Route::post('mollie-prepare-plan', [PaymentController::class, 'molliePaymentPrepare'])->middleware('auth')->name('mollie.prepare.plan');
Route::get('mollie-payment-plan/{slug}/{plan_id}', [PaymentController::class, 'molliePlanGetPayment'])->middleware('auth')->name('plan.mollie.callback');

Route::post('coingate-prepare-plan', [PaymentController::class, 'coingatePaymentPrepare'])->middleware('auth')->name('coingate.prepare.plan');
Route::get('coingate-payment-plan', [PaymentController::class, 'coingatePlanGetPayment'])->middleware('auth')->name('coingate.mollie.callback');

Route::post('skrill-prepare-plan', [PaymentController::class, 'skrillPaymentPrepare'])->middleware('auth')->name('skrill.prepare.plan');
Route::get('skrill-payment-plan', [PaymentController::class, 'skrillPlanGetPayment'])->middleware('auth')->name('plan.skrill.callback');


//================================= Custom Landing Page ====================================//
// Route::get('/landingpage', [LandingPageSectionsController::class, 'index'])->middleware('auth', 'XSS')->name('custom_landing_page.index');

// Route::get('/LandingPage/show/{id}', [LandingPageSectionsController::class, 'show']);
// Route::post('/LandingPage/setConetent', [LandingPageSectionsController::class, 'setConetent'])->middleware('auth', 'XSS');

Route::get(
    '/get_landing_page_section/{name}',
    function ($name) {
        $plans = DB::table('plans')->get();
        return view('custom_landing_page.' . $name, compact('plans'));
    }
);

// Route::post('/LandingPage/removeSection/{id}', [LandingPageSectionsController::class, 'removeSection'])->middleware('auth', 'XSS');

// Route::post('/LandingPage/setOrder', [LandingPageSectionsController::class, 'setOrder'])->middleware('auth', 'XSS');

// Route::post('/LandingPage/copySection', [LandingPageSectionsController::class, 'copySection'])->middleware('auth', 'XSS');


//================================= Custom Massage Page ====================================//
Route::post('/store/custom-msg/{slug}', [StoreController::class, 'customMassage'])->name('customMassage');
Route::post('store/get-massage/{slug}', [StoreController::class, 'getWhatsappUrl'])->name('get.whatsappurl');

Route::post('store/{slug}/downloadable_prodcut', [StoreController::class, 'downloadable_prodcut'])->name('user.downloadable_prodcut');


// Email Templates
Route::get('email_template_lang/{lang?}', [EmailTemplateController::class, 'emailTemplate'])->name('email_template')->middleware('auth', 'XSS');
Route::get('email_template_lang/{id}/{lang?}', [EmailTemplateController::class, 'manageEmailLang'])->name('manage.email.language')->middleware('auth', 'XSS');
Route::put('email_template_lang/{id}/', [EmailTemplateController::class, 'updateEmailSettings'])->name('updateEmail.settings')->middleware('auth');
Route::put('email_template_store/{pid}', [EmailTemplateController::class, 'storeEmailLang'])->name('store.email.language')->middleware('auth', 'XSS');
Route::put('email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('status.email.language')->middleware('auth', 'XSS');
Route::put('email_template_status/{id}', [EmailTemplateController::class, 'updateStatus'])->name('email_template.update')->middleware('auth', 'XSS');

//--------------------------------------------------------Import/Export Data Route--------------------------------------------------
Route::get('{id}/export/product', [ProductController::class, 'export'])->name('product.export');
Route::get('{id}/export/order', [OrderController::class, 'export'])->name('order.export');
Route::get('export/shipping', [ShippingController::class, 'export'])->name('shipping.export');
Route::get('export/category', [ProductCategorieController::class, 'export'])->name('category.export');
Route::get('export/tax', [ProductTaxController::class, 'export'])->name('tax.export');
Route::get('export/customer', [StoreController::class, 'exports'])->name('customer.export');
Route::get('import/coupon/file', [ProductCouponController::class, 'importFile'])->name('coupon.file.import');
Route::post('import/coupon', [ProductCouponController::class, 'import'])->name('coupon.import');
Route::get('export/coupon', [ProductCouponController::class, 'export'])->name('coupon.export');

/*=================================Customer Login==========================================*/
////////////////////
Route::get('{slug}/customer-login', [CustomerLoginController::class, 'showLoginForm'])->name('customer.loginform');
Route::post('{slug}/customer-login/{cart?}', [CustomerLoginController::class, 'login'])->name('customer.login');

Route::get('{slug}/user-create', [StoreController::class, 'userCreate'])->name('store.usercreate');
Route::post('{slug}/user-create', [StoreController::class, 'userStore'])->name('store.userstore');

Route::get('{slug}/customer-home', [StoreController::class, 'customerHome'])->name('customer.home')->middleware('customerauth');

Route::get('{slug}/customer-profile/{id}', [CustomerLoginController::class, 'profile'])->name('customer.profile')->middleware('customerauth');
// Route::get('{slug}/customer-profile/{id}', [CustomerLoginController::class, 'profile'])->name('customer.profile')->middleware('customerauth');
Route::put('{slug}/customer-profile/{id}', [CustomerLoginController::class, 'profileUpdate'])->name('customer.profile.update')->middleware('customerauth');
Route::put('{slug}/customer-profile-password/{id}', [CustomerLoginController::class, 'updatePassword'])->name('customer.profile.password')->middleware('customerauth');
Route::post('{slug}/customer-logout', [CustomerLoginController::class, 'logout'])->name('customer.logout');

/*=================== Payments ===================================================================*/
Route::get('store-payment/{slug?}/userpayment', [StoreController::class, 'userPayment'])->name('store-payment.payment');
Route::get('store-payment/userpayment/stripe', [StripePaymentController::class, 'getProductStatus'])->name('store.payment.stripe');
Route::get('{id}/get-payment-status{slug?}', [PaypalController::class, 'GetPaymentStatus'])->name('get.payment.status')->middleware('XSS');

//    Payments Callbacks

Route::post('{slug?}/cod', [StoreController::class, 'cod'])->name('user.cod');
Route::post('{slug?}/bank_transfer', [StoreController::class, 'bank_transfer'])->name('user.bank_transfer');

Route::get('paystack/{slug}/{code}/{order_id}', [PaymentController::class, 'paystackPayment'])->name('paystack');
Route::get('flutterwave/{slug}/{tran_id}/{order_id}', [PaymentController::class, 'flutterwavePayment'])->name('flutterwave');
Route::get('razorpay/{slug}/{pay_id}/{order_id}', [PaymentController::class, 'razerpayPayment'])->name('razorpay');
Route::post('{slug}/paytm/prepare-payments/', [PaymentController::class, 'paytmOrder'])->name('paytm.prepare.payments');
Route::post('paytm/callback/', [PaymentController::class, 'paytmCallback'])->name('paytm.callback');
Route::post('{slug}/mollie/prepare-payments/', [PaymentController::class, 'mollieOrder'])->name('mollie.prepare.payments');
Route::get('{slug}/{order_id}/mollie/callback/', [PaymentController::class, 'mollieCallback'])->name('mollie.callback');
Route::post('{slug}/mercadopago/prepare-payments/', [PaymentController::class, 'mercadopagoPayment'])->name('mercadopago.prepare');
Route::any('{slug}/mercadopago/callback/', [PaymentController::class, 'mercadopagoCallback'])->name('mercado.callback');

Route::post('{slug}/coingate/prepare-payments/', [PaymentController::class, 'coingatePayment'])->name('coingate.prepare');
Route::get('coingate/callback', [PaymentController::class, 'coingateCallback'])->name('coingate.callback');

Route::post('{slug}/skrill/prepare-payments/', [PaymentController::class, 'skrillPayment'])->name('skrill.prepare.payments');
Route::get('skrill/callback', [PaymentController::class, 'skrillCallback'])->name('skrill.callback');
Route::get('{slug}/skrill/cancelled', [PaymentController::class, 'paymentCancelled'])->name('skrill.cancelled');

Route::get('{slug}/skrill/cancelled', [PaymentController::class, 'paymentCancelled'])->name('payment.cancelled');

Route::post('{slug}/paystack/store-slug/', [StoreController::class, 'storesession'])->name('paystack.session.store');

Route::get('product/import/export', [ProductController::class, 'fileImportExport'])->name('product.file.import');
Route::post('product/import', [ProductController::class, 'fileImport'])->name('product.import');

/*==================================Recaptcha====================================================*/
Route::post('/recaptcha-settings', [SettingController::class, 'recaptchaSettingStore'])->name('recaptcha.settings.store')->middleware('auth', 'XSS');

/*==============================================================================================================================*/
Route::any('user-reset-password/{id}', [StoreController::class, 'userPassword'])->name('user.reset');
Route::post('user-reset-password/{id}', [StoreController::class, 'userPasswordReset'])->name('user.password.update');

/*================================================================================================================================*/
Route::post('paymentwall', [PaymentWallPaymentController::class, 'index'])->name('paymentwall');
Route::post('plan-pay-with-paymentwall/{plan}', [PaymentWallPaymentController::class, 'planPayWithPaymentwall'])->name('plan.pay.with.paymentwall');
Route::any('/plan/error/{flag}', [PaymentWallPaymentController::class, 'paymenterror'])->name('callback.error');

Route::post('{slug}/paymentwall/store-slug/', [StoreController::class, 'paymentwallstoresession'])->name('paymentwall.session.store');
Route::any('{slug}/paymentwall/order/', [PaymentWallPaymentController::class, 'orderindex'])->name('paymentwall.index');
Route::post('{slug}/order-pay-with-paymentwall/', [PaymentWallPaymentController::class, 'orderPayWithPaymentwall'])->name('order.pay.with.paymentwall');
Route::any('{slug}/order/error/{flag}', [PaymentWallPaymentController::class, 'orderpaymenterror'])->name('order.callback.error');

/*========================================================================================================================*/
Route::get('store/product/{order_id}/{customer_id}/{slug}', [StoreController::class, 'orderview'])->name('store.product.product_order_view');

// ===================================customer view==========================================
Route::get('/customer', [StoreController::class, 'customerindex'])->name('customer.index')->middleware('XSS');
Route::get('/customer/view/{id}', [StoreController::class, 'customershow'])->name('customer.show')->middleware('XSS');

Route::post('storage-settings', [SettingController::class, 'storageSettingStore'])->name('storage.setting.store')->middleware('auth', 'XSS');

Route::post('{slug}/payfast', [PayfastController::class, 'Paywithpayfast'])->name('payfast');

Route::get('payfast/{success}/{slug}', [PayfastController::class, 'payfastsuccess'])->name('payfast.success');

// iyzipay
Route::post('iyzipay/prepare-payments/{slug}', [IyziPayController::class, 'iyzipaypayment'])->name('iyzipay.prepare.payment');
Route::post('iyzipay/callback/{slug}/{price}', [IyzipayController::class, 'iyzipaypaymentCallback'])->name('iyzipay.callback');

// sspay
Route::post('{slug}/sspay/prepare-payments/', [SspayController::class, 'Sspaypayment'])->name('sspay.prepare.payments');
Route::get('sspay/callback/{get_amount}/{slug?}', [SspayController::class, 'Sspaycallpack'])->name('sspay.callback');

// Toyyibpay
Route::post('{slug}/toyyibpay/prepare-payments/', [ToyyibpayController::class, 'toyyibpaypayment'])->name('toyyibpay.prepare.payments');
Route::get('toyyibpay/callback/{get_amount}/{slug?}', [ToyyibpayController::class, 'toyyibpaycallpack'])->name('toyyibpay.callback');

// Paytab
Route::post('pay-with-paytab/{slug}', [PaytabController::class, 'PayWithpaytab'])->name('pay.with.paytab');
Route::any('paytab-success/store', [PaytabController::class, 'PaytabGetPaymentCallback'])->name('paytab.success');

// CashFree
Route::post('{slug}/cashfree/payments/store', [CashfreeController::class, 'payWithCashfree'])->name('store.cashfree.initiate');
Route::any('store/cashfree/payments/success/payment/success', [CashfreeController::class, 'storeCashfreePaymentSuccess'])->name('store.cashfreePayment.success');

// Benefit
Route::any('{slug}/payment/initiate', [BenefitPaymentController::class, 'storeInitiatePayment'])->name('store.benefit.initiate');
Route::any('/store/call_back/cancelled', [BenefitPaymentController::class, 'storeCall_back'])->name('store.benefit.call_back');

// AamarPay
Route::post('{slug}/aamarpay/payment', [AamarpayController::class, 'payWithAamarpay'])->name('store.pay.aamarpay.payment');
Route::any('aamarpay/success/store/{data}', [AamarpayController::class, 'storeAamarpaysuccess'])->name('store.pay.aamarpay.success');

Route::resource('roles', RoleController::class)->middleware(['auth', 'XSS']);
Route::resource('users', UserController::class)->middleware(['auth', 'XSS']);
Route::get('users/reset/{id}', [UserController::class, 'reset'])->name('users.reset')->middleware(['auth', 'XSS']);
Route::post('users/reset/{id}', [UserController::class, 'updatePassword'])->name('users.resetpassword')->middleware(['auth', 'XSS']);
Route::resource('permissions', PermissionController::class)->middleware(['auth', 'XSS',]);

Route::get('store/{slug?}/{product_id?}/{quantity?}/{variant_id?}', [StoreController::class, 'StoreCart'])->name('store.cart');
Route::any('add-to-cart/store/{slug?}/{product_id?}/{quantity?}/{variant_id?}', [StoreController::class, 'addToCart'])->name('user.addToCart');
// Route::any('add-to-cart/{slug?}/cart/{product_id?}/{quantity?}/{variant_id?}', [StoreController::class, 'addToCart'])->name('user.addToCart');
// Route::get('user-cart-item/{slug?}/cart/{product_id?}/{quantity?}/{variant_id?}', [StoreController::class, 'StoreCart'])->name('store.cart');

Route::get('/create-expresscheckout/{product_id?}', [ExpresscheckoutController::class, 'create'])->name('expresscheckout.create');
Route::post('/store-expresscheckout/{product_id?}', [ExpresscheckoutController::class, 'store'])->name('expresscheckout.store');
Route::get('/edit-expresscheckout/{product_id?}', [ExpresscheckoutController::class, 'edit'])->name('expresscheckout.edit');
Route::post('/update-expresscheckout/{product_id?}', [ExpresscheckoutController::class, 'update'])->name('expresscheckout.update');
Route::delete('/delete-expresscheckout/{product_id?}', [ExpresscheckoutController::class, 'destroy'])->name('expresscheckout.destroy');


Route::post('chatgptkey', [SettingController::class, 'chatgptkey'])->name('settings.chatgptkey');
Route::get('generate/{template_name}', [AiTemplateController::class, 'create'])->name('generate');
Route::post('generate/keywords/{id}', [AiTemplateController::class, 'getKeywords'])->name('generate.keywords');
Route::post('generate/response', [AiTemplateController::class, 'AiGenerate'])->name('generate.response');

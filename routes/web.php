<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\WebController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\admin\DocumentRepositoryController;
use App\Http\Controllers\admin\ContactUsController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\NewsLetterController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\ClientContactController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\AgentController;
use App\Http\Controllers\admin\AboutUsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\HomeSliderController;
use App\Http\Controllers\admin\EventController;
use App\Http\Controllers\admin\PageController;
use App\Http\Controllers\admin\PageSettingController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\FAQController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\admin\TrainerController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\admin\BlogCategoryController;
use App\Http\Controllers\admin\BlogController;

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



Route::get('/route-clear', function () {
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    $cache = 'Route cache cleared <br /> View cache cleared <br /> Cache cleared <br /> Config cleared <br /> Config cache cleared';
    return $cache;
});

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');

Route::get('sign-up', [WebController::class, 'SignUp'])->name('sign-up');
Route::post('user/store', [WebController::class, 'storeUser'])->name('user.register.store');

Route::get('email-verification/{token}', [WebController::class, 'verifyEmail'])->name('email-verification');

//admin reset password
Route::get('admin/forgot_password', [AdminController::class, 'forgotPassword'])->name('admin.forgot_password');
Route::get('admin/send-password-reset-link', [AdminController::class, 'passwordResetLink'])->name('admin.send-password-reset-link');
Route::get('admin/reset-password/{token}', [AdminController::class, 'resetPassword'])->name('admin.reset-password');
Route::post('admin/change_password', [AdminController::class, 'changePassword'])->name('admin.change_password');


// User forgot password
Route::get('forgot-password', [WebController::class, 'forgotPassword'])->name('forgot-password');
Route::post('forgot-password', [WebController::class, 'passwordResetLink'])->name('password.reset-link');

// User reset password (from email)
Route::get('reset-password/{verify_token}', [WebController::class, 'resetPassword'])->name('reset-password');
Route::post('reset-password', [WebController::class, 'changePassword'])->name('password.change');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Route::get('/admin/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
Route::post('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
Route::post('admin/logout', [AdminController::class, 'logOut'])->name('admin.logout');

Route::post('user/authenticate', [UserController::class, 'authenticate'])->name('user.authenticate');
Route::post('/user/profile/update', [UserController::class, 'userUpdateProfile'])->name('user.profile.update');
Route::get('/member/profile/edit', [UserController::class, 'MemberEditProfile'])->name('member.profile.edit');
Route::post('user/logout', [UserController::class, 'logOut'])->name('user.logout');

//Frontend
Route::get('/', [WebController::class, 'index'])->name('index');
Route::get('get_states', [WebController::class, 'getStates'])->name('get_states');
Route::get('get_cities', [TrainerController::class, 'get_cities'])->name('get_cities');
Route::post('appointment', [WebController::class, 'appointment'])->name('appointment');
Route::get('about-us', [WebController::class, 'AboutUs'])->name('about-us');
Route::get('benefits', [WebController::class, 'Benefits'])->name('benefits');
Route::get('blogs', [WebController::class, 'Blogs'])->name('blogs');

Route::get('registration', [WebController::class, 'Registration'])->name('registration');
Route::get('events', [WebController::class, 'Events'])->name('events');
Route::get('careers', [WebController::class, 'Careers'])->name('careers');
/* Route::get('how-it-works', [WebController::class, 'HowItWorks'])->name('how-it-works'); */
Route::get('leaderboard', [WebController::class, 'LeaderBoard'])->name('leaderboard');
Route::get('gallery', [WebController::class, 'Gallery'])->name('gallery');
Route::get('contact-us', [WebController::class, 'ContactUs'])->name('contact-us');
Route::post('book-session', [WebController::class, 'BookSession'])->name('book-session');
Route::get('faqs', [WebController::class, 'Faqs'])->name('faqs');
Route::get('our-services', [WebController::class, 'Services'])->name('our-services');
Route::get('service-details/{slug}', [WebController::class, 'ServiceDetails'])->name('service_details');
Route::get('privacy-policy', [WebController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('term-and-conditions', [WebController::class, 'termAndConditions'])->name('term-and-conditions');
Route::get('reviews', [WebController::class, 'Reviews'])->name('reviews');

Route::get('trainers', [WebController::class, 'Trainers'])->name('trainers');
Route::get('trainer-details/{id}', [WebController::class, 'TrainerDetail'])->name('trainer.detail');

//stripe payment
Route::get('stripe/create', [StripeController::class, 'create'])->name('stripe.create');
Route::get('stripe/checkout/{id}', [StripeController::class, 'checkout'])->name('stripe.checkout');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('product/search', [ProductController::class, 'search'])->name('product.search');

//NewsLetter
Route::resource('newsletter', NewsLetterController::class);

//Contact
Route::resource('contact', ContactController::class);

//Client Contact
Route::resource('client_contact', ClientContactController::class);

//ContactUs
Route::resource('contactus', ContactUsController::class);
/* Route::group(['middleware' => 'auth'], function () {
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
    Route::get('/payment/success', [AppointmentController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/cancel', [AppointmentController::class, 'paymentCancel'])->name('payment.cancel');
}); */

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/payment/success/{appointment_id}', [AppointmentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel/{appointment_id}', [AppointmentController::class, 'paymentCancel'])->name('payment.cancel');
Route::get('/appointments/google-calendar-callback', [AppointmentController::class, 'googleCalendarCallback'])->name('appointments.google-calendar-callback');

// Route to mark notification as read and redirect to appointments
Route::get('/mark-notification-read/{id}', function ($id, Request $request) {
    if (Auth::check()) {
        $notification = Auth::user()->unreadNotifications->find($id);
        if ($notification) {
            $notification->markAsRead();
            // Redirect to the specified URL or appointments page
            $redirectUrl = $request->get('redirect', route('appointments.index'));
            return redirect($redirectUrl);
        }
    }
    return redirect()->route('appointments.index');
})->name('mark.notification.read');

Route::get('/appointments/available-times/{trainer_id}/{date}', [AppointmentController::class, 'getAvailableTimes'])->name('appointments.available-times');
Route::get('/appointments/available-dates/{trainer_id}/{month}', [AppointmentController::class, 'getAvailableDates'])->name('appointments.available-dates');

// Appointment action routes
Route::get('/appointments/{id}', [AppointmentController::class, 'show'])->name('appointments.show');
Route::post('/appointments/{id}/confirm', [AppointmentController::class, 'confirm'])->name('appointments.confirm');
Route::post('/appointments/{id}/complete', [AppointmentController::class, 'complete'])->name('appointments.complete');
Route::post('/appointments/{id}/cancel', [AppointmentController::class, 'cancel'])->name('appointments.cancel');

// ============================================
// BOOKING MODULE ROUTES - MUST BE BEFORE ADMIN ROUTES
// ============================================

// Trainer Routes (for trainers and admins)
Route::prefix('trainer')->middleware(['auth', 'role:Trainer|Admin'])->name('trainer.')->group(function () {
    // Test route to check auth
    Route::get('test', function () {
        return 'Auth works! User: ' . auth()->user()->name . ' | Roles: ' . auth()->user()->getRoleNames()->implode(', ');
    });

    // Dashboard
    Route::get('dashboard', [\App\Http\Controllers\Trainer\TrainerDashboardController::class, 'index'])->name('dashboard');

    // Availability Management
    Route::resource('availability', \App\Http\Controllers\Trainer\TrainerAvailabilityController::class);

    // Pricing Management
    Route::get('pricing', [\App\Http\Controllers\Trainer\TrainerPricingController::class, 'index'])->name('pricing.index');
    Route::post('pricing', [\App\Http\Controllers\Trainer\TrainerPricingController::class, 'update'])->name('pricing.update');

    // Slot Management
    Route::get('slots', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'index'])->name('slots.index');
    Route::get('slots/block-form', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'blockForm'])->name('slots.block-form');
    Route::post('slots/block', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'block'])->name('slots.block');
    Route::get('slots/blocked', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'blocked'])->name('slots.blocked');
    Route::delete('slots/{id}/unblock', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'unblock'])->name('slots.unblock');

    // Booking Management
    Route::get('bookings', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'show'])->name('bookings.show');
    Route::post('bookings/{booking}/approve', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/cancel', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'cancel'])->name('bookings.cancel');
    Route::post('bookings/{booking}/complete', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'complete'])->name('bookings.complete');

    // Reschedule
    Route::get('bookings/{booking}/reschedule', [\App\Http\Controllers\Trainer\TrainerRescheduleController::class, 'show'])->name('bookings.reschedule');
    Route::post('bookings/reschedule', [\App\Http\Controllers\Trainer\TrainerRescheduleController::class, 'store'])->name('bookings.reschedule.store');

    // Google Calendar Integration
    Route::get('google', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'index'])->name('google.index');
    Route::get('google/connect', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'connect'])->name('google.connect');
    Route::get('google/callback', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'callback'])->name('google.callback');
    Route::post('google/disconnect', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'disconnect'])->name('google.disconnect');
    Route::post('google/test', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'test'])->name('google.test');
});

// Customer Routes (for authenticated users)
Route::prefix('customer')->name('customer.')->group(function () {
    // Browse Trainers
    Route::get('trainers', [\App\Http\Controllers\Customer\TrainerListController::class, 'index'])->name('trainers.index');
    Route::get('trainers/{id}', [\App\Http\Controllers\Customer\TrainerListController::class, 'show'])->name('trainers.show');

    // View trainer schedule
    Route::get('trainers/{trainer}/schedule', [\App\Http\Controllers\Customer\ScheduleController::class, 'show'])->name('schedule.show');

    // Booking Management
    Route::get('bookings', [\App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/create', [\App\Http\Controllers\Customer\BookingController::class, 'create'])->name('bookings.create');
    Route::post('bookings', [\App\Http\Controllers\Customer\BookingController::class, 'store'])->name('bookings.store');
    Route::get('bookings/{booking}', [\App\Http\Controllers\Customer\BookingController::class, 'show'])->name('bookings.show');

    // Payment callbacks
    Route::get('payment/success', [\App\Http\Controllers\Customer\BookingController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('payment/cancel', [\App\Http\Controllers\Customer\BookingController::class, 'paymentCancel'])->name('payment.cancel');

    // Reschedule
    Route::get('bookings/{booking}/reschedule', [\App\Http\Controllers\Customer\RescheduleController::class, 'show'])->name('bookings.reschedule');
    Route::post('bookings/{booking}/reschedule', [\App\Http\Controllers\Customer\RescheduleController::class, 'store'])->name('bookings.reschedule.store');
});

Route::group(['middleware' => ['auth']], function () {
    //Roles
    Route::resource('role', RoleController::class);

    //Stripe
    Route::get('stripe', [WebController::class, 'Stripe'])->name('stripe');

    //users
    Route::resource('user', UserController::class);

    //permissions
    Route::resource('permission', PermissionController::class);

    //Packages
    Route::resource('package', PackageController::class);

    //Category
    Route::resource('services', CategoryController::class);

    //testimonial
    Route::resource('testimonial', TestimonialController::class);

    //Agents
    Route::resource('agents', AgentController::class);

    //About
    Route::resource('about', AboutUsController::class);

    //Setting
    Route::resource('page', PageController::class);
    Route::get('page_setting/{slug}', [PageSettingController::class, 'show'])->name('page_setting.show');
    Route::post('page_setting', [PageSettingController::class, 'store'])->name('page_setting.store');

    //payment
    Route::resource('payment', PaymentController::class);

    //FAQS
    Route::resource('faq', FAQController::class);

    //Banner
    Route::resource('banner', BannerController::class);

    //Home Slider
    Route::resource('homeslider', HomeSliderController::class);

    //Appointments
    Route::resource('appointment', AppointmentController::class);

    //Events
    Route::resource('event', EventController::class);

    //Blog Categories
    Route::resource('blog_category', BlogCategoryController::class);

    //Blogs
    Route::resource('blog', BlogController::class);

    // Admin Booking Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('bookings', [\App\Http\Controllers\admin\AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{id}', [\App\Http\Controllers\admin\AdminBookingController::class, 'show'])->name('bookings.show');
        Route::get('appointments/{id}', [\App\Http\Controllers\admin\AdminBookingController::class, 'showAppointment'])->name('appointments.show');

        // Admin Slot Management
        Route::get('slots', [\App\Http\Controllers\admin\AdminSlotController::class, 'index'])->name('slots.index');
        Route::get('slots/blocked', [\App\Http\Controllers\admin\AdminSlotController::class, 'blocked'])->name('slots.blocked');

        // Admin Availability Management
        Route::get('availability', [\App\Http\Controllers\admin\AdminAvailabilityController::class, 'index'])->name('availability.index');
        Route::get('availability/trainer/{trainerId}', [\App\Http\Controllers\admin\AdminAvailabilityController::class, 'show'])->name('availability.show');
    });

    // ============================================
    // BOOKING MODULE ROUTES
    // ============================================

    // Trainer Routes (for trainers and admins)
    Route::prefix('trainer')->middleware(['auth', 'role:trainer|admin'])->name('trainer.')->group(function () {
        // Test route to check auth
        Route::get('test', function () {
            return 'Auth works! User: ' . auth()->user()->name . ' | Roles: ' . auth()->user()->getRoleNames()->implode(', ');
        });

        // Dashboard
        Route::get('dashboard', [\App\Http\Controllers\Trainer\TrainerDashboardController::class, 'index'])->name('dashboard');

        // Profile Management
        Route::get('profile', [\App\Http\Controllers\Trainer\TrainerDashboardController::class, 'profile'])->name('profile.edit');
        Route::post('profile', [\App\Http\Controllers\Trainer\TrainerDashboardController::class, 'updateProfile'])->name('profile.update');

        // Availability Management
        Route::resource('availability', \App\Http\Controllers\Trainer\TrainerAvailabilityController::class);

        // Pricing Management
        Route::get('pricing', [\App\Http\Controllers\Trainer\TrainerPricingController::class, 'index'])->name('pricing.index');
        Route::post('pricing', [\App\Http\Controllers\Trainer\TrainerPricingController::class, 'update'])->name('pricing.update');

        // Slot Management
        Route::get('slots', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'index'])->name('slots.index');
        Route::get('slots/block-form', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'blockForm'])->name('slots.block-form');
        Route::post('slots/block', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'block'])->name('slots.block');
        Route::get('slots/blocked', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'blocked'])->name('slots.blocked');
        Route::delete('slots/{id}/unblock', [\App\Http\Controllers\Trainer\TrainerSlotController::class, 'unblock'])->name('slots.unblock');

        // Booking Management
        Route::get('bookings', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{booking}', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{booking}/approve', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'approve'])->name('bookings.approve');
        Route::post('bookings/{booking}/cancel', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'cancel'])->name('bookings.cancel');
        Route::post('bookings/{booking}/complete', [\App\Http\Controllers\Trainer\TrainerBookingController::class, 'complete'])->name('bookings.complete');

        // Reschedule
        Route::get('bookings/{booking}/reschedule', [\App\Http\Controllers\Trainer\TrainerRescheduleController::class, 'show'])->name('bookings.reschedule');
        Route::post('bookings/reschedule', [\App\Http\Controllers\Trainer\TrainerRescheduleController::class, 'store'])->name('bookings.reschedule.store');

        // Google Calendar Integration
        Route::get('google', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'index'])->name('google.index');
        Route::get('google/connect', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'connect'])->name('google.connect');
        Route::get('google/callback', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'callback'])->name('google.callback');
        Route::post('google/disconnect', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'disconnect'])->name('google.disconnect');
        Route::post('google/test', [\App\Http\Controllers\Trainer\GoogleCalendarController::class, 'test'])->name('google.test');
    });

    //Trainers
    Route::resource('trainer', TrainerController::class);

    // Customer Routes (for authenticated users)
    Route::prefix('customer')->name('customer.')->group(function () {
        // Browse Trainers
        Route::get('trainers', [\App\Http\Controllers\Customer\TrainerListController::class, 'index'])->name('trainers.index');
        Route::get('trainers/{id}', [\App\Http\Controllers\Customer\TrainerListController::class, 'show'])->name('trainers.show');

        // View trainer schedule
        Route::get('trainers/{trainer}/schedule', [\App\Http\Controllers\Customer\ScheduleController::class, 'show'])->name('schedule.show');

        // Booking Management
        Route::get('bookings', [\App\Http\Controllers\Customer\BookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/create', [\App\Http\Controllers\Customer\BookingController::class, 'create'])->name('bookings.create');
        Route::post('bookings', [\App\Http\Controllers\Customer\BookingController::class, 'store'])->name('bookings.store');
        Route::get('bookings/{booking}', [\App\Http\Controllers\Customer\BookingController::class, 'show'])->name('bookings.show');

        // Payment callbacks
        Route::get('payment/success', [\App\Http\Controllers\Customer\BookingController::class, 'paymentSuccess'])->name('payment.success');
        Route::get('payment/cancel', [\App\Http\Controllers\Customer\BookingController::class, 'paymentCancel'])->name('payment.cancel');

        // Reschedule
        Route::get('bookings/{booking}/reschedule', [\App\Http\Controllers\Customer\RescheduleController::class, 'show'])->name('bookings.reschedule');
        Route::post('bookings/reschedule', [\App\Http\Controllers\Customer\RescheduleController::class, 'store'])->name('bookings.reschedule.store');
    });
});

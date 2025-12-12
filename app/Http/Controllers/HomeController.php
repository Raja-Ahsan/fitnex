<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MemberDirectory;
use App\Models\DocumentRepository;
use App\Models\Project;
use App\Models\JobPost;
use App\Models\ContactUs;
use App\Models\Contact;
use App\Models\ClientContact;
use App\Models\news_letter;
use App\Models\Trainer;
use App\Models\Testimonial;
use App\Models\Category;
use App\Models\Booking;
use App\Models\Appointment;
use App\Models\TimeSlot;
use App\Models\BlockedSlot;
use App\Models\Availability;
use Google\Service\CivicInfo\Resource\Elections;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /** 
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            // Admin dashboard
            $page_title = 'Admin Dashboard';
            
            // Basic Statistics
            $total_users = User::where('id', '!=', 1)->count();
            $total_contactus = ContactUs::where('status', 1)->count();
            $total_jobpost = JobPost::where('status', 1)->count();
            $testimonials = Testimonial::where('status', 1)->count();
            $total_trainer = Trainer::where('status', 1)->count();
            $total_category = Category::where('status', 1)->count();
            
            // Booking & Appointment Statistics
            $total_bookings = Booking::count();
            $total_appointments = Appointment::count();
            $pending_bookings = Booking::where('booking_status', 'pending')->count();
            $confirmed_bookings = Booking::where('booking_status', 'confirmed')->count();
            $completed_bookings = Booking::where('booking_status', 'completed')->count();
            $cancelled_bookings = Booking::where('booking_status', 'cancelled')->count();
            
            $pending_appointments = Appointment::where('status', 'pending')->count();
            $confirmed_appointments = Appointment::where('status', 'confirmed')->count();
            $completed_appointments = Appointment::where('status', 'completed')->count();
            $cancelled_appointments = Appointment::where('status', 'cancelled')->count();
            
            // Revenue Statistics
            $total_revenue = Booking::where('payment_status', 'paid')->sum('price') + 
                           Appointment::where('payment_status', 'paid')->sum('price');
            $monthly_revenue = Booking::where('payment_status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('price') + 
                Appointment::where('payment_status', 'paid')
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->sum('price');
            
            $today_revenue = Booking::where('payment_status', 'paid')
                ->whereDate('created_at', today())
                ->sum('price') + 
                Appointment::where('payment_status', 'paid')
                ->whereDate('created_at', today())
                ->sum('price');
            
            // Time Slot Statistics
            $total_slots = TimeSlot::count();
            $available_slots = TimeSlot::where('is_booked', false)->count();
            $booked_slots = TimeSlot::where('is_booked', true)->count();
            $blocked_slots = BlockedSlot::count();
            $upcoming_slots = TimeSlot::where('slot_datetime', '>', now())->count();
            
            // Payment Statistics
            $paid_bookings = Booking::where('payment_status', 'paid')->count();
            $pending_payments = Booking::where('payment_status', 'pending')->count() + 
                              Appointment::where('payment_status', 'pending')->count();
            
            // Recent Activity (Last 7 days)
            $recent_bookings = Booking::where('created_at', '>=', now()->subDays(7))->count();
            $recent_appointments = Appointment::where('created_at', '>=', now()->subDays(7))->count();
            $recent_users = User::where('created_at', '>=', now()->subDays(7))->count();
            $recent_trainers = Trainer::where('created_at', '>=', now()->subDays(7))->count();
            
            // Revenue Chart Data (Last 30 days)
            $revenue_chart_data = [];
            for ($i = 29; $i >= 0; $i--) {
                $date = now()->subDays($i);
                $day_revenue = Booking::where('payment_status', 'paid')
                    ->whereDate('created_at', $date)
                    ->sum('price') + 
                    Appointment::where('payment_status', 'paid')
                    ->whereDate('created_at', $date)
                    ->sum('price');
                $revenue_chart_data[] = [
                    'date' => $date->format('M d'),
                    'revenue' => (float) $day_revenue
                ];
            }
            
            // Booking Status Chart Data - ensure we have at least one value
            $booking_status_data = [];
            if ($pending_bookings > 0) $booking_status_data[] = ['name' => 'Pending', 'y' => $pending_bookings, 'color' => '#f39c12'];
            if ($confirmed_bookings > 0) $booking_status_data[] = ['name' => 'Confirmed', 'y' => $confirmed_bookings, 'color' => '#27ae60'];
            if ($completed_bookings > 0) $booking_status_data[] = ['name' => 'Completed', 'y' => $completed_bookings, 'color' => '#3498db'];
            if ($cancelled_bookings > 0) $booking_status_data[] = ['name' => 'Cancelled', 'y' => $cancelled_bookings, 'color' => '#e74c3c'];
            if (empty($booking_status_data)) {
                $booking_status_data = [['name' => 'No Bookings', 'y' => 1, 'color' => '#95a5a6']];
            }
            
            // Appointment Status Chart Data - ensure we have at least one value
            $appointment_status_data = [];
            if ($pending_appointments > 0) $appointment_status_data[] = ['name' => 'Pending', 'y' => $pending_appointments, 'color' => '#f39c12'];
            if ($confirmed_appointments > 0) $appointment_status_data[] = ['name' => 'Confirmed', 'y' => $confirmed_appointments, 'color' => '#27ae60'];
            if ($completed_appointments > 0) $appointment_status_data[] = ['name' => 'Completed', 'y' => $completed_appointments, 'color' => '#3498db'];
            if ($cancelled_appointments > 0) $appointment_status_data[] = ['name' => 'Cancelled', 'y' => $cancelled_appointments, 'color' => '#e74c3c'];
            if (empty($appointment_status_data)) {
                $appointment_status_data = [['name' => 'No Appointments', 'y' => 1, 'color' => '#95a5a6']];
            }
            
            // Monthly Booking Trend (Last 6 months)
            $monthly_booking_data = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = now()->subMonths($i);
                $month_bookings = Booking::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
                $month_appointments = Appointment::whereMonth('created_at', $month->month)
                    ->whereYear('created_at', $month->year)
                    ->count();
                $monthly_booking_data[] = [
                    'month' => $month->format('M Y'),
                    'bookings' => $month_bookings,
                    'appointments' => $month_appointments
                ];
            }
            
            // Top Trainers by Bookings
            $top_trainers = Trainer::withCount(['bookings' => function($query) {
                $query->where('booking_status', 'confirmed');
            }])
            ->having('bookings_count', '>', 0)
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();
            
            // Ensure we have data for charts even if empty
            if ($top_trainers->isEmpty()) {
                // Create dummy data to prevent chart errors
                $top_trainers = collect([
                    (object)['name' => 'No Data', 'bookings_count' => 0]
                ]);
            }
            
            return view('admin.dashboard.dashboard', compact(
                'page_title', 'total_users', 'total_jobpost', 'total_contactus', 
                'total_trainer', 'testimonials', 'total_category',
                'total_bookings', 'total_appointments', 'pending_bookings', 
                'confirmed_bookings', 'completed_bookings', 'cancelled_bookings',
                'pending_appointments', 'confirmed_appointments', 'completed_appointments', 
                'cancelled_appointments', 'total_revenue', 'monthly_revenue', 'today_revenue',
                'total_slots', 'available_slots', 'booked_slots', 'blocked_slots', 
                'upcoming_slots', 'paid_bookings', 'pending_payments',
                'recent_bookings', 'recent_appointments', 'recent_users', 'recent_trainers',
                'revenue_chart_data', 'booking_status_data', 'appointment_status_data',
                'monthly_booking_data', 'top_trainers'
            ));
        } elseif (Auth::check() && Auth::user()->hasRole('Trainer')) {
            // Trainer dashboard
            return redirect()->route('trainer.dashboard');
        } elseif (Auth::check() && Auth::user()->hasRole('Member')) {
            // Member dashboard
            $page_title = 'Dashboard';
            return view('website.member-dashboard.dashboard', compact('page_title'));
        } else {
            return redirect('/');
        }
    }
}

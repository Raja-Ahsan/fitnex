<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\PickDropLocation;
use App\Models\Product;
use Carbon\Carbon;
use Auth; 
use Session;
use PDF;

class BookingController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax()){
            if(Auth::user()->hasRole('Admin')){
                $query = Booking::orderby('id', 'desc')->where('id', '>', 0);
            }elseif(Auth::user()->hasRole('EPC Developer')){
                $query = Booking::orderby('id', 'desc')->where('customer_id', Auth::user()->id)->where('id', '>', 0);
            }
            if($request['search'] != ""){
                $query->where('booking_number', 'like', '%'. $request['search'] .'%')
                    ->orWhere('product_slug', 'like', '%'. $request['search'] .'%')
                    ->orWhere('trip_start_date', 'like', '%'. $request['search'] .'%');
            }
            if($request['status']!="All"){
                if($request['status']==2){
                    $request['status'] = 0;
                }
                $query->where('status', $request['status']);
            }
            $models = $query->paginate(10);
            return (string) view('admin.bookings.search', compact('models'));
        }
        $page_title = 'All Bookings';
        if(Auth::user()->hasRole('Admin')){
            $models = Booking::orderby('id', 'desc')->paginate(10);
        }elseif(Auth::user()->hasRole('EPC Developer')){
            $models = Booking::orderby('id', 'desc')->where('customer_id', Auth::user()->id)->paginate(10);
        }
        
        return View('admin.bookings.index', compact("models", "page_title"));
    }
    public function store(Request $request)
    {
        Session::put('data', $request->all());
        if(!Auth::check()){
            return redirect()->route('login');
        }else{
            return redirect()->route('stripe.create');
        }  
    }

    public function show($booking_number)
    {
        $bookings = Booking::where('booking_number', $booking_number)->first();
        $page_title = 'Booking Details';
        return view('admin.bookings.show', compact('bookings', 'page_title'));
    }

    public function edit($booking_number)
    {
        $booking_details = Booking::where('booking_number', $booking_number)->first();
        $booking_details->status = 3;
        $booking_details->save();
        
        return redirect()->route('rentals');
    }

    public function bookingDetail()
    {
        $page_title= 'All Booking Detail';
        $bookings_details = Booking::where('customer_id', Auth::user()->id)->where('booking_number' , '!=' , 'null')->get();
        return view('website.user-dashboard.booking-detail' , compact('page_title' , 'bookings_details'));
    }
	
	public function detailShow($booking_number)
    {
        $page_title= 'All Booking Detail';
        $bookings_detail = Booking::where('booking_number', $booking_number)->first();
        return view('admin.bookings.booking-detail' , compact('page_title' , 'bookings_detail'));
    }
	
    public function status(Request $request)
    {
        $booking = Booking::where('booking_number', $request->booking_number)->first();
        $booking->status = $request->booking_status;
        $booking->save();

        return redirect()->route('booking.index')->with('message','Booking status updated successfully');
    }

    public function invoice($booking_number)
    {   
        $booking_details = Booking::where('booking_number', $booking_number)->first();
		//return view('website.user-dashboard.booking-invoice', compact('booking_details'));
        $pdf = PDF::loadView('website.user-dashboard.booking-invoice', compact('booking_details'));
        return $pdf->download('booking-invoice.pdf');
		
        
    }
    
    public function destroy($booking_number){
        $model = Booking::where('booking_number', $booking_number)->delete();
        if($model){
            Session::forget('booking_number');
            Session::forget('data');
            
            return redirect()->route('rentals');
        }
    }
	
	 public function bookingReview(Request $request)
    {  
        $reviews = Booking::where('booking_number', $request->bookings)->first();
        $reviews->review = $request->review;
		$reviews->comment = $request->comment;
        $reviews->update();
        
        return redirect()->back()->with('message','Review Added Successfully');
    }
}

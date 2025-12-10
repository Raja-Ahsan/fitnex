@extends('layouts.website.master')
@section('title', $page_title)
 
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .booking-form {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .form-input {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
        transition: all 0.3s ease;
    }
    
    .form-input:focus {
        border-color: #0079D4;
        box-shadow: 0 0 0 3px rgba(0, 121, 212, 0.1);
        outline: none;
        background: rgba(255, 255, 255, 0.15);
    }
    
    .form-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .time-slot-btn {
        background: rgba(255, 255, 255, 0.1);
        border: 2px solid rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 10px;
        padding: 12px 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .time-slot-btn:hover {
        background: rgba(0, 121, 212, 0.2);
        border-color: #0079D4;
        transform: translateY(-2px);
    }
    
    .time-slot-btn.selected {
        background: #0079D4 !important;
        border-color: #0079D4 !important;
        box-shadow: 0 4px 15px rgba(0, 121, 212, 0.4);
    }
    
    .trainer-card {
        background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .primary-btn {
        background: linear-gradient(135deg, #0079D4 0%, #005a9f 100%);
        border: none;
        border-radius: 12px;
        padding: 16px 32px;
        font-weight: 700;
        font-size: 18px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 121, 212, 0.3);
    }
    
    .primary-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 121, 212, 0.4);
    }
    
    .primary-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }
    
    .error-message {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 20px;
        border-left: 4px solid #a71e2a;
    }
    
    .success-message {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border-radius: 10px;
        padding: 16px;
        margin-bottom: 20px;
        border-left: 4px solid #1e7e34;
    }
    
    .form-label {
        font-weight: 600;
        margin-bottom: 8px;
        color: #f8f9fa;
        font-size: 16px;
    }
    
    .loading-spinner {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: 3px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top-color: #fff;
        animation: spin 1s ease-in-out infinite;
    }
    
    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    /* Custom Appointment Scheduler Styles */
    .custom-appointment-scheduler {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 25px 70px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255, 255, 255, 0.05);
        background: #0f0f0f;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .custom-appointment-scheduler:hover {
        transform: translateY(-2px);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.7), 0 0 0 1px rgba(0, 121, 212, 0.3);
    }
    
    .scheduler-header {
        background: linear-gradient(135deg, #0079D4 0%, #0066b3 50%, #005292 100%);
        border-bottom: none;
        position: relative;
        box-shadow: 0 4px 20px rgba(0, 121, 212, 0.3);
    }
    
    .scheduler-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
        pointer-events: none;
    }
    
    .scheduler-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    }
    
    .scheduler-body {
        border: 1px solid rgba(0, 121, 212, 0.15);
    }
    
    /* Custom Calendar Styles */
    .custom-calendar {
        min-height: 400px;
        background: rgba(31, 41, 55, 0.8) !important;
    }
    
    .custom-calendar .calendar-days {
        min-height: 320px;
        padding: 10px 0;
    }
    
    .custom-calendar .calendar-days.grid {
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        gap: 8px !important;
    }
    
    .custom-calendar .calendar-day {
        width: 100% !important;
        min-height: 50px;
        height: 50px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        font-size: 16px;
        color: #e5e7eb;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }
    
    /* Ensure available dates are clearly visible */
    .custom-calendar .calendar-day:not(.disabled):not(.other-month):not(.selected):not(.today) {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.15);
    }
    
    .custom-calendar .calendar-day:hover:not(.disabled):not(.other-month) {
        background: rgba(0, 121, 212, 0.25);
        border-color: rgba(0, 121, 212, 0.6);
        transform: scale(1.08);
        color: #fff;
        box-shadow: 0 2px 10px rgba(0, 121, 212, 0.3);
    }
    
    .custom-calendar .calendar-day.disabled {
        color: #6b7280;
        cursor: not-allowed;
        opacity: 0.3;
        background: rgba(107, 114, 128, 0.1);
    }
    
    .custom-calendar .calendar-day.disabled:hover {
        background: rgba(107, 114, 128, 0.1);
        border-color: transparent;
        transform: none;
        box-shadow: none;
    }
    
    .custom-calendar .calendar-day.other-month {
        color: #4b5563;
        opacity: 0.4;
        background: transparent;
    }
    
    .custom-calendar .calendar-day.other-month:hover {
        background: transparent;
        border-color: transparent;
        transform: none;
    }
    
    .custom-calendar .calendar-day.today {
        background: linear-gradient(135deg, rgba(0, 121, 212, 0.4) 0%, rgba(0, 102, 179, 0.4) 100%);
        border-color: #0079D4;
        color: #fff;
        font-weight: 700;
        box-shadow: 0 2px 8px rgba(0, 121, 212, 0.4);
    }
    
    .custom-calendar .calendar-day.selected {
        background: linear-gradient(135deg, #0079D4 0%, #0066b3 100%);
        border-color: #0079D4;
        color: #fff;
        font-weight: 700;
        box-shadow: 0 4px 20px rgba(0, 121, 212, 0.6);
        transform: scale(1.1);
        z-index: 10;
    }
    
    .custom-calendar .calendar-weekdays {
        display: grid !important;
        grid-template-columns: repeat(7, 1fr) !important;
        gap: 8px !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding-bottom: 12px;
        margin-bottom: 15px;
    }
    
    .custom-calendar .calendar-weekdays > div {
        font-weight: 700;
        color: #9ca3af;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: center;
        padding: 8px 0;
    }
    
    /* Time Slot Styles */
    .time-slot {
        padding: 12px 20px;
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        color: #e5e7eb;
        font-weight: 600;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .time-slot:hover {
        background: rgba(0, 121, 212, 0.2);
        border-color: #0079D4;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 121, 212, 0.3);
    }
    
    .time-slot.disabled {
        opacity: 0.3;
        cursor: not-allowed;
        background: rgba(107, 114, 128, 0.1);
    }
    
    .time-slot.disabled:hover {
        transform: none;
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: none;
    }
    
    .time-slot.selected {
        background: linear-gradient(135deg, #0079D4 0%, #0066b3 100%);
        border-color: #0079D4;
        color: #fff;
        box-shadow: 0 4px 20px rgba(0, 121, 212, 0.5);
        transform: scale(1.05);
    }
    
    /* Manual input section styling */
    .bg-gray-800 input[type="date"],
    .bg-gray-800 input[type="time"] {
        transition: all 0.3s ease;
        border: 2px solid rgba(255, 255, 255, 0.1);
    }
    
    .bg-gray-800 input[type="date"]:focus,
    .bg-gray-800 input[type="time"]:focus {
        border-color: #0079D4;
        box-shadow: 0 0 0 4px rgba(0, 121, 212, 0.2);
        outline: none;
        background: rgba(0, 121, 212, 0.05);
    }
    
    /* Responsive design */
    @media (max-width: 768px) {
        .google-calendar-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .google-calendar-container iframe {
            min-height: 550px;
        }
        
        .google-calendar-header > div:last-child {
            width: 100%;
            text-align: center;
        }
    }

</style> 

@section('content')
<section class="inner-banner listing-banner" style="background: url('{{ ($banner && $banner->image) ? asset('/admin/assets/images/banner/'.$banner->image) : asset('/admin/assets/images/images.png') }}') no-repeat center/cover">
    <div class="container">
        <h1 class="relative mx-auto text-[50px] text-white font-bold leading-[1.1]" data-aos="flip-right" data-aos-easing="linear" data-aos-duration="1500">
            @php
                $title = ($banner && $banner->name) ? $banner->name : 'Book Session';
                $parts = explode(' ', $title, 2);
            @endphp
            <span class="italic uppercase font-black">
                <span class="primary-theme-text">{{ $parts[0] }}</span>@if(isset($parts[1])) {{ $parts[1] }}@endif
            </span>
        </h1>
    </div>
</section>

<section class="py-16 bg-black text-white">
    <div class="container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <div>
                <h2 class="text-3xl font-bold mb-4">Trainer Information</h2>
                <div class="flex items-center space-x-4 mb-6">
                    <img src="{{ asset('/admin/assets/images/Trainers/'.$trainer->image) }}" alt="{{ $trainer->name }}" class="w-24 h-24 rounded-full object-cover">
                    <div>
                        <h3 class="text-2xl font-bold">{{ $trainer->name }}</h3>
                        <p class="text-lg text-[#0079D4]">{{ $trainer->designation }}</p>
                        <p class="text-lg font-bold primary-theme">${{ $trainer->price }} / session</p>
                    </div>
                </div>
                <div class="prose prose-invert max-w-none">
                    {!! $trainer->description !!}
                </div>
            </div>
            <div>
                <h2 class="text-3xl font-bold mb-4">Book Your Session</h2>
                @if(session('error'))
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('appointments.store') }}" id="regform" class="form-horizontal" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    @csrf
                    <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                    
                    @guest
                    <div class="mb-4">
                        <label for="name" class="block text-lg font-medium mb-2">Full Name</label>
                        <input type="text" id="name" name="name" class="w-full bg-gray-800 border-gray-600 rounded p-3" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-lg font-medium mb-2">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full bg-gray-800 border-gray-600 rounded p-3" placeholder="Enter your email" required>
                    </div>
                    @endguest

                    <!-- Hidden inputs for form submission -->
                    <input type="hidden" name="appointment_date" id="appointment_date" required>
                    <input type="hidden" name="appointment_time" id="appointment_time" required>
                    <input type="hidden" name="time_zone" id="time_zone" required>
                    <input type="hidden" name="google_calendar_event_id" id="google_calendar_event_id">
                    
                    <!-- Custom Appointment Scheduler -->
                    <div class="custom-appointment-scheduler mb-6">
                        <div class="scheduler-header rounded-t-xl p-5 flex items-center justify-between shadow-lg relative">
                            <div class="flex items-center space-x-4 relative z-10">
                                <div class="bg-opacity-25 backdrop-blur-md rounded-xl p-3 shadow-lg border border-white border-opacity-30">
                                    <i class="fas fa-calendar-alt  text-2xl"></i>
                                </div>
                                <div>
                                    <h3 class="text-white font-bold text-xl mb-1 drop-shadow-lg">Select Your Appointment Time</h3>
                                    <p class="text-blue-100 text-sm flex items-center font-medium" id="current-timezone-display">
                                        <i class="fas fa-globe mr-2 text-blue-200"></i>
                                        <span>Loading timezone...</span>
                                    </p>
                                </div>
                            </div>
                            <div class="bg-opacity-25 backdrop-blur-md text-white px-5 py-3 rounded-full border border-white border-opacity-40 shadow-lg relative z-10 hover:bg-opacity-30 transition-all duration-300">
                                <div class="flex items-center">
                                    <i class="fas fa-dollar-sign mr-2 text-green-300"></i>
                                    <span class="font-bold text-lg">${{ $trainer->price ?? 0 }}</span>
                                    <span class="text-sm ml-2 opacity-90">/session</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="scheduler-body bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 rounded-b-xl p-6 shadow-2xl">
                            <!-- Date Selection -->
                            <div class="mb-6">
                                <h4 class="text-white font-semibold text-lg mb-4 flex items-center">
                                    <i class="fas fa-calendar-check mr-2 text-blue-400"></i>
                                    Select Date
                                </h4>
                                <div class="custom-calendar bg-gray-800 rounded-xl p-6 border border-gray-700 shadow-xl">
                                    <div class="calendar-header flex items-center justify-between mb-6">
                                        <button type="button" id="prev-month" class="text-white hover:text-blue-400 transition-all p-3 rounded-xl hover:bg-gray-700 hover:scale-110">
                                            <i class="fas fa-chevron-left text-lg"></i>
                                        </button>
                                        <h5 class="text-white font-bold text-xl" id="current-month-year">November 2025</h5>
                                        <button type="button" id="next-month" class="text-white hover:text-blue-400 transition-all p-3 rounded-xl hover:bg-gray-700 hover:scale-110">
                                            <i class="fas fa-chevron-right text-lg"></i>
                                        </button>
                                    </div>
                                    <div class="calendar-weekdays grid grid-cols-7 gap-2 mb-4">
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Sun</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Mon</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Tue</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Wed</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Thu</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Fri</div>
                                        <div class="text-center text-gray-400 font-bold text-sm py-3">Sat</div>
                                    </div>
                                    <div class="calendar-days grid grid-cols-7 gap-2" id="calendar-days">
                                        <!-- Calendar days will be generated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Time Selection -->
                            <div class="mb-6">
                                <h4 class="text-white font-semibold text-lg mb-4 flex items-center">
                                    <i class="fas fa-clock mr-2 text-blue-400"></i>
                                    Select Time
                                </h4>
                                <div class="time-slots grid grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3" id="time-slots">
                                    <!-- Time slots will be generated by JavaScript -->
                                </div>
                            </div>

                            <!-- Selected Appointment Display -->
                            <div id="selected-appointment" class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl p-4 border-2 border-blue-400 shadow-lg" style="display: none;">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-white bg-opacity-20 rounded-full p-2">
                                            <i class="fas fa-check text-white"></i>
                                        </div>
                                        <div>
                                            <p class="text-white font-semibold text-sm">Selected Appointment:</p>
                                            <p class="text-blue-100 font-bold text-lg" id="selected-appointment-text">No appointment selected</p>
                                        </div>
                                    </div>
                                    <button type="button" id="clear-selection" class="text-white hover:text-red-300 transition-colors p-2 rounded-lg hover:bg-white hover:bg-opacity-20">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="description" class="block text-lg font-medium mb-2">Additional Notes (Optional)</label>
                        <textarea id="description" name="description" rows="4" class="w-full bg-gray-800 border-gray-600 rounded p-3 text-white" placeholder="Any additional information..."></textarea>
                    </div>

                    <button type="submit" id="submit-btn" class="btn primary-btn w-full">
                        <span id="submit-text">Proceed to Payment</span>
                        <span id="submit-loader" class="loading-spinner" style="display: none;"></span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
 
@section('script')
<script>
(function() {
    document.addEventListener('DOMContentLoaded', function() {
        const trainerId = document.querySelector('input[name="trainer_id"]').value;
        const dateInput = document.getElementById('appointment_date');
        const timeInput = document.getElementById('appointment_time');
        const form = document.getElementById('regform');
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const submitLoader = document.getElementById('submit-loader');

        if (!trainerId || !dateInput || !timeInput || !form) {
            console.error("Required booking form elements are missing.");
            return;
        }

        // Set timezone
        const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        const timezoneInput = document.getElementById('time_zone');
        const timezoneDisplay = document.getElementById('current-timezone-display');
        
        if (timezoneInput) {
            timezoneInput.value = timezone;
        }
        
        if (timezoneDisplay) {
            timezoneDisplay.textContent = `Timezone: ${timezone}`;
        }
        
        // Custom Calendar Implementation
        let currentDate = new Date();
        let selectedDate = null;
        let selectedTime = null;
        
        const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        const calendarDays = document.getElementById('calendar-days');
        const currentMonthYear = document.getElementById('current-month-year');
        const prevMonthBtn = document.getElementById('prev-month');
        const nextMonthBtn = document.getElementById('next-month');
        const timeSlotsContainer = document.getElementById('time-slots');
        const selectedAppointment = document.getElementById('selected-appointment');
        const selectedAppointmentText = document.getElementById('selected-appointment-text');
        const clearSelectionBtn = document.getElementById('clear-selection');
        
        // Check if calendar elements exist
        if (!calendarDays || !currentMonthYear) {
            console.error("Calendar elements not found!");
            return;
        }
        
        if (!timeSlotsContainer) {
            console.error("Time slots container not found!");
            return;
        }
        
        // Fetch available time slots from backend
        async function fetchAvailableTimes(date) {
            if (!date || !trainerId) {
                return [];
            }
            
            try {
                const response = await fetch(`/appointments/available-times/${trainerId}/${date}`);
                const data = await response.json();
                return Array.isArray(data) ? data : [];
            } catch (error) {
                console.error('Error fetching available times:', error);
                return [];
            }
        }
        
        // Generate time slots (9 AM to 8 PM) - now fetches from backend
        async function generateTimeSlots() {
            timeSlotsContainer.innerHTML = '<div class="text-white text-center py-4">Loading available times...</div>';
            
            // If no date is selected, show message
            if (!selectedDate) {
                timeSlotsContainer.innerHTML = '<div class="text-gray-400 text-center py-4">Please select a date first</div>';
                return;
            }
            
            // Fetch available times from backend
            const availableTimes = await fetchAvailableTimes(selectedDate);
            
            timeSlotsContainer.innerHTML = '';
            
            // Generate all possible slots (9 AM to 8 PM, 30-minute intervals)
            const allSlots = [];
            for (let hour = 9; hour <= 20; hour++) {
                for (let minute = 0; minute < 60; minute += 30) {
                    const timeString = `${hour.toString().padStart(2, '0')}:${minute.toString().padStart(2, '0')}`;
                    const time12 = new Date(`2000-01-01T${timeString}`).toLocaleTimeString('en-US', {
                        hour: 'numeric',
                        minute: '2-digit',
                        hour12: true
                    });
                    allSlots.push({ value: timeString, display: time12 });
                }
            }
            
            const now = new Date();
            const currentTime = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}`;
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const selectedDateObj = new Date(selectedDate);
            selectedDateObj.setHours(0, 0, 0, 0);
            const isToday = selectedDateObj.getTime() === today.getTime();
            
            // Display slots - only show available ones from backend
            if (availableTimes.length === 0) {
                timeSlotsContainer.innerHTML = '<div class="text-red-400 text-center py-4">No available time slots for this date</div>';
                return;
            }
            
            allSlots.forEach(slot => {
                const slotElement = document.createElement('div');
                slotElement.className = 'time-slot';
                slotElement.textContent = slot.display;
                slotElement.dataset.time = slot.value;
                
                // Check if this slot is available from backend
                const isAvailable = availableTimes.includes(slot.value);
                
                // Also disable past times if selected date is today
                if (isToday && slot.value <= currentTime) {
                    slotElement.classList.add('disabled');
                } else if (!isAvailable) {
                    // Slot is not available (booked)
                    slotElement.classList.add('disabled');
                }
                
                slotElement.addEventListener('click', function() {
                    if (!this.classList.contains('disabled')) {
                        document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                        this.classList.add('selected');
                        selectedTime = slot.value;
                        updateSelectedAppointment();
                    }
                });
                timeSlotsContainer.appendChild(slotElement);
            });
        }
        
        // Update time slots when date is selected
        function updateTimeSlotsForDate() {
            generateTimeSlots();
        }
        
        // Fetch available dates for a month from backend
        async function fetchAvailableDates(monthString) {
            if (!trainerId) {
                return null; // Return null to indicate we should show all dates
            }
            
            try {
                const response = await fetch(`/appointments/available-dates/${trainerId}/${monthString}`);
                if (!response.ok) {
                    console.warn('Failed to fetch available dates, showing all dates as available');
                    return null; // Return null on error to show all dates
                }
                const data = await response.json();
                
                // If we get an error object, return null
                if (data.error) {
                    console.warn('Error from API:', data.error);
                    return null;
                }
                
                return Array.isArray(data) ? data : null;
            } catch (error) {
                console.error('Error fetching available dates:', error);
                // Return null to indicate we should show all dates (fallback behavior)
                return null;
            }
        }
        
        // Generate calendar
        async function generateCalendar() {
            if (!calendarDays || !currentMonthYear) {
                console.error("Calendar elements not available");
                return;
            }
            
            calendarDays.innerHTML = '<div class="col-span-7 text-white text-center py-4">Loading calendar...</div>';
            
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();
            
            if (currentMonthYear) {
                currentMonthYear.textContent = `${monthNames[month]} ${year}`;
            }
            
            // Fetch available dates for this month
            const monthString = `${year}-${String(month + 1).padStart(2, '0')}`;
            const availableDates = await fetchAvailableDates(monthString);
            
            // Debug logging
            if (availableDates === null) {
                console.log('Available dates: Fallback mode - showing all dates as available');
            } else {
                console.log(`Available dates for ${monthString}:`, availableDates.length, 'dates with available slots');
            }
            
            calendarDays.innerHTML = '';
            
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Previous month days
            const prevMonthDays = new Date(year, month, 0).getDate();
            for (let i = firstDay - 1; i >= 0; i--) {
                const day = prevMonthDays - i;
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day other-month';
                dayElement.textContent = day;
                
                // Calculate previous month date
                const prevMonth = month === 0 ? 11 : month - 1;
                const prevYear = month === 0 ? year - 1 : year;
                const prevDate = new Date(prevYear, prevMonth, day);
                const todayCheck = new Date();
                todayCheck.setHours(0, 0, 0, 0);
                
                // Make clickable if not in past
                if (prevDate >= todayCheck) {
                    dayElement.dataset.date = `${prevYear}-${String(prevMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    dayElement.dataset.navigateMonth = 'prev';
                    dayElement.style.cursor = 'pointer';
                    dayElement.style.opacity = '0.6';
                    
                    dayElement.addEventListener('click', async function() {
                        // Navigate to previous month
                        currentDate.setMonth(prevMonth);
                        currentDate.setFullYear(prevYear);
                        await generateCalendar();
                        
                        // Select the date after calendar regenerates
                        setTimeout(() => {
                            const targetDate = this.dataset.date;
                            document.querySelectorAll('.calendar-day').forEach(d => {
                                if (d.dataset.date === targetDate) {
                                    d.classList.remove('selected');
                                    d.classList.add('selected');
                                    selectedDate = targetDate;
                                    selectedTime = null;
                                    document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                                    updateTimeSlotsForDate();
                                    updateSelectedAppointment();
                                }
                            });
                        }, 50);
                    });
                }
                
                calendarDays.appendChild(dayElement);
            }
            
            // Current month days
            for (let day = 1; day <= daysInMonth; day++) {
                const dayDate = new Date(year, month, day);
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day';
                dayElement.textContent = day;
                const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                dayElement.dataset.date = dateString;
                
                // Check if date is in the past
                if (dayDate < today) {
                    dayElement.classList.add('disabled');
                } else {
                    // Only disable if we successfully got available dates AND this date is not in the list
                    // If availableDates is null, it means there was an error, so show all dates as available
                    if (availableDates !== null && !availableDates.includes(dateString)) {
                        dayElement.classList.add('disabled');
                        dayElement.title = 'No available slots for this date';
                    } else {
                        // Date is available (either in the list, or we're in fallback mode)
                        dayElement.addEventListener('click', function() {
                            if (!this.classList.contains('disabled')) {
                                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                                this.classList.add('selected');
                                selectedDate = this.dataset.date;
                                selectedTime = null; // Reset time when date changes
                                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                                updateTimeSlotsForDate();
                                updateSelectedAppointment();
                            }
                        });
                    }
                }
                
                // Highlight today
                if (dayDate.getTime() === today.getTime()) {
                    dayElement.classList.add('today');
                }
                
                calendarDays.appendChild(dayElement);
            }
            
            // Next month days
            const totalCells = calendarDays.children.length;
            const remainingCells = 42 - totalCells; // 6 weeks * 7 days
            const nextMonth = month === 11 ? 0 : month + 1;
            const nextYear = month === 11 ? year + 1 : year;
            const todayCheckNext = new Date();
            todayCheckNext.setHours(0, 0, 0, 0);
            
            for (let day = 1; day <= remainingCells; day++) {
                const dayElement = document.createElement('div');
                dayElement.className = 'calendar-day other-month';
                dayElement.textContent = day;
                
                // Calculate next month date
                const nextDate = new Date(nextYear, nextMonth, day);
                
                // Make clickable if not in past
                if (nextDate >= todayCheckNext) {
                    dayElement.dataset.date = `${nextYear}-${String(nextMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    dayElement.dataset.navigateMonth = 'next';
                    dayElement.style.cursor = 'pointer';
                    dayElement.style.opacity = '0.6';
                    
                    dayElement.addEventListener('click', async function() {
                        // Navigate to next month
                        currentDate.setMonth(nextMonth);
                        currentDate.setFullYear(nextYear);
                        await generateCalendar();
                        
                        // Select the date after calendar regenerates
                        setTimeout(() => {
                            const targetDate = this.dataset.date;
                            document.querySelectorAll('.calendar-day').forEach(d => {
                                if (d.dataset.date === targetDate) {
                                    d.classList.remove('selected');
                                    d.classList.add('selected');
                                    selectedDate = targetDate;
                                    selectedTime = null;
                                    document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                                    updateTimeSlotsForDate();
                                    updateSelectedAppointment();
                                }
                            });
                        }, 50);
                    });
                }
                
                calendarDays.appendChild(dayElement);
            }
        }
        
        // Update selected appointment display
        function updateSelectedAppointment() {
            if (selectedDate && selectedTime) {
                const dateObj = new Date(selectedDate + 'T' + selectedTime);
                const formattedDate = dateObj.toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                const formattedTime = dateObj.toLocaleTimeString('en-US', {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });
                
                selectedAppointmentText.textContent = `${formattedDate} at ${formattedTime}`;
                selectedAppointment.style.display = 'block';
                
                // Update hidden inputs
                if (dateInput) dateInput.value = selectedDate;
                if (timeInput) timeInput.value = selectedTime;
            } else {
                selectedAppointment.style.display = 'none';
            }
        }
        
        // Month navigation
        if (prevMonthBtn) {
            prevMonthBtn.addEventListener('click', async function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                await generateCalendar();
            });
        }
        
        if (nextMonthBtn) {
            nextMonthBtn.addEventListener('click', async function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                await generateCalendar();
            });
        }
        
        // Clear selection
        if (clearSelectionBtn) {
            clearSelectionBtn.addEventListener('click', function() {
                selectedDate = null;
                selectedTime = null;
                document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
                document.querySelectorAll('.time-slot').forEach(s => s.classList.remove('selected'));
                selectedAppointment.style.display = 'none';
                if (dateInput) dateInput.value = '';
                if (timeInput) timeInput.value = '';
            });
        }
        
        // Initialize
        console.log("Initializing calendar...");
        console.log("calendarDays:", calendarDays);
        console.log("timeSlotsContainer:", timeSlotsContainer);
        
        if (calendarDays && timeSlotsContainer) {
            generateCalendar().then(() => {
                generateTimeSlots();
                console.log("Calendar initialized successfully");
            });
        } else {
            console.error("Failed to initialize calendar - elements missing");
        }

        // Handle form submission via AJAX
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Validate form
            if (!dateInput || !dateInput.value || !timeInput || !timeInput.value) {
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    text: 'Please select both date and time for your appointment.',
                    confirmButtonColor: '#0079D4'
                });
                return;
            }

            // Format date and time for display
            const selectedDateObj = new Date(dateInput.value + 'T' + timeInput.value);
            const formattedDate = selectedDateObj.toLocaleDateString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric' 
            });
            const formattedTime = selectedDateObj.toLocaleTimeString('en-US', { 
                hour: '2-digit', 
                minute: '2-digit',
                hour12: true 
            });

            // Show confirmation dialog before proceeding
            const confirmation = await Swal.fire({
                icon: 'question',
                title: 'Confirm Booking',
                html: `
                    <p class="mb-3">Would you like to proceed with payment for this booking?</p>
                    <div style="text-align: left; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #0079D4;">
                        <p style="margin: 5px 0;"><strong>Date:</strong> ${formattedDate}</p>
                        <p style="margin: 5px 0;"><strong>Time:</strong> ${formattedTime}</p>
                        <p style="margin: 5px 0;"><strong>Amount:</strong> ${{ $trainer->price ?? 0 }}</p>
                    </div>
                    <p class="mt-3 text-sm">After payment is completed, your booking will be confirmed and saved to the database.</p>
                `,
                showCancelButton: true,
                confirmButtonText: 'Yes, Proceed to Payment',
                cancelButtonText: 'No, Cancel',
                confirmButtonColor: '#0079D4',
                cancelButtonColor: '#dc3545',
                reverseButtons: true,
                focusConfirm: false
            });

            // If user clicked cancel, don't proceed
            if (!confirmation.isConfirmed) {
                // Clear inputs if cancelled
                if (dateInput) dateInput.value = '';
                if (timeInput) timeInput.value = '';
                    return;
                }

            // Disable submit button and show loading
            if (submitBtn) submitBtn.disabled = true;
            if (submitText) submitText.style.display = 'none';
            if (submitLoader) submitLoader.style.display = 'inline-block';

            // Get form data
            const formData = new FormData(form);

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // If there's a redirect URL, it means payment is required - redirect to Stripe
                    if (data.redirect_url) {
                        // Show message before redirecting to Stripe
                        Swal.fire({
                            icon: 'info',
                            title: 'Redirecting to Payment',
                            html: `
                                <p><strong>You are being redirected to the Stripe payment page.</strong></p>
                                <p class="mt-2">After payment is completed, your booking will be confirmed and updated in Google Calendar.</p>
                                <div style="text-align: left; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #0079D4;">
                                    <p style="margin: 5px 0;"><strong>Date:</strong> ${formattedDate}</p>
                                    <p style="margin: 5px 0;"><strong>Time:</strong> ${formattedTime}</p>
                                    <p style="margin: 5px 0;"><strong>Amount to Pay:</strong> ${{ $trainer->price ?? 0 }}</p>
                                </div>
                            `,
                            confirmButtonText: 'Proceed to Payment',
                            confirmButtonColor: '#0079D4',
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then(() => {
                            // Redirect to Stripe payment
                            window.location.href = data.redirect_url;
                        });
                    } else {
                        // For free appointments, show confirmation directly
                        const bookingConfirmed = await Swal.fire({
                            icon: 'success',
                            title: 'Booking Confirmed!',
                            html: `
                                <p>${data.message || 'Your appointment has been confirmed successfully!'}</p>
                                <div style="text-align: left; margin-top: 15px; padding: 15px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                                    <p style="margin: 5px 0;"><strong>Date:</strong> ${formattedDate}</p>
                                    <p style="margin: 5px 0;"><strong>Time:</strong> ${formattedTime}</p>
                                </div>
                                <p class="mt-3">Would you like to view your appointments?</p>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Yes, View Appointments',
                            cancelButtonText: 'No, Close',
                            confirmButtonColor: '#0079D4',
                            cancelButtonColor: '#6c757d',
                            reverseButtons: true
                        });

                        if (bookingConfirmed.isConfirmed) {
                            window.location.href = '{{ route("appointments.index") }}';
                        } else {
                            // Reset form
                            form.reset();
                            if (dateInput) dateInput.value = '';
                            if (timeInput) timeInput.value = '';
                            if (timezoneInput) timezoneInput.value = timezone;
                        }
                    }
                } else {
                    // Show error alert with validation errors if available
                    let errorMessage = data.message || 'Something went wrong. Please try again.';
                    
                    if (data.errors) {
                        const errorList = Object.values(data.errors).flat().join('<br>');
                        errorMessage = errorList;
                    }
                    
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: errorMessage,
                        confirmButtonColor: '#0079D4'
                    });
                }
            } catch (error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.',
                    confirmButtonColor: '#0079D4'
                });
            } finally {
                // Re-enable submit button
                if (submitBtn) submitBtn.disabled = false;
                if (submitText) submitText.style.display = 'inline';
                if (submitLoader) submitLoader.style.display = 'none';
            }
        });
    });
})();
</script>
 


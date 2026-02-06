@php
    if (Auth::check()) {
        if (Auth::user()->hasRole('Admin')) {
            $layout = 'layouts.admin.app';
        } else if (Auth::user()->hasRole('Member')) {
            $layout = 'layouts.member.app';
        } else {
            $layout = 'layouts.website.master';
        }
    } else {
        $layout = 'layouts.website.master';
    }
@endphp
@extends($layout)
@section('title', $page_title)
<style>
    /* Clean professional styles */
    .bg-gradient-to-r {
        background: linear-gradient(to right, var(--tw-gradient-stops));
    }
    
    .from-blue-600 {
        --tw-gradient-from: #2563eb;
        --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(37, 99, 235, 0));
    }
    
    .to-indigo-700 {
        --tw-gradient-to: #4338ca;
    }
    
    /* Clean shadows */
    .shadow-lg {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }
    
    /* Clean rounded corners */
    .rounded-xl {
        border-radius: 0.75rem;
    }
    
    .rounded-2xl {
        border-radius: 1rem;
    }
    
    /* Clean spacing */
    .p-6 {
        padding: 1.5rem;
    }
    
    .p-8 {
        padding: 2rem;
    }
    
    .px-8 {
        padding-left: 2rem;
        padding-right: 2rem;
    }
    
    .py-4 {
        padding-top: 1rem;
        padding-bottom: 1rem;
    }
    
    .py-6 {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }
    
    .py-12 {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
    
    .py-16 {
        padding-top: 4rem;
        padding-bottom: 4rem;
    }
    
    .px-6 {
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }
    
    .py-3 {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }
    
    /* Clean margins */
    .mb-4 {
        margin-bottom: 1rem;
    }
    
    .mb-6 {
        margin-bottom: 1.5rem;
    }
    
    .mb-8 {
        margin-bottom: 2rem;
    }
    
    .mb-10 {
        margin-bottom: 2.5rem;
    }
    
    .mt-1 {
        margin-top: 0.25rem;
    }
    
    .mt-2 {
        margin-top: 0.5rem;
    }
    
    .mt-8 {
        margin-top: 2rem;
    }
    
    .ml-2 {
        margin-left: 0.5rem;
    }
    
    .ml-4 {
        margin-left: 1rem;
    }
    
    .mr-2 {
        margin-right: 0.5rem;
    }
    
    .mr-3 {
        margin-right: 0.75rem;
    }
    
    /* Clean text sizes */
    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
    
    .text-lg {
        font-size: 1.125rem;
        line-height: 1.75rem;
    }
    
    .text-xl {
        font-size: 1.25rem;
        line-height: 1.75rem;
    }
    
    .text-2xl {
        font-size: 1.5rem;
        line-height: 2rem;
    }
    
    .text-3xl {
        font-size: 1.875rem;
        line-height: 2.25rem;
    }
    
    .text-5xl {
        font-size: 3rem;
        line-height: 1;
    }
    
    .font-semibold {
        font-weight: 600;
    }
    
    .font-bold {
        font-weight: 700;
    }
    
    /* Clean colors */
    .text-blue-100 {
        color: #dbeafe;
    }
    
    .text-blue-600 {
        color: #2563eb;
    }
    
    .text-gray-500 {
        color: #6b7280;
    }
    
    .text-gray-600 {
        color: #4b5563;
    }
    
    .text-gray-900 {
        color: #111827;
    }
    
    .text-white {
        color: #ffffff;
    }
    
    .text-gray-400 {
        color: #9ca3af;
    }
    
    .text-green-600 {
        color: #059669;
    }
    
    .text-green-800 {
        color: #065f46;
    }
    
    .text-orange-600 {
        color: #ea580c;
    }
    
    .text-orange-800 {
        color: #9a3412;
    }
    
    .text-purple-600 {
        color: #9333ea;
    }
    
    .text-red-600 {
        color: #dc2626;
    }
    
    /* Clean background colors */
    .bg-white {
        background-color: #ffffff;
    }
    
    .bg-gray-50 {
        background-color: #f9fafb;
    }
    
    .bg-gray-100 {
        background-color: #f3f4f6;
    }
    
    .bg-blue-100 {
        background-color: #dbeafe;
    }
    
    .bg-green-100 {
        background-color: #d1fae5;
    }
    
    .bg-orange-100 {
        background-color: #fed7aa;
    }
    
    .bg-purple-100 {
        background-color: #f3e8ff;
    }
    
    .bg-red-100 {
        background-color: #fee2e2;
    }
    
    .bg-green-50 {
        background-color: #f0fdf4;
    }
    
    .bg-red-50 {
        background-color: #fef2f2;
    }
    
    /* Clean border colors */
    .border {
        border-width: 1px;
    }
    
    .border-gray-100 {
        border-color: #f3f4f6;
    }
    
    .border-gray-200 {
        border-color: #e5e7eb;
    }
    
    .border-green-200 {
        border-color: #bbf7d0;
    }
    
    .border-red-200 {
        border-color: #fecaca;
    }
    
    /* Clean rounded corners */
    .rounded-lg {
        border-radius: 0.5rem;
    }
    
    .rounded-xl {
        border-radius: 0.75rem;
    }
    
    .rounded-2xl {
        border-radius: 1rem;
    }
    
    .rounded-full {
        border-radius: 9999px;
    }
    
    /* Clean dimensions */
    .w-10 {
        width: 2.5rem;
    }
    
    .h-10 {
        height: 2.5rem;
    }
    
    .w-14 {
        width: 3.5rem;
    }
    
    .h-14 {
        height: 3.5rem;
    }
    
    .w-16 {
        width: 4rem;
    }
    
    .h-16 {
        height: 4rem;
    }
    
    .w-20 {
        width: 5rem;
    }
    
    .h-20 {
        height: 5rem;
    }
    
    /* Clean transitions */
    .transition-colors {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }
    
    .transition-all {
        transition-property: all;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }
    
    /* Clean hover effects */
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
    
    .hover\:bg-blue-200:hover {
        background-color: #bfdbfe;
    }
    
    .hover\:bg-green-200:hover {
        background-color: #bbf7d0;
    }
    
    .hover\:bg-red-200:hover {
        background-color: #fecaca;
    }
    
    .hover\:bg-blue-700:hover {
        background-color: #1d4ed8;
    }
    
    .hover\:bg-gray-50:hover {
        background-color: #f9fafb;
    }
    
    /* Clean grid utilities */
    .grid {
        display: grid;
    }
    
    .grid-cols-1 {
        grid-template-columns: repeat(1, minmax(0, 1fr));
    }
    
    @media (min-width: 768px) {
        .md\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        
        .md\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
    
    @media (min-width: 1024px) {
        .lg\:grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
    
    .gap-6 {
        gap: 1.5rem;
    }
    
    /* Clean flex utilities */
    .flex {
        display: flex;
    }
    
    .items-center {
        align-items: center;
    }
    
    .items-start {
        align-items: flex-start;
    }
    
    .justify-between {
        justify-content: space-between;
    }
    
    .space-x-2 > * + * {
        margin-left: 0.5rem;
    }
    
    .space-x-3 > * + * {
        margin-left: 0.75rem;
    }
    
    .space-x-4 > * + * {
        margin-left: 1rem;
    }
    
    .space-x-6 > * + * {
        margin-left: 1.5rem;
    }
    
    .space-y-4 > * + * {
        margin-top: 1rem;
    }
    
    /* Clean text utilities */
    .font-medium {
        font-weight: 500;
    }
    
    .font-semibold {
        font-weight: 600;
    }
    
    .font-bold {
        font-weight: 700;
    }
    
    /* Clean responsive utilities */
    @media (min-width: 640px) {
        .sm\:px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }
    }
    
    @media (min-width: 768px) {
        .md\:grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        
        .md\:grid-cols-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }
    
    @media (min-width: 1024px) {
        .lg\:grid-cols-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }
    }
    
    /* Clean max width utilities */
    .max-w-7xl {
        max-width: 165rem;
    }
    
    .max-w-md {
        max-width: 28rem;
    }
    
    /* Clean container */
    .container {
        width: 100%;
    }
    
    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }
    
    /* Clean overflow utilities */
    .overflow-hidden {
        overflow: hidden;
    }
    
    /* Clean divide utilities */
    .divide-y > * + * {
        border-top-width: 1px;
    }
    
    .divide-gray-100 > * + * {
        border-color: #f3f4f6;
    }
    
    /* Clean truncate utility */
    .truncate {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    
    /* Clean inline utilities */
    .inline-flex {
        display: inline-flex;
    }
    
    /* Clean object fit utilities */
    .object-cover {
        object-fit: cover;
    }
    
    /* Clean hidden utility */
    .hidden {
        display: none;
    }
    
    /* Clean text center utility */
    .text-center {
        text-align: center;
    }
    
    /* Clean text right utility */
    .text-right {
        text-align: right;
    }
    
    /* Clean inline utilities for badges */
    .inline-flex {
        display: inline-flex;
    }
    
    /* Clean padding utilities for badges */
    .px-3 {
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }
    
    .py-1 {
        padding-top: 0.25rem;
        padding-bottom: 0.25rem;
    }
    
    /* Clean text size for badges */
    .text-sm {
        font-size: 0.875rem;
        line-height: 1.25rem;
    }
    
    /* Clean font weight for badges */
    .font-semibold {
        font-weight: 600;
    }
    
    /* Clean border radius for badges */
    .rounded-full {
        border-radius: 9999px;
    }
    
    /* Clean text colors for badges */
    .text-green-800 {
        color: #065f46;
    }
    
    .text-orange-800 {
        color: #9a3412;
    }
    
    /* Clean background colors for badges */
    .bg-green-100 {
        background-color: #d1fae5;
    }
    
    .bg-orange-100 {
        background-color: #fed7aa;
    }
    
    /* Clean border colors for badges */
    .border-green-200 {
        border-color: #bbf7d0;
    }
    
    .border-red-200 {
        border-color: #fecaca;
    }
    </style>
@section('content')
<!-- Clean Professional Header -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-8 py-16">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-2xl mb-8" style="justify-content: center;">
                <i class="fas fa-calendar-check text-3xl text-white"></i>
            </div>
            <h1 class="text-6xl font-bold mb-8">{{ $page_title }}</h1>
            <p class="text-2xl text-blue-100 mb-12 max-w-4xl mx-auto">
                {{ Auth::check() && Auth::user()->hasRole('Admin') ? 'Manage all user appointments and their status' : 'Manage your fitness appointments with our professional trainers' }}
            </p>
            <a href="{{ route('trainers') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 text-lg font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-lg">
                <i class="fas fa-plus mr-3"></i>
                Book Appointment
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-8 py-12">
    <!-- Alert Messages -->
        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 rounded-xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-green-800">Success!</h3>
                    <p class="text-green-700 mt-1">{{ session('success') }}</p>
                </div>
            </div>
            </div>
        @endif
    
        @if(session('error'))
        <div class="mb-8 bg-red-50 border border-red-200 rounded-xl p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-triangle text-red-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-red-800">Error!</h3>
                    <p class="text-red-700 mt-1">{{ session('error') }}</p>
                </div>
            </div>
            </div>
        @endif

    <!-- Clean Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-blue-100 rounded-xl flex items-center justify-center" style="justify-content: center;">
                        <i class="fas fa-calendar text-blue-600 w-full flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-600">Total Bookings</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $models->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center" style="justify-content: center;">
                        <i class="fas fa-check text-green-600 text-2xl flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-600">Confirmed</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $models->where('status', 'confirmed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-16 h-16 bg-orange-100 rounded-xl flex items-center justify-center" style="justify-content: center;">
                        <i class="fas fa-clock text-orange-600 text-2xl flex items-center justify-center"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-600">Pending</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $models->where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="">
                    <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center" style="justify-content: center;">
                        <i class="fas fa-dollar-sign text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-base font-medium text-gray-600">Total Spent</p>
                    <p class="text-3xl font-bold text-gray-900">${{ number_format($models->sum('price'), 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Clean Appointments Section -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900">{{ Auth::check() && Auth::user()->hasRole('Admin') ? 'All Appointment Bookings' : 'My Appointment Bookings' }}</h2>
                    <p class="text-lg text-gray-600 mt-2">{{ Auth::check() && Auth::user()->hasRole('Admin') ? 'All scheduled training sessions and their current status' : 'Your scheduled training sessions and their current status' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Last updated</p>
                    <p class="text-sm font-medium text-gray-900">{{ now()->format('M d, Y g:i A') }}</p>
                </div>
            </div>
        </div>
        
        @if($models->count() > 0)
            <div class="divide-y divide-gray-100">
                @foreach($models as $appointment)
                    <div class="p-8 hover:bg-gray-50 transition-colors duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-6">
                                <div class="flex-shrink-0">
                                    @if($appointment->trainer)
                                        <img class="w-16 h-16 rounded-xl object-cover border-2 border-gray-200" 
                                             src="{{ asset('admin/assets/images/Trainers/'.$appointment->trainer->image) }}" 
                                             alt="{{ $appointment->trainer->name }}">
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gray-200 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400 text-xl"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4 mb-4">
                                        <h3 class="text-2xl font-bold text-gray-900">
                                            @if($appointment->trainer)
                                                {{ $appointment->trainer->name }}
                                            @else
                                                Trainer not assigned
                                            @endif
                                        </h3>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                            @if($appointment->status == 'cancelled') bg-red-100 text-red-800
                                            @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                            @elseif($appointment->status == 'confirmed') bg-green-100 text-green-800
                                            @elseif($appointment->status == 'pending') bg-orange-100 text-orange-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($appointment->status) }}
                                    </span>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                                <i class="fas fa-calendar text-blue-600 flex items-center justify-center"></i>
                                            </div>
                                            <div>
                                                <p class="text-base text-gray-500">Appointment Date</p>
                                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                                <i class="fas fa-clock text-green-600 flex items-center justify-center"></i>
                                            </div>
                                            <div>
                                                <p class="text-base text-gray-500">Time</p>
                                                @php
                                                    $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                                                    $dayOfWeek = \Carbon\Carbon::parse($appointment->appointment_date)->dayOfWeek;
                                                    $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                                                        ->where('day_of_week', $dayOfWeek)
                                                        ->where('is_active', true)
                                                        ->first();
                                                    $sessionDuration = (int) ($availability->session_duration ?? 60);
                                                    $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                                @endphp
                                                <p class="font-semibold text-gray-900">{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</p>
                                            </div>
                                        </div>
                                        
                                        <div class="flex items-center space-x-3">
                                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                                <i class="fas fa-globe text-purple-600 flex items-center justify-center"></i>
                                            </div>
                                            <div>
                                                <p class="text-base text-gray-500">Timezone</p>
                                                <p class="font-semibold text-gray-900">{{ $appointment->time_zone }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center space-x-6 text-base text-gray-500">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-user text-gray-400"></i>
                                            <span>Booked by: <span class="font-medium text-gray-900">
                                                @if(Auth::check() && Auth::user()->hasRole('Admin'))
                                                    {{ $appointment->user ? $appointment->user->name : ($appointment->name ?? 'Guest') }}
                                                @else
                                                    {{ Auth::check() ? Auth::user()->name : ($appointment->name ?? 'Guest') }}
                                                @endif
                                            </span></span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-calendar-plus text-gray-400"></i>
                                            <span>Booked on: <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y') }}</span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex flex-col items-end space-y-4">
                                <div class="text-right">
                                    <p class="text-3xl font-bold text-gray-900">${{ number_format($appointment->price, 2) }}</p>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold mt-2
                                        @if($appointment->payment_status == 'cancelled') bg-red-100 text-red-800
                                        @elseif($appointment->payment_status == 'completed') bg-green-100 text-green-800
                                        @elseif($appointment->payment_status == 'pending') bg-orange-100 text-orange-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <a href="{{ route('appointments.show', $appointment->id) }}" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors duration-200" title="View Details" style="justify-content: center;">
                                        <i class="fas fa-eye text-blue-600 flex items-center justify-center"></i>
                                    </a>
                                    @if($appointment->status == 'pending' && Auth::check() && Auth::user()->hasRole('Admin'))
                                        <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-green-100 hover:bg-green-200 rounded-lg flex items-center justify-center transition-colors duration-200 confirm-btn" title="Confirm" data-message="Are you sure you want to confirm this appointment?">
                                                <i class="fas fa-check text-green-600 flex items-center justify-center"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($appointment->status == 'confirmed' && Auth::check() && Auth::user()->hasRole('Admin'))
                                        <form method="POST" action="{{ route('appointments.complete', $appointment->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-blue-100 hover:bg-blue-200 rounded-lg flex items-center justify-center transition-colors duration-200 confirm-btn" title="Mark as Completed" data-message="Are you sure you want to mark this appointment as completed?">
                                                <i class="fas fa-check-double text-blue-600 flex items-center justify-center"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($appointment->status == 'pending' && Auth::check() && Auth::user()->hasRole('Admin'))
                                        <form method="POST" action="{{ route('appointments.complete', $appointment->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-purple-100 hover:bg-purple-200 rounded-lg flex items-center justify-center transition-colors duration-200 confirm-btn" title="Mark as Completed" data-message="Are you sure you want to mark this appointment as completed?">
                                                <i class="fas fa-flag-checkered text-purple-600 flex items-center justify-center"></i>
                                            </button>
                                        </form>
                                    @endif
                                    @if($appointment->status != 'cancelled' && $appointment->status != 'completed')
                                        <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}" class="inline">
                                            @csrf
                                            <button type="submit" class="w-10 h-10 bg-red-100 hover:bg-red-200 rounded-lg flex items-center justify-center transition-colors duration-200 confirm-btn" title="Cancel" data-message="Are you sure you want to cancel this appointment?">
                                                <i class="fas fa-times text-red-600 flex items-center justify-center"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-16">
                <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100 mb-6">
                    <i class="fas fa-calendar-times text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-4">No appointments booked</h3>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">You haven't booked any appointments yet. Start your fitness journey by booking your first session.</p>
                <a href="{{ route('trainers') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors duration-200">
                    <i class="fas fa-plus mr-2"></i>
                    Book Your First Appointment
                </a>
            </div>
        @endif
    </div>

    <!-- Pagination -->
    @if($models->hasPages())
        <div class="bg-white rounded-xl shadow-lg px-8 py-6 mt-8 border border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing <span class="font-semibold">{{ $models->firstItem() ?? 0 }}</span> to <span class="font-semibold">{{ $models->lastItem() ?? 0 }}</span> of <span class="font-semibold">{{ $models->total() }}</span> results
                    </p>
                </div>
                <div class="flex items-center space-x-2">
                {{ $models->links() }}
                </div>
            </div>
        </div>
    @endif
    </div>

<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle all confirmation buttons
    document.querySelectorAll('.confirm-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const form = this.closest('form');
            const message = this.getAttribute('data-message');
            const action = this.getAttribute('title');
            
            // Determine icon and color based on action
            let icon = 'question';
            let confirmButtonColor = '#3b82f6';
            
            if (action.includes('Confirm')) {
                icon = 'success';
                confirmButtonColor = '#10b981';
            } else if (action.includes('Complete')) {
                icon = 'info';
                confirmButtonColor = '#8b5cf6';
            } else if (action.includes('Cancel')) {
                icon = 'warning';
                confirmButtonColor = '#ef4444';
            }
            
            Swal.fire({
                title: 'Confirm Action',
                text: message,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: confirmButtonColor,
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, proceed!',
                cancelButtonText: 'Cancel',
                reverseButtons: true,
                customClass: {
                    popup: 'rounded-xl shadow-2xl',
                    title: 'text-xl font-bold text-gray-900',
                    content: 'text-gray-700',
                    confirmButton: 'rounded-lg px-6 py-3 font-semibold',
                    cancelButton: 'rounded-lg px-6 py-3 font-semibold'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    
    // Show success/error messages with SweetAlert
    @if(session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#10b981',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded-xl shadow-2xl',
                title: 'text-xl font-bold text-gray-900',
                content: 'text-gray-700',
                confirmButton: 'rounded-lg px-6 py-3 font-semibold'
            }
        });
    @endif
    
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonColor: '#ef4444',
            confirmButtonText: 'OK',
            customClass: {
                popup: 'rounded-xl shadow-2xl',
                title: 'text-xl font-bold text-gray-900',
                content: 'text-gray-700',
                confirmButton: 'rounded-lg px-6 py-3 font-semibold'
            }
        });
    @endif
});
</script>


@endsection


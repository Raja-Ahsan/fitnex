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

@section('content')
<!-- Clean Professional Header -->
<div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-8 py-16">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 rounded-2xl mb-8">
                <i class="fas fa-calendar-check text-3xl text-white"></i>
            </div>
            <h1 class="text-6xl font-bold mb-8">{{ $page_title }}</h1>
            <p class="text-2xl text-blue-100 mb-12 max-w-4xl mx-auto">
                Detailed information about your appointment
            </p>
            <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-8 py-4 bg-white text-blue-600 text-lg font-semibold rounded-xl hover:bg-gray-50 transition-all duration-300 shadow-lg">
                <i class="fas fa-arrow-left mr-3"></i>
                Back to Appointments
            </a>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="max-w-7xl mx-auto px-8 py-12">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200">
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Appointment Details</h2>
                    <p class="text-gray-600 mt-1">Complete information about your training session</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-500">Appointment ID</p>
                    <p class="text-sm font-medium text-gray-900">#{{ $appointment->id }}</p>
                </div>
            </div>
        </div>
        
        <div class="p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Left Column - Trainer Information -->
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-8">Trainer Information</h3>
                    
                    <div class="bg-gray-50 rounded-xl p-8 mb-8">
                        <div class="flex items-center space-x-6">
                            @if($appointment->trainer)
                                <img class="w-24 h-24 rounded-xl object-cover border-2 border-gray-200" 
                                     src="{{ asset('admin/assets/images/Trainers/'.$appointment->trainer->image) }}" 
                                     alt="{{ $appointment->trainer->name }}" style="width: 100px; height: 100px;">
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-900" style="margin-left: 25px;">{{ $appointment->trainer->name }}</h4>
                                    <p class="text-base text-gray-500 mt-3" style="margin-left: 25px;">{{ $appointment->trainer->experience ?? 'Professional' }} Trainer</p>
                                    <h4 class="text-lg font-semibold text-gray-900 mb-4" style="margin-left: 25px;">Specialization</h4>
                                    <div class="text-gray-600 mt-2">
                                        @php
                                            $specialization = $appointment->trainer->specialization ?? 'Fitness Trainer';
                                            if (is_string($specialization) && is_array(json_decode($specialization, true))) {
                                                $specs = json_decode($specialization, true);
                                                if (is_array($specs) && count($specs) > 0) {
                                                    echo '<ul class="list-disc list-inside space-y-1 mt-2">';
                                                    foreach ($specs as $spec) {
                                                        echo '<li class="text-base">' . htmlspecialchars($spec) . '</li>';
                                                    }
                                                    echo '</ul>';
                                                } else {
                                                    echo 'Fitness Trainer';
                                                }
                                            } else {
                                                echo $specialization;
                                            }
                                        @endphp
                                    </div>
                                    
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-xl bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-3xl"></i>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-bold text-gray-900">Trainer not assigned</h4>
                                    <p class="text-lg text-gray-600">No trainer information available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                <i class="fas fa-calendar text-blue-600 w-full flex items-center justify-center"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Appointment Date</p>
                                <p class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                <i class="fas fa-clock text-green-600 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Appointment Time</p>
                                @php
                                    $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                                    $dayOfWeek = \Carbon\Carbon::parse($appointment->appointment_date)->dayOfWeek;
                                    $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                                        ->where('day_of_week', $dayOfWeek)
                                        ->where('is_active', true)
                                        ->first();
                                    $sessionDuration = (int) ($availability->session_duration ?? 60); // Cast to int
                                    $endTime = $startTime->copy()->addMinutes($sessionDuration);
                                @endphp
                                <p class="font-semibold text-gray-900">{{ $startTime->format('h:i A') }} - {{ $endTime->format('h:i A') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center" style="justify-content: center;">
                                <i class="fas fa-globe text-purple-600 flex items-center justify-center"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Timezone</p>
                                <p class="font-semibold text-gray-900">{{ $appointment->time_zone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Status and Payment -->
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Status & Payment</h3>
                    
                    <div class="space-y-6">
                        <!-- Status Card -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Appointment Status</h4>
                            <div class="flex items-center space-x-3">
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                    @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                                    @elseif($appointment->status == 'pending') bg-orange-100 text-orange-800
                                    @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                                    @else bg-red-100 text-red-800 @endif">
                                    <i class="fas fa-circle mr-2"></i>
                                    {{ ucfirst($appointment->status) }}
                                </span>
                                <p class="text-sm text-gray-600">
                                    @if($appointment->status == 'confirmed')
                                        Your appointment is confirmed and ready
                                    @elseif($appointment->status == 'pending')
                                        Waiting for confirmation
                                    @elseif($appointment->status == 'completed')
                                        Session completed successfully
                                    @else
                                        Appointment has been cancelled
                                    @endif
                                </p>
                            </div>
                        </div>
                        
                        <!-- Payment Card -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Payment Information</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Amount:</span>
                                    <span class="text-2xl font-bold text-gray-900">${{ number_format($appointment->price, 2) }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Payment Status:</span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold
                                        @if($appointment->payment_status == 'completed') bg-green-100 text-green-800
                                        @elseif($appointment->payment_status == 'pending') bg-orange-100 text-orange-800
                                        @elseif($appointment->payment_status == 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($appointment->payment_status) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Booking Information -->
                        <div class="bg-gray-50 rounded-xl p-6">
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Booking Information</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Booked by:</span>
                                    <span class="font-semibold text-gray-900">{{ $appointment->user ? $appointment->user->name : $appointment->name }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Booked on:</span>
                                    <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->created_at)->format('M d, Y g:i A') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Last updated:</span>
                                    <span class="font-semibold text-gray-900">{{ \Carbon\Carbon::parse($appointment->updated_at)->format('M d, Y g:i A') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Description Section -->
            @if($appointment->description)
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Session Description</h3>
                <div class="bg-gray-50 rounded-xl p-6">
                    <p class="text-gray-700 leading-relaxed">{{ $appointment->description }}</p>
                </div>
	</div>
            @endif
            
            <!-- Action Buttons -->
            <div class="mt-8 pt-8 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('appointments.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Back to List
                        </a>
                        
                        @if($appointment->status == 'pending' && Auth::check() && Auth::user()->hasRole('Admin'))
                            <form method="POST" action="{{ route('appointments.confirm', $appointment->id) }}" class="inline">
                                @csrf
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition-colors duration-200 confirm-btn" data-message="Are you sure you want to confirm this appointment?">
                                    <i class="fas fa-check mr-2"></i>
                                    Confirm Appointment
                                </button>
                            </form>
                        @endif
	</div>
                    
                    @if($appointment->status != 'cancelled' && $appointment->status != 'completed')
                        <form method="POST" action="{{ route('appointments.cancel', $appointment->id) }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition-colors duration-200 confirm-btn" data-message="Are you sure you want to cancel this appointment?">
                                <i class="fas fa-times mr-2"></i>
                                Cancel Appointment
                            </button>
                        </form>
                    @endif
                </div>
				</div>
			</div>
		</div>
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
            const action = this.textContent.trim();
            
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

.rounded-lg {
    border-radius: 0.5rem;
}

.rounded-full {
    border-radius: 9999px;
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

.mt-8 {
    margin-top: 2rem;
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

.text-gray-700 {
    color: #374151;
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

.bg-green-600 {
    background-color: #059669;
}

.bg-red-600 {
    background-color: #dc2626;
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

/* Clean grid utilities */
.grid {
    display: grid;
}

.grid-cols-1 {
    grid-template-columns: repeat(1, minmax(0, 1fr));
}

@media (min-width: 1024px) {
    .lg\:grid-cols-2 {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
}

.gap-8 {
    gap: 2rem;
}

/* Clean flex utilities */
.flex {
    display: flex;
}

.items-center {
    align-items: center;
}

.justify-between {
    justify-content: space-between;
}

.space-x-3 > * + * {
    margin-left: 0.75rem;
}

.space-x-4 > * + * {
    margin-left: 1rem;
}

.space-y-3 > * + * {
    margin-top: 0.75rem;
}

.space-y-4 > * + * {
    margin-top: 1rem;
}

.space-y-6 > * + * {
    margin-top: 1.5rem;
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

/* Clean max width utilities */
.max-w-7xl {
    max-width: 165rem;
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

/* Clean inline utilities */
.inline-flex {
    display: inline-flex;
}

.inline {
    display: inline;
}

/* Clean object fit utilities */
.object-cover {
    object-fit: cover;
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

.px-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.py-1 {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}

.py-2 {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
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

.text-gray-800 {
    color: #1f2937;
}

/* Clean background colors for badges */
.bg-green-100 {
    background-color: #d1fae5;
}

.bg-orange-100 {
    background-color: #fed7aa;
}

.bg-gray-100 {
    background-color: #f3f4f6;
}

/* Clean border colors for badges */
.border-green-200 {
    border-color: #bbf7d0;
}

.border-red-200 {
    border-color: #fecaca;
}

/* Clean hover effects */
.hover\:bg-gray-50:hover {
    background-color: #f9fafb;
}

.hover\:bg-gray-200:hover {
    background-color: #e5e7eb;
}

.hover\:bg-green-700:hover {
    background-color: #047857;
}

.hover\:bg-red-700:hover {
    background-color: #b91c1c;
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

/* Clean dimensions */
.w-12 {
    width: 3rem;
}

.h-12 {
    height: 3rem;
}

.w-20 {
    width: 5rem;
}

.h-20 {
    height: 5rem;
}

/* Clean leading utilities */
.leading-relaxed {
    line-height: 1.625;
}
</style>
@endsection
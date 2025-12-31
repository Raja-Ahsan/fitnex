@extends('layouts.website.master')
@section('title', 'Payment Successful')

@section('content')
<section class="py-16 bg-black text-white min-h-screen flex items-center justify-center">
    <div class="container">
        <div class="max-w-2xl mx-auto text-center">
            <!-- Success Icon -->
            <div class="mb-8">
                <div class="inline-flex items-center justify-center w-24 h-24 bg-green-500 rounded-full mb-6">
                    <i class="fas fa-check text-4xl text-white"></i>
                </div>
            </div>
            
            <!-- Success Message -->
            <h1 class="text-4xl font-bold mb-4 text-white">Payment Successful!</h1>
            <p class="text-xl text-gray-300 mb-8">Thank you for booking your appointment.</p>
            
            <!-- Appointment Details -->
            @if(isset($appointment) && $appointment)
            <div class="bg-gray-800 rounded-xl p-6 mb-8 text-left">
                <h3 class="text-2xl font-bold mb-4 text-white">Appointment Details</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <i class="fas fa-user text-blue-400 mr-3 w-6"></i>
                        <span class="text-gray-300"><strong class="text-white">Trainer:</strong> {{ $appointment->trainer->name ?? 'N/A' }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-calendar text-blue-400 mr-3 w-6"></i>
                        <span class="text-gray-300"><strong class="text-white">Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-clock text-blue-400 mr-3 w-6"></i>
                        <span class="text-gray-300">
                            <strong class="text-white">Time:</strong> 
                            @php
                                $startTime = \Carbon\Carbon::parse($appointment->appointment_time);
                                // Get session duration from trainer's availability for this day
                                $dayOfWeek = \Carbon\Carbon::parse($appointment->appointment_date)->dayOfWeek;
                                $availability = \App\Models\Availability::where('trainer_id', $appointment->trainer_id)
                                    ->where('day_of_week', $dayOfWeek)
                                    ->where('is_active', true)
                                    ->first();
                                $sessionDuration = (int) ($availability->session_duration ?? 60); // Default to 60 minutes, cast to int
                                $endTime = $startTime->copy()->addMinutes($sessionDuration);
                            @endphp
                            {{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-dollar-sign text-blue-400 mr-3 w-6"></i>
                        <span class="text-gray-300"><strong class="text-white">Amount:</strong> ${{ number_format($appointment->price, 2) }}</span>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('index') }}" class="inline-flex items-center justify-center px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Back to Home
                </a>
                <a href="{{ route('trainers') }}" class="inline-flex items-center justify-center px-8 py-3 bg-gray-700 text-white font-semibold rounded-lg hover:bg-gray-600 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Book Another Appointment
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
{{-- <script>
document.addEventListener('DOMContentLoaded', function() {
    // Show SweetAlert automatically when page loads
    Swal.fire({
        icon: 'success',
        title: 'Payment Successful!',
        html: `
            <div style="text-align: left; margin-top: 20px; padding: 20px; background-color: #f8f9fa; border-radius: 8px; border-left: 4px solid #28a745;">
                <p style="margin: 10px 0; font-size: 16px;"><strong>Thank you for your booking!</strong></p>
                <p style="margin: 10px 0; color: #6c757d;">Your appointment has been confirmed and a confirmation email has been sent to you.</p>
                @if(isset($appointment) && $appointment)
                <div style="margin-top: 15px; padding-top: 15px; border-top: 1px solid #dee2e6;">
                    <p style="margin: 5px 0;"><strong>Trainer:</strong> {{ $appointment->trainer->name ?? 'N/A' }}</p>
                    <p style="margin: 5px 0;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</p>
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
                    <p style="margin: 5px 0;"><strong>Time:</strong> {{ $startTime->format('g:i A') }} - {{ $endTime->format('g:i A') }}</p>
                </div>
                @endif
            </div>
        `,
        confirmButtonText: 'Back to Home',
        confirmButtonColor: '#0079D4',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCancelButton: true,
        cancelButtonText: 'Book Another',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route("index") }}';
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            window.location.href = '{{ route("trainers") }}';
        }
    });
});
</script> --}}
@endsection


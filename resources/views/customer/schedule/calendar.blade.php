@extends('layouts.app')

@section('title', 'Book Session with ' . $trainer->name)

@section('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css' rel='stylesheet' />
    <style>
        .fc-event {
            cursor: pointer;
        }

        .fc-event.available-slot {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }

        .fc-event.booked-slot {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            cursor: not-allowed;
        }

        .slot-time-btn {
            margin: 5px;
            min-width: 100px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                @if($trainer->image)
                                    <img src="{{ asset('storage/' . $trainer->image) }}" alt="{{ $trainer->name }}"
                                        class="img-fluid rounded-circle">
                                @else
                                    <img src="{{ asset('images/default-trainer.png') }}" alt="{{ $trainer->name }}"
                                        class="img-fluid rounded-circle">
                                @endif
                            </div>
                            <div class="col-md-10">
                                <h2>{{ $trainer->name }}</h2>
                                <p class="text-muted">{{ $trainer->designation }}</p>
                                <p>{{ $trainer->description }}</p>

                                @if($trainer->pricing->isNotEmpty())
                                    <div class="mt-3">
                                        <h5>Session Pricing:</h5>
                                        @foreach($trainer->pricing as $pricing)
                                            <span class="badge bg-primary me-2">
                                                {{ $pricing->session_duration }} min - ${{ number_format($pricing->price, 2) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Select a Date</h4>
                    </div>
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Available Time Slots</h4>
                    </div>
                    <div class="card-body">
                        <div id="selected-date-display" class="alert alert-info" style="display: none;">
                            <strong>Selected Date:</strong> <span id="selected-date-text"></span>
                        </div>

                        <div id="slots-container">
                            <p class="text-muted text-center">Click on a date in the calendar to view available time slots.
                            </p>
                        </div>

                        <div id="loading-slots" style="display: none;" class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Loading available slots...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Confirmation Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('customer.bookings.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="trainer_id" value="{{ $trainer->id }}">
                        <input type="hidden" name="time_slot_id" id="selected_slot_id">

                        <div class="mb-3">
                            <label class="form-label"><strong>Trainer:</strong></label>
                            <p>{{ $trainer->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Date & Time:</strong></label>
                            <p id="booking-datetime"></p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Price:</strong></label>
                            <p id="booking-price"></p>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes (Optional)</label>
                            <textarea name="notes" id="notes" class="form-control" rows="3"
                                placeholder="Any special requests or notes..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Proceed to Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const trainerId = {{ $trainer->id }};
            const calendarEl = document.getElementById('calendar');
            let selectedDate = null;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                validRange: {
                    start: new Date().toISOString().split('T')[0]
                },
                events: `/api/trainer/${trainerId}/calendar-events`,
                dateClick: function (info) {
                    const clickedDate = info.dateStr;
                    const today = new Date().toISOString().split('T')[0];

                    if (clickedDate < today) {
                        alert('Cannot book slots in the past.');
                        return;
                    }

                    selectedDate = clickedDate;
                    loadAvailableSlots(clickedDate);
                },
                eventClick: function (info) {
                    if (info.event.extendedProps.is_booked) {
                        alert('This slot is already booked.');
                    }
                }
            });

            calendar.render();

            function loadAvailableSlots(date) {
                document.getElementById('loading-slots').style.display = 'block';
                document.getElementById('slots-container').innerHTML = '';
                document.getElementById('selected-date-display').style.display = 'block';
                document.getElementById('selected-date-text').textContent = new Date(date).toLocaleDateString('en-US', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                fetch(`/api/trainer/${trainerId}/available-slots?date=${date}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('loading-slots').style.display = 'none';

                        if (data.slots && data.slots.length > 0) {
                            let slotsHtml = '<div class="d-grid gap-2">';
                            data.slots.forEach(slot => {
                                if (slot.available) {
                                    slotsHtml += `
                                    <button type="button" class="btn btn-outline-success slot-time-btn" 
                                            onclick="selectSlot(${slot.id}, '${slot.time}', '${date}')">
                                        ${slot.time}
                                    </button>
                                `;
                                }
                            });
                            slotsHtml += '</div>';
                            document.getElementById('slots-container').innerHTML = slotsHtml;
                        } else {
                            document.getElementById('slots-container').innerHTML =
                                '<p class="text-muted text-center">No available slots for this date.</p>';
                        }
                    })
                    .catch(error => {
                        document.getElementById('loading-slots').style.display = 'none';
                        document.getElementById('slots-container').innerHTML =
                            '<p class="text-danger text-center">Error loading slots. Please try again.</p>';
                        console.error('Error:', error);
                    });
            }

            window.selectSlot = function (slotId, time, date) {
                document.getElementById('selected_slot_id').value = slotId;
                document.getElementById('booking-datetime').textContent = `${new Date(date).toLocaleDateString()} at ${time}`;
                document.getElementById('booking-price').textContent = 'Will be calculated based on session duration';

                const modal = new bootstrap.Modal(document.getElementById('bookingModal'));
                modal.show();
            };
        });
    </script>
@endsection
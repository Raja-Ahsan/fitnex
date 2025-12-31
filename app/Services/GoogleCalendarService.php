<?php

namespace App\Services;

use Spatie\GoogleCalendar\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    /**
     * Get available time slots from Google Calendar for a specific date
     * 
     * @param string $calendarId The Google Calendar ID
     * @param string $date Date in Y-m-d format
     * @param string $startTime Start time in H:i format (default: 09:00)
     * @param string $endTime End time in H:i format (default: 17:00)
     * @param int $slotDuration Slot duration in minutes (default: 30)
     * @return array Array of available time slots in H:i format
     */
    public function getAvailableSlots($calendarId, $date, $startTime = '09:00', $endTime = '17:00', $slotDuration = 30)
    {
        try {
            if (!$calendarId) {
                Log::info("No Google Calendar ID provided, returning all slots as available");
                // If no calendar ID, return all slots as available
                return $this->generateAllSlots($startTime, $endTime, $slotDuration);
            }

            // Format calendar ID to ensure correct format
            $formattedCalendarId = $this->formatCalendarId($calendarId);
            Log::info("Fetching available slots from Google Calendar", [
                'original_calendar_id' => $calendarId,
                'formatted_calendar_id' => $formattedCalendarId,
                'date' => $date,
                'start_time' => $startTime,
                'end_time' => $endTime
            ]);

            // Get start and end datetime for the date
            $startDateTime = Carbon::parse($date . ' ' . $startTime);
            $endDateTime = Carbon::parse($date . ' ' . $endTime);
            
            // Fetch events from Google Calendar using the formatted calendar ID
            try {
                $events = Event::get($startDateTime, $endDateTime, [], $formattedCalendarId);
            } catch (\Exception $fetchException) {
                Log::error("Failed to fetch events from Google Calendar", [
                    'calendar_id' => $formattedCalendarId,
                    'date' => $date,
                    'error' => $fetchException->getMessage()
                ]);
                // Return all slots as available if we can't fetch events (fallback behavior)
                return $this->generateAllSlots($startTime, $endTime, $slotDuration);
            }
            
            Log::info("Fetched events from Google Calendar", [
                'calendar_id' => $formattedCalendarId,
                'date' => $date,
                'event_count' => count($events),
                'start_datetime' => $startDateTime->toDateTimeString(),
                'end_datetime' => $endDateTime->toDateTimeString()
            ]);
            
            // Extract booked times from events
            $bookedSlots = [];
            $dayEvents = [];
            
            foreach ($events as $event) {
                try {
                    // Spatie package uses startDateTime and endDateTime properties
                    $eventStart = Carbon::parse($event->startDateTime);
                    $eventEnd = Carbon::parse($event->endDateTime);
                    
                    // Only consider events on the selected date
                    if ($eventStart->format('Y-m-d') === $date) {
                        $dayEvents[] = [
                            'start' => $eventStart,
                            'end' => $eventEnd
                        ];
                        
                        // Generate slots for this event
                        $current = $eventStart->copy();
                        while ($current->lt($eventEnd)) {
                            $bookedSlots[] = $current->format('H:i');
                            $current->addMinutes($slotDuration);
                        }
                    }
                } catch (\Exception $eventException) {
                    Log::warning("Error processing event: " . $eventException->getMessage());
                    continue;
                }
            }
            
            Log::info("Booked slots extracted", [
                'booked_slots_count' => count(array_unique($bookedSlots)),
                'booked_slots' => array_unique($bookedSlots),
                'day_events_count' => count($dayEvents)
            ]);
            
            // Generate all possible slots
            $allSlots = $this->generateAllSlots($startTime, $endTime, $slotDuration);
            
            // Check if events cover the entire day (indicating the day is not available)
            $dayStart = Carbon::parse($date . ' ' . $startTime);
            $dayEnd = Carbon::parse($date . ' ' . $endTime);
            $totalDayMinutes = $dayStart->diffInMinutes($dayEnd);
            
            // Calculate total booked minutes
            $totalBookedMinutes = 0;
            foreach ($dayEvents as $eventData) {
                $eventStart = $eventData['start'];
                $eventEnd = $eventData['end'];
                
                // Only count minutes within our time range
                $eventStartInRange = max($eventStart, $dayStart);
                $eventEndInRange = min($eventEnd, $dayEnd);
                
                if ($eventStartInRange < $eventEndInRange) {
                    $totalBookedMinutes += $eventStartInRange->diffInMinutes($eventEndInRange);
                }
            }
            
            // Filter out booked slots
            $availableSlots = array_diff($allSlots, array_unique($bookedSlots));
            
            // Log detailed information for debugging
            Log::info("Slot availability analysis for {$date}", [
                'total_slots' => count($allSlots),
                'booked_slots' => count(array_unique($bookedSlots)),
                'available_slots_before_checks' => count($availableSlots),
                'total_day_minutes' => $totalDayMinutes,
                'total_booked_minutes' => $totalBookedMinutes,
                'booked_percentage' => $totalDayMinutes > 0 ? ($totalBookedMinutes / $totalDayMinutes * 100) : 0,
                'day_events_count' => count($dayEvents)
            ]);
            
            // If 95% or more of the day is booked, consider it fully blocked/unavailable
            if ($totalBookedMinutes >= ($totalDayMinutes * 0.95)) {
                Log::info("Day {$date} is fully booked or blocked in Google Calendar (95%+ booked: {$totalBookedMinutes}/{$totalDayMinutes} minutes)");
                return [];
            }
            
            // If no available slots remain after filtering, return empty
            if (empty($availableSlots)) {
                Log::warning("Day {$date} has no available slots after filtering booked times. This might indicate an issue if slots are expected to be available.");
                return [];
            }
            
            // Additional check: If there are events but they cover most slots, 
            // and remaining slots are very few, it might indicate the day is not really available
            $availablePercentage = (count($availableSlots) / count($allSlots)) * 100;
            if (count($dayEvents) > 0 && $availablePercentage < 5) {
                Log::info("Day {$date} has very few available slots ({$availablePercentage}%), considering it unavailable");
                return [];
            }
            
            // Filter out past times for today
            if ($date === date('Y-m-d')) {
                $currentTime = date('H:i');
                $availableSlots = array_filter($availableSlots, function($slot) use ($currentTime) {
                    return $slot > $currentTime;
                });
            }
            
            $finalSlots = array_values($availableSlots);
            Log::info("Available slots calculated", [
                'total_available_slots' => count($finalSlots),
                'available_slots' => $finalSlots
            ]);
            
            return $finalSlots;
            
        } catch (\Exception $e) {
            Log::error('Google Calendar Error fetching available slots: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            // On error with Google Calendar, return empty array (don't assume slots are available)
            // This ensures we only show dates that actually have available slots
            return [];
        }
    }

    /**
     * Get all events for a month grouped by date
     * 
     * @param string $calendarId The Google Calendar ID
     * @param Carbon $startDate Start date of the month
     * @param Carbon $endDate End date of the month
     * @return array Array of events grouped by date (Y-m-d format)
     */
    public function getMonthEvents($calendarId, $startDate, $endDate)
    {
        try {
            if (!$calendarId) {
                return [];
            }

            // Format calendar ID
            $formattedCalendarId = $this->formatCalendarId($calendarId);
            
            // Fetch all events for the month
            $events = Event::get($startDate, $endDate, [], $formattedCalendarId);
            
            // Group events by date
            $monthEvents = [];
            foreach ($events as $event) {
                try {
                    $eventStart = Carbon::parse($event->startDateTime);
                    $eventEnd = Carbon::parse($event->endDateTime);
                    $dateKey = $eventStart->format('Y-m-d');
                    
                    if (!isset($monthEvents[$dateKey])) {
                        $monthEvents[$dateKey] = [];
                    }
                    
                    $monthEvents[$dateKey][] = [
                        'start' => $eventStart->format('Y-m-d H:i:s'),
                        'end' => $eventEnd->format('Y-m-d H:i:s'),
                    ];
                } catch (\Exception $eventException) {
                    Log::warning("Error processing event in getMonthEvents: " . $eventException->getMessage());
                    continue;
                }
            }
            
            return $monthEvents;
            
        } catch (\Exception $e) {
            Log::error('Google Calendar Error fetching month events: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Generate all possible time slots
     * 
     * @param string $startTime Start time in H:i format
     * @param string $endTime End time in H:i format
     * @param int $slotDuration Slot duration in minutes
     * @return array Array of time slots in H:i format
     */
    private function generateAllSlots($startTime, $endTime, $slotDuration)
    {
        $slots = [];
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);
        
        $current = $start->copy();
        while ($current->lt($end)) {
            $slots[] = $current->format('H:i');
            $current->addMinutes($slotDuration);
        }
        
        return $slots;
    }

    /**
     * Create an event in Google Calendar
     * 
     * @param string $calendarId The Google Calendar ID
     * @param string $title Event title
     * @param Carbon $startDateTime Start date and time
     * @param Carbon $endDateTime End date and time
     * @param string $description Event description
     * @param array $attendees Array of attendee emails
     * @return Event|null Created event or null on failure
     */
    public function createEvent($calendarId, $title, $startDateTime, $endDateTime, $description = '', $attendees = [])
    {
        try {
            if (!$calendarId) {
                Log::warning('No Google Calendar ID provided, skipping event creation');
                return null;
            }

            // Ensure calendar ID is in correct format
            $formattedCalendarId = $this->formatCalendarId($calendarId);
            
            Log::info("Creating Google Calendar event", [
                'original_calendar_id' => $calendarId,
                'formatted_calendar_id' => $formattedCalendarId,
                'title' => $title,
                'start' => $startDateTime->toDateTimeString(),
                'end' => $endDateTime->toDateTimeString()
            ]);
            
            // Create event instance
            $event = new Event();
            $event->name = $title;
            $event->startDateTime = $startDateTime;
            $event->endDateTime = $endDateTime;
            $event->description = $description;
            
            // Add attendees if provided
            if (!empty($attendees)) {
                $eventAttendees = [];
                foreach ($attendees as $attendee) {
                    if (is_array($attendee) && isset($attendee['email'])) {
                        $eventAttendees[] = ['email' => $attendee['email']];
                    } elseif (is_string($attendee) && filter_var($attendee, FILTER_VALIDATE_EMAIL)) {
                        $eventAttendees[] = ['email' => $attendee];
                    }
                }
                if (!empty($eventAttendees)) {
                    $event->attendees = $eventAttendees;
                }
            }
            
            // Save the event to Google Calendar with calendar ID as parameter
            $event->save($formattedCalendarId);
            
            // After save, the Spatie package stores the Google Event in the googleEvent property
            // The event ID is in googleEvent->id
            $eventId = null;
            
            // Method 1: Check if googleEvent property exists and has id
            if (property_exists($event, 'googleEvent') && $event->googleEvent && isset($event->googleEvent->id)) {
                $eventId = $event->googleEvent->id;
                Log::info("Found event ID via googleEvent->id: {$eventId}");
            }
            // Method 2: Direct property access (sometimes it's set directly)
            elseif (isset($event->id)) {
                $eventId = $event->id;
                Log::info("Found event ID via direct property: {$eventId}");
            }
            // Method 3: Use reflection to access private/protected properties
            else {
                try {
                    $reflection = new \ReflectionClass($event);
                    // Try to get googleEvent property
                    if ($reflection->hasProperty('googleEvent')) {
                        $googleEventProp = $reflection->getProperty('googleEvent');
                        $googleEventProp->setAccessible(true);
                        $googleEvent = $googleEventProp->getValue($event);
                        if ($googleEvent && isset($googleEvent->id)) {
                            $eventId = $googleEvent->id;
                            Log::info("Found event ID via reflection googleEvent: {$eventId}");
                        }
                    }
                } catch (\Exception $reflectionException) {
                    Log::warning("Reflection failed: " . $reflectionException->getMessage());
                }
            }
            
            // Log event details after save for debugging
            Log::info("Event saved to Google Calendar - ID extraction", [
                'event_id' => $eventId ?? 'NOT_SET',
                'event_name' => $event->name ?? 'NOT_SET',
                'calendar_id' => $formattedCalendarId,
                'has_id_property' => isset($event->id),
                'has_googleEvent_property' => property_exists($event, 'googleEvent'),
                'googleEvent_exists' => property_exists($event, 'googleEvent') && isset($event->googleEvent),
                'googleEvent_has_id' => property_exists($event, 'googleEvent') && isset($event->googleEvent) && isset($event->googleEvent->id),
                'event_class' => get_class($event)
            ]);
            
            if ($event && $eventId) {
                // Set the ID on the event object for consistency
                if (!isset($event->id)) {
                    $event->id = $eventId;
                }
                Log::info("Google Calendar event created successfully. Event ID: {$eventId}, Calendar ID: {$formattedCalendarId}");
                return $event;
            } else {
                Log::error('Google Calendar event creation - ID not found after save', [
                    'event_exists' => $event !== null,
                    'event_id_found' => $eventId !== null,
                    'event_class' => get_class($event),
                    'event_methods' => get_class_methods($event),
                    'public_properties' => get_object_vars($event)
                ]);
                
                // Even if we can't get the ID, the event was created successfully
                // Return the event so we can at least confirm creation
                if ($event) {
                    Log::warning('Returning event without ID - event was created but ID could not be extracted. Check Google Calendar manually.');
                    return $event;
                }
                
                return null;
            }
            
        } catch (\Exception $e) {
            Log::error('Failed to create Google Calendar event: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return null;
        }
    }

    /**
     * Format calendar ID to ensure it's in the correct format
     * 
     * @param string $calendarId
     * @return string
     */
    public function formatCalendarId($calendarId)
    {
        if (empty($calendarId)) {
            return $calendarId;
        }

        // If it already contains @, it's likely in the correct format (email or group calendar)
        if (strpos($calendarId, '@') !== false) {
            return $calendarId;
        }

        // If it's just an ID (like from calendar.app.google URL), 
        // try appending @group.calendar.google.com for shared calendars
        // This is the most common format for Google Calendar API
        if (!str_contains($calendarId, '@')) {
            // Check if it looks like an email (has dots and looks like email format)
            // If not, assume it's a calendar ID and append the group calendar suffix
            if (!filter_var($calendarId, FILTER_VALIDATE_EMAIL)) {
                return $calendarId . '@group.calendar.google.com';
            }
        }
        
        return $calendarId;
    }

    /**
     * Update an existing event in Google Calendar
     * 
     * @param string $eventId The Google Calendar event ID
     * @param string $calendarId The Google Calendar ID
     * @param array $data Event data to update
     * @return Event|null Updated event or null on failure
     */
    public function updateEvent($eventId, $calendarId, $data)
    {
        try {
            if (!$calendarId || !$eventId) {
                return null;
            }

            // Format calendar ID
            $formattedCalendarId = $this->formatCalendarId($calendarId);
            
            $event = Event::find($eventId, $formattedCalendarId);
            
            if (!$event) {
                Log::warning("Google Calendar event not found: {$eventId} in calendar {$formattedCalendarId}");
                return null;
            }
            
            if (isset($data['name'])) {
                $event->name = $data['name'];
            }
            if (isset($data['startDateTime'])) {
                $event->startDateTime = $data['startDateTime'];
            }
            if (isset($data['endDateTime'])) {
                $event->endDateTime = $data['endDateTime'];
            }
            if (isset($data['description'])) {
                $event->description = $data['description'];
            }
            
            // Save with calendar ID
            $event->save($formattedCalendarId);
            
            Log::info("Google Calendar event updated: {$eventId} in calendar {$formattedCalendarId}");
            
            return $event;
            
        } catch (\Exception $e) {
            Log::error('Failed to update Google Calendar event: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return null;
        }
    }

    /**
     * Delete an event from Google Calendar
     * 
     * @param string $eventId The Google Calendar event ID
     * @param string $calendarId The Google Calendar ID
     * @return bool Success status
     */
    public function deleteEvent($eventId, $calendarId)
    {
        try {
            if (!$calendarId || !$eventId) {
                return false;
            }

            $event = Event::find($eventId, $calendarId);
            
            if ($event) {
                $event->delete();
                Log::info("Google Calendar event deleted: {$eventId}");
                return true;
            }
            
            return false;
            
        } catch (\Exception $e) {
            Log::error('Failed to delete Google Calendar event: ' . $e->getMessage());
            return false;
        }
    }
}


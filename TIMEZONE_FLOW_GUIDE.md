# Timezone Flow Guide

## Current Implementation

### How Timezone Works Currently

1. **Frontend Detection** (JavaScript)
   - Browser automatically detects user's timezone using: `Intl.DateTimeFormat().resolvedOptions().timeZone`
   - Example: "America/New_York", "Europe/London", "Asia/Tokyo"
   - Stored in hidden input: `<input type="hidden" name="time_zone" id="time_zone">`

2. **Storage**
   - **Appointments Table**: Stores `time_zone` as string (e.g., "America/New_York")
   - **Time Slots**: Stored as `datetime` in server timezone (UTC by default)
   - **Bookings**: Uses `time_slot_id` which references `time_slots` table

3. **Current Flow**
   ```
   User selects time → Time stored as-is → No conversion → Displayed as stored
   ```

## Recommended Timezone Flow

### Option 1: Store Everything in Server Timezone (Recommended)

**How it works:**
1. User selects time in their timezone (frontend)
2. Convert to server timezone before saving
3. Store in server timezone (UTC)
4. Convert back to user's timezone when displaying

**Benefits:**
- Consistent storage (all times in UTC)
- Easy to query and compare
- Works with Google Calendar API (uses UTC)

**Implementation:**

```php
// When saving appointment
use App\Helpers\TimezoneHelper;

$converted = TimezoneHelper::convertAppointmentToServer(
    $request->appointment_date,
    $request->appointment_time,
    $request->time_zone
);

$appointment = Appointment::create([
    'appointment_date' => $converted['date'],
    'appointment_time' => $converted['time'],
    'time_zone' => $request->time_zone, // Store user's timezone for display
    // ... other fields
]);

// When displaying
$display = TimezoneHelper::convertAppointmentToUser(
    $appointment->appointment_date,
    $appointment->appointment_time,
    $appointment->time_zone
);
```

### Option 2: Store in User's Timezone (Current Approach)

**How it works:**
1. User selects time in their timezone
2. Store as-is (no conversion)
3. Display as stored

**Limitations:**
- Hard to compare times across timezones
- Google Calendar integration needs conversion
- Can cause confusion for trainers in different timezones

## Timezone Conversion Examples

### Example 1: User in New York books 8:00 PM EST
```
User Input: 2025-12-15 20:00 (EST)
Converted to UTC: 2025-12-16 01:00 (UTC)
Stored: 2025-12-16 01:00:00
Displayed back: 2025-12-15 20:00 EST
```

### Example 2: User in London books 2:00 PM GMT
```
User Input: 2025-12-15 14:00 (GMT)
Converted to UTC: 2025-12-15 14:00 (UTC) - same as GMT
Stored: 2025-12-15 14:00:00
Displayed back: 2025-12-15 14:00 GMT
```

## Implementation Steps

### Step 1: Update AppointmentController to Convert Times

```php
// In store() method
$converted = TimezoneHelper::convertAppointmentToServer(
    $request->appointment_date,
    $request->appointment_time,
    $request->time_zone
);

$appointment = Appointment::create([
    'appointment_date' => $converted['date'],
    'appointment_time' => $converted['time'],
    'time_zone' => $request->time_zone,
    // ...
]);
```

### Step 2: Update Views to Display in User's Timezone

```php
// In blade templates
@php
    $display = TimezoneHelper::convertAppointmentToUser(
        $appointment->appointment_date,
        $appointment->appointment_time,
        $appointment->time_zone
    );
@endphp
Date: {{ $display['date'] }}
Time: {{ $display['datetime']->format('h:i A') }}
```

### Step 3: Update getAvailableTimes to Return Times in User's Timezone

```php
// Convert slot times to user's timezone before returning
$userTimezone = $request->input('timezone', 'UTC');
foreach ($timeSlots as $slot) {
    $userTime = TimezoneHelper::serverToUser(
        $slot->slot_datetime,
        $userTimezone
    );
    // Return times in user's timezone
}
```

## Configuration

### Server Timezone (config/app.php)
```php
'timezone' => 'UTC', // Recommended: UTC for consistency
```

### Common Timezones
- `UTC` - Universal Coordinated Time
- `America/New_York` - Eastern Time (EST/EDT)
- `America/Chicago` - Central Time (CST/CDT)
- `America/Denver` - Mountain Time (MST/MDT)
- `America/Los_Angeles` - Pacific Time (PST/PDT)
- `Europe/London` - Greenwich Mean Time (GMT/BST)
- `Asia/Tokyo` - Japan Standard Time (JST)

## Best Practices

1. **Always store in UTC** - Makes queries and comparisons easier
2. **Store user's timezone** - For display purposes
3. **Convert on display** - Show times in user's timezone
4. **Use Carbon** - Laravel's Carbon library handles timezones well
5. **Test with different timezones** - Ensure conversions work correctly

## Testing Timezone Conversion

```php
// Test conversion
$userTz = 'America/New_York';
$date = '2025-12-15';
$time = '20:00';

$converted = TimezoneHelper::convertAppointmentToServer($date, $time, $userTz);
// Should convert 8:00 PM EST to UTC (1:00 AM next day)

$display = TimezoneHelper::convertAppointmentToUser(
    $converted['date'],
    $converted['time'],
    $userTz
);
// Should convert back to 8:00 PM EST
```


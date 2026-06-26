<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Successful</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full text-center">
        <div class="text-green-500 text-6xl mb-4">✓</div>
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Appointment Booked!</h1>
        <p class="text-gray-600 mb-4">Your appointment has been scheduled successfully.</p>
        
        @if(session('appointment'))
            <div class="bg-blue-50 rounded p-4 mb-4 text-left">
                <p><strong>Appointment #:</strong> {{ session('appointment')->appointment_number }}</p>
                <p><strong>Date:</strong> {{ session('appointment')->appointment_date }}</p>
                <p><strong>Time:</strong> {{ session('appointment')->appointment_time }}</p>
            </div>
        @endif

        <a href="{{ route('booking.create') }}" class="inline-block bg-blue-600 text-white font-bold py-2 px-4 rounded hover:bg-blue-700 transition">
            Book Another
        </a>
    </div>
</body>
</html>
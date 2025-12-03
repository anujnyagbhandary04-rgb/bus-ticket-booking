<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = $_POST['booking_id'];

    $stmt = $conn->prepare("SELECT travel_date, bus_name, seat_numbers, email, phone FROM bookings WHERE booking_id=?");
    $stmt->bind_param("s", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $travel_date = $row['travel_date'];
        $bus_name = $row['bus_name'];
        $seats = explode(',', $row['seat_numbers']);
        $user_email = $row['email'];
        $user_phone = $row['phone'];

        // Extract time from bus_name
        if (preg_match('/(\d{1,2}:\d{2}\s?[APMapm]{2})/', $bus_name, $matches)) {
            $bus_time_str = $matches[1];
            $bus_datetime = DateTime::createFromFormat('Y-m-d g:i A', $travel_date . ' ' . strtoupper($bus_time_str));
            $now = new DateTime();

            if ($bus_datetime && $now->diff($bus_datetime)->h >= 2 || $bus_datetime > $now->add(new DateInterval('PT2H'))) {

                // Log cancelled booking
                $logCancellation = $conn->prepare("INSERT INTO canceled_bookings (booking_id, user_name, user_phone, travel_date, bus_name, seat_numbers) VALUES (?, ?, ?, ?, ?, ?)");
                $seat_numbers = implode(",", $seats);
                $logCancellation->bind_param("ssssss", $booking_id, $user_email, $user_phone, $travel_date, $bus_name, $seat_numbers);
                $logCancellation->execute();

                // Delete booked seats
                foreach ($seats as $s) {
                    $delSeat = $conn->prepare("DELETE FROM booked_seats WHERE travel_date=? AND bus_name=? AND seat_number=?");
                    $delSeat->bind_param("sss", $travel_date, $bus_name, $s);
                    $delSeat->execute();
                }

                // Delete passengers
                $delPax = $conn->prepare("DELETE FROM passengers WHERE booking_id=?");
                $delPax->bind_param("s", $booking_id);
                $delPax->execute();

                // Delete bookings
                $delBook = $conn->prepare("DELETE FROM bookings WHERE booking_id=?");
                $delBook->bind_param("s", $booking_id);
                $delBook->execute();

                $success = "Booking ID <b>$booking_id</b> has been successfully cancelled and the seats are now available.";
            } else {
                $error = "Booking cannot be cancelled less than 2 hours before bus departure.";
            }
        } else {
            $error = "Unable to determine bus timing from bus name.";
        }
    } else {
        $error = "Invalid Booking ID. Please check and try again.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f7f9fc;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .container {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 2px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success, .error {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .success {
            color: green;
            background-color: #e6f7e6;
            border: 1px solid #4CAF50;
        }

        .error {
            color: red;
            background-color: #f9e6e6;
            border: 1px solid #f44336;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-size: 16px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Cancel Your Booking</h2>

    <?php if (!empty($success)): ?>
        <p class="success"><?= $success ?></p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label>
            Enter Booking ID to Cancel:
            <input type="text" name="booking_id" required>
        </label>
        <button type="submit">Cancel Booking</button>
    </form>

    <a href="dashboard.php">Back to Booking Page</a>
</div>

</body>
</html>

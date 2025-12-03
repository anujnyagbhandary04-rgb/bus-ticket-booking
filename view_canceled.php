<?php
session_start();

// OPTIONAL: Add admin login check here
// if (!isset($_SESSION['admin_logged_in'])) {
//     header("Location: admin_login.php");
//     exit();
// }

$conn = new mysqli("localhost", "root", "", "register_db");

$result = $conn->query("SELECT * FROM canceled_bookings ORDER BY cancel_time DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Canceled Bookings - Admin View</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
            text-align: center;
        }
        th {
            background-color: #f4a261;
        }
        h2 {
            text-align: center;
            margin-top: 30px;
        }
nav a {
      color:black;
      margin-left: 90%;
      text-decoration: none;
      font-weight:bold;

    }

    </style>
</head>
<body>
    <h2>Canceled Bookings</h2>

    <table>
        <tr>
            <th>Cancel ID</th>
            <th>Booking ID</th>
            <th>User Email</th>
            <th>User Phone</th>
            <th>Travel Date</th>
            <th>Bus Name</th>
            <th>Seat Numbers</th>
            <th>Cancelled At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['cancel_id']) ?></td>
                <td><?= htmlspecialchars($row['booking_id']) ?></td>
                <td><?= htmlspecialchars($row['user_name']) ?></td>
                <td><?= htmlspecialchars($row['user_phone']) ?></td>
                <td><?= htmlspecialchars($row['travel_date']) ?></td>
                <td><?= htmlspecialchars($row['bus_name']) ?></td>
                <td><?= htmlspecialchars($row['seat_numbers']) ?></td>
                <td><?= htmlspecialchars($row['cancel_time']) ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<br>
<nav>
<a href="admin_dashboard">BACK</a>
</nav>

</body>
</html>

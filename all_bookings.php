<?php
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error)
    die("Connection failed: " . $conn->connect_error);

if (isset($_GET['delete_booking'])) {
    $stmt = $conn->prepare("DELETE FROM bookings WHERE booking_id = ?");
    $stmt->bind_param("s", $_GET['delete_booking']);
    $stmt->execute();
    header("Location: all_bookings.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Bookings</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f4f6f8;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007BFF;
            color: white;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        a.button {
            color: white;
            background-color: #dc3545;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        a.button:hover {
            background-color: #c82333;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
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
<h2>All User Bookings</h2>
<table>
    <tr>
        <th>Booking ID</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Bus</th>
        <th>Date</th>
        <th>Seats</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
<?php
$result = $conn->query("SELECT * FROM bookings");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['booking_id']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
                <td>{$row['bus_name']}</td>
                <td>{$row['travel_date']}</td>
                <td>{$row['seat_numbers']}</td>
                <td>₹{$row['total_cost']}</td>
                <td><a class='button' href='?delete_booking={$row['booking_id']}' onclick='return confirm(\"Delete this booking?\")'>Delete</a></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='no-data'>No bookings found.</td></tr>";
}
?>
</table>
<br>
<nav>
<a href="admin_dashboard">BACK</a>
</nav>

</body>
</html>

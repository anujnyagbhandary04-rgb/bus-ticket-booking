<?php
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Seat Availability</title>
    <style>
nav a {
      color:black;
      margin-left: 90%;
      text-decoration: none;
      font-weight:bold;

    }

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
            background-color: #28a745;
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

        tr:hover {
            background-color: #eef7ee;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>
<h2>Seat Availability</h2>
<table>
<tr>
    <th>Bus Name</th>
    <th>Travel Date</th>
    <th>Booked Seats</th>
    <th>Available Seats</th>
</tr>
<?php
$sql = "
  
    SELECT 
        bs.bus_name, 
        bs.travel_date, 
        COUNT(*) AS booked 
    FROM booked_seats bs
    INNER JOIN buses b ON bs.bus_name = b.bus_name
    WHERE bs.travel_date >= CURDATE()
    GROUP BY bs.bus_name, bs.travel_date
";


$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $available = 20 - $row['booked']; // Adjust if bus has more/less seats
        echo "<tr>
                <td>{$row['bus_name']}</td>
                <td>{$row['travel_date']}</td>
                <td>{$row['booked']}</td>
                <td>$available</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='no-data'>No seat data available.</td></tr>";
}
?>
</table>
<br>
<nav>
<a href="admin_dashboard">BACK</a>
</nav>

</body>
</html>

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
?>
<!DOCTYPE html>
<html>
<head>
    <title>All Buses</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f4f6f8;
        }
 nav a {
      color:black;
      margin-left: 90%;
      text-decoration: none;
      font-weight:bold;

    }


        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #007BFF;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .no-data {
            text-align: center;
            color: #777;
            padding: 20px;
        }
    </style>
</head>
<body>

<h2>All Buses</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Time</th>
        <th>Cost</th>
    </tr>
<?php
$result = $conn->query("SELECT * FROM buses");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['bus_name']) . "</td>
                <td>{$row['bus_time']}</td>
                <td>₹{$row['cost']}</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='4' class='no-data'>No buses found.</td></tr>";
}
?>
</table>
<br>
<nav>
<a href="admin_dashboard">BACK</a>
</nav>

</body>
</html>

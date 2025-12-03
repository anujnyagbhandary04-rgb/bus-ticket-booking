<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "register_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT * FROM feedback ORDER BY submitted_at DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Feedback</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 90px auto 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }

        h1 {
            text-align: center;
            color: #2f3542;
            margin-bottom: 30px;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 18px;
            background-color: #1e272e;
            color: #ffa502;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .back-btn:hover {
            background-color: #2f3542;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #1e272e;
            color: #ffa502;
        }

        tr:hover {
            background-color: #f1f2f6;
        }

        @media (max-width: 768px) {
            .container {
                margin: 90px 10px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            th {
                display: none;
            }

            td {
                position: relative;
                padding-left: 50%;
                text-align: right;
            }

            td::before {
                content: attr(data-label);
                position: absolute;
                left: 10px;
                font-weight: bold;
                color: #57606f;
                text-align: left;
            }

            .back-btn {
                width: 100%;
                text-align: center;
                display: block;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <a class="back-btn" href="admin_dashboard.php"><i class="fas fa-arrow-left"></i> Back </a>
    <h1>User Feedback</h1>

    <?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td data-label="ID"><?= htmlspecialchars($row['id']) ?></td>
                <td data-label="Name"><?= htmlspecialchars($row['name']) ?></td>
                <td data-label="Email"><?= htmlspecialchars($row['email']) ?></td>
                <td data-label="Message"><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                <td data-label="Submitted At"><?= $row['submitted_at'] ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p style="text-align:center; color: #888;">No feedback found.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php $conn->close(); ?>

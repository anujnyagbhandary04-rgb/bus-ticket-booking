<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background-color: #2f3542;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 30px 20px;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
        }

        .sidebar h2 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #ffa502;
        }

        .sidebar a {
            text-decoration: none;
            color: #f1f2f6;
            margin: 15px 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .sidebar a:hover {
            color: #ffa502;
        }

        nav {
            position: fixed;
            top: 0;
            left: 240px;
            right: 0;
            height: 60px;
            background-color: #1e272e;
            color: white;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0 20px;
            z-index: 1000;
        }

        nav a {
            color: #ffa502;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
        }

        nav a i {
            margin-right: 8px;
        }

        .main-content {
            margin-left: 240px;
            padding: 90px 30px 30px;
            width: calc(100% - 240px);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #2f3542;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
        }

        .card {
            background-color: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            color: #2f3542;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .card i {
            font-size: 28px;
            margin-bottom: 15px;
            color: #57606f;
        }

        .card h3 {
            font-size: 18px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            nav {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 90px 20px 20px;
            }

            .header h1 {
                font-size: 22px;
            }

            .dashboard-grid {
                gap: 15px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="admin_buses.php"><i class="fas fa-bus"></i> View All Buses</a>
        <a href="manage_buses.php"><i class="fas fa-cogs"></i> Manage Buses</a>
        <a href="seat_availability.php"><i class="fas fa-chair"></i> Seat Availability</a>
        <a href="all_bookings.php"><i class="fas fa-users"></i> User Bookings</a>
        <a href="view_canceled.php"><i class="fas fa-ban"></i> Canceled Bookings</a>
        <a href="admin_feedback.php"><i class="fas fa-comment-dots"></i> Feedback</a> 
    </div>

    <!-- Navigation Bar -->
    <nav>
        <a href="home.php"><i class="fas fa-home"></i>Back to Home</a>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="dashboard-grid">
            <a href="admin_buses.php" class="card">
                <i class="fas fa-bus"></i>
                <h3>View All Buses</h3>
            </a>
            <a href="manage_buses.php" class="card">
                <i class="fas fa-cogs"></i>
                <h3>Manage Buses</h3>
            </a>
            <a href="seat_availability.php" class="card">
                <i class="fas fa-chair"></i>
                <h3>Seat Availability</h3>
            </a>
            <a href="all_bookings.php" class="card">
                <i class="fas fa-users"></i>
                <h3>User Bookings</h3>
            </a>
            <a href="view_canceled.php" class="card">
                <i class="fas fa-ban"></i>
                <h3>Canceled Bookings</h3>
            </a>
            <a href="admin_feedback.php" class="card">
                <i class="fas fa-comment-dots"></i>
                <h3>User Feedback</h3>
            </a> <!-- New Feedback Card -->
        </div>
    </div>

</body>
</html>

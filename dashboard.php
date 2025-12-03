<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'] ?? 'Guest';
$firstLetter = strtoupper(substr($username, 0, 1));

// Random color generator
$colors = ['#ff6347', '#4682b4', '#32cd32', '#ffa500', '#9370db', '#20b2aa'];
$bgColor = $colors[array_rand($colors)];

$booking_id = $_SESSION['booking_id'] ?? null;  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Bus Booking</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('background.jpg'); 
      background-size: cover;
      background-position: center;
      color: white;
    }
    .navbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 30px;
      background-color: rgba(0, 0, 0, 0.7);
    }
    .search-bar input {
      padding: 7px;
      font-size: 16px;
    }
    .search-bar button {
      padding: 7px 12px;
      font-size: 16px;
      cursor: pointer;
      margin-left: 5px;
    }
    .user-info {
      display: flex;
      align-items: center;
    }
    .profile-pic {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background-color: <?= $bgColor ?>;
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      font-weight: bold;
      margin-right: 10px;
    }
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 50px 20px;
    }
    .cards {
      display: flex;
      flex-direction: column;
      gap: 25px;
      width: 100%;
      max-width: 800px;
    }
    .card {
      background-color: rgba(0, 0, 0, 0.6);
      padding: 20px;
      border-radius: 10px;
      transition: 0.3s;
      cursor: pointer;
    }
    .card:hover {
      background-color: rgba(0, 0, 0, 0.8);
      transform: translateY(-5px);
    }
    .card h2 {
      margin-top: 0;
    }
    .footer {
      text-align: center;
      margin-top: 40px;
      padding: 20px;
      background-color: rgba(0, 0, 0, 0.6);
      font-size: 18px;
    }
    .logout-btn {
      background-color: crimson;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
margin-left:800px;
    }
  </style>
</head>
<body>

  <div class="navbar">
    <div class="search-bar">
      <input type="text" placeholder="Search...">
      <button>Search</button>
    </div>
<form method="post" style="display: inline;">
    <button class="logout-btn" type="submit" name="logout">Logout</button>
  </form>

  <?php
  if (isset($_POST['logout'])) {
      session_destroy();
      header("Location: home.php");
      exit();
  }
  ?>
    <div class="user-info">
      <div class="profile-pic"><?= $firstLetter ?></div>
    </div>
  </div>

  <div class="container">
    <div class="cards">
      <div class="card" onclick="location.href='index.php'">
        <h2>Book Your Tickets</h2>
        <p>Select your destination and book seats instantly with our simple interface.</p>
      </div>

      <!-- Conditionally display the "View Your Tickets" card if a booking ID is present -->
      <?php if ($booking_id): ?>
<div class="card" onclick="location.href='view.php?booking_id=<?= urlencode($booking_id) ?>'">
          <h2>View Your Tickets</h2>
          <p>See your upcoming and past bookings with full details.</p>
        </div>
      <?php else: ?>
        <div class="card">
          <h2>No Ticket Booked</h2>
          <p>Click on "Book Your Tickets" to reserve your seat!</p>
        </div>
      <?php endif; ?>

      <div class="card" onclick="location.href='cancel_ticket.php'">
        <h2>Cancel Ticket</h2>
        <p>Cancel your ticket instantly using your unique booking ID</p>
      </div>
    </div>

    <div class="footer">
      <p>Welcome to our online bus ticket booking platform. Book your trip now, manage your reservations, and complete your payments all in one place. Enjoy a hassle-free journey experience!</p>
    </div>
  </div>

  

</body>
</html>

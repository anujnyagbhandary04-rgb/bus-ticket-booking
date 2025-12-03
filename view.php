<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$booking_id = trim($_GET['booking_id'] ?? '');

if (!$booking_id) {
    echo "Booking ID not provided.";
    exit;
}

$stmt = $conn->prepare("SELECT * FROM bookings WHERE booking_id = ?");
$stmt->bind_param("s", $booking_id);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();

if (!$booking) {
    echo "No booking found for the provided ID.";
    exit;
}

$stmt2 = $conn->prepare("SELECT * FROM passengers WHERE booking_id = ?");
$stmt2->bind_param("s", $booking_id);
$stmt2->execute();
$passengers = $stmt2->get_result();

if ($passengers->num_rows === 0) {
    error_log("No passengers found for booking ID: $booking_id");
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Your Ticket</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background: #f9fbfd;
    }
    .ticket {
      background: #ffffff;
      padding: 25px;
      border-radius: 8px;
      max-width: 800px;
      margin: auto;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    h2 {
      color: #007bff;
      text-align: center;
    }
    .section {
      margin-bottom: 20px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #dee2e6;
      padding: 12px;
      text-align: left;
    }
    th {
      background: #e9f5ff;
      color: #007bff;
    }
    .booking-id {
      color: #007bff;
      font-size: 18px;
    }
    .buttons {
      margin-top: 30px;
      text-align: center;
    }
    .buttons button {
      padding: 10px 20px;
      margin: 5px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
      color: white;
    }
    .download-btn {
      background-color: #28a745;
    }
    .download-btn:hover {
      background-color: #218838;
    }
    .dashboard-btn {
      background-color: #007bff;
    }
    .dashboard-btn:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
    
    if (window.history.replaceState) {
      window.history.replaceState({}, '', 'ticket.php?booking_id=<?= urlencode($booking_id) ?>');
    }
    window.history.pushState(null, '', window.location.href);
    window.onpopstate = function () {
      window.location.href = 'index.php';
    };

    function generateRandomBusNumber() {
      const states = ["MH", "DL", "KA", "TN", "GJ", "RJ", "UP"];
      const state = states[Math.floor(Math.random() * states.length)];
      const district = Math.floor(Math.random() * 90 + 10);
      const letters = String.fromCharCode(65 + Math.floor(Math.random() * 26)) +
                      String.fromCharCode(65 + Math.floor(Math.random() * 26));
      const digits = Math.floor(Math.random() * 9000 + 1000);
      return `${state}${district}${letters}${digits}`;
    }

    function downloadPDF() {
  const element = document.getElementById('ticket-content');

  
  const buttons = document.querySelector('.buttons');
  buttons.style.display = 'none';

  
  let busNumber = generateRandomBusNumber();
  let busNumberEl = document.getElementById('random-bus-number');
  if (!busNumberEl) {
    busNumberEl = document.createElement('div');
    busNumberEl.id = 'random-bus-number';
    busNumberEl.innerHTML = `<strong>Bus Number:</strong> <span>${busNumber}</span><br>`;
    const section = element.querySelector('.section');
    section.insertBefore(busNumberEl, section.children[4]); 
  } else {
    busNumberEl.querySelector('span').innerText = busNumber;
  }

  const opt = {
    margin:       0.5,
    filename:     'ticket_<?= htmlspecialchars($booking['booking_id']) ?>.pdf',
    image:        { type: 'jpeg', quality: 0.98 },
    html2canvas:  { scale: 2 },
    jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
  };

  html2pdf().from(element).set(opt).save().then(() => {
    
    buttons.style.display = 'block';
  });
}


  
  </script>
</head>
<body>
<div class="ticket" id="ticket-content">
  <h2><center>🚌 Your Bus Ticket</center></h2>
  <div class="section">
    <strong>Booking ID:</strong> <span class="booking-id"><?= htmlspecialchars($booking['booking_id']) ?></span><br>
    <strong>Bus:</strong> <?= htmlspecialchars($booking['bus_name']) ?><br>
    <strong>Route:</strong> <?= htmlspecialchars($booking['source']) ?> → <?= htmlspecialchars($booking['destination']) ?><br>
    <strong>Date:</strong> <?= htmlspecialchars($booking['travel_date']) ?><br>
    <strong>Seats:</strong> <?= htmlspecialchars($booking['seat_numbers']) ?><br>
    <strong>Total Paid:</strong> ₹<?= number_format($booking['total_cost'], 2) ?><br>
    <strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?><br>
    <strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?><br>
    <strong>Payment Method:</strong> <?= ucfirst(htmlspecialchars($booking['payment_method'])) ?><br>
  </div>

  <div class="section">
    <h3>Passenger Details</h3>
    <?php if ($passengers->num_rows > 0): ?>
      <table>
        <tr><th>Name</th><th>Age</th><th>Gender</th></tr>
        <?php while ($p = $passengers->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['age']) ?></td>
            <td><?= htmlspecialchars(ucfirst($p['gender'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </table>
    <?php else: ?>
      <p style="color:red;">⚠ No passenger details found for this booking.</p>
    <?php endif; ?>
  </div>

  <div class="buttons">
    <button class="download-btn" onclick="downloadPDF()">Download PDF</button>
    <button class="dashboard-btn" onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
</body>
</html>

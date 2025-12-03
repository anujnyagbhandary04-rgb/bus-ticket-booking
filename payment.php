<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");

function generateBookingID() {
  return strtoupper(uniqid('BK'));
}

if (!isset($_SESSION['pending_booking'])) {
  $_SESSION['error'] = "No booking found to process.";
  header("Location: index.php");
  exit();
}

$booking_data = $_SESSION['pending_booking'];
$finalMessage = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_now'])) {
  $method = $_POST['payment_method'] ?? null;

  if (empty($method)) {
    $error = "Please select a payment method.";
  } else {
    $original_cost = $booking_data['total_cost'];

    if ($method === 'upi') {
      $upi_id = trim($_POST['upi_id'] ?? '');
if (empty($upi_id) || !preg_match('/^[\w.-]+@(upi|paytm|ybl|oksbi|okhdfcbank|okaxis)$/', $upi_id)) {
        $error = "Please enter a valid UPI ID (e.g., example@upi).";
      } else {
        $final_cost = round($original_cost * 0.95, 2); // 5% discount
      }
    } elseif ($method === 'card') {
      $card_number = preg_replace('/\s+/', '', $_POST['card_number'] ?? '');
      $cvv = $_POST['cvv'] ?? '';
      $exp_date = $_POST['exp_date'] ?? '';

      if (!preg_match('/^\d{16}$/', $card_number)) {
        $error = "Card number must be exactly 16 digits.";
      } elseif (!preg_match('/^\d{3}$/', $cvv)) {
        $error = "CVV must be exactly 3 digits.";
      } elseif (!$exp_date || strtotime($exp_date . "-01") < strtotime(date("Y-m-01"))) {
        $error = "Please enter a valid card expiry date.";
      } else {
        $final_cost = $original_cost + 10; // ₹10 fee
      }
    } else {
      $error = "Invalid payment method selected.";
    }
  }

  if (!$error) {
    $booking_id = generateBookingID();
    $source = $booking_data['source'];
    $destination = $booking_data['destination'];
    $travel_date = $booking_data['travel_date'];
    $bus_name = $booking_data['bus_name'];
    $seat_numbers = $booking_data['seat_str'];
    $email = $booking_data['email'];
    $phone = $booking_data['phone'];

    $stmt = $conn->prepare("INSERT INTO bookings (booking_id, source, destination, travel_date, bus_name, seat_numbers, total_cost, email, phone, payment_method) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssisss", $booking_id, $source, $destination, $travel_date, $bus_name, $seat_numbers, $final_cost, $email, $phone, $method);
    $stmt->execute();

    foreach ($booking_data['passengers'] as $p) {
      $name = $p['name'];
      $age = $p['age'];
      $gender = $p['gender'];
      $stmt2 = $conn->prepare("INSERT INTO passengers (booking_id, name, age, gender) VALUES (?, ?, ?, ?)");
      $stmt2->bind_param("ssis", $booking_id, $name, $age, $gender);
      $stmt2->execute();
    }

    foreach ($booking_data['seats'] as $s) {
      $stmt3 = $conn->prepare("INSERT INTO booked_seats (travel_date, bus_name, seat_number) VALUES (?, ?, ?)");
      $stmt3->bind_param("sss", $travel_date, $bus_name, $s);
      $stmt3->execute();
    }

    $_SESSION['booking_id'] = $booking_id;
    unset($_SESSION['pending_booking']);
    header("Location: view.php?booking_id=$booking_id");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Confirm Payment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #e9f5ff;
    }
    .box {
      background: #ffffff;
      padding: 20px;
      border-radius: 8px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 4px 12px rgba(0, 123, 255, 0.2);
    }
    h2 {
      color: #007bff;
      text-align: center;
    }
    .payment-option {
      margin: 15px 0;
      padding: 15px;
      background: #d9ecff;
      border: 1px solid #b3d7ff;
      border-radius: 6px;
    }
    .field {
      margin-bottom: 12px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #007bff;
    }
    input[type="text"], input[type="number"], input[type="month"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ced4da;
      border-radius: 4px;
    }
    button {
      padding: 10px 25px;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    button:hover {
      background: #0056b3;
    }
    .error {
      color: black;
      font-weight: bold;
      margin: 10px 0;
    }
  </style>
  <script>
    function togglePaymentFields() {
      const method = document.querySelector('input[name="payment_method"]:checked');
      if (!method) return;
      document.getElementById('upi_fields').style.display = method.value === 'upi' ? 'block' : 'none';
      document.getElementById('card_fields').style.display = method.value === 'card' ? 'block' : 'none';
    }

    function validatePaymentForm() {
      const method = document.querySelector('input[name="payment_method"]:checked');
      if (!method) {
        alert("Please select a payment method.");
        return false;
      }

      if (method.value === "card") {
        const cardNumber = document.querySelector('input[name="card_number"]').value.replace(/\s+/g, '');
        const cvv = document.querySelector('input[name="cvv"]').value;
        const exp = document.querySelector('input[name="exp_date"]').value;

        if (!/^\d{16}$/.test(cardNumber)) {
          alert("Card number must be exactly 16 digits.");
          return false;
        }

        if (!/^\d{3}$/.test(cvv)) {
          alert("CVV must be exactly 3 digits.");
          return false;
        }

        if (!exp) {
          alert("Please enter card expiry date.");
          return false;
        }

        const expDate = new Date(exp + "-01");
        const today = new Date();
        today.setDate(1); // first of the month
        if (expDate < today) {
          alert("Card expiry date must be in the future.");
          return false;
        }
      } else if (method.value === "upi") {
        const upi = document.querySelector('input[name="upi_id"]').value.trim();
const upiPattern = /^[\w.-]+@(upi|paytm|ybl|oksbi|okhdfcbank|okaxis)$/;
        if (!upi || !upiPattern.test(upi)) {
          alert("Please enter a valid UPI ID (e.g., example@upi).");
          return false;
        }
      }

      return true;
    }

    window.onload = togglePaymentFields;
  </script>
</head>
<body>
<div class="box">
  <h2><center>Confirm Your Payment</center></h2>

  <?php if ($finalMessage): ?>
    <div class="success"><?= $finalMessage ?></div>
  <?php elseif (!empty($booking_data)): ?>
    <p><strong>Bus:</strong> <?= htmlspecialchars($booking_data['bus_name']) ?><br>
       <strong>Seats:</strong> <?= htmlspecialchars($booking_data['seat_str']) ?><br>
       <strong>Total:</strong> ₹<?= htmlspecialchars($booking_data['total_cost']) ?><br>
       <strong>Email:</strong> <?= htmlspecialchars($booking_data['email']) ?><br>
       <strong>Phone:</strong> <?= htmlspecialchars($booking_data['phone']) ?></p>

    <?php if ($error): ?>
      <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" onsubmit="return validatePaymentForm()">
      <div class="payment-option">
        <label><input type="radio" name="payment_method" value="upi" checked onchange="togglePaymentFields()"> UPI (5% Off)</label>
        <label><input type="radio" name="payment_method" value="card" onchange="togglePaymentFields()"> Debit / Credit Card (+ ₹10 Fee)</label>
      </div>

      <div id="upi_fields" class="payment-option">
        <div class="field">
          <label>UPI ID:</label>
          <input type="text" name="upi_id" placeholder="example@upi">
        </div>
      </div>

      <div id="card_fields" class="payment-option" style="display:none;">
        <div class="field">
          <label>Card Number:</label>
          <input type="text" name="card_number" maxlength="16" placeholder="Enter 16-digit number">
        </div>
        <div class="field">
          <label>CVV:</label>
          <input type="text" name="cvv" maxlength="3" placeholder="123">
        </div>
        <div class="field">
          <label>Expiry Date:</label>
          <input type="month" name="exp_date">
        </div>
      </div>

     <center><button type="submit" name="pay_now">Pay Now</button></center>
    </form>
  <?php else: ?>
    <p class="error">No booking data found.</p>
  <?php endif; ?>
</div>
</body>
</html>

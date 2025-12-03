<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");


$buses = $conn->query("SELECT * FROM buses ORDER BY id DESC");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_booking'])) {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $travel_date = $_POST['travel_date'];
    $num_passengers = min(6, max(1, (int)$_POST['num_passengers']));
    $bus_id = (int)$_POST['bus'];
    $seats = explode(',', $_POST['selected_seats']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $bus_info = $conn->query("SELECT * FROM buses WHERE id=$bus_id")->fetch_assoc();
    $bus_name = $bus_info['bus_name'];
    $bus_cost = $bus_info['cost'];
    $total_cost = count($seats) * $bus_cost;
    $seat_str = implode(',', $seats);

   
    $conflict = false;
    $bookedSeats = [];
    foreach ($seats as $s) {
        $check = $conn->prepare("SELECT * FROM booked_seats WHERE travel_date=? AND bus_name=? AND seat_number=?");
        $check->bind_param("sss", $travel_date, $bus_name, $s);
        $check->execute();
        if ($check->get_result()->num_rows > 0) {
            $conflict = true;
            $bookedSeats[] = $s;
        }
    }

    if ($conflict) {
        $_SESSION['error'] = "The following seats are already booked: " . implode(', ', $bookedSeats);
        header("Location: index.php");
        exit();
    }

    
    $passengers = [];
    for ($i = 1; $i <= $num_passengers; $i++) {
        $passengers[] = [
            'name' => $_POST["name$i"],
            'age' => $_POST["age$i"],
            'gender' => $_POST["gender$i"]
        ];
    }

    $_SESSION['pending_booking'] = compact('source', 'destination', 'travel_date', 'bus_name', 'seat_str', 'total_cost', 'email', 'phone', 'passengers', 'seats', 'bus_id');
    $_SESSION['ready_for_payment'] = true;
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bus Booking System</title>
   <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f7ff;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #003366;
        }
        form label {
            font-weight: bold;
            color: #003366;
        }
        form select, form input[type="date"], form input[type="email"], form input[type="text"], form input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[name^="name"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        form button:hover {
            background-color: #0056b3;
        }
        .seat {
            width: 40px;
            height: 40px;
            margin: 5px;
            display: inline-block;
            text-align: center;
            line-height: 40px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }
        .available {
            background: #1E90FF;
        }
        .booked {
            background: #ccc;
            cursor: not-allowed;
		pointer-events:none;
        }
        .selected {
            background: #ff4d4d;
        }
        .passenger-block {
            margin-bottom: 15px;
            background: #eef3ff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #d1e0ff;
        }
        .bus-selection {
            margin-bottom: 20px;
        }
        .seat-selection {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        #topSeats, #bottomSeats {
            display: flex;
            flex-wrap: wrap;
            width: 80%;
            background: #ffffff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #totalCost {
            font-weight: bold;
            color: #003366;
        }
    </style>
</head>
<body>
<div class="container">
<h2>Bus Booking System</h2>

<?php
if (!empty($_SESSION['success'])) {
    echo "<p style='color:green;font-weight:bold'>" . htmlspecialchars($_SESSION['success']) . "</p>";
    unset($_SESSION['success']);
}
if (!empty($_SESSION['error'])) {
    echo "<p style='color:red;font-weight:bold'>" . htmlspecialchars($_SESSION['error']) . "</p>";
    unset($_SESSION['error']);
}
if (!empty($_SESSION['ready_for_payment']) && !empty($_SESSION['pending_booking'])) {
    $b = $_SESSION['pending_booking'];
    echo "<h3><center>Confirm and Pay</center></h3>
    <p><b>Bus:</b> " . htmlspecialchars($b['bus_name']) . "<br>
       <b>Seats:</b> " . htmlspecialchars($b['seat_str']) . "<br>
       <b>Total:</b> ₹" . htmlspecialchars($b['total_cost']) . "<br>
       <b>Email:</b> " . htmlspecialchars($b['email']) . "<br>
       <b>Phone:</b> " . htmlspecialchars($b['phone']) . "</p>
    <form action='payment.php' method='POST'>
      <button name='pay_now'>Pay Now</button>
    </form>";
    unset($_SESSION['ready_for_payment']);
    exit();
}
?>

<form method="POST">
    <label>Source:
        <select name="source" required>
            <option>Udupi(City-BusStand)</option>
            <option>Manipal</option>
            <option>Kinnimulki</option>
            <option>Kaup</option>
        </select>
    </label><br><br>

    <label>Destination:
        <select name="destination" required>
            <option>Majestic(kempegowda bus-stand)</option>
            <option>Yeshwanthpur</option>
            <option>Madiwala</option>
            <option>Navarang/Rajajinagar</option>
        </select>
    </label><br><br>

    <label>Date:
        <input type="date" name="travel_date" id="travel_date" required>
    </label><br><br>

    <label>Email: <input type="email" name="email" required></label><br><br>
    <label>Phone: <input type="text" name="phone" maxlength="10" required></label><br><br>

    <label>Number of Passengers:
        <input type="number" name="num_passengers" id="num_passengers" min="1" max="6" required>
    </label>
    <div id="passengerDetails"></div>

    <h4>Select Bus</h4>
    <?php while ($b = $buses->fetch_assoc()): ?>
        <label>
            <input type="radio" name="bus" value="<?= $b['id'] ?>"> <?= htmlspecialchars($b['bus_name']) ?> - ₹<?= $b['cost'] ?>
        </label><br>
    <?php endwhile; ?>

    <h4>Upper Deck Seats</h4>
    <div id="topSeats"></div>
    <h4>Lower Deck Seats</h4>
    <div id="bottomSeats"></div>

    <input type="hidden" name="selected_seats" id="selected_seats">
    <p>Total Cost: ₹<span id="totalCost">0</span></p>
    <button type="submit" name="confirm_booking">Confirm Booking</button>
</form>
</div>
<script>
document.querySelector('form').addEventListener('submit', function(e) {
    const numPassengers = parseInt(document.getElementById('num_passengers').value) || 1;

    if (selected.size === 0) {
        e.preventDefault();  
        alert("Please select at least one seat.");
        return;
    }

    if (selected.size !== numPassengers) {
        e.preventDefault();
        alert(`You must select exactly ${numPassengers} seats.`);
        return;
    }
});

const today = new Date().toISOString().split('T')[0];
document.getElementById('travel_date').min = today;

const seatField = document.getElementById('selected_seats');
const totalCost = document.getElementById('totalCost');
const selected = new Set();

function seatLayout(container, prefix, start, count) {
  for (let i = start; i < start + count; i++) {
    const div = document.createElement('div');
    const sn = prefix + i;
    div.className = 'seat available';
    div.innerText = sn;
    div.dataset.seat = sn;
    container.appendChild(div);
  }
}

seatLayout(document.getElementById('topSeats'), 'S', 1, 10);
seatLayout(document.getElementById('bottomSeats'), 'L', 1, 10);

document.addEventListener('click', function(e) {
  if (e.target.classList.contains('seat')) {
    const seat = e.target;
    if (seat.classList.contains('booked')) return;
    const sn = seat.dataset.seat;
    const maxPassengers = parseInt(document.getElementById('num_passengers').value) || 1;
    if (selected.has(sn)) {
      seat.classList.remove('selected');
      selected.delete(sn);
    } else {
      if (selected.size >= maxPassengers) {
        alert(`You can only select up to ${maxPassengers} seats.`);
        return;
      }
      seat.classList.add('selected');
      selected.add(sn);
    }
    seatField.value = Array.from(selected).join(',');
    totalCost.innerText = selected.size * getBusCost();
  }
});

function getBusCost() {
  const selectedBus = document.querySelector('input[name="bus"]:checked');
  if (!selectedBus) return 0;
  const costText = selectedBus.nextSibling.textContent.match(/₹(\d+)/);
  return costText ? parseInt(costText[1]) : 0;
}

document.querySelectorAll('input[name="bus"]').forEach(radio => {
  radio.onchange = () => {
    totalCost.innerText = selected.size * getBusCost();
    fetchBookedSeats();
  };
});

document.getElementById('travel_date').addEventListener('change', fetchBookedSeats);

document.getElementById('num_passengers').oninput = function() {
  const p = document.getElementById('passengerDetails');
  p.innerHTML = '';
  const val = Math.min(6, parseInt(this.value));
  this.value = val;
  for (let i = 1; i <= val; i++) {
    p.innerHTML += `
      <div class="passenger-block">
        <strong>Passenger ${i}</strong><br><br>
        <label>Name: <input name="name${i}" required></label><br><br>
        <label>Age: <input type="number" name="age${i}" required></label><br><br>
        <label>Gender:
          <select name="gender${i}">
            <option>Male</option>
            <option>Female</option>
            <option>Other</option>
          </select>
        </label>
      </div>`;
  }
};

function fetchBookedSeats() {
  const selectedBusRadio = document.querySelector('input[name="bus"]:checked');
  const date = document.getElementById('travel_date').value;
  if (!selectedBusRadio || !date) return;

  const busName = selectedBusRadio.nextSibling.textContent.trim().split(" - ")[0];

  fetch(`get_booked_seats.php?bus=${encodeURIComponent(busName)}&date=${date}`)
    .then(res => res.json())
    .then(data => {
      document.querySelectorAll('.seat').forEach(seat => {
        const sn = seat.dataset.seat;
        if (data.includes(sn)) {
          seat.classList.remove('available', 'selected');
          seat.classList.add('booked');
          selected.delete(sn);
        } else {
          seat.classList.remove('booked', 'selected');
          seat.classList.add('available');
        }
      });
      seatField.value = Array.from(selected).join(',');
      totalCost.innerText = selected.size * getBusCost();
    });
}
function fetchBookedSeats() {
  const selectedBusRadio = document.querySelector('input[name="bus"]:checked');
  const date = document.getElementById('travel_date').value;
  if (!selectedBusRadio || !date) return;

  const busName = selectedBusRadio.nextSibling.textContent.trim().split(" - ")[0];

  fetch(`get_booked_seats.php?bus=${encodeURIComponent(busName)}&date=${date}`)
    .then(res => res.json())
    .then(data => {
      document.querySelectorAll('.seat').forEach(seat => {
        const sn = seat.dataset.seat;
        if (data.includes(sn)) {
          seat.classList.remove('available', 'selected');
          seat.classList.add('booked');
          selected.delete(sn);  // make sure 'selected' is defined in your code
        } else {
    if (!selected.has(sn)) { 
        seat.classList.remove('booked');
        seat.classList.add('available');
    }
}
      });
      seatField.value = Array.from(selected).join(',');  
      totalCost.innerText = selected.size * getBusCost();  
    });
}

window.onload = fetchBookedSeats;

document.querySelectorAll('input[name="bus"]').forEach(el => {
  el.addEventListener('change', fetchBookedSeats);
});
document.getElementById('travel_date').addEventListener('change', fetchBookedSeats);

setInterval(fetchBookedSeats,5000);

</script>
</body>
</html>

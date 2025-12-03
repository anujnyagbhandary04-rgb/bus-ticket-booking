<?php
$conn = new mysqli("localhost", "root", "", "register_db");

$bus = $_GET['bus'] ?? '';
$date = $_GET['date'] ?? '';

if (!$bus || !$date) {
    echo json_encode([]);
    exit();
}

$stmt = $conn->prepare("SELECT seat_number FROM booked_seats WHERE bus_name = ? AND travel_date = ?");
$stmt->bind_param("ss", $bus, $date);
$stmt->execute();
$result = $stmt->get_result();

$bookedSeats = [];
while ($row = $result->fetch_assoc()) {
    $bookedSeats[] = $row['seat_number'];
}

echo json_encode($bookedSeats);
?>

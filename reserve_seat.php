<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");

$data = json_decode(file_get_contents("php://input"), true);
$seat = $data['seat'];
$bus_name = $data['bus'];
$travel_date = $data['date'];
$session_id = session_id();


$conn->query("DELETE FROM temp_reserved_seats WHERE TIMESTAMPDIFF(MINUTE, reserved_at, NOW()) > 5");


$stmt = $conn->prepare("SELECT * FROM temp_reserved_seats WHERE seat_number=? AND bus_name=? AND travel_date=?");
$stmt->bind_param("sss", $seat, $bus_name, $travel_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    
    $stmt = $conn->prepare("INSERT INTO temp_reserved_seats (seat_number, bus_name, travel_date, session_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $seat, $bus_name, $travel_date, $session_id);
    $stmt->execute();
    echo json_encode(["status" => "reserved"]);
} else {
    echo json_encode(["status" => "already_reserved"]);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_bus'])) {
    $stmt = $conn->prepare("INSERT INTO buses (bus_name, bus_time, cost) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $_POST['bus_name'], $_POST['bus_time'], $_POST['cost']);
    $stmt->execute();
    $_SESSION['success'] = "Bus added successfully.";
    header("Location: manage_buses.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_bus'])) {
    $stmt = $conn->prepare("UPDATE buses SET bus_name = ?, bus_time = ?, cost = ? WHERE id = ?");
    $stmt->bind_param("ssii", $_POST['bus_name'], $_POST['bus_time'], $_POST['cost'], $_POST['bus_id']);
    $stmt->execute();
    $_SESSION['success'] = "Bus updated successfully.";
    header("Location: manage_buses.php");
    exit();
}

if (isset($_GET['delete_bus'])) {
    $bus_id = $_GET['delete_bus'];

    // get bus name
    $stmt = $conn->prepare("SELECT bus_name FROM buses WHERE id = ?");
    $stmt->bind_param("i", $bus_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $bus_name = $result->fetch_assoc()['bus_name'];

    // delete associated records
    $conn->query("DELETE FROM booked_seats WHERE bus_name = '$bus_name'");
    $conn->query("DELETE FROM bookings WHERE bus_name = '$bus_name'");
    $conn->query("DELETE FROM buses WHERE id = $bus_id");

    $_SESSION['success'] = "Bus and related data deleted.";
    header("Location: manage_buses.php");
    exit();
}
?>

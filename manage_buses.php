<?php
session_start();
$conn = new mysqli("localhost", "root", "", "register_db");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);


include 'bus_operations.php';


$bus_to_edit = null;
if (isset($_GET['edit_bus'])) {
    $stmt = $conn->prepare("SELECT * FROM buses WHERE id = ?");
    $stmt->bind_param("i", $_GET['edit_bus']);
    $stmt->execute();
    $bus_to_edit = $stmt->get_result()->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Buses</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            background-color: #f4f6f8;
        }

        h2, h3 {
            color: #333;
        }

        .success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            width: 100%;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="text"], input[type="time"], input[type="number"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th {
            background-color: #343a40;
            color: white;
            padding: 12px;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.button {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        a.button:hover {
            opacity: 0.9;
        }

        .edit {
            background-color: #28a745;
            color: white;
        }

        .delete {
            background-color: #dc3545;
            color: white;
        }
nav a {
      color:black;
      margin-left: 90%;
      text-decoration: none;
      font-weight:bold;

    }

    </style>
</head>
<body>

<h2>Manage Buses</h2>

<?php if (!empty($_SESSION['success'])): ?>
    <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
<?php endif; ?>

<h3><?= $bus_to_edit ? "Edit Bus" : "Add Bus"; ?></h3>

<form method="POST">
    <?php if ($bus_to_edit): ?>
        <input type="hidden" name="bus_id" value="<?= $bus_to_edit['id'] ?>">
    <?php endif; ?>

    <label>Bus Name:
        <input name="bus_name" value="<?= htmlspecialchars($bus_to_edit['bus_name'] ?? '') ?>" required>
    </label>

    <label>Bus Time:
        <input type="time" name="bus_time" value="<?= htmlspecialchars($bus_to_edit['bus_time'] ?? '') ?>" required>
    </label>

    <label>Cost:
        <input type="number" name="cost" value="<?= htmlspecialchars($bus_to_edit['cost'] ?? '') ?>" required>
    </label>

    <button type="submit" name="<?= $bus_to_edit ? 'edit_bus' : 'add_bus' ?>">
        <?= $bus_to_edit ? 'Update Bus' : 'Add Bus' ?>
    </button>
</form>

<h3>Existing Buses</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Time</th>
        <th>Cost</th>
        <th>Actions</th>
    </tr>
    <?php
    $result = $conn->query("SELECT * FROM buses");
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>" . htmlspecialchars($row['bus_name']) . "</td>
            <td>{$row['bus_time']}</td>
            <td>₹{$row['cost']}</td>
            <td>
                <a class='button edit' href='?edit_bus={$row['id']}'>Edit</a>
                <a class='button delete' href='?delete_bus={$row['id']}' onclick='return confirm(\"Delete this bus and all its bookings?\")'>Delete</a>
            </td>
        </tr>";
    }
    ?>
</table>
<br>
<nav>
<a href="admin_dashboard">BACK</a>
</nav>

</body>
</html>

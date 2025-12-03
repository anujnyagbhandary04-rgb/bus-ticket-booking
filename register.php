<?php
session_start();

$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "register_db";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $usernameInput = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validate inputs
    if (empty($firstname) || empty($lastname) || empty($usernameInput) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
        $_SESSION['error'] = "All fields are required!";
    } elseif (strlen($usernameInput) < 6) {
        $_SESSION['error'] = "Username must be at least 6 characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $_SESSION['error'] = "Phone number must be 10 digits.";
    } elseif ($password !== $confirmPassword) {
        $_SESSION['error'] = "Passwords do not match!";
    } elseif (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters.";
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one uppercase letter.";
    } elseif (!preg_match('/[a-z]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one lowercase letter.";
    } elseif (!preg_match('/\d/', $password)) {
        $_SESSION['error'] = "Password must contain at least one digit.";
    } elseif (!preg_match('/[@$!%*?&]/', $password)) {
        $_SESSION['error'] = "Password must contain at least one special character (@$!%*?&).";
    } else {
        
        $check_username_stmt = $conn->prepare("SELECT * FROM registration WHERE username = ?");
       $check_username_stmt->bind_param("s", $usernameInput);
        $check_username_stmt->execute();
        $check_username_result = $check_username_stmt->get_result();

        if ($check_username_result->num_rows > 0) {
           $_SESSION['error'] = "Username already exists. Please use another username.";
            header("Location: register.php");
            exit();
       }

        
        $check_email_stmt = $conn->prepare("SELECT * FROM registration WHERE email = ?");
        $check_email_stmt->bind_param("s", $email);
        $check_email_stmt->execute();
        $check_email_result = $check_email_stmt->get_result();

        if ($check_email_result->num_rows > 0) {
            $_SESSION['error'] = "Email already registered. Please use another email.";
            header("Location: register.php");
            exit();
        }

        
        $check_phone_stmt = $conn->prepare("SELECT * FROM registration WHERE phone = ?");
        $check_phone_stmt->bind_param("s", $phone);
        $check_phone_stmt->execute();
        $check_phone_result = $check_phone_stmt->get_result();

        if ($check_phone_result->num_rows > 0) {
            $_SESSION['error'] = "Phone number already registered. Please use another phone number.";
            header("Location: register.php");
            exit();
        }

        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO registration (firstname, lastname, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $usernameInput, $email, $phone, $hashed_password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Registration successful!";
            $_SESSION['username'] = $usernameInput;
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['error'] = "Database error: " . $stmt->error;
        }

        $stmt->close();
    }

    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('register-background.jpg');
            background-size: cover;
            background-position: center;
            margin: 0;
        }

        .navbar {
    background-color: #0057b7;
    color: white;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1000;
}

        .navbar .logo {
            font-weight: bold;
            font-size: 40px;
        }

        .navbar .route {
            font-size: 16px;
            margin-left: 10px;
        }

        .navbar .right a {
            color: white;
            text-decoration: none;
            margin-right: 80px;
            font-weight:bold;
        }

        .form-container {
            max-width: 360px;
	    margin: 120px auto;
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 25px;
            border: 4px solid black;
            backdrop-filter: blur(10px);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
        }

        button {
            width: 60%;
            padding: 10px;
            margin: 10px auto;
            display: block;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #0056b3;
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .success {
            background-color: #d4edda;
            color: green;
            padding: 10px;
            margin-bottom: 10px;
        }

        .error {
            background-color: #f8d7da;
            color: red;
            padding: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <div>
            <span class="logo">GOBUS</span>
            <span class="route">Udupi → Bangalore</span>
        </div>
        <div class="right">
            <a href="home.php">Home</a>
        </div>
    </div>

    <div class="form-container">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        } elseif (isset($_SESSION['error'])) {
            echo "<div class='error'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        ?>

        <h2>REGISTER NOW</h2>

        <form method="POST" action="">
            <input type="text" name="firstname" placeholder="First Name" required>
            <input type="text" name="lastname" placeholder="Last Name" required>
            <input type="text" name="username" placeholder="Username (min 6 characters)" required minlength="6">
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="phone" placeholder="Phone Number" maxlength="10" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>

        <div class="login-link">
            Already have an account? <a href="login.php">LOGIN</a>
        </div>
    </div>

</body>
</html>

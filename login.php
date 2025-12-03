<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'register_db');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM registration WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['message'] = "<span class='success'>Login Successful! Welcome, </span>" . htmlspecialchars($username);
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['message'] = "<span class='error'>Incorrect Password!</span>";
        }
    } else {
        $_SESSION['message'] = "<span class='error'>Username not found!</span>";
    }
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('user-background.jpg') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: #0057b7;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            font-weight: bold;
            font-size: 26px;
        }

        .navbar .route {
            font-size: 16px;
            margin-left: 10px;
        }

        .navbar .right a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
        }

        .navbar .right a:hover {
            text-decoration: underline;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 10px;
            border: 2px solid black;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            width: 350px;
            margin: auto;
            margin-top: 60px;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 25px;
            color:black;
        }

        input[type="text"], input[type="password"] {
            width: 95%;
            padding: 12px;
            margin: 8px 0 16px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

       .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 14px;
        }

        .options a {
            color: #0057b7;
            text-decoration: none;
        }

        .options a:hover {
            text-decoration: underline;
        }

        .error, .success {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            opacity: 1;
            transition: opacity 1s ease;
        }

        .error {
            color: red;
        }

        .success {
            color: limegreen;
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

<div class="login-container">
    <center>
    <?php
    if (isset($_SESSION['message'])) {
        echo "<div id='flash-message'>" . $_SESSION['message'] . "</div>";
        
        unset($_SESSION['message']);
        session_write_close();
    }
    ?>
    </center>

    <h2>Login</h2>
    <form method="POST" autocomplete="off">
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" autocomplete="new-password" required>
        <button type="submit" name="login">Login</button>
    <div class="options">
            <label><input type="checkbox"> Remember me</label>
            <a href="forgot_password.php">Forgot password?</a>
        </div>
    </form>
</div>

<script>
    
    window.onload = function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
            }, 5000); 
            setTimeout(() => {
                flashMessage.remove();
            }, 6000); 
        }
    }
</script>

</body>
</html>

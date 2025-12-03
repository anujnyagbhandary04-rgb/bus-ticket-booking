<?php 
session_start();
$loginResult = "";  

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $username = $_POST['username']; 
    $password = $_POST['password']; 

    // Database Connection 
    $conn = new mysqli('localhost', 'root', '', 'admin_db'); 

    if ($conn->connect_error) { 
        die("Connection failed: " . $conn->connect_error); 
    } 

    // Secure query using prepared statements
    $stmt = $conn->prepare("SELECT * FROM admin_login WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result(); 

    if ($result->num_rows == 1) {
        // Store login state in session if needed
        $_SESSION['username'] = $username;

        // Redirect to dashboard
        header("Location: admin_dashboard.php");
        exit();
    } else { 
        $loginResult = "<h2 style='color:red;'>Login Failed! Invalid username or password.</h2>"; 
    } 

    $stmt->close();
    $conn->close(); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Form with Icons</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('admin-background.jpg') no-repeat center center/cover;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: transparent;
            padding: 40px;
            border-radius: 10px;
            width: 350px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
            border: 5px solid black;
            backdrop-filter: blur(8px);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .input-box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f1f1f1;
        }

        .icon-box {
            width: 50px;
            text-align: center;
            background: #ddd;
            padding: 10px;
            border-right: 1px solid #ccc;
        }

        .input-box input {
            border: none;
            outline: none;
            padding: 10px;
            width: 100%;
            background: transparent;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .login-btn:hover {
            background-color: #2980b9;
        }

        .eye-icon {
            cursor: pointer;
        }

        .result-message {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<form action="" method="post" class="login-container" autocomplete="off">
    <h2>Login</h2>

    <div class="input-box">
        <div class="icon-box">
            <img src="https://img.icons8.com/ios-filled/30/000000/user.png" alt="User Icon">
        </div>
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-box">
        <div class="icon-box">
            <img id="eyeIcon" src="https://img.icons8.com/ios-filled/30/000000/lock.png" alt="Lock Icon" onclick="togglePassword()" class="eye-icon">
        </div>
        <input type="password" name="password" id="passwordField" placeholder="Password" autocomplete="new-password" required>
    </div>

    <button type="submit" class="login-btn">Login</button>

    <div class="result-message">
        <?php echo $loginResult; ?>
    </div>
</form>

<script>
function togglePassword() {
    const passwordField = document.getElementById('passwordField');
    const eyeIcon = document.getElementById('eyeIcon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        eyeIcon.src = 'https://img.icons8.com/ios-filled/30/000000/closed-eye.png';
    } else {
        passwordField.type = 'password';
        eyeIcon.src = 'https://img.icons8.com/ios-filled/30/000000/lock.png';
    }
}
</script>

</body>
</html>

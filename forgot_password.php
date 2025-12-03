<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'register_db');
$message = '';
$msg_class = '';

if (isset($_POST['next'])) {
    $username = trim($_POST['username']);

    if (empty($username)) {
        $_SESSION['message'] = "Username is required.";
        $_SESSION['msg_class'] = "error";
    } else {
        $stmt = $conn->prepare("SELECT * FROM registration WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['username'] = $username;
            header("Location: reset_password.php");
            exit();
        } else {
            $_SESSION['message'] = "Username not found. Please try again.";
            $_SESSION['msg_class'] = "error";
        }
    }
    header("Location: forgot_password.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password | GOBUS</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: url('forgot.jpg');
            background-size: cover;
            background-position: center;
        }

        .container {
            display: flex;
            width: 800px;
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background-color: #ffffff;
        }

        .left-panel {
            flex: 1;
            background-color: #1e3a8a;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
        }

        .left-panel h2 {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .left-panel p {
            font-size: 16px;
            line-height: 1.5;
        }

        .right-panel {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-panel h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .error {
            background-color: #f8d7da;
            color: #842029;
        }

        form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #1e3a8a;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #3b82f6;
        }

        .back-link {
            text-align: center;
            margin-top: 15px;
        }

        .back-link a {
            color: #1e3a8a;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <h2>Welcome Back!</h2>
            <p>Enter your username to reset your password and get back on track. We'll guide you through the process smoothly.</p>
        </div>

        <div class="right-panel">
            <h2>Forgot Password</h2>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="message <?php echo $_SESSION['msg_class']; ?>">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message'], $_SESSION['msg_class']); ?>
            <?php endif; ?>

            <form method="POST">
                <input 
                    type="text" 
                    name="username" 
                    placeholder="Enter your Username" 
                    required
                />
                <button type="submit" name="next">
                    Next
                </button>
            </form>

            <div class="back-link">
                <a href="login.php">Back to Login</a>
            </div>
        </div>
    </div>
</body>
</html>

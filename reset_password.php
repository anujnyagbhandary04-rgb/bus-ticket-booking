<?php 
session_start(); 
$conn = new mysqli('localhost', 'root', '', 'register_db');

if (!isset($_SESSION['username'])) {
    header('Location: forgot_password.php');
    exit();
}

$username = $_SESSION['username'];

$user_check = "SELECT * FROM registration WHERE username='$username'";
$result = $conn->query($user_check);

if ($result->num_rows != 1) {
    $_SESSION['message'] = 'Username not found. Password cannot be reset.';
    $_SESSION['msg_class'] = 'error';
    session_destroy();
} elseif (isset($_POST['reset'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $_SESSION['message'] = 'Passwords do not match.';
        $_SESSION['msg_class'] = 'error';
    } elseif (strlen($new_password) < 6) {
        $_SESSION['message'] = 'Password must be at least 6 characters.';
        $_SESSION['msg_class'] = 'error';
    } elseif (!preg_match('/[A-Z]/', $new_password)) {
        $_SESSION['message'] = 'Password must include at least one uppercase letter.';
        $_SESSION['msg_class'] = 'error';
    } elseif (!preg_match('/[a-z]/', $new_password)) {
        $_SESSION['message'] = 'Password must include at least one lowercase letter.';
        $_SESSION['msg_class'] = 'error';
    } elseif (!preg_match('/\d/', $new_password)) {
        $_SESSION['message'] = 'Password must include at least one number.';
        $_SESSION['msg_class'] = 'error';
    } elseif (!preg_match('/[\W_]/', $new_password)) {
        $_SESSION['message'] = 'Password must include at least one special character.';
        $_SESSION['msg_class'] = 'error';
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update = "UPDATE registration SET password='$hashed_password' WHERE username='$username'";
        
        if ($conn->query($update)) {
            $_SESSION['message'] = 'Password reset successful. <a href="login.php">Login</a>';
            $_SESSION['msg_class'] = 'success';
            header('Refresh: 3; URL=login.php');
        } else {
            $_SESSION['message'] = 'Failed to update password.';
            $_SESSION['msg_class'] = 'error';
        }
    }
    header('Location: reset_password.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Reset Password | GoBus</title>
    <style>
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: linear-gradient(to right, #0072ff, #00c6ff);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 500px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .message {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            font-size: 14px;
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
            background-color: #0072ff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #005bb5;
        }

        .btn-group {
            display: flex;
            gap: 10px;
        }

        .btn-group a {
            flex: 1;
            display: inline-block;
            text-align: center;
            padding: 12px;
            background-color: #6c757d;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-group a:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Reset Your Password</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class='message <?php echo $_SESSION['msg_class']; ?>'>
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['msg_class']); ?>
        <?php endif; ?>

        <form method='POST'>
            <input 
                type='password' 
                name='new_password' 
                placeholder='New Password' 
                required
            />
            <input 
                type='password' 
                name='confirm_password' 
                placeholder='Confirm Password' 
                required
            />
            <div class="btn-group">
                <button type='submit' name='reset'>
                    Reset Password
                </button>
                <a href='forgot_password.php'>Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>

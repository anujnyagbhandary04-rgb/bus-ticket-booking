<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - GOBUS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #e0f7ff, #f2f9ff);
        }

        header {
            background-color: #0056ba;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-route h2 {
            font-size: 32px;
            margin: 0;
        }

        .logo-route .route {
            font-size: 14px;
            margin-left: 10px;
            color: #d3e9ff;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: bold;
            font-size: 16px;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            max-width: 1000px;
            margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .contact-info {
            flex: 1;
            padding: 40px 30px;
        }

        .contact-info h2 {
            font-size: 24px;
            margin-bottom: 30px;
            color: #004080;
            text-align: center;
        }

        .info-box {
            background-color: #f0f8ff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .info-box .icon {
            font-size: 22px;
            margin-right: 10px;
            vertical-align: middle;
        }

        .info-box p {
            margin: 0;
            font-size: 16px;
        }

        .illustration {
            flex: 1;
            background: url('contact.jpeg') no-repeat center;
            background-size: cover; 
            min-height: 400px;
            height: 100%; 
            width: 100%;
            object-fit: cover; 
        }

        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }

            .illustration {
                min-height: 250px;
                background-size: cover;
                object-fit: cover;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
            }

            nav {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="logo-route">
        <h2>GOBUS</h2>
        <span class="route">Udupi → Bangalore</span>
    </div>
    <nav>
        <a href="home.php">Home</a>
    </nav>
</header>

<div class="main-container">
    <div class="contact-info">
        <h2>CONTACT US</h2>

        <div class="info-box">
            <span class="icon">📧</span>
            <p><strong>Email:</strong> contact@gobus.com</p>
        </div>

        <div class="info-box">
            <span class="icon">📞</span>
            <p><strong>Phone:</strong> +91 98765 43210</p>
        </div>

        <div class="info-box">
            <span class="icon">🏢</span>
            <p><strong>Address:</strong><br>
                GOBUS Pvt Ltd,<br>
                Majestic Bus Terminal,<br>
                Bangalore, Karnataka - 560009
            </p>
        </div>
    </div>

    <div class="illustration"></div>
</div>

</body>
</html>

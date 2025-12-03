<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - GOBUS</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #e0f0ff;
            padding-top: 80px;         }

        header {
            background-color: #0056b3;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 40px;
            position: fixed; 
            top: 0; 
            left: 0;
            width: 100%; 
            z-index: 1000; 
}

        header h1 {
            font-size: 48px;
            margin: 0;
            font-weight: bold;
        }

        header span {
            margin-left: 15px;
            font-size: 20px;
        }

        nav a {
            color: white;
            font-weight: bold;
            font-size: 18px;
            text-decoration: none;
            margin-right: 70px; 
        }

        nav a:hover {
            text-decoration: underline; 
        }

        .about-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 900px;
            margin: 40px auto;
        }

        h1, h2 {
            color: #003366;
        }

        p {
            color: #444;
            line-height: 1.6;
            font-size: 16px;
        }

        .faq {
            margin-top: 40px;
        }

        .faq h2 {
            text-align: center;
            font-size: 36px;
        }

        .faq-item {
            margin: 15px 0;
        }

        .faq-question {
            background: #f0f0f0;
            color: #000;
            border: none;
            width: 100%;
            padding: 12px;
            text-align: left;
            font-size: 17px;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 4px;
        }

        .faq-answer {
            display: none;
            padding: 10px;
            background: white;
            border-left: 3px solid #0056b3;
            font-size: 15px;
            margin-top: 5px;
        }

    </style>
</head>
<body>

<header>
    <div style="display: flex; align-items: center;">
        <h1>GOBUS</h1>
        <span>Udupi → Bangalore</span>
    </div>
    <nav>
        <a href="home.php" onclick="startLoading('home.php')">Home</a>
    </nav>
</header>

<div class="about-container">
    <h1><center>About Us</center></h1>
    <p>
        Welcome to <strong>GOBUS</strong> — your reliable travel partner. Our mission is to simplify your travel
        by providing a seamless, reliable, and efficient online bus booking platform.
        Our system allows you to easily search, select, and reserve your seats from the comfort of your home.
    </p>
    <p>
        With GOBUS, enjoy transparent pricing, real-time seat availability, secure payments, and a user-friendly interface.
        Our goal is to make your travel experience smooth, safe, and comfortable — whether you're heading home or exploring a new city.
    </p>
    <p><strong><center>Thank you for choosing GOBUS. Happy traveling!</center></strong></p>

    <div class="faq">
        <h2>FAQs</h2>

        <div class="faq-item">
            <button class="faq-question">How do I book a ticket? <span>&#9660;</span></button>
            <div class="faq-answer">Visit our website, go to "Book Ticket", choose your seats, and complete payment online.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">What payment methods are accepted? <span>&#9660;</span></button>
            <div class="faq-answer">We accept debit cards, credit cards, UPI</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Can I cancel my ticket? <span>&#9660;</span></button>
            <div class="faq-answer">Yes, you can cancel your ticket up to 2 hours before departure. Refunds are subject to our cancellation policy.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Do I need a printout of my ticket? <span>&#9660;</span></button>
            <div class="faq-answer">No, you can show your e-ticket confirmation during boarding.please download pdf of Ticket for the Bus Number.</div>
        </div>

        <div class="faq-item">
            <button class="faq-question">Is there customer support available? <span>&#9660;</span></button>
            <div class="faq-answer">Yes, we are available 24/7 to assist you through our helpline and email.</div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".faq-question").forEach(button => {
                button.addEventListener("click", () => {
                    let answer = button.nextElementSibling;
                    answer.style.display = answer.style.display === "block" ? "none" : "block";
                });
            });
        });    
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyBus - Online Bus Booking</title>
  <!-- Add Font Awesome CDN for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <style>
    * {
      margin: 0; padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', sans-serif;
    }
    body {
      background: #f5f7fa;
      color: #333;
      padding-top: 80px;  
    }
    header {
      background: #0057b8;
      color: white;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: fixed;  
      top: 0;  
      left: 0;
      width: 100%;  
      z-index: 1000;  
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);  
    }
    header .logo-container {
      display: flex;
      align-items: center;
    }
    header h1 {
      font-size: 50px;
    }
    nav a {
      color: white;
      margin-left: 20px;
      text-decoration: none;
      font-weight: bold;
    }
    .hero {
      background: url('homebus.gif') no-repeat center center/cover;
      height: 500px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: white;
      text-align: center;
    }
    .hero h2{
      font-size: 40px;
      margin-bottom: 30%;
      color: black;
    }
    .features {
      display: flex;
      justify-content: space-around;
      margin: 40px 0;
      text-align: center;
    }
    .features div {
      width: 30%;
    }
    .features h3 {
      margin-bottom: 10px;
      color: #00008B;
    }

    .popular-buses {
      padding: 40px;
      background: #eef1f5;
    }
    .popular-buses h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .routes {
      display: flex;
      justify-content: space-around;
    }
    .routes div {
      background: white;
      padding: 20px;
      border-radius: 8px;
      width: 28%;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .testimonials {
      padding: 40px;
      text-align: center;
    }
    .testimonials h2 {
      margin-bottom: 30px;
    }
    .testimonial {
      background: white;
      margin: 0 auto;
      padding: 20px;
      max-width: 600px;
      border-left: 5px solid #0057b8;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    footer {
      background: #333;
      color: white;
      padding: 20px;
      text-align: center;
    }
    footer p {
      margin: 5px 0;
    }
    footer a { 
      color: #fff;
      text-decoration: none; 
      margin-left: 20px; 
      cursor: pointer; 
    }
    footer a:hover {
      text-decoration: underline;
    }

    /* Add social media icon styling */
    footer .social-icons {
      margin-top: 10px;
    }
    footer .social-icons a {
      margin: 0 10px;
      font-size: 24px;
      color: #fff;
    }

    #progressBarContainer { 
      width: 100%; 
      background-color: #ccc;
      height: 5px; 
      position: fixed; 
      top: 0; 
      left: 0; 
      z-index: 9999; 
    }
    #loader {
      width: 0;
      height: 5px;
      background-color: grey;
    }

    .route {
      font-size: 16px;
      color: #f1f1f1;
      margin-top: 1px;
      margin-left: 8px;
    }
.rate-us {
  padding: 40px;
  background: #f7fafd;
  margin-top: 40px;
}

.rate-container {
  max-width: 600px;
  margin: auto;
  background: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  text-align: center;
}

.rate-container label {
  font-weight: bold;
  color: #333;
}

.stars {
  direction: rtl;
  display: inline-block;
}

.stars input[type="radio"] {
  display: none;
}

.stars label {
  font-size: 30px;
  color: #ccc;
  cursor: pointer;
}

.stars input[type="radio"]:checked ~ label {
  color: #fbc02d;
}

.stars label:hover,
.stars label:hover ~ label {
  color: #fdd835;
}

textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 6px;
  resize: vertical;
  font-size: 16px;
}

button[type="submit"] {
  background-color: #0057b8;
  color: white;
  border: none;
  padding: 10px 25px;
  font-size: 16px;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.3s;
}

button[type="submit"]:hover {
  background-color: #00449e;
}
.routes div:hover {
  transform: translateY(-10px) scale(1.03);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}
.trending-offers section:hover {
  transform: translateY(-10px) scale(1.03);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}
  </style>
</head>
<body>
<div id="progressBarContainer"><div id="loader"></div></div>

<header>
  <div class="logo-container">
   <h1> GOBUS</h1>
   <p class="route">Udupi → Bangalore</p>
 </div>
  <nav>
        <a href="#" onclick="startLoading('home.php')">Home</a>
        <a href="#" onclick="startLoading('about.php')">About Us</a>
        <a href="#" onclick="startLoading('contact.php')">Contact Us</a>
        <a href='#' onclick="startLoading('register.php')">Register</a>
    </nav>
</header>

<div class="hero">
  <h2>Book Your Bus Tickets Online</h2>
</div>

<div class="features">
  <div>
    <h3>Live Seat Availability</h3>
    <p>See real-time updates of available seats and book instantly.</p>
  </div>
  <div>
    <h3>Secure Payment</h3>
    <p>Enjoy secure and flexible payment options including <br>cards and UPIs.</p>
  </div>
  <div>
    <h3>Easy Cancellations</h3>
    <p>Cancel your bookings 2 hours before Departure with full refund options.</p>
  </div>
</div>

<section class="popular-buses">
  <h2>Popular Buses</h2>
  <div class="routes">
    <div>
      <img src="bus1.png" alt="Dolphin Bus" style="width:100%; height:auto; border-radius:8px;">
      <h4 style="text-align:center;">Dolphin</h4>
      <p style="text-align:center;">AC & Non-AC | Starting ₹600</p>
    </div>
    <div>
      <img src="bus2.png" alt="Canara Bus" style="width:100%; height:auto; border-radius:8px;">
      <h4 style="text-align:center;">Canara</h4>
      <p style="text-align:center;">Hourly Departures | ₹500 onwards</p>
    </div>
    <div>
      <img src="bus3.png" alt="Tulsi Bus" style="width:100%; height:auto; border-radius:8px;">
      <h4 style="text-align:center;">Tulsi</h4>
      <p style="text-align:center;">Fast Express | 8hrs journey</p>
    </div>
  </div>
</section>

<section class="testimonials">
  <h2>What Our Users Say</h2>
  <div class="testimonial">
    <p>“GoBus made my journey hassle-free. Quick booking, easy seat selection, and instant confirmation. Highly recommended!” – <strong>Priya R.</strong></p>
  </div>
</section>
<section class="trending-offers">
  <h2 style="text-align:center; margin-top: 20px; color:#0057b8;">Trending Offers</h2>
  <div style="display: flex; justify-content: space-around; padding: 20px 40px;">
    <section style="background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px; width: 30%; text-align: center;">
      <h4 style="color: #00008B;">🎉 25% Off on First Booking</h4>
      <p>Use code <strong>GOBUS25</strong> and get instant 25% off on your first ticket.</p>
    </section>
    <section style="background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px; width: 30%; text-align: center;">
      <h4 style="color: #00008B;">🔥 Refer & Earn</h4>
      <p>Refer friends & earn ₹100 wallet credit on every successful signup.</p>
    </section>
    <section style="background: white; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); padding: 20px; width: 30%; text-align: center;">
      <h4 style="color: #00008B;">💳 Cashback on UPI</h4>
      <p>Book using UPI & get 10% cashback directly to your wallet.</p>
    </section>
  </div>
</section>
<section class="rate-us">
  <h2 style="text-align:center; color:#0057b8; margin-bottom: 20px;">Rate Us & Feedback</h2>
  <div class="rate-container">
    <?php
      if ($_SERVER["REQUEST_METHOD"] === "POST") {
          $name = htmlspecialchars($_POST['name']);
          $email = htmlspecialchars($_POST['email']);
          $rating = $_POST['rating'];
          $feedback = htmlspecialchars($_POST['feedback']);

          $conn = new mysqli("localhost", "root", "", "register_db");
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, message) VALUES (?, ?, ?, ?)");
          $stmt->bind_param("ssis", $name, $email, $rating, $feedback);
          $stmt->execute();

          echo "<p style='color: green; font-weight: bold;'>Feedback submitted successfully!</p>";
          $stmt->close();
          $conn->close();
      }
    ?>

    <form method="POST">
      <label for="name">Your Name:</label><br>
      <input type="text" name="name" id="name" required style="width: 100%; padding: 10px; margin-bottom: 10px;"><br>

      <label for="email">Your Email:</label><br>
      <input type="email" name="email" id="email" required style="width: 100%; padding: 10px; margin-bottom: 10px;"><br>

      <label for="rating">How would you rate your experience?</label><br>
      <div class="stars">
        <input type="radio" name="rating" value="5" id="star5" required><label for="star5">&#9733;</label>
        <input type="radio" name="rating" value="4" id="star4"><label for="star4">&#9733;</label>
        <input type="radio" name="rating" value="3" id="star3"><label for="star3">&#9733;</label>
        <input type="radio" name="rating" value="2" id="star2"><label for="star2">&#9733;</label>
        <input type="radio" name="rating" value="1" id="star1"><label for="star1">&#9733;</label>
      </div><br><br>

      <label for="feedback">Your Feedback:</label><br>
      <textarea name="feedback" id="feedback" rows="5" placeholder="Tell us what you loved or what we can improve..." required></textarea><br><br>

      <button type="submit">Submit Feedback</button>
    </form>
  </div>
</section>


<footer>
  <p>&copy; 2025 GoBus. All rights reserved.</p>
  <p>Contact: support@Gobus.com | +91-9999-123456</p>
  <p><a href="#" onclick="startLoading('adminlogin.php')">Admin</a></p>
  
  <!-- Social Media Icons -->
  <div class="social-icons">
    <a href="https://www.facebook.com" target="_blank" class="fab fa-facebook-f"></a>
    <a href="https://www.instagram.com" target="_blank" class="fab fa-instagram"></a>
    <a href="https://www.twitter.com" target="_blank"i class="fab fa-twitter"></i></a>

  </div>
</footer>

<script>
  var isLoading = false;

  function startLoading(page) {
      if (isLoading) return; 
      isLoading = true;

      var loader = document.getElementById('loader');
      loader.style.width = '0%';

      var progress = 0;
      var interval = setInterval(function() {
          if (progress >= 100) {
              clearInterval(interval);
              isLoading = false;
              window.location.href = page; 
          } else {
              progress += 5;
              loader.style.width = progress + '%';
          }
      }, 50); 
  }

  
  window.onload = function() {
      document.getElementById('loader').style.width = '0%';
      isLoading = false;
  }
</script>

</body>
</html>

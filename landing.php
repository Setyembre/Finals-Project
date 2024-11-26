

<?php
// Start the session
session_start();

// Set a cookie to track the user's visit
setcookie("visited", "yes", time() + 86400); // expires in 1 day

// Check if the user has already visited the site
if (isset($_COOKIE["visited"])) {
    echo "Welcome back!";
} else {
    echo "Welcome to our site!";
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Filter the form inputs
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $pwd = filter_var($_POST['pwd'], FILTER_SANITIZE_STRING);

    // Create a connection to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare statement to retrieve the user data
    $stmt = $conn->prepare("SELECT id, username, pwd FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $username, $hashedPwd);
    $stmt->fetch();

    if ($id && password_verify($pwd, $hashedPwd)) {
        // If password is correct, store user info in session
        $_SESSION['user_id'] = $id;
        $_SESSION['username'] = $username;

        // Redirect to website.php
        header("Location: website.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- landing.php -->
<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Senior Tech Support</title>
    <link rel="stylesheet" href="landing.css">
</head>
<body>
<header>
<div class="logo">
  <img src="pics\gentle tch logo.png" alt="Your Company Logo">
</div>
  <nav>
    <ul class="nav-menu">
      <li class="nav-item">
        <a href="website.php" class="nav-link">About Us</a>
      </li>
      <li class="nav-item">
        <a href="services.php" class="nav-link">Services</a>
      </li>
      <li class="nav-item">
        <button id="contact-btn" onclick="openSidebar()">Contact</button>
      </li>
    </ul>
  </nav>
</header>
    <main>
    <div class="welcome-message">
    <h1>Welcome to SilverConnect!</h1>
    <p>Bridging Generations Through Technology.</p>
  </div>
        <section id="hero">
            <div class="hero-image">
                <img src="pics\bg.jpg" alt="Senior using technology">
            </div>
            <div class="hero-content">
                <h1>Empowering Seniors with Technology</h1>
                <p>We provide personalized tech support for elderly individuals who struggle with technology. <br>Our mission is to bridge the digital gap, helping seniors stay connected with loved ones,<br> explore new possibilities, and gain confidence in using modern devices and applications.<br>
                 Whether it's setting up a smartphone, navigating social media, or understanding online safety, <br>
                  we're here to make technology simple, accessible, and enjoyable for every senior.</p>
            </div>
        </section>
       
  <!-- Sidebar structure -->
<div class="wrapper">
<div id="supportSidebar" class="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeSidebar()">&times;</a>
    <h2>Contact & Support</h2>

    <div class="contact-info">
        <h3>Contact Information</h3>
        <p><i class="fas fa-phone-alt"></i> +1 (123) 456-7890</p>
        <p><i class="fas fa-envelope"></i> silverconnect@gmail.com</p>
        <p><i class="fas fa-map-marker-alt"></i> 451 M.L. Quezon Street Muntinlupa City</p>
    </div>

    <div class="support-links">
        <h3>Support Options</h3>
        <a href="faq.php"><i class="fas fa-question-circle"></i> FAQ</a>
        <a href="troubleshoot.php"><i class="fas fa-tools"></i> Troubleshooting Guide</a>
        <a href="help.php" target="_blank"><i class="fas fa-headset"></i> Help Center</a>
    </div>

    <div class="quick-actions">
        <h3>Want to Avail Our</h3>
        <button onclick="openEmail()">Contact Us via Email</button>
    
    </div>

    <script>
  
// ... existing code ...
function openSidebar() {
  document.getElementById("supportSidebar").style.width = "20em";
  document.getElementById("supportSidebar").style.display = "block";
}

function closeSidebar() {
  document.getElementById("supportSidebar").style.width = "0";
  document.getElementById("supportSidebar").style.display = "none";
  document.querySelector('.closebtn').addEventListener('click', closeSidebar);
}
    function openEmail() {
        window.location.href = "mailto:support@example.com";
    }


</script>
</div>


    </main>
    <script src="landing.js"></script>
</body>
</html>
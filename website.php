<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "team_profile_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="body.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Team Profile</title>
</head>

<body>
    



<header>
<h1>This is Our Team</h1>
</header>

<section class="team">
    <?php
    // Fetch team members from the database
    $sql = "SELECT * FROM team_members";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($member = $result->fetch_assoc()) {
            echo '<div class="member-container">';
            echo '<img src="' . $member['image'] . '" alt="' . $member['name'] . '">';
            echo '<h2>' . $member['name'] . '</h2>';
            echo '<p>' . $member['role'] . '</p>';
            echo '<button onclick="showDetails(\'' . $member['name'] . '\', \'' . $member['studentid'] . '\', \'' . $member['age'] . '\', \'' . $member['address'] . '\', \'' . $member['email'] . '\')">Show Details</button>';

            // Social icons
            echo '<div class="social-icons">';
            echo '<a class="social-icon fb-icon" href="' . $member['facebook'] . '" target="_blank"><i class="fab fa-facebook-f"></i></a>';
            echo '<a class="social-icon ig-icon" href="' . $member['instagram'] . '" target="_blank"><i class="fab fa-instagram"></i></a>';
            echo '<a class="social-icon github-icon" href="' . $member['github'] . '" target="_blank"><i class="fab fa-github"></i></a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "<p>No team members found.</p>";
    }

    $conn->close();
    ?>
</section>


<?php include('footer.php');?>


<script src="script.js"></script>
</body>
</html>




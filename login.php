<?php
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my_database";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve and sanitize form inputs
    $email = htmlspecialchars($_POST['email']);
    $pwd = htmlspecialchars($_POST['pwd']);

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
        header("Location: landing.php");
        exit();
    } else {
        $error = "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="form.css">
    <title>Login</title>
 
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <div class="form">
        <form method="post" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="pwd" placeholder="Password" required>
            <button type="submit">Login</button>
            <div style="margin-top: 10px;">
    <button onclick="window.location.href='signup.php';">Don't have an Account? Signup</button>
</div>
        </form>
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>
</html>

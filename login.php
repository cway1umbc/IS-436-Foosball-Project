<?php
require 'dbcon.php';

$tbl_name = "IS436users"; // Table name 

// username and password sent from form 
$email = trim($_POST['email']); 
$password = trim($_POST['password']); 

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);

$email = mysqli_real_escape_string($conn, $email);

$sql = "SELECT * FROM $tbl_name WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_password = crypt($password, $row['password']);

    // Check if the hashed password matches the stored hashed password
    if ($hashed_password == $row['password']) {
        // Start a session and store the email as a session variable
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $email;

        // Redirect to the landing page
        header("Location: landingpg.html");
        exit();
    }
}

// If the login credentials are invalid, redirect to the login page with an error message
header("Location: login.html?error=1");
exit();
?>

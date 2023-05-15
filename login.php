<?php
require 'dbcon.php';

$tbl_name = "IS436users"; // Table name 

// Check if Google Sign-In was used to authenticate
if (isset($_POST['id_token'])) {
    // Verify the id_token using Google's API
    $id_token = $_POST['id_token'];
    $CLIENT_ID = "452465441402-kp5mq2ciaksifflseuq5tbkhcvkhrj8q.apps.googleusercontent.com";

    $url = "https://oauth2.googleapis.com/tokeninfo?id_token=".$id_token;
    $response = file_get_contents($url);
    $response = json_decode($response);

    if ($response->aud == $CLIENT_ID) {
        $email = $response->email;
        $name = $response->name;

        // Check if the user already exists in the database
        $sql = "SELECT * FROM $tbl_name WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // User already exists, start a session and store the email as a session variable
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;

            // Redirect to the landing page
            header("Location: landingpg.html");
            exit();
        } else {
            // User does not exist, insert the user into the database
            $sql = "INSERT INTO $tbl_name (email, name) VALUES ('$email', '$name')";
            if ($conn->query($sql) === TRUE) {
                // Start a session and store the email as a session variable
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;

                // Redirect to the landing page
                header("Location: landingpg.html");
                exit();
            } else {
                // If there is an error inserting the user into the database, redirect to the login page with an error message
                header("Location: login.html?error=2");
                exit();
            }
        }
    } else {
        // If the id_token is not valid, redirect to the login page with an error message
        header("Location: login.html?error=3");
        exit();
    }
}

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
        header("Location: landingpg.php");
        exit();
    }
}

// If the login credentials are invalid, redirect to the login page with an error message
header("Location: login.html?error=1");
exit();
?>

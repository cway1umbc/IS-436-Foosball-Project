<?php
// Connection
// File Name is dbcon.php

$servername = "studentdb-maria.gl.umbc.edu";
$username = "eunicea2";
$password = "eunicea2";
$dbname = "eunicea2";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Start a session
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  // Validate user inputs
  $u_fname = trim($_POST['u_fname']);
  $u_lname = trim($_POST['u_lname']);
  $u_email = trim($_POST['u_email']);
  $u_password = trim($_POST['u_password']);

  if (empty($u_fname) || empty($u_lname) || empty($u_email) || empty($u_password)) {
    // If any of the inputs is empty, return an error message
    die("Please fill all fields.");
  } else if (!filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
    // If email is invalid, return an error message
    die("Invalid email format.");
  }

  // Use prepared statement to prevent SQL injection
  $stmt = $conn->prepare("INSERT INTO sign up (u_fname, u_lname, u_email, u_password) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $u_fname, $u_lname, $u_email, $u_password);

  // Execute prepared statement and check for errors
  if ($stmt->execute()) {
    // Store user details in session
    $_SESSION['signup'] = true;
    $_SESSION['u_fname'] = $u_fname;
    $_SESSION['u_lname'] = $u_lname;
    header("Location: success.php");
    exit();
  } else {
    // If there is an error in executing the prepared statement, return an error message
    die("Error executing prepared statement: " . $stmt->error);
  }

  // Close prepared statement
  $stmt->close();
}
?>

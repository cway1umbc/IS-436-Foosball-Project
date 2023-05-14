<?php
$servername = "studentdb-maria.gl.umbc.edu";
$username = "eunicea2";
$password = "eunicea2";
$dbname = "eunicea2";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname)
            or die("Connection Failed: " . mysqli_connect_error());

    // Get form data
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Server-side validation
    if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
        die("All fields must be filled out");
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database
    $sql = "INSERT INTO `signup` (`fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$hashed_password')";

    // Execute query and check for success
    $query = mysqli_query($conn, $sql);
    if ($query) {
        header("Location: login.html");
        exit; // make sure to exit after the redirect
    } else {
        echo 'Error Occured';
    }
}
?>

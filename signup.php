<?php
$servername = "studentdb-maria.gl.umbc.edu";
$username = "eunicea2";
$password = "eunicea2";
$dbname = "eunicea2";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect($servername, $username, $password, $dbname)
            or die("Connection Failed: " . mysqli_connect_error());

    // Get form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

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
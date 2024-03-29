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

    // Hash the password using the crypt function
    $salt = '$2a$07$' . substr(md5(uniqid(rand(), true)), 0, 22);
    $hashed_password = crypt($password, $salt);

    // Insert into database
    $sql = "INSERT INTO `IS436users` (`fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$hashed_password')";

    // Execute query and check for success
    $query = mysqli_query($conn, $sql);
    if ($query) {
        // Redirect to confirmation page
        header("Location: confirmation.php");
        exit;
    } else {
        echo 'Error Occured';
    }
    if(!$query) {
        printf("Error message: %s\n", mysqli_error($conn));
    }
    
}
?>

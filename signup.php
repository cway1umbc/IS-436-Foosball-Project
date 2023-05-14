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

    // Validate form data
    $errors = array();
    if (empty($fname)) {
        $errors[] = "First name is required";
        echo "<script>alert('First name is required');</script>";
    }
    if (empty($lname)) {
        $errors[] = "Last name is required";
        echo "<script>alert('Last name is required');</script>";
    }
    if (empty($email)) {
        $errors[] = "Email is required";
        echo "<script>alert('Email is required');</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
        echo "<script>alert('Invalid email format');</script>";
    }
    if (empty($password)) {
        $errors[] = "Password is required";
        echo "<script>alert('Password is required');</script>";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long";
        echo "<script>alert('Password must be at least 6 characters long');</script>";
    }

    // If there are errors, display them to the user
    if (!empty($errors)) {
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
    } else {
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
            echo 'Error Occurred';
        }
    }

    // Close database connection
    mysqli_close($conn);
}
?>

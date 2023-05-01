<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
{
    echo "<H3>Welcome to the user's area, user: " . $_SESSION['email'] . "!</H3>";
} else {
    header("Location: index.html");
}
?>
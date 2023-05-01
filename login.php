<?php

require 'dbcon.php';
$tbl_name="retriever_users"; // Table name 



// username and password sent from form 
$email=$_POST['email']; 
$password=$_POST['password']; 

// To protect MySQL injection (more detail about MySQL injection)
$email = stripslashes($email);
$password = stripslashes($password);

$sql="SELECT * FROM $tbl_name WHERE email='$email' and password='$password'";
$result = $conn->query($sql);

// Mysql_num_row is counting table row
$count=$result->num_rows;

// If result matched $username and $password, table row must be 1 row
if($count==1){
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
	
	header("Location: index2.html"); /* Redirect browser */
	exit();
	}


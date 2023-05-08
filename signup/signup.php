<?php

// database connection
$servername = "studentdb-maria.gl.umbc.edu";
$username = "eunicea2";
$password = "eunicea2";
$dbname = "eunicea2";


	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$conn = mysqli_connect($servername, $username, $password, $dbname)
		or die("Connection Failed:" .mysqli_connect_error());
		
		// links variables and user inputs
		if(isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password'])){
			$fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			

			// Insert into database
			$sql = "INSERT INTO  `signup` ( `fname`,  `lname`,  `email`,  `password`) VALUES('$fname', '$lname', '$email', '$password')";
			
			
			// connection sucess check
			$query = mysqli_query($conn,$sql);
			if($query){
				echo 'Entry Sucessful';
			} else {
				echo 'Error Occured';
			}
		}
	}




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<button>Continue<a href= "index2.html"></button>
</body>
</html>

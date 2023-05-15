<?php
		// database connection
		$servername = "studentdb-maria.gl.umbc.edu";
        $username = "eunicea2";
        $password = "eunicea2";
        $dbname = "eunicea2";

		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
			$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection Failed: " . mysqli_connect_error());
			
			if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['location'])){
				$name = $_POST['name'];
				$description = $_POST['description'];
				$price = $_POST['price'];
				$location = $_POST['location'];
				
				$sql = "INSERT INTO `productlist` (`name`, `description`, `price`, `location`) VALUES ('$name', '$description', '$price', '$location')";
				
				$query = mysqli_query($conn, $sql);
                 
                if ($query) {
                
                    // Redirect to confirmation page
                    header("Location: productconfirmation.php");
                    exit;
                 } else {
                     echo 'Error Occured';
                }
                if(!$query) {
            printf("Error message: %s\n", mysqli_error($conn));
    }
    
			}
		}
	?>
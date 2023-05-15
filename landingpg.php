<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <link rel="stylesheet" href="landingpg.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <link rel="stylesheet" href="landingpg.css">
    <link rel="stylesheet" href="landingtable.css">
    <title> Retriever Landing Page </title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="landingpg.php" onclick="location.href='landingpg.php'">Home</a></li>
          <li><a href="product.html" onclick="location.href='product.html'">List a Product</a></li>
          <li><a href="viewproducts.php" onclick="location.href='viewproducts.php'">View Products</a></li>
        </ul>
      </nav>
    </header>
    <main>
      <h1>Welcome to Retriever!</h1>
      <div class="container">
    </div>
    </main>
    
<?php
// database connection
$servername = "studentdb-maria.gl.umbc.edu";
$username = "eunicea2";
$password = "eunicea2";
$dbname = "eunicea2";

// connect to database
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// select products from database
$sql = "SELECT * FROM `productlist`";
$result = mysqli_query($conn, $sql);

// check if any products were found
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $table = '<table style="border-collapse: collapse; width: 100%;">';
    $table .= '<tr><th>Name</th><th>Description</th><th>Price</th><th>Location</th></tr>';
    while($row = mysqli_fetch_assoc($result)) {
      echo '<div class="card">';
      echo '<div class="card-body">';
      echo '<h2 class="card-title">' . $row["name"] . '</h2>';
      echo '<p class="card-text">' . $row["description"] . '</p>';
      echo '<p class="card-price">' . $row["price"] . '</p>';
      echo '<p class="card-location">' . $row["location"] . '</p>';
      echo '</div>';
      echo '</div>';
    }
    $table .= '</table>';
} else {
    $table = '<p>No products found</p>';
}

// close database connection
mysqli_close($conn);
?>

<footer>
      <p>&copy; 2023 Retriever Inc. All rights reserved.</p>
    </footer>
  </body>
</html>


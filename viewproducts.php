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
        $table .= '<tr>';
        $table .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row["name"] . '</td>';
        $table .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row["description"] . '</td>';
        $table .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row["price"] . '</td>';
        $table .= '<td style="border: 1px solid #ddd; padding: 8px;">' . $row["location"] . '</td>';
        $table .= '</tr>';
    }
    $table .= '</table>';
} else {
    $table = '<p>No products found</p>';
}

// close database connection
mysqli_close($conn);
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap">
    <link rel="stylesheet" href="landingpg.css">
    <link rel="stylesheet" href="table.css">

</head>
<body>
<header>
      <nav>
        <ul>
          <li><a href="landingpg.html" onclick="location.href='landingpg.html'">Home</a></li>
          <li><a href="product.html" onclick="location.href='product.html'">List a Product</a></li>
          <li><a href="viewproducts.php" onclick="location.href='viewproducts.php'">View Products</a></li>
        </ul>
      </nav>
    </header>
        <h1>Products</h1>
    </div>
    <div class="container">
    <h1>Product Listing</h1>
        <?php echo $table; ?>
        <div id="add-product">
            <a href="product.html" class="btn">Add Product</a>
        </div>
    </div>
   
</body>
</html>

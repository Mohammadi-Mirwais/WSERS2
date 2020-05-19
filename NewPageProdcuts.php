<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="2tpife.css" />
  </head>
  <body>

  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "mirwais";
  $connection = mysqli_connect($servername, $username, $password, $database);
  if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $product = $connection->prepare("SELECT * FROM products");
  if (!$connection) {
    die("we did manage ro conecte your datbase");
  }
  $product->execute();
  $result = $product->get_result();
  while ($row = $result->fetch_assoc()) { ?>
<div class="Product">
  <img src="<?php print $row["Picture"]; ?>">
  <p><?php print $row["Description"]; ?></p>
  <p>Price:<?php print $row["Price"]; ?>&euro;</p>
  <br/>
</div>
<?php }
  ?>

  </body>
</html>


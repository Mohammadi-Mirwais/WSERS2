<form action="searchbar.php" method="post">
select country: <select id="countries" name="coutries">
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "mirwais";
$connection = mysqli_connect($servername, $username, $password, $database);
if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}

$nationallity = $connection->prepare("SELECT * FROM countries");
if (!$connection) {
  die("we did manage to conecte your datbase");
}

$nationallity->execute();
$result = $nationallity->get_result();
while ($row = $result->fetch_assoc()) { ?>

  
<option value="1"><?php print $row["COUNTRY_NAME"]; ?></option>
  


<?php }
?>

 
</select> 
<input type="submit" value="GO">
</form>

  </body>
</html>

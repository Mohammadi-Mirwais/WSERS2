<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Administration</title>
  <link rel='stylesheet' type='text/css' media='screen' href='2tpife.css'>
</head>
<body>

<nav id="navigationBar1">
        <div id="navigationTittle">
            
        </div>
        <div id=navigationLinks>
            <a href="2tpifeProducts.php">
                <h1>Products</h1>
            </a>
            <a href="2tpifeAbout.php">
                <h1>About</h1>
            </a>
            </div>
            </nav> 
   
        <div id="signup">
       
        
<?php
include_once "sessionCheck.php";
include_once "credentials.php";

if (!$_SESSION["UserLogged"]) {
  die("You are NOT allowed here !");
}

$userSelect = $connection->prepare(
  "SELECT User_type FROM ppl WHERE PERSON_ID=?"
);
$userSelect->bind_param("i", $_SESSION["CurrentUser"]);
$userSelect->execute();
$resultUser = $userSelect->get_result();
$rowUser = $resultUser->fetch_assoc();
if ($rowUser["User_type"] !== 1) {
  die("You are not an admin and not allowed here");
}
if (isset($_POST["userToDelete"])) {
  $users = $connection->prepare("DELETE FROM ppl WHERE UserName=?");
  $users->bind_param("s", $_POST["userToDelete"]);
  $users->execute();
}
$users = $connection->prepare("SELECT UserName FROM ppl WHERE PERSON_ID <>?");
$users->bind_param("i", $_SESSION["CurrentUser"]);
$users->execute();
$resultUsers = $users->get_result();
while ($rowUsers = $resultUsers->fetch_assoc()) {
  print $rowUsers["UserName"] . "<br>"; ?>
  <form action="Administration.php" method="post">
        <input type="hidden" name="userToDelete" value="<?php print $rowUsers[
          "UserName"
        ]; ?>" >
        <input type="submit" name="Delete" id="deleteButton" value="Delete">
    </form>
  <?php
}
if (isset($_POST["Add"])) {
  $addProduct = $connection->prepare(
    "INSERT INTO products(NAME,Description,Price,Picture) VALUES(?,?,?,?)"
  );
  $addProduct->bind_param(
    "ssis",
    $_POST["ProductName"],
    $_POST["Description"],
    $_POST["Price"],
    $_POST["Picture"]
  );
  $addProduct->execute();
  $resultProduct = $addProduct->get_result();
}
?>
<table>
  <form id="form" action="Administration.php" method="post">
    <tr><td>Name: <input type="text" name="ProductName" placeholder="Product Name" required></td></tr>
    <tr><td>Description: <input type="text" name="Description" placeholder="Description"></td></tr>
    <tr><td>Price: <input type="text" name="Price" placeholder="Price" required></td></tr>
    <tr><td>Picture: <input type="text" name="Picture" placeholder="Picture" required></td></tr>
    <tr><td><input type="submit" name="Add" id="addButton" value="Add"></td></tr>
  </form>
</table>
</div>



</body>
</html>


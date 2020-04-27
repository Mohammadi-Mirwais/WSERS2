<?php
 include_once "session.php";
 include_once "credentials.php";
 include_once "displaynewuser.php";


 if (isset($_POST["Logout"])){
     session_unset();
     session_destroy();
     print "successfully unregistered";
 }elseif ($_SESSION["userlogged"]){
     print "you are already have logged in" . "<BR>";
  displayuserdetails($connection);
?>
<form action="Login1.php" method="post">
    <input type="submit" name="Logout" value="Logout">
</form>

<?php
 }elseif (isset($_POST["Username"]) && isset($_POST["Password"])) {
    //  include_once "credentials.php";

    // Create connection
    
    // Check connection
   
    $userFromMyDatabase = $connection->prepare("SELECT * FROM people WHERE UserName=?");
    $userFromMyDatabase->bind_param("s", $_POST["Username"]);
    $userFromMyDatabase->execute();
    $result = $userFromMyDatabase->get_result();
    if ($result->num_rows === 1) {
        print "We are checking your password <BR>";
        $row = $result->fetch_assoc();
        if (password_verify($_POST["Password"], $row["Password"])) {
            $_SESSION["userlogged"]= true;
            $_SESSION["currentuser"] = $row["PERSON_ID"];
            displayuserdetails($connection); 
            ?> <a href="Login1.php">Go to the Login1 page</a>
<?php
        } else {
            print "Wrong password !";
        }
    } else {
        print "Your username is not in our database !! Please consider registering !"; ?> <a href="Signup.php">Go to
    the signup page</a>
<a href="Login1.php">Try again</a>
<?php
    }
} else {
     ?>
<form action="Login1.php" method="post">
    Username: <input type="text" name="Username" required><br>
    Password: <input type="text" name="Password" required><br>
    <input type="submit" name="Login" value="Login">
</form>
<?php
}
?>
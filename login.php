<!DOCTYPE html>
<html lang="en">

<body>
    <?php

    include_once("credentials.php");
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ((isset($_GET["Username"]))&&
     (isset($_GET["Password"]))) {

        $isUserFromMyDatabase = $connection->prepare("SELECT * FROM people WHERE Username=?");
        $isUserFromMyDatabase->bind_param("s", $_GET["Username"]);
        $isUserFromMyDatabase->execute();

        if ($result->num_rows === 1) {
            print "we are checking your password <br>";
            $row = $result->num_rows->fetch_assoc());
            print $row["person_ID"];
            if ($row['Password'] === $_GET["Password"]) {
                print "you are now successfully login!<br>";
            } 
        } else {
            print "user does not exist/ password is wrong";
        }
    }
    $connection->close();

    ?>

    <form action="login.php" method="get">
        username: <input type="text" name="Username"><br>
        password: <input type="text" name="Password">
        <input type="submit" value="login" name="login">
    </form>


</body>

</html>
<html>
<body>
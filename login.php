<!DOCTYPE html>
<html lang="en">

<body>
    <?php

    include_once("credentials.php");
    $connection = mysqli_connect($servername, $username, $password, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ((isset($_GET["Username"])) && (isset($_GET["Password"]))) {

        $isUserThere = $connection->prepare("SELECT * FROM people WHERE Username=?");
        $isUserThere->bind_param("s", $_GET["Username"]);
        $isUserThere->execute();

        $result = $isUserThere->get_result();

        if ($result->num_rows > 0) {
            print "user does not exist/ password is wrong!<br>";
            $row = mysqli_fetch_assoc($result);
            if ($row['Password'] == $_GET["Password"]) {
                print "Your username does not exist!<br>";
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
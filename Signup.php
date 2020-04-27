<?php
 include_once "session.php";
 ?>
<html>

<body>
    <?php
    include_once "credentials.php";
    if (isset($_POST["Logout"])){
        session_unset();
        session_destroy();
        print "successfully unregisterd";
        
    }elseif ($_SESSION["userlogged"]) {
        print " you already log in you can not sign up twoice";?>
    <form action="Signup.php" method="post">
        <input type="submit" name="Logout" value="Logout">
    </form>
    <?php
} elseif (
        isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Username"]) && isset($_POST["Password"])) {
        print "You are about to register .... but not yet<BR>";
        $isUserThere = $connection->prepare("SELECT * FROM people WHERE Username=?");
        $isUserThere->bind_param("s", $_POST["Username"]);
        $isUserThere->execute();
       
        $result = $isUserThere->get_result();
        if ($result->num_rows > 0) {
            print "Your username is already taken ! <BR>";
        } else {
            
            $hasedpassword = password_hash($_POST["Password"], PASSWORD_DEFAULT);
            $stmt = $connection->prepare("INSERT INTO people(First_Name,Second_Name,Age,UserName,Password,Nationality) VALUES(?,?,?,?,?,?)");
            $stmt->bind_param(
                "ssissi",
                $_POST["FirstName"],
                $_POST["LastName"],
                $_POST["Age"],
                $_POST["Username"],
                $hasedpassword,
                $_POST["Country"]);
            $stmt->execute();
        
        print " you have registered. Check the database <BR>";
        $_SESSION["userlogged"]= true;
        $newselectstmt = $connection->prepare("SELECT PERSON_ID FROM people WHERE Username?");
        $newselectstmt->bind_param("i", $_POST["Username"]);
        $newselectstmt->execute();
        $resultinguser = $newselectstmt->get_result();
        $rowcurrntid = $resultinguser->fetch_assoc();
       $_SESSION["currentuser"] = $rowcurrntid["PERSON_ID"];
            ?> <a href="Login1.ph p">Go to the Login1 page</a> <?php
        }

    } else {


    ?>
    <form action="Signup.php" method="POST">
        First name: <input type="text" name="FirstName" required><br>
        Last name: <input type="text" name="LastName" required><br>
        Age: <input type="text" name="Age"><br>
        UserName: <input type="text" name="Username" required><br>
        Password: <input type="text" name="Password" required><br>

        <select name="Country">
            <?php
                $stmt = $connection->prepare("SELECT * FROM countries");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row["COUNTRY_ID"] . '">' . $row["COUNTRY_NAME"] . '</option>';
                    }
                } else {
                    echo "0 results";
                }
                $connection->close();
                ?>
        </select>
        <br>
        <input type="submit" name="Register" value="Register">
    </form>
    <?php } ?>

</body>

</html>
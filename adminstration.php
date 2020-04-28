<?php 
include_once "session.php";
include_once "credentials.php";
if  (!$_SESSION["userlogged"]){
    die ("you are not logged in the adminstrator");
}
$userselect = $connection->prepare("SELECT User_Type FROM people WHERE PERSON_ID=?");
        $userselect->bind_param("i", $_SESSION["currentuser"]);
        $userselect->execute();
        $resultuser = $userselect->get_result();
        $rowuser = $resultuser->fetch_assoc();
if($rowuser["UserType"]!== 1){
    die ("you are not an adminstraotr");
}
$users= $connection->prepare("SELECT UserName FROM people WHERE PERSON_ID?");
        $users->bind_param("i", $_POST["currentuser"]);
        $users->execute();
        $resultuser = $users->get_result();
        while ($rowusers = $resulusers->fetch_assoc()){
            print $rowusers["UserName"]. "BR";
        }

?>
<?php
function displayuserdetails($connection)
 {
     if (isset($_SESSION["currentuser"])){
         print "you are trying to display witout log in";
     }
     else{
    $userFromMyDatabase = $connection->prepare("SELECT * FROM people WHERE PERSON_ID=?");
    $userFromMyDatabase->bind_param("i", $_SESSION["currentuser"]);
    $userFromMyDatabase->execute();
    $result = $userFromMyDatabase->get_result();
    $row = $result->fetch_assoc();


    
    print "First name:". $row["First_Name"] . "<BR>";
    print "Second name:" .  $row["Second_Name"] . "<BR>";
    print "age:" . $row["Age"]."<BR>"; 
    print "username:" . $row["UserName"]."<BR>"; 
   $counrtrySelect = $connection->prepare('SELECT * FROM countries WHERE COUNTRY_ID=?');
   $counrtrySelect->bind_param('i', $row ["Nationality"]);
   $counrtrySelect->execute();
   $resultcountry = $counrtrySelect->get_result();
   $rowcountry = $resultcountry->fetch_assoc();
   print "you are from:". $rowcountry["COUNTRY_NAME"];
} 
 }
 ?>
<?php

if(  isset($_GET["adoption_id"] )  ){
    
    
    $adoption_id=$_GET["adoption_id"];
    echo $adoption_id;

    $servername = 'localhost';
    $username = 'root';
    $password ='tiger';
    $dbname = 'output';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $searchSql = "DELETE from pet_adoption where adoption_id=$adoption_id"; 
    $result=$conn->query($searchSql);

    $conn->close();
}

header("location: adoptions.php");
exit;

?>
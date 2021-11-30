<?php

$host = "localhost";
$username = "zetrax";
$password = "Adro2277*";
$db_name = "zetrax";
$connection = null;

try {
  $conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}



function  getOsobaID($uemail)
{
    global $conn;
    $sql = 'CALL getOsobaId(:uemail)';
        
    $statement = $conn->prepare($sql);

    $statement->bindParam(':uemail', $uemail, PDO::PARAM_STR);

    $statement->execute(); 

    if($statement->rowCount() == 1){
        if($row = $statement->fetch()){
            $returnId = $row["id"];
        }
    }
    
    return $returnId;
}

?>




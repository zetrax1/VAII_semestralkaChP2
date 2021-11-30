<?php

require_once "databeseConnect.php";


function  upadteFormularu($idOsoba){
    global $conn;
    global $meno;
    global $priezvisko; 
    global $email;

    $meno=htmlspecialchars(strip_tags($meno));
    $priezvisko=htmlspecialchars(strip_tags($priezvisko));
    $email=htmlspecialchars(strip_tags($email));



    $sql = 'CALL updateOsoba(:umeno,:upriezvisko,:uemail,:uid )';
        
    $statement = $conn->prepare($sql);
    $statement->bindParam(':umeno', $meno, PDO::PARAM_STR);
    $statement->bindParam(':upriezvisko', $priezvisko, PDO::PARAM_STR);
    $statement->bindParam(':uemail', $email, PDO::PARAM_STR);
    $statement->bindParam(':uid', $idOsoba, PDO::PARAM_INT);

    $statement->execute();  
}

$meno = $_POST['meno'];
$priezvisko = $_POST['priezvisko'];
$email =  $_POST['email'];
$heslo =  $_POST['heslo'];

if( isset($_POST['submit'])){
   
    upadteFormularu($idOsoba);
}
else{
    echo '<h3 style="text-align:center;">A very detailed error message ( ͡° ͜ʖ ͡°)</h3>';
}

?>




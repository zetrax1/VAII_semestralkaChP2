<?php
// Initialize the session

$userId = "";

session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$userId = $_SESSION["id"];

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5"> Menu uzivatela.</h1>
    <p>
        <a class="nav-link main-text-color" href="osobneUdajeUpdate.php">Osobne údaje</a>
        <a class="nav-link main-text-color" href="deleteUcet.php">zmazat účet</a>
        <a class="nav-link main-text-color" href="main_page.php">Home</a>
    </p>
</body>
</html>
<?php

require_once "databeseConnect.php";

$userId = "";

session_start();

$userId = $_SESSION["id"];

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    echo "neprihlaseny";

    header("location: login.php");
    exit;
}

$meno = $priezvisko = $email = $heslo  = $mesto = $ulica = $psc = $userId = "";
$meno_err = $email_err =  "";

function getActualUdajeOsoba()
{
    global $conn;
    global $meno;
    global $priezvisko;
    global $email;
    global $userId;
    $userId = $_SESSION["id"];

    $sql = 'CALL getOsoba(:uid)';

    $statement = $conn->prepare($sql);

    $statement->bindParam(':uid', $userId, PDO::PARAM_STR);

    $statement->execute();

    if ($statement->rowCount() == 1) {
        if ($row = $statement->fetch()) {
            $meno = $row["meno"];
            $priezvisko = $row["priezvisko"];
            $email = $row["email"];
        }
    }
}

function  updateOsoba()
{
    global $conn;
    global $meno;
    global $priezvisko;
    global $email;
    global $userId;

    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $email =  $_POST['email'];
    $userId = $_SESSION["id"];

    $meno = htmlspecialchars(strip_tags($meno));
    $priezvisko = htmlspecialchars(strip_tags($priezvisko));
    $email = htmlspecialchars(strip_tags($email));

    $sql = 'CALL updateOsoba(:umeno,:upriezvisko,:uemail,:uid)';

    $statement = $conn->prepare($sql);
    $statement->bindParam(':umeno', $meno, PDO::PARAM_STR);
    $statement->bindParam(':upriezvisko', $priezvisko, PDO::PARAM_STR);
    $statement->bindParam(':uemail', $email, PDO::PARAM_STR);
    $statement->bindParam(':uid', $userId, PDO::PARAM_INT);

     $statement->execute();
}


function updateOsobneUdaje()
{
    global $meno;
    global $priezvisko;
    global $email;
    global $conn;

    $heslo = $_POST['heslo'];
    $email =  $_POST['email'];

    $param_password = password_hash($heslo, PASSWORD_DEFAULT);

    $id = getOsobaID($email);

    $sql = 'CALL pridajHeslo(:uheslo,:uosobaId)';

    $statement = $conn->prepare($sql);

    $statement->bindParam(':uheslo', $param_password, PDO::PARAM_STR);
    $statement->bindParam(':uosobaId', $id, PDO::PARAM_STR);

    $statement->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $userId = $_SESSION["id"];

    if (isset($_POST['home']))
     {
        header("location: main_page.php");
    }

    if (isset($_POST['submit'])) {

        if (trim($_POST["email"])) {

            $sql = 'CALL getOsobaId(:uemail)';

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":uemail", $email, PDO::PARAM_STR);

                $email = trim($_POST["email"]);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        if($row = $stmt->fetch()){
                            $userIdDb = $row["id"];
                        }
                        if ($userId != $userIdDb) {
                            $email_err = "Tento email už je použity pri inej osobe";
                        }
                    } else {
                        $email = trim($_POST["email"]);
                    }
                } else {
                    // echo "Oops! Something went wrong. Please try again later.";
                    return;
                }

                unset($stmt);
            }
        }

        if (empty($email_err)) {

            updateOsoba();
        }
    } else {
    }

    unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Osobné údaje</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 12px sans-serif;
        }

        .wrapper {
            width: 400px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Osobné údaje</h2>
        <p>Tu môžete vidiet prehlad osobných údajov</p>
        <?php getActualUdajeOsoba(); ?>
        <form action="osobneUdajeUpdate.php" method="post">
            <div class="form-group">
                <label>Meno</label>
                <input type="text" name="meno" class="form-control " value="<?php echo $meno; ?>">
                <span class="invalid-feedback"><?php echo $meno_err; ?></span>
            </div>
            <div class="form-group">
                <label>Priezvisko</label>
                <input type="text" name="priezvisko" class="form-control " value="<?php echo $priezvisko; ?>">
                <span class="invalid-feedback"><?php echo $meno_err; ?></span>
            </div>

            <div class="form-group">
                <label>Email adreasa</label>
                <input type="text" name="email" class="form-control " value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>

            <p>Doplnujúce údaje</p>
            <div class="form-group">
                <label>Mesto</label>
                <input type="text" name="mesto" class="form-control " value="<?php echo $mesto; ?>">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Ulica</label>
                <input type="text" name="ulica" class="form-control " value="<?php echo $ulica; ?>">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <label>Poštove smerovacie číslo</label>
                <input type="text" name="psc" class="form-control " value="<?php echo $psc; ?>">
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ulozit" name="submit">
                <input type="submit" class="btn btn-primary" value="Home"  name="home" >
            </div>
        </form>
    </div>
</body>

</html>
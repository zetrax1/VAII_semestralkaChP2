<?php

require_once "databeseConnect.php";

$meno = $priezvisko = $email = $heslo  = "";
$username_err = $password_err = $confirm_password_err = $email_err =  "";

function  registaciaFormularu()
{
    global $conn;
    global $meno;
    global $priezvisko;
    global $email;

    $meno = $_POST['meno'];
    $priezvisko = $_POST['priezvisko'];
    $email =  $_POST['email'];
    $heslo =  $_POST['heslo'];

    $meno = htmlspecialchars(strip_tags($meno));
    $priezvisko = htmlspecialchars(strip_tags($priezvisko));
    $email = htmlspecialchars(strip_tags($email));

    $sql = 'CALL pridajOsobuRegistracia(:umeno,:upriezvisko,:uemail)';

    $statement = $conn->prepare($sql);
    $statement->bindParam(':umeno', $meno, PDO::PARAM_STR);
    $statement->bindParam(':upriezvisko', $priezvisko, PDO::PARAM_STR);
    $statement->bindParam(':uemail', $email, PDO::PARAM_STR);

    $statement->execute();
}


function registruj()
{
    global $email;
    global $heslo;
    global $conn;

    $heslo = $_POST['heslo'];
    $email =  $_POST['email'];

    //$param_password = password_hash($heslo , PASSWORD_DEFAULT);
    $param_password = crypt($heslo,$email);

    $id = getOsobaID($email);

    $sql = 'CALL pridajHeslo(:uheslo,:uosobaId)';

    $statement = $conn->prepare($sql);

    $statement->bindParam(':uheslo', $param_password, PDO::PARAM_STR);
    $statement->bindParam(':uosobaId', $id, PDO::PARAM_STR);

    $statement->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['submit']) && isset($_POST['email'])  && isset($_POST['meno']) && isset($_POST['heslo']) && isset($_POST['priezvisko'])) {



        if (preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["meno"]))) {

            $sql = 'CALL getOsobaId(:uemail)';

            if ($stmt = $conn->prepare($sql)) {
                $stmt->bindParam(":uemail", $email, PDO::PARAM_STR);

                $email = trim($_POST["email"]);

                if ($stmt->execute()) {
                    if ($stmt->rowCount() == 1) {
                        $email_err = "This email is already taken.";
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

        if (strlen(trim($_POST["heslo"])) < 6) {
            $heslo_err = "Password must have atleast 6 characters.";
        } else {
            $heslo = trim($_POST["heslo"]);
        }

        if (empty(trim($_POST["confirm_heslo"]))) {
            $confirm_heslo_err = "Please confirm password.";
        } else {
            $confirm_heslo = trim($_POST["confirm_heslo"]);

            if (empty($heslo_err) && ($heslo != $confirm_heslo)) {
                $confirm_heslo_err = "Password did not match.";
            }
        }

        if (empty($email_err) && empty($heslo_err) && empty($confirm_heslo_err)) {

            registaciaFormularu();
            registruj();
            header("location: main_page.php");
        }
    } else {
    }
    unset($conn);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Registrácia</title>
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>

<body>
    <center>
        <script>
            function validateHeslo() {
                let x = document.forms["myForm"]["heslo"].value;
            
                if (!x) {
                    alert("Heslo musí byť vyplnené!");
                    return false;
                }

                if (x.length > 40 || x.length < 8) {
                    alert("Heslo nemá požadovánu dlžku 8-40!");
                    return false;
                }

                var upperCaseLetters = /[A-Z]/g;

                if (!x.match(upperCaseLetters)) {
                    alert("Heslo neobsahuje velke pismena");
                    return false;
                }

                var lowerCaseLetters = /[a-z]/g;

                if (!x.match(lowerCaseLetters)) {
                    alert("Heslo neobsahuje malinke pismena");
                    return false;
                }

                var numbers = /[0-9]/g;
                if (!x.match(numbers)) {
                    alert("Heslo musi obsahovat cislice 0-9");
                    return false;
                }

                let y = document.forms["myForm"]["confirm_heslo"].value;

                if (!y) {
                    alert("Potvrdzujuce heslo musí byť vyplnené!");
                    return false;
                }

                if (x != y) {
                    alert("Hesla sa nezhoduju");
                    return false;
                }

                return true;
            }
        </script>
        <div class="container">
            <div>
                <div>
                    <div class="hero-title">
                        <h1 class="section-title text-uppercase font-weight-bold">Registacny formular</h1>
                        <p></p>
                    </div>
                    <div">
                        <form name="myForm" onsubmit="return validateHeslo()" class="main-bg-color" action="registracia.php" method="post">
                            <div class="form-group">
                                <label for="meno">Meno </label>
                                <input type="text" class="form-control" id="meno" name="meno" />
                            </div>
                            <div class="form-group">
                                <label for="priezvisko">Priezvisko</label>
                                <input type="text" class="form-control" id="priezvisko" name="priezvisko" />
                            </div>
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="text" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" id="email" name="email" required placeholder="meno@example.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
                                <span class="invalid-feedback"><?php echo $email_err; ?></span>
                            </div>
                            <div class="form-group">
                                <label for="heslo">Heslo </label>
                                <input type="password" class="form-control" id="heslo" name="heslo" />
                            </div>
                            <div class="form-group">
                                <label for="confirm_heslo">Potvrd Heslo </label>
                                <input type="password" class="form-control" id="confirm_heslo" name="confirm_heslo" />
                            </div>
                            <input type="submit" class="btn btn-primary hover" name="submit" />
                        </form>
                </div>
            </div>
        </div>
        </div>
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        </div>
    </center>
</body>

</html>
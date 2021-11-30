<?php
// Initialize the session
session_start();

require_once "databeseConnect.php";

$heslo = $idOsoba = $email = "";
$heslo_err = "";

function deleteOsobneUdaje()
{
    global $conn;
    global $idOsoba;
    $idOsoba = $_SESSION["id"];

    $sql = 'CALL deleteOsoba(:uid)';

    $statement = $conn->prepare($sql);

    $statement->bindParam(':uid', $idOsoba, PDO::PARAM_STR);

    $statement->execute();

    unset($statement);
    unset($conn);
}

function logoutUser()
{
    $_SESSION = array();
    session_destroy();
    header("location: main_page.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    if (isset($_POST['home']))
    {
        header("location: main_page.php");
    }

    if (isset($_POST['delete'])) {
        if (!isset($_POST['heslo'])) {
            $heslo_err = "Please enter your password.";
        } else {

            $heslo = trim($_POST["heslo"]);
        }

        if (empty($heslo_err)) {


            $idOsoba = $_SESSION["id"];
            $email = $_SESSION["email"] ;  

            $sql = 'CALL getHeslo(:uosobaId)';

            if ($stmt = $conn->prepare($sql)) {

                $stmt->bindParam(":uosobaId", $idOsoba, PDO::PARAM_STR);

                if ($stmt->execute()) {

                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {

                            $hashed_password = $row["heslo"];

                            if(hash_equals($hashed_password, crypt($heslo, $email))){ {

                                unset($stmt);

                                deleteOsobneUdaje();
                                logoutUser();
                                exit;
                            } 
                        }
                    } else {
                      
                        $heslo_err = "Invalid username or password.";
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close statement
                unset($stmt);
            }
        }
    }
    unset($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>delete</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <h2>Delete</h2>
        <p> Zadajte heslo na potvrdenie.</p>

        <?php
        if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        ?>

        <form action="deleteUcet.php" method="post">
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="heslo" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Potvrd"  name="delete">
                <input type="submit" class="btn btn-primary" value="Zrus" name="home">
            </div>
        </form>
    </div>
</body>

</html>
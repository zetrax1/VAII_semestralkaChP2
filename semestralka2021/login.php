<?php
// Initialize the session
session_start();
 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){

    header("location: welcome.php");
    exit;
}
 
require_once "databeseConnect.php";
 
$email = $heslo = "";
$email_err = $heslo_err = $login_err = "";
 
if($_SERVER["REQUEST_METHOD"] == "POST"){

   
    if(!isset($_POST['email'])){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    if(!isset($_POST['heslo'])){
        $heslo_err = "Please enter your password.";
    } else{
        
        $heslo = trim($_POST["heslo"]);
    }
    
    if(empty($email_err) && empty($heslo_err)){


        $idOsoba =  getOsobaID($email);


        $sql = 'CALL getHeslo(:uosobaId)';
        
        if($stmt = $conn->prepare($sql)){

            $stmt->bindParam(":uosobaId", $idOsoba, PDO::PARAM_STR);
            
            if($stmt->execute()){

                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){


                       $hashed_password = $row["heslo"];

                        if(hash_equals($hashed_password, crypt($heslo, $email))){

                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $idOsoba;
                            $_SESSION["email"] = $email;                              
                                                     
                            header("location: welcome.php");

                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }
    unset($conn);

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Prihlásenie</h2>
        <p>Pre prihlásenie zadajte údaje.</p>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>emal</label>
                <input type="text" name="email" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>heslo</label>
                <input type="password" name="heslo" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Chcete si vytvorit ucet ? <a href="registracia.php">Registracia tu</a>.</p>
        </form>
    </div>
</body>
</html>
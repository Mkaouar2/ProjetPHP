<?php
session_start();
include("../Controller/UtilisateurController.php");
$messageLog = $messagePass = "";

if(isset($_POST['submit'])) {
    if (empty($_POST['login'])) {
        $messageLog = "<strong style='color:red'> Login nécessaire</strong>";
    } elseif (empty($_POST['password'])) {
        $messagePass = "<strong style='color:red'> Mot de passe nécessaire</strong>";
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $_SESSION['login']=$login;
        UtilisateurController::ChercherUtilisateur($login, $password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style2.css">
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="card animated bounceInDown">
            <div class="card-body">
                <h1 class="text-center mb-4">Authentification</h1>
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" id="login">
                        <span class="error-message"><?php echo $messageLog?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <span class="error-message"><?php echo $messagePass?></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block" name="submit">Se connecter</button>
                </form>
                <div class="text-center mt-3">
                    <a href="SignUp.php">Vous n'avez pas encore de compte? S'inscrire</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>




<?php
include("../Controller/UtilisateurController.php");
$loginError = $passwordError = $nomError = $cinError = $emailError = $roleError = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST['login'])){
        $loginError = "Login requis";
    }
    if(empty($_POST['password'])){
        $passwordError = "Mot de passe requis";
    }
    if (empty($_POST['nom'])) {
        $nomError = "Nom requis";
    }
    if (empty($_POST['cin'])) {
        $cinError = "CIN requis";
    }
    if (empty($_POST['email'])) {
        $emailError = "Email requis";
    }
    if (empty($_POST['role'])) {
        $roleError = "Rôle requis";
    }
}

if(isset($_POST['login']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['cin']) && isset($_POST['email']) && isset($_POST['role'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $nom = $_POST['nom'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $role = ($_POST['role'] == "chauffeur") ? "0" : "1";

    if(empty($loginError) && empty($passwordError) && empty($nomError) && empty($cinError) && empty($emailError) && empty($roleError)){
        UtilisateurController::AjouterUtilisateur($login,$password,$nom,$cin,$email,$role);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style3.css">
    <title>Sign Up</title>
</head>
<body>
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100">
        <div class="card animated bounceInDown">
            <div class="card-body">
                <h1 class="text-center mb-4">Inscription</h1>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" name="login" id="login">
                        <span class="error-message"><?php echo $loginError ?></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <span class="error-message"><?php echo $passwordError ?></span>
                    </div>

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" name="nom" id="nom">
                        <span class="error-message"><?php echo $nomError ?></span>
                    </div>

                    <div class="form-group">
                        <label for="cin">CIN</label>
                        <input type="text" class="form-control" name="cin" id="cin">
                        <span class="error-message"><?php echo $cinError ?></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email">
                        <span class="error-message"><?php echo $emailError ?></span>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" name="role" id="role">
                            <option value="chauffeur">Chauffeur</option>
                            <option value="admin">Administrateur</option>
                        </select>
                        <span class="error-message"><?php echo $roleError ?></span>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


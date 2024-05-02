<?php
include("../Controller/UtilisateurController.php");
if(isset($_GET['login'])){
    $login = $_GET['login'];
    UtilisateurController::supprimerChauffeur($login);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des voitures</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style4.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2 class="section-title">Liste des chauffeurs</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Login</th>
                                <th>Nom</th>
                                <th>Cin</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            UtilisateurController::chercherTousChauffeurs();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-title"></h2>
                        <form action="Chauffeur.php" method="post">
                            <div class="form-group">
                                <label for="matricule">Login</label>
                                <input type="text" class="form-control" name="login" required>
                            </div>
                            <div class="form-group">
                                <label for="marque">nom</label>
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Cin</label>
                                <input type="text" class="form-control" name="cin" required>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Email</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Modifier chauffeur</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>    
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['login'])&&isset($_POST['nom'])&&isset($_POST['cin'])&&isset($_POST['email'])){
        $login = $_POST['login'];
        $nom = $_POST['nom'];
        $cin = $_POST['cin'];
        $email = $_POST['email'];
        UtilisateurController::modifierChauffeur($login,$nom,$cin,$email);
    }
}
?>
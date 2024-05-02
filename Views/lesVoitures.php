<?php
include("../Controller/VoitureController.php");
$message = ""; 
if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    if (isset($_POST['matricule']) && isset($_POST['marque']) && isset($_POST['couleur']) && isset($_POST['dateAchat'])) {
        $matricule = $_POST['matricule'];
        $marque = $_POST['marque'];
        $couleur = $_POST['couleur'];
        $dateAchat = $_POST['dateAchat'];
        
        if (isset($_POST['ajouter'])) {
            $result = VoitureController::ajouterVoiture($matricule,$marque,$couleur,$dateAchat);
            if ($result) {
                header("Location: ../Views/lesVoitures.php");
                exit();
            } else {
                $message = "<div class='alert alert-danger' role='alert'>Erreur : Une erreur s'est produite lors de l'ajout de la voiture. Veuillez réessayer.</div>";
            }
        } elseif (isset($_POST['modifier'])) {
            VoitureController::modifierVoiture($matricule,$marque,$couleur,$dateAchat);
        }
    }
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
                <h2 class="section-title">Les Voitures</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Matricule</th>
                                <th>Marque</th>
                                <th>Couleur</th>
                                <th>Date Achat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            VoitureController::chercherTousLesVoitures();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-title">Ajouter/Modifier une voiture</h2>
                        <form action="lesVoitures.php" method="post">
                            <div class="form-group">
                                <label for="matricule">Matricule</label>
                                <input type="text" class="form-control" name="matricule" required>
                            </div>
                            <div class="form-group">
                                <label for="marque">Marque</label>
                                <input type="text" class="form-control" name="marque" required>
                            </div>
                            <div class="form-group">
                                <label for="couleur">Couleur</label>
                                <input type="text" class="form-control" name="couleur" required>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date Achat</label>
                                <input type="date" class="form-control" name="dateAchat" required>
                            </div>
                            <?php
                            echo $message;
                            ?>
                            <button type="submit" class="btn btn-primary" name="ajouter">Ajouter voiture</button>
                            <button type="submit" class="btn btn-primary" name="modifier">Modifier voiture</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>    
</html>

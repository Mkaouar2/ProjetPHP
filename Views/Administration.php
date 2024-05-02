<?php
include("../Controller/VoitureController.php");
include("../Controller/UtilisateurController.php");
include("../Controller/MissionController.php");

$message = ""; 
if (isset($_GET['idMission']) && isset($_GET['objectif']) && isset($_GET['ville']) && isset($_GET['chauffeur']) && isset($_GET['voiture']) && isset($_GET['date_debut']) && isset($_GET['description'])) {
    $idMission = $_GET['idMission'];
    $objectif = $_GET['objectif'];
    $ville = $_GET['ville'];
    $chauffeur = $_GET['chauffeur'];
    $voiture = $_GET['voiture'];
    $date_debut = $_GET['date_debut'];
    $description = $_GET['description'];
    $result = MissionController::AjouterMission($idMission, $objectif, $ville, $chauffeur, $voiture, $date_debut, $description);
    if ($result) {
        header("Location: ../Views/Administration.php");
$_GET['idMission']="";
$_GET['objectif']="";
$_GET['ville']="";
$_GET['chauffeur']="";
$_GET['voiture']="";
$_GET['date_debut']="";
$_GET['description']="";
        exit();
    } else {
        $message = "<div class='alert alert-danger' role='alert'>Erreur : Une erreur s'est produite lors de l'ajout de la mission. Veuillez réessayer.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des missions</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style4.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2 class="section-title">Missions existantes</h2>
                <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Objectif</th>
                <th>Ville</th>
                <th>Nom du chauffeur</th>
                <th>Voiture</th>
                <th>Date début</th>
                <th>Date fin</th>
                <th>Etat de la mission</th>
                <th>Commentaire</th>
            </tr>
        </thead>
        <tbody>
            <?php
            MissionController::afficherTousLesMissions();
            ?>
        </tbody>
    </table>
</div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="section-title">Ajouter une nouvelle mission</h2>
                        <form action="Administration.php" method="get">
                        <div class="form-group">
                                <label for="IdMission">Id Mission</label>
                                <input type="text" class="form-control" name="idMission" required>
                            </div>
                            <div class="form-group">
                                <label for="objectif">Objectif</label>
                                <input type="text" class="form-control" id="objectif" name="objectif" required>
                            </div>
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" required>
                            </div>
                            <div class="form-group">
                                <label for="nom_chauffeur">Nom du chauffeur</label>
                                <select name="chauffeur" class="form-control">
                                    <?php
                                    UtilisateurController::chercherTousUtilisateurs();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="voiture">Voiture</label>
                                <select name="voiture" class="form-control">
                                    <?php
                                    VoitureController::chercherVoiture();
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_debut">Date début</label>
                                <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                            </div>
                            <div class="form-group">
                                <label for="commentaire">Description</label>
                                <textarea class="form-control" id="commentaire" name="description" rows="3"></textarea>
                            </div>
                            <?php
                            echo $message;
                            ?>
                            <button type="submit" class="btn btn-primary" name="submit">Ajouter mission</button>
                            <a href="MissionEnAttente.php" class="btn btn-primary">Les missions en attente</a>
                            <a href="lesVoitures.php" class="btn btn-secondary">Afficher voiture</a>
                            <a href="Chauffeur.php" class="btn btn-secondary">Afficher chauffeur</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

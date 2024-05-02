<?php
include("../Controller/MissionController.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Missions en attente</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style5.css">
</head>
<body>
    <div class="container">
        <div class="table-container">
            <h2 class="text-center mb-4">Missions en attente</h2>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th>Objectif</th>
                            <th>Ville</th>
                            <th>Nom du chauffeur</th>
                            <th>Voiture</th>
                            <th>Date début</th>
                            <th>Commentaire</th>
                            <th>Etat de la mission</th>
                            <th>Annulation</th>
                            <th>Modification</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        MissionController::AffichageLesMissionsEnAttente();
                        ?>                    
                 </tbody>
                </table>
            </div>
            <form action="#" method="POST" class="mt-4">
                <div class="text-center">
                <a class="btn btn-black" href="../Views/Administration.php" role="button">Retout a l'Administration</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
if(isset($_GET['idMission'])){
    $idMission=$_GET['idMission'];
    MissionController::supprimerMission($idMission);
}
?>

<?php
include("../Controller/UtilisateurController.php");
include("../Controller/VoitureController.php");
include("../Controller/MissionController.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Mission</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style/style6.css">
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Formulaire de Mission</h2>
        <form method="get">
            <div class="form-group">
            <input type="hidden" name="idMission" value="<?php echo $_GET['idMission']; ?>">
                <label for="objectif">Objectif :</label>
                <input type="text" class="form-control" id="objectif" name="objectif" required>
            </div>
            <div class="form-group">
                <label for="ville">Ville :</label>
                <input type="text" class="form-control" id="ville" name="ville" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="dateDebut">Date début :</label>
                <input type="date" class="form-control" id="dateDebut" name="dateDebut" required>
            </div>
            <div class="form-group">
                <label for="login">Login :</label>
                <select class="form-control" id="login" name="login">
                <?php
                UtilisateurController::chercherTousUtilisateurs();
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="matricule">Matricule voiture :</label>
                <select class="form-control" id="matricule" name="voiture">
                <?php
                VoitureController::chercherVoiture();
                ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Soumettre</button>
        </form>
    </div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (
        isset($_GET['objectif']) &&
        isset($_GET['ville']) &&
        isset($_GET['description']) &&
        isset($_GET['dateDebut']) &&
        isset($_GET['login']) &&
        isset($_GET['voiture']) &&
        isset($_GET['idMission'])
    ) {
        
        MissionController::ModifierMissionEnAttente(
            $_GET['idMission'],
            $_GET['objectif'],
            $_GET['ville'],
            $_GET['description'],
            $_GET['dateDebut'],
            $_GET['login'],
            $_GET['voiture']
        );
        
    }
}
?>

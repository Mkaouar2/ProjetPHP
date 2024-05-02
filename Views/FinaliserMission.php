<?php
include("../Controller/MissionController.php");

$idMission = "";
if(isset($_GET['idMission'])) {
    $idMission = $_GET['idMission'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finaliser Mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../Style/style.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 text-center">Finalisation d'une mission</h1>
        <form action="FinaliserMission.php" method="get" class="needs-validation" novalidate>
            <input type="hidden" name="idMission" value="<?php echo $idMission; ?>">
            <div class="mb-4">
                <label for="commentaire" class="form-label">Commentaire :</label>
                <textarea class="form-control" id="commentaire" name="commentaire" rows="5" required></textarea>
                <div class="invalid-feedback">Veuillez saisir votre commentaire.</div>
            </div>
            <div class="mb-4">
                <label for="date" class="form-label">Date :</label>
                <input type="date" class="form-control" id="date" name="date" required>
                <div class="invalid-feedback">Veuillez sélectionner une date.</div>
            </div>
            <div class="mt-4 d-grid gap-2">
                <button type="submit" class="btn btn-dark">Enregistrer</button>
                <?php 
                if(isset($_GET['commentaire']) && isset($_GET['date'])) {
                    $result = MissionController::UpdateEnCours($idMission, $_GET['commentaire'],$_GET['date']);
                    if($result) {
                        header("Location:../Views/Accueil.php");
                    } 
                }
                ?>
            </div>
        </form>
    </div>
</body>
</html>

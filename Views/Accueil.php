<?php
include("../Controller/MissionController.php");
session_start();
if(isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
}
if(isset($_GET['idMission'])) {
  MissionController::ModifierEtat($login, $_GET['idMission']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Accueil</title>
</head>
<body>
    <h1>Liste des missions</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">IdMission</th>
                <th scope="col">Objectif</th>
                <th scope="col">Ville</th>
                <th scope="col">Voiture</th>
                <th scope="col">Date_Debut</th>
                <th scope="col">Date_Fin</th>
                <th scope="col">Etat de mission</th>
            </tr>
        </thead>
        <tbody>
            <?php
            MissionController::ChercherMissionParUtilisateur($login);
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
include("../Controller/MissionController.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description de la mission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .background-color-custom {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body class="background-color-custom"> 
    <div class="container">
        <h1 class="mt-4 text-center">Description de la mission</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <ul class="list-group list-group-flush">
                    <?php
                    if (isset($_GET['idMission'])) {
                        $idMission = $_GET['idMission'];
                        MissionController::AfficherMission($idMission);
                    }
                    ?>
                </ul>
                <div class="mt-4 d-grid gap-2">
                    <a href="Administration.php" class="btn btn-dark btn-lg">Retour à l'administration</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

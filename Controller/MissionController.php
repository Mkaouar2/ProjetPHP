<?php
include("../Modele/Mission.php");
class MissionController {
    static $count = 0;

    public static function ChercherMissionParUtilisateur($login) {
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Mission::ChercherMissionParUtilisateur($conn, $login);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    self::$count++; 
                    echo "<th scope='row'>" . self::$count . "</th>";
                    echo "<td name='id'>".$row['idMission']."</td>";
                    echo "<td name='objectif'>". "<a href='DescriptionMission.php?idMission=$row[idMission]'>".$row['objectif']."</a>" ."</td>";
                    echo "<td name='ville'>".$row['ville']."</td>";
                    echo "<td name='matricule_voiture'>".$row['matricule_voiture']."</td>";
                    echo "<td name='dateDebut'>".$row['dateDebut']."</td>";
                    echo "<td name='dateFin'>".$row['dateFin']."</td>";
                    echo "<td>";
                    if ($row['etat'] == '0') {
                        echo "<a href='Accueil.php?idMission=$row[idMission]'>Lancer Mission</a>";//idMission ykhali url yaaref ama mission nhebou naamlou aaliha modification 
                    } elseif ($row['etat'] == '1'){
                        echo "<a href='Accueil.php?idMission=$row[idMission]'>En Cours</a>"; 
                    } else {
                        echo "Finalisée";
                    }       
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr>";
                self::$count++; 
                echo "<th scope='row'>" . self::$count . "</th>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";
                echo "<td>"."Null"."</td>";

            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }

    public static function ModifierEtat($login, $idMission){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Mission::ChercherMissionParIdMissionEtLogin($conn, $login, $idMission);
            if($result && $result->num_rows > 0){
                $row = $result->fetch_assoc();
                $etat = $row['etat']; 
                $nouvelEtat = $etat;
                if($etat == 0){
                    $nouvelEtat = 1;
                } elseif($etat == 1){
                    $nouvelEtat = 2;
                }
                    if($nouvelEtat == 1){
                        $req = "UPDATE mission SET etat='$nouvelEtat' WHERE idMission='$idMission'";
                        $ex = $conn->query($req);
                        if($ex){
                            header("Location:../Views/Accueil.php");
                        }else {
                            echo "Erreur lors de la mise à jour de l'état de la mission : " . mysqli_error($conn);
                        }
                    } else {
                        header("Location:../Views/FinaliserMission.php?idMission=$row[idMission]");
                    }
                    exit;
                
            } else {
                echo "Aucune mission trouvée pour l'ID donné : " . $idMission;
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    
    public static function AfficherMission($idMission){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        $result = Mission::ChercherMission($conn,$idMission);
        if($result){
            if($result->num_rows>0){
                $row = $result->fetch_assoc();
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Chauffeur</span>";
                echo "<span>".$row['login_utilisateur']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>ID Mission</span>";
                echo "<span>".$row['idMission']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Objectif</span>";
                echo "<span>".$row['objectif']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Ville</span>";
                echo "<span>".$row['ville']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Description</span>";
                echo "<span>".$row['description']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Commentaire</span>";
                echo "<span>".$row['commentaire']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>DateDebut</span>";
                echo "<span>".$row['dateDebut']."</span>";
                echo "</li>";

                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>DateFin</span>";
                echo "<span>".$row['dateFin']."</span>";
                echo "</li>";

                if($row['etat']=='0'){
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<span class='fw-bold'>Etat</span>";
                    echo "<span>En attente</span>";
                    echo "</li>";
                }elseif($row['etat']=='1'){
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<span class='fw-bold'>Etat</span>";
                    echo "<span>En Cours</span>";
                    echo "</li>";
                }else{
                    echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                    echo "<span class='fw-bold'>Etat</span>";
                    echo "<span>Finalisée</span>";
                    echo "</li>";
                }
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>";
                echo "<span class='fw-bold'>Voiture</span>";
                echo "<span>".$row['matricule_voiture']."</span>";
                echo "</li>";
            }
        }
    }
    
    public static function UpdateEnCours($idMission, $commentaire, $dateFin) {
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        $erreur = false;
        try {
            $res = Mission::ChercherMission($conn, $idMission);
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $dateDebut = $row['dateDebut'];
                if (strtotime($dateFin) <= strtotime($dateDebut) || empty($commentaire)) {
                    $erreur = true;
                } else {
                    $dateFinFormatted = date('Y-m-d', strtotime($dateFin));                    
                    $req = "UPDATE mission SET etat='2', commentaire='$commentaire', dateFin='$dateFinFormatted' WHERE idMission='$idMission'";
                    $rep = $conn->query($req);
                    if ($rep) {
                        return true;
                    }
                }
            }
            if ($erreur) {
                echo "<div class='alert alert-danger' role='alert'>Erreur : La date de fin doit être postérieure à la date de début et tous les champs doivent être remplis correctement.</div>";
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
        return false;
    }
    
    public static function afficherTousLesMissions(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Mission::chercherTousLesMissions($conn);
            
            if($result){
                if($result->num_rows>0){
                    while ($row = $result->fetch_assoc()) {
                        echo"<tr>";
                        echo"<td>"."<a href='DescriptionMissions.php?idMission=$row[idMission]'>".$row['objectif']."</a>"."</td>";
                        echo"<td>".$row['ville']."</td>";
                        echo"<td>".$row['login_utilisateur']."</td>";
                        echo "<td>".$row['matricule_voiture']."</td>";
                        echo "<td>".$row['dateDebut']."</td>";
                        echo "<td>".$row['dateFin']."</td>";
                        if($row['etat']=='0'){
                            echo "<td>En Attente</td>";
                        }elseif ($row['etat']=='1') {
                            echo "<td>En Cours</td>";
                        }else {
                            echo "<td>Finalisée</td>";
                        }
                        echo "<td>".$row['commentaire']."</td>";
                        echo"</tr>";
                    }
                }
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function AjouterMission($idMission,$objectif,$ville,$Chauffeur,$voiture,$dateDeb,$description){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $date = date("Y-m-d");
            $date_string = (string)$date;
            
            if ($dateDeb < $date_string) {
                echo "<div class='alert alert-danger' role='alert'>Erreur : La date de début doit être égale ou postérieure à la date courante.</div>";
            } else {
                $dateDebut=date("Y-m-d", strtotime($dateDeb));
                return $result = Mission::AjouterMission($conn, $idMission, $objectif, $ville, $description, $dateDebut,$Chauffeur, $voiture);
            }
            
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function AffichageLesMissionsEnAttente(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try{
            $result = Mission::chercherTousLesMissions($conn);
            if($result){
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        if($row['etat']=='0'){
                            echo "<tr>";
                            echo "<td>".$row['objectif']."</td>";
                            echo "<td>".$row['ville']."</td>";
                            echo "<td>".$row['login_utilisateur']."</td>";
                            echo "<td>".$row['matricule_voiture']."</td>";
                            echo "<td>".$row['dateDebut']."</td>";
                            echo "<td>".$row['commentaire']."</td>";
                            echo "<td>En Attente</td>";
                            echo "<td>"."<a href='MissionEnAttente.php?idMission=$row[idMission]'>Annuler</a>"."</td>";
                            echo "<td>"."<a href='MissionModifie.php?idMission=$row[idMission]'>Modifier</a>"."</td>";
                            echo "</tr>"; 
                        }
                    }
                }
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
public static function supprimerMission($idMission){
    include_once("./Modele/Conn.php");
    $conn = Conn::obtenir_connexion();
    try {
        $result = Mission::supprimerMission($conn, $idMission);
        if($result){
            header("Location:../Views/MissionEnAttente.php");
            exit();
            $_GET['idMission']="";
            $message = "<div class='alert alert-success' role='alert'>La mission a été supprimée avec succès.</div>";
        } else {
            $message = "<div class='alert alert-danger' role='alert'>Erreur : La mission n'a pas pu être supprimée.</div>";
        }
    } catch (mysqli_sql_exception $ex) {
        echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
    } finally {
        mysqli_close($conn);
    }
    
    return $message;
}
public static function ModifierMissionEnAttente($idMission, $objectif, $ville, $description, $date_Debut, $login, $voiture) {
    include_once("../Modele/Conn.php");
    $conn = Conn::obtenir_connexion();
    try {
        if (strtotime($date_Debut) >= strtotime(date("Y-m-d"))) {
            
            $result = Mission::ModifierMissionEnAttente($conn, $idMission, $objectif, $ville, $description, $date_Debut, $login, $voiture);
            if ($result) {
                echo "<div class='alert alert-success' role='alert'>La mission a été modifiée avec succès.</div>";
                header("Location:../Views/MissionEnAttente.php");
                exit();
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Erreur : La date doit être postérieure ou égale à celle d'aujourd'hui.</div>";
        }
    }catch (mysqli_sql_exception $ex) {
        echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
    } finally {
        mysqli_close($conn);
    }
}

}
?>
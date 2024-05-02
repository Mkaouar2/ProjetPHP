<?php
include("../Modele/Voiture.php");
class VoitureController{
    public static function chercherVoiture(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Voiture::chercherVoiture($conn);
            if($result){
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        echo "<option>$row[matricule]</option>";
                    }
                }else {
                    echo "<option>Aucune voiture</option>";
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function chercherVoitureParMatricule($matricule){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Voiture::chercherVoitureParMatricule($conn,$matricule);
            if($result){
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    return $marque = $row['marque'];
                }
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function chercherVoitureParMarque($marque){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try{
            $result = Voiture::chercherParMarque($conn,$marque);
            if($result){
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    return $row['matricule'];
                }
            }
            return null;
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function chercherTousLesVoitures(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Voiture::chercherVoiture($conn);
            if($result){
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                    echo"<tr>";
                    echo"<td>".$row['matricule']."</td>";
                    echo"<td>".$row['marque']."</td>";
                    echo"<td>".$row['couleur']."</td>";
                    echo"<td>".$row['dateAchat']."</td>";
                    echo "<td><a href='lesVoitures.php?matricule=$row[matricule]'>Annuler</a></td>";
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
    public static function ajouterVoiture($matricule,$marque,$couleur,$dateachat){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $date = date("Y-m-d");
            $date_string = (string)$date;
            if ($dateachat > $date_string) {
                echo "<div class='alert alert-danger' role='alert'>Erreur : La date d'achat doit être égale ou anterieur à la date courante.</div>";
            } else {
                $dateAchat=date("Y-m-d", strtotime($dateachat));
                return $result = Voiture::ajouterVoiture($conn, $matricule,$marque,$couleur,$dateAchat);
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :".$ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function supprimerVoiture($matricule){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Voiture::supprimerVoiture($conn,$matricule);
            if($result){
                header("Location:lesVoitures.php");
                exit();
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function modifierVoiture($matricule,$marque,$couleur,$dateAchat){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $dateachat=date("Y-m-d", strtotime($dateAchat));
            $result = Voiture::modifierVoiture($conn,$matricule,$marque,$couleur,$dateachat);
            if($result){
                header("Location:../Views/lesVoitures.php");
                exit();
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
}
?>
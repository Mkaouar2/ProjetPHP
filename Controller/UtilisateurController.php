<?php
include("../Modele/Utilisateur.php");
include_once("../Modele/Conn.php");

class UtilisateurController {
    
    public static function AjouterUtilisateur($login, $password, $nom, $cin, $email, $role) {
        $conn = Conn::obtenir_connexion();
        try {
            Utilisateur::Ajouter($conn, $login, $password, $nom, $cin, $email, $role);
            header("Location: Authentification.php");
            exit();
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    
    public static function ChercherUtilisateur($login, $password) {
        $conn = Conn::obtenir_connexion();
        $rep = Utilisateur::Chercher($conn, $login, $password);
        if ($rep != null) {
            try {
                $req = "SELECT role FROM utilisateur WHERE login ='$login'";
                $result = $conn->query($req);
                
                if ($result) {
                    $row = $result->fetch_assoc();
                    $role = $row['role'];
                    
                    if ($role == '0') {
                        header("Location: ../Views/Accueil.php");
                        exit(); 
                    } else {
                        header("Location: ../Views/Administration.php");
                        exit(); 
                    }
                } else {
                    echo "Erreur lors de la récupération du rôle de l'utilisateur";
                }
            } catch (mysqli_sql_exception $ex) {
                echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
            } finally {
                mysqli_close($conn);
            }
        } else {
            echo "Compte n'existe pas ou votre code est incorrecte";
        }
    }

    public static function chercherTousUtilisateurs(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try{
            $result = Utilisateur::CherchertousUtilisateurs($conn);
            if($result){
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo "<option>$row[login]</option>";
                    }
                }else {
                    echo "Aucun utilisateur trouvé";
                }
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function chercherParUtilisateur($login){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Utilisateur::ChercherParUtilisateur($conn,$login);
            if($result){
                if($result->num_rows>0){
                    $row = $result->fetch_assoc();
                    return $nom = $row['nom'];
                }else {
                    return "Aucun utilisateur trouvé";
                }
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function chercherTousChauffeurs(){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try{
            $result = Utilisateur::chercherTousLesChauffeur($conn);
            if($result){
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        echo"<tr>";
                        echo "<td>$row[login]</td>";
                        echo "<td>$row[nom]</td>";
                        echo "<td>$row[cin]</td>";
                        echo "<td>$row[email]</td>";
                        echo "<td><a href='Chauffeur.php?login=$row[login]'>Annuler</a></td>";
                        echo"</tr>";
                    }
                }else {
                    echo "Aucun utilisateur trouvé";
                }
            }
        }catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function supprimerChauffeur($login){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result= Utilisateur::supprimerChauffeurs($conn,$login);
            if($result){
                header("Location:../Views/Chauffeur.php");
                exit();
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
    public static function modifierChauffeur($login,$nom,$cin,$email){
        include_once("../Modele/Conn.php");
        $conn = Conn::obtenir_connexion();
        try {
            $result = Utilisateur::modifierChauffeur($conn,$login,$nom,$cin,$email);
            if($result){
                header("Location:../Views/Chauffeur.php");
                exit();
            }
        } catch (mysqli_sql_exception $ex) {
            echo "<div class='alert alert-danger' role='alert'>"."Erreur :". $ex->getMessage()."</div>";
        } finally {
            mysqli_close($conn);
        }
    }
}

?>
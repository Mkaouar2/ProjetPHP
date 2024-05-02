<?php
class Mission{
    private $idMission;
    private $objectif;
    private $ville;
    private $description;
    private $date_debut;
    private $etat;
    private $commentaire;
    private $login;
    private $mat;
    
    public function __construct($idMission,$objectif,$ville,$description,$date_debut,$etat,$commentaire,Utilisateur $utilisateur,Voiture $voiture)
    {
        $this->idMission=$idMission;
        $this->objectif=$objectif;
        $this->ville=$ville;
        $this->description=$description;
        $this->date_debut=$date_debut;
        $this->etat=$etat;
        $this->commentaire=$commentaire;
        $this->login=$utilisateur->login;
        $this->mat=$voiture->matricule;
    }

    public function __set($attr,$value){
        if(!isset($this->$attr)){
            return"Erreur";
        }else{
            $this->$attr=$value;
        }
    }

    public function __get($attr){
        if(!isset($this->$attr)){
            return"Erreur";
        }else{
            return $this->$attr;
        }
    }
    public static function ChercherMissionParUtilisateur($conn,$login){
        $req = "SELECT * FROM mission WHERE login_utilisateur ='$login'";
        return $result = $conn->query($req);
    }
    public static function ChercherMissionParIdMissionEtLogin($conn,$login,$idMission){
        $req = "SELECT * FROM mission WHERE login_utilisateur='$login'AND idMission='$idMission'";
        return $result = $conn->query($req);
    }
    public static function ChercherMission($conn,$idMission){
    $req = "SELECT * FROM mission WHERE idMission = '$idMission'";
    return $result = $conn->query($req);
    }
    public static function UpdateMission($conn,$idMission,$dateFin,$commentaire){
        $req = "UPDATE mission SET date_fin='$dateFin',commentaire='$commentaire' WHERE idMission='$idMission'";
        return $result = $conn->query($req);
    }
    public static function chercherTousLesMissions($conn){
        $req = "SELECT * FROM mission";
        return $result = $conn->query($req);
    }
    public static function AjouterMission($conn,$idMission,$objectif,$ville,$description,$dateDeb,$Chauffeur,$voiture){
        $req = "INSERT INTO mission (idMission,objectif,ville,description,dateDebut,dateFin,etat,commentaire,login_utilisateur,matricule_voiture)VALUES ('$idMission','$objectif','$ville','$description','$dateDeb','','0','','$Chauffeur','$voiture')";
        return $result = $conn->query($req);
    }
    public static function SupprimerMission($conn,$idMission){
        $req = "DELETE FROM mission WHERE idMission='$idMission'";
        return $result = $conn->query($req);
    }
    public static function ModifierMissionEnAttente($conn,$idMission,$objectif,$ville,$description,$date_debut,$login,$voiture){
        $req= "UPDATE mission SET objectif='$objectif',ville='$ville',description='$description',dateDebut='$date_debut',login_utilisateur='$login',matricule_voiture='$voiture' WHERE idMission='$idMission'";
        return $result = $conn->query($req);
    }
}
?>
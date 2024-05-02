<?php
class Voiture{
    private $matricule;
    private $marque;
    private $couleur;
    private $dateAchat;
    public function __construct($matricule,$marque,$couleur,$dateAchat)
    {
        $this->matricule=$matricule;
        $this->marque=$marque;
        $this->couleur=$couleur;
        $this->dateAchat=$dateAchat;
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
    public static function chercherVoiture($conn){
        $req = "SELECT * FROM voiture";
        return $result = $conn->query($req);
    }
    public static function chercherParMarque($conn,$marque){
        $req = "SELECT * FROM voiture WHERE marque='$marque'";
        return $result = $conn->query($req);
    }
    public static function chercherVoitureParMatricule($conn,$matricule){
        $req = "SELECT * FROM voiture WHERE matricule='$matricule'";
        return $result = $conn->query($req);
    }
    public static function ajouterVoiture($conn,$matricule,$marque,$couleur,$dateAchat){
        $req = "INSERT INTO voiture(matricule,marque,couleur,dateAchat) VALUES('$matricule','$marque','$couleur','$dateAchat')";
        return $result = $conn->query($req);
    }
    public static function supprimerVoiture($conn,$matricule){
        $req = "DELETE FROM voiture WHERE matricule='$matricule'";
        return $result = $conn->query($req);
    }
    public static function modifierVoiture($conn,$matricule,$marque,$couleur,$dateAchat){
        $req = "UPDATE voiture SET marque='$marque',couleur='$couleur',dateAchat='$dateAchat' WHERE matricule='$matricule'";
        return $result = $conn->query($req);
    }
    public function __toString()
    {
        return "Matricule:".$this->matricule. "Marque:".$this->marque. "Couleur:".$this->couleur. "DateAchat:".$this->dateAchat;
    }
}
?>
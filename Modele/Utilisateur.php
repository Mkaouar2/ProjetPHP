<?php
class Utilisateur{
    private $login;
    private $password;
    private $nom;
    private $cin;
    private $email;
    private $role;

    public function __construct($login,$password,$nom,$cin,$email,$role){
        $this->login=$login;
        $this->password =$password;
        $this->nom =$nom;
        $this->cin =$cin;
        $this->email =$email;
        $this->role =$role;
    }
    public static function Ajouter($conn,$login,$password,$nom,$cin,$email,$role){
        $req = "INSERT INTO utilisateur(login,password,nom,cin,email,role) VALUES('$login','$password','$nom','$cin','$email','$role')";
        return $conn->query($req);
    }
    public static function Chercher($conn, $login, $password){
        $req = "SELECT * FROM utilisateur WHERE login='$login' AND password='$password'";
        $result = $conn->query($req);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return null; 
        }
    }
    public static function CherchertousUtilisateurs($conn){
        $req = "SELECT * FROM utilisateur";
        return $result = $conn->query($req);
    }
    public static function chercherParUtilisateur($conn,$login){
        $req = "SELECT * FROM utilisateur WHERE login='$login'";
        return $result = $conn->query($req);
    }
    public static function chercherUtilisateurParNom($conn,$nom){
        $req = "SELECT * FROM utilisateur WHERE nom='$nom'";
        return $result = $conn->query($req);
    }
    public static function chercherTousLesChauffeur($conn){
        $req = "SELECT * FROM utilisateur WHERE role='0'";
        return $result = $conn->query($req);
    }
    public static function supprimerChauffeurs($conn,$login){
        $req = "DELETE FROM utilisateur WHERE login='$login'";
        return $conn->query($req);
    }
    public static function modifierChauffeur($conn,$login,$nom,$cin,$email){
        $req = "UPDATE utilisateur SET nom='$nom',cin='$cin',email='$email' WHERE login='$login'";
        return $conn->query($req);
    }
  
    public function __get($attr)
    {
        if(isset($attr)){
            return $this->$attr;
        }else{
            return null;
        }
    }
    public function __toString()
    {
        return "Nom:".$this->nom."<br/>"."Role:".$this->role;
    }
}
?>
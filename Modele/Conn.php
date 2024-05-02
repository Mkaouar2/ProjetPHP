<?php
include_once("myparam.inc.php");
class Conn{
    public static function obtenir_connexion() {
        try {
            $conn = new mysqli(MYHOST, MYUSER, MYPASS, "dbparc");
            return $conn;
        } catch (mysqli_sql_exception $ex) {
            echo "Erreur lors de la connexion à la base de données : " . $ex->getMessage();
            return null;
        }
    }
}
?>

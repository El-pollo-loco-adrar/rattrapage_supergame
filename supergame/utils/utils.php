<?php
//Fonction de nettoyage de données
function sanitize($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}

//Fonction de création de l'objet de connexion PDO
//TODO : configurer correctement les paramètres du constructeur
function connect(){
    $pdo = new PDO('mysql:host=localhost;dbname=supergame','root','',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $pdo->exec('SET NAMES "utf8mb4"');
    return $pdo;
}

?>
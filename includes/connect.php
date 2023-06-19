<?php
    // Constantes d'environement
    define("DBHOST", "localhost");
    define("DBUSER", "root");
    define("DBPASS", "motdepasse1@");
    define("DBNAME", "reservationsalles");

    // Avec PDO nous avons besoin d'un DSN (Data Source Name)
    // $dsn = "mysql:dbname=tuto_php;host=localhost";
    $dsn = "mysql:dbname=".DBNAME.";host=".DBHOST;

    // On va se connecter à la base
    // On utilise le "try catch"
    try {
        // On va instancier PDO, créer une instance, un élément de PDO qu'on va mettre dans une variable
        $db = new PDO($dsn, DBUSER, DBPASS);

        // echo "On est connecté";

        // On s'assure d'envoyer les données en UTF8 (pour la gestion des accents)
        $db->exec("SET NAMES utf8");

        // On peut définir le mode de "fetch" par défaut
        $db->setAttribute(  PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); # Définition du mode par défaut en tableau associatif

    } catch (PDOException $e) {
        die("Erreur:".$e->getMessage());
    }


?>    

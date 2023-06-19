<?php
// On démarre la session PHP
// session_start();
if (isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
// On vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    var_dump($_POST); # vérification des valeurs depuis le formulaire
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis
    if (isset($_POST["login"], $_POST["password"])
        && !empty($_POST["login"]) && !empty($_POST["password"])){

        // Le formulaire est complet
        // On réqupère les données en les protégeant (failles XSS)
        $identifiant = strip_tags($_POST["login"]); # Enlève toutes les balises qui pourrait éventuellement être dedans
        
        // On vérifie que l'email est vraiment un email
        if (!filter_var($_POST["login"], FILTER_DEFAULT)) {
            die("Le login est incorrecte");
        }

        // On va hasher le mot de passe
        $pass = password_hash($_POST["password"], PASSWORD_ARGON2ID);

        // die($pass); permet de voir le mot de passe hashé

        // Ajouter ici tous les contrôles souhaités



        // On enregistre en BDD
        require_once "includes/connect.php";

        $sql = "INSERT INTO `utilisateurs`(`login`, `password`) VALUES 
        (:identifiant, '$pass')";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(":identifiant", $identifiant, PDO::PARAM_STR);
        // $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        // On exécute la requête
        $query->execute();

        // On récupère l'id du nouvel utilisateur
        $id = $db->lastInsertId();

        

        // On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $id,
            "identifiant" => $identifiant
            // "email" => $_POST["email"]
            // "roles" => ["ROLE_USER"]
        ];

        // On redirige vers la page connexion
        header("Location: connexion.php");

    }else{
        die("Le formulaire est incomplet");
    }
}


    // On inclue le header
    include "includes/header.php";

    // On inclue la navbar
    include_once "includes/navbar.php";

    // On écrit le contenu de la page
?>

<h1>Inscription</h1>

<!-- Un formulaire en méthode POST -->
<div class="container">
    <form method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
        </div>
        <!-- <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div> -->
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>
        <!-- <div>
            <label for="pass">Confirmation du mot de passe</label>
            <input type="password" name="pass" id="pass">
        </div> -->
        <button type="submit">M'inscrire</button>
    </form>
</div>

<?php

    // On inclue le footer
    include_once "includes/footer.php";

?>

<link rel="stylesheet" href="css/connexion_styles.css">
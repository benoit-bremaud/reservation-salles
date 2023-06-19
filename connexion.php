<?php
// On démarre la session PHP
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}
// On vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    var_dump($_POST); # vérification des valeurs depuis le formulaire
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis
    if (isset($_POST["login"], $_POST["password"])
        && !empty($_POST["login"]) && !empty($_POST["password"])
    ){
        // On vérifie que l'eamil est valide
        if (!filter_var($_POST["login"], FILTER_DEFAULT)) {
            die("Ce n'est pas un nom valide");
        }

        // On se connecte à la bdd
        require_once "includes/connect.php";

        // On écrit la requête
        $sql = "SELECT * FROM  `utilisateurs` WHERE `login` = :username";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(":username", $_POST["login"], PDO::PARAM_STR);

        // On exécute la requete
        $query->execute();

        // On récupère les données
        $user = $query->fetch();

        // On affiche le résultat
        // var_dump($user);die;
        // Gestion de si oui ou non il y a un user
        if (!$user) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        // Ici on a un user existant, on peut vérifier son mot de passe
        var_dump(password_verify($_POST["password"], $user["password"]));
        if (!password_verify($_POST["password"], $user["password"])) {
            die("L'utilisateur et/ou le mot de passe est incorrect");
        }

        // Ici l'utilisateur et le mot de passe sont corrects
        // On va pouvoir "connecter" l'utilisateur (ouvrir la session)
        

        // On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id"],
            "identifiant" => $user["login"]
            // "email" => $user["email"]
            // "roles" => $user["roles"]
        ];

        // On redirige vers la page de profil(par exemple)
        header("Location: index.php");
    }
}

    // On inclue le header
    include "includes/header.php";

    // On inclue la navbar
    include_once "includes/navbar.php";

    // On écrit le contenu de la page
?>

<h1>Connexion</h1>

<!-- Un formulaire en méthode POST -->
<div class="container">
    <form method="post">
        <div>
            <label for="login">Login</label>
            <input type="text" name="login" id="login">
        </div>
        <div>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>
        <button type="submit">Me connecter</button>
    </form>
</div>

<?php

    // On inclue le footer
    include_once "includes/footer.php";
?>

<link rel="stylesheet" href="css/connexion_styles.css">


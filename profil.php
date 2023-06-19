<?php
    session_start();
    // On inclut le header
    include "includes/header.php";

    // On inclut la navbar
    include_once "includes/navbar.php";

    // On écrit le contenu de la page
?>


<h1>Profil de <?= $_SESSION["user"]["identifiant"] ?></h1>

<p>identifiant : <?= $_SESSION["user"]["identifiant"] ?></p>


<?php

    // On inclue le footer
    include_once "includes/footer.php";
?>

<link rel="stylesheet" href="css/navbar_styles.css">

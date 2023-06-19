<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}

// Supprime une variable
unset($_SESSION["user"]);

header("Location: index.php");
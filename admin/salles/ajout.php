<?php
// On traite le formulaire
if (!empty($_POST)) {
    // POST n'est pas vide, on vérifie que toutes les données sont présentes
    if(
        isset($_POST["titre"], $_POST["contenu"])
        && !empty($_POST["titre"]) && !empty($_POST["contenu"])
    ){
        // Le formulaire est complet
        // On récupère les données en les protégeant (failles XSS)
        // On retire toute balise du titre
        $titre = strip_tags($_POST["titre"]); # On supprime les balises du titre

        // On neutralise toute balise du contenu
        $contenu = htmlspecialchars($_POST["contenu"]); # balises désactivées

        // On peut les enregistrer
        // On se connecte à la base
        require_once "../../includes/connect.php";

        // On écrit la requête
        $sql = "INSERT INTO `articles`(`title`, `content`) VALUES (:title, :content)";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(":title", $titre, PDO::PARAM_STR);
        $query->bindValue(":content", $contenu, PDO::PARAM_STR);

        // On exécute la requête
        if (!$query->execute()) {
            die("Une erreur est survenue");
        }
        
        // On récupère l'id de l'article
        $id = $db->lastInsertId();

        die("Article ajouté sous le numéro $id");

    } else {
        die("Le formulaire est incomplet");
    }
}

$titre = "Ajouter un article";

// On inclut le header
include_once "../../includes/header.php";

include_once "../../includes/navbar.php";
?>
<h1>Ajouter un article</h1>

<!-- Formulaire en méthode POST -->
<form method="post">
    <div>
        <label for="titre">TItre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="contenu">Contenu</label>
        <textarea name="contenu" id="contenu"></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php
include_once "../../includes/footer.php";
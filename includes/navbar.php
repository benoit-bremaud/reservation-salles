<nav class="navbar">
    <a href="#" class="logo">Logo</a>
    <!-- Création d'un bouton "burger" -->
    <label for="btn" class="icon">
        <svg viewBox="0 0 100 80" width="40" height="40">
            <rect width="100" height="15"></rect>
            <rect y="35" width="100" height="15"></rect>
            <rect y="70" width="100" height="15"></rect>
        </svg>
    </label>
    <input type="checkbox" id="btn">
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
            <a href="#">Planning</a>
        </li>
        <?php if(!isset($_SESSION["user"])): ?>
        <li class="nav-item">
            <a href="connexion.php">Connexion</a>
        </li>
        <li class="nav-item">
            <a href="inscription.php">Inscription</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
            <a href="deconnexion.php">Déconnexion</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
            <label for="btn2" class="show">Mon compte +</label>
            <input type="checkbox" id="btn2">
            <ul class="dropdown">
                <li class="drop-item">
                    <a href="#">Mon Profil</a>
                </li>
                <li class="drop-item">
                    <a href="#">Lien 1</a>
                </li>
                <li class="drop-item">
                    <a href="#">Lien 2</a>
                </li>
                <li class="drop-item">
                    <a href="#">Lien 3</a>
                </li>                    
            </ul>
        </li>
        <li class="nav-item">
            <a href="#">Autre Menu</a>
        </li>
    </ul>
</nav>
<link rel="stylesheet" href="css/navbar_styles.css">


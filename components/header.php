<!DOCTYPE html>
<header id="header">
    <img src="/assets/logo.png" alt="Logo" style="cursor: pointer" onclick="window.location.href='accueil.html'">
    <div class="search-wrapper">
        <input type="text" id="search-input" placeholder="Type to search"/>
    </div>
    <div class="login">
        <?php
        if(isset($_COOKIE['userId']))
        {
            echo '<a href="/deconnexion.php">Déconnexion</a>';
        }
        else
        {
            echo '<a href="/connexion.php">Connexion</a>';
            echo ' | ';
            echo '<a href="/inscription.php">Inscription</a>';
        }
        ?>
    </div>
</header>


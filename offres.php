<!DOCTYPE html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="/assets/styles/accueil.css">
</head>
<body>
<header class="header">
    <img src="/assets/logo.png" alt="Logo" style="cursor: pointer" onclick="window.location.href='accueil.html'">
    <div class="search-wrapper">
        <input type="text" class="search-input" placeholder="Type to search"/>
    </div>
    <div class="login"><a href="connexion.php">Connexion</a> | <a href="inscription.php">Inscription</a></div>
</header>
<main class="main">
    <div class="list-offres">
        <div class="parametres">
            <div class="mode"><a class="selected">Classic</a> | <a href="fancy.html">Fancy</a></div>
            <button class="filtres">Filtrer ▼</button>
        </div>
        <div class="posts">
            <div class="offre">
                <img src="/assets/poste.png" alt="Entreprise">
                <article>
                    <div class="c1">
                        <span class="poste">Poste</span>
                        <span class="entreprise">Entreprise</span>
                        <span class="niveau">Niveau</span>
                    </div>
                    <div class="c2">
                        <span class="domaine">Domaine</span>
                        <span class="dates">Dates</span>
                    </div>
                    <div class="c3">
                    </div>
                    <div class="list-competences">
                        <ul class="competences">Compétences :
                            <li>competence 1</li>
                            <li>competence 2</li>
                        </ul>
                    </div>
                </article>
            </div>
        </div>
    </div>
</main>
</body>
</html>

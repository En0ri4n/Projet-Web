<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
    <link rel="stylesheet" href="/assets/styles/etudiant_interne.css">
</head>
<body>
<header class="header">
    <img src="/assets/logo.png" alt="Logo">
    <div class="search"><input type="search" placeholder="Rechercher..."><button>🔍</button></div>
    <div class="login"><a href="connexion.php">Connexion</a> | <a href="inscription.php">Inscription</a></div>
</header>
<main>
    <div class="profil">
        <div class="form">
            <h1>Profil</h1>
            <br>
            <form method="post">
                <div class="form__inputs">
                    <input type="text" id="nom" name="nom" placeholder="Nom">
                    <input type="text" id="prenom" name="prenom" placeholder="Prénom">
                    <input type="email" id="email" name="email" placeholder="E-mail">
                    <input type="text" id="domaine" name="domaine" placeholder="Domaine">
                    <input type="tel" id="telephone" name="telephone" placeholder="Téléphone">
                    <input type="text" id="adresse" name="adresse" placeholder="Adresse">
                    <input type="text" id="centre" name="centre" placeholder="Centre">
                    <input type="text" id="promotion" name="promotion" placeholder="Promotion">
                    <input type="submit" value="Appliquer les modifications">
                </div>
            </form>
        </div>
        <img src="/assets/logo.png" alt="Image de profil">
    </div>
    <div class="informations">
        <div class="listes">
        <div class="competences">
            <h1>Compétences</h1>
            <ul>
            <li>compétence 1</li>
            <li>compétence 2</li>
            <li>compétence 3</li>
            </ul>
            </div>
        <button class="edit">Modifier ✏️</button>
        <div class="langues">
            <h1>Langues</h1>
            <ul>
                <li>langue 1</li>
                <li>langue 2</li>
                <li>langue 3</li>
            </ul>
        </div>
        <button class="edit">Modifier ✏️</button>
        </div>
        <article class="formation">
            <h1>Formations</h1>
            <ul>
                <li><h2>Ecole 1</h2><p>Détails, année, cycle, diplôme etc.</p></li>
                <li><h2>Ecole 2</h2><p>Détails, année, cycle, diplôme etc.</p></li>
                <li><h2>Ecole 3</h2><p>Détails, année, cycle, diplôme etc.</p></li>
            </ul>
            <button class="edit">Modifier ✏️</button>
        </article>
    </div>
</main>
</body>
</html>
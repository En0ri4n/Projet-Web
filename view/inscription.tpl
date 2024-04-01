<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
    {include file='components/head.tpl'}
    <!-- Description: This is the inscription page. -->
    <!-- It is used to create an account on the website. -->
    <meta name="description" content="This is the inscription page. It is used to create an account on the website.">
    <meta name="keywords" content="inscription, account, create, website">
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div class="form">
        <h1>Inscription</h1>
        <form method="post" id="form_inscription">
            <div class="form__inputs">
                <input type="text" id="id-utilisateur" name="id-utilisateur" placeholder="Identifiant" required>
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required>
                <input type="email" id="email" name="email" placeholder="E-mail" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirmation" required>
            </div>
            <div class="account-type" id="account">
                <div>
                    <input type="radio" id="student-account" name="account-type" value="etudiant" required>
                    <label for="student-account">Élève</label>
                </div>
                <div>
                    <input type="radio" id="pilote-account" name="account-type" value="pilote" required>
                    <label for="pilote-account">Pilote</label>
                </div>
                {if $current_user_type == 'administrateur'}
                    <div>
                        <input type="radio" id="admin-account" name="account-type" value="admin" required>
                        <label for="admin-account">Administrateur</label>
                    </div>
                {/if}
            </div>
            <div class="form__inputs" id="pilote-form" style="display: none">
                <input type='text' name='name-promotion' placeholder='Nom de la Promotion' required>
                <input type="text" name="type-promotion" placeholder="Spécialité de la Promotion" required>
                <input type='date' name='date-promotion' placeholder='Date de stag' required>
                <input type="number" name="niveau-promotion" placeholder="Niveau" required>
                <input type='text' name="duree-promotion" placeholder="Durée du stage" required>
                <input type='text' name="centre-promotion" placeholder="Centre de formation" required>
            </div>
            <div class="form__inputs" id="etudiant-form" style="display: none">
                <select id="promotion" name="promotion" required>
                    <option value="" disabled selected>Promotion</option>
                </select>
                <div class="adresse-form">
                    <input type="text" name="numero-rue" placeholder="Numéro de rue" required>
                    <input type="text" name="nom-rue" placeholder="Nom de rue" required>
                    <input type="text" name="code-postal" placeholder="Code postal" required>
                    <select id="ville" name="ville" required>
                        <option value="" disabled selected>Ville</option>
                    </select>
                    <input type="text" name="pays" placeholder="Pays" required>
                </div>
            </div>
            <div class="center">
                <input class="submit" type="submit" value="Confirmer l'inscription">
            </div>
        </form>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/inscription.js"></script>
</html>
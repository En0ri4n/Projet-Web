<!DOCTYPE html>
<html lang="fr">
<head>
    <title>{if $is_modification}Modifier un Utilisateur{else}Ajouter un utilisateur{/if}</title>
    {include file='components/head.tpl'}
    <!-- Description: This is the inscription page. -->
    <!-- It is used to create an account on the website. -->
    <meta name="description" content="This is the inscription page. It is used to create an account on the website.">
    <meta name="keywords" content="inscription, account, create, website">
</head>
<body>
{include file='components/header.tpl'}
<main>
    <section class="form">
        <h1>{if $is_modification}Mettre à jour {$user->getId()}{else}Créer un Utilisateur{/if}</h1>
        <form method="post" id="form_inscription" action="/api/users">
            <div class="form__inputs">
                <label for="id-utilisateur">Identifiant</label>
                <input type="text" id="id-utilisateur" name="IdUtilisateur" placeholder="Identifiant" required>
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="Nom" placeholder="Nom" required>
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="Prenom" placeholder="Prénom" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="MailUtilisateur" placeholder="E-mail" required>
                <label for="telephone">Telephone</label>
                <input type="tel" id="telephone" name="TelephoneUtilisateur" placeholder="Téléphone" required>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="MotDePasse" placeholder="Mot de passe" required>
                <label for="password-confirm">Confirmez le mot de passe</label>
                <input type="password" id="password-confirm" name="password-confirm" placeholder="Confirmation" required>
                <label for="promotion">Promotion</label>
                <select id="promotion" name="idPromo" required>
                    <option value="" disabled selected>Promotion</option>
                </select>
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
                        <input type="radio" id="admin-account" name="account-type" value="admininistrateur" required>
                        <label for="admin-account">Administrateur</label>
                    </div>
                {/if}
            </div>
            <input type="hidden" value="etudiant" name="type" id="type">
            <div class="form__inputs" id="etudiant-form" style="display: none">
                <div class="adresse-form">
                    <input type="number" id="adresse-numero" name="Numero" placeholder="Numéro de rue" required>
                    <input type="text" id="adresse-rue" name="Rue" placeholder="Nom de rue" required>
                    <input type="text" id="code-postal" name="CodePostal" placeholder="Code postal" required>
                    <select id="ville" name="Ville" required>
                        <option value="" disabled selected>Ville</option>
                    </select>
                    <input type="text" id="adresse-pays" name="Pays" placeholder="Pays" required>
                </div>
            </div>
            <div class="center">
                <input class="submit" type="submit" value="Confirmer {if $is_modification}la modification{else}l'inscription{/if}">
            </div>
        </form>
    </section>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/inscription.js"></script>
</html>
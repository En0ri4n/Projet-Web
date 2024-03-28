{* TODO: Style et tout *}
<div class="profil">
    <div>
        {if $user_exists}
        <h1>Profil de {$user->getPrenom()} {$user->getNom()}</h1>
        <div>
            <ul>
                <li>Identifiant : {$user->getId()}</li>
                <li>Prénom : {$user->getPrenom()}</li>
                <li>Nom : {$user->getNom()}</li>
                <li>Email : {$user->getEmail()}</li>
                <li>Téléphone : {$user->getTelephone()}</li>
                {if $user_type == "etudiant"}
                <li>Promotion : {$user->getIdPromotion()}</li>
                <li>Adresse : {$user->getIdAdresse()}</li>
                {/if}
            </ul>
        </div>
        <div>
            <img src="/assets/profil.png" alt="Image de profil">
        </div>
        {else}
        <h1>Cet utilisateur n'existe pas :/</h1>
        {/if}
    </div>
</div>
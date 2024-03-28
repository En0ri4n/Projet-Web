{* TODO: Style et tout *}
{if $user_exists}
    <h1>Profil de {$user->getPrenom()} {$user->getNom()}</h1>
    <div class="profil">
        <div>
            <img src="/assets/profil.png" width=100% alt="Image de profil">
        </div>
        <div class="liste-info">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Identifiant</span> <span>{$user->getId()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Prénom</span> <span>{$user->getPrenom()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Nom</span>  <span>{$user->getNom()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Email</span>  <span>{$user->getEmail()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Téléphone</span>  <span>{$user->getTelephone()}</span>
            </div>
            {if $user_type == "etudiant"}
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Promotion</span>  <span>{$user->getIdPromotion()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Adresse</span>  <span>{$user->getIdAdresse()}</span>
            </div>
            {/if}
        </div>
    </div>
{else}
    <h1>Cet utilisateur n'existe pas :/</h1>
{/if}
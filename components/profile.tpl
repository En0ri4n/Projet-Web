{* TODO: Style et tout *}
<div class="profil">
    <h1>Profil de {$user->getPrenom()} {$user->getNom()}</h1>
    <div>
        <div>
            <img src="/assets/profil.png" width=128 alt="Image de profil">
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
                <span class="soustitre-liste">Nom</span> <span>{$user->getNom()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Email</span> <span>{$user->getEmail()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Téléphone</span> <span>{$user->getTelephone()}</span>
            </div>
            {if $user_type == "etudiant"}
                <div>
                    <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                    <span class="soustitre-liste">Promotion</span> <span>{$promotion->getNom()}</span>
                </div>
                <div>
                    <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                    <span class="soustitre-liste">Adresse</span>
                    <span>{$adresse->getNumero()} {$adresse->getRue()} {$adresse->getVille()} {$adresse->getPays()}</span>
                </div>
            {/if}
            {if $user_type == "pilote"}
                <div>
                    <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                    <span class="soustitre-liste">Promotion(s) à charge </span>
                    {if $has_promotion}
                        <ul>
                            {foreach $promotions as $promo}
                                <li>{$promo->getNom()}</li>
                            {/foreach}
                        </ul>
                    {else}
                        Aucune
                    {/if}
                </div>
            {/if}
        </div>
    </div>
</div>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Description Offre</title>
    {include file='components/head.tpl'}

    <!-- pas toucher -->
    <!-- map -->
    <link rel="stylesheet" href="/assets/styles/map.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script src="scripts/map2.js" defer></script>
</head>
<body>
{include file='components/header.tpl'}
<main>
    {if $offre_exists}
    <div id="premiere_section">
        <div class="map" id="map"></div>
    </div>
    <div class="resume-entreprise">
        <div class="entete-entreprise">
            <h1><a class="titre-link" href="/description-entreprise?entrepriseId={$entreprise->getId()}">{$entreprise->getNom()}</a></h1>
            <span id="Domaine">
                {foreach $entreprise_secteurs as $secteur}
                    {$secteur->getNom()}
                {/foreach}
            </span>
        </div>
        <p class="description">
            {$entreprise->getDescription()}
        </p>
    </div>
    <div class="resume-offre">
        <h1>Offre</h1>
        <div class="liste-info">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Titre du Poste</span> <span>{$offre->getName()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Niveau demandé</span> <span>A{$offre->getLevel()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Domaine</span>  <span>{$secteur->getNom()}</span>
            </div>
        </div>
    </div>
    <div class="description-offre">
        <h1>Description de l'offre</h1>
        <p class="description">
            {$offre->getDescription()}
        </p>
    </div>
    <div class="competence-demandees">
    <h1>Compétences</h1>
        <div class="box_competences">
            {foreach $competences as $comp}
                <div>
                    <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                    <span>{$comp->getNom()}</span>
                </div>
            {/foreach}
        </div>
</div>
    <div class="actions-offres">
        <button class="button-action-offre"id="postuler" onclick="window.location.href='/candidature?offreId={$offre->getId()}'">Postuler</button> {* TODO: Page postuler *}
        <button class="button-action-offre" id="wishlist">Wishlist</button> {* TODO: requête wishlist *}
    </div>
    <div class="contact">
        <h1>Contact</h1>
        <div class="liste-info">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Adresse</span>
                <span>{$entreprise_adresses[0]->getNumero()} {$entreprise_adresses[0]->getRue()} {$entreprise_adresses[0]->getVille()} {$entreprise_adresses[0]->getCodePostal()}</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Mail</span> <span><a href="mailto:{$entreprise->getEmail()}">{$entreprise->getEmail()}</a></span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Telephone</span>  <span><a href="tel:{$entreprise->getTelephone()}">{$entreprise->getTelephone()}</a></span>
            </div>
        </div>
    </div>
    {else}
        <h1>L'offre n'existe pas :/</h1>
    {/if}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/descriptions.js"></script>
</html>
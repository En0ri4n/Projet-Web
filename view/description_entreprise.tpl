<!DOCTYPE html>
<html lang="fr">
<head>
    <title>
        {if $entreprise_exists}
            {$entreprise->getNom()} - Entreprise
        {else}
            Entreprise introuvable
        {/if}
    </title>
    {include file='components/head.tpl'}

    <!-- pas toucher -->
    <!-- etoiles -->
    <link rel="stylesheet" href="/assets/styles/etoile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="/scripts/etoile.js" defer></script>

    <!-- map -->
    <link rel="stylesheet" href="/assets/styles/map.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
    <script src="/scripts/map.js" defer></script>

</head>
<body>

{include file='components/header.tpl'}
<main>
    {if $entreprise_exists}
    <section id="premiere_section">
        <div class="map" id="map"></div>
    </section>
    <section class="resume-entreprise">
        <div class="entete-entreprise">
            <h1>{$entreprise->getNom()}</h1>
            <span id="Domaine">
                {foreach $entreprise_secteurs as $secteur}
                    {$secteur->getNom()}
                {/foreach}
            </span>
        </div>
        <p class="description">
            {$entreprise->getDescription()}
        </p>
    </section>
        <h1>Offres de l'entreprise</h1>
    <section class="liste-offres" id="liste-offres">
        <img src="/assets/loading.gif" alt="loading" id="loading">
    </section>
        {include file="components/pagination.tpl" index=0}
    <section class="evaluation">
        <h2>Laisser une évaluation</h2>
        <div class="note-etoiles">
            <span class="fas fa-star" data-star="1"></span>
            <span class="fas fa-star" data-star="2"></span>
            <span class="fas fa-star" data-star="3"></span>
            <span class="fas fa-star" data-star="4"></span>
            <span class="fas fa-star" data-star="5"></span>
        </div>
        <form method="post" action="/api/evaluations" id="form-avis">
            <div class = "form__inputs">
                <textarea id="commentaire" placeholder="Ecrivez votre commentaire" name="Commentaire"></textarea>
                <input type="hidden" id="note" name="Note" value="0">
                <input type="hidden" name="IdEntreprise" value="{$entreprise->getId()}">
                <input class="submit" id="btn-ajouter-avis" type="submit" value="Envoyer">
            </div>
        </form>
        <div id="liste-evaluations">
            <img src="/assets/loading.gif" alt="loading" id="loading"/>
        </div>
        {include file='components/pagination.tpl' index=1}
    </section>
    <section class="contact">
        <h1>Contact</h1>
        <div class="liste-info">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Adresse</span>
                <ul>
                    {foreach $entreprise_adresses as $adresse}
                        <li>{$adresse->getNumero()} {$adresse->getRue()} {$adresse->getVille()} {$adresse->getCodePostal()}</li>
                    {/foreach}
                </ul>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Mail</span> <span><a href="mailto:{$entreprise->getEmail()}">{$entreprise->getEmail()}</a></span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-liste">Telephone</span> <span><a href="tel:{$entreprise->getTelephone()}">{$entreprise->getTelephone()}</a></span>
            </div>
        </div>
    </section>
    {else}
        <h1>L'entreprise n'existe pas :/</h1>
    {/if}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/etoile.js"></script>
<script type="module" src="/scripts/description_entreprise.js"></script>
</html>
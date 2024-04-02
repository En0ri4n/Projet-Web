<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Description Entreprise</title>
    {include file='components/head.tpl'}
    <!-- pas toucher -->
    <link rel="stylesheet" href="/assets/styles/etoile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="etoile.js" defer></script>
</head>
<body>
{include file='components/header.tpl'}
<main>
    {if $entreprise_exists}
    <div id="premiere_section">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d206142.40185708913!2d7.438217952285873!3d48.6633638245937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47942e6e169737ed%3A0xb799f7853b7d739!2sPompes%20Funebres%20du%20Pays%20De%20Bitches!5e0!3m2!1sfr!2sfr!4v1708078412049!5m2!1sfr!2sfr"
                    style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="resume-entreprise">
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
    </div>
    <div class="liste-offres">
        <h1>Offres de l'entreprise</h1>
        <article class="offre" onclick="window.location.href='{$default_page}';">
            <div class="c1">
                <span class="poste">Poste</span>
                <span>Entreprise</span>
                <span class="niveau">Niveau</span>
            </div>
            <div class="c2">
                <span class="domaine">Domaine</span>
                <span class="dates">Dates</span>
            </div>
            <div class="c3">
                <ul class="competences">Compétences :
                    <li>competence 1</li>
                    <li>competence 2</li>
                </ul>
            </div>
        </article>
    </div>
    <div class="evaluation">
        <h2>Laisser une évaluation</h2>
        <div class="note-etoiles">
            <span class="fas fa-star" data-star="1"></span>
            <span class="fas fa-star" data-star="2"></span>
            <span class="fas fa-star" data-star="3"></span>
            <span class="fas fa-star" data-star="4"></span>
            <span class="fas fa-star" data-star="5"></span>
        </div>
    </div>
    <div class="contact">
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
                <span class="soustitre-liste">Telephone</span> <span><a href="tel:{$entreprise->getTelephone()}">{$entreprise->getTelephone()}</span>
            </div>
        </div>
    </div>
    {else}
        <h1>L'entreprise n'existe pas :/</h1>
    {/if}
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/etoile.js"></script>
</html>
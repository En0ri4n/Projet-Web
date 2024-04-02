<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Description Entreprise</title>
    {include file='components/head.tpl'}
    <!-- pas toucher -->
    <link rel="stylesheet" href="/assets/styles/etoile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
    <script src="etoile.js" defer></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     <style>
        #map {height: 500px; width:500px}
     </style>
</head>
<body>

{include file='components/header.tpl'}
<main>
    {if $entreprise_exists}
    <div id="premiere_section">
        <div class="map">
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
<script>

var map = L.map('map');
    map.setView([51.505, -0.09], 13);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

let apiKey = "8b0b65847e964e828fb065d72b3a57b4";

const address = 'Baldersgade 3B, 2200 Copenhagen, Denmark';

fetch(`https://api.geoapify.com/v1/geocode/search?text=${encodeURIComponent(address)}&apiKey=8b0b65847e964e828fb065d72b3a57b4`)
.then(resp => resp.json())
.then((geocodingResult) => {
	console.log(geocodingResult);
});

addressurl = "https://api.geoapify.com/v1/geocode/search?housenumber=11&street=Rue%20Grenette&postcode=69002&city=Lyon&country=France&apiKey=8b0b65847e964e828fb065d72b3a57b4";

/*navigator.geolocation.watchPosition(success, error);*/

let marker;

marker = L.marker([lat, lon]).addTo(map);
map.setView([address.lat, address.lon], 17);
</script>
</html>
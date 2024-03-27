<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Description Offre</title>
    {include file='components/head.tpl'}
</head>
<body>
{include file='components/header.tpl'}
<main>
    <div id="premiere_section">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d206142.40185708913!2d7.438217952285873!3d48.6633638245937!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47942e6e169737ed%3A0xb799f7853b7d739!2sPompes%20Funebres%20du%20Pays%20De%20Bitches!5e0!3m2!1sfr!2sfr!4v1708078412049!5m2!1sfr!2sfr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <div class="resume-entreprise">
        <div class="entete-entreprise">
            <h1><a class="titre-link" href="description_entreprise.tpl">NomEntreprise</a></h1>
            <span id="Domaine">Domaine</span>
        </div>
        <p class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua. Mi eget mauris pharetra et. Neque aliquam vestibulum morbi blandit cursus
            risus at. Et malesuada fames ac turpis. Proin fermentum leo vel orci porta non pulvinar. Tincidunt
            praesent semper feugiat nibh sed pulvinar proin gravida. At urna condimentum mattis pellentesque id
            nibh. Porta lorem mollis aliquam ut porttitor leo a. Et leo duis ut diam quam nulla porttitor. Quis
            risus sed vulputate odio ut enim blandit. Duis convallis convallis tellus id interdum velit laoreet
            id donec. Et molestie ac feugiat sed lectus vestibulum. Sapien nec sagittis aliquam malesuada
            bibendum. Rutrum quisque non tellus orci ac auctor augue mauris. Tortor posuere ac ut consequat
            semper viverra nam libero. Ante in nibh mauris cursus mattis molestie. Faucibus turpis in eu mi
            bibendum.
        </p>
    </div>
    <div class="resume-offre">
        <h1>Offre</h1>
        <div class="liste-info-offre">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-offre">Titre du Poste</span> <span>inserer nom</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-offre">Niveau demandé</span> <span>inserer niveau</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-offre">Domaine</span>  <span>inserer domaine</span>
            </div>
        </div>
    </div>
    <div class="description-offre">
        <h1>Description de l'offre</h1>
        <p class="description">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
            aliqua. Mi eget mauris pharetra et. Neque aliquam vestibulum morbi blandit cursus risus at. Et malesuada fames ac
            turpis. Proin fermentum leo vel orci porta non pulvinar. Tincidunt praesent semper feugiat nibh sed pulvinar proin
            gravida. At urna condimentum mattis pellentesque id nibh. Porta lorem mollis aliquam ut porttitor leo a. Et leo duis
            ut diam quam nulla porttitor. Quis risus sed vulputate odio ut enim blandit. Duis convallis convallis tellus id
            interdum velit laoreet id donec. Et molestie ac feugiat sed lectus vestibulum. Sapien nec sagittis aliquam malesuada
            bibendum. Rutrum quisque non tellus orci ac auctor augue mauris. Tortor posuere ac ut consequat semper viverra nam
            libero. Ante in nibh mauris cursus mattis molestie. Faucibus turpis in eu mi bibendum.
        </p>
    </div>
    <div class="competence-demandees">
    <h1>Compétences</h1>
        <div class="box_competences">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span>Compétence1</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span>Compétence2</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span>Compétence3</span>
            </div>
        </div>
</div>
    <div class="actions-offres">
        <button class="button-action-offre" id="postuler">Postuler</button>
        <button class="button-action-offre" id="wishlist">Wishlist</button>
    </div>
    <div class="contact">
        <h1>Contact</h1>
        <div class="liste-contact">
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-contact">Adresse</span> <span>inserer adresse</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-contact">Mail</span> <span>inserer mail</span>
            </div>
            <div>
                <img src="/assets/star.svg" class="star-bullet-point" alt="small star">
                <span class="soustitre-contact">Telephone</span>  <span>inserer telephone</span>
            </div>
        </div>
    </div>
</main>
{include file='components/footer.tpl'}
</body>
<script type="module" src="/scripts/descriptions.js"></script>
</html>
<header id="header">
    <div id="header-top">
        <img id="logo" src="/assets/logo.svg" alt="Logo" onclick="window.location.href='{$default_page}'">
        {if $is_connected}
        <nav class="navbar">
            <ul>
                <li><a href="/profil?userId={$current_user->getId()}">Profil</a></li>
                <li><a href="/offres">Offres</a></li>
                <li><a href="/about">À propos de nous</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/mentions">Mentions Légales</a></li>
            </ul>
        </nav>
        <div class="login">
                <a href="/profil?userId={$current_user->getId()}">{$current_user->getPrenom()} {$current_user->getNom()}</a>
                <a href="/api/logout">Déconnexion</a>
        </div>
        {/if}
        <button id="button-menu-burger"><img id="menu-burger-icon" alt="menu" src="/assets/bars_menu.svg"></button>
    </div>
    <div id="header-bottom">
        <ul>
            <li><a href="{$default_page}">Accueil</a></li>
            <li><a href="/offres">Offres</a></li>
            <li><a href="/about">À propos de nous</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/mentions">Mentions Légales</a></li>
        </ul>
    </div>
</header>
<script type="module" src="/scripts/header.js"></script>
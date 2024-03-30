<header id="header">
    <div id="header-top">
        <img id="logo" src="/assets/logo.svg" alt="Logo" onclick="window.location.href='{$default_page}'">
        <!--TODO: See what we do-->
        <div class="search" id="search-header">
            <input type="text" id="search-input" placeholder="Type to search">
            <img id="search-icon" src="/assets/magnifying_glass.svg">
        </div>
        <div class="login">
            {if $is_connected}
                <a href="/profil?userId={$current_user->getId()}">{$current_user->getPrenom()} {$current_user->getNom()}</a>
                <a href="/api/logout">Déconnexion</a>
            {/if}
        </div>
        <button id="button-menu-burger"><img id="menu-burger-icon" src="/assets/bars_menu.svg"></button>
    </div>
    <div id="header-bottom">
        <div class="search"  id="search-burger">
            <input type="text" id="search-input" placeholder="Type to search"> <!--TODO: Make searchbar work-->
            <img id="search-icon" src="/assets/magnifying_glass.svg">
        </div>
        <ul>
            <li><a href="{$default_page}">Accueil</a></li>
            <li><a href="{$index_page}?view=offres">Offres</a></li>
            <li><a href="{$index_page}?view=about">À propos de nous</a></li>
            <li><a href="{$index_page}?view=contact">Contact</a></li>
            <li><a href="{$index_page}?view=mentions">Mentions Légales</a></li>
        </ul>
    </div>
</header>
<script type="module" src="/scripts/header.js"></script>
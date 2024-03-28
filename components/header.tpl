<header id="header">
    <img src="/assets/logo.svg" alt="Logo" onclick="window.location.href='{$default_page}'">
    <!--<div class="search-wrapper">
        <input type="text" id="search-input" placeholder="Type to search"/> TODO: See what we do
    </div>-->
    <div class="login">
        {if $is_connected}
            <a href="/profil?userId={$current_user->getId()}">{$current_user->getPrenom()} {$current_user->getNom()}</a>
            <a href="/api/logout">Déconnexion</a>
        {/if}
    </div>
</header>
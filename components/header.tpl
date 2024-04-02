<header id="header">
    <div id="header-top">
        <img id="logo" src="/assets/logo.svg" alt="Logo" onclick="window.location.href='{$default_page}'">
        {if $is_connected}
            <nav class="navbar">
                <ul>
                    {foreach $links as $name => $link}
                        <li><a href="{$link}">{$name}</a></li>
                    {/foreach}
                </ul>
            </nav>
            <div class="login">
                <a href="/profil?userId={$current_user->getId()}">{$current_user->getPrenom()} {$current_user->getNom()}</a>
                <a href="/api/logout">Déconnexion</a>
            </div>
        {/if}
        <button id="button-menu-burger" ><img id="menu-burger-icon" alt="menu" src="/assets/bars_menu.svg"></button>
    </div>
    <div id="header-bottom">
        <ul>
            {if $is_connected}
                <li><a href="/profil?userId={$current_user->getId()}">{$current_user->getPrenom()} {$current_user->getNom()}</a></li>
                <li><a href="/api/logout">Déconnexion</a></li>
            {/if}
            {foreach $links as $name => $link}
                <li><a href="{$link}">{$name}</a></li>
            {/foreach}
        </ul>
    </div>
</header>
<script type="module" src="/scripts/header.js"></script>
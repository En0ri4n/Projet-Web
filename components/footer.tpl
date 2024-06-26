<footer id="footer">
    <button id="button_back">
        <img src="/assets/arrow_up.svg" alt="fleche haut">
    </button>
    <div class="content">
        {if $is_connected}
        <div id="footer-links">
            <h1>Liens</h1>
            <ul>
                {foreach $footer_links as $name => $link}
                    <li><a href="{$link}">{$name}</a></li>
                {/foreach}
            </ul>
        </div>
        {/if}
    </div>
    <p>© 2024 - Tous droits réservés</p>
</footer>
<script type="module" src="/scripts/footer.js"></script>
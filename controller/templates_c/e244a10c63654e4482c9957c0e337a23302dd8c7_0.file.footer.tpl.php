<?php
/* Smarty version 4.5.1, created on 2024-03-27 16:35:02
  from 'C:\Users\MOI\Documents\cesi\A2\blocs\4web\projet\projet code\Projet-Web\components\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_66043ca6527e63_26563833',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e244a10c63654e4482c9957c0e337a23302dd8c7' => 
    array (
      0 => 'C:\\Users\\MOI\\Documents\\cesi\\A2\\blocs\\4web\\projet\\projet code\\Projet-Web\\components\\footer.tpl',
      1 => 1711550461,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66043ca6527e63_26563833 (Smarty_Internal_Template $_smarty_tpl) {
?><footer id="footer">
    <button id="button_back">
        <img src="/assets/arrow_up.svg" alt="fleche haut">
    </button>
    <div class="content">
        <div id="footer-links">
            <h1>Liens</h1>
            <ul>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['default_page']->value;?>
">Accueil</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['index_page']->value;?>
?view=offres">Offres</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['index_page']->value;?>
?view=about">À propos de nous</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['index_page']->value;?>
?view=contact">Contact</a></li>
                <li><a href="<?php echo $_smarty_tpl->tpl_vars['index_page']->value;?>
?view=mentions">Mentions Légales</a></li>
            </ul>
        </div>
    </div>
    <p>© 2024 - Tous droits réservés</p>
    <!--<div>
        <p><a>Mentions Légales</a></p>
        <p>Site web réalisé par <a href="https://www.linkedin.com/in/enorian-rajoelisoa/" target="_blank">Enorian Rajoelisoa</a>
            , <a href="https://www.linkedin.com/in/louise-ley-26221b282/" target="_blank">Louise Ley</a>
            , <a href="https://www.linkedin.com/in/c%C3%A9dric-hoog-48679a293/" target="_blank">Cédric Hoog</a>
            et <a href="https://www.linkedin.com/in/laura-giese-a78938295/" target="_blank">Laura Giese</a>
        </p>
    </div>-->
</footer>
<?php echo '<script'; ?>
 type="module" src="/scripts/footer.js"><?php echo '</script'; ?>
><?php }
}

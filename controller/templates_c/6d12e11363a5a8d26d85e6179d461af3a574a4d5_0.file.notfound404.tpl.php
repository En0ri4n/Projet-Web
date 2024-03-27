<?php
/* Smarty version 4.5.1, created on 2024-03-27 16:37:33
  from 'C:\Users\MOI\Documents\cesi\A2\blocs\4web\projet\projet code\Projet-Web\view\notfound404.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_66043d3d39e9b1_64816123',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6d12e11363a5a8d26d85e6179d461af3a574a4d5' => 
    array (
      0 => 'C:\\Users\\MOI\\Documents\\cesi\\A2\\blocs\\4web\\projet\\projet code\\Projet-Web\\view\\notfound404.tpl',
      1 => 1711550461,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:components/head.tpl' => 1,
    'file:components/header.tpl' => 1,
    'file:components/footer.tpl' => 1,
  ),
),false)) {
function content_66043d3d39e9b1_64816123 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Page non trouvée</title>
    <?php $_smarty_tpl->_subTemplateRender('file:components/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender('file:components/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main style="display: flex; flex-direction: column">
    <h1>Erreur 404 - Page non trouvée</h1>
    <br>
    <img src="https://http.cat/images/404.jpg" style="width: max(30vw, 400px);" alt="notfound">
    <br>
    <p>Je crois que vous vous êtes perdu.</p>
    <p><a href="/index.php?view=accueil">Retour à l'accueil</a></p>
</main>
<footer class="footer"></footer>
<?php $_smarty_tpl->_subTemplateRender('file:components/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html><?php }
}

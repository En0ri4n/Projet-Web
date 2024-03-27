<?php
/* Smarty version 4.5.1, created on 2024-03-27 16:35:02
  from 'C:\Users\MOI\Documents\cesi\A2\blocs\4web\projet\projet code\Projet-Web\view\connexion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_66043ca64f4198_45847341',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '384dc5be598062acff4b7896b0deeda800b70f42' => 
    array (
      0 => 'C:\\Users\\MOI\\Documents\\cesi\\A2\\blocs\\4web\\projet\\projet code\\Projet-Web\\view\\connexion.tpl',
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
function content_66043ca64f4198_45847341 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <?php $_smarty_tpl->_subTemplateRender('file:components/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <meta name="description" content="This is the connection page. It is used to connect to the website.">
    <meta name="keywords" content="connection, connexion, website, site">
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender('file:components/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
    <div class="form">
        <h1>Connexion</h1>
        <form id="form" method="post" action="api/login" onsubmit="return onSubmit(this);">
            <div class="form__inputs">
                <input type="text" id="identifiant" name="username" placeholder="Identifiant" required>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="hidden" id="token" name="token" value="">
            </div>
            <div>
                <input type="submit" class="submit" id="connect-button" value="Connexion">
            </div>
        </form>
    </div>
</main>
<?php $_smarty_tpl->_subTemplateRender('file:components/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
<?php echo '<script'; ?>
 type="module" src="/scripts/connection.js"><?php echo '</script'; ?>
>
</html><?php }
}

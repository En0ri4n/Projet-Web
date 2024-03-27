<?php
/* Smarty version 4.5.1, created on 2024-03-27 16:35:02
  from 'C:\Users\MOI\Documents\cesi\A2\blocs\4web\projet\projet code\Projet-Web\components\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_66043ca651dd01_46614254',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '138a42455e1a2883c62013265a496b64c21602c3' => 
    array (
      0 => 'C:\\Users\\MOI\\Documents\\cesi\\A2\\blocs\\4web\\projet\\projet code\\Projet-Web\\components\\header.tpl',
      1 => 1711550461,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66043ca651dd01_46614254 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header">
    <img src="/assets/logo.svg" alt="Logo" onclick="window.location.href='<?php echo $_smarty_tpl->tpl_vars['default_page']->value;?>
'">
    <!--<div class="search-wrapper">
        <input type="text" id="search-input" placeholder="Type to search"/> TODO: See what we do
    </div>-->
    <div class="login">
        <?php if ($_smarty_tpl->tpl_vars['is_connected']->value) {?>
            <a href="/profile?userId=<?php echo $_smarty_tpl->tpl_vars['current_user']->value->getId();?>
"><?php echo $_smarty_tpl->tpl_vars['current_user']->value->getPrenom();?>
 <?php echo $_smarty_tpl->tpl_vars['current_user']->value->getNom();?>
</a>
            <a href="/api/logout">Déconnexion</a>
        <?php }?>
    </div>
</header><?php }
}

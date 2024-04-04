<?php
/* Smarty version 4.5.1, created on 2024-04-04 16:22:38
  from 'C:\Users\cedri\source\repos\Projet-Web\view\mentions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.5.1',
  'unifunc' => 'content_660eb7aed9d9e6_69177466',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '22bbc9d3a66c5f1c5e42a02ede8763b8c3632030' => 
    array (
      0 => 'C:\\Users\\cedri\\source\\repos\\Projet-Web\\view\\mentions.tpl',
      1 => 1712145822,
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
function content_660eb7aed9d9e6_69177466 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mentions Légales</title>
    <?php $_smarty_tpl->_subTemplateRender('file:components/head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</head>
<body>
<?php $_smarty_tpl->_subTemplateRender('file:components/header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<main>
<h1>Mentions Légales</h1>
<div class="paragraphe">
    <div>- StageFinder édité par Akoustik SAS-</div>
    <div>- N° SIRET : 90205742295236 -</div>
    <div>- Capital de 37 000€ -</div>
    <div>- Parc des Tanneries, 2 All. des Foulons, 67380 Lingolsheim -</div>
    <div>- stagefinder@viacesi.fr -</div>
</div>
</main>
<?php $_smarty_tpl->_subTemplateRender('file:components/footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
</html><?php }
}

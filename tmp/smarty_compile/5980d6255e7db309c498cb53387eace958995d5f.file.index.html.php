<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 03:55:01
         compiled from "/mnt/data/public_html/_admin_/application/system/pages/views/templates/index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1771267585b039495d84ae7-41675731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5980d6255e7db309c498cb53387eace958995d5f' => 
    array (
      0 => '/mnt/data/public_html/_admin_/application/system/pages/views/templates/index/index.html',
      1 => 1526744432,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1771267585b039495d84ae7-41675731',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'modules' => 0,
    'module' => 0,
    'arr' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5b039495dc0456_62381403',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5b039495dc0456_62381403')) {function content_5b039495dc0456_62381403($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['this']->value->action($_smarty_tpl->tpl_vars['module']->value['action'],$_smarty_tpl->tpl_vars['module']->value['controller'],$_smarty_tpl->tpl_vars['module']->value['module'],$_smarty_tpl->tpl_vars['arr']->value);?>

<?php } ?><?php }} ?>
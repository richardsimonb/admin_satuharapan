<?php /* Smarty version Smarty-3.1.12, created on 2013-04-04 06:52:31
         compiled from "/home/satuhara/public_html/_admin_/application/system/pages/views/templates/index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:2006823382515cc0bf206d16-32880468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '34f07f14c459a87c6f15220aa0974a945a08b94c' => 
    array (
      0 => '/home/satuhara/public_html/_admin_/application/system/pages/views/templates/index/index.html',
      1 => 1352354857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2006823382515cc0bf206d16-32880468',
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
  'unifunc' => 'content_515cc0bf24dcd1_53727089',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_515cc0bf24dcd1_53727089')) {function content_515cc0bf24dcd1_53727089($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['this']->value->action($_smarty_tpl->tpl_vars['module']->value['action'],$_smarty_tpl->tpl_vars['module']->value['controller'],$_smarty_tpl->tpl_vars['module']->value['module'],$_smarty_tpl->tpl_vars['arr']->value);?>

<?php } ?><?php }} ?>
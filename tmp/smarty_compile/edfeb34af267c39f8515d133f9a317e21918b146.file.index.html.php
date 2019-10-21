<?php /* Smarty version Smarty-3.1.12, created on 2013-03-11 18:53:53
         compiled from "/home/kabarpem/public_html/_admin_/application/system/pages/views/templates/index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1914514140513dc5d1c21182-52036844%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'edfeb34af267c39f8515d133f9a317e21918b146' => 
    array (
      0 => '/home/kabarpem/public_html/_admin_/application/system/pages/views/templates/index/index.html',
      1 => 1352354857,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1914514140513dc5d1c21182-52036844',
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
  'unifunc' => 'content_513dc5d1c59dc3_76247868',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513dc5d1c59dc3_76247868')) {function content_513dc5d1c59dc3_76247868($_smarty_tpl) {?><?php  $_smarty_tpl->tpl_vars['module'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['module']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['modules']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['module']->key => $_smarty_tpl->tpl_vars['module']->value){
$_smarty_tpl->tpl_vars['module']->_loop = true;
?>
<?php echo $_smarty_tpl->tpl_vars['this']->value->action($_smarty_tpl->tpl_vars['module']->value['action'],$_smarty_tpl->tpl_vars['module']->value['controller'],$_smarty_tpl->tpl_vars['module']->value['module'],$_smarty_tpl->tpl_vars['arr']->value);?>

<?php } ?><?php }} ?>
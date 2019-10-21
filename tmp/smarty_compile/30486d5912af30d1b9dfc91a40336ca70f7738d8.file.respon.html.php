<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 10:54:04
         compiled from "modules/news/views/templates/form/respon.html" */ ?>
<?php /*%%SmartyHeaderCode:1999160937513b09c08a5425-87916332%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30486d5912af30d1b9dfc91a40336ca70f7738d8' => 
    array (
      0 => 'modules/news/views/templates/form/respon.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1999160937513b09c08a5425-87916332',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b09c08b4687_75182740',
  'variables' => 
  array (
    'respon' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b09c08b4687_75182740')) {function content_513b09c08b4687_75182740($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['respon']->value)){?>
	<div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['respon']->value['status'];?>
"><?php echo $_smarty_tpl->tpl_vars['respon']->value['message'];?>
</div>
<?php }?>
<?php }} ?>
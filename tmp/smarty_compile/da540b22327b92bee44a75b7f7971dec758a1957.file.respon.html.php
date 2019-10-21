<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:09:06
         compiled from "modules/content/views/templates/form/respon.html" */ ?>
<?php /*%%SmartyHeaderCode:1424311661513c1561b0f846-85792968%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da540b22327b92bee44a75b7f7971dec758a1957' => 
    array (
      0 => 'modules/content/views/templates/form/respon.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1424311661513c1561b0f846-85792968',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c1561b1efd1_67115003',
  'variables' => 
  array (
    'respon' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c1561b1efd1_67115003')) {function content_513c1561b1efd1_67115003($_smarty_tpl) {?><?php if (isset($_smarty_tpl->tpl_vars['respon']->value)){?>
	<div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['respon']->value['status'];?>
"><?php echo $_smarty_tpl->tpl_vars['respon']->value['message'];?>
</div>
<?php }?>
<?php }} ?>
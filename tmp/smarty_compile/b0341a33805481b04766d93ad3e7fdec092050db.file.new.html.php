<?php /* Smarty version Smarty-3.1.12, created on 2018-05-23 11:12:24
         compiled from "modules/staff/views/templates/index/new.html" */ ?>
<?php /*%%SmartyHeaderCode:1595659514513c200d6b63b2-37266702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b0341a33805481b04766d93ad3e7fdec092050db' => 
    array (
      0 => 'modules/staff/views/templates/index/new.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1595659514513c200d6b63b2-37266702',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c200d6ed2e9_51762449',
  'variables' => 
  array (
    'reply' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c200d6ed2e9_51762449')) {function content_513c200d6ed2e9_51762449($_smarty_tpl) {?><div class="row">
    <div class="span9">
    		<div class="page-header"><h4>New Users</h4></div>
            <?php if (isset($_smarty_tpl->tpl_vars['reply']->value['status'])){?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['reply']->value['status'];?>
"><?php echo $_smarty_tpl->tpl_vars['reply']->value['message'];?>
</div>
            <?php }?>
           <form class="form-horizontal frm-users" action="" method="post">
            <?php echo $_smarty_tpl->tpl_vars['this']->value->render('form/user.html');?>

            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
            </form>
    </div>
</div><?php }} ?>
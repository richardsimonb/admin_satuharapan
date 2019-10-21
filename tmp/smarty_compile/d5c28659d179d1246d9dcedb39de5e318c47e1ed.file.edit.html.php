<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:53:03
         compiled from "modules/staff/views/templates/index/edit.html" */ ?>
<?php /*%%SmartyHeaderCode:1422062159513b0a11709822-07352894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd5c28659d179d1246d9dcedb39de5e318c47e1ed' => 
    array (
      0 => 'modules/staff/views/templates/index/edit.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1422062159513b0a11709822-07352894',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b0a11741841_47539016',
  'variables' => 
  array (
    'reply' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b0a11741841_47539016')) {function content_513b0a11741841_47539016($_smarty_tpl) {?><div class="row">
    <div class="span9">
    		<div class="page-header"><h4>Edit Users</h4></div>
            <?php if (isset($_smarty_tpl->tpl_vars['reply']->value['status'])){?>
                <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['reply']->value['status'];?>
"><?php echo $_smarty_tpl->tpl_vars['reply']->value['message'];?>
</div>
            <?php }?>
           <form class="form-horizontal frm-users" action="" method="post">
            <?php echo $_smarty_tpl->tpl_vars['this']->value->render('form/user.html');?>

            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
            </form>
    </div>
</div><?php }} ?>
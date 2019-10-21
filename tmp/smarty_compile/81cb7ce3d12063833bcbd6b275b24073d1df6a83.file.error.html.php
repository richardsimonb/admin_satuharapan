<?php /* Smarty version Smarty-3.1.12, created on 2013-03-09 17:06:25
         compiled from "/home/kabarpem/public_html/_admin_/application/system/pages/views/templates/error/error.html" */ ?>
<?php /*%%SmartyHeaderCode:301531894513b09a1e456e0-45321124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '81cb7ce3d12063833bcbd6b275b24073d1df6a83' => 
    array (
      0 => '/home/kabarpem/public_html/_admin_/application/system/pages/views/templates/error/error.html',
      1 => 1349149443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '301531894513b09a1e456e0-45321124',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b09a1e856a5_85043963',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b09a1e856a5_85043963')) {function content_513b09a1e856a5_85043963($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Zend Framework Default Application</title>
</head>
<body>


  <h1>An error occurred</h1>
  <h2><?php echo $_smarty_tpl->tpl_vars['this']->value->message;?>
</h2>

  <?php if ($_smarty_tpl->tpl_vars['this']->value->exception){?>

  <h3>Exception information:</h3>
  <p>
      <b>Message:</b> <?php echo $_smarty_tpl->tpl_vars['this']->value->exception->getMessage();?>

  </p>

  <h3>Stack trace:</h3>
  <pre><?php echo $_smarty_tpl->tpl_vars['this']->value->exception->getTraceAsString();?>

  </pre>

  <h3>Request Parameters:</h3>
  <pre><?php echo var_export($_smarty_tpl->tpl_vars['this']->value->request->getParams(),true);?>

  </pre>
  <?php }?>

</body>
</html>
<?php }} ?>
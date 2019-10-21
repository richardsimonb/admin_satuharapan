<?php /* Smarty version Smarty-3.1.12, created on 2013-04-03 19:47:45
         compiled from "/home/satuhara/public_html/_admin_/application/system/pages/views/templates/error/error.html" */ ?>
<?php /*%%SmartyHeaderCode:522854718515c24f1205bb7-21414702%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '98e8444960e92077c7f693926daf043f06e28d89' => 
    array (
      0 => '/home/satuhara/public_html/_admin_/application/system/pages/views/templates/error/error.html',
      1 => 1349149443,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '522854718515c24f1205bb7-21414702',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_515c24f1246304_25670111',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_515c24f1246304_25670111')) {function content_515c24f1246304_25670111($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
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
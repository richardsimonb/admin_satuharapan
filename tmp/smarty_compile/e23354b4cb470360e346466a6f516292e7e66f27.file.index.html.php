<?php /* Smarty version Smarty-3.1.12, created on 2021-03-21 12:03:41
         compiled from "modules/staff/views/templates/index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:683308901513b132ff222e0-77587443%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e23354b4cb470360e346466a6f516292e7e66f27' => 
    array (
      0 => 'modules/staff/views/templates/index/index.html',
      1 => 1616302881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '683308901513b132ff222e0-77587443',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b1330019e03_42770460',
  'variables' => 
  array (
    'tplpath' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b1330019e03_42770460')) {function content_513b1330019e03_42770460($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" dir="ltr" >
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Login Satu Harapan</title>
<link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/template_cssl.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/systeml.css" type="text/css" />
<link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/warning.css" rel="stylesheet" type="text/css" />

</head>
<body onload="javascript:setFocus()" id="login" class="blue">
<div id="login-wrapper">
  <div id="login-top">
    <div id="logo"> <img src="https://www.satuharapan.com/fileadmin/templates/new/images/logo2018.png" /> </div>
  </div>
  <div id="login-content">
    <form action="" method="post" name="login" id="form-login" style="clear: both;">
      <p id="form-login-username">
        <label for="modlgn_username">Username</label>
        <input name="username" id="modlgn_username" type="text" class="inputbox" size="15" />
      </p>
      <p id="form-login-password">
        <label for="modlgn_passwd">Password</label>
        <input name="password" id="modlgn_passwd" type="password" class="inputbox" size="15" />
      </p>
      <p>
        <label for="modlgn_passwd">&nbsp;</label>
        <input type="submit" name="submit" value="Submit" style="display:block;float: left;width:100px;margin-left: 16px;">
      </p>
      
      <div class="clr"></div>
     
    </form>
    <?php if (isset($_smarty_tpl->tpl_vars['message']->value)){?>
    <div class="notification information">
      <div class="warning"> 
        <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

      </div>
    </div>
    <?php }?>
   
    <div class="clear"></div>
  </div>
</div>
<noscript>
    Warning! JavaScript must be enabled for proper operation of the Administrator back-end.
</noscript>
<div class="clr"></div>
</div>
</div>
</div>
</body>
</html>
<?php }} ?>
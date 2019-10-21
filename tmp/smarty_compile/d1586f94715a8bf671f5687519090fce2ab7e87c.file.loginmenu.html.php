<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 10:51:10
         compiled from "modules/welcome/views/templates/index/loginmenu.html" */ ?>
<?php /*%%SmartyHeaderCode:1992369112513b099bde8e01-69061053%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd1586f94715a8bf671f5687519090fce2ab7e87c' => 
    array (
      0 => 'modules/welcome/views/templates/index/loginmenu.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1992369112513b099bde8e01-69061053',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b099be2a320_90028512',
  'variables' => 
  array (
    'baseUrl' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b099be2a320_90028512')) {function content_513b099be2a320_90028512($_smarty_tpl) {?><ul class="nav">
  <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news">News</a></li>  
  <?php if ($_SESSION['Default']['user']['usergroup']!=1){?>
    <li ><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/pages">Pages</a></li>  
    <!-- <li> <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/banner">Banners</a></li> -->  
    <li ><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/edit/uid/302">IHSG & Kurs</a></li>  
    <li ><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/kontak">Kontak redaksi</a></li>  
    <li ><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/staff/index/list">Users</a></li>
  <?php }?>  
</ul>
<?php if (isset($_SESSION['Default']['user']['uid'])){?>

<!--  Logged in as <a class="navbar-link" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/staff/index/edit/uid/<?php echo $_SESSION['Default']['user']['uid'];?>
"><?php echo $_SESSION['Default']['user']['name'];?>
</a>-->
<ul class="nav pull-right" >
     <li class="dropdown">      	
      <a data-toggle="dropdown" class="dropdown-toggle" href="#">Logged in as : <?php echo $_SESSION['Default']['user']['name'];?>
 <b class="caret"></b></a>
      <ul class="dropdown-menu">           
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/staff/index/edit">My Profile</a></li>
        <?php if ($_SESSION['Default']['user']['usergroup']==3){?>
        	<li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/clearcache">Clear Cache</a></li>
        <?php }?>
        <li class="divider"></li>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/users/index/logout" >Logout</a></li>
      </ul>
    </li>
  </ul>
<?php }?>

            <?php }} ?>
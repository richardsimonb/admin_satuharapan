<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 10:51:10
         compiled from "modules/news/views/templates/index/leftmenu.html" */ ?>
<?php /*%%SmartyHeaderCode:260503608513b099be4eba9-73723292%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '664ece0a57cecee732dd4263c5ce13fa223c2953' => 
    array (
      0 => 'modules/news/views/templates/index/leftmenu.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260503608513b099be4eba9-73723292',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b099be91c79_74571242',
  'variables' => 
  array (
    'baseUrl' => 0,
    'categories' => 0,
    'cat' => 0,
    'catsub' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b099be91c79_74571242')) {function content_513b099be91c79_74571242($_smarty_tpl) {?><div class="news-cat-left">
<ul>
    <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news">All</a></li>
    <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
    <?php if ($_smarty_tpl->tpl_vars['cat']->value['uid']==39){?>
        <?php if ($_SESSION['Default']['user']['usergroup']!=1){?>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/index/category/<?php echo $_smarty_tpl->tpl_vars['cat']->value['uid'];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value['title'];?>
</a></li>
        <?php }?>
    <?php }else{ ?>
        <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/index/category/<?php echo $_smarty_tpl->tpl_vars['cat']->value['uid'];?>
"><?php echo $_smarty_tpl->tpl_vars['cat']->value['title'];?>
</a>
            <?php if (isset($_smarty_tpl->tpl_vars['cat']->value['sub'])){?>
                <ul>
                <?php  $_smarty_tpl->tpl_vars['catsub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['catsub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['catsub']->key => $_smarty_tpl->tpl_vars['catsub']->value){
$_smarty_tpl->tpl_vars['catsub']->_loop = true;
?>
                    <li><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/index/category/<?php echo $_smarty_tpl->tpl_vars['catsub']->value['uid'];?>
"><?php echo $_smarty_tpl->tpl_vars['catsub']->value['title'];?>
</a></li>
                <?php } ?>
                </ul>
            <?php }?>    
        </li>
    <?php }?>
    <?php } ?>
</ul>
</div>
<?php }} ?>
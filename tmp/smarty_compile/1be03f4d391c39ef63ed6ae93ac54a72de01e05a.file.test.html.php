<?php /* Smarty version Smarty-3.1.12, created on 2013-03-19 22:27:25
         compiled from "modules/news/views/templates/index/test.html" */ ?>
<?php /*%%SmartyHeaderCode:206185576651487892e58646-02455277%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1be03f4d391c39ef63ed6ae93ac54a72de01e05a' => 
    array (
      0 => 'modules/news/views/templates/index/test.html',
      1 => 1363706836,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '206185576651487892e58646-02455277',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_51487892e58eb0_11996958',
  'variables' => 
  array (
    'tplpath' => 0,
    'news' => 0,
    'row' => 0,
    'newsrel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51487892e58eb0_11996958')) {function content_51487892e58eb0_11996958($_smarty_tpl) {?><script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/src/jquery.multiselect.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/src/jquery.multiselect.filter.min.js"></script>

<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/jquery.multiselect.filter.css" />



<select multiple="multiple" name="related[]" style="width: 400px; height: 400px;" id="multiselect">                    	
    <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
"  <?php if (in_array($_smarty_tpl->tpl_vars['row']->value['uid'],$_smarty_tpl->tpl_vars['newsrel']->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</option>
    <?php } ?>
</select>

<script type="text/javascript">
$("#multiselect")
   .multiselect({
       multiple: false,
      noneSelectedText: 'Select news',
      selectedList: 10
   })
   .multiselectfilter();
</script>
<?php }} ?>
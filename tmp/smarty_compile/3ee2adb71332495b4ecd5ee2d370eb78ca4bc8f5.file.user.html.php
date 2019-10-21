<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:53:03
         compiled from "modules/staff/views/templates/form/user.html" */ ?>
<?php /*%%SmartyHeaderCode:1179148664513b0a11744608-79127049%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3ee2adb71332495b4ecd5ee2d370eb78ca4bc8f5' => 
    array (
      0 => 'modules/staff/views/templates/form/user.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1179148664513b0a11744608-79127049',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b0a117cee32_70119028',
  'variables' => 
  array (
    'params' => 0,
    'detail' => 0,
    'groups' => 0,
    'group' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b0a117cee32_70119028')) {function content_513b0a117cee32_70119028($_smarty_tpl) {?>
            <?php if ($_SESSION['Default']['user']['uid']!=$_smarty_tpl->tpl_vars['params']->value['uid']){?>
            <div class="control-group">
                <label class="control-label" >Disable</label>
                <div class="controls">
                <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['disable']){?>
                	<input type="checkbox" name="f[disable]" value="1" checked="checked">
                <?php }else{ ?>
                	<input type="checkbox" name="f[disable]" value="1">
                <?php }?>                	
                </div>
            </div>
            <?php }?>
            <div class="control-group">
                <label class="control-label" >Username</label>
                <div class="controls">
                <input type="text" name="f[username]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['username'];?>
<?php }?>" required="">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Password</label>
                <div class="controls">
                <input type="text" name="f[password]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['password'];?>
<?php }?>" required>
                </div>
            </div>
            
            <?php if ($_SESSION['Default']['user']['usergroup']==3){?> <!-- jika user  adalah direksi -->
            <div class="control-group">
                <label class="control-label" >User Type</label>
                <div class="controls">
                <select name="f[usergroup]">
                    <?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['group']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['groups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
$_smarty_tpl->tpl_vars['group']->_loop = true;
?>
                    	 <?php if ($_SESSION['Default']['user']['usergroup']==2){?>
                    	 	<?php if ($_smarty_tpl->tpl_vars['group']->value['uid']==1){?>
                    		<option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['uid'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['usergroup']==$_smarty_tpl->tpl_vars['group']->value['uid']){?>selected=""<?php }?>><?php echo $_smarty_tpl->tpl_vars['group']->value['title'];?>
</option>
                    		<?php }?>
                    	 <?php }else{ ?>	
        	                <option value="<?php echo $_smarty_tpl->tpl_vars['group']->value['uid'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['usergroup']==$_smarty_tpl->tpl_vars['group']->value['uid']){?>selected=""<?php }?>><?php echo $_smarty_tpl->tpl_vars['group']->value['title'];?>
</option>
                    	 <?php }?>
                    <?php } ?>
                </select>
                </div>
            </div>  
            <?php }?>          

            <div class="control-group">
                <label class="control-label" >Name</label>
                <div class="controls">
                <input type="text" name="f[name]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['name'];?>
<?php }?>" required>
                </div>
            </div>
           
            <div class="control-group">
                <label class="control-label" >Address</label>
                <div class="controls">
                <input type="text" name="f[address]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['address'];?>
<?php }?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Telephone</label>
                <div class="controls">
                <input type="text" name="f[telephone]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['telephone'];?>
<?php }?>">
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" >Email</label>
                <div class="controls">
                <input type="email" name="f[email]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['email'];?>
<?php }?>" >
                </div>
            </div><?php }} ?>
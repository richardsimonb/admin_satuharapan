<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:09:06
         compiled from "modules/content/views/templates/form/news.html" */ ?>
<?php /*%%SmartyHeaderCode:1601714466513c1561b20c08-23974807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f7c02e59ab98b4b483a301fe0c6ee8c3012712db' => 
    array (
      0 => 'modules/content/views/templates/form/news.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1601714466513c1561b20c08-23974807',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c1561b70ae2_41154240',
  'variables' => 
  array (
    'detail' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c1561b70ae2_41154240')) {function content_513c1561b70ae2_41154240($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
?><ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab">General</a></li>
          
          <li><a href="#access" data-toggle="tab">Access </a></li>
        </ul>
        
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="general">   
            <?php if ($_SESSION['Default']['user']['usergroup']!=1){?>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Hidden</label>
                <div class="controls">
                    <input type="checkbox" name="f[hidden]" value="1" <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['hidden']==1){?>checked=""<?php }?> />
                </div>
            </div>
            <?php }?>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Create date:</label>
                <div class="controls">
                    <input type="text" class="spa5 datetimepicker" name="crdate" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['crdate'],"%d-%m-%Y %H:%M");?>
<?php }?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Title</label>
                <div class="controls">
                    <input type="text" class="span5" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['header'];?>
<?php }?>" name="f[header]" >
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" for="inputEmail">Text</label>
                <div class="controls">
                    <textarea name="f[bodytext]" class="ckeditor" id="editor1"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['bodytext'];?>
<?php }?></textarea>
                </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="access">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Start:</label>
                <div class="controls">
                    <input type="text" class="datepicker" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['starttime']!=0){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['starttime'],"%d-%m-%Y");?>
<?php }?>" name="starttime">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Stop:</label>
                <div class="controls">
                    <input type="text" class="datepicker" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['endtime']!=0){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['endtime'],"%d-%m-%Y");?>
<?php }?>" name="endtime">
                </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
        	<input type="submit" class="btn btn-primary " value="SAVE" />
		</div>
		

<?php }} ?>
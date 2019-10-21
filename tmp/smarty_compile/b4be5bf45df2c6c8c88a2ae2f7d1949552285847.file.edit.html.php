<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:09:06
         compiled from "modules/content/views/templates/index/edit.html" */ ?>
<?php /*%%SmartyHeaderCode:1057195474513c1561ac4346-97015368%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b4be5bf45df2c6c8c88a2ae2f7d1949552285847' => 
    array (
      0 => 'modules/content/views/templates/index/edit.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1057195474513c1561ac4346-97015368',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c1561b0c6b3_87096790',
  'variables' => 
  array (
    'tplpath' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c1561b0c6b3_87096790')) {function content_513c1561b0c6b3_87096790($_smarty_tpl) {?><script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="span10">
    	<div class="page-header"><h4>Edit Pages</h4></div>
        <?php echo $_smarty_tpl->tpl_vars['this']->value->render("form/respon.html");?>

        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        	<?php echo $_smarty_tpl->tpl_vars['this']->value->render("form/news.html");?>

        </form>
    </div>
</div>

<script type="text/javascript" >
 CKEDITOR.replace( 'editor1',
                {
                   
                    filebrowserBrowseUrl        : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Connector=http://kp.just4development.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://kp.just4development.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://kp.just4development.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl        : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
                    
                    toolbar: [
                  [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ], // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                  [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],   // Defines toolbar group without name.
                  [ 'MediaEmbed','Image','oembed','Youtube','Video','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ],                        
                  // '/',                     // Line break - next group will be placed in new line.
                  [ 'Bold', 'Italic' ]
                 ] 
                                                            
                });
                CKEDITOR.instances.editor1.resize( '1000px', '350', true );
                
                
                //]]>
 </script>
<style>
#cke_1_top {height: 376px;}
</style>



<?php }} ?>
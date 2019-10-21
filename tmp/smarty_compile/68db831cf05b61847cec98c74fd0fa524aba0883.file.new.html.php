<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 10:54:04
         compiled from "modules/news/views/templates/index/new.html" */ ?>
<?php /*%%SmartyHeaderCode:680664775513b09c0859bc5-44072510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '68db831cf05b61847cec98c74fd0fa524aba0883' => 
    array (
      0 => 'modules/news/views/templates/index/new.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '680664775513b09c0859bc5-44072510',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b09c08a2472_37075347',
  'variables' => 
  array (
    'tplpath' => 0,
    'baseUrl' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b09c08a2472_37075347')) {function content_513b09c08a2472_37075347($_smarty_tpl) {?><script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/ckeditor.js"></script>
<div class="row">
    <div class="span10">
        <div class="page-header"><h4>Add News
        <a class="btn btn-primary pull-right" href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/new">Add News</a>
        </h4></div>
        <?php echo $_smarty_tpl->tpl_vars['this']->value->render("form/respon.html");?>

        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data" id="form-news">
        	<?php echo $_smarty_tpl->tpl_vars['this']->value->render("form/news.html");?>

        </form>
    </div>
</div>



<script type="text/javascript" >
 CKEDITOR.replace( 'editor1',
                {
                    filebrowserBrowseUrl        : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Connector=http://www.satuharapan.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=http://www.satuharapan.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=http://www.satuharapan.com/ajax/filemanager/connectors/php/connector.php',
                    filebrowserUploadUrl        : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
                    filebrowserImageUploadUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
                    filebrowserFlashUploadUrl   : '<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash',
                    
                    toolbar: [
                  [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ], // Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
                  [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],   // Defines toolbar group without name.
                  [ 'Link', 'Unlink' ],                  
                  [ 'MediaEmbed','Image','oembed','Youtube','Video','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ],                        
                  // '/',                     // Line break - next group will be placed in new line.
                  [ 'Bold', 'Italic', 'Strike' ],
                  [ 'NumberedList', 'BulletedList', '-' , 'Outdent', 'Indent' ],
                  <!--[ 'Maximize' ]-->
                  [ 'Styles' ]
                  
                 ] 
                                                            
                });
                
                //]]>
 </script>
<?php }} ?>
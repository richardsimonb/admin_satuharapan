<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 12:02:37
         compiled from "modules/news/views/templates/index/preview.html" */ ?>
<?php /*%%SmartyHeaderCode:1865853126513c0e3055c474-38873351%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '18ca8fa9bdde79c3ba7531d62af4845a35e22327' => 
    array (
      0 => 'modules/news/views/templates/index/preview.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1865853126513c0e3055c474-38873351',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c0e3059fd05_23103365',
  'variables' => 
  array (
    'row' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c0e3059fd05_23103365')) {function content_513c0e3059fd05_23103365($_smarty_tpl) {?><div class="container" style="width: 600px; padding-left: 38px; ">
	<div class="row">
		<div class="10">
			<h1 class="title-preview"><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</h1>
		</div>
	</div>
	<div class="row top-preview">
		<div class="span4 img-preview">
	       <?php if (!empty($_smarty_tpl->tpl_vars['image']->value[0])){?>
	        <img  src="/uploads/pics/<?php echo $_smarty_tpl->tpl_vars['image']->value[0];?>
"/>
	       <?php }else{ ?>
	        <img  src="/uploads/pics/no-image.jpg" style="height: 200px;"/>
	       <?php }?>
			
		</div>
	    <div class="span2 rel-preview">
	          <div style="" id="related-by-cat" class="dright">
				<div class="dttl">Kabar Terkait</div>
				<ul class="dcon" style="">
					<li><a title="" href="#"> sample item related news sample item related news</a></li>
	                <li><a title="" href="#"> sample item related news sample item related news</a></li>
	                <li><a title="" href="#"> sample item related news sample item related news</a></li>               
				</li>
			</div>
	    </div>
	</div>
	<div class="row">
		<div class="10">
			<?php echo $_smarty_tpl->tpl_vars['row']->value['bodytext'];?>

		</div>
	</div>
</div><?php }} ?>
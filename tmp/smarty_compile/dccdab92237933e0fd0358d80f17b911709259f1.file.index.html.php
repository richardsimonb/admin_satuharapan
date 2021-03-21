<?php /* Smarty version Smarty-3.1.12, created on 2021-03-21 11:15:30
         compiled from "templates/frontend/index.html" */ ?>
<?php /*%%SmartyHeaderCode:1612979755513b099bd50204-30673205%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dccdab92237933e0fd0358d80f17b911709259f1' => 
    array (
      0 => 'templates/frontend/index.html',
      1 => 1616300123,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1612979755513b099bd50204-30673205',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b099bdd1938_68585107',
  'variables' => 
  array (
    'tplpath' => 0,
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b099bdd1938_68585107')) {function content_513b099bdd1938_68585107($_smarty_tpl) {?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Content Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->        
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
ico/apple-touch-icon-57-precomposed.png">
    <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/overlay.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/table.css" rel="stylesheet">
    <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/validation.css" rel="stylesheet">
    <?php echo $_smarty_tpl->tpl_vars['this']->value->headTitle();?>

    <?php echo $_smarty_tpl->tpl_vars['this']->value->headLink();?>

    <?php echo $_smarty_tpl->tpl_vars['this']->value->headStyle();?>

    
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/jquery.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-transition.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-alert.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-modal.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-dropdown.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-scrollspy.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-tab.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-tooltip.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-popover.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-button.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-collapse.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-carousel.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/bootstrap-typeahead.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/jquery.validate.min.js"></script>
    <!--<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/jquery-ui.1.9.2.css" />-->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
    
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/jquery-ui-timepicker-addon.css" />
    <link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/select2/select2.css" />
    <!--<script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/jquery-ui-1.9.2.js"></script>-->
    <script src="https://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/jquery-ui-timepicker-addon.js"></script>
    
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/typehead/typeahead.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/select2/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	
	
    
    <script>
        $(function() {            
                $( ".datepicker" ).datepicker( {dateFormat:"dd-mm-yy"} );
                $('.datetimepicker').datetimepicker({                
                    dateFormat:"dd-mm-yy",
                    controlType: 'select',                	
                });
        });
        $(function() {
	        	$(".fancybox").fancybox({
	        		maxWidth	: 800,
	        		maxHeight	: 600,
	        		fitToView	: false,
	        		width		: '30%',
	        		height		: '30%',
	        		autoSize	: true,
	        		closeClick	: false,
	                type :"ajax",
	                wrapCSS : "popup-wrap"
	        	});
	        });
    </script>
    
    
    <?php echo $_smarty_tpl->tpl_vars['this']->value->headScript();?>

    
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="http://www.satuharapan.com/" target="_blank">
          	<img src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
images/typo3logo-white.png" />
          </a>
          <div class="nav-collapse collapse">          	
            	 <?php echo $_smarty_tpl->tpl_vars['this']->value->action('loginmenu','index','welcome');?>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container content">
    	<div class="row">
    		<div class="span2 left-content">
    			<?php echo $_smarty_tpl->tpl_vars['this']->value->action('leftmenu','index','news');?>
	
    		</div>
    		<div class="span10 right-content">
    			<?php echo $_smarty_tpl->tpl_vars['this']->value->layout()->content;?>
		
    		</div>
    		
    	</div>
        
      

      <hr class="hr-footer">

      <footer>
        <p>Copyright © 2012-2021 | satuharapan.com</p>
      </footer>

    </div> <!-- /container -->
    <div id="loading_overlay" style="display: none;">
    	<div class="loading_message">
    		<img src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
img/loading.gif"   alt="loading" />
    	</div>
    </div>    
    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   <link href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
css/overide.css" rel="stylesheet">
  </body>
</html>
<?php }} ?>
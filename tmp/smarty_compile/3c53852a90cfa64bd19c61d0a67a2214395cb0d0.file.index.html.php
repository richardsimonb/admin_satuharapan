<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 10:51:10
         compiled from "modules/news/views/templates/index/index.html" */ ?>
<?php /*%%SmartyHeaderCode:5925961513b099bc9e8d9-20793260%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3c53852a90cfa64bd19c61d0a67a2214395cb0d0' => 
    array (
      0 => 'modules/news/views/templates/index/index.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5925961513b099bc9e8d9-20793260',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b099bd49258_51865693',
  'variables' => 
  array (
    'params' => 0,
    'category' => 0,
    'baseUrl' => 0,
    'numrows' => 0,
    'rows' => 0,
    'row' => 0,
    'id_paging' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b099bd49258_51865693')) {function content_513b099bd49258_51865693($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_paginate_first')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_first.php';
if (!is_callable('smarty_function_paginate_prev')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_prev.php';
if (!is_callable('smarty_function_paginate_middle')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_middle.php';
if (!is_callable('smarty_function_paginate_next')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_next.php';
if (!is_callable('smarty_function_paginate_last')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_last.php';
?>
<script>
    $(function() {
        $( ".datePicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd/mm/yy"
        });    
    });
    
</script>

<form class="form-horizontal">
<div id="advSearch" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
    <h3 id="myModalLabel">Advanced search</h3>
  </div>
  <div class="modal-body">   
    <div class="control-group">
        <label class="control-label">Title</label>
        <div class="controls">
            <input type="text"  name="title" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['title'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['title'];?>
<?php }?>">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Author</label>
        <div class="controls">
            <input type="text"  name="author" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['author'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['author'];?>
<?php }?>">
        </div>
    </div>
     <div class="control-group">
        <label class="control-label">Created</label>
        <div class="controls">
            <input type="text"  name="cr_first" class="span2 datepicker" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['cr_first'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['cr_first'];?>
<?php }?>"> - <input value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['cr_last'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['cr_last'];?>
<?php }?>" type="text"  name="cr_last" class="span2 datepicker">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Status</label>
        <div class="controls">
            <select name="status">
                <option value="">All</option>
                <option value="0" <?php if (isset($_smarty_tpl->tpl_vars['params']->value['status'])&&$_smarty_tpl->tpl_vars['params']->value['status']==0&&$_smarty_tpl->tpl_vars['params']->value['status']!=''){?>selected=""<?php }?>>Publish</option>
                <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['params']->value['status'])&&$_smarty_tpl->tpl_vars['params']->value['status']==1&&$_smarty_tpl->tpl_vars['params']->value['status']!=''){?>selected=""<?php }?>>Unpublish</option>                
            </select>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Edited</label>
        <div class="controls">
            <select name="edited">
                <option value="">All</option>
                <option value="1" <?php if (isset($_smarty_tpl->tpl_vars['params']->value['edited'])&&$_smarty_tpl->tpl_vars['params']->value['edited']==1&&$_smarty_tpl->tpl_vars['params']->value['edited']!=''){?>selected=""<?php }?>>Yes</option>
                <option value="0" <?php if (isset($_smarty_tpl->tpl_vars['params']->value['edited'])&&$_smarty_tpl->tpl_vars['params']->value['edited']==0&&$_smarty_tpl->tpl_vars['params']->value['edited']!=''){?>selected=""<?php }?>>No</option>                
            </select>
        </div>
    </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary" type="submit">Search</button>
  </div>
</div>
</form>

    <div class="page-header"><h4>List News : 
    <?php if (isset($_smarty_tpl->tpl_vars['category']->value)){?>
        <?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>

    <?php }else{ ?>
    All
    <?php }?>
    </h4>
    </div>
    <div class="home-top-bar">
    	<div class="frm-search">
	    	<form class="form-inline" method="get" action="" id="form-search">
		        <input type="text" class="txt-search" value="<?php if (isset($_GET['keyword'])){?><?php echo $_GET['keyword'];?>
<?php }?>" placeholder="keywords" name="keyword">
		        <button type="submit" class="btn btn-success">Search</button>
		        <a href="#advSearch" role="button" class="btn btn-primary" data-toggle="modal">Advance Search</a>       
		    </form>
	    </div>
	    <div class="btn-addnew">
    		<a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/new" class="btn btn-primary">Add News</a>
    	</div>
    </div>
    
    <form action="" method="post" id="form-users" class="list-news">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><input type="checkbox" class="checkall"/></th>
          <th>Title</th>
          <th>Author</th>         
          <th>Created</th>
          <th>Published</th>
          <th>Read</th>
          <th>Status</th>   
          <th>Edited</th>       
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($_smarty_tpl->tpl_vars['numrows']->value<1){?>
      <tr><td colspan="8"><div class="alert">Data Not Found</div></td></tr>
      <?php }?>
       <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['rows']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
        <tr class="<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
">
          <td><input type="checkbox" name="uid[]" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
"  class="child-checked"/></td>  
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>   
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['author'];?>
</td>        
          <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['crdate'],"%d-%m-%Y %H:%M");?>
</td>
          <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['datetime'],"%d-%m-%Y %H:%M");?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['tx_ncttnewsmostpopular_counter'];?>
</td>      
          <td><?php if ($_smarty_tpl->tpl_vars['row']->value['hidden']==0){?><span class="label label-success">Publish</span><?php }else{ ?><span class="label label-important">Unpublish</span><?php }?></td>
          <td><?php if ($_smarty_tpl->tpl_vars['row']->value['redaktur_uid']!=0){?><span class="label label-success">Yes</span><?php }else{ ?><span class="label label-important">No</span><?php }?></td>
          <td><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/edit/uid/<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
" class="btn btn-warning"><i class="icon-edit icon-white"></i></a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
    </form>
    <?php if ($_smarty_tpl->tpl_vars['numrows']->value>0){?>    
    <div class="pagination">
    
    
    	
    	<div class="delete-all">
    	<!-- penghapusan tombol delete utk user wartawan, by:ben tgl 4 Agustus 2015 -->
    	<?php if ($_SESSION['Default']['user']['usergroup']!=1){?>
    		<a href="javascript:void(0);" id="remove-all" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp;Delete</a>
    	<?php }?> 
    	</div>
    	
    	
    	
    	
    	<div class="page">
	        <ul>
	            <?php echo smarty_function_paginate_first(array('id'=>$_smarty_tpl->tpl_vars['id_paging']->value,'target'=>"_self"),$_smarty_tpl);?>
 
	            <?php echo smarty_function_paginate_prev(array('id'=>$_smarty_tpl->tpl_vars['id_paging']->value,'target'=>"_self"),$_smarty_tpl);?>

	            <?php echo smarty_function_paginate_middle(array('format'=>"page",'prefix'=>" ",'suffix'=>" ",'page_limit'=>"5",'id'=>$_smarty_tpl->tpl_vars['id_paging']->value,'target'=>"_self"),$_smarty_tpl);?>

	            <?php echo smarty_function_paginate_next(array('id'=>$_smarty_tpl->tpl_vars['id_paging']->value,'target'=>"_self"),$_smarty_tpl);?>

	            <?php echo smarty_function_paginate_last(array('id'=>$_smarty_tpl->tpl_vars['id_paging']->value,'target'=>"_self"),$_smarty_tpl);?>

	        </ul>
        </div> 
    </div> 
    <?php }?>
 

<script type="text/javascript">
$(document).ready(function() {     
    var  baseUrl = "<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/";
    $('.checkall').click(function () {
	   $(this).parents('table:eq(0)').find(':checkbox').attr('checked', this.checked);
	});
    
    
    $("#remove-all").click(function() { //begin
      
                 var checkeditems = $('input:checkbox[name="uid[]"]:checked')
                       .map(function() { return $(this).val() })
                       .get()
                       .join(",");                      
                    var substr = checkeditems.split(',');
                    //console.log(substr);
                    //alert(substr.length);  
                    var datastring = $('#form-users').serialize();
                    var i;
                    $("#loading_overlay").show();  
            		    
                    $.ajax({                        
                        url: baseUrl+"news/index/index/act/delete",
                        type: 'POST',
                        data: datastring,
                        async: true,
                        success: function (data) {
                                    var i;
                                    for (i = 0; i < substr.length; ++i) {
                                        $("." +substr[i]).fadeOut(500, function() {
                        					$("."+substr[i]).remove();
                        				});
                                    }
                                    $("#loading_overlay").hide();
                                    //window.parent.document.location.reload();
                            },           
                        });
           
    return false; 
    }); //end 
       
});
</script>
<?php }} ?>
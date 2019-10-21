<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:09:32
         compiled from "modules/staff/views/templates/index/list.html" */ ?>
<?php /*%%SmartyHeaderCode:1478224762513b09fc00e3e2-28257294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3854371774d26b292f750f3c4f7f5e306480f1a6' => 
    array (
      0 => 'modules/staff/views/templates/index/list.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1478224762513b09fc00e3e2-28257294',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b09fc0a90e0_01988692',
  'variables' => 
  array (
    'params' => 0,
    'baseUrl' => 0,
    'numrows' => 0,
    'rows' => 0,
    'row' => 0,
    'totalpage' => 0,
    'id_paging' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b09fc0a90e0_01988692')) {function content_513b09fc0a90e0_01988692($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_paginate_first')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_first.php';
if (!is_callable('smarty_function_paginate_prev')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_prev.php';
if (!is_callable('smarty_function_paginate_middle')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_middle.php';
if (!is_callable('smarty_function_paginate_next')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_next.php';
if (!is_callable('smarty_function_paginate_last')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/function.paginate_last.php';
?>
    <div class="page-header"><h4>Users</h4></div>
    
        <form class="form-inline" method="get" action="" id="form-search">
		        <input type="text" value="<?php if (isset($_GET['name'])){?><?php echo $_GET['name'];?>
<?php }?>" placeholder="Name" name="name">
                <div class="input-prepend">
                    <span class="add-on">Tanggal</span>
                    <input type="text" class="datepicker span2" name="awal" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['awal'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['awal'];?>
<?php }?>" /> <span class="add-on">-</span> <input type="text" class="datepicker span2" name="akhir" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['akhir'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['akhir'];?>
<?php }?>"/>
                </div>
                
		        <button type="submit" class="btn btn-success">Search</button>
		        <!--<a href="#advSearch" role="button" class="btn btn-primary" data-toggle="modal">Advance Search</a>-->        
		    <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/staff/index/new" class="btn btn-primary pull-right" >New</a>
         </form>
     
    
    
    <form action="" method="post" id="form-users">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><input type="checkbox" class="checkall"/></th>
          <th>Name</th> 
          <th>Username</th>
          <th>Email</th>  
          <th>Group</th>      
          <th>Created</th>
          <th>Posting</th>
          <th>Publish</th>
          <th>Unpublish</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php if ($_smarty_tpl->tpl_vars['numrows']->value<1){?>
      <tr><td colspan="7"><div class="alert">Data Not Found</div></td></tr>
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
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['name'];?>
</td>  
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['username'];?>
</td>  
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['email'];?>
</td> 
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['group_title'];?>
</td>       
          <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['crdate'],"%d-%m-%Y");?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['jumlah_berita'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['publish'];?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['unpublish'];?>
</td>
          <td><?php if ($_smarty_tpl->tpl_vars['row']->value['disable']==0){?><span class="label label-success">active</span><?php }else{ ?><span class="label label-important">disable</span><?php }?></td>
          <td><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/staff/index/edit/uid/<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
" class="btn btn-warning">edit</a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
    </form>
       
    <div class="delete-all">
    	<a href="javascript:void(0);" id="remove-all" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp;Delete</a>
    </div>
    
    <?php if ($_smarty_tpl->tpl_vars['totalpage']->value>1){?>    
    
    <div class="pagination">
    	
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
                    console.log(substr);
                    //alert(substr.length);  
                    var datastring = $('#form-users').serialize();
                    var i;
                    $("#loading_overlay").show();  
            		    
                    $.ajax({                        
                        url: baseUrl+"staff/index/list/act/delete",
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
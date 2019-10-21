<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:09:08
         compiled from "modules/content/views/templates/index/kontak.html" */ ?>
<?php /*%%SmartyHeaderCode:1308327361513c157cdd4038-76487943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b8493e5c6b53ecedea85332cda346908152569f' => 
    array (
      0 => 'modules/content/views/templates/index/kontak.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1308327361513c157cdd4038-76487943',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513c157ced1141_48151931',
  'variables' => 
  array (
    'baseUrl' => 0,
    'numrows' => 0,
    'rows' => 0,
    'row' => 0,
    'totalpage' => 0,
    'id_paging' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513c157ced1141_48151931')) {function content_513c157ced1141_48151931($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
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


    <form method="post" action="" enctype="multipart/form-data" style="display: none;">
        <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 id="myModalLabel">Upload data</h3>
            </div>
            <div class="modal-body">
             <div class="control-group">
                <div class="controls">
                    <input type="file" name="excelfile" >
                </div>
             </div>
            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button class="btn btn-primary">Upload</button>
            </div>
        </div>     
    </form>
    <!--
    <form class="form-inline" method="get" action="" id="form-search">
        <input type="text" value="<?php if (isset($_GET['title'])){?><?php echo $_GET['title'];?>
<?php }?>" placeholder="Header" name="header">
        <input type="text" value="<?php if (isset($_GET['rang_date_1'])){?><?php echo $_GET['rang_date_1'];?>
<?php }?>" placeholder="Created start" class="datePicker" name="rang_date_1">
        <input type="text" value="<?php if (isset($_GET['rang_date_2'])){?><?php echo $_GET['rang_date_2'];?>
<?php }?>" placeholder="Created end" class="datePicker" name="date_rang2">
        <button type="submit" class="btn btn-success">Search</button>
        
        <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/pagesnew" class="btn btn-primary" >New</a>
    </form>
    -->
  	<div class="page-header"><h4>Kontak Redaksi</h4></div>
    
    <form action="" method="post" id="form-users">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th><input type="checkbox" class="checkall"/></th>
          <th>Tanggal</th>
          <th>Pesan </th>
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
          <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['crdate'],"%d-%m-%Y %H:%M");?>
</td>
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>
</td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
    </form>
    <?php if ($_smarty_tpl->tpl_vars['numrows']->value>0){?>
    	<div class="delete-all">
    		<a href="javascript:void(0);" id="remove-all" class="btn btn-danger"><i class="icon-remove icon-white"></i>&nbsp;Delete</a>
    	</div>
    <?php }?>    
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
                        url: baseUrl+"content/index/kontak/act/delete",
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
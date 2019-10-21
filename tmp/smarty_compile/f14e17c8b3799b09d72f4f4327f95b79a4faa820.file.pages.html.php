<?php /* Smarty version Smarty-3.1.12, created on 2018-05-22 05:08:35
         compiled from "modules/content/views/templates/index/pages.html" */ ?>
<?php /*%%SmartyHeaderCode:612799073513b0c4d6e81f4-81653089%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f14e17c8b3799b09d72f4f4327f95b79a4faa820' => 
    array (
      0 => 'modules/content/views/templates/index/pages.html',
      1 => 1526744451,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '612799073513b0c4d6e81f4-81653089',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b0c4d75f599_19805674',
  'variables' => 
  array (
    'baseUrl' => 0,
    'numrows' => 0,
    'rows' => 0,
    'row' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b0c4d75f599_19805674')) {function content_513b0c4d75f599_19805674($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
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



    
    <div class="page-header"><h4>Pages</h4></div>
    
    <form class="form-inline" method="get" action="" id="form-search"  style="display: none;">
        <input type="text" value="<?php if (isset($_GET['title'])){?><?php echo $_GET['title'];?>
<?php }?>" placeholder="Header" name="header">
        <input type="text" value="<?php if (isset($_GET['rang_date_1'])){?><?php echo $_GET['rang_date_1'];?>
<?php }?>" placeholder="Created start" class="datePicker" name="rang_date_1">
        <input type="text" value="<?php if (isset($_GET['rang_date_2'])){?><?php echo $_GET['rang_date_2'];?>
<?php }?>" placeholder="Created end" class="datePicker" name="date_rang2">
        <button type="submit" class="btn btn-success">Search</button>        
        <a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/pagesnew" class="btn btn-primary">New</a>
    </form>      	
    
    <form action="" method="post" id="form-users">
    <table class="table table-bordered">
      <thead>
        <tr>
          
          <th>Header</th>
          <th>Created</th>
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
          
          <td><?php echo $_smarty_tpl->tpl_vars['row']->value['header'];?>
</td>   
             
          <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['row']->value['crdate'],"%d-%m-%Y %H:%M");?>
</td>
          <td><?php if ($_smarty_tpl->tpl_vars['row']->value['hidden']==0){?><span class="label label-success">Publish</span><?php }else{ ?><span class="label label-important">Unpublish</span><?php }?></td>
          <td><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/content/index/edit/uid/<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
" class="btn btn-warning">edit</a></td>
        </tr>
       <?php } ?>
      </tbody>
    </table>
    </form>
  
 

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
                        url: baseUrl+"clients/index/delete",
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
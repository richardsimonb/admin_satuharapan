<?php /* Smarty version Smarty-3.1.12, created on 2019-09-10 19:01:01
         compiled from "modules/news/views/templates/form/news.html" */ ?>
<?php /*%%SmartyHeaderCode:610583332513b09c08b6231-95990387%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5b4010dd3224b23766f28284c96e535b8f1a90f' => 
    array (
      0 => 'modules/news/views/templates/form/news.html',
      1 => 1568116853,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '610583332513b09c08b6231-95990387',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_513b09c09ade38_81838567',
  'variables' => 
  array (
    'tplpath' => 0,
    'params' => 0,
    'detail' => 0,
    'authors' => 0,
    'author' => 0,
    'cruser_id' => 0,
    'images' => 0,
    'img' => 0,
    'baseUrl' => 0,
    'categories' => 0,
    'cat' => 0,
    'newsCategory' => 0,
    'catsub' => 0,
    'news' => 0,
    'row' => 0,
    'newsrel' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_513b09c09ade38_81838567')) {function content_513b09c09ade38_81838567($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/mnt/data/public_html/_admin_/library/Smarty/plugins/modifier.date_format.php';
?><script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/src/jquery.multiselect.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/src/jquery.multiselect.filter.min.js"></script>

<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/jquery.multiselect.css" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['tplpath']->value;?>
js/multiselect/jquery.multiselect.filter.css" />
<ul id="myTab" class="nav nav-tabs">
          <li class="active"><a href="#general" data-toggle="tab">General</a></li>
          <li><a href="#special" data-toggle="tab">Special</a></li>
          <li><a href="#media" data-toggle="tab">Media</a></li>
          <li><a href="#relation" data-toggle="tab">Categories & Relations </a></li>
          <li><a href="#access" data-toggle="tab">Access </a></li>
        </ul>
        
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane fade in active" id="general">   
            <?php if ($_SESSION['Default']['user']['usergroup']==3){?>
            <div class="control-group">
                <label class="control-label" >Hidden</label>
                <div class="controls">
                    <?php if ($_smarty_tpl->tpl_vars['params']->value['action']=='new'){?>
                        <input type="checkbox" name="f[hidden]" value="1" checked="" />
                    <?php }else{ ?>
                        <input type="checkbox" name="f[hidden]" value="1" <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['hidden']==1){?>checked=""<?php }?> />
                    <?php }?>    
                </div>
            </div>
			<div class="control-group">
                <label class="control-label" >Publish Special Date</label>
                <div class="controls">
                    <?php if ($_smarty_tpl->tpl_vars['params']->value['action']=='new'){?>
                        <input type="checkbox" name="f[publish]" value="1" />
                    <?php }else{ ?>
                        <input type="checkbox" name="f[publish]" value="1"/>
                    <?php }?>     
                </div>
            </div>
            <?php }?>
            <div class="control-group">
                <label class="control-label" >Title</label>
                <div class="controls">
                    <input type="text" class="span5" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['title'];?>
<?php }?>" name="f[title]" required id="title">
                </div>
            </div>
            
            <!-- Penambahan Sub header di CMS by : ben-->
           <div class="control-group">
                <label class="control-label" >Subheader</label>
                <div class="controls">
                    
                    <textarea name="f[short]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['short'];?>
<?php }?></textarea>
                    <!--<textarea name="f[short]" class="ckeditor" id="editor1" required><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['short'];?>
<?php }?></textarea>-->
                </div>
            </div>
            
            
            <div class="control-group">
                <label class="control-label" >Content</label>
                <div class="controls">
                    <textarea name="f[bodytext]" class="ckeditor" id="editor1" required><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['bodytext'];?>
<?php }?></textarea>
                </div>
            </div>
          </div>
          <div class="tab-pane fade" id="special">
            <div class="control-group">
                <label class="control-label" >Date/Time:</label>
                <div class="controls">
                    <input type="text" class="spa5 datetimepicker" name="f[datetime]" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['datetime'],"%d-%m-%Y %H:%M");?>
<?php }?>">
                </div>
            </div>
           
            <div class="control-group">
                <label class="control-label" for="inputEmail">Keywords (,)</label>
                <div class="controls">
                	<textarea name="f[keywords]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['keywords'];?>
<?php }?></textarea>	
                	
                </div>
            </div>
            
             
                 <div class="control-group" <?php if ($_SESSION['Default']['user']['usergroup']==1){?>style="display:none;" <?php }?>>
                    <label class="control-label" >Authors</label>
                    <div class="controls">
                    	<select name="f[cruser_id]" class="singgle-select">
                            <?php  $_smarty_tpl->tpl_vars['author'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['author']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['authors']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['author']->key => $_smarty_tpl->tpl_vars['author']->value){
$_smarty_tpl->tpl_vars['author']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['author']->value['uid'];?>
" <?php if ($_smarty_tpl->tpl_vars['cruser_id']->value==$_smarty_tpl->tpl_vars['author']->value['uid']){?>selected=""<?php }?> ><?php echo $_smarty_tpl->tpl_vars['author']->value['name'];?>
</option>
                            <?php } ?>
                        </select>	
                    </div>
                </div>
            
          </div>
          <div class="tab-pane fade" id="media">           
            <table class="table table-bordered">
                <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?>
                    <tr>
                        <th>Image</th>
                        <th>Filename</th>
                        <th>Action</th>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['img'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['img']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['iteration']=0;
foreach ($_from as $_smarty_tpl->tpl_vars['img']->key => $_smarty_tpl->tpl_vars['img']->value){
$_smarty_tpl->tpl_vars['img']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['foo']['iteration']++;
?>
                        <tr class="row-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['iteration'];?>
">
                            <td>
                                <a href="/uploads/pics/<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
" class="image-news">
                                <img src="/uploads/pics/<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
" width="100"/>
                                <!-- <img src="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/image/filename/<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
/width/100"/> -->
                                </a>
                                <input type="hidden" name="filename[]" value="<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
" />
                            </td>
                            <td><?php echo $_smarty_tpl->tpl_vars['img']->value;?>
</td>
                            <td><a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/delete/uid/<?php echo $_smarty_tpl->tpl_vars['detail']->value['uid'];?>
/filename/<?php echo $_smarty_tpl->tpl_vars['img']->value;?>
" class="btn btn-danger remove" id="row-<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['foo']['iteration'];?>
">delete</a></td>
                        </tr>
                    <?php } ?>
                <?php }?>
            </table>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Images</label>
                <div class="controls">
                    <input type="file" class="" name="image" >
                </div>
            </div>
            <h5><i>use the enter key to separate from one another</i></h5>
            <div class="control-group">
                <label class="control-label" >Caption</label>
                <div class="controls">
                	<textarea name="f[imagecaption]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['imagecaption'];?>
<?php }?></textarea>                    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Img alttext</label>
                <div class="controls">
                	<textarea name="f[imagealttext]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['imagealttext'];?>
<?php }?></textarea>                    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Img titletext</label>
                <div class="controls">
                	<textarea name="f[imagetitletext]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['imagetitletext'];?>
<?php }?></textarea>                    
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" >Links</label>
                <div class="controls">
                	<textarea name="f[links]"><?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['links'];?>
<?php }?></textarea>                    
                </div>
            </div>
          </div>
          
          <div class="tab-pane fade" id="relation">
           <div class="control-group">
                <label class="control-label" >Category</label>
                <div class="controls">
                    <select name="category[]" style="width: 400px; height: 400px;" class="multiselect" multiple="multiple">
                        <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value){
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['uid'];?>
"
                                            <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?>
                                              <?php if (in_array($_smarty_tpl->tpl_vars['cat']->value['uid'],$_smarty_tpl->tpl_vars['newsCategory']->value)){?>selected="selected"<?php }?>
                                            <?php }?>>
                                            <?php echo $_smarty_tpl->tpl_vars['cat']->value['title'];?>
</option>
                                            
                                <?php if (isset($_smarty_tpl->tpl_vars['cat']->value['sub'])){?>
                                    <?php  $_smarty_tpl->tpl_vars['catsub'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['catsub']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cat']->value['sub']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['catsub']->key => $_smarty_tpl->tpl_vars['catsub']->value){
$_smarty_tpl->tpl_vars['catsub']->_loop = true;
?>
                                        <option  value="<?php echo $_smarty_tpl->tpl_vars['catsub']->value['uid'];?>
"
                                            <?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?>                                              
                                              <?php if (in_array($_smarty_tpl->tpl_vars['catsub']->value['uid'],$_smarty_tpl->tpl_vars['newsCategory']->value)){?>selected="selected"<?php }?>
                                            <?php }?>
                                        >--<?php echo $_smarty_tpl->tpl_vars['catsub']->value['title'];?>
</option>
                                    <?php } ?>
                                <?php }?>    
                            
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="control-group">
                <label class="control-label" >Related</label>
                <div class="controls">
                	 <p>
                  <input type="hidden" class="bigdrop" id="e6" style="width:600px" value="16340"/>
              </p>
                   <select multiple="multiple" name="related[]" style="width: 400px; height: 400px;" class="multiselect">                    	
                        <?php  $_smarty_tpl->tpl_vars['row'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['row']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['news']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['row']->key => $_smarty_tpl->tpl_vars['row']->value){
$_smarty_tpl->tpl_vars['row']->_loop = true;
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['row']->value['uid'];?>
"  <?php if (in_array($_smarty_tpl->tpl_vars['row']->value['uid'],$_smarty_tpl->tpl_vars['newsrel']->value)){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</option>
                        <?php } ?>
                    </select>
                    
                </div>
            </div>
            
          </div>
          
          <div class="tab-pane fade" id="access">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Start</label>
                <div class="controls">
                    <input type="text" class="datetimepicker" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['starttime']!=0){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['starttime'],"%d-%m-%Y %H:%M");?>
<?php }?>" name="f[starttime]">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Stop</label>
                <div class="controls">
                    <input type="text" class="datetimepicker" value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)&&$_smarty_tpl->tpl_vars['detail']->value['endtime']!=0){?><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['detail']->value['endtime'],"%d-%m-%Y %H:%M");?>
<?php }?>" name="f[endtime]">
                </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
        	<a href="<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/news/index/preview/uid/<?php echo $_smarty_tpl->tpl_vars['params']->value['uid'];?>
" class="btn btn-warning fancybox" id="preview" style="display: none;">Preview</a>
        	<input  type="hidden" id="show-preview" value="<?php if (isset($_smarty_tpl->tpl_vars['params']->value['preview'])){?><?php echo $_smarty_tpl->tpl_vars['params']->value['preview'];?>
<?php }else{ ?>0<?php }?>" name="preview"/>
            <input  type="hidden"  value="<?php if (isset($_smarty_tpl->tpl_vars['detail']->value)){?><?php echo $_smarty_tpl->tpl_vars['detail']->value['redaktur_uid'];?>
<?php }else{ ?>0<?php }?>" name="redaktur_uid"/>
            <input type="button" class="btn btn-warning " value="Preview" id="btn-preview"  />            
            <input type="button" class="btn btn-primary " value="SAVE" id="btn-save" />
            
            
		</div>

		
<script>

 function cekValid()
    {
        var valid = 0;
        if($("#title").val() != '')
        {
            valid = 1;
        }
      
        return valid;
        
    }

$(document).ready(function(){
    
   
    
   // var  baseUrl = "<?php echo $_smarty_tpl->tpl_vars['baseUrl']->value;?>
/";
   if($("#show-preview").val() == 1)
   {
    $("#preview").trigger("click");
   }
   $("#btn-preview").click(function(){
        $("#show-preview").val(1);
        if(cekValid())
        {
            $("#form-news").submit();
        } else {
            alert("Title dan content harus di isi");
        }
        
   }); 
   $("#btn-save").click(function(){
        $("#show-preview").val(0);
        if(cekValid())
        {
            $("#form-news").submit();
            //include "../../../autotweetsatuharapan/post_tweet.php";
            
        } else {
            alert("Title dan content harus di isi");
        }
   }); 
   
   $("a.image-news").fancybox({
		'titleShow'     : false
	});
    
   $(".remove").click(function(){
        console.log(this.id);
        $("." + this.id).fadeOut(500, function() {
			
		});
		$("." + this.id).remove();
        var datastring = "ok";
        $("#loading_overlay").show();    
        $.ajax({                        
            url: $(this).attr("href"),
            type: 'POST',
            data: datastring,
            async: true,
            success: function (data) {                     
                    $("#loading_overlay").hide();           
                },           
            });       
        return false;
   }); 
});
   
</script>



<script type="text/javascript">
$(".multiselect")
   .multiselect({
      noneSelectedText: 'Select',
      selectedList: 10
   })
   .multiselectfilter();
$(".singgle-select")
   .multiselect({
      multiple: false,
      noneSelectedText: 'Select',
      selectedList: 10
   })
   .multiselectfilter();
</script>

<?php }} ?>
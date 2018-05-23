<?php 
	define('TBL_CAT','tbl_category');
	//$$primary_key = $_REQUEST[$primary_key_edit];
	$$primary_key = $_REQUEST['gallery_id'];
	$act = ($$primary_key != '')?'Edit':'Add';
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity." Image";
	
   	
	//print_r($_REQUEST);	
	/*if(isset($_REQUEST['gallery_id']))
	{
	$gallery_id=$_REQUEST['gallery_id'];
	$selectGalleryMain=$wpdb->get_row($wpdb->prepare("select * from `tbl_gallery_main where status='Y' and gallery_main_id=$gallery_id"));
		
	
	}*/
	
	
	
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL;?>inc/js/main.js"></script>
<style type="text/css">
#previews{
	position:absolute;
	border:1px solid #ccc;
	background:#333;
	padding:5px;
	display:none;
	color:#fff;
	}
	</style>	
<div class="wrap" >
  <div id="icon-edit-pages" class="icon32" align="left"></div>
  <h2><?php echo $heading;?></h2>
</div>
<div align="center"><br />
  <font color="#ff0000"><?php echo $alert; ?></font><br />
</div>
<div class="wrap" id="box1" style=" width:90%;">
  <?php	
  			
  		//if ($$primary_key != '' && $hidAction == '') {
		if ($$primary_key != '') {
		
			
			
			//$res1 = $wpdb->get_row( $wpdb->prepare( "SELECT * from ".TBL." WHERE ".$primary_key." = %s", $$primary_key ) );
			
			$res1 = $wpdb->get_row( $wpdb->prepare("select * from tbl_gallery_main gm inner join  tbl_gallery g on gm.gallery_main_id=g.gallery_main_id WHERE g.".$primary_key_edit." = %s", $$primary_key ) );
			
		    $res1 = stripslashes_deep($res1);
			
						
			$category_id=$res1->category_id;
			$title=$res1->title;
			$before_imagetitle=$res1->before_imagetitle;
			$before_imagealt=$res1->before_imagealt;
			$before_image=$res1->before_image;
			$after_imagetitle=$res1->after_imagetitle;
			$after_imagealt=$res1->after_imagealt;
			$after_image=$res1->after_image;
			$description=$res1->description;
			$$primary_key = $res1->$primary_key;
			$status = $res1->status;
			
		}
		else {
			extract($_POST);
		}
		
 ?>
  <form enctype="multipart/form-data" name="add" id="add" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  onsubmit="return validate();" >
    <table cellspacing="0" class="widefat" width="100%" >
      <thead>
        <tr class="nodrag nodrop">
          <th colspan="3"><b><?php echo $act.' '.$entity.' Image'; ?></b></th>
        </tr>
      </thead>
      <tbody>
        
			
              <tr>
                <td colspan="4" style="padding:0px !important; border-bottom:0px;">
				<table width="95%" border="0" cellspacing="0" cellpadding="0">
  
			  
			    
			 
			   <tr> 
				 <td colspan="4" id="beforeafterdetails">
				 <table width="895" border="1" cellspacing="0" id="beforeafter_1" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" >

                   <tr>
                     <td width="121">Before Image Title<font color="#FF0000">*</font></td>
                     <td width="313"><input type="text" name="txtBeforeImageTitle_1" id="txtBeforeImageTitle_1" value="<?php echo $before_imagetitle; ?>" /></td>
                     <td width="121">After Image Title<font color="#FF0000">*</font></td>
                     <td width="322"><input type="text" name="txtAfterImageTitle_1" id="txtAfterImageTitle_1" value="<?php echo $after_imagetitle; ?>" /></td>
                   </tr>
				   
<tr>
                     <td width="121">Before Image Alt</td>
                     <td width="313"><input type="text" name="txtBeforeImageAlt_1" id="txtBeforeImageAlt_1" value="<?php echo $before_imagealt; ?>" /></td>
                     <td width="121">After Image Alt</td>
                     <td width="322"><input type="text" name="txtAfterImageAlt_1" id="txtAfterImageAlt_1" value="<?php echo $after_imagealt; ?>" /></td>
                   </tr>				   
				   
				   
				     <tr>
				       <td> Before Image<font color="#FF0000">*</font></td>
				       <td><input type="file" id="before_image_1" value=""  name="before_image_1" />
					  <?php if($$primary_key!="") {?><a href="<?php echo UPLOAD_URL.$folder_name.'/before/'.$before_image; ?>" onclick="return false;" class="previews">view </a><?php }?>
					  </td>
				       <td> After Image<font color="#FF0000">*</font></td>
				       <td><input type="file" id="after_image_1" value="" name="after_image_1" />
                      <?php if($$primary_key!="") {?><a href="<?php echo UPLOAD_URL.$folder_name.'/after/'.$after_image; ?>" onclick="return false;" class="previews">view </a><?php }?>					   
					  </td>
			        </tr>
				     <tr>
                     <td>&nbsp;</td>
                     <td colspan="3">(Restricted to Jpg, Gif and Png) </td>
                    </tr>
					<tr>
					<td><input type="hidden" name="hidbefore_image" value="<?php echo $before_image; ?>"><input type="hidden" name="hidafter_image" value="<?php echo $after_image; ?>"></td>
					</tr>
                 </table></td>
                <td width="6">&nbsp;</td>
              </tr>
			  
			  
			  
             
</table>

				</td>
              </tr>
          
        <!--<tr align="left">
          <td width="106"  valign="middle">Status<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left"><input type="radio" name="status" value="Y" <?php //echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> />
            Yes &nbsp;
            <input type="radio" name="status" value="N" <?php// echo ($status=='N')?'checked="checked"':''; ?> />
            No </td>
        </tr>-->
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;
              <label class="submit">
              <?php 
			if($$primary_key!="")
			{
			?>
              <input name="submit"  type="submit" title="Update"  value="Update"/>
              <?php
			}
			else
			{
			?>
              <input name="submit"  type="submit" title="Save"  value="Save"/>
              <?php
			}
			?>
              <!-- <input  type="submit"  value="Submit" name="list" />-->
              </label>
              <label class="submit">
			 
              <input type="hidden" id="hidCatImg" name="hidCatImg" value="<?php echo $category_image;?>" />
              <input name="button"  type="button"  title="Cancel" onclick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name; ?>');"  value="Cancel"/>
              </label>
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
	 <input type="hidden" name="gallery_count" id="gallery_count" value="1">
  <!--  <input type="hidden" name="hidAction" id="hidAction" value="<?php //echo ($$primary_key!='')?'edit':'add'; ?>" />-->
     <input type="hidden" name="hidAction1" id="hidAction1" value="editgal" />
     <input type="hidden" name="hidgal_main_id" id="hidgal_main_id" value="<?php echo $$primary_key; ?>" />
	<input type="hidden" name="<?php echo $primary_key_edit; ?>" id="<?php echo $primary_key_edit; ?>" value="<?php echo $res1->gallery_id; ?>" />
  </form>
</div>
<script type="text/javascript">

function validate()
{

		if(jQuery.trim(jQuery('#txtBeforeImageTitle_1').val())=='')
		{
		 alert("Please fill in Before Image Title.");
		 jQuery('#txtBeforeImageTitle_1').focus();
		 return false;
		 }	
		   <?php
				
				if($_REQUEST['hidAction1']!="")
				{
			?> 
		 if(jQuery.trim(jQuery('#before_image_1').val())=='')
		{
		 alert("Please upload Before Image.");
		 jQuery('#before_image_1').focus();
		 return false;
		 }
		  <?php } ?>
		
		 
		 if(jQuery.trim(jQuery('#txtAfterImageTitle_1').val())=='')
		{
		 alert("Please fill in After Image Title.");
		 jQuery('#txtAfterImageTitle_1').focus();
		 return false;
		 }
		  <?php
				
				if($_REQUEST['hidAction1']!="")
				{
			?> 
		 
		 if(jQuery.trim(jQuery('#after_image_1').val())=='')
		{
		 alert("Please upload After Image.");
		 jQuery('#after_image_1').focus();
		 return false;
		 }
		 <?php } ?>

	         document.add.submit();

}


jQuery("#addmore").click(function(){
	var gallery_count=jQuery("#gallery_count").val();
	gallery_count=parseInt(gallery_count)+parseInt(1);
	jQuery("#gallery_count").val(gallery_count);
	jQuery("#beforeafterdetails").append('<table width="895" border="1" cellspacing="0" id="beforeafter_'+gallery_count+'" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" ><tr><td colspan="4" align="right"><a href="javascript:void(0);" onclick=" removeUpBeforeAfter('+gallery_count+'); return false;" >Close Box</a></td></tr><tr><td width="98">Before Image Title<font color="#FF0000">*</font></td><td width="316"><input type="text" name="txtBeforeImageTitle_'+gallery_count+'" id="txtBeforeImageTitle_'+gallery_count+'" value="" /></td><td width="98">After Image Title<font color="#FF0000">*</font></td><td width="277"><input type="text" name="txtAfterImageTitle_'+gallery_count+'" id="txtAfterImageTitle_'+gallery_count+'" value="" /></td></tr><tr><td> Before Image<font color="#FF0000">*</font></td><td><input type="file" id="before_image_'+gallery_count+'" value=""  name="before_image_'+gallery_count+'" /></td><td> After Image<font color="#FF0000">*</font></td><td><input type="file" id="after_image_'+gallery_count+'" value="" name="after_image_'+gallery_count+'" /></td></tr><tr><td>&nbsp;</td><td colspan="3">(Restricted to Jpg, Gif and Png) </td></tr></table>');
});
function removeUpBeforeAfter(closeId)
{
	var gallery_count=jQuery("#gallery_count").val();
	gallery_count=parseInt(gallery_count)-parseInt(1);
	jQuery("#gallery_count").val(gallery_count);

	jQuery("#beforeafter_"+closeId).remove();
	
}
</script>


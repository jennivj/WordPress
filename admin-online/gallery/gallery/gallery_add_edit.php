<?php 
	define('TBL_CAT','tbl_category');
	
	$$primary_key = $_REQUEST[$primary_key];
	
	//echo "primary key".$_REQUEST[$primary_key]."<br>";
	
	$act = ($$primary_key != '')?'Edit':'Add';
	
	//echo $act;
	
		
	$heading="Manage ".$entity." &raquo; ".$act." ".$entity;
	if($$primary_key!="")
	{
		$gallery_id		=$_REQUEST['gallery_id'];
		
		$selectGallerySql=$wpdb->get_row($wpdb->prepare("select * from tbl_gallery where gallery_id=$gallery_id ",''));

		$categoryId=$selectGallerySql->category_id;
		$title=$selectGallerySql->imagetitle;
		$alt=$selectGallerySql->imagealt;
		$image=$selectGallerySql->image;
		$description=$selectGallerySql->description;
		$status=$selectGallerySql->status;
		
		/*if(count($selectGallerySql)>0)
		{
			$before_image_thumb=$selectGallerySql->before_image_thumb;
			$after_image_thumb=$selectGallerySql->after_image_thumb;
			
			@unlink(UPLOAD_PATH.$folder_name.'/before/'.$before_image_thumb);
			@unlink(UPLOAD_PATH.$folder_name.'/after/'.$after_image_thumb);
			
			@unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$before_image_thumb);
			@unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$after_image_thumb);
			
			@unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$before_image_thumb);
			@unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$after_image_thumb);
			
			//$deleteGallerySql="delete from tbl_gallery where gallery_id=$gallery_id";
			//$deleteGallerySqlConnect=mysql_query($deleteGallerySql);
		}*/
		
		
	}
?>
<script type="text/javascript" src="<?php echo PLUGIN_URL;?>inc/js/main.js"></script>
<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/ckeditor/ckeditor.js"></script>
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
  			
  		if ($$primary_key != '' && $hidAction == '') {
		
		
			//$res1 = $wpdb->get_row( $wpdb->prepare( "SELECT * from ".TBL." WHERE ".$primary_key." = %s", $$primary_key ) );
			
		/*	$res1 = $wpdb->get_row( $wpdb->prepare("select * from tbl_gallery_main gm inner join  tbl_gallery g on gm.gallery_main_id=g.gallery_main_id WHERE g.".$primary_key." = %s", $$primary_key ) );
			
		    $res1 = stripslashes_deep($res1);
			
			$category_id=$res1->category_id;
			$title=$res1->title;
			$before_imagetitle=$res1->before_imagetitle;
			$before_image=$res1->before_image;
			$after_imagetitle=$res1->after_imagetitle;
			$after_image=$res1->after_image;
			$description=$res1->description;
			$$primary_key = $res1->$primary_key;
			$status = $res1->status;*/
			
		}
		else {
			extract($_POST);
		}
		
 ?>
  <form enctype="multipart/form-data" name="add" id="add" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>"  onsubmit="return validate();" >
    <table cellspacing="0" class="widefat" width="100%" >
      <thead>
        <tr class="nodrag nodrop">
          <th colspan="3"><b><?php echo $act.' '.$entity; ?></b></th>
        </tr>
      </thead>
      <tbody>
        <tr align="left">
          <td width="106">Category Name<font color="#FF0000">*</font> </td>
          <td width="585" align="left">
		<?php
		$categories = $wpdb->get_results( 
			"
			SELECT * 
			FROM ".TBL_CAT."
			WHERE status = 'Y' 
			ORDER BY ordering
			"
		);		  

		?>
		<select name="category" id="category">
		<option value="0">Select Category</option>
		  <?php
			foreach ( $categories as $values ) 
			{
				?>
		        <option <?php if($values->category_id==$categoryId){?> selected="selected" <?php } ?>  value="<?php echo $values->category_id; ?>"><?php echo $values->category_name; ?></option>
				<?php
			}		  
          ?>
		</select>
          </td>
          <td width="163">&nbsp;</td>
        </tr>
			
        <tr>
                <td colspan="4" style="padding:0px !important; border-bottom:0px;">
				<table width="95%" border="0" cellspacing="0" cellpadding="0">
			    
			  
			   <tr> 
				 <td colspan="4" id="beforeafterdetails">
				 <table width="900" border="1" cellspacing="0" id="beforeafter_1" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" >

                   <tr>
                     <td width="121">Image Title<font color="#FF0000">*</font></td>
                     <td width="313"><input type="text" name="ImageTitle_1" id="ImageTitle_1"  value='<?php echo $title;?>' tabindex="104"/></td>
                     <td width="121">Image Alt</td>
                     <td width="313"><input type="text" name="ImageAlt_1" id="ImageAlt_1" value='<?php echo $alt; ?>'  tabindex="107"/></td>
				   </tr>
				   
				   <tr>
				   	  <td width="121">Image Description</td>
					 <td width="313"><textarea name="ImageDesc_1" id="ImageDesc_1" style="width: 290px; height: 44px;"><?php echo $description;?></textarea></td>
					 <td>Image<font color="#FF0000">*</font></td>
				       <td><input tabindex="109" type="file" id="image_1" value=""  name="image_1" />
					  <?php if($$primary_key!="") {?><a href="<?php echo UPLOAD_URL.$folder_name.'/thumbs/'.$image; ?>" onclick="return false;" class="previews">view </a><?php }?>					  </td>
				   </tr>				   
				   
				     <tr>
                     <td>&nbsp;</td>
                     <td colspan="3">(Restricted to Jpg, Gif and Png) </td>
                    </tr>
					<tr>
					<td><input type="hidden" name="hidimage" value="<?php echo $image; ?>"></td>
					</tr>
                 </table>
                 
                 </td>
                 
                 
                <td width="6">&nbsp;</td>
              </tr>
			  
			  <?php
			  if($act == 'Add'){?>
			  
              <tr>
                <td width="104">&nbsp;</td>
                <td width="317" align="center"><a href="javascript:void(0);" id="addmore"  >Add More</a> </td>
                <td colspan="2" align="left">&nbsp;</td>
                <td width="6">&nbsp;</td>
              </tr>
              <?php
			  }?>
</table>

				</td>
              </tr>
<!--			  <tr>
			  <td>Metat Title</td><td><textarea name="metatitle" id="metatitle" rows="2" cols="60"><?php echo $metatitle; ?></textarea></td>
			  </tr>
			  <tr>
			  <td>Metat Description</td><td><textarea name="metadescription" id="metadescription" rows="2" cols="60"><?php echo $metadescription; ?></textarea></td>
			  </tr>
-->        <tr align="left">
          <td width="106"  valign="middle">Status<span style=" color:#F00;">*</span></td>
          <td colspan="2" align="left"><input type="radio" name="status" value="Y" <?php echo ($status=='Y' || $status=='')?'checked="checked"':''; ?> tabindex="115"/>
            Yes &nbsp;
            <input type="radio" name="status" value="N" <?php echo ($status=='N')?'checked="checked"':''; ?>  tabindex="116"/>
            No </td>
        </tr>
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
              <input name="button"  type="button"  title="Cancel" onclick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name; ?>');"  value="Cancel" tabindex="114"/>
              </label>
          </td>
          <td>&nbsp;</td>
        </tr>
      </tbody>
    </table>
	 <input type="hidden" name="gallery_count" id="gallery_count" value="1">
    <input type="hidden" name="hidAction" id="hidAction" value="<?php echo ($$primary_key!='')?'edit':'add'; ?>" />
	<input type="hidden" name="<?php echo $primary_key; ?>" id="<?php echo $primary_key; ?>" value="<?php echo $$primary_key; ?>" />
	<input type="hidden" name="prev_cat" id="prev_cat" value="<?php echo $categoryId; ?>" />
	<input type="hidden" name="prev_subcat" id="prev_subcat" value="<?php echo $subcatId; ?>" />
  </form>
</div>
<script type="text/javascript">

function validate()
{
	var gallery_count=jQuery("#gallery_count").val();
	//alert(gallery_count);

	if(jQuery.trim(jQuery('#category').val())=='' || jQuery.trim(jQuery('#category').val())==0)
	{
		 alert("Please select a Category Name.");
		 jQuery('#category').focus();
		 return false;
	 }
	 
		
			<?php
				
				if($$primary_key!="")
				{
			?> 
						 for(var i=2;i<=gallery_count;i++)
						 {
						 if(document.getElementsByName('ImageTitle_'+i+'').length!=0) 
							 {  
						
									if(jQuery.trim(jQuery('#ImageTitle_'+i+'').val())=='')
									{
									 alert("Please fill in Image Title.");
									 jQuery('#ImageTitle_'+i+'').focus();
									 return false;
									 }	 
									 if(jQuery.trim(jQuery('#image_'+i+'').val())=='')
									{
									 alert("Please upload Image.");
									 jQuery('#image_'+i+'').focus();
									 return false;
									 }
									 
									 
								}
									 
							}	
			
			
			<?php
			   }
			   else
			   {
			?>
	
				 for(var i=1;i<=gallery_count;i++)
				 {
				 if(document.getElementsByName('ImageTitle_'+i+'').length!=0) 
					 {  
				
							if(jQuery.trim(jQuery('#ImageTitle_'+i+'').val())=='')
							{
							 alert("Please fill in Image Title.");
							 jQuery('#ImageTitle_'+i+'').focus();
							 return false;
							 }	 
							 if(jQuery.trim(jQuery('#image_'+i+'').val())=='')
							{
							 alert("Please upload Image.");
							 jQuery('#image_'+i+'').focus();
							 return false;
							 }
							 
						}
							 
					}
					
					
				<?php
				}
			?>
	
		     document.add.gallery_count.value=gallery_count;
	         document.add.submit();
	
}


jQuery("#addmore").click(function(){
	var gallery_count=jQuery("#gallery_count").val();
	gallery_count=parseInt(gallery_count)+parseInt(1);
	jQuery("#gallery_count").val(gallery_count);
	jQuery("#beforeafterdetails").append('<table width="900" border="1" cellspacing="0" id="beforeafter_'+gallery_count+'" class="widefat3"  bgcolor="#CCCCCC" bordercolor="#FFFFFF" ><tr><td colspan="4" align="right"><a href="javascript:void(0);" onClick=" removeUpBeforeAfter('+gallery_count+'); return false;" >Close Box</a></td></tr><tr><td width="98">Image Title<font color="#FF0000">*</font></td><td width="316"><input type="text" name="ImageTitle_'+gallery_count+'" id="ImageTitle_'+gallery_count+'" value="" /></td><td width="98">Image Alt</td><td width="316"><input type="text" name="ImageAlt_'+gallery_count+'" id="ImageAlt_'+gallery_count+'" value="" /></td></tr><tr><td width="121">Image Description</td><td width="313"><textarea name="ImageDesc_'+gallery_count+'" id="ImageDesc_'+gallery_count+'" style="width: 290px; height: 44px;"></textarea></td><td>Image<font color="#FF0000">*</font></td><td><input type="file" id="image_'+gallery_count+'" value=""  name="image_'+gallery_count+'" /></td></tr><tr><td>&nbsp;</td><td colspan="3">(Restricted to Jpg, Gif and Png) </td></tr></table>');
});
function removeUpBeforeAfter(closeId)
{
	var gallery_count=jQuery("#gallery_count").val();
	gallery_count=parseInt(gallery_count)-parseInt(1);
	jQuery("#gallery_count").val(gallery_count);

	jQuery("#beforeafter_"+closeId).remove();
	
}


jQuery(".deletegallery").click(function(){
	var deleteconfirmation=confirm('Are you sure you want to delete the selected record.?');
	if(deleteconfirmation)
	{
		var url=jQuery(this).attr('url');
		window.location=url;
	}

});


</script>
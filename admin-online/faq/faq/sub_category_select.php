<?php 
include("../../../../wp-load.php"); 
if($_REQUEST['id']!="")
{
	$cat_id=$_REQUEST['id'];
}
else
{
	$cat_id='';
}
$subcategory_Id=$_REQUEST['sub_category_id'];
if($cat_id!="")
{
	$sql_cat=$wpdb->prepare("Select subcategory_id,subcategory_name from tbl_subcategory where status='Y' and category_id=".$cat_id." ");
	$result_cat=$wpdb->get_results($sql_cat);
	$count_cat=count($result_cat);
	if($count_cat>0)
	{
	?>
		<select id="select_sub_cat" name="select_sub_cat" >
			<option selected="selected" value="">--Select Sub Category--</option>
			<?php
			for($i=0;$i<$count_cat;$i++)
			{
			?>
				<option <?php if($subcategory_Id==$result_cat[$i]->subcategory_id) echo "selected";?> value="<?php echo $result_cat[$i]->subcategory_id; ?>"><?php echo $result_cat[$i]->subcategory_name; ?> 
				</option>
			<?php	
			}
			?>
		</select>
	<?php		  
	}
	else
	{
		echo "No Sub Category Name Found";
	}
}
else
{
	echo "No Sub Category Name Found";
}
?>
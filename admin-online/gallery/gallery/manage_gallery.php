<script type="text/javascript" src="<?php echo PLUGIN_URL; ?>inc/js/main.js"></script>
<script type="text/javascript">
jQuery(document).ready(function() {
	select(); 
	
	function select() {
		   jQuery("#table-1").tableDnD({
			onDragClass: "myDragClass",
			onDrop: function(table, row) {
				var rows = table.tBodies[0].rows;
				var neworder = '';
				for (var i=0; i<rows.length; i++) {
					neworder += rows[i].id+",";
				}
				document.manage_frm.orderval.value=neworder;
				document.manage_frm.hidAction.value='ordering';
				document.manage_frm.submit();
			}
		});
	}
});
</script>

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
<?php
    include_once(PLUGIN_PATH."inc/classes/paginator.class.php");
	$title="Manage ".$entity;
    $searchText = $_REQUEST['searchText'];
	$pval = (isset($_REQUEST['pval']))?$_REQUEST['pval']:'1';
	$sort = (isset($_REQUEST['sort']))?$_REQUEST['sort']:'ordering';
	$mode = (isset($_REQUEST['mode']))?$_REQUEST['mode']:'asc';
	
	if($searchText!='') {//pending to done
	
         $sql="select * from tbl_gallery  where imagetitle LIKE '%%$searchText%%'"; 
		 $sql = $wpdb->prepare( $sql,'');
		 $count_sql = "select count(*) from tbl_gallery where imagetitle LIKE '%%$searchText%%'";
		 $count_sql = $wpdb->prepare( $count_sql,'');
		 $srch=1;
	}
	
	elseif($_REQUEST['category']!='' )
	{
	 	    $sql="select * from tbl_gallery where category_id=".$_REQUEST['category']."  and status='Y' order by ordering"; 
			$sql = $wpdb->prepare( $sql , '') ;
			$count_sql = "select count(*) from tbl_gallery where category_id=".$_REQUEST['category']." and status='Y' order by ordering"; 
			$count_sql = $wpdb->prepare( $count_sql , '') ;
	}
	else 
	{
				 //********* Code for Select First Category and Subcategory *********//
				 $categorysql="select * from tbl_category where status='Y' order by ordering";
				 $resultcat=mysql_query($categorysql);
				 $isgallery=0;
				 while($datacategory=mysql_fetch_array($resultcat)){ //fetching category
				     $category_id=$datacategory['category_id']; //category id
					 
					 // $subcategorysql="select * from tbl_gallerysubcategory where category_id=".$category_id." and status='Y' order by ordering"; 
					 // $resultsubcat=mysql_query($subcategorysql); 
					 // while($datasubcat=mysql_fetch_array($resultsubcat)){//fetching subcategory
					   // $subcategory_id=$datasubcat['subcategory_id']; //subcategory id
						 
/*					 	 $gallerysql="select * from tbl_gallery where category_id=".$category_id." and subcategory_id=".$subcategory_id." and status='Y' order by ordering";
*/					     $gallerysql="select * from tbl_gallery where category_id=".$category_id." and status='Y' order by ordering";
						 $resultgallrey=mysql_query($gallerysql);
						 if($datagallery=mysql_fetch_array($resultgallrey)){
									 $category_id; //first category id with records
									 //$subcategory_id; // first subcategory id with records
									 $isgallery=1;
									 if($isgallery==1)
									 break;
						}
						 //if($isgallery==1)
						 //break;
					  //} 
					if($isgallery==1)
					break;	  

				}		
					 //********* Code for Select First Category and Subcategory *********//
			if($category_id!=""){
			//if($category_id!="" && $subcategory_id!="" ){
			//$sql="select * from tbl_gallery where category_id=".$category_id." and subcategory_id=".$subcategory_id." order by ordering";		 
	 	    $sql="select * from tbl_gallery where category_id=".$category_id." order by ordering";
			$sql = $wpdb->prepare( $sql ,"") ;
			$count_sql="select count(*) from tbl_gallery where category_id=".$category_id." order by ordering";
			$count_sql = $wpdb->prepare( $count_sql ,"") ;
			}
		
	 }//else case end here
	
 	$tot_cnt = $wpdb->get_var( $count_sql );
	if($tot_cnt > 0) {
			$pages = new paginator;
			$pages->items_total = $tot_cnt;
			$pages->mid_range = 5;
			$pages->paginate($tot_cnt);
			$rec_list = $wpdb->get_results( $sql ." $pages->limit" );
	
			$rec_list = stripslashes_deep($rec_list);
			$rec_cnt = count($rec_list);
	}
	$ipp = $_REQUEST['ipp'];
	if($ipp!="") {
		$itemPerPageCnt = ($ipp=="All")?$tot_cnt:$ipp;
	}
	else {
		$itemPerPageCnt = 10;
	} 
	if ($_REQUEST['pval']!='')  $cnt = $itemPerPageCnt * ($_REQUEST['pval']  - 1 );

    if($_REQUEST["ins"]==1)
    	$alert = $entity." Added Successfully.";
    elseif($_REQUEST["upd"]==1)
    	$alert = $entity." Updated Successfully.";
	elseif($_REQUEST["del"]==1) 
		$alert = $entity."(s) Deleted Successfully.";
	if($_REQUEST["ord"]==1)
		$alert="Ordering Changed Successfully.";
	if($srch==1){
			if($rec_cnt==0){ $alert="0 Record(s) matched your search.";}
			else{
			$alert=$rec_cnt." Record(s) matched your search.";
			}
		}
		

if($_REQUEST['category']!=""){
$category_id=$_REQUEST['category']; 
}

?>
<div class="wrap" >
  <div id="icon-edit-pages" class="icon32" align="left"></div>
  <h2><?php echo  $title ;?> </h2>
  <br>
</div>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="manage_frm"  name="manage_frm" method="post">
  <div align="center" style="padding-bottom:10px;"><font color="#ff0000"><?php echo $alert;?></font> </div>
  <div id="admin-top" style="padding-bottom:5px; padding-left:5px;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr class="td">
        <td width="205" class="td-widht"><label class="submit">
          <input id="Add" name="Add" type="button" title="Add <?php echo $entity; ?>" value="Add <?php echo $entity; ?>" onClick="javascript: window.location=('<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&option=add'; ?>');" />
        </label>        </td>
<?php if($srch!=1){ ?>		  
<td width="224"><label class="submit">
          <?php
		 	$categories = $wpdb->get_results( 
				"
				SELECT category_id,category_name 
				FROM tbl_category
				WHERE status ='Y' order by ordering 
				"
			);		  
		  ?>
		  Category
          <select id="maincategory_id" name="maincategory_id" onchange="javascript:maincategory(this.value);">
				   <?php
				   foreach($categories as $values){
				   ?>
		          <option <?php if($values->category_id==$category_id){echo "selected";} ?> value="<?php echo $values->category_id; ?>" ><?php echo $values->category_name; ?></option>
				  <?php }?>
		  </select>
          </label>        
	    </td>
		
		
<?php }?>
        <td width="343">
		  <label>
          <input id="searchText" name="searchText" type="text"  value="<?php echo $searchText;?>" style="float:left; margin-right:5px;"  />
          </label>
		  <label class="submit">
          <input id="srch_btn" name="srch_btn" type="submit"  onclick="return validate_search(manage_frm);"  value="Search"  title="Search" style="float:left;"/>
        </label>        </td>
        <td align="left" valign="middle"width="134">
		<?php if($tot_cnt>0)  {   ?>
          <label style="float:left; padding-top:3px;">Filter&nbsp;</label>
        <div> <?php echo $pages->display_items_per_page(); }?></div>		</td>
      </tr>
    </table>
    <br />
  </div>
  <div class="wrap">
    <table width="100%" cellspacing="0" class="widefat" <?php if($category_id!="" || $subcategory_id!="")
	  { ?>  id="table-1"<?php } ?>>
      <thead>
        <tr class="nodrag nodrop">
          <th width="6%">SI No</th>
			
				
				
<th width="15%" class="<?php echo $field_sort.' '.$class_sort; ?>">
				<span>Image Title</span>
				<span class="sorting-indicator"></span>		  </th>		 
		   
          <th width="17%" class="<?php //echo $field_sort.' '.$class_sort; ?>"> 
            <span>Image</span> </th>
		  
		  
		  
		  	<?php
				$mode = 'asc';
				if ($_REQUEST['sort']=='status') {
					$mode = ($_REQUEST['mode']=='asc')?'desc':'asc';
					$field_sort = 'sorted';
					$class_sort = $_REQUEST['mode'];
				}
				else {
					$field_sort = 'sortable';
					$class_sort = 'desc';
				}
			?>
		  <th width="9%" class="<?php echo $field_sort.' '.$class_sort; ?>">
				<span>Status</span> 		  </th>
          <th width="6%">Edit</th>
          <th width="15%" align="right" style="text-align:right;">
		  <?php if ($rec_cnt>0) { ?>
		  	Select All
            <input type="checkbox" name="selectall" value="0" onclick="javascript:allchecked(document.manage_frm.del);"/>
		  <?php } ?>		  </th>
        </tr>
      </thead>
      <tbody>
        <?php
		
		if ($rec_cnt>0) {
			for ($i = 0; $i < $rec_cnt; $i++) {
				$cnt++; 		
			
		?>
        <tr id="<?php echo $rec_list[$i]->$primary_key; ?>">
          <td width="6%"><?php echo $cnt;?></td>
		  
			 
          <td width="15%">
		  <?php 
		   $title=$rec_list[$i]->imagetitle; 
		   if(strlen($title)>35)
		   echo substr($title,0,35).'...';
		   else
		   echo $title;
		  ?></td>
		  <td><a href="<?php echo UPLOAD_URL.$folder_name.'/thumbs/'.$rec_list[$i]->image; ?>" class="previews">view</a></td>
		  <td width="9%"><?php 
		   $status=$rec_list[$i]->status;
		  echo ($status=='N')?'Inactive':'Active'; 
		  ?>		  </td>
          <td width="6%"><a href="<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&gallery_id='.$rec_list[$i]->gallery_id;?>&option=add"  title="Edit this record">Edit</a></td>
          <td width="15%" align="right"><input type="checkbox" name="del" value="<?php echo $rec_list[$i]->$primary_key; ?>" style="cursor:default" /></td>
        </tr>
        <?php } ?>
        <tr>
          <td colspan="8" align="right"><label class="submit" >
            <input id="Delete" name="Delete" type="submit"  title="Delete selected record(s)" onclick="return validate(document.manage_frm,'delete')" value="Delete" />
            </label>		  </td>
        <tr>
        <?php } else { ?>
        <tr height="30" valign="middle">
          <td colspan="6" align="center" style="border-bottom:none;"><font color="#13859f"><strong>No <?php echo $entity; ?> Found.</strong></font></td>
        <tr>
        <?php } ?>
      </tbody>
    </table>
    <div class="tablenav" >
	
	  <?php
		if ($searchText=='' && $tot_cnt>1 && $sort=='g.ordering') echo '<span>Note: Drag the rows to sort them in the order of your choice</span>';
	  ?>
      <div class='tablenav-pages' align="center">
        <div style="float:right">
          <?php if($tot_cnt > $itemPerPageCnt)  { echo $pages->display_pages(); } ?>
        </div>
        <br clear="all" />
      </div>
    </div>
  </div>

  
  <input type="hidden" name="deleterec" value="" />
  <input type="hidden" name="hidAction"   id="hidAction" value=""/>
  <input type="hidden" name="orderval"   id="orderval" value=""/>
  <input type="hidden" name="fistcatId" value="<?php echo $fistcatId;?>" />
</form>
<script type="text/javascript">
function validate_search(thisform) {
	valid = true;
	thisform.submit();
	return valid;	
}

function validate(frm,opt){
	var del_ids= '';
	if (opt=='delete'){
		var field = frm.del;
		if (field[0]){
			for (i = 0; i < field.length; i++){
				if (field[i].checked == true) {
					if (del_ids=='')
						del_ids = field[i].value;
					else
						del_ids += ',' + field[i].value;
				}
			}
		}
		else {
			if (field.checked == true) {
				del_ids = field.value;
			}
		}
		if (del_ids != ''){
			if (confirm('Are you sure you want to delete the selected record(s)?')){
				frm.deleterec.value = del_ids;
				frm.hidAction.value = 'delete';
				return true;
			}
			else return false;
		}
		frm.hidAction.value = '';
		frm.deleterec.value = '';
		alert('Please select record(s) for deleting.');
		return false;
	}
}

function allchecked(field) {
	var set_tick = true;
	if (field[0]){
		if (field[0].checked == true) set_tick = false;
		for (i = 0; i < field.length; i++){
			field[i].checked = set_tick;
		}
	}
	else {
		if (field.checked == true) set_tick = false;
		field.checked = set_tick;
	}
	document.manage_frm.selectall.checked = set_tick;
}

function maincategory(i)
{
	if(i!="0")
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1<?php // echo $pval; ?>&category='+i;
	}
	else
	{ 
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1<?php // echo $pval; ?>';
	}
	
}

function subcategory(i)
{
	if(i!="0")
	{
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1&category=<?php  echo $category_id; ?>&subcategory='+i;
	}
	else
	{ 
	window.location='<?php echo get_option('siteurl').'/wp-admin/admin.php?page='.$page_name.'&sort=ordering'; ?>&mode=<?php echo $mode; ?>&ipp=<?php echo $ipp; ?>&pval=1<?php // echo $pval; ?>';
	}

}

</script>

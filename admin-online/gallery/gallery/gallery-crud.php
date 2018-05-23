<?php
	 require("seofun.php");	 
	 $action=$_REQUEST["hidAction"];
	 $gallery_count=$_REQUEST['gallery_count'];   
	 
	  include(PLUGIN_PATH."inc/classes/image.class.php");
	 // include(PLUGIN_PATH."inc/classes/class.image.php"); // white space class
		 
		  // server side validation//
	/*  function gallery_validation(){
		if (trim($_POST["txtCategory"])==''){
			return 'Please Select Category Name.';
		}
		return 1;
	 } */
	// server side validation// 
	 $date=date("m/d/Y");
	 switch($action){
	 case 'add':
/*	 $validation_function = $page_name.'_validation';
		 	$validation_status = $validation_function();
			if ($validation_status != 1){
				$alert = $validation_status;
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
*/			 //duplicate checking
			/* 
			$dup = $wpdb->get_var( $wpdb->prepare( "select count(*) from ". TBL ." where title = %s", trim($_POST["category_name"]) ) );	
			if( $dup>0) {
				$alert = 'This '.$entity .' already exists.';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			*/
			
			for($i=1;$i<=$gallery_count;$i++)
			{ 
			         if($_FILES['image_'.$i]['name']!="")
					 { 
			
						
						  list($width, $height, $type, $attr)= getimagesize($_FILES['image_'.$i]['tmp_name']); 
						//code start for  image Upload
							if (trim($_FILES['image_'.$i]['name']) != '' ){ //image uploading 
							 	$image 		= new Image($_FILES['image_'.$i]['tmp_name']);
							 	$thumb_image 		= new Image($_FILES['image_'.$i]['tmp_name']);
							 	$smallthumb_image 		= new Image($_FILES['image_'.$i]['tmp_name']);

								$source_path =$_FILES['image_'.$i]['tmp_name'];
								
								$valid_image_types = array('image/png','image/jpeg','image/gif');
								
								
							if (!in_array($_FILES['image_'.$i]['type'],$valid_image_types) || $_FILES['image_'.$i]['size']<=0){
									$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
									include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
									exit();
								}
								
							 	$Image_name = rand().time().$_FILES['image_'.$i]['name']; 
						
							    //$image->whitespace(631, 300, array('color' => '#FFFFFF')); // With Color
							    //$image->output(UPLOAD_PATH.$folder_name.'/'.$Image_name); 
								
								$image->resize(640,480);
								$image->save(UPLOAD_PATH.$folder_name.'/'.$Image_name );
								
								$thumb_image->resize(270,307);
								$thumb_image->save(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name );
								
								 
								 $smallthumb_image=UPLOAD_PATH.$folder_name.'/smallthumbs/'.$Image_name;
								 cropImages($source_path,$smallthumb_image,65,65);
								
								//$thumb_image->scale(270,307);
							    //$thumb_image->output(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name ); 
								
						 }
							
							else
							{
								$Image_name  = '';
							}	
								
						//code start for  image Upload
					
					
								$updateGallerySql="update ".TBL." SET ordering=(ordering + 1)";
								$updateGallerySqlConnect=mysql_query($updateGallerySql);
								
								if($_POST['status']=='Y')
								{
									$status="Y";
								}
								else
								{
									$status="N";
								}
								$data = array(	
											'category_id'   => $_POST['category'],
											'imagetitle' 	=> $_POST['ImageTitle_'.$i],
											'imagealt' 		=> $_POST['ImageAlt_'.$i],
											'image' 		=> $Image_name,
											'description' 	=> $_POST['ImageDesc_'.$i],
											'ordering'		=>1,
											'status' 		=> $status
										);
										$wpdb->insert( TBL, $data, array('%d','%s','%s','%s','%s','%d','%s') );
						                //$wpdb->print_error();  exit;
						}
				}		
						
				wp_redirect("admin.php?page=".$page_name."&ins=1");
				break;
				
				
		 case 'edit':
/*		 	$validation_function = $page_name.'_validation';
		 	$validation_status = $validation_function();
			if ($validation_status != 1){
	
				$alert = $validation_status;
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
*/		/*	$dup = $wpdb->get_var( $wpdb->prepare( "SELECT count(*)  from " .TBL." WHERE title = %s AND   ".$primary_key." <> %s ", trim($_POST["category_name"]), $_POST[$primary_key]  ) ); 
			if($dup > 0) {
				$alert = 'This '.$entity .' already exists.';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
			*/
		
			
for($i=1;$i<=$gallery_count;$i++)
{

		 if($i!=1)
		 {
			if($_FILES['image_'.$i]['name']!="")
			 {
	
				
				 list($width, $height, $type, $attr)= getimagesize($_FILES['image_'.$i]['tmp_name']); 
				//code start for  image Upload
					if (trim($_FILES['image_'.$i]['name']) != '' ){//image uploading
						$image 		= new Image($_FILES['image_'.$i]['tmp_name']);
						$thumb_image 		= new Image($_FILES['image_'.$i]['tmp_name']);
						$smallthumb_image = new Image($_FILES['image_'.$i]['tmp_name']);
						
						$source_path =$_FILES['image_'.$i]['tmp_name'];
						
						$valid_image_types = array('image/png','image/jpeg','image/gif');
						
					if (!in_array($_FILES['image_'.$i]['type'],$valid_image_types) || $_FILES['image_'.$i]['size']<=0){
							$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
							include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
							exit();
						}
						
						
						
						$Image_name = rand().time().$_FILES['image_'.$i]['name']; 
						
							   // $image->whitespace(631, 300, array('color' => '#FFFFFF')); // With Color
							    //$image->output(UPLOAD_PATH.$folder_name.'/'.$Image_name); 
								
								$image->resize(640,480);
								$image->save(UPLOAD_PATH.$folder_name.'/'.$Image_name );
								
								$thumb_image->resize(270,307);
								$thumb_image->save(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name );
								 
								 $smallthumb_image=UPLOAD_PATH.$folder_name.'/smallthumbs/'.$Image_name;
								 cropImages($source_path,$smallthumb_image,65,65);
								
								//$thumb_image->scale(270,307);
							    //$thumb_image->output(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name ); 
						
					}
					
					else
					{
						$Image_name  = '';
					}	
						
				//code start for  image Upload
			
			
						$updateGallerySql="update ".TBL." SET ordering=(ordering + 1)";
						$updateGallerySqlConnect=mysql_query($updateGallerySql);
						
						if($_POST['status']=='Y')
						{
							$status="Y";
						}
						else
						{
							$status="N";
						}
						$data = array(	
									'category_id'   => $_POST['category'],
									'imagetitle' 	=> $_POST['ImageTitle_'.$i],
									'imagealt' 		=> $_POST['ImageAlt_'.$i],
									'image' 		=> $Image_name,
									'description' 	=> $_POST['ImageDesc_'.$i],
									'ordering'		=>1,
									'status' 		=> $status
								);
								$wpdb->insert( TBL, $data, array('%d','%s','%s','%s','%s','%d','%s') );
							  //  $wpdb->print_error();  exit;
				}										
		}
		else
		{
			
				//code start for  image Upload
				 list($width, $height, $type, $attr)= getimagesize($_FILES['image_1']['tmp_name']); 
				if (trim($_FILES['image_1']['name']) != '' ){//image uploading
					$image 		= new Image($_FILES['image_1']['tmp_name']);
					$thumb_image 		= new Image($_FILES['image_1']['tmp_name']);
					$smallthumb_image = new Image($_FILES['image_1']['tmp_name']);
					
					$source_path =$_FILES['image_'.$i]['tmp_name'];
					
					$valid_image_types = array('image/png','image/jpeg','image/gif');
					
				if (!in_array($_FILES['image_1']['type'],$valid_image_types) || $_FILES['image_1']['size']<=0){
						$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
						include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
						exit();
					}
					
					
							//delete the old image
				$old_image = trim( $wpdb->get_var( $wpdb->prepare( "select image from ". TBL ." where ".$primary_key." = %s", trim($_POST[$primary_key]) ) ) );
					
					if ($old_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/'.$old_image)){
								unlink(UPLOAD_PATH.$folder_name.'/'.$old_image);
								unlink(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_image);
								unlink(UPLOAD_PATH.$folder_name.'/smallthumbs/'.$old_image);
							}
					
					$Image_name = rand().time().$_FILES['image_1']['name']; 
					
							    //$image->whitespace(631, 300, array('color' => '#FFFFFF')); // With Color
							    //$image->output(UPLOAD_PATH.$folder_name.'/'.$Image_name);
								
								$image->resize(640,480);
								$image->save(UPLOAD_PATH.$folder_name.'/'.$Image_name );
								
								$thumb_image->resize(270,307);
								$thumb_image->save(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name );
								
/*								 $thumb_image=UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name;
								 cropImages($source_path,$thumb_image,270,307);
*/
								
								 $smallthumb_image=UPLOAD_PATH.$folder_name.'/smallthumbs/'.$Image_name;
								 cropImages($source_path,$smallthumb_image,65,65);
								
								//$thumb_image->scale(270,307);
							   // $thumb_image->output(UPLOAD_PATH.$folder_name.'/thumbs/'.$Image_name ); 
				}
				
				else
				{
					$Image_name  = $_POST['hidimage'];
				}	
					
			//code start for  image Upload
		
					
					if($_POST['status']=='Y')
					{
						$status="Y";
					}
					else
					{
						$status="N";
					}
					$data = array(
					
									'category_id'   => $_POST['category'],
									'imagetitle' 	=> $_POST['ImageTitle_'.$i],
									'imagealt' 		=> $_POST['ImageAlt_'.$i],
									'image' 		=> $Image_name,
									'description' 	=> $_POST['ImageDesc_'.$i],
									'ordering'		=>1,
									'status' 		=> $status
							
							);
							
							$data_format = array('%d','%s','%s','%s','%s','%d','%s');
							
							$where = array(
										$primary_key => $_POST[$primary_key]
									);
							$wpdb->update( TBL, $data, $where, $data_format, '%d' );
							
							//$wpdb->print_error(); exit;
		
		}		   
											   
								}

		
				
				wp_redirect("admin.php?page=".$page_name."&upd=1&category=".$_POST['category']);
			
			break;
			
			case 'delete':
			
			if ($_POST["deleterec"]!='') {
				//delete the image
				$id_arr = explode(',',$_POST["deleterec"]);
				$del_arr = array();
				$del = 1;
				foreach ($id_arr as $key => $val){
					$items_found = $wpdb->get_var( $wpdb->prepare( "select count(*) from ".TBL." where gallery_id = %d", $val ) );
					
					if ($items_found>0) {
						
						array_push($del_arr,$val); 
						$old_image = trim( $wpdb->get_var( $wpdb->prepare( "select image from ". TBL ." where ".$primary_key." = %s", $val ) ) );
						
						
					if ($old_image!='' && file_exists(UPLOAD_PATH.$folder_name.'/'.$old_image)){
					   
							@unlink(UPLOAD_PATH.$folder_name.'/'.$old_image);
							@unlink(UPLOAD_PATH.$folder_name.'/thumbs/'.$old_image);
							@unlink(UPLOAD_PATH.$folder_name.'/smallthumbs/'.$old_image);
						}	
							
						
					}
						if (count($del_arr)>0){
					//print_r($del_arr); exit;

					$del_str = implode(',',$del_arr);
					
					$delete_sql = $wpdb->prepare( "DELETE from ".TBL." where ".$primary_key."  in (".$del_str.")");
					$wpdb->query( $delete_sql );
					
				}
					
				}
				
			}
			
			wp_redirect("admin.php?page=".$page_name."&del=1");
			break;
			
			case 'ordering':
			if ($_POST["orderval"]!=''){
				$arr_order=explode(",",$_POST["orderval"]);
				for($i=0;$i<count($arr_order);$i++) {
					if($arr_order[$i]!="") {
						$data = array(
							'ordering' => ($i+1)
						);
						$where = array(
							$primary_key => $arr_order[$i]
						);
						$wpdb->update( TBL, $data, $where, '%d', '%d' );
						//$wpdb->print_error();
						//print_r($_REQUEST);
						//exit;
					}
				}
			}
			
			wp_redirect("admin.php?page=".$page_name."&ord=1&category=".$_REQUEST['category']);
			
			break;
	     
	} // end of switch case 
	
?>
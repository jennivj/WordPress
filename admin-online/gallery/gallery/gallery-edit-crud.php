<?php
//echo "<pre>";
//  print_r($_REQUEST);

	 require("seofun.php");	 
	 $action=$_REQUEST["hidAction1"];
	 $gallery_count=$_REQUEST['gallery_count'];  
	 
	  include(PLUGIN_PATH."inc/classes/image.class.php");
		 
		  // server side validation//
	  function gallery_validation(){
		if (trim($_POST["txtBeforeImageTitle_1"])==''){
			return 'Please fill in Before Image Title.';
		}
		/*if (trim($_POST["before_image_1"])==''){
			return 'Please upload Before Image.';
		}*/
		if (trim($_POST["txtAfterImageTitle_1"])==''){
			return 'Please fill in After Image Title.';
		}
		/*if (trim($_POST["after_image_1"])==''){
			return 'Please upload After Image.';
		}*/
		return 1;
	 }
	 


	// server side validation// 
	 switch($action){
				
		 case 'editgal':
		 	$validation_function = $page_name.'_validation';
		 	$validation_status = $validation_function();
			if ($validation_status != 1){
	
				$alert = $validation_status;
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}
		/*	$dup = $wpdb->get_var( $wpdb->prepare( "SELECT count(*)  from " .TBL." WHERE title = %s AND   ".$primary_key." <> %s ", trim($_POST["txtMainTitle"]), $_POST[$primary_key]  ) ); 
			if($dup > 0) {
				$alert = 'This '.$entity .' already exists.';
				include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
				exit();
			}*/
									   
									        //code start for  image Upload
											if (trim($_FILES['before_image_1']['name']) != '' || trim($_FILES['after_image_1']['name']) != ''  ){//image uploading
											
											if (trim($_FILES['before_image_1']['name']) != '')
											{
											
											$before_image 		= new Image($_FILES['before_image_1']['tmp_name']);
											$before_thumb_image 	= new Image($_FILES['before_image_1']['tmp_name']); 											
											$before_medium_image 	= new Image($_FILES['before_image_1']['tmp_name']);
											}
											
											if (trim($_FILES['after_image_1']['name']) != ''){
											
											$after_thumb_image 	= new Image($_FILES['after_image_1']['tmp_name']); 
											$after_image 	= new Image($_FILES['after_image_1']['tmp_name']); 
											$after_medium_image 	= new Image($_FILES['after_image_1']['tmp_name']); 
											
											}
											
												//$productImage_thumb_detailpage = new Image($_FILES['product_image']['tmp_name']);
												$valid_image_types = array(1,2,3);
											
												if (trim($_FILES['before_image_1']['name']) != '')
												{		
											if (!in_array($before_image->info['image_type'],$valid_image_types) || $_FILES['before_image_1']['size']<=0){
													$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
													include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
													exit();
												}
												
												}
												
														if (trim($_FILES['after_image_1']['name']) != ''){	
											if (!in_array($after_image->info['image_type'],$valid_image_types) || $_FILES['after_image_1']['size']<=0){
													$alert = 'Uploaded image is corrupted or the image type is not allowed or Image size Exceeds the Limit';
													include(PLUGIN_PATH.$folder_name.'/'.$page_name.'_add_edit.php');
													exit();
												}}
												
														//delete the old image
														
/*														echo "select before_image from ". TBL ." where gallery_id = %s", trim($_POST['gallery_id']); exit;
*/													
											$old_before_image = trim( $wpdb->get_var( $wpdb->prepare( "select before_image from ". TBL ." where gallery_id = %s", trim($_POST['gallery_id']) ) ) );
											$old_after_image = trim( $wpdb->get_var( $wpdb->prepare( "select after_image from ". TBL ." where gallery_id = %s", trim($_POST['gallery_id']) ) ) );
												
												
												
												$beforeImage_name = rand().time().$_FILES['before_image_1']['name']; 
												$afterImage_name = rand().time().$_FILES['after_image_1']['name']; 
												
											//after_medium	
												 $source_path_before =$_FILES['before_image_1']['tmp_name']; 
												 $source_path_after =$_FILES['after_image_1']['tmp_name'];
												
												if (trim($_FILES['before_image_1']['name']) != '' && file_exists(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image))
											    {
												
												$before_image->resize(361,217);
												$before_image->save(UPLOAD_PATH.$folder_name.'/before/'.$beforeImage_name );
												unlink(UPLOAD_PATH.$folder_name.'/before/'.$old_before_image);
												
												$before_medium_image->resize(172,190);
												$before_medium_image->save(UPLOAD_PATH.$folder_name.'/before_medium/'.$beforeImage_name );
												unlink(UPLOAD_PATH.$folder_name.'/before_medium/'.$old_before_image);
												
												
										$before_thumb_image->resize(105,64);
										$before_thumb_image->save(UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name );
												
												//$dest_before_thumb=UPLOAD_PATH.$folder_name.'/before_thumb/'.$beforeImage_name;									
												//cropImages($source_path_before,$dest_before_thumb,105,64);
												unlink(UPLOAD_PATH.$folder_name.'/before_thumb/'.$old_before_image);
												}
												
												if (trim($_FILES['after_image_1']['name']) != '' && file_exists(UPLOAD_PATH.$folder_name.'/after/'.$old_after_image))
												{
												
												
												$after_image->resize(361,217);
												$after_image->save(UPLOAD_PATH.$folder_name.'/after/'.$afterImage_name );
												unlink(UPLOAD_PATH.$folder_name.'/after/'.$old_after_image);
												
												
												$after_medium_image->resize(172,190);
												$after_medium_image->save(UPLOAD_PATH.$folder_name.'/after_medium/'.$afterImage_name );
												unlink(UPLOAD_PATH.$folder_name.'/after_medium/'.$old_after_image);
												
												
								$after_thumb_image->resize(105,64);
								$after_thumb_image->save(UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name );
												
												//$dest_after_thumb=UPLOAD_PATH.$folder_name.'/after_thumb/'.$afterImage_name;
												//cropImages($source_path_after,$dest_after_thumb,105,64);
												unlink(UPLOAD_PATH.$folder_name.'/after_thumb/'.$old_after_image);
												}
											}
											
											else
											{
												$beforeImage_name  = $_POST['hidbefore_image'];
												$afterImage_name  = $_POST['hidafter_image'];
											}	
												
										//code start for  image Upload
										
								if (trim($_FILES['before_image_1']['name']) == '')
										{
										
									$resultgal = mysql_query("select before_image,before_image_thumb from tbl_gallery where gallery_id='".$_POST['gallery_id']."' ");
									$rowgal = mysql_fetch_row($resultgal);
									
									//echo "loop1";
									//print_r($rowgal);
									$beforeImage_name = $rowgal[0];
								
										}
										
								if (trim($_FILES['after_image_1']['name']) == '')
										{
																	
									
									$resultgal = mysql_query("select after_image,after_image_thumb from tbl_gallery where gallery_id='".$_POST['gallery_id']."' ");
									$rowgal = mysql_fetch_row($resultgal);
									//echo "loop2";
									//print_r($rowgal);
									$afterImage_name = $rowgal[0];
								
										
										}		
										
										
										
										
														
												
												$data = array(	
												            'gallery_main_id' 		 	=> $_POST['hidgal_main_id'],
															'before_imagetitle' 		 	=> $_POST['txtBeforeImageTitle_1'],
											                'before_imagealt'               => $_POST['txtBeforeImageAlt_1'],
															'before_image' 		=> $beforeImage_name,
															'before_image_thumb' 		=> $beforeImage_name,
															'after_imagetitle' 				=> $_POST['txtAfterImageTitle_1'],
											                'after_imagealt'               => $_POST['txtAfterImageAlt_1'],
															'after_image' 				=> $afterImage_name,
															'after_image_thumb' 				=> $afterImage_name
														);
														
													
													/*echo "<pre>";
													print_r($data);
													exit();*/
																																					
																																						
														$data_format = array('%d','%s','%s','%s','%s','%s','%s','%s','%s');
														
														/*$where = array(
																	$primary_key => $_POST[$primary_key]
																);*/
														$where = array(
																	$primary_key_edit => $_POST['gallery_id']
																);		
																
															
														$wpdb->update('tbl_gallery',$data,$where,$data_format,'%d' );
														
													    //$wpdb->print_error(); exit;
														
	       // wp_redirect("admin.php?page=".$page_name."&upd=1");
			wp_redirect("admin.php?page=".$page_name."&gallery_main_id=".$_POST['hidgal_main_id']."&upd=1&option=add");
			
			
			
			break;
                                        
			}		   
	
			
	     

	
?>


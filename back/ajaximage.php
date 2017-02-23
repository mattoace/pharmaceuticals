<?php
require_once("../application/config/configRaw.php");
session_start();
$session_id='1'; //$session id
$path = "uploads/";

	$valid_formats = array("jpg", "png", "gif", "bmp");
	if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST")
		{
			$name = $_FILES['photoimg']['name'];
			$size = $_FILES['photoimg']['size'];
			
			if(strlen($name))
				{
					 list($txt, $ext) = explode(".", $name);
					//if(in_array($ext,$valid_formats))
					//{
					//if($size<(1024*1024))
						//{
							$actual_image_name = time().substr(str_replace(" ", "_", $txt), 5).".".$ext;
                                                        
							$tmp = $_FILES['photoimg']['tmp_name'];
                                                        
                                                        //var_dump($actual_image_name); exit();
                                                        
							if(move_uploaded_file($tmp, $path.$actual_image_name))
								{
                                                                if(mysql_query("DELETE FROM ems_imgtmp")){
                                                                    
                                                                    //$imgPath = "/ems/ci/application/controllers/back/uploads/".$actual_image_name;
                                                                    $imgPath = "/back/uploads/".$actual_image_name;
                                                                    
                                                                    mysql_query("INSERT INTO ems_imgtmp(`image`,`image_name`) VALUES('".$imgPath."','".$actual_image_name."')");
                                                                    echo "<img height='150' width='150' src='".$imgPath."'  class='preview'>";
                                                                };									
							       
								}
							else
								echo "failed";
						//}
						//else
						//echo "Image file size max 1 MB";					
						//}
						//else
						//echo "Invalid file format..";	
				}
				
			else
				echo "Please select image..!";
				
			exit;
		}
?>
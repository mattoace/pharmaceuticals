<?php
ini_set('display_errors',0);
require_once("../application/config/configRaw.php");
date_default_timezone_set('Europe/London');
require_once 'PHPExcel/IOFactory.php'; 
require_once 'PHPExcel.php';  

    class ImportDatabase{
        
        public $parameter;
        public $type;
        public $inst; 


       function __construct($parameter,$type,$inst) {
          $this->parameter = $parameter;
          $this->type = $type;
          $this->inst = $inst;           
       }
       

		function convertDateTimeStamp($dateValue = 0, $ExcelBaseDate=0) {
		    
		    if ($ExcelBaseDate == 0) {
		        $myExcelBaseDate = 25569;
		        
		        if ($dateValue < 60) {
		            --$myExcelBaseDate;
		        }
		    } else {
		        $myExcelBaseDate = 24107;
		    }

		    // Perform conversion
		    if ($dateValue >= 1) {
		        $utcDays = $dateValue - $myExcelBaseDate;
		        $returnValue = round($utcDays * 86400);
		        if (($returnValue <= PHP_INT_MAX) && ($returnValue >= -PHP_INT_MAX)) {
		            $returnValue = (integer) $returnValue;
		        }
		    } else {
		        $hours = round($dateValue * 24);
		        $mins = round($dateValue * 1440) - round($hours * 60);
		        $secs = round($dateValue * 86400) - round($hours * 3600) - round($mins * 60);
		        $returnValue = (integer) gmmktime($hours, $mins, $secs);
		    }
		    // Return
		    return $returnValue;
		}

      function saveMarks($inst,$class_id,$stream_id,$exam_id,$subject_id,$term_id){  


			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objReader->setReadDataOnly(true);

			$objPHPExcel = $objReader->load($this->parameter);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$highestRow = $objWorksheet->getHighestRow(); 
			$highestColumn = $objWorksheet->getHighestColumn(); 

			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 

			$rows = array();
			
			
			for ($row = 2; $row <= $highestRow; ++$row) {
   
				  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
					  
					$rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
					
					switch($objWorksheet->getCellByColumnAndRow($col, $row-1)->getValue()){
						case 'Student ID':$student_id = $col; break;
						//case 'Class ID': $class_id = $col; break;
						//case 'Stream ID': $stream_id = $col;break;        
						//case 'Exam ID': $exam_id = $col;break;
						//case 'Subject ID': $subject_id = $col;break;
						//case 'Term ID': $term_id = $col;break;
						case 'Marks': $marks = $col;break;						
					} 
				  }	

				 $marks  = ($rows[$marks]) ? $rows[$marks]: 0;
				 $exam_id = ($exam_id) ? $exam_id : 0;
				 $class_id  = ($class_id) ? $class_id: 0;
				 $stream_id  = ($stream_id) ? $stream_id: 0;
				 $subject_id = ($subject_id) ? $subject_id : 0;
				 $term_id = ($term_id) ? $term_id : 0;
				 $student_id = ($rows[$subject_id]) ? $rows[$student_id] : 0;

				  
				  $sqlInsert = "INSERT INTO ems_marks(`marks`,`exam_id`,`class_id`,`stream_id`,`subject_id`,`term_id`,`student_id`)
				   VALUES('".$marks."','".$exam_id."','".$class_id."','".$stream_id."','".$subject_id."','".$term_id."','".$student_id."')       
				  "; 

				  if(mysql_query($sqlInsert)){
					  $response = "Successfully saved!";  
				  }else{
					  $response = $sqlInsert ." - ".mysql_error()."<br>";
				  }

				  var_dump($response );
				}		
	    return $response;
      } 

     
       function saveInstitutions()
       { 
	   
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objReader->setReadDataOnly(true);

			$objPHPExcel = $objReader->load($this->parameter);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$highestRow = $objWorksheet->getHighestRow(); 
			$highestColumn = $objWorksheet->getHighestColumn(); 

			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 

			$rows = array();
			
			
			for ($row = 2; $row <= $highestRow; ++$row) {
   
				  for ($col = 0; $col <= $highestColumnIndex; ++$col) {
					  
					$rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
					
					switch($objWorksheet->getCellByColumnAndRow($col, $row-1)->getValue()){
						case 'Institution Name':$institution_name = $col; break;
						case 'Town': $town = $col; break;
						case 'Latitude': $latitude = $col;break;        
						case 'Longitude': $longitude = $col;break;
						case 'Address': $address = $col;break;
						case 'Telephone': $telephone = $col;break;
						case 'Email': $email = $col;break;
						case 'Principal': $principal = $col;break;						
						case 'Founded Date': $founded_date = $col;break;
						case 'Total Population': $total_population = $col;break;
						case 'County': $county = $col;break;
						case 'Sub County': $sub_county = $col;break;
						case 'District': $district = $col;break;
					} 
				  }	

			 $latitude  = ($rows[$latitude]) ? $rows[$latitude]: 0;
			 $longitude = ($rows[$longitude]) ? $rows[$longitude] : 0;

			 $timestamp = $this->convertDateTimeStamp($rows[$founded_date]);
			 $mysqlDate = date('Y-m-d', $timestamp);

			 $county  = ($rows[$county]) ? $rows[$county]: 0;
			 $sub_county  = ($rows[$sub_county]) ? $rows[$sub_county]: 0;
			 $district  = ($rows[$district]) ? $rows[$district]: 0;


				  
				  $sqlInsert = "INSERT INTO ems_institution(`institution_name`,`town`,`latitude`,`longitude`,`address`,`telephone`,`email`,`principal`,`type`,`founded_date`,`total_population`,`county`,`subcounty`,`district`)
				   VALUES('".$rows[$institution_name]."','".$rows[$town]."','".$latitude."','".$longitude."','".$rows[$address]."','".$rows[$telephone]."','".$rows[$email]."','".$rows[$principal]."','".$this->type."','".$mysqlDate."','".$rows[$total_population]."','".$county."','".$sub_county."','".$district."')       
				  "; 				  
				  if(mysql_query($sqlInsert)){
					$response = "Successfully saved!";  
				  }else{
					  $response = $sqlInsert ." - ".mysql_error()."<br>";
				  }
				}		
	    return $response;
       }
       
       
      function saveStudents()
       { 
	   
			$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			$objReader->setReadDataOnly(true);

			$objPHPExcel = $objReader->load($this->parameter);
			$objWorksheet = $objPHPExcel->getActiveSheet();

			$highestRow = $objWorksheet->getHighestRow(); 
			$highestColumn = $objWorksheet->getHighestColumn(); 

			$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 

			$rows = array();
			
			
			for ($row = 2; $row <= $highestRow; ++$row) {

				for ($col = 0; $col <= $highestColumnIndex; ++$col) {
				  
					$rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
					
					switch($objWorksheet->getCellByColumnAndRow($col, $row-1)->getValue()){
                                                case 'First Name': $fname = $col; break;
						case 'Middle Name': $mname = $col; break;
						case 'Last Name': $lname = $col;break;        
						case 'Address': $address = $col;break;
						case 'Is Active': $active = $col;break;
						case 'Type': $type = $col;break;
						case 'Telephone': $telephone = $col;break;
						case 'Mobile': $mobile = $col;break;						
						case 'Email': $email = $col;break;
						case 'Date Of Registration': $dor = $col;break;
						case 'National Id': $national_id = $col;break;
						case 'Date Of Birth': $dob = $col;break;
						case 'Town': $town = $col;break;
                                                case 'Country': $country = $col;break;						
						case 'M/F': $gender = $col;break;
						case 'Student Reg': $stude_reg = $col;break;
						case 'Is Border': $is_border = $col;break;
						case 'Is Discontinue': $discontinue = $col;break;
						case 'Initials': $initials = $col;break;
                                                case 'Institution Type': $inst_type = $col;break;
						case 'Institution': $inst = $col;break;
                                                default: break;
						
					} 
				  }	

			 $type  = ($rows[$type]) ? $rows[$type]: 0;
			 $active = ($rows[$active]) ? $rows[$active] : 0;
                         $is_border  = ($rows[$is_border]) ? $rows[$is_border]: 0;
			 $discontinue  = ($rows[$discontinue]) ? $rows[$discontinue]: 0;
			 //$gender  = ($rows[$gender]) ? $rows[$gender]: 1;
			 $timestamp1 = $this->convertDateTimeStamp($rows[$dob]);
			 $mysqlDate_dob = date('Y-m-d', $timestamp1);                         
                         $timestamp2 = $this->convertDateTimeStamp($rows[$dor]);
			 $mysqlDate_dor = date('Y-m-d', $timestamp2);

				  
                    $sqlInsert = "INSERT INTO ems_person(`fname`,`mname`,`lname`,`address`,`active`,`type`,`telephone`,`mobile`,`email`,`dor`,`nationalid`,`dob`,`town`,`country`,`gender`,`stud_reg`,`is_border`,`is_discontinue`,`initials`,`institution_type`,`institution`)
                     VALUES('".$rows[$fname]."','".$rows[$mname]."','".$rows[$lname]."','".$rows[$address]."','".$active."','".$type."','".$rows[$telephone]."','".$rows[$mobile]."','".$rows[$email]."','".$mysqlDate_dor."','".$rows[$national_id]."','".$mysqlDate_dob."','".$rows[$town]."','".$rows[$country]."','".$gender."','".$rows[$stude_reg]."','".$is_border."','".$discontinue."','".$rows[$initials]."','".$this->inst."','".$this->type."')       
                    "; 				  
				
                    //echo $sqlInsert . "<br>"; 
                    
                    
                    if(mysql_query($sqlInsert)){
					$response = "Successfully saved!";  
				  }else{
					  $response = $sqlInsert ." - ".mysql_error()."<br>";
                                          var_dump(mysql_error()); 
				  }
                                   
				}
                                
                             
	    return $response;
       }
         

    }

    //$fn = new ImportDatabase('uploads/ExcellStudents.xlsx' , 1 , 1);//ExcelStudents.xlsx
    //echo json_encode(array("response"=>$fn->saveStudents()));  
?>

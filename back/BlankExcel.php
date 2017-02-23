<?php
	ini_set('display_errors',-1);
	require_once("../application/config/configRaw.php");
	date_default_timezone_set('Europe/London');
	require_once 'PHPExcel/IOFactory.php'; 
	require_once 'PHPExcel.php';  

	$instId = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
	$classId = filter_input(INPUT_GET, 'class_id', FILTER_SANITIZE_NUMBER_INT);
	$streamId = filter_input(INPUT_GET, 'stream_id', FILTER_SANITIZE_NUMBER_INT);

    // Create your database query
	$query = "
	SELECT * FROM ems_person p , ems_studentclasses esc
	WHERE esc.student_id = p.id
	AND esc.class_id = '".$classId."'
	";
	 if($streamId > 0) $query .= " AND esc.stream_id =  '".$streamId."'";  

	// Execute the database query
	$result = mysql_query($query) or die(mysql_error());

	// Instantiate a new PHPExcel object
	$objPHPExcel = new PHPExcel(); 
	// Set the active Excel worksheet to sheet 0
	$objPHPExcel->setActiveSheetIndex(0); 
	// Initialise the Excel row number

   $objPHPExcel->getActiveSheet()->SetCellValue('A1','Student ID'); 
   $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Marks'); 

	$rowCount = 2; 
	// Iterate through each result from the SQL query in turn
	// We fetch each database result row into $row in turn
	while($row = mysql_fetch_array($result)){ 
	    // Set cell An to the "name" column from the database (assuming you have a column called name)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, $row['id']); 
	    // Set cell Bn to the "age" column from the database (assuming you have a column called age)
	    //    where n is the Excel row number (ie cell A1 in the first row)
	    //$objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowCount, $row['age']); 
	    // Increment the Excel row counter
	    $rowCount++; 
	}
	// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
	$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
	// Write the Excel file to filename some_excel_file.xlsx in the current directory
	$objWriter->save('uploads/BlankStudentMarksSheet.xlsx'); 

	header("Location: /back/uploads/BlankStudentMarksSheet.xlsx");




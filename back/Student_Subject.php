<?php
include( "php/DataTables.php" );
$classid = filter_input(INPUT_GET, 'classId', FILTER_SANITIZE_NUMBER_INT);
$inst = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
//$streamId = filter_input(INPUT_GET, 'streamId', FILTER_SANITIZE_NUMBER_INT);
$streamId = $_GET['streamId'];
$subjectId = filter_input(INPUT_GET, 'subjectId', FILTER_SANITIZE_NUMBER_INT);

$actionId = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_NUMBER_INT);

use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;


switch($actionId){
    
    case 1:
        
        if($streamId > 0){
       
            Editor::inst( $db, 'ems_person' )
                    ->fields(
                            Field::inst( 'ems_person.fname' )->validator( 'Validate::notEmpty' ),
                            Field::inst( 'ems_person.mname' )->validator( 'Validate::notEmpty' ),
                            Field::inst( 'ems_person.lname' ),
                            Field::inst( 'ems_person.address' ),
                            Field::inst( 'ems_person.active' ),                
                            Field::inst( 'ems_person.gender' ),             
                            //Field::inst( 'e1.itemname' ),                
                            //Field::inst( 'e2.itemname' ),                
                            Field::inst( 'ems_person.town' ),
                            Field::inst( 'ems_person.country')->options('ems_countries','id','country_name'),
                            Field::inst( 'ems_person.is_border' ),
                            Field::inst( 'ems_person.is_discontinue' ), 
                            Field::inst( 'ems_person.type' ),                
                            Field::inst( 'ems_person.institution'),
                            Field::inst( 'ems_person.institution_type' ),
                            Field::inst( 'ems_person.telephone' ),
                            Field::inst( 'ems_person.mobile' ),
                            Field::inst( 'ems_person.email' )
                                    ->validator( 'Validate::email' )
                                    ->setFormatter( 'Format::ifEmpty', null ),
                            Field::inst( 'ems_person.nationalid' )
                                    ->validator( 'Validate::numeric' )
                                    ->setFormatter( 'Format::ifEmpty', null ),
                            Field::inst( 'ems_person.dor' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),                

                              Field::inst( 'ems_person.dob' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),

                              Field::inst( 'ems_person.doc' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )

                    )
                    ->leftJoin( 'ems_studentclasses e1', 'e1.student_id', '=', 'ems_person.id' )->where( 'e1.class_id',$classid)
                    ->leftJoin( 'ems_studentsubject e2', 'e2.student_id', '=', 'ems_person.id' )
                    ->where( 'e1.institution_id', $inst ) 
                    ->where( 'ems_person.institution', $inst )
                    ->where( 'e1.stream_id',$streamId)
                    ->where( 'e2.subject_id',$subjectId)
                    ->process( $_POST )
                    ->json();   


             }else{

            Editor::inst( $db, 'ems_person' )
                    ->fields(
                            Field::inst( 'ems_person.fname' )->validator( 'Validate::notEmpty' ),
                            Field::inst( 'ems_person.mname' )->validator( 'Validate::notEmpty' ),
                            Field::inst( 'ems_person.lname' ),
                            Field::inst( 'ems_person.address' ),
                            Field::inst( 'ems_person.active' ),                
                            Field::inst( 'ems_person.gender' ),             
                            //Field::inst( 'e1.itemname' ),                
                            //Field::inst( 'e2.itemname' ),                
                            Field::inst( 'ems_person.town' ),
                            Field::inst( 'ems_person.country')->options('ems_countries','id','country_name'),
                            Field::inst( 'ems_person.is_border' ),
                            Field::inst( 'ems_person.is_discontinue' ), 
                            Field::inst( 'ems_person.type' ),                
                            Field::inst( 'ems_person.institution'),
                            Field::inst( 'ems_person.institution_type' ),
                            Field::inst( 'ems_person.telephone' ),
                            Field::inst( 'ems_person.mobile' ),
                            Field::inst( 'ems_person.email' )
                                    ->validator( 'Validate::email' )
                                    ->setFormatter( 'Format::ifEmpty', null ),
                            Field::inst( 'ems_person.nationalid' )
                                    ->validator( 'Validate::numeric' )
                                    ->setFormatter( 'Format::ifEmpty', null ),
                            Field::inst( 'ems_person.dor' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),                

                              Field::inst( 'ems_person.dob' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),

                              Field::inst( 'ems_person.doc' )
                                    ->validator( 'Validate::dateFormat', array(
                                            "format"  => Format::DATE_ISO_8601,
                                            "message" => "Please enter a date in the format yyyy-mm-dd"
                                    ) )
                                    ->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
                                    ->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )

                    )
                    ->leftJoin( 'ems_studentclasses e1', 'e1.student_id', '=', 'ems_person.id' )->where( 'e1.class_id',$classid)
                    ->leftJoin( 'ems_studentsubject e2', 'e2.student_id', '=', 'ems_person.id' )
                    ->where( 'e1.institution_id', $inst ) 
                    ->where( 'ems_person.institution', $inst )
                    ->where( 'e2.subject_id',$subjectId)
                    ->process( $_POST )
                    ->json();   


             }

        
    break;
    default:
     if($streamId > 0){
     Editor::inst( $db, 'ems_person' )
	->fields(
                Field::inst( 'ems_person.id' ),
		Field::inst( 'ems_person.fname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_person.mname' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'ems_person.lname' ),
		Field::inst( 'ems_person.address' ),
		Field::inst( 'ems_person.active' ),                
                Field::inst( 'ems_person.gender' ),             
                //Field::inst( 'e2.subject_id' ),
                //Field::inst( 'e2.student_id' ),
                //Field::inst( 'e2.itemname' ),                
                Field::inst( 'ems_person.town' ),
                Field::inst( 'ems_person.country')->options('ems_countries','id','country_name'),
                Field::inst( 'ems_person.is_border' ),
                Field::inst( 'ems_person.is_discontinue' ), 
                Field::inst( 'ems_person.type' ),                
                Field::inst( 'ems_person.institution'),
                Field::inst( 'ems_person.institution_type' ),
                Field::inst( 'ems_person.telephone' ),
		Field::inst( 'ems_person.mobile' ),
		Field::inst( 'ems_person.email' )
			->validator( 'Validate::email' )
			->setFormatter( 'Format::ifEmpty', null ),
		Field::inst( 'ems_person.nationalid' )
			->validator( 'Validate::numeric' )
			->setFormatter( 'Format::ifEmpty', null ),
		Field::inst( 'ems_person.dor' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),                
                
                  Field::inst( 'ems_person.dob' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
                
                  Field::inst( 'ems_person.doc' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
                
	)         

        ->leftJoin( 'ems_studentclasses e1', 'e1.student_id', '=', 'ems_person.id' )->where( 'e1.class_id',$classid)
        
        //->leftJoin( 'ems_studentsubject e2', 'e1.student_id', '=', 'ems_person.id' )//->where('e2.subject_id',$subjectId,'!=')  
        
        ->where( 'e1.institution_id', $inst )     
        
        ->where( 'e1.stream_id',$streamId) 
        
        ->where( 'ems_person.institution', $inst ) 
        
	->process( $_POST )
	->json();
    
 }else{

Editor::inst( $db, 'ems_person' )
	->fields(
		Field::inst( 'ems_person.fname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_person.mname' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'ems_person.lname' ),
		Field::inst( 'ems_person.address' ),
		Field::inst( 'ems_person.active' ),                
                Field::inst( 'ems_person.gender' ),             
                //Field::inst( 'e1.itemname' ),                
                //Field::inst( 'e2.itemname' ),                
                Field::inst( 'ems_person.town' ),
                Field::inst( 'ems_person.country')->options('ems_countries','id','country_name'),
                Field::inst( 'ems_person.is_border' ),
                Field::inst( 'ems_person.is_discontinue' ), 
                Field::inst( 'ems_person.type' ),                
                Field::inst( 'ems_person.institution'),
                Field::inst( 'ems_person.institution_type' ),
                Field::inst( 'ems_person.telephone' ),
		Field::inst( 'ems_person.mobile' ),
		Field::inst( 'ems_person.email' )
			->validator( 'Validate::email' )
			->setFormatter( 'Format::ifEmpty', null ),
		Field::inst( 'ems_person.nationalid' )
			->validator( 'Validate::numeric' )
			->setFormatter( 'Format::ifEmpty', null ),
		Field::inst( 'ems_person.dor' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),                
                
                  Field::inst( 'ems_person.dob' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 ),
                
                  Field::inst( 'ems_person.doc' )
			->validator( 'Validate::dateFormat', array(
				"format"  => Format::DATE_ISO_8601,
				"message" => "Please enter a date in the format yyyy-mm-dd"
			) )
			->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
			->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
                
	)
        ->leftJoin( 'ems_studentclasses e1', 'e1.student_id', '=', 'ems_person.id' )->where( 'e1.class_id',$classid)
        //->leftJoin( 'ems_studentsubject e2', 'e2.student_id', '=', 'ems_person.id' )->where('e2.subject_id',$subjectId,'!=') 
        ->where( 'e1.institution_id', $inst ) 
        ->where( 'ems_person.institution', $inst ) 
        
	->process( $_POST )
	->json(); 
     
 }


        
    break;
}







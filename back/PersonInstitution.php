<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$inst = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
$case = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_NUMBER_INT);

use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;



switch($case){

case 1:

$studentId = filter_input(INPUT_GET, 'student_id', FILTER_SANITIZE_NUMBER_INT);

Editor::inst( $db, 'ems_person' )
	->fields(
		Field::inst( 'ems_person.fname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_person.mname' )->validator( 'Validate::notEmpty' ),
                Field::inst( 'ems_person.lname' ),
		Field::inst( 'ems_person.address' ),
		Field::inst( 'ems_person.active' ),                
                Field::inst( 'ems_person.gender' ),             
                Field::inst( 'e1.country_name' ),                
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


	->leftJoin( 'ems_countries e1', 'e1.id', '=', 'ems_person.country' ) 
        
    ->where( 'ems_person.institution', $inst )
    ->where( 'ems_person.id',$studentId )           
	->process( $_POST )
	->json();
break;
default:
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
        
     ->where( 'ems_person.institution', $inst )         
	->process( $_POST )
	->json();                                                                                                           
break;
}


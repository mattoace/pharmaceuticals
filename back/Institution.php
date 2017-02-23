<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$institution = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
error_reporting(0);
// Alias Editor classes so they are easy to use
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

switch($_GET['is_admin']){
	case 1:
	// Build our Editor instance and process the data coming from _POST
	Editor::inst( $db, 'ems_institution' )
		->fields(
			Field::inst( 'ems_institution.institution_name' )->validator( 'Validate::notEmpty' ),
			Field::inst( 'ems_institution.district' )->options('ems_district','id','district_name')->validator( 'Validate::notEmpty' ),
	                Field::inst( 'ems_institution.county' )->options('ems_county','id','county_name'),
	                Field::inst( 'ems_institution.subcounty' )->options('ems_subcounty','id','sub_countyname'),
			Field::inst( 'ems_institution.address' ),
			Field::inst( 'ems_institution.town' ),
	                Field::inst( 'ems_county.county_name' ),
	                Field::inst( 'ems_district.district_name' ),
	                Field::inst( 'ems_subcounty.sub_countyname' ),
	                Field::inst( 'ems_institution.type' ),
			Field::inst( 'ems_institution.email' ),
			Field::inst( 'ems_institution.telephone' )
				->validator( 'Validate::numeric' )
				->setFormatter( 'Format::ifEmpty', null ),
			Field::inst( 'ems_institution.total_population' )
				->validator( 'Validate::numeric' )
				->setFormatter( 'Format::ifEmpty', null ),
			Field::inst( 'ems_institution.founded_date' )
				->validator( 'Validate::dateFormat', array(
					"format"  => Format::DATE_ISO_8601,
					"message" => "Please enter a date in the format yyyy-mm-dd"
				) )
				->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
				->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
		) 
	        
	        ->leftJoin( 'ems_county', 'ems_county.id', '=', 'ems_institution.county')
	        ->leftJoin( 'ems_district', 'ems_district.id', '=', 'ems_institution.district')
	        ->leftJoin( 'ems_subcounty', 'ems_subcounty.id', '=', 'ems_institution.subcounty')
	        
	       /* ->join(
	        Mjoin::inst('ems_institutiontype' )
	            ->link( 'ems_institution.type','ems_institutiontype.id' )
	            ->fields( 
	                     Field::inst( 'id' ),
	                     Field::inst( 'institution_name' )
	                    )
	         )*/
	        
	        ->where( 'type', $id )
	        
		->process( $_POST )
		->json();

	break;
	default:
	// Build our Editor instance and process the data coming from _POST
	Editor::inst( $db, 'ems_institution' )
		->fields(
			Field::inst( 'ems_institution.institution_name' )->validator( 'Validate::notEmpty' ),
			Field::inst( 'ems_institution.district' )->options('ems_district','id','district_name')->validator( 'Validate::notEmpty' ),
	                Field::inst( 'ems_institution.county' )->options('ems_county','id','county_name'),
	                Field::inst( 'ems_institution.subcounty' )->options('ems_subcounty','id','sub_countyname'),
			Field::inst( 'ems_institution.address' ),
			Field::inst( 'ems_institution.town' ),
	                Field::inst( 'ems_county.county_name' ),
	                Field::inst( 'ems_district.district_name' ),
	                Field::inst( 'ems_subcounty.sub_countyname' ),
	                Field::inst( 'ems_institution.type' ),
			Field::inst( 'ems_institution.email' ),
			Field::inst( 'ems_institution.telephone' )
				->validator( 'Validate::numeric' )
				->setFormatter( 'Format::ifEmpty', null ),
			Field::inst( 'ems_institution.total_population' )
				->validator( 'Validate::numeric' )
				->setFormatter( 'Format::ifEmpty', null ),
			Field::inst( 'ems_institution.founded_date' )
				->validator( 'Validate::dateFormat', array(
					"format"  => Format::DATE_ISO_8601,
					"message" => "Please enter a date in the format yyyy-mm-dd"
				) )
				->getFormatter( 'Format::date_sql_to_format', Format::DATE_ISO_8601 )
				->setFormatter( 'Format::date_format_to_sql', Format::DATE_ISO_8601 )
		) 
	        
	        ->leftJoin( 'ems_county', 'ems_county.id', '=', 'ems_institution.county')
	        ->leftJoin( 'ems_district', 'ems_district.id', '=', 'ems_institution.district')
	        ->leftJoin( 'ems_subcounty', 'ems_subcounty.id', '=', 'ems_institution.subcounty')
	        
	       /* ->join(
	        Mjoin::inst('ems_institutiontype' )
	            ->link( 'ems_institution.type','ems_institutiontype.id' )
	            ->fields( 
	                     Field::inst( 'id' ),
	                     Field::inst( 'institution_name' )
	                    )
	         )*/
	        
	        ->where( 'type', $id )
	        ->where( 'ems_institution.id', $institution )
		->process( $_POST )
		->json();
	break;
}







//ref : https://editor.datatables.net/manual/php/conditions
<?php
include( "php/DataTables.php" );
$countyId = filter_input(INPUT_GET, 'countyId', FILTER_SANITIZE_STRING);
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;
Editor::inst( $db, 'ems_district' )
	->fields(		
		Field::inst( 'ems_county.id' ),
		Field::inst( 'ems_county.county_name' )
	)
        
         ->leftJoin( 'ems_county', 'ems_county.id', '=', 'ems_district.county')
         ->where( 'ems_district.id', $countyId )
	 ->process( $_GET )
	 ->json();

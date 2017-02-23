<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$inst = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

switch($_GET['is_admin']){
case 1:
Editor::inst( $db, 'ems_institution' )
	->fields(		
		Field::inst( 'id' ),
		Field::inst( 'institution_name' )
	)->where( 'type', $id )
	->process( $_POST )
	->json();
break;
default:
Editor::inst( $db, 'ems_institution' )
	->fields(		
		Field::inst( 'id' ),
		Field::inst( 'institution_name' )
	)->where( 'type', $id )
	->where( 'id', $inst )
	->process( $_POST )
	->json();
break;

}




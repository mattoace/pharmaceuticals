<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

Editor::inst( $db, 'ems_examtypes' )
	->fields(
		Field::inst( 'id' ),
		Field::inst( 'exam_description' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'marked_outof' )->validator( 'Validate::notEmpty' )
	)        
	->process( $_POST )
	->json();

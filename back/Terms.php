<?php
include( "php/DataTables.php" );
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

Editor::inst( $db, 'ems_terms' )
	->fields(
		Field::inst( 'term_name' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'description')
	)        
	->process( $_POST )
	->json();

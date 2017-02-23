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

Editor::inst( $db, 'ems_smtp' )
	->fields(
		Field::inst( 'host' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'port' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'ems_smtp.username' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'pass' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'default_from_email' )->validator( 'Validate::email' ),
        Field::inst( 'default_from_email_password' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'default_from_name' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'default_mail_heading' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'smtp_type' )->validator( 'Validate::notEmpty' )
	)        
	->process( $_POST )
	->json();

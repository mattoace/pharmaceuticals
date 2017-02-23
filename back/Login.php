<?php
include( "php/DataTables.php" );
$uname = filter_input(INPUT_POST, 'uname', FILTER_SANITIZE_STRING);
$upass = filter_input(INPUT_POST, 'upass', FILTER_SANITIZE_STRING);
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;
Editor::inst( $db, 'ems_users' )
	->fields(		
		Field::inst( 'username' ),
		Field::inst( 'pass' ),
                Field::inst( 'id' )
	)->where( 'username', $uname )
     ->where( 'pass', md5($upass))
     ->where( 'is_active',1)
	 ->process( $_POST )
	 ->json();

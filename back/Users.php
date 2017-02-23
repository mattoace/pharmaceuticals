<?php
include( "php/DataTables.php" );
$inst = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT); 
if ( isset( $postData['action'] ) && ( $postData['action'] === 'create' || $postData['action'] === 'edit' ) ) {
  // $postData[0]['ems_users']['pass'] = md5( $postData['data'][0]['ems_user']['pass'] );
}
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

switch($_GET['is_admin']){
 case 1:
Editor::inst( $db, 'ems_users' )
	->fields(
		Field::inst( 'ems_users.fname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_users.mname' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'ems_users.username' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_users.pass' )->validator( 'Validate::notEmpty' )
		 ->setFormatter( function ( $val ) {
		        return md5( $val );
		    }),
		Field::inst( 'ems_users.email' )->validator( 'Validate::email' ),
        Field::inst( 'ems_users.mobile' ),
        Field::inst( 'ems_users.is_active' ),
        Field::inst( 'ems_userinstitution.type'),
        Field::inst( 'ems_userinstitution.institution' )->validator( 'Validate::notEmpty' )
	) 
	->leftJoin( 'ems_userinstitution', 'ems_userinstitution.userId', '=', 'ems_users.id')       
	->process( $_POST )
	->json();
 break;
 default:
Editor::inst( $db, 'ems_users' )
	->fields(
		Field::inst( 'ems_users.fname' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_users.mname' )->validator( 'Validate::notEmpty' ),
        Field::inst( 'ems_users.username' )->validator( 'Validate::notEmpty' ),
		Field::inst( 'ems_users.pass' )->validator( 'Validate::notEmpty' )
		 ->setFormatter( function ( $val ) {
		        return md5( $val );
		    }),
		Field::inst( 'ems_users.email' )->validator( 'Validate::email' ),
        Field::inst( 'ems_users.mobile' ),
        Field::inst( 'ems_users.is_active' ),
        Field::inst( 'ems_userinstitution.type'),
        Field::inst( 'ems_userinstitution.institution' )->validator( 'Validate::notEmpty' )
	) 
	->leftJoin( 'ems_userinstitution', 'ems_userinstitution.userId', '=', 'ems_users.id')
	->where( 'ems_userinstitution.institution', $inst )       
	->process( $_POST )
	->json();
 break;
}



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

switch($_GET['isAdmin']){
   case 1:
   Editor::inst( $db, 'ems_accessroles' )
	->fields(
		Field::inst( 'ems_accessroles.user_id' )->validator( 'Validate::notEmpty' )->options('ems_users','id','username'),
		Field::inst( 'ems_accessroles.module' )->validator( 'Validate::notEmpty' ),		
                Field::inst( 'ems_accessroles.add' ),
                Field::inst( 'e1.itemname as is_add' ),
                Field::inst( 'e2.itemname as is_edit' ),
                Field::inst( 'e3.itemname as is_delete' ),
                Field::inst( 'ems_users.username' ),
		Field::inst( 'ems_accessroles.edit' ),
		Field::inst( 'ems_accessroles.delete')
	) 
        
        ->leftJoin( 'ems_users', 'ems_users.id', '=', 'ems_accessroles.user_id')
        ->leftJoin( 'ems_lookup e1', 'e1.itemvalue', '=', 'ems_accessroles.add')->where( 'e1.itemtype',8)
        ->leftJoin( 'ems_lookup e2', 'e2.itemvalue', '=', 'ems_accessroles.edit')->where( 'e2.itemtype',8)
        ->leftJoin( 'ems_lookup e3', 'e3.itemvalue', '=', 'ems_accessroles.delete')->where( 'e3.itemtype',8)

    ->where( 'module',$_GET['id'])
	->process( $_POST )
	->json();
   break;
   default:
	Editor::inst( $db, 'ems_accessroles' )
		->fields(
			Field::inst( 'ems_accessroles.user_id' )->validator( 'Validate::notEmpty' )->options('ems_users','id','username'),
			Field::inst( 'ems_accessroles.module' )->validator( 'Validate::notEmpty' ),		
	                Field::inst( 'ems_accessroles.add' ),
	                Field::inst( 'e1.itemname as is_add' ),
	                Field::inst( 'e2.itemname as is_edit' ),
	                Field::inst( 'e3.itemname as is_delete' ),
	                Field::inst( 'ems_users.username' ),
			Field::inst( 'ems_accessroles.edit' ),
			Field::inst( 'ems_accessroles.delete')
		) 
	        ->leftJoin( 'ems_userinstitution emsUser', 'emsUser.userId', '=', 'ems_accessroles.user_id')->where( 'emsUser.institution',$_GET['instId'])
	        ->leftJoin( 'ems_users', 'ems_users.id', '=', 'ems_accessroles.user_id')

	        ->leftJoin( 'ems_lookup e1', 'e1.itemvalue', '=', 'ems_accessroles.add')->where( 'e1.itemtype',8)
	        ->leftJoin( 'ems_lookup e2', 'e2.itemvalue', '=', 'ems_accessroles.edit')->where( 'e2.itemtype',8)
	        ->leftJoin( 'ems_lookup e3', 'e3.itemvalue', '=', 'ems_accessroles.delete')->where( 'e3.itemtype',8)
	      
      
	    ->where( 'module',$_GET['id'])
		->process( $_POST )
		->json();
   break;
}



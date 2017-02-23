<?php

include( "php/DataTables.php" );
$action = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_NUMBER_INT);
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

switch ($action) {

    case 1:
        Editor::inst($db, 'ems_county')
                ->fields(
                        Field::inst('id'),
                        Field::inst('county_name')->validator('Validate::notEmpty')
                )
                ->process($_POST)
                ->json();
    break;
    case 2:
        Editor::inst($db, 'ems_subcounty')
                ->fields(
                        Field::inst('id'),
                        Field::inst('sub_countyname')->validator('Validate::notEmpty'),
                        Field::inst('county')->validator('Validate::notEmpty')
                )
                ->process($_POST)
                ->json();
    break;
    case 3:
        Editor::inst($db, 'ems_facilities')
                ->fields(
                        Field::inst('id'),
                        Field::inst('facility_name')->validator('Validate::notEmpty'),
                        Field::inst('description'),
                        Field::inst('quantity'),
                        Field::inst('location'),
                        Field::inst('inst_id')                      
                ) 
                ->where( 'inst_id', $id )
                ->where( 'parent', null)           
                ->process($_POST)
                ->json();
    break;
}
<?php

include( "php/DataTables.php" );
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_NUMBER_INT);

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
        Editor::inst($db, 'ems_district')
                ->fields(
                        Field::inst('ems_district.id'),
                        Field::inst('ems_district.district_name')->validator('Validate::notEmpty'),
                        Field::inst('ems_district.county')->options('ems_county','id','county_name')->validator( 'Validate::notEmpty' ),
                        Field::inst( 'ems_county.county_name' )
                )
                ->leftJoin( 'ems_county', 'ems_county.id', '=', 'ems_district.county')
                ->process($_POST)
                ->json();
    break;
}
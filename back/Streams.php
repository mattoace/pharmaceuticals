<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

        Editor::inst($db, 'ems_stream')
                ->fields(
                        Field::inst('id'),
                        Field::inst('stream_name')->validator('Validate::notEmpty'),
                        Field::inst('description'),
                        Field::inst('class_id')
                )
                ->where( 'class_id', $id )
                ->process($_POST)
                ->json();

<?php
include( "php/DataTables.php" );
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

        Editor::inst($db, 'ems_subjects')
                ->fields(
                        Field::inst('id'),
                        Field::inst('subject_name')->validator('Validate::notEmpty'),
                        Field::inst('description'),
                        Field::inst('institution_id')
                )
                ->where('institution_id', $id ) 
                ->process($_POST)
                ->json();

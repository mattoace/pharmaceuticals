<?php
include( "php/DataTables.php" );

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
$type = filter_input(INPUT_GET, 'type', FILTER_SANITIZE_NUMBER_INT);

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;


    Editor::inst($db, 'ems_grades')
            ->fields(
                    Field::inst('ems_grades.id'),
                    Field::inst('ems_grades.exam')->options('ems_examtypes','id','exam_description')->validator( 'Validate::notEmpty' ),
                    Field::inst('ems_grades.marks_from')->validator('Validate::notEmpty'),
                    Field::inst('ems_grades.marks_to')->validator('Validate::notEmpty'),
                    Field::inst('ems_grades.comments'),
                    Field::inst('ems_grades.grade'),
                    Field::inst('ems_grades.institution_id'),
                    Field::inst('ems_grades.type'),
                    Field::inst( 'e1.exam_description' ),
                    Field::inst( 'ems_grades.points' )
            )
            ->leftJoin( 'ems_examtypes e1', 'e1.id', '=', 'ems_grades.exam' )
            ->where( 'ems_grades.type', $type )
            ->where( 'ems_grades.institution_id', $id )
            
            //
            ->process($_POST)
            ->json();

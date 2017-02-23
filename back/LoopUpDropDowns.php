<?php
include( "php/DataTables.php" );
$sortid = filter_input(INPUT_GET, 'sortid', FILTER_SANITIZE_STRING);
$actionid = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_STRING);


use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;

switch ($actionid) {
    case 1:
        Editor::inst($db, 'ems_classes')
                ->fields(
                        Field::inst('ems_classes.id'), Field::inst('ems_classes.class_name')
                )
                ->where('ems_classes.institution_id', $sortid)
                ->process($_GET)
                ->json();
     break;
    case 2:
         Editor::inst($db, 'ems_stream')
                ->fields(
                        Field::inst('ems_stream.id'), Field::inst('ems_stream.stream_name')
                )
                ->where('ems_stream.class_id', $sortid)
                ->process($_GET)
                ->json();
    break;
    case 3:
          Editor::inst($db, 'ems_examtypes')
                ->fields(
                        Field::inst('ems_examtypes.id'), Field::inst('ems_examtypes.exam_description')
                )             
                ->process($_GET)
                ->json();
    break;
    case 4:
          Editor::inst($db, 'ems_subjects')
                ->fields(
                        Field::inst('ems_subjects.id'), Field::inst('ems_subjects.subject_name')
                )
                ->where('ems_subjects.institution_id', $sortid)
                ->process($_GET)
                ->json();
        
    break;
    case 5:
         Editor::inst($db, 'ems_terms')
                ->fields(
                        Field::inst('ems_terms.id'), Field::inst('ems_terms.term_name')
                )             
                ->process($_GET)
                ->json();
     break;
    default:
        Editor::inst($db, 'ems_lookup')
                ->fields(
                        Field::inst('ems_lookup.id'), Field::inst('ems_lookup.itemname')
                )
                ->where('ems_lookup.itemtype', $sortid)
                ->process($_GET)
                ->json();
    break;
}

        

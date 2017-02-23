<?php
include( "php/DataTables.php" );
$instId = filter_input(INPUT_GET, 'inst', FILTER_SANITIZE_NUMBER_INT);
$classId = filter_input(INPUT_GET, 'class_id', FILTER_SANITIZE_NUMBER_INT);
$streamId = filter_input(INPUT_GET, 'stream_id', FILTER_SANITIZE_NUMBER_INT);
$examId = filter_input(INPUT_GET, 'exam_id', FILTER_SANITIZE_NUMBER_INT);
$subjectId = filter_input(INPUT_GET, 'subject_id', FILTER_SANITIZE_NUMBER_INT);
$term_id = filter_input(INPUT_GET, 'term_id', FILTER_SANITIZE_NUMBER_INT);
$case = filter_input(INPUT_GET, 'case', FILTER_SANITIZE_NUMBER_INT);

use DataTables\Editor,
    DataTables\Editor\Field,
    DataTables\Editor\Format,
    DataTables\Editor\Mjoin,
    DataTables\Editor\Upload,
    DataTables\Editor\Validate;


switch($case){

       case 1: 
        //filter by class
        Editor::inst($db, 'ems_person')
                    ->fields(
                            Field::inst( 'ems_person.fname' ),
                            Field::inst( 'ems_person.mname' ),
                            Field::inst( 'ems_person.lname' ),
                            Field::inst( 'ems_person.id' ),
                            Field::inst( 'e1.marks' ),
                            Field::inst( 'e1.exam_id' )
                    )

                ->leftJoin( 'ems_marks e1', 'e1.student_id', '=', 'ems_person.id' )
                ->leftJoin( 'ems_studentclasses e2', 'e2.student_id', '=', 'ems_person.id' )
                //->leftJoin( 'ems_studentsubject e3', 'e3.student_id', '=', 'ems_person.id' )  
                ->where( 'e2.class_id',$classId)
                ->where( 'e2.institution_id',$instId)
                ->where( 'e1.subject_id',$subjectId)
                ->where( 'e1.exam_id',$examId)
                ->where( 'e1.term_id',$term_id)  
                ->process( $_POST )
            ->json();
        break;
        case 2: 
        //filter by stream
        Editor::inst($db, 'ems_person')
                    ->fields(
                            Field::inst( 'ems_person.id' ),
                            Field::inst( 'ems_person.fname' ),
                            Field::inst( 'ems_person.mname' ),
                            Field::inst( 'ems_person.lname' ),                       
                            Field::inst( 'e1.marks' ),
                            Field::inst( 'e1.exam_id' )
                    )

                ->leftJoin( 'ems_marks e1', 'e1.student_id', '=', 'ems_person.id' )
                ->leftJoin( 'ems_studentclasses e2', 'e2.student_id', '=', 'ems_person.id' )
                //->leftJoin( 'ems_studentsubject e3', 'e3.student_id', '=', 'ems_person.id' )      
                ->where( 'e2.class_id',$classId)
                ->where( 'e2.institution_id',$instId)
                ->where( 'e2.stream_id',$streamId)
                ->where( 'e1.subject_id',$subjectId)
                ->where( 'e1.exam_id',$examId)
                ->where( 'e1.term_id',$term_id)    
                ->where( 'ems_person.institution', $instId )  
                            ->process( $_POST )
            ->json();
        break;
      /*  case 3: 
        //filter by stream
        Editor::inst($db, 'ems_person')
                    ->fields(
                            Field::inst( 'ems_person.fname' ),
                            Field::inst( 'ems_person.mname' ),
                            Field::inst( 'ems_person.lname' ),
                            Field::inst( 'ems_person.id' ),
                            Field::inst( 'e1.marks' )
                    )

                ->leftJoin( 'ems_marks e1', 'e1.student_id', '=', 'ems_person.id' )
                ->leftJoin( 'ems_studentclasses e2', 'e2.student_id', '=', 'ems_person.id' )
                ->leftJoin( 'ems_studentsubject e3', 'e3.student_id', '=', 'ems_person.id' )
                ->where( 'e2.class_id',$classId)
                ->where( 'e2.institution_id',$instId)
                ->where( 'e2.stream_id',$streamId)
                ->where( 'e3.subject_id',$subjectId) 
                ->where( 'ems_person.institution', $instId )  
                            ->process( $_POST )
            ->json();
        break;

        default:

            Editor::inst($db, 'ems_person')
                    ->fields(
                            Field::inst( 'ems_person.fname' ),
                            Field::inst( 'ems_person.mname' ),
                            Field::inst( 'ems_person.lname' ),
                            Field::inst( 'ems_person.id' ),
                            Field::inst( 'e1.marks' )
                    )

                ->leftJoin( 'ems_marks e1', 'e1.student_id', '=', 'ems_person.id' )
                ->where( 'ems_person.institution_type', $instId ) 
                            ->process( $_POST )
                ->json();

         break;*/

}

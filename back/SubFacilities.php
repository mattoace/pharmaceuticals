<?php
require_once("../application/config/configRaw.php");
error_reporting(0);
$id = $_POST['id'];
$action = filter_input(INPUT_POST, 'case', FILTER_SANITIZE_NUMBER_INT);
$facility_name = $_POST['facility_name']; 
$description = $_POST['description']; 
$inst = filter_input(INPUT_POST, 'inst', FILTER_SANITIZE_NUMBER_INT);

switch($action){
 case 1:
    $bool = false;
    $parentArr = explode("_",$id);

    if(substr($id,0,1)  == 'j'){
        //create parent item here
        $sqlParent = "INSERT INTO ems_facilities(`facility_name`,`description`,`inst_id`) VALUES('".$facility_name."','".$description."','".$inst."')";
        if(mysql_query($sqlParent)){
            $msg = "Created parent item";
            $bool = true;
        }else{
            $msg = mysql_error();
        }
    }else{
        $sqlChild = "INSERT INTO ems_facilities(`facility_name`,`description`,`inst_id`,`parent`) VALUES('".$facility_name."','".$description."','".$inst."','".$parentArr[1]."')";
        if(mysql_query($sqlChild)){
           $msg = "Created child item";
           $bool = true;
        }else{
           $msg = mysql_error(); 
        }
    }
    echo json_encode(array("response"=>$msg,"bool"=>$bool,"parent"=>$parentArr[1]));
 break;
 case 2:
    $id = $_GET['id'];
    $bool = false;
    $parentArr = explode("_",$id);
    if(substr($id,0,1) == 'j'){
        $msg = "Parent item here!";
    }else{
        $sqlDelete = "DELETE FROM ems_facilities WHERE id = '".$parentArr[1]."'";
        if(mysql_query($sqlDelete)){
           $msg = "Successfully deleted!";
           $bool = true;
        }else{
           $msg = mysql_error(); 
        }
    }
    echo json_encode(array("response"=>$msg,"bool"=>$bool,"id"=>$parentArr[1]));
 break;
 default:

        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $sql = "SELECT * FROM ems_facilities WHERE inst_id = '".$id."' AND parent is null";
            $resMain = mysql_query($sql) or die("database error:". mysql_error());

            $treeData = [];

            $j = 0;

             while( $rowMain = mysql_fetch_assoc($resMain) ) {


                        $sqlSub = "SELECT * FROM ems_facilities WHERE parent = '".$rowMain['id']."' AND inst_id = '".$id."'";
                        $resSub = mysql_query($sqlSub) or die("database error:". mysql_error());
                        $nodesChildren = [];

                            $i=0;
                            while( $rowChildren = mysql_fetch_assoc($resSub) ) { 


                                $sqlSubChild = "SELECT * FROM ems_facilities WHERE parent = '".$rowChildren['id']."' AND inst_id = '".$id."'";
                                $resSubChild = mysql_query($sqlSubChild) or die("database error:". mysql_error());
                                $nodesChildren1 = [];
                                $k=0;
                                 while($rowChildren1 = mysql_fetch_assoc($resSubChild) ) { 

                                        $sqlSubChild1 = "SELECT * FROM ems_facilities WHERE parent = '".$rowChildren1['id']."' AND inst_id = '".$id."'";
                                        $resSubChild1 = mysql_query($sqlSubChild1) or die("database error:". mysql_error());
                                        $nodesChildren2 = [];
                                        $l=0;
                                         while($rowChildren2 = mysql_fetch_assoc($resSubChild1) ) {


                                                $sqlSubChild2 = "SELECT * FROM ems_facilities WHERE parent = '".$rowChildren2['id']."' AND inst_id = '".$id."'";
                                                $resSubChild2 = mysql_query($sqlSubChild2) or die("database error:". mysql_error());
                                                $nodesChildren3 = [];
                                                $m=0;
                                                while($rowChildren3 = mysql_fetch_assoc($resSubChild2) ) {

                                                 $nodesChildren3[$m] = ['id'=>"sub_".$rowChildren3['id'], 'text'=>$rowChildren3['facility_name'], 'state'=>['opened'=>true]];
                                                $m++;
                                                }


                                         $nodesChildren2[$l] = ['id'=>"sub_".$rowChildren2['id'], 'text'=>$rowChildren2['facility_name'],'children'=>$nodesChildren3, 'state'=>['opened'=>true]];
                                         $l++;
                                         }                           


                                   $nodesChildren1[$k] = ['id'=>"sub_".$rowChildren1['id'], 'text'=>$rowChildren1['facility_name'], 'children'=>$nodesChildren2, 'state'=>['opened'=>true]];
                                   $k++;
                                 }

                                 $nodesChildren[$i] = ['id'=>"sub_".$rowChildren['id'], 'text'=>$rowChildren['facility_name'], 'children'=>$nodesChildren1, 'state'=>['opened'=>true]];
                               $i++;                       
                            }

                 $treeData[$j] = array('id'=>"main_".$rowMain['id'], 'text'=>$rowMain['facility_name'], 'children'=>$nodesChildren, 'state'=>['opened'=>true]);
                 $j++;  
             }   

          echo json_encode(['id'=>0, 'text'=>'Available facilities for selected institution', 'children'=>$treeData, 'state'=>['opened'=>true]]);



 break;
}




<?php
require_once("../application/config/configRaw.php");

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);

switch($action){
    
    case 1:
        $to = filter_input(INPUT_POST, 'to', FILTER_SANITIZE_STRING);
        
        $from = filter_input(INPUT_POST, 'from', FILTER_SANITIZE_STRING);
       
        $message = $_POST['message'];
        
        $message = mysql_real_escape_string($message);
        
        $sqlUser = "SELECT id FROM ems_users WHERE md5(id) = '".$id."'";
        
        $responseUser = mysql_query($sqlUser)or die(mysql_error());
        
        $rowUser = mysql_fetch_assoc($responseUser);
        
        $user = $rowUser['id'];
        
        $sqlInsert = "INSERT INTO ems_chatlog(`user`,`log`,`to`,`from`) VALUES('".$user."','".$message."',(SELECT id FROM ems_users WHERE fname ='".$to."'),(SELECT id FROM ems_users WHERE fname ='".$from."'))";
        
        if(mysql_query($sqlInsert)){
            $response = "Saved!";
        }else{
            $response = mysql_error();
        }       
        
        echo json_encode(array("response"=>$response));
    break;
    case 2:
        
        $selected = filter_input(INPUT_POST, 'selected', FILTER_SANITIZE_STRING);
        
        $sqlUser = "SELECT id FROM ems_users WHERE md5(id) = '".$id."'";
        
        $responseUser = mysql_query($sqlUser)or die(mysql_error());
        
        $rowUser = mysql_fetch_assoc($responseUser);
        
        $user = $rowUser['id'];
        
        $sqlChatLog = "SELECT * FROM ems_chatlog WHERE (ems_chatlog.to = (SELECT id FROM ems_users WHERE fname ='".$selected."') or ems_chatlog.from = (SELECT id FROM ems_users WHERE fname ='".$selected."')) and ems_chatlog.user = '".$user."'";
           
        //var_dump($sqlChatLog);
        
        $resChatlog = mysql_query($sqlChatLog)or die(mysql_error());
        
        while($rowChatlog = mysql_fetch_assoc($resChatlog)){
            $response[] = $rowChatlog['log'];  
        }
        
        $response = implode(" ",$response);
        
        //$response = "test here";
        echo json_encode(array("message"=>$response));
     break;
     case 3:
      //save roles
     $userId = $_POST['user_id'];
     $checked = $_POST['checked'];

     $sqlDelRoles = "DELETE FROM ems_useroles WHERE userId = '".$userId."'";
     if(mysql_query($sqlDelRoles)){

             foreach ($checked as $key => $moduleId) {

                $sqlInsertRole = "INSERT INTO ems_useroles(`userId`,`moduleId`) VALUES('".$userId."','".$moduleId."')";
                mysql_query($sqlInsertRole)or die(mysql_error()); 

               /* $moduleArr = explode("_", $moduleId);
                if($moduleArr[0]== 'sub'){
                       $submodulesId = end($moduleArr); 

                       $sqlInsertRole = "INSERT INTO ems_useroles(`userId`,`moduleId`) VALUES('".$userId."','".$submodulesId."')";

                       mysql_query($sqlInsertRole)or die(mysql_error());                    

                }*/
                
              } 
           $response = "Saved roles";
      }else{ $response = mysql_error(); }     

      echo json_encode(array("response"=>$response)); 

     break;
     case 4:
        $sqlSavedRoles = "SELECT * FROM ems_useroles WHERE userId = '".$_POST['user_id']."'";
        $resSavedRoles = mysql_query($sqlSavedRoles)or die(mysql_error());
        while($rowRoles = mysql_fetch_assoc($resSavedRoles)){
            $modules[] = $rowRoles['moduleId'];
        }
      echo json_encode($modules);
     break;
    case 5:
        $start = $_POST['start'];
        $end = $_POST['end'];
        $userId = $_POST['userId'];
        //$sqlAccessRoles = "SELECT * FROM ems_accessroles WHERE module LIKE '".$start."%' AND module LIKE '%".$end."' AND user_id = '".$userId."'";
        /*
        create a function for splitting strings in mysql

        CREATE FUNCTION `SPLIT_STR`(
          x VARCHAR(255),
          delim VARCHAR(12),
          pos INT
        ) RETURNS varchar(255)
        RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos),
       LENGTH(SUBSTRING_INDEX(x, delim, pos -1)) + 1),
       delim, '')

        */

        $sqlAccessRoles = "SELECT ea.add,ea.edit,ea.delete,i.institution_name,eui.type,el.itemname,i.id,eu.is_admin 
        FROM ems_accessroles ea
        JOIN ems_users eu ON eu.id = ea.user_id 
        LEFT JOIN ems_userinstitution eui ON eui.userId = ea.user_id AND eui.userId = '".$userId."'
        LEFT JOIN ems_institution i ON i.id = eui.institution
        LEFT JOIN ems_lookup el ON el.itemvalue = eui.type AND el.itemtype = 6
        WHERE SPLIT_STR(ea.module, '_', 3)  = '".$end."' 
        AND ea.user_id = '".$userId."' 
        GROUp BY ea.user_id       
        ";
        $resAccessRoles = mysql_query($sqlAccessRoles) or die(mysql_error());
        $rowAccessRoles = mysql_fetch_assoc($resAccessRoles);
        $add = $rowAccessRoles['add'];
        $edit = $rowAccessRoles['edit'];
        $delete = $rowAccessRoles['delete'];
        $institution = $rowAccessRoles['id'];
        $institution_name = $rowAccessRoles['institution_name'];
        $instType = $rowAccessRoles['type'];
        $category = $rowAccessRoles['itemname'];
        $is_admin = $rowAccessRoles['is_admin'];  
        echo json_encode(array("add"=>$add , "edit"=>$edit,"delete"=>$delete,"debug"=>$sqlAccessRoles,"institution"=>$institution, "instType"=>$instType,"category"=>$category,"institution_name"=>$institution_name,"is_admin"=>$is_admin)); 
    break;
    default:
    $sql = "SELECT * FROM ems_menu ";
    $resMain = mysql_query($sql) or die("database error:". mysql_error());
    $treeData = [];
    $j = 0;
     while( $rowMain = mysql_fetch_assoc($resMain) ) {
                $sqlSub = "SELECT * FROM ems_submenu WHERE menu_id = '".$rowMain['id']."'";
                $resSub = mysql_query($sqlSub) or die("database error:". mysql_error());
                $nodesChildren = [];
                    $i=0;
                    while( $rowChildren = mysql_fetch_assoc($resSub) ) {  
                       $nodesChildren[] = ['id'=>"sub_".$i."_".$rowChildren['id'], 'text'=>$rowChildren['menu_name'],  'children'=>['id'=>"ch1_".$rowChildren['id'], 'text'=>$rowChildren['menu_name']], 'state'=>['opened'=>true]];
                    $i++;                       
                    }

         $treeData[$j] = array('id'=>"main_".$rowMain['id'], 'text'=>$rowMain['menu_name'], 'children'=>$nodesChildren, 'state'=>['opened'=>true]);
         $j++;
     }     
  echo json_encode(['id'=>0, 'text'=>'Modules', 'children'=>$treeData, 'state'=>['opened'=>true]]);
 // Ref : http://phpflow.com/php/dynamic-tree-with-jstree-php-and-mysql/ 
  break;
  case 6:
    $hash = filter_input(INPUT_POST, 'hash', FILTER_SANITIZE_STRING);
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); 
    $sqlUpdate = "UPDATE ems_users SET pass = '".$hash."' WHERE id = '".$id."'";
    if(mysql_query($sqlUpdate)){
          $response = "Saved!";
    }else{$response = mysql_error();}
    echo json_encode(array("response"=>$response));
  break;
  }   
  
?>
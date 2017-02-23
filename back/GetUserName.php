<?php
require_once("../application/config/configRaw.php");
switch($_GET['action']){    
    case 1:        
    break;
    default:
       $sqlUser = "SELECT fname FROM ems_users WHERE md5(id) = '".$_GET['id']."'";
       $resUsers = mysql_query($sqlUser)or die(mysql_error());
       $rowUsers = mysql_fetch_assoc($resUsers);       
       echo json_encode(array("user_name"=>$rowUsers['fname']));
    break;
    
}

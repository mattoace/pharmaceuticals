<?php
require_once("../application/config/configRaw.php");
$sql = "SELECT * FROM ems_institution";
$result = mysql_query($sql)or die(mysql_error());
while($row = mysql_fetch_assoc($result)){
   $myArray[] = array("value"=>$row['institution_name'],"data"=>$row['id']);
}
echo json_encode($myArray);

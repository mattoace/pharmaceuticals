<?php
require_once("../application/config/configRaw.php");
$action = $_GET['action'];

switch($action){
	case 1:
     $student_id = $_GET['id'];
     $sql = "SELECT img_name FROM ems_person WHERE id = '".$student_id ."'";
	 $result = mysql_query($sql)or die(mysql_error());
	 $row = mysql_fetch_assoc($result);
	 $image = $row['img_name'];
     echo json_encode(array("img_name"=>$image));
	break;
	default:
    $student_id = $_GET['id'];
	$sql = "SELECT img FROM ems_person WHERE id = '".$student_id ."'";
	$result = mysql_query($sql)or die(mysql_error());
	$row = mysql_fetch_assoc($result);
	$image = $row['img'];
	?>
	<img src="data:image/jpeg;base64,<?php echo $image; ?>" />
	<?php
	break;

}

?>


<?php
require_once 'php/dacapo.class.php'; // simple database wrapper
require_once 'php/server_side/php/jui_filter_rules.php';
require_once 'php/server_side/php/bs_grid.php';
$db_settings = array(
  'rdbms' => 'MYSQLi',
  'db_server' => 'coreict.co.ke',
  'db_user' => 'coreictc_ems',
  'db_passwd' => 'coreictc_ems2016',
  'db_name' => 'coreictc_ems',
  'db_port' => '3306',
  'charset' => 'utf8',
  'use_pst' => true, // use prepared statements
  'pst_placeholder' => 'question_mark'
);
 
$ds = new dacapo($db_settings, null);
 
$page_settings = array(
  "selectCountSQL" => "SELECT count(id) as totalrows FROM ems_institution",
  "selectSQL" => "SELECT i.id,i.institution_name,i.town,i.latitude,i.longitude,
				  i.address,i.telephone,i.email,i.principal,i.founded_date,i.total_population 
				  FROM ems_institution i
  ",
  "page_num" => $_POST['page_num'],
  "rows_per_page" => $_POST['rows_per_page'],
  "columns" => $_POST['columns'],
  "sorting" => isset($_POST['sorting']) ? $_POST['sorting'] : array(),
  "filter_rules" => isset($_POST['filter_rules']) ? $_POST['filter_rules'] : array()
);
 
$jfr = new jui_filter_rules($ds);
$jdg = new bs_grid($ds, $jfr, $page_settings, $_POST['debug_mode'] == "yes" ? true : false); 
$data = $jdg->get_page_data(); 
// data conversions (if necessary)
foreach($data['page_data'] as $key => $row) {
  // this will convert Lastname to a link
  //$data['page_data'][$key]['institution_name'] = "<a href=\"/viewinst/{$row['id']}\">{$row['institution_name']}</a>";
  // this will format date_updated (attention date_convert is a local function)
  ////$data['page_data'][$key]['date_updated'] = date_convert($row['date_updated'], 'UTC', 'YmdHis', 'UTC', 'd/m/Y H:i:s');
   $date1 = new DateTime($row['date_updated']);
   $s1 = $date1->format('d/m/Y H:i:s');
   $data['page_data'][$key]['date_updated'] = $s1;
}
 
echo json_encode($data);
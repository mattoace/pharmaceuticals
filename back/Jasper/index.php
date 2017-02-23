<?php
 
//Import the PhpJasperLibrary
include_once('PhpJasperLibrary-master/PhpJasperLibrary/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary-master/PhpJasperLibrary/PHPJasperXML.inc.php");

 $reporttype = $_GET['type'];  

//database connection details
 
$server="localhost";
$db="coreictc_ems";
$user="coreictc_ems";
$pass="coreictc_ems2016";
$version="0.8b";
$pgport=5432;
$pchartfolder="./class/pchart2";
 
 
//display errors should be off in the php.ini file
ini_set('display_errors', 0);
 
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
//$PHPJasperXML->arrayParameter=array("parameter1"=>1);

//setting the path to the created jrxml file
switch($reporttype){
	case 'kcse':
	$PHPJasperXML->arrayParameter=array("institution"=>4,"year"=>2016);
    $xml =  simplexml_load_file("Jrxml/Kcse.jrxml");
	break;
}
$PHPJasperXML->xml_dismantle($xml); 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
 
 
?>
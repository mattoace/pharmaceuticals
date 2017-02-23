<?php
/**
 * HTML2PDF Librairy - example
 *
 * HTML => PDF convertor
 * distributed under the LGPL License
 *
 * @author      Laurent MINGUET <webmaster@html2pdf.fr>
 *
 * isset($_GET['vuehtml']) is not mandatory
 * it allow to display the result in the HTML format
 */

    // get the HTML
    require_once("../../../Controller/config.php");
    require("../../../Model/GeneralClass.php");
    
    $loansid = 29;
    $mode = 0;
    
    //Heading
    $sql = "SELECT * FROM fairladies_loans WHERE Loan_ID = {$loansid}";

    $res    = mysql_query($sql) or "test1".die(mysql_error ());    
    $row = mysql_fetch_array($res);

    $customer =  $row["Loan_Relation_Name"];
    $startdate =  $row["Loan_StartDate"];
    $enddate =  $row["Loan_EndDate"];
    $principal =  $row["Loan_Principal"];
    $interest_rate = $row["Loan_Interest_Rate"] * 100;
    $payment_interval = $row["Loan_Payment_Frequency"];
    $years = $row["Loan_Years"];
    
    if ($payment_interval == "Weekly"){
        
        $no_of_payments = $years * 52;
        
        $rate = $interest_rate  / 5200;
        $middle = $rate / (pow((1+$rate),$no_of_payments) - 1);
        $installments = round(($rate + $middle) * $principal,2);
        
    } else {
        $no_of_payments = $years * 12;
        
        $rate = $interest_rate / 1200;
        $middle = $rate / (pow((1+$rate),$no_of_payments) - 1);
        $installments = round(($rate + $middle) * $principal,2);
    }
                    
    $content.= "<table style='width: 100%;' bgcolor='#d4e7ff' cellspacing='5' >";
    $content.= "<tr><td colspan='2'><b>Amortization Schedule</b></td></tr>";
    $content.= "<tr><td>Customer:</td><td>{$customer}</td></tr>";
    $content.= "<tr><td style='width: 20%;'>Loan Start Date:</td><td style='width: 80%;'>{$startdate}</td></tr>";
    $content.= "<tr><td>Loan End Date:</td><td>{$enddate}</td></tr>";
    $content.= "<tr><td>Principal:</td><td>".number_format($principal)."</td></tr>";
    $content.= "<tr><td>Interest Rate:</td><td>{$interest_rate}</td></tr>";
    $content.= "<tr><td>Payment Interval:</td><td>{$payment_interval}</td></tr>";
    $content.= "<tr><td>No of Payments:</td><td>{$no_of_payments}</td></tr>";
    $content.= "<tr><td>{$payment_interval} Payment:</td><td>{$installments}</td></tr>";
    $content.= "</table>";
    $content.= "<br>";
    $content.= "<table style='width: 100%;' bgcolor='#e5e5e5' cellspacing='0' >";
    $content.= "<tr><td colspan='8'><b>Schedule of Payments</b></td></tr>";
    $content.= "<tr><td style='width: 10%;'>Period</td><td style='width: 20%;'>Date</td><td style='width: 10%;'>Payments</td><td style='width: 10%;'>Principal</td><td style='width: 10%;'>Interest</td><td style='width: 10%;'>Balance</td><td style='width: 15%;'>Cumulative Interest</td><td style='width: 15%;'>Cumulative Payment</td></tr>";
    //Body
    if($mode != 1 ){
        $psql = "SELECT * FROM fairladies_loan_payments WHERE Loan_ID = {$loansid} AND Loan_Period";
        $pres    = mysql_query($psql) or "test2".die(mysql_error ());    
        $bgcount = 0;
                        
        while ($prow = mysql_fetch_array($pres)) {
        
        if($bgcount == 0) $color = "#fff"; else $color = "#eee";
        $content.= "<tr bgcolor='{$color}' ><td>{$prow["Loan_Period"]}</td><td>{$prow["Loan_Payment_Date"]}</td><td>{$prow["Loan_Payment_Installment"]}</td><td>{$prow["Loan_Principal_Payment"]}</td><td>{$prow["Loan_Interest_Expected"]}</td><td>{$prow["Loan_Balance_Expected"]}</td><td>{$prow["Loan_Interest_Cumulative"]}</td><td>{$prow["Loan_Installment_Cumulative"]}</td></tr>";
        
        $bgcount ++;                 
        if($bgcount == 2){
            $bgcount = 0;
        }
        }
    }
    $content.= "</table>";

    // convert to PDF
    require_once(dirname(__FILE__).'/../html2pdf.class.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr', true, 'UTF-8', 10);
        $html2pdf->pdf->SetDisplayMode('fullpage');
        $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
        ob_start();
        $html2pdf->Output('xxxfff.pdf');
        
        $newcount = "xxx2";
        $out .= ob_get_contents();
        ob_end_flush();

        if (strlen($out) > 0)
        {       
                $file = 'Uploads/'.$newcount.'.pdf';
                touch($file);
                $fh = fopen($file, 'w');
                $t = fwrite($fh, $out);
                fclose($fh);
                $data['data']=array('success'=>true,'message'=>$t);
        }  
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }

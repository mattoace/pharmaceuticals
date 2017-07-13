<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class InvoiceController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Invoice','invoice');
        //$this->load->model('Order','order');
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }
 


public function createInvoice($isExpress,$storeid,$patientid,$orderno,$items){

  $this->load->model('Order','ordermain');

  require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");

  $this->load->model('Users','users');  

  if($isExpress){
     $list = $this->invoice->fetchConfirmRefillIds($storeid,$patientid,$orderno,$type);
     $totals = $this->invoice->fetchConfirmRefillIdsTotals($storeid,$patientid,$orderno,$type);
     $tax = $this->invoice->fetchConfirmRefillIdsTax($storeid,$patientid,$orderno,$type);
     $userdetails = $this->users->fetchRecord($list[0]->user); 
  }else{

    $orderline = $this->input->post("orderid");  

    $type = $this->input->post("type");  

    $orderlineArr = explode('_',$orderline); 

    $storeid = $orderlineArr[0];

    $patientid = $orderlineArr[1];

    $orderno = $orderlineArr[2];

    $list = $this->invoice->fetchConfirmRefillIds($storeid,$patientid,$orderno,$type);

    $totals = $this->invoice->fetchConfirmRefillIdsTotals($storeid,$patientid,$orderno,$type);

    $tax = $this->invoice->fetchConfirmRefillIdsTax($storeid,$patientid,$orderno,$type);

    $userdetails = $this->users->fetchRecord($list[0]->user);  
    
    $patientid = $userdetails[0]->id;

  }

  
  


    $listsmtp = $this->ordermain->fetchsmtp(); 

    $smtparray = $listsmtp->row_array();
    $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']);

    $defaultCompanydetails = $this->users->fetchDefaultCompany();

    $currentdate = date('d/m/Y'); 

     ///add to the invoice tables

    

   require_once("Coupon.php");

   $coupon = new Coupon();

   $myArray = array("length"=>3,"prefix"=>"INV-");

   $code =   $coupon->generate($myArray);  

   $maxinvno = $this->invoice->getMaxInv(); 

   $increament =  $maxinvno[0]->max +1; 

   $code =  $code."-".$increament;

     

   //$totals = $this->invoice->getInvoiceTotals($storeid,$patientid,$type);

   //var_dump($totals); exit();

   //$tax = $this->invoice->getInvoiceTax($storeid,$patientid,$type); 

   $grandtotal = $totals[0]->totals + $tax[0]->tax;  

   $arrayInvoice = array(
                'invoiceno' => $code ,
                'invoicedate' => date('Y-m-d H:i:s'),
                'amount' =>  $totals[0]->totals,
                'tax' => $tax[0]->tax,
                'currency' => 'KES',
                'orderno'=>$list[0]->orderno,
                'patientid' => $list[0]->user
            );          

   $newid = $this->invoice->createInvoice($arrayInvoice); 

  // insert the items
   foreach ($list as $orderitems) {
       $array = array(
                'invoiceno' => $code ,
                'invoicedate' => date('Y-m-d H:i:s'),
                'itemid' => $orderitems->id,
                'parentid' => $newid
            );          

    $this->invoice->createInvoiceItems($array); 

    }


   $body = '
                    <!DOCTYPE html>
                    <html>
                    <head>
                      <meta charset="utf-8">
                     
                      <title>Pharmacy System | Invoice</title>
                      <!-- Tell the browser to be responsive to screen width -->
                     
                      <!-- Bootstrap 3.3.6 -->
                      <link rel="stylesheet" href="http://tibamoja.co.ke/assets/plugins/bootstrap/css/bootstrap.min.css">
                      <!-- Font Awesome -->
                      <link rel="stylesheet" href="http://tibamoja.co.ke/assets/plugins/font-awesome/font-awesome.min.css">  
                      <!-- Ionicons -->
                      <link rel="stylesheet" href="http://tibamoja.co.ke/assets/plugins/font-awesome/ionicons.min.css">  
                     
                      <!-- Theme style -->
                      <link rel="stylesheet" href="http://tibamoja.co.ke/assets/css/AdminLTE.min.css"> 
                      <!--[if lt IE 9]>
                      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                      <![endif]-->
                        <script>
                        function commitPayment(invoiceno){
                          window.location = "http://tibamoja.co.ke/ws:pay-invoice?invoiceno="+invoiceno  
                        }
                        </script>
                      <style>
                      .invoice {
                          background: #fff none repeat scroll 0 0;
                          border: 1px solid #f4f4f4;
                          margin: 10px 25px;
                          padding: 20px;
                          position: relative;
                      }
                      .page-header {
                          font-size: 22px;
                          margin: 10px 0 20px;
                      }
                      .page-header {
                          border-bottom: 1px solid #eee;
                          margin: 40px 0 20px;
                          padding-bottom: 9px;
                      }
                      .col-xs-12 {
                          width: 100%;
                      }
                      .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          float: left;
                      }
                      .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          min-height: 1px;
                          padding-left: 15px;
                          padding-right: 15px;
                          position: relative;
                      }
                      .fa {
                          display: inline-block;  
                          font-feature-settings: normal;
                          font-kerning: auto;
                          font-language-override: normal;
                          font-size: inherit;
                          font-size-adjust: none;
                          font-stretch: normal;
                          font-style: normal;
                          font-synthesis: weight style;
                          font-variant: normal;
                          font-weight: normal;
                          line-height: 1;
                          text-rendering: auto;
                      }
                      .page-header > small {
                          color: #666;
                          display: block;
                          margin-top: 5px;
                      }
                      .pull-right {
                          float: right;
                      }
                      .pull-right {
                          float: right !important;
                      }
                      .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small {
                          font-size: 65%;
                      }
                      .h1 .small, .h1 small, .h2 .small, .h2 small, .h3 .small, .h3 small, .h4 .small, .h4 small, .h5 .small, .h5 small, .h6 .small, .h6 small, h1 .small, h1 small, h2 .small, h2 small, h3 .small, h3 small, h4 .small, h4 small, h5 .small, h5 small, h6 .small, h6 small {
                          color: #777;
                          font-weight: 400;
                          line-height: 1;
                      }
                      .small, small {
                          font-size: 85%;
                      }
                      small {
                          font-size: 80%;
                      }
                      .row {
                          margin-left: -15px;
                          margin-right: -15px;
                      }
                      .col-sm-4 {
                          width: 33.3333%;
                      }
                      .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9 {
                          float: left;
                      }
                      .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          min-height: 1px;
                          padding-left: 15px;
                          padding-right: 15px;
                          position: relative;
                      }
                      address {
                          font-style: normal;
                          line-height: 1.42857;
                          margin-bottom: 20px;
                      }
                      b, strong {
                          font-weight: 700;
                      }
                      .table-responsive {
                          min-height: 0.01%;
                          overflow-x: auto;
                      }
                      .col-xs-12 {
                          width: 100%;
                      }
                      .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          float: left;
                      }
                      .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          min-height: 1px;
                          padding-left: 15px;
                          padding-right: 15px;
                          position: relative;
                      }
                      .table {
                          margin-bottom: 20px;
                          max-width: 100%;
                          width: 100%;
                      }
                      table {
                          background-color: transparent;
                      }
                      table {
                          border-collapse: collapse;
                          border-spacing: 0;
                      }
                      .table > thead > tr > th {
                          border-bottom: 2px solid #f4f4f4;
                      }
                      .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                          border-top: 1px solid #f4f4f4;
                      }
                      .table > thead > tr > th {
                          border-bottom: 2px solid #ddd;
                          vertical-align: bottom;
                      }
                      .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                          border-top: 1px solid #ddd;
                          line-height: 1.42857;
                          padding: 8px;
                          vertical-align: top;
                      }
                      th {
                          text-align: left;
                      }
                      td, th {
                          padding: 0;
                      }
                      .col-xs-6 {
                          width: 50%;
                      }
                      .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          float: left;
                      }
                      .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-xs-1, .col-xs-10, .col-xs-11, .col-xs-12, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9 {
                          min-height: 1px;
                          padding-left: 15px;
                          padding-right: 15px;
                          position: relative;
                      }
                      .table-responsive {
                          min-height: 0.01%;
                          overflow-x: auto;
                      }
                      .table {
                          margin-bottom: 20px;
                          max-width: 100%;
                          width: 100%;
                      }
                      table {
                          background-color: transparent;
                      }
                      table {
                          border-collapse: collapse;
                          border-spacing: 0;
                      }
                      .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                          border-top: 1px solid #f4f4f4;
                      }
                      .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                          border-top: 1px solid #ddd;
                          line-height: 1.42857;
                          padding: 8px;
                          vertical-align: top;
                      }
                      th {
                          text-align: left;
                      }
                      td, th {
                          padding: 0;
                      }                   

                      </style>

                    </head>
                    <body onload="">
                    <div class="wrapper" style="width: 100%;height:100%;min-width: 960px;">
                      <!-- Main content -->
                      <div class="invoice" style="background:url(http://www.tibamoja.co.ke/assets/img/mail.jpg) !important;background-size:100% !important;background-repeat:no-repeat !important;height: 100%;">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-xs-12">
                            <h2 class="page-header">
                              <i><img src="http://www.tibamoja.co.ke/assets/img/logo.png" width="200" style="width:200px;"/></i> Pharmacy System | Invoice 
                              <small class="pull-right" style="color:white !important;">Date: '.$currentdate.'</small>
                            </h2>
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                          <div class="col-sm-4 invoice-col">
                            From
                            <address>
                              <strong>'.$defaultCompanydetails[0]->companyname.'</strong><br>
                              '.$defaultCompanydetails[0]->address.' ,<br>
                              '.$defaultCompanydetails[0]->town." , ".$defaultCompanydetails[0]->country.'<br>
                              Phone  : '.$defaultCompanydetails[0]->telephone1." , ".$defaultCompanydetails[0]->telephone2.'<br>
                              Email  : '.$defaultCompanydetails[0]->email.'
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            To
                            <address>
                              <strong>'.$userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname.'</strong><br>
                              Address : '.$userdetails[0]->address .'<br>
                              Town:'.$userdetails[0]->town.'<br>
                              Phone: '.$userdetails[0]->phone.'<br>
                              Email: '.$userdetails[0]->email .'
                            </address>
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-4 invoice-col">
                            <b>Invoice #'.$code.'</b><br>
                            <br>        
                            <b>Payment Due:</b> 2/22/2014<br>
                            <b>Account:</b> PHARM-'.$patientid.'
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->';


                         $body .= '   <!-- Table row -->
                            <div class="row">
                              <div class="col-xs-12 table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                    <th>Qty</th>
                                    <th>Pharmacy/Store</th>
                                    <th>Serial #</th>
                                    <th>Description</th>
                                    <th>Subtotal</th>
                                    <th>Tax</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  ';

                               foreach ($list as $orderL) {
                                if($orderL->price < 0) { $productdescription = "Coupon Discount"; }else{ $productdescription = $orderL->genericname; }
                                      $body .= ' 
                                        <tr>
                                          <td>'.$orderL->qty.'</td>
                                          <td>'.$orderL->storename.'</td>
                                          <td>0000'.$orderL->id.'</td>
                                          <td>'.$productdescription.'</td>
                                          <td align="center">Kes '.$orderL->price.' /=</td>
                                          <td align="right">'.number_format($orderL->tax,0).'%</td>
                                        </tr>'; 

                                      // $totalex = $totalex + $orderL->price;

                                       //$tax =  $tax + ((int)$orderL->tax/100 * $totalex); 
//$tax = 0;

                                        $array = array(
                                                'description' => 'Invoice sent',
                                                'comments' => 'Invoiced'
                                            );          

                                           $this->invoice->saveRecord($array,$orderL->id); // temporary halt flaging the invoice

                                }




              $body .= '</tbody>
                    </table>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                  <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-xs-6">
                  <br><hr>

                    <form action="https://tibamoja.co.ke/ws:pay-invoice?invoiceno='.$code.'" method="post" target="_top">
                    <input type="hidden" name="invoiceno" value='.$code.'>
                    <input type="hidden" name="hosted_button_id" value="">
                    <input type="image" src="https://tibamoja.co.ke/assets/img/credit/mpesa.png" border="0" name="submit" alt="Lipa na MPESA">
                    <img alt="Click link to pay using Mpesa" border="0" src="https://tibamoja.co.ke/assets/img/credit/mpesa.png" width="1" height="1">
                    </form>
                  
                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="hosted_button_id" value="QARQ5URZDKYKE">
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                    <img alt="Click link to pay using Paypal" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                    </form><br>
                    <h2>Or</h2><br>



                 <!-- <span style="cursor:pointer; color:green;">  <img style="cursor:pointer;" onClick=commitPayment('.json_encode($code).') src="http://tibamoja.co.ke/assets/img/credit/mpesa.png" alt="MPESA"> </span>-->


                    <!--<img style="cursor:pointer;" src="http://tibamoja.co.ke/assets/img/credit/visa.png" alt="Visa">
                    <img style="cursor:pointer;" src="http://tibamoja.co.ke/assets/img/credit/mastercard.png" alt="Mastercard">
                    <img style="cursor:pointer;" src="http://tibamoja.co.ke/assets/img/credit/american-express.png" alt="American Express">
                    <img style="cursor:pointer;" src="http://tibamoja.co.ke/assets/img/credit/paypal2.png" alt="Paypal">-->

                   <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Please make payments of the products listed.
                    </p>
                  </div>
                  <!-- /.col -->
                  <div class="col-xs-6">
                    <p class="lead">Amount Due '.$currentdatelong.'</p>

                    <div class="table-responsive">
                      <table class="table" >
                        <tr>
                          <th style="width:50%">Subtotal:</th>
                          <td align="right">'.number_format($totals[0]->totals,2).'</td>
                        </tr>
                        <tr>
                          <th>Tax</th>
                          <td align="right">'.number_format($tax[0]->tax,2).'</td>
                        </tr>
                        <tr>
                          <th>Shipping:</th>
                          <td align="right">0.00</td>
                        </tr>
                        <tr>
                          <th>Total:</th>
                          <td align="right"><b>'.number_format($grandtotal,2).'</b></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.content -->
            </div>
            <!-- ./wrapper -->
            </body>
            </html>

            '; 
        // print $body; exit();

        $content = $this->createPdfTemplate($arrayInvoice,$defaultCompanydetails,$userdetails,$list,$totals[0]->totals,$tax[0]->tax,$grandtotal);  
        //exit();
        //create a pdf here

    require_once(dirname(__FILE__) . '/html2pdf/html2pdf.class.php');
        try {
            $html2pdf = new HTML2PDF('P', 'A4', 'en', true, 'UTF-8', 10);
            $html2pdf->pdf->SetDisplayMode('real');
            $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            //$html2pdf->writeHTML($body, true, 0, true, true);
            $html2pdf->Output("assets/uploads/invoicepdf/Invoice_".$code.".pdf","F");
        } catch (HTML2PDF_exception $e) {
            echo $e;
            exit;
        }

       $array = array(
                'file' => "assets/uploads/invoicepdf/Invoice_".$code.".pdf"
            );          

     $this->invoice->savePdfFile($array,$code);         
     $response = "Initializing email..";
     if($grandtotal > 0) {

       $toEmail = $userdetails[0]->email;

       $toName =  $userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname;

       $subject = "Invoice";

       $message = $body;

       $headers = "'X-Mailer', 'All rights reserved Core Ict Consultancy'";

       $title = "Invoice";

       $fromEmail = $smtparray['defaultemail'];

       $fromName = "tibamoja";

       $key = null;

      

        $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key); 

        }else{$response = "Email not sent!";}  


       //var_dump($response);
        return $response;
      
  }

  public function fetchInvoice(){     

        $list = $this->invoice->getInvoices();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();
            $row[] = $order->id;
            $row[] = $order->invoicedate;
            $row[] = $order->invoiceno;
            $row[] = $order->orderno;
            $row[] = $order->storename;
            $row[] = $order->Firstname; 
            $row[] = $order->Secondname; 
            $row[] = $order->email;      
            $row[] = number_format($order->totals,2); 
            $row[] = $order->file;        
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->invoice->count_all(),
                        "recordsFiltered" => $this->invoice->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

  }

  public function fetchUserInvoice(){

    $list = $this->invoice->getUserInvoices($this->input->get("id"));
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();
            $row[] = $order->id;
            $row[] = $order->invoicedate;
            $row[] = $order->invoiceno;
            $row[] = $order->orderno;
            $row[] = $order->storename;
            $row[] = $order->Firstname; 
            $row[] = $order->Secondname; 
            $row[] = $order->email;      
            $row[] = number_format($order->totals,2);
            $img = $order->file; 
            $imgArray = explode("/", $img);
            $row[] = $imgArray[3];
            $row[] = $order->file;        
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->invoice->count_all(),
                        "recordsFiltered" => $this->invoice->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

  }


  public function fetchInvoiceDetails(){ 

        $orderline = $this->input->get("id");     

        $list = $this->invoice->getInvoiceDetails($orderline);

        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();
            $row[] = $order->id;
            $row[] = $order->invoiceno;
            $row[] = $order->storename;
            $row[] = $order->genericname; 
            $row[] = $order->qty; 
            $row[] = $order->price; 
            $row[] = $order->tax;
            $row[] = $order->description;  
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->invoice->count_all(),
                        "recordsFiltered" => $this->invoice->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

}

public function createPdfTemplate($arrayInvoice,$defaultCompanydetails,$userdetails,$list,$total,$tax,$grandtotal){

        

              $event_id = $arrayInvoice['invoiceno'];
              $relation_id = $userdetails[0]->id;
              $reference = $arrayInvoice['invoiceno'];
              $event_date = $arrayInvoice['invoicedate'];
              $orderno = $list[0]->orderno;
             

              $relation_company = substr($userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname, 0, 35);
              $address = $userdetails[0]->address;
              $contact_person = $userdetails[0]->firstname;
              $zipcode = "254";
              $city = $userdetails[0]->town;
              $country = "Kenya";
              $telephone = $userdetails[0]->phone;
              $title = $userdetails[0]->initial;
              $contact_name = $userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname;
              $country_id = "1";

            

              $content .= "<table cellspacing='0' cellpadding='0' style='width:100%;font-style:calibri;font-size:10px;background: #FFFFFF $export_bg;position: absolute;background-position: center; background-repeat: no-repeat; top: -10px;' border='0'>";
              $content .= "<tr><td rowspan='16' colspan='3'><img src='assets/img/logo.png' width='200' style='width:200px;'/></td><td colspan='7' align='right' style='font-size:22px;font-weight:bold;vertical-align:top;'>$invoice_title</td></tr>";
              $content .= "<tr><td colspan='4'></td><td colspan='3' align='right'>&nbsp;</td></tr>";
              $content .= "<tr><td colspan='4' style='font-size:14px;font-weight:bold;'>".$defaultCompanydetails[0]->companyname."</td><td colspan='3' align='right' style='font-weight:bold;'>".$defaultCompanydetails[0]->bank."</td></tr>";
              $content .= "<tr><td colspan='4'>".$defaultCompanydetails[0]->location."</td><td colspan='3' align='right'>Acc Name: ".$defaultCompanydetails[0]->companyname."</td></tr>";
              $content .= "<tr><td colspan='4'>".$defaultCompanydetails[0]->town."</td><td colspan='3' align='right'>Branch:".$defaultCompanydetails[0]->town."</td></tr>";
              $content .= "<tr><td colspan='4'>".$defaultCompanydetails[0]->address."</td><td colspan='3' align='right'>Acc No: ".$defaultCompanydetails[0]->accountnumber."</td></tr>";
              $content .= "<tr><td colspan='4'>".$defaultCompanydetails[0]->town."</td><td colspan='3' align='right' style='font-weight:bold;'>&nbsp;</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td><td colspan='3' align='right' style='font-weight:bold;'>".$defaultCompanydetails[0]->bank."</td></tr>";
              $content .= "<tr><td colspan='4'>Office Telephone : ".$defaultCompanydetails[0]->telephone1 .",".$defaultCompanydetails[0]->telephone2 ."</td><td colspan='3' align='right'>Acc Name: ".$defaultCompanydetails[0]->accountname."</td></tr>";
              $content .= "<tr><td colspan='4'>Mobile : ".$defaultCompanydetails[0]->telephone2."</td><td colspan='3' align='right'>Branch: ".$defaultCompanydetails[0]->branch."</td></tr>";
              $content .= "<tr><td colspan='4'>Email : ".$defaultCompanydetails[0]->email."</td><td colspan='3' align='right'>Acc No: ".$defaultCompanydetails[0]->accountnumber."</td></tr>";
              $content .= "<tr><td colspan='4'>Website: ".$defaultCompanydetails[0]->website."</td><td colspan='3' align='right'>&nbsp;</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td><td colspan='3' align='right'>MPESA Paybill: ".$defaultCompanydetails[0]->paybill."</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td><td colspan='3' align='right'>Lipa-na-Mpesa: Till No. ".$defaultCompanydetails[0]->tillno."</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td><td colspan='3' align='right'>PIN: ".$defaultCompanydetails[0]->pin."</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td><td align='right' colspan='3' rowspan='2' style='font-size:14px;font-weight:bold;vertical-align:bottom;'>".$arrayInvoice['invoiceno']."</td></tr>";
              $content .= "<tr><td colspan='4'>&nbsp;</td></tr>";

              $content .= "<tr><td style='width:12%'>&nbsp;</td><td style='width:10%'>&nbsp;</td><td style='width:11%'>&nbsp;</td><td style='width:21%'>&nbsp;</td><td style='width:10%'>&nbsp;</td><td style='width:8%'>&nbsp;</td><td style='width:5%'>&nbsp;</td><td style='width:10%'>&nbsp;</td><td style='width:10%'>&nbsp;</td></tr>";

              $addrArr = explode(',',$address);
              $address = implode(",<br>",$addrArr);
              $content .= "<tr><td colspan='2' style='padding-top:5px;padding-bottom:5px;font-weight:bold;font-size:11px;color:#000;'>Invoice Address</td><td>&nbsp;</td><td colspan='3' style='padding-top:5px;padding-bottom:5px;font-weight:bold;font-size:11px;color:#000;'>Delivery Address</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
              $content .= "<tr><td colspan='2'>$relation_company</td><td>&nbsp;</td><td  colspan='3'>$relation_company</td><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>";
              $content .= "<tr><td colspan='2'>$contact_person</td><td>&nbsp;</td><td  colspan='3'>$contact_person</td><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>";
              $content .= "<tr><td colspan='2'>$address-$zipcode</td><td>&nbsp;</td><td colspan='3'>$address-$zipcode</td><td>&nbsp;</td><td>&nbsp;</td><td></td></tr>";
              $content .= "<tr><td colspan='2'>$city</td><td>&nbsp;</td><td colspan='3'>$city</td><td>&nbsp;</td><td>&nbsp;</td><td ></td></tr>";

              $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
              $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";

             

              $content .= "<tr style='font-size:10px;color:#000;font-weight:bold;'><td style='padding-top:5px;padding-bottom:5px;border-bottom: 1px #000 solid;'>Invoice No.</td><td style='border-bottom: 1px #000 solid;'>Invoice Date</td><td style='border-bottom: 1px #000 solid;'>Order Number</td><td style='border-bottom: 1px #000 solid;'>Ship by</td><td style='border-bottom: 1px #000 solid;'>Cust. No.</td><td style='border-bottom: 1px #000 solid;' colspan='2'>Contact</td><td colspan='2' style='border-bottom: 1px #000 solid;'>Account Manager</td></tr>";
              $content .= "<tr><td>$reference</td><td>$event_date</td><td>$orderno</td><td>$shipping_name</td><td>$relation_id</td><td colspan='2'>$title. $contact_name</td><td colspan='2'>$employee_name</td></tr>";

              $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
              $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";

              $content .= "<tr style='font-size:10px;color:#000;font-weight:bold;'><td style='padding-top:5px;padding-bottom:5px;border-bottom: 1px #000 solid;'>Part No.</td><td colspan='5' style='border-bottom: 1px #000 solid;'>Description</td><td style='border-bottom: 1px #000 solid;text-align:right;'>Quantity</td><td style='border-bottom: 1px #000 solid;text-align:right;'>Unit Price</td><td style='border-bottom: 1px #000 solid;text-align:right;'>Total Excl.</td></tr>";
              $content .= "<tr><td>&nbsp;</td><td colspan='5'>&nbsp;</td><td style='vertical-align:top;text-align:right;'>&nbsp;</td><td style='vertical-align:top;text-align:right;font-weight:bold;'>KSH</td><td style='vertical-align:top;text-align:right;font-weight:bold;'>KSH</td></tr>";
              $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";


             foreach ($list as $orderL) {
              if($orderL->price < 0) { $productdescription = "Coupon Discount"; }else{ $productdescription = $orderL->genericname; }


                  $sub_total = str_replace(",", "", number_format($orderL->price, 2)) * $orderL->qty;

                  $content .= "<tr><td style='width:10%;padding-top:-10px;padding-bottom:0px;'>{$orderL->id}<br></td><td colspan='5' style='width:50%; word-wrap: break-word;'>{$productdescription} <br/><span style='font-weight:bold;'>{$row3["Warranty"]}</span><br/><span style='font-weight:bold;'>{$row3["Discount"]}</span></td><td style='vertical-align:top;text-align:right;width:5%;'>".$orderL->qty."</td><td style='vertical-align:top;text-align:right;width:10%;'>" . number_format($orderL->price, 2) . "</td><td style='vertical-align:top;text-align:right;width:10%;'>" . number_format($sub_total, 2) . "</td></tr>";
                  $content .= "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
                  $vat_perc = $row3["Tax"];

                  $vat = $sub_total * $orderL;

                  $vat_total = $vat_total + round($vat, 4);

                  $total_excl = $total_excl + $sub_total;
              }

              if ($shipping > 0) {
                
                    $shipping_vat = $shipping;  
                
                  $shipping_vat = $shipping * $vat_perc;   
                  $vat_total = $vat_total + $shipping_vat;
                  $total_sub = $total_excl + $shipping;
                  $padding_bottom = 250;

                  $total_incl = $total_sub + $vat_total;
              } else {
                  $padding_bottom = 200;

                  $total_excl = $total_excl;
                  $vat_total = $vat_total;

                  $total_incl = $total_excl + $vat_total;
              }
      

              $content .= "</table>";

              $content .= "<table cellspacing='0' cellpadding='0' style='width:100%;font-style:calibri;font-size:11px;position: absolute;bottom:{$padding_bottom}px;' border='0'>";
              $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#ffffff;background-color: #8d8f92;' colspan='2'>&nbsp;</td></tr>";
              $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>Total Sub</td><td align='right' style='font-weight:bold;'>" . number_format($total, 2) . "</td></tr>";


              if ($shipping <> 0) {
                  $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>Shipping Cost</td><td align='right' style='font-weight:bold;'>" . number_format($shipping, 2) . "</td></tr>";
              }

              if ($order_cost <> 0) {
                  $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>Order Cost</td><td align='right' style='font-weight:bold;'>" . number_format(0, 2) . "</td></tr>";
              }

              if ($discount <> 0) {
                  $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>Discount</td><td align='right' style='font-weight:bold;'>" . number_format($discount, 2) . "</td></tr>";
              }

              if ($shipping <> 0 || $discount <> 0) {
                  $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>Total</td><td align='right' style='font-weight:bold;'>" . number_format($total, 2) . "</td></tr>";
              }

              $content .= "<tr><td style='padding:5px;'>&nbsp;</td><td colspan=3'></td><td style='font-size:10px;color:#000;background-color: #eee;'>VAT <span style='font-weight:bold;'>" . number_format($vat_perc * 100, 0) . "%</span></td><td align='right' style='font-weight:bold;'>" . number_format($tax, 2) . "</td></tr>";

              $content .= "<tr><td style='padding:5px;width:22%;'>&nbsp;</td><td colspan=3' style='width:58%;'></td><td style='font-size:10px;color:#000;background-color: #eee;width:10%;'>Grand Total</td><td align='right' style='font-weight:bold;width:10%;'>" . number_format($grandtotal, 2) . "</td></tr>";

              $content .= "<tr style='font-size:10px;color:#ffffff;background-color: #8d8f92;'><td style='padding:5px;'>Terms of payment</td><td style='width:5%;'>Cash</td><td style='width:5%;'>Bank</td><td style='width:5%;'>Paybill</td><td style=''>On account</td><td colspan='2'>Lipa-na-Mpesa</td></tr>";

              $content .= "<tr style='font-size:10px;color:#000;background-color: #eee;'><td style='padding:5px;'>$payment_name</td><td style='font-weight:bold;'>$grandtotal</td><td style='font-weight:bold;'>$bank_amount</td><td style='font-weight:bold;'>$mpesa_amount</td><td  style='font-weight:bold;'>" . $cheque_amount . "</td><td colspan='2' align='right'>" . $lipa_na_mpesa_amount . "</td></tr>";

              $content .= "<tr><td colspan=6'>&nbsp;</td></tr>";
              $content .= "<tr><td colspan=6'>&nbsp;</td></tr>";
              $content .= "<tr><td style='padding-bottom:5px;color:#8d8f92;font-size:9px;border-bottom:1px solid #d0d0d2;' colspan=6'>Thank you for your order. Please state invoice and customer number on your payment</td></tr>";
              $content .= "<tr><td style='padding-top:5px;color:#8d8f92;font-size:9px;' colspan=6'>Our general terms and conditions of sale are applicable to all our deliveries and quotations</td></tr>";
              $content .= "</table>";

          

//var_dump($content); exit();
return $content;

}


function fetchInvoiceFilter(){

       $storeid = $this->input->get("id"); 

        $list = $this->invoice->getFilterInvoices($storeid);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();
            $row[] = $order->id;
            $row[] = $order->invoicedate;
            $row[] = $order->invoiceno;
            $row[] = $order->orderno;
            $row[] = $order->storename;
            $row[] = $order->Firstname; 
            $row[] = $order->Secondname; 
            $row[] = $order->email; 
            $row[] = number_format($order->totals,2);
            $row[] = $order->file;        
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->invoice->count_all(),
                        "recordsFiltered" => $this->invoice->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

}


function fetchFilterInvoicesCat(){

       $storeid = $this->input->get("id"); 
       $cat = $this->input->get("cat"); 

        $list = $this->invoice->getInvoicesCatFilter($storeid,$cat);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();
            $row[] = $order->id;
            $row[] = $order->invoicedate;
            $row[] = $order->invoiceno;
            $row[] = $order->orderno;
            $row[] = $order->storename;
            $row[] = $order->Firstname; 
            $row[] = $order->Secondname; 
            $row[] = $order->email;      
            $row[] = number_format($order->totals,2);
            $row[] = $order->file;                
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->invoice->count_all(),
                        "recordsFiltered" => $this->invoice->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);

}


 
}
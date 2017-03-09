<?php
defined('BASEPATH') or exit('No direct script access allowed');

//define('WSDL','http://192.168.1.207/pharmaceuticals/index.php/ws:wsdl?wsdl');

//define('WSDL','http://pharm-portal.coreict.co.ke/index.php/ws:wsdl?wsdl');

define('WSDL','https://tibamoja.co.ke/index.php/ws:wsdl?wsdl');

class Services extends CI_Controller
{

     

    function __construct() 
    {
        parent::__construct();
        $this->load->database(); 
        //$this->load->model('Cds'); //load your models here      
        $this->load->library("Nusoap_library"); //load the library here
        $this->nusoap_server = new soap_server();
        $this->nusoap_server->configureWSDL("Pharmaceuticals Soap Server", "urn:PharmaceuticalsSoapServer");
        $this->nusoap_server->wsdl->schemaTargetNamespace = 'urn:PharmaceuticalsSoapServer';

        //DATA TYPES
        $this->nusoap_server->wsdl->addComplexType(
            'Userstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'username' => array('name' => 'username', 'type' => 'xsd:string'),
                'pass' => array('name' => 'pass', 'type' => 'xsd:string'),
                'personid' => array('name' => 'titel', 'type' => 'xsd:integer'),
                'homelat' => array('name' => 'homelat', 'type' => 'xsd:string'),
                'homelon' => array('name' => 'homelon', 'type' => 'xsd:string'),
                'worklat' => array('name' => 'homelon', 'type' => 'xsd:string'),
                'worklon' => array('name' => 'worklon', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string')
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "UsernameArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Userstruct[]")
            ),
            "tns:Userstruct"
        );


       //pharmacy

        $this->nusoap_server->wsdl->addComplexType(
            'Pharmacystruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'storename' => array('name' => 'storename', 'type' => 'xsd:string'),
                'location' => array('name' => 'location', 'type' => 'xsd:string'),
                'address' => array('name' => 'address', 'type' => 'xsd:string'),
                'telephone' => array('name' => 'telephone', 'type' => 'xsd:string'),
                'email' => array('name' => 'email', 'type' => 'xsd:string'),
                'latitude' => array('name' => 'latitude', 'type' => 'xsd:string'),
                'longitude' => array('name' => 'longitude', 'type' => 'xsd:string'),
                'additionalservices' => array('name' => 'additionalservices', 'type' => 'xsd:string')
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "PharmacyArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Pharmacystruct[]")
            ),
            "tns:Pharmacystruct"
        );

     //create a structure for normal result output
        $this->nusoap_server->wsdl->addComplexType(
            'resultstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'response' => array('name' => 'response', 'type' => 'xsd:string'),
                'message' => array('name' => 'message', 'type' => 'xsd:string')               
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "resultsArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:resultstruct[]")
            ),
            "tns:resultstruct"
        );


      //user

     $this->nusoap_server->wsdl->addComplexType(
            'Userdetailstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'initial' => array('name' => 'initial', 'type' => 'xsd:string'),
                'firstname' => array('name' => 'firstname', 'type' => 'xsd:string'),
                'secondname' => array('name' => 'secondname', 'type' => 'xsd:string'),
                'phone' => array('name' => 'phone', 'type' => 'xsd:string'),
                'email' => array('name' => 'email', 'type' => 'xsd:string'),
                'address' => array('name' => 'address', 'type' => 'xsd:string'),
                'nationalid' => array('name' => 'nationalid', 'type' => 'xsd:string'),
                'town' => array('name' => 'town', 'type' => 'xsd:string'),
                'homelat' => array('name' => 'homelat', 'type' => 'xsd:string'),
                'homelon' => array('name' => 'homelon', 'type' => 'xsd:string'),
                'worklat' => array('name' => 'worklat', 'type' => 'xsd:string'),
                'worklon' => array('name' => 'worklon', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string'),          
                'homeaddress' => array('name' => 'homeaddress', 'type' => 'xsd:string')            
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "UserdetailsArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Userdetailstruct[]")
            ),
            "tns:Userdetailstruct"
        );


        //products

        $this->nusoap_server->wsdl->addComplexType(
            'Productstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'productid' => array('name' => 'productid', 'type' => 'xsd:string'),
                'serialno' => array('name' => 'serialno', 'type' => 'xsd:string'),
                'genericname' => array('name' => 'genericname', 'type' => 'xsd:string'),
                'drugprice' => array('name' => 'drugprice', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string'),
                'tax' => array('name' => 'tax', 'type' => 'xsd:string')                
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "ProductsArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Productstruct[]")
            ),
            "tns:Productstruct"
        );


         $this->nusoap_server->wsdl->addComplexType(
            'PrescriptionMedstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'productid' => array('name' => 'productid', 'type' => 'xsd:string'),
                'serialno' => array('name' => 'serialno', 'type' => 'xsd:string'),
                'genericname' => array('name' => 'genericname', 'type' => 'xsd:string'),
                'drugprice' => array('name' => 'drugprice', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string'),
                'tax' => array('name' => 'tax', 'type' => 'xsd:string'),
                'dose' => array('name' => 'dose', 'type' => 'xsd:string'), 
                'minimumdose' => array('name' => 'minimumdose', 'type' => 'xsd:string'), 
                'maximumdose' => array('name' => 'maximumdose', 'type' => 'xsd:string'),
                'refilldate' => array('name' => 'refilldate', 'type' => 'xsd:string'),
                'startdate' => array('name' => 'startdate', 'type' => 'xsd:string') , 
                'enddate' => array('name' => 'enddate', 'type' => 'xsd:string')                    
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "PrescriptionArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:PrescriptionMedstruct[]")
            ),
            "tns:PrescriptionMedstruct"
        );

        //product review and rating
        $this->nusoap_server->wsdl->addComplexType(
            'Invoicestruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'invoiceno' => array('name' => 'invoiceno', 'type' => 'xsd:string'),
                'amount' => array('name' => 'amount', 'type' => 'xsd:string'),
                'tax' => array('name' => 'tax', 'type' => 'xsd:string'),
                'currency' => array('name' => 'currency', 'type' => 'xsd:string'),
                'file' => array('name' => 'file', 'type' => 'xsd:string')              
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "InvoiceArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Invoicestruct[]")
            ),
            "tns:Invoicestruct"
        );

      //product review and rating
        $this->nusoap_server->wsdl->addComplexType(
            'Reviewstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'title' => array('name' => 'title', 'type' => 'xsd:string'), 
                'reviewdate' => array('name' => 'reviewdate', 'type' => 'xsd:string'), 
                'firstname' => array('name' => 'firstname', 'type' => 'xsd:string'), 
                'secondname' => array('name' => 'secondname', 'type' => 'xsd:string'), 
                'surname' => array('name' => 'surname', 'type' => 'xsd:string'), 
                'email' => array('name' => 'email', 'type' => 'xsd:string'),
                'productid' => array('name' => 'productid', 'type' => 'xsd:string'),
                'serialno' => array('name' => 'serialno', 'type' => 'xsd:string'),
                'genericname' => array('name' => 'genericname', 'type' => 'xsd:string'),
                'rating' => array('name' => 'rating', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string'),
                'comments' => array('name' => 'comments', 'type' => 'xsd:string')               
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "ReviewArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Reviewstruct[]")
            ),
            "tns:Reviewstruct"
        );

       //prescrption uploads

        $this->nusoap_server->wsdl->addComplexType(
            'Prescriptionstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'uploadate' => array('name' => 'productid', 'type' => 'xsd:string'),
                'filename' => array('name' => 'serialno', 'type' => 'xsd:string'),
                'path' => array('name' => 'genericname', 'type' => 'xsd:string'),
                'patientid' => array('name' => 'drugprice', 'type' => 'xsd:string')              
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "PrescriptionUploadArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Prescriptionstruct[]")
            ),
            "tns:Prescriptionstruct"
        );

        //coupon

        $this->nusoap_server->wsdl->addComplexType(
            'Couponstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'code' => array('name' => 'code', 'type' => 'xsd:string'),
                'amount' => array('name' => 'amount', 'type' => 'xsd:string'),
                'status' => array('name' => 'status', 'type' => 'xsd:string')              
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "CouponArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Couponstruct[]")
            ),
            "tns:Couponstruct"
        );

       //patient order struct

        $this->nusoap_server->wsdl->addComplexType(
            'PatientOrderstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'patientid' => array('name' => 'productid', 'type' => 'xsd:string'),
                'drugid' => array('name' => 'serialno', 'type' => 'xsd:integer'),
                'refilldate' => array('name' => 'genericname', 'type' => 'xsd:string'),
                'qty' => array('name' => 'drugprice', 'type' => 'xsd:string'),
                'price' => array('name' => 'img', 'type' => 'xsd:string'),
                'img' => array('name' => 'img', 'type' => 'xsd:string'), 
                'comments' => array('name' => 'comments', 'type' => 'xsd:string')                       
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "PatientOrdersArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:PatientOrderstruct[]")
            ),
            "tns:PatientOrderstruct"
        );



      //categories

        $this->nusoap_server->wsdl->addComplexType(
            'Categoriesstruct',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id' => array('name' => 'id', 'type' => 'xsd:integer'),
                'categoryname' => array('name' => 'categoryname', 'type' => 'xsd:string'),
                'description' => array('name' => 'description', 'type' => 'xsd:string')             
            )
        );

        $this->nusoap_server->wsdl->addComplexType(
            "CategoriesArray",
            "complexType",
            "array",
            "",
            "SOAP-ENC:Array",
            array(),
            array(
                array("ref"=>"SOAP-ENC:arrayType","wsdl:arrayType"=>"tns:Categoriesstruct[]")
            ),
            "tns:Categoriesstruct"
        );

        //REGISTRATION
 
        $this->nusoap_server->register(
            'getUserInfo',
            array('id' => 'xsd:integer'),  //parameters
            array('return' => 'tns:Userstruct'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getUserInfo',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get info of employee basing on the user id' //description
        );

         $this->nusoap_server->register(
            'getUsers',
            array(),  //parameters
            array('return' => 'tns:UsernameArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getUsers',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all Users' //description
        );


        // Register the  upload file method
        $this->nusoap_server->register('uploadPrescriptionFile',                                           // method
                array('patientid' => 'xsd:string','file' => 'xsd:string','location' => 'xsd:string'),    // input parameters
                array('return' => 'xsd:string'),                             // output parameters
                'urn:PharmaceuticalsSoapServer',                                            // namespace
                'urn:PharmaceuticalsSoapServer#uploadPrescriptionFile',                                // soapaction
                'rpc',                                                       // style
                'encoded',                                                   // use
                'Uploads the prescription file to the server'                                // documentation
            );

      //pharmacy registration
      $this->nusoap_server->register(
            'getPharmacies',
            array(),  //parameters
            array('return' => 'tns:PharmacyArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPharmacies',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all pharmacy registered' //description
        );

    //categories registration
      $this->nusoap_server->register(
            'getCategories',
            array(),  //parameters
            array('return' => 'tns:CategoriesArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getCategories',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all drug categories' //description
        );


    //products registration
      $this->nusoap_server->register(
            'getProducts',
            array('storeid' => 'xsd:integer'),
            array('return' => 'tns:ProductsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getProducts',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all drug available in a particular store' //description
        );

    //product review/ratings registration
    $this->nusoap_server->register(
            'getReview',
            array('drugid' => 'xsd:integer'),
            array('return' => 'tns:ReviewArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getReview',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get the product review by the patient' //description
        );

    //get all product review/ratings registration
    $this->nusoap_server->register(
            'getAllReview',
            array('rating' => 'xsd:integer'),
            array('return' => 'tns:ReviewArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getAllReview',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all reviews of a product basing on a rating' //description
        );


    //patient orders registration
      $this->nusoap_server->register(
            'getPatientOrders',
            array('patientid' => 'xsd:integer'),
            array('return' => 'tns:PatientOrdersArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPatientOrders',  //soapaction
            'rpc', // style
            'encoded', // use
            'Fetches all the orders made by the patient' //description
        );


    //patient unconfirmed orders registration
      $this->nusoap_server->register(
            'getPatientUnconfirmedOrders',
            array('patientid' => 'xsd:integer'),
            array('return' => 'tns:PatientOrdersArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPatientUnconfirmedOrders',  //soapaction
            'rpc', // style
            'encoded', // use
            'When an order is made it needs to be confirmed by the admin, this fetches unconfirmed orders' //description
        );

    //patient unconfirmed orders registration
      $this->nusoap_server->register(
            'getPatientInvoices',
            array('patientid' => 'xsd:integer'),
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPatientInvoices',  //soapaction
            'rpc', // style
            'encoded', // use
            'Fetch patients Invoices' //description
        );

  //products search using key word registration
      $this->nusoap_server->register(
            'searchProductkeyWord',
            array('drugname' => 'xsd:string'),
            array('return' => 'tns:ProductsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#searchProductkeyWord',  //soapaction
            'rpc', // style
            'encoded', // use
            'Search a drug using the name of the drug' //description
        );

    //products search using category registration
      $this->nusoap_server->register(
            'getProductCategory',
            array('categoryname' => 'xsd:string'),
            array('return' => 'tns:ProductsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getProductCategory',  //soapaction
            'rpc', // style
            'encoded', // use
            'Search a drug using the catgegory of the drug' //description
        );


  //fetch uploaded prescription for the patient
      $this->nusoap_server->register(
            'getPrescriptionUpload',
            array('patientid' => 'xsd:string'),
            array('return' => 'tns:PrescriptionUploadArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPrescriptionUpload',  //soapaction
            'rpc', // style
            'encoded', // use
            'Fetch uploaded prescriptions' //description
        );

   //fetch uploaded prescription for the patient
      $this->nusoap_server->register(
            'getPrescription',
            array('patientid' => 'xsd:string'),
            array('return' => 'tns:PrescriptionArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getPrescription',  //soapaction
            'rpc', // style
            'encoded', // use
            'Fetch the patient prescribed medicines' //description
        );


     //fetch user details
      $this->nusoap_server->register(
            'getUserdetailsCall',
            array('userid' => 'xsd:string'),
            array('return' => 'tns:UserdetailsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getUserdetailsCall',  //soapaction
            'rpc', // style
            'encoded', // use
            'Fetch the user details' //description
        );


    //products search using category registration
      $this->nusoap_server->register(
            'getProductCoupon',
            array(),
            array('return' => 'tns:CouponArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getProductCoupon',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get coupons associated by the product' //description
        );

    //products search registration ---------------------------------------------------------
      $this->nusoap_server->register(
            'searchProduct',
            array('storeid' => 'xsd:string','drugname' => 'xsd:string'),  //parameters
            array('return' => 'tns:ProductsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getProducts',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all drug available in a particular store' //description
        );

      //create new order registration
     $this->nusoap_server->register(
            'createOrder',
            array('drugid' => 'xsd:string','patientid' => 'xsd:string','qty' => 'xsd:string','parameters'=> 'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#createOrder',  //soapaction
            'rpc', // style
            'encoded', // use
            'Create an order' //description
        );

 //create new user
     $this->nusoap_server->register(
            'createUser',
            array('fullname' => 'xsd:string','email' => 'xsd:string' ,'pass' => 'xsd:string','pass' => 'xsd:string','homelat' => 'xsd:string','homelon' => 'xsd:string','worklat' => 'xsd:string','worklon' => 'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#createUser',  //soapaction
            'rpc', // style
            'encoded', // use
            'Sign up a new user into the system' //description
        );

    //do payment
    $this->nusoap_server->register(
            'payInvoice',
            array('invoiceno' => 'xsd:string','amount' => 'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#payInvoice',  //soapaction
            'rpc', // style
            'encoded', // use
            'Invoice Payment' //description
        );


 //refill drug
    $this->nusoap_server->register(
            'reFillPatientMeds',
            array('parameters' => 'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#reFillPatientMeds',  //soapaction
            'rpc', // style
            'encoded', // use
            'Refill a drug of the patient' //description
        );

//update user details
  $this->nusoap_server->register(
            'userdetailsUpdate',
            array('parameters' => 'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#userdetailsUpdate',  //soapaction
            'rpc', // style
            'encoded', // use
            'Update  user details' //description
        );

      //create new order registration
     $this->nusoap_server->register(
            'createReview',
            array('drugid' => 'xsd:string','rating' => 'xsd:string','comments' => 'xsd:string','patientid'=> 'xsd:string' ,'title'=>'xsd:string'),  //parameters
            array('return' => 'tns:resultsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#createReview',  //soapaction
            'rpc', // style
            'encoded', // use
            'Post a review/rating of a product' //description
        );

    //all products  registration ---------------------------------------------------------
     $this->nusoap_server->register(
            'getallProduct',
            array('from' => 'xsd:string','to' => 'xsd:string'),          
            array('return' => 'tns:ProductsArray'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#getallProduct',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all drug available in a particular store' //description
        );


      //login check registration
        $this->nusoap_server->register(
            'loginCheck',
            array('username' => 'xsd:string','pass' => 'xsd:string'),  //parameters
            array('return' => 'tns:Userstruct'),  //output
            'urn:PharmaceuticalsSoapServer',   //namespace
            'urn:PharmaceuticalsSoapServer#loginCheck',  //soapaction
            'rpc', // style
            'encoded', // use
            'Authorize user to login' //description
        );


        
        //IMPLEMENTATION  

      function getUserInfo($id)
        {
            $ci =& get_instance();
            $ci->db->where('id', $id); 
            $qcd = $ci->db->get('users');
            if ($qcd->num_rows()>0) {
                return $qcd->row_array();
            } else {
                return false;
            }
            
        }

        function getUsers()
        {
            $ci =& get_instance();
 
            $ci->load->model('Login'); 

            $qcd = $ci->Login->get_all_items(); //loaded via model        

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }            
        }

    function loginCheck($username,$pass)
        {
           try {

            $ci =& get_instance();
            
            $arrayUser = array('username' => $username, 'pass' => $pass);

            $ci->load->model('Login'); 

            $qcd = $ci->Login->login_check($arrayUser);
    
            if ($qcd->num_rows()>0) {
                return $qcd->row_array();
            } else {
                return false;
            }

            } catch (Exception $e) {
               echo 'Caught exception: ',  $e->getMessage(), "\n";
          }
            
        }


    function getPharmacies()
        {

            $ci =& get_instance();
 
            $ci->load->model('Pharmacy'); 

            $qcd = $ci->Pharmacy->get_all_items();       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }            
    
        }



    function getCategories()
        {

            $ci =& get_instance();
 
            $ci->load->model('Cat'); 

            $qcd = $ci->Cat->get_all_items();       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }            
    
        }

    function getProducts($storeid)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchProduct($storeid);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function getReview($drugid)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchReview($drugid);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }

    function createReview($drugid,$rating,$comments,$patientid,$title)
        {          

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

              $array = array(
                    'drugid' => $drugid,
                    'rating' => $rating,
                    'comments' => $comments,
                    'patientid' => $patientid,
                    'title' => $title,
                    'reviewdate'=>date('Y-m-d H:i:s')
                );             

            $response = $ci->Drug->creatReview($array);  

            $ret_val=array();

            $ret_val[0]["response"] = $response;
           
            return $ret_val;              

        }

    function getAllReview($rating)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchAllReview($rating);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function getPatientOrders($patientid)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchPatientOrders($patientid);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function getPatientUnconfirmedOrders($patientid)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchPatientUnconfirmedOrders($patientid);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function getPatientInvoices($patientid)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $qcd = $ci->Drug->fetchPatientInvoices($patientid);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function searchProductkeyWord($drugname)
        {  
     
            $ci =& get_instance();

            $ci->load->model('Drug');

            $arraySearch = array('drugname' => $drugname); 

            $qcd = $ci->Drug->searchKeyword($arraySearch);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }


   function getProductCategory($categoryname)
        {  
     
            $ci =& get_instance();

            $ci->load->model('Drug');

            $arraySearch = array('categoryname' => $categoryname); 

            $qcd = $ci->Drug->getDrugCategory($arraySearch);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }

 function getPrescriptionUpload($patientid)
        {  
     
            $ci =& get_instance();

            $ci->load->model('Drug');

            $arraySearch = array('patientid' => $patientid); 

            $qcd = $ci->Drug->getPrescriptionUpload($arraySearch);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }

 function getPrescription($patientid)
        {  
     
            $ci =& get_instance();

            $ci->load->model('Drug');

            $arraySearch = array('patientid' => $patientid); 

            $qcd = $ci->Drug->getPrescription($arraySearch);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }


  function getUserdetailsCall($userid)
        { 
     
            $ci =& get_instance();

            $ci->load->model('Users');           

            $qcd = $ci->Users->fetchUserDetails($userid);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }


    function getProductCoupon()
        {  
     
            $ci =& get_instance();

            $ci->load->model('Drug');            

            $qcd = $ci->Drug->getDrugCoupon(null);       
 
            if ($qcd->num_rows()>0) {

                $ret_val = array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;

            } else {

                return false;

            }    

        }


    function searchProduct($storeid,$drugname)
        {   
       

            $ci =& get_instance();
 
            $ci->load->model('Drug'); 

            $arraySearch = array('storeid' => $storeid, 'drugname' => $drugname);

            $qcd = $ci->Drug->searchProduct($arraySearch);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }


    function userdetailsUpdate($parameters)
        { 

         $ci =& get_instance();

         $ret_val=array();

        $parameters = json_decode($parameters);  
        $myArrayUpdate = array(
                "userid"=> $parameters->userid,
                "initial"=> $parameters->initial, 
                "firstname"=> $parameters->firstname, 
                "secondname"=> $parameters->secondname, 
                "surname"=> $parameters->surname,
                "gender"=> $parameters->gender, 
                "dob"=> $parameters->dob, 
                "nationalid"=> $parameters->nationalid, 
                "address"=> $parameters->address, 
                "phone"=> $parameters->phone, 
                "town"=> $parameters->town, 
                "email"=> $parameters->email, 
                "homelat"=> $parameters->homelat, 
                "homelon"=> $parameters->homelon, 
                "worklat"=> $parameters->worklat, 
                "worklon"=> $parameters->worklon, 
                "homeaddress"=> $parameters->homeaddress, 
                "pass"=> $parameters->pass 
                );

        $ci->load->model('Users','user'); 
        
        $response = $ci->user->updateRecord($myArrayUpdate);        

        $ret_val[0]["response"] = $response;


           return $ret_val;
        }


    function reFillPatientMeds($parameters)
        { 
            require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");

            $ci =& get_instance();

            $ret_val=array(); 

            $parameters = json_decode($parameters); 

            $patientid = $parameters->patientID;

            $storeId = 1 ;

            $ci->load->model('Users','user');

            $ci->load->model('Order','ordermain');

            $ci->load->model('Invoice','invoice');

            $userdetails = $ci->user->fetchRecord($patientid);

            $ci->load->model('Transactions','transactions');

            foreach ($parameters->Products as $key => $drugIds) {               

                $response = $ci->transactions->createInvoiceTransactionExpress($patientid,$drugIds->drugID,$drugIds->qty,$coupon,null,null); // create a new pending Order 

            }

            $patientid = $userdetails[0]->id; 

            $ci->load->model('Prescriptionupload','prescupload');

            $list = $ci->prescupload->fetchInvoiceRefill($patientid);           

            //send an invoice
            $listsmtp = $ci->ordermain->fetchsmtp(); 

            $smtparray = $listsmtp->row_array();

            $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']); 


            $defaultCompanydetails = $ci->user->fetchDefaultCompany();

            $currentdate = date('d/m/Y'); 


           require_once("Coupon.php");

           $coupon = new Coupon();



            $myArrayOrder = array("length"=>3,"prefix"=>"OD-");

             $orderno =   $coupon->generate($myArrayOrder);     

       

             $maxinvno = $ci->ordermain->getMaxOrder(); 
          
             $increament =  $maxinvno[0]->max +1;     

             $orderno =  $orderno."-".$increament; 


            $totals = $ci->prescupload->getInvoiceTotals($storeid,$patientid,$type);  
          
            $tax = $ci->prescupload->getInvoiceTax($storeid,$patientid,$type); 

            $grandtotal = $totals[0]->totals + $tax[0]->tax;  



             $arrayOrder = array(
                          'orderno' => $orderno,
                          'orderdate' => date('Y-m-d H:i:s'),
                          'amount' =>  $totals[0]->totals,
                          'tax' => $tax[0]->tax,
                          'currency' => 'KES',
                          'patientid' => $list[0]->user
                      );        

             $newid = $ci->ordermain->createOrder($arrayOrder); 
    
         // insert the items
           foreach ($list as $orderitems) {
               $arrayItems = array(
                        'orderno' => $orderno ,
                        'createdate' => date('Y-m-d H:i:s'),
                        'itemid' => $orderitems->id,
                        'parentid' => $newid
                    );          

            $ci->ordermain->createOrderItems($arrayItems); 

            } 

           $myArray = array("length"=>3,"prefix"=>"INV-");

           $code =   $coupon->generate($myArray);  

           $maxinvno = $ci->invoice->getMaxInv(); 

           $increament =  $maxinvno[0]->max +1; 

           $code =  $code."-".$increament;


           $arrayInvoice = array(
                        'invoiceno' => $code ,
                        'invoicedate' => date('Y-m-d H:i:s'),
                        'amount' =>  $totals[0]->totals,
                        'tax' => $tax[0]->tax,
                        'currency' => 'KES',
                        'orderno'=>$orderno,
                        'patientid' => $list[0]->user
                    );          

           $newid = $ci->invoice->createInvoice($arrayInvoice); 

          // insert the items
           foreach ($list as $orderitems) {
               $array = array(
                        'invoiceno' => $code ,
                        'invoicedate' => date('Y-m-d H:i:s'),
                        'itemid' => $orderitems->id,
                        'parentid' => $newid
                    );          

            $ci->invoice->createInvoiceItems($array); 

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
                    <div class="wrapper">
                      <!-- Main content -->
                      <div class="invoice">
                        <!-- title row -->
                        <div class="row">
                          <div class="col-xs-12">
                            <h2 class="page-header">
                              <i class="fa fa-globe"></i> Pharmacy System | Invoice 
                              <small class="pull-right">Date: '.$currentdate.'</small>
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

                                       //$totalex += $orderL->price;

                                        //if($orderL->tax){
                                         // $tax =  $tax + ((int)$orderL->tax/100 * $totalex);   
                                      //  }                                     


                                        $array = array(
                                                'description' => 'Invoice sent',
                                                'comments' => 'Invoiced'
                                            );          

                                       $ci->invoice->saveRecord($array,$orderL->id); // temporary halt flaging the invoice

                                }

                              //$grandtot =  $totalex  + $tax ;

                              $body .= '</tbody>
                                    </table>
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                  <div class="row">
                                  <!-- accepted payments column -->
                                  <div class="col-xs-6">

                                   <!-- <img src="http://tibamoja.co.ke/assets/img/credit/visa.png" alt="Visa">
                                    <img src="http://tibamoja.co.ke/assets/img/credit/mastercard.png" alt="Mastercard">
                                    <img src="http://tibamoja.co.ke/assets/img/credit/american-express.png" alt="American Express">
                                    <img src="http://tibamoja.co.ke/assets/img/credit/paypal2.png" alt="Paypal">-->

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
                                          <td align="right">'.number_format($totals[0]->tax,2).'</td>
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


                          $ret_val[1]["response"] = $code;
                          $ret_val[2]["response"] = $response;
                         
                         
           return $ret_val;
        }



    function payInvoice($invoiceno,$amount)
        {  
            $ci =& get_instance();         

            $ci->load->model('Invoice','invoice');

            $userDetails = $ci->invoice->fetchUserInvoice($invoiceno); 

            $ret_val=array();          

            require_once "AfricasTalkingGateway.php";

            $username = "tibamoja";

/*            $apiKey   = "7c79e4daca5dd1a15988bf86a177617bb19847404f2a25adb0eb89be7ad0cd7d";
            $gateway = new AfricasTalkingGateway($username, $apiKey, "sandbox");
            $productName  = "tibamoja"; */

            $apiKey   = "1caae1e1ac826fd71a382211cfff7ab363c88c3966c262301f9c2c298d235c83";
            $gateway = new AfricasTalkingGateway($username, $apiKey);
            $productName  = "tiba"; 
       
                 
            $phoneNumber  = $userDetails[0]->phone; $ret_val[0]["message"] = $phoneNumber;        
            $currencyCode = "KES";           
            $amount       = $amount;       
            $metadata     = array("Payment details"   => "Client name :". $userDetails[0]->firstname." ".$userDetails[0]->secondname,
                                  "productId" => $invoiceno);
            try {
            
              $transactionId = $gateway->initiateMobilePaymentCheckout($productName,
                                           $phoneNumber,
                                           $currencyCode,
                                           $amount,
                                           $metadata);

              $ret_val[0]["response"] =  "Transaction Id ".$transactionId;

              $ret_val[0]["message"] = "Payment from ". $userDetails[0]->firstname." ".$userDetails[0]->secondname;            
            

            }
            catch(AfricasTalkingGatewayException $e){
               $ret_val[0]["message"] = "Received error response: ".$e->getMessage();
            }  

         return $ret_val;

        }

    function createUser($fullname,$email,$pass,$homelat,$homelon,$worklat,$worklon)
        {  

          $ret_val=array();
          $ci =& get_instance();         

          $ci->load->model('Users','signup');
  
          $userRecord = $ci->signup->fetchUser($email); 

          if($userRecord[0]->id){
                $ret_val[0]["response"] = "Username  ".$userRecord[0]->email." already exists!";
                return $ret_val;
          }else{         

            $ret_val[0]["response"] = "Creating new User..";
            $ret_val[1]["response"] = $pass;
          

            $namesArray = explode(" ", $fullname); 

                 $array = array(
                    'firstname' => $namesArray[0] ,
                    'secondname' => $namesArray[1] ,
                    'homelat' => $homelat ,
                    'homelon' => $homelon ,
                    'worklat' => $worklat ,
                    'worklon' => $worklon ,
                    'email' => $email
                );        

            $insertedid = $ci->signup->addNew($array);

                 $arrayUsers = array(
                    'username' => $email,
                    'pass' => md5($pass),
                    'personid'=> $insertedid,
                    'isactive'=>1
                ); 

            $insertedid = $ci->signup->addNewUser($arrayUsers);

            $ret_val[0]["message"] = $insertedid;

            $ret_val[2]["response"] = "Created User : ".$insertedid;

            $ret_val[3]["response"] = "Initialising user confirmation email";

            require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");      

            $ci->load->model('Order','order');

            $list = $ci->order->fetchsmtp();

            $smtparray = $list->row_array();

            $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']); 

            $toEmail = $email;

            $toName = $namesArray[0];

            $subject = "User Registration";

            //$message = "You have successfully registered as a user in the pharm-portal,click the link below to confirm your registration. \n";
            //$message .= "http://pharm-portal.coreict.co.ke/activate?id=".$insertedid;
            $message = "Dear ".$fullname." ,\n<br>";
            $message .= "Thank you for signing up in the Pharmacy app,<br> You can now proceeed and make your prescription Orders \n";

            $headers = "";

            $title = "User Registration";

            $fromEmail = $smtparray['defaultemail'];            

            $fromName = "tibamoja";

            $key = null;

            $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);  

            $ret_val[4]["response"] = $response ;


           return $ret_val;
          }
        }


    function createOrder($drugid,$patientid,$qty,$parameters)
        {      
          $ret_val=array();            

            $parameters = json_decode($parameters);  

            $ci =& get_instance();
 
            $ci->load->model('Drug');

            $ci->load->model('Transactions','transactions');

            $arraySearch = array('drugid' => $drugid, 'patientid' => $patientid);


           $i= 0 ; 
         
          foreach ($parameters as $key => $jsonitems) {

             $drugID = $parameters->Products[$i]->drugID;

             $qty = $parameters->Products[$i]->qty;

             $patientid = $parameters->patientID;

             $coupon = $parameters->coupon;  

             $userid  = $patientid; 

             $response = $ci->transactions->createPendingTransaction($patientid,$drugID,$qty,$coupon,null,null); 

           $i++;
           }
           

            $ret_val[0]["response"] = $response;

            $ret_val[0]["message"]= "Items have been put on pending Orders!";

            $response = 1;

                  if($response){
                    //process the order
                   
                     $ret_val[1]["message"]= "Order email initialising..";  


                                    $ci->load->helper('url');  

                                    require_once("htmlMimeMail-2.5.1/send_mail_coreict.php");

                                    //$userid = $arraySearch['patientid'];   

                                    $ci->load->model('Order','order');        

                                    $list = $ci->order->fetchsmtp(); 

                                    $smtparray = $list->row_array();

                                    $cls = new SendMailClass($smtparray['host'],25,$smtparray['username'],$smtparray['pass']); 

                                    //get the email for the user
                                    $ci->load->model('Users','user');

                                    $userdetails = $ci->user->fetchRecord($userid); 

                                    $patientid = $userdetails[0]->id;  

                                    $defaultCompanydetails = $ci->user->fetchDefaultCompany(); 

                                    $currentdate = date('d/m/Y');

                                    $currentdatelong = date('D , d - M - Y');

                               
                                    $body = '
                                                <!DOCTYPE html>
                                                <html>
                                                <head>
                                                  <meta charset="utf-8">
                                                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                                  <title>Pharmacy System | Products Ordered</title>
                                                  <!-- Tell the browser to be responsive to screen width -->
                                                  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                                                <div class="wrapper">
                                                  <!-- Main content -->
                                                  <section class="invoice">
                                                    <!-- title row -->
                                                    <div class="row">
                                                      <div class="col-xs-12">
                                                        <h2 class="page-header">
                                                          <i class="fa fa-globe"></i> Pharmacy System | Order 
                                                          <small class="pull-right">Date: '.$currentdate.'</small>
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
                                                        <b>Order #007612</b><br>
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
                                                                <th>Price</th>
                                                                <th>Subtotal</th>
                                                                <th>Tax</th>
                                                              </tr>
                                                              </thead>
                                                              <tbody>
                                                              ';

                                                     //fetch the pending transaction
                                                     $ci->load->model('Transactions','transaction');
                                                     $pendingRefillsListStores = $ci->transaction->fetchPendingRefillStores($userid);
                                                     $ret_val[2]["message"]= "Fetching list of qued order(s)...";
                                                     //loop through the list of stores
                                                     
                                                     foreach ($pendingRefillsListStores as $storeList) {

                                                     $storebody = $body;

                                                     $pendingRefillsList = $ci->transaction->fetchPendingRefill($storeList->storeid,$userid);

                                                     foreach ($pendingRefillsList as $pendingList) {

                                                        if($pendingList->price < 0) { $productdescription = "Coupon Discount"; }else{ $productdescription = $pendingList->genericname; }

                                                            $bodymain .= ' 
                                                              <tr>
                                                                <td>'.$pendingList->qty.'</td>
                                                                <td>'.$pendingList->storename.'</td>
                                                                <td>0000'.$pendingList->id.'</td>
                                                                <td>'.$productdescription.'</td>
                                                                <td>'.$pendingList->price.'</td>
                                                                <td align="center">Kes '. ($pendingList->price * $pendingList->qty) .' /=</td>
                                                                <td align="right">'.number_format($pendingList->tax,0).'%</td>
                                                              </tr>';        
                                                              $totalex = $totalex + ($pendingList->price * $pendingList->qty);

                                                              $tax =  $tax + ($pendingList->tax/100 * $totalex);  

                                                              $storebody .= ' 
                                                              <tr>
                                                                <td>'.$pendingList->qty.'</td>
                                                                <td>'.$pendingList->storename.'</td>
                                                                <td>0000'.$pendingList->id.'</td>
                                                                <td>'.$productdescription.'</td>
                                                                <td>'.$pendingList->price.'</td>
                                                                <td align="center">Kes '.($pendingList->price * $pendingList->qty).' /=</td>
                                                                <td align="right">'.number_format($pendingList->tax,0).'%</td>
                                                              </tr>';

                                                              $totalexs = $totalexs + ($pendingList->price * $pendingList->qty);

                                                              $taxs =  $taxs + ($pendingList->tax/100 * $totalexs); 
                                                 }      


                                              $storebody .= '</tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                                </div>
                                                <!-- /.row -->

                                                <div class="row">
                                              <!-- accepted payments column -->
                                              <div class="col-xs-6">
                                               <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                Please have a look at your ordered items.
                                                </p>
                                              </div>
                                              <!-- /.col -->
                                              <div class="col-xs-6">
                                                <p class="lead">Amount Due '.$currentdatelong.'</p>

                                                <div class="table-responsive">
                                                  <table class="table" >
                                                    <tr>
                                                      <th style="width:50%">Subtotal:</th>
                                                      <td align="right">'.number_format($totalexs,2).'</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Tax</th>
                                                      <td align="right">'.number_format($taxs,2).'</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Shipping:</th>
                                                      <td align="right">0.00</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Total:</th>
                                                      <td align="right"><b>'.number_format($totalexs+$taxs,2).'</b></td>
                                                    </tr>
                                                  </table>
                                                </div>
                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                          </section>
                                          <!-- /.content -->
                                        </div>
                                        <!-- ./wrapper -->
                                        </body>
                                        </html>

                                        ';
                                     //send individual email here
                                     $toEmail = $pendingList->email;
                                     $toName =  $pendingList->storename;
                                     $subject = ''.$userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname."'s Order";
                                     $message = $storebody;
                                     $headers = "Content-Type: text/html; charset=UTF-8\r\n";
                                     $title = "Order";
                                     $fromEmail = $smtparray['defaultemail'];
                                     $fromName = "tibamoja";
                                     $key = null;                                    

                                     $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);
                                     
                                     $storebody="";
                                     $totalexs = 0;
                                     $taxs =0;
                                    }
                                     //exit();    

                                    $body .= $bodymain;   

                                        $body .= '</tbody>
                                                </table>
                                                </div>
                                                <!-- /.col -->
                                                </div>
                                                <!-- /.row -->'; 
                                       

                                          $body .= '<div class="row">
                                              <!-- accepted payments column -->
                                              <div class="col-xs-6">
                                               <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                                                Please have a look at your ordered items.
                                                </p>
                                              </div>
                                              <!-- /.col -->
                                              <div class="col-xs-6">
                                                <p class="lead">Amount Due '.$currentdatelong.'</p>

                                                <div class="table-responsive">
                                                  <table class="table" >
                                                    <tr>
                                                      <th style="width:50%">Subtotal:</th>
                                                      <td align="right">'.number_format($totalex,2).'</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Tax</th>
                                                      <td align="right">'.number_format($tax,2).'</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Shipping:</th>
                                                      <td align="right">0.00</td>
                                                    </tr>
                                                    <tr>
                                                      <th>Total:</th>
                                                      <td align="right"><b>'.number_format($totalex+$tax,2).'</b></td>
                                                    </tr>
                                                  </table>
                                                </div>
                                              </div>
                                              <!-- /.col -->
                                            </div>
                                            <!-- /.row -->
                                          </section>
                                          <!-- /.content -->
                                        </div>
                                        <!-- ./wrapper -->
                                        </body>
                                        </html>

                                        ';       


                                    $toEmail = $userdetails[0]->email;

                                    $toName =  $userdetails[0]->initial ." ".$userdetails[0]->firstname." ".$userdetails[0]->secondname;

                                    $subject = "New Order";

                                    $message = $body;

                                    $headers = "'X-Mailer', 'All rights reserved Core Ict Consultancy'";

                                    $title = "Order";

                                    $fromEmail = $smtparray['defaultemail'];

                                    $fromName = "tibamoja";

                                    $key = null;
                                    $ret_val[3]["message"]= "Total : ". $totalex+$tax;  
                                   if($totalex+$tax > 0) {

                                    $response = $cls -> getMails($toEmail, $toName, $subject, $message, $headers, $title,$fromEmail,$fromName,$key);        

                                    $array = array(
                                                'comments' => 'Ordered',
                                                'description' => 'Awaiting order confirmation'
                                            ); 
                                    $ci->transaction->updateStatusTransaction($array,$userid); 

                                                 $ret_val[1]["response"] = "Order status has been updated to Awaiting Confirmation";
                                                 $ret_val[4]["message"]= $response;    

                                    }   

 

                  }             
             return $ret_val;
        }


    function getallProduct($from,$to)
        {          

            $ci =& get_instance();
 
            $ci->load->model('Drug');                    

            $qcd = $ci->Drug->allProducts($from,$to);       

            if ($qcd->num_rows()>0) {
                $ret_val=array();
                $i=0;
                foreach ($qcd->result_array() as $row) {
                    $ret_val[$i]=$row;
                    $i++;
                }
                return $ret_val;
            } else {
                return false;
            }    

        }



   function uploadPrescriptionFile($encoded,$patientid,$name) {  

            $ci =& get_instance();

            $ci->load->model('Patient');    

            $location ="assets/uploads/prescriptions/".$name;                               // Mention where to upload the file

            $current = file_get_contents($location);                     // Get the file content. This will create an empty file if the file does not exist  

            $current = base64_decode($encoded);                          // Now decode the content which was sent by the client    

            file_put_contents($location, $current);                     // Write the decoded content in the file mentioned at particular location    

            if($name!="")
            { 

                 $date = date("Y-m-d h:i:s");                       

                 $array = array('uploadate' =>$date,
                    'filename' => $name,
                    'patientid' => $patientid,
                    'path'=>$location
                );         

            $ci->Patient->addPrescriptionUpload($array);

            return "File Uploaded successfully...";                                                   
            }
            else        
            {
                return "Please upload a file...";
            }
        }


    }


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////client end point



    public function fetchPharmacies()
        {
           $wsdl = WSDL; 

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $result = $client->call('getPharmacies');

            echo json_encode($result);      
        }

    public function fetchCategories()
        {
           $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $result = $client->call('getCategories');

             echo json_encode($result);     
        }
    

    public function fetchProducts()
        {
            $id = $this->input->get("id");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getProducts', array('storeid'=>$id)); 

            echo json_encode($res1 );     
        }


    public function fetchReview()
        {
            $id = $this->input->get("drugid");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getReview', array('drugid'=>$id)); 

            echo json_encode($res1);     
        }

    public function createReview(){

            $drugid = $this->input->post("drugid");
            $rating = $this->input->post("rating");
            $comments = $this->input->post("comments");
            $patientid = $this->input->post("patientid");
            $title = $this->input->post("title");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('createReview', array('drugid'=>$drugid,'rating'=>$rating,'comments'=>$comments,'patientid'=>$patientid,'title'=>$title)); 

            echo json_encode($res1); 


    }


    public function fetchAllReview()
        {
            $id = $this->input->get("id");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getAllReview', array('rating'=>$id)); 

            echo json_encode($res1);     
        }

  public function fetchPatientOrders()
        {
            $id = $this->input->get("id");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getPatientOrders', array('patientid'=>$id)); 

             echo json_encode($res1 );   
        }


   public function fetchPatientUnconfirmedOrders()
        {
            $id = $this->input->get("id");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getPatientUnconfirmedOrders', array('patientid'=>$id)); 

            echo json_encode($res1 );    
        }


public function fetchPatientInvoices()
        {
            $id = $this->input->get("id");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getPatientInvoices', array('patientid'=>$id)); 

             echo json_encode($res1 );    
        }

 public function createNewOrder(){
       

            $parameters = $this->input->get("parameters"); 

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('createOrder', array('drugid'=>$drugid,'patientid'=>$patientid,'qty'=>$qty,'parameters'=>$parameters));       

             echo json_encode($res1 );



 }   

  public function createUser(){
       

            $fullname = $this->input->get("fullname");

            $email = $this->input->get("email"); 

            $pass = $this->input->get("pass");

            $homelat = $this->input->get("homelat"); 

            $homelon = $this->input->get("homelon"); 

            $worklat = $this->input->get("worklat"); 

            $worklon = $this->input->get("worklon");      

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('createUser', array('fullname'=>$fullname,'email'=>$email,'pass'=>$pass,'homelat'=>$homelat,'homelon'=>$homelon,'worklat'=>$worklat,'worklon'=>$worklon));       

            echo json_encode($res1 );

 }  


public function payInvoice(){

    $invoiceno = $this->input->get("invoiceno"); 

    $amount = $this->input->get("amount"); 

    $wsdl = WSDL;

    $this->load->library("Nusoap_library");

    $client = new nusoap_client($wsdl, 'wsdl'); 

    $res1 = $client->call('payInvoice', array('invoiceno'=>$invoiceno , 'amount'=> $amount ));

    echo json_encode($res1);

  }   

    public function reFill(){


            $parameters = $this->input->get("parameters");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('reFillPatientMeds', array('parameters'=>$parameters));       

            echo json_encode($res1);

    }

 public function updateUserdetails(){
       

            $parameters = $this->input->get("parameters");    

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('userdetailsUpdate', array('parameters'=>$parameters)); 

            echo json_encode($res1 );
 }  




public function searchProductskeyWord()
        {
            $id = $this->input->get("name");           

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('searchProductkeyWord', array('drugname'=>$id)); 

             echo json_encode($res1 );   
        }


 public function searchProducts()
        {
            $storeId = $this->input->get("storeid");
            $drugname = $this->input->get("name");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('searchProduct', array('storeid'=>$storeId,'drugname'=>$drugname));       

             echo json_encode($res1 );    
        }



 public function allProducts()
        {
            $from = $this->input->get("from");
            $to = $this->input->get("to");

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getallProduct' , array('from'=>$from,'to'=>$to));       

            echo json_encode($res1);   
        }


    public function drugCategory()
        {
            $id = $this->input->get("name");           

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getProductCategory', array('categoryname'=>$id)); 

            //var_dump($res1);   
            echo json_encode($res1); 
        }


 public function fetchProductCoupon()
        {                   

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getProductCoupon'); 
          
            echo json_encode($res1); 
        }

public function fetchPrescriptionUploads()
        {
            $id = $this->input->get("patientid");           

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getPrescriptionUpload', array('patientid'=>$id));
              
            echo json_encode($res1); 
        }


public function fetchPrescription()
        {
            $id = $this->input->get("patientid");           

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getPrescription', array('patientid'=>$id));
              
            echo json_encode($res1); 
        }


public function getUserdetails()
        {
            $id = $this->input->get("userid");           

            $wsdl = WSDL;

            $this->load->library("Nusoap_library");

            $client = new nusoap_client($wsdl, 'wsdl'); 

            $res1 = $client->call('getUserdetailsCall', array('userid'=>$id));
              
            echo json_encode($res1); 
        }

 public function uploadFile()
        {                   

            $wsdl = WSDL;

            $this->load->helper('url');

            $patientid = $this->input->get("patientid");

            $this->load->library("Nusoap_library");

            $this->load->library('upload');

            $this->load->helper(array('form', 'url'));

            $client = new nusoap_client($wsdl, 'wsdl'); 
          
               $tmpfile = $_FILES["uploadfiles"]["tmp_name"]; 

               $filename = $_FILES["uploadfiles"]["name"];     

               $handle = fopen($tmpfile, "r"); 

               $contents = fread($handle, filesize($tmpfile)); 

               fclose($handle);                                 

               $decodeContent   = base64_encode($contents);     // Decode the file content, so that we code send a binary string to SOAP          

           $response =  $client->call('uploadPrescriptionFile',array($decodeContent,$patientid,$filename));   //Send two inputs strings. {1} DECODED CONTENT {2} FILENAME
           
           if($client->fault){

                echo json_encode (array("response"=>"Fault {$client->faultcode} <br/>"));

                echo json_encode (array("response"=>"String {$client->faultstring} <br/>"));
           }
           else{
                echo json_encode(array("response"=>$response)); 
           }

        }


    public function index()
    {
        $this->nusoap_server->service(file_get_contents("php://input")); //standard info about service
    }

    public function testClient()
    {
        $id = $this->input->get("id");

        $wsdl = WSDL;

        $this->load->library("Nusoap_library");

        $client = new nusoap_client($wsdl, 'wsdl'); 

        $res1 = $client->call('getUserInfo', array('id'=>$id));
        var_dump($res1);

        echo "<hr>";
        $res2 = $client->call('getUsers');
         echo json_encode($res2);
    }




 public function loginCheck()
    {  
       /* 
        sample -> 192.168.1.207/pharmaceuticals/index.php/ws:login?username=mike&pass=18126e7bd3f84b3f3e4df094def5b7de
        */

    try{
        $wsdl = WSDL;

        $username = $this->input->get("username");

        $pass = $this->input->get("pass"); 

        $this->load->library("Nusoap_library");

        $client = new nusoap_client($wsdl, 'wsdl'); 

        $res1 = $client->call('loginCheck', array('username'=>$username,'pass'=>md5($pass) , 'isactive' => 1));

            if(array_key_exists('faultcode', $res1)){
                    $result= array("success"=>False);
            }else{
                if( $res1['username'] == $username && $res1['pass']== md5($pass) ){
                    $result= array("success"=>True,"userid"=>$res1['id'],"user"=>$res1['username'],"pass"=>$res1['pass'],"homelat"=>$res1['homelat'],"homelon"=>$res1['homelon'],"worklat"=>$res1['worklat'],"worklon"=>$res1['worklon'],"img"=>$res1['img']);                   
                }else{
                    $result= array("success"=>False);                  
                }
            }
             echo json_encode($result);
        } catch (Exception $e) {
           echo 'Caught exception: ',  $e->getMessage(), "\n";
      }
    
    }
}




<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define('USERNAME','mattoace');
define('API','e3fef004cc3aa63750d8d50e4a0ad3d09ed3f84d7fbb2552ebafedbe3139660');
 
class PayController extends CI_Controller {
 
    public function __construct()
    {
        parent::__construct();
   
    }
 
    public function index()
    {
        $this->load->helper('url');
        
    }



	 function executePayment(){

			require_once "AfricasTalkingGateway.php";

			//Specify your credentials
			$username = "mattoace";

			$apiKey   = "ce60279c511c6fc49c36ce5a0b8638dbb4bed7800968541aa7c7dc50ab69b59e";

			// NOTE: If connecting to the sandbox, please use your sandbox login credentials

			//Create an instance of our awesome gateway class and pass your credentials
			$gateway = new AfricasTalkingGateway($username, $apiKey, "sandbox");

			// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
			/*************************************************************************************
			             ****SANDBOX****
			$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
			**************************************************************************************/

			// Specify the name of your Africa's Talking payment product
			$productName  = "tibamoja";
			// The phone number of the customer checking out
			$phoneNumber  = "+254727310743";
			// The 3-Letter ISO currency code for the checkout amount
			$currencyCode = "KES";
			// The checkout amount
			$amount       = 150.50;

			// Any metadata that you would like to send along with this request
			// This metadata will be  included when we send back the final payment notification
			$metadata     = array("agentId"   => "654",
					              "productId" => "321");
			try {
			  // Initiate the checkout. If successful, you will get back a transactionId
			  $transactionId = $gateway->initiateMobilePaymentCheckout($productName,
										   $phoneNumber,
										   $currencyCode,
										   $amount,
										   $metadata);

			 $response =  "The id here is ".$transactionId;
			 
			

			}
			catch(AfricasTalkingGatewayException $e){
			  $response = "Received error response: ".$e->getMessage();
			}
			echo json_encode(array("response"=>$response));
	}


	function executeCallback(){


	$data  = json_decode(file_get_contents('php://input'), true);

	print_r($data);

	 $this->load->model('Patientpayment','payments');

     $array = array(                   
                    'comments' => implode(",",$data)
                );          

     $this->payments->addPayLog($array);

	// Process the data...
	$category = $data["category"];
	if ( $category == "MobileC2B" ) {
	   // We have been paid by one of our customers!!
	   $phoneNumber = $data["source"];
	   $value       = $data["value"];
	   $account     = $data["clientAccount"];
	   // manipulate the data as required by your business logic
	   // Perhaps send an SMS to confirm the payment using our APIs...

	

	   $response = $data;
	} else {

			$response = "Error!";


	  }

        echo json_encode(array("response"=>$response));

	}


	function sendMessageNotification($phonenumber,$message){


				// Be sure to include the file you've just downloaded
				require_once('AfricasTalkingGateway.php');
				// Specify your login credentials
				$username   = "mattoace";
				$apikey     = "ce60279c511c6fc49c36ce5a0b8638dbb4bed7800968541aa7c7dc50ab69b59e";
				// NOTE: If connecting to the sandbox, please use your sandbox login credentials
				// Specify the numbers that you want to send to in a comma-separated list
				// Please ensure you include the country code (+254 for Kenya in this case)
				$recipients = $phonenumber;
				// And of course we want our recipients to know what we really do
				/////$message    = "I'm a lumberjack and its ok, I sleep all night and I work all day";
				// Create a new instance of our awesome gateway class
				$gateway    = new AfricasTalkingGateway($username, $apikey);
				// NOTE: If connecting to the sandbox, please add the sandbox flag to the constructor:
				/*************************************************************************************
				             ****SANDBOX****
				$gateway    = new AfricasTalkingGateway($username, $apiKey, "sandbox");
				**************************************************************************************/
				// Any gateway error will be captured by our custom Exception class below, 
				// so wrap the call in a try-catch block
				try 
				{ 
				  // Thats it, hit send and we'll take care of the rest. 
				  $results = $gateway->sendMessage($recipients, $message);
				            
				  foreach($results as $result) {
				    // status is either "Success" or "error message"
				    $response[] = " Number: " .$result->number;
				    $response[] = " Status: " .$result->status;
				    $response[] = " MessageId: " .$result->messageId;
				    $response[] = " Cost: "   .$result->cost."\n";
				  }
				}
				catch ( AfricasTalkingGatewayException $e )
				{
				  $response[] = "Encountered an error while sending: ".$e->getMessage();
				}

				echo json_encode(array("response"=> implode(" , ", $response )));	


	}

}


?>

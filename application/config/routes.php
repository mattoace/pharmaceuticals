<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'pages/view';
//$route['default_controller'] = 'services';
$route['home'] = 'pages/view';
$route['ws'] = 'services/testClient';
$route['ws:wsdl'] = 'services';
$route['ws:login'] = 'services/loginCheck';
$route['ws:signup'] = 'services/createUser';
$route['ws:fetch-user'] = 'services/getUserdetails';
$route['ws:update-user'] = 'services/updateUserdetails';
$route['ws:pharmacies'] = 'services/fetchPharmacies';
$route['ws:categories'] = 'services/fetchCategories';
$route['ws:products'] = 'services/fetchProducts';
$route['ws:productsearch'] = 'services/searchProducts';
$route['ws:product'] = 'services/searchProductskeyWord';
$route['ws:allproducts'] = 'services/allProducts';
$route['ws:drug-category'] = 'services/drugCategory';
$route['ws:patient-orders'] = 'services/fetchPatientOrders';
$route['ws:patient-unconfirmedorders'] = 'services/fetchPatientUnconfirmedOrders';
$route['ws:patient-invoices'] = 'services/fetchPatientInvoices';
$route['ws:patient-createorder'] = 'services/createNewOrder';
$route['ws:product-coupon'] = 'services/fetchProductCoupon';
$route['ws-presc_upload'] = 'services/uploadFile';
$route['ws:fetch-presc_upload'] = 'services/fetchPrescriptionUploads';
$route['ws:upload'] = 'pages/view/prescriptionuploadview';
$route['ws:review'] = 'services/fetchReview';
$route['ws:reviewratings'] = 'services/fetchAllReview';
$route['ws:postreview'] = 'services/createReview';
$route['ws:refill'] = 'services/reFill';
$route['ws:fetch-prescriptions'] = 'services/fetchPrescription';
$route['ws:pay-invoice'] = 'services/payInvoice';


$route['dashboard-areagraph'] = 'dashboardController/drawAreaGrapgh';
$route['dashboard-linegraph'] = 'dashboardController/drawlineGrapgh';
$route['dashboard-sendemail'] = 'dashboardController/sendEmail';


$route['admin'] = 'pages/back/index';
$route['alogin'] = 'pages/fullpage/login';
$route['aregister'] = 'pages/fullpage/register';
$route['padmregister'] = 'RegistrationController/addNewAdmin';
$route['alogincheck'] = 'RegistrationController/checkAdmin';

$route['patient'] = 'pages/back/patient';
$route['person-fetch'] = 'patientController/fetch';
$route['person-add'] = 'patientController/addNew'; 
$route['person-fetchedit'] = 'patientController/fetchedit';
$route['person-edit'] = 'patientController/edit';
$route['person-delete'] = 'patientController/deleteRecord';
$route['person-upload'] = 'patientController/uploadPicture'; 

$route['staff'] = 'pages/back/staff';
$route['supplier'] = 'pages/back/supplier';


$route['patientrefill'] = 'pages/back/patientrefill';
$route['patientrefill-fetch'] = 'patientrefillController/fetchRefill';
$route['patientrefill-formfetch'] = 'patientrefillController/fetchformRefill';

$route['patientinsurance'] = 'pages/back/patientinsurance'; 
$route['patientinsurance-add'] = 'patientinsuranceController/addNew';
$route['patientinsurance-fetch'] = 'patientinsuranceController/fetchInsurance';
$route['patientinsurance-formfetch'] = 'patientinsuranceController/fetchForm';
$route['patientinsurance-delete'] = 'patientinsuranceController/deleteRecord';

$route['immunization'] = 'pages/back/immunization'; 
$route['immunization-add'] = 'immunizationController/addNew';
$route['immunization-fetch'] = 'immunizationController/fetchimmunization';
$route['immunization-formfetch'] = 'immunizationController/fetchForm';
$route['immunization-delete'] = 'immunizationController/deleteRecord'; 

$route['presc-uploads'] = 'pages/back/prescriptionuploads';
$route['presc-fetch'] = 'prescController/fetch';
$route['presc-addcomments'] = 'prescController/saveComments';  
$route['presc-formfetch'] = 'prescController/fetchComments';
$route['presc-ordermed'] = 'prescController/orderMedication';
$route['presc-loadordered'] = 'prescController/loadOrdered';
$route['presc-confirmordered'] = 'prescController/confirmOrdered';   

$route['patientbill'] = 'pages/back/patientbill';
$route['patientbill-add'] = 'patientbillController/addNew';
$route['patientbill-fetch'] = 'patientbillController/fetchpatientbill';
$route['patientbill-formfetch'] = 'patientbillController/fetchForm';
$route['patientbill-delete'] = 'patientbillController/deleteRecord';
$route['patientbill-getotals'] = 'patientbillController/fetchTotals';

$route['patientpayments'] = 'pages/back/patientpayment';
$route['patientpayment-add'] = 'patientpaymentController/addNew';
$route['patientpayment-fetch'] = 'patientpaymentController/fetchpatientpayment';
$route['patientpayment-formfetch'] = 'patientpaymentController/fetchForm';
$route['patientpayment-delete'] = 'patientpaymentController/deleteRecord';
$route['patientpayment-getotals'] = 'patientpaymentController/fetchTotals';

   

$route['pharm'] = 'pages/back/pharmacy';
$route['pharm-fetch'] = 'pharmacyController/fetch';
$route['pharm-add'] = 'pharmacyController/addNew'; 
$route['pharm-fetchedit'] = 'pharmacyController/fetchedit';
$route['pharm-edit'] = 'pharmacyController/edit';
$route['pharm-delete'] = 'pharmacyController/deleteRecord';
$route['pharm-imgupload'] = 'pharmacyController/imgupload';


$route['clinic'] = 'pages/back/clinic';
$route['clinic-fetch'] = 'clinicController/fetch';
$route['clinic-add'] = 'clinicController/addNew'; 
$route['clinic-fetchedit'] = 'clinicController/fetchedit';
$route['clinic-edit'] = 'clinicController/edit';
$route['clinic-delete'] = 'clinicController/deleteRecord';
$route['clinic-imgupload'] = 'clinicController/imgupload';

$route['users'] = 'pages/back/users';
$route['users-fetch'] = 'usersController/fetch';
$route['users-add'] = 'usersController/addNew';
$route['users-edit'] = 'usersController/edit';
$route['users-fetchedit'] = 'usersController/fetchedit';
$route['users-delete'] = 'usersController/deleteRecord'; 

$route['settings'] = 'pages/back/settings';
$route['settings-fetch'] = 'settingsController/fetch';
$route['settings-add'] = 'settingsController/addNew';
$route['settings-fetchedit'] = 'settingsController/fetchedit';
$route['settings-edit'] = 'settingsController/edit';
$route['settings-delete'] = 'settingsController/deleteRecord';


$route['med'] = 'pages/back/drugs';
$route['med-fetch'] = 'drugController/fetch';
$route['med-add'] = 'drugController/addNew'; 
$route['med-fetchedit'] = 'drugController/fetchedit';
$route['med-edit'] = 'drugController/edit';
$route['med-delete'] = 'drugController/deleteRecord';
$route['med-upload'] = 'drugController/upload';
$route['med-imgupload'] = 'drugController/imgupload';
$route['med-images'] = 'drugController/displayImages';
$route['med-filter'] = 'drugController/filterDrugs';

$route['coupons'] = 'pages/back/coupons';
$route['coupons-adddiscount'] = 'DiscountController/addNew';
$route['coupons-fetchdiscount'] = 'DiscountController/fetchForm';
$route['coupons-fetchgrid'] = 'DiscountController/fetchgrid'; 
$route['coupons-generate'] = 'DiscountController/generateCoupons';
$route['coupons-clear'] = 'DiscountController/clearCoupons';  


$route['orders'] = 'pages/back/orders';
$route['order-fetch'] = 'orderController/fetchOrder';
$route['orderdetails-fetch'] = 'orderController/fetchOrderDetails';
$route['order-filter'] = 'orderController/fetchStoreOrder';
$route['order-cfilter'] = 'orderController/fetchcStoreOrder';
$route['order-confirm'] = 'orderController/confirmOrder';
$route['order-changeqty'] = 'orderController/orderChangeQty';

$route['corders'] = 'pages/back/corders';
$route['corder-fetch'] = 'orderController/fetchcOrder';
$route['corderdetails-fetch'] = 'orderController/fetchcOrderDetails';
$route['corder-filter'] = 'orderController/fetchStorecOrder';
$route['corder-cfilter'] = 'orderController/fetchcStorecOrder';

$route['invoice'] = 'pages/back/invoice';
$route['invoice-create'] = 'invoiceController/createInvoice';
$route['invoice-resend'] = 'invoiceController/createInvoice';
$route['invoice-fetch'] = 'invoiceController/fetchInvoice';
$route['invoicedetails-fetch'] = 'invoiceController/fetchInvoiceDetails';
$route['invoice-filter'] = 'invoiceController/fetchInvoiceFilter';
$route['invoice-cfilter'] = 'invoiceController/fetchFilterInvoicesCat';


$route['cat-fetch'] = 'catController/fetch';
$route['cat-add'] = 'catController/addNew'; 
$route['cat-fetchedit'] = 'catController/fetchedit';
$route['cat-edit'] = 'catController/edit';
$route['cat-delete'] = 'catController/deleteRecord';
$route['cat-tree'] = 'catController/loadTree';
$route['cat-contextmenu'] = 'catController/loadContext';
$route['cat-cotextsave'] = 'catController/saveContext'; 
$route['cat-treedeleteall'] = 'catController/deleteTreeAll';  
$route['cat-treedelete'] = 'catController/deleteTree';   

$route['drugassigning-fetch'] = 'assigningController/fetch';
$route['drugassigned-fetch'] = 'assigningController/fetchassigned';
$route['drug-assigncat'] = 'assigningController/assignCat';
$route['drug-deassign'] = 'assigningController/deassignCat';


$route['roles'] = 'pages/back/roles';
$route['roles-fetch'] = 'rolesController/fetch';
$route['roles-save'] = 'rolesController/save';
$route['roles-reload'] = 'rolesController/reload';
$route['rolespharm-fetch'] = 'rolesController/pharmfetch';
$route['roles-assignpharm'] = 'rolesController/assignpharm';
$route['roles-fetchassigned'] = 'rolesController/pharmfetchassigned';
$route['roles-pharmacydeassign'] = 'rolesController/pharmdeassigned';

//front end
$route['login'] = 'pages/view/login';
//$route['home'] = 'pages/view/home';
$route['home'] = 'pages/view/products';
$route['data-products'] = 'pages/fullview/data';
$route['data-productshome'] = 'pages/fullview/data-home';
$route['about'] = 'pages/view/about';
$route['service'] = 'pages/view/service';
$route['contact'] = 'pages/view/contact';

$route['register'] = 'RegistrationController/addNew';
$route['activate'] = 'RegistrationController/activate';
$route['activated'] = 'pages/view/activated';
$route['check'] = 'RegistrationController/check';
$route['medc-fetch'] = 'drugController/fetchc'; 
$route['prescription'] = 'pages/view/prescription'; 
$route['med-order'] = 'TransactionsController/order'; 
$route['med-transfetch'] = 'TransactionsController/fetchtransaction';
$route['med-transearch'] = 'TransactionsController/searchtransaction'; 
$route['med-details'] = 'TransactionsController/drugDetails';
$route['med-scan'] = 'TransactionsController/scanDrug';
$route['med-search'] = 'TransactionsController/drugSearch';


$route['dose-add'] = 'DosageController/addNew'; 
$route['dose-fetch'] = 'DosageController/fetchForm'; 


$route['order-request'] = 'orderController/orderRequest';
$route['cart-request'] = 'cartController/processOrder'; 

$route['pay'] = 'PayController/executePayment'; 
$route['pay-callback'] = 'PayController/executeCallback';         

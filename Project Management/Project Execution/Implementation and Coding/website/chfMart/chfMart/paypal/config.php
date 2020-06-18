<?php 
/* 
 * PayPal and database configuration 
 */ 
  
// PayPal configuration 
define('PAYPAL_ID', 'huddersfax@onlinemart.com'); 
define('PAYPAL_SANDBOX', TRUE); //TRUE or FALSE 
 
define('PAYPAL_RETURN_URL', 'http://localhost/chfMart/paypal/success.php'); 
define('PAYPAL_CANCEL_URL', 'http://localhost/chfMart/paypal/cancel.php'); 
define('PAYPAL_NOTIFY_URL', 'http://localhost/chfMart/paypal/ipn.php'); 
define('PAYPAL_CURRENCY', 'USD'); 
 
 
// Change not required 
define('PAYPAL_URL', (PAYPAL_SANDBOX == true)?"https://www.sandbox.paypal.com/cgi-bin/webscr":"https://www.paypal.com/cgi-bin/webscr");
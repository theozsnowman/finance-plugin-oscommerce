<?php
/**
 * Authorize.net SIM Payment Module
 *
 * @package languageDefines
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Wed Dec 30 22:16:19 2015 -0500 Modified in v1.5.5 $
 */

  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_ADMIN_TITLE', 'Finance payment');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_CATALOG_TITLE', 'Finance payment');  // Payment option title as displayed to the customer


  if (MODULE_PAYMENT_FINANCEPAYMENT_STATUS == 'True') {
    define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_DESCRIPTION', 'Description of Finance Payment module');
  } else {
    define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_DESCRIPTION', 'Description of Finance Payment module');
  }

  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_DEPOSIT', 'Finance payment deposit % : ');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_PLAN', 'Finance Payment selected plan: ');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_TOTAL', 'Finance payment total value: ');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_DETAILS', 'Finance details ');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_MODULE_DISABLED', 'This payment method is not active, Please try another payment method.');
  define('MODULE_PAYMENT_FINANCEPAYMENT_TEXT_PAYMENT_MISMATCH', 'Order amount mismatch error.');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* The owner\'s name of the credit card must be at least ' . CC_OWNER_MIN_LENGTH . ' characters.\n');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* The credit card number must be at least ' . CC_NUMBER_MIN_LENGTH . ' characters.\n');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV', '* The 3 or 4 digit CVV number must be entered from the back of the credit card.\n');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', 'There has been an error processing your credit card. Please try again.');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', 'Your credit card was declined. Please try another card or contact your bank for more info.');
  // define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', 'Credit Card Error!');

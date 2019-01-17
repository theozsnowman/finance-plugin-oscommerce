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
  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
  define('EMAIL_TEXT_PRODUCTS', 'Products');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Delivery Address');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Billing Address');
  define('EMAIL_TEXT_SUBJECT', 'Payment confirmed by Finance payment');

<?php
/**
 * finance_main_handler.php callback handler for Finance payment module notifications
 */

/**
 * handle Finance payment processing:
 */
require('includes/application_top.php');
require(DIR_WS_MODULES . 'payment/financepayment.php');
require_once DIR_FS_CATALOG. 'includes/languages/english/modules/payment/financepayment.php';
require_once DIR_FS_CATALOG. 'includes/languages/english/modules/payment/FinanceApi.php';

$finance = new financepayment();
error_log('finance handler');
if(isset($_POST['action']) && $_POST['action'] == 'getCalculatorWidget' && $_POST['products_id'] > 0) {
    error_log('product id passed');
    $price = $finance->get_product_price((int)$_POST['products_id']);
  $plans = $finance->getSelectedPlansString((int)$_POST['products_id'],(int)$price);
  $widgets = array();
  if($plans != '') {
      error_log('have plans');
      $financeApi = new FinanceApi();
      $financeEnv = $financeApi->getFinanceEnv();
      error_log(MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_CALCULATOR);
    $widgets['js'] = $finance->getJsKey();
    $widgets['jsSrc'] = "https://cdn.divido.com/calculator/v2.1/production/js/template.'$financeEnv'.js";
    if(MODULE_PAYMENT_FINANCEPAYMENT_PRODUCT_CALCULATOR == 'True') {
      $widgets['calculator'] = '<div data-'.$financeEnv.'-widget data-'.$financeEnv.'-prefix="'.MODULE_PAYMENT_FINANCEPAYMENT_PREFIX.'" data-'.$financeEnv.'-suffix="'.MODULE_PAYMENT_FINANCEPAYMENT_SUFIX.'" data-'.$financeEnv.'-title-logo data-'.$financeEnv.'-amount="'.$price.'" data-'.$financeEnv.'-apply="true" data-'.$financeEnv.'-apply-label="Apply Now" data-'.$financeEnv.'-plans ="'.$plans.'"></div>';
    }
    if(MODULE_PAYMENT_FINANCEPAYMENT_WIDGET == 'True') {
      $widgets['widget'] = '<div data-'.$financeEnv.'-widget data-'.$financeEnv.'-mode="popup" data-'.$financeEnv.'-prefix="'.MODULE_PAYMENT_FINANCEPAYMENT_PREFIX.'" data-'.$financeEnv.'-suffix="'.MODULE_PAYMENT_FINANCEPAYMENT_SUFIX.'" data-'.$financeEnv.'-title-logo data-'.$financeEnv.'-amount="'.$price.'" data-'.$financeEnv.'-apply="true" data-'.$financeEnv.'-apply-label="Apply Now" data-'.$financeEnv.'-plans ="'.$plans.'"></div>';
    }
  }
  die(json_encode($widgets));
}
if(isset($_POST['action']) && $_POST['action'] == 'getAdminProductForm' && $_POST['pID'] > 0) {
  die(json_encode(array('html' => $finance->getProductOptionsAdmin($_POST['pID']))));
}
if(isset($_POST['action']) && $_POST['action'] == 'CheckFinanceActiveCall' && $_POST['oID'] > 0) {
  die(json_encode(array('html' => $finance->CheckFinanceActiveCall($_POST['oID']))));
}
if(isset($_POST['action']) && $_POST['action'] == 'updateProductPlans' && $_POST['pID'] > 0) {
  if($finance->updatePlans($_POST['pID'],$_POST['plans'])) {
    die(json_encode(array('message' => 'Successfully updated product plans!')));
  }
}



require_once(DIR_WS_CLASSES . 'order.php');
require(DIR_WS_CLASSES . 'payment.php');
require_once(DIR_WS_CLASSES . 'shopping_cart.php');
require(DIR_WS_CLASSES . 'order_total.php');
global $order,$messageStack,$zco_notifier,$order_totals,$payment;
if (isset($_GET['type']) && $_GET['type'] == 'financepayment' && isset($_GET['response'])) {  
  $input = file_get_contents('php://input');
  $data  =  json_decode($input);
  if (!isset($data->status) || !isset($data->metadata->cart_id)) {
      die;
  }
  $cart_id   = $data->metadata->cart_id;
  $order_id = $data->metadata->order_id;
  $result = tep_db_fetch_array(tep_db_query('SELECT * FROM `finance_requests` WHERE `order_id` = "'.(int)$order_id.'"'
  ));
  if (!$result) {
      die;
  }
  $hash = hash('sha256', $result['cart_id'].$result['hash']);
  if ($hash !== $data->metadata->cart_hash && $order_id != $result['order_id']) {
      die;
  }
  $order = new Order($order_id);
  $status = "MODULE_PAYMENT_FINANCEPAYMENT_".$data->status."_STATUS";
  $status = $finance->getConfigValue($status);
  if (!$status) {
      die;
  }
  $total = preg_replace("/[^0-9.]/", "", $order->info['total']);
  if ($total != $result['total']) {
      $status = '';
  }
  $current_order_state = tep_db_fetch_array(tep_db_query("select orders_status_id
                                from " . TABLE_ORDERS_STATUS . "
                                where orders_status_name = '" . $order->info['orders_status'] . "'"));
  if($order_id && $status) {
    if ($current_order_state['orders_status_id'] != MODULE_PAYMENT_FINANCEPAYMENT_AWAITING_STATUS) {
        if ($status != $current_order_state['orders_status_id']) {
            $finance->updateOrderStatus($order_id,$status,'Finance Application Id: '.$result['transaction_id']);
        }
    } elseif ($status != $current_order_state['orders_status_id']) {
        $finance->updateOrderStatus($order_id,$status,'Finance Application Id: '.$result['transaction_id']);
    }
  }
} elseif (isset($_GET['type']) && $_GET['type'] == 'financepayment' && isset($_GET['confirmation']) && isset($_GET['cartID']) !='') {
    $cart_id = $_GET['cartID'];
    $result = tep_db_fetch_array(tep_db_query('SELECT * FROM `finance_requests` WHERE `cart_id` = "'.(int)$cart_id.'"'
  ));
    $order_id = $_SESSION['order_id'];
    if($order_id != $result['order_id']) {
      $messageStack->add_session('Your session has been expired.', 'error');
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
    $cart = new shoppingCart();
    $cart->restore_contents();
    $finance = new financepayment();
    if(!$order)
      $order = new Order($result['order_id']);
    if (!(is_object($order))) {
        $_SESSION['cartID'] == $cart->cartID;
        $_SESSION['cart'] = $cart;
        $messageStack->add_session('Your order could not be created, Please try again.', 'error');
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
    $current_order_state = tep_db_fetch_array(tep_db_query("select orders_status_id
                                from " . TABLE_ORDERS_STATUS . "
                                where orders_status_name = '" . $order->info['orders_status'] . "'"));
    if ($current_order_state['orders_status_id'] == MODULE_PAYMENT_FINANCEPAYMENT_AWAITING_STATUS) {
        $_SESSION['cartID'] == $cart->cartID;
        $_SESSION['cart'] = $cart;
        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
    $order_total_modules = new order_total;
    $finance->sendOrderEmails($order_id);
} 

 -----------------
Installation Notes      
------------------

1. Copy the includes folder and the financepayment_main_handler.php to your Oscommerce folder. This contains all the required module files, Do not overwrite any original files while copying.

2. Login into your admin page. While viewing the payment modules in admin you will see the "Finance Payment" module in the list. Click the **[Install]** button.

3. You can set the configuration of this module in the Modules => Payment => Finance Payment.

4.To add options of finance plans for each product page, You have to edit few files.
   a) You need to open the application_bottom.php under your admin folder and then /includes/application_bottom.php and add the below code at the bottom of the file.
   <!--bof Finance payment module js-->
  <script type="text/javascript" src="<?php echo '../includes/modules/payment/financepayment/js/product_admin.js';?>"></script>
  <!--eof Finance payment module js-->

   b) You need to open the product_info.php in the root directory of the oscommerce folder and add the below code at the bottom of the file.

    <!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo DIR_WS_MODULES.'payment/financepayment/js/product.js';?>"></script>
    <!--eof Finance payment module js-->
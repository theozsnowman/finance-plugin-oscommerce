 --------------------------------
Zipping up finance payment module 
---------------------------------

1. Run `composer install`

2. Run `bash zip.sh`


 -------------------------------------
Installation of finance payment module    
--------------------------------------

1. Move zip file to root directory of oscommerce site on client server

2. ssh into client server and navigate to root directory of oscommerce site

3. Run `unzip finance-gateway-m1.zip`

4. Run `bash unpack.sh`

5. Login into your admin page. While viewing the payment modules in admin you will see the "Finance Payment" module in the list. Click the **[Install]** button.

6. You can set the configuration of this module in the Modules => Payment => Finance Payment.

7.To add options of finance plans for each product page, You have to edit few files.
   a) You need to open the application_bottom.php under your admin folder and then /includes/application_bottom.php and add the below code at the bottom of the file.
   
 ```  
<!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo '../includes/modules/payment/financepayment/js/product_admin.js';?>">       </script>
<!--eof Finance payment module js-->
```

   b) You need to open the product_info.php in the root directory of the oscommerce folder and add the below code at the bottom of the file.
   
```
<!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo DIR_WS_MODULES.'payment/financepayment/js/product.js';?>"></script>
<!--eof Finance payment module js-->
```    

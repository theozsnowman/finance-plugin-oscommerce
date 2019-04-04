
Installation of finance payment module    
--------------------------------------

1. Move `finance-gateway-oscommerce.zip` to the "catalog" directory of the oscommerce site on the client server

2. ssh into the client server and navigate to the "catalog" directory of the oscommerce site

3. Run `unzip finance-gateway-oscommerce.zip`

5. Login to your admin page. While viewing the payment modules in admin you will see the "Finance Payment" module in the list. Click the **[Install]** button.

6. You can set the configuration of this module in the Modules => Payment => Finance Payment:

    a) Add your api key
    b) Set "Enable/Disable activation call functionality" to "True"
    b) Under "Set Order Status - Order status to make Finance Payment activation call", set to "Delivered"

6. To add options of finance plans for each product page, You have to edit few files.

   a) Open /admin/includes/application_bottom.php and add the below code at the bottom of the file.
   
 ```  
<!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo '../includes/modules/payment/financepayment/js/product_admin.js';?>">       </script>
<!--eof Finance payment module js-->
```

   
   b) Open product_info.php in the root directory add the below code at the bottom of the file.
   
```
<!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo DIR_WS_MODULES.'payment/financepayment/js/product.js';?>"></script>
<!--eof Finance payment module js-->
```    

7. To send an activation call to Divido you need to open /admin/orders.php and add the below code at the bottom of the file.
   
 ```  
<!--bof Finance payment module js-->
    <script type="text/javascript" src="<?php echo '../includes/modules/payment/financepayment/js/product_admin.js';?>">       </script>
<!--eof Finance payment module js-->
```
mv finance_main_handler.php catalog/
rm -rf includes/modules/payment/financepayment
mv includes/languages/english/modules/payment/financepayment.php catalog/includes/languages/english/modules/payment/
mv includes/modules/payment/* catalog/includes/modules/payment/
rm -rf catalog/vendor
mv vendor catalog/vendor
chmod 777 /var/www/oscommerce.demo.divido.com/catalog/includes/configure.php
chmod 777 /var/www/oscommerce.demo.divido.com/catalog/admin/includes/configure.php
<?php print $customer['firstname'] . ' ' . $customer['lastname'] . EMAIL_GREET . "\n\n" ?>
<?php print EMAIL_THANKS_FOR_SHOPPING . "\n" . EMAIL_DETAILS_FOLLOW . "\n" ?>

<?php print EMAIL_TEXT_ORDER_HISTORY_CONFIRM."\n";?>
<?php print $invoice_url; ?>

<?php print EMAIL_TEXT_DATE_ORDERED.$date_ordered?> 
<?php print EMAIL_TEXT_ORDER_NUMBER.$order_id?> 
<?php print EMAIL_TEXT_PAYMENT_METHOD.":".$payment_method . "\n";?>
<?php print EMAIL_TEXT_PRODUCTS."\n"?>
<?php print $products_ordered."\n"?>
<?php print $totals?>

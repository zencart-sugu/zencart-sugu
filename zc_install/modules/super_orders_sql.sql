-- EDIT EXISTING TABLES
ALTER TABLE orders ADD date_completed datetime default NULL;
ALTER TABLE orders ADD date_cancelled datetime default NULL;
ALTER TABLE orders ADD balance_due decimal(14,2) default NULL;


-- NEW TABLES

CREATE TABLE customers_admin_notes (
  admin_notes_id int(12) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  admin_id int(11) NOT NULL default '0',
  admin_notes text NOT NULL,
  rating tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (admin_notes_id),
  KEY customers_id (customers_id)
) TYPE=MyISAM ;

-- --------------------------------------------------------

CREATE TABLE so_payments (
  payment_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  payment_number varchar(32) NOT NULL default '',
  payment_name varchar(40) NOT NULL default '',
  payment_amount decimal(14,2) NOT NULL default '0.00',
  payment_type varchar(20) NOT NULL default '',
  date_posted datetime NOT NULL default '0000-00-00 00:00:00',
  last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  purchase_order_id int(11) NOT NULL default '0',
  PRIMARY KEY  (payment_id)
) TYPE=MyISAM ;

-- --------------------------------------------------------

CREATE TABLE so_payment_types (
  payment_type_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  payment_type_code varchar(4) NOT NULL default '',
  payment_type_full varchar(20) NOT NULL default '',
  PRIMARY KEY  (payment_type_id),
  UNIQUE KEY type_code (payment_type_code),
  KEY type_code_2 (payment_type_code)
) TYPE=MyISAM;

-- Some good default payment types
INSERT INTO so_payment_types VALUES (NULL, 1, 'CA', 'Cash');
INSERT INTO so_payment_types VALUES (NULL, 1, 'CK', 'Check');
INSERT INTO so_payment_types VALUES (NULL, 1, 'MO', 'Money Order');
INSERT INTO so_payment_types VALUES (NULL, 1, 'ADJ', 'Adjustment');
INSERT INTO so_payment_types VALUES (NULL, 1, 'CC', 'Credit Card');
INSERT INTO so_payment_types VALUES (NULL, 1, 'MC', 'Master Card');
INSERT INTO so_payment_types VALUES (NULL, 1, 'VISA', 'Visa');
INSERT INTO so_payment_types VALUES (NULL, 1, 'AMEX', 'American Express');
INSERT INTO so_payment_types VALUES (NULL, 1, 'DISC', 'Discover');

-- --------------------------------------------------------

CREATE TABLE so_purchase_orders (
  purchase_order_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  po_number varchar(32) default NULL,
  date_posted datetime NOT NULL default '0000-00-00 00:00:00',
  last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (purchase_order_id)
) TYPE=MyISAM ;

-- --------------------------------------------------------

CREATE TABLE so_refunds (
  refund_id int(11) NOT NULL auto_increment,
  payment_id int(11) NOT NULL default '0',
  orders_id int(11) NOT NULL default '0',
  refund_number varchar(32) NOT NULL default '',
  refund_name varchar(40) NOT NULL default '',
  refund_amount decimal(14,2) NOT NULL default '0.00',
  refund_type varchar(4) NOT NULL default 'CK',
  date_posted datetime NOT NULL default '0000-00-00 00:00:00',
  last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (refund_id),
  KEY refund_id (refund_id)
) TYPE=MyISAM ;

-- --------------------------------------------------------

-- Store Phone and Fax numbers
INSERT INTO configuration VALUES ('', 'Store Fax', 'STORE_FAX', '', 'Enter the fax number for your store.<br>You can call upon this by using the define <strong>STORE_FAX</strong>.', 1, 4, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'Store Phone', 'STORE_PHONE', '', 'Enter the phone number for your store.<br>You can call upon this by using the define <strong>STORE_PHONE</strong>.', 1, 4, now(), now(), NULL, NULL);

-- Purchase Order payment module configs
INSERT INTO configuration VALUES (NULL, 'Enable Purchase Order Module', 'MODULE_PAYMENT_PURCHASE_ORDER_STATUS', 'True', 'Do you want to accept Purchase Order payments?', 6, 1, now(), now(), NULL, 'zen_cfg_select_option(array(\'True\', \'False\'), ');
INSERT INTO configuration VALUES (NULL, 'Make payable to:', 'MODULE_PAYMENT_PURCHASE_ORDER_PAYTO', 'Destination ImagiNation, Inc.', 'Who should payments be made payable to?', 6, 2, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Sort order of display.', 'MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 4, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Payment Zone', 'MODULE_PAYMENT_PURCHASE_ORDER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 5, now(), now(), 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(');
INSERT INTO configuration VALUES (NULL, 'Set Order Status', 'MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID', '2', 'Set the status of orders made with this payment module to this value', 6, 6, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');

-- Super Orders configuration group
INSERT INTO configuration_group VALUES (28, 'Super Orders', 'Settings for Super Order features', 100, 1);

-- Super Orders configs (Admin > Configuration > Super Orders)
-- Automatic Status Updating
INSERT INTO configuration VALUES (NULL, 'Auto Status - Purchase Order', 'AUTO_STATUS_PO', '2', 'Number of the status assigned to an order when a purchase order is added to the payment data.', 28, 11, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Auto Status - Payment', 'AUTO_STATUS_PAYMENT', '2', 'Number of the order status assigned when a payment (<B>not</B> attached to a purchase order) is added to the payment data.', 28, 10, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Auto Status - P.O. Payment', 'AUTO_STATUS_PO_PAYMENT', '2', 'Number of the order status assigned when a payment <B>attached to a purchase order</B> is added to the payment data.', 28, 10, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Auto Status - Refund', 'AUTO_STATUS_REFUND', '2', 'Number of the order status assigned when a refund is added to the payment data.', 28, 13, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Auto Comments - Payment', 'AUTO_COMMENTS_PAYMENT', 'Payment received in our office. Payment ID: %s', 'You''ll have the option of adding these pre-configured comments to an order when a payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.', 28, 14, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Auto Comments - P.O. Payment', 'AUTO_COMMENTS_PO_PAYMENT', 'Payment on purchase order received in our office. Payment ID: %s', 'You will have the option of adding these pre-configured comments to an order when a purchase order payment is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.', 28, 14, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Auto Comments - Purchase Order', 'AUTO_COMMENTS_PO', 'Purchase Order #%s received in our office', 'You will have the option of adding these pre-configured comments to an order when a purchase order is entered.  You can attach the payment number to the comments by typing <strong>%s</strong>.', 28, 15, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Auto Comments - Refund', 'AUTO_COMMENTS_REFUND', 'Refund #%s has been issued from our office.', 'You will have the option of adding these pre-configured comments to an order when a refund is entered.  You can attach the refund number to the comments by typing <strong>%s</strong>.', 28, 17, now(), now(), NULL, NULL);
INSERT INTO configuration VALUES (NULL, 'Federal Tax Exempt Number', 'FED_TAX_ID_NUMBER', '00-000000', 'If your tax exempt, then you should have a federal tax ID number. Enter the number here and the tax columns will not appear on the invoice. The number will also be displayed at the top of the invoice.', 28, 50, now(), now(), NULL , NULL);
INSERT INTO configuration VALUES (NULL, 'Closed Status - "Cancelled"', 'STATUS_ORDER_CANCELLED', '0', 'Insert the order status ID # you would like to assign to an order when you press the special "Cancelled!" button on super_orders.php.<p>If you do not have a "cancel" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>', 28, 30, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Closed Status - "Completed"', 'STATUS_ORDER_COMPLETED', '0', 'Insert the order status ID # you would like to assign to an order when you press the special "Completed!" button on super_orders.php.<p>If you do not have a "complete" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>', 28, 30, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (NULL, 'Closed Status - "Reopened"', 'STATUS_ORDER_REOPEN', '0', 'Insert the order status ID # you would like to assign to an order when you undo the cancelled/completed status of an order.<p>If you do not have a "reopened" status, or do not want assign one automatically, choose <B>default</B> and this option will be ignored.<p><strong>You cannot attach comments or notify the customer using this option.</strong>', 28, 30, now(), now(), 'zen_get_order_status_name', 'zen_cfg_pull_down_order_statuses(');

-- Following is for a future release
-- Bar code display
--INSERT INTO configuration VALUES (NULL, 'Display bar codes', 'BC_ENABLE', 'true', 'If enabled, a bar code of the order number will appear on invoices and packing slips.', 28, 99, now(), now(), NULL, 'zen_cfg_select_option(array(''true'', ''false''),');
--INSERT INTO configuration VALUES (NULL, 'Bar Code Height', 'BC_HEIGHT', '60', 'Height of image in pixels.', 28, 99, now(), now(), NULL, NULL);
--INSERT INTO configuration VALUES (NULL, 'Bar Code Width', 'BC_WIDTH', '300', 'Width of image in pixels. The image MUST be wide enough to handle the length of the given value. The default value will probably be able to display about 11 digits. If you get an error message, make it wider!', 28, 99, now(), now(), NULL, NULL);
--INSERT INTO configuration VALUES (NULL, 'Bar Code Quality', 'BC_QUALITY', '100', 'For JPEG only: ranges from 0-100.', 28, 99, now(), now(), NULL, NULL);
--INSERT INTO configuration VALUES (NULL, 'Bar Code Output Format', 'BC_OUTTYPE', 'PNG', 'The graphic format for the barcode.<br />TIP: JPEG is usually the best option. PNG normally dosen''t print well, and GIF is very low-res.', 28, 99, now(), now(), NULL, 'zen_cfg_select_option(array(\'JPEG\', \'PNG\', \'GIF\'),');
--INSERT INTO configuration VALUES (NULL, 'Display text of bar code contents', 'BC_TEXTSHOW', 'true', 'To disable text below barcode = 0. To enable text below barcode = 1.', 28, 99, now(), now(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');
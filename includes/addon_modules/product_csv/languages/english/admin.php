<?php
define('HEADING_TITLE', 'Centrally managed by CSV');

define('PRODUCT_CSV_IMPORT_TITLE', '* Products Shelf Registration or Mass Update');
define('PRODUCT_CSV_IGNORE_FIRST_LINE', 'Ignore First Line');
define('PRODUCT_CSV_IMPORT_MESSAGE', 'Please upload a CSV file.');
define('PRODUCT_CSV_IMPORT_BUTTON', 'Upload');

define('PRODUCT_CSV_EXPORT_TITLE', '* Products CSV Download');
define('PRODUCT_CSV_EXPORT_CATEGORY', 'Categories for Download');
define('PRODUCT_CSV_EXPORT_BUTTON', 'CSV Download');

define('PRODUCT_CSV_FORMAT', 'CSV File Format');

// error message
define('PRODUCT_CSV_ERROR_READ', 'Failed to load the file');
define('PRODUCT_CSV_ERROR_INVALID_FORMAT', 'The format of the file does not match the format specified');

// import message
define('PRODUCT_CSV_TABLE_HEADER', 'Execution Results');
define('PRODUCT_CSV_TABLE_LINE_NUMBER', 'Line Number');
define('PRODUCT_CSV_MESSAGE_SUCCESS', 'Successful Updated');
// product
define('PRODUCT_CSV_MESSAGE_DELETE', 'Deleted');
define('PRODUCT_CSV_MESSAGE_NO_MODEL', 'No Mode');
define('PRODUCT_CSV_MESSAGE_NOT_STRING', 'Please input %s by the character string.');
define('PRODUCT_CSV_MESSAGE_NOT_PATHSTRING', 'An alphanumeric character and _-/. can use it for %s.');
define('PRODUCT_CSV_MESSAGE_NOT_URLSTRING', 'An alphanumeric character and -.$,;:&=?!*~@#_()/ can use it for %s. The head should start by http(s)://');
define('PRODUCT_CSV_MESSAGE_NOT_INT', 'Please input %s by the unsigned integer.');
define('PRODUCT_CSV_MESSAGE_NOT_SIGNED_INT', 'Please input %s by the signed integer.');
define('PRODUCT_CSV_MESSAGE_NOT_FLOAT', 'Please input %s by the unsigned float.');
define('PRODUCT_CSV_MESSAGE_NOT_SIGNED_FLOAT', 'Please input %s by the signed float.');
define('PRODUCT_CSV_MESSAGE_NOT_ZERO_ONE', 'Please input %s by 0 or 1.');
define('PRODUCT_CSV_MESSAGE_NOT_DATETIME_SHORT', 'Please input %s by YYYY-MM-DD format.');
define('PRODUCT_CSV_MESSAGE_NOT_DATETIME_LONG', 'Please input %s by YYYY-MM-DD HH:MM:SS format.');
define('PRODUCT_CSV_MESSAGE_NO_PRODUCT_TYPE', 'Product type %s does not exist.');
define('PRODUCT_CSV_MESSAGE_NO_TAX_CLASS_TITLE', 'Tax class %s does not exist.');
define('PRODUCT_CSV_MESSAGE_NO_SHIPPING_TYPE', 'Shipping type %s does not exist.');

// category
define('PRODUCT_CSV_MESSAGE_NO_TOPLEVEL_CATEGORY', 'Please be sure to input top level');
define('PRODUCT_CSV_MESSAGE_NO_CATEGORY_NAME', 'Category name is blank');
define('PRODUCT_CSV_MESSAGE_NOT_SEQUENTIAL', 'A blank is between category level.');
define('PRODUCT_CSV_MESSAGE_NOT_MATCH', '%s category name does not match');
define('PRODUCT_CSV_MESSAGE_CANNOT_ADD_CATEGORY', 'A subcategory cannot be added to the category containing products.');
define('PRODUCT_CSV_MESSAGE_CANNOT_ADD_PRODUCT', 'A products cannot be added to the category containing subcategory.');
define('PRODUCT_CSV_MESSAGE_CREATE_CATEGORY', 'The category was created.');
define('PRODUCT_CSV_MESSAGE_DELETE_CATEGORY', 'Removed the category of linking');
// option
define('PRODUCT_CSV_MESSAGE_NOT_PLUS_MINUS', 'Please input %s by + or -.');
define('PRODUCT_CSV_MESSAGE_NO_OPTION_NAME', 'The option name does not match');
define('PRODUCT_CSV_MESSAGE_OPTION_NAME_IS_EMPTY', 'The option name is empty');
define('PRODUCT_CSV_MESSAGE_OPTION_VALUE_IS_EMPTY', 'The option value is empty');
define('PRODUCT_CSV_MESSAGE_OPTION_DELETE', 'Removed the option of linking');
define('PRODUCT_CSV_MESSAGE_OPTION_VALUE', 'Optional value was added');
define('PRODUCT_CSV_RESERVED_OPTION_NAME', 'Extension Guarantee');
define('PRODUCT_CSV_MESSAGE_OPTION_NAME_RESERVED', 'Option Name:'.PRODUCT_CSV_RESERVED_OPTION_NAME.' cannot be specified');

define('PRODUCT_CSV_MESSAGE_IMPORT_STATUS', '%s lines were read. Success:%s Failure:%s');
?>
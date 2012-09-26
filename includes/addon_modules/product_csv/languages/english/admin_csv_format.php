<?php
define('HEADING_TITLE', 'CSV Product Definition');
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_FORMAT_NAME', 'Format Name');
define('TABLE_HEADING_FORMAT_TYPE', 'Type');
define('TABLE_HEADING_ACTION', 'Action');

define('MESSAGE_DELETE_FORMAT', 'ID:%s Delete %s?');
define('MESSAGE_CHECK_NAME', 'Please specify the format name');
define('MESSAGE_NO_FORMATS', 'The format does not save');

define('FORM_FORMAT_NAME', 'Format Name');
define('FORM_FORMAT_TYPE', 'Type');
define('FORM_FORMAT_NOW', 'Format set now');
define('FORM_FORMAT_COLUMN_NAME', 'Column %s');
define('FORM_FORMAT_STEP1', 'STEP1: CSV product upload');
define('FORM_FORMAT_MESSAGE1', 'Please upload products CSV.');
define('FORM_FORMAT_UPLOAD', 'Upload');
define('FORM_FORMAT_FILE', 'CSV File');
define('FORM_FORMAT_STEP2', 'STEP2: Format Setting');
define('FORM_FORMAT_MESSAGE2', 'Please define the contents of the item of each sequence based on the uploaded file.');
define('FORM_FORMAT_COLUMN_HEADER1', 'Column Number');
define('FORM_FORMAT_COLUMN_HEADER2', 'Value of the first line of uploaded file');
define('FORM_FORMAT_COLUMN_HEADER3', 'Item Content');
define('FORM_FORMAT_NOTICE', 'NOTICE: The following items are required.');
define('FORM_FORMAT_NECESSITY_PRODUCT', 'Model');
define('FORM_FORMAT_NECESSITY_CATEGORY', 'Category Name-Level 1');
define('FORM_FORMAT_NECESSITY_OPTION', 'Option Name / Value / Model');
define('FORM_FORMAT_SAVE', 'Save');

define('FORM_FORMAT_INVALID_FILE', 'Failed to load the file. File format may be incorrect. Please upload the file are correct and try again.<br/>If the file is too large, please try to split.');

define('FORM_FORMAT_ERROR_REPEATED', 'Duplicate %s');
define('FORM_FORMAT_ERROR_NECESSITY', '%s is required');
define('FORM_FORMAT_NECESSITY_SHORT_CATEGORY', 'Level 1');
define('FORM_FORMAT_CATEGORY_LEVEL_PREFIX', '-Level');
define('FORM_FORMAT_CATEGORY_LEVEL_SEQ_ERROR', 'Hierarchy of %s is not continuously');
define('FORM_FORMAT_CATEGORY_LEVEL_OVER', 'A level that is deeper than the level of the %s cannot be specified by the other language.');
?>
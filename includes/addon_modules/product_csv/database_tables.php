<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * Database name defines
 *
 */
define('CSV_FORMAT_TYPES', DB_PREFIX . 'csv_format_types');
define('CSV_FORMATS', DB_PREFIX . 'csv_formats');
define('CSV_COLUMNS', DB_PREFIX . 'csv_columns');
define('CSV_FORMAT_COLUMNS', DB_PREFIX . 'csv_format_columns');

define('CREATE_CSV_FORMAT_TYPES', 'CREATE TABLE IF NOT EXISTS ' . CSV_FORMAT_TYPES . ' (
csv_format_type_id INT(11) auto_increment,
csv_format_type_name VARCHAR(255),
PRIMARY KEY (csv_format_type_id)
)');
define('CREATE_CSV_FORMATS', 'CREATE TABLE IF NOT EXISTS ' . CSV_FORMATS . ' (
csv_format_id INT(11) auto_increment,
csv_format_type_id INT(11),
csv_format_name VARCHAR(255),
csv_format_date_added DATETIME,
csv_format_last_modified DATETIME,
PRIMARY KEY (csv_format_id),
KEY idx_format_name_zen (csv_format_name)
)');
define('CREATE_CSV_COLUMNS', 'CREATE TABLE IF NOT EXISTS ' . CSV_COLUMNS . ' (
csv_column_id INT(11) auto_increment,
csv_format_type_id INT(11),
csv_column_name VARCHAR(255),
csv_column_validate_function TEXT,
csv_columns_dbtable VARCHAR(255),
csv_columns_dbcolumn VARCHAR(255),
PRIMARY KEY (csv_column_id)
)');
define('CREATE_CSV_FORMAT_COLUMNS', 'CREATE TABLE IF NOT EXISTS ' . CSV_FORMAT_COLUMNS . ' (
csv_format_column_id INT(11) auto_increment,
csv_format_id INT(11),
csv_column_id INT(11),
csv_format_column_number INT(11),
PRIMARY KEY (csv_format_column_id),
KEY idx_csv_format_columns_zen (csv_format_id, csv_format_column_number, csv_column_id)
)');

define('INSERT_CSV_FORMAT_TYPES', 'INSERT INTO ' . CSV_FORMAT_TYPES . '
VALUES
 (\'1\', \'%s\'),
 (\'2\', \'%s\'),
 (\'3\', \'%s\')'
       );
define('INSERT_CSV_COLUMNS', 'INSERT INTO ' . CSV_COLUMNS . '
(csv_column_id,
csv_format_type_id,
csv_column_name,
csv_column_validate_function,
csv_columns_dbtable,
csv_columns_dbcolumn
) VALUES (\'%s\', \'%s\', \'%s\', \'%s\', \'%s\', \'%s\')'
       );
?>
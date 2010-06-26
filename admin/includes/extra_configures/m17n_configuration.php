<?php
/**
 * m17n configuration
 *
 * @package productTypes
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: m17n_configuration.php 2842 2008-01-12 06:21:11Z sasaki $
 */
/**
 * exclude db configuretion keys cause configuretion values defined on language file.
 */
  $exclude_db_configuretion_keys = array(
    'STORE_NAME',
    'STORE_OWNER',
    'STORE_NAME_ADDRESS'
  );
?>
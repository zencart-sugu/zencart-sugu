<?php
/**
 * addon main_template_vars.php
 *
 * @package page
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_INDEX_MAIN_TEMPLATE_VARS');

// get module page vars
extract($page_module->getTemplateVars($page_method));

// require module page template
require($page_module->getPageTemplate($page_method));

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_INDEX_MAIN_TEMPLATE_VARS');
?>
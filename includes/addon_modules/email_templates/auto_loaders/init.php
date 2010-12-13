<?php
require DIR_FS_CATALOG_ADDON_MODULES . 'email_templates/classes/class.email_templates_replacer.php';

$email_templates_insert = array();
// load jquery
$email_templates_insert[] = array('target' => '<script',
                                  'insert' => '<script language="javascript" src="../includes/addon_modules/jquery/templates/template_default/jscript/jquery.js"></script>'
                                 );
// super_orders.php
$email_templates_insert[] = array('target' => '</tr>[\w\d\s\r\n]*<tr>[\w\d\s\r\n]*<td class="main"><strong>'.ENTRY_STATUS,
                                  'insert' => '
                </tr>
                                               <tr>
                                                 <td>'.
                                                   ENTRY_NOTIFY_CUSTOMER.
                                                   zen_get_email_group_for_status((int)$_GET['oID']).
                                                   zen_draw_hidden_field('notify',          '', 'id="notify"').
                                                   zen_draw_hidden_field('notify_comments', '', 'id="notify_comments"').'
                                                 </td>
                                               </tr>'
                                 );
// super_batch_status.php
$email_templates_insert[] = array('target' => '</table></td>[\w\d\s\r\n]*</tr>[\w\d\s\r\n]*<tr>[\w\d\s\r\n]*<td colspan="2">[\w\d\s\r\n]*'.TEXT_TOTAL_ORDERS,
                                  'insert' => '<tr><td colspan=3><?php echo zen_get_email_template_for_status(); ?></td></tr>'
                                 );


$email_templates_replace = array();
// orders.php
$email_templates_replace[] = array('original' => '<td class="main"><strong>'.ENTRY_NOTIFY_CUSTOMER.'</strong>.*</td>',
                                   'replace' => ENTRY_NOTIFY_CUSTOMER
                                                .zen_get_email_group_for_status((int)$_GET['oID'])
                                                .zen_draw_hidden_field('notify',          '', 'id="notify"')
                                                .zen_draw_hidden_field('notify_comments', '', 'id="notify_comments"')
                                  );
$email_templates_replace[] = array('original' => '<td class="main"><strong>'.ENTRY_NOTIFY_COMMENTS.'</strong>.*</td>',
                                   'replace' => ''
                                  );
// super_orders.php
$email_templates_replace[] = array('original' => '<input type="checkbox".*name="notify".*'.ENTRY_NOTIFY_CUSTOMER.'<br />',
                                   'replace' => ''
                                  );
$email_templates_replace[] = array('original' => '<input type="checkbox".*name="notify_comments".*'.ENTRY_NOTIFY_COMMENTS,
                                   'replace' => ''
                                  );

$etr = new email_templates_replacer($email_templates_insert);

?>
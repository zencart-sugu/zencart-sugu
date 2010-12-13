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
$email_templates_replace[] = array('original' => '<input type="checkbox".*name="notify".*'.ENTRY_NOTIFY_CUSTOMER.'<br />[\w\d\s\r\n]*<input type="checkbox".*name="notify_comments".*'.ENTRY_NOTIFY_COMMENTS.'[\w\d\s\r\n]*</strong>[\w\d\s\r\n]*</td>',
                                   'replace' => ''
                                  );

// super_batch_status.php
$button = zen_image_submit('button_update.gif', IMAGE_UPDATE);
$email_templates_replace[] = array('original' => $button.'[\w\d\s\r\n]*</td>[\w\d\s\r\n]*</tr>[\w\d\s\r\n]*</table>[\w\d\s\r\n]*</td>[\w\d\s\r\n]*</tr>',
                                   'replace' => $button.'</td></tr><tr><td colspan="3">'.zen_get_email_template_for_status().'</td></tr></table></td></tr>'
                                 );

$etr = new email_templates_replacer($email_templates_insert);

?>
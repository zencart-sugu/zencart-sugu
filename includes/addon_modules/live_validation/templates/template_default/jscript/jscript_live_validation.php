<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>

<?php 
switch ($_GET['main_page']) {
case 'checkout_shipping_address':
case 'checkout_payment_address':
case 'login':
case 'create_account':
case 'account_edit':
case 'address_book_process':
?>
<script type="text/javascript" src="<?php echo $this->_getTemplateDir('.js', $page, 'jscript') . '/jquery.validate.js'; ?>"></script>
<script type="text/javascript" src="<?php echo $this->_getTemplateDir('.js', $page, 'jscript') . '/live_validation.js'; ?>"></script>
<script type="text/javascript">
  liveValidation.validate_depend_firstname = <?php echo ($_GET['main_page'] == 'checkout_shipping_address' || $_GET['main_page'] == 'checkout_payment_address') ? 'true' : 'false' ?>;
  liveValidation.mainPage = '<?php echo $_GET["main_page"]; ?>';
  liveValidation.config = {
    privacy_conditions : {'required'  : {'value'   : <?php echo (DISPLAY_PRIVACY_CONDITIONS == 'true' ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED; ?>'}},
    gender             : {'required'  : {'value'   : <?php echo (ACCOUNT_GENDER == 'true' ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_GENDER_ERROR; ?>'}},
    firstname          : {'required'  : {'value'   : <?php echo (ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_FIRST_NAME_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>',
                                         'message' : '<?php echo ENTRY_FIRST_NAME_ERROR; ?>'}},
    lastname           : {'required'  : {'value'   : <?php echo (ENTRY_LAST_NAME_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_LAST_NAME_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>',
                                         'message' : '<?php echo ENTRY_LAST_NAME_ERROR; ?>'}},
<?php if (FURIKANA_NESESSARY) { ?>
    firstname_kana     : {'required'  : {'value'   : <?php echo (ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_FIRST_NAME_KANA_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>',
                                         'message' : '<?php echo ENTRY_FIRST_NAME_KANA_ERROR; ?>'}},
    lastname_kana      : {'required'  : {'value'   : <?php echo (ENTRY_LAST_NAME_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_LAST_NAME_KANA_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>',
                                         'message' : '<?php echo ENTRY_LAST_NAME_KANA_ERROR; ?>'}},
<?php } ?>
<?php if (ACCOUNT_DOB == 'true') { ?>
    dob                : {'required'  : {'value'   : <?php echo (ENTRY_DOB_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_DATE_OF_BIRTH_ERROR; ?>'},
                          'date'      : {'value'   : true,
                                         'message' : '<?php echo ENTRY_DATE_OF_BIRTH_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_DOB_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_DATE_OF_BIRTH_ERROR; ?>'}},
<?php } ?>
    email_address      : {'required'  : {'value'   : <?php echo (ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_EMAIL_ADDRESS_ERROR ?>'},
                          'email'     : {'value'   : true,
                                         'message' : '<?php echo ENTRY_EMAIL_ADDRESS_CHECK_ERROR; ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>'}},
    street_address     : {'required'  : {'value'   : <?php echo (ENTRY_STREET_ADDRESS_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_STREET_ADDRESS_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_STREET_ADDRESS_ERROR; ?>'}},
    postcode           : {'required'  : {'value'   : <?php echo (ENTRY_POSTCODE_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_POST_CODE_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_POSTCODE_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_POST_CODE_ERROR; ?>'}},
    city               : {'required'  : {'value'   : <?php echo (ENTRY_CITY_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_CITY_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_CITY_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_CITY_ERROR; ?>'}},
    country            : {'number'    : {'value'   : true,
                                         'message' : '<?php echo ENTRY_COUNTRY_ERROR ?>'}},
<?php if (ACCOUNT_STATE == 'true') { ?>
    state              : {'required'  : {'value'   : <?php echo (ENTRY_STATE_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_STATE_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_STATE_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_STATE_ERROR; ?>'}},
<?php } ?>
    telephone          : {'required'  : {'value'   : <?php echo (ENTRY_TELEPHONE_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_TELEPHONE_NUMBER_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_TELEPHONE_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_TELEPHONE_NUMBER_ERROR; ?>'}},
    password           : {'required'  : {'value'   : <?php echo (ENTRY_PASSWORD_MIN_LENGTH > 0 ? 'true' : 'false') ?>,
                                         'message' : '<?php echo ENTRY_PASSWORD_ERROR ?>'},
                          'minlength' : {'value'   : '<?php echo ENTRY_PASSWORD_MIN_LENGTH ?>',
                                         'message' : '<?php echo ENTRY_PASSWORD_ERROR; ?>'}},
    confirmation       : {'equalTo'   : {'value'   : '#password-new',
                                         'message' : '<?php echo ENTRY_PASSWORD_ERROR_NOT_MATCHING ?>'}}
  }
new liveValidation.Validator(liveValidation.mainPage,
                             liveValidation.config);
</script>
<?php } ?>

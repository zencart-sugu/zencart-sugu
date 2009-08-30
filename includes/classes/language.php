<?php
/**
 * language Class.
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: language.php 3041 2006-02-15 21:56:45Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * language Class.
 * Class to handle language settings for customer viewing
 *
 * @package classes
 */
class language extends base {
  var $languages, $catalog_languages, $browser_languages, $language;

  function language($lng = '') {
    global $db;
    $this->languages = array('ar' => array('ar([-_][[:alpha:]]{2})?|arabic', 'arabic', 'ar'),
    'bg-win1251' => array('bg|bulgarian', 'bulgarian-win1251', 'bg'),
    'bg-koi8r' => array('bg|bulgarian', 'bulgarian-koi8', 'bg'),
    'ca' => array('ca|catalan', 'catala', 'ca'),
    'cs-iso' => array('cs|czech', 'czech-iso', 'cs'),
    'cs-win1250' => array('cs|czech', 'czech-win1250', 'cs'),
    'da' => array('da|danish', 'danish', 'da'),
    'de' => array('de([-_][[:alpha:]]{2})?|german', 'german', 'de'),
    'el' => array('el|greek',  'greek', 'el'),
    'en' => array('en([-_][[:alpha:]]{2})?|english', 'english', 'en'),
    'es' => array('es([-_][[:alpha:]]{2})?|spanish', 'spanish', 'es'),
    'et' => array('et|estonian', 'estonian', 'et'),
    'fi' => array('fi|finnish', 'finnish', 'fi'),
    'fr' => array('fr([-_][[:alpha:]]{2})?|french', 'french', 'fr'),
    'gl' => array('gl|galician', 'galician', 'gl'),
    'he' => array('he|hebrew', 'hebrew', 'he'),
    'hu' => array('hu|hungarian', 'hungarian', 'hu'),
    'id' => array('id|indonesian', 'indonesian', 'id'),
    'it' => array('it|italian', 'italian', 'it'),
    'ja-euc' => array('ja|japanese', 'japanese-euc', 'ja'),
    'ja-sjis' => array('ja|japanese', 'japanese-sjis', 'ja'),
    'ko' => array('ko|korean', 'korean', 'ko'),
    'ka' => array('ka|georgian', 'georgian', 'ka'),
    'lt' => array('lt|lithuanian', 'lithuanian', 'lt'),
    'lv' => array('lv|latvian', 'latvian', 'lv'),
    'nl' => array('nl([-_][[:alpha:]]{2})?|dutch', 'dutch', 'nl'),
    'no' => array('no|norwegian', 'norwegian', 'no'),
    'pl' => array('pl|polish', 'polish', 'pl'),
    'pt-br' => array('pt[-_]br|brazilian portuguese', 'brazilian_portuguese', 'pt-BR'),
    'pt' => array('pt([-_][[:alpha:]]{2})?|portuguese', 'portuguese', 'pt'),
    'ro' => array('ro|romanian', 'romanian', 'ro'),
    'ru-koi8r' => array('ru|russian', 'russian-koi8', 'ru'),
    'ru-win1251' => array('ru|russian', 'russian-win1251', 'ru'),
    'sk' => array('sk|slovak', 'slovak-iso', 'sk'),
    'sk-win1250' => array('sk|slovak', 'slovak-win1250', 'sk'),
    'sr-win1250' => array('sr|serbian', 'serbian-win1250', 'sr'),
    'sv' => array('sv|swedish', 'swedish', 'sv'),
    'th' => array('th|thai', 'thai', 'th'),
    'tr' => array('tr|turkish', 'turkish', 'tr'),
    'uk-win1251' => array('uk|ukrainian', 'ukrainian-win1251', 'uk'),
    'zh-tw' => array('zh[-_]tw|chinese traditional', 'chinese_big5', 'zh-TW'),
    'zh' => array('zh|chinese simplified', 'chinese_gb', 'zh'));


    $this->catalog_languages = array();
    $languages_query = "select languages_id, name, code, image, directory
                          from " . TABLE_LANGUAGES . " 
                          order by sort_order";

    $languages = $db->Execute($languages_query);

    while (!$languages->EOF) {
      $this->catalog_languages[$languages->fields['code']] = array('id' => $languages->fields['languages_id'],
      'name' => $languages->fields['name'],
      'image' => $languages->fields['image'],
      'code' => $languages->fields['code'],
      'directory' => $languages->fields['directory']);
      $languages->MoveNext();
    }
    $this->browser_languages = '';
    $this->language = '';

    $this->set_language($lng);
  }

  function set_language($language) {
    if ( (zen_not_null($language)) && (isset($this->catalog_languages[$language])) ) {
      $this->language = $this->catalog_languages[$language];
    } else {
      $this->language = $this->catalog_languages[DEFAULT_LANGUAGE];
    }
  }

  function get_browser_language() {
    $this->browser_languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

    for ($i=0, $n=sizeof($this->browser_languages); $i<$n; $i++) {
      reset($this->languages);
      while (list($key, $value) = each($this->languages)) {
        if (eregi('^(' . $value[0] . ')(;q=[0-9]\\.[0-9])?$', $this->browser_languages[$i]) && isset($this->catalog_languages[$key])) {
          $this->language = $this->catalog_languages[$key];
          break 2;
        }
      }
    }
  }
}
?>
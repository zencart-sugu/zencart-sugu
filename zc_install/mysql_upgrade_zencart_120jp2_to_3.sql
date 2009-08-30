# This SQL script upgrades the core Zen Cart database structure from v1.2.0-l10n-jp-2 to v1.2.0-l10n-jp-3
#
# 2005/05/06 shida@zen-cart.jp


UPDATE configuration SET configuration_title = 'アカウント作成時の個人情報確認画面表示', configuration_description = 'アカウントを作成する画面で個人情報の確認画面を表示します。<div style="color: red;">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>', configuration_value='true' WHERE configuration_key = 'DISPLAY_PRIVACY_CONDITIONS';
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('お問い合わせ時の個人情報確認画面表示', 'DISPLAY_CONTACT_US_PRIVACY_CONDITIONS', 'true', 'お問い合わせする画面で個人情報の確認画面を表示します。<div style="color: red;">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を開示することが求められています。</div>', '11', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now());
 

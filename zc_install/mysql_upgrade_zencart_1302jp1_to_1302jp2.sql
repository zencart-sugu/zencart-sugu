# Start of l10n-jp-2's modification
DELETE from tax_rates;
DELETE from geo_zones;
DELETE from zones_to_geo_zones;
DELETE from tax_class;
INSERT INTO tax_rates VALUES (1,1,1,1,5.0000,'消費税：5%','2007-01-15 11:44:17','2006-11-29 16:18:40');
INSERT INTO geo_zones VALUES (1,'日本','日本（消費税）','2007-01-15 11:44:41','2006-11-29 16:18:40');
INSERT INTO zones_to_geo_zones VALUES (1,107,NULL,1,'2007-01-21 11:44:32','2006-11-29 16:18:40');
INSERT INTO tax_class VALUES (1,'消費税','消費税（日本）','2007-01-15 11:43:40','2004-01-21 01:35:29');
UPDATE configuration SET configuration_title='価格を税込みで表示 - 管理画面', configuration_description='管理画面で価格を税込みで表示するかどうかを設定します。<br /><br />\r\n・true = 価格を税込みで表示<br />\r\n・false = 最後に税額を表示', configuration_value = 'true' WHERE configuration_key='DISPLAY_PRICE_WITH_TAX_ADMIN';
UPDATE configuration SET configuration_title='送信メールの送信元アドレスの実在性', configuration_description='お使いのメールサーバでは、送信するメールの送信元(From)アドレスがWebサーバ上に実在することが必須ですか?<br /><br />spam送信を防止するなどのためにこのように設定されていることがあります。Yesに設定すると、送信元アドレスとメール内のFromアドレスが一致していることが求められます。' WHERE configuration_key='EMAIL_SEND_MUST_BE_STORE';
UPDATE configuration SET configuration_title='クッキー利用を必須にする', configuration_description='セッションに必ずクッキーを利用します。True指定するとブラウザのクッキーがオフになっている場合はセッションを開始しません。セキュリティ上の理由から余程の理由のない限りはTrue指定のままとすることを強く推奨します。', configuration_value='True' WHERE configuration_key='SESSION_FORCE_COOKIE_USE';
UPDATE configuration SET configuration_title='ウェルカムクーポン券', configuration_description='会員登録時にその会員にウェルカムクーポン券として自動発行するクーポン券を選択してください。' WHERE configuration_key='NEW_SIGNUP_DISCOUNT_COUPON';
UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-2' where project_version_id = '1';
UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-2' where project_version_id = '2';
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Main', '1', '3.0.2-l10n-jp-2', '', 'v1.3.0.2-l10n-jp-2', now());
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Database', '1', '3.0.2-l10n-jp-2', '', 'v1.3.0.2-l10n-jp-2', now());
# End of l10n-jp-2's modification

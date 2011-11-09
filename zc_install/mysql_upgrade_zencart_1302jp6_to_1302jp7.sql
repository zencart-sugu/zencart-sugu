UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-7' where project_version_id = '1';
UPDATE project_version SET project_version_minor = '3.0.2-l10n-jp-7' where project_version_id = '2';
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Main', '1', '3.0.2-l10n-jp-7', '', 'v1.3.0.2-l10n-jp-7', now());
INSERT INTO project_version_history (project_version_key, project_version_major, project_version_minor, project_version_patch, project_version_comment, project_version_date_applied) VALUES ('Zen-Cart Database', '1', '3.0.2-l10n-jp-7', '', 'v1.3.0.2-l10n-jp-7', now());

DROP TABLE IF EXISTS paypal;
DROP TABLE IF EXISTS paypal_testing;
DROP TABLE IF EXISTS paypal_payment_status;

ALTER TABLE coupons MODIFY coupon_amount decimal(15,4) NOT NULL default '0.0000';
ALTER TABLE coupons MODIFY coupon_minimum_order decimal(15,4) NOT NULL default '0.0000';

UPDATE currencies SET decimal_places = 0 WHERE currencies_id = 3;
UPDATE configuration SET configuration_title='商品名の表示', configuration_description='商品名を表示しますか?<br />\r\n<br />\r\n・0= off<br />\r\n・1桁目：左か右か<br />\r\n・2・3桁目：(他の表示項目との)ソート順<br />\r\n・4桁目：表示後の改行(br)数<br />' WHERE configuration_key='PRODUCT_ALL_LIST_NAME';

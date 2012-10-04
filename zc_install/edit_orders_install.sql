SET @edit4=0;
SELECT (@edit4:=configuration_group_id) as edit4 
FROM configuration_group
WHERE configuration_group_title= 'Edit Orders';
DELETE FROM configuration WHERE configuration_group_id = @edit4;
DELETE FROM configuration_group WHERE configuration_group_id = @edit4;

INSERT INTO configuration_group VALUES ('', 'Edit Orders', 'Settings for Edit Orders features', '100', '1');
UPDATE configuration_group SET sort_order = last_insert_id() WHERE configuration_group_id = last_insert_id();
SET @edit4=0;
SELECT (@edit4:=configuration_group_id) as edit4 
FROM configuration_group
WHERE configuration_group_title= 'Edit Orders';

INSERT INTO configuration VALUES (NULL, 'Super Orders Module Switch', 'SO_SWITCH', 'False', 'If you have the Super Orders module installed, set this option to TRUE so that Super Orders will work with Edit Orders', @edit4, 180, now(), now(), NULL, "zen_cfg_select_option(array('True', 'False'),");
SET @edit4=0;
SELECT (@edit4:=configuration_group_id) as edit4 
FROM configuration_group
WHERE configuration_group_title= 'Edit Orders';
DELETE FROM configuration WHERE configuration_group_id = @edit4;
DELETE FROM configuration_group WHERE configuration_group_id = @edit4;
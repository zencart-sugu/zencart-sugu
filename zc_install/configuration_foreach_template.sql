DROP TABLE IF EXISTS configuration_foreach_template;                                                              
CREATE TABLE configuration_foreach_template (
   configuration_id int(11) NOT NULL auto_increment,
   configuration_title text NOT NULL,
   configuration_key varchar(255) NOT NULL default '',
   configuration_value text NOT NULL,
   configuration_description text NOT NULL,
   configuration_group_id int(11) NOT NULL default '0',
   template_dir varchar(64) NOT NULL,
   sort_order int(5) default NULL,
   last_modified datetime default NULL,
   date_added datetime NOT NULL default '0001-01-01 00:00:00',
   use_function text default NULL,
   set_function text default NULL,
   PRIMARY KEY  (configuration_id),
   UNIQUE KEY unq_config_key_zen (template_dir, configuration_key),
          KEY idx_key_value_zen (configuration_key,configuration_value(10)),
          KEY idx_cfg_grp_id_zen (configuration_group_id)
 ) TYPE=MyISAM; 

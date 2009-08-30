# The following commands are used to upgrade the Zen Cart v1.1.2 database structure to v1.1.3 format.
#
# $Id: mysql_upgrade_zencart_112_to_113.sql 276 2004-09-10 22:35:28Z wilt $
#

UPDATE configuration SET configuration_value='0' where configuration_key='ORDER_WEIGHT_ZERO_STATUS';

## END OF UPDATE
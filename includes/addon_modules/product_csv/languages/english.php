<?php
define('BOX_ADDON_MODULES_CSV_FORMAT', '����CSV�����');
define('BOX_ADDON_MODULES_PRODUCT_CSV', 'CSV�ˤ�������');

define('MODULE_PRODUCT_CSV_TITLE', 'CSV�ˤ�뾦�ʰ����Ͽ');
define('MODULE_PRODUCT_CSV_DESCRIPTION', '����CSV�ι���������Ƥ�����Ǥ���褦�ˤ������η����Ǿ��ʾ��������Ͽ�������Ǥ���褦�ˤ��ޤ�');
define('MODULE_PRODUCT_CSV_STATUS_TITLE', 'CSV�ˤ�뾦�ʰ����Ͽ��ͭ����');
define('MODULE_PRODUCT_CSV_STATUS_DESCRIPTION', 'CSV�ˤ�뾦�ʰ����Ͽ��ͭ���ˤ��ޤ����� <br />true: ͭ��<br />false: ̵��');
define('MODULE_PRODUCT_CSV_SORT_ORDER_TITLE', 'ͥ���');
define('MODULE_PRODUCT_CSV_SORT_ORDER_DESCRIPTION', '�⥸�塼���ͥ��������Ǥ��ޤ����������������ۤ���˥⥸�塼����ɤ߹��ߤȽ������¹Ԥ���ޤ���Ⱦ�ѿ�����¾�Υ⥸�塼��ȽŤʤ�ʤ��褦�����ꤷ�Ƥ���������');

define('MODULE_PRODUCT_CSV_FORMAT_TYPES_1', '���ʥޥ���');
define('MODULE_PRODUCT_CSV_FORMAT_TYPES_2', '���ʥ��ƥ��꡼');
define('MODULE_PRODUCT_CSV_FORMAT_TYPES_3', '���ʥ��ץ����');

define('PRODUCT_CSV_RETURN_TEXT', '���');

$GLOBALS['MODULE_PRODUCT_CSV_COLUMNS'] = array(
  array('type_id'=>'1',
	'column_id'=>'1001',
	'name'=>'���ʥ�����',
	'validate'=>'validateProductTypeExists',
	'dbtable'=>'product_types',
	'dbcolumn'=>'type_handler'),
  array('type_id'=>'1',
	'column_id'=>'1002',
	'name'=>'�߸˿�',
	'validate'=>'validateIsSignedFloat',
	'dbtable'=>'products',
	'dbcolumn'=>'products_quantity'),
  array('type_id'=>'1',
	'column_id'=>'1003',
	'name'=>'����',
	'validate'=>'validateIsString',
	'dbtable'=>'products',
	'dbcolumn'=>'products_model'),
  array('type_id'=>'1',
	'column_id'=>'1004',
	'name'=>'���ʲ���̾',
	'validate'=>'validateIsPathString',
	'dbtable'=>'products',
	'dbcolumn'=>'products_image'),
  array('type_id'=>'1',
	'column_id'=>'1005',
	'name'=>'����',
	'validate'=>'validateIsFloat',
	'dbtable'=>'products',
	'dbcolumn'=>'products_price'),
  array('type_id'=>'1',
	'column_id'=>'1006',
	'name'=>'�������ץե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'products_virtual'),
  array('type_id'=>'1',
	'column_id'=>'1007',
	'name'=>'��Ͽ��',
	'validate'=>'validateIsDatetimeLong',
	'dbtable'=>'products',
	'dbcolumn'=>'products_date_added'),
  array('type_id'=>'1',
	'column_id'=>'1008',
	'name'=>'ȯ����',
	'validate'=>'validateIsDatetimeLong',
	'dbtable'=>'products',
	'dbcolumn'=>'products_date_available'),
  array('type_id'=>'1',
	'column_id'=>'1009',
	'name'=>'����(Kg)',
	'validate'=>'validateIsFloat',
	'dbtable'=>'products',
	'dbcolumn'=>'products_weight'),
  array('type_id'=>'1',
	'column_id'=>'1010',
	'name'=>'ɽ����ɽ���ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'products_status'),
  array('type_id'=>'1',
	'column_id'=>'1011',
	'name'=>'�Ǽ���',
	'validate'=>'validateTaxClassExists',
	'dbtable'=>'tax_class',
	'dbcolumn'=>'tax_class_title'),
  array('type_id'=>'1',
	'column_id'=>'1012',
	'name'=>'�᡼����',
	'validate'=>'validateIsString',
	'dbtable'=>'manufacturers',
	'dbcolumn'=>'manufacturers_name'),
  array('type_id'=>'1',
	'column_id'=>'1013',
	'name'=>'���ʴ���ʸ��',
	'validate'=>'validateIsInt',
	'dbtable'=>'products',
	'dbcolumn'=>'products_ordered'),
  array('type_id'=>'1',
	'column_id'=>'1014',
	'name'=>'������ǽ�Ǿ��Ŀ�',
	'validate'=>'validateIsInt',
	'dbtable'=>'products',
	'dbcolumn'=>'products_quantity_order_min'),
  array('type_id'=>'1',
	'column_id'=>'1015',
	'name'=>'������ǽ����Ŀ�',
	'validate'=>'validateIsInt',
	'dbtable'=>'products',
	'dbcolumn'=>'products_quantity_order_max'),
  array('type_id'=>'1',
	'column_id'=>'1016',
	'name'=>'�����Ŀ�ñ��',
	'validate'=>'validateIsInt',
	'dbtable'=>'products',
	'dbcolumn'=>'products_quantity_order_units'),
  array('type_id'=>'1',
	'column_id'=>'1017',
	'name'=>'̵�����ʥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'product_is_free'),
  array('type_id'=>'1',
	'column_id'=>'1018',
	'name'=>'���䤤��碌���ʥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'product_is_call'),
  array('type_id'=>'1',
	'column_id'=>'1019',
	'name'=>'���ץ������ʤ�ޤ�ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'products_priced_by_attribute'),
  array('type_id'=>'1',
	'column_id'=>'1020',
	'name'=>'�Ǿ����� ñ��MIX�ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'products_quantity_mixed'),
  array('type_id'=>'1',
	'column_id'=>'1021',
	'name'=>'̵�������ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'product_is_always_free_shipping'),
  array('type_id'=>'1',
	'column_id'=>'1022',
	'name'=>'����������ɽ���ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products',
	'dbcolumn'=>'products_qty_box_status'),
  array('type_id'=>'1',
	'column_id'=>'1023',
	'name'=>'�¤ӽ�',
	'validate'=>'validateIsSignedInt',
	'dbtable'=>'products',
	'dbcolumn'=>'products_sort_order'),
  array('type_id'=>'1',
	'column_id'=>'1100',
	'name'=>'����̾(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'products_description',
	'dbcolumn'=>'products_name'),
  array('type_id'=>'1',
	'column_id'=>'1200',
	'name'=>'��������(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsStringWithReturn',
	'dbtable'=>'products_description',
	'dbcolumn'=>'products_description'),
  array('type_id'=>'1',
	'column_id'=>'1300',
	'name'=>'����URL(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsUrlString',
	'dbtable'=>'products_description',
	'dbcolumn'=>'products_url'),
  array('type_id'=>'1',
	'column_id'=>'1400',
	'name'=>'�����ȥ�(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'meta_tags_products_description',
	'dbcolumn'=>'metatags_title'),
  array('type_id'=>'1',
	'column_id'=>'1500',
	'name'=>'META�������(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'meta_tags_products_description',
	'dbcolumn'=>'metatags_keywords'),
  array('type_id'=>'1',
	'column_id'=>'1600',
	'name'=>'META�ǥ�����ץ����(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsStringWithReturn',
	'dbtable'=>'meta_tags_products_description',
	'dbcolumn'=>'metatags_description'),
  array('type_id'=>'1',
	'column_id'=>'1700',
	'name'=>'�������ᳫ����',
	'validate'=>'validateIsDatetimeShort',
	'dbtable'=>'featured',
	'dbcolumn'=>'featured_date_available'),
  array('type_id'=>'1',
	'column_id'=>'1701',
	'name'=>'�������Ὢλ��',
	'validate'=>'validateIsDatetimeShort',
	'dbtable'=>'featured',
	'dbcolumn'=>'expires_date'),
  array('type_id'=>'1',
	'column_id'=>'1702',
	'name'=>'�ò�����',
	'validate'=>'validateIsFloat',
	'dbtable'=>'specials',
	'dbcolumn'=>'specials_new_products_price'),
  array('type_id'=>'1',
	'column_id'=>'1703',
	'name'=>'�ò����ʳ�����',
	'validate'=>'validateIsDatetimeShort',
	'dbtable'=>'specials',
	'dbcolumn'=>'specials_date_available'),
  array('type_id'=>'1',
	'column_id'=>'1704',
	'name'=>'�ò����ʽ�λ��',
	'validate'=>'validateIsDatetimeShort',
	'dbtable'=>'specials',
	'dbcolumn'=>'expires_date'),
  array('type_id'=>'1',
	'column_id'=>'1706',
	'name'=>'���ʺ���ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_DELETE),
  array('type_id'=>'1',
	'column_id'=>'1707',
	'name'=>'̵��',
	'validate'=>'',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_IGNORE),

  array('type_id'=>'2',
	'column_id'=>'2000',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����1:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2050',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����2:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2100',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����3:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2150',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����4:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2200',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����5:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2250',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����6:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2300',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����7:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2350',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����8:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2400',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����9:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2450',
	'name'=>'���ƥ��꡼̾(LANGUAGE_NAME)-����10:LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_name'),
  array('type_id'=>'2',
	'column_id'=>'2500',
	'name'=>'���ƥ��꡼����(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsStringWithReturn',
	'dbtable'=>'categories_description',
	'dbcolumn'=>'categories_description'),
  array('type_id'=>'2',
	'column_id'=>'2600',
	'name'=>'���ƥ��꡼�����ե�����̾',
	'validate'=>'validateIsPathString',
	'dbtable'=>'categories',
	'dbcolumn'=>'categories_image'),
  array('type_id'=>'2',
	'column_id'=>'2601',
	'name'=>'���ƥ��꡼�¤ӽ�',
	'validate'=>'validateIsSignedInt',
	'dbtable'=>'categories',
	'dbcolumn'=>'sort_order'),
  array('type_id'=>'2',
	'column_id'=>'2602',
	'name'=>'���ƥ��꡼ͭ��̵���ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'categories',
	'dbcolumn'=>'categories_status'),
  array('type_id'=>'2',
	'column_id'=>'2603',
	'name'=>'����',
	'validate'=>'validateIsString',
	'dbtable'=>'products',
	'dbcolumn'=>'products_model'),
  array('type_id'=>'2',
	'column_id'=>'2650',
	'name'=>'�����ȥ�(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'meta_tags_categories_description',
	'dbcolumn'=>'metatags_title'),
  array('type_id'=>'2',
	'column_id'=>'2700',
	'name'=>'META�������(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'meta_tags_categories_description',
	'dbcolumn'=>'metatags_keywords'),
  array('type_id'=>'2',
	'column_id'=>'2750',
	'name'=>'META�ǥ�����ץ����(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsStringWithReturn',
	'dbtable'=>'meta_tags_categories_description',
	'dbcolumn'=>'metatags_description'),
  array('type_id'=>'2',
	'column_id'=>'2800',
	'name'=>'���ƥ��꡼ɳ�դ�����ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_DELETE),
  array('type_id'=>'2',
	'column_id'=>'2801',
	'name'=>'̵��',
	'validate'=>'',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_IGNORE),

  array('type_id'=>'3',
	'column_id'=>'3000',
	'name'=>'���ץ����̾(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsNotReservedOptionName',
	'dbtable'=>'products_options',
	'dbcolumn'=>'products_options_name'),
  array('type_id'=>'3',
	'column_id'=>'3050',
	'name'=>'���ץ������(LANGUAGE_NAME):LANGUAGE_ID',
	'validate'=>'validateIsString',
	'dbtable'=>'products_options_values',
	'dbcolumn'=>'products_options_values_name'),
  array('type_id'=>'3',
	'column_id'=>'3100',
	'name'=>'����',
	'validate'=>'validateIsString',
	'dbtable'=>'products',
	'dbcolumn'=>'products_model'),
  array('type_id'=>'3',
	'column_id'=>'3101',
	'name'=>'����',
	'validate'=>'validateIsFloat',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'options_values_price'),
  array('type_id'=>'3',
	'column_id'=>'3102',
	'name'=>'��������',
	'validate'=>'validateIsPlusMinus',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'price_prefix'),
  array('type_id'=>'3',
	'column_id'=>'3103',
	'name'=>'�¤ӽ�',
	'validate'=>'validateIsSignedInt',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'products_options_sort_order'),
  array('type_id'=>'3',
	'column_id'=>'3104',
	'name'=>'̵���ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'product_attribute_is_free'),
  array('type_id'=>'3',
	'column_id'=>'3105',
	'name'=>'����',
	'validate'=>'validateIsFloat',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'products_attributes_weight'),
  array('type_id'=>'3',
	'column_id'=>'3106',
	'name'=>'��������',
	'validate'=>'validateIsPlusMinus',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'products_attributes_weight_prefix'),
  array('type_id'=>'3',
	'column_id'=>'3107',
	'name'=>'ɽ���Τߥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_display_only'),
  array('type_id'=>'3',
	'column_id'=>'3108',
	'name'=>'�ǥե���ȥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_default'),
  array('type_id'=>'3',
	'column_id'=>'3109',
	'name'=>'���ʳ��Ŭ�ѥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_discounted'),
  array('type_id'=>'3',
	'column_id'=>'3110',
	'name'=>'���ץ������ʹ绻�ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_price_base_included'),
  array('type_id'=>'3',
	'column_id'=>'3111',
	'name'=>'�����ե�����̾',
	'validate'=>'validateIsPathString',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_image'),
  array('type_id'=>'3',
	'column_id'=>'3112',
	'name'=>'ɬ�ܥե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'products_attributes',
	'dbcolumn'=>'attributes_required'),
  array('type_id'=>'3',
	'column_id'=>'3113',
	'name'=>'���ץ����ɳ�դ�����ե饰',
	'validate'=>'validateIsZeroOne',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_DELETE),
  array('type_id'=>'3',
	'column_id'=>'3114',
	'name'=>'̵��',
	'validate'=>'',
	'dbtable'=>'',
	'dbcolumn'=>MODULE_PRODUCT_CSV_FORMAT_COLUMN_IGNORE)
);
define('MODULE_PRODUCT_CSV_FORMAT_PRODUCT_ALL', '���ʥޥ���(����)');
define('MODULE_PRODUCT_CSV_FORMAT_CATEGORY_ALL', '���ʥ��ƥ��꡼(����)');
define('MODULE_PRODUCT_CSV_FORMAT_OPTION_ALL', '���ʥ��ץ����(����)');
?>
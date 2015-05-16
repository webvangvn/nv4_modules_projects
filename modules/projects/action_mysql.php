<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate 2-10-2010 20:59
 */

if( ! defined( 'NV_IS_FILE_MODULES' ) ) die( 'Stop!!!' );
$sql_drop_module = array();

global $op, $db;

$result = $db->query( "SHOW TABLE STATUS LIKE '" . $db_config['prefix'] . "\_" . $module_data . "\_money\_%'" );
$num_table = intval( $result->rowCount() );
$array_lang_module_setup = array();
$set_lang_data = '';
if( $num_table > 0 )
{
	while( $item = $result->fetch() )
	{
		$array_lang_module_setup[] = str_replace( $db_config['prefix'] . "_" . $module_data . "_money_", "", $item['name'] );
	}
	if( $lang != $global_config['site_lang'] and in_array( $global_config['site_lang'], $array_lang_module_setup ) )
	{
		$set_lang_data = $global_config['site_lang'];
	}
	else
	{
		foreach( $array_lang_module_setup as $lang_i )
		{
			if( $lang != $lang_i )
			{
				$set_lang_data = $lang_i;
				break;
			}
		}
	}
}

$result = $db->query( "SHOW TABLE STATUS LIKE '" . $db_config['prefix'] . "\_" . $lang . "\_comments'" );
$rows = $result->fetchAll();
if( sizeof( $rows ) )
{
	$sql_drop_module[] = "DELETE FROM " . $db_config['prefix'] . "_" . $lang . "_comments WHERE module='" . $module_name . "'";
}

if( in_array( $lang, $array_lang_module_setup ) and $num_table > 1 )
{
	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_rows
	 DROP ' . $lang . '_title,
	 DROP ' . $lang . '_alias,
	 DROP ' . $lang . '_hometext,
	 DROP ' . $lang . '_bodytext,
	 DROP ' . $lang . '_warranty,
	 DROP ' . $lang . '_promotional';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_catalogs
	 DROP ' . $lang . '_title,
	 DROP ' . $lang . '_alias,
	 DROP ' . $lang . '_description,
	 DROP ' . $lang . '_keywords';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_group
	 DROP ' . $lang . '_title,
	 DROP ' . $lang . '_alias,
	 DROP ' . $lang . '_description,
	 DROP ' . $lang . '_keywords';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_block_cat
	 DROP ' . $lang . '_title,
	 DROP ' . $lang . '_alias,
	 DROP ' . $lang . '_description,
	 DROP ' . $lang . '_keywords';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_units
	 DROP ' . $lang . '_title,
	 DROP ' . $lang . '_note';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_tags
	 DROP ' . $lang . '_numpro,
	 DROP ' . $lang . '_alias,
	 DROP ' . $lang . '_image,
	 DROP ' . $lang . '_description,
	 DROP ' . $lang . '_keywords';

	$sql_drop_module[] = 'ALTER TABLE ' . $db_config['prefix'] . '_' . $module_data . '_tags_id DROP ' . $lang . '_keyword';
}
elseif( $op != 'setup' )
{
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_block';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_field';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_template';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_info';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_block_cat';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_catalogs';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_group';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_group_cateid';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_group_items';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_group_quantity';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_group_quantity_logs';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_warehouse';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_warehouse_logs';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_warehouse_logs_group';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_orders';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_orders_id';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_orders_id_group';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_orders_shipping';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_payment';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_transaction';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_rows';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_review';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_units';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_discounts';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_tags';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_tags_id';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_coupons';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_coupons_product';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_coupons_history';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_point';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_point_queue';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_point_history';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_location';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_config';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_config_items';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_config_location';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_config_weight';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_location';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_carrier_weight';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_shops';
	$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_shops_carrier';
	$set_lang_data = '';
}

$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_money_' . $lang;
$sql_drop_module[] = 'DROP TABLE IF EXISTS ' . $db_config['prefix'] . '_' . $module_data . '_weight_' . $lang;

$sql_create_module = $sql_drop_module;

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_catalogs (
 catid mediumint(8) unsigned NOT NULL auto_increment,
 parentid mediumint(8) unsigned NOT NULL default '0',
 image varchar(255) NOT NULL default '',
 weight smallint(4) unsigned NOT NULL default '0',
 sort mediumint(8) NOT NULL default '0',
 lev smallint(4) NOT NULL default '0',
 viewcat varchar(50) NOT NULL default 'viewcat_page_new',
 numsubcat int(11) NOT NULL default '0',
 subcatid varchar(255) NOT NULL default '',
 inhome tinyint(1) unsigned NOT NULL default '0',
 numlinks tinyint(2) unsigned NOT NULL default '3',
 newday tinyint(4) NOT NULL DEFAULT '3',
 typeprice tinyint(4) NOT NULL DEFAULT '2',
 form varchar(50) NOT NULL DEFAULT '',
 group_price text NOT NULL DEFAULT '',
 admins mediumtext NOT NULL,
 add_time int(11) unsigned NOT NULL default '0',
 edit_time int(11) unsigned NOT NULL default '0',
 groups_view varchar(255) NOT NULL default '',
 cat_allow_point tinyint(1) NOT NULL default '0',
 cat_number_point tinyint(4) NOT NULL default '0',
 cat_number_product tinyint(4) NOT NULL default '0',
 PRIMARY KEY (catid),
 KEY parentid (parentid)
) ENGINE=MyISAM";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_catalogs ADD " . $lang . "_title VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_catalogs ADD " . $lang . "_alias VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_catalogs ADD " . $lang . "_description VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_catalogs ADD " . $lang . "_keywords text NOT NULL";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_template (
  id mediumint(8) NOT NULL AUTO_INCREMENT,
  status tinyint(1) NOT NULL DEFAULT '1',
  title varchar(255) NOT NULL default '',
  alias varchar(255) NOT NULL default '',
  PRIMARY KEY (id) ,
  UNIQUE KEY alias (alias)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_info (
  id mediumint(8) NOT NULL AUTO_INCREMENT,
  shopid mediumint(8) unsigned NOT NULL default '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_field (
  fid mediumint(8) NOT NULL AUTO_INCREMENT,
  field varchar(25) NOT NULL,
  listtemplate varchar(25) NOT NULL,
  weight int(10) unsigned NOT NULL DEFAULT '1',
  field_type enum('number','date','textbox','textarea','editor','select','radio','checkbox','multiselect') NOT NULL DEFAULT 'textbox',
  field_choices text NOT NULL,
  sql_choices text NOT NULL,
  match_type enum('none','alphanumeric','email','url','regex','callback') NOT NULL DEFAULT 'none',
  match_regex varchar(250) NOT NULL DEFAULT '',
  func_callback varchar(75) NOT NULL DEFAULT '',
  min_length int(11) NOT NULL DEFAULT '0',
  max_length bigint(20) unsigned NOT NULL DEFAULT '0',
  class varchar(25) NOT NULL DEFAULT '',
  language text NOT NULL,
  default_value varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (fid),
  UNIQUE KEY field (field)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_group (
 groupid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 parentid mediumint(8) unsigned NOT NULL DEFAULT '0',
 image varchar(255) NOT NULL DEFAULT '',
 weight smallint(4) unsigned NOT NULL DEFAULT '0',
 sort mediumint(8) NOT NULL DEFAULT '0',
 lev smallint(4) NOT NULL DEFAULT '0',
 viewgroup varchar(50) NOT NULL DEFAULT 'viewcat_page_new',
 numsubgroup int(11) NOT NULL DEFAULT '0',
 subgroupid varchar(255) NOT NULL DEFAULT '',
 inhome tinyint(1) unsigned NOT NULL DEFAULT '0',
 indetail tinyint(1) unsigned NOT NULL DEFAULT '0',
 add_time int(11) unsigned NOT NULL DEFAULT '0',
 edit_time int(11) unsigned NOT NULL DEFAULT '0',
 numpro int(11) unsigned NOT NULL DEFAULT '0',
 in_order tinyint(2) NOT NULL DEFAULT '0',
 is_require tinyint(1) NOT NULL DEFAULT '0',
 PRIMARY KEY (groupid),
 KEY parentid (parentid)
) ENGINE=MyISAM ";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_group ADD " . $lang . "_title VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_group ADD " . $lang . "_alias VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_group ADD " . $lang . "_description VARCHAR( 255 ) NOT NULL DEFAULT ''";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_group ADD " . $lang . "_keywords text NOT NULL";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_group_cateid (
  groupid mediumint(8) unsigned NOT NULL,
  cateid mediumint(8) unsigned NOT NULL,
  UNIQUE KEY groupid (groupid, cateid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_group_items (
  pro_id int(11) unsigned NOT NULL default '0',
  group_id int(11) unsigned NOT NULL default '0',
  PRIMARY KEY (pro_id, group_id),
  KEY pro_id (pro_id),
  KEY group_id (group_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_group_quantity (
  pro_id int(11) unsigned NOT NULL default '0',
  listgroup varchar(255) NOT NULL,
  quantity int(11) unsigned NOT NULL,
  UNIQUE KEY pro_id (pro_id,listgroup)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouse (
  wid int(11) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  note TEXT NOT NULL,
  user_id mediumint(8) NOT NULL DEFAULT '0',
  addtime int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (wid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouse_logs (
  logid int(11) unsigned NOT NULL AUTO_INCREMENT,
  wid int(11) unsigned NOT NULL default '0',
  pro_id int(11) unsigned NOT NULL default '0',
  quantity INT(11) UNSIGNED NOT NULL DEFAULT '0',
  price float NOT NULL DEFAULT '0',
  money_unit char(3) NOT NULL,
  PRIMARY KEY (logid),
  KEY wid (wid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_warehouse_logs_group (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  logid int(11) unsigned NOT NULL default '0',
  listgroup varchar(255)NOT NULL,
  quantity INT(11) UNSIGNED NOT NULL DEFAULT '0',
  price float NOT NULL DEFAULT '0',
  money_unit char(3) NOT NULL,
  PRIMARY KEY (id),
  KEY logid (logid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_rows (
 id int(11) unsigned NOT NULL AUTO_INCREMENT,
 listcatid int(11) NOT NULL DEFAULT '0',
 user_id mediumint(8) NOT NULL DEFAULT '0',
 addtime int(11) unsigned NOT NULL DEFAULT '0',
 edittime int(11) unsigned NOT NULL DEFAULT '0',
 status tinyint(4) NOT NULL DEFAULT '1',
 publtime int(11) unsigned NOT NULL DEFAULT '0',
 exptime int(11) unsigned NOT NULL DEFAULT '0',
 archive tinyint(1) unsigned NOT NULL DEFAULT '0',
 product_code varchar(255) NOT NULL DEFAULT '',
 product_number int(11) NOT NULL DEFAULT '0',
 product_price float NOT NULL DEFAULT '0',
 price_config text NOT NULL DEFAULT '',
 money_unit char(3) NOT NULL,
 product_unit int(11) NOT NULL,
 product_weight float NOT NULL DEFAULT '0',
 weight_unit char(20) NOT NULL DEFAULT '',
 discount_id smallint(6) NOT NULL DEFAULT '0',
 homeimgfile varchar(255) NOT NULL DEFAULT '',
 detailintro varchar(255) NOT NULL DEFAULT '',
 homeimgthumb tinyint(4) NOT NULL DEFAULT '0',
 homeimgalt varchar(255) NOT NULL,
 otherimage text NOT NULL,
 imgposition tinyint(1) NOT NULL DEFAULT '1',
 copyright tinyint(1) unsigned NOT NULL DEFAULT '0',
 inhome tinyint(1) unsigned NOT NULL DEFAULT '0',
 allowed_comm tinyint(1) unsigned NOT NULL DEFAULT '0',
 allowed_rating tinyint(1) unsigned NOT NULL DEFAULT '0',
 ratingdetail varchar(255) NOT NULL DEFAULT '',
 allowed_send tinyint(1) unsigned NOT NULL DEFAULT '0',
 allowed_print tinyint(1) unsigned NOT NULL DEFAULT '0',
 allowed_save tinyint(1) unsigned NOT NULL DEFAULT '0',
 hitstotal mediumint(8) unsigned NOT NULL DEFAULT '0',
 hitscm mediumint(8) unsigned NOT NULL DEFAULT '0',
 hitslm mediumint(8) unsigned NOT NULL DEFAULT '0',
 num_sell mediumint(8) NOT NULL DEFAULT '0',
 showprice tinyint(2) NOT NULL DEFAULT '0',
 PRIMARY KEY (id),
 KEY listcatid (listcatid),
 KEY user_id (user_id),
 KEY publtime (publtime),
 KEY exptime (exptime)
) ENGINE=MyISAM";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_rows ADD " . $lang . "_title VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_alias VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_hometext text NOT NULL,
 ADD " . $lang . "_bodytext mediumtext NOT NULL,
 ADD " . $lang . "_warranty text NOT NULL,
 ADD " . $lang . "_promotional text NOT NULL,
 ADD " . $lang . "_address text NOT NULL";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_review (
  review_id int(11) unsigned NOT NULL AUTO_INCREMENT,
  product_id int(11) NOT NULL DEFAULT '0',
  userid int(11) NOT NULL DEFAULT '0',
  sender varchar(255) NOT NULL,
  content text NOT NULL,
  rating int(1) NOT NULL,
  add_time int(11) NOT NULL DEFAULT '0',
  edit_time int(11) NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (review_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_block_cat (
 bid mediumint(8) unsigned NOT NULL auto_increment,
 adddefault tinyint(4) NOT NULL default '0',
 image varchar(255) NOT NULL,
 weight smallint(4) NOT NULL default '0',
 add_time int(11) NOT NULL default '0',
 edit_time int(11) NOT NULL default '0',
 PRIMARY KEY (bid)
) ENGINE=MyISAM";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_block_cat ADD " . $lang . "_title VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_alias VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_description VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_keywords text NOT NULL";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_block (
 bid int(11) unsigned NOT NULL,
 id int(11) unsigned NOT NULL,
 weight int(11) unsigned NOT NULL,
 UNIQUE KEY bid (bid,id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_units (
 id int(11) NOT NULL auto_increment,
 PRIMARY KEY (id)
) ENGINE=MyISAM";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_units ADD " . $lang . "_title VARCHAR( 255 ) NOT NULL DEFAULT '',
 ADD " . $lang . "_note text NOT NULL ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_orders (
 order_id int(11) unsigned NOT NULL auto_increment,
 order_code varchar(30) NOT NULL default '',
 lang char(2) NOT NULL default 'en',
 order_name varchar(255) NOT NULL,
 order_email varchar(255) NOT NULL,
 order_phone varchar(20) NOT NULL,
 order_note text NOT NULL,
 user_id int(11) unsigned NOT NULL default '0',
 admin_id int(11) unsigned NOT NULL default '0',
 shop_id int(11) unsigned NOT NULL default '0',
 who_is int(2) unsigned NOT NULL default '0',
 unit_total char(3) NOT NULL,
 order_total double unsigned NOT NULL default '0',
 order_time int(11) unsigned NOT NULL default '0',
 edit_time int(11) unsigned NOT NULL default '0',
 postip varchar(100) NOT NULL,
 order_view tinyint(2) NOT NULL DEFAULT '0',
 transaction_status tinyint(4) NOT NULL,
 transaction_id int(11) NOT NULL default '0',
 transaction_count int(11) NOT NULL,
 PRIMARY KEY (order_id),
 UNIQUE KEY order_code (order_code),
 KEY user_id (user_id),
 KEY order_time (order_time),
 KEY shop_id (shop_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_orders_id (
 id int(11) unsigned NOT NULL AUTO_INCREMENT,
 order_id int(11) NOT NULL,
 proid mediumint(9) NOT NULL,
 num mediumint(9) NOT NULL,
 price int(11) NOT NULL,
 discount_id smallint(6) NOT NULL DEFAULT '0',
 UNIQUE KEY orderid (order_id, id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_orders_id_group (
 order_i int(11) NOT NULL,
 group_id mediumint(8) NOT NULL,
 UNIQUE KEY orderid (order_i, group_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_orders_shipping (
  id tinyint(11) unsigned NOT NULL AUTO_INCREMENT,
  order_id tinyint(11) unsigned NOT NULL,
  ship_name varchar(255) NOT NULL,
  ship_phone varchar(25) NOT NULL,
  ship_location_id mediumint(8) unsigned NOT NULL,
  ship_address_extend varchar(255) NOT NULL,
  ship_shops_id tinyint(3) unsigned NOT NULL,
  ship_carrier_id tinyint(3) unsigned NOT NULL,
  weight float NOT NULL DEFAULT '0',
  weight_unit char(20) NOT NULL DEFAULT '',
  ship_price float NOT NULL DEFAULT '0',
  ship_price_unit char(3) NOT NULL DEFAULT '',
  add_time int(11) unsigned NOT NULL,
  edit_time int(11) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY add_time (add_time)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_transaction (
 transaction_id int(11) NOT NULL AUTO_INCREMENT,
 transaction_time int(11) NOT NULL DEFAULT '0',
 transaction_status int(11) NOT NULL,
 order_id int(11) NOT NULL DEFAULT '0',
 userid int(11) NOT NULL DEFAULT '0',
 payment varchar(100) NOT NULL DEFAULT '0',
 payment_id varchar(22) NOT NULL DEFAULT '0',
 payment_time int(11) NOT NULL DEFAULT '0',
 payment_amount float NOT NULL DEFAULT '0',
 payment_data text NOT NULL,
 PRIMARY KEY (transaction_id),
 KEY order_id (order_id),
 KEY payment_id (payment_id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_money_" . $lang . " (
 id mediumint(11) NOT NULL,
 code char(3) NOT NULL,
 currency varchar(255) NOT NULL,
 exchange float NOT NULL default '0',
 round varchar(10) NOT NULL,
 number_format varchar(5) NOT NULL DEFAULT ',||.',
 PRIMARY KEY (id),
 UNIQUE KEY code (code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $lang . " (
 id tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
 code char(20) NOT NULL,
 title varchar(50) NOT NULL,
 exchange float NOT NULL default '0',
 round varchar(10) NOT NULL,
 PRIMARY KEY (id),
 UNIQUE KEY code (code)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_payment (
 payment varchar(100) NOT NULL,
 paymentname varchar(255) NOT NULL,
 domain varchar(255) NOT NULL,
 active tinyint(4) NOT NULL default '0',
 weight int(11) NOT NULL default '0',
 config text NOT NULL,
 images_button varchar(255) NOT NULL,
 PRIMARY KEY (payment)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_discounts (
  did smallint(6) NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL DEFAULT '',
  weight smallint(6) NOT NULL DEFAULT '0',
  add_time int(11) unsigned NOT NULL DEFAULT '0',
  edit_time int(11) unsigned NOT NULL DEFAULT '0',
  begin_time int(11) unsigned NOT NULL DEFAULT '0',
  end_time int(11) unsigned NOT NULL DEFAULT '0',
  config text NOT NULL,
  detail tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (did),
  KEY begin_time (begin_time,end_time)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_wishlist (
  wid smallint(6) NOT NULL AUTO_INCREMENT,
  user_id int(11) unsigned NOT NULL default '0',
  listid text DEFAULT '',
  PRIMARY KEY (wid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_tags (
	 tid mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
	 PRIMARY KEY (tid)
	) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_tags_id (
	 id int(11) NOT NULL,
	 tid mediumint(9) NOT NULL,
	 UNIQUE KEY sid (id,tid)
	) ENGINE=MyISAM";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_tags ADD " . $lang . "_numpro mediumint(8) NOT NULL DEFAULT '0',
 ADD " . $lang . "_alias varchar(255) NOT NULL DEFAULT '',
 ADD " . $lang . "_image varchar(255) DEFAULT '',
 ADD " . $lang . "_description text,
 ADD " . $lang . "_keywords varchar(255) DEFAULT '',
 ADD UNIQUE(" . $lang . "_alias)";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_tags_id ADD " . $lang . "_keyword varchar(65) NOT NULL";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_coupons (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(100) NOT NULL DEFAULT '',
  code varchar(50) NOT NULL DEFAULT '',
  type varchar(1) NOT NULL DEFAULT 'p',
  discount float NOT NULL DEFAULT '0',
  total_amount float NOT NULL DEFAULT '0',
  date_start int(11) unsigned NOT NULL DEFAULT '0',
  date_end int(11) unsigned NOT NULL DEFAULT '0',
  uses_per_coupon int(11) unsigned NOT NULL DEFAULT '0',
  uses_per_coupon_count int(11) NOT NULL DEFAULT '0',
  date_added int(11) unsigned NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_coupons_history (
  id int(11) NOT NULL AUTO_INCREMENT,
  cid int(11) NOT NULL,
  order_id int(11) NOT NULL,
  amount float NOT NULL DEFAULT '0',
  date_added int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_coupons_product (
  cid int(11) unsigned NOT NULL,
  pid int(11) unsigned NOT NULL,
  UNIQUE KEY cid (cid,pid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_point (
  userid int(11) NOT NULL DEFAULT '0',
  point_total int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (userid)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_point_queue (
  order_id int(11) NOT NULL,
  point mediumint(11) NOT NULL DEFAULT '0',
  status tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_point_history (
  id int(11) NOT NULL AUTO_INCREMENT,
  userid int(11) NOT NULL DEFAULT '0',
  order_id int(11) NOT NULL,
  point int(11) NOT NULL DEFAULT '0',
  time int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (id)
) ENGINE=MyISAM";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_location (
 id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
 parentid mediumint(8) unsigned NOT NULL DEFAULT '0',
 title varchar(255) NOT NULL,
 weight smallint(4) unsigned NOT NULL DEFAULT '0',
 sort mediumint(8) NOT NULL DEFAULT '0',
 lev smallint(4) NOT NULL DEFAULT '0',
 numsub int(11) NOT NULL DEFAULT '0',
 subid varchar(255) NOT NULL DEFAULT '',
 PRIMARY KEY (id),
 KEY parentid (parentid)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_carrier (
  id tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  phone varchar(15) NOT NULL,
  address varchar(255) NOT NULL,
  logo varchar(255) NOT NULL,
  description text NOT NULL,
  weight tinyint(3) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_carrier_config (
  id tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  description text NOT NULL,
  weight tinyint(3) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (id)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_carrier_config_items (
  id smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  cid tinyint(3) unsigned NOT NULL DEFAULT '0',
  title varchar(255) NOT NULL,
  description text NOT NULL,
  weight smallint(4) unsigned NOT NULL,
  add_time int(11) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_carrier_config_location (
  cid tinyint(3) unsigned NOT NULL,
  iid smallint(4) unsigned NOT NULL,
  lid mediumint(8) unsigned NOT NULL,
  UNIQUE KEY cid( cid, lid)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_carrier_config_weight (
  iid smallint(4) unsigned NOT NULL,
  weight float unsigned NOT NULL,
  weight_unit varchar(20) NOT NULL,
  carrier_price float NOT NULL,
  carrier_price_unit char(3) NOT NULL
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_shops (
  id tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  location mediumint(8) unsigned NOT NULL DEFAULT '0',
  address varchar(255) NOT NULL,
  description text NOT NULL,
  weight tinyint(3) unsigned NOT NULL,
  status tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM ";

$sql_create_module[] = "CREATE TABLE IF NOT EXISTS " . $db_config['prefix'] . "_" . $module_data . "_shops_carrier (
  shops_id tinyint(3) unsigned NOT NULL,
  carrier_id tinyint(3) unsigned NOT NULL,
  config_id tinyint(3) unsigned NOT NULL,
  UNIQUE KEY shops_id (shops_id, carrier_id)
) ENGINE=MyISAM ";

$data = array();
$data['image_size'] = '100x100';
$data['home_view'] = 'view_home_all';
$data['per_page'] = 20;
$data['per_row'] = 3;
$data['money_unit'] = 'VND';
$data['weight_unit'] = 'g';
$data['post_auto_member'] = 0;
$data['auto_check_order'] = 1;
$data['format_order_id'] = strtoupper( substr( $module_name, 0, 1 ) ) . '%06s';
$data['format_code_id'] = strtoupper( substr( $module_name, 0, 1 ) ) . '%06s';
$data['facebookappid'] = '';
$data['active_guest_order'] = 0;
$data['active_showhomtext'] = 1;
$data['active_order'] = 1;
$data['active_order_popup'] = 1;
$data['active_order_non_detail'] = 1;
$data['active_guest_order'] = 1;
$data['active_price'] = 1;
$data['active_order_number'] = 0;
$data['order_day'] = 0;
$data['order_nexttime'] = 0;
$data['active_payment'] = 1;
$data['groups_price'] = '3';
$data['active_tooltip'] = 1;
$data['timecheckstatus'] = 0;
$data['show_product_code'] = 1;
$data['show_compare'] = 0;
$data['show_displays'] = 0;
$data['use_shipping'] = 1;
$data['use_coupons'] = 0;
$data['active_wishlist'] = 1;
$data['tags_alias'] = 0;
$data['auto_tags'] = 1;
$data['tags_remind'] = 0;
$data['point_active'] = 0;
$data['point_conversion'] = 0;
$data['point_new_order'] = 0;
$data['review_active'] = 1;
$data['review_check'] = 1;
$data['review_captcha'] = 1;
$data['group_price'] = '';
$data['groups_notify'] = '3';

foreach( $data as $config_name => $config_value )
{
	$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', " . $db->quote( $module_name ) . ", " . $db->quote( $config_name ) . ", " . $db->quote( $config_value ) . ")";
}

if( ! empty( $set_lang_data ) )
{
	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_catalogs" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_catalogs SET " . $lang . "_title = " . $global_config['site_lang'] . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_catalogs SET " . $lang . "_alias = " . $set_lang_data . "_alias";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_catalogs SET " . $lang . "_description = " . $set_lang_data . "_description";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_catalogs SET " . $lang . "_keywords = " . $set_lang_data . "_keywords";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_rows" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_title = " . $set_lang_data . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_alias = " . $set_lang_data . "_alias";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_hometext = " . $set_lang_data . "_hometext";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_bodytext = " . $set_lang_data . "_bodytext";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_warranty = " . $set_lang_data . "_warranty";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_rows SET " . $lang . "_promotional = " . $set_lang_data . "_promotional";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_units" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_units SET " . $lang . "_title = " . $set_lang_data . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_units SET " . $lang . "_note = " . $set_lang_data . "_note";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_block_cat" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_block_cat SET " . $lang . "_title = " . $set_lang_data . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_block_cat SET " . $lang . "_alias = " . $set_lang_data . "_alias";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_block_cat SET " . $lang . "_description = " . $set_lang_data . "_description";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_block_cat SET " . $lang . "_keywords = " . $set_lang_data . "_keywords";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_group" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_group SET " . $lang . "_title = " . $set_lang_data . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_group SET " . $lang . "_alias = " . $set_lang_data . "_alias";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_group SET " . $lang . "_description = " . $set_lang_data . "_description";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_group SET " . $lang . "_keywords = " . $set_lang_data . "_keywords";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_block_cat" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_money_" . $lang . " SELECT * FROM " . $db_config['prefix'] . "_" . $module_data . "_money_" . $set_lang_data;
		$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $lang . " SELECT * FROM " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $set_lang_data;
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_tags" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_tags SET " . $lang . "_alias = " . $set_lang_data . "_title";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_tags SET " . $lang . "_image = " . $set_lang_data . "_alias";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_tags SET " . $lang . "_description = " . $set_lang_data . "_description";
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_tags SET " . $lang . "_keywords = " . $set_lang_data . "_keywords";
	}

	$numrow = $db->query( "SELECT count(*) FROM " . $db_config['prefix'] . "_" . $module_data . "_tags_id" )->fetchColumn();
	if( $numrow )
	{
		$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_tags_id SET " . $lang . "_keyword = " . $set_lang_data . "_keyword";
	}

	$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_money_" . $lang . " SET exchange = '1'";
	$sql_create_module[] = "UPDATE " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $lang . " SET exchange = '1'";
}

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_money_" . $lang . " (id, code, currency, exchange, round, number_format) VALUES (840, 'USD', 'US Dollar', 21000, '0.01', ',||.')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_money_" . $lang . " (id, code, currency, exchange, round, number_format) VALUES (704, 'VND', 'Vietnam Dong', 1, '100', ',||.')";

$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $lang . " (code, title, exchange, round) VALUES ('g', 'Gram', 1, '0.1')";
$sql_create_module[] = "INSERT INTO " . $db_config['prefix'] . "_" . $module_data . "_weight_" . $lang . " (code, title, exchange, round) VALUES ('kg', 'Kilogam', 1000, '0.1')";

$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_catalogs ADD UNIQUE (" . $lang . "_alias)";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_group ADD UNIQUE (" . $lang . "_alias)";
$sql_create_module[] = "ALTER TABLE " . $db_config['prefix'] . "_" . $module_data . "_block_cat ADD UNIQUE (" . $lang . "_alias)";

// Comments
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'auto_postcomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'allowed_comm', '-1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'view_comm', '6')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'setcomm', '4')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'activecomm', '1')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'emailcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'adminscomm', '')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'sortcomm', '0')";
$sql_create_module[] = "INSERT INTO " . NV_CONFIG_GLOBALTABLE . " (lang, module, config_name, config_value) VALUES ('" . $lang . "', '" . $module_name . "', 'captcha', '1')";

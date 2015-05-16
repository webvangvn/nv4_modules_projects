<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Fri, 10 Jan 2014 04:47:14 GMT
 */

if( ! defined( 'NV_ADMIN' ) ) die( 'Stop!!!' );

$sql = "SELECT module, config_name, config_value FROM " . NV_CONFIG_GLOBALTABLE . " WHERE lang='" . NV_LANG_DATA . "' and module='" . $module_name . "'";
$list = nv_db_cache( $sql, '', $module_name );
foreach( $list as $row )
{
	$shop_module_config[$row['config_name']] = $row['config_value'];
}

$submenu['items'] = $lang_module['content_add_items'];
$submenu['content'] = $lang_module['content_add'];
$submenu['cat'] = $lang_module['categories'];
$submenu['tags'] = $lang_module['tags'];
if( defined( 'NV_IS_SPADMIN' ) )
{
	$submenu['template'] = $lang_module['fields'];
}
$submenu['setting'] = $lang_module['setting'];

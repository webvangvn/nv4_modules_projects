<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @copyright 2009
 * @License GNU/GPL version 2 or any later version
 * @Createdate 12/31/2009 0:51
 */

if( ! defined( 'NV_SYSTEM' ) ) die( 'Stop!!!' );

define( 'NV_IS_MOD_SHOPS', true );

require_once NV_ROOTDIR . '/modules/' . $module_file . '/global.functions.php';
require_once NV_ROOTDIR . '/modules/' . $module_file . '/site.functions.php';

$array_wishlist_id = array();
$arr_cat_title = array();
$catid = 0;
$parentid = 0;
$set_viewcat = '';
$alias_cat_url = isset( $array_op[0] ) ? $array_op[0] : '';
$alias_group_url = isset( $array_op[1] ) ? $array_op[1] : '';
$groupid = 0;

$array_displays = array(
	'0' => $lang_module['displays_new'],
	'1' => $lang_module['displays_price_asc'],
	'2' => $lang_module['displays_price_desc']
);

// Categories
foreach( $global_array_shops_cat as $row )
{
	$global_array_shops_cat[$row['catid']]['link'] =  NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=' . $row['alias'];

	if( $alias_cat_url == $row['alias'] )
	{
		$catid = $row['catid'];
		$parentid = $row['parentid'];
	}
}

// Groups
foreach( $global_array_group as $row )
{
	$global_array_group[$row['groupid']]['link'] = NV_BASE_SITEURL . 'index.php?' . NV_LANG_VARIABLE . '=' . NV_LANG_DATA . '&amp;' . NV_NAME_VARIABLE . '=' . $module_name . '&amp;' . NV_OP_VARIABLE . '=group/' . $row['alias'];
	if( $alias_group_url == $row['alias'] )
	{
		$groupid = $row['groupid'];
	}
}
unset( $alias_cat_url, $row, $alias_group_url );

$page = 1;
$per_page = $pro_config['per_page'];

if( $op == 'main' )
{
	if( empty( $catid ) )
	{
		if( preg_match( '/^page\-([0-9]+)$/', ( isset( $array_op[0] ) ? $array_op[0] : '' ), $m ) )
		{
			$page = ( int )$m[1];
		}
	}
	else
	{
		if( sizeof( $array_op ) == 2 and preg_match( '/^([a-z0-9\-]+)\-([0-9]+)$/i', $array_op[1], $m1 ) and ! preg_match( '/^page\-([0-9]+)$/', $array_op[1], $m2 ) )
		{
			$op = 'detail';
			$alias_url = $m1[1];
			$id = $m1[2];
		}
		else
		{
			$op = 'viewcat';
		}

		$parentid = $catid;
		while( $parentid > 0 )
		{
			$array_cat_i = $global_array_shops_cat[$parentid];
			$array_mod_title[] = array(
				'catid' => $parentid,
				'title' => $array_cat_i['title'],
				'link' => $array_cat_i['link']
			);
			$parentid = $array_cat_i['parentid'];
		}
		sort( $array_mod_title, SORT_NUMERIC );
	}
}

// Wishlist
if( defined( 'NV_IS_USER' ) and $pro_config['active_wishlist'] )
{
	$listid = $db->query( 'SELECT listid FROM ' . $db_config['prefix'] . '_' . $module_data . '_wishlist WHERE user_id = ' . $user_info['userid'] . '' )->fetchColumn();
	if( $listid )
	{
		$array_wishlist_id = explode( ',', $listid );
	}
}

/**
 * GetDataIn()
 *
 * @param mixed $result
 * @param mixed $catid
 * @return
 */
function GetDataIn( $result, $catid )
{
	global $global_array_shops_cat, $module_name, $module_file, $db, $link, $module_info, $global_config;

	$data_content = array();
	$data = array();
	while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $product_code, $product_number, $product_price, $money_unit, $discount_id, $showprice,$promotional, $newday ) = $result->fetch( 3 ) )
	{
		if( $homeimgthumb == 1 )//image thumb
		{
			$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 2 )//image file
		{
			$thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 3 )//image url
		{
			$thumb = $homeimgfile;
		}
		else//no image
		{
			$thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
		}

		$data[] = array(
			'id' => $id,
			'listcatid' => $listcatid,
			'publtime' => $publtime,
			'title' => $title,
			'alias' => $alias,
			'hometext' => $hometext,
			'homeimgalt' => $homeimgalt,
			'homeimgthumb' => $thumb,
			'product_code' => $product_code,
			'product_number' => $product_number,
			'product_price' => $product_price,
			'discount_id' => $discount_id,
			'money_unit' => $money_unit,
			'showprice' => $showprice,
			'newday' => $newday,
			'promotional'=> $promotional,
			'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . '-' . $id . $global_config['rewrite_exturl'],
			'link_order' => $link . 'setcart&amp;id=' . $id
		);
	}

	$data_content['id'] = $catid;
	$data_content['title'] = $global_array_shops_cat[$catid]['title'];
	$data_content['image'] = $global_array_shops_cat[$catid]['image'];
	$data_content['data'] = $data;
	$data_content['alias'] = $global_array_shops_cat[$catid]['alias'];

	return $data_content;
}

/**
 * GetDataInGroup()
 *
 * @param mixed $result
 * @param mixed $groupid
 * @return
 */
function GetDataInGroups( $result, $array_g )
{
	global $global_array_group, $module_name, $module_file, $db, $link, $module_info, $global_array_shops_cat, $global_config;

	$data_content = array();
	$data = array();

	while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $product_code, $product_number, $product_price, $money_unit, $discount_id, $showprice,$promotional, $newday ) = $result->fetch( 3 ) )
	{
		if( $homeimgthumb == 1 )//image thumb
		{
			$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 2 )//image file
		{
			$thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 3 )//image url
		{
			$thumb = $homeimgfile;
		}
		else//no image
		{
			$thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
		}

		$data[] = array(
			'id' => $id,
			'listcatid' => $listcatid,
			'publtime' => $publtime,
			'title' => $title,
			'alias' => $alias,
			'hometext' => $hometext,
			'homeimgalt' => $homeimgalt,
			'homeimgthumb' => $thumb,
			'product_code' => $product_code,
			'product_number' => $product_number,
			'product_price' => $product_price,
			'discount_id' => $discount_id,
			'money_unit' => $money_unit,
			'showprice' => $showprice,
			'newday' => $newday,
			'promotional' => $promotional,
			'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . '-' . $id . $global_config['rewrite_exturl'],
			'link_order' => $link . 'setcart&amp;id=' . $id
		);
	}

	$data_content['id'] = $array_g[0];
	$data_content['title'] = $global_array_group[$array_g[0]]['title'];
	$data_content['data'] = $data;
	$data_content['alias'] = $global_array_group[$array_g[0]]['alias'];

	return $data_content;
}

/**
 * GetDataInGroup()
 *
 * @param mixed $result
 * @param mixed $groupid
 * @return
 */
function GetDataInGroup( $result, $groupid )
{
	global $global_array_group, $module_name, $module_file, $db, $link, $module_info, $global_array_shops_cat, $global_config;

	$data_content = array();
	$data = array();

	while( list( $id, $listcatid, $publtime, $title, $alias, $hometext, $homeimgalt, $homeimgfile, $homeimgthumb, $product_code, $product_number, $product_price, $money_unit, $discount_id, $showprice, $newday ) = $result->fetch( 3 ) )
	{
		if( $homeimgthumb == 1 )//image thumb
		{
			$thumb = NV_BASE_SITEURL . NV_FILES_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 2 )//image file
		{
			$thumb = NV_BASE_SITEURL . NV_UPLOADS_DIR . '/' . $module_name . '/' . $homeimgfile;
		}
		elseif( $homeimgthumb == 3 )//image url
		{
			$thumb = $homeimgfile;
		}
		else//no image
		{
			$thumb = NV_BASE_SITEURL . 'themes/' . $module_info['template'] . '/images/' . $module_file . '/no-image.jpg';
		}

		$data[] = array(
			'id' => $id,
			'listcatid' => $listcatid,
			'publtime' => $publtime,
			'title' => $title,
			'alias' => $alias,
			'hometext' => $hometext,
			'homeimgalt' => $homeimgalt,
			'homeimgthumb' => $thumb,
			'product_code' => $product_code,
			'product_number' => $product_number,
			'product_price' => $product_price,
			'discount_id' => $discount_id,
			'money_unit' => $money_unit,
			'showprice' => $showprice,
			'newday' => $newday,
			'link_pro' => $link . $global_array_shops_cat[$listcatid]['alias'] . '/' . $alias . '-' . $id . $global_config['rewrite_exturl'],
			'link_order' => $link . 'setcart&amp;id=' . $id
		);
	}

	$data_content['id'] = $groupid;
	$data_content['title'] = $global_array_group[$groupid]['title'];
	$data_content['data'] = $data;
	$data_content['alias'] = $global_array_group[$groupid]['alias'];
	$data_content['description'] = $global_array_group[$groupid]['description'];
	$data_content['image'] = $global_array_group[$groupid]['image'];

	return $data_content;
}

/**
 * SetSessionProView()
 *
 * @param mixed $id
 * @param mixed $title
 * @param mixed $alias
 * @param mixed $addtime
 * @param mixed $link
 * @param mixed $homeimgthumb
 * @return
 */
function SetSessionProView( $id, $title, $alias, $addtime, $link, $homeimgthumb )
{
	global $module_data;
	if( ! isset( $_SESSION[$module_data . '_proview'] ) ) $_SESSION[$module_data . '_proview'] = array();
	if( ! isset( $_SESSION[$module_data . '_proview'][$id] ) )
	{
		$_SESSION[$module_data . '_proview'][$id] = array(
			'title' => $title,
			'alias' => $alias,
			'addtime' => $addtime,
			'link' => $link,
			'homeimgthumb' => $homeimgthumb
		);
	}
}
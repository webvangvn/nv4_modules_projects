<?php

/**
 * @Project NUKEVIET 4.x
 * @Author Webvang (hoang.nguyen@webvang.vn)
 * @copyright 2009
 * @License GNU/GPL version 2 or any later version
 * @Createdate 16/05/2015 09:47
 */

if( ! defined( 'NV_ADMIN' ) or ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );

$module_version = array(
	'name' => 'Projects', // Tieu de module
	'modfuncs' => 'main,viewcat,detail,search,complete,history,group,search_result,compare,wishlist,tag,point', // Cac function co block
	'is_sysmod' => 0, // 1:0 => Co phai la module he thong hay khong
	'virtual' => 1, // 1:0 => Co cho phep ao hao module hay khong
	'version' => '4.0.00', // Phien ban cua module
	'date' => 'Sat, 16 May 2015 00:50:00 GMT', // Ngay phat hanh phien ban
	'author' => 'Webvang (hoang.nguyen@webvang.vn)', // Tac gia
	'note' => '', // Ghi chu
	'uploads_dir' => array( $module_name, $module_name . '/temp_pic', $module_name . '/' . date( 'Y_m' ) )
);
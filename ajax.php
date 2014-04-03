<?php

/**
 * Ajax
 *
 * @package Boots
 * @subpackage Ajax
 * @version 1.0.0
 * @license GPLv2
 *
 * Boots - The missing WordPress framework. http://wpboots.com
 *
 * Copyright (C) <2014>  <M. Kamal Khan>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 */

define('WP_USE_THEMES', false);
require('../../../../../../wp-blog-header.php');
if (!function_exists ('has_action')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}
header("HTTP/1.1 200 OK");

$action = isset($_POST['_action']) ? esc_attr($_POST['_action']) : false;
$hook = 'boots_ajax_' . $action;

if(!$action)
{
    die();
}

$nonce = isset($_POST['_nonce']) ? esc_attr($_POST['_nonce']) : false;

unset($_POST['_action'], $_POST['_nonce']);

if(has_action($hook))
{
    do_action($hook, $nonce);
}
else
{
    die('Could not find the action hook <strong>' . $hook . '</strong>');
}
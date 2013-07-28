<?php

ini_set('display_errors', '1');

if(isset($_SERVER['HTTP_HOST'])){
	
	$base_url = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on' ? 'https' : 'http';
	$base_url .= '://'. $_SERVER['HTTP_HOST'];
	$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

	$base_uri = parse_url($base_url, PHP_URL_PATH);

	if(substr($base_uri, 0, 1) != '/')
		$base_uri = '/'.$base_uri;
	if(substr($base_uri, -1, 1) != '/')
		$base_uri .= '/';
}
else{
	
	$base_url = 'http://localhost/';
	$base_uri = '/';
}

//echo dirname(__FILE__);

/**
 * Define document paths
 */
define('SERVER_ROOT' , str_replace('\\', '/', dirname(__FILE__)));

define('SITE_ROOT' , $base_url);

/**
 * Fetch the router
 */
//require_once(SERVER_ROOT . '/controllers/' . 'router.php');

require_once(SERVER_ROOT . '/config/' . 'router.php');
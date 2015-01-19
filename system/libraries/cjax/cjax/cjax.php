<?php
/** ################################################################################################**   
* Copyright (c)  2008  CJ.   
* Permission is granted to copy, distribute and/or modify this document   
* under the terms of the GNU Free Documentation License, Version 1.2   
* or any later version published by the Free Software Foundation;   
* Provided 'as is' with no warranties, nor shall the autor be responsible for any mis-use of the same.     
* A copy of the license is included in the section entitled 'GNU Free Documentation License'.   
*   
*   CJAX  5.3-Obama2012                $     
*   ajax made easy with cjax                    
*   -- DO NOT REMOVE THIS --                    
*   -- AUTHOR COPYRIGHT MUST REMAIN INTACT -   
*   Written by: CJ Galindo                  
*   Website: http://cjax.sourceforge.net                     $      
*   Email: cjxxi@msn.com    
*   Date: 2/12/2007                           $     
*   File Last Changed:  11/02/2012            $     
**####################################################################################################    */   

include_once 'core/cjax_config.php';
$ajax = CJAX::getInstance();

/**
 * Handle mod_rewrite redirects
 */
if(isset($_SERVER['REDIRECT_QUERY_STRING']) && $_SERVER['REDIRECT_QUERY_STRING']) {
	$_SERVER['QUERY_STRING'] = $_SERVER['REDIRECT_QUERY_STRING'];
} else if(isset($_SERVER['PATH_INFO']) && $_SERVER['PATH_INFO'] && !$_SERVER['QUERY_STRING']) {
	$_SERVER['QUERY_STRING'] = ltrim($_SERVER['PATH_INFO'],'/');
}

/**
 * Handle friendly URLS
 */
if(isset($_SERVER['QUERY_STRING']) && $query = $_SERVER['QUERY_STRING']) {
	$packet = explode('/' ,rtrim($query,'/'));
	if(count($packet) == 1) {
		$is_plugin = $packet[0];
		if($plugin = $ajax->isPlugin($is_plugin))  {
			if(!defined('AJAX_VIEW')) {
				define('AJAX_VIEW', true);
			}
		}
	}
	if($ajax->isAjaxRequest() || defined('AJAX_VIEW') ) {
		if($packet && count(array_keys($packet)) >= 2 && $packet[0] && $packet[1]) {
			$_REQUEST['controller'] = $packet[0];
			$_REQUEST['function'] = $packet[1];
			$_REQUEST['cjax'] = time();
			if(count(array_keys($packet)) > 2) {
				unset($packet[0]);
				unset($packet[1]);
				if($packet){
					$params = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
					foreach($packet as $k  => $v) {
						$_REQUEST[current($params)] = $v;
						next($params);
					}
				}
			}
		} else  {
			if(!$ajax->input('controller')) {
				if(count($packet)==1) {
					$url = explode('&',$_SERVER['QUERY_STRING']);
					if(count($url) ==1){
						$_REQUEST['controller'] = $packet[0];
					}
				}
			}
		}
	}
}

if(!$ajax->isAjaxRequest()) {
	if(count(array_keys(debug_backtrace(false))) == 1 && !defined('AJAX_VIEW')) {
		exit("Security Error. You cannot access this file directly.");
	}
}


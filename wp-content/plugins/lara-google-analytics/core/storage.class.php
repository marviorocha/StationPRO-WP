<?php

namespace Lara\Utils\Common;

use Lara\Utils\Common as Common;

/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

if (!defined("ABSPATH"))
    die("This file cannot be accessed directly");

class registryStore{
	
	function __construct(){
		session_start();
	}
	
	public function set($name, $value=""){
		global $wpdb;
		
		if (empty($value)){$this->remove($name);}
		elseif (!empty($name)){
			try{
				$exists = $wpdb->get_results( "SELECT * FROM `".lrgawidget_plugin_table."` WHERE `name` = '".$name."'",ARRAY_A ); 
				if (!empty($exists)){
					$wpdb->update( lrgawidget_plugin_table, array('value' => $value), array('name' => $name));
				}else{
					$wpdb->insert( lrgawidget_plugin_table, array( 'name' => $name, 'value' => $value));
				}
			} catch (\Exception $e) {
				Common\ErrorHandler::FatalError("cannot save ".$name." returned error: ". $e->getMessage());
			}
		}

	}
	
	public function remove($name){
		global $wpdb;
		
		if (!empty($name)){
			try{
				$wpdb->delete( lrgawidget_plugin_table, array('name' => $name) );
			} catch (\Exception $e) {
				Common\ErrorHandler::FatalError("cannot delete ".$name." returned error: ". $e->getMessage());
			}
		}		
	}	
	
	public function getSettingsArray(){
		global $wpdb;
		
		$allSettings = array();
        $settings = $wpdb->get_results ( "SELECT `name`, `value` FROM  `".lrgawidget_plugin_table."`", ARRAY_A );
		if (!empty($settings)){
			foreach ($settings as $setting) {
				$allSettings[$setting['name']] = $setting['value'];
			}			
		}
		foreach ($_SESSION as $key => $value) {
			if(preg_match('/^lrgatmp_/s', $key)){
				$nkey = str_replace("lrgatmp_", "", $key);
				$allSettings[$nkey] = $value;
			}
		}
		return $allSettings;
	}
	
	public function settingsReset(){
		global $wpdb;
		
    	try{
			$wpdb->query("TRUNCATE TABLE `".lrgawidget_plugin_table."`");
		} catch (\Exception $e) {
				Common\ErrorHandler::FatalError("cannot empty table, returned error: ". $e->getMessage());
		}

		foreach ($_SESSION as $key => $value) {
			if(preg_match('/^lrgatmp_/s', $key)){
			   unset($_SESSION[$key]);
			};
		}		
	}	

	public function getCache($cachePrefix, $queryID, $expires_in=0){
		if (isset($_SESSION[$cachePrefix.$queryID]["cache"])){
			if (($_SESSION[$cachePrefix.$queryID]["created_on"] + $expires_in) >=  time()){
				return $_SESSION[$cachePrefix.$queryID]["cache"];
			}else{
				unset($_SESSION[$cachePrefix.$queryID]);
			}
		}
	}

	public function saveCache($cachePrefix , $queryID, $value){
		if (!empty($queryID) && !empty($value) && !empty($cachePrefix)){
			$_SESSION[$cachePrefix.$queryID]["cache"] = $value;
			$_SESSION[$cachePrefix.$queryID]["created_on"] = time();
		}		
	}

	public function deleteCache($cachePrefix , $queryID){
		if (!empty($queryID) && !empty($cachePrefix)){
			unset($_SESSION[$cachePrefix.$queryID]);
		}		
	}	
	
	public function purgeCache($cachePrefix){
		foreach ($_SESSION as $key => $value) {
			if(preg_match("/^".$cachePrefix."/s", $key)){ 
			   unset($_SESSION[$key]);
			};
		}		
	}

	public function setToSession($var, $value){
		if (!empty($var) && !empty($value)){
             $_SESSION["lrgatmp_".$var] = $value ;
		}
	}
	
	public function removeFromSession($var){
		if (isset($_SESSION[$var])){
			unset($_SESSION[$var]);
		}
	}
}
?>
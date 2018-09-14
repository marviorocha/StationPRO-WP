<?php

namespace Lara;
use Lara\Widgets\GoogleAnalytics as GoogleAnalytics;
use Lara\Utils\Common            as Common;

/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

if (!defined("ABSPATH"))
    die("This file cannot be accessed directly");

require("exception.class.php");

if (isset($lrdata['action']) && !empty($lrperm)){
	
	require("callURL.class.php");
	require("storage.class.php");
	require("GoogleAnalyticsAPI.class.php");
	require("lrgawidget.class.php");


	$call = new GoogleAnalytics\lrgawidget($lrperm);
	$call->setSystemTimeZone(get_option('timezone_string'));

	$call->setDateRange(date('Y-m-d', strtotime('-1 month')), date('Y-m-d'));
	if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){
	    Common\ErrorHandler::setDebugMode(true);
	}
 	
	switch ($lrdata['action']) {
		case "getAuthURL":
			if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){$call->getAuthURL(trim($lrdata['client_id']), trim($lrdata['client_secret']));}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;	
		case "getAccessToken":
			if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){$call->getAccessToken(trim($lrdata['client_id']), trim($lrdata['client_secret']), trim($lrdata['code']));}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;	
		case "getProfiles":
			if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){$call->getProfiles();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;
		case "setProfileID":
			if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){ $call->setProfileID($lrdata['account_id'],$lrdata['property_id'],$lrdata['profile_id'], $lrdata['profile_timezone']);}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}			
			break;	
		case "settingsReset":
			if (in_array("lrgawidget_perm_admin", $lrperm["permissions"])){ $call->settingsReset();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to reset data!");}			
			break;			
		case "getSessions":
			if (in_array("lrgawidget_perm_sessions", $lrperm["permissions"])){$call->getSessions();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}
			break;
		case "getPages":
			if (in_array("lrgawidget_perm_pages", $lrperm["permissions"])){$call->getPages();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;			
		case "getBrowsers":
			if (in_array("lrgawidget_perm_browsers", $lrperm["permissions"])){$call->getBrowsers(@$lrdata['versions']);}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;
		case "getLanguages":
			if (in_array("lrgawidget_perm_languages", $lrperm["permissions"])){$call->getLanguages();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;	
		case "getOS":
			if (in_array("lrgawidget_perm_os", $lrperm["permissions"])){$call->getOS(@$lrdata['versions']);}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;
		case "getDevices":
			if (in_array("lrgawidget_perm_devices", $lrperm["permissions"])){$call->getDevices(@$lrdata['versions']);}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;			
		case "getScreenResolution":
			if (in_array("lrgawidget_perm_screenres", $lrperm["permissions"])){$call->getScreenResolution();}
			else{ Common\ErrorHandler::FatalError("You don't have permission to access this tab!");}		
			break;
		default:
		    exit;
	} 
}else{ Common\ErrorHandler::FatalError("Fatal :: Invalid Call!");}

?>
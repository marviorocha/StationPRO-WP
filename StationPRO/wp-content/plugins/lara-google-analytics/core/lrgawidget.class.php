<?php

namespace Lara\Widgets\GoogleAnalytics;
use Lara\Utils\Google\GoogleAnalyticsAPI as GoogleAnalyticsAPI;
use Lara\Utils\Common\registryStore as registryStore;

/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

if (!defined("ABSPATH"))
    die("This file cannot be accessed directly");

class lrgawidget{
	
	private $lrperm;
	private $systemTimeZone;
    private $gapi;
	private $store;
	private $cache;
	private $cacheOutput;
	private $cachedOutput;
	private $cachePrefix;
	private $cacheTime;
	private $dParams  = array();
	private $params   = array();
	private $filters  = array();	
	private $settings = array();
	private $results  = array();
	private $output   = array();
	private $errors   = array();	
	private $cached;
	private $currentQueryParams;
	private $mdCurrentQueryParams;
	private $calculateTotalsFor;

	function __construct($lrperm){
		$this->lrperm = $lrperm;
		$this->systemTimeZone = date_default_timezone_get();
		$this->gapi = new GoogleAnalyticsAPI();
		$this->store = new registryStore();
		$this->cache = true;
		$this->cacheOutput = true;
		$this->cachePrefix = "lrga_";
		$this->cacheTime = 3600;
		$this->dParams = array( 'metrics' => 'ga:sessions', 'sort' => '-ga:sessions');
		$this->settings = $this->store->getSettingsArray();
		$this->calculateTotalsFor = "ga:sessions";
	}
	
	public function getSessions(){
		$this->params = array('metrics' => 'ga:sessions,ga:users,ga:pageviews, ga:percentNewSessions,ga:bounceRate,ga:avgSessionDuration,ga:pageviewsPerSession',
		                      'dimensions' => 'ga:date',
							  'sort' => 'ga:date');
		$this->doCall();
		
		$cachedCall = array();
        if (($this->cacheOutput === true) && (!empty($this->mdCurrentQueryParams))){
            $cachedCall = $this->store->getCache($this->cachePrefix, $this->mdCurrentQueryParams."_output", $this->cacheTime);
		}
			
		if (!empty($cachedCall)){
			$this->output = $cachedCall;
			$this->cachedOutput = true;
		}else{
			@array_walk($this->results['rows'], array($this, 'convertDate'));
			$plotData = array(); 
			foreach ($this->results['rows'] as $row){
				foreach ($row as $id => $value){
					if     ($id === 1){$plotData['sessions'][] = array($row[0], $value); $plotData['sessions_sb'][] = $value;}
					elseif ($id === 2){$plotData['users'][] = array($row[0], $value); $plotData['users_sb'][] = $value;}
					elseif ($id === 3){$plotData['pageviews'][] = array($row[0], $value); $plotData['pageviews_sb'][] = $value;}
					elseif ($id === 4){$plotData['percentNewSessions'][] = array($row[0], $this->roundNumbers($value)); $plotData['percentNewSessions_sb'][] = $this->roundNumbers($value);}
					elseif ($id === 5){$plotData['bounceRate'][] = array($row[0], $this->roundNumbers($value)); $plotData['bounceRate_sb'][] = $this->roundNumbers($value);}
					elseif ($id === 6){$plotData['avgSessionDuration'][] = array($row[0],$this->roundNumbers($value)); $plotData['avgSessionDuration_sb'][] = $this->roundNumbers($value);}
					elseif ($id === 7){$plotData['pageviewsPerSession'][] = array($row[0], $this->roundNumbers($value)); $plotData['pageviewsPerSession_sb'][] = $this->roundNumbers($value);}
				}
			}
			$finalPlotData['sessions'] = array("label" => "Sessions", "data" => $plotData['sessions'], "lrbefore"=>"", "lrafter"=>"", "lrformat"=>"");
			$finalPlotData['users'] = array("label" => "Users", "data" => $plotData['users'], "lrbefore"=>"", "lrafter"=>"", "lrformat"=>"");
			$finalPlotData['pageviews'] = array("label" => "Pageviews", "data" => $plotData['pageviews'], "lrbefore"=>"", "lrafter"=>"", "lrformat"=>"");
			$finalPlotData['percentNewSessions'] = array("label" => "% New Sessions", "data" => $plotData['percentNewSessions'], "lrbefore"=>"", "lrafter"=>"%", "lrformat"=>"");
			$finalPlotData['bounceRate'] = array("label" => "Bounce Rate", "data" => $plotData['bounceRate'], "lrbefore"=>"", "lrafter"=>"%", "lrformat"=>"");
			$finalPlotData['avgSessionDuration'] = array("label" => "avg. Session Duration", "data" => $plotData['avgSessionDuration'], "lrbefore"=>"", "lrafter"=>"", "lrformat"=>"seconds");
			$finalPlotData['pageviewsPerSession'] = array("label" => "Pageviews/Session", "data" => $plotData['pageviewsPerSession'], "lrbefore"=>"", "lrafter"=>"", "lrformat"=>"");
			
			$totalsForAllResults['sessions'] = array("total" => $this->results['totalsForAllResults']['ga:sessions'], "data" => implode(",", $plotData['sessions_sb']));
			$totalsForAllResults['users'] = array("total" => $this->results['totalsForAllResults']['ga:users'], "data" => implode(",", $plotData['users_sb']));
			$totalsForAllResults['pageviews'] = array("total" => $this->results['totalsForAllResults']['ga:pageviews'], "data" => implode(",", $plotData['pageviews_sb']));
			$totalsForAllResults['percentNewSessions'] = array("total" => $this->roundNumbers($this->results['totalsForAllResults']['ga:percentNewSessions']), "data" => implode(",", $plotData['percentNewSessions_sb']));
			$totalsForAllResults['bounceRate'] = array("total" => $this->roundNumbers($this->results['totalsForAllResults']['ga:bounceRate']), "data" => implode(",", $plotData['bounceRate_sb']));
			$totalsForAllResults['avgSessionDuration'] = array("total" => gmdate("H:i:s", $this->results['totalsForAllResults']['ga:avgSessionDuration']), "data" => implode(",", $plotData['avgSessionDuration_sb']));
			$totalsForAllResults['pageviewsPerSession'] = array("total" => $this->roundNumbers($this->results['totalsForAllResults']['ga:pageviewsPerSession']), "data" => implode(",", $plotData['pageviewsPerSession_sb']));

			$this->output =  array ("plotdata" => $finalPlotData, "totalsForAllResults" =>$totalsForAllResults);

			if (($this->cacheOutput === true) && (!empty($this->mdCurrentQueryParams))){
				$this->store->saveCache($this->cachePrefix, $this->mdCurrentQueryParams."_output", $this->output);
			}
		}

		$this->jsonOutput();
	}
	
	public function getBrowsers($versions=""){
		$this->params = array( 'dimensions' => 'ga:browser');
		$this->doCall(true);
	}

	public function getLanguages(){
		$this->params = array('dimensions' => 'ga:language');		
		$this->doCall(true);
	}

	public function getOS($versions=""){
		$this->params = array( 'dimensions' => 'ga:operatingSystem');
		$this->doCall(true);
	}
	
	public function getDevices($versions=""){
		$this->params = array( 'dimensions' => 'ga:deviceCategory');
		$this->doCall(false);
		
		$this->calculateTotals();
		$this->jsonOutput();
		
	}	

	public function getScreenResolution(){
		$this->params = array('dimensions' => 'ga:ScreenResolution');		
		$this->doCall(true);
	}	

	public function getPages(){
		$this->params = array('metrics' => 'ga:pageviews', 'dimensions' => 'ga:pagePath,ga:pageTitle', 'sort' => '-ga:pageviews');
		$this->calculateTotalsFor = "ga:pageviews";
		$this->doCall(false);
		
		if (is_array($this->results['rows']) && !empty($this->results['rows'])){
			@array_walk($this->results['rows'], array($this, 'preparePagesOutput'));
		}
		
		$this->calculateTotals();
		$this->jsonOutput();		
	}
	
	private function doCall($handleOutput=false){
		$this->checkSettings();
		$_params = array_merge($this->dParams, $this->params, $this->filters);
		$this->gapi->buildQuery($_params);
		$this->setCurrentQueryParms();
		$this->inCache($this->currentQueryParams);
		if (!$this->cached){
			$this->results = $this->gapi->doQuery();
			if ($this->cache){
				$this->store->saveCache($this->cachePrefix, $this->mdCurrentQueryParams, $this->results);
			}
		}
		if ($handleOutput){
			$this->calculateTotals();
			$this->jsonOutput();
		}
	}
	
	private function inCache($query){
        $this->cached = false; 		
		if ($this->cache){
			$queryID = md5(json_encode($query, true));
			$cachedCall = $this->store->getCache($this->cachePrefix, $queryID, $this->cacheTime);
			if (!empty($cachedCall)){
				$this->results = $cachedCall;
				$this->cached = true;
			}
	    }
	}

	private function setCurrentQueryParms(){
		$this->currentQueryParams = $this->gapi->getQueryParams();
		$this->mdCurrentQueryParams = md5(json_encode($this->currentQueryParams, true));
	}
	
	private function checkSettings (){
		if ( ($this->getSetting('client_id') === null) || ($this->getSetting('client_secret') === null) || ($this->getSetting('access_token')=== null) || ($this->getSetting('profile_id')=== null)){
			$this->output = array("setup" => 1);
			$this->jsonOutput();
		}
		if ( ($this->getSetting('start_date') !== null) && ($this->getSetting('end_date') !== null)){
			$this->setGapiValues(array( 'start_date'   => $this->getSetting('start_date'), 
										'end_date'     => $this->getSetting('end_date')));
		}
		$this->setGapiValues(array('profile_id'   => $this->getSetting('profile_id')));
		$this->refreshToken();		
	}

    ## Authentication Methods	
	public function getAuthURL($client_id, $client_secret){
		$this->setGapiValues(array( 'client_id' => $client_id, 'client_secret'  => $client_secret));
		$this->output = array('url'=>$this->gapi->authURL());
		$this->jsonOutput();
	}
	
	
	public function getProfiles(){
		$this->refreshToken();
		$this->results = $this->gapi->getAccounts();
		$this->output['all_accounts'] = $this->results['items'];
		$this->results = $this->gapi->getProfiles(array('fields' => 'items(id,timezone)'));
		$this->output['all_profiles'] = $this->results['items'];
		$this->output['current_selected'] = array("account_id"         => $this->getSetting('account_id'),
		                                           "property_id"       => $this->getSetting('property_id'),
												   "profile_id"        => $this->getSetting('profile_id'),
												   "profile_timezone"  => $this->getSetting('profile_timezone')); 
		$this->jsonOutput();
	}

	public function getAccessToken($client_id, $client_secret, $code){
		$this->setGapiValues(array( 'client_id' => $client_id, 'client_secret'  => $client_secret, 'code' => $code));
		$results = $this->gapi->getAccessToken();
		$this->saveSetting(array('client_id'     => $client_id,
		                         'client_secret' => $client_secret,
								 'access_token'  => $results['access_token'],
								 'token_type'    => $results['token_type'],
								 'expires_in'    => $results['expires_in'],
								 'refresh_token' => $results['refresh_token'],
								 'created_on'    => time()));
		$this->jsonOutput();
	}
	private function refreshToken(){
		if (($this->getSetting('created_on') + $this->getSetting('expires_in')) <=  time() ){
			$this->setGapiValues(array( 'client_id'     => $this->getSetting('client_id'),
										'client_secret' => $this->getSetting('client_secret'),
										'refresh_token' => $this->getSetting('refresh_token')));
			$results = $this->gapi->refreshAccessToken();
			$this->saveSetting(array('access_token'  => $results['access_token'],
			                         'token_type'    => $results['token_type'],
									 'expires_in'    => $results['expires_in'],
									 'created_on'    => time()));
			$this->purgeCache();
		}
		$this->setGapiValues(array('access_token' => $this->getSetting('access_token')));
	}
	

	public function setProfileID($account_id, $property_id, $profile_id, $profile_timezone){
		$this->saveSetting(array('account_id'        => $account_id,
		                         'property_id'       => $property_id,
								 'profile_id'        => $profile_id,
								 'profile_timezone'  => $profile_timezone));
		$this->purgeCache();
		$this->jsonOutput();
	}

	public function settingsReset(){
		$this->store->settingsReset();
		$this->purgeCache();
		$this->output = array("setup" => 1);
		$this->jsonOutput();
	}	

	public function setDateRange($start_date, $end_date){
		if (($this->getSetting('start_date') != $start_date) || ($this->getSetting('end_date') != $end_date)){
			$this->saveSetting(array('start_date'  => $start_date,
			                         'end_date'    => $end_date), true);
			$this->purgeCache();
		}
	}

	public function setSystemTimeZone($systemTimeZone){
		$this->systemTimeZone = $systemTimeZone; 
	}	

    private function purgeCache(){
		if ($this->cache){
			$this->store->purgeCache($this->cachePrefix);
		}
	}	

	private function getSetting($name){
		return(isset($this->settings[$name])?$this->settings[$name]:null);
	}	
	
	private function saveSetting($settings, $sessionOnly=false){
		foreach ($settings as $name => $val){
			$this->settings[$name] = $val;
			if ($sessionOnly){
				$this->store->setToSession($name, $val);
			}else{
				$this->store->set($name, $val);
			}
		}
	}
	
	private function setGapiValues($kvPairs){
		foreach ($kvPairs as $key => $val){
			$this->gapi->$key = $val;
		}
	}

	private function calculateTotals(){
		if (isset($this->results['rows'])){
			$totalSessions = $this->results['totalsForAllResults'][$this->calculateTotalsFor];
			foreach ($this->results["rows"] as $index => $record){
				$this->results["rows"][$index][] = number_format(((end($record)*100)/$totalSessions),2);
			}
		$this->output = $this->results["rows"];
		}
	}

	private function preparePagesOutput(&$item){
		$item[0] = array($item[0],$item[1]);
		$item[1] = $item[2];
		unset($item[2]);
	}	
	
	private function convertDate(&$item){
		$item[0] = strtotime($item[0]." UTC") * 1000;
	}
	
	private function roundNumbers($num){
		$rounded =  floor($num * 100) / 100	;
        return $rounded; 		
	}	
	
	private function jsonOutput(){
		header('Content-Type: application/json; charset=utf-8');
		if (empty($this->errors)){
			if ($this->cached){ $this->output['cached'] = "true";}
			if ($this->cachedOutput){ $this->output['cachedOutput'] = "true";}
			$this->output['system_timezone'] = $this->systemTimeZone;
			$this->output['gaview_timezone'] = $this->getSetting('profile_timezone');
			$this->output['start'] = $this->getSetting('start_date');			
			$this->output['end'] = $this->getSetting('end_date');
			$this->output['status'] = "done";
			echo json_encode($this->output, true);
		}else{ echo json_encode($this->errors); }
		
		exit();
	}	
	
}
?>
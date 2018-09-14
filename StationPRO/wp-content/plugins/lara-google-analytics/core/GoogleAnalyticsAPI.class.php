<?php

namespace Lara\Utils\Google;
use Lara\Utils\Common as Common;

/**
 * @package    Google Analytics by Lara
 * @author     Amr M. Ibrahim <mailamr@gmail.com>
 * @link       https://www.xtraorbit.com/
 * @copyright  Copyright (c) WHMCSAdminTheme 2016 - 2017
 */

if (!defined("ABSPATH"))
    die("This file cannot be accessed directly");

class GoogleAnalyticsAPI{
	
 	const TOKEN_URL = 'https://accounts.google.com/o/oauth2/token';
	const AUTH_URL = 'https://accounts.google.com/o/oauth2/auth';
	const SCOPE_URL = 'https://www.googleapis.com/auth/analytics.readonly';
    const ACCOUNTS_SUMMARY_URL = "https://www.googleapis.com/analytics/v3/management/accountSummaries";
	const PROFILES_SUMMARY_URL = "https://www.googleapis.com/analytics/v3/management/accounts/~all/webproperties/~all/profiles";
	const API_URL = 'https://www.googleapis.com/analytics/v3/data/ga';

	
    private $client_id;
	private $client_secret;
	private $access_token;
	private $refresh_token;
	private $code;
	private $profile_id;
	private $start_date;
	private $end_date;
	private $dateRange = array();
	private $redirect_uri;
	private $httpRequest;
	private $queryParams;

	public function __construct(){
		$this->httpRequest = new Common\callURL();
		$this->redirect_uri = 'urn:ietf:wg:oauth:2.0:oob';
		$this->start_date = date('Y-m-d', strtotime('-1 month'));
		$this->end_date = date('Y-m-d');
	}

	public function authURL($params=array()) {
		$defaults = array( 'response_type' => 'code',
						   'client_id' => $this->client_id,
						   'redirect_uri' => $this->redirect_uri,
						   'scope' => self::SCOPE_URL,
						   'access_type' => 'offline',
						   'approval_prompt' => 'force');
						   
		$params = array_merge($defaults, $params);
		return self::AUTH_URL . '?' . http_build_query($params);
	}

	public function getAccounts() {
		return $this->httpRequest(self::ACCOUNTS_SUMMARY_URL, array('access_token' => $this->access_token), "GET");
	}

	public function getProfiles($params=array()) {
		return $this->httpRequest(self::PROFILES_SUMMARY_URL, array_merge(array('access_token' => $this->access_token), $params), "GET");
	}	
	public function buildQuery($params=array()){
		$this->dateRange = array('start-date' => $this->start_date, 'end-date' => $this->end_date);
		$_params = array_merge($this->dateRange, array('access_token' => $this->access_token, 'ids' => "ga:".$this->profile_id));
		$this->queryParams = array_merge($_params, $params);
	}

	public function doQuery(){
		return $this->httpRequest(self::API_URL, $this->queryParams, "GET"); 
	}
	
	public function getAccessToken() {
		$params = array( 'code'          => $this->code,
		                 'client_id'     => $this->client_id,
						 'client_secret' => $this->client_secret,
						 'redirect_uri'  => $this->redirect_uri,
						 'grant_type'    => 'authorization_code');
		
        $results = $this->httpRequest(self::TOKEN_URL, $params, "POST"); 
		if ( !empty($results['access_token']) && !empty($results['token_type']) && !empty($results['expires_in']) && !empty($results['refresh_token']) ){
			return $results;
		}else{ Common\ErrorHandler::FatalError("Invalid Reply","Google Replied with unexpected replay, enable debugging to check the reply..",100,$results); }
	}	
	
	public function refreshAccessToken() {
		$params = array( 'client_id'     => $this->client_id,
		                 'client_secret' => $this->client_secret,
						 'refresh_token' => $this->refresh_token,
						 'grant_type'    => 'refresh_token');
						 
        $results = $this->httpRequest(self::TOKEN_URL, $params, "POST"); 
		if ( !empty($results['access_token']) && !empty($results['token_type']) && !empty($results['expires_in']) ){
			return $results;
		}else{ Common\ErrorHandler::FatalError("Invalid Reply","Google Replied with unexpected replay, enable debugging to check the reply..",101,$results); }
	}
	
	private function httpRequest ($url, $query, $method){
		$doCall = $this->httpRequest->doQuickCall($url, $query, $method);
		$response = json_decode($doCall['Response'], true);
		if ($doCall['HTTP_Status_Code'] === 200){
			return $response;
		}else{
			$debugReply = json_decode($doCall['Response'], true);
			if (is_array($response['error']) && !empty($response['error']['message'])){ $response['error'] = $response['error']['message'];}
			Common\ErrorHandler::FatalError($response['error'],@$response['error_description'], $doCall['HTTP_Status_Code'], array("url" => $url, "curlRequest" =>$doCall['curlRequest'] , "request" => $query, "Reply" => $debugReply)); 
		}
	}
	
	public function getQueryParams(){
		return $this->queryParams;
	}	
	
	public function __set($property, $value) {
		switch($property){
			case 'client_id';
			case 'client_secret';
			case 'access_token';
			case 'refresh_token';
			case 'code';
			case 'profile_id';
			case 'start_date';
			case 'end_date';
			     $this->$property = $value;
				 break;
			default;
			     Common\ErrorHandler::FatalError("Invalid Property! : ".$property);
				 break;
		}		
	}
}

?>
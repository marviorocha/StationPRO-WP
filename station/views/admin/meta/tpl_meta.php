<?php

	// load language file		
$this->load->helper('language');
$this->lang->load('admin/setting');		
$this->load->model('varchar');
 
$pro = new TPLN;	
 
// here parse variable 

$pro->parse('base_url',base_url()); 
$pro->parse('admin_url',base_url().APPPATH.('views/admin/')); 

     
$pro->write(); 		

 ?>
<?php
/*
 *---------------------------------------------------------------
 * APPLICATION STATION PRO
 *---------------------------------------------------------------
 *
 * Here this location for variable the station pro software
 *
 *
 * NOTE: 
 *
 */
	
class Varchar extends CI_Model {
	

 	

// function meta config site
function menu () {
 
  	
 


}

function list_user(){

$query = $this->db->query("SELECT * FROM users");


foreach ($query->result_array() as $row)
{
  // echo json_encode($row[]);
   
return json_encode ($row);
}
 
	
	}


function select_setting(){
		$query = $this->db->query('SELECT * FROM settings LIMIT 1');
		$row = $query->row();
		return $row;
	}

function update_setting (){
$data = $this->input->post();	
 
 
$this->db->query("UPDATE `stationpro`.`settings` SET `company` = '".$this->input->post('company')."',
`slogan` = '".$this->input->post('slogan')."',
`email` = '".$this->input->post('email')."',
`ip` = '".$this->input->post('ip')."',
`port` = '".$this->input->post('port')."',
`url` = '".$this->input->post('web_url')."',
`description` = '".$this->input->post('description')."' WHERE `settings`.`id` = 1;
"); 
	

	
	}



	
}

































?>
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
	

 // function logo
function select_login () {

$query = $this->db->query('SELECT email,password FROM users');
$row = $query->row();
return $row;	
	
} 	

// function meta config site
function login () {

$log = $this->input->post();

$query = $this->db->query("SELECT * FROM users WHERE email='".$log['email']."' and password='".$log['password']."' ");
$row = $query->row();
$count = $query->num_rows(); 
 
if($count == 1){
 
$this->session->set_userdata($row->name);
 
$user = array(
                   'name'  => $row->name,
                   'email'     => $row->email,
				   'date'     => date('d/M/Y'),
                   'logged_in' => TRUE
               );

$this->session->set_userdata($user);

 
return $this->load->view('admin/loading.html');
// inicia a session
	
	} else{
		
$this->session->sess_destroy();		
return false;
	
}
 
 


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

// Install

function install (){
include(APPPATH."config/database.php");	
 

if ($this->db->table_exists('install'))
{
   redirect('install');
} 
$this->load->dbutil();


 
 
}



	
}

































?>
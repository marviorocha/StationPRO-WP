<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	  
	 
 
	
	// page setings 
	
	public function settings ()
	{
		
	// load language file		
$this->load->helper('language');
$this->lang->load('admin/setting');		
$this->load->model('varchar');
	
 
 
$pro = new TPLN;	
 
$pro->open(APPPATH.'views/admin/settings.html'); // you can do  $TPLN->Open();

// here parse variable 

$pro->parse('base_url',base_url()); 
$pro->parse('admin_url',base_url().APPPATH.('views/admin/')); 
$pro->parse('title',lang('title')); 
$pro->parse('site_setting',lang('site_setting')); 
$pro->parse('system_settings',lang('system_settings')); 
$pro->parse('company',lang('company')); 
$pro->parse('slogan',lang('slogan')); 
$pro->parse('streaming',lang('streaming')); 
$pro->parse('slogan',lang('slogan')); 
$pro->parse('email',lang('email'));
$pro->parse('url',lang('url'));
$pro->parse('ip',lang('ip'));
$pro->parse('port',lang('port'));
$pro->parse('description',lang('description'));
$pro->parse('error',lang('error'));
$pro->parse('button_salve',lang('button_salve'));

    
 // here parse variable 

$pro->includeFile('menu',APPPATH.'views/admin/menu.php'); // Include bottom 
$powerby = "Powered by <a href=\"http://www.stationpro.net\">Station PRO</a> v0.1";
$pro->parse('powered',$powerby); 

$pro->write(); 		
		//$apt['var'] = $this->varchar->config();

	 
	}
	
function Pages(){
 //$this->input->post('company');
 
if(($_POST['nome'] == "") || ($_POST['email'] == ""))
    {
      $message = "Please fill up blank fields";
      $bg_color = "#FFEBE8";
    
    } elseif(($_POST['nome'] != "nome") || ($_POST['email'] != "email")){
      $message = "Username and password do not match.";
      $bg_color = "#FFEBE8";
      
    }else{
      $message = "Username and password matched.";
      $bg_color = "#FFA";
    }
    
    $output = '{ "message": "'.$message.'", "bg_color": "'.$bg_color.'" }';
    echo $output;
  }	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
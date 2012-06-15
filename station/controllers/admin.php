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
	 // page index
	 
	 public function index (){
		$this->load->helper('language');
$this->lang->load('admin/setting');		

$pro = new TPLN;	
 
  
 $pro->open(APPPATH.'views/admin/login.html'); // you can do  $TPLN->Open();

 $powerby = "Powered by <a href=\"http://www.stationpro.net\">Station PRO</a> v0.1";
$pro->parse('powered',$powerby); 

$pro->write(); 		
  
		 
		 
		 }
	  
	 // page user 
	 
	 public function users($grid = 'none')
{
	
		// load language file		
$this->load->helper('language');
$this->lang->load('admin/setting');		

 
 
$pro = new TPLN;	
 
$pro->open(APPPATH.'views/admin/users.html'); // you can do  $TPLN->Open();

// here parse variable 


$pro->parse('admin_url',base_url().APPPATH.('views/admin/')); 
$pro->parse('title',lang('title')); 
$pro->parse('user_title',lang('user_title')); 
$pro->parse('tabs1',lang('tabs1')); 
$pro->parse('tabs2',lang('tabs2')); 
$pro->parse('name',lang('name')); 
$pro->parse('email',lang('email')); 
$pro->parse('passworld',lang('passworld')); 
$pro->parse('bio',lang('bio_user')); 
$pro->parse('type',lang('type_user')); 
 
  $columns = array(
            0 => array(
                'name' => lang('name'),
                'db_name' => 'name',
                'header' => lang('name'),
                'group' => 'User',
                'required' => TRUE,
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => lang('email'),
                'db_name' => 'email',
                'header' => lang('email'),
				'group' => 'User',
                'required' => TRUE,
                'visible' => TRUE,
				 'validation' => 'email',
                'form_control' => 'text_long',
                'type' => 'string'),
			2 => array(
                'name' => lang('passworld'),
                'db_name' => 'passworld',
                'header' => 'Senha',
				'group' => 'User',
                'required' => TRUE,
                'visible' => FALSE,
				'validation' => 'password',
                'form_control' => 'text_long',
                'type' => 'string'),
			3 => array(
                'name' => 'Bio',
                'db_name' => 'bio',
                'header' => lang('bio_user'),
                'group' => 'User',
                'required' => FALSE,
                'visible' => FALSE,
                'form_control' => 'textarea',
                'type' => 'string'),
			4 => array(
                'name' => 'Type',
                'db_name' => 'type',
                'header' => 'Type',
                'group' => 'User',
				'ref_table_db_name' => 'usercontrol',
                'ref_field_db_name' => 'type',
                'ref_field_type' => 'string',
                'form_control' => 'dropdown',
                'required' => TRUE,
                'type' => '1-n'),
           
        );
        // Allow edit/delete only for items with the current IP address
       
        // Don't show multiple delete button
$commands['delete']['toolbar'] = FALSE;
$params = array(
    'users' => 'id_users',
    'table' => 'users',
    'url' => 'admin/users',
    'uri_param' => $grid,
	'page_size  ' => "10",
	'allow_columns' => false,
    'columns' => $columns
  );
 

        $this->load->library('carbogrid', $params);

        if ($this->carbogrid->is_ajax)
        {
            $this->carbogrid->render();
            return FALSE;
        }

        // Pass grid to the view
        $data->page = 'admin/users';
       


$pro->parse('carbo',$this->carbogrid->render()); 
$pro->parse('error',lang('error'));
$pro->parse('success',lang('success'));
$pro->parse('button_salve',lang('button_salve'));

    
 // here parse variable 
$pro->includeFile('head',APPPATH.'views/admin/meta/head.php'); // Include bottom 
$pro->includeFile('menu',APPPATH.'views/admin/meta/menu.php'); // Include bottom 
$powerby = "Powered by <a href=\"http://www.stationpro.net\">Station PRO</a> v0.1";
$pro->parse('powered',$powerby); 

$pro->write(); 		 
		 
	 }


 
	
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
$setting = $this->varchar->select_setting();   
 
$pro->parse('admin_url',base_url().APPPATH.('views/admin/')); 
$pro->parse('title',lang('title')); 
$pro->parse('site_setting',lang('site_setting')); 
$pro->parse('company',$setting->company); 
$pro->parse('slogan',$setting->slogan); 
$pro->parse('email',$setting->email); 
$pro->parse('ip',$setting->ip); 
$pro->parse('port',$setting->port); 
$pro->parse('web_url',$setting->url); 
$pro->parse('description',$setting->description); 
$pro->parse('error',lang('error'));
$pro->parse('success',lang('success'));
 
 
 // here parse variable 

$pro->includeFile('head',APPPATH.'views/admin/meta/head_all.php'); // Include bottom 
$pro->includeFile('menu',APPPATH.'views/admin/meta/menu.php'); // Include bottom 
$powerby = "Powered by <a href=\"http://www.stationpro.net\">Station PRO</a> v0.1";
$pro->parse('powered',$powerby); 
$pro->write(); 		
		//$apt['var'] = $this->varchar->config();

	 
	}
	
public function setting_update (){
$this->load->model('varchar');
$this->varchar->update_setting();


} 
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
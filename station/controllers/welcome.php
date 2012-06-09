<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		
$pro = new TPLN;		
$pro->open(APPPATH.'views/page.html'); // you can do  $TPLN->Open();
$pro->parse('meta',APPPATH.'this is my text in my bloc !'); 

$pro->setNavColor('#ffffff','#ffffc0'); // change colors
$pro->dbConnect();
$pro->showRecords('SELECT * FROM users', 1); // only 10 results by page
$pro->dbClose();
 
$pro->write(); 		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
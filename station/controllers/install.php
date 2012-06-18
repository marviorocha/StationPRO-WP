<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install extends CI_Controller {

function index(){
	
$this->load->database('default');
echo $this->load->database('default');		
$this->load->helper('language');
$this->lang->load('admin/setting');		
$this->load->model('varchar');

$pro = new TPLN;	
$pro->open(APPPATH.'views/admin/install.html'); // you can do  $TPLN->Open();
 
 
$pro->includeFile('head',APPPATH.'views/admin/meta/head_all.php'); // Include bottom 
$pro->parse('admin_url',base_url().APPPATH.('views/admin/')); 
$powerby = "Powered by <a href=\"http://www.stationpro.net\">Station PRO</a> v0.1";
$pro->parse('powered',$powerby); 

$pro->write(); 		

	
}


function verific(){
	

include(APPPATH."config/database.php");		
$database = array(
"hostname" => $db['default']['hostname'],
"username" => $db['default']['username'],
"password" => $db['default']['password'],
"database" => $db['default']['database'],
$db['default']['dbdriver'] => '',
$db['default']['dbprefix'] => '',

);

$conn = mysql_connect($this->input->post('hostname'), $this->input->post('username'), $this->input->post('dbpassword')); 

if(!$conn) { 
  
  die('Could not connect: ' . mysql_error());
 
 } else {
  return true;
 } 
}



function conection (){
$this->load->helper('file');
$data = '<?php  if ( ! defined("BASEPATH")) exit("No direct script access allowed");
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the "Database Connection"
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	["hostname"] The hostname of your database server.
|	["username"] The username used to connect to the database
|	["password"] The password used to connect to the database
|	["database"] The name of the database you want to connect to
|	["dbdriver"] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	["dbprefix"] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	["pconnect"] TRUE/FALSE - Whether to use a persistent connection
|	["db_debug"] TRUE/FALSE - Whether database errors should be displayed.
|	["cache_on"] TRUE/FALSE - Enables/disables query caching
|	["cachedir"] The path to the folder where cache files should be stored
|	["char_set"] The character set used in communicating with the database
|	["dbcollat"] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	["swap_pre"] A default table prefix that should be swapped with the dbprefix
|	["autoinit"] Whether or not to automatically initialize the database.
|	["stricton"] TRUE/FALSE - forces "Strict Mode" connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the "default" group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = "default";
$active_record = TRUE;

$db["default"]["hostname"] = "'.$this->input->post('hostname').'";
$db["default"]["username"] = "'.$this->input->post('username').'";
$db["default"]["password"] = "'.$this->input->post('dbpassword').'";
$db["default"]["database"] = "'.$this->input->post('database').'";
$db["default"]["dbdriver"] = "mysql";
$db["default"]["dbprefix"] = "'.$this->input->post('prefix').'";
$db["default"]["pconnect"] = TRUE;
$db["default"]["db_debug"] = TRUE;
$db["default"]["cache_on"] = FALSE;
$db["default"]["cachedir"] = "";
$db["default"]["char_set"] = "utf8";
$db["default"]["dbcollat"] = "utf8_general_ci";
$db["default"]["swap_pre"] = "";
$db["default"]["autoinit"] = TRUE;
$db["default"]["stricton"] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */';

if ( !write_file(APPPATH.'./config/database.php', $data))
{
     echo 'Unable to write the file';
}
else
{
    

$this->db->trans_begin();
 // install
$this->db->query("
CREATE TABLE   ".$this->input->post('prefix')."install (
  id int(11) NOT NULL AUTO_INCREMENT,
  `installer` varchar(200) DEFAULT NULL,
  `install_content` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='' AUTO_INCREMENT=1 ;
 ");
// setting 
$this->db->query("
CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."settings (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(250) DEFAULT NULL,
  `slogan` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `ip` int(11) DEFAULT NULL COMMENT 'This streamign is url or ip',
  `port` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='table for Settings' AUTO_INCREMENT=2 ;
");
 
 // bloco
$this->db->query("
CREATE TABLE   ".$this->input->post('prefix')."block (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(200) DEFAULT NULL,
  `block_content` varchar(999) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='That this a block content for cms Station PRO' AUTO_INCREMENT=1 ;
 ");
// pages 
 $this->db->query("
CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."pages (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(200) DEFAULT NULL,
  `title` varchar(250) NOT NULL DEFAULT 'NULL',
  `description` varchar(200) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `content` mediumtext,
  `status` enum('Published','Draft') NOT NULL,
  `date` datetime DEFAULT NULL,
  `robot` enum('No Index','No Follow') NOT NULL,
  PRIMARY KEY (`id`)
)
ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='That this a block content for cms Station PRO' AUTO_INCREMENT=1 ;
 ");
 // program
$this->db->query("CREATE TABLE IF NOT EXISTS   ".$this->input->post('prefix')."program (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monday` varchar(150) DEFAULT NULL,
  `tuesday` varchar(150) DEFAULT NULL,
  `wednesday` varchar(200) DEFAULT NULL,
  `friday` varchar(150) DEFAULT NULL,
  `saturday` varchar(150) DEFAULT NULL,
  `sunday` varchar(150) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `finish` time DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='radio online programa with cron' AUTO_INCREMENT=1 ;
"); 
// theme
$this->db->query("
CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."theme (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `default` int(11) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `scree` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='This is table for Theme Station PRO' AUTO_INCREMENT=1 ;
"); 
// usercontrol
$this->db->query("CREATE TABLE IF NOT EXISTS   ".$this->input->post('prefix')."usercontrol (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;"); 

 // Plugin
 $this->db->query("
CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."plugin (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` set('active','desactive') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='This table for cms Station PRO' AUTO_INCREMENT=1 ;
");
 // Users
 $this->db->query("CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."users (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` char(6) DEFAULT NULL,
  `bio` varchar(300) DEFAULT NULL,
  `type` enum('Admin','Dj','Edit','Artist') NOT NULL COMMENT 'table users',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;");
// playlist

$this->db->query("CREATE TABLE IF NOT EXISTS ".$this->input->post('prefix')."playlist (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `audio_title` varchar(200) DEFAULT NULL,
  `audio_ordem` int(11) DEFAULT NULL,
  `audio_upload` blob,
  `playnow` char(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='That it a table for station pro album add' AUTO_INCREMENT=1 ;
"); 

// insert introl

$this->db->query("INSERT INTO ".$this->input->post('prefix')."settings (`id`, `company`, `slogan`, `email`, `ip`, `port`, `url`, `description`) VALUES (NULL, '".$this->input->post('company')."', NULL, '".$this->input->post('email')."', '".$this->input->post('ip')."', '".$this->input->post('port')."', '".$this->input->post('url')."', NULL);");

// insert control
$this->db->query("INSERT INTO ".$this->input->post('prefix')."usercontrol (`id`, `type`) VALUES
(1, 'Admin'),
(2, 'Dj'),
(3, 'User'),
(4, 'Edit'),
(5, 'Artist');"); 

// insert users
$this->db->query("INSERT INTO ".$this->input->post('prefix')."users(`id`, `name`, `email`, `password`, `bio`, `type`) VALUES (NULL, '".$this->input->post('name')."', '".$this->input->post('email')."', '".$this->input->post('password')."', NULL, 'Admin');");

 // Ci_sessions
 $this->db->query("CREATE TABLE IF NOT EXISTS  ".$this->input->post('prefix')."ci_sessions (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
");


if ($this->db->trans_status() === FALSE)
{	

    $this->db->trans_rollback();
	return false;
}
else
{
  // redirect('install');
}		
	
}

$this->load->helper('file');	

 	
}
 
	
	
	
}
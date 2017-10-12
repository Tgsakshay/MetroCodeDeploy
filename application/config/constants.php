<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('KEY_SERVICE', '1234');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('blah', 'hello mum!');
$myglobalvar = 'hey there';
//---------------Constants Define For Data BAse Table---------------------
define("PATIENT","patient");
define("USG","usg_cts");
define("USG_RATE","usg_master");
define("CTSCAN","ct_scan");
define("CT_RATE","ct_test_master");
define("PATHO_TEST_MASTER","patho_test");
define("PATHO_ALLOT_TEST","patho_allot_test");
define("HR_ASSESMENTFB","hr_assessfeedb");
define("HR_DEPARTMENT","department");
define("HR_designation","designation");
define("EMPLOYEE","employee");
define("EMP_DOC","employee_doc");
define("HR_DEPENDENT","hr_dependent");
define("HR_SUBDEP","sub_department");
define("HR_HEALTH_CHKUP","hr_health_chkup");
define("PATH_TEMP","patho_temp_humi");
define("PATH_RENDOX","patho_rendox");
define("PATH_COBAS","patho_cobas");
define("PATH_ACCULYTE","patho_acculyte");

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
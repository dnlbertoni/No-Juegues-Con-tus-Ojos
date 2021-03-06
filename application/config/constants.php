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
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

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

/*
 * PARAMETROS GENERALES
 */
define('NOMBRE_PROYECTO',		'No Juegues con tus Ojos');
define('CLUB_ROTARIO',		'Rotary Club Salto Grande Concordia');
define('TXTFILES', BASEPATH .'../assets/txt/');
define('IMGFILES', BASEPATH .'../assets/img/');
define('PROGRAMA', 1);
define('COPIAS', 1);
define('DEVELOP', '0' ); // 0- nadie, 1 - por ip, ALL - todos
/*
 * ESTADOS DE PESQUIZAS
 */
define('PESQUIZA_PENDINETE',  0);
define('PESQUIZA_REALIZADA',  1);
define('PESQUIZA_FINALIZADA', 2);
define('PESQUIZA_CARTAS',     3);
define('PESQUIZA_TURNOS',     4);
define('PESQUIZA_TERMINADA',  5);

/* End of file constants.php */
/* Location: ./application/config/constants.php */
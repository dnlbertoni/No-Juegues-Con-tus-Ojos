<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$IPDEBUG=array('192.168.1.2','192.168.1.3');
$bas3=(in_array($_SERVER['REMOTE_ADDR'],$IPDEBUG) && (DEVELOP == 1))?'debug':'default';
$bas3=( DEVELOP === "ALL")?'debug':$bas3;

$active_group = $bas3;
$active_record = TRUE;

$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'sistemas';
$db['default']['password'] = '';
$db['default']['database'] = 'okulo';
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


$db['debug']['hostname'] = 'localhost';
$db['debug']['username'] = 'sistemas';
$db['debug']['password'] = '';
$db['debug']['database'] = 'okulo_2012';
$db['debug']['dbdriver'] = 'mysql';
$db['debug']['dbprefix'] = '';
$db['debug']['pconnect'] = TRUE;
$db['debug']['db_debug'] = TRUE;
$db['debug']['cache_on'] = FALSE;
$db['debug']['cachedir'] = '';
$db['debug']['char_set'] = 'utf8';
$db['debug']['dbcollat'] = 'utf8_general_ci';
$db['debug']['swap_pre'] = '';
$db['debug']['autoinit'] = TRUE;
$db['debug']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */

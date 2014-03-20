<?php
use \R as R;

//Define a PATH to the plugin as a CONSTANT - for example:
define('PATH_TO_PLUGIN','../../plugins/CUBRID/'); //put your path to your plugin writer here!

//Load the CUBRID query writer
require(PATH_TO_PLUGIN .'CUBRID.php');
require(PATH_TO_PLUGIN .'testing/CUBRID.php');

//Define a hook path
$hookPath = PATH_TO_PLUGIN . 'testing/';

//Define extra test packages from the hook
$extraTestsFromHook = array(
	'CUBRID/Setget',
	'CUBRID/Writer' 
);

//Create a connection for this database
$ini['CUBRID'] = array(
	'host'	=> 'localhost',
	'schema' => 'oodb',
	'user'	=> 'dba',
	'pass'	=> ''
);

$colorMap[ 'CUBRID' ] = '0;35';

$dsn = "cubrid:host={$ini['CUBRID']['host']};port=33000;dbname={$ini['CUBRID']['schema']}";
R::addDatabase( 'CUBRID', $dsn, $ini['CUBRID']['user'], $ini['CUBRID']['pass'], FALSE );
R::selectDatabase( 'CUBRID' );
R::exec( 'AUTOCOMMIT IS ON' );

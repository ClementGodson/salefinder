<?php
mb_internal_encoding('utf-8');

//set session expire on inactivity after 30 minutes.
if (isset($_SESSION['LAST_ACTIVITY']) 
    && (time() - $_SESSION['LAST_ACTIVITY'] > 300)) {
        
        session_unset();     // unset $_SESSION variable for the run-time 
        session_destroy();   // destroy session data in storage
    }
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp


function autoloadFunction($class){
	if(preg_match('/Controller$/',$class))
		require('controllers/'.$class.'.php');
	else
		require('models/'.$class.'.php');
}	

spl_autoload_register('autoloadFunction');

Db::connect('localhost','root','','salefinder');

$router = new RouterController();
$router->process(array($_SERVER['REQUEST_URI']));
$router->renderView();
?>

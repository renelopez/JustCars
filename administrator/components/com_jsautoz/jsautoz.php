<?php
/**
 * @Copyright Copyright (C) 2012 ... Ahmad Bilal
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , ahmad@burujsolutions.com
 * Created on:	April 05, 2012
 ^
 + Project: 		JS Autoz
 ^ 
*/

defined('_JEXEC') or die('Restricted access');

/*
 * Require our default controller - used if 'c' is not assigned
 * - c is the controller to use (should probably rename to 'controller')
 */
require_once (JPATH_COMPONENT . '/controller.php');

/*
 * Checking if a controller was set, if so let's included it
 */
if ($c = JRequest :: getCmd('c', 'jsautoz'))
{
	$path = JPATH_COMPONENT . '/controllers/' . $c . '.php';
	//echo 'Path'.$path;
	jimport('joomla.filesystem.file');
	/*
	 * Checking if the file exists and including it if it does
	 */
	if (JFile :: exists($path))
	{
		require_once ($path);
	}
	else
	{
		JError :: raiseError('500', JText :: _('Unknown controller: <br>' . $c . ':' . $path));
	}
}

/*
 * Define the name of the controller class we're going to use
 * Instantiate a new instance of the controller class
 * Execute the task being called (default to 'display')
 * If it's set, redirect to the URI
 */
$c = 'JSAutozControllerJsautoz';
$controller = new $c ();
$controller->execute(JRequest :: getCmd('task', 'display'));
$controller->redirect();
?>

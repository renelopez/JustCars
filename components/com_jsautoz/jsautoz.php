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

// requires the default controller 
require_once (JPATH_COMPONENT . '/controller.php');
if ($c = JRequest :: getCmd('c', 'jsautoz')){
    //$c = JRequest :: getVar('c', 'jsautoz');
	$path = JPATH_COMPONENT . '/controllers/'  . $c . '.php';
	jimport('joomla.filesystem.file');

	if (JFile :: exists($path))
	{
		require_once ($path);
	}
	else
	{
		JError :: raiseError('500', JText :: _('Unknown controller: <br>' . $c . ':' . $path));
	}
}
if($c=='sphone')$c = 'JSAutozControllerSphone';
else
    $c = 'JSAutozControllerJsautoz';
$controller = new $c ();
$controller->execute(JRequest :: getCmd('task', 'display'));
$controller->redirect();
?>

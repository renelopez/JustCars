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

// our table class for the application data
class Tablevehicleimages extends JTable
{
/** @var int Primary key */
	var $id=null;
	var $vehicleid=null;
	var $filename=null;
	var $created=null;
	var $status=null;
	var $isdefault=0;
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_vehicleimages', 'id' , $db );
	}
	
	/** 
	 * Validation
	 * 
	 * @return boolean True if buffer is valid
	 * 
	 */
	 function check()
	 {
	 	return true;
	 }
	 	 
}

?>

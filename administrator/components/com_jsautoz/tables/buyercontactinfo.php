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
class Tablebuyercontactinfo extends JTable
{
	var $id=null;
	var $uid=null;
	var $vehicleid=null;
	var $buyername=null;
	var $buyercell=null;
	var $buyerphone=null;
	var $buyeremail=null;
	var $subject=null;
	var $description=null;
	var $status=null;
	var $created=null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_vehicle_buyer_contact', 'id' , $db );
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

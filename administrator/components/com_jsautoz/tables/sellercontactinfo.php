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
class Tablesellercontactinfo extends JTable
{
	var $id=null;
	var $uid=null;
	var $vehicleid=null;
	var $name=null;
	var $cell=null;
	var $phone=null;
	var $email=null;
	var $status=null;
	var $created=null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_seller_contact_info', 'id' , $db );
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

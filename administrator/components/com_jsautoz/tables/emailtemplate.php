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

class TableEmailTemplate extends JTable
{

	var $id=null;
	var $uid=null;
	var $templatefor=null;
	var $title=null;
	var $subject=null;
	var $body=null;
	var $created=null;
	var $status=null;

	
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_emailtemplates', 'id' , $db );
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

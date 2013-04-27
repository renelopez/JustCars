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

class TableUserFieldValue extends JTable
{
	var $id=null;
	var $field=null;
	var $fieldtitle=null;
	var $fieldvalue=null;
	var $ordering=null;
	var $sys=null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_userfieldvalues', 'id' , $db );
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

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


class TableUserField extends JTable
{
	var $id=null;
	var $name=null;
	var $title=null;
	var $description=null;
	var $type=null;
	var $maxlength=null;
	var $size=null;
	var $required=null;
	var $ordering=null;
	var $cols=null;
	var $rows=null;
	var $value=null;
	var $default=null;
	var $published=null;
	var $fieldfor=null;
	var $readonly=null;
	var $calculated=null;
	var $sys=null;
	var $params=null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_userfields', 'id' , $db );
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

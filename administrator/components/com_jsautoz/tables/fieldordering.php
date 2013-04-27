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
class TableFieldOrdering extends JTable
{
	var $id=null;
	var $field=null;
	var $fieldtitle=null;
	var $ordering=null;
	var $section=null;
	var $fieldfor=null;
	var $published=null;
	var $sys=null;
	var $cannotunpublished=null;
	var $required=null;
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_fieldordering', 'id' , $db );
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

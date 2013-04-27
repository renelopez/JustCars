<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class TTools {
	
	/**
	 * This function will redirect the current page to the joomla login page
	 * @param URL $returnurl, after login redirect to this url
	 */
	static function redirectToLogin($returnurl="") {
		$app = JFactory::getApplication();
		$returnurl = base64_encode(TRoute::_($returnurl,false));
		if(version_compare(JVERSION,'1.6.0','>=')){
			//joomla 1.6 format
			$app->redirect( "index.php?option=com_users&view=login&return=$returnurl","");
		} else {
			//joomla 1.5 format
			$app->redirect( "index.php?option=com_user&view=login&return=$returnurl","");
		}
	}
	
    static function print_popup($url)
	{
		$url .= '&tmpl=component&print=1';
	
		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no';
	
		// checks template image directory for image, if non found default are loaded
		$text = JHtml::_('image', 'system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
	
		$attribs['title']	= JText::_('JGLOBAL_PRINT');
		$attribs['onclick'] = "window.open(this.href,'win2','".$status."'); return false;";
		$attribs['rel']		= 'nofollow';
	
		return JHtml::_('link', JRoute::_($url), $text, $attribs);
	}
	
	static function print_screen()
	{
		// checks template image directory for image, if non found default are loaded
		$text = JHtml::_('image', 'system/printButton.png', JText::_('JGLOBAL_PRINT'), NULL, true);
		return '<a href="#" onclick="window.print();return false;">'.$text.'</a><script>jQ(function() {window.print();});</script>';
	}
    
	static function getCatImageUrl($catid,$thumb=false) {
		$extensions = array("jpg","png","gif");
		$image_name = ($thumb == true) ? "cat_t":"cat";
		
		foreach($extensions as $ext) {
			if (file_exists(JPATH_ROOT."/images/com_adsmanager/categories/".$catid."$image_name.$ext"))
				return JURI::root()."images/com_adsmanager/categories/".$catid."$image_name.$ext";
		}
		return JURI::root().'components/com_adsmanager/images/default.gif';
	}
}
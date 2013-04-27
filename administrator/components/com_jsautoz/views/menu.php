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

if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );

global $mainframe;
	$document =& JFactory::getDocument();
	$document->addStyleSheet('components/com_jsautoz/include/admin_menu/sdmenu/sdmenu.css');
	$document->addScript( 'components/com_jsautoz/include/admin_menu/sdmenu/sdmenu.js' );

?>


	<script type="text/javascript">
	// <![CDATA[
	var myMenu;
	window.onload = function() {
		myMenu = new SDMenu("my_menu");
		myMenu.oneSmOnly = true;  // One expanded submenu at a time
		myMenu.init();
	};
	// ]]>
	</script>

    <div>
		<img src="components/com_jsautoz/include/images/jsautoz.png" width="175">
	</div>
	<div style="float: left" id="my_menu" class="sdmenu">
      <div class="collapsed">
        <span><?php echo JText::_('ADMIN'); ?></span>
		<a href="index.php?option=com_jsautoz&view=vehicles&layout=controlpanel"><?php echo JText::_('CONTROL_PANEL'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=vehicletypes"><?php echo JText::_('VEHICLE_TYPES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=fueltypes"><?php echo JText::_('FUEL_TYPES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=mileagetypes"><?php echo JText::_('MILEAGE_TYPES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=modelyears"><?php echo JText::_('MODEL_YEARS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=transmissions"><?php echo JText::_('TRANSMISSIONS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=adexpiries"><?php echo JText::_('AD-EXPIRY'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=cylinders"><?php echo JText::_('CYLINDERS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=conditions"><?php echo JText::_('CONDITIONS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=categories"><?php echo JText::_('CATEGORIES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=currency"><?php echo JText::_('CURRENCIES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=updateactivate"><?php echo JText::_('UPDATE_ACTIVATE'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=info"><?php echo JText::_('INFORMATION'); ?></a>
	  </div>
      <div class="collapsed">
        <span><?php echo JText::_('CONFIGURATIONS');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=configurations"><?php echo JText::_('CONFIGURATIONS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=themes"><?php echo JText::_('THEMES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('PAYMENT_METHODS'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('MAKES_BY_MODELS');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=makes"><?php echo JText::_('MAKES'); ?></a>
        
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('VEHICLES');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=vehicles"><?php echo JText::_('VEHICLES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=vehiclequeue"><?php echo JText::_('VEHICLE_APPROVAL_QUEUE'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=vehiclesearch"><?php echo JText::_('VEHICLE_SEARCH'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('GOLD_VEHICLES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('FEATURED_VEHICLES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=userfields&ff=1"><?php echo JText::_('CUSTOM_FIELDS'); ?></a>
		<a href="index.php?option=com_jsautoz&view=vehicle&layout=formvehicleuserfield"><?php echo JText::_('OPTION_CUSTOM_FIELDS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=fieldsordering&ff=1"><?php echo JText::_('VEHICLE_FIELDS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=fieldsordering&ff=2"><?php echo JText::_('OPTIONS_FIELDS'); ?></a>
	  </div>
      <div class="collapsed">
        <span><?php echo JText::_('PACKAGES');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('SELLER_PACKAGE'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('APPROVAL_QUEUE'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('PAYMENTS');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('PAYMENT_HISTORY'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('PAYMENT_REPORT'); ?></a>
	  </div>
      <div class="collapsed">
        <span><?php echo JText::_('RANK_AND_REVIEW');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('REVIEW'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('REVIEW_APPROVAL_QUEUE'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('MESSAGES');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('MESSAGES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('MESSAGES_APPROVAL_QUEUE'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('DEALERS');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('DEALERS'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=business_version"><?php echo JText::_('DEALERS_APPORVAL_QUEUE'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('EMAIL_TEMPLATES');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=ew-vh"><?php echo JText::_('NEW_VEHICLE'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=vs-vh"><?php echo JText::_('NEW_VEHICLE_VISITOR'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=ew-rv"><?php echo JText::_('VEHICLE_REVIEW'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=sl-rv"><?php echo JText::_('SELLER_VEHICLE_REVIEW'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=vh-ap"><?php echo JText::_('VEHICLE_APPROVAL'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=vh-rj"><?php echo JText::_('VEHICLE_REJECTING'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=pk-by"><?php echo JText::_('PACKAGE_PURCHASE'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=pk-ap"><?php echo JText::_('PAYMENT_APPROVAL'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=by-sl"><?php echo JText::_('BUYER_CONTACT_SELLER'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=ms-bs"><?php echo JText::_('MESSAGE_BUYER_TO_SELLER'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=ms-sb"><?php echo JText::_('MESSAGE_SELLER_TO_BUYER'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=tl-fr"><?php echo JText::_('TELL_A_FRIEND'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=vh-al"><?php echo JText::_('VEHICLE_ALERT_SUBSCRIBER'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf=dl-ap"><?php echo JText::_('DEALER_APPROVAL'); ?></a>
      </div>
      <div class="collapsed">
        <span><?php echo JText::_('COUNTRIES');?></span>
		<a href="index.php?option=com_jsautoz&task=view&layout=countries"><?php echo JText::_('COUNTRIES'); ?></a>
		<a href="index.php?option=com_jsautoz&task=view&layout=loadaddressdata"><?php echo JText::_('LOAD_ADDRESS_DATA'); ?></a>
      </div>
    </div>



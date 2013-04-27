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
$document =& JFactory::getDocument();
$document->addScript('components/com_jsautoz/include/js/jquery.js');
$document->addScript('components/com_jsautoz/include/js/jquery_idTabs.js');
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
global $mainframe;
$ADMINPATH = JPATH_BASE .'\components\com_jsautoz';
$showhide = array(
	'0' => array('value' => 1,'text' => JText::_('Show')),
	'1' => array('value' => 0, 'text' => JText::_('Hide')),);

$defaultradius = array(
	'0' => array('value' => "m",'text' => JText::_('METERS')),
	'1' => array('value' => "km", 'text' => JText::_('KILOMETERS')),
	'2' => array('value' => "mile", 'text' => JText::_('MILES')),
	'3' => array('value' => "nacmiles", 'text' => JText::_('NAUTICAL_MILES')),
        );
// new css 
$theme = array(
	'0' => array('value' => '/gray/css/jsautozgray.css','text' => JText::_('DEFAULT_THEME')),
	'1' => array('value' => 'jsautos02.css','text' => JText::_('VIOLET_THEME')),
	'2' => array('value' => 'jsautos03.css','text' => JText::_('PEACH_ORANGE_THEME')),
	'3' => array('value' => 'jsautos04.css','text' => JText::_('GRASS_THEME')),
    '4' => array('value' => 'jsautos05.css','text' => JText::_('PASTEL_PINK_THEME')),
	'5' => array('value' => 'jsautos06.css','text' => JText::_('BLACK_THEME')),
	'6' => array('value' => 'jsautos07.css','text' => JText::_('BLUE_THEME')),
    );

$themes = JHTML::_('select.genericList', $theme, 'theme', 'class="inputbox" '. '', 'value', 'text', $this->configs['theme']);

$date_format = array(
	'0' => array('value' => 'd-m-Y','text' => JText::_('DD_MM_YYYY')),
	'1' => array('value' => 'm-d-Y','text' => JText::_('MM_DD_YYYY')),
	'2' => array('value' => 'Y-m-d','text' => JText::_('YYYY_MM_DD')),);
$vehiclemakemodel = array(
	'0' => array('value' => 'mkmdcu','text' => JText::_('MAKE_WITH_MODEL_TOTAL')),
	'1' => array('value' => 'mk','text' => JText::_('MAKE')),
	'2' => array('value' => 'mkmd','text' => JText::_('MAKE_MODEL')),);
/*$joblistingstyle = array(
	'1' => array('value' => JText::_('classic'),'text' => JText::_('CLASSIC')),
	'2' => array('value' => JText::_('july2011'),'text' => JText::_('NEW')),);
$resumelistingstyle = array(
	'1' => array('value' => JText::_('classic'),'text' => JText::_('CLASSIC')),
	'2' => array('value' => JText::_('july2011'),'text' => JText::_('NEW')),);
*/
$yesno = array(
	'0' => array('value' => 1,'text' => JText::_('JS_YES')),
	'1' => array('value' => 0,'text' => JText::_('JS_NO')),);
$reviewstatus = array(
	'0' => array('value' => 1,'text' => JText::_('APPROVE')),
	'1' => array('value' => 0,'text' => JText::_('UNAPPROVE')),);

$yesnobackup = array(
	'0' => array('value' => 1,'text' => JText::_('YES_RECOMMENDED')),
	'1' => array('value' => 0,'text' => JText::_('NO')),);

$paymentmethodsarray = array(
	'0' => array('value' => 'paypal','text' => JText::_('PAYPAL')),
	'1' => array('value' => 'fastspring','text' => JText::_('FASTSPRING')),
	'2' => array('value' => 'authorizenet','text' => JText::_('AUTHORIZE_NET')),
	'3' => array('value' => '2checkout','text' => JText::_('2CHECKOUT')),
	'4' => array('value' => 'pagseguro','text' => JText::_('PAGSEGURO')),
	'5' => array('value' => 'other','text' => JText::_('OTHER')),
	'6' => array('value' => 'no','text' => JText::_('NOT_USE')),);


$offline = JHTML::_('select.genericList', $yesno, 'offline', 'class="inputbox" '. '', 'value', 'text', $this->config['offline']);
$backup = JHTML::_('select.genericList', $yesnobackup, 'backuponuninstall', 'class="inputbox" '. '', 'value', 'text', $this->config['backuponuninstall']);
$paymentmethods = JHTML::_('select.genericList', $paymentmethodsarray, 'payment_method', 'class="inputbox" '. 'onchange="paymentmethod_showhide()"', 'value', 'text', $this->configs['payment_method']);
$payment_showdescription = JHTML::_('select.genericList', $showhide, 'payment_showdescription', 'class="inputbox" '. '', 'value', 'text', $this->configs['payment_showdescription']);
$payment_showfooter = JHTML::_('select.genericList', $showhide, 'payment_showfooter', 'class="inputbox" '. '', 'value', 'text', $this->configs['payment_showfooter']);



$big_field_width = 40;
$med_field_width = 25;
$sml_field_width = 15;
?>
<style type="text/css">
div#map_container{
	z-index:1000;
	position:relative;
	background:#000;
	width:100%;
	height:100%;
/*	opacity:0.55;
	-moz-opacity:0.45;
	filter:alpha(opacity=45);*/
}
div#map{
	visibility:hidden;
	position:absolute;
	width:73%;
	height:60%;
	top:110%;
}
div#closetag a{
	color:red;
}
</style>

<table width="100%" >
	<tr>
		<td align="left" width="188"  valign="top">
			<table width="100%" style="table-layout:fixed;"><tr><td style="vertical-align:top;">
			<?php
			include_once('components/com_jsautoz/views/menu.php');
			?>
			</td>
			</tr></table>
		</td>
		<td width="789" valign="top" align="left">
			<?php $installation_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($this->config['installation_date'])) . " +30 days"));
					$curdate = date("Y-m-d");
			if($this->config['reviewed'] == 0 && ($installation_date <= $curdate || $this->noofvehicles > 10)){?>
				<div id="review_wrap">
					<a id="button" href="#" onclick="return markreview();"><?php echo JText::_('MAKE_A_REVIEW'); ?></a>
					<div id="review_text"><?php echo JText::_('IF_YOU_USE');?> <b><a id="no" href="#" onclick="return markreview();" title="<?php echo JText::_('REVIEW_AT_JED');?>">JS Autoz</a></b>, <?php echo JText::_('PLEASE_POST_A_RATING_AND_A_REVIEW_AT_JOOMLA_EXTENSIONS_DIRECTORY');?></div>
					<img id="review_img" src="components/com_jsautoz/include/images/review_image.png" alt="" />
				</div>
			<?php }?>

			<form action="index.php" method="POST" name="adminForm" id="adminForm">
						<div id="tabs_wrapper" class="tabs_wrapper">
							<div class="idTabs">
								<span><a class="selected" href="#site_setting"><?php echo JText::_('SITE_SETTINGS');?></a></span> 
								<span><a  href="#seller_setting"><?php echo JText::_('SELLER_SETTING');?></a></span> 
								<span><a  href="#buyer_setting"><?php echo JText::_('BUYER_SETTING');?></a></span> 
								<span><a  href="#dealer_setting"><?php echo JText::_('DEALER_SETTING');?></a></span> 
								<span><a  href="#visitor_setting"><?php echo JText::_('VISITOR_SETTING');?></a></span> 
								<span><a  href="#vehicle_search"><?php echo JText::_('VEHICLE_SEARCH_SETTINGS');?></a></span> 
								<span><a  href="#filter_setting"><?php echo JText::_('FILTER');?></a></span> 
								<span><a  href="#email_setting"><?php echo JText::_('EMAIL');?></a></span> 
								<span><a  href="#links_setting"><?php echo JText::_('LINKS');?></a></span> 
								<span><a  href="#rss_setting"><?php echo JText::_('RSS_SETTING');?></a></span> 
								<span><a  href="#google_setting"><?php echo JText::_('GOOGLE_ADSENSE');?></a></span> 
							</div>
							<div id="site_setting">
								<fieldset>
									<legend><?php echo JText::_('SITE_SETTINGS'); ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('TITLE'); ?></td>
											<td  width="25%"><input type="text" name="title" value="<?php echo $this->config['title']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
											<td  class="key"><?php echo JText::_('SEPERATE_NEW_AND_USED_VEHICLE'); ?></td>
																				<td ><?php echo JHTML::_('select.genericList', $yesno, 'seperate_new_and_used_vehicle', 'class="inputbox" '. '', 'value', 'text', $this->config['seperate_new_and_used_vehicle']);; ?></td>
										</tr>
										<tr>
											<td class="key" ><?php echo JText::_('OFFLINE'); ?></td>
											<td ><?php if ($this->config['zsat'] != '0') echo $offline; else echo '<a href="index.php?option=com_jsautoz&task=view&layout=updateactivate">'.JText::_('ACTIVATE_JSAUTOZ').'</a>';?></td>
											<td class="key" ><?php echo JText::_('OFFLINE_MESSAGE'); ?></td>
											<td><textarea name="offline_text" cols="25" rows="3" class="inputbox"><?php echo $this->config['offline_text']; ?></textarea> </td>
										</tr>
										<tr>
												<td  class="key"><?php echo JText::_('VEHICLE_MAKE_MODEL_STYLE'); ?></td>
												<td ><?php echo JHTML::_('select.genericList', $vehiclemakemodel, 'vehiclemakemodel', 'class="inputbox" '. '', 'value', 'text', $this->config['vehiclemakemodel']);; ?></td>
												<td  class="key" width="25%"></td>
												<td ></td>
										</tr>
										<tr >
											<td  class="key" width="25%"><?php echo JText::_('SHOW_VEHICLE_QUICK_LINKS'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'show_vehicle_quicklink', 'class="inputbox" '. '', 'value', 'text', $this->config['show_vehicle_quicklink']);; ?></td>
											<td class="key"></td>
											<td></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('PRICE_RANGE_START'); ?></td>
											<td  width="25%"><input type="text" name="pricerangestart" value="<?php echo $this->config['pricerangestart']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
											<td  class="key" width="25%"><?php echo JText::_('PRICE_RANGE_END'); ?></td>
											<td  width="25%"><input type="text" name="pricerangeend" value="<?php echo $this->config['pricerangeend']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('PRICE_GAP'); ?></td>
											<td  width="25%"><input type="text" name="pricegap" value="<?php echo $this->config['pricegap']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
											<td  class="key" width="25%"><?php echo JText::_('MAXIMUM_IMAGE_PER_VEHICLE'); ?></td>
											<td  width="25%"><input type="text" name="maximageperveh" value="<?php echo $this->config['maximageperveh']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('MAXIMUM_GOLD_VEHICLES_IN_VEHICLES_LISTING'); ?></td>
											<td  width="25%"><input type="text" name="show_maximum_gold_vehicles_on_vehicles_listing" value="<?php echo $this->config['show_maximum_gold_vehicles_on_vehicles_listing']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
											<td  class="key" width="25%"><?php echo JText::_('MAXIMUM_FEATURED_VEHICLES_IN_VEHICLES_LISTING'); ?></td>
											<td  width="25%"><input type="text" name="show_maximum_featured_vehicles_on_vehicles_listing" value="<?php echo $this->config['show_maximum_featured_vehicles_on_vehicles_listing']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('SHOW_SOLD_VEHICLES'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'show_sold_vehicles', 'class="inputbox" '. '', 'value', 'text', $this->config['show_sold_vehicles']);; ?></td>
																				<td class="key"><?php echo JText::_('DEFAULT_COUNTRY'); ?></td>
																				<td><?php echo $this->lists['defaultcountry']; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('CAPTCHA'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $showhide, 'captcha', 'class="inputbox" '. '', 'value', 'text', $this->config['captcha']);; ?></td>
																				<td width="20%"><?php echo JText::_('MAP_DEFAULT_COORDINATES');?></td>
																				<td width="30%">
																				<a href="Javascript: showdiv();loadMap();"><?php echo JText::_('SHOW_MAP');?></a>
																				<br/><input type="text" id="default_longitude" name="default_longitude" value="<?php echo $this->config['default_longitude'];?>"/><br/><?php echo JText::_('LONGITUDE');?>
																				<br/><input type="text" id="default_latitude" name="default_latitude" value="<?php echo $this->config['default_latitude'];?>"/><br/><?php echo JText::_('LATITUDE');?>
																				</td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('DEFAULT_RADIUS'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $defaultradius, 'default_radius', 'class="inputbox" '. '', 'value', 'text', $this->config['default_radius']);; ?></td>
										</tr>
									</table>
								</fieldset>
									<div id="map"><div id="closetag"><a href="Javascript: hidediv();"><?php echo JText::_('CLOSE_MAP');?></a></div><div id="map_container"></div></div>
							</div>
							<div id="seller_setting">
								<fieldset>
									<legend><?php echo JText::_('SELLER_SETTING');?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
												<td  class="key" width="25%"><?php echo JText::_('NEW_LISTING_PACKAGE_REQUIRED'); ?></td>
												<td ><?php echo JHTML::_('select.genericList', $yesno, 'newlisting_requiredpackage', 'class="inputbox" '. '', 'value', 'text', $this->config['newlisting_requiredpackage']);; ?></td>
												<td  class="key" width="25%"><?php echo JText::_('NEW_LISTING_REQUIRED_LOGIN'); ?></td>
												<td ><?php echo JHTML::_('select.genericList', $yesno, 'newlisting_requiredlogin', 'class="inputbox" '. '', 'value', 'text', $this->config['newlisting_requiredlogin']);; ?></td>
										</tr>
										<tr>
												<td  class="key" width="25%"><?php echo JText::_('VEHICLE_AUTO_APPROVE'); ?></td>
												<td ><?php echo JHTML::_('select.genericList', $yesno, 'vehicle_auto_approve', 'class="inputbox" '. '', 'value', 'text', $this->config['vehicle_auto_approve']);; ?></td>
												<td  class="key" width="25%"></td>
												<td ></td>
										</tr>

									</table>
								</fieldset>
							</div>
							<div id="buyer_setting">
								<fieldset>
									<legend><?php echo JText::_('BUYER_SETTING');?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('NEW_LISTING_REQUIRED_LOGIN'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'buyer_newlisting_requiredlogin', 'class="inputbox" '. '', 'value', 'text', $this->config['buyer_newlisting_requiredlogin']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('ADD_MAXIMUN_VEHICLE_TO_SHORT_LIST'); ?></td>
											<td  width="25%"><input type="text" name="max_vehicle_short_list" value="<?php echo $this->config['max_vehicle_short_list']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('BUYER_CAN_CONTACT_SELLER'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'buyer_can_contact_seller', 'class="inputbox" '. '', 'value', 'text', $this->config['buyer_can_contact_seller']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('BUYER_CAN_CONTACT_SELLER_LOGIN'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'buyer_contact_seller_must_login', 'class="inputbox" '. '', 'value', 'text', $this->config['buyer_contact_seller_must_login']);; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('VEHICLE_ALERT_FOR_VISITOR'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'vehicle_alert_visitor', 'class="inputbox" '. '', 'value', 'text', $this->config['vehicle_alert_visitor']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('REVIEW_AUTO_APPROVE'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'review_status', 'class="inputbox" '. '', 'value', 'text', $this->config['review_status']);; ?></td>
										</tr>
									</table>
								</fieldset>
							</div>
							<div id="dealer_setting">
								<fieldset>
									<legend><?php echo JText::_('DEALER_SETTING');?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('DEALER_CAN_POST_VEHICLE_WITHOUT_PACKAGE'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'deller_can_post_vehicle_without_package', 'class="inputbox" '. '', 'value', 'text', $this->config['deller_can_post_vehicle_without_package']);; ?></td>
											<td  class="key" width="25%"></td>
											<td ></td>
										</tr>
									</table>
								</fieldset>
							</div>
							<div id="visitor_setting">
								<fieldset>
								<legend><?php echo JText::_('VISITOR_SETTING'); ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('VISITOR_CAN_EDIT_VEHICLE'); ?></td>
											<td ><?php echo JHTML::_('select.genericList', $yesno, 'visitor_can_edit_vehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['visitor_can_edit_vehicle']);; ?></td>
											<td  class="key" width="25%"></td>
											<td ></td>
										</tr>
									</table>
								</fieldset>
							</div>
							<div id="vehicle_search">
								<fieldset>
									<legend><?php echo JText::_('VEHICLE_SEARCH_SETTINGS'); ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
											<tr>
												<td class="key" width="25%"><?php echo JText::_('TITLE'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchtitle', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchtitle']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('VEHICLE_TYPE'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchvehicletype', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchvehicletype']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('MAKES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchmake', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchmake']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('MODELS'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchmodel', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchmodel']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('MODELYEAR'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchmodelyear', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchmodelyear']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('FUELTYPES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchfueltype', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchfueltype']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('CYLINDERS'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchcylinder', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchcylinder']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('PRICE'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchprice', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchprice']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('EXTERIORCOLOR'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchexteriorcolor', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchexteriorcolor']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('REGISTRATION_NUMBER'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchregistrationnumber', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchregistrationnumber']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('ENGINE_CAPACITY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchenginecapacity', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchenginecapacity']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('CONDITON'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchcondition', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchcondition']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('REG_COUNTRY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchregcountry', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchregcountry']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('REG_STATE'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchregstate', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchregstate']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('REG_COUNTY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchregcounty', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchregcounty']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('REG_CITY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchregcity', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchregcity']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('LOC_COUNTRY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchloccountry', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchloccountry']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('LOC_STATE'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchlocstate', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchlocstate']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('LOC_COUNTY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchloccounty', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchloccounty']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('LOC_CITY'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchloccity', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchloccity']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('LOC_ZIP'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchloczip', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchloczip']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('RADIUS_SEARCH_ON_ZIP'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchradius', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchradius']);; ?></td>
											</tr>
											<tr>
												<td class="key" width="25%"><?php echo JText::_('MILEAGES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchmileages', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchmileages']);; ?></td>
												<td class="key" width="25%"><?php echo JText::_('MAP'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchmap', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchmap']);; ?></td>
											</tr>
									</table>
								</fieldset>
							</div>
							<div id="filter_setting">
								<fieldset>
								<legend><?php echo JText::_('FILTER_SETTING'); ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('FILTER'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vehiclefilter', 'class="inputbox" '. '', 'value', 'text', $this->configs['vehiclefilter']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('CONDITION'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtercondition', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtercondition']);; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('MODEL'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtermodel', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtermodel']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('MAKE'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtermake', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtermake']);; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('COUNTRY'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtercountry', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtercountry']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('STATE'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filterstate', 'class="inputbox" '. '', 'value', 'text', $this->configs['filterstate']);; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('COUNTY'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtercounty', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtercounty']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('CITY'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtercity', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtercity']);; ?></td>
										</tr>
										<tr>
											<td  class="key" width="25%"><?php echo JText::_('MODEL_YEAR'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtermodelyear', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtermodelyear']);; ?></td>
											<td  class="key" width="25%"><?php echo JText::_('MAP'); ?></td>
																			<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'filtermap', 'class="inputbox" '. '', 'value', 'text', $this->configs['filtermap']);; ?></td>
										</tr>
									</table>
								</fieldset>
							</div>
							<div id="email_setting">
								<fieldset>
								<legend><?php echo JText::_('EMAIL_SETTINGS'); ?></legend>
								<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
									<tr >
										<td class="key" width="25%"><?php echo JText::_('MAIL_FROM_ADDRESS'); ?></td>
										<td width="25%"><input type="text" name="mailfromaddress" value="<?php echo $this->configs['mailfromaddress']; ?>" class="inputbox" size="<?php echo $big_field_width;?>"/> </td>
										<td width="25%" class="key"><?php echo JText::_('EMAIL_ADMIN_NEW_VEHICLE'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'new_vehicle_admin', 'class="inputbox" '. '', 'value', 'text', $this->configs['new_vehicle_admin']);; ?></td>
									</tr>
									<tr >
										<td class="key"><?php echo JText::_('MAIL_ADMIN_ADDRESS'); ?></td>
										<td><input type="text" name="adminemailaddress" value="<?php echo $this->configs['adminemailaddress']; ?>" class="inputbox" size="<?php echo $med_field_width;?>" /> </td>
										<td class="key"><?php echo JText::_('EMAIL_VISITOR_NEW_VEHICLE'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'new_vehicle_visitor', 'class="inputbox" '. '', 'value', 'text', $this->configs['new_vehicle_visitor']);; ?></td>
									</tr>
									<tr>
										<td class="key"><?php echo JText::_('MAIL_FROM_NAME'); ?></td>
										<td><input type="text" name="mailfromname" value="<?php echo $this->configs['mailfromname']; ?>" class="inputbox" size="<?php echo $med_field_width;?>" /> </td>
										<td class="key"><?php echo JText::_('EMAIL_ADMIN_VEHICLE_REVIEW'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'vehicle_review_admin', 'class="inputbox" '. '', 'value', 'text', $this->configs['vehicle_review_admin']);; ?></td>
									</tr>
									<tr>
										<td class="key"><?php echo JText::_('EMAIL_SELLER_VEHICLE_REVIEW'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'vehicle_review_seller', 'class="inputbox" '. '', 'value', 'text', $this->configs['vehicle_review_seller']);; ?></td>
										<td class="key"><?php echo JText::_('EMAIL_SELLER_PAYMENT_APPROVE'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'seller_payment_approve', 'class="inputbox" '. '', 'value', 'text', $this->configs['seller_payment_approve']);; ?></td>
									</tr>
									<tr>
										<td class="key"><?php echo JText::_('EMAIL_ADMIN_PACKAGE_PURCHASE'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'admin_package_purchase', 'class="inputbox" '. '', 'value', 'text', $this->configs['admin_package_purchase']);; ?></td>
										<td class="key"><?php echo JText::_('EMAIL_SELLER_VEHICLE_APPROVE'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'seller_vehicle_approve', 'class="inputbox" '. '', 'value', 'text', $this->configs['seller_vehicle_approve']);; ?></td>
									</tr>
									<tr>
										<td class="key"><?php echo JText::_('EMAIL_SELLER_VEHICLE_REJECTED'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'seller_vehicle_rejected', 'class="inputbox" '. '', 'value', 'text', $this->configs['seller_vehicle_rejected']);; ?></td>
										<td class="key"><?php echo JText::_('EMAIL_SELLER_BUYER_CONTACT_TO_SELLER'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'seller_buyer_contact_to_seller', 'class="inputbox" '. '', 'value', 'text', $this->configs['seller_buyer_contact_to_seller']);; ?></td>
									</tr>
									<tr>
										<td class="key"><?php echo JText::_('CRON_JOB_ALERT_TO_ADMIN'); ?></td>
										<td ><?php echo JHTML::_('select.genericList', $yesno, 'cron_job_alert_admin', 'class="inputbox" '. '', 'value', 'text', $this->configs['cron_job_alert_admin']);; ?></td>
									</tr>
								</table>
								</fieldset>
							</div>
							<div id="links_setting">
								<fieldset>
									<legend><?php echo JText::_('SELLER_CONTROL_PANEL_LINKS') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('NEW_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'formnewvehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['formnewvehicle']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('USED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'formusedvehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['formusedvehicle']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('MY_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'myvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['myvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('PACKAGES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'packages', 'class="inputbox" '. '', 'value', 'text', $this->configs['packages']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('PURCHASE_HISTORY'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'purchasehistory', 'class="inputbox" '. '', 'value', 'text', $this->configs['purchasehistory']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('MYSTATS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'mystats', 'class="inputbox" '. '', 'value', 'text', $this->configs['mystats']);; ?></td>
										 </tr>
										<tr >
											 <td  width="25%" class="key"><?php echo JText::_('MESSAGES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'messages', 'class="inputbox" '. '', 'value', 'text', $this->configs['messages']);; ?></td>
											 <td  width="25%" class="key"></td>
											 <td  width="25%"></td>
										 </tr>
									</table>
								</fieldset>
								<fieldset>
									<legend><?php echo JText::_('VISITOR_SELLER_CONTROL_PANEL_LINKS') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('NEW_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vformnewvehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['vformnewvehicle']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('USED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vformusedvehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['vformusedvehicle']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('MY_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vmyvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vmyvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('PACKAGES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vpackages', 'class="inputbox" '. '', 'value', 'text', $this->configs['vpackages']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('PURCHASE_HISTORY'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vpurchasehistory', 'class="inputbox" '. '', 'value', 'text', $this->configs['vpurchasehistory']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('MYSTATS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vmystats', 'class="inputbox" '. '', 'value', 'text', $this->configs['vmystats']);; ?></td>
										 </tr>
										<tr >
											 <td  width="25%" class="key"><?php echo JText::_('MESSAGES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vmessages', 'class="inputbox" '. '', 'value', 'text', $this->configs['vmessages']);; ?></td>
											 <td  width="25%" class="key"></td>
											 <td  width="25%"></td>
										 </tr>
									</table>
								</fieldset>
								<fieldset>
									<legend><?php echo JText::_('BUYER_CONTROL_PANEL_LINKS') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('NEW_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bformnewvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bformnewvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('USED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bformusedvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bformusedvehicles']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('SEARCH_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bsearchvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bsearchvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('NEW_VEHICLES_BY_MAKE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bnvehiclebymakes', 'class="inputbox" '. '', 'value', 'text', $this->configs['bnvehiclebymakes']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('USED_VEHICLES_BY_MAKE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'buvehiclebymakes', 'class="inputbox" '. '', 'value', 'text', $this->configs['buvehiclebymakes']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_CITY'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bvehiclebycity', 'class="inputbox" '. '', 'value', 'text', $this->configs['bvehiclebycity']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('VEHICLES_BY_PRICE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bvehiclebyprice', 'class="inputbox" '. '', 'value', 'text', $this->configs['bvehiclebyprice']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_MODEL_YEARS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bvehiclebymodelyears', 'class="inputbox" '. '', 'value', 'text', $this->configs['bvehiclebymodelyears']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('GOLD_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bgoldvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bgoldvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('FEATURED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bfeaturedvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bfeaturedvehicles']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('SHORT_LIST_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bshortlistvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['bshortlistvehicles']);; ?></td>
											 <td class="key" width="25%"><?php echo JText::_('DEALERS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bdealers', 'class="inputbox" '. '', 'value', 'text', $this->configs['bdealers']);; ?></td>
										 </tr>
										<tr >
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_ALERTS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bvehiclealerts', 'class="inputbox" '. '', 'value', 'text', $this->configs['bvehiclealerts']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('COMPARE_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bcomparevehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['bcomparevehicle']);; ?></td>
										 </tr>
										<tr >
											 <td  width="25%" class="key"><?php echo JText::_('MESSAGES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bmessages', 'class="inputbox" '. '', 'value', 'text', $this->configs['bmessages']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_TYPE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'bvehiclebytypes', 'class="inputbox" '. '', 'value', 'text', $this->configs['bvehiclebytypes']);; ?></td>
										 </tr>
									</table>
								</fieldset>
								<fieldset>
									<legend><?php echo JText::_('VISITOR_BUYER_CONTROL_PANEL_LINKS') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" >
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('NEW_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbformnewvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbformnewvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('USED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbformusedvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbformusedvehicles']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('SEARCH_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbsearchvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbsearchvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('NEW_VEHICLES_BY_MAKE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbnvehiclebymakes', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbnvehiclebymakes']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('USED_VEHICLES_BY_MAKE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbuvehiclebymakes', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbuvehiclebymakes']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_CITY'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbvehiclebycity', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbvehiclebycity']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('VEHICLES_BY_PRICE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbvehiclebyprice', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbvehiclebyprice']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_MODEL_YEARS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbvehiclebymodelyears', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbvehiclebymodelyears']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('GOLD_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbgoldvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbgoldvehicles']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('FEATURED_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbfeaturedvehicles', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbfeaturedvehicles']);; ?></td>
										 </tr>
										<tr >
											 <td class="key" width="25%"><?php echo JText::_('DEALERS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbdealers', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbdealers']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_ALERTS'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbvehiclealerts', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbvehiclealerts']);; ?></td>
										 </tr>
										<tr >
											 <td  width="25%" class="key"><?php echo JText::_('COMPARE_VEHICLES'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbcomparevehicle', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbcomparevehicle']);; ?></td>
											 <td  width="25%" class="key"><?php echo JText::_('VEHICLES_BY_TYPE'); ?></td>
											 <td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'vbvehiclebytypes', 'class="inputbox" '. '', 'value', 'text', $this->configs['vbvehiclebytypes']);; ?></td>
										 </tr>
									</table>
								</fieldset>
							</div>
							<div id="rss_setting">
								<fieldset>
									<legend><?php echo JText::_('RSS_SETTING');?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" id="jobsrss">
										<tr>
											<td  width="25%" class="key"><?php echo JText::_('SHOW_RSS_FEED'); ?></td>
											<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'showrssfeeding', 'class="inputbox" '. '', 'value', 'text', $this->configs['showrssfeeding']);; ?></td>
											<td width="25%" class="key"><?php echo JText::_('TITLE'); ?></td>
											<td  ><input type="text" name="rss_vehicle_title" value="<?php echo $this->configs['rss_vehicle_title']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('MUST_PROVIDE_TITLE_FOR_VEHICLE_FEED');?></small></td>
										</tr>
										<tr>
											<td width="25%" class="key"><?php echo JText::_('DESCRIPTION'); ?></td>
											<td><textarea name="rss_vehicle_description" cols="25" rows="3" class="inputbox"><?php echo $this->configs['rss_vehicle_description']; ?></textarea><br clear="all">
											<small><?php echo JText::_('MUST_PROVIDE_DESCRIPTION_FOR_VEHICLE_FEED');?></small></td>
											<td width="25%" class="key"><?php echo JText::_('COPYRIGHT'); ?></td>
											<td  ><input type="text" name="rss_vehicle_copyright" value="<?php echo $this->configs['rss_vehicle_copyright']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('LEAVE_BLANK_IF_NOT_SHOW');?></small></td>
										</tr>
										<tr>
											<td width="25%" class="key"><?php echo JText::_('WEBMASTER'); ?></td>
											<td  ><input type="text" name="rss_vehicle_webmaster" value="<?php echo $this->configs['rss_vehicle_webmaster']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('LEAVE_BLANK_IF_NOT_SHOW_WEBMASTER_USED_FOR_TECHNICAL_ISSUE');?></small></td>
											<td width="25%" class="key"><?php echo JText::_('EDITOR'); ?></td>
											<td  ><input type="text" name="rss_vehicle_editor" value="<?php echo $this->configs['rss_vehicle_editor']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('LEAVE_BLANK_IF_NOT_SHOW_EDITOR_USED_FOR_FEED_CONTENT_ISSUE');?></small></td>
										</tr>
										<tr>
											<td width="25%" class="key"><?php echo JText::_('TIME_TO_LIVE'); ?></td>
											<td  ><input type="text" name="rss_vehicle_ttl" value="<?php echo $this->configs['rss_vehicle_ttl']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('TIME_TO_LIVE_FOR_VEHICLE_FEED');?></small></td>
										</tr>
									</table>
								</fieldset>
							</div>
							<div id="google_setting">
								<fieldset>
								<legend><?php echo JText::_('GOOGLE_ADSENSE') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" id="jobsrss">
										<tr>
											<td  width="25%" class="key"><?php echo JText::_('SHOW_GOOGLE_ADSENSE'); ?></td>
											<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'showgoogleadsense', 'class="inputbox" '. '', 'value', 'text', $this->configs['showgoogleadsense']);; ?></td>
											<td width="25%" class="key" ><?php echo JText::_('CUSTOM_CSS'); ?></td>
											<td><textarea  readonly="readonly" name="custom_css" cols="25" rows="3" class="inputbox"><?php echo $this->configs['custom_css']; ?></textarea> </td>
										</tr>
										<tr>
											<td width="25%" class="key"><?php echo JText::_('ADSENSE_REPEAT'); ?></td>
											<td  ><input type="text" name="add_on_repitation" value="<?php echo $this->configs['add_on_repitation']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('SHOW_ADSENSE_AFTER_NUMBER_OF_VEHICLES');?></small></td>
											<td width="25%" class="key" ><?php echo JText::_('CLIENT'); ?></td>
											<td  ><input type="text" name="add_on_client" value="<?php echo $this->configs['add_on_client']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
										</tr>
										<tr>
											<td width="25%" class="key"><?php echo JText::_('SLOT'); ?></td>
											<td  ><input type="text" name="add_on_slot" value="<?php echo $this->configs['add_on_slot']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<td width="25%" class="key"><?php echo JText::_('FORMAT'); ?></td>
											<td  ><input type="text" name="add_on_format" value="<?php echo $this->configs['add_on_format']; ?>" class="inputbox" size="<?php echo $med_field_width; ?>" maxlength="255" /><br clear="all">
											<small><?php echo JText::_('EX. 728 * 90');?></small></td>
										</tr>
									</table>
								</fieldset>
								<fieldset>
								<legend><?php echo JText::_('GOOGLE_ADSENSE_SHOW_HIDE') ?></legend>
									<table cellpadding="5" cellspacing="1" border="0" width="100%" class="admintable" id="jobsrss">
										<tr>
												<td  width="25%" class="key"><?php echo JText::_('LIST_VEHICLES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'listvehiclesshowadsense', 'class="inputbox" '. '', 'value', 'text', $this->configs['listvehiclesshowadsense']);; ?></td>
												<td  width="25%" class="key"><?php echo JText::_('SEARCH_RESULT'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'searchresultshowadsense', 'class="inputbox" '. '', 'value', 'text', $this->configs['searchresultshowadsense']);; ?></td>
										</tr>
										<tr>
												<td  width="25%" class="key"><?php echo JText::_('GOLD_VEHICLES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'goldvehiclesshowadsense', 'class="inputbox" '. '', 'value', 'text', $this->configs['goldvehiclesshowadsense']);; ?></td>
												<td  width="25%" class="key"><?php echo JText::_('FEATURED_VEHICLES'); ?></td>
												<td  width="25%"><?php echo JHTML::_('select.genericList', $showhide, 'featuredvehicleshowadsense', 'class="inputbox" '. '', 'value', 'text', $this->configs['featuredvehicleshowadsense']);; ?></td>
										</tr>
									</table>
								</fieldset>
							</div>
						</div>
			<input type="hidden" name="task" value="saveconf" />
			<input type="hidden" name="view" value="vehicles" />
			<input type="hidden" name="layout" value="configurations" />
			<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
			</form>
		</td>
	</tr>

<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function loadMap() {
		var default_latitude = document.getElementById('default_latitude').value;
		var default_longitude = document.getElementById('default_longitude').value;
		var latlng = new google.maps.LatLng(default_latitude, default_longitude); zoom=10;
		var myOptions = {
		  zoom: zoom,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_container"),myOptions);
		var lastmarker = new google.maps.Marker({
			postiion:latlng,
			map:map
		});
		var marker = new google.maps.Marker({
		  position: latlng, 
		  map: map 
		});
		marker.setMap(map);
		lastmarker = marker;

	google.maps.event.addListener(map,"click", function(e){
		var latLng = new google.maps.LatLng(e.latLng.lat(),e.latLng.lng());
		geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'latLng': latLng}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
			if(lastmarker != '') lastmarker.setMap(null);
			var marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map
			});
			marker.setMap(map);
			lastmarker = marker;
			document.getElementById('default_latitude').value = marker.position.lat();
			document.getElementById('default_longitude').value = marker.position.lng();
			
		  } else {
			alert("Geocode was not successful for the following reason: " + status);
		  }
		});
	});
//document.getElementById('map_container').innerHTML += "<a href='Javascript hidediv();'><?php echo JText::_('CLOSE_MAP');?></a>";
}
function showdiv(){
	document.getElementById('map').style.visibility = 'visible';
}
function hidediv(){
	document.getElementById('map').style.visibility = 'hidden';
}
    function paymentmethod_showhide(){
        paypal = document.getElementById('paymentmethod_paypal').style;
        pagseguro = document.getElementById('paymentmethod_pagseguro').style;
        packageform = document.getElementById('paymentmethod_packageform').style;
        element = document.getElementById('payment_method');
        val = element.options[element.selectedIndex].value;
        if(val == 'paypal'){
            paypal.display = 'block';
            pagseguro.display = 'none';
            packageform.display = 'none';
        }else if(val == 'pagseguro'){
            paypal.display = 'none';
            pagseguro.display = 'block';
            packageform.display = 'none';
        }else if((val == 'fastspring') || (val == 'authorizenet') || (val == '2checkout')){
            paypal.display = 'none';
            pagseguro.display = 'none';
            packageform.display = 'block';
        }else{
            paypal.display = 'none';
            pagseguro.display = 'none';
            packageform.display = 'none';
        }
    }

    //paymentmethod_showhide(); //calling method
function markreview(){
	$.post("index.php?option=com_jsautoz&task=markreviewed",{},function(data){
			if(data){
				window.open("http://extensions.joomla.org/extensions/vertical-markets/vehicles/20344");
				var forceGet = true;
				window.location.reload(forceGet);
			}else return false;
	});
	return false;
}
</script>

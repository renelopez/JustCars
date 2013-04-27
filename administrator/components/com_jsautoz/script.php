<?php

/** @Copyright Copyright (C) 2011
 * @license		GNU/GPL http://www.gnu.org/copyleft/gpl.html
 + Created by:	Ahmad Bilal
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , ahmad@burujsolutions.com
 * Created on:	Oct 22, 2011
 ^
 + Project:		JS Documentation 
*/
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class com_JSAutozInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent) 
	{
		// $parent is the class calling this method
		//$parent->getParent()->setRedirectURL('index.php?option=com_jsdocumentation');
	}

	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent) 
	{
		// $parent is the class calling this method
		echo '<p>' . JText::_('JS_JSAUTOZ_UNINSTALL_TEXT') . '</p>';
	}

	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent) 
	{
		// $parent is the class calling this method
		
	}

	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent) 
	{
/*
			$db = &JFactory::getDBO();
			$query = 'SELECT * FROM '.$db->nameQuote('#__js_auto_config')." WHERE configname = 'versioncode'";
			$db->setQuery($query);
			$version = $db->loadObject();
			if($version){
				if($version->configvalue == '100'){
					$query = 'SELECT COUNT(*) FROM '.$db->nameQuote('#__js_auto_messages');
					$db->setQuery($query);
					$message = $db->loadResult();
					if ( $message == 0 )	{ // no back up found


						$query = "ALTER TABLE `#__js_auto_vehicles`
							ADD COLUMN  `issold` tinyint(1) DEFAULT '0',
							ADD COLUMN  `solddated` datetime DEFAULT NULL,
							ADD COLUMN  `latitude` double DEFAULT NULL,
							ADD COLUMN  `longitude` double DEFAULT NULL,
							ADD COLUMN  `registrationnumber` varchar(255) DEFAULT NULL,
							ADD COLUMN  `chasisnumber` varchar(255) DEFAULT NULL,
							ADD COLUMN  `enginenumber` varchar(255) DEFAULT NULL;";
						$db->setQuery($query);
						if (!$result = $db->queryBatch()) echo "<font color='red'>".JText::_('Error occurred while attempting to Alter Vehicle table.</font><br>');


						$query = "UPDATE `#__js_auto_fieldordering` SET  `ordering` =  `ordering` + 3 WHERE  `ordering` > 10 and `fieldfor` =  1;";
						$query .= "UPDATE `#__js_auto_fieldordering` SET  `ordering` =  `ordering` + 2 WHERE  `ordering` > 21 and `fieldfor` = 1;";
						$query .= "UPDATE `#__js_auto_fieldordering` SET  `ordering` =  `ordering` + 1 WHERE  `id` = 18 and `fieldfor` =  1;";
						$query .= "UPDATE `#__js_auto_fieldordering` SET  `ordering` =  22 WHERE  `id` = 142 and `fieldfor` = 1;";
						$query .= "UPDATE `#__js_auto_fieldordering` SET  `ordering` =  23 WHERE  `id` = 27 and `fieldfor` = 1;";
						$query .= "DELETE FROM `#__js_auto_fieldordering`  WHERE  `id` = 155 and `fieldfor` = 1;";
						$query .= "DELETE FROM `#__js_auto_fieldordering`  WHERE  `id` = 156 and `fieldfor` = 1;";
						$db->setQuery($query);
						if (!$result = $db->queryBatch()) echo "<font color='red'>".JText::_('Error occurred while attempting to Updating Field Ordering table.</font><br>');

						$query = "INSERT INTO `#__js_auto_fieldordering` VALUES (173,'status','status',35,NULL,1,1,0,0,'0'),(174,'issold','Is Sold',33,NULL,1,1,0,0,'0'),(175,'registrationnumber','Registration Number',11,NULL,1,1,0,0,'0'),(176,'chasisnumber','Chasis Number',13,NULL,1,1,0,0,'0'),(177,'enginenumber','Engine Number',12,NULL,1,1,0,0,'0');";
						$db->setQuery($query);
						if (!$result = $db->queryBatch()) echo "<font color='red'>".JText::_('Error occurred while attempting to Interting Field Ordering table.</font><br>');

						$query = "INSERT INTO `#__js_auto_emailtemplates` VALUES (11,NULL,'vehicle-visitor',NULL,NULL,'<p>Dear {VISITOR} ,</p>\r\n<p>You add new Vehicle  {VEHICLE_TITLE}.You are visitor your Vehicle id is {VEHICLE_ID} </p>\r\n<p>Title: {VEHICLE_TITLE}</p>\r\n<p>Make: {MAKE}</p>\r\n<p>MODEL: {MODEL}</p>\r\n<p>MODEL YEAR: {MODEL_YEAR}</p>\r\n<p>Location: {LOCATION}</p>\r\n<p>Login and view detail at Please do not respond to this message. It is automatically generated and is for information purposes only.</p>',NULL,NULL),(12,NULL,'message-btosemail',NULL,'JS Autoz: New Message Alert\n','<p>Dear {SELLER},</p>\n<p>{BUYER}: send you new message.</p>\n<p><strong><span style=\"text-decoration: underline;\">Summary</span></strong></p>\n<p>Vehicle Title: {VEHICLE_TITLE}</p>\n<p>Subject: {SUBJECT}</p>\n<p>Message: {MESSAGE}</p>',1,'2012-04-05 12:25:41'),(13,NULL,'message-stobemail',NULL,'JS Autoz: New Message Alert\n','<p>Dear {BUYER},</p>\n<p>{SELLER}: send you new message.</p>\n<p><strong><span style=\"text-decoration: underline;\">Summary</span></strong></p>\n<p>Vehicle Title: {VEHICLE_TITLE}</p>\n<p>Subject: {SUBJECT}</p>\n<p>Message: {MESSAGE}</p>',1,'2012-04-05 12:25:41');";
						$query .= "INSERT INTO `#__js_auto_emailtemplates` VALUES (15, 42, 'dealer-approval', NULL, 'Your dealer account status', '<p>Dear {DEALER_NAME} ,</p>\r\n<p>Business Name: {DEALER_BUSINESS_NAME},</p>\r\n<p>Your dealer account request has been {APPROVAL_STATUS} by admin.</p>\r\n<p><strong>*DO NOT REPLY TO THIS E-MAIL*</strong><br />This is an automated e-mail message sent from our support system. Do not reply to this e-mail as we wonot receive your reply!</p>', 1, '2013-01-22 00:00:00');";
						$db->setQuery($query);
						if (!$result = $db->queryBatch()) echo "<font color='red'>".JText::_('Error occurred while attempting to Inserting Email Templates table.</font><br>');


						$query = "INSERT INTO `#__js_auto_config` VALUES('dealerautoapprove', '0', 'default');";
						$query .= "INSERT INTO `#__js_auto_config` VALUES('dealer_approve_sendemail', '1', 'email');";
						$query .= "INSERT INTO `#__js_auto_config` VALUES('visitor_can_see_dealerpackage', '1', 'default');";
						$query .= "INSERT INTO `#__js_auto_config` VALUES('seller_can_see_dealerpackage', '1', 'default');";
						$query .= "INSERT INTO `#__js_auto_config` VALUES('dealer_can_see_sellerpackage', '1', 'default');";

						$query .= "UPDATE `#__js_auto_config` SET configvalue = 'business' WHERE configname = 'vtype';";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = CURDATE() WHERE configname = 'installation_date';";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = '0' WHERE configname = 'reviewed';";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = '' WHERE configname = 'update_data';";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = '/graywhite/css/jsautozgraywhite.css' WHERE configname = 'theme';";
						
						$query .= "INSERT INTO `#__js_auto_config` VALUES ('show_sold_vehicles','1','default'),('rss_vehicle_title','JS Autoz Vehicle ','rss'),('rss_vehicle_description','JS Autoz For vehicle feed','rss'),('rss_vehicle_copyright','©Copyright Buruj Solutions ','rss'),('rss_vehicle_webmaster','Powered by Joom Sky','rss'),('rss_vehicle_editor','zain_22pugc@yahoo.com','rss'),('rss_vehicle_ttl','vehicle','rss'),('custom_css','float:left;width:100%;clear:both;overflow: hidden;','addon'),('add_on_repitation','5','addon'),('visitor_can_edit_vehicle','1','visitor'),('bcomparevehicle','1','links'),('bmessages','1','links'),('messages','1','links'),('vformnewvehicle','1','links'),('vformusedvehicle','1','links'),('vmyvehicles','1','links'),('vbformnewvehicles','1','links'),('vbformusedvehicles','1','links'),('vbsearchvehicles','1','links'),('vbnvehiclebymakes','1','links'),('vbuvehiclebymakes','1','links'),('vbvehiclebycity','1','links'),('vbvehiclebyprice','1','links'),('vbvehiclebymodelyears','1','links'),('vbgoldvehicles','1','links'),('vbfeaturedvehicles','1','links'),('vbdealers','1','links'),('vbvehiclealerts','1','links'),('vbcomparevehicle','1','links'),('searchtitle','1','search'),('searchvehicletype','1','search'),('searchmake','1','search'),('searchmodel','1','search'),('searchregcountry','1','search'),('searchregstate','1','search'),('searchregcounty','1','search'),('searchregcity','1','search'),('searchloccountry','1','search'),('searchlocstate','1','search'),('searchloccounty','1','search'),('searchloccity','1','search'),('searchloczip','1','search'),('searchradius','1','search'),('searchmodelyear','1','search'),('searchfueltype','1','search'),('searchcylinder','1','search'),('searchprice','1','search'),('searchexteriorcolor','1','search'),('searchregistrationnumber','1','search'),('searchenginecapacity','1','search'),('searchcondition','1','search'),('searchmileages','1','search'),('vehiclefilter','1','default'),('filtercondition','1','filter'),('filtermodel','1','filter'),('filtermake','1','filter'),('filtercountry','1','filter'),('filterstate','1','filter'),('filtercounty','1','filter'),('filtercity','1','filter'),('filtermodelyear','1','filter'),('bvehiclebytypes','1','links'),('vbvehiclebytypes','1','links'),('default_longitude','74.18554640000002','default'),('default_latitude','32.0927435','default'),('filtermap','1','filter'),('searchmap','1','search'),('add_on_client','ca-pub-8827762976015158','addon'),('add_on_slot','9560237528','addon'),('add_on_format','728 x 90','addon'),('listvehiclesshowadsense','1','addon'),('searchresultshowadsense','1','addon'),('goldvehiclesshowadsense','1','addon'),('featuredvehicleshowadsense','1','addon'),('showgoogleadsense','1','addon'),('showrssfeeding','1','rss'),('captcha','1','default'),('vpackages','1','links'),('vpurchasehistory','1','links'),('vmystats','1','links'),('vmessages','1','links'),('cron_vehicle_alert_key','',''),('cron_job_alert_admin','','email'),('default_radius','km','default');";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = '1.0.3' WHERE configname = 'version';";
						$query .= "UPDATE `#__js_auto_config` SET configvalue = '103' WHERE configname = 'versioncode';";
						$db->setQuery($query);
						if (!$result = $db->queryBatch()) echo "<font color='red'>".JText::_('Error occurred while attempting to Inserting Configurations table.</font><br>');



					}	
				}
				
			}
			*/ 
	}

	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent) 
	{
		
		jimport('joomla.installer.helper');
		$installer = new JInstaller();
		//$installer->_overwrite = true;

		
			echo "<br /><br /><font color='green'><strong>Installing modules</strong></font>";
			$ext_module_path = JPATH_ADMINISTRATOR.'/components/com_jsautoz/extensions/modules/';
			$extensions = array( 
				'mod_vehiclesbymake.zip'=>'Vehicles by Make Module'
			 );
				 
			 foreach( $extensions as $ext => $extname ){
				  $package = JInstallerHelper::unpack( $ext_module_path.$ext );
				  if( $installer->install( $package['dir'] ) ){
					echo "<br /><font color='green'>$extname successfully installed.</font>";
				  }else{
					echo "<br /><font color='red'>ERROR: Could not install the $extname. Please install manually.</font>";
				  }
				JInstallerHelper::cleanupInstall( $ext_module_path.$ext, $package['dir'] ); 
			}

			echo "<br /><br /><font color='green'><strong>Installing plugins</strong></font>";
			$ext_plugin_path = JPATH_ADMINISTRATOR.'/components/com_jsautoz/extensions/plugins/';
			$extensions = array( 
				'plg_vehiclesbymake.zip'=>'Vehicles by Make Plugin'

			 );
			   
				 
			 foreach( $extensions as $ext => $extname ){
				  $package = JInstallerHelper::unpack( $ext_plugin_path.$ext );
				  if( $installer->install( $package['dir'] ) ){
					echo "<br /><font color='green'>$extname successfully installed.</font>";
				  }else{
					echo "<br /><font color='red'>ERROR: Could not install the $extname. Please install manually.</font>";
				  }
				JInstallerHelper::cleanupInstall( $ext_plugin_path.$ext, $package['dir'] ); 
			}
		}



}


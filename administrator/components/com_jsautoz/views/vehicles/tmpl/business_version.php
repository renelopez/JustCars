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
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>

<table width="100%">
	<tr>
		<td align="left" width="175" valign="top">
			<table width="100%"><tr><td style="vertical-align:top;">
			<?php
			include_once('components/com_jsautoz/views/menu.php');
			?>
			</td>
			</tr></table>
		</td>
		<td width="100%" valign="top">
			<div id="pro_wrap">
				<div id="pro_text">
					<?php echo JText::_('FEATURE_AVAIL_IN_JSAUTOZ_PRO_VERSION');?><span id="img"></span>
				</div>
				<div id="pro_feature_wrap">
					<div id="pro_feature_text">
						<a href="" ><?php echo JText::_('JSAUTOZ_PRO_FEATURE');?></a>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_1" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_gold.png" alt=""/>
						<span class="title"><?php echo JText::_('GOLD_VEHICLES');?></span>
						<span class="text"><?php echo JText::_('Seller can add their vehicle to Gold according to their package, and Administrator can show the Gold vehicles to top of vehicles listing.');?></span>
					</div>
					<div id="pro_feature_2" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_featured.png" alt=""/>
						<span class="title"><?php echo JText::_('FEATURED_VEHICLES');?></span>
						<span class="text"><?php echo JText::_('Seller can also add their vehicle to Featured according to their package, and also a vehicle can be Gold as well as Featured also, Administrator can also show the Featured Vehicles to top of vehicles listing.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_3" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_edit.png" alt=""/>
						<span class="title"><?php echo JText::_('VISITOR_CAN_EDIT_VEHICLES');?></span>
						<span class="text"><?php echo JText::_('Not only the Visitor just can add vehicles, edit their vehicles also.');?></span>
					</div>
					<div id="pro_feature_4" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_shortlist.png" alt=""/>
						<span class="title"><?php echo JText::_('SHORTLIST_VEHICLES');?></span>
						<span class="text"><?php echo JText::_('Buyer can shortlist vehicles make their shortlist review and rate also. (Registerd User)');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_5" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_compare.png" alt=""/>
						<span class="title"><?php echo JText::_('COMPARE_VEHICLES');?></span>
						<span class="text"><?php echo JText::_('Buyer can compare two different vehicles at a time.');?></span>
					</div>
					<div id="pro_feature_6" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_reviewrat.png" alt=""/>
						<span class="title"><?php echo JText::_('REVIEW_AND_RATING');?></span>
						<span class="text"><?php echo JText::_('Buyer can review and rate the Seller vehicles. (Registerd User)');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_7" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_dealer.png" alt=""/>
						<span class="title"><?php echo JText::_('DEALERS');?></span>
						<span class="text"><?php echo JText::_('Administrator can make a registerd user to Dealer for vehicles.');?></span>
					</div>
					<div id="pro_feature_8" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_message.png" alt=""/>
						<span class="title"><?php echo JText::_('MESSAGES');?></span>
						<span class="text"><?php echo JText::_('Buyer and Seller can also communicate to each other with the messages, If buyer is interested in vehicle he can message the Seller for further information or deal.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_9" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_google_adsense.png" alt=""/>
						<span class="title"><?php echo JText::_('GOOGLE_ADSENSE');?></span>
						<span class="text"><?php echo JText::_('Administrator can publish the google adsense in vehicles listing, that after how many vehicles that ads will show.');?></span>
					</div>
					<div id="pro_feature_10" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_package.png" alt=""/>
						<span class="title"><?php echo JText::_('PACKAGES');?></span>
						<span class="text"><?php echo JText::_('Administrator can create package that how much vehicles can added by a Seller when they were expired, also the package expireations date and many other feature relate to packages.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_11" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_payment.png" alt=""/>
						<span class="title"><?php echo JText::_('PAYMENTS_GATEWAYS');?></span>
						<span class="text"><?php echo JText::_('Administrator set payment gateways for selling their packages to the Seller, that by which method Seller can pay.');?></span>
					</div>
					<div id="pro_feature_12" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_stats.png" alt=""/>
						<span class="title"><?php echo JText::_('STATS');?></span>
						<span class="text"><?php echo JText::_('Seller have statistics relate to their vehicles, how many vehicles it have how many are GOLD and Featured, and how much vehicles he/she can add.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_13" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_cronjob.png" alt=""/>
						<span class="title"><?php echo JText::_('NEW_LISTING_CRON_JOB');?></span>
						<span class="text"><?php echo JText::_('New listing alert will send to subscriber by Cron Job.');?></span>
					</div>
					<div id="pro_feature_14" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_rss.png" alt=""/>
						<span class="title"><?php echo JText::_('RSS_FEED');?></span>
						<span class="text"><?php echo JText::_('RSS feed can also be given for vehicles');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_15" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_modules.png" alt=""/>
						<span class="title"><?php echo JText::_('FREE_MODULE');?></span>
						<span class="text"><?php echo JText::_('We will give 14 modules with our Pro Version and 1 module with our Free Version.');?></span>
					</div>
					<div id="pro_feature_16" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_plugins.png" alt=""/>
						<span class="title"><?php echo JText::_('FREE_PLUGINS');?></span>
						<span class="text"><?php echo JText::_('Same as module we will give 14 plugins with our Pro Version and 1 plugins with our Free Version.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_17" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_copyright.png" alt=""/>
						<span class="title"><?php echo JText::_('COPYRIGHT_REMOVED');?></span>
						<span class="text"><?php echo JText::_('You can remove our copyright tag to the site in Pro Version only.');?></span>
					</div>
					<div id="pro_feature_18" class="rightalign">
						<img src="components/com_jsautoz/include/images/pro_upgrade.png" alt=""/>
						<span class="title"><?php echo JText::_('FREE_UPGRADATION');?></span>
						<span class="text"><?php echo JText::_('No free up-gradation will be offer to free version only for Pro Version only.');?></span>
					</div>
					</div>
					<div id="pro_featureWrap">
					<div id="pro_feature_19" class="leftalign">
						<img src="components/com_jsautoz/include/images/pro_support.png" alt=""/>
						<span class="title"><?php echo JText::_('SUPPORT');?></span>
						<span class="text"><?php echo JText::_('No support will give to free version only for Pro Version only.');?></span>
					</div>
					</div>
				</div>
			</div>
		</td>
		</tr>			
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

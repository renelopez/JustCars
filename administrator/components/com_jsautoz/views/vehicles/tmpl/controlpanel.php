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
 global $mainframe;
 $document =& JFactory::getDocument();

 $document->addScript('components/com_jsautoz/include/admin_menu/sdmenu/sdmenu.js');
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
	<script type="text/javascript">
//	var myMenu;
	function mymenu(val) {
		myMenu = new SDMenu("my_menu");
myMenu.speed = 3;                     // Menu sliding speed (1 - 5 recomended)
myMenu.remember = true;               // Store menu states (expanded or collapsed) in cookie and restore later
myMenu.oneSmOnly = true;             // One expanded submenu at a time
myMenu.markCurrent = true;            // Mark current link / page (link.href == location.href)

myMenu.init();
// Additional methods...
var firstSubmenu = myMenu.submenus[val];
myMenu.expandMenu(firstSubmenu);      // Expand a submenu
	};
	</script>
<div>
<table width="100%" >
    <tr>
        <td align="left" width="175"  valign="top">
                <table width="100%" ><tr><td style="vertical-align:top;">
                <?php
                include_once('components/com_jsautoz/views/menu.php');
                ?>
                </td>
                </tr></table>
        </td>
		
        <td width="100%" valign="top">
            <table width="100%" border="0">
                <tr><td height="0"></td></tr>
                <tr>
                        <td align="center" class="header" colspan="2">
                        <div class="header"><h2><u><?php echo JText::_('JS_AUTOZ'); ?></u></h2></div>
                        </td>
                </tr>
                <tr>
                        <td width="7%"></td>
                        <td align="center" width="85%">

                            <table class="adminlist" >
                                <thead>
								<tr><th><?php echo JText::_('VEHICLES'); ?></th></tr>
	                        </thead>
	                        <tbody>
	                                <tr>
		                                <td align="center">
                                                        <div id="cpanel" >
                                                                <table width="85%" border="0" cellpadding="0" cellspacing="1" >
                                                                        <tr align="center">
                                                                                <td width="15"></td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicles" onclick="mymenu(2)"  >
                                                                                                        <img src="components/com_jsautoz/include/images/vehicles.png" height="56" width="56">
                                                                                                        <br /><?php echo JText::_('VEHICLES'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehiclequeue" onclick="mymenu(2)" >
                                                                                                        <img src="components/com_jsautoz/include/images/approvalqueue.png" height="56" width="56">
                                                                                                        <br /><?php echo JText::_('VEHICLE_APPROVAL_QUEUE'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehiclesearch" onclick="mymenu(2)" >
                                                                                                        <img src="components/com_jsautoz/include/images/search.png" height="56" width="56">
                                                                                                        <br /><?php echo JText::_('SEARCH_VEHICLE'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                </td>
                                                                        </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                            <table class="adminlist" >
                                <thead>
								<tr><th><?php echo JText::_('ADMIN_AND_CONFICURATIONS'); ?></th></tr>
	                        </thead>
	                        <tbody>
	                                <tr>
		                                <td align="center">
                                                        <div id="cpanel" >
                                                                <table width="85%" border="0" cellpadding="0" cellspacing="1" >
                                                                        <tr align="center">
                                                                                <td width="15"></td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=makes" onclick="mymenu(0)">
                                                                                                        <img src="components/com_jsautoz/include/images/makes.png"  width="56">
                                                                                                        <br /><?php echo JText::_('MAKE'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=configurations" onclick="mymenu(1)">
                                                                                                        <img src="components/com_jsautoz/include/images/configurations.png" height="56"  width="56">
                                                                                                        <br /><?php echo JText::_('CONFIGURATIONS'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=business_version" onclick="mymenu(1)">
                                                                                                        <img src="components/com_jsautoz/include/images/paymentmethods.png" height="56"  width="56">
                                                                                                        <br /><?php echo JText::_('PAYMENT_METHODS'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                                <td width="90">
                                                                                           <div style="float:center;align:center;"><div class="icon">
                                                                                                        <a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicles"  onclick="mymenu(0)" >
                                                                                                        <img src="components/com_jsautoz/include/images/stats.png" height="56"  width="56">
                                                                                                        <br /><?php echo JText::_('STATS'); ?></a>
                                                                                                </div></div>
                                                                                </td>
                                                                        </tr>
                                                                </table>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                           
                            <table class="adminlist" >
                                <thead>
									<tr><th><?php echo JText::_('INFORMATION'); ?></th></tr>
	                        </thead>
	                        <tbody>
	                                <tr>
		                                <td align="center">
											<div id="cpanel" >
													<table width="85%" border="0" cellpadding="0" cellspacing="1" >
															<tr align="center">
																	<td width="15"></td>
																	<td width="90">
																			   <div style="float:center;align:center;"><div class="icon">
																							<a  href="index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=info"  >
																							<img src="components/com_jsautoz/include/images/information.png" height="56" width="56">
																							<br /><?php echo JText::_('ABOUT'); ?></a>
																					</div></div>
																	</td>
																	<td width="90">
																			<div ><div class="icon">
																									<a href="index.php?option=com_jsautoz&view=vehicles&layout=updateactivate">
																									<img src="components/com_jsautoz/include/images/copyright.png" height="56" width="56">
																									<br/><?php echo JText::_('REMOVE_FOOTER'); ?></a>
																			</div></div>
																	</td>
																	<td width="90">
																			<div ><div class="icon">
																					<a href="index.php?option=com_jsautoz&view=vehicles&layout=updateactivate" onclick="mymenu(0)">
																					<img src="components/com_jsautoz/include/images/updates.png" height="56" width="56">
																					<br/><?php echo JText::_('UPDATES'); ?></a>
																			</div></div>
																	</td>
																	<td width="90">
																			<div ><div class="icon">
															<?php

																	$url = 'http://www.joomsky.com/jsautozsys/getlatestversion.php';
																	$pvalue = "dt=".date('Y-m-d');
																	if  (in_array  ('curl', get_loaded_extensions())) {
																		$ch = curl_init();
																		curl_setopt($ch,CURLOPT_URL,$url);
																		curl_setopt($ch,CURLOPT_POST,8);
																		curl_setopt($ch,CURLOPT_POSTFIELDS,$pvalue);
																		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
																		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
																		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
																		$curl_errno = curl_errno($ch);
																		$curl_error = curl_error($ch);
																		$result = curl_exec($ch);
																		curl_close($ch);
																		if($result == $this->config['versioncode']){ ?>
																					<img src="components/com_jsautoz/include/images/systemupdated.png" height="56" width="56" title="<?php echo JText::_('YOUR_SYSTEM_IS_UP_TO_DATE'); ?>">
																					<br/><?php echo JText::_('YOUR_SYSTEM_IS_UP_TO_DATE'); ?></a>
																		<?php	
																		}elseif($result){ ?>
																					<img src="components/com_jsautoz/include/images/newversionavailable.png" height="56" width="56" title="<?php echo JText::_('NEW_VERSION_AVAILABLE'); ?>">
																					<br/><?php echo JText::_('NEW_VERSION_AVAILABLE'); ?></a>
																		<?php			
																		}else{ ?>
																					<img src="components/com_jsautoz/include/images/unabletoconnect.png" height="56" width="56" title="<?php echo JText::_('UNABLE_CONNECT_TO_SERVER'); ?>">
																					<br/><?php echo JText::_('UNABLE_TO_CONNECT'); ?></a>
																		<?php			
																		}
																	}else{ ?>
																				<img src="components/com_jsautoz/include/images/unabletoconnect.png" height="56" width="56" title="<?php echo JText::_('UNABLE_CONNECT_TO_SERVER'); ?>">
																				<br/><?php echo JText::_('UNABLE_TO_CONNECT'); ?></a>
																	<?php			
																	}
															
															?>
																			</div></div>
																	</td>
															</tr>
															<tr><td colspan="4" height="25">
															
															</td></tr>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
                            <table class="adminlist" >
                                <thead>
									<tr><th><?php echo JText::_('SUPPORT'); ?></th></tr>
	                        </thead>
	                        <tbody>
	                                <tr>
		                                <td align="center">
											<div id="cpanel" >
													<table width="85%" border="0" cellpadding="0" cellspacing="1" >
															<tr align="center">
																	<td width="15"></td>
																	<td width="90">
																			   <div style="float:center;align:center;"><div class="icon">
																							<a  href="http://www.joomsky.com/jsautozsys/forum.php"  target="_blank">
																							<img src="components/com_jsautoz/include/images/forum.png" height="56" width="56">
																							<br /><?php echo JText::_('FORUM'); ?></a>
																					</div></div>
																	</td>
																	<td width="90">
																			<div ><div class="icon">
																									<a href="http://www.joomsky.com/jsautozsys/documentation.php" target="_blank">
																									<img src="components/com_jsautoz/include/images/documentation.png" height="56" width="56">
																									<br/><?php echo JText::_('DOCUMENTATION'); ?></a>
																			</div></div>
																	</td>
																	<td width="90">
																			<div ><div class="icon">
																					<a href="http://www.joomsky.com/jsautozsys/ticket.php" target="_blank">
																					<img src="components/com_jsautoz/include/images/ticket.png" height="56" width="56">
																					<br/><?php echo JText::_('OPEN_A_TICKET'); ?></a>
																			</div></div>
																	</td>
																	<td width="90">
																	</td>
															</tr>
															<tr><td colspan="4" height="25"></td></tr>
													</table>
												</div>
											</td>
										</tr>
									</tbody>
								</table>

                            <table class="adminlist" >
                                <thead>
									<tr><th><?php echo JText::_('MAKE_A_REVIEW'); ?></th></tr>
	                        </thead>
	                        <tbody>
	                                <tr>
		                                <td align="center">
											<div id="cpanel" >
													<div id="review_wrap" class="extra_height">
														<a id="button" href="http://extensions.joomla.org/extensions/vertical-markets/vehicles/20344" target="_blank"><?php echo JText::_('MAKE_A_REVIEW'); ?></a>
														<div id="review_text"><?php echo JText::_('IF_YOU_USE');?> <b><a id="no" href="http://extensions.joomla.org/extensions/vertical-markets/vehicles/20344" title="<?php echo JText::_('REVIEW_AT_JED');?>">JS Autoz</a></b>, <?php echo JText::_('PLEASE_POST_A_RATING_AND_A_REVIEW_AT_JOOMLA_EXTENSIONS_DIRECTORY');?></div>
														<img id="review_img" src="components/com_jsautoz/include/images/review_image.png" alt="" />
													</div>
											</div>
											</td>
										</tr>
									</tbody>
								</table>


                                        </td>
                                    <td width="4%"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left" width="100%"  valign="top">
						</td>
                    </tr>
                </table>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>
		

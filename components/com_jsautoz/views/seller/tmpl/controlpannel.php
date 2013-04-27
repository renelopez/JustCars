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
$document->addStyleSheet('components/com_jsautoz/themes/' . $this->config['theme']);
JHTML::_('behavior.modal');

?>

<div>
<?php if ($this->config['offline'] == '1'){ ?>
 <div   class="contentpane">
	<div  class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
	<div ></div>
	<div class="jsautozmsg">
		<?php echo $this->config['offline_text']; ?>
	</div>
</div>
<?php  }else{ ?>

        <div id="jsautoz_toppanel">
            <div id="jsautoz_topsection">
                    <?php if ($this->config['showtitle'] == 1) { ?>
                            <div id="autoz_sitetitle">
                                    <?php echo $this->config['title']; ?>
                            </div>
                    <?php } ?>
                    <?php if ($this->config['navigation'] == 1) { ?>
                            <div class="autoz_topcurloc">
                                <?php if (isset($this->vehicle) && ($this->vehicle->id == '')){	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('NEW_VEHICLE_INFO'); ?>
                                <?php }else{	?>
                                        <?php echo JText::_('CUR_LOC'); ?> : <?php echo JText::_('CONTROL_PANEL'); ?>
                                <?php }	?>
                            </div>
                    <?php } ?>
            </div>
            <?php 
                if (sizeof($this->sellerlinks) != 0){
                    echo '<div id="autoz_top_links">';
                    foreach ($this->sellerlinks as $lnk) { ?>
                        <a class="<?php if($lnk[2] == 1)echo 'first'; elseif($lnk[2] == -1)echo 'last';  ?>" href="<?php echo $lnk[0]; ?>"><?php echo $lnk[1]; ?></a>
                    <?php
                    }
                    echo '</div>';
                }
            ?>
            <div id="autoz_topheading">
                    <span id="autoz_topheading_text">
                            <span id="autoz_topheading_text_left"></span>
                            <span id="autoz_topheading_text_center"><?php echo JText::_('CONTROL_PANEL'); ?></span>
                            <span id="autoz_topheading_text_right"></span>
                    </span>
            </div>
        </div>

        <div id="autoz_cp_main">
			<div id="autoz_cp_icon_portion">
				<div id="autoz_cp_icon_heading">
					<span id="autoz_cp_icon_headingtext">
						<span id="autoz_cp_icon_headingtext_left"></span>
						<span id="autoz_cp_icon_headingtext_center"><?php echo JText::_('VEHICLES');?></span>
						<span id="autoz_cp_icon_headingtext_right"></span>
					</span>
				</div>
                                <?php
                                $userid=$this->uid;
                                if($userid){ ?>
                                    <?php if ($this->config['seperate_new_and_used_vehicle'] == 1) {?>
                                                <?php if ($this->links['formnewvehicle'] == 1){ ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=1&Itemid=<?php echo $this->Itemid;?>" >
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/add_new_veh.png" alt="<?php echo JText::_('ADD_NEW_VEHICLE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('ADD_NEW_VEHICLE'); ?>
									</div>
								</div>
							</a>
                                                <?php } ?>
                                                <?php if ($this->links['formusedvehicle'] == 1){ ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=2&Itemid=<?php echo $this->Itemid;?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/add_used_veh.png" alt="<?php echo JText::_('ADD_USED_VEHICLE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('ADD_USED_VEHICLE'); ?>
									</div>
								</div>
							</a>
                                                <?php } ?>
                                    <?php }else{ ?>
                                                        <?php if ($this->links['formnewvehicle'] == 1){ ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&nadtype=1&rd=1&rd1=1&Itemid=<?php echo $this->Itemid;?>" >
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/add_new_veh.png" alt="<?php echo JText::_('ADD_VEHICLE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('ADD_VEHICLE'); ?>
									</div>
								</div>
							</a>
                                                        <?php } ?>
                                    <?php } ?>
                                                        <?php if ($this->config['seperate_new_and_used_vehicle'] == 0) { ?>
                                                                <?php if ($this->links['myvehicles'] == 1){ ?>
                                                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=vehiclelist&nadtype=1&Itemid=<?php echo $this->Itemid;?>">
                                                                                <div  id="jsautoz_cplinks">
                                                                                        <div class="cpimage">
                                                                                                <img width="32" height="32" src="components/com_jsautoz/images/my_veh.png" alt="<?php echo JText::_('MY_VEHICLES'); ?>" />
                                                                                        </div>
                                                                                        <div class="cptext">
                                                                                                <?php echo JText::_('MY_VEHICLES'); ?>
                                                                                        </div>
                                                                                </div>
                                                                        </a>
                                                                <?php } ?>

                                                        <?php }else { ?>
                                                                <?php if ($this->links['myvehicles'] == 1){ ?>
                                                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=vehiclelist&Itemid=<?php echo $this->Itemid;?>">
                                                                                <div  id="jsautoz_cplinks">
                                                                                        <div class="cpimage">
                                                                                                <img width="32" height="32" src="components/com_jsautoz/images/my_veh.png" alt="<?php echo JText::_('MY_VEHICLES'); ?>" />
                                                                                        </div>
                                                                                        <div class="cptext">
                                                                                                <?php echo JText::_('MY_VEHICLES'); ?>
                                                                                        </div>
                                                                                </div>
                                                                        </a>
                                                                <?php } ?>

                                                        <?php } ?>
                                <?php }else{ ?>
                                                        <?php if ($this->config['seperate_new_and_used_vehicle'] == 1) {?>
                                                                    <?php if ($this->links['vformnewvehicle'] == 1){ ?>
                                                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=1&Itemid=<?php echo $this->Itemid;?>" >
                                                                                <div  id="jsautoz_cplinks">
                                                                                        <div class="cpimage">
                                                                                                <img width="32" height="32" src="components/com_jsautoz/images/add_new_veh.png" alt="<?php echo JText::_('ADD_NEW_VEHICLE'); ?>" />
                                                                                        </div>
                                                                                        <div class="cptext">
                                                                                                <?php echo JText::_('ADD_NEW_VEHICLE'); ?>
                                                                                        </div>
                                                                                </div>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if ($this->links['vformusedvehicle'] == 1){ ?>
                                                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=2&Itemid=<?php echo $this->Itemid;?>">
                                                                                <div  id="jsautoz_cplinks">
                                                                                        <div class="cpimage">
                                                                                                <img width="32" height="32" src="components/com_jsautoz/images/add_used_veh.png" alt="<?php echo JText::_('ADD_USED_VEHICLE'); ?>" />
                                                                                        </div>
                                                                                        <div class="cptext">
                                                                                                <?php echo JText::_('ADD_USED_VEHICLE'); ?>
                                                                                        </div>
                                                                                </div>
                                                                        </a>
                                                                    <?php } ?>
                                                        <?php }else{ ?>
                                                                            <?php if ($this->links['vformnewvehicle'] == 1){ ?>
                                                                                <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&nadtype=1&rd=1&rd1=1&Itemid=<?php echo $this->Itemid;?>" >
                                                                                        <div  id="jsautoz_cplinks">
                                                                                                <div class="cpimage">
                                                                                                        <img width="32" height="32" src="components/com_jsautoz/images/add_new_veh.png" alt="<?php echo JText::_('ADD_VEHICLE'); ?>" />
                                                                                                </div>
                                                                                                <div class="cptext">
                                                                                                        <?php echo JText::_('ADD_VEHICLE'); ?>
                                                                                                </div>
                                                                                        </div>
                                                                                </a>
                                                                            <?php } ?>
                                                                            <?php if ($this->links['vmyvehicles'] == 1){ ?>
                                                                                <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=authenticate&Itemid=<?php echo $this->Itemid;?>">
                                                                                        <div  id="jsautoz_cplinks">
                                                                                                <div class="cpimage">
                                                                                                        <img width="32" height="32" src="components/com_jsautoz/images/my_veh.png" alt="<?php echo JText::_('MY_VEHICLES'); ?>" />
                                                                                                </div>
                                                                                                <div class="cptext">
                                                                                                        <?php echo JText::_('MY_VEHICLES'); ?>
                                                                                                </div>
                                                                                        </div>
                                                                                </a>
                                                                            <?php } ?>
                                                        <?php } ?>
                                <?php } ?>
                        </div>
        </div>
<?php
}//ol
?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


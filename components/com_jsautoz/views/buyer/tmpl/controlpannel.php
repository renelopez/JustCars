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
$document = & JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/themes/' . $this->config['theme']);
?>
    <?php if ($this->config['offline'] == '1') { ?>


        <div class="contentpane">
            <div  class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
            <div ></div>
            <div class="jsautozmsg">
                <?php echo $this->config['offline_text']; ?>
            </div>
        </div>
    <?php } else { ?>
<div>
        <div id="jsautoz_toppanel">
			<div id="jsautoz_topsection">
				<?php if ($this->config['showtitle'] == 1) { ?>
					<div id="autoz_sitetitle">
						<?php echo $this->config['title']; ?>
					</div>
				<?php } ?>
				<?php if ($this->config['navigation'] == 1) { ?>
					<div class="autoz_topcurloc">
						<?php if (isset($this->vehicle) && ($this->vehicle->id == '')) {
							?>
							<?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('VEHICLE_INFORMATION'); ?>
						<?php } else {
							?>
							<?php echo JText::_('CUR_LOC'); ?> : <?php echo JText::_('CONTROL_PANNEL'); ?>
						<?php } ?>
					</div>
				<?php } ?>
            </div>
			<?php
				if (sizeof($this->buyerlinks) != 0) {
					echo '<div id="autoz_top_links">';
					foreach ($this->buyerlinks as $lnk) {
						?>
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
				if (($this->uid != '') && ($this->uid != 0)) {
					if ($this->config['seperate_new_and_used_vehicle'] == 1) {
						?>
						<?php if ($this->links['bformnewvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=20&vtype=1&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new.png" alt="<?php echo JText::_('NEW_VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('NEW_VEHICLES'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
						<?php if ($this->links['bformusedvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=20&vtype=2&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/used.png" alt="<?php echo JText::_('USED_VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('USED_VEHICLES'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
					<?php } elseif ($this->config['seperate_new_and_used_vehicle'] == 0) { ?>
						<?php if ($this->links['bformnewvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=11&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new.png" alt="<?php echo JText::_('VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
					<?php } ?>
					<?php if ($this->links['bsearchvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/search.png" alt="<?php echo JText::_('SEARCH_VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('SEARCH_VEHICLES'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
					<?php if ($this->config['seperate_new_and_used_vehicle'] == 1) { ?>
						<?php if ($this->links['bnvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=1&cl=1&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new_make.png" alt="<?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
						<?php if ($this->links['buvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=2&cl=1&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/used_make.png" alt="<?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
					<?php } elseif ($this->config['seperate_new_and_used_vehicle'] == 0) { ?>
						<?php if ($this->links['bnvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&cl=12&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new_make.png" alt="<?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
					<?php } ?>
					<?php if ($this->links['bvehiclebycity'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebycity&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/city.png" alt="<?php echo JText::_('VEHICLES_BY_CITY'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_CITY'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
					<?php if ($this->links['bvehiclebyprice'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebyprice&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/price.png" alt="<?php echo JText::_('VEHICLES_BY_PRICE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_PRICE'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
					<?php if ($this->links['bvehiclebymodelyears'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebymodelyear&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/modalyear.png" alt="<?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
					<?php if ($this->links['bvehiclebytypes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebytypes&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/vehicle_types.png" alt="<?php echo JText::_('VEHICLES_BY_TYPE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_TYPE'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
				<?php } else {

					if ($this->config['seperate_new_and_used_vehicle'] == 1) {
						?>
				<?php if ($this->links['vbformnewvehicles'] == 1) { ?>
						<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype=1&cl=20&Itemid=<?php echo $this->Itemid; ?>">
							<div  id="jsautoz_cplinks">
								<div class="cpimage">
									<img width="32" height="32" src="components/com_jsautoz/images/new.png" alt="<?php echo JText::_('NEW_VEHICLES'); ?>" />
								</div>
								<div class="cptext">
									<?php echo JText::_('NEW_VEHICLES'); ?>
								</div>
							</div>
						</a>
				<?php } ?>
				<?php if ($this->links['vbformusedvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype=2&cl=20&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/used.png" alt="<?php echo JText::_('USED_VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('USED_VEHICLES'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
			<?php } elseif ($this->config['seperate_new_and_used_vehicle'] == 0) { ?>
				<?php if ($this->links['vbformnewvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=11&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new.png" alt="<?php echo JText::_('VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
			<?php } ?>
			<?php if ($this->links['vbsearchvehicles'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/search.png" alt="<?php echo JText::_('SEARCH_VEHICLES'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('SEARCH_VEHICLES'); ?>
									</div>
								</div>
							</a>
					<?php } ?>
			<?php if ($this->config['seperate_new_and_used_vehicle'] == 1) { ?>
				<?php if ($this->links['vbnvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=1&cl=1&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new_make.png" alt="<?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
				<?php } ?>
				<?php if ($this->links['vbuvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=2&cl=1&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/used_make.png" alt="<?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
			<?php } elseif ($this->config['seperate_new_and_used_vehicle'] == 0) { ?>
				<?php if ($this->links['vbnvehiclebymakes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&cl=12&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/new_make.png" alt="<?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>
									</div>
								</div>
							</a>
						<?php } ?>
			<?php } ?>
			<?php if ($this->links['vbvehiclebycity'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebycity&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/city.png" alt="<?php echo JText::_('VEHICLES_BY_CITY'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_CITY'); ?>
									</div>
								</div>
							</a>
			<?php } ?>
			<?php if ($this->links['vbvehiclebyprice'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebyprice&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/price.png" alt="<?php echo JText::_('VEHICLES_BY_PRICE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_PRICE'); ?>
									</div>
								</div>
							</a>
			<?php } ?>
			<?php if ($this->links['vbvehiclebymodelyears'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebymodelyear&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/modalyear.png" alt="<?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?>
									</div>
								</div>
							</a>
			<?php } ?>
			<?php if ($this->links['vbvehiclebytypes'] == 1) { ?>
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebytypes&Itemid=<?php echo $this->Itemid; ?>">
								<div  id="jsautoz_cplinks">
									<div class="cpimage">
										<img width="32" height="32" src="components/com_jsautoz/images/vehicle_types.png" alt="<?php echo JText::_('VEHICLES_BY_TYPE'); ?>" />
									</div>
									<div class="cptext">
										<?php echo JText::_('VEHICLES_BY_TYPE'); ?>
									</div>
								</div>
							</a>
			<?php } ?>
					
				<?php } ?>
			</div>
        </div>
        <?php
    }//ol
    ?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


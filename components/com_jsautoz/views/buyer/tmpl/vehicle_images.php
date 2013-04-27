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
$comma = 0;
$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$document =& JFactory::getDocument();
 $document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);

?>
<div>
<?php if ($this->config['offline'] == '1'){ ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
	<tr><td valign="top" class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></td></tr>
	<tr><td height="25"></td></tr>
	<tr><td class="jsautozmsg">
		<?php echo $this->config['offline_text']; ?>
	</td></tr>
</table>
<?php }else{ ?>
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
							<?php echo JText::_('CUR_LOC'); ?> : <?php echo JText::_('MY_VEHICLES'); ?> ><a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=formvehicle"><?php echo JText::_('VEHICLES_INFORMATION'); ?></a>
						<?php }	?>
					</div>
				<?php } ?>
            </div>
			<?php /*
				if (sizeof($this->buyerlinks) != 0) {
					echo '<div id="autoz_top_links">';
					foreach ($this->buyerlinks as $lnk) {
						?>
						<a class="<?php if($lnk[2] == 1)echo 'first'; elseif($lnk[2] == -1)echo 'last';  ?>" href="<?php echo $lnk[0]; ?>"><?php echo $lnk[1]; ?></a>

					<?php
					}
					echo '</div>';
				}
			 */ ?>
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLE_IMAGES'); ?></span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>

<form action="index.php" method="post" name="adminForm" id="adminForm"  enctype="multipart/form-data" class="form-validate">
	<table cellpadding="5" cellspacing="0" border="1" width="100%" class="adminform">
		<tr>
			<td colspan="3"><input type="file" class="inputbox" name="filename" id="filename" size="20" maxlenght="30"/><input type="submit" rel="button" value="save"/></td>
		</tr>
	</table>
	<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
		<tr> 
			<?php
				$colcount=0;
					foreach ( $this->vehicleimages AS $vehicleimage ){?>
						<?php if($colcount == $colperrow){ echo '</tr><tr>';  $colcount = 0; } $colcount++; 	?>
						<?php echo '<td>'?>
							<div style="max-width: 150px;max-height: 150px;">
								<img  width="100" height="100" src="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicleid;?>/images/thumbs/<?php echo 'jsautoz_m_'.$vehicleimage->filename; ?>"  />
						</div>
						<a  anchor="anchor"  href="index.php?option=com_jsautoz&task=deletevehicleimages&id=<?php echo $vehicleimage->id;?>&Itemid=".$Itemid>Remove </a>
						<?php echo '</td>';
					} ?>
		</tr>
	</table>
        <input type="hidden" name="vehicleid" value="<?php echo $this->vehicleid; ?>" />		
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
		<input type="hidden" name="task" value="savevehicleimages" />
		<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
					
</form>
	
<?php }?>	
	
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


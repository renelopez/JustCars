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
jimport('joomla.html.pane');
JHTML :: _('behavior.calendar');
//JHTMLBehavior::formvalidation();
JHTML::_('behavior.formvalidation');

	$document = &JFactory::getDocument();
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);

$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$td=array('row0','row1');$k=0;
//echo 'dkdk'.$td[$k];
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
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
		<td width="100%" valign="top" align="left">

<script type="text/javascript">
function submitbutton(pressbutton) {
	if (pressbutton) {
		document.adminForm.task.value=pressbutton;
	}
	if(pressbutton == 'save'){
		returnvalue = validate_form(document.adminForm);
	}else returnvalue  = true;
	
	if (returnvalue == true){
		try {
			  document.adminForm.onsubmit();
	        }
		catch(e){}
		document.adminForm.submit();
	}
}

function validate_form(f)
{
        if (document.formvalidator.isValid(f)) {
                f.check.value='<?php if(($jversion == '1.5') || ($jversion == '2.5')) echo JUtility::getToken(); else echo  JSession::getFormToken(); ?>';//send token
        }
        else {
                alert('Some values are not acceptable.  Please retry.');
				return false;
        }
		return true;
}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm" >
    <table cellpadding="3" cellspacing="0" border="0" width="100%">                           <!--Main Table Start-->
        <?php
        foreach($this->fieldorderings as $field){
			switch ($field->field) {
				case "vehicletypeid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td width="25%" valign="top" align="right"><label id="vechiletypeidmsg" for="vechiletypeid"><?php echo JText::_('VEHICLES'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><?php echo $this->lists['vehicletypes']; ?></td>
				   </tr>
				<?php break;
				case "agentid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="agentidmsg" for="agentid"><?php echo JText::_('AGENTID'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><input class="inputbox required" type="text" id="agentid" name="agentid" value="<?php if(isset($this->vehicle))echo $this->vehicle->agentid;?>"/></td>
				   </tr>
				<?php break;
				case "makeid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="makeidmsg" for="makeid"><?php echo JText::_('MAKES'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><?php echo $this->lists['makes']; ?></td>
				   </tr>
				<?php break;
				case "modelid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="modelidmsg" for="modelid"><?php echo JText::_('MODELS'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td id="vf_models"><?php echo $this->lists['models']; ?></td>
				   </tr>
				<?php break;
				case "categoryid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="categoryidmsg" for="categoryid"><?php echo JText::_('CATEGORIES'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><?php echo $this->lists['categories']; ?></td>
				   </tr>
				<?php break;
				case "modelyearid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="modelyearidmsg" for="modelyearid"><?php echo JText::_('MODELYEAR'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><?php echo $this->lists['modelyears']; ?></td>
				   </tr>
				<?php break;
				case "conditionid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="conditionidmsg" for="conditionid"><?php echo JText::_('CONDITION'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['conditions']; ?></td>
					</tr>
				<?php break;
				case "fueltypeid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="fueltypeidmsg" for="fueltypeid"><?php echo JText::_('FUELTYPES'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['fueltypes']; ?></td>
					</tr>
				 <?php break;
				case "cylinderid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="cylinderidmsg" for="cylinderid"><?php echo JText::_('CYLINDERS'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['cylinders']; ?></td>
					</tr>
				<?php break;
				case "transmissionid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="transmissionidmsg" for="transmissionid"><?php echo JText::_('TRANSMISSION'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['transmissions']; ?></td>
					</tr>
				<?php break;
				case "adexpiryid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="adexpiryidmsg" for="adexpiryid"><?php echo JText::_('ADEXPIRY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['adexpiries']; ?></td>
					</tr>
				<?php break;
				case "regcountry": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="regcountrymsg" for="regcountry"><?php echo JText::_('REG_COUNTRY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_regcountry"><?php echo $this->lists['regcountry']?></td>
					</tr>
				<?php break;
				case "regstate": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="regstatemsg" for="regstate"><?php echo JText::_('REG_STATE'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_regstate">
								<?php
								if ((isset($this->lists['regstate'])) && ($this->lists['regstate']!='')){
										echo $this->lists['regstate'];
								} else{ ?>
										<input class="inputbox" type="text" name="regstate" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->regstate; ?>" />
								<?php } ?>
							</td>
					</tr>
				<?php break;
				case "regcounty": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="regcountymsg" for="regcounty"><?php echo JText::_('REG_COUNTY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_regcounty">
								<?php
								if ((isset($this->lists['regcounty'])) && ($this->lists['regcounty']!='')){
										echo $this->lists['regcounty'];
								} else{ ?>
										<input class="inputbox" type="text" name="regcounty" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->regcounty; ?>" />
								<?php } ?>
							</td>
					</tr>
				<?php break;
				case "regcity": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="regcitymsg" for="regcity"><?php echo JText::_('REG_CITY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_regcity">
								 <?php
								if ((isset($this->lists['regcity'])) && ($this->lists['regcity']!='')){
										echo $this->lists['regcity'];
								} else{ ?>
										<input class="inputbox" type="text" name="regcity" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->regcity; ?>" />
								<?php } ?>
							</td>
					</tr>
				<?php break;
				case "loccountry": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td valign="top" align="right"><label id="loccountrymsg" for="loccountry"><?php echo JText::_('LOC_COUNTRY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td id="vehicleform_loccountry"><?php echo $this->lists['loccountry']; ?></td>
					</tr>
				<?php break;
				case "locstate": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="locstatemsg" for="locstate"><?php echo JText::_('LOC_STATE'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_locstate">
								<?php
								if ((isset($this->lists['locstate'])) && ($this->lists['locstate']!='')){
										echo $this->lists['locstate'];
								} else{ ?>
										<input class="inputbox" type="text" name="locstate" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->locstate; ?>" />
								<?php } ?>
							</td>
					</tr>
				<?php break;
				case "loccounty": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="loccountymsg" for="loccounty"><?php echo JText::_('LOC_COUNTY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_loccounty">
								<?php
								if ((isset($this->lists['loccounty'])) && ($this->lists['loccounty']!='')){
										echo $this->lists['loccounty'];
								} else{ ?>
										<input class="inputbox" type="text" name="loccounty" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->loccounty; ?>" />
								<?php } ?>
							</td>

					</tr>
				<?php break;
				case "loccity": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="loccitymsg" for="loccity"><?php echo JText::_('LOC_CITY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td id="vehicleform_loccity">
								 <?php
								if ((isset($this->lists['loccity'])) && ($this->lists['loccity']!='')){
										echo $this->lists['loccity'];
								} else{ ?>
										<input class="inputbox" type="text" name="loccity" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->loccity; ?>" />
								<?php } ?>
							</td>

					</tr>
				<?php break;
				case "mileages": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="mileagesmsg" for="mileages"><?php echo JText::_('MILEAGES'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="mileages" name="mileages" value="<?php if(isset($this->vehicle))echo $this->vehicle->mileages;?>"/></td>
					</tr>
				<?php break;
				case "mileagetypeid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="mileagetypeidmsg" for="mileagetypeid"><?php echo JText::_('MILEAGESTYPEID'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this-> lists['mileagetypes']; ?></td>
					</tr>
				<?php break;
				case "price": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="pricemsg" for="price"><?php echo JText::_('PRICE'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="price" name="price" value="<?php if(isset($this->vehicle)) echo $this->vehicle->price; ?>"/></td>
					</tr>
				<?php break;
				case "exteriorcolor": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="exteriorcolormsg" for="exteriorcolor"><?php echo JText::_('EXTERIORCOLOR'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="exteriorcolor" name="exteriorcolor" value="<?php if(isset($this->vehicle))echo $this->vehicle->exteriorcolor;?>"/></td>
					</tr>
				<?php break;
				case "interiorcolor": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="interiorcolormsg" for="interiorcolor"><?php echo JText::_('INTERIORCOLOR'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="interiorcolor" name="interiorcolor" value="<?php if(isset($this->vehicle))echo $this->vehicle->interiorcolor;?>"/></td>
					</tr>
				<?php break;
				case "enginecapacity": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="enginecapacitymsg" for="enginecapacity"><?php echo JText::_('ENGINECAPACITY'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="enginecapacity" name="enginecapacity" value="<?php if(isset($this->vehicle))echo $this->vehicle->enginecapacity;?>"/></td>
					</tr>
				<?php break;
				case "cityfuelconsumption": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="cityfuelconsumptionmsg" for="cityfuelconsumption"><?php echo JText::_('CITYFUELCONSUMPTION'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="cityfuelconsumption" name="cityfuelconsumption" value="<?php if(isset($this->vehicle))echo $this->vehicle->cityfuelconsumption;?>"/></td>
					</tr>
				<?php break;
				case "highwayfuelconsumption": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="highwayfuelconsumptionmsg" for="highwayfuelconsumption"><?php echo JText::_('HIGHWAYFUELCONSUMPTION'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="highwayfuelconsumption" name="highwayfuelconsumption" value="<?php if(isset($this->vehicle))echo $this->vehicle->highwayfuelconsumption;?>"/></td>
					</tr>
				<?php break;
				case "map": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="mapmsg" for="map"><?php echo JText::_('MAP'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="map" name="map" value="<?php if(isset($this->vehicle))echo $this->vehicle->map;?>"/></td>
					</tr>
				<?php break;
				case "video": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
							<td valign="top" align="right"><label id="videomsg" for="video"><?php echo JText::_('VIDEO'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="video" name="video" value="<?php if(isset($this->vehicle))echo $this->vehicle->video;?>"/></td>
					</tr>
				<?php break;
				case "description": ?>
					<?php if ( $field->published == 1 ) { ?>
							<?php if ( $this->config['vf_editor'] == '1' ) { ?>
										<tr><td height="10" colspan="2"></td></tr>
										<tr class="<?php echo $td[$k];$k=1-$k;?>">
											<td colspan="2" valign="top" align="center"><label id="descriptionmsg" for="description"><strong><?php echo JText::_('DESCRIPTION'); ?></strong></label>&nbsp;<font color="red">*</font></td>
										</tr>
										<tr>
											<td colspan="2" align="center">
										<?php
												$editor =& JFactory::getEditor();
												if(isset($this->vehicle))
												echo $editor->display('description', $this->vehicle->description, '550', '300', '60', '20', false);
												else
												echo $editor->display('description', '', '550', '300', '60', '20', false);
										?>
											</td>
										</tr>
								<?php 	} else 	{?>
											<tr class="<?php echo $td[$k];$k=1-$k;?>">
												<td valign="top" align="right"><label id="descriptionmsg" for="description"><?php echo JText::_('DESCRIPTION'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
												<td><textarea  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="description" name="description" value="<?php if(isset($this->vehicle))echo $this->vehicle->description;?>"></textarea></td>
											</tr>
								<?php } ?>
				<?php   } ?>
			   <?php break;
			}
        }?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		        <tr>
		            <th valign="top" align="left" font="72" >Vehicle Options (check any that apply)</th>
		        </tr>
		</table>
		<table cellpadding="3" cellspacing="0" border="1" width="100%">
			<?php
			$colcount=1;
           foreach($this->fieldorderings_options as $field){
              switch ($field->field) {
				  case "section_body": ?>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							<table cellpadding="3" cellspacing="0" border="0" width="100%">
								<tr>
									   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('BODY'); ?></b></td>
								</tr>
								<?php break;
								  case "door2": ?>
									<tr>
											<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door2' id='door2' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door2 == 1) ? "checked='checked'" : ""; } ?> /><label for="door2"><?php  echo JText::_('2_DOOR'); ?></label></td>
								<?php break;
								case "door3": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door3' id='door3' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door3 == 1) ? "checked='checked'" : ""; } ?> /><label for="door3"><?php  echo JText::_('3_DOOR'); ?></label></td>
								<?php break;
								case "door4": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door4' id='door4' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door4 == 1) ? "checked='checked'" : ""; } ?> /><label for="door4"><?php  echo JText::_('4_DOOR'); ?></label></td>
								<?php break;
								case "covertible": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='covertible' id='covertible' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->covertible == 1) ? "checked='checked'" : ""; } ?> /><label for="covertible"><?php  echo JText::_('COVER_TIBLE'); ?></label></td>
								<?php break;
								case "crewcab": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='crewcab' id='crewcab' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->crewcab == 1) ? "checked='checked'" : ""; } ?> /><label for="crewcab"><?php  echo JText::_('CREW_CAB'); ?></label></td>
								<?php break;
								case "extendedcab": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='extendedcab' id='extendedcab' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->extendedcab == 1) ? "checked='checked'" : ""; } ?> /><label for="extendedcab"><?php  echo JText::_('EXTENDED_CAB'); ?></label></td>
								<?php break;
								case "longbox": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='longbox' id='longbox' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->longbox == 1) ? "checked='checked'" : ""; } ?> /><label for="longbox"><?php  echo JText::_('LONG_BOX'); ?></label></td>
								<?php break;
								case "offroadpackage": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;  ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='offroadpackage' id='offroadpackage' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->offroadpackage== 1) ? "checked='checked'" : ""; } ?> /><label for="offroadpackage"><?php  echo JText::_('OFFROAD_PACKAGE'); ?></label></td>
								<?php break;
								case "shortbox": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='shortbox' id='shortbox' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->shortbox== 1) ? "checked='checked'" : ""; } ?> /><label for="shortbox"><?php  echo JText::_('SHORT_BOX'); ?></label></td>
								<?php break;
								case "section_drivetrain":
									for($i = $colcount; $i < $colperrow; $i++){
										echo '<td></td>';
									}
									echo '</tr>';
									$colcount=0;
									?>
							</table>
						</td>
					</tr>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('DRIVE_TRAIN'); ?></b></td>
									</tr>
									<?php break;
									case "wheeldrive2": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='wheeldrive2' id='wheeldrive2' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->wheeldrive2== 1) ? "checked='checked'" : ""; } ?> /><label for="wheeldrive2"><?php  echo JText::_('2_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "wheeldrive4": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='wheeldrive4' id='wheeldrive4' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->wheeldrive4== 1) ? "checked='checked'" : ""; } ?> /><label for="wheeldrive4"><?php  echo JText::_('4_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "allwheeldrive": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='allwheeldrive'id='allwheeldrive' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->allwheeldrive== 1) ? "checked='checked'" : ""; } ?> /><label for="allwheeldrive"><?php  echo JText::_('ALL_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "rearwheeldrive": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearwheeldrive' id='rearwheeldrive' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearwheeldrive== 1) ? "checked='checked'" : ""; } ?> /><label for="rearwheeldrive"><?php  echo JText::_('REAR_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "supercharged": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='supercharged' id='supercharged' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->supercharged== 1) ? "checked='checked'" : ""; } ?> /><label for="supercharged"><?php  echo JText::_('SUPER_CHARGED'); ?></label></td>
									<?php break;
									case "turbo": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='turbo' id='turbo' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->turbo== 1) ? "checked='checked'" : ""; } ?> /><label for="turbo"><?php  echo JText::_('TURBO'); ?></label></td>
									<?php break;
									case "section_exterior":
										for($i = $colcount; $i < $colperrow; $i++){
											echo '<td></td>';
										}
										echo '</tr>';
										$colcount=0;
										?>
							</table>
						</td>
					</tr>

					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('EXTERIOR'); ?></b></td>
									</tr>
									<?php break;
									case "alloywheels": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='alloywheels' id='alloywheels' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->alloywheels== 1) ? "checked='checked'" : ""; } ?> /><label for="alloywheels"><?php  echo JText::_('ALLOY_WHEELS'); ?></label></td>
									<?php break;
									case "bedliner": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bedliner' id='bedliner' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bedliner== 1) ? "checked='checked'" : ""; } ?> /><label for="bedliner"><?php  echo JText::_('BED_LINER'); ?></label></td>
									<?php break;
									case "bugshield": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bugshield'id='bugshield' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bugshield== 1) ? "checked='checked'" : ""; } ?> /><label for="bugshield"><?php  echo JText::_('BUG_SHIELD'); ?></label></td>
									<?php break;
									case "campermirrors": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='campermirrors' id='campermirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->campermirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="campermirrors"><?php  echo JText::_('CAMPER_MIRRORS'); ?></label></td>
									<?php break;
									case "cargocover": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cargocover' id='cargocover' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cargocover== 1) ? "checked='checked'" : ""; } ?> /><label for="cargocover"><?php  echo JText::_('CARGO_COVER'); ?></label></td>
									<?php break;
									case "customwheels": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='customwheels' id='customwheels' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->customwheels== 1) ? "checked='checked'" : ""; } ?> /><label for="customwheels"><?php  echo JText::_('CUSTOM_WHEELS'); ?></label></td>
									<?php break;
									case "dualslidingdoors": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualslidingdoors' id='dualslidingdoors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualslidingdoors== 1) ? "checked='checked'" : ""; } ?> /><label for="dualslidingdoors"><?php  echo JText::_('DUAL_SLIDING_DOORS'); ?></label></td>
									<?php break;
									case "foglamps": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='foglamps' id='foglamps' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->foglamps== 1) ? "checked='checked'" : ""; } ?> /><label for="foglamps"><?php  echo JText::_('FOG_LAMPS'); ?></label></td>
									<?php break;
									case "heatedwindshield": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedwindshield' id='heatedwindshield' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedwindshield== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedwindshield"><?php  echo JText::_('HEATED_WIND_SHIELD'); ?></label></td>
									<?php break;
									case "immitationconvertibletop": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='immitationconvertibletop' id='immitationconvertibletop' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->immitationconvertibletop== 1) ? "checked='checked'" : ""; } ?> /><label for="immitationconvertibletop"><?php  echo JText::_('IMMITATION_CONVERTIBLE_TOP'); ?></label></td>
									<?php break;
									case "luggagerack": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='luggagerack' id='luggagerack' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->luggagerack== 1) ? "checked='checked'" : ""; } ?> /><label for="luggagerack"><?php  echo JText::_('LUGGAGE_RACK'); ?></label></td>
									<?php break;
									case "metallicpaint": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='metallicpaint' id='metallicpaint' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->metallicpaint== 1) ? "checked='checked'" : ""; } ?> /><label for="metallicpaint"><?php  echo JText::_('METALLIC_PAINT'); ?></label></td>
									<?php break;
									case "nerfbars": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='nerfbars' id='nerfbars' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->nerfbars== 1) ? "checked='checked'" : ""; } ?> /><label for="nerfbars"><?php  echo JText::_('NERF_BARS'); ?></label></td>
									<?php break;
									case "newtires": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='newtires' id='newtires' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->newtires== 1) ? "checked='checked'" : ""; } ?> /><label for="newtires"><?php  echo JText::_('NEW_TIRES'); ?></label></td>
									<?php break;
									case "premiumwheels": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='premiumwheels' id='premiumwheels' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->premiumwheels== 1) ? "checked='checked'" : ""; } ?> /><label for="premiumwheels"><?php  echo JText::_('PREMIUM_WHEELSS'); ?></label></td>
									<?php break;
									case "rearwiper": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearwiper' id='rearwiper' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearwiper== 1) ? "checked='checked'" : ""; } ?> /><label for="rearwiper"><?php  echo JText::_('REAR_WIPER'); ?></label></td>
									<?php break;
									case "removeabletop": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='removeabletop' id='removeabletop' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->removeabletop== 1) ? "checked='checked'" : ""; } ?> /><label for="removeabletop"><?php  echo JText::_('REMOVEABLE_TOP'); ?></label></td>
									<?php break;
									case "ridecontrol": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ridecontrol' id='ridecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ridecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="ridecontrol"><?php  echo JText::_('RIDE_CONTROL'); ?></label></td>
									<?php break;
									case "runningboards": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='runningboards' id='runningboards' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->runningboards== 1) ? "checked='checked'" : ""; } ?> /><label for="runningboards"><?php  echo JText::_('RUNNING_BOARDS'); ?></label></td>
									<?php break;
									case "splashquards": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='splashquards' id='splashquards' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->splashquards== 1) ? "checked='checked'" : ""; } ?> /><label for="splashquards"><?php  echo JText::_('SPLASH_QUARDS'); ?></label></td>
									<?php break;
									case "spoiler": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='spoiler' id='spoiler' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->spoiler== 1) ? "checked='checked'" : ""; } ?> /><label for="spoiler"><?php  echo JText::_('SPOILER'); ?></label></td>
									<?php break;
									case "sunroof": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='sunroof' id='sunroof' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->sunroof== 1) ? "checked='checked'" : ""; } ?> /><label for="sunroof"><?php  echo JText::_('SUN_ROOF'); ?></label></td>
									<?php break;
									case "ttops": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ttops' id='ttops' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ttops== 1) ? "checked='checked'" : ""; } ?> /><label for="ttops"><?php  echo JText::_('T_TOPS'); ?></label></td>
									<?php break;
									case "tonneaucover": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tonneaucover' id='tonneaucover' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tonneaucover== 1) ? "checked='checked'" : ""; } ?> /><label for="tonneaucover"><?php  echo JText::_('TONNEAU_COVER'); ?></label></td>
									<?php break;
									case "towingpackage": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='towingpackage' id='towingpackage' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->towingpackage== 1) ? "checked='checked'" : ""; } ?> /><label for="towingpackage"><?php  echo JText::_('TOWIN_PACKAGE'); ?></label></td>
									<?php break;
									case "section_interior":
										for($i = $colcount; $i < $colperrow; $i++){
											echo '<td></td>';
										}
										echo '</tr>';
										$colcount=0;
										?>
							</table>
						</td>
					</tr>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('INTERIOR'); ?></b></td>
									</tr>
									<?php break;
									case "ndrowbucketseats2": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ndrowbucketseats2' id='ndrowbucketseats2' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ndrowbucketseats2== 1) ? "checked='checked'" : ""; } ?> /><label for="ndrowbucketseats2"><?php  echo JText::_('NDROW_BUCKET_SEATS2'); ?></label></td>
									<?php break;
									case "rdrowseat3": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rdrowseat3' id='rdrowseat3' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rdrowseat3== 1) ? "checked='checked'" : ""; } ?> /><label for="rdrowseat3"><?php  echo JText::_('RDROWSEAT3'); ?></label></td>
									<?php break;
									case "adjustablefootpedals": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='adjustablefootpedals'id='adjustablefootpedals' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->adjustablefootpedals== 1) ? "checked='checked'" : ""; } ?> /><label for="adjustablefootpedals"><?php  echo JText::_('ADJUSTABLE_FOOT_PEDALS'); ?></label></td>
									<?php break;
									case "airconditioning": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='airconditioning' id='airconditioning' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->airconditioning== 1) ? "checked='checked'" : ""; } ?> /><label for="airconditioning"><?php  echo JText::_('AIR_CONDITIONING'); ?></label></td>
									<?php break;
									case "autodimisrvmirror": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='autodimisrvmirror' id='autodimisrvmirror' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->autodimisrvmirror== 1) ? "checked='checked'" : ""; } ?> /><label for="autodimisrvmirror"><?php  echo JText::_('AUTO_DIMISRV_MIRROR'); ?></label></td>
									<?php break;
									case "bucketseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bucketseats' id='bucketseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bucketseats== 1) ? "checked='checked'" : ""; } ?> /><label for="bucketseats"><?php  echo JText::_('BUCKET_SEATS'); ?></label></td>
									<?php break;
									case "centerconsole": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='centerconsole' id='centerconsole' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->centerconsole== 1) ? "checked='checked'" : ""; } ?> /><label for="centerconsole"><?php  echo JText::_('CENTER_CONSOLE'); ?></label></td>
									<?php break;
									case "childseat": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='childseat' id='childseat' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->childseat== 1) ? "checked='checked'" : ""; } ?> /><label for="childseat"><?php  echo JText::_('CHILD_SEAT'); ?></label></td>
									<?php break;
									case "cooledseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cooledseats' id='cooledseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cooledseats== 1) ? "checked='checked'" : ""; } ?> /><label for="cooledseats"><?php  echo JText::_('COOLED_SEATS'); ?></label></td>
									<?php break;
									case "cruisecontrol": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cruisecontrol' id='cruisecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cruisecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="cruisecontrol"><?php  echo JText::_('CRUISE_CONTROL'); ?></label></td>
									<?php break;
									case "dualclimatecontrol": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualclimatecontrol' id='dualclimatecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualclimatecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="dualclimatecontrol"><?php  echo JText::_('DUAL_CLIMATE_CONTROL'); ?></label></td>
									<?php break;
									case "heatedmirrirs": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedmirrirs' id='heatedmirrirs' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedmirrirs== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedmirrirs"><?php  echo JText::_('HEATED_MIRRIRS'); ?></label></td>
									<?php break;
									case "heatedseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedseats' id='heatedseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedseats== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedseats"><?php  echo JText::_('HEATED_SEATS'); ?></label></td>
									<?php break;
									case "leatherseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='leatherseats' id='leatherseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->leatherseats== 1) ? "checked='checked'" : ""; } ?> /><label for="leatherseats"><?php  echo JText::_('LEATHER_SEATS'); ?></label></td>
									<?php break;
									case "power3rdrowseat": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='power3rdrowseat' id='power3rdrowseat' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->power3rdrowseat== 1) ? "checked='checked'" : ""; } ?> /><label for="power3rdrowseat"><?php  echo JText::_('POWER_3RD_ROW_SEAT'); ?></label></td>
									<?php break;
									case "powerdoorlocks": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerdoorlocks' id='powerdoorlocks' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerdoorlocks== 1) ? "checked='checked'" : ""; } ?> /><label for="powerdoorlocks"><?php  echo JText::_('POWER_DOOR_LOCKS'); ?></label></td>
									<?php break;
									case "powermirrors": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powermirrors' id='powermirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powermirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="powermirrors"><?php  echo JText::_('POWER_MIRRIORS'); ?></label></td>
									<?php break;
									case "powerseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerseats' id='powerseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerseats== 1) ? "checked='checked'" : ""; } ?> /><label for="powerseats"><?php  echo JText::_('POWER_SEATS'); ?></label></td>
									<?php break;
									case "powersteering": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powersteering' id='powersteering' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powersteering== 1) ? "checked='checked'" : ""; } ?> /><label for="powersteering"><?php  echo JText::_('POWER_STEERING'); ?></label></td>
									<?php break;
									case "powerwindows": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerwindows' id='powerwindows' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerwindows== 1) ? "checked='checked'" : ""; } ?> /><label for="powerwindows"><?php  echo JText::_('POWER_WINDOWS'); ?></label></td>
									<?php break;
									case "rearairconditioning": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearairconditioning' id='rearairconditioning' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearairconditioning== 1) ? "checked='checked'" : ""; } ?> /><label for="rearairconditioning"><?php  echo JText::_('REAR_AIR_CONDITIONING'); ?></label></td>
									<?php break;
									case "reardefrost": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='reardefrost' id='reardefrost' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->reardefrost== 1) ? "checked='checked'" : ""; } ?> /><label for="reardefrost"><?php  echo JText::_('REAR_DEFROST'); ?></label></td>
									<?php break;
									case "rearslidingwindow": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearslidingwindow' id='rearslidingwindow' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearslidingwindow== 1) ? "checked='checked'" : ""; } ?> /><label for="rearslidingwindow"><?php  echo JText::_('REAR_SLIDING_WINDOW'); ?></label></td>
									<?php break;
									case "tiltsteering": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tiltsteering' id='tiltsteering' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tiltsteering== 1) ? "checked='checked'" : ""; } ?> /><label for="tiltsteering"><?php  echo JText::_('TILT_STEERING'); ?></label></td>
									<?php break;
									case "tintedwindows": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tintedwindows' id='tintedwindows' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tintedwindows== 1) ? "checked='checked'" : ""; } ?> /><label for="tintedwindows"><?php  echo JText::_('TINTED_WINDOWS'); ?></label></td>
									<?php break;
									case "section_electronics":
										for($i = $colcount; $i < $colperrow; $i++){
											echo '<td></td>';
										}
										echo '</tr>';
										$colcount=0;
										?>
							</table>
						</td>
					</tr>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('ELECTRONICS'); ?></b></td>
									</tr>
									<?php break;
									case "alarm": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='alarm' id='alarm' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->alarm== 1) ? "checked='checked'" : ""; } ?> /><label for="alarm"><?php  echo JText::_('ALARM'); ?></label></td>
									<?php break;
									case "amfmradio": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='amfmradio' id='amfmradio' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->amfmradio== 1) ? "checked='checked'" : ""; } ?> /><label for="amfmradio"><?php  echo JText::_('AMFM_RADIO'); ?></label></td>
									<?php break;
									case "antitheft": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='antitheft'id='antitheft' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->antitheft== 1) ? "checked='checked'" : ""; } ?> /><label for="antitheft"><?php  echo JText::_('ANTI_THEFT'); ?></label></td>
									<?php break;
									case "cdchanger": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cdchanger' id='cdchanger' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cdchanger== 1) ? "checked='checked'" : ""; } ?> /><label for="cdchanger"><?php  echo JText::_('CD_CHANGER'); ?></label></td>
									<?php break;
									case "cdplayer": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cdplayer' id='cdplayer' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cdplayer== 1) ? "checked='checked'" : ""; } ?> /><label for="cdplayer"><?php  echo JText::_('CD_PLAYER'); ?></label></td>
									<?php break;
									case "dualdvds": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualdvds' id='dualdvds' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualdvds== 1) ? "checked='checked'" : ""; } ?> /><label for="dualdvds"><?php  echo JText::_('DUAL_DVDS'); ?></label></td>
									<?php break;
									case "dvdplayer": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dvdplayer' id='dvdplayer' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dvdplayer== 1) ? "checked='checked'" : ""; } ?> /><label for="dvdplayer"><?php  echo JText::_('DVD_PLAYER'); ?></label></td>
									<?php break;
									case "handsfreecomsys": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='handsfreecomsys' id='handsfreecomsys' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->handsfreecomsys== 1) ? "checked='checked'" : ""; } ?> /><label for="handsfreecomsys"><?php  echo JText::_('HANDSFREE_COM_SYS'); ?></label></td>
									<?php break;
									case "homelink": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='homelink' id='homelink' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->homelink== 1) ? "checked='checked'" : ""; } ?> /><label for="homelink"><?php  echo JText::_('HOME_LINK'); ?></label></td>
									<?php break;
									case "informationcenter": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='informationcenter' id='informationcenter' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->informationcenter== 1) ? "checked='checked'" : ""; } ?> /><label for="informationcenter"><?php  echo JText::_('INFORMATION_CENTER'); ?></label></td>
									<?php break;
									case "integratedphone": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='integratedphone' id='integratedphone' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->integratedphone== 1) ? "checked='checked'" : ""; } ?> /><label for="integratedphone"><?php  echo JText::_('INTEGRATED_PHONE'); ?></label></td>
									<?php break;
									case "ipodport": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ipodport' id='ipodport' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ipodport== 1) ? "checked='checked'" : ""; } ?> /><label for="ipodport"><?php  echo JText::_('IPOD_PORT'); ?></label></td>
									<?php break;
									case "ipodmp3port": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ipodmp3port' id='ipodmp3port' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ipodmp3port== 1) ? "checked='checked'" : ""; } ?> /><label for="ipodmp3port"><?php  echo JText::_('IPOD_MP3_PORT'); ?></label></td>
									<?php break;
									case "keylessentry": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='keylessentry' id='keylessentry' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->keylessentry== 1) ? "checked='checked'" : ""; } ?> /><label for="keylessentry"><?php  echo JText::_('KEY_LESSENTRY'); ?></label></td>
									<?php break;
									case "memoryseats": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='memoryseats' id='memoryseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->memoryseats== 1) ? "checked='checked'" : ""; } ?> /><label for="memoryseats"><?php  echo JText::_('MEMORY_SEATS'); ?></label></td>
									<?php break;
									case "navigationsystem": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='navigationsystem' id='navigationsystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->navigationsystem== 1) ? "checked='checked'" : ""; } ?> /><label for="navigationsystem"><?php  echo JText::_('NAVIGATION_SYSTEM'); ?></label></td>
									<?php break;
									case "onstar": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='onstar' id='onstar' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->onstar== 1) ? "checked='checked'" : ""; } ?> /><label for="onstar"><?php  echo JText::_('ON_STAR'); ?></label></td>
									<?php break;
									case "backupcameraandmirror": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='backupcameraandmirror' id='backupcameraandmirror' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->backupcameraandmirror== 1) ? "checked='checked'" : ""; } ?> /><label for="backupcameraandmirror"><?php  echo JText::_('BACKUP_CAMERAAND_MIRROR'); ?></label></td>
									<?php break;
									case "parkassistrear": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='parkassistrear' id='parkassistrear' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->parkassistrear== 1) ? "checked='checked'" : ""; } ?> /><label for="parkassistrear"><?php  echo JText::_('PARK_ASSISTREAR'); ?></label></td>
									<?php break;
									case "powerliftgate": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerliftgate' id='powerliftgate' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerliftgate== 1) ? "checked='checked'" : ""; } ?> /><label for="powerliftgate"><?php  echo JText::_('POWER_LIFT_GATE'); ?></label></td>
									<?php break;
									case "rearlockingdifferential": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearlockingdifferential' id='rearlockingdifferential' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearlockingdifferential== 1) ? "checked='checked'" : ""; } ?> /><label for="rearlockingdifferential"><?php  echo JText::_('REAR_LOCKING_DIFFERENTIAL'); ?></label></td>
									<?php break;
									case "rearstereo": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearstereo' id='rearstereo' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearstereo== 1) ? "checked='checked'" : ""; } ?> /><label for="rearstereo"><?php  echo JText::_('REAR_STEREO'); ?></label></td>
									<?php break;
									case "remotestart": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='remotestart' id='remotestart' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->remotestart== 1) ? "checked='checked'" : ""; } ?> /><label for="remotestart"><?php  echo JText::_('REMOTE_START'); ?></label></td>
									<?php break;
									case "satelliteradio": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='satelliteradio' id='satelliteradio' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->satelliteradio== 1) ? "checked='checked'" : ""; } ?> /><label for="satelliteradio"><?php  echo JText::_('SATELLITE_RADIO'); ?></label></td>
									<?php break;
									case "steeringwheelcontrols": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='steeringwheelcontrols' id='steeringwheelcontrols' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->steeringwheelcontrols== 1) ? "checked='checked'" : ""; } ?> /><label for="steeringwheelcontrols"><?php  echo JText::_('STEERING_WHEEL_CONTROLS'); ?></label></td>
									<?php break;
									case "stereotape": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='stereotape' id='stereotape' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->stereotape== 1) ? "checked='checked'" : ""; } ?> /><label for="stereotape"><?php  echo JText::_('STEREO_TAPE'); ?></label></td>
									<?php break;
									case "tirepressuremonitorsystem": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tirepressuremonitorsystem' id='tirepressuremonitorsystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tirepressuremonitorsystem== 1) ? "checked='checked'" : ""; } ?> /><label for="tirepressuremonitorsystem"><?php  echo JText::_('TIRE_PREEEURE_MONITOR_SYSTEM'); ?></label></td>
									<?php break;
									case "trailerbrakesystem": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='trailerbrakesystem' id='trailerbrakesystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->trailerbrakesystem== 1) ? "checked='checked'" : ""; } ?> /><label for="trailerbrakesystem"><?php  echo JText::_('TRAILER_BRAKE_SYSTEM'); ?></label></td>
									<?php break;
									case "tripmileagecomputer": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tripmileagecomputer' id='tripmileagecomputer' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tripmileagecomputer== 1) ? "checked='checked'" : ""; } ?> /><label for="tripmileagecomputer"><?php  echo JText::_('TRIP_MILEAGE_COMPUTER'); ?></label></td>
									<?php break;
									case "tv": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tv' id='tv' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tv== 1) ? "checked='checked'" : ""; } ?> /><label for="tv"><?php  echo JText::_('TV'); ?></label></td>
									<?php break;
									case "section_safetyfeatures":
										for($i = $colcount; $i < $colperrow; $i++){
											echo '<td></td>';
										}
										echo '</tr>';
										$colcount=0;
										?>
							</table>
						</td>
					</tr>
					<tr class="<?php echo $td[$k];$k=1-$k;?>">
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('SAFETY_FEATURES'); ?></b></td>
									</tr>
									<?php break;
									case "antilockbrakes": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='antilockbrakes' id='antilockbrakes' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->antilockbrakes== 1) ? "checked='checked'" : ""; } ?> /><label for="antilockbrakes"><?php  echo JText::_('ANTI_LOCK_BRAKES'); ?></label></td>
									<?php break;
									case "backupsensors": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='backupsensors' id='backupsensors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->backupsensors== 1) ? "checked='checked'" : ""; } ?> /><label for="backupsensors"><?php  echo JText::_('BACKUP_SENSORS'); ?></label></td>
									<?php break;
									case "cartracker": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cartracker'id='cartracker' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cartracker== 1) ? "checked='checked'" : ""; } ?> /><label for="cartracker"><?php  echo JText::_('CAR_TRACKER'); ?></label></td>
									<?php break;
									case "driverairbag": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='driverairbag' id='driverairbag' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->driverairbag== 1) ? "checked='checked'" : ""; } ?> /><label for="driverairbag"><?php  echo JText::_('DRIVER_AIR_BAG'); ?></label></td>
									<?php break;
									case "passengerairbag": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='passengerairbag' id='passengerairbag' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->passengerairbag== 1) ? "checked='checked'" : ""; } ?> /><label for="passengerairbag"><?php  echo JText::_('PASSENGER_AIR_BAG'); ?></label></td>
									<?php break;
									case "rearairbags": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearairbags' id='rearairbags' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearairbags== 1) ? "checked='checked'" : ""; } ?> /><label for="rearairbags"><?php  echo JText::_('REAR_AIR_BAG'); ?></label></td>
									<?php break;
									case "sideairbags": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='sideairbags' id='sideairbags' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->sideairbags== 1) ? "checked='checked'" : ""; } ?> /><label for="sideairbags"><?php  echo JText::_('SIDE_AIR_BAG'); ?></label></td>
									<?php break;
									case "signalmirrors": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='signalmirrors' id='signalmirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->signalmirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="signalmirrors"><?php  echo JText::_('SIGNAL_MIRRORS'); ?></label></td>
									<?php break;
									case "tractioncontrol": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tractioncontrol' id='tractioncontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tractioncontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="tractioncontrol"><?php  echo JText::_('TRACTION_CONTROL'); ?></label></td>
									<?php break;
										?>
							</table>
						</td>
					</tr>
					<?php
					}
				}?>
					<?php
					   for($i = $colcount; $i < $colperrow; $i++){
							echo '<td></td>';
						}
					?>
		</table>
				<input type="hidden" name="id" value="<?php if(isset($this->vehicle)) echo $this->vehicle->id; ?>"/>
				<input type="hidden" name="vehicleoptionid" value="<?php if(isset($this->vehicleoptions)) echo $this->vehicleoptions->id; ?>"/>
				<input type="hidden" name="option" value="<?php echo $option; ?>" />
				<input type="hidden" name="task" value="savevehicle" />
				<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
					<tr>
						<td colspan="2" valign="top" align="center"><input class="button" type="submit" onclick="return validate_form(document.adminForm)" name="submit_app"  value="<?php echo JText::_('SAVE_VEHICLE'); ?>" /></td>
				    </tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>
</form>
                    </table>
<script language=Javascript>
function getvfmodels(val, req){
	var pagesrc = 'vf_models';
        document.getElementById(pagesrc).innerHTML="Loading ...";
	var xhr;
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
	catch (e) {
		try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
		catch (e2) {
		  try {  xhr = new XMLHttpRequest();     }
		  catch (e3) {  xhr = false;   }
		}
	 }

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById(pagesrc).innerHTML=xhr.responseText; //retuen value
            }
        }

	xhr.open("GET","index2.php?option=com_jsautoz&task=listmodels&val="+val+"&req="+req,true);
	xhr.send(null);
}

function geteregaddressdata(src, val){
        var pagesrc = 'vehicleform_reg'+src;
	document.getElementById(pagesrc).innerHTML="Loading ...";
	var xhr;
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
	catch (e)
	{
		try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
		catch (e2)
		{
		  try {  xhr = new XMLHttpRequest();     }
		  catch (e3) {  xhr = false;   }
		}
	 }
	xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
        	document.getElementById(pagesrc).innerHTML=xhr.responseText; //retuen value
			if(src=='state'){
                                countyhtml = "<input class='inputbox' type='text' name='regcounty' size='40' maxlength='100'  />";
				cityhtml = "<input class='inputbox' type='text' name='regcity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_regcounty').innerHTML=countyhtml; //retuen value
				document.getElementById('vehicleform_regcity').innerHTML=cityhtml; //retuen value
			}else if(src=='county'){
                                cityhtml = "<input class='inputbox' type='text' name='regcity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_regcity').innerHTML=cityhtml; //retuen value
			}
      }
    }
       	xhr.open("GET","index2.php?option=com_jsautoz&task=listregaddressdata&data="+src+"&val="+val,true);
	xhr.send(null);
}
function getlocaddressdata(src, val){
        var pagesrc = 'vehicleform_loc'+src;
	document.getElementById(pagesrc).innerHTML="Loading ...";
	var xhr;
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
	catch (e)
	{
		try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
		catch (e2)
		{
		  try {  xhr = new XMLHttpRequest();     }
		  catch (e3) {  xhr = false;   }
		}
	 }
	xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){
        	document.getElementById(pagesrc).innerHTML=xhr.responseText; //retuen value
			if(src=='state'){
				countyhtml = "<input class='inputbox' type='text' name='loccounty' size='40' maxlength='100'  />";
				cityhtml = "<input class='inputbox' type='text' name='loccity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_loccounty').innerHTML=countyhtml; //retuen value
				document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
			}else if(src=='county'){
				cityhtml = "<input class='inputbox' type='text' name='loccity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
			}
      }
    }
        
	xhr.open("GET","index2.php?option=com_jsautoz&task=listlocaddressdata&data="+src+"&val="+val,true);
	xhr.send(null);
}
</script>


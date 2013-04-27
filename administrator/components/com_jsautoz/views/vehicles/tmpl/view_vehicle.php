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
  global $mainframe;
JRequest :: setVar('layout', 'view_vehicle');
$_SESSION['cur_layout']='view_vehicle';
$comma = 0;
$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $mainframe->getBasePath(); ?>components/com_jsautoz/css/<?php echo $this->config['theme']; ?>" />
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

  <?php //if(isset($this->vehicle)) ?>
 <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
<?php
                $trclass = array("odd", "even");
		$i = 0;
		$isodd = 0;
		foreach($this->fieldorderings as $field){
			//echo '<br> uf'.$field->field;
			switch ($field->field) {
				case "vehicletypeid": $isodd = 1 - $isodd; ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('VEHICLES'); ?></b></td>
						<td><?php echo $this->vehicle->vehicletitle; ?></td>
				      </tr>
				<?php break;
				case "makeid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MAKES'); ?></b></td>
						<td><?php echo $this->vehicle->maketitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "modelid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MODELS'); ?></b></td>
						<td><?php echo $this->vehicle->modeltitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "categoryid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('CATEGORIES'); ?></b></td>
						<td><?php echo $this->vehicle->cattitle;?></td>
				      </tr>
				  <?php } ?>
				<?php break;
				case "modelyearid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MODELYEAR'); ?></b></td>
						<td><?php echo $this->vehicle->modelyeartitle; ?></td>
				      </tr>
				  <?php } ?>
				<?php break;
				case "conditionid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('CONDITION'); ?></b></td>
						<td><?php echo $this->vehicle->conditiontitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "fueltypeid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('FUELTYPES'); ?></b></td>
						<td><?php echo $this->vehicle->fueltitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "cylinderid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('CYLINDERS'); ?></b></td>
						<td><?php echo $this->vehicle->cylindertitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "transmissionid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('TRANSMISSION'); ?></b></td>
						<td><?php echo $this->vehicle->transtitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "adexpiryid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('ADEXPIRY'); ?></b></td>
						<td><?php echo $this->vehicle->adexptitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "mileages": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MILEAGES'); ?></b></td>
						<td><?php echo $this->vehicle->mileages; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "mileagetypeid": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MILEAGESTYPEID'); ?></b></td>
						<td><?php echo $this->vehicle-> mileagetitle; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "price": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('PRICE'); ?></b></td>
						<td><?php echo $this->vehicle->price; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "exteriorcolor": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('EXTERIORCOLOR'); ?></b></td>
						<td><?php echo $this->vehicle->exteriorcolor; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "interiorcolor": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('INTERIORCOLOR'); ?></b></td>
						<td><?php echo $this->vehicle->interiorcolor; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "enginecapacity": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('ENGINECAPACITY'); ?></b></td>
						<td><?php echo $this->vehicle->enginecapacity; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "cityfuelconsumption": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('CITYFUELCONSUMPTION'); ?></b></td>
						<td><?php echo $this->vehicle->cityfuelconsumption; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "highwayfuelconsumption": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('HIGHWAYFUELCONSUMPTION'); ?></b></td>
						<td><?php echo $this->vehicle->highwayfuelconsumption; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "map": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('MAP'); ?></b></td>
						<td><?php echo $this->vehicle->map; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "video": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('VIDEO'); ?></b></td>
						<td><?php echo $this->vehicle->video; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
				case "description": $isodd = 1 - $isodd; ?>
					  <?php if ( $field->published == 1 ) { ?>
				      <tr class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><td></td>
				        <td><b><?php echo JText::_('DESCRIPTION'); ?></b></td>
						<td><?php echo $this->vehicle->description; ?></td>
				      </tr>
					  <?php } ?>
				<?php break;
//				default:
//					echo '<br> default uf '.$filed->field;
//					if ( $field->published == 1 ) {
//						foreach($this->userfields as $ufield){
//							if($field->field == $ufield[0]->id) {
//								$isodd = 1 - $isodd;
//								$userfield = $ufield[0];
//								$i++;
//								echo '<tr class="'.$this->theme[$trclass[$isodd]] .'"><td></td>';
//								echo '<td class="maintext"><b>'. $userfield->title .'</b></td>';
//								if ($userfield->type != "select"){
							//	if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
							//	}elseif ($userfield->type == "select"){
						//			if(isset($ufield[2])){ $fvalue = $ufield[2]->fieldvalue; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
					//			}
				//				echo '<td class="maintext">'.$fvalue.'</td>';
			//					echo '</tr>';
		//					}
	//					}
//					}
			}

		}
		?>

    
    <tr>
        <td colspan="2" height="10"></td>
      </tr>

 </table>
    <table cellpadding="0" cellspacing="0" border="0" width="100%">
        <tr>
            <th valign="top" align="center" size="72px" >Vehicle Properties</th>
        </tr>
    </table>
    <table cellpadding="3" cellspacing="0" border="1" width="100%">
      <?php
      $colcount=1;
           foreach($this->fieldorderings_options as $field){
              switch ($field->field) {
				case "section_body": ?>
					<tr>
						<td>
							<table cellpadding="3" cellspacing="0" border="0" width="100%">
								<tr>
									<td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('BODY'); ?></b></td>
								</tr>
								<tr>
								<?php break;
								case "door2": 
											if($this->vehicleoptions->door2 == 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('2_DOOR').'</td>';
											} 
								break;
								case "door3":
											if($this->vehicleoptions->door3== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('3_DOOR').'</td>';
											} 
								break;
								case "door4": 
											if($this->vehicleoptions->door4== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('4_DOOR').'</td>';
											} 
								break;
								case "covertible":
											if($this->vehicleoptions->covertible== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('COVER_TIBLE').'</td>';
											} 
								break;
								case "crewcab": 
											if($this->vehicleoptions->crewcab== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('CREW_CAB').'</td>';
											} 
								break;
								case "extendedcab": 
											if($this->vehicleoptions->extendedcab== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('EXTENDED_CAB').'</td>';
											} 
								break;
								case "longbox": 
											if($this->vehicleoptions->longbox== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('LONG_BOX').'</td>';
											} 
								break;
								case "offroadpackage": 
											if($this->vehicleoptions->offroadpackage== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('OFFROAD_PACKAGE').'</td>';
											} 
								break;
								case "shortbox": 
											if($this->vehicleoptions->shortbox== 1) {
												if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
												echo '<td width="'.$colwidth.'">'.JText::_('SHORT_BOX').'</td>';
											} 
								break;
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
					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('DRIVE_TRAIN'); ?></b></td>
									</tr>
									
									<?php break;
									case "wheeldrive2": 
													if($this->vehicleoptions->wheeldrive2== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('2_WHEEL_DRIVE').'</td>';
													}
									break;
									case "wheeldrive4": 
													if($this->vehicleoptions->wheeldrive4== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('4_WHEEL_DRIVE').'</td>';
													}
									break;
									case "allwheeldrive": 
													if($this->vehicleoptions->allwheeldrive== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ALL_WHEEL_DRIVE').'</td>';
													}
									break;
									case "rearwheeldrive": 
													if($this->vehicleoptions->rearwheeldrive== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_WHEEL_DRIVE').'</td>';
													}
									break;
									case "supercharged": 
													if($this->vehicleoptions->supercharged== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SUPER_CHARGED').'</td>';
													}
									break;
									case "turbo": 
													if($this->vehicleoptions->turbo== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TURBO').'</td>';
													}
									break;
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

					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('EXTERIOR'); ?></b></td>
									</tr>
									
									<?php break;
									case "alloywheels":
													if($this->vehicleoptions->alloywheels== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ALLOY_wheels').'</td>';
													}
									break;
									case "bedliner": 
													if($this->vehicleoptions->bedliner== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('BED_LINER').'</td>';
													}
									break;
									case "bugshield": 
													if($this->vehicleoptions->bugshield== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('BUG_SHIELD').'</td>';
													}
									break;
									case "campermirrors": 
													if($this->vehicleoptions->campermirrors== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CAMPER_MIRRORS').'</td>';
													}
									break;
									case "cargocover": 
													if($this->vehicleoptions->cargocover== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CARGO_COVER').'</td>';
													}
									break;
									case "customwheels": 
													if($this->vehicleoptions->customwheels== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CUSTOM_WHEELS').'</td>';
													}
									break;
									case "dualslidingdoors": 
													if($this->vehicleoptions->dualslidingdoors== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('DUAL_SLIDING_DOORS').'</td>';
													}
									break;
									case "foglamps": 
													if($this->vehicleoptions->foglamps== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('FOG_LAMPS').'</td>';
													}
									break;
									case "heatedwindshield": 
													if($this->vehicleoptions->heatedwindshield== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('HEATED_WIND_SHIELD').'</td>';
													}
									break;
									case "immitationconvertibletop": 
													if($this->vehicleoptions->immitationconvertibletop== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('IMMITATION_CONVERTIBLE_TOP').'</td>';
													}
									break;
									case "luggagerack": 
													if($this->vehicleoptions->luggagerack== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('LUGGAGE_RACK').'</td>';
													}
									break;
									case "metallicpaint": 
													if($this->vehicleoptions->metallicpaint== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('METALLIC_PAINT').'</td>';
													}
									break;
									case "nerfbars": 
													if($this->vehicleoptions->nerfbars== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('NERF_BARS').'</td>';
													}
									break;
									case "newtires": 
													if($this->vehicleoptions->newtires== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('NEW_TIRES').'</td>';
													}
									break;
									case "premiumwheels": 
													if($this->vehicleoptions->premiumwheels== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('PREMIUM_WHEELSS').'</td>';
													}
									break;
									case "rearwiper": 
													if($this->vehicleoptions->rearwiper== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_WIPER').'</td>';
													}
									break;
									case "removeabletop": 
													if($this->vehicleoptions->removeabletop== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REMOVEABLE_TOP').'</td>';
													}
									break;
									case "ridecontrol": 
													if($this->vehicleoptions->ridecontrol== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('RIDE_CONTROL').'</td>';
													}
									break;
									case "runningboards": 
													if($this->vehicleoptions->runningboards== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('RUNNING_BOARDS').'</td>';
													}
									break;
									case "splashquards": 
													if($this->vehicleoptions->splashquards== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SPLASH_QUARDS').'</td>';
													}
									break;
									case "spoiler": 
													if($this->vehicleoptions->spoiler== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SPOILER').'</td>';
													}
									break;
									case "sunroof": 
													if($this->vehicleoptions->sunroof== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SUN_ROOF').'</td>';
													}
									break;
									case "ttops": 
													if($this->vehicleoptions->ttops== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('T_TOPS').'</td>';
													}
									break;
									case "tonneaucover": 
													if($this->vehicleoptions->tonneaucover== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TONNEAU_COVER').'</td>';
													}
									break;
									case "towingpackage": 
													if($this->vehicleoptions->towingpackage== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TOWIN_PACKAGE').'</td>';
													}
									break;
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
					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('INTERIOR'); ?></b></td>
									</tr>
									
									<?php break;
									case "ndrowbucketseats2": 
													if($this->vehicleoptions->ndrowbucketseats2== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('NDROW_BUCKET_SEATS2').'</td>';
													}
									break;
									case "rdrowseat3": 
													if($this->vehicleoptions->rdrowseat3== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('RDROWSEAT3').'</td>';
													}
									break;
									case "adjustablefootpedals": 
													if($this->vehicleoptions->adjustablefootpedals== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ADJUSTABLE_FOOT_PEDALS').'</td>';
													}
									break;
									case "airconditioning": 
													if($this->vehicleoptions->airconditioning== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('AIR_CONDITIONING').'</td>';
													}
									break;
									case "autodimisrvmirror": 
													if($this->vehicleoptions->autodimisrvmirror== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('AUTO_DIMISRV_MIRROR').'</td>';
													}
									break;
									case "bucketseats": 
													if($this->vehicleoptions->bucketseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('BUCKET_SEATS').'</td>';
													}
									break;
									case "centerconsole": 
													if($this->vehicleoptions->centerconsole== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CENTER_CONSOLE').'</td>';
													}
									break;
									case "childseat": 
													if($this->vehicleoptions->childseat== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CHILD_SEAT').'</td>';
													}
									break;
									case "cooledseats": 
													if($this->vehicleoptions->cooledseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('COOLED_SEATS').'</td>';
													}
									break;
									case "cruisecontrol": 
													if($this->vehicleoptions->cruisecontrol== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CRUISE_CONTROL').'</td>';
													}
									break;
									case "dualclimatecontrol": 
													if($this->vehicleoptions->dualclimatecontrol== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('DUAL_CLIMATE_CONTROL').'</td>';
													}
									break;
									case "heatedmirrirs": 
													if($this->vehicleoptions->heatedmirrirs== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('HEATED_MIRRIRS').'</td>';
													}
									break;
									case "heatedseats": 
													if($this->vehicleoptions->heatedseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('HEATED_SEATS').'</td>';
													}
									case "leatherseats": 
													if($this->vehicleoptions->leatherseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('LEATHER_SEATS').'</td>';
													}
									break;
									case "power3rdrowseat": 
													if($this->vehicleoptions->power3rdrowseat== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_3RD_ROW_SEAT').'</td>';
													}
									break;
									case "powerdoorlocks": 
													if($this->vehicleoptions->powerdoorlocks== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_DOOR_LOCKS').'</td>';
													}
									break;
									case "powermirrors": 
													if($this->vehicleoptions->powermirrors== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_MIRRIORS').'</td>';
													}
									break;
									case "powerseats": 
													if($this->vehicleoptions->powerseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_SEATS').'</td>';
													}
									break;
									case "powersteering": 
													if($this->vehicleoptions->powersteering== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_STEERING').'</td>';
													}
									break;
									case "powerwindows": 
													if($this->vehicleoptions->powerwindows== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_WINDOWS').'</td>';
													}
									break;
									case "rearairconditioning": 
													if($this->vehicleoptions->rearairconditioning== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_AIR_CONDITIONING').'</td>';
													}
									break;
									case "reardefrost": 
													if($this->vehicleoptions->reardefrost== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_DEFROST').'</td>';
													}
									break;
									case "rearslidingwindow": 
													if($this->vehicleoptions->rearslidingwindow== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_SLIDING_WINDOW').'</td>';
													}
									break;
									case "tiltsteering": 
													if($this->vehicleoptions->tiltsteering== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TILT_STEERING').'</td>';
													}
									break;
									case "tintedwindows": 
													if($this->vehicleoptions->tintedwindows== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TINTED_WINDOWS').'</td>';
													}
									break;
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
					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('ELECTRONICS'); ?></b></td>
									</tr>
									
									<?php break;
									case "alarm": 
													if($this->vehicleoptions->alarm== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ALARM').'</td>';
													}
									break;
									case "amfmradio": 
													if($this->vehicleoptions->amfmradio== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('AMFM_RADIO').'</td>';
													}
									break;
									case "antitheft": 
													if($this->vehicleoptions->antitheft== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ANTI_THEFT').'</td>';
													}
									break;
									case "cdchanger": 
													if($this->vehicleoptions->cdchanger== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CD_CHANGER').'</td>';
													}
									break;
									case "cdplayer": 
													if($this->vehicleoptions->cdplayer== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CD_PLAYER').'</td>';
													}
									break;
									case "dualdvds": 
													if($this->vehicleoptions->dualdvds== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('DUAL_DVDS').'</td>';
													}
									break;
									case "dvdplayer": 
													if($this->vehicleoptions->dvdplayer== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('DVD_PLAYER').'</td>';
													}
									break;
									case "handsfreecomsys": 
													if($this->vehicleoptions->handsfreecomsys== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('HANDSFREE_COM_SYS').'</td>';
													}
									break;
									case "homelink": 
													if($this->vehicleoptions->homelink== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('HOME_LINK').'</td>';
													}
									break;
									case "informationcenter": 
													if($this->vehicleoptions->informationcenter== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('INFORMATION_CENTER').'</td>';
													}
									break;
									case "integratedphone": 
													if($this->vehicleoptions->integratedphone== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('INTEGRATED_PHONE').'</td>';
													}
									break;
									case "ipodport": 
													if($this->vehicleoptions->ipodport== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('IPOD_PORT').'</td>';
													}
									break;
									case "ipodmp3port": 
													if($this->vehicleoptions->ipodmp3port== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('IPOD_MP3_PORT').'</td>';
													}
									break;
									case "keylessentry": 
													if($this->vehicleoptions->keylessentry== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('KEY_LESSENTRY').'</td>';
													}
									break;
									case "memoryseats": 
													if($this->vehicleoptions->memoryseats== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('MEMORY_SEATS').'</td>';
													}
									break;
									case "navigationsystem": 
													if($this->vehicleoptions->navigationsystem== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('NAVIGATION_SYSTEM').'</td>';
													}
									break;
									case "onstar": 
													if($this->vehicleoptions->onstar== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ON_STAR').'</td>';
													}
									break;
									case "backupcameraandmirror": 
													if($this->vehicleoptions->backupcameraandmirror== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('BACKUP_CAMERAAND_MIRROR').'</td>';
													}
									break;
									case "parkassistrear": 
													if($this->vehicleoptions->parkassistrear== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('PARK_ASSISTREAR').'</td>';
													}
									break;
									case "powerliftgate": 
													if($this->vehicleoptions->powerliftgate== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('POWER_LIFT_GATE').'</td>';
													}
									break;
									case "rearlockingdifferential": 
													if($this->vehicleoptions->rearlockingdifferential== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_LOCKING_DIFFERENTIAL').'</td>';
													}
									break;
									case "rearstereo": 
													if($this->vehicleoptions->rearstereo== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_STEREO').'</td>';
													}
									break;
									case "remotestart": 
													if($this->vehicleoptions->remotestart== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REMOTE_START').'</td>';
													}
									break;
									case "satelliteradio": 
													if($this->vehicleoptions->satelliteradio== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SATELLITE_RADIO').'</td>';
													}
									break;
									case "steeringwheelcontrols": 
													if($this->vehicleoptions->steeringwheelcontrols== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('STEERING_WHEEL_CONTROLS').'</td>';
													}
									break;
									case "stereotape": 
													if($this->vehicleoptions->stereotape== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('STEREO_TAPE').'</td>';
													}
									break;
									case "tirepressuremonitorsystem": 
													if($this->vehicleoptions->tirepressuremonitorsystem== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TIRE_PREEEURE_MONITOR_SYSTEM').'</td>';
													}
									break;
									case "trailerbrakesystem": 
													if($this->vehicleoptions->trailerbrakesystem== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TRAILER_BRAKE_SYSTEM').'</td>';
													}
									break;
									case "tripmileagecomputer": 
													if($this->vehicleoptions->tripmileagecomputer== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TRIP_MILEAGE_COMPUTER').'</td>';
													}
									break;
									case "tv": 
													if($this->vehicleoptions->tv== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TV').'</td>';
													}
									break;
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
					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr>
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="<?php echo $this->theme[$trclass[$isodd]]; ?>"><b><?php  echo JText::_('SAFETY_FEATURES'); ?></b></td>
									</tr>
									
									<?php break;
									case "antilockbrakes": 
													if($this->vehicleoptions->antilockbrakes== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('ANTI_LOCK_BRAKES').'</td>';
													}
									break;
									case "backupsensors": 
													if($this->vehicleoptions->backupsensors== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('BACKUP_SENSORS').'</td>';
													}
									break;
									case "cartracker": 
													if($this->vehicleoptions->cartracker== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('CAR_TRACKER').'</td>';
													}
									break;
									case "driverairbag": 
													if($this->vehicleoptions->driverairbag== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('DRIVER_AIR_BAG').'</td>';
													}
									break;
									case "passengerairbag": 
													if($this->vehicleoptions->passengerairbag== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('PASSENGER_AIR_BAG').'</td>';
													}
									break;
									case "rearairbags": 
													if($this->vehicleoptions->rearairbags== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('REAR_AIR_BAG').'</td>';
													}
									break;
									case "sideairbags": 
													if($this->vehicleoptions->sideairbags== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SIDE_AIR_BAG').'</td>';
													}
									break;
									case "signalmirrors": 
													if($this->vehicleoptions->signalmirrors== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('SIGNAL_MIRRORS').'</td>';
													}
									break;
									case "tractioncontrol": 
													if($this->vehicleoptions->tractioncontrol== 1){
														if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; 
														echo '<td width="'.$colwidth.'">'.JText::_('TRACTION_CONTROL').'</td>';
													}
									break;
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
	</table>
	

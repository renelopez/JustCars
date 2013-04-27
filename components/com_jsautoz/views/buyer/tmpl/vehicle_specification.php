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

require_once 'vehicle_details.php';
?>
<?php $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']); $k=1 ?>
<div class="<?php echo $divclass['0']; ?>" id="automaindiv">
	<div id="jsautoz_sub_heading">
		<?php echo JText::_('SPECIFICATION'); ?>
	</div>
<div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain " >
<div class="jsautoz_section_heading" id="jsautoz_leftalign">
    <span id="sectionheadline_text">
    <?php echo JText::_('FEATURE_IN_VEHICLE');?>
    </span>
</div>
    <table cellpadding="3" cellspacing="0" border="0" width="100%">
      <?php
      $colperrow=4;
      $colwidth = round(100/$colperrow,1);
      $colwidth = $colwidth.'%';

      $colcount=0;?>

            <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                <td>
                    <table cellpadding="3" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="">
                                <div class="jsautoz_section_heading" >
                                    <span id="sectionheadline_text">
                                    <span id="sectionheadline_left"></span>
                                    <?php  echo JText::_('BODY'); ?>
                                    <span id="sectionheadline_right"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        <tr >
                            <?php
                            if($this->vehicleoptions->door2 == 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0;  } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('2_DOOR').'</td>';
                            }
                            if($this->vehicleoptions->door3== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0;  } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('3_DOOR').'</td>';
                            }
                            if($this->vehicleoptions->door4== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('4_DOOR').'</td>';
                            }
                            if($this->vehicleoptions->covertible== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('COVER_TIBLE').'</td>';
                            }
                            if($this->vehicleoptions->crewcab== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('CREW_CAB').'</td>';
                            }
                            if($this->vehicleoptions->extendedcab== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('EXTENDED_CAB').'</td>';
                            }
                            if($this->vehicleoptions->longbox== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('LONG_BOX').'</td>';
                            }
                            if($this->vehicleoptions->offroadpackage== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('OFFROAD_PACKAGE').'</td>';
                            }
                            if($this->vehicleoptions->shortbox== 1) {
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('SHORT_BOX').'</td>';
                            }
                            for($i = $colcount; $i < $colperrow; $i++){
                                echo '<td></td>';
                            }
                        echo '</tr>';$colcount=0;
                            ?>

                        </table>
                </td>
            </tr>


            <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                <td>
                    <table cellpadding="3" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="">
                                <div class="jsautoz_section_heading">
                                    <span id="sectionheadline_text">
                                    <span id="sectionheadline_left"></span>
                                    <?php  echo JText::_('DRIVE_TRAIN'); ?>
                                    <span id="sectionheadline_right"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                         <tr >
                            <?php
                            if($this->vehicleoptions->wheeldrive2== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('2_WHEEL_DRIVE').'</td>';
                            }
                            if($this->vehicleoptions->wheeldrive4== 1){
                            if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                            echo '<td width="'.$colwidth.'">'.JText::_('4_WHEEL_DRIVE').'</td>';
                            }else if($this->vehicleoptions->allwheeldrive== 1){
                            if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                            echo '<td width="'.$colwidth.'">'.JText::_('ALL_WHEEL_DRIVE').'</td>';
                            }else if($this->vehicleoptions->rearwheeldrive== 1){
                            if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                            echo '<td width="'.$colwidth.'">'.JText::_('REAR_WHEEL_DRIVE').'</td>';
                            }else if($this->vehicleoptions->supercharged== 1){
                            if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                            echo '<td width="'.$colwidth.'">'.JText::_('SUPER_CHARGED').'</td>';
                            }else if($this->vehicleoptions->turbo== 1){
                            if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                            echo '<td width="'.$colwidth.'">'.JText::_('TURBO').'</td>';
                            }
                            for($i = $colcount; $i < $colperrow; $i++){
                            echo '<td></td>';
                            }
                        echo '</tr>';$colcount=0;
                    ?>

                    </table>
                </td>
            </tr>


            <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                <td>
                    <table cellpadding="3" cellspacing="0" border="0" width="100%">
                        <tr>
                            <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="">
                                <div class="jsautoz_section_heading">
                                    <span id="sectionheadline_text">
                                    <span id="sectionheadline_left"></span>
                                    <?php  echo JText::_('EXTERIOR'); ?>
                                    <span id="sectionheadline_right"></span>
                                    </span>
                                </div>
                            </td>
                        </tr>
                         <tr >
                            <?php
                            if($this->vehicleoptions->alloywheels== 1){

                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('ALLOY_wheels').'</td>';
                            }
                            if($this->vehicleoptions->bedliner== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('BED_LINER').'</td>';
                            }
                            if($this->vehicleoptions->bugshield== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('BUG_SHIELD').'</td>';
                            }
                            if($this->vehicleoptions->campermirrors== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('CAMPER_MIRRORS').'</td>';
                            }
                            if($this->vehicleoptions->cargocover== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('CARGO_COVER').'</td>';
                            }
                            if($this->vehicleoptions->customwheels== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('CUSTOM_WHEELS').'</td>';
                            }
                            if($this->vehicleoptions->dualslidingdoors== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('DUAL_SLIDING_DOORS').'</td>';
                            }
                            if($this->vehicleoptions->foglamps== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('FOG_LAMPS').'</td>';
                            }
                            if($this->vehicleoptions->heatedwindshield== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('HEATED_WIND_SHIELD').'</td>';
                            }
                            if($this->vehicleoptions->immitationconvertibletop== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('IMMITATION_CONVERTIBLE_TOP').'</td>';
                            }
                            if($this->vehicleoptions->luggagerack== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('LUGGAGE_RACK').'</td>';
                            }
                            if($this->vehicleoptions->metallicpaint== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('METALLIC_PAINT').'</td>';
                            }
                            if($this->vehicleoptions->nerfbars== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('NERF_BARS').'</td>';
                            }
                            if($this->vehicleoptions->newtires== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('NEW_TIRES').'</td>';
                            }
                            if($this->vehicleoptions->premiumwheels== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('PREMIUM_WHEELSS').'</td>';
                            }
                            if($this->vehicleoptions->rearwiper== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('REAR_WIPER').'</td>';
                            }
                            if($this->vehicleoptions->removeabletop== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('REMOVEABLE_TOP').'</td>';
                            }
                            if($this->vehicleoptions->ridecontrol== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('RIDE_CONTROL').'</td>';
                            }
                            if($this->vehicleoptions->runningboards== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('RUNNING_BOARDS').'</td>';
                            }
                            if($this->vehicleoptions->splashquards== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('SPLASH_QUARDS').'</td>';
                            }
                            if($this->vehicleoptions->spoiler== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('SPOILER').'</td>';
                            }
                            if($this->vehicleoptions->sunroof== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('SUN_ROOF').'</td>';
                            }
                            if($this->vehicleoptions->ttops== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('T_TOPS').'</td>';
                            }
                            if($this->vehicleoptions->tonneaucover== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('TONNEAU_COVER').'</td>';
                            }
                            if($this->vehicleoptions->towingpackage== 1){
                                if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                echo '<td width="'.$colwidth.'">'.JText::_('TOWIN_PACKAGE').'</td>';
                            }
                            for($i = $colcount; $i < $colperrow; $i++){
                            echo '<td></td>';
                            }
                        echo '</tr>';$colcount=0;
                        ?>
                        </table>
                    </td>
                </tr>

                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td >
                        <table cellpadding="3" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" >
                                    <div class="jsautoz_section_heading">
                                        <span id="sectionheadline_text">
                                        <span id="sectionheadline_left"></span>
                                        <?php  echo JText::_('INTERIOR'); ?>
                                        <span id="sectionheadline_right"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr >
                                <?php
                                if($this->vehicleoptions->ndrowbucketseats2== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('NDROW_BUCKET_SEATS2').'</td>';
                                }
                                if($this->vehicleoptions->rdrowseat3== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('RDROWSEAT3').'</td>';
                                }
                                if($this->vehicleoptions->adjustablefootpedals== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('ADJUSTABLE_FOOT_PEDALS').'</td>';
                                }
                                if($this->vehicleoptions->airconditioning== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('AIR_CONDITIONING').'</td>';
                                }
                                 if($this->vehicleoptions->autodimisrvmirror== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('AUTO_DIMISRV_MIRROR').'</td>';
                                }
                                if($this->vehicleoptions->bucketseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('BUCKET_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->centerconsole== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CENTER_CONSOLE').'</td>';
                                }
                                if($this->vehicleoptions->childseat== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CHILD_SEAT').'</td>';
                                }
                                if($this->vehicleoptions->cooledseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('COOLED_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->cruisecontrol== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CRUISE_CONTROL').'</td>';
                                }
                                if($this->vehicleoptions->dualclimatecontrol== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('DUAL_CLIMATE_CONTROL').'</td>';
                                }
                                if($this->vehicleoptions->heatedmirrirs== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('HEATED_MIRRIRS').'</td>';
                                }
                                if($this->vehicleoptions->heatedseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('HEATED_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->leatherseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('LEATHER_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->power3rdrowseat== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_3RD_ROW_SEAT').'</td>';
                                }
                                if($this->vehicleoptions->powerdoorlocks== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_DOOR_LOCKS').'</td>';
                                }
                                if($this->vehicleoptions->powermirrors== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_MIRRIORS').'</td>';
                                }
                                if($this->vehicleoptions->powerseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->powersteering== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_STEERING').'</td>';
                                }
                                if($this->vehicleoptions->powerwindows== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_WINDOWS').'</td>';
                                }
                                if($this->vehicleoptions->rearairconditioning== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_AIR_CONDITIONING').'</td>';
                                }
                                if($this->vehicleoptions->reardefrost== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_DEFROST').'</td>';
                                }
                                if($this->vehicleoptions->rearslidingwindow== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_SLIDING_WINDOW').'</td>';
                                }
                                if($this->vehicleoptions->tiltsteering== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TILT_STEERING').'</td>';
                                }
                                if($this->vehicleoptions->tintedwindows== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TINTED_WINDOWS').'</td>';
                                }
                                for($i = $colcount; $i < $colperrow; $i++){
                                echo '<td></td>';
                                }
                            echo '</tr>';$colcount=0;
                                ?>
                        </table>
                    </td>
                </tr>


                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td>
                        <table cellpadding="3" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="">
                                    <div class="jsautoz_section_heading">
                                        <span id="sectionheadline_text">
                                        <span id="sectionheadline_left"></span>
                                        <?php  echo JText::_('ELECTRONICS'); ?>
                                        <span id="sectionheadline_right"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr >
                                <?php
                                if($this->vehicleoptions->alarm== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('ALARM').'</td>';
                                }
                                if($this->vehicleoptions->amfmradio== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('AMFM_RADIO').'</td>';
                                }
                                if($this->vehicleoptions->antitheft== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('ANTI_THEFT').'</td>';
                                }
                                if($this->vehicleoptions->cdchanger== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CD_CHANGER').'</td>';
                                }
                                if($this->vehicleoptions->cdplayer== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CD_PLAYER').'</td>';
                                }
                                 if($this->vehicleoptions->dualdvds== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('DUAL_DVDS').'</td>';
                                }
                                if($this->vehicleoptions->dvdplayer== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('DVD_PLAYER').'</td>';
                                }
                                if($this->vehicleoptions->handsfreecomsys== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('HANDSFREE_COM_SYS').'</td>';
                                }
                                if($this->vehicleoptions->homelink== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('HOME_LINK').'</td>';
                                }
                                if($this->vehicleoptions->informationcenter== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('INFORMATION_CENTER').'</td>';
                                }
                                if($this->vehicleoptions->integratedphone== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('INTEGRATED_PHONE').'</td>';
                                }
                                if($this->vehicleoptions->ipodport== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('IPOD_PORT').'</td>';
                                }
                                if($this->vehicleoptions->ipodmp3port== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('IPOD_MP3_PORT').'</td>';
                                }
                                if($this->vehicleoptions->keylessentry== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('KEY_LESSENTRY').'</td>';
                                } if($this->vehicleoptions->memoryseats== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('MEMORY_SEATS').'</td>';
                                }
                                if($this->vehicleoptions->navigationsystem== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('NAVIGATION_SYSTEM').'</td>';
                                }
                                if($this->vehicleoptions->onstar== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('ON_STAR').'</td>';
                                }
                                if($this->vehicleoptions->backupcameraandmirror== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('BACKUP_CAMERAAND_MIRROR').'</td>';
                                }
                                if($this->vehicleoptions->parkassistrear== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('PARK_ASSISTREAR').'</td>';
                                }
                                if($this->vehicleoptions->powerliftgate== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('POWER_LIFT_GATE').'</td>';
                                }
                                if($this->vehicleoptions->rearlockingdifferential== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_LOCKING_DIFFERENTIAL').'</td>';
                                }
                                if($this->vehicleoptions->rearstereo== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_STEREO').'</td>';
                                }
                                if($this->vehicleoptions->remotestart== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REMOTE_START').'</td>';
                                }
                                if($this->vehicleoptions->satelliteradio== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('SATELLITE_RADIO').'</td>';
                                }
                                if($this->vehicleoptions->steeringwheelcontrols== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('STEERING_WHEEL_CONTROLS').'</td>';
                                }
                                if($this->vehicleoptions->stereotape== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('STEREO_TAPE').'</td>';
                                }
                                if($this->vehicleoptions->tirepressuremonitorsystem== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TIRE_PRESSURE_MONITOR_SYSTEM').'</td>';
                                }
                                if($this->vehicleoptions->trailerbrakesystem== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TRAILER_BRAKE_SYSTEM').'</td>';
                                }
                                if($this->vehicleoptions->tripmileagecomputer== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TRIP_MILEAGE_COMPUTER').'</td>';
                                }
                                if($this->vehicleoptions->tv== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TV').'</td>';
                                }
                                for($i = $colcount; $i < $colperrow; $i++){
                                echo '<td></td>';
                                }
                            echo '</tr>';$colcount=0;

                            ?>
                        </table>
                    </td>
                </tr>


                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td>
                        <table cellpadding="3" cellspacing="0" border="0" width="100%">
                            <tr>
                                <td colspan="<?php echo $colperrow; ?>" valign="top" align="left" class="">
                                    <div class="jsautoz_section_heading">
                                        <span id="sectionheadline_text">
                                        <span id="sectionheadline_left"></span>
                                        <?php  echo JText::_('SAFETY_FEATURES'); ?>
                                        <span id="sectionheadline_right"></span>
                                        </span>
                                    </div>
                                </td>
                            </tr>
                            <tr >
                                <?php
                                if($this->vehicleoptions->antilockbrakes== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('ANTI_LOCK_BRAKES').'</td>';
                                }
                                if($this->vehicleoptions->backupsensors== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('BACKUP_SENSORS').'</td>';
                                }
                                if($this->vehicleoptions->cartracker== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('CAR_TRACKER').'</td>';
                                }
                                if($this->vehicleoptions->driverairbag== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('DRIVER_AIR_BAG').'</td>';
                                }
                                if($this->vehicleoptions->passengerairbag== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('PASSENGER_AIR_BAG').'</td>';
                                }
                                if($this->vehicleoptions->rearairbags== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('REAR_AIR_BAG').'</td>';
                                }
                                if($this->vehicleoptions->sideairbags== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('SIDE_AIR_BAG').'</td>';
                                }
                                if($this->vehicleoptions->signalmirrors== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('SIGNAL_MIRRORS').'</td>';
                                }
                                if($this->vehicleoptions->tractioncontrol== 1){
                                    if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                    echo '<td width="'.$colwidth.'">'.JText::_('TRACTION_CONTROL').'</td>';
                                }
                                for($i = $colcount; $i < $colperrow; $i++){
                                echo '<td></td>';
                                }
                            echo '</tr>';
                            ?>
                        </table>
                    </td>
                </tr>
                <?php if((isset($this->vehicleoption))&&(!empty($this->vehicleoption))) { ?>
                    
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>" >
                        <td>
                                <table cellpadding="3" cellspacing="0" border="0" width="100%">
                                        <tr>
                                        <?php foreach($this->vehicleoption as $field){
                                            switch ($field->field) { 
                                                case "section_userfields":
                                                echo '<td colspan="'.$colperrow.'" valign="top" align="left" >
                                                            <div class="jsautoz_section_heading">
                                                                <span id="sectionheadline_text">
                                                                <span id="sectionheadline_left"></span>
                                                                '.$field->fieldtitle.'
                                                                <span id="sectionheadline_right"></span>
                                                                </span>
                                                            </div>
                                                        </td>';
                                            }
                                         }?>
                                        </tr>
                                        <tr>
                                        <?php 
                                        foreach($this->vehicleoption as $field){
                                            switch ($field->field) {
                                                case "userfield1":
                                                    if($this->vehicleoptions->userfield1== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield2":
                                                    if($this->vehicleoptions->userfield2== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield3":
                                                    if($this->vehicleoptions->userfield3== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield4":
                                                    if($this->vehicleoptions->userfield4== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield5":
                                                    if($this->vehicleoptions->userfield5== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield6":
                                                    if($this->vehicleoptions->userfield6== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield7":
                                                    if($this->vehicleoptions->userfield7== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield8":
                                                    if($this->vehicleoptions->userfield8== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield9":
                                                    if($this->vehicleoptions->userfield9== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield10":
                                                    if($this->vehicleoptions->userfield10== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield11":
                                                    if($this->vehicleoptions->userfield11== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield12":
                                                    if($this->vehicleoptions->userfield12== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield13":
                                                    if($this->vehicleoptions->userfield13== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield14":
                                                    if($this->vehicleoptions->userfield14== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                                case "userfield15":
                                                    if($this->vehicleoptions->userfield15== 1){
                                                        if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++;
                                                        echo '<td width="'.$colwidth.'">'.$field->fieldtitle.'</td>';

                                                        }
                                                break;
                                            }
                                        }?>
                                </table>
                        </td>
                </tr>
                    
            <?php } ?>


        </table>
        </div>
</div>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>




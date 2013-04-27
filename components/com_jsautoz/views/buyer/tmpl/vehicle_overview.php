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
 JHTML::_('behavior.modal');
JHTML::_('behavior.formvalidation');
require_once 'vehicle_details.php'; 
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);

$divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
$i = 0;
$k=1;
?>

        <div  class="<?php echo $divclass['0']; ?>" id="automaindiv">
            <div id="jsautoz_sub_heading">
                <?php echo JText::_('OVERVIEW'); ?>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> jsautoz_section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('MODEL_REGISTRATION_DETAIL');?>
                <span id="sectionheadline_right"></span>
                </span>
            </div>    
            <?php if($this->fieldorderings_vehicle['makeid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MAKE_MANUFACTURER') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->maketitle ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['modelid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MODEL') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->modeltitle ; ?></span>
            </div>         
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['modelyearid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MODEL_YEAR') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->modelyeartitle ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['regcity'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('REGISTRATION_CITY') ;?></span>
                <span class="auto_vsdata">
                    <?php if($this->vehicle->cityname !=''  ) echo $this->vehicle->cityname ;
                        else echo JText::_('REG_CITY_NOT_AVAILABLE')                        ?>
                </span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['loccity'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('LOCATION_OF_VEHICLE') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->city ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['mileages'] == 1){ ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MILEAGE') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->mileage.' '.$this->vehicle->mileagesymbol ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['description'] == 1){ ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('DESCRIPTION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->description; ?></span>
            </div>
            <?php } ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> jsautoz_section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('MECHNICAL_DETAIL'); ?>
                <span id="sectionheadline_right"></span>
                </span>
            </div>
            <?php if($this->fieldorderings_vehicle['transmissionid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('TRANSMISSION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->transmission ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['fueltypeid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('FUEL_TYPE') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->fueltitle ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['enginecapacity'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('ENGINE_CAPACITY') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->enginecapacity ; ?></span>
            </div>
            <?php } ?>

            <div class="<?php echo $divclass[$k]; $k=1-$k;?> jsautoz_section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('APPEARANCE_AND_CONDITION'); ?>
                <span id="sectionheadline_right"></span>
                </span>
             </div>   
            <?php if($this->fieldorderings_vehicle['conditionid'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('CONDITION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->conditiontitle; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['exteriorcolor'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('EXTERIORCOLOR') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->exteriorcolor ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['interiorcolor'] == 1){ ?>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('INTERIORCOLOR') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->interiorcolor ; ?></span>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['map'] == 1){ ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> jsautoz_section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('LOCATION_AND_VIDEO'); ?>
                <span id="sectionheadline_right"></span>
                </span>
             </div>   
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MAP') ;?></span>
            </div>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <?php if($this->vehicle->latitude OR $this->vehicle->longitude){ ?>
                                <script type="text/javascript" language="javascript">
                                    window.onload= new Function("loadMap('<?php echo $this->vehicle->latitude; ?>', '<?php echo $this->vehicle->longitude ?>');");
                                                                
                                  //window.onload=loadMap;
                               </script>
                                <div  id="map_container"></div>
                                
                    <?php } ?>
            </div>
            <?php } ?>
            <?php if($this->fieldorderings_vehicle['video'] == 1){ ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('VIDEO') ;?></span>
            </div>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading">
					<?php if($this->vehicle->video){  ?> 
						<!--<iframe id="player" type="text/html" width="640" height="390"
						  src="<?php echo $this->vehicle->video ; ?> http://www.youtube.com/embed/W-Q7RMpINVo "
						  frameborder="0"></iframe>-->
						<iframe title="YouTube video player" class="youtube-player" type="text/html" 
						width="640" height="390" src="http://www.youtube.com/embed/<?php echo $this->vehicle->video ; ?>"
						frameborder="0" allowFullScreen></iframe>
						<!--<iframe title="YouTube video player" width="480" height="390" src="http://www.youtube.com/embed/<?php echo $this->vehicle->video ; ?>" frameborder="0" allowfullscreen>
                                                </iframe>-->
                    <?php } ?>                            
                  
                </span>
            </div>
            <?php } ?>
            <?php if(isset($this->userfields)&&(!empty($this->userfields))) { ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> jsautoz_section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('ADDITIONAL_FEATURES'); ?>
                <span id="sectionheadline_right"></span>
                </span>
             </div>   
                    <?php 


                foreach($this->userfields as $ufield) { ?>
                    <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                        <?php 
                        $userfield = $ufield[0];
                    echo '<span class="auto_vsheading">';
                        echo $userfield->title;
                        if ($userfield->type == "checkbox"){
                        if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
                        if ($fvalue == '1') $fvalue = "True"; else $fvalue = "false";
                        }elseif ($userfield->type == "select"){
                        if(isset($ufield[2])){ $fvalue = $ufield[2]->fieldtitle; $userdataid = $ufield[2]->id;} else {$fvalue=""; $userdataid = ""; }
                        }else{
                        if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
                        }
                        //								echo '<td>'.$fvalue.'</td>';	
                        echo '</span><span class='.$divclass[$k].' auto_vsmain>'.$fvalue.'</span>';$k=1-$k; ?>

                </div>
                    <?php } 	


                        ?>   
                
            <?php } ?>
                
            
            
            
            
            
            
            
            
            
           <!-- <div class="<?php echo $divclass['0']; ?> auto_vsmain">
                <span class="auto_vsheading"></span>
                <span class="auto_vsdata"></span>
            </div>

            <!-- <hr class="auto_vshr" />-->
    </div>

    <div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


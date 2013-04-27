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
<?php
//$divclass = array('row0','row1');
$divclass = array('even','odd');
$k = 0;
?>

<div class="automaindiv">
<div id="auto_adminmenuvehiclewraper">
    <table width="100%">
		<tr>
			<td align="left" width="175"  valign="top">
				<?php
				include_once('components/com_jsautoz/views/menu.php');
				?>
			</td>
			<td width="100%" valign="top">
                            <?php require_once 'vehicle_details.php';
                                    $divclass = array('odd', 'even');
                                    $i = 0;
                                    $k=1;
                            ?>
        <div  class="<?php echo $divclass['0']; ?>" id="automaindiv">
            <div id="sub_heading">
                <?php echo JText::_('OVERVIEW'); ?>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('MODEL_REGISTRATION_DETAIL');?>
                <span id="sectionheadline_right"></span>
                </span>
            </div>    
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MAKE_MANUFACTURER') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->maketitle ; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MODEL') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->modeltitle ; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MODEL_YEAR') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->modelyeartitle ; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('REGISTRATION_CITY') ;?></span>
                <span class="auto_vsdata">
                    <?php if($this->vehicle->regcity !=''  ) echo $this->vehicle->regcity ;
                            else if($this->vehicle->vregcity !=''  ) echo $this->vehicle->vregcity ;
                            else echo JText::_('CITY_NONE');?>
                </span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('LOCATION_OF_VEHICLE') ;?></span>
                <span class="auto_vsdata"><?php if(!empty($this->vehicle->vloccity)) echo $this->vehicle->vloccity;else echo JText::_('CITY_NONE');?></span>
            </div>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('MILEAGE') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->mileage;?></span>
            </div>
<?php /*            <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('DESCRIPTION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->description; ?></span>
            </div> */ ?>
            <div class="<?php echo $divclass[$k]; $k=1-$k;?> section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('MECHNICAL_DETAIL'); ?>
                <span id="sectionheadline_right"></span>
                </span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('TRANSMISSION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->transmission ; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('FUEL_TYPE') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->fueltitle ; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('ENGINE_CAPACITY') ;?></span>
                <span class="auto_vsdata"><?php if(!empty($this->vehicle->enginecapacity)) echo $this->vehicle->enginecapacity;else echo JText::_('NONE'); ?></span>
            </div>

            <div class="<?php echo $divclass[$k]; $k=1-$k;?> section_heading">
                <span id="sectionheadline_text">
                <span id="sectionheadline_left"></span>
                <?php echo JText::_('APPEARANCE_AND_CONDITION'); ?>
                <span id="sectionheadline_right"></span>
                </span>
             </div>   
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('CONDITION') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->conditiontitle; ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('EXTERIORCOLOR') ;?></span>
                <span class="auto_vsdata"><?php if(!empty($this->vehicle->exteriorcolor)) echo $this->vehicle->exteriorcolor;else echo JText::_('NONE'); ?></span>
            </div>
            <div class="<?php echo $divclass[$k];$k=1-$k; ?> auto_vsmain">
                <span class="auto_vsheading"><?php echo JText::_('INTERIORCOLOR') ;?></span>
                <span class="auto_vsdata"><?php echo $this->vehicle->interiorcolor ; ?></span>
            </div>
<?php /*            <div class="<?php echo $divclass[$k]; $k=1-$k;?> section_heading">
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
            </div> */ ?>
            <?php if(isset($this->userfields)&&(!empty($this->userfields))) { ?>
                <div class="<?php echo $divclass[$k]; $k=1-$k;?> auto_vsmain">
                    <h1><?php echo JText::_('CUSTOM_FIELDS'); ?></h1>
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
                        echo '</span><span class="auto_vsdata">'.$fvalue.'</span>'; ?>
                </div>
                    <?php } 	


                        ?>   
                
            <?php } ?>
			</td>
		</tr>
    </table>

</div>




</div>
<table width="100%">
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

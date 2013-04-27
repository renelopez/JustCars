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
 
 
 JHTML::_('behavior.modal');
 
$document =& JFactory::getDocument();
$document->addStyleSheet('../components/com_jsautoz/lightbox/css/lightbox.css');
$document->addStyleSheet('../components/com_jsautoz/css/star_rating.css');
$document->addStyleSheet('../components/com_jsautoz/css/jsautozrating.css');
//$document->addScript('../components/com_jsautoz/lightbox/js/prototype.js');
//$document->addScript('../components/com_jsautoz/lightbox/js/scriptaculous.js?load=effects,builder');
//$document->addScript('../components/com_jsautoz/lightbox/js/lightbox.js');
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
$document->addScript('components/com_jsautoz/include/js/jquery.js');

?>
<script type="text/javascript" src="../components/com_jsautoz/lightbox/js/lightbox.js"></script>

    <div id="auto_detailvehiclewraper">
            <?php
                $divclass = array($this->theme['odd'], $this->theme['even']);
                $isodd =1;
            ?>

            <div class="<?php echo $divclass[$isodd]; ?> auto_detail_maintitle" id="auto_maintitle">
				<?php
				if ($this->vehicle->title != ''){
					echo '<span id="auto_maintitle_text">'. $this->vehicle->title.'</span>' ;
				}else{
					echo  '<span id="auto_maintitle_text">'. $this->vehicle->maketitle.'     '.$this->vehicle->modeltitle.'</span>';
				}
				 ?>
                <span id="auto_maintitle_price">
                        <?php $price=$this->vehicle->price;
                                   $price=number_format($price);
                         echo $this->config['currency'].$price; ?>
                </span>
            </div>
    <div class="<?php echo $divclass[$isodd]; ?>" id="detail_wraper" > 
		<div id="auto_detail_table">
            <div  id="auto_image">
                <?php if ($this->vehicle->vehiclelogo != ''){ ?>
                        <img alt="" width="100px" height="100px" src="../<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_m_'.$this->vehicle->vehiclelogo; ?>"  />
                <?php }else{ ?>
                        <img  src="../components/com_jsautoz/images/default_jsautoz.png" width="100px" height="100px" title="picture"  alt="Default"/>
                <?php } ?>
            </div>
            <div id="auto_data">
				<div  id="auto_information">
					<div id="auto_detail_overallrating">
							<div id="auto_detail_overall_rating">
								<span  class="auto_detail_overallreviewheading theme_data_text_color">
								<?php echo JText::_('OVERALL_RATING') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id ;
								$percent="";
								if (isset ($this->review))$percent = $this->review->overallrating * 20;
								$stars = '';
							   // if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;margin:0 auto;\"" )."  >
								<ul class=\"jsautoz-stars".$stars."\" >
								<li id=\"oa_rating_".$vid."\" class=\"current-rating\" style=\"width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div> 
					</div>
					<div id="auto_detail">
						<span id="auto_information_info" >
							<span id="auto_detail_text"> <?php echo JText::_('MAKE'); ?>  </span>
								<?php 
									$maketitle=strlen($this->vehicle->maketitle);
								?>
								<?php if($maketitle > 10){ ?>
									<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->maketitle.'<br>' ;?></span>
								<?php }else{ ?>
									<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->maketitle.'<br>' ;?></span>
								<?php } ?>
								<span id="auto_detail_text"> <?php echo JText::_('MODEL'); ?>  </span>
								<?php 
									$modeltitle=strlen($this->vehicle->modeltitle);
								?>
								<?php if($modeltitle > 10){ ?>
									<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->modeltitle.'<br>'  ;?></span>

								<?php }else{ ?>
									<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->modeltitle.'<br>'  ;?></span>
								<?php } ?>
								<span id="auto_detail_text"> <?php echo JText::_('YEAR'); ?>  </span>
								<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->modelyeartitle.'<br>'  ;?></span>
						</span>
						<span id="auto_information_info" >
								<span id="auto_detail_text"> <?php echo JText::_('TYPE'); ?>  </span>
								<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->vehicletitle.'<br>'  ;?></span>
								<span id="auto_detail_text"> <?php echo JText::_('CONDITION'); ?>  </span>
								<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->conditiontitle.'<br>'  ;?></span>
								<span id="auto_detail_text"> <?php echo JText::_('FUEL_TYPE'); ?>  </span>
								<span class="theme_data_text_color" id="auto_detail_value"><?php echo $this->vehicle->fueltitle.'<br>'  ;?></span>
						</span>
					</div>
					<div id="auto_detail_rating" >
						<div id="auto_detail_rating_portion">
							<div>
								<span class="auto_detail_reviewheading theme_data_text_color">
								<?php echo JText::_('APPEARANCE') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id;
								$percent="";
								if (isset ($this->review))$percent = $this->review->appearance* 20;
								$stars = '';
								//   if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;\"" )."  id=\"jsautoz\">
								<ul class=\"star-rating small-star\">
								<li id=\"ap_rating_".$vid."\" class=\"current-rating\" style=\"padding-left: 0px;width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div>
							<div>
								<span class="auto_detail_reviewheading theme_data_text_color">
								<?php echo JText::_('COMFORT') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id;
								$percent="";
								if (isset ($this->review))$percent = $this->review->comfort* 20;
								$stars = '';
								//   if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;\"" )." id=\"jsautoz\">
								<ul class=\"star-rating small-star\">
								<li id=\"cm_rating_".$vid."\" class=\"current-rating\" style=\"padding-left: 0px;width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div>
							<div>
								<span class="auto_detail_reviewheading theme_data_text_color">
								<?php echo JText::_('PERFORMANCE') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id;
								$percent="";
								if (isset ($this->review))$percent = $this->review->performance* 20;
								$stars = '';
								//   if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;\"" )." id=\"jsautoz\">
								<ul class=\"star-rating small-star\">
								<li id=\"pr_rating_".$vid."\" class=\"current-rating\" style=\"padding-left: 0px;width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div>
						</div>
						<div id="auto_detail_rating_portion">
							<div>
								<span class="auto_detail_reviewheading theme_data_text_color">
								<?php echo JText::_('VALUE') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id;
								$percent="";
								if (isset ($this->review))$percent = $this->review->value* 20;
								$stars = '';
								//   if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;\"" )." id=\"jsautoz\">
								<ul class=\"star-rating small-star\">
								<li id=\"vl_rating_".$vid."\" class=\"current-rating\" style=\"padding-left: 0px;width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div>
							<div>
								<span class="auto_detail_reviewheading theme_data_text_color">
								<?php echo JText::_('RELIABILITY') ; ?>
								</span>
								<?php
								$vid = $this->vehicle->id;
								$percent="";
								if (isset ($this->review))$percent = $this->review->reliability* 20;
								$stars = '';
								//   if(isset ($this->vehiclereview)) $percent = $this->vehiclereview->overallrating * 20;
								$stars = '-small';
								$html="
								<div class=\"jsautoz-container".$stars."\"".( " style=\"display:inline-block;\"" )." id=\"jsautoz\">
								<ul class=\"star-rating small-star\">
								<li id=\"rl_rating_".$vid."\" class=\"current-rating\" style=\"padding-left: 0px;width:".(int)$percent."%;\"></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								<li></li>
								</ul>
								</div>
								";
								$html .="</small></span>";
								echo $html;
								?>
							</div>
						</div>
					</div>			
			<div id="auto_detaillocation">
			<strong> <?php echo JText::_('LOCATION'); ?>:</strong>
			<span class="theme_data_text_color">
				<?php
					$comma=", ";
					if(!empty($this->vehicle->cityname)){
						echo $this->vehicle->cityname.$comma;

					}elseif(!empty($this->vehicle->city)){
						echo $this->vehicle->city.$comma;

					}
					if(!empty($this->vehicle->countyname)){

						echo $this->vehicle->countyname.$comma;

					}elseif(!empty($this->vehicle->county)){

						echo $this->vehicle->county.$comma;

					}
					if(!empty($this->vehicle->statename)){
						echo $this->vehicle->statename.$comma ;

					}elseif(!empty($this->vehicle->state)){

						echo $this->vehicle->state.$comma;

					}

					if(!empty($this->vehicle->countryname)){

						echo $this->vehicle->countryname;

					}elseif(!empty($this->vehicle->country)){

						echo $this->vehicle->country;

					}
				?>
			</span>
			<?php 
			$vehcreated=date("F d, Y", strtotime($this->vehicle->created));
			echo '<span id="auto_detail_dateposted" class="theme_data_text_color">'.$vehcreated.'</span>'; 
			?>
			</div>
        </div>

				</div>
            </div>
		</div>
        <div id="auto_detail_bottom_row">
		<div  class="<?php echo $divclass[$isodd]; ?>" id="auto_thumbs">
			<?php if(empty($this->vehicleimages)) { ?>
				<img  src="../components/com_jsautoz/images/default_jsautoz.png" width="50px" height="50px" title="picture"  alt="Default"/>
				<?php } ?>
			<?php 
                            $thumbcount = 0;
                            foreach ( $this->vehicleimages AS $vehicleimage ){ 
                                $thumbcount++;?>
				<div id="auto_thumbsetting">
						<a rel="lightbox[roadtrip]" href="<?php echo '../'.$this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_l_'.$vehicleimage->filename; ?>"  title="Vehicle Images"  >
                                                    <?php if($thumbcount <= 4){ ?>
                                                    <img  alt="" src="<?php echo '../'.$this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_s_'.$vehicleimage->filename; ?>" />
                                                    <?php } ?>
						 </a>
				</div>
			<?php } ?>
		</div>
                <div id="tabsshadow"></div>
		<div class="<?php echo $divclass[$isodd]; ?>" id="auto_vdtabs">
			<span>
				<ul >
                                    <li class="rightborder" ><a  href=index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_overview&id=<? echo $this->vehicleid;?> <?php if($this->layout=="vehicle_overview") echo 'class="youarehere"';?> ><span ><?php echo JText::_('OVERVIEW') ; ?></span></a></li>
                                    <li class="rightborder" ><a  href=index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_specification&id=<? echo $this->vehicleid;?> <?php if($this->layout=="vehicle_specification") echo 'class="youarehere"';?> ><span  ><?php echo JText::_('SPECIFICATION') ; ?></span></a></li>
                                    <li ><a  href=index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_gallery&id=<? echo $this->vehicleid;?> <?php if($this->layout=="vehicle_gallery") echo 'class="youarehere"';?> ><span  ><?php echo JText::_('GALLERY') ; ?></span></a></li>
				</ul>
			 </span>
		</div>
            
    </div>

    </div>
<script type="text/javascript">
    function setcolor(){
    alert(yes);



    }

</script>


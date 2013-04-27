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
    $document->addStyleSheet('components/com_jsautoz/themes/'. $this->config['theme']);
    $document->addStyleSheet('components/com_jsautoz/lightbox/css/lightbox.css');
    $document->addStyleSheet('components/com_jsautoz/css/star_rating.css');
    $document->addStyleSheet('components/com_jsautoz/css/jsautozrating.css');
    $document->addScript('administrator/components/com_jsautoz/include/js/jquery.js');
    $document->addScript('components/com_jsautoz/lightbox/js/lightbox.js');
    //$document->addScriptDeclaration ('jQuery.noConflict();');

$calfrm = JRequest::getVar('cl');
$vtype = JRequest::getVar('vtype');

    ?>
<style type="text/css">
#map_container{
	width:100%;
	height:350px;
}
</style>

<script type="text/javascript" 
   src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript" language="javascript">
  function loadMap(latitude,longitude) {
                       var latlng = new google.maps.LatLng(latitude, longitude);
                        var myOptions = {
                        zoom: 4,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map_container"),myOptions);

                    var lastmarker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude)
                    });
                    lastmarker.setMap(map); 

  }
</script>

<div>
<?php if ($this->config['offline'] == '1'){ ?>
<div class="contentpane">
	<div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
	<div class="jsautozmsg">
		<?php echo $this->config['offline_text']; ?>
	</div>
</div>
<?php }else{ ?>
            <div id="jsautoz_toppanel">
			<div id="jsautoz_topsection">
				<?php if ($this->config['showtitle'] == 1) { ?>
					<div id="autoz_sitetitle">
						<?php echo $this->config['title']; ?>
					</div>
				<?php } ?>
				<?php if ($this->config['navigation'] == 1) {
					$calfrm =  JRequest::getVar('cl');
					$layout =  JRequest::getVar('layout');
					$vtype =  JRequest::getVar('vtype');
					$id=  JRequest::getVar('id');
					$dellerid=  JRequest::getVar('did');
					?>
					<div class="autoz_topcurloc">
						 <?php echo JText::_('CUR_LOC'); ?> :
							<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid ; ?> "> <?php echo JText::_('CONTROL_PANEL'); ?></a> >
						<?php if ($calfrm == 8){?>
												<?php
												 if($vtype){
													 if($vtype == 1){?>
																  <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype=<?php echo $vtype; ?>&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('NEW_VEHICLE'); ?></a> > <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
													 <?php }elseif($vtype == 2){ ?>
																  <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype=<?php echo $vtype; ?>&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('USED_VEHICLES'); ?></a> > <?php echo JText::_('VEHICLE_OVERVIEW'); ?>

													 <?php } ?>

												 <?php }else{ ?>

												 <?php }


												 ?>
												 <?php 
						 }elseif($calfrm == 7){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('VEHICLE_SEARCH'); ?></a> > 
												  <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch_results&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('VEHICLES_SEARCH_RESULT'); ?> > </a><?php echo JText::_('VEHICLE_OVERVIEW'); ?>
												 <?php
						 }elseif($calfrm == 1){ ?>
												<?php if($vtype){?>
														<?php if($vtype == 1){?>
														<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=<?php echo $vtype ?>&cl=<?php echo $calfrm ; ?>&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?></a> > 
																  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>

														<?php }elseif($vtype == 2){?>
																<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=<?php echo $vtype ?>&cl=<?php echo $calfrm ; ?>&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?></a> > 
																		  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>

														<?php } ?>

												<?php }else{?>

												<?php } 

						 }elseif($calfrm == 2){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebycity&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('VEHICLE_BY_CITIES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 3){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebyprice&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('VEHICLE_BY_PRICE'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 4){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebymodelyear&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('VEHICLE_BY_MODEL_YEAR'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 5){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=goldvehicles&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('GOLD_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 6){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=featuredvehicles&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('FEATURED_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 9){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=vehiclelist&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('MY_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 10){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&did=<?php echo $dellerid ;?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid ; ?> " > <?php echo JText::_('VEHICLES_BY_DEALER'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 13){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=dealerlist&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('DEALER'); ?></a> >
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&did=<?php echo $dellerid ;?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid ; ?> " > <?php echo JText::_('VEHICLES_BY_DEALER'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 11){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('NEW_AND_USED_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 12){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('NEW_AND_USED_VEHICLE_MAKE_AND_MODEL'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 14){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles_shortlist&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('SHORT_LIST_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 15){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=compare_vehicles&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('COMPARE_VEHICLES'); ?></a> > 
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						 <?php }elseif($calfrm == 16){ ?>
												 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebytypes&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('VEHICLES_BY_TYPE'); ?></a> >
												  <?php echo JText::_('VEHICLE_OVERVIEW'); ?>
						<?php }	?>
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
        <?php if ($this->config['show_vehicle_quicklink'] == 1) {?>
        <div id="auto_vehiclequicklink">
            <?php
                require_once( 'vehicle_quicklink.php' );
            ?>
        </div>
		<?php } ?>
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLE_DETAILS'); ?></span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>

    <div id="auto_detailvehiclewraper">
            <?php
                $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
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
                        <?php
                            $price = $this->vehicle->price;
							if(($price!="") && ($price!=0)){
								$price = number_format($price);
                            echo  $this->vehicle->currency. $price;

							}else{

								echo  JText::_('PRICE_NOT_GIVEN');
							}
                        ?>

                </span>
            </div>
    <div class="<?php echo $divclass[$isodd]; ?>" id="jsautoz_detail_wraper" > 
		<div id="auto_detail_table">
            <div  id="auto_image">
                <?php if ($this->vehicle->vehiclelogo != ''){ ?>
                    <img alt="" width="100px" height="100px" src="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_m_'.$this->vehicle->vehiclelogo; ?>"  /><br>
                <?php }else{ ?>
                    <img  src="components/com_jsautoz/images/default_jsautoz.png" width="100px" height="100px" title="picture"  alt="Default"/><br>
                <?php } ?>
            </div>
            <div id="auto_data">
				<div  id="auto_information">
					<div id="auto_detail_overallrating">
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
						</div>
						<div id="auto_detail_rating_portion">
						</div>
					</div>			
			<div id="auto_detaillocation">
			<strong> <?php echo JText::_('LOCATION'); ?>:</strong>
			<span class="theme_data_text_color">
				<?php
					$comma=", ";
					if($this->vehicle->cityname !=''){
						echo $this->vehicle->cityname.$comma;

					}elseif($this->vehicle->city !=''){
						echo $this->vehicle->city.$comma;

					}
					if($this->vehicle->countyname !=''){

						echo $this->vehicle->countyname.$comma;

					}elseif($this->vehicle->county !=''){

						echo $this->vehicle->county.$comma;

					}
					if($this->vehicle->statename !=''){
						echo $this->vehicle->statename.$comma ;

					}elseif($this->vehicle->state!=''){

						echo $this->vehicle->state.$comma;

					}

					if($this->vehicle->countryname!=''){

						echo $this->vehicle->countryname;

					}elseif($this->vehicle->country!=''){

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
				<img  src="components/com_jsautoz/images/default_jsautoz50.png" width="50px" height="50px" title="picture"  alt="Default"/>
				<?php } ?>
			<?php 
                            $thumbcount = 0;
                            if(!empty($this->vehicleimages))
                            foreach ( $this->vehicleimages AS $vehicleimage ){ 
                                $thumbcount++;?>
				<div id="auto_thumbsetting">
						<a rel="lightbox[roadtrip]" href="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_l_'.$vehicleimage->filename; ?>"  title="Vehicle Images"  >
                                                    <?php if($thumbcount <= 4){ ?>
                                                    <img  alt="" src="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_s_'.$vehicleimage->filename; ?>" />
                                                    <?php } ?>
						 </a>
				</div>
			<?php } ?>
		</div>
                <div id="tabsshadow"></div>
		<div class="<?php echo $divclass[$isodd]; ?>" id="auto_vdtabs">
			<span>
				<ul >
					<li class="rightborder" ><a  href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>" <?php if($this->layout=="vehicle_overview") echo 'class="youarehere"';?> ><span><?php echo JText::_('OVERVIEW') ; ?></span></a></li>
					<li class="rightborder" ><a  href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_specification&id=<?php echo $id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>" <?php if($this->layout=="vehicle_specification") echo 'class="youarehere"';?> ><span><?php echo JText::_('SPECIFICATION') ; ?></span></a></li>
					<li class="rightborder" ><a  href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_gallery&id=<?php echo $id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>" <?php if($this->layout=="vehicle_gallery") echo 'class="youarehere"';?> ><span><?php echo JText::_('GALLERY') ; ?></span></a></li>
				</ul>
			 </span>
			<div id="auto_detail_feature_icon">
			</div>
		</div>
            
    </div>

    </div>
<!-- <br clear="all">-->

<?php } ?>

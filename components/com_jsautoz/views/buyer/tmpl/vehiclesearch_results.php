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
$document =& JFactory::getDocument();
 $document->addStyleSheet('components/com_jsautoz/themes/'.$this->config['theme']);


  JHTML::_('behavior.modal');

?>
<div>
<div>
    <?php if ($this->config['offline'] == '1'){ ?>
        <div>
            <div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
            <div class="jsautozmsg"><?php echo $this->config['offline_text']; ?></div>
        </div>
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
							<?php echo JText::_('CUR_LOC'); ?> :
							 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('CONTROL_PANEL'); ?></a> >
							 <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch&Itemid=<?php echo $this->Itemid ; ?> "><?php echo JText::_('VEHICLE_SEARCH'); ?></a> >
							 <?php echo JText::_('VEHICLES_SEARCH_RESULT'); ?>
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
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLES_SEARCH_RESULT'); ?></span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>

<?php
    $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
    $isodd =1;
    $a=1; 
	$calfrm = 7;
?>

    <?php  if(isset($this->vehiclesearchresult)){ ?>
        <?php  foreach($this->vehiclesearchresult AS $vehicle){
                
                    $isodd = 1 - $isodd; ?>
							<div class="<?php echo $divclass[$isodd]; ?>" id="auto_vehiclelistwraper">
								<div  id="auto_maintitle">
									<?php if ($vehicle->title != '') { ?>
										<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id ; ?>&cl=7&Itemid=<?php echo $this->Itemid ;?>"  title="Vehicle Images"  > 
										<span id="auto_maintitle_text"><?php echo $vehicle->title; ?> </span></a>
									<?php } else { ?>
										<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id ; ?>&cl=7&Itemid=<?php echo $this->Itemid ;?>"  title="Vehicle Images"  >
										<span id="auto_maintitle_text"><?php echo $vehicle->maketitle . '     ' . $vehicle->modeltitle; ?></span>
										</a>
									<?php } ?>
									<span id="auto_maintitle_price">
										<?php
										$price = $vehicle->price;
										if(($price!="") && ($price!=0)){
											$price = number_format($price);
											echo $vehicle->currency . $price;

										}else{

											echo  JText::_('PRICE_NOT_GIVEN');
										}
										?>
									</span>
								</div>
								<div id="auto_datawraper">
									<div  id="auto_image">
										<?php if ($vehicle->vehiclelogo != '') { ?>
											<a href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id ; ?>&cl=7&Itemid=<?php echo $this->Itemid ;?>"  title="Vehicle Images"  >
											<img alt="" width="100px" height="100px"  src="<?php echo $this->config['data_directory']; ?>/data/vehicle/vehicle_<?php echo $vehicle->id; ?>/images/thumbs/<?php echo 'jsautoz_m_' . $vehicle->vehiclelogo; ?>"  /><br>
											<?php if ($vehicle->issold == 1) { ?>
												<img class="soldimage" src="components/com_jsautoz/images/sold.png" width="83px" height="83px"/>
											<?php } ?>
											</a>
										<?php } else { ?>
											<a href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id ; ?>&cl=7&Itemid=<?php echo $this->Itemid ;?>"  title="Vehicle Images"  >
											<img  width="100px" height="100px" src="components/com_jsautoz/images/default_jsautoz.png" title="picture"  alt="Default"/><br>
											</a>
										<?php } ?>
									</div>
									<div id="auto_data">
										<div  id="auto_information">
											<span id="auto_information_info" >
												<strong > <?php echo JText::_('MAKE'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->maketitle . '<br>'; ?></span>
												<strong> <?php echo JText::_('MODEL'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->modeltitle . '<br>'; ?></span>
												<strong> <?php echo JText::_('MODEL_YEAR'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->modelyeartitle . '<br>'; ?></span>
											</span>
											<span id="auto_information_info" >
												<strong> <?php echo JText::_('VEHICLE_TYPE'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->vehicletitle . '<br>'; ?></span>
												<strong> <?php echo JText::_('CONDITION'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->conditiontitle . '<br>'; ?></span>
												<strong> <?php echo JText::_('FUEL_TYPE'); ?>  </strong>
												<span class="theme_data_text_color" ><?php echo $vehicle->fueltypetitle . '<br>'; ?></span>
											</span>
											<span id="auto_information_rating" >

												<span class="auto_writereview">
													<a class="button" id="button" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id ; ?>&cl=7&Itemid=<?php echo $this->Itemid ;?>"> 
														<?php echo JText::_('VEHICLE_DETAIL'); ?>
													</a>
												</span>

											</span>
										</div>
										<div  id="auto_location" >
											<strong> <?php echo JText::_('LOCATION'); ?>:</strong>
											<span class="theme_data_text_color">
												<?php
												$comma = ", ";
												if ($vehicle->cityname != '') {
													echo $vehicle->cityname . $comma;
												} elseif ($vehicle->city != '') {
													echo $vehicle->city . $comma;
												}
												if ($vehicle->countyname != '') {

													echo $vehicle->countyname . $comma;
												} elseif ($vehicle->county != '') {

													echo $vehicle->county . $comma;
												}
												if ($vehicle->statename != '') {
													echo $vehicle->statename . $comma;
												} elseif ($vehicle->state != '') {

													echo $vehicle->state . $comma;
												}

												if ($vehicle->countryname != '') {

													echo $vehicle->countryname;
												} elseif ($vehicle->country != '') {

													echo $vehicle->country;
												}
												?>
											</span>
											<?php
											$vehcreated = date("F d, Y", strtotime($vehicle->created));
											echo '<span class="theme_data_text_color auto_dateposted">' . $vehcreated . '</span>';
											?>
										</div>
									</div>
								</div>
								<div id="auto_shortlist"  >
									<span id="vehicle_shortlist_<?php echo $id; ?>"></span>
								</div>
							</div>
        <?php } ?>
    <?php } ?>

    <br clear="all">
        <div class="auto_pagination">

     <form action="<?php echo JRoute::_('index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch_results&Itemid='.$this->Itemid); ?>" method="post">
				<div id="jl_pagination">
					<div id="jl_pagination_pageslink">
						<?php //$this->pagination->setAdditionalUrlParam('', $querystring);
								echo $this->pagination->getPagesLinks(); ?>
					</div>
					<div id="jl_pagination_box">
						<?php	
							echo JText::_('DISPLAY_#');
							echo $this->pagination->getLimitBox();
						?>
					</div>
					<div id="jl_pagination_counter">
						<?php echo $this->pagination->getResultsCounter(); ?>
					</div>
				</div>
</form>
        </div>


    <?php
}//ol
?>
 </div>   
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>

<script language="javascript" type="text/javascript">
		function makereview(vehicleid,calfrm){
			$.post("index.php?option=com_jsautoz&task=getvehiclereviewajax",{vehicleid:vehicleid,calfrm:calfrm},function(data){
				if(data){
					$("#vehicle_review").show();
					$("#vehicle_review_form").html(data);
					$("#popup").slideDown("slow");
				}else{
					alert("<?php echo JText::_('SOME_PROBLEM_OCCURED');?>");
				}
			});
		}
		function closereview(){
			$("#popup").slideUp("slow",function(){
				$("#vehicle_review").hide();
			});
			
		}
        function vehicleshortlist(src,vehicleid,uid,vtype) {
            document.getElementById(src).innerHTML="Loading ...";
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
                    document.getElementById(src).innerHTML="";
                    document.getElementById("addtoshortlist").innerHTML=xhr.responseText; //retuen value
                    $("div#tellafriend_headline,shortlist").show();
                    $("#addtoshortlist").show();
                    $("#popup").slideDown("slow");

                }
            }
            var vsrc = src;
            xhr.open("GET","index.php?option=com_jsautoz&task=vehicleaddtoshortlist&id="+vehicleid+"&uid="+uid+"&vsrcid="+vsrc+"&vtype="+vtype,true);
            xhr.send(null);
		
		
        }
        function vehicleshortlistclose(src){
            //document.getElementById(src).innerHTML="";
            $("#popup").slideUp("slow",function(){
                $("#addtoshortlist").html("");
                $("div#tellafriend_headline.shortlist").hide();
            });
            
	
        }
        function setrating(src,newrating) {
            document.getElementById(src).style.width=parseInt(newrating*20)+'%';
            document.getElementById('vehicleshortlistrating').value=newrating;
        }
        function vehicleshortlistsave(src,vehicleid,uid,slid)   {
            comments=document.getElementById('comments_'+vehicleid).value;
            rating=document.getElementById('rating_'+vehicleid).style.width;
            rateintvalue = parseInt(rating);
            rate=rateintvalue/20;
		 
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
                    $("#popup").slideUp("slow",function(){
							$("#addtoshortlist").slideUp("slow");
						});
                    src = "#"+src;
                    $(src).html(xhr.responseText); //retuen value                        
                    $(src).fadeIn(5000, function(){
                        $(src).fadeOut(7000);
                    });
                }
            }
            xhr.open("GET","index.php?option=com_jsautoz&task=savevehicleshortlist&id="+vehicleid+"&uid="+uid+"&comments="+comments+"&rate="+rate+"&slid="+slid,true);
            xhr.send(null);
        }
	function tellafriend(vehicletitle,v_id){
		$("#tellafriend").toggle();
		$("#vtitle").val(vehicletitle);
		$("#vid").val(v_id);
		$("#popup").slideDown("slow");
	}
</script>

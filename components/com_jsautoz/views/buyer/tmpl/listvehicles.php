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
$document->addStyleSheet('components/com_jsautoz/css/star_rating.css');
$document->addStyleSheet('components/com_jsautoz/css/jsautozrating.css');
JHTML::_('behavior.modal');
$link = "index.php?option=com_jsautoz&view=buyer&layout=listvehicles";
$calfrm = JRequest::getVar('cl');
$vtype = JRequest::getVar('vtype');
?>

    <?php if ($this->config['offline'] == '1') { ?>
        <div class="contentpane">
            <div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
            <div class="jsautozmsg">
                <?php echo $this->config['offline_text']; ?>
            </div>
        </div>
    <?php } else { ?>
        <?php
        $mkmdtitle = '';
        $typetitle = "";
        if (isset($this->maketitle))
            $mkmdtitle = ' [' . $this->maketitle->title . ']';
        if (isset($this->modeltitle))
            $mkmdtitle .= ' [' . $this->modeltitle->title . ']';
        if (isset($this->typetitle))
            $typetitle = $this->typetitle->title;
        ?>
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
                    <?php echo JText::_('CUR_LOC'); ?> :
                    <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANEL'); ?></a> >
                    <?php if ($calfrm == 1) { ?>
                        <?php if ($vtype) { ?>
                            <?php if ($vtype == 1) { ?>
                                <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=<?php echo $vtype ?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?></a> >
                                <?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>

                            <?php } elseif ($vtype == 2) { ?>
                                <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&vtype=<?php echo $vtype ?>&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?></a> >
                                <?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>

                            <?php } ?>

                        <?php } else {echo JText::_('VEHICLES');} ?>

                    <?php } elseif ($calfrm == 2) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebycity&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('VEHICLES_BY_CITY'); ?></a> >
                        <?php echo JText::_('VEHICLES_BY_CITY'); ?>
                    <?php } elseif ($calfrm == 3) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebyprice&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('VEHICLES_BY_PRICE'); ?></a> >
                        <?php echo JText::_('VEHICLES_BY_PRICE'); ?>
                    <?php } elseif ($calfrm == 4) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebymodelyear&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?></a> >
                        <?php echo JText::_('VEHICLES_BY_MODEL_YEAR'); ?>
                    <?php } elseif ($calfrm == 10) { ?>
                        <?php echo JText::_('VEHICLES_BY_DEALER'); ?>
                    <?php } elseif ($calfrm == 11) { ?>
                        <?php echo JText::_('VEHICLES'); ?>
                    <?php } elseif ($calfrm == 12) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicles&cl=<?php echo $calfrm; ?>&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('NEW_AND_USED_VEHICLE_MAKE_AND_MODEL'); ?></a> >
                        <?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>

                    <?php } elseif ($calfrm == 13) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=dealerlist&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('DEALERS'); ?></a> >
                        <?php echo JText::_('VEHICLES_BY_DEALER'); ?>

                    <?php } elseif ($calfrm == 16) { ?>
                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehiclebytypes&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('VEHICLES_BY_TYPE'); ?></a> >
                        <?php echo $typetitle; ?>
                    <?php } elseif ($this->vtype == 1) { ?>
                        <?php
                        echo JText::_('NEW_VEHICLES');
                        $calfrm = 8;
                        ?>
                    <?php } elseif ($this->vtype == 2) { ?>
                        <?php
                        echo JText::_('USED_VEHICLES');
                        $calfrm = 8;
                        ?>
                    <?php } else { ?>
                        <?php echo JText::_('NEW_VEHICLES'); ?>
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
            <?php if ($this->config['vehiclefilter'] == 1) { ?>
                <div id="auto_vehiclefilter">
                        <?php require_once( 'vehicle_filter.php' ); ?>
                </div>
            <?php } ?>
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center">
						<?php if ($calfrm == 1) { ?>
							<?php if ($vtype == 1) { ?>
								<div  id="tp_headingtext"><?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL') . $mkmdtitle; ?></div>
							<?php } elseif ($vtype == 2) { ?>
								<div  id="tp_headingtext"><?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL') . $mkmdtitle; ?></div>
							<?php } else { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES') . $mkmdtitle; ?></div>
							<?php } ?>
						<?php } elseif ($calfrm == 2) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_CITY'); ?></div>
						<?php } elseif ($calfrm == 3) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_PRICE'); ?></div>
						<?php } elseif ($calfrm == 4) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_MODEL_YEAR');
								if (isset($this->modelyeartitle)) echo ' [' . $this->modelyeartitle->title . ']';
							?></div>
						<?php }elseif ($calfrm == 10) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_DEALER'); ?></div>
						<?php } elseif ($calfrm == 11) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES'); ?></div>
						<?php } elseif ($calfrm == 12) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_MAKE_AND_MODEL') . $mkmdtitle; ?></div>
						<?php } elseif ($calfrm == 13) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_DEALER'); ?></div>
						<?php } elseif ($calfrm == 16) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES_BY_TYPE') . " [ " . $typetitle . " ] "; ?></div>
						<?php } elseif ($this->vtype == 1) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('NEW_VEHICLES'); ?></div>
						<?php } elseif ($this->vtype == 2) { ?>
							<div  id="tp_headingtext"><?php echo JText::_('USED_VEHICLES'); ?></div>

						<?php } else { ?>
							<div  id="tp_headingtext"><?php echo JText::_('VEHICLES') . $mkmdtitle; ?></div>
						<?php } ?>
					</span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>

        <?php
        $querystring = "";
        if ($this->vtype)
            $querystring = '&vtype=' . $this->vtype;
        if ($this->modelid)
            $querystring .= '&md=' . $this->modelid;
        /*if ($this->md2)
            $querystring .= '&md2=' . $this->md2;
            */ 
        if ($this->makeid)
            $querystring .= '&mk=' . $this->makeid;
        if ($this->country)
            $querystring .= '&country=' . $this->country;
        if ($this->txt_state) {
            $querystring .= '&txt_state=' . $this->txt_state;
        } else {
            if ($this->state)
                $querystring .= '&state=' . $this->state;
        }
        if ($this->txt_county) {
            $querystring .= '&txt_county=' . $this->txt_county;
        } else {
            if ($this->county)
                $querystring .= '&county=' . $this->county;
        }
        if ($this->txt_city) {
            $querystring .= '&txt_city=' . $this->txt_city;
        } else {
            if ($this->city)
                $querystring .= '&city=' . $this->city;
        }
        if ($this->pricestart)
            $querystring .= '&prs=' . $this->pricestart;
        if ($this->priceend)
            $querystring .= '&pre=' . $this->priceend;
        if ($this->myid)
            $querystring .= '&mod=' . $this->myid;
        if ($this->dellerid)
            $querystring .= '&did=' . $this->dellerid;
        if ($this->cl)
            $querystring .= '&cl=' . $this->cl;
        if ($this->type)
            $querystring .= '&type=' . $this->type;
        $querystring .= '&Itemid=' . $this->Itemid;
        $link_sort_pagination = 'index.php?option=com_jsautoz&view=buyer&layout=listvehicles'.$querystring;
        //echo 'list vehicle '.$querystring;
        ?>

        <div id="auto_vehiclesortby">
            <form action="<?php echo JRoute::_($link_sort_pagination); ?>" name="sortbyFrom" id="sortbyFrom" method="post">
				<div id="sortby_inner">
					<span id="sortby_text"><?php echo JText::_('SORT_BY'); ?> :</span>
					<div id="sortby_value">
						<?php
						echo $this->sort['sort'];
						if ($this->sortorder == 'asc')
							$img = "components/com_jsautoz/images/sort0.png";
						else
							$img = "components/com_jsautoz/images/sort1.png";
						?>
						<a href="#" onclick="submitSorting(2)"><img alt="" src="<?php echo $img ?>"></a>
					</div>
				</div>
                <input type="hidden" name="vtype" value="<?php echo $this->vtype; ?>">
                <input type="hidden" name="lv_sortorder" id="lv_sortorder" value="<?php if ($this->sortorder == 'asc') echo 'asc'; else echo 'desc'; ?>">
                <input type="hidden" name="mk" value="<?php echo $this->makeid; ?>">
                <input type="hidden" name="md" value="<?php echo $this->modelid; ?>">

                <input type="hidden" id="country" name="country" value="<?php echo $this->country; ?>">
                <input type="hidden" id="state" name="state" value="<?php echo $this->state; ?>">
                <input type="hidden" id="county" name="county" value="<?php echo $this->county; ?>">
                <input type="hidden" id="city" name="city" value="<?php echo $this->city; ?>">
                <input type="hidden" name="prs" value="<?php echo $this->pricestart; ?>">
                <input type="hidden" name="pre" value="<?php echo $this->priceend; ?>">
                <input type="hidden" name="mod" value="<?php echo $this->myid; ?>">
                <input type="hidden" name="did" value="<?php echo $this->dellerid; ?>">
                <input type="hidden" name="cl" value="<?php echo $this->cl; ?>">
                <input type="hidden" name="type" value="<?php echo $this->type; ?>">

            </form>
        </div>
        <form action="index.php" name="adminvForm" id="adminvForm" method="post">
            <?php
            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
            $isodd = 1;
            ?>

            <?php
            $a = 1;
            ?>

    <?php
    if(!empty($this->vehiclelist))
    foreach ($this->vehiclelist AS $vehicle) {
        $isodd = 1 - $isodd;
        ?>

        <div class="<?php echo $divclass[$isodd]; ?>" id="auto_vehiclelistwraper">
			<div  id="auto_maintitle">
				<?php if ($vehicle->title != '') { ?>
					<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&did=<?php echo $this->dellerid; ?>&Itemid=<?php echo $this->Itemid; ?>"  title="Vehicle Images"  > 
					<span id="auto_maintitle_text"><?php echo $vehicle->title; ?> </span></a>
				<?php } else { ?>
					<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&did=<?php echo $this->dellerid; ?>&Itemid=<?php echo $this->Itemid; ?>"  title="Vehicle Images"  >
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
						<a href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&did=<?php echo $this->dellerid; ?>&Itemid=<?php echo $this->Itemid; ?>"  title="Vehicle Images"  >
						<img alt="" width="100px" height="100px"  src="<?php echo $this->config['data_directory']; ?>/data/vehicle/vehicle_<?php echo $vehicle->id; ?>/images/thumbs/<?php echo 'jsautoz_m_' . $vehicle->vehiclelogo; ?>"  /><br>
						<?php if ($vehicle->soldvehicles == 1) { ?>
							<img class="soldimage" src="components/com_jsautoz/images/sold.png" width="83px" height="83px"/>
						<?php } ?>
						</a>
					<?php } else { ?>
						<a href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&did=<?php echo $this->dellerid; ?>&Itemid=<?php echo $this->Itemid; ?>"  title="Vehicle Images"  >
						<img  width="100px" height="100px" src="components/com_jsautoz/images/default_jsautoz.png" title="picture"  alt="Default"/><br>
						<?php if ($vehicle->soldvehicles == 1) { ?>
							<img class="soldimage" src="components/com_jsautoz/images/sold.png" width="83px" height="83px" />
						<?php } ?>
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
							<span class="theme_data_text_color" ><?php echo $vehicle->fueltitle . '<br>'; ?></span>
						</span>
						<span id="auto_information_rating" >

							<span class="auto_writereview">
								<a id="button" class="button" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&vtype=<?php echo $vtype; ?>&cl=<?php echo $calfrm; ?>&did=<?php echo $this->dellerid; ?>&Itemid=<?php echo $this->Itemid; ?>"> 
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
                <span id="vehicle_shortlist_<?php echo $id; ?>" style="display:none;"></span>
            </div>
        </div>
		<span style="float: left; width: 100% ; height: 5px;" ></span>
    <?php } ?>
            <input type="hidden" name="option" value="<?php echo $this->option; ?>">
            <input type="hidden" name="vehicleshortlistcomments" id="vehicleshortlistcomments" value="">
            <input type="hidden" name="vehicleshortlistrating" id="vehicleshortlistrating" value="">
            <input type="hidden" name="vehicleshortlistid" id="vehicleshortlistid" value="">
            <input type="hidden" name="vehicleshortlistuid" id="vehicleshortlistuid" value="">
            <input type="hidden" name="vehicleshortlistrd" id="vehicleshortlistrd" value="">
            <input type="hidden" name="task" id="task" value="">
        </form>
        <br clear="all">    
        <div class="auto_pagination">
			<form  action="<?php echo JRoute::_($link_sort_pagination); ?>" method="post">
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


                <input type="hidden" name="lv_sortorder" id="lv_sortorder" value="<?php if ($this->sortorder == 'asc') echo 'asc'; else echo 'desc'; ?>">
            </form>
        </div>

<?php } ?>

<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>

    <script type="text/javascript">
		
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
        function submitform(){
            document.adminForm.submit();

        }
        function submitSorting(callfrom){
            if(callfrom==2){
                var ordervalue=document.getElementById('lv_sortorder').value;

                if(ordervalue=='asc') ordervalue = 'desc'; else ordervalue = 'asc';
                //alert(ordervalue);
                document.getElementById('lv_sortorder').value=ordervalue;
            }
            document.sortbyFrom.submit();
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
							$("#addtoshortlist").hide();
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

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
jimport('joomla.html.pane');
JHTML :: _('behavior.calendar');
//JHTMLBehavior::formvalidation();
JHTML::_('behavior.formvalidation');

$document =& JFactory::getDocument();
//$document->addScript('../components/com_jsautoz/js/jquery.js');
//$document->addScript('../components/com_jsautoz/js/iColorPicker.js');
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);

$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$td=array('row0','row1');$k=0;
 JHTML::_('behavior.modal');
$i = 0;
?>
<style type="text/css">
div#map_container{
	width:100%;
	height:350px;
}
</style>

<script type="text/javascript" 
   src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
// for joomla 1.6
function cancel_popup() {
    

$(document).keydown(function(e) {
        // ESCAPE key pressed
        if (e.keyCode == 27) {
            $('div#iColorPicker').hide();
            //$('#iColorPicker').empty();
            var colorvalue=document.getElementById('color1').value;
            if(colorvalue==""){
                $("#color1").css({
                    "background": ""
                });
                
            }
        }
    });
    
    
}   
  function loadMap1(latitude,longitude,callfrom) {
                        var latlng = new google.maps.LatLng(latitude, longitude);
                        var myOptions = {
                        zoom: 4,
                        center: latlng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                        };
                        var map = new google.maps.Map(document.getElementById("map_container"),myOptions);

                        /*var marker = new google.maps.Marker({
                        position: latlng, 
                        map: map, 
                        title:"my hometown, Malim Nawar!"
                        }); 
                        google.maps.event.addListener(marker, 'click', function() { 
                        alert("I am marker " + marker.title); 
                        }); */

                    var lastmarker = new google.maps.Marker({
                    position: new google.maps.LatLng(latitude, longitude)
                    });
                    lastmarker.setMap(map); 

                    google.maps.event.addListener(map,"click", function(e){
                    //Initialize marker
                    var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(e.latLng.lat(),e.latLng.lng())
                    });
                    //Delete marker
                    if(lastmarker) lastmarker.setMap(null);;
                    //Add marker to the map
                    //alert(e.latLng.lng());
                    marker.setMap(map);
                    //Output marker information
                    document.getElementById("latitude").value=e.latLng.lat();
                    document.getElementById("longitude").value=e.latLng.lng();
                    //alert(e.latLng.lat());
                    //alert(e.latLng.lng());
                    //Memory marker to delete
                    lastmarker = marker;
                    }); 

  }

Joomla.submitbutton = function(task){
        if (task == ''){
                return false;
        }else{
                if (task == 'savevehicle'){
                    returnvalue = validate_form(document.adminForm);
                }else returnvalue  = true;
                if (returnvalue){
                        Joomla.submitform(task);
                        return true;
                }else return false;
        }
}
// for joomla 1.5
function submitbutton(pressbutton) {
	if (pressbutton) {
		document.adminForm.task.value=pressbutton;
	}
	if(pressbutton == 'savevehicle'){
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

<form action="index.php" method="post" name="adminForm" id="adminForm" >
    <table cellpadding="5" cellspacing="0" border="0" width="100%">          <!--Main Table Start-->
<?php if(isset($this->vehicle)){?>
         <tr class="row1">
            <td></td>
            <td valign="top" align="right">
                <?php $link = 'index.php?option=com_jsautoz&view=vehicle&layout=vehicle_review&cid[]='.$this->vehicleid.'&rd=1'; ?>
                <a   href="<?php echo $link;?>"><h3><?php echo JText::_('EDIT_VEHICLE_REVIEW') ?></h3></a>

            </td>
        </tr>
        <?php } ?>
        <?php
        $userfield_count = 0; // userfield count
        $k=0;
        foreach($this->fieldorderings as $field){
			switch ($field->field) {
                            case "title": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
                                                    <td width="25%"  valign="top" align="right"><label id="titlemsg" for="title"><?php echo JText::_('TITLE'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                    <td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="title" name="title" value="<?php if(isset($this->vehicle))echo $this->vehicle->title;?>"/></td>
                                    </tr>
                            <?php break;
				case "vehicletypeid": ?>
				   <tr class="<?php echo $td[$k];$k=1-$k;?>">
						   <td width="25%" valign="top" align="right"><label id="vechiletypeidmsg" for="vechiletypeid"><?php echo JText::_('VEHICLE_TYPE'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
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
				   <tr class="<?php echo $td[$k];$k=1-$k; ?>">
						   <td valign="top" align="right"><label id="modelyearidmsg" for="modelyearid"><?php echo JText::_('MODELYEAR'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
						   <td><?php echo $this->lists['modelyears']; ?></td>
				   </tr>
				<?php break;
				case "conditionid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="conditionidmsg" for="conditionid"><?php echo JText::_('CONDITION'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['conditions']; ?></td>
					</tr>
				<?php break;
				case "fueltypeid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="fueltypeidmsg" for="fueltypeid"><?php echo JText::_('FUELTYPES'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['fueltypes']; ?></td>
					</tr >
				 <?php break;
				case "cylinderid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="cylinderidmsg" for="cylinderid"><?php echo JText::_('CYLINDERS'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['cylinders']; ?></td>
					</tr>
				<?php break;
				case "transmissionid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="transmissionidmsg" for="transmissionid"><?php echo JText::_('TRANSMISSION'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['transmissions']; ?></td>
					</tr>
				<?php break;
				case "adexpiryid": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="adexpiryidmsg" for="adexpiryid"><?php echo JText::_('AD-EXPIRY'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['adexpiries']; ?></td>
					</tr>
				<?php break;
                                case "registrationnumber": ?>
                                <tr>
                                                        <td valign="top" align="right"><label id="transmissionidmsg" for="transmissionid"><?php echo JText::_('REGISTRATION_NUMBER'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                        <td><input  class="inputbox <?php if($field->required == 1) echo 'required';?>" type="text" id="title" name="registrationnumber" value="<?php if(isset($this->vehicle))echo $this->vehicle->registrationnumber;?>"/></td>
                                </tr>
                                <?php break;
				case "regcountry": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="regcountrymsg" for="regcountry"><?php echo JText::_('REG_COUNTRY'); ?></label></td>
							<td id="vehicleform_regcountry"><?php echo $this->lists['regcountry']?></td>
					</tr>
				<?php break;
				case "regstate": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="regstatemsg" for="regstate"><?php echo JText::_('REG_STATE'); ?></label></td>
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
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="regcountymsg" for="regcounty"><?php echo JText::_('REG_COUNTY'); ?></label></td>
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
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="regcitymsg" for="regcity"><?php echo JText::_('REG_CITY'); ?></label></td>
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
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
						   <td valign="top" align="right"><label id="loccountrymsg" for="loccountry"><?php echo JText::_('LOC_COUNTRY'); ?></label></td>
						   <td id="vehicleform_loccountry"><?php echo $this->lists['loccountry']; ?></td>
					</tr>
				<?php break;
				case "locstate": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="locstatemsg" for="locstate"><?php echo JText::_('LOC_STATE'); ?></label></td>
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
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="loccountymsg" for="loccounty"><?php echo JText::_('LOC_COUNTY'); ?></label></td>
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
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="loccitymsg" for="loccity"><?php echo JText::_('LOC_CITY'); ?></label></td>
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
				case "loczip": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="loczipmsg" for="loczip"><?php echo JText::_('LOC_ZIP'); ?></label></td>
							<td id="vehicleform_loczip">
								 <?php
								if ((isset($this->lists['zipcode'])) && ($this->lists['zipcode']!='')){
										echo $this->lists['zipcode'];
								} else{ ?>
										<input class="inputbox" type="text" name="loczip" size="40" maxlength="100" value="<?php if(isset($this->vehicle)) echo $this->vehicle->loczip; ?>" />
								<?php } ?>
							</td>

					</tr>
				<?php break;
				case "mileages": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="mileagesmsg" for="mileages"><?php echo JText::_('MILEAGES'); ?></label></td>
							<td>
                                                            <input class="inputbox" type="text" id="mileages" name="mileages" value="<?php if(isset($this->vehicle))echo $this->vehicle->mileages;?>"/>
                                                            <?php echo $this-> lists['mileagetypes']; ?>
                                                        </td>
					</tr>
				<?php break;
				case "price": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="pricemsg" for="price"><?php echo JText::_('PRICE'); ?></label></td>
							<td>
                                                            <?php echo $this-> lists['currency']; ?>
                                                            <input class="inputbox" type="text" id="price" name="price" value="<?php if(isset($this->vehicle)) echo $this->vehicle->price; ?>"/>
                                                        </td>
					</tr>
				<?php break;
				case "exteriorcolor": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="exteriorcolormsg" for="exteriorcolor"><?php echo JText::_('EXTERIORCOLOR'); ?></label></td>
							<td><input  class="inputbox" type="text" id="exteriorcolor" name="exteriorcolor" value="<?php if(isset($this->vehicle))echo $this->vehicle->exteriorcolor;?>"/></td>
                                                    <!--<td>
                                                        <input id="color1"  name="exteriorcolor" type="text" value="<?php if(isset($this->vehicle))echo $this->vehicle->exteriorcolor;?>" class="iColorPicker" />
                                                        <a id="icp_color1" onkeypress="cancel_popup();" onclick="iColorShow('color1','icp_color1')" href="javascript:void(null)">
                                                        <img align="absmiddle" style="border:0;margin:0 0 0 3px" src="../components/com_jsautoz/images/color.png">
                                                        </a>
                                                    </td>-->
					</tr>
				<?php break;
				case "interiorcolor": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="interiorcolormsg" for="interiorcolor"><?php echo JText::_('INTERIORCOLOR'); ?></label></td>
							<td><input  class="inputbox" type="text" id="interiorcolor" name="interiorcolor" value="<?php if(isset($this->vehicle))echo $this->vehicle->interiorcolor;?>"/></td>
					</tr>
				<?php break;
				case "enginecapacity": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="enginecapacitymsg" for="enginecapacity"><?php echo JText::_('ENGINECAPACITY'); ?></label></td>
							<td><input  class="inputbox" type="text" id="enginecapacity" name="enginecapacity" value="<?php if(isset($this->vehicle))echo $this->vehicle->enginecapacity;?>"/></td>
					</tr>
				<?php break;
				case "cityfuelconsumption": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="cityfuelconsumptionmsg" for="cityfuelconsumption"><?php echo JText::_('CITYFUELCONSUMPTION'); ?></label></td>
							<td><input class="inputbox" type="text" id="cityfuelconsumption" name="cityfuelconsumption" value="<?php if(isset($this->vehicle))echo $this->vehicle->cityfuelconsumption;?>"/></td>
					</tr>
				<?php break;
				case "highwayfuelconsumption": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="highwayfuelconsumptionmsg" for="highwayfuelconsumption"><?php echo JText::_('HIGHWAYFUELCONSUMPTION'); ?></label></td>
							<td><input  class="inputbox" type="text" id="highwayfuelconsumption" name="highwayfuelconsumption" value="<?php if(isset($this->vehicle))echo $this->vehicle->highwayfuelconsumption;?>"/></td>
					</tr>
				<?php break;
				case "map": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="mapmsg" for="map"><?php echo JText::_('MAP'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                        <td>
                                                           <!-- <? //if(isset($this->vehicle)) { ?>
                                                                <script type="text/javascript" language="javascript">
                                                                    window.onload= new Function("loadMap('<?php echo $this->vehicle->latitude; ?>', '<?php echo $this->vehicle->longitude; ?>','2');");
                                                                    //window.onload=loadMap;
                                                                </script>

                                                            <?php //}else{ ?>
                                                                <script type="text/javascript" language="javascript">
                                                                    window.onload= new Function("loadMap('29.2932951629731', '70.7044190168381','1');");

                                                                    //window.onload=loadMap;
                                                                </script>
                                                            <a href="#" onclick="Javascript:loadMap(1,'','','','')"><?php echo JText::_("SHOW_MAP"); ?></a>

                                                            <?php //} ?>-->
                                                            <div  id="map_container"></div>

                                                            <input type="text" id="longitude" name="longitude" value="<?php if(isset($this->vehicle)) echo $this->vehicle->longitude;?>"/><?php echo JText::_('LONGITUDE');?>
                                                            <br/><input type="text" id="latitude" name="latitude" value="<?php if(isset($this->vehicle)) echo $this->vehicle->latitude;?>"/><?php echo JText::_('LATITUDE');?>
                                                            <br/><input type="button" value="<?php echo JText::_('GET_ADDRESS_FROM_MARKER');?>" onclick="Javascript: loadMap(2,'country','state','county','city');"/>
                                                            <input type="button" value="<?php echo JText::_('SET_MARKER_FROM_ADDRESS');?>" onclick="Javascript: loadMap(3,'country','state','county','city');"/>
                                                            <!--<input class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="map" name="map" value="<?php if(isset($this->vehicle))echo $this->vehicle->map;?>"/>-->

                                                        </td>
					</tr>
				<?php break;
				case "video": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="videomsg" for="video"><?php echo JText::_('VIDEO'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><input  class="inputbox<?php if($field->required == 1) echo' required';?>" type="text" id="video" name="video" value="<?php if(isset($this->vehicle))echo $this->vehicle->video;?>"/>
                            <?php echo JText::_('YOUTUBE_VIDEO_ID');?> 
							</td>
					</tr>
				<?php break;
				case "status": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="statusmsg" for="status"><?php echo JText::_('STATUS'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['status']; ?></td>
					</tr>
				<?php break;
				case "issold": ?>
					<tr class="<?php echo $td[$k];$k=1-$k; ?>">
							<td valign="top" align="right"><label id="issoldmsg" for="issold"><?php echo JText::_('IS_SOLD'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
							<td><?php echo $this->lists['isold']; ?></td>
					</tr>
				<?php break;
                            case "enginenumber": ?>
                               <tr class="<?php echo $td[$k];$k=1-$k; ?>" >
                                                    <td valign="top" align="right"><label id="enginenumbermsg" for="enginenumber"><?php echo JText::_('ENGINE_NUMBER'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                    <td><input  class="inputbox <?php if($field->required == 1) echo 'required';?>" type="text" id="enginenumber" name="enginenumber" value="<?php if(isset($this->vehicle))echo $this->vehicle->enginenumber;?>"/></td>
                               </tr>
                            <?php break;
                            case "chasisnumber": ?>
                               <tr class="<?php echo $td[$k];$k=1-$k; ?>" >
                                                    <td valign="top" align="right"><label id="chasisnumbermsg" for="chasisnumber"><?php echo JText::_('CHASIS_NUMBER'); ?></label>&nbsp;<?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                    <td><input  class="inputbox <?php if($field->required == 1) echo 'required';?>" type="text" id="chasisnumber" name="chasisnumber" value="<?php if(isset($this->vehicle))echo $this->vehicle->enginenumber;?>"/></td>
                               </tr>
                            <?php break;
                            case "description": ?>
					<?php if ( $field->published == 1 ) { ?>
							<?php if ( $this->config['vf_editor'] == '1' ) { ?>
										<tr class="<?php echo $td[$k];$k=1-$k; ?>"><td height="10" colspan="2"></td></tr>
										<tr class="<?php echo $td[$k];$k=1-$k; ?>">
											<td colspan="2" valign="top" align="center"><label id="descriptionmsg" for="description"><strong><?php echo JText::_('DESCRIPTION'); ?></strong></label>&nbsp;<font color="red">*</font></td>
										</tr>
										<tr class="<?php echo $td[$k];$k=1-$k; ?>">
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
											<tr class="<?php echo $td[$k];$k=1-$k; ?>">
												<td valign="top" align="right"><label id="descriptionmsg" for="description"><?php echo JText::_('DESCRIPTION'); ?></label><?php if($field->required == 1){ echo '&nbsp;<font color="red">*</font>';} ?></td>
                                                                                                <td><textarea cols="" rows=""    id="description" name="description" ><?php if(isset($this->vehicle))echo $this->vehicle->description;?></textarea></td>
											</tr>
								<?php } ?>
				<?php   } ?>
                       <?php break;
				default:
					//echo '<br> default uf '.$filed->field;
					if ( $field->published == 1 ) {
						
						foreach($this->userfields as $ufield){
							if($field->field == $ufield[0]->id) {
								$userfield = $ufield[0];
								$userfield_count++;
								
								echo "<tr><td valign='top' align='right'>";
								if($userfield->required == 1){
									echo "<label id=".$userfield->name."msg for=$userfield->name>$userfield->title</label>&nbsp;<font color='red'>*</font>";
									if($userfield->type == 'emailaddress') $cssclass = "class ='inputbox required validate-email' ";
									else $cssclass = "class ='inputbox required' ";
								}else{
									echo $userfield->title;
									if($userfield->type == 'emailaddress') $cssclass = "class ='inputbox validate-email' ";
									else  $cssclass = "class='inputbox' ";
								}
								echo "</td><td>"	;

								$readonly = $userfield->readonly ? ' readonly="readonly"' : '';
		   						$maxlength = $userfield->maxlength ? 'maxlength="'.$userfield->maxlength.'"' : '';
								if(isset($ufield[1])){ $fvalue = $ufield[1]->data; $userdataid = $ufield[1]->id;}  else {$fvalue=""; $userdataid = ""; }
								echo '<input type="hidden" id="userfields_'.$userfield_count.'_id" name="userfields_'.$userfield_count.'_id"  value="'.$userfield->id.'"  />';
								echo '<input type="hidden" id="userdata_'.$userfield_count.'_id" name="userdata_'.$userfield_count.'_id"  value="'.$userdataid.'"  />';
								switch( $userfield->type ) {
									case 'text':
										echo '<input type="text" id="userfields_'.$userfield_count.'" name="userfields_'.$userfield_count.'" size="'.$userfield->size.'" value="'. $fvalue .'" '.$cssclass .$maxlength . $readonly . ' />';
										break;
									case 'emailaddress':
										echo '<input type="text" id="userfields_'.$userfield_count.'" name="userfields_'.$userfield_count.'" size="'.$userfield->size.'" value="'. $fvalue .'" '.$cssclass .$maxlength . $readonly . ' />';
										break;
									case 'date':
										$userfieldid = 'userfields_'.$userfield_count;
										$userfieldid = "'".$userfieldid."'";
										echo '<input type="text" id="userfields_'.$userfield_count.'" name="userfields_'.$userfield_count.'" readonly size="'.$userfield->size.'" value="'. $fvalue .'" '.$cssclass .$maxlength . $readonly . ' />';
										echo '<input type="reset" class="button" value="..." onclick="return showCalendar('.$userfieldid.',\'%Y-%m-%d\');"  />';
										break;
									case 'textarea':
										echo '<textarea name="userfields_'.$userfield_count.'" id="userfields_'.$userfield_count.'_field" cols="'.$userfield->cols.'" rows="'.$userfield->rows.'" '.$readonly.'>'.$fvalue.'</textarea>';
										break;
									case 'checkbox':
										echo '<input type="checkbox" name="userfields_'.$userfield_count.'" id="userfields_'.$userfield_count.'_field" value="1" '.  'checked="checked"' .'/>';
										break;
									case 'select':
										$htm = '<select name="userfields_'.$userfield_count.'" id="userfields_'.$userfield_count.'" >';
										if (isset ($ufield[2])){
											foreach($ufield[2] as $opt){
												if ($opt->id == $fvalue)
													$htm .= '<option value="'.$opt->id.'" selected="yes">'. $opt->fieldtitle .' </option>';
												else
													$htm .= '<option value="'.$opt->id.'">'. $opt->fieldtitle .' </option>';
											}
										}
										$htm .= '</select>';
										echo $htm;
								}
								echo '</td></tr>';
							}
						}
            		echo '<input type="hidden" id="userfields_total" name="userfields_total"  value="'.$userfield_count.'"  />';
					}
			}
        }
?>
		<table cellpadding="0" cellspacing="0" border="0" width="100%">
		        <tr >
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
								<tr class="<?php echo $td[$k];$k=1-$k;?>">
									   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('BODY'); ?></b></td>
								</tr>
								<?php break;
								  case "door2": ?>
									<tr class="<?php echo $td[$k];$k=1-$k;?>">
											<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door2' id='door2' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door2 == 1) ? "checked='checked'" : ""; } ?> /><label for="door2"><?php  echo JText::_('2_DOOR'); ?></label></td>
								<?php break;
								case "door3": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>' ; $colcount = 0;$k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door3' id='door3' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door3 == 1) ? "checked='checked'" : ""; } ?> /><label for="door3"><?php  echo JText::_('3_DOOR'); ?></label></td>
								<?php break;
								case "door4": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='door4' id='door4' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->door4 == 1) ? "checked='checked'" : ""; } ?> /><label for="door4"><?php  echo JText::_('4_DOOR'); ?></label></td>
								<?php break;
								case "covertible": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='covertible' id='covertible' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->covertible == 1) ? "checked='checked'" : ""; } ?> /><label for="covertible"><?php  echo JText::_('COVER_TIBLE'); ?></label></td>
								<?php break;
								case "crewcab": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='crewcab' id='crewcab' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->crewcab == 1) ? "checked='checked'" : ""; } ?> /><label for="crewcab"><?php  echo JText::_('CREW_CAB'); ?></label></td>
								<?php break;
								case "extendedcab": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='extendedcab' id='extendedcab' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->extendedcab == 1) ? "checked='checked'" : ""; } ?> /><label for="extendedcab"><?php  echo JText::_('EXTENDED_CAB'); ?></label></td>
								<?php break;
								case "longbox": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='longbox' id='longbox' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->longbox == 1) ? "checked='checked'" : ""; } ?> /><label for="longbox"><?php  echo JText::_('LONG_BOX'); ?></label></td>
								<?php break;
								case "offroadpackage": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++;  ?>
											 <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='offroadpackage' id='offroadpackage' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->offroadpackage== 1) ? "checked='checked'" : ""; } ?> /><label for="offroadpackage"><?php  echo JText::_('OFFROAD_PACKAGE'); ?></label></td>
								<?php break;
								case "shortbox": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
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
					<tr >
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('DRIVE_TRAIN'); ?></b></td>
									</tr>
									<?php break;
									case "wheeldrive2": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='wheeldrive2' id='wheeldrive2' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->wheeldrive2== 1) ? "checked='checked'" : ""; } ?> /><label for="wheeldrive2"><?php  echo JText::_('2_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "wheeldrive4": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='wheeldrive4' id='wheeldrive4' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->wheeldrive4== 1) ? "checked='checked'" : ""; } ?> /><label for="wheeldrive4"><?php  echo JText::_('4_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "allwheeldrive": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='allwheeldrive'id='allwheeldrive' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->allwheeldrive== 1) ? "checked='checked'" : ""; } ?> /><label for="allwheeldrive"><?php  echo JText::_('ALL_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "rearwheeldrive": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearwheeldrive' id='rearwheeldrive' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearwheeldrive== 1) ? "checked='checked'" : ""; } ?> /><label for="rearwheeldrive"><?php  echo JText::_('REAR_WHEEL_DRIVE'); ?></label></td>
									<?php break;
									case "supercharged": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='supercharged' id='supercharged' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->supercharged== 1) ? "checked='checked'" : ""; } ?> /><label for="supercharged"><?php  echo JText::_('SUPER_CHARGED'); ?></label></td>
									<?php break;
									case "turbo": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
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

					<tr >
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('EXTERIOR'); ?></b></td>
									</tr>
									<?php break;
									case "alloywheels": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='alloywheels' id='alloywheels' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->alloywheels== 1) ? "checked='checked'" : ""; } ?> /><label for="alloywheels"><?php  echo JText::_('ALLOY_WHEELS'); ?></label></td>
									<?php break;
									case "bedliner": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bedliner' id='bedliner' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bedliner== 1) ? "checked='checked'" : ""; } ?> /><label for="bedliner"><?php  echo JText::_('BED_LINER'); ?></label></td>
									<?php break;
									case "bugshield": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bugshield'id='bugshield' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bugshield== 1) ? "checked='checked'" : ""; } ?> /><label for="bugshield"><?php  echo JText::_('BUG_SHIELD'); ?></label></td>
									<?php break;
									case "campermirrors": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='campermirrors' id='campermirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->campermirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="campermirrors"><?php  echo JText::_('CAMPER_MIRRORS'); ?></label></td>
									<?php break;
									case "cargocover": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cargocover' id='cargocover' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cargocover== 1) ? "checked='checked'" : ""; } ?> /><label for="cargocover"><?php  echo JText::_('CARGO_COVER'); ?></label></td>
									<?php break;
									case "customwheels": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='customwheels' id='customwheels' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->customwheels== 1) ? "checked='checked'" : ""; } ?> /><label for="customwheels"><?php  echo JText::_('CUSTOM_WHEELS'); ?></label></td>
									<?php break;
									case "dualslidingdoors": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualslidingdoors' id='dualslidingdoors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualslidingdoors== 1) ? "checked='checked'" : ""; } ?> /><label for="dualslidingdoors"><?php  echo JText::_('DUAL_SLIDING_DOORS'); ?></label></td>
									<?php break;
									case "foglamps": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='foglamps' id='foglamps' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->foglamps== 1) ? "checked='checked'" : ""; } ?> /><label for="foglamps"><?php  echo JText::_('FOG_LAMPS'); ?></label></td>
									<?php break;
									case "heatedwindshield": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedwindshield' id='heatedwindshield' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedwindshield== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedwindshield"><?php  echo JText::_('HEATED_WIND_SHIELD'); ?></label></td>
									<?php break;
									case "immitationconvertibletop": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='immitationconvertibletop' id='immitationconvertibletop' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->immitationconvertibletop== 1) ? "checked='checked'" : ""; } ?> /><label for="immitationconvertibletop"><?php  echo JText::_('IMMITATION_CONVERTIBLE_TOP'); ?></label></td>
									<?php break;
									case "luggagerack": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='luggagerack' id='luggagerack' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->luggagerack== 1) ? "checked='checked'" : ""; } ?> /><label for="luggagerack"><?php  echo JText::_('LUGGAGE_RACK'); ?></label></td>
									<?php break;
									case "metallicpaint": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='metallicpaint' id='metallicpaint' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->metallicpaint== 1) ? "checked='checked'" : ""; } ?> /><label for="metallicpaint"><?php  echo JText::_('METALLIC_PAINT'); ?></label></td>
									<?php break;
									case "nerfbars": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='nerfbars' id='nerfbars' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->nerfbars== 1) ? "checked='checked'" : ""; } ?> /><label for="nerfbars"><?php  echo JText::_('NERF_BARS'); ?></label></td>
									<?php break;
									case "newtires": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='newtires' id='newtires' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->newtires== 1) ? "checked='checked'" : ""; } ?> /><label for="newtires"><?php  echo JText::_('NEW_TIRES'); ?></label></td>
									<?php break;
									case "premiumwheels": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='premiumwheels' id='premiumwheels' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->premiumwheels== 1) ? "checked='checked'" : ""; } ?> /><label for="premiumwheels"><?php  echo JText::_('PREMIUM_WHEELSS'); ?></label></td>
									<?php break;
									case "rearwiper": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearwiper' id='rearwiper' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearwiper== 1) ? "checked='checked'" : ""; } ?> /><label for="rearwiper"><?php  echo JText::_('REAR_WIPER'); ?></label></td>
									<?php break;
									case "removeabletop": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='removeabletop' id='removeabletop' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->removeabletop== 1) ? "checked='checked'" : ""; } ?> /><label for="removeabletop"><?php  echo JText::_('REMOVEABLE_TOP'); ?></label></td>
									<?php break;
									case "ridecontrol": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ridecontrol' id='ridecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ridecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="ridecontrol"><?php  echo JText::_('RIDE_CONTROL'); ?></label></td>
									<?php break;
									case "runningboards": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='runningboards' id='runningboards' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->runningboards== 1) ? "checked='checked'" : ""; } ?> /><label for="runningboards"><?php  echo JText::_('RUNNING_BOARDS'); ?></label></td>
									<?php break;
									case "splashquards": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='splashquards' id='splashquards' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->splashquards== 1) ? "checked='checked'" : ""; } ?> /><label for="splashquards"><?php  echo JText::_('SPLASH_QUARDS'); ?></label></td>
									<?php break;
									case "spoiler": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='spoiler' id='spoiler' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->spoiler== 1) ? "checked='checked'" : ""; } ?> /><label for="spoiler"><?php  echo JText::_('SPOILER'); ?></label></td>
									<?php break;
									case "sunroof": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='sunroof' id='sunroof' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->sunroof== 1) ? "checked='checked'" : ""; } ?> /><label for="sunroof"><?php  echo JText::_('SUN_ROOF'); ?></label></td>
									<?php break;
									case "ttops": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ttops' id='ttops' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ttops== 1) ? "checked='checked'" : ""; } ?> /><label for="ttops"><?php  echo JText::_('T_TOPS'); ?></label></td>
									<?php break;
									case "tonneaucover": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k;  } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tonneaucover' id='tonneaucover' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tonneaucover== 1) ? "checked='checked'" : ""; } ?> /><label for="tonneaucover"><?php  echo JText::_('TONNEAU_COVER'); ?></label></td>
									<?php break;
									case "towingpackage": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
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
					<tr >
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('INTERIOR'); ?></b></td>
									</tr>
									<?php break;
									case "ndrowbucketseats2": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ndrowbucketseats2' id='ndrowbucketseats2' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ndrowbucketseats2== 1) ? "checked='checked'" : ""; } ?> /><label for="ndrowbucketseats2"><?php  echo JText::_('NDROW_BUCKET_SEATS2'); ?></label></td>
									<?php break;
									case "rdrowseat3": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rdrowseat3' id='rdrowseat3' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rdrowseat3== 1) ? "checked='checked'" : ""; } ?> /><label for="rdrowseat3"><?php  echo JText::_('RDROWSEAT3'); ?></label></td>
									<?php break;
									case "adjustablefootpedals": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='adjustablefootpedals'id='adjustablefootpedals' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->adjustablefootpedals== 1) ? "checked='checked'" : ""; } ?> /><label for="adjustablefootpedals"><?php  echo JText::_('ADJUSTABLE_FOOT_PEDALS'); ?></label></td>
									<?php break;
									case "airconditioning": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='airconditioning' id='airconditioning' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->airconditioning== 1) ? "checked='checked'" : ""; } ?> /><label for="airconditioning"><?php  echo JText::_('AIR_CONDITIONING'); ?></label></td>
									<?php break;
									case "autodimisrvmirror": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='autodimisrvmirror' id='autodimisrvmirror' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->autodimisrvmirror== 1) ? "checked='checked'" : ""; } ?> /><label for="autodimisrvmirror"><?php  echo JText::_('AUTO_DIMISRV_MIRROR'); ?></label></td>
									<?php break;
									case "bucketseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='bucketseats' id='bucketseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->bucketseats== 1) ? "checked='checked'" : ""; } ?> /><label for="bucketseats"><?php  echo JText::_('BUCKET_SEATS'); ?></label></td>
									<?php break;
									case "centerconsole": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='centerconsole' id='centerconsole' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->centerconsole== 1) ? "checked='checked'" : ""; } ?> /><label for="centerconsole"><?php  echo JText::_('CENTER_CONSOLE'); ?></label></td>
									<?php break;
									case "childseat": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='childseat' id='childseat' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->childseat== 1) ? "checked='checked'" : ""; } ?> /><label for="childseat"><?php  echo JText::_('CHILD_SEAT'); ?></label></td>
									<?php break;
									case "cooledseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cooledseats' id='cooledseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cooledseats== 1) ? "checked='checked'" : ""; } ?> /><label for="cooledseats"><?php  echo JText::_('COOLED_SEATS'); ?></label></td>
									<?php break;
									case "cruisecontrol": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cruisecontrol' id='cruisecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cruisecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="cruisecontrol"><?php  echo JText::_('CRUISE_CONTROL'); ?></label></td>
									<?php break;
									case "dualclimatecontrol": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualclimatecontrol' id='dualclimatecontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualclimatecontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="dualclimatecontrol"><?php  echo JText::_('DUAL_CLIMATE_CONTROL'); ?></label></td>
									<?php break;
									case "heatedmirrirs": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedmirrirs' id='heatedmirrirs' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedmirrirs== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedmirrirs"><?php  echo JText::_('HEATED_MIRRIRS'); ?></label></td>
									<?php break;
									case "heatedseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='heatedseats' id='heatedseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->heatedseats== 1) ? "checked='checked'" : ""; } ?> /><label for="heatedseats"><?php  echo JText::_('HEATED_SEATS'); ?></label></td>
									<?php break;
									case "leatherseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='leatherseats' id='leatherseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->leatherseats== 1) ? "checked='checked'" : ""; } ?> /><label for="leatherseats"><?php  echo JText::_('LEATHER_SEATS'); ?></label></td>
									<?php break;
									case "power3rdrowseat": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='power3rdrowseat' id='power3rdrowseat' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->power3rdrowseat== 1) ? "checked='checked'" : ""; } ?> /><label for="power3rdrowseat"><?php  echo JText::_('POWER_3RD_ROW_SEAT'); ?></label></td>
									<?php break;
									case "powerdoorlocks": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerdoorlocks' id='powerdoorlocks' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerdoorlocks== 1) ? "checked='checked'" : ""; } ?> /><label for="powerdoorlocks"><?php  echo JText::_('POWER_DOOR_LOCKS'); ?></label></td>
									<?php break;
									case "powermirrors": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powermirrors' id='powermirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powermirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="powermirrors"><?php  echo JText::_('POWER_MIRRIORS'); ?></label></td>
									<?php break;
									case "powerseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerseats' id='powerseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerseats== 1) ? "checked='checked'" : ""; } ?> /><label for="powerseats"><?php  echo JText::_('POWER_SEATS'); ?></label></td>
									<?php break;
									case "powersteering": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powersteering' id='powersteering' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powersteering== 1) ? "checked='checked'" : ""; } ?> /><label for="powersteering"><?php  echo JText::_('POWER_STEERING'); ?></label></td>
									<?php break;
									case "powerwindows": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerwindows' id='powerwindows' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerwindows== 1) ? "checked='checked'" : ""; } ?> /><label for="powerwindows"><?php  echo JText::_('POWER_WINDOWS'); ?></label></td>
									<?php break;
									case "rearairconditioning": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearairconditioning' id='rearairconditioning' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearairconditioning== 1) ? "checked='checked'" : ""; } ?> /><label for="rearairconditioning"><?php  echo JText::_('REAR_AIR_CONDITIONING'); ?></label></td>
									<?php break;
									case "reardefrost": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='reardefrost' id='reardefrost' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->reardefrost== 1) ? "checked='checked'" : ""; } ?> /><label for="reardefrost"><?php  echo JText::_('REAR_DEFROST'); ?></label></td>
									<?php break;
									case "rearslidingwindow": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearslidingwindow' id='rearslidingwindow' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearslidingwindow== 1) ? "checked='checked'" : ""; } ?> /><label for="rearslidingwindow"><?php  echo JText::_('REAR_SLIDING_WINDOW'); ?></label></td>
									<?php break;
									case "tiltsteering": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tiltsteering' id='tiltsteering' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tiltsteering== 1) ? "checked='checked'" : ""; } ?> /><label for="tiltsteering"><?php  echo JText::_('TILT_STEERING'); ?></label></td>
									<?php break;
									case "tintedwindows": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
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
					<tr >
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('ELECTRONICS'); ?></b></td>
									</tr>
									<?php break;
									case "alarm": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='alarm' id='alarm' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->alarm== 1) ? "checked='checked'" : ""; } ?> /><label for="alarm"><?php  echo JText::_('ALARM'); ?></label></td>
									<?php break;
									case "amfmradio": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='amfmradio' id='amfmradio' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->amfmradio== 1) ? "checked='checked'" : ""; } ?> /><label for="amfmradio"><?php  echo JText::_('AMFM_RADIO'); ?></label></td>
									<?php break;
									case "antitheft": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='antitheft'id='antitheft' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->antitheft== 1) ? "checked='checked'" : ""; } ?> /><label for="antitheft"><?php  echo JText::_('ANTI_THEFT'); ?></label></td>
									<?php break;
									case "cdchanger": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cdchanger' id='cdchanger' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cdchanger== 1) ? "checked='checked'" : ""; } ?> /><label for="cdchanger"><?php  echo JText::_('CD_CHANGER'); ?></label></td>
									<?php break;
									case "cdplayer": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cdplayer' id='cdplayer' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cdplayer== 1) ? "checked='checked'" : ""; } ?> /><label for="cdplayer"><?php  echo JText::_('CD_PLAYER'); ?></label></td>
									<?php break;
									case "dualdvds": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dualdvds' id='dualdvds' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dualdvds== 1) ? "checked='checked'" : ""; } ?> /><label for="dualdvds"><?php  echo JText::_('DUAL_DVDS'); ?></label></td>
									<?php break;
									case "dvdplayer": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='dvdplayer' id='dvdplayer' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->dvdplayer== 1) ? "checked='checked'" : ""; } ?> /><label for="dvdplayer"><?php  echo JText::_('DVD_PLAYER'); ?></label></td>
									<?php break;
									case "handsfreecomsys": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='handsfreecomsys' id='handsfreecomsys' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->handsfreecomsys== 1) ? "checked='checked'" : ""; } ?> /><label for="handsfreecomsys"><?php  echo JText::_('HANDSFREE_COM_SYS'); ?></label></td>
									<?php break;
									case "homelink": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='homelink' id='homelink' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->homelink== 1) ? "checked='checked'" : ""; } ?> /><label for="homelink"><?php  echo JText::_('HOME_LINK'); ?></label></td>
									<?php break;
									case "informationcenter": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='informationcenter' id='informationcenter' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->informationcenter== 1) ? "checked='checked'" : ""; } ?> /><label for="informationcenter"><?php  echo JText::_('INFORMATION_CENTER'); ?></label></td>
									<?php break;
									case "integratedphone": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='integratedphone' id='integratedphone' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->integratedphone== 1) ? "checked='checked'" : ""; } ?> /><label for="integratedphone"><?php  echo JText::_('INTEGRATED_PHONE'); ?></label></td>
									<?php break;
									case "ipodport": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ipodport' id='ipodport' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ipodport== 1) ? "checked='checked'" : ""; } ?> /><label for="ipodport"><?php  echo JText::_('IPOD_PORT'); ?></label></td>
									<?php break;
									case "ipodmp3port": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='ipodmp3port' id='ipodmp3port' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->ipodmp3port== 1) ? "checked='checked'" : ""; } ?> /><label for="ipodmp3port"><?php  echo JText::_('IPOD_MP3_PORT'); ?></label></td>
									<?php break;
									case "keylessentry": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='keylessentry' id='keylessentry' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->keylessentry== 1) ? "checked='checked'" : ""; } ?> /><label for="keylessentry"><?php  echo JText::_('KEY_LESSENTRY'); ?></label></td>
									<?php break;
									case "memoryseats": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='memoryseats' id='memoryseats' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->memoryseats== 1) ? "checked='checked'" : ""; } ?> /><label for="memoryseats"><?php  echo JText::_('MEMORY_SEATS'); ?></label></td>
									<?php break;
									case "navigationsystem": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='navigationsystem' id='navigationsystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->navigationsystem== 1) ? "checked='checked'" : ""; } ?> /><label for="navigationsystem"><?php  echo JText::_('NAVIGATION_SYSTEM'); ?></label></td>
									<?php break;
									case "onstar": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='onstar' id='onstar' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->onstar== 1) ? "checked='checked'" : ""; } ?> /><label for="onstar"><?php  echo JText::_('ON_STAR'); ?></label></td>
									<?php break;
									case "backupcameraandmirror": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='backupcameraandmirror' id='backupcameraandmirror' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->backupcameraandmirror== 1) ? "checked='checked'" : ""; } ?> /><label for="backupcameraandmirror"><?php  echo JText::_('BACKUP_CAMERAAND_MIRROR'); ?></label></td>
									<?php break;
									case "parkassistrear": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='parkassistrear' id='parkassistrear' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->parkassistrear== 1) ? "checked='checked'" : ""; } ?> /><label for="parkassistrear"><?php  echo JText::_('PARK_ASSISTREAR'); ?></label></td>
									<?php break;
									case "powerliftgate": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='powerliftgate' id='powerliftgate' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->powerliftgate== 1) ? "checked='checked'" : ""; } ?> /><label for="powerliftgate"><?php  echo JText::_('POWER_LIFT_GATE'); ?></label></td>
									<?php break;
									case "rearlockingdifferential": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearlockingdifferential' id='rearlockingdifferential' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearlockingdifferential== 1) ? "checked='checked'" : ""; } ?> /><label for="rearlockingdifferential"><?php  echo JText::_('REAR_LOCKING_DIFFERENTIAL'); ?></label></td>
									<?php break;
									case "rearstereo": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearstereo' id='rearstereo' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearstereo== 1) ? "checked='checked'" : ""; } ?> /><label for="rearstereo"><?php  echo JText::_('REAR_STEREO'); ?></label></td>
									<?php break;
									case "remotestart": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='remotestart' id='remotestart' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->remotestart== 1) ? "checked='checked'" : ""; } ?> /><label for="remotestart"><?php  echo JText::_('REMOTE_START'); ?></label></td>
									<?php break;
									case "satelliteradio": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='satelliteradio' id='satelliteradio' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->satelliteradio== 1) ? "checked='checked'" : ""; } ?> /><label for="satelliteradio"><?php  echo JText::_('SATELLITE_RADIO'); ?></label></td>
									<?php break;
									case "steeringwheelcontrols": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='steeringwheelcontrols' id='steeringwheelcontrols' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->steeringwheelcontrols== 1) ? "checked='checked'" : ""; } ?> /><label for="steeringwheelcontrols"><?php  echo JText::_('STEERING_WHEEL_CONTROLS'); ?></label></td>
									<?php break;
									case "stereotape": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='stereotape' id='stereotape' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->stereotape== 1) ? "checked='checked'" : ""; } ?> /><label for="stereotape"><?php  echo JText::_('STEREO_TAPE'); ?></label></td>
									<?php break;
									case "tirepressuremonitorsystem": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tirepressuremonitorsystem' id='tirepressuremonitorsystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tirepressuremonitorsystem== 1) ? "checked='checked'" : ""; } ?> /><label for="tirepressuremonitorsystem"><?php  echo JText::_('TIRE_PREEEURE_MONITOR_SYSTEM'); ?></label></td>
									<?php break;
									case "trailerbrakesystem": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='trailerbrakesystem' id='trailerbrakesystem' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->trailerbrakesystem== 1) ? "checked='checked'" : ""; } ?> /><label for="trailerbrakesystem"><?php  echo JText::_('TRAILER_BRAKE_SYSTEM'); ?></label></td>
									<?php break;
									case "tripmileagecomputer": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
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
					<tr>
						<td>
							 <table cellpadding="3" cellspacing="0" border="0" width="100%">
									<tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
										   <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php  echo JText::_('SAFETY_FEATURES'); ?></b></td>
									</tr>
									<?php break;
									case "antilockbrakes": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='antilockbrakes' id='antilockbrakes' value='1'<?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->antilockbrakes== 1) ? "checked='checked'" : ""; } ?> /><label for="antilockbrakes"><?php  echo JText::_('ANTI_LOCK_BRAKES'); ?></label></td>
									<?php break;
									case "backupsensors": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='backupsensors' id='backupsensors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->backupsensors== 1) ? "checked='checked'" : ""; } ?> /><label for="backupsensors"><?php  echo JText::_('BACKUP_SENSORS'); ?></label></td>
									<?php break;
									case "cartracker": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='cartracker'id='cartracker' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->cartracker== 1) ? "checked='checked'" : ""; } ?> /><label for="cartracker"><?php  echo JText::_('CAR_TRACKER'); ?></label></td>
									<?php break;
									case "driverairbag": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='driverairbag' id='driverairbag' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->driverairbag== 1) ? "checked='checked'" : ""; } ?> /><label for="driverairbag"><?php  echo JText::_('DRIVER_AIR_BAG'); ?></label></td>
									<?php break;
									case "passengerairbag": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='passengerairbag' id='passengerairbag' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->passengerairbag== 1) ? "checked='checked'" : ""; } ?> /><label for="passengerairbag"><?php  echo JText::_('PASSENGER_AIR_BAG'); ?></label></td>
									<?php break;
									case "rearairbags": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='rearairbags' id='rearairbags' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->rearairbags== 1) ? "checked='checked'" : ""; } ?> /><label for="rearairbags"><?php  echo JText::_('REAR_AIR_BAG'); ?></label></td>
									<?php break;
									case "sideairbags": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k;} $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='sideairbags' id='sideairbags' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->sideairbags== 1) ? "checked='checked'" : ""; } ?> /><label for="sideairbags"><?php  echo JText::_('SIDE_AIR_BAG'); ?></label></td>
									<?php break;
									case "signalmirrors": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k; } $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='signalmirrors' id='signalmirrors' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->signalmirrors== 1) ? "checked='checked'" : ""; } ?> /><label for="signalmirrors"><?php  echo JText::_('SIGNAL_MIRRORS'); ?></label></td>
									<?php break;
									case "tractioncontrol": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0; $k=1-$k;} $colcount++; ?>
												<td width="<?php echo $colwidth; ?>"><input type='checkbox' name='tractioncontrol' id='tractioncontrol' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->tractioncontrol== 1) ? "checked='checked'" : ""; } ?> /><label for="tractioncontrol"><?php  echo JText::_('TRACTION_CONTROL'); ?></label></td>
									<?php break;
                                                                        case "section_userfields":
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
                                                                <tr class="<?php echo $td[$k];$k=0;$k=1-$k;?>">
                                                                           <td colspan="<?php echo $colperrow; ?>" valign="top" align="left"><b><?php echo  $field->fieldtitle?></b></td>
                                                                </tr>
                                                                <?php break;
                                                                  case "userfield1":  ?>
                                                                        <tr>
                                                                                        <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield1' id='userfield1' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield1 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield1"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield2": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield2' id='userfield2' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield2 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield2"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield3": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k;} $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield3' id='userfield3' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield3 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield3"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield4": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield4' id='userfield4' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield4 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield4"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield5": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield5' id='userfield5' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield5 == 1) ? "checked='checked'" : ""; } ?> /><label for="crewcab"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield6": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield6' id='userfield6' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield6 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield6"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield7": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield7' id='userfield7' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield7 == 1) ? "checked='checked'" : ""; } ?> /><label for="userfield7"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield8": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k;} $colcount++;  ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield8' id='userfield8' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield8== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield9"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield9": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield9' id='userfield9' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield9== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield9"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield10": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield10' id='userfield10' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield10== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield10"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield11": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield11' id='userfield11' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield11== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield11"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield12": if($colcount == $colperrow){ echo '</tr><tr>'; $colcount = 0; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield12' id='userfield12' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield12== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield12"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield13": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k;} $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield13' id='userfield13' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield13== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield13"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield14": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield14' id='userfield14' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield14== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield14"><?php echo  $field->fieldtitle?></label></td>
                                                                <?php break;
                                                                case "userfield15": if($colcount == $colperrow){ echo '</tr><tr class='.$td[$k].'>'; $colcount = 0;$k=1-$k; } $colcount++; ?>
                                                                                         <td width="<?php echo $colwidth; ?>"><input type='checkbox' name='userfield15' id='userfield15' value='1' <?php if(isset($this->vehicleoptions)) { echo ($this->vehicleoptions->userfield15== 1) ? "checked='checked'" : ""; } ?> /><label for="userfield9"><?php echo  $field->fieldtitle?></label></td>
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
            <?php
				if(isset($this->vehicle)) {
					if (($this->vehicle->created=='0000-00-00 00:00:00') || ($this->vehicle->created==''))
						$curdate = date('Y-m-d H:i:s');
					else
						$curdate = $this->vehicle->created;
				}else{ $curdate = date('Y-m-d H:i:s');}

				if(isset($this->vehicle)) {
					if ((!$this->vehicle->solddated=='0000-00-00 00:00:00') || (!$this->vehicle->solddated==''))
						$sdate = $this->vehicle->solddated;
				}
				
				if(isset($this->vehicle)){
					if($this->vehicle->uid) $uid = $this->vehicle->uid;
					else $uid = $this->vehicle->uid;
					
				}else{$uid = $this->uid;}



                ?>
				<input type="hidden" name="solddated" value="<?php echo $sdate; ?>" />
				<input type="hidden" name="created" value="<?php echo $curdate; ?>" />
				<input type="hidden" name="id" value="<?php if(isset($this->vehicle)) echo $this->vehicle->id; ?>"/>
				<input type="hidden" name="uid" value="<?php echo $uid; ?>"/>
				<input type="hidden" name="vehicleoptionid" value="<?php if(isset($this->vehicleoptions)) echo $this->vehicleoptions->id; ?>"/>
				<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
				<input type="hidden" name="task" value="savevehicle" />
				<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
				<input type="hidden" name="check" name="check" value="" />
                                <input type="hidden" name="default_longitude" id="default_longitude" value="<?php echo $this->config['default_longitude']; ?>" />
                                <input type="hidden" name="default_latitude" id="default_latitude" value="<?php  echo $this->config['default_latitude']; ?>" />

					<tr>
						<td colspan="2" valign="top" align="center"><input class="button" type="submit" onclick="return validate_form(document.adminForm)" name="submit_app"  value="<?php echo JText::_('SAVE_VEHICLE_AND_UPLOAD_IMAGE'); ?>" /></td>
                                         </tr>
				    
</form>
                    
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>
</table>
<script type="text/javascript" 
   src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

 
<script type="text/javascript">
	//window.onload = loadMap(1,'','','','');
  function loadMap(callfrom,country,state,county,city) {
		var longitude = document.getElementById('longitude').value;
		var default_latitude = document.getElementById('default_latitude').value;
		var default_longitude = document.getElementById('default_longitude').value;
		var latitude = document.getElementById('latitude').value;
		if(longitude != '' && latitude != ''){ var latlng = new google.maps.LatLng(latitude, longitude); zoom = 12;}
		else {var latlng = new google.maps.LatLng(default_latitude, default_longitude); zoom=4;}
		var myOptions = {
		  zoom: zoom,
		  center: latlng,
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};
		var map = new google.maps.Map(document.getElementById("map_container"),myOptions);
		var lastmarker = new google.maps.Marker({
			postiion:latlng,
			map:map
		});
		if(callfrom == 1){
			var marker = new google.maps.Marker({
			  position: latlng, 
			  map: map
			});
			document.getElementById('longitude').value = marker.position.lng();
			document.getElementById('latitude').value = marker.position.lat();
			marker.setMap(map);
			lastmarker = marker;
		}
	google.maps.event.addListener(map,"click", function(e){
		var latLng = new google.maps.LatLng(e.latLng.lat(),e.latLng.lng());
		geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'latLng': latLng}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
			lastmarker.setMap(null);
			var marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map
			});
			marker.setMap(map);
			lastmarker = marker;
			document.getElementById('latitude').value = marker.position.lat();
			document.getElementById('longitude').value = marker.position.lng();
			
		  } else {
			alert("Geocode was not successful for the following reason: " + status);
		  }
		});
	}); 


	if(callfrom == 3){
            field = document.getElementById('loccountry').value;
		var value='';var zoom=4;
		if(country !== ''){
			var field = document.getElementById('loccountry');
			value = field.options[field.selectedIndex].text;
                        
		}
		if(state != ''){
			var field = document.getElementById('locstate');
			if(field.type == "text"){ value = field.value+", "+value;zoom+=2;}
			else{ value = field.options[field.selectedIndex].text+", "+value;zoom+=2;}
		}
		if(county != ''){
			var field = document.getElementById('loccounty');
			if(field.type == "text"){ value = field.value+", "+value;zoom+=2;}
			else{ value = field.options[field.selectedIndex].text+", "+value;zoom+=2;}
		}
		if(city != ''){
			var field = document.getElementById('loccity');
			if(field.type == "text"){ value = field.value+", "+value;zoom+=2;}
			else{ value = field.options[field.selectedIndex].text+", "+value;zoom+=2;}
		}
		if(value != ''){
			geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': value}, function(results, status) {
			  if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				document.getElementById('latitude').value = results[0].geometry.location.lat();
				document.getElementById('longitude').value = results[0].geometry.location.lng();
				map.setZoom(12);
				lastmarker.setMap(null);
				var marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map
				});
				marker.setMap(map);
				lastmarker = marker;
			  } else {
				alert("Geocode was not successful for the following reason: " + status);
			  }
			});
		}
	}
	if(callfrom == 2){
		var latLng = new google.maps.LatLng(latitude,longitude);
		geocoder = new google.maps.Geocoder();
		geocoder.geocode( { 'latLng': latLng}, function(results, status) {
		  if (status == google.maps.GeocoderStatus.OK) {
    			lastmarker.setMap(null);
			var marker = new google.maps.Marker({
				position: results[0].geometry.location, 
				map: map
			});
			map.setZoom(12);
			marker.setMap(map);
			lastmarker = marker;
			var address = results[1].formatted_address;
			var xhr;
			try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
			catch (e){
				try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
				catch (e2) {
				  try {  xhr = new XMLHttpRequest();     }
				  catch (e3) {  xhr = false;   }
				}
			 }
			xhr.onreadystatechange = function(){
					if(xhr.readyState == 4 && xhr.status == 200){
						var obj = eval("("+xhr.responseText+")");
                                                
						document.getElementById('loccountry').value = obj.loccountrycode;
						document.getElementById('vehicleform_locstate').innerHTML = obj.locstates;
						document.getElementById('vehicleform_loccounty').innerHTML = obj.loccounties;
						document.getElementById('vehicleform_loccity').innerHTML = obj.loccity;
					}
				}

			xhr.open("GET","index.php?option=com_jsautoz&task=getlocmapaddressdata&val="+address,true);
			xhr.send(null);
		}
		});
	}
}
</script>
                    
                    
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

	xhr.open("GET","index.php?option=com_jsautoz&task=listmodels&val="+val+"&req="+req,true);
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
       	xhr.open("GET","index.php?option=com_jsautoz&task=listregaddressdata&data="+src+"&val="+val,true);
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
				countyhtml = "<input class='inputbox' type='text' name='loccounty' id='loccounty' size='40' maxlength='100'  />";
				cityhtml = "<input class='inputbox' type='text' name='loccity' id='loccity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_loccounty').innerHTML=countyhtml; //retuen value
				document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
			}else if(src=='county'){
				cityhtml = "<input class='inputbox' type='text' name='loccity' id='loccity' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
			}else if(src=='zip'){
				ziphtml = "<input class='inputbox' type='text' name='loczip' size='40' maxlength='100'  />";
				document.getElementById('vehicleform_loczip').innerHTML=ziphtml; //retuen value
			}
      }
    }
        
	xhr.open("GET","index.php?option=com_jsautoz&task=listlocaddressdata&data="+src+"&val="+val,true);
	xhr.send(null);
}

loadMap(1,'','','','');
</script>


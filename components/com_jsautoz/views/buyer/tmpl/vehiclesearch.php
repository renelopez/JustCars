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
$document = & JFactory::getDocument();
// $document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);
$document->addStyleSheet('components/com_jsautoz/themes/' . $this->config['theme']);
?>
<style type="text/css">
    div#map_container{
        z-index:1000;
        position:relative;
        background:#000;
        width:70%;
        height:100%;
        float: left;
        /*	opacity:0.55;
                -moz-opacity:0.45;
                filter:alpha(opacity=45);*/
    }
    div#map{
        visibility:hidden;
        position:absolute;
        width:100%;
        height:32%;
        top:43%;
    }
    div#closetag a{

        position:relative;
        color:red;
        float:left;
        width:37%;
        text-align: left;

    }
</style>
<div>
<?php if ($this->config['offline'] == '1') { ?>
        <div  class="contentpane">
            <div class="<?php echo $this->theme['title']; ?>" > <?php echo $this->config['title']; ?></div>
            <div class="jsautozmsg">
    <?php echo $this->config['offline_text']; ?>
            </div>
        </div>
<?php } else { ?>

        <div id="jsautoz_toppanel">
			<div id="jsautoz_topsection">
				<?php if ($this->config['showtitle'] == 1) { ?>
					<div id="autoz_sitetitle">
						<?php echo $this->config['title']; ?>
					</div>
				<?php } ?>
				<?php if ($this->config['navigation'] == 1) { ?>
					<div class="autoz_topcurloc">
						<?php if (isset($this->vehicle) && ($this->vehicle->id == '')) { ?>
								<?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('VEHICLE_INFORMATION'); ?>
						<?php } else { ?>
								<?php echo JText::_('CUR_LOC'); ?> :<a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANEL'); ?></a> > <?php echo JText::_('VEHICLE_SEARCH'); ?>
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
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLE_SEAERCH'); ?></span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>


        <form action="<?php echo JRoute::_('index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch_results&Itemid=' . $this->Itemid); ?>" method="post" name="adminForm" id="adminForm">
            <table cellpadding="8" cellspacing="0" border="0" width="100%">                           <!--Main Table Start-->
                <?php
                foreach ($this->fieldorderings as $field) {

                    switch ($field->field) {
                        case "title":
                            ?>
                            <?php if ($this->search['searchtitle'] == 1) { ?> 
                                <tr >
                                    <td width="25%" valign="top" align="right"><b><label id="titleidmsg" for="title"><?php echo JText::_('TITLE'); ?></label> </b></td>
                                    <td><input type="text" id="title" name="title"></td>
                                </tr>
                            <?php } ?> 
                            <?php break;
                        case "vehicletypeid":
                            ?>
                <?php if ($this->search['searchvehicletype'] == 1) { ?> 
                                <tr >
                                    <td width="25%" valign="top" align="right"><b><label id="vechiletypeidmsg" for="vechiletypeid"><?php echo JText::_('VEHICLES'); ?></label> </b></td>
                                    <td><?php echo $this->lists['vehicletypes']; ?></td>
                                </tr>
                            <?php } ?> 
                            <?php break;
                        case "makeid":
                            ?>
                <?php if ($this->search['searchmake'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="makeidmsg" for="makeid"><?php echo JText::_('MAKE'); ?></label></b></td>
                                    <td><?php echo $this->lists['makes']; ?></td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "modelid":
                            ?>
                <?php if ($this->search['searchmodel'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="modelidmsg" for="modelid"><?php echo JText::_('MODEL'); ?></label></b></td>
                                    <td id="vs_models"><?php echo $this->lists['models']; ?></td>
                                </tr>
                            <?php } ?>  
                <?php break;
            case "regcountry":
                ?>
                            <?php if ($this->search['searchregcountry'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="regcountrymsg" for="regcountry"><b><?php echo JText::_('REG_COUNTRY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_regcountry"><?php echo $this->lists['regcountry'] ?></td>
                                </tr>
                <?php } ?>  
                <?php break;
            case "regstate":
                ?>
                <?php if ($this->search['searchregstate'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="regstatemsg" for="regstate"><b><?php echo JText::_('REG_STATE'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_regstate">
                                <?php echo $this->lists['regstate']; ?>
                                    </td>
                                </tr>
                <?php } ?>  
                                    <?php break;
                                case "regcounty":
                                    ?>
                            <?php if ($this->search['searchregcounty'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="regcountymsg" for="regcounty"><b><?php echo JText::_('REG_COUNTY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_regcounty">
                                <?php echo $this->lists['regcounty']; ?>
                                    </td>
                                </tr>
                                    <?php } ?>  
                                    <?php break;
                                case "regcity":
                                    ?>
                            <?php if ($this->search['searchregcity'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="regcitymsg" for="regcity"><b><?php echo JText::_('REG_CITY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_regcity">
                    <?php echo $this->lists['regcity']; ?>
                                    </td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "loccountry":
                            ?>
                            <?php if ($this->search['searchloccountry'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="loccountrymsg" for="loccountry"><b><?php echo JText::_('LOC_COUNTRY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_loccountry"><?php echo $this->lists['loccountry']; ?></td>
                                </tr>
                <?php } ?>  
                            <?php break;
                        case "locstate":
                            ?>
                            <?php if ($this->search['searchlocstate'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="locstatemsg" for="locstate"><b><?php echo JText::_('LOC_STATE'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_locstate">
                                        <?php echo $this->lists['locstate']; ?>
                                    </td>
                                </tr>
                <?php } ?>  
                            <?php break;
                        case "loccounty":
                            ?>
                            <?php if ($this->search['searchloccounty'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="loccountymsg" for="loccounty"><b><?php echo JText::_('LOC_COUNTY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_loccounty">
                                        <?php echo $this->lists['loccounty']; ?>
                                    </td>

                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "loccity":
                            ?>
                            <?php if ($this->search['searchloccity'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="loccitymsg" for="loccity"><b><?php echo JText::_('LOC_CITY'); ?></b></label>&nbsp;</td>
                                    <td id="vehicleform_loccity">
                                        <?php echo $this->lists['loccity']; ?>
                                    </td>

                                </tr>
                                    <?php } ?>  
                                    <?php break;
                                case "loczip":
                                    ?>
                            <?php if ($this->search['searchloczip'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="loczipmsg" for="loczip"><b><?php echo JText::_('LOCATION_ZIP'); ?></b></label></td>
                                    <td id="vehicleform_loczip">
                    <?php
                    if ((isset($this->lists['zipcode'])) && ($this->lists['zipcode'] != '')) {
                        echo $this->lists['loczip'];
                        ?>
                                            <input  type="text" id="loczip" name="loczip" value=""/>
                                <?php } else { ?>
                                            <input  type="text" id="loczip" name="loczip" value=""/>
                                <?php } ?>
                                    </td>
                                </tr>
                <?php } ?>  
                <?php if ($this->search['searchradius'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><label id="radiussearchmsg" for="radiussearch"><b><?php echo JText::_('RADIUS_SEARCH_ON_ZIP'); ?></b></label>&nbsp;</td>
                                    <td >
                                <?php echo $this->lists['radiussearch']; ?>
                                    </td>

                                </tr>
                <?php } ?>  
                <?php break;
            case "modelyearid":
                ?>
                            <?php if ($this->search['searchmodelyear'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="modelyearidmsg" for="modelyearid"><?php echo JText::_('MODELYEAR'); ?></label></b></td>
                                    <td><?php echo $this->lists['modelyears']; ?></td>
                                </tr>
                <?php } ?>  
                            <?php break;
                        case "fueltypeid":
                            ?>
                            <?php if ($this->search['searchfueltype'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="fueltypeidmsg" for="fueltypeid"><?php echo JText::_('FUELTYPES'); ?></label></b></td>
                                    <td><?php echo $this->lists['fueltypes']; ?></td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "enginecapacity":
                            ?>
                            <?php if ($this->search['searchenginecapacity'] == 1) { ?> 
                                <tr>
                                    <td valign="top" align="right"><b><label id="enginecapacitymsg" for="enginecapacity"><?php echo JText::_('ENGINECAPACITY'); ?></label></b></td>
                                    <td><input  class="inputbox" type="text" id="enginecapacity" name="enginecapacity" value=""/></td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "cylinderid":
                            ?>
                <?php if ($this->search['searchcylinder'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="cylinderidmsg" for="cylinderid"><?php echo JText::_('CYLINDER'); ?></label></b></td>
                                    <td><?php echo $this->lists['cylinders']; ?></td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "conditionid":
                            ?>
                <?php if ($this->search['searchcondition'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="conditionidmsg" for="conditionid"><?php echo JText::_('CONDITION'); ?></label></b></td>
                                    <td><?php echo $this->lists['conditions']; ?></td>
                                </tr>
                            <?php } ?>  
                            <?php break;
                        case "price":
                            ?>
                <?php if ($this->search['searchprice'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="pricemsg" for="price"><?php echo JText::_('PRICE'); ?>&nbsp;</label></b></td>
                                    <td ><label id="pricemsg" for="pricefrom"><?php echo JText::_('FROM'); ?><input class="inputbox" type="text" id="pricefrom" name="pricefrom" value=""/></label>&nbsp;&nbsp;&nbsp;
                                        <label id="pricemsg" for="priceto"><?php echo JText::_('TO'); ?>-<input class="inputbox" type="text" id="priceto" name="priceto" value=""/></label></td>
                                </tr>
                            <?php } ?>  
                <?php break;
            case "exteriorcolor":
                ?>
                            <?php if ($this->search['searchexteriorcolor'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="exteriorcolormsg" for="exteriorcolor"><?php echo JText::_('EXTERIORCOLOR'); ?></label></b></td>
                                    <td><input  class="inputbox" type="text" id="exteriorcolor" name="exteriorcolor" value=""/></td>
                                </tr>
                <?php } ?>  
                <?php break;
            case "mileages":
                ?>
                                                <?php if ($this->search['searchmileages'] == 1) { ?> 
                                <tr>
                                    <td  valign="top" align="right"><b><label id="mileagesmsg" for="mileages"><?php echo JText::_('MILEAGE'); ?></label></b></td>
                                    <td><input class="inputbox"  size="15" type="text" id="mileages" name="mileages" value=""/></td>
                                </tr>    
                <?php } ?>  
                <?php break;
            case "registrationnumber":
                ?>
                <?php if ($this->search['searchregistrationnumber'] == 1) { ?> 
                                <tr >
                                    <td valign="top" align="right"><b><label id="registrationnumbermsg" for="registrationnumber"><?php echo JText::_('REGISTRATION_NUMBER'); ?></label></b></td>
                                    <td><input  class="inputbox" type="text" id="registrationnumber" name="registrationnumber" value=""/></td>
                                </tr>
                <?php } ?>  
                <?php break;
            case "map":
                ?>
                <?php if ($this->search['searchmap'] == 1) { ?> 
                                <tr >
                                    <td align="right"><b><label><?php echo JText::_('MAP_COORDINATES'); ?></label></b>
                                        <div id="map">
                                            <div id="closetag">
                                                <a anchor="anchor" href="Javascript: hidediv();">
                    <?php echo JText::_('CLOSE_MAP'); ?></a>
                                            </div>
                                            <div id="map_container"></div>

                                        </div>
                                    </td>
                                    <td>
                                        <a anchor="anchor" href="Javascript: showdiv();loadMap();"><?php echo JText::_('SHOW_MAP'); ?></a>
                                        <br/><input type="text" id="longitude" name="longitude" value=""/><?php echo JText::_('LONGITUDE'); ?>
                                        <br/><input type="text" id="latitude" name="latitude" value=""/><?php echo JText::_('LATITUDE'); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <b><label><?php echo JText::_('COORDINATES_RADIUS'); ?></label></b>
                                    </td>
                                    <td>
                                        <input type="text" id="radius" name="radius" value=""/>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right">
                                        <b><label><?php echo JText::_('RADIUS_TYPE'); ?></label></b>
                                    </td>
                                    <td>
                                        <select name="radius_length_type" id="radius_length_type">
                                            <option value="m" <?php if ($this->config['default_radius'] == "m") { ?> selected="selected"<?php } ?> ><?php echo JText::_('METERS'); ?></option>
                                            <option value="km" <?php if ($this->config['default_radius'] == "km") { ?> selected="selected"<?php } ?> ><?php echo JText::_('KILOMETERS'); ?></option>
                                            <option value="mile"<?php if ($this->config['default_radius'] == "mile") { ?> selected="selected"<?php } ?> ><?php echo JText::_('MILES'); ?></option>
                                            <option value="nacmiles"<?php if ($this->config['default_radius'] == "nacmiles") { ?> selected="selected"<?php } ?> ><?php echo JText::_('NAUTICAL_MILES'); ?></option>
                                        </select>
                                    </td>
                                </tr>
                    <?php } ?>  

                <?php break; ?>

        <?php }
    }
    ?>
                <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
                <input type="hidden" name="isvehiclesearch" value="1" />
                <input type="hidden" name="Itemid" id="Itemid" value="<?php echo $this->Itemid; ?>" />
                <input type="hidden" id="default_longitude" name="default_longitude" value="<?php echo $this->config['default_longitude']; ?>"/>
                <input type="hidden" id="default_latitude" name="default_latitude" value="<?php echo $this->config['default_latitude']; ?>"/>
    <!--					<tr>
                                <td colspan="2" valign="top" align="center">  <input type="submit"  class="button" value="Search Vehicle"/></td>
                    </tr>--> 
                <tr >
                    <td colspan="2" align="center">
                        <input type="submit" rel="button" name="submit_app" onclick="return formSubmit();" value="<?php echo JText::_('SEARCH_VEHICLE'); ?>" />
                    </td>
                </tr>

            </table> <!--Main Table Close-->
        </form>
    <?php
}//ol
?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


    <script type="text/javascript" language=Javascript>
        function formSubmit() {
    
            search_long=document.getElementById("longitude").value;
            search_lati=document.getElementById("latitude").value;
            search_radius=document.getElementById("radius").value;
            if(search_long!=='' && search_lati!=='' ){
        
                if(search_radius=='') {
                    alert('<?php echo JText::_('PLEASE_ENTER_COORDINATES_RADIUS') ?>');
                    return false;
                }
        
            }else{
                return true;
                //var ItemId =document.getElementById('Itemid').value;
                //document.adminForm.action="index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch_results&Itemid"+ItemId;
                //document.getElementById("adminFormvehiclefilter").submit();
    
            }

    
        }    

        function getvfsmodels(val){
            var pagesrc = 'vs_models';
            //	alert ('call');
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

            xhr.open("GET","index.php?option=com_jsautoz&task=listmodels&val="+val/*+"&req="+req*/,true);
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
                        countyhtml = "<input class='inputbox' type='text' name='loccounty' size='40' maxlength='100'  />";
                        cityhtml = "<input class='inputbox' type='text' name='loccity' size='40' maxlength='100'  />";
                        document.getElementById('vehicleform_loccounty').innerHTML=countyhtml; //retuen value
                        document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
                    }else if(src=='county'){
                        cityhtml = "<input class='inputbox' type='text' name='loccity' size='40' maxlength='100'  />";
                        document.getElementById('vehicleform_loccity').innerHTML=cityhtml; //retuen value
                    }else if(src=='zip'){
                        cityhtml = "<input class='inputbox' type='text' name='loczip' size='40' maxlength='100'  />";
                        document.getElementById('vehicleform_loczip').innerHTML=ziphtml; //retuen value
                    }
                }
            }
        
            xhr.open("GET","index.php?option=com_jsautoz&task=listlocaddressdata&data="+src+"&val="+val,true);
            xhr.send(null);
        }
    </script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
        function loadMap() {
            var default_latitude = document.getElementById('default_latitude').value;
            var default_longitude = document.getElementById('default_longitude').value;
		
            var latitude = document.getElementById('latitude').value;
            var longitude = document.getElementById('longitude').value;
		
            if(latitude != '' && longitude != ''){
                default_latitude = latitude;
                default_longitude = longitude;
            }
            var latlng = new google.maps.LatLng(default_latitude, default_longitude); zoom=10;
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
            var marker = new google.maps.Marker({
                position: latlng, 
                map: map
            });
            marker.setMap(map);
            lastmarker = marker;
            document.getElementById('latitude').value = marker.position.lat();
            document.getElementById('longitude').value = marker.position.lng();

            google.maps.event.addListener(map,"click", function(e){
                var latLng = new google.maps.LatLng(e.latLng.lat(),e.latLng.lng());
                geocoder = new google.maps.Geocoder();
                geocoder.geocode( { 'latLng': latLng}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if(lastmarker != '') lastmarker.setMap(null);
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
            //document.getElementById('map_container').innerHTML += "<a href='Javascript hidediv();'><?php echo JText::_('JS_CLOSE_MAP'); ?></a>";
        }
        function showdiv(){
            document.getElementById('map').style.visibility = 'visible';
        }
        function hidediv(){
            document.getElementById('map').style.visibility = 'hidden';
        }
    </script>



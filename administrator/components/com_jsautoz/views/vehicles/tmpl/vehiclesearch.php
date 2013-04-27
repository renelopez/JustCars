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
JHTML :: _('behavior.calendar');
//JHTMLBehavior::formvalidation();
JHTML::_('behavior.formvalidation');
$document = &JFactory::getDocument();
JRequest :: setVar('layout', 'vehiclesearch');
$_SESSION['cur_layout']='vehiclesearch';
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
<style type="text/css">
div#map_container{
	z-index:1000;
	position:relative;
	background:#000;
	width:50%;
	height:278px;
        float: left;
        top: 607px;
        left: 120px;
        
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
div#closetag a {
    
	position:absolute;
	color:red;
	float:left;
	width:37%;
        top:595px;
        left: 123px;
        text-align: left;
        
}
</style>

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

<form action="<?php echo JRoute::_('index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehiclesearch_results'); ?>"  method="post" name="adminForm" id="adminForm"   >
    <table cellpadding="8" cellspacing="0" border="0" width="100%">                           <!--Main Table Start-->
        <?php
        $td=array('row0','row1');$k=0;
        foreach($this->fieldorderings as $field){
                switch ($field->field) {
                        case "title": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td width="25%" valign="top" align="right"><label id="titlemsg" for="title"><?php echo JText::_('TITLE'); ?></label></td>
                                   <td><input  class="inputbox" type="text" id="title" name="title" value=""/></td>
                           </tr>
                        <?php break;
                        case "vehicletypeid": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td width="25%" valign="top" align="right"><label id="vechiletypeidmsg" for="vechiletypeid"><?php echo JText::_('VEHICLE_TYPE'); ?></label></td>
                                   <td><?php echo $this->lists['vehicletypes']; ?></td>
                           </tr>
                        <?php break;
                        case "makeid": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td valign="top" align="right"><label id="makeidmsg" for="makeid"><?php echo JText::_('MAKES'); ?></label></td>
                                   <td><?php echo $this->lists['makes']; ?></td>
                           </tr>
                        <?php break;
                        case "modelid": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td valign="top" align="right"><label id="modelidmsg" for="modelid"><?php echo JText::_('MODELS'); ?></label></td>
                                   <td id="vs_models"><?php echo $this->lists['models']; ?></td>
                           </tr>
                        <?php break;
                        case "regcountry": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="regcountrymsg" for="regcountry"><?php echo JText::_('REG_COUNTRY'); ?></label>&nbsp;</td>
                                <td id="vehicleform_regcountry"><?php echo $this->lists['regcountry']?></td>
                            </tr>
                        <?php break;
                        case "regstate": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="regstatemsg" for="regstate"><?php echo JText::_('REG_STATE'); ?></label>&nbsp;</td>
                                <td id="vehicleform_regstate">
                                        <?php echo $this->lists['regstate'];?>
                                </td>
                            </tr>
                        <?php break;
                        case "regcounty": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="regcountymsg" for="regcounty"><?php echo JText::_('REG_COUNTY'); ?></label>&nbsp;</td>
                                <td id="vehicleform_regcounty">
                                        <?php echo $this->lists['regcounty'];  ?>
                                </td>
                            </tr>
                        <?php break;
                        case "regcity": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="regcitymsg" for="regcity"><?php echo JText::_('REG_CITY'); ?></label>&nbsp;</td>
                                <td id="vehicleform_regcity">
                                        <?php echo $this->lists['regcity']; ?>
                                </td>
                            </tr>
                        <?php break;
                        case "loccountry": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td valign="top" align="right"><label id="loccountrymsg" for="loccountry"><?php echo JText::_('LOC_COUNTRY'); ?></label>&nbsp;</td>
                                   <td id="vehicleform_loccountry"><?php echo $this->lists['loccountry']; ?></td>
                            </tr>
                        <?php break;
                        case "locstate": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="locstatemsg" for="locstate"><?php echo JText::_('LOC_STATE'); ?></label>&nbsp;</td>
                                <td id="vehicleform_locstate">
                                        <?php echo $this->lists['locstate'];  ?>
                                </td>
                            </tr>
                        <?php break;
                        case "loccounty": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="loccountymsg" for="loccounty"><?php echo JText::_('LOC_COUNTY'); ?></label>&nbsp;</td>
                                <td id="vehicleform_loccounty">
                                        <?php echo $this->lists['loccounty']; ?>
                                </td>

                            </tr>
                        <?php break;
                        case "loccity": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="loccitymsg" for="loccity"><?php echo JText::_('LOC_CITY'); ?></label>&nbsp;</td>
                                <td id="vehicleform_loccity">
                                        <?php echo $this->lists['loccity']; ?>
                                </td>

                            </tr>
                        <?php break;
                        case "loczip": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                <td valign="top" align="right"><label id="loczipmsg" for="loczip"><?php echo JText::_('LOC_ZIP'); ?></label></td>
                                <td id="vehicleform_loczip">
                                    <?php
                                    if ((isset($this->lists['zipcode'])) && ($this->lists['zipcode']!='')){
                                        echo $this->lists['loczip'];?>
                                        <input  type="text" id="loczip" name="loczip" value=""/>
                                    <?php } else{ ?>
                                        <input  type="text" id="loczip" name="loczip" value=""/>
                                    <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" align="right"><label id="radiussearchmsg" for="radiussearch"><?php echo JText::_('RADIUS_SEARCH_ON_ZIP'); ?></label>&nbsp;</td>
                                <td >
                                        <?php echo $this->lists['radiussearch']; ?>
                                </td>

                            </tr>
                        <?php break;
                        case "modelyearid": ?>
                           <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                   <td valign="top" align="right"><label id="modelyearidmsg" for="modelyearid"><?php echo JText::_('MODELYEAR'); ?></label></td>
                                   <td><?php echo $this->lists['modelyears']; ?></td>
                           </tr>
                        <?php break;
                        case "fueltypeid": ?>
                            <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                    <td valign="top" align="right"><label id="fueltypeidmsg" for="fueltypeid"><?php echo JText::_('FUELTYPES'); ?></label></td>
                                    <td><?php echo $this->lists['fueltypes']; ?></td>
                            </tr>
                         <?php break;
                        case "cylinderid": ?>
                            <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                    <td valign="top" align="right"><label id="cylinderidmsg" for="cylinderid"><?php echo JText::_('CYLINDERS'); ?></label></td>
                                    <td><?php echo $this->lists['cylinders']; ?></td>
                            </tr>
                         <?php break;
                        case "price": ?>
                            <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                    <td valign="top" align="right"><label id="pricemsg" for="price"><?php echo JText::_('PRICE'); ?></label></td>
                                    <td><label id="pricemsg" for="pricefrom"><?php echo JText::_('FROM'); ?><input class="inputbox" type="text" id="pricefrom" name="pricefrom" value=""/></label>&nbsp;&nbsp;&nbsp;
                                    <label id="pricemsg" for="priceto"><?php echo JText::_('TO-'); ?><input class="inputbox" type="text" id="priceto" name="priceto" value=""/></label></td>
                            </tr>
                        <?php break;
                        case "exteriorcolor": ?>
                            <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                    <td valign="top" align="right"><label id="exteriorcolormsg" for="exteriorcolor"><?php echo JText::_('EXTERIORCOLOR'); ?></label></td>
                                    <td><input  class="inputbox" type="text" id="exteriorcolor" name="exteriorcolor" value=""/></td>
                            </tr>
                        <?php break;
                        case "registrationnumber": ?>
                            <tr class="<?php echo $td[$k];$k=1-$k; ?>">
                                    <td valign="top" align="right"><label id="registrationnumbermsg" for="registrationnumber"><?php echo JText::_('REGISTRATION_NUMBER'); ?></label></td>
                                    <td><input  class="inputbox" type="text" id="registrationnumber" name="registrationnumber" value=""/></td>
                            </tr>
                        <?php break;

                        case "map": ?>
                                <tr class="<?php echo $td[$k]; ?>" >
                                        <td align="right"><b><label><?php echo JText::_('MAP_COORDINATES'); ?></label></b>
                                        <div id="map">
                                            <div id="closetag">
                                                <a href="Javascript: hidediv();">
                                                <?php echo JText::_('CLOSE_MAP');?></a>
                                            </div>
                                            <div id="map_container"></div>
                                    
                                        </div>
                                        </td>
                                        <td>
                                            <a href="Javascript: showdiv();loadMap();"><?php echo JText::_('SHOW_MAP');?></a>
                                            <br/><input type="text" id="longitude" name="longitude" value=""/><?php echo JText::_('LONGITUDE');?>
                                            <br/><input type="text" id="latitude" name="latitude" value=""/><?php echo JText::_('LATITUDE');?>
                                        </td>
                                </tr>
                                <tr class="<?php echo $td[$k];?>">
                                            <td align="right">
                                                    <b><label><?php echo JText::_('COORDINATES_RADIUS'); ?></label></b>
                                            </td>
                                            <td>
                                                    <input type="text" id="radius" name="radius" value=""/>
                                            </td>
                                </tr>
                                <tr class="<?php echo $td[$k]; $k=1-$k;?>">
                                            <td align="right">
                                                    <b><label><?php echo JText::_('RADIUS_TYPE');?></label></b>
                                            </td>
                                            <td>
                                                    <select name="radius_length_type" id="radius_length_type">
							<option value="m" <?php if($this->config['default_radius']=="m"){?> selected="selected"<?php } ?> ><?php echo JText::_('METERS');?></option>
							<option value="km" <?php if($this->config['default_radius']=="km"){?> selected="selected"<?php } ?> ><?php echo JText::_('KILOMETERS');?></option>
							<option value="mile"<?php if($this->config['default_radius']=="mile"){?> selected="selected"<?php } ?> ><?php echo JText::_('MILES');?></option>
							<option value="nacmiles"<?php if($this->config['default_radius']=="nacmiles"){?> selected="selected"<?php } ?> ><?php echo JText::_('NAUTICAL_MILES');?></option>
                                                    </select>
                                            </td>
                                </tr>
                                
                        <?php break; 
                    
                    
                    
                    }
        }?>
				<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
				<input type="hidden" name="isvehiclesearch" value="1" />
				<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
                                <input type="hidden" id="default_longitude" name="default_longitude" value="<?php echo $this->config['default_longitude'];?>"/>
                                <input type="hidden" id="default_latitude" name="default_latitude" value="<?php echo $this->config['default_latitude'];?>"/>
<!--					<tr>
				                <td colspan="2" valign="top" align="center">  <input type="submit"  class="button" value="Search Vehicle"/></td>
				    </tr>--> 
					<tr>
						<td colspan="2" align="center">
						<input type="submit" class="button" onclick="return formSubmit();" value="<?php echo JText::_('SEARCH_VEHICLE'); ?>" />
						</td>
					</tr>
					
	</table>
</form>
                </td>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

    
<script language=Javascript>
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
        
        document.adminForm.submit();
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
//document.getElementById('map_container').innerHTML += "<a href='Javascript hidediv();'><?php echo JText::_('JS_CLOSE_MAP');?></a>";
}
function showdiv(){
	document.getElementById('map').style.visibility = 'visible';
}
function hidediv(){
	document.getElementById('map').style.visibility = 'hidden';
}
</script>

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
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/themes/'.$this->config['theme']);
$style=''; 
 ?>
<style type="text/css">
div#map_container{
	z-index:1000;
	position:relative;
	background:#000;
	width:99%;
	height:250px;
/*        border: 1px solid #000;
	opacity:0.55;
	-moz-opacity:0.45;
	filter:alpha(opacity=45);*/
}
div#map{
	visibility:hidden;
	position:absolute;
	width:100%;
	height:35%;
	top:0%;
	left:0px;
}
div#closetag a{
	color:red;
	float:left;
        margin-left: 20px;
}
</style>
         <?php 
            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
            $isodd =1;
	        ?>
        <form action=""  name="adminFormvehiclefilter" id="adminFormvehiclefilter" method="post">
            <div id="map">
                <div id="closetag">
                    <a anchor="anchor" href="Javascript: hidediv();"><?php echo JText::_('CLOSE_MAP');?></a>
                </div>
                <div id="map_container"></div>
            </div>
			<div id="filter_outer">
				<div id="filter_inner">
					<?php if($this->filter['filtermake']==1) { ?>
						<div id="jsautoz_object">
							<div class="object_item_title"><?php echo $this->vehiclefilter['makes']; ?></div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filtermodel']==1) { ?>
						<div id="jsautoz_object">
							<div id="filter_models" class="object_item_title"><?php echo $this->vehiclefilter['models']; ?></div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filtercondition']==1) { ?>
						<div id="jsautoz_object">
							<div class="object_item_title"><?php echo $this->vehiclefilter['condition']; ?></div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filtermodelyear']==1) { ?>
						<div id="jsautoz_object">
							<div class="object_item_title"><?php echo $this->vehiclefilter['modelyears']; ?></div>
						</div>
					<?php } ?>  
				</div>
				<div id="filter_inner">
					<?php if($this->filter['filtermap']==1) { ?>
						<div id="jsautoz_object">
							<div class="object_item">
								<?php $longitude = JText::_('LONGITUDE');
										$style = "color:#808080;";
										if(isset($this->vehiclefilter)) if($this->vehiclefilter['longitude'] != ''){ $longitude = $this->vehiclefilter['longitude'];$style = "color:black;";} ?>
										 <input type="text" id="f_lo" name="f_lo" value="<?php echo $longitude;?>" size="15" style="<?php echo $style;?>width: 100px;" onfocus="if(this.value == '<?php echo JText::_('LONGITUDE');?>') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='<?php echo JText::_('LONGITUDE');?>';  }" />
							</div>
						</div>
						<div id="jsautoz_object">
							<div class="object_item">
								<?php $latitude = JText::_('LATITUDE');
										$style = "color:#808080;";
										if(isset($this->vehiclefilter)) if($this->vehiclefilter['latitude'] != ''){ $latitude = $this->vehiclefilter['latitude'];$style = "color:black;";} ?>
										<input type="text" id="f_la" name="f_la" value="<?php echo $latitude;?>" size="15" style="<?php echo $style;?>width: 100px;" onfocus="if(this.value == '<?php echo JText::_('LATITUDE');?>') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='<?php echo JText::_('LATITUDE');?>';  }" onchange="this.style.color='black';"/>
							</div>
						</div>
						<div id="jsautoz_object">
							<div class="object_item">
								<?php $radius = JText::_('COORDINATES_RADIUS');
										$style = "color:#808080;";
										if(isset($this->vehiclefilter)) if($this->vehiclefilter['radius'] != ''){ $radius = $this->vehiclefilter['radius'];$style = "color:black;";} ?>
										<input type="text" id="f_r" name="f_r" value="<?php echo $radius;?>" size="10" style="<?php echo $style;?>width: 110px;" size="25" onfocus="if(this.value == '<?php echo JText::_('COORDINATES_RADIUS');?>') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='<?php echo JText::_('COORDINATES_RADIUS');?>';  }" />
							</div>
						</div>
						<div id="jsautoz_object">
							<div class="object_item_title">
								<select  name="f_r_l_t" id="f_r_l_t" style="width:70px;">
									<option value="m" <?php if($this->config['default_radius']=="m"){?> selected="selected"<?php } ?> ><?php echo JText::_('METERS');?></option>
									<option value="km" <?php if($this->config['default_radius']=="km"){?> selected="selected"<?php } ?> ><?php echo JText::_('KILOMETERS');?></option>
									<option value="mile"<?php if($this->config['default_radius']=="mile"){?> selected="selected"<?php } ?> ><?php echo JText::_('MILES');?></option>
									<option value="nacmiles"<?php if($this->config['default_radius']=="nacmiles"){?> selected="selected"<?php } ?> ><?php echo JText::_('NAUTICAL_MILES');?></option>
								</select>
                                                        <span class="map_titlea"><a anchor="anchor" href="Javascript: showdiv();loadMap();"><?php echo JText::_('MAP');?></a></span>
							</div>
						</div>
					<?php } ?>  
				</div>
				<div id="filter_inner">
					<?php if($this->filter['filtercountry']==1) { ?>
						<div id="jsautoz_object">
							<div class="object_item"><?php echo $this->vehiclefilter['loccountry']; ?></div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filterstate']==1) { ?>
						<div id="jsautoz_object">
							<div id="filter_state" class="object_item_title">
								<?php if((isset($this->vehiclefilter['locstate']))&&($this->vehiclefilter['locstate']!=="")) { ?>
											<?php echo $this->vehiclefilter['locstate']; ?>
								<?php }else{
										if(isset($this->vehiclefiltervalue)) if($this->vehiclefiltervalue['state'] != '') {$statevalue = $this->vehiclefiltervalue['state']; $style .= 'color:black;'; } else { $statevalue = 'State'; $style .= 'color:#808080;';} ?>
										<input type="text" name="state" size="15" id="state" style="<?php echo $style;  ?>" value="<?php echo $statevalue  ?>" onfocus="if(this.value == 'State') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='State'; }" />
								<?php } ?>  
							</div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filtercounty']==1) { ?>
						<div id="jsautoz_object">
							<div id="filter_county" class="object_item_title">
								<?php if((isset($this->vehiclefilter['loccounty']))&&($this->vehiclefilter['loccounty']!=="")) { ?>
											<?php echo $this->vehiclefilter['loccounty']; ?>
								<?php }else{
									if(isset($this->vehiclefiltervalue)) if($this->vehiclefiltervalue['county'] != '') $countyvalue = $this->vehiclefiltervalue['county']; else { $countyvalue = 'County'; $style .= 'color:#808080;';} else { $countyvalue = 'County'; $style .= 'color:#808080;';} ?>  
											<input type="text" name="county" size="15" id="county" style="<?php echo $style ;?>" value="<?php echo $countyvalue;  ?>" onfocus="if(this.value == 'County') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='County';  }" />
								<?php }  ?>  
							</div>
						</div>
					<?php } ?>  
					<?php if($this->filter['filtercity']==1) { ?>
						<div id="jsautoz_object">
							<div id="filter_city" class="object_item_title">
								<?php if((isset($this->vehiclefilter['loccity']))&&($this->vehiclefilter['loccity']!=="")) { ?>
											<?php echo $this->vehiclefilter['loccity']; ?>
								<?php }else{
									if(isset($this->vehiclefiltervalue)) if($this->vehiclefiltervalue['city'] != '') $cityvalue = $this->vehiclefiltervalue['city']; else { $cityvalue = 'City'; $style .= 'color:#808080;';} else { $cityvalue = 'City'; $style .= 'color:#808080;';}?>  
										<input type="text" name="city"  size="15" id="city" style="<?php echo $style ;?>" value="<?php echo $cityvalue;  ?>" onfocus="if(this.value == 'City') { this.value = ''; this.style.color='black';}" onblur="if(this.value == '') { this.style.color='#808080';this.value='City';  }"/>
								<?php } ?> 
							</div>
						</div>
					<?php } ?>
			</div>
			</div>
			<div id="filter_button">
				<button rel="button"  onclick="return formSubmit()" ><?php echo JText::_( 'GO' ); ?></button>
				<button rel="button"  onclick="return myReset();"><?php echo JText::_( 'RESET' ); ?></button>
			</div>
            <input type="hidden" name="option" value="com_jsautoz">
            <input type="hidden" name="view" value="buyer">
            <input type="hidden" name="layout" value="listvehicles">
            <input type="hidden" name="cl" value="<?php echo $this->cl;?>">
            <?php 
                /*if(($this->cl==2) &&($this->config['defaultcountry']!=$this->country)) { ?> 
                
                <input type="hidden" id="state" name="state" value="<?php echo $this->state; ?>">
                <input type="hidden" id="county" name="county" value="<?php echo $this->county; ?>">
                <input type="hidden" id="city" name="city" value="<?php echo $this->city; ?>">
                
            <?php }*/
            ?>
            <input type="hidden" name="mk" id="mk" value="<?php echo $this->makeid;?>">
            <input type="hidden" name="md" id="md" value="<?php echo $this->modelid;?>">
            <input type="hidden"  id="vTypeText" name="vtype" value="<?php echo $this->vtype;?>">
            <input type="hidden"  id="isfilter" name="isfilter" value="1">
            <input type="hidden" id="default_longitude" name="default_longitude" value="<?php echo $this->config['default_longitude'];?>"/>
            <input type="hidden" id="default_latitude" name="default_latitude" value="<?php echo $this->config['default_latitude'];?>"/>
       </form>

<script type="text/javascript">
function updatefiltervtypevalue(val){
	if(val==-1) val="";
    document.getElementById("vTypeText").value=val;
}	
function formSubmit() {
    
    filter_long=document.getElementById("f_lo").value;
    filter_lati=document.getElementById("f_la").value;
    filter_radius=document.getElementById("f_r").value;
    if(filter_long!=='Longitude' && filter_lati!=='Latitude' ){
        
        if(filter_radius=='Coordinates Radius') {
            alert('<?php echo JText::_('PLEASE_ENTER_COORDINATES_RADIUS') ?>');
            return false;
        }
        
    }else{
        
        document.getElementById("adminFormvehiclefilter").submit();
    
    }

    
}    
function myReset() {
    if (testIsValidObject(document.adminFormvehiclefilter.fmk)) document.adminFormvehiclefilter.fmk.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.fmd)) document.adminFormvehiclefilter.fmd.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.mk)) document.adminFormvehiclefilter.mk.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.md)) document.adminFormvehiclefilter.md.value = '';
    
    if(testIsValidObject(document.adminFormvehiclefilter.fvtype)) document.adminFormvehiclefilter.fvtype.value = '-1';
    
    if (testIsValidObject(document.adminFormvehiclefilter.fmod)) document.adminFormvehiclefilter.fmod.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.country)) document.adminFormvehiclefilter.country.value = '';

    if (testIsValidObject(document.adminFormvehiclefilter.state)) document.adminFormvehiclefilter.state.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.county)) document.adminFormvehiclefilter.county.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.city)) document.adminFormvehiclefilter.city.value = '';

    if (testIsValidObject(document.adminFormvehiclefilter.txt_state)) document.adminFormvehiclefilter.txt_state.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.txt_county)) document.adminFormvehiclefilter.txt_county.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.txt_city)) document.adminFormvehiclefilter.txt_city.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.isfilter)) document.adminFormvehiclefilter.isfilter.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.f_r)) document.adminFormvehiclefilter.f_r.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.f_lo)) document.adminFormvehiclefilter.f_lo.value = '';
    if (testIsValidObject(document.adminFormvehiclefilter.f_la)) document.adminFormvehiclefilter.f_la.value = '';
	//reset the new hidden field for the condition
    if (testIsValidObject(document.adminFormvehiclefilter.vTypeText)) document.adminFormvehiclefilter.vTypeText.value = '';

    document.adminFormvehiclefilter.submit();
    //alert('reset 2');
 
 }

function testIsValidObject(objToTest) {
    
    if (null == objToTest) {
            return false;
    }
    if ("undefined" == typeof(objToTest) ) {
            return false;
    }
    return true;

}

    function getfiltermodels(val){
	var pagesrc = 'filter_models';
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

	xhr.open("GET","index.php?option=com_jsautoz&task=vehiclefilterlistmodels&val="+val/*+"&req="+req*/,true);
	xhr.send(null);
}
function getfilteraddressdata(src, val){
       var pagesrc = 'filter_'+src;
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
				//countyhtml = "<input class='inputbox'  value='County'  type='text' name='txt_county' id='txt_county' size='10' maxlength='100' onfocus='if(this.value == \"County\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"County\";}'  />";
				//cityhtml = "<input class='inputbox'  value='City' type='text'  name='txt_city' id='txt_city' size='10' maxlength='100' onfocus='if(this.value == \"City\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"City\"; }'  />";
				countyhtml = "<input class='inputbox'  value='County'  type='text' name='county' style='color:#808080;' id='county' size='10' maxlength='100' onfocus='if(this.value == \"County\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"County\";}'  />";
				cityhtml = "<input class='inputbox'  value='City' type='text'  name='city' id='city' style='color:#808080;' size='10' maxlength='100' onfocus='if(this.value == \"City\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"City\"; }'  />";
				document.getElementById('filter_county').innerHTML=countyhtml; //retuen value
				document.getElementById('filter_city').innerHTML=cityhtml; //retuen value
			}else if(src=='county'){
				//cityhtml = "<input class='inputbox'  value='City' type='text'  name='txt_city' id='txt_city' size='10' maxlength='100' onfocus='if(this.value == \"City\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"City\"; }'  />";
				cityhtml = "<input class='inputbox'  value='City' type='text'  name='city' id='city' style='color:#808080;'  size='10' maxlength='100' onfocus='if(this.value == \"City\"){this.value=\"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"City\"; }'  />";
				document.getElementById('filter_city').innerHTML=cityhtml; //retuen value
			}
                        
      }
    }
        
	xhr.open("GET","index.php?option=com_jsautoz&task=listfilteraddressdata&data="+src+"&val="+val,true);
	xhr.send(null);
 }
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  function loadMap() {
		var default_latitude = document.getElementById('default_latitude').value;
		var default_longitude = document.getElementById('default_longitude').value;
		
		var latitude = document.getElementById('f_la').value;
		var longitude = document.getElementById('f_lo').value;
		
		if(!isNaN(latitude) && !isNaN(longitude)){
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
		document.getElementById('f_la').value = marker.position.lat();
		document.getElementById('f_lo').value = marker.position.lng();

		document.getElementById('f_la').style.color = "black";
		document.getElementById('f_lo').style.color = "black";

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
			document.getElementById('f_la').value = marker.position.lat();
			document.getElementById('f_lo').value = marker.position.lng();
			
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

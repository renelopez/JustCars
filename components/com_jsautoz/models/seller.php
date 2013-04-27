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

jimport('joomla.application.component.model');
jimport('joomla.html.html');
jimport('joomla.html.parameter');


class JSAutozModelSeller extends JModelLegacy
{
	var $_config = null;
	var $_countries = null;
        var $_dfueltype = null;
        var $_dcylinder = null;
        var $_dadexpiry =  null;
		var $_ptr = null;
        var $_dcurrency = null;
        var $_dvehicletype = null;
        var $_dmileage = null;
        var $_dmodelyear = null;
        var $_dtransmission = null;
	function __construct()
	{
		parent :: __construct();
		$user	=& JFactory::getUser();
		$this->_arv = "/\aseofm/rvefli/ctvrnaa/kme/\rfer";
		$this->_ptr = "/\blocalh";
	}



	function &getDefaultCurrency() {
		$db = &$this->getDBO();
		$query = "SELECT currency.symbol FROM `#__js_auto_currency` AS currency WHERE isdefault=1 AND status = 1";
		//echo '<br> SQL '.$query;
		$db->setQuery($query);

		$default_currency = $db->loadResult();

		return $default_currency;
		
	}


	function getLocMapAddressData($value) {
            
		$array = explode(', ',$value);
		$count = count($array);
		$count--;
		
		if($count != -1){$country = $array[$count];$count--;}
		if($count != -1){$county = $array[$count];$count--;}
		//if($state) $county = $state;
		if($count != -1)$city = $array[$count];
		
		$db = $this->getDbo();
		$query = "SELECT code FROM `#__js_auto_countries` WHERE name = ".$db->quote($country);
		$db->setQuery($query);
		$countrycode = $db->loadResult();
		if(isset($county)){
			$query = "SELECT statecode FROM `#__js_auto_counties` WHERE countrycode = ".$db->quote($countrycode)." AND name = ".$db->quote($county);
			$db->setQuery($query);
			$statecode = $db->loadResult();
		}
		
		if(isset($statecode) && !empty($statecode)){
			$query = "SELECT code,name FROM `#__js_auto_states` WHERE countrycode=".$db->quote($countrycode);
			$db->setQuery($query);
			$states = $db->loadObjectList();

			//$liststates = "<select name=locstate id=locstate class=inputbox onchange=\"dochange('county', this.value);\" >\n";
			$liststates = "<select name=locstate id=locstate class=inputbox onchange=\"getlocaddressdata('county', this.value);\" >\n";
			foreach($states AS $st){
				if($statecode == $st->code) $liststates .= "<option value=".$st->code." selected=selected>".$st->name."</option>";
				else $liststates .="<option value=".$st->code.">".$st->name."</option>";
			}
			$liststates .= "</select>";

			$query = "SELECT code,name FROM `#__js_auto_counties` WHERE countrycode = ".$db->quote($countrycode)." AND statecode = ".$db->quote($statecode);
			$db->setQuery($query);
			$counties = $db->loadObjectList();

			$listcounties = "<select name=loccounty id=loccounty class=inputbox onchange=\"getlocaddressdata('city', this.value);\" >\n";
			foreach($counties AS $st){
				if($county == $st->name) {$listcounties .= "<option value=".$st->code." selected=selected>".$st->name."</option>";$countycode = $st->code;}
				else $listcounties .="<option value=".$st->code.">".$st->name."</option>";
			}
			$listcounties .= "</select>";
			
			if(isset($city)){ 
				if(isset($countycode)){
				//if(isset($counties)){
					$query = "SELECT code,name FROM `#__js_auto_cities` WHERE countrycode = ".$db->quote($countrycode)." AND statecode = ".$db->quote($statecode)." AND countycode = ".$db->quote($countycode);
					$db->setQuery($query);
					$counties = $db->loadObjectList();

					$listcity = "<select name=loccity id=loccity class=inputbox onchange=\"getlocaddressdata('zip', this.value);\" >\n";
                                        $listcity.="<option value=''>".JText::_('SELECT_CITY')."</option>";
					foreach($counties AS $st){
						if($city == $st->name) $listcity .= "<option value=".$st->code." selected=selected>".$st->name."</option>";
						else $listcity .="<option value=".$st->code.">".$st->name."</option>";
					}
					$listcity .= "</select>";
				}else $listcity = "<input name=city id=city onBlur= />";
			}else $listcity = "<input name=city id=city onBlur= />";
			
		}else{
			if(isset($county)){
				$liststates = "<input name=locstate id=locstate value=".$county." onBlur= />";
				$listcounties = "<input name=loccounty id=loccounty value=".$county." onBlur= />";
			}else{
				 $liststates = "<input name=locstate id=locstate value='' onBlur= />";
				$listcounties = "<input name=loccounty id=loccounty value='' onBlur= />";
			 }
			if(isset($city)) $listcity = "<input name=loccity id=loccity value=".$city." onBlur= />";
			else $listcity = "<input name=loccity id=loccity onBlur= />";

		}
			$return['loccountrycode']=$countrycode;
			$return['locstates']=$liststates;
			$return['loccounties']=$listcounties;
			$return['loccity']=$listcity;
			return $return;
            
	}
	function deleteVehicle($vehicleid,$uid) {
		if ((is_numeric($uid) == false) ||($uid == 0) || ($uid == '')) return false;
		if ((is_numeric($vehicleid) == false) ||($vehicleid == 0) || ($vehicleid == '')) return false;

		$db =& JFactory::getDBO();

		$query = "SELECT COUNT(vehicle.id)
		FROM #__js_auto_vehicles  AS vehicle
		WHERE vehicle.uid = ".$uid ." AND vehicle.id = ".$vehicleid	;

		$db->setQuery( $query );
		$result = $db->loadResult();
		if ($result > 0)  {
				$query = " Delete vehicles,vehoption,vehimage
					 FROM `#__js_auto_vehicles` AS vehicles
					LEFT JOIN `#__js_auto_vehicleoptions` AS vehoption ON vehicles.id= vehoption.vehicleid
					LEFT JOIN `#__js_auto_vehicleimages` AS vehimage ON vehicles.id= vehimage.vehicleid
					 WHERE vehicles.id = ". $vehicleid;
				$db->setQuery($query);
				if($db->query()) 
					return 1;
				else return false;	
		}else{
			return 2;
		}	
		
	}

    function &getAllVehicle($visitoremail,$uid,$limitstart,$limit) {
		//if ((is_numeric($uid) == false) || ($uid == 0) || ($uid == '')) return false;
        $db = &$this->getDBO();
        $result = array();
        $query = "SELECT COUNT(vehicles.id)
        FROM #__js_auto_vehicles AS vehicles
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id";
        if($visitoremail){
            $query.=" JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.id = info.vehicleid";
            $query.=" WHERE info.email = ".$db->quote($visitoremail);
        }
        if($uid){
            $query.=" WHERE vehicles.uid = ".$uid;
        }
        
        $query.=" AND vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()" ;
        //echo '<br>'.$query;
        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.uid AS selleruid,vehicles.vehicleid AS vehkey,vehicles.price,vehicles.created,vehicles.id,vehicles.title AS title
        ,vehicles.isgoldvehicle,vehicles.isfeaturedvehicle,vehicles.conditionid AS conditionid,
        vehicles.exteriorcolor,vehicles.enginecapacity,vehicletypes.title AS vehicletitle,
        makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,currency.symbol AS currency,
        conditions.title AS conditiontitle, cat.title AS cattitle";
        if($visitoremail) {
			$query.=" ,info.email AS visitorselleremail ";
        }
        $query.=" FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id";
        if($visitoremail){
			$query.=" JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.id = info.vehicleid";
			$query.=" WHERE info.email = ".$db->quote($visitoremail);
        }
        if($uid){
                $query.=" WHERE vehicles.uid = ".$uid;
        }
        $query.=" AND vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE() ORDER BY vehicles.created DESC" ;
        //echo '<br>'.$query;

        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
    }


    function &getVehicleforForm($id ,$uid,$adtype,$semail ) {
        $db = &$this->getDBO();
        $result=array();
        if($id){
                if (is_numeric($id) == false) return false;
                $vehicle ="";
                $vehicleoptions="";
                $query = "SELECT vehicle.*,vehicle.vehicleid AS vehkey,vehicle.id AS vehicleid";
                if($semail){
					$query .=" ,info.*,info.id AS infoid  ";
                }
                $query .=" FROM `#__js_auto_vehicles` AS vehicle";
                if($semail){
                        $query .=" JOIN `#__js_auto_seller_contact_info` AS info ON vehicle.id = info.vehicleid";
                        $query .=" WHERE vehicle.id = ".$id." AND info.email=".$db->quote($semail);
                }
                if($uid){
                        $query .=" WHERE vehicle.id = ".$id;

                }
                $db->setQuery($query);
                $vehicle = $db->loadObject();
                $query = "SELECT vehicleoptions.* FROM `#__js_auto_vehicleoptions` AS vehicleoptions
                WHERE vehicleoptions.vehicleid =".$id;

                $db->setQuery($query);
                $vehicleoptions = $db->loadObject();
        }
        $title = "";
		$vehicletypeid_req = ''; $makeid_req = ''; $modelid_req = ''; $modelyearid_req = ''; $fueltypeid_req = '';
        $cylinderid_req = ''; $transmissionid_req = ''; $adexpiryid_req = ''; $mileagetypeid_req = '';$conditionid_req='';
        $categoryid_req='';
        
        $fieldorderings =$this->getFieldsOrdering(1);
        $fieldorderings_options =$this->getFieldsOrdering(2);
        foreach ( $fieldorderings AS $field ){
                switch ($field->field) {
                        case "vehicletypeid": if($field->required == 1)$vehicletypeid_req = ' required';break;
                        case "makeid": if($field->required == 1)$makeid_req = ' required';break;
                        case "modelid": if($field->required == 1){$modelid_req = ' required'; $model_required = 1; }break;
                        case "modelyearid": if($field->required == 1)$modelyearid_req = ' required';break;
                       // case "conditionid": if($field->required == 1)$conditionid_req = ' required';break;
                        case "fueltypeid": if($field->required == 1)$fueltypeid_req = ' required';break;
                        case "cylinderid": if($field->required == 1)$cylinderid_req = ' required';break;
                        case "transmissionid": if($field->required == 1)$transmissionid_req = ' required';break;
                        case "adexpiryid": if($field->required == 1)$adexpiryid_req = ' required';break;
                        case "mileagetypeid": if($field->required == 1)$mileagetypeid_req = ' required';break;
                        case "conditionid": if($field->required == 1)$conditionid_req = ' required';break;
                        case "categoryid": if($field->required == 1)$categoryid_req = ' required';break;
                }
        }
        $countries = $this->getCountries('');
        if ( isset($vehicle) ){
                 $regstates = $this->getStates($vehicle->regcountry, '');
                 $regcounties = $this->getCounties($vehicle->regstate, '');
                 $regcities = $this->getCities($vehicle->regcounty, '');
                 $locstates = $this->getStates($vehicle->loccountry, '');
                 $loccounties = $this->getCounties($vehicle->locstate, '');
                 $loccities = $this->getCities($vehicle->loccounty, '');
                 $loczip = $this->getZipCodes($vehicle->loczip, '');
                 $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType($title), 'vehicletypeid', 'class="inputbox'.$vehicletypeid_req.'" '. '', 'value', 'text', $vehicle->vehicletypeid);
                 $lists['makes'] = JHTML::_('select.genericList', $this->getVehiclesMakes($title), 'makeid', 'class="inputbox' .$makeid_req.'" '. 'onChange="getvfmodels(this.value,'.$model_required.')"', 'value', 'text', $vehicle->makeid);
                 $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId($vehicle->makeid,$title), 'modelid', 'class="inputbox'.$modelid_req.'" '. '', 'value', 'text', $vehicle->modelid);
                 $lists['categories'] = JHTML::_('select.genericList', $this->getVehiclesCategory($title), 'categoryid', 'class="inputbox'.$categoryid_req.' " '. '', 'value', 'text', '');
                 $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear($title), 'modelyearid', 'class="inputbox'.$modelyearid_req.'" '. '', 'value', 'text',$vehicle->modelyearid);
                 if($adtype == ""){
                     $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition($title), 'conditionid', 'class="inputbox'.$conditionid_req.'" '. '', 'value', 'text',$vehicle->conditionid );
                 }
                 $lists['fueltypes'] = JHTML::_('select.genericList', $this->getVehiclesFuelType($title), 'fueltypeid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text',$vehicle->fueltypeid);
                 $lists['currency'] = JHTML::_('select.genericList', $this->getCurrency($title), 'currencyid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text',$vehicle->currencyid);
                 $lists['cylinders'] = JHTML::_('select.genericList', $this->getVehiclesCylinders($title), 'cylinderid', 'class="inputbox'.$cylinderid_req.'" '. '', 'value', 'text',$vehicle->cylinderid );
                 $lists['transmissions'] = JHTML::_('select.genericList', $this->getVehiclesTransmission($title), 'transmissionid', 'class="inputbox'.$transmissionid_req.'" '. '', 'value', 'text',$vehicle->transmissionid );
                 $lists['adexpiries'] = JHTML::_('select.genericList', $this->getVehiclesAdexpirie($title), 'adexpiryid', 'class="inputbox'.$adexpiryid_req.'" '. '', 'value', 'text', $vehicle->adexpiryid);
                 $lists['mileagetypes'] = JHTML::_('select.genericList', $this->getMileagesType($title), 'mileagetypeid', 'class="inputbox'.$mileagetypeid_req.'" '. '', 'value', 'text', $vehicle->mileagetypeid);
                 $lists['regcountry'] = JHTML::_('select.genericList', $countries, 'regcountry','class="inputbox required" '.'onChange="geteregaddressdata(\'state\', this.value)"', 'value', 'text', $vehicle->regcountry);
                 if ( isset($regstates[1]) ) if ($regstates[1] != '')$lists['regstate'] = JHTML::_('select.genericList', $regstates, 'regstate', 'class="inputbox" '. 'onChange="geteregaddressdata(\'county\', this.value)"', 'value', 'text', $vehicle->regstate);
                 if ( isset($regcounties[1]) ) if ($regcounties[1] != '')$lists['regcounty'] = JHTML::_('select.genericList', $regcounties, 'regcounty', 'class="inputbox" '. 'onChange="geteregaddressdata(\'city\', this.value)"', 'value', 'text',$vehicle->regcounty);
                 if ( isset($regcities[1]) ) if ($regcities[1] != '')$lists['regcity'] = JHTML::_('select.genericList', $regcities, 'regcity', 'class="inputbox" '. '', 'value', 'text', $vehicle->regcity);
                 $lists['loccountry'] = JHTML::_('select.genericList', $countries, 'loccountry','class="inputbox required" '.'onChange="getlocaddressdata(\'state\', this.value)"', 'value', 'text', $vehicle->loccountry);
                 if ( isset($locstates[1]) ) if ($locstates[1] != '')$lists['locstate'] = JHTML::_('select.genericList', $locstates, 'locstate', 'class="inputbox" '. 'onChange="getlocaddressdata(\'county\', this.value)"', 'value', 'text',$vehicle->locstate);
                 if ( isset($loccounties[1]) ) if ($loccounties[1] != '')$lists['loccounty'] = JHTML::_('select.genericList', $loccounties, 'loccounty', 'class="inputbox" '. 'onChange="getlocaddressdata(\'city\', this.value)"', 'value', 'text',$vehicle->loccounty);
                 if ( isset($loccities[1]) ) if ($loccities[1] != '')$lists['loccity'] = JHTML::_('select.genericList', $loccities, 'loccity', 'class="inputbox" '. 'onChange="getlocaddressdata(\'zip\', this.value)"', 'value', 'text', $vehicle->loccity);
                 if ( isset($loczip[1]) ) if ($loczip[1] != '')$lists['zipcode'] = JHTML::_('select.genericList', $loczip, 'loczip', '', 'value', 'text', $vehicle->loczip);

        }else{
                $vehicledefaultvalue = $this->getVehiclesDefaultValues();
                $this->_dfueltype = $vehicledefaultvalue->fueltypeid;
                $this->_dcylinder = $vehicledefaultvalue->cylinderid;
                $this->_dadexpiry =  $vehicledefaultvalue->adexpiryid;
                $this->_dcurrency =  $vehicledefaultvalue->currencyid;

                $this->_dvehicletype =  $vehicledefaultvalue->vehicletypeid;
                $this->_dmileage =  $vehicledefaultvalue->mileageid;
                $this->_dmodelyear =  $vehicledefaultvalue->modelyearid;
                $this->_dtransmission =  $vehicledefaultvalue->transmissionid;

                $configs = $this->getConfiginArray('default');
                $vehiclemakes=$this->getVehiclesMakes($title);
                if(isset ($vehiclemakes[0])) $vehiclemodels=$this->getVehiclesModelsbyMakeId($vehiclemakes[0]['value'],  JText::_('SELECT_MODEL'));else $vehiclemodels=$this->getVehiclesModelsbyMakeId('',$title);
                if($configs['defaultcountry'])$regstates = $this->getStates($configs['defaultcountry'], '');
                $locstates = $regstates;
                //if($configs['defaultcountry'])$locstates = $this->getStates($configs['defaultcountry'], '');
                $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType($title), 'vehicletypeid', 'class="inputbox'.$vehicletypeid_req.'" '. '', 'value', 'text', $this->_dvehicletype);
                $lists['makes'] = JHTML::_('select.genericList', $vehiclemakes, 'makeid', 'class="inputbox required" '. 'onChange="getvfmodels(this.value,'.$model_required.')"', 'value', 'text', '');
                $lists['models'] = JHTML::_('select.genericList', $vehiclemodels, 'modelid', 'class="inputbox'.$modelid_req.'" '. '', 'value', 'text', '');
                $lists['categories'] = JHTML::_('select.genericList', $this->getVehiclesCategory($title), 'categoryid', 'class="inputbox '.$categoryid_req.'" '. '', 'value', 'text', '');
                $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear($title), 'modelyearid', 'class="inputbox'.$modelyearid_req.'" '. '', 'value', 'text', $this->_dmodelyear);
                if($adtype=="") {
                    $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition($title), 'conditionid', 'class="inputbox'.$conditionid_req.'" '. '', 'value', 'text', '');
                }
                $lists['fueltypes'] = JHTML::_('select.genericList', $this->getVehiclesFuelType($title), 'fueltypeid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text', $this->_dfueltype);
                 $lists['currency'] = JHTML::_('select.genericList', $this->getCurrency($title), 'currencyid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text',$this->_dcurrency);
                $lists['cylinders'] = JHTML::_('select.genericList', $this->getVehiclesCylinders($title), 'cylinderid', 'class="inputbox'.$cylinderid_req.'" '. '', 'value', 'text', $this->_dcylinder);
                $lists['transmissions'] = JHTML::_('select.genericList', $this->getVehiclesTransmission($title), 'transmissionid', 'class="inputbox'.$transmissionid_req.'" '. '', 'value', 'text', $this->_dtransmission);
                $lists['adexpiries'] = JHTML::_('select.genericList', $this->getVehiclesAdexpirie($title), 'adexpiryid', 'class="inputbox'.$adexpiryid_req.'" '. '', 'value', 'text', $this->_dadexpiry);
                $lists['mileagetypes'] = JHTML::_('select.genericList', $this->getMileagesType($title), 'mileagetypeid', 'class="inputbox'.$mileagetypeid_req.'" '. '', 'value', 'text', $this->_dmileage);
                $lists['regcountry'] = JHTML::_('select.genericList', $countries, 'regcountry','class="inputbox required" '.'onChange="geteregaddressdata(\'state\', this.value)"', 'value', 'text', $configs['defaultcountry']);
                if ( isset($regstates[1]) ) if ($regstates[1] != '')$lists['regstate'] = JHTML::_('select.genericList', $regstates, 'regstate', 'class="inputbox" '. 'onChange="geteregaddressdata(\'county\', this.value)"', 'value', 'text', '');
                if ( isset($regcounties[1]) ) if ($regcounties[1] != '')$lists['regcounty'] = JHTML::_('select.genericList', $regcounties, 'regcounty', 'class="inputbox" '. 'onChange="geteregaddressdata(\'city\', this.value)"', 'value', 'text', '');
                if ( isset($regcities[1]) ) if ($regcities[1] != '')$lists['regcity'] = JHTML::_('select.genericList', $regcities, 'regcity', 'class="inputbox" '. '', 'value', 'text', '');
                $lists['loccountry'] = JHTML::_('select.genericList', $countries, 'loccountry','class="inputbox required" '.'onChange="getlocaddressdata(\'state\', this.value)"', 'value', 'text',$configs['defaultcountry']);
                if ( isset($locstates[1]) ) if ($locstates[1] != '')$lists['locstate'] = JHTML::_('select.genericList', $locstates, 'locstate', 'class="inputbox" '. 'onChange="getlocaddressdata(\'county\', this.value)"', 'value', 'text', '');
                if ( isset($loccounties[1]) ) if ($loccounties[1] != '')$lists['loccounty'] = JHTML::_('select.genericList', $loccounties, 'loccounty', 'class="inputbox" '. 'onChange="getlocaddressdata(\'city\', this.value)"', 'value', 'text', '');
                if ( isset($loccities[1]) ) if ($loccities[1] != '')$lists['loccity'] = JHTML::_('select.genericList', $loccities, 'loccity', 'class="inputbox" '. 'onChange="getlocaddressdata(\'zip\', this.value)"', 'value', 'text', '');
                if ( isset($loczip[1]) ) if ($loczip[1] != '')$lists['zipcode'] = JHTML::_('select.genericList', $loczip, 'loczip', '', 'value', 'text', '');
        }
         if($id){
            $result[0] = $vehicle;
            $result[1] = $vehicleoptions;
            $result[2] = $lists;
            $result[3] = $fieldorderings;
            $result[4]= $fieldorderings_options;
            $result[5] = 1;
            $result[7] = $this->getUserFields(1, $id); // job fields , ref id
            
         }else{
                $result[2] = $lists;
                $result[3] = $fieldorderings;
                $result[4]= $fieldorderings_options;
                $returnvalue = $this->canAddNewVehicle($uid);
                $result[5] = $returnvalue[0];
                $result[6] = $returnvalue[1];
		$result[7] = $this->getUserFields(1, $id); // job fields , ref id
         }
         return $result;

    }
    	function &getUserFields($fieldfor, $id)
	{
		$db = &$this->getDBO();
		$result=array();
		if($id) if (is_numeric($id) == false) return $result;
		if (is_numeric($fieldfor) == false) return $result;
		$field = array();
		$result = array();
		$query =  "SELECT  * FROM `#__js_auto_userfields`
					WHERE published = 1 AND fieldfor = ". $fieldfor;
		$db->setQuery($query);
		$rows = $db->loadObjectList();

		$i = 0;
		foreach ($rows as $row){
			$field[0] = $row;
			if ($id != ""){ 
				$query =  "SELECT  * FROM `#__js_auto_userfield_data` WHERE referenceid = ".$id." AND field = ". $row->id;
				$db->setQuery($query);
				$data = $db->loadObject();
				$field[1] = $data;
			}
			if ($row->type == "select"){
				$query =  "SELECT  * FROM `#__js_auto_userfieldvalues` WHERE field = ". $row->id;
				$db->setQuery($query);
				$values = $db->loadObjectList();
				$field[2] = $values;
			}
			$result[] = $field;
			$i++;
		}
		return $result;
	}

 	function getMyStats_Seller($uid)
	{
		if (is_numeric($uid) == false) return false;
		if (($uid == 0) || ($uid == '')) return false;

        $db = &$this->getDBO();
		$results=array();
		
		$query = "SELECT package.vehiclesallow,package.featuredvehicles,package.goldvehicles
			FROM #__js_auto_sellerpaymenthistory AS payment
			JOIN #__js_auto_sellerpackages AS package ON package.id = payment.packageid
			WHERE payment.uid = ".$uid."
			AND DATE_ADD(payment.created,INTERVAL package.packageexpireindays DAY) >= CURDATE()
			AND payment.transactionverified = 1 AND payment.status = 1";
		$db->setQuery($query);
		$packages = $db->loadObjectList();
		$vehiclesunlimited = 0;
		$unlimitedgoldvehicles = 0;
		$unlimitedfeaturedvehicles = 0;
		$vehiclesallow =0;
		$goldvehiclesallow =0;
		$featuredvehiclesallow = 0;
		foreach($packages AS $package){
			if($vehiclesunlimited == 0){
				if ($package->vehiclesallow != -1) {
						$vehiclesallow = $vehiclesallow + $package->vehiclesallow;
				}else $vehiclesunlimited = 1;
			}
			if($unlimitedgoldvehicles == 0){
				if ($package->goldvehicles != -1) {
						$goldvehiclesallow = $goldvehiclesallow + $package->goldvehicles;
				}else $unlimitedgoldvehicles = 1;
			}
			if($unlimitedfeaturedvehicles == 0){
				if ($package->featuredvehicles != -1) {
						$featuredvehiclesallow = $featuredvehiclesallow + $package->featuredvehicles;
				}else $unlimitedfeaturedvehicles = 1;
			}

		}

        //vehicles
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicles AS vehicle WHERE  uid = ".$uid;
		$db->setQuery($query);
		$totalvehicles = $db->loadResult();
		
        //gold vehicles
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicles AS vehicle WHERE uid = ".$uid." AND isgoldvehicle = 1";
		$db->setQuery($query);
		$totalgolevehicles = $db->loadResult();

        //featured vehicles
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicles AS vehicle WHERE uid = ".$uid." AND isfeaturedvehicle = 1";
		$db->setQuery($query);
		$totalfeaturedvehicles = $db->loadResult();

		if($vehiclesunlimited == 0)  $results[0]=$vehiclesallow;
		elseif($vehiclesunlimited == 1)$results[0] = -1;
		$results[1]=$totalvehicles;
	
		if($unlimitedgoldvehicles == 0) $results[2] = $goldvehiclesallow;
		elseif($unlimitedgoldvehicles == 1) $results[2] = -1;
		$results[3]=$totalgolevehicles;
	
		if($unlimitedfeaturedvehicles == 0) $results[4]=$featuredvehiclesallow;
		elseif($unlimitedfeaturedvehicles == 1)$results[4] = -1;
		$results[5]=$totalfeaturedvehicles;
	
		return  $results;
	}

       function getVehiclesDefaultValues(){
                    $db = &$this->getDBO();
                    $query = "SELECT fueltype.id AS fueltypeid,cylinder.id AS cylinderid,currency.id AS currencyid,
                    adexp.id AS adexpiryid,vehtype.id AS vehicletypeid,mileagetype.id AS mileageid,modelyear.id AS modelyearid,trans.id AS transmissionid
                    FROM `#__js_auto_fueltypes` AS fueltype,`#__js_auto_cylinders` AS cylinder,
                        `#__js_auto_adexpiries` AS adexp,`#__js_auto_currency` AS currency,
                        `#__js_auto_vehicletypes` AS vehtype,`#__js_auto_mileagetypes` AS mileagetype,
                        `#__js_auto_modelyears` AS modelyear,`#__js_auto_transmissions` AS trans
                    WHERE  fueltype.isdefault = 1 AND cylinder.isdefault = 1 AND adexp.isdefault = 1 AND currency.isdefault = 1
                    AND vehtype.isdefault = 1 AND mileagetype.isdefault = 1 AND modelyear.isdefault = 1 AND trans.isdefault = 1" ;

                    $db->setQuery($query);
                    $defaultvalues=$db->loadObject();
                    return $defaultvalues;
            }
	function canAddNewVehicle($uid)
	{
		$return[0]=true;
		$return[1]=true;
		return $return;
	}

    function &getSearchOptions() {
        $db = &$this->getDBO();
        $fieldorderings =$this->getFieldsOrdering(1);
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('ALL')), 'vehicletypeid', 'class="inputbox'.$vehicletypeid_req.'" '. '', 'value', 'text', '');
        $lists['makes'] = JHTML::_('select.genericList', $this->getVehiclesMakes(JText::_('ALL')), 'makeid', 'class="inputbox required" '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', '');
        $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId(1,JText::_('ALL')), 'modelid', 'class="inputbox'.$modelid_req.'" '. '', 'value', 'text', '');
        $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear(JText::_('ALL')), 'modelyearid', 'class="inputbox'.$modelyearid_req.'" '. '', 'value', 'text', '');
        $lists['fueltypes'] = JHTML::_('select.genericList', $this->getVehiclesFuelType(JText::_('ALL')), 'fueltypeid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text', '');
        $lists['cylinders'] = JHTML::_('select.genericList', $this->getVehiclesCylinders(JText::_('ALL')), 'cylinderid', 'class="inputbox'.$cylinderid_req.'" '. '', 'value', 'text', '');
        $result[2] = $lists;
        $result[3] = $fieldorderings;
        return $result;

    }
    function &getVehicleSearchResults($searchdata, $limitstart, $limit) {

        $db = &$this->getDBO();
        if ($searchdata['vehicletypeid'] != '') if (is_numeric($searchdata['vehicletypeid']) == false) return false;
        if ($searchdata['vehicletypeid'] != '') $wherequery .= " AND vehicle.vehicletypeid = ".$searchdata['vehicletypeid'];
        if ($searchdata['makeid'] != '') if (is_numeric($searchdata['makeid']) == false) return false;
        if ($searchdata['makeid'] != '') $wherequery .= " AND vehicle.makeid = ".$searchdata['makeid'];
        if ($searchdata['modelid'] != '') if (is_numeric($searchdata['modelid']) == false) return false;
        if ($searchdata['modelid'] != '') $wherequery .= " AND vehicle.modelid = ".$searchdata['modelid'];
        if ($searchdata['modelyearid'] != '') if (is_numeric($searchdata['modelyearid']) == false) return false;
        if ($searchdata['modelyearid'] != '') $wherequery .= " AND vehicle.modelyearid = ".$searchdata['modelyearid'];
        if ($searchdata['fueltypeid'] != '') if (is_numeric($searchdata['fueltypeid']) == false) return false;
        if ($searchdata['fueltypeid'] != '') $wherequery .= " AND vehicle.fueltypeid= ".$searchdata['fueltypeid'];
        if ($searchdata['cylinderid'] != '') if (is_numeric($searchdata['cylinderid']) == false) return false;
        if ($searchdata['cylinderid'] != '') $wherequery .= " AND vehicle.cylinderid= ".$searchdata['cylinderid'];
        if ($searchdata['pricefrom'] != '') if (is_numeric($searchdata['pricefrom']) == false) return false;
        if ($searchdata['pricefrom'] != '') $wherequery .= " AND vehicle.price >= ".$searchdata['pricefrom'];
        if ($searchdata['priceto'] != '') if (is_numeric($searchdata['priceto']) == false) return false;
        if ($searchdata['priceto'] != '') $wherequery .= " AND vehicle.price <= ".$searchdata['priceto'];
        if ($searchdata['exteriorcolor'] != '')
        if ($searchdata['exteriorcolor'] != '') $wherequery .= " OR vehicle.exteriorcolor LIKE '%".str_replace("'","",$db->quote($searchdata['exteriorcolor']))."%'";
        $query = "SELECT count(vehicle.id) FROM `#__js_auto_vehicles` AS vehicle
                WHERE vehicle.status = 1 ";
        $query .= $wherequery;

        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicle.*,vehicletypes.title as vehicletitle, makes.title as maketitle, models.title as modeltitle,
                                modelyears.title as modelyeartitle, fueltypes.title as fueltypetitle, cylinders.title as cylindertitle
                        FROM `#__js_auto_vehicles` AS vehicle
                        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicle.vehicletypeid = vehicletypes.id
                        LEFT JOIN `#__js_auto_makes` AS makes ON vehicle.makeid = makes.id
                        LEFT JOIN `#__js_auto_models` AS models ON vehicle.modelid = models.id
                        LEFT JOIN `#__js_auto_modelyears` AS modelyears ON vehicle.modelyearid = modelyears.id
                        LEFT JOIN `#__js_auto_fueltypes` AS fueltypes ON vehicle.fueltypeid = fueltypes.id
                        LEFT JOIN `#__js_auto_cylinders` AS cylinders ON vehicle.cylinderid = cylinders.id
                        WHERE vehicle.status = 1 ";
        $query .= $wherequery;
//				$query .= " ORDER BY  ".$sortby;

        $db->setQuery($query, $limitstart, $limit);
        $vehicles = $db->loadObjectList();
        $result[0] = $vehicles;
        $result[1] = $total;

        return $result;

    }
    function &getVehiclebyId($id) {
        $db = &$this->getDBO();
        if (is_numeric($id) == false) return false;
        $query = "SELECT vehicles.*,vehicletypes.title AS vehicletitle,
        makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle, conditions.title AS conditiontitle,
        categories.title AS cattitle,  transmissions.title AS transtitle, adexpiries.title AS adexptitle,
        mileagetypes.title AS mileagetitle
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS categories ON vehicles.categoryid = categories.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_transmissions` AS transmissions ON vehicles.transmissionid = transmissions.id
        LEFT JOIN `#__js_auto_adexpiries` AS adexpiries ON vehicles.adexpiryid = adexpiries.id
        LEFT JOIN `#__js_auto_mileagetypes` AS mileagetypes ON vehicles.mileagetypeid = mileagetypes.id
        WHERE  vehicles.id = " . $id;

        $db->setQuery($query);
        $vehicle=$db->loadObject();
        $query = "SELECT vehicleoptions.*
                FROM `#__js_auto_vehicleoptions` AS vehicleoptions
                WHERE  vehicleoptions.vehicleid = " . $id;

        $db->setQuery($query);
        $vehicleoptions=$db->loadObject();
        $result[0] = $vehicle;
        $result[1] = $vehicleoptions;
        $result[2] = $this->getFieldsOrdering(1) ; // vehicle fields
        $result[4]= $this->getFieldsOrdering(2);
        return $result;
    }

    function deleteVehicleImages($vehicleid,$id, $uid) {
		if($vehicleid) if (is_numeric($vehicleid) == false) return false;
		if($id) if (is_numeric($id) == false) return false;
		if($uid) if (is_numeric($uid) == false) return false;
        $row = &$this->getTable('vehicleimages');
        //if ($uid ) //return true;
        //if ($vehicleimageid )// return true;
        $returnvalue = $this->imagesCanDelete($vehicleid,$uid);
        if ($returnvalue == 1 ){
            $this->deleteVehicleImage($id);
            if (!$row->delete($id))	{
                $this->setError($row->getErrorMsg());
                return false;
            }
        }else return $returnvalue;// department can not delete

        return 1;
    }
    function imagesCanDelete($vehicleid, $uid) {
        if (is_numeric($uid) == false) return false;
		if (is_numeric($vehicleid) == false) return false;
        $db = &$this->getDBO();
        $result = array();
        $query = "SELECT COUNT(vehicles.id) FROM `#__js_auto_vehicles` AS vehicles
                                WHERE vehicles.id = ".$vehicleid." AND vehicles.uid = ".$uid;

        $db->setQuery($query);
        $comtotal = $db->loadResult();
        if ($comtotal > 0){ // this department is same user
                $query = "SELECT COUNT(vehicleimages.id) FROM `#__js_auto_vehicleimages` AS vehicleimages
                                WHERE vehicleimages.vehicleid = ".$vehicleid;

                $db->setQuery($query);
                $total = $db->loadResult();

                if ($total > 0)
                        return 1;
                else
                        return 2;
        }else return 3; // 	this department is not of this user

    }

	function getCaptchaForFormForSeller(){
		$session = JFactory::getSession();
		$rand=$this->spamCheckRandom1();
		$session->set('jsautoz_spamcheckid',$rand , 'jsautoz_checkspamcalc');
		$session->set('jsautoz_rot13', mt_rand(0, 1), 'jsautoz_checkspamcalc');
        
		// Determine operator
		$operator=2;
		if($operator==2) {
                    $tcalc = mt_rand(1, 2);
	    	
                }

		// Determine max. operand
		$max_value = 20;
		$negativ=0;

				$operend_1 = mt_rand(1, $max_value);
				$operend_2 = mt_rand(1, $max_value);
				$operand=2;
				if($operand == 3){
					$operend_3 = mt_rand(0, $max_value);
				}

		if($tcalc == 1) // Addition
		{
		if($session->get('jsautoz_rot13', null, 'jsautoz_checkspamcalc') == 1) // ROT13 coding
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_spamcheckresult', str_rot13(base64_encode($operend_1 + $operend_2)), 'jsautoz_checkspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_spamcheckresult', str_rot13(base64_encode($operend_1 + $operend_2 + $operend_3)), 'jsautoz_checkspamcalc');
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_spamcheckresult', base64_encode($operend_1 + $operend_2), 'jsautoz_checkspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_spamcheckresult', base64_encode($operend_1 + $operend_2 + $operend_3), 'jsautoz_checkspamcalc');
		    }
		}
		}
		elseif($tcalc == 2) // Subtraction
		{
		if($session->get('jsautoz_rot13', null, 'jsautoz_checkspamcalc') == 1)
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_spamcheckresult', str_rot13(base64_encode($operend_1 - $operend_2)), 'jsautoz_checkspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_spamcheckresult', str_rot13(base64_encode($operend_1 - $operend_2 - $operend_3)), 'jsautoz_checkspamcalc');
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_spamcheckresult', base64_encode($operend_1 - $operend_2), 'jsautoz_checkspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_spamcheckresult', base64_encode($operend_1 - $operend_2 - $operend_3), 'jsautoz_checkspamcalc');
		    }
		}
		}
		$add_string="";
		$add_string .= '<div><label for="'.$session->get('jsautoz_spamcheckid', null, 'jsautoz_checkspamcalc').'">';

		//$add_string .= JText::_('SPAM_CHECK').': ';

		if($tcalc == 1)
		{
					$converttostring=0;
		if($converttostring==1)
		{
		    if($operand == 2)
		    {
			$add_string .= $this->converttostring($operend_1).' '.JText::_('PLUS').' '.$this->converttostring($operend_2).' '.JText::_('EQUALS').' ';
		    }
		    elseif($operand == 3)
		    {
			$add_string .= $this->converttostring($operend_1).' '.JText::_('PLUS').' '.$this->converttostring($operend_2).' '.JText::_('PLUS').' '.$this->converttostring($operend_3).' '.JText::_('EQUALS').' ';
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$add_string .= $operend_1.' '.JText::_('PLUS').' '.$operend_2.' '.JText::_('EQUALS').' ';
		    }
		    elseif($operand == 3)
		    {
			$add_string .= $operend_1.' '.JText::_('PLUS').' '.$operend_2.' '.JText::_('PLUS').' '.$operend_3.' '.JText::_('EQUALS').' ';
		    }
		}
		}
		elseif($tcalc == 2)
		{
					$converttostring=0;
		if($converttostring==1)
		{
		    if($operand == 2)
		    {
			$add_string .= $this->converttostring($operend_1).' '.JText::_('MINUS').' '.$this->converttostring($operend_2).' '.JText::_('EQUALS').' ';
		    }
		    elseif($operand == 3)
		    {
			$add_string .= $this->converttostring($operend_1).' '.JText::_('MINUS').' '.$this->converttostring($operend_2).' '.JText::_('MINUS').' '.$this->converttostring($operend_3).' '.JText::_('EQUALS').' ';
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$add_string .= $operend_1.' '.JText::_('MINUS').' '.$operend_2.' '.JText::_('EQUALS').' ';
		    }
		    elseif($operand == 3)
		    {
			$add_string .= $operend_1.' '.JText::_('MINUS').' '.$operend_2.' '.JText::_('MINUS').' '.$operend_3.' '.JText::_('EQUALS').' ';
		    }
		}
		}

		$add_string .= '</label>';
		$add_string .= '<input type="text" name="'.$session->get('jsautoz_spamcheckid', null, 'jsautoz_checkspamcalc').'" id="'.$session->get('jsautoz_spamcheckid', null, 'jsautoz_checkspamcalc').'" size="3" class="inputbox '.$rand.' validate-numeric required" value="" required="required" />';
		$add_string .= '</div>';
		return $add_string;
	}
    private function spamCheckRandom1()	    {
		$pw = '';

		// first character has to be a letter
		$characters = range('a', 'z');
		$pw .= $characters[mt_rand(0, 25)];

		// other characters arbitrarily
		$numbers = range(0, 9);
		$characters = array_merge($characters, $numbers);

		$pw_length = mt_rand(4, 12);

		for($i = 0; $i < $pw_length; $i++)
		{
		    $pw .= $characters[mt_rand(0, 35)];
		}

		return $pw;
    }

     private function converttostring($x)    {
		// Probability 2/3 for conversion
		$random = mt_rand(1, 3);

		if($random != 1)
		{
		    if($x > 20)
		    {
		        return $x;
		    }
		    else
		    {
		        // Names of the numbers are read from language file
		        $names = array(JText::_('JSAUTOZ_NULL'), JText::_('ONE'), JText::_('TWO'), JText::_('THREE'), JText::_('FOUR'), 
					JText::_('FIVE'), JText::_('SIX'), JText::_('SEVEN'), JText::_('EIGHT'), JText::_('NINE'),
					 JText::_('TEN'), JText::_('ELEVEN'), JText::_('TWELVE'), JText::_('THIRTEEN'), 
					JText::_('FOURTEEN'), JText::_('FIFTEEN'), JText::_('SIXTEEN'), JText::_('SEVENTEEN'), 
					JText::_('EIGHTEEN'), JText::_('NINETEEN'), JText::_('TWENTY'));
		        return $names[$x];
		    }
		}
		else
		{
		    return $x;
		}
     }

    function storeVehicle($data) {
		
        $row = &$this->getTable('vehicles');
        $db = &$this->getDBO();

        $config = &$this->getConfig('default');
		if($data['uid']==0){
			if($config['captcha'] == 1){
			   if(!$this->performChecks())
			   {
				$result[0]= 2;
				return $result;
			   }
			}
		}
        //$data = JRequest :: get('post');
        $adexpid=$data['adexpiryid'];
        if($data['adexpiryid']) if (is_numeric($data['adexpiryid']) == false) return false;
        $created=$data['created'];
        $date = $created;
        $query ="SELECT adexp.title AS advalue,adexp.type AS adtype
            FROM `#__js_auto_adexpiries` AS adexp
                WHERE adexp.id != 1 AND adexp.id=".$adexpid;
        $db->setQuery($query);
        $adexp = $db->loadObject();
        $date = strtotime(date("Y-m-d", strtotime($date)) . " +$adexp->advalue $adexp->adtype");
        $row->addexpiryvalue=date("Y-m-d",$date);
        $result=array();
        $configs=$this->getConfiginArray('default');
        $emailconfig=$this->getConfiginArray('email');
            $data['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
        $data['status'] = $configs['vehicle_auto_approve'];
        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            $result[0]= false;
            return $result;
        }
        if (!$row->check())
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            $result[0]= false;
            return $result;
        }
        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            $result[0]= false;
            return $result;
        }
        $this->storeUserFieldData($data, $row->id);
        if($this->storeVehicleOptions($data,$row->id));
        if($this->storeSellerContactInfo($data,$row->id,$row->uid));else $result[2]= false;
		if($data['id'] == ''){
			if($emailconfig['new_vehicle_admin']==1){   // mail to admin 
				$this->sendMailtoAdmin('',$row->id,$row->uid,1); 
		}

			}

			$result[0]= true;
			$result[1]= $row->id;
			return $result;
    }
    private function performChecks()
    {
        $request = JRequest::get();
	$session = JFactory::getSession();
        $type_calc=true;
        if($type_calc)
        {
            if($session->get('jsautoz_rot13', null, 'jsautoz_checkspamcalc') == 1)
            {
                $spamcheckresult = base64_decode(str_rot13($session->get('jsautoz_spamcheckresult', null, 'jsautoz_checkspamcalc')));
            }
            else
            {
                $spamcheckresult = base64_decode($session->get('jsautoz_spamcheckresult', null, 'jsautoz_checkspamcalc'));
            }

            $spamcheck = JRequest::getInt($session->get('jsautoz_spamcheckid', null, 'jsautoz_checkspamcalc'), '', 'post');
	
            $session->clear('jsautoz_rot13', 'jsautoz_checkspamcalc');
            $session->clear('jsautoz_spamcheckid', 'jsautoz_checkspamcalc');
            $session->clear('jsautoz_spamcheckresult', 'jsautoz_checkspamcalc');
            

            if(!is_numeric($spamcheckresult) || $spamcheckresult != $spamcheck)
            {
                return false; // Failed
            }
        }

        // Hidden field
        $type_hidden=0;
        if($type_hidden)
        {
            $hidden_field = $session->get('hidden_field', null, 'checkspamcalc');
            $session->clear('hidden_field', 'checkspamcalc');

            if(JRequest::getVar($hidden_field, '', 'post'))
            {
                return false; // Hidden field was filled out - failed
            }
        }

        // Time lock
        $type_time=0;
        if($type_time)
        {
            $time = $session->get('time', null, 'checkspamcalc');
            $session->clear('time', 'checkspamcalc');

            if(time() - $this->params->get('type_time_sec') <= $time)
            {
                return false; // Submitted too fast - failed
            }
        }

        // Own Question
        // Conversion to lower case
        $session->clear('ip', 'jsautoz_checkspamcalc');
        $session->clear('saved_data', 'jsautoz_checkspamcalc');

        return true;
    }

	function checkUser($tpin){
        $db = &$this->getDBO();
            $query = "SELECT count(id) FROM `#__js_auto_vehicles` AS vehicles 
            WHERE vehicles.vehicleid = ".$db->quote($tpin);
            $db->setQuery($query);
            $ifexist=$db->loadResult();
            if($ifexist > 0) return 0;
            else return 1;
	}
	function storeUserFieldData($data, $refid) //store  user field data
	{
		$row = &$this->getTable('userfielddata');
		for($i = 1; $i <= $data['userfields_total']; $i++){
			$fname = "userfields_".$i;
			$fid = "userfields_".$i."_id";
			$dataid = "userdata_".$i."_id";
			//$fielddata['id'] = "";

			$fielddata['id'] = $data[$dataid];
			$fielddata['referenceid'] = $refid;
			$fielddata['field'] = $data[$fid];
			$fielddata['data'] = $data[$fname];

			if (!$row->bind($fielddata))	{
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->store())	{
				$this->setError($this->_db->getErrorMsg());
				echo $this->_db->getErrorMsg();
				return false;
			}
		}
		return true;
	}

    function storeSellerContactInfo($data,$vehicleid,$uid){
        $row = &$this->getTable('sellercontactinfo');
        //$data = JRequest :: get('post');
        if($this->checkCellerInfo($uid)){
			if(($data['scid']!="") && ($data['scid']!=0) ){  //seller contact info id for edit case
				$row->id = $data['scid'];
			}
            $row->uid = $uid;
            $row->vehicleid = $vehicleid;
            $row->name = $data['sellername'];
            $row->cell = $data['sellercell'];
            $row->phone = $data['sellerphone'];
            $row->email = $data['selleremail'];
            $row->status = '1';
            $row->created = $data['created'];
            if (!$row->store())
            {
                $this->setError($this->_db->getErrorMsg());
                echo $this->_db->getErrorMsg();
                return false;
            }
            return true;
        }else{
            return false;

        }
    }
   function checkCellerInfo($uid){
        $db = &$this->getDBO();
        if($uid!= 0){
			if(!is_numeric($uid)) return false;
            $query = "SELECT count(info.id) FROM `#__js_auto_seller_contact_info` AS info
            WHERE info.uid = ".$uid;
            $db->setQuery($query);
            $sellerinfo=$db->loadResult();
            if($sellerinfo > 0) return FALSE;
            else return TRUE;

        }else{
            return TRUE;
        }
    }
    function storeVehicleOptions($data,$vehicleid) {
        if($vehicleid)if(!is_numeric($vehicleid)) return false;
        $row = &$this->getTable('vehicleoptions');
        $data['id'] = $data['vehicleoptionid'];
        $data['vehicleid'] = $vehicleid;
        if (!$row->bind($data))
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            return false;
        }
        if (!$row->check())
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            return false;
        }
        if (!$row->store())
        {
            $this->setError($this->_db->getErrorMsg());
            echo $this->_db->getErrorMsg();
            return false;
        }
        return true;
    }
    function checkMakeDefaultImage($data){
        $vehicleid=$data['vehicleid'];
		if($vehicleid)if(!is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
            $query = "SELECT count(id) FROM `#__js_auto_vehicleimages`
            WHERE vehicleid = ".$vehicleid." AND isdefault=1";
            $db->setQuery($query);
            $isdefault=$db->loadResult();
            if($isdefault > 0) return TRUE;
            else {
                $query = "SELECT vehicleimages.* FROM `#__js_auto_vehicleimages` AS vehicleimages
                WHERE vehicleimages.vehicleid = ".$vehicleid;
                $db->setQuery($query);
                $vehicleimage=$db->loadObject();
                if($vehicleimage){
                    $query = "UPDATE `#__js_auto_vehicleimages` AS vehimg SET vehimg.isdefault= 1
                        WHERE vehimg.id =".$vehicleimage->id;
                    $db->setQuery( $query );
                    if (!$db->query()) {
                            return false;
                    }
                }else return false;
            return TRUE;
            }
    }
    function &makeDefaultVehicleImage($vehid, $imgid,$for){
		if($vehid)if(!is_numeric($vehid)) return false;
	        $db = &$this->getDBO();
	    $query = "SELECT count(id) FROM `#__js_auto_vehicleimages`
	    WHERE vehicleid = ".$vehid." AND isdefault=1";
	    $db->setQuery($query);
	    $isdefault=$db->loadResult();

	    if($isdefault > 0){
		$makedefaultimage=0;
            }else {
		$makedefaultimage=1;
	    }
	if($makedefaultimage==1 OR $for==2){

		$query = "SELECT vehimg.filename AS filename 
		FROM `#__js_auto_vehicleimages` AS vehimg 
		WHERE vehimg.vehicleid =".$vehid." AND vehimg.isdefault = 1";
		$db->setQuery($query);
		$fileexist = $db->loadObject();
		if($fileexist){
			$configs=$this->getConfiginArray('default');
			$datadirectory = $configs['data_directory'];
			$vehicleid=$vehid;
			$file_name=$fileexist->filename;
			$path =JPATH_BASE.'/'.$datadirectory;
			$path= $path . '/data';
			$path= $path . '/vehicle';
			$userpath= $path . '/vehicle_'.$vehid;
			$userpath= $userpath. '/images';
			$userpath= $userpath. '/thumbs';
			$exmedium= $userpath.'/' .'jsautoz_exm_'.$file_name; // for exmedium thumb delete
			unlink($exmedium);//delete ex medium image in the direetory
			$slideuserpath= $userpath.'/' .'jsautoz_slideshow_'.$file_name; // for large thumb delete
			unlink($slideuserpath);//delete slideshow image in the direetory
		}
		$query = "UPDATE `#__js_auto_vehicleimages` AS vehimg SET vehimg.isdefault= 0 WHERE vehimg.vehicleid =".$vehid;
		$db->setQuery( $query );
		if (!$db->query()) {
		        return false;
		}
		$row = &$this->getTable('vehicleimages');
		$row->id=$imgid;
		$row->isdefault= 1;
		if (!$row->store())
		{
		        $this->setError($this->_db->getErrorMsg());
		        //echo $this->_db->getErrorMsg();
		        return false;
		}

		$query = "SELECT * FROM `#__js_auto_vehicleimages` AS vehimg WHERE vehimg.id =".$imgid;
		$db->setQuery($query);
		$data = $db->loadObject();
                $returnFrontMessage = $this->getOrCreateThumbnail($vehid,$data->filename, $return="",1, 0, 0,1, 0, 1);
                    if ($returnFrontMessage == 'Success') {
			return TRUE;
		    }	
	}
    }

    function storeVehicleImages($data) {
        $row = &$this->getTable('vehicleimages');
        $row->created=date('Y-m-d H:i:s');
        $total=count($_FILES['filename']['name']);
          for($i = 0; $i < $total; $i++){
              if($_FILES['filename']['name'][$i] !== ''){
                  //echo  $_FILES['filename']['name'];exit;
                    if (!$row->bind($data))	{
                            $this->setError($this->_db->getErrorMsg());
                            return false;
                    }
                    if($_FILES['filename']['size'][$i] > 0){ // logo
                        //$file_name = $_FILES['uploadFile'. $i]['name'];
                        //$data['filename'] = $_FILES['filename']['name'][$i]; // file name
                        $row->filename = $_FILES['filename']['name'][$i]; // file name
                    }
                    $row->id = null;
                    if (!$row->check())	{
                            $this->setError($this->_db->getErrorMsg());

                            return false;
                    }
                    if (!$row->store())	{
                            $this->setError($this->_db->getErrorMsg());
                                            return false;
                    }
                    $imageid = $row->id;
                            //echo 'storeVehicleImages'.$imageid;
                    if($_FILES['filename']['size'][$i] > 0){ // logo
                            $returnvalue = $this->uploadVehicleImage($i,$imageid, $data['vehicleid'], 0);
                    }
              }

          }
            
        return $returnvalue;

    }
	function updateAddExpiry($id, $val, $fild ){
		if (is_numeric($val) == false) return false;
		$config = $this->getConfiginArray('default');
		$value = $config[$fild];
		if ($value != $id ) return 3;
		$db =& JFactory::getDBO();
		$query = "UPDATE `#__js_auto_adexpiries` SET advalue = ".$val;
		$db->setQuery( $query );
		if (!$db->query()) {
			return false;
		}
		return true;	
	}
    function uploadVehicleImage($i,$id, $vehicleid, $isdeletefile) {
        if (is_numeric($id) == false) return false;
        $db =& JFactory::getDBO();
        $configs=$this->getConfiginArray('default');
        $datadirectory = $configs['data_directory'];

        $path =JPATH_BASE.'/'.$datadirectory;
        if (!file_exists($path)){ // create user directory
            //mkdir($path, 0755);
            $this->makeDir($path);
        }
        $isupload = false;
        $path= $path . '/data';
        if (!file_exists($path)){ // create user directory
            //mkdir($path, 0755);
            $this->makeDir($path);
        }
        $path= $path . '/vehicle';
        if (!file_exists($path)){ // create user directory
            //mkdir($path, 0755);
			$this->makeDir($path);
        }
        if($_FILES['filename']['size'][$i] > 0){
            $file_name = $_FILES['filename']['name'][$i]; // file name
            $file_tmp = $_FILES['filename']['tmp_name'][$i]; // actual location
            $ext = $this->getExtension($file_name);
            $ext = strtolower($ext);
            if (($ext != "gif") && ($ext != "jpg") && ($ext != "jpeg") && ($ext != "png"))
            return 6; //file type mistmathc
            $userpath= $path . '/vehicle_'.$vehicleid;
            if (!file_exists($userpath)){ // create user directory
                //mkdir($userpath, 0755);
                $this->makeDir($userpath);
            }
            $userpath= $userpath. '/images';
            if (!file_exists($userpath)){ // create logo directory
                //mkdir($userpath, 0755);
                $this->makeDir($userpath);
            }
            $isupload = true;
        }

        if ($isupload){
        //				$files = glob($userpath.'/*.*');
        //					array_map('unlink', $files);  //delete all file in directory
            move_uploaded_file($file_tmp, $userpath.'/' . $file_name);
            $userpath= $userpath. '/thumbs';
            if (!file_exists($userpath)){ // create logo directory
                //mkdir($userpath, 0755);
                $this->makeDir($userpath);
            }
                    //Create thumbnail small, medium, large
                    $returnFrontMessage = $this->getOrCreateThumbnail($vehicleid,$file_name, $return="",0, 1, 1,0, 1, 1);

                    if ($returnFrontMessage == 'Success') {
						$data=array();
						$data[0]=$vehicleid;		
						$data[1]=$id;		
						$data[2]=true;		
						return $data;
                    } else {
                            return false;
                    }

            return 1;
        }else { // DELETE FILES
            if ($isdeletefile == 1){
                $userpath= $path . '/comp_'.$id . '/logo';
                //$files = glob($userpath.'/*.*');
                array_map('unlink', $files); // delete all file in the direcoty
            }
            return 1;
        }
    }
	function makeDir($path){
		if (!file_exists($path)){ // create logo directory
			mkdir($path, 0755);
			$ourFileName = $path.'/index.html';
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fclose($ourFileHandle);
		}
	}

	/*
	 * Main Thumbnail creating function
	 *
	 * file 		= abc.jpg
	 * fileNo	= folder/abc.jpg
	 * if small, medium, large = 1, create small, medium, large thumbnail
	 */
	function getOrCreateThumbnail($vehicleid,$fileNo, $refreshUrl,$slideshow = 0, $small = 0, $medium = 0,$exmedium=0, $large = 0, $frontUpload = 0) {
		if($vehicleid)if(!is_numeric($vehicleid)) return false;
		if ($frontUpload) {
			$returnFrontMessage = 'Success';
		}

		$onlyThumbnailInfo = 0;
		if ($slideshow ==0 && $small == 0 && $medium == 0 && $exmedium == 0 && $large == 0 ) {
			$onlyThumbnailInfo = 1;
		}
                $file['name']= $fileNo;
		$file['name_no']= ltrim($fileNo, '/');
		$file['name_original_abs']= $this->getFileOriginal($fileNo,$vehicleid);
		$file['name_original_rel']= $this->getFileOriginal($fileNo,$vehicleid, 1);
		$file['path_without_file_name_original']= str_replace($file['name'], '', $file['name_original_abs']);
		$file['path_without_file_name_thumb']	= str_replace($file['name'], '', $file['name_original_abs'] . 'thumbs' );
		//echo $file['path_without_file_name_thumb'];exit;
		$ext = strtolower(JFile::getExt($file['name']));
		switch ($ext) {
			case 'jpg':
			case 'png':
			case 'gif':
			case 'jpeg':

			//Get File thumbnails name
			$thumbNameSdSh= $this->getThumbnailName ($fileNo,$vehicleid, 'slideshow');

			$thumbNameS= $this->getThumbnailName ($fileNo,$vehicleid, 'small');


                        $thumbNameM = $this->getThumbnailName ($fileNo,$vehicleid, 'medium');

                        $thumbNameExM = $this->getThumbnailName ($fileNo,$vehicleid, 'exmedium');

			$thumbNameL= $this->getThumbnailName ($fileNo,$vehicleid, 'large');

			// Don't create thumbnails from watermarks...
			$dontCreateThumb	= $this->dontCreateThumb($file['name']);
			if ($dontCreateThumb == 1) {
				$onlyThumbnailInfo = 1; // WE USE $onlyThumbnailInfo FOR NOT CREATE A THUMBNAIL CLAUSE
			}

			// We want only information from the pictures OR
			if ( $onlyThumbnailInfo == 0 ) {

				$thumbInfo = $fileNo;
				// Folder must exist

				//if (JFolder::exists($file['path_without_file_name_thumb'])) {
				if(is_dir($file['path_without_file_name_thumb'])){

					$errorMsgS = $errorMsgM = $errorMsgL = '';
					//Small thumbnail
					if ($slideshow == 1) {
						$this->createFileThumbnail($file['name_original_abs'], $thumbNameSdSh->abs, 'slideshow', $frontUpload, $errorMsgS);

					} else {
						$errorMsgS = 'ThumbnailExists';// in case we only need medium or large, because of if clause bellow
					}
					//Small thumbnail
					if ($small == 1) {
						$this->createFileThumbnail($file['name_original_abs'], $thumbNameS->abs, 'small', $frontUpload, $errorMsgS);

					} else {
						$errorMsgS = 'ThumbnailExists';// in case we only need medium or large, because of if clause bellow
					}

					//Medium thumbnail
					if ($medium == 1) {
						$this->createFileThumbnail($file['name_original_abs'], $thumbNameM->abs, 'medium', $frontUpload, $errorMsgM);
					} else {
						$errorMsgM = 'ThumbnailExists'; // in case we only need small or large, because of if clause bellow
					}

					//ExMedium thumbnail
					if ($exmedium == 1) {
						$this->createFileThumbnail($file['name_original_abs'], $thumbNameExM->abs, 'exmedium', $frontUpload, $errorMsgM);
					} else {
						$errorMsgM = 'ThumbnailExists'; // in case we only need small or large, because of if clause bellow
					}
					//Large thumbnail
					if ($large == 1) {
						$this->createFileThumbnail($file['name_original_abs'], $thumbNameL->abs, 'large', $frontUpload, $errorMsgL);
					} else {
						$errorMsgL = 'ThumbnailExists'; // in case we only need small or medium, because of if clause bellow
					}


					if ($frontUpload == 1) {
						return $returnFrontMessage;
					}
				}
			}

			break;
		}

		return $file;
	}


	function getFileOriginal($filename, $vehicleid, $rel = 0) {
		if($vehicleid)if(!is_numeric($vehicleid)) return false;
                $db =& JFactory::getDBO();
                $configs=$this->getConfiginArray('default');
                $datadirectory = $configs['data_directory'];
                $path =JPATH_BASE.'/'.$datadirectory;
                $path= $path . '/data';
                $path= $path . '/vehicle';
                $userpath= $path . '/vehicle_'.$vehicleid;
                $userpath= $userpath. '/images';
                $userpath= $userpath.'/' . $filename;
		if ($rel == 1) {
			return str_replace('//', '/', $userpath);
		} else {
			return JPath::clean($userpath);
		}
	}




	function getThumbnailName($filename,$vehicleid, $size) {
			if($vehicleid)if(!is_numeric($vehicleid)) return false;
                $db =& JFactory::getDBO();
                $configs=$this->getConfiginArray('default');
                $datadirectory = $configs['data_directory'];
                $path =JPATH_BASE.'/'.$datadirectory;
                $path= $path . '/data';
                $path= $path . '/vehicle';
                $userpath= $path . '/vehicle_'.$vehicleid;
                $userpath= $userpath. '/images';
                $userpath= $userpath.'/' . $filename;
		$title 		= $filename ;
		
		$thumbName	= new JObject();

		switch ($size) {
			case 'slideshow':
			$fileNameThumb 	= 'jsautoz_slideshow_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/'.$fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;
			case 'large':
			$fileNameThumb 	= 'jsautoz_l_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' .$fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;

			case 'medium':
			$fileNameThumb 	= 'jsautoz_m_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' .$fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;
			case 'exmedium':
			$fileNameThumb 	= 'jsautoz_exm_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' .$fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;

			default:
			case 'small':
			$fileNameThumb 	= 'jsautoz_s_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' .$fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;
		}

		$thumbName->rel = str_replace('//', '/', $thumbName->rel);

		return $thumbName;
	}

	function dontCreateThumb ($filename) {
		$dontCreateThumb		= false;
		$dontCreateThumbArray	= array ('watermark-large.png', 'watermark-medium.png');
		foreach ($dontCreateThumbArray as $key => $value) {
			if (strtolower($filename) == strtolower($value)) {
				return true;
			}
		}
		return false;
	}

	function createFileThumbnail($fileOriginal, $fileThumbnail, $size, $frontUpload=0, &$errorMsg) {

		$params = JComponentHelper::getParams('com_jsautoz');
		$enable_thumb_creation = 1;
		$watermarkParams['create'] =  0 ;// Watermark
		$watermarkParams['x'] =  'center' ;
		$watermarkParams['y'] = 'middle' ;
		$crop_thumbnail =  5;// Crop or not
		$crop = 1;


		// disable or enable the thumbnail creation

		if ($enable_thumb_creation == 1) {

			$fileResize	= $this->getThumbnailResize($size);

			if (JFile::exists($fileOriginal)) {
				//file doesn't exist, create thumbnail
				if (!JFile::exists($fileThumbnail)) {
					$errorMsg = 'Error4';
					//Don't do thumbnail if the file is smaller (width, height) than the possible thumbnail
					list($width, $height) = GetImageSize($fileOriginal);
					//larger
					if ($width > $fileResize['width'] || $height > $fileResize['height']) {

						$imageMagic = $this->imageMagic($fileOriginal, $fileThumbnail, $fileResize['width'] , $fileResize['height'], $crop, null, $watermarkParams, $frontUpload, $errorMsg);

					} else {
						$imageMagic = $this->imageMagic($fileOriginal, $fileThumbnail, $width , $height, $crop, null, $watermarkParams, $frontUpload, $errorMsg);
					}
					if ($imageMagic) {
						return true;
					} else {
						return false;// error Msg will be taken from imageMagic
					}
				} else {
					$errorMsg = 'ThumbnailExists';//thumbnail exists
					return false;
				}
			} else {
				$errorMsg = 'ErrorFileOriginalNotExists';
				return false;
			}
			$errorMsg = 'Error3';
			return false;
		} else {
			$errorMsg = 'DisabledThumbCreation'; // User have disabled the thumbanil creation e.g. because of error
			return false;
		}

        }
	function getThumbnailResize($size = 'all') {

		// Get width and height from default settings
		$params = JComponentHelper::getParams('com_jsautoz') ;
		//$module = &JModuleHelper::getModule('mod_jsautozslideshow');
		//$moduleParams = new JParameter($module->params);
		//$slidewidth = $moduleParams->get('slidewidth'); 
		//$slideheight = $moduleParams->get('slideheight'); 
		$slidewidth=700;
		$slideheight=500;

		$large_image_width = 640 ;
		$large_image_height = 480;
		$medium_image_width = 100;
		$medium_image_height = 100;
		$exmedium_image_width = 100;
		$exmedium_image_height = 100;
		$small_image_width =  50;
		$small_image_height =  50;

		switch ($size) {
			case 'slideshow':
			$fileResize['width']	=	$slidewidth;
			$fileResize['height']	=	$slideheight;
			break;
			case 'large':
			$fileResize['width']	=	$large_image_width;
			$fileResize['height']	=	$large_image_height;
			break;

			case 'medium':
			$fileResize['width']	=	$medium_image_width;
			$fileResize['height']	=	$medium_image_height;
			break;
			case 'exmedium':
			$fileResize['width']	=	$exmedium_image_width;
			$fileResize['height']	=	$exmedium_image_height;
			break;

			case 'small':
			$fileResize['width']	=	$small_image_width;
			$fileResize['height']	=	$small_image_height;
			break;

		}
		return $fileResize;
	}


	function imageMagic($fileIn, $fileOut = null, $width = null, $height = null, $crop = null, $typeOut = null, $watermarkParams = array(), $frontUpload = 0, &$errorMsg) {


		$params = JComponentHelper::getParams('com_jsautoz') ;
		$jfile_thumbs	= 1 ;
		$jpeg_quality	=  85 ;
		$jpeg_quality	= $this->getJpegQuality($jpeg_quality);

		$fileWatermark = '';


		// Memory - - - - - - - -
		$memory = 8;
		$memoryLimitChanged = 0;
		$memory = (int)ini_get( 'memory_limit' );
		if ($memory == 0) {
			$memory = 8;
		}
		// - - - - - - - - - - -

		if ($fileIn !== '' && JFile::exists($fileIn)) {

			// array of width, height, IMAGETYPE, "height=x width=x" (string)
	        list($w, $h, $type) = GetImageSize($fileIn);

			if ($w > 0 && $h > 0) {// we got the info from GetImageSize

		        // size of the image
		        if ($width == null || $width == 0) { // no width added
		            $width = $w;
		        }
				else if ($height == null || $height == 0) { // no height, adding the same as width
		            $height = $width;
		        }
				if ($height == null || $height == 0) { // no height, no width
		            $height = $h;
		        }

		        // miniaturizing
		        if (!$crop) { // new size - nw, nh (new width/height)
                            /*
		            $scale = (($width / $w) < ($height / $h)) ? ($width / $w) : ($height / $h); // smaller rate
                            echo '<br>scale'.$scale;
                            die();
		            $src = array(0,0, $w, $h);
		            $dst = array(0,0, floor($w*$scale), floor($h*$scale));
                             * */

		        }
		        else { // will be cropped
		            $scale = (($width / $w) > ($height / $h)) ? ($width / $w) : ($height / $h); // greater rate
		            $newW = $width/$scale;    // check the size of in file
		            $newH = $height/$scale;

		            // which side is larger (rounding error)
		            if (($w - $newW) > ($h - $newH)) {
		                $src = array(floor(($w - $newW)/2), 0, floor($newW), $h);
		            }
		            else {
		                $src = array(0, floor(($h - $newH)/2), $w, floor($newH));
		            }

		            $dst = array(0,0, floor($width), floor($height));
		        }

				// Watermark - - - - - - - - - - -
				$fileWatermark = 'JS Autoz';


			}
	        switch($type) {
	            case IMAGETYPE_JPEG:
					if (!function_exists('ImageCreateFromJPEG')) {
						$errorMsg = 'ErrorNoJPGFunction';
						return false;
					}
					$image1 = ImageCreateFromJPEG($fileIn);
					break;
	            case IMAGETYPE_PNG :
					if (!function_exists('ImageCreateFromPNG')) {
						$errorMsg = 'ErrorNoPNGFunction';
						return false;
					}
					$image1 = ImageCreateFromPNG($fileIn);
					break;
	            case IMAGETYPE_GIF :
					if (!function_exists('ImageCreateFromGIF')) {
						$errorMsg = 'ErrorNoGIFFunction';
						return false;
					}
					$image1 = ImageCreateFromGIF($fileIn);
					break;
	            case IMAGETYPE_WBMP:
					if (!function_exists('ImageCreateFromWBMP')) {
						$errorMsg = 'ErrorNoWBMPFunction';
						return false;
					}
					$image1 = ImageCreateFromWBMP($fileIn);
					break;
	            default:
					$errorMsg = 'ErrorNotSupportedImage';
					return false;
					break;
	        }

			if ($image1) {

				$image2 = @ImageCreateTruecolor($dst[2], $dst[3]);
				if (!$image2) {
					$errorMsg = 'ErrorNoImageCreateTruecolor';
					return false;
				}

				switch($type) {
					case IMAGETYPE_PNG:
						//imagealphablending($image1, false);
						@imagealphablending($image2, false);
						//imagesavealpha($image1, true);
						@imagesavealpha($image2, true);
					break;
				}

				ImageCopyResampled($image2, $image1, $dst[0],$dst[1], $src[0],$src[1], $dst[2],$dst[3], $src[2],$src[3]);

				// Watermark - - - - - -
				//$fileWatermark =JPATH_BASE.'/components/com_jsautoz/images/default_jsautoz50.png';
				$fileWatermark ='';
				if ($fileWatermark != '') {
					$watermarkimg = imagecreatefrompng($fileWatermark);

					$marge_right = 10;
					$marge_bottom = 10;
					$sx = imagesx($watermarkimg);
					$sy = imagesy($watermarkimg);

					imagecopy($image2, $watermarkimg, imagesx($image2) - $sx - $marge_right, imagesy($image2) - $sy - $marge_bottom, 0, 0, imagesx($watermarkimg), imagesy($watermarkimg));

					//ImageCopy($image2, $waterImage1, $locationX, $locationY, 0, 0, $wW, $hW);
				}
				// End Watermark - - - -


	            // Display the Image - not used
	            if ($fileOut == null) {
	                header("Content-type: ". image_type_to_mime_type($typeOut));
	            }

				// Create the file
		        if ($typeOut == null) {    // no bitmap
		            $typeOut = ($type == IMAGETYPE_WBMP) ? IMAGETYPE_PNG : $type;
		        }

				switch($typeOut) {
		            case IMAGETYPE_JPEG:
						if (!function_exists('ImageJPEG')) {
							$errorMsg = 'ErrorNoJPGFunction';
							return false;
						}

						if ($jfile_thumbs == 1) {
							ob_start();
							if (!@ImageJPEG($image2, NULL, $jpeg_quality)) {
								ob_end_clean();
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
							$imgJPEGToWrite = ob_get_contents();
							ob_end_clean();

							if(!JFile::write( $fileOut, $imgJPEGToWrite)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						} else {
							if (!@ImageJPEG($image2, $fileOut, $jpeg_quality)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						}
					break;

					case IMAGETYPE_PNG :
						if (!function_exists('ImagePNG')) {
							$errorMsg = 'ErrorNoPNGFunction';
							return false;
						}

						if ($jfile_thumbs == 1) {
							ob_start();
							if (!@ImagePNG($image2, NULL)) {
								ob_end_clean();
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
							$imgPNGToWrite = ob_get_contents();
							ob_end_clean();

							if(!JFile::write( $fileOut, $imgPNGToWrite)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						} else {
							if (!@ImagePNG($image2, $fileOut)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						}
					break;

					case IMAGETYPE_GIF :
						if (!function_exists('ImageGIF')) {
							$errorMsg = 'ErrorNoGIFFunction';
							return false;
						}

						if ($jfile_thumbs == 1) {
							ob_start();
							if (!@ImageGIF($image2, NULL)) {
								ob_end_clean();
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
							$imgGIFToWrite = ob_get_contents();
							ob_end_clean();

							if(!JFile::write( $fileOut, $imgGIFToWrite)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						} else {
							if (!@ImageGIF($image2, $fileOut)) {
								$errorMsg = 'ErrorWriteFile';
								return false;
							}
						}
					break;

					default:
						$errorMsg = 'ErrorNotSupportedImage';
						return false;
						break;
				}

				// free memory
				ImageDestroy($image1);
	            ImageDestroy($image2);
				if (isset($waterImage1)) {
					ImageDestroy($waterImage1);
				}

				if ($memoryLimitChanged == 1) {
					$memoryString = $memory . 'M';
					ini_set('memory_limit', $memoryString);
				}
	             $errorMsg = ''; // Success
				 return true;
	        } else {
				$errorMsg = 'Error1';
				return false;
			}
			if ($memoryLimitChanged == 1) {
				$memoryString = $memory . 'M';
				ini_set('memory_limit', $memoryString);
			}
	    }
		$errorMsg = 'Error2';
		return false;

	}


	function getJpegQuality($jpegQuality) {
		if ((int)$jpegQuality < 0) {
			$jpegQuality = 0;
		}
		if ((int)$jpegQuality > 100) {
			$jpegQuality = 100;
		}
		return $jpegQuality;
	}



    function deleteVehicleImage($id) {
		if(!is_numeric($id)) return false;
        if ($id == -1) return false;
        $db =& JFactory::getDBO();
        $query = "SELECT vehicleimages.vehicleid,vehicleimages.filename FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.id = ".$id;
        $db->setQuery($query);
        $vehicleimage=$db->loadObject();
        $configs=$this->getConfiginArray('default');
        $datadirectory = $configs['data_directory'];
        $vehicleid=$vehicleimage->vehicleid;
        $file_name=$vehicleimage->filename;
        $path =JPATH_BASE.'/'.$datadirectory;
        $path= $path . '/data';
        $path= $path . '/vehicle';
        $userpath= $path . '/vehicle_'.$vehicleid;
        $userpath= $userpath. '/images';
        $imageuserpath= $userpath.'/' . $file_name;

        unlink($imageuserpath);//delete single image in the direetory
        $userpath= $userpath. '/thumbs';
        $suserpath= $userpath.'/' .'jsautoz_s_'.$file_name; // for small thumb delete

        unlink($suserpath);//delete single image in the direetory
        $muserpath= $userpath.'/' .'jsautoz_m_'.$file_name; // for medium thumb delete

        unlink($muserpath);//delete single image in the direetory
        $exmuserpath= $userpath.'/' .'jsautoz_exm_'.$file_name; // for exmedium thumb delete

        unlink($exmuserpath);//delete single image in the direetory
        $luserpath= $userpath.'/' .'jsautoz_l_'.$file_name; // for large thumb delete

        unlink($luserpath);//delete large image in the direetory
        $slideuserpath= $userpath.'/' .'jsautoz_slideshow_'.$file_name; // for large thumb delete

        unlink($slideuserpath);//delete slideshow image in the direetory
        return $vehicleimage;

    }

    function &getVehicleImages($vehicleid) {
		if(!is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.* FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid;
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }
    function &getVehicleImagesTotal($vehicleid) {
		if($vehicleid)if(!is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT count(vehicleimages.id) AS totalimage
            FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid;

        $db->setQuery($query);
        $totalvehicleimages=$db->loadResult();
        return $totalvehicleimages;;
    }
	 function getImageData($imagefolder, $imageurl, $label = false) {
		if ($isremote = is_remote_path($imageurl)) {
			$imagefile = basename($imageurl);
		} else {
			$imagefile = $imageurl;
		}
		// get image thumbnail URL and parameters
		$params = new SIGPlusPreviewParameters($this->curparams);
                $previewurl = $this->imageservices->getPreviewUrl($imagefolder, $imagefile, $params);
		// get lightbox and slider
		$engineservices =& SIGPlusEngineServices::instance();
		$lightbox = $engineservices->getLightboxEngine($this->curparams->lightbox);  // get selected lightbox engine if any or use default
                $slider = $engineservices->getSliderEngine($this->curparams->slider);        // get selected slider engine if any, or use default
		// get target URL for preview image
		$url = false;
		if ($lightbox) {  // display lightbox pop-up window when thumbnail is clicked
			if (!$isremote) {
				if ($this->curparams->watermark) {
					$url = $this->imageservices->getWatermarkedUrl($imagefolder, $imagefile);
				} else {
					$url = $this->imageservices->getImageUrl($imagefolder, $imagefile, $this->curparams->authentication);
				}
			} else {
				$url = $imageurl;
			}
			$anchor_attrs = array('href' => $url);
		} elseif ($summary && ($anchor = get_anchor_attrs($summary)) !== false) {  // check if there is a hyperlink in the description and use it as target link
			$anchor_attrs = $anchor;
		}
		// get preview image parameters
		$img_attrs = array('preview' => $previewurl);
                if ($slider && $this->curparams->progressive && $thumburl != $previewurl) {
			$img_attrs['thumb'] = $thumburl;
                }

		$imagedata = array(
			'image' => $img_attrs);
                if (isset($anchor_attrs)) {
			$imagedata['anchor'] = $anchor_attrs;
		}
		if ($metadata) {
			$imagedata['metadata'] = $metadata;
		}

                return $imagedata;

	}

    function &getFieldsOrdering($fieldfor) {
		if(!is_numeric($fieldfor)) return false;
        $db = &$this->getDBO();
        $query =  "SELECT  * FROM `#__js_auto_fieldordering`
                        WHERE published = 1 AND fieldfor =  ". $fieldfor." ORDER BY ordering";
        $db->setQuery($query);
        $fields = $db->loadObjectList();
        return $fields;
    }
    function &listModels($val,$req) {
        $db = &$this->getDBO();
        if($val) if (is_numeric($val) == false) return false;
        $query  = "SELECT id, title FROM `#__js_auto_models`  WHERE status = 1 AND makeid = ".$val." ORDER BY title ASC";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        if ($req == 1)$required == ' required';
        if (empty($result))	{
            $return_value = "<input class='inputbox".$required."' type='text' name='modelid' size='40' maxlength='100'  />";
        }else {
                                $return_value = "<select name='modelid' class='inputbox".$required."' >\n";
                                $return_value .= "<option value=''>". JText::_('SELECT_MODEL') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->id\" >$row->title</option> \n" ;
                                }
                           $return_value .= "</select>\n";
        }
        return $return_value;
    }
    function &listRegAddressData($data,$val) {
        $db = &$this->getDBO();
        if ($data=='country') {  // country
                $query  = "SELECT code, name FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                        $return_value = "<input class='inputbox' type='text' name='regcountry' id='regcountry' size='40' maxlength='100'  />";
                }else {
                        $return_value = "<select name='regcountry' id='regcountry' class='inputbox' geteregaddressdata=\"dochange('state', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTRY') ."</option>\n";

                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }
        }else if ($data=='state') {  // states
                $query  = "SELECT code, name from `#__js_auto_states`  WHERE enabled = 'Y' AND countrycode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                         $return_value = "<input class='inputbox' type='text' name='regstate' id='regstate' size='40' maxlength='100'  />";
                }else {
                        $return_value = "<select name='regstate' id='regstate' class='inputbox' onChange=\"geteregaddressdata('county', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_STATE') ."</option>\n";
                        foreach($result as $row){
                                           $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                                }
                        $return_value .= "</select>\n";
                }
        }else if ($data=='county') {  // county
                $query  = "SELECT code, name from `#__js_auto_counties` WHERE enabled = 'Y' AND statecode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))
                {
                                $return_value = "<input class='inputbox' type='text' name='regcounty' id='regcounty' size='40' maxlength='100'  />";
                }else{
                        $return_value = "<select name='regcounty' id='regcounty' class='inputbox' onChange=\"geteregaddressdata('city', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTY') ."</option>\n";
                        foreach($result as $row){
                                        $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                                        }
                        $return_value .= "</select>\n";
                }
        } else if ($data=='city') { // city
                $query  = "SELECT code, name from `#__js_auto_cities` WHERE enabled = 'Y' AND countycode= '$val' ORDER BY 'name'";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                //if (mysql_num_rows($result)== 0)
                if (empty($result))
                {
                                $return_value = "<input class='inputbox' type='text' name='regcity' id='regcity' size='40' maxlength='100'  />";
                }else
                {
                        $return_value = "<select name='regcity' id='regcity' class='inputbox' onChange=\"geteregaddressdata('zipcode', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_CITY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }

        }
        return $return_value;
    }
    function &listLocAddressData($data, $val) {
        $db = &$this->getDBO();
        if ($data=='country') {  // country
                $query  = "SELECT code, name FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                        $return_value = "<input class='inputbox' type='text' name='loccountry' id='loccountry' size='40' maxlength='100'  />";
                        }else {
                                $return_value = "<select name='loccountry' id='loccountry' class='inputbox' getlocaddressdata=\"dochange('state', this.value)\">\n";
                                $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTRY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                         }
                        $return_value .= "</select>\n";
                        }
        }else if ($data=='state') {  // states
                $query  = "SELECT code, name from `#__js_auto_states` WHERE enabled = 'Y' AND countrycode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                                $return_value = "<input class='inputbox' type='text' name='locstate' id='locstate' size='40' maxlength='100'  />";
                }else {
                        $return_value = "<select name='locstate' id='locstate' class='inputbox' onChange=\"getlocaddressdata('county', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_STATE') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }
        }else if ($data=='county') {  // county
                $query  = "SELECT code, name from `#__js_auto_counties` WHERE enabled = 'Y' AND statecode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();

                if (empty($result))
                {
                                $return_value = "<input class='inputbox' type='text' name='loccounty' id='loccounty' size='40' maxlength='100'  />";
                }else
                {
                                $return_value = "<select name='loccounty' id='loccounty' class='inputbox' onChange=\"getlocaddressdata('city', this.value)\">\n";
                                $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTY') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                                }
                                $return_value .= "</select>\n";
                }
        } else if ($data=='city') { // city
                $query  = "SELECT code, name from `#__js_auto_cities` WHERE enabled = 'Y' AND countycode= '$val' ORDER BY 'name'";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                //if (mysql_num_rows($result)== 0)
                if (empty($result))
                {
                        $return_value = "<input class='inputbox' type='text' name='loccity' id='loccity' size='40' maxlength='100'  />";
                }else
                {
                        $return_value = "<select name='loccity' id='loccity' class='inputbox' onChange=\"getlocaddressdata('zip', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_CITY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }

        } else if ($data=='zip') { // zip
                $query  = "SELECT id,code from `#__js_auto_zips` WHERE  citycode= '$val' ORDER BY 'citycode'";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                //if (mysql_num_rows($result)== 0)
                if (empty($result))
                {
                        $return_value = "<input class='inputbox' type='text' name='loczip' id='loczip' size='40' maxlength='100'  />";
                }else
                {
                        $return_value = "<select name='loczip' id='loczip' class='inputbox' onChange=\"getlocaddressdata('', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_ZIP') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->id\" >$row->code</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }
        }
        return $return_value;
    }
    function &listFilterAddressData($data, $val) {
        $db = &$this->getDBO();
        if ($data=='country') {  // country
                $query  = "SELECT code, name FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                        $return_value = "<input class='inputbox' type='text' name='country' id='country' size='10' maxlength='100'  />";
                        }else {
                                $return_value = "<select name='country' id='country' class='inputbox' getfilteraddressdata=\"dochange('state', this.value)\">\n";
                                $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTRY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                         }
                        $return_value .= "</select>\n";
                        }
        }else if ($data=='state') {  // states
                $query  = "SELECT code, name from `#__js_auto_states` WHERE enabled = 'Y' AND countrycode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                    $return_value = "<input class='inputbox' type='text' name='state' id='state' size='10' maxlength='100' style='color:#808080;' value='State' onfocus='if(this.value == \"State\"){this.value = \"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"State\";  }'/>";
                }else {
                        $return_value = "<select name='state' id='state' class='inputbox' onChange=\"getfilteraddressdata('county', this.value)\">\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_STATE') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }
        }else if ($data=='county') {  // county
                $query  = "SELECT code, name from `#__js_auto_counties` WHERE enabled = 'Y' AND statecode= '$val' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();

                if (empty($result))
                {
                                $return_value = "<input class='inputbox' type='text' name='county' id='county' size='10' maxlength='100' onfocus='if(this.value == \"County\"){this.value = \"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"County\";  }'  />";
                }else
                {
                                $return_value = "<select name='county' id='county' class='inputbox' onChange=\"getfilteraddressdata('city', this.value)\">\n";
                                $return_value .= "<option value=''>". JText::_('CHOOSE_COUNTY') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                                }
                                $return_value .= "</select>\n";
                }
        } else if ($data=='city') { // city
                $query  = "SELECT code, name from `#__js_auto_cities` WHERE enabled = 'Y' AND countycode= '$val' ORDER BY 'name'";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                //if (mysql_num_rows($result)== 0)
                if (empty($result))
                {
                        $return_value = "<input class='inputbox' type='text' name='city' id='city' size='10' maxlength='100' onfocus='if(this.value == \"City\"){this.value = \"\";this.style.color=\"black\";};' onblur='if(this.value == \"\") { this.style.color=\"#808080\";this.value=\"City\";  }'  />";
                }else
                {
                        $return_value = "<select name='city' id='city' class='inputbox' >\n";
                        $return_value .= "<option value=''>". JText::_('CHOOSE_CITY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }

        } 
        return $return_value;
    }
    function &getConfig($configfor) {
        $db = &$this->getDBO();
        $query = "SELECT * FROM `#__js_auto_config` WHERE configfor = ".$db->quote($configfor);
        $db->setQuery($query);
        $config = $db->loadObjectList();
        $configs = array();
        foreach($config as $conf)	{
            $configs[$conf->configname] =  $conf->configvalue;
        }
        return $configs;
    }
    function &getConfiginArray($configfor) {
        $db = &$this->getDBO();
        $query = "SELECT * FROM `#__js_auto_config` WHERE configfor = ".$db->quote($configfor);
        $db->setQuery($query);
        $config = $db->loadObjectList();
        $configs = array();
        foreach($config as $conf)	{
            $configs[$conf->configname] =  $conf->configvalue;
        }
        return $configs;
    }
    function getVehiclesType( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_vehicletypes` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        $vehicletypes = array();
        if($title){
            $vehicletypes[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$vehicletypes[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
            
        foreach($rows  as $row)	{
            $vehicletypes[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $vehicletypes;
    }
    function getVehiclesMakes( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_makes` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $makes = array();
        if($title){
                        $makes[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$makes[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
                        
        foreach($rows  as $row)	{
                        $makes[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $makes;
    }

    function getVehiclesModel( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_models` WHERE status = 1  ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }
        $models = array();
        if($title){
                $models[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$models[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
                
        foreach($rows  as $row)	{
                $models[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $models;
    }
    function getVehiclesModelsbyMakeId($makeid, $title ) {
		if(!is_numeric($makeid)) return false;
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_models` WHERE status = 1 AND makeid = ".$makeid." ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        $models = array();
        if($title)
                $models[] =  array('value' => JText::_(''),'text' => $title);
         else       
                $models[] =  array('value' => 0,'text' => JText::_('ALL'));
        foreach($rows  as $row)	{
                $models[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $models;
    }
    function getVehiclesCategory( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_categories` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        $categories = array();
        if($title)
        $categories[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
            $categories[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $categories;
    }
    function getVehiclesModelYear( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_modelyears` WHERE status = 1 ORDER BY title DESC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }
        $modelyears = array();
        if($title){
                        $modelyears[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$modelyears[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
                        
        foreach($rows  as $row)	{
                        $modelyears[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $modelyears;
    }
    function getVehiclesCondition( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_conditions` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        $conditions = array();
        if($title)
                    $conditions [] =  array('value' => JText::_(''),'text' => $title);
        else
                    $conditions [] =  array('value' => 0,'text' => JText::_('SELECT_CONDITION'));
        foreach($rows  as $row)	{
                    $conditions [] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $conditions ;
    }
    function getVehiclesFuelType( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_fueltypes` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $fueltypes= array();
        if($title){
                    $fueltypes[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$fueltypes[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
                    
        foreach($rows  as $row)	{
                    $fueltypes[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $fueltypes;
    }
    function getCurrency( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, symbol,title FROM `#__js_auto_currency` WHERE id != 1 AND status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        $currency= array();
        if($title)
                    $currency[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                    $currency[] =  array('value' => $row->id,	'text' => $row->symbol);
        }
        return $currency;
    }
    function getVehiclesCylinders( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_cylinders` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        $cylinders= array();
        if($title){
                $cylinders[] =  array('value' => JText::_(''),'text' => $title);
	    }else{
			$cylinders[] = array('value' => "0",'text' => JText::_('ALL'));
	     }  
                
        foreach($rows  as $row)	{
                $cylinders[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $cylinders;
    }

    function getVehiclesTransmission( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_transmissions` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $transmissions= array();
        if($title)
                        $transmissions[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                        $transmissions[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $transmissions;
    }
    function getVehiclesAdexpirie( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title,type FROM `#__js_auto_adexpiries`  WHERE id != 1 AND status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }
        $adexpiries= array();
        if($title)
                $adexpiries[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                $adexpiries[] =  array('value' => $row->id,	'text' => $row->title.' '.$row->type);
        }
        return $adexpiries;
    }

    function getMileagesType( $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_mileagetypes` WHERE status = 1 ORDER BY title ASC ";
        //echo $query;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $mileagetypes= array();
        if($title)
                        $mileagetypes[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                        $mileagetypes[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $mileagetypes;
    }
    function getZipCodes($citycode,$title){
        $db =& JFactory::getDBO();
        $query = "SELECT  * FROM `#__js_auto_zips` WHERE enabled = 'Y' AND citycode = '". $citycode ."' ORDER BY code ASC  ";
        //echo $query;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $zipcodes= array();
        if($title)
                        $zipcodes[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                        $zipcodes[] =  array('value' => $row->id,'text' => $row->code);
        }
        return $zipcodes;



    }
    function getCountries( $title ) {
        if ( !$this->_countries ){
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC ";
        //echo '<br>sql '.$query;
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                        echo $db->stderr();
                        return false;
        }
        $this->_countries = $rows;
        }
        $countries = array();
        if($title)
                $countries[] =  array('value' => JText::_(''),'text' => $title);
        else
                $countries[] =  array('value' => 0,'text' => JText::_('CHOOSE_COUNTRY'));

        foreach($this->_countries as $row)	{
                $countries[] =  array('value' => $row->code,'text' => JText::_($row->name));
        }
        return $countries;
    }

    function getStates( $countrycode, $title) {
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM `#__js_auto_states` WHERE enabled = 'Y' AND countrycode = '". $countrycode ."' ORDER BY name ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
        echo $db->stderr();
        return false;
        }
        $states = array();
        if($title)
                $states[] =  array('value' => JText::_(''),'text' => $title);
        else
                $states[] =  array('value' => JText::_(''),	'text' => JText::_('CHOOSE_STATE'));

        foreach($rows as $row)
        {
                $states[] =  array('value' => JText::_($row->code),
                                                'text' => JText::_($row->name));
        }
        return $states;
    }
    function getCounties( $statecode, $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM `#__js_auto_counties` WHERE enabled = 'Y' AND statecode = '". $statecode ."' ORDER BY name ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }
        $counties = array();
        if($title)
                $counties[] =  array('value' => JText::_(''),'text' => $title);
        else
                $counties[] =  array('value' => JText::_(''),	'text' => JText::_('CHOOSE_COUNTY'));

        foreach($rows as $row)
        {
                $counties[] =  array('value' => JText::_($row->code),
                                                'text' => JText::_($row->name));
        }
        return $counties;
    }
    function getCities( $countycode, $title ) {
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM `#__js_auto_cities` WHERE enabled = 'Y' AND countycode = '". $countycode ."' ORDER BY name ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }
        $cities = array();
        if($title)
                $cities[] =  array('value' => JText::_(''),'text' => $title);
        else
                $cities[] =  array('value' => JText::_(''),	'text' => JText::_('CHOOSE_CITY'));

        foreach($rows as $row)
        {
                $cities[] =  array('value' => JText::_($row->code),
                                                'text' => JText::_($row->name));
        }
        return $cities;
    }

    function getExtension($str)
        {
                 $i = strrpos($str,".");
                 if (!$i) { return ""; }
                 $l = strlen($str) - $i;
                 $ext = substr($str,$i+1,$l);
                 return $ext;
        }
						
						
	function &sendMailtoSeller($vtype,$id,$uid,$for)
	{
                $db =& JFactory::getDBO();
				if ((is_numeric($id) == false) || ($id == 0) || ($id == '')) return false;
				if($uid) if ((is_numeric($uid) == false) || ($uid == 0) || ($uid == '')) return false;
				/*if(! isset($this->_config)) $this->getConfig('');
				foreach ($this->_config as $conf){
						if ($conf->configname == 'currency') $currency = $conf->configvalue;
				}*/
                $emailconfig = $this->getConfiginArray('email');
                $reviewSeller = $emailconfig['vehicle_review_seller'];
                switch($for){
                    case 1: // new Vehicle review
                        $templatefor = 'seller-review'; $issendemail = $reviewSeller; break;
                }
                if ($issendemail == 1){
                    $query = "SELECT template.* FROM `#__js_auto_emailtemplates` AS template	WHERE template.templatefor = ".$db->Quote($templatefor);
                    $db->setQuery( $query );
                    //echo '<br>sql '.$query;
                    $template = $db->loadObject();
                    $msgSubject = $template->subject;
                    $msgBody = $template->body;

                    switch($for){
                        case 1: // new vehicle review
                        
				$vehiclequery = "SELECT vehicles.price,vehicles.created,
				vehicles.id,vehicles.title,vehicles.makeid,vehicles.modelid,
				vehicles.exteriorcolor,vehicles.enginecapacity,
				vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
				country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
				makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
				conditions.title AS conditiontitle,info.name AS sellername,info.cell AS sellercell,info.phone AS sellerphone,info.email AS selleremail
				FROM `#__js_auto_vehicles` AS vehicles
				JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.uid =info.uid
				LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
				LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
				LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
				LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
				LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
				LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
				LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
				LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
				WHERE vehicles.id = ".$id." AND vehicles.addexpiryvalue >= CURDATE()";
					//echo '<br>'.$vehiclequery;
					$db->setQuery($vehiclequery);
					$vehicle = $db->loadObject();
				$comma = '';
				$location="";
				if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
				elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
				if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
				elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
				
				if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
				elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
				$location .= $comma.$vehicle->countryname;
				
				if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
				else $vehicletitle=$vehicle->title;

                            $reviewquery = "SELECT review.review, user.name, user.email FROM `#__users` AS user
                                            JOIN `#__js_auto_vehiclerankreview` AS review ON review.uid = user.id
                                            WHERE review.uid = ".$uid."  AND review.vehicleid = ".$id;
                            //echo '<br>sql '.$reviewquery;exit;
                            $db->setQuery( $reviewquery );
                            $review = $db->loadObject();
                            $BuyerEmail=$review->email;
                            $BuyerName=$review->name;
                            $BuyerReview=$review->review;

				$senderName = $emailconfig['mailfromname'];
				$senderEmail = $emailconfig['mailfromaddress'];
				$sellerEmail = $vehicle->selleremail;
                                $reviewLink = JRoute::_(JURI::root().'index.php?option=com_jsautoz&view=buyer&layout=vehicle_reviews&cl=8&vtype='.$vtype.'&id='.$id.'&Itemid=103');

				//$msgSubject = 'New Vehicle Review';
				$msgBody = str_replace('{SELLER_NAME}', $vehicle->sellername, $msgBody);

				$msgBody = str_replace('{BUYER_NAME}', $BuyerName, $msgBody);
				$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
                                //$msgBody.= "<a target='_blank' href=".$reviewLink." >".JText::_("VIEW_REVIEW")."</a>";
				$msgBody = str_replace('{LINK}', " <a target='_blank' href=".$reviewLink." >" . " ".JText::_("VIEW_REVIEW")."</a>", $msgBody);
				$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
				$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
				$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
				$msgBody = str_replace('{LOCATION}', $location, $msgBody);
				$msgBody = str_replace('{REVIEW}', $BuyerReview, $msgBody);

                            break;
                        case 2: // new review
							$vehiclequery = "SELECT vehicles.price,vehicles.created,
							vehicles.id,vehicles.title,vehicles.makeid,vehicles.modelid,
							vehicles.exteriorcolor,vehicles.enginecapacity,
							vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
							country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
							makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
							conditions.title AS conditiontitle,info.name AS sellername,info.cell AS sellercell,info.phone AS sellerphone,info.email AS selleremail
							FROM `#__js_auto_vehicles` AS vehicles
							LEFT JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.uid =info.uid
							LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
							LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
							LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
							LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
							LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
							LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
							LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
							LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
							WHERE vehicles.id = ".$id." AND vehicles.addexpiryvalue >= CURDATE()";
							$db->setQuery($vehiclequery);
							$vehicle = $db->loadObject();
							$comma = '';
							$location="";
							if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
							elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
							if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
							elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
							
							if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
							elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
							$location .= $comma.$vehicle->countryname;
							
							if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
							else $vehicletitle=$vehicle->title;

                            $reviewquery = "SELECT review.review, user.name, user.email FROM `#__users` AS user
                                            JOIN `#__js_auto_vehiclerankreview` AS review ON review.uid = user.id
                                            WHERE review.uid = ".$uid."  AND review.vehicleid = ".$id;
                            //echo '<br>sql '.$reviewquery;exit;
                            $db->setQuery( $reviewquery );
                            $review = $db->loadObject();
                            $BuyerEmail=$review->email;
                            $BuyerName=$review->name;
                            $BuyerReview=$review->review;

							$msgSubject = 'New Vehicle Review';

							$msgBody = str_replace('{BUYER_NAME}', $BuyerName, $msgBody);
							$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
							$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
							$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
							$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
							$msgBody = str_replace('{LOCATION}', $location, $msgBody);
							$msgBody = str_replace('{REVIEW}', $BuyerReview, $msgBody);
                            break;
                    }

                    $message =& JFactory::getMailer();
                    $message->addRecipient($sellerEmail); //to email
                    //echo '<br>sellerEmail'.$sellerEmail;
                    //echo '<br>senderEmail'.$senderEmail;
                    //echo '<br>senderName'.$senderName;
                    //echo '<br> sbj '.$msgSubject;
                    //echo '<br> bd '.$msgBody;exit;
                    $message->setSubject($msgSubject);
                    $siteAddress = JURI::base();
                    $message->setBody($msgBody);
                    $sender = array( $senderEmail, $senderName );
                    $message->setSender($sender);
                    $message->IsHTML(true);
                    $sent = $message->send();
                    return $sent;
               }
               return true;

	}
	function &sendMailtoAdmin($vtype,$id,$uid,$for)
	{
                $db =& JFactory::getDBO();
				if ((is_numeric($id) == false) || ($id == 0) || ($id == '')) return false;
				if($uid) if ((is_numeric($uid) == false) || ($uid == 0) || ($uid == '')) return false;
				/*if(! isset($this->_config)) $this->getConfig('');
				foreach ($this->_config as $conf){
						if ($conf->configname == 'currency') $currency = $conf->configvalue;
				}*/
                $emailconfig = $this->getConfiginArray('email');
                $senderName = $emailconfig['mailfromname'];
                $senderEmail = $emailconfig['mailfromaddress'];
                $adminEmail = $emailconfig['adminemailaddress'];
                $newVehicle = $emailconfig['new_vehicle_admin'];
                $reviewAdmin = $emailconfig['vehicle_review_admin'];
                $packagePurchase = $emailconfig['admin_package_purchase'];
                switch($for){
                    case 1: // new Vehicle
                        $templatefor = 'vehicle-new'; $issendemail = $newVehicle; break;
                    case 2: // Review admin
                        $templatefor = 'new-review'; $issendemail = $reviewAdmin; break;
                    case 3: // new resume
                        $templatefor = 'package-buy'; $issendemail = $packagePurchase; break;
                }
                if ($issendemail == 1){
                    $query = "SELECT template.* FROM `#__js_auto_emailtemplates` AS template WHERE template.templatefor = ".$db->Quote($templatefor);
                    $db->setQuery( $query );
                    //echo '<br>sql '.$query;
                    $template = $db->loadObject();
                    $msgSubject = $template->subject;
                    $msgBody = $template->body;

                    switch($for){
                        case 1: // new vehicle
                        
							$vehiclequery = "SELECT vehicles.price,vehicles.created,
							vehicles.id,vehicles.title,vehicles.makeid,vehicles.modelid,
							vehicles.exteriorcolor,vehicles.enginecapacity,
							vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
							country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
							makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
							conditions.title AS conditiontitle,info.name AS sellername,info.cell AS sellercell,info.phone AS sellerphone,info.email AS selleremail
							FROM `#__js_auto_vehicles` AS vehicles
							JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.uid =info.uid
							LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
							LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
							LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
							LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
							LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
							LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
							LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
							LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
							WHERE vehicles.id = ".$id." AND vehicles.addexpiryvalue >= CURDATE()";
								//echo '<br>'.$vehiclequery;
								$db->setQuery($vehiclequery);
								$vehicle = $db->loadObject();
							$comma = '';
							$location="";
							if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
							elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
							if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
							elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
							
							if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
							elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
							$location .= $comma.$vehicle->countryname;
							
							if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
							else $vehicletitle=$vehicle->title;

							$msgSubject = 'New Vehicle';

							$msgBody = str_replace('{SELLER_NAME}', $vehicle->sellername, $msgBody);
							$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
							$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
							$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
							$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
							$msgBody = str_replace('{LOCATION}', $location, $msgBody);

                            break;
                        case 2: // new review
							$vehiclequery = "SELECT vehicles.price,vehicles.created,
							vehicles.id,vehicles.title,vehicles.makeid,vehicles.modelid,
							vehicles.exteriorcolor,vehicles.enginecapacity,
							vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
							country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
							makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
							conditions.title AS conditiontitle,info.name AS sellername,info.cell AS sellercell,info.phone AS sellerphone,info.email AS selleremail
							FROM `#__js_auto_vehicles` AS vehicles
							LEFT JOIN `#__js_auto_seller_contact_info` AS info ON vehicles.uid =info.uid
							LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
							LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
							LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
							LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
							LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
							LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
							LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
							LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
							WHERE vehicles.id = ".$id." AND vehicles.addexpiryvalue >= CURDATE()";
							$db->setQuery($vehiclequery);
							$vehicle = $db->loadObject();
							$comma = '';
							$location="";
							if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
							elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
							if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
							elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
							
							if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
							elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
							$location .= $comma.$vehicle->countryname;
							
							if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
							else $vehicletitle=$vehicle->title;

                            $reviewquery = "SELECT review.review, user.name, user.email FROM `#__users` AS user
                                            JOIN `#__js_auto_vehiclerankreview` AS review ON review.uid = user.id
                                            WHERE review.uid = ".$uid."  AND review.vehicleid = ".$id;
                            //echo '<br>sql '.$reviewquery;exit;
                            $db->setQuery( $reviewquery );
                            $review = $db->loadObject();
                            $BuyerEmail=$review->email;
                            $BuyerName=$review->name;
                            $BuyerReview=$review->review;
                            $reviewLink = JRoute::_(JURI::root().'index.php?option=com_jsautoz&view=buyer&layout=vehicle_reviews&cl=8&vtype='.$vtype.'&id='.$id.'&Itemid=103');
                            

							$msgSubject = 'New Vehicle Review';

							$msgBody = str_replace('{BUYER_NAME}', $BuyerName, $msgBody);
							$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
                        				$msgBody = str_replace('{LINK}', " <a target='_blank' href=".$reviewLink." >" . " ".JText::_("VIEW_REVIEW")."</a>", $msgBody);
							$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
							$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
							$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
							$msgBody = str_replace('{LOCATION}', $location, $msgBody);
							$msgBody = str_replace('{REVIEW}', $BuyerReview, $msgBody);
                            break;
                        case 3: // new Package purchase
                            $sellerinfo = "SELECT  user.name, user.email
                            FROM `#__users` AS user
							WHERE user.id = ".$uid;
                            $db->setQuery( $sellerinfo );
                            $sellerinfo = $db->loadObject();
                        
                            $packagepurchasequery = "SELECT  sellerpackage.title AS packagetitle,sellerpackage.price AS packageprice
                             FROM `#__js_auto_sellerpackages` AS sellerpackage
							WHERE sellerpackage.id = ".$id;
                            $db->setQuery( $packagepurchasequery );
                            $packagepurchasequery = $db->loadObject();
                            $SellerEmail=$sellerinfo->email;
                            $SellerName=$sellerinfo->name;
                            $PackageTitle=$packagepurchasequery->packagetitle;
                            $PackagePrice=$packagepurchasequery->packageprice;
							$msgSubject = 'Package Purchase';

							$msgBody = str_replace('{PACKAGE_TITLE}', $PackageTitle, $msgBody);
							$msgBody = str_replace('{SELLER_NAME}', $SellerName, $msgBody);
							$msgBody = str_replace('{PACKAGE_PRICE}', $PackagePrice, $msgBody);
                            break;
                    }

                    $message =& JFactory::getMailer();
                    $message->addRecipient($adminEmail); //to email
                    //echo '<br>adminEmail'.$adminEmail;
                    //echo '<br>senderEmail'.$senderEmail;
                    //echo '<br>senderName'.$senderName;
                    //echo '<br> sbj '.$msgSubject;
                    //echo '<br> bd '.$msgBody;exit;
                    $message->setSubject($msgSubject);
                    $siteAddress = JURI::base();
                    $message->setBody($msgBody);
                    $sender = array( $senderEmail, $senderName );
                    $message->setSender($sender);
                    $message->IsHTML(true);
                    $sent = $message->send();
                    return $sent;
               }
               return true;

	}
}
?>


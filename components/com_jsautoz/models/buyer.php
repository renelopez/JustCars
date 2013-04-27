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

$option = JRequest :: getVar('option', 'com_omrpreptest');


class JSAutozModelBuyer extends JModelLegacy
{
	var $_config = null;
	var $_countries;
	var $_ptr = null;
	
	function __construct()
	{
		parent :: __construct();
		$user	=& JFactory::getUser();
		$this->_arv = "/\aseofm/rvefli/ctvrnaa/kme/\rfer";
		$this->_ptr = "/\blocalh";
		
	}
        
    function &getUserFields($fieldfor, $id){
		$db = &$this->getDBO();
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
				if(isset($id) && $id != ""){//if id is not empty
					$query =  "SELECT  fieldvalue.* FROM `#__js_auto_userfield_data` AS fielddata
								JOIN `#__js_auto_userfieldvalues` AS fieldvalue ON fieldvalue.id = fielddata.data
								WHERE fielddata.field = ". $row->id." AND fielddata.referenceid = ".$id;
				}else{//general
					$query =  "SELECT  value.* FROM `#__js_auto_userfieldvalues` AS value WHERE value.field = ". $row->id;
				}
				/*
				$query =  "SELECT  * FROM `#__js_auto_userfieldvalues` AS value 
				JOIN `#__js_auto_userfield_data` AS udata ON udata.data = value.id
				WHERE value.field = ". $row->id;
				*/
				$db->setQuery($query);
				$value = $db->loadObject();
				$field[2] = $value;
			}
			$result[] = $field;
			$i++;
		}
		return $result;
	}

	function getVehiclesByTitle() {
            $db = &$this->getDBO();
            
            $term = JRequest::getVar('term');//retrieve the search term that autocomplete sends

            $q = "SELECT vehicles.id, vehicles.title as value FROM `#__js_auto_vehicles` AS vehicles WHERE vehicles.title LIKE '%".$term."%' AND vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
            $db->setQuery($q);
            $result = $db->loadObjectList();//query the database for entries containing the term
            if(isset($result))
            foreach($result AS $record){
                $row['value']=htmlentities(stripslashes($record->value));
                $row['id']=(int)$record->id;
                $row_set[] = $row;//build an array
            } 
            $result =  $row_set;//format the array into json data */
            return $result;
        }
        function emailValidation($email){
            $db = & JFactory:: getDBO();
            $query = "SELECT COUNT(id) FROM `#__js_auto_new_listing_alerts` WHERE email = ". $db->Quote($email);
            $db->setQuery( $query );
            $result = $db->loadResult();
            if($result > 0) return true;
			else return false;
        }
        function &storeVehicleBuyerContact($data){
            $row = &$this->getTable('buyercontactinfo');
            $emailconfig=$this->getConfiginArray('email');
			$data['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
            if($data['uid']==0){
                if(!$this->performChecks())
                {
                    return 3;
                }
            }

            //$data = JRequest :: get('post');
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
            if($emailconfig['seller_buyer_contact_to_seller']==1){
				$this->sendMailToSeller($data);
				
			}
            return true;
        
    }
	function setVehicleHitValue($id){
		$db = &$this->getDBO();

		$query = "UPDATE `#__js_auto_vehicles` SET hits = hits +1 WHERE id = ".$id;
		$db->setQuery($query);
		$db->query();
		return true;
	}
    function sendMailToSeller($data){
        $db = &$this->getDBO();
        $query  = "SELECT uid FROM `#__js_auto_vehicles`  WHERE id = ".$data['vehicleid'] ;
        $db->setQuery($query);
        $uid = $db->loadResult();
        if($uid){
            $query  = "SELECT * FROM `#__js_auto_seller_contact_info`  WHERE uid = ".$uid ;
            $db->setQuery($query);
            $sellerdata = $db->loadObject();
        }else{
            $query  = "SELECT * FROM `#__js_auto_seller_contact_info`  WHERE vehicleid = ".$data['vehicleid'] ;
            $db->setQuery($query);
            $sellerdata = $db->loadObject();
        }
        $Email = $sellerdata->email;
        $sellerName = $sellerdata->name;
		$templatefor="buyer-contact-seller";
		$query = "SELECT template.* FROM `#__js_auto_emailtemplates` AS template	WHERE template.templatefor = ".$db->Quote($templatefor);
		$db->setQuery( $query );
		//echo '<br>sql '.$query;
		$template = $db->loadObject();
		$msgSubject = $data['subject'];
		$msgBody = $template->body;

        //$msgBody = $data['description'];
        $buyerEmail = $data['buyeremail'];
        $buyerName = $data['buyername'];
        $buyerCell = $data['buyercell'];
        $buyerPhone = $data['buyerphone'];
        $buyerDescription = $data['description'];

		$msgBody = str_replace('{SELLER_NAME}', $sellerName, $msgBody);

		$msgBody = str_replace('{BUYER_NAME}', $buyerName, $msgBody);
		$msgBody = str_replace('{BUYER_EMAIL}', $buyerEmail, $msgBody);
		$msgBody = str_replace('{BUYER_PHONE}', $buyerPhone, $msgBody);
		$msgBody = str_replace('{BUYER_CELL}', $buyerCell, $msgBody);
		$msgBody = str_replace('{BUYER_DESCRIPTION}', $buyerDescription, $msgBody);

        $message =& JFactory::getMailer();
        $message->addRecipient($Email); //to email
		//echo '<br>buyerEmail'.$buyerEmail;
		//echo '<br>sellerEmail'.$Email;
		//echo '<br>buyerName'.$buyerName;
		//echo '<br> sbj '.$msgSubject;
		//echo '<br> bd '.$msgBody;exit;

        $message->setSubject($msgSubject);
        $message->setBody($msgBody);
        $sender = array( $buyerEmail, $buyerName );
        $message->setSender($sender);
        $message->IsHTML(true);
        $sent = $message->send();

        return true;
    }

	function storeVehicleCurrency($id, $val, $fild ){
		if (is_numeric($val) == false) return false;
		$config = $this->getConfiginArray('default');
		$value = $config[$fild];
		$value = $this->getSVal($value); 
		if ($value != $id ) return 3;
		$db =& JFactory::getDBO();
		$query = "UPDATE `#__js_auto_currency` SET regin = ".$val;
		$db->setQuery( $query );
		if (!$db->query()) {
			return false;
		}
		return true;	
	}
    function &listModels($val) {
        $db = &$this->getDBO();
        if($val) if (is_numeric($val) == false) return false;
        $query  = "SELECT id, title FROM `#__js_auto_models`  WHERE status = 1 AND makeid = ".$val." ORDER BY title ASC";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        //if ($req == 1)$required == ' required';
        if (empty($result))	{
            $return_value = "<input class='inputboxrequired' type='text' name='modelid' id='modelid' size='40' maxlength='100'  />";
        }else {
                                $return_value = "<select id='modelid' name='modelid'  >\n";
                                $return_value .= "<option value='0'>". JText::_('SELECT_MODEL') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->id\" >$row->title</option> \n" ;
                                }
                           $return_value .= "</select>\n";
        }
        return $return_value;
    }
    function listVehicleQuickModels($val){
        $db = &$this->getDBO();
        if($val) if (is_numeric($val) == false) return false;
        $query  = "SELECT id, title FROM `#__js_auto_models`  WHERE status = 1 AND makeid = ".$val." ORDER BY title ASC";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        //if ($req == 1)$required == ' required';
        if (empty($result))	{
            $return_value = "<input class='inputboxrequired' type='text' id='md' name='md' size='25' maxlength='100'  />";
        }else {
                                $return_value = "<select id='md' name='md' style='width:125px'  >\n";
                                $return_value .= "<option value='0'>". JText::_('SELECT_MODEL') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->id\" >$row->title</option> \n" ;
                                }
                           $return_value .= "</select>\n";
        }
        return $return_value;



    }
    function listVehicleFilterModels($val) {
        $db = &$this->getDBO();
        if($val) if (is_numeric($val) == false) return false;
        $query  = "SELECT id, title FROM `#__js_auto_models`  WHERE status = 1 AND makeid = ".$val." ORDER BY title ASC";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        //if ($req == 1)$required == ' required';
        if (empty($result))	{
            $return_value = "<input class='inputboxrequired' type='text' id='fmd' name='fmd' size='25' maxlength='100'  />";
        }else {
                                $return_value = "<select id='fmd' name='fmd' style='width:125px'  >\n";
                                $return_value .= "<option value='0'>". JText::_('SELECT_MODEL') ."</option>\n";
                                foreach($result as $row){
                                        $return_value .= "<option value=\"$row->id\" >$row->title</option> \n" ;
                                }
                           $return_value .= "</select>\n";
        }
        return $return_value;
    }
	function getVehicleSort($sortvalue) {
                    $sorting = array(
                '0' => array('value' => 'vehicles.title ','text' => JText::_('TITLE')),
                '1' => array('value' => 'makes.title','text' => JText::_('MAKE')),
                '2' => array('value' => 'models.title','text' => JText::_('MODEL')),
                '3' => array('value' => 'modelyear.title','text' => JText::_('MODEL_YEAR')),
                '4' => array('value' => 'vehicles.price','text' => JText::_('PRICE')),
                '5' => array('value' => 'vehicletypes.title','text' => JText::_('VEHICLE_TYPE')),
                '6' => array('value' => 'fueltype.title','text' => JText::_('FUEL_TYPE')),
                '7' => array('value' => 'created','text' => JText::_('CREATED')),);

               $selectsort['sort'] = JHTML::_('select.genericlist', $sorting, 'lv_sortvalue', 'class="inputbox" '. 'onchange="submitSorting(1)"', 'value', 'text', $sortvalue);
               return $selectsort;
        }

    function &getSearchOptions() {
        
        $db = &$this->getDBO();
        $countries = $this->getCountries(JText::_('ALL'));
        $regstates = $this->getStates(JText::_('ALL'), '');
        $regcounties = $this->getCounties(JText::_('ALL'), '');
        $regcities = $this->getCities(JText::_('ALL'), '');
        $locstates = $this->getStates(JText::_('ALL'), '');
        $loccounties = $this->getCounties(JText::_('ALL'), '');
        $loccities = $this->getCities(JText::_('ALL'), '');
        $zip = $this->getZipCodes('', '');
        $radiussearch = array(
        '0' => array('value' => '','text' => JText::_('SELECT_RADIUS_LIMIT')),
        '1' => array('value' => 10,'text' => JText::_('WITH_IN_TEN_KM')),
        '2' => array('value' => 20,'text' => JText::_('WITH_IN_TWENTY_KM')),
        '3' => array('value' => 25,'text' => JText::_('WITH_IN_TWENTYFIVE_KM')),);

        $fieldorderings =$this->getFieldsOrdering(1,0);
        $makes =$this->getVehiclesMakes(JText::_('ALL'));
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('ALL')), 'vehicletypeid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['makes'] = JHTML::_('select.genericList', $makes, 'makeid', 'class="inputbox " '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', '');
        $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId(JText::_('ALL')), 'modelid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear(JText::_('ALL')), 'modelyearid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['fueltypes'] = JHTML::_('select.genericList', $this->getVehiclesFuelType(JText::_('ALL')), 'fueltypeid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['transmissions'] = JHTML::_('select.genericList', $this->getVehiclesTransmission(JText::_('ALL')), 'transmissionid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition(JText::_('ALL')), 'conditionid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['cylinders'] = JHTML::_('select.genericList', $this->getVehiclesCylinders(JText::_('ALL')), 'cylinderid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['regcountry'] = JHTML::_('select.genericList', $countries, 'regcountry','class="inputbox required" '.'onChange="geteregaddressdata(\'state\', this.value)"', 'value', 'text', '');
        $lists['regstate'] = JHTML::_('select.genericList', $regstates, 'regstate', 'class="inputbox" '. 'onChange="geteregaddressdata(\'county\', this.value)"', 'value', 'text', '');
        $lists['regcounty'] = JHTML::_('select.genericList', $regcounties, 'regcounty', 'class="inputbox" '. 'onChange="geteregaddressdata(\'city\', this.value)"', 'value', 'text', '');
        $lists['regcity'] = JHTML::_('select.genericList', $regcities, 'regcity', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['loccountry'] = JHTML::_('select.genericList', $countries, 'loccountry','class="inputbox required" '.'onChange="getlocaddressdata(\'state\', this.value)"', 'value', 'text','');
        $lists['locstate'] = JHTML::_('select.genericList', $locstates, 'locstate', 'class="inputbox" '. 'onChange="getlocaddressdata(\'county\', this.value)"', 'value', 'text', '');
        $lists['loccounty'] = JHTML::_('select.genericList', $loccounties, 'loccounty', 'class="inputbox" '. 'onChange="getlocaddressdata(\'city\', this.value)"', 'value', 'text', '');
        $lists['loccity'] = JHTML::_('select.genericList', $loccities, 'loccity', 'class="inputbox" '. 'onChange="getlocaddressdata(\'zip\', this.value)"', 'value', 'text', '');
        $lists['loczip'] = JHTML::_('select.genericList', $zip, 'loczip', '', 'value', 'text', '');
        $lists['radiussearch'] = JHTML::_('select.genericlist', $radiussearch, 'radiussearch', 'class="inputbox" '. '', 'value', 'text', '');
        $result[2] = $lists;
        $result[3] = $fieldorderings;
        return $result;

    }
    function getVehicleQuickLink($q=0,$module=0,$plugins=0){
        $db = &$this->getDBO();
        $vehiclecondition = array(
        '0' => array('value' => '','text' => JText::_('SELECT_CONDITION')),
        '1' => array('value' => '1','text' => JText::_('NEW')),
        '2' => array('value' => '2','text' => JText::_('USED')),);
        $vehiclemakes=$this->getVehiclesMakes(JText::_('ALL_MAKES'));
        $vehiclemodels=$this->getVehiclesModelsbyMakeId(JText::_('ALL_MODELS'));
        if($q <> 0 && $module == 0 && $plugins == 0)
        $lists['makes'] = JHTML::_('select.genericList',$vehiclemakes, 'mk', 'class="inputbox" style="width:120px" '. 'onChange="getquicklinkmodels(this.value)"', 'value', 'text', '');
        elseif($q == 0 && $module <> 0 && $plugins == 0)
        $lists['makes'] = JHTML::_('select.genericList',$vehiclemakes, 'mk', 'class="inputbox" style="width:120px" '. 'onChange="getmodulesmodels(this.value)"', 'value', 'text', '');
        elseif($q <> 0 && $module == 0 && $plugins <> 0)
        $lists['makes'] = JHTML::_('select.genericList',$vehiclemakes, 'mk', 'class="inputbox" style="width:120px" '. 'onChange="getpluginsmodels(this.value)"', 'value', 'text', '');
        else
        $lists['makes'] = JHTML::_('select.genericList',$vehiclemakes, 'mk', 'class="inputbox" style="width:120px" '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', '');
        $lists['models'] = JHTML::_('select.genericList',$vehiclemodels, 'md', 'class="inputbox" style="width:125px" '. '', 'value', 'text', '');
        $lists['condition'] = JHTML::_('select.genericList', $vehiclecondition, 'vtype', 'class="inputbox" style="width:108px" '. '', 'value', 'text', '');
        $result = $lists;
        return $result;

    }
    function getVehicleFilter($makeid,$modelid,$fvtype,$modelyear,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$filter_radius,$filter_latitude,$filter_longitude) {
        
        
        
                $db = &$this->getDBO();
                $config=$this->getConfiginArray('default');
                if($config['defaultcountry']){
                    $defaultvehiclecountry=$config['defaultcountry'];
                    
                }
                if($vehiclecountry!="" && $vehiclecountry!=$defaultvehiclecountry) {
                    $defaultvehiclecountry=$vehiclecountry;
                }
        
                $countries = $this->getCountries(JText::_('ALL_COUNTRIES'));
                if($defaultvehiclecountry){
                    $locstates = $this->getStates($defaultvehiclecountry, 'ALL_STATES');
                }else{
                    if($vehiclecountry != '')$locstates = $this->getStates($vehiclecountry, 'ALL_STATES');
                    
                }
                if ($vehiclestate != '') $loccounties = $this->getCounties($vehiclestate, 'ALL_COUNTIES');
                if ($vehiclecounty != '')$loccities = $this->getCities($vehiclecounty, 'ALL_CITIES');
                
                $lists['loccountry'] = JHTML::_('select.genericList', $countries, 'country','class="inputbox " style="width:100px" '.'onChange="getfilteraddressdata(\'state\', this.value)"', 'value', 'text',$defaultvehiclecountry);
                if ( isset($locstates[1]) ) if ($locstates[1] != '') $lists['locstate'] = JHTML::_('select.genericList', $locstates, 'state', 'class="inputbox" style="width:100px"  '. 'onChange="getfilteraddressdata(\'county\', this.value)"', 'value', 'text', $vehiclestate);
                if ( isset($loccounties[1]) ) if ($loccounties[1] != '') $lists['loccounty'] = JHTML::_('select.genericList', $loccounties, 'county', 'class="inputbox" style="width:100px" '. 'onChange="getfilteraddressdata(\'city\', this.value)"', 'value', 'text', $vehiclecounty);

        if ( isset($loccities[1]) ) if ($loccities[1] != '') $lists['loccity'] = JHTML::_('select.genericList', $loccities, 'city', 'class="inputbox" style="width:100px" '. '', 'value', 'text', $vehiclecity);
        
        $vehiclemakes=$this->getVehiclesMakes(JText::_('ALL_MAKES'));
        $vehiclemodels=$this->getVehiclesModelsbyMakeId(JText::_('ALL_MODELS'));
        
        
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('ALL_TYPES')), 'vehicletypeid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear(JText::_('ALL_MODEL_YEARS')), 'fmod', 'class="inputbox" '. '', 'value', 'text', $modelyear);
        $lists['makes'] = JHTML::_('select.genericList',$vehiclemakes, 'fmk', 'class="inputbox" style="width:100px"  '. 'onChange="getfiltermodels(this.value)"', 'value', 'text', $makeid);
        $lists['models'] = JHTML::_('select.genericList',$vehiclemodels, 'fmd', 'class="inputbox" style="width:100px" '. '', 'value', 'text', $modelid);
        $lists['condition'] = JHTML::_('select.genericList', $this->getVehiclesConditionForFilter(JText::_('ALL_CONDITIONS')), 'fvtype', 'class="inputbox" '. 'onChange="updatefiltervtypevalue(this.value)"', 'value', 'text', $fvtype);
        if($filter_radius != "Coordinates Radius")$lists['radius'] = $filter_radius;else $lists['radius']="";
        if($filter_latitude != "Latitude")$lists['latitude'] = $filter_latitude;else$lists['latitude'] = "";
        if($filter_longitude != "Longitude")$lists['longitude'] = $filter_longitude;else$lists['longitude'] = "";

        $filtervalues['state'] = $vehiclestate;
        $filtervalues['county'] = $vehiclecounty;
        $filtervalues['city'] = $vehiclecity;

        //$filtervalues['state'] = $txt_state;
        //$filtervalues['county'] = $txt_county;
        //$filtervalues['city'] = $txt_city;
        /*if($clfrm==2){
            $filtervalues['state'] = $vehiclestate;
            $filtervalues['county'] = $vehiclecounty;
            $filtervalues['city'] = $vehiclecity;
        }*/
        
        $result=array();
        $result[0] = $lists;
        $result[1] = $filtervalues;
        return $result;
    }
    function &getVehicleSearchResults($searchdata, $limitstart, $limit ) {
        $db = &$this->getDBO();
        $result=  array();
        $wherequery="";
        if ((isset($searchdata['vehicletypeid'])) && ($searchdata['vehicletypeid'] != '') ){
            if (is_numeric($searchdata['vehicletypeid']) == false) return false;
            $wherequery .= " AND vehicle.vehicletypeid = ".$searchdata['vehicletypeid'];
        } 
        if ((isset($searchdata['makeid'])) && ($searchdata['makeid'] != '')){
            if (is_numeric($searchdata['makeid']) == false) return false;
            $wherequery .= " AND vehicle.makeid = ".$searchdata['makeid'];
        } 
        if ((isset($searchdata['conditionid'] )) &&($searchdata['conditionid'] != '')){
            if (is_numeric($searchdata['conditionid']) == false) return false;
            $wherequery .= " AND vehicle.conditionid = ".$searchdata['conditionid'];
            
        }
        if ((isset($searchdata['modelid']) && ($searchdata['modelid'] != '') && ($searchdata['modelid'] != 0))){
            if (is_numeric($searchdata['modelid']) == false) return false;
            $wherequery .= " AND vehicle.modelid = ".$searchdata['modelid'];
            
        } 
        if ((isset($searchdata['modelyearid'])) && ($searchdata['modelyearid'] != '')){
            if (is_numeric($searchdata['modelyearid']) == false) return false;
            $wherequery .= " AND vehicle.modelyearid = ".$searchdata['modelyearid'];
            
        }
        if ((isset($searchdata['fueltypeid'])) && ($searchdata['fueltypeid'] != '')){
            
            if (is_numeric($searchdata['fueltypeid']) == false) return false;
            $wherequery .= " AND vehicle.fueltypeid= ".$searchdata['fueltypeid'];
            
        } 
        if ((isset($searchdata['cylinderid']))&&($searchdata['cylinderid'] != '')){
            if (is_numeric($searchdata['cylinderid']) == false) return false;
            $wherequery .= " AND vehicle.cylinderid= ".$searchdata['cylinderid'];
            
        } 
        if ((isset($searchdata['pricefrom'])) && ($searchdata['pricefrom'] != '')){
            if (is_numeric($searchdata['pricefrom']) == false) return false;
            $wherequery .= " AND vehicle.price >= ".$searchdata['pricefrom'];
            
        } 
        if ((isset($searchdata['priceto'])) && ($searchdata['priceto'] != '')){
            if (is_numeric($searchdata['priceto']) == false) return false;
            $wherequery .= " AND vehicle.price <= ".$searchdata['priceto'];
            
        } 
        if ((isset($searchdata['exteriorcolor'])) && ($searchdata['exteriorcolor'] != '')) $wherequery .= " AND vehicle.exteriorcolor LIKE '%".str_replace("'","",$db->quote($searchdata['exteriorcolor']))."%'";
        if ((isset($searchdata['title'])) && ($searchdata['title'] != '')) $wherequery .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchdata['title']))."%'";
        if ((isset($searchdata['registrationnumber'])) && ($searchdata['registrationnumber'] != '')) $wherequery .= " AND vehicle.registrationnumber =".$db->quote($searchdata['registrationnumber']);
        if ((isset($searchdata['regcountry']))&&($searchdata['regcountry'] != '')) $wherequery .= " AND vehicle.regcountry= ".$db->quote($searchdata['regcountry']);
        if ((isset($searchdata['regstate'])) && ($searchdata['regstate'] != '')) $wherequery .= " AND vehicle.regstate= ".$db->quote($searchdata['regstate']);
        if ((isset($searchdata['regcounty'])) && ($searchdata['regcounty'] != '')) $wherequery .= " AND vehicle.regcounty= ".$db->quote($searchdata['regcounty']);
        if ((isset($searchdata['regcity'])) && ($searchdata['regcity'] != '')) $wherequery .= " AND vehicle.regcity= ".$db->quote($searchdata['regcity']);
        if ((isset($searchdata['loccountry'])) && ($searchdata['loccountry'] != '')) $wherequery .= " AND vehicle.loccountry= ".$db->quote($searchdata['loccountry']);
        if ((isset($searchdata['locstate'])) && ($searchdata['locstate'] != '')) $wherequery .= " AND vehicle.locstate= ".$db->quote($searchdata['locstate']);
        if ((isset($searchdata['loccounty']))&&($searchdata['loccounty'] != '')) $wherequery .= " AND vehicle.loccounty= ".$db->quote($searchdata['loccounty']);
        if ((isset($searchdata['loccity']))&&($searchdata['loccity'] != '')) $wherequery .= " AND vehicle.loccity= ".$db->quote($searchdata['loccity']);
        if ((isset($searchdata['loczip'])) && ($searchdata['loczip'] != 0)) {
            $zipcodes = $this->get_zips_in_range($searchdata['loczip'], $searchdata['radiussearch'], 1, 1); //$zip, $range, $sort=1, $include_base
            $total="";
            if($zipcodes){
				foreach($zipcodes as $code)	{
						$total = $total + 1;
						if($total == 1) $wherequery .= " AND (vehicle.loczip = " . $code->code;
						else $wherequery .= " OR vehicle.loczip = " . $code->code;
				}
				$wherequery .=" )";

				if($total > 1){
						$wherequery .= $wherequery;
				}else {
						$wherequery .= "AND vehicle.loczip = " . $code->code;
				}
				
			}

        }
        if ((isset($searchdata['enginecapacity'])) && ($searchdata['enginecapacity'] != '')) $wherequery .= " AND vehicle.enginecapacity= ".$db->quote($searchdata['enginecapacity']);
        if ((isset($searchdata['mileages']))&&($searchdata['mileages'] != '')) $wherequery .= " AND vehicle.mileages BETWEEN ".$db->quote($searchdata['mileages'])." AND ".$db->quote($searchdata['mileages']);
        if(isset($searchdata['radius_length_type'])){
            switch($searchdata['radius_length_type']){
                            case "m":$radiuslength = 6378137;break;
                            case "km":$radiuslength = 6378.137;break;
                            case "mile":$radiuslength = 3963.191;break;
                            case "nacmiles":$radiuslength = 3441.596;break;
                    }
            
        }
        $selectdistance = " ";
        if((isset($searchdata['longitude'])) && (isset($searchdata['latitude'])) && (isset($searchdata['radius']))) {
            
            if(($searchdata['longitude']!=="")&&($searchdata['latitude']!=="")&&($searchdata['radius']!=="")){
                            $latitude=$searchdata['latitude'];
                            $longitude=$searchdata['longitude'];
                            $radius=$searchdata['radius'];

                            //$radiussearch = " acos((sin(PI()*$latitude/180)*sin(PI()*job.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*job.latitude/180)*cose(PI()*job.longitude/180 - PI()*$longitude/180)))*$radiuslength <= $radius";
                            $radiussearch = " acos((SIN( PI()* $latitude /180 )*SIN( PI()*vehicle.latitude/180 ))+(cos(PI()* $latitude /180)*COS( PI()*vehicle.latitude/180) *COS(PI()*vehicle.longitude/180-PI()* $longitude /180)))* $radiuslength <= $radius";
                            $selectdistance = " ,acos((sin(PI()*$latitude/180)*sin(PI()*vehicle.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*vehicle.latitude/180)*cose(PI()*vehicle.longitude/180 - PI()*$longitude/180)))*$radiuslength AS distance ";
            }
        }
        if(isset($radiussearch) && $radiussearch != '') $wherequery .= " AND ".$radiussearch;

        
        $query = "SELECT count(vehicle.id) FROM `#__js_auto_vehicles` AS vehicle
                WHERE vehicle.status = 1 AND vehicle.addexpiryvalue >= CURDATE()  ";
        $query .= $wherequery;

        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicle.*,vehicletypes.title as vehicletitle, makes.title as maketitle, models.title as modeltitle,

        vehicle.loccountry AS country,vehicle.locstate AS state,vehicle.loccounty AS county,vehicle.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,

        modelyears.title as modelyeartitle, fueltypes.title as fueltypetitle, cylinders.title as cylindertitle,
        image.filename AS vehiclelogo,conditions.title AS conditiontitle,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicle
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicle.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicle.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicle.makeid = makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicle.modelid = models.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyears ON vehicle.modelyearid = modelyears.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltypes ON vehicle.fueltypeid = fueltypes.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinders ON vehicle.cylinderid = cylinders.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicle.currencyid = currency.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicle.conditionid = conditions.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicle.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicle.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicle.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicle.loccity = city.code
        WHERE vehicle.status = 1 AND vehicle.addexpiryvalue >= CURDATE() ";
        $query .= $wherequery  ;
        //echo $query;
        
        $db->setQuery($query, $limitstart, $limit);
        $vehicles = $db->loadObjectList();
        $result[0] = $vehicles;
        $result[1] = $total;

        return $result;

    }
     
    function get_zips_in_range($zip, $range, $sort=1, $include_base) {
                $db =& JFactory::getDBO();
          // returns an array of the zip codes within $range of $zip. Returns
          // an array with keys as zip codes and values as the distance from
          // the zipcode defined in $zip.

          //$this->chronometer();                     // start the clock
          $details = $this->get_zip_point($zip);  // base zip details
          if ($details == false) return false;

          // This portion of the routine  calculates the minimum and maximum lat and
          // long within a given range.  This portion of the code was written
          // by Jeff Bearer (http://www.jeffbearer.com). This significanly decreases
          // the time it takes to execute a query.  My demo took 3.2 seconds in
          // v1.0.0 and now executes in 0.4 seconds!  Greate job Jeff!
          // Find Max - Min Lat / Long for Radius and zero point and query
          // only zips in that range.
          $lat_range = $range/69.172;
          $lon_range = abs($range/(cos($details->latitude) * 69.172));
          $min_lat = number_format($details->latitude - $lat_range, "4", ".", "");
          $max_lat = number_format($details->latitude + $lat_range, "4", ".", "");
          $min_lon = number_format($details->longitude - $lon_range, "4", ".", "");
          $max_lon = number_format($details->longitude + $lon_range, "4", ".", "");

        //$return = array();    // declared here for scope

        $query = "SELECT code, latitude, longitude FROM `#__js_auto_zips`";
        if (!$include_base) $query .= "WHERE code <> '$zip' AND ";
        else $query .= "WHERE ";
        $query .= "latitude BETWEEN '$min_lat' AND '$max_lat'
                   AND longitude BETWEEN '$min_lon' AND '$max_lon'";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        if ($db->getErrorNum()) {
                echo $db->stderr();
                return false;
        }

        return $rows;

    }
    function get_zip_point($zip) {

        // This function pulls just the lattitude and longitude from the
        // database for a given zip code.
        $db =& JFactory::getDBO();

        $query = "SELECT latitude, longitude FROM `#__js_auto_zips` WHERE code='$zip'";
        $db->setQuery( $query );
        $row = $db->loadObject();
        if ($db->getErrorNum()) {
            echo $db->stderr();
            return false;
        }
        return $row;
    }
    function &getAllVehicles($show_sold_vehicles,$type,$vtype,$makeid,$modelid,$dealerid,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$pricestart,$priceend,$modelyear,$filter_radius,$filter_latitude,$filter_longitude,$radiustype,$sortvalue,$sortorder,$limitstart,$limit) {
        $db = &$this->getDBO();
        $query = '';
        switch($radiustype){
			case "m":$radiuslength = 6378137;break;
			case "km":$radiuslength = 6378.137;break;
			case "mile":$radiuslength = 3963.191;break;
			case "nacmiles":$radiuslength = 3441.596;break;
		}
        $selectdistance = " ";
        
        if(($filter_longitude != '') &&($filter_latitude != '')  &&($filter_radius != '') ){
			//$radiussearch = " acos((sin(PI()*$latitude/180)*sin(PI()*job.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*job.latitude/180)*cose(PI()*job.longitude/180 - PI()*$longitude/180)))*$radiuslength <= $radius";
			$radiussearch = " acos((SIN( PI()* $filter_latitude /180 )*SIN( PI()*vehicles.latitude/180 ))+(cos(PI()* $filter_latitude /180)*COS( PI()*vehicles.latitude/180) *COS(PI()*vehicles.longitude/180-PI()* $filter_longitude /180)))* $radiuslength <= $filter_radius";
			//$selectdistance = " ,acos((sin(PI()*$latitude/180)*sin(PI()*job.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*job.latitude/180)*cose(PI()*job.longitude/180 - PI()*$longitude/180)))*$radiuslength AS distance ";
        }
        $result = array();
        $query = "SELECT SQL_CALC_FOUND_ROWS COUNT(DISTINCT  vehicles.id)  id
        FROM #__js_auto_vehicles AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($type){
            $query.=" AND vehicles.vehicletypeid=".$type;
        }
        if($vtype){
            $query.=" AND vehicles.conditionid=".$vtype;
        }
        if($makeid){
            $query.=" AND vehicles.makeid=" .$makeid;
        }
        if($modelid){
            $query.=" AND vehicles.modelid=" .$modelid;
        }
        if($dealerid){
            $query.=" AND vehicles.uid=" .$dealerid;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        if($show_sold_vehicles==0){
            $query.=" AND vehicles.issold = 0 ";
        }
        if(($pricestart!='') && ($priceend!='')){
            $query.=" AND vehicles.price BETWEEN ".$db->Quote($pricestart)." AND ".$db->Quote($priceend);
        }
        if(isset($radiussearch)) $query .= " AND ".$radiussearch;

        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.issold AS soldvehicles,vehicles.price,vehicles.created,
        vehicles.id,vehicles.title,vehicles.latitude,vehicles.longitude,
        vehicles.exteriorcolor,vehicles.enginecapacity,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        vehicletypes.title AS vehicletitle,
        makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($type){
            $query.=" AND vehicles.vehicletypeid=".$type;
        }
        if($vtype){
            $query.=" AND vehicles.conditionid=".$vtype;
        }
        if($makeid){
            $query.=" AND vehicles.makeid=" .$makeid;
        }
        if($modelid){
            $query.=" AND vehicles.modelid=" .$modelid;
        }
        if($dealerid){
            $query.=" AND vehicles.uid=" .$dealerid;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        if($show_sold_vehicles==0){
            $query.=" AND vehicles.issold = 0 ";
        }
        if(($pricestart!='') && ($priceend!='')){
            $query.=" AND vehicles.price BETWEEN ".$db->Quote($pricestart)." AND ".$db->Quote($priceend);
        }
        
        if(isset($radiussearch)) $query .= " AND ".$radiussearch;

        $query.=" ORDER BY ".$sortvalue." ".$sortorder;
        //echo $query;
     
        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
        
        
        
    }
    function &getAllVehicle($show_sold_vehicles,$vehicletype,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$pricestart,$priceend,$modelyear,$sortvalue,$sortorder,$limitstart,$limit) {
        $db = &$this->getDBO();
        $query = '';
        if($vehicletype==1) if(!is_numeric($vehicletype)) return false;
        if($modelyear) if(!is_numeric($modelyear)) return false;
        //if($pricestart) if(!is_numeric($pricestart)) return false;
        //if($priceend) if(!is_numeric($priceend)) return false;
        if($pricestart!='')
            $query .= " AND vehicles.price >= ".$db->Quote($pricestart);

        if($priceend!='')
            $query .= " AND vehicles.price <= ".$db->Quote($priceend);
        

        $result = array();
        $query = "SELECT SQL_CALC_FOUND_ROWS COUNT(DISTINCT  vehicles.id)  id
        FROM #__js_auto_vehicles AS vehicles
            LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        if(($pricestart!='') && ($priceend!='')){
            $query.=" AND vehicles.price BETWEEN ".$db->Quote($pricestart)." AND ".$db->Quote($priceend);
        }
        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.issold AS soldvehicles,vehicles.price,vehicles.created,
        
        vehicles.id,vehicles.title,
        vehicles.exteriorcolor,vehicles.enginecapacity,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        vehicletypes.title AS vehicletitle,
        makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        if(($pricestart!='') && ($priceend!='')){
            $query.=" AND vehicles.price BETWEEN ".$db->Quote($pricestart)." AND ".$db->Quote($priceend);
        }
        $query.=" GROUP BY vehicles.id ORDER BY ".$sortvalue." ".$sortorder;
     
        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
    }
    function &getVehiclesByFilter($show_sold_vehicles,$makeid,$modelid,$vehicletype,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$modelyear,$sortvalue,$sortorder,$limitstart,$limit){
        $db = &$this->getDBO();
        $query = '';
        if($vehicletype==1) if(!is_numeric($vehicletype)) return false;
        if($modelyear) if(!is_numeric($modelyear)) return false;
        //if($pricestart) if(!is_numeric($pricestart)) return false;
        //if($priceend) if(!is_numeric($priceend)) return false;
        

        $result = array();
        $query = "SELECT SQL_CALC_FOUND_ROWS COUNT(DISTINCT  vehicles.id)  id
        FROM #__js_auto_vehicles AS vehicles
            LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($makeid){
            $query.=" AND vehicles.makeid=".$makeid;
        }
        if($modelid){
            $query.=" AND vehicles.modelid=".$modelid;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        if($show_sold_vehicles==0){
            $query.=" AND vehicles.issold = 0 ";
        }
        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.issold AS soldvehicles,vehicles.price,vehicles.created,
        (SELECT sum(rv.overallrating) FROM `#__js_auto_vehiclerankreview` AS rv WHERE rv.vehicleid = vehicles.id ) AS overallrating,
        vehicles.id,vehicles.title,
        vehicles.exteriorcolor,vehicles.enginecapacity,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        vehicletypes.title AS vehicletitle,
        makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($makeid){
            $query.=" AND vehicles.makeid=".$makeid;
        }
        if($modelid){
            $query.=" AND vehicles.modelid=".$modelid;
        }
        if($vehiclecountry){
            $query.=" AND vehicles.loccountry=".$db->Quote($vehiclecountry);
        }
        if($vehiclestate){
            $query.=" AND vehicles.locstate=".$db->Quote($vehiclestate);
        }
        if($vehiclecounty){
            $query.=" AND vehicles.loccounty=".$db->Quote($vehiclecounty);
        }
        if($vehiclecity){
            $query.=" AND vehicles.loccity=".$db->Quote($vehiclecity);
        }
        if($modelyear){
            $query.=" AND vehicles.modelyearid=".$modelyear;
        }
        
        if($show_sold_vehicles==0){
            $query.=" AND vehicles.issold = 0 ";
        }
        $query.=" ORDER BY ".$sortvalue." ".$sortorder;
        //echo 'filterQuery<br>'.$query;
     
        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
    }
    function &getVehiclesbyMake($show_sold_vehicles,$vehicletype,$makeid,$sortvalue,$sortorder,$limitstart,$limit) {
		if($vehicletype) if(! is_numeric($vehicletype)) return false;
		if($makeid) if(! is_numeric($makeid)) return false;
        $db = &$this->getDBO();
        $result = array();
        $query = "SELECT SQL_CALC_FOUND_ROWS COUNT(DISTINCT  vehicles.id)  id
        FROM #__js_auto_vehicles AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid 
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype ;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        $query.=" AND vehicles.makeid = ".$makeid;

        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.issold AS soldvehicles,vehicles.id,vehicles.title,vehicles.price,vehicles.created,
        vehicles.exteriorcolor,vehicles.enginecapacity,vehicletypes.title AS vehicletitle,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        $query.=" AND vehicles.makeid = ".$makeid." GROUP BY vehicles.id ORDER BY ".$sortvalue." ".$sortorder;

        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
    }
    function &getVehiclesbyModel($show_sold_vehicles,$vehicletype,$modelid,$sortvalue,$sortorder,$limitstart,$limit) {
		if($vehicletype) if(! is_numeric($vehicletype)) return false;
		if($modelid) if(! is_numeric($modelid)) return false;
        $db = &$this->getDBO();
        $result = array();
        $query = "SELECT SQL_CALC_FOUND_ROWS COUNT(DISTINCT  vehicles.id)  id
        FROM #__js_auto_vehicles AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
            WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        $query.=" AND vehicles.modelid = ".$modelid;

        $db->setQuery($query);

        $totalresult = $db->loadResult();
        if ( $totalresult <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicles.issold AS soldvehicles,vehicles.id,vehicles.title,vehicles.price,vehicles.created,
        vehicles.exteriorcolor,vehicles.enginecapacity,vehicletypes.title AS vehicletitle,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo ,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE()";
        if($vehicletype==1){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }
        if($vehicletype==2){
            $query.=" AND vehicles.conditionid=".$vehicletype;
        }

        $query.=" AND vehicles.modelid = ".$modelid." GROUP BY vehicles.id ORDER BY ".$sortvalue." ".$sortorder;

        $db->setQuery($query, $limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1]=$totalresult;
        return $result;
    }
    function &getVehiclebyIds($id) {
		if(! is_numeric($id)) return false;
        $db = &$this->getDBO();
        $query = "SELECT  vehicles.description AS description,vehicles.issold AS soldvehicles,vehicles.uid,vehicles.price,trans.title AS transmission ,
        vehicles.mileages AS mileage,vehicles.latitude,vehicles.longitude,
        miletype.symbol As mileagesymbol,vehicles.created ,
        
        vehicles.id,vehicles.title,vehicles.map,vehicles.video,vehicles.makeid,vehicles.modelid,
        vehicles.loccountry AS country,vehicles.locstate AS state,vehicles.loccounty AS county,vehicles.loccity AS city,
        country.name AS countryname,state.name AS statename,county.name AS countyname,city.name AS cityname,
        vehicles.exteriorcolor,vehicles.interiorcolor,vehicles.enginecapacity,vehicletypes.title AS vehicletitle,
        makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo,currency.symbol AS currency
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid AND image.isdefault = 1
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_mileagetypes` AS miletype ON vehicles.mileagetypeid = miletype.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicles.currencyid = currency.id
        LEFT JOIN `#__js_auto_transmissions` AS trans ON vehicles.transmissionid = trans.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.loccountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.locstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.loccounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.loccity = city.code
        WHERE vehicles.status = 1 AND vehicles.addexpiryvalue >= CURDATE() AND vehicles.id = ".$id." GROUP BY vehicles.id";

        $db->setQuery($query);
        $result = $db->loadObject();
        return $result;
    }
    function &getVehicleImagebyId($vehicleid) {
		if(! is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.filename FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid." ORDER BY vehicleimages.isdefault" ;
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }


    function &getVehicleSpecificationbyId($id) {
		if(! is_numeric($id)) return false;
        $db = &$this->getDBO();
        $query = "SELECT trans.title AS transmission ,country.name AS regcountry,state.name AS regstate,county.name AS regcounty,city.name AS regcity,
        vehicles.regcounty AS vregcounty,vehicles.regcity AS vregcity,
        vehicles.loccountry AS vloccountry,vehicles.locstate AS vlocstate,vehicles.loccounty AS vloccounty,
        vehicles.loccity AS vloccity,
        vehicles.price,vehicles.exteriorcolor,vehicles.interiorcolor,vehicles.enginecapacity,
        vehicles.mileages AS mileage,vehicles.id,vehicles.title,vehicles.exteriorcolor,
        vehicletypes.title AS vehicletitle,makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo
        FROM `#__js_auto_vehicles` AS vehicles
        LEFT JOIN `#__js_auto_vehicleimages` AS image ON vehicles.id= image.vehicleid
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicles.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicles.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicles.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicles.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicles.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicles.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicles.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicles.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_transmissions` AS trans ON vehicles.transmissionid = trans.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.regcountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.regstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.regcounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.regcity = city.code
        WHERE vehicles.id = ".$id." GROUP BY vehicles.id";
        //echo '<br> SQL '.$query;
        $db->setQuery($query);
        $result = $db->loadObject();
        return $result;
    }
    function &getVehicleMakeTitle($makeid){
		if(! is_numeric($makeid)) return false;
        $db = &$this->getDBO();
            $query = "SELECT make.*
                FROM `#__js_auto_makes` AS make
                WHERE  make.id = " . $makeid;
        $db->setQuery($query);
        $vehiclemake=$db->loadObject();
        return $vehiclemake;

    }
    function &getVehicleModelTitle($modelid){
		if(! is_numeric($modelid)) return false;
        $db = &$this->getDBO();
            $query = "SELECT model.*
                FROM `#__js_auto_models` AS model
                WHERE  model.id = " . $modelid;
        $db->setQuery($query);
        $vehiclemodel=$db->loadObject();
        return $vehiclemodel;
    }

    function &getVehicleTypeTitle($type){
        if(! is_numeric($type)) return false;
        $db = &$this->getDBO();
            $query = "SELECT type.*
                FROM `#__js_auto_vehicletypes` AS type
                WHERE  type.id = ". $type;
        $db->setQuery($query);
        $vehicletype=$db->loadObject();
        return $vehicletype;
    }
    function &getVehicleYearTitle($yearid){
		if(! is_numeric($yearid)) return false;
        $db = &$this->getDBO();
            $query = "SELECT year.*
                FROM `#__js_auto_modelyears` AS year
                WHERE  year.id = " . $yearid;
        $db->setQuery($query);
        $vehiclemodelyear=$db->loadObject();
        return $vehiclemodelyear;
    }

	function getSVal($value){
		$mdr= ''; $mdrg9=''; $mdrt11='';$val='';		
		for ($i = 0; $i < strlen(substr($value,3,6)); $i++)	$mdr += ord($value[$i]);
		for ($i = 0; $i < strlen(substr($value,9,3)); $i++)	$mdrg9 += ord($value[$i]);
		for ($i = 0; $i < strlen(substr($value,15,3)); $i++)$mdrt11 += ord($value[$i]);
		$val = substr($value,0,3).$mdrg9.substr($value,3,4).$mdrt11.substr($value,6,5).$mdr.substr($value,11,3);
		return $val;
	}	

    function &getVehicleOverviewbyId($id) {
		if(! is_numeric($id)) return false;
        $db = &$this->getDBO();
            $query = "SELECT vehicleoptions.*
                FROM `#__js_auto_vehicleoptions` AS vehicleoptions
                WHERE  vehicleoptions.vehicleid = " . $id;
        $db->setQuery($query);
        $vehicleoptions=$db->loadObject();
        return $vehicleoptions;
    }
    function &getAllImagebyVehicleId($vehicleid) {
		if(! is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.filename FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid ;
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }
   function getVehiclebyMakesModels($vehicletype){
		if($vehicletype) if(! is_numeric($vehicletype)) return false;
        $db = &$this->getDBO();
        $inquery =  " (SELECT COUNT(vehicle.makeid) FROM `#__js_auto_vehicles`  AS vehicle";
        if($vehicletype==1){
            $inquery .=" WHERE vehicle.conditionid=".$vehicletype." AND vehicle.makeid = make.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemake ,";
        }elseif($vehicletype==2){
            $inquery .=" WHERE vehicle.conditionid=".$vehicletype." AND vehicle.makeid = make.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemake ,";
        }else{
            $inquery .=" WHERE vehicle.makeid = make.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemake ,";

        }
        $inquery .="(SELECT COUNT(vehicle.modelid) FROM `#__js_auto_vehicles` AS vehicle";
        if($vehicletype==1){
            $inquery .=" WHERE vehicle.conditionid=".$vehicletype." AND vehicle.modelid = model.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemodel";
        }elseif($vehicletype==2){
            $inquery .=" WHERE vehicle.conditionid=".$vehicletype." AND vehicle.modelid = model.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemodel";
        }else{
            $inquery .=" WHERE vehicle.modelid = model.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemodel";
        }
        $query =  "SELECT   make.id AS makeid, make.title AS maketitle , model.id AS modelid,model.title AS modeltitle ,";
        $query .= $inquery;
        $query .=  " FROM `#__js_auto_makes` AS make
        LEFT JOIN `#__js_auto_models`  AS model ON make.id = model.makeid
        LEFT JOIN `#__js_auto_vehicles` AS vehicle ON (make.id = vehicle.makeid AND model.id = vehicle.modelid)
         GROUP BY model.id ORDER BY make.id ASC ";
        ////$query .=  " ORDER BY make.title ";
        $db->setQuery($query);
        $vehiclemakes=$db->loadObjectList();
        return $vehiclemakes;

    }
    function getVehiclebyMakesModelsNotTotal($vehicletype){
		if($vehicletype) if(! is_numeric($vehicletype)) return false;
        $db = &$this->getDBO();

        $query =  "SELECT   make.id AS makeid, make.title AS maketitle , model.id AS modelid,model.title AS modeltitle ";
        $query .=  " FROM `#__js_auto_makes` AS make
        LEFT JOIN `#__js_auto_models`  AS model ON make.id = model.makeid
        LEFT JOIN `#__js_auto_vehicles`  AS vehicle ON (make.id = vehicle.makeid AND model.id = vehicle.modelid)";
        if($vehicletype==1){
            $query.=" WHERE vehicle.status <> 0 AND vehicle.addexpiryvalue  >= CURDATE() AND vehicle.conditionid=".$vehicletype." GROUP BY model.id ";
        }elseif($vehicletype==2){
            $query.=" WHERE vehicle.status <> 0 AND vehicle.addexpiryvalue  >= CURDATE() AND vehicle.conditionid=".$vehicletype." GROUP BY model.id ";
        }else{
            $query.="WHERE vehicle.status <> 0 AND vehicle.addexpiryvalue  >= CURDATE() GROUP BY model.id ";

        }
        ////$query .=  " ORDER BY make.title ";
        $db->setQuery($query);
        $vehiclemakes=$db->loadObjectList();
        return $vehiclemakes;

    }
    function getVehiclebyMakes($vehicletype){
		if($vehicletype) if(! is_numeric($vehicletype)) return false;
        $db = &$this->getDBO();
        $query =  "SELECT make.id AS makeid, make.title AS maketitle ,count(vehicle.id) AS totalvehiclemake
                FROM `#__js_auto_makes` AS make 
                left join `#__js_auto_vehicles` as vehicle on vehicle.makeid = make.id 
                where date(vehicle.addexpiryvalue) > curdate() AND vehicle.conditionid=$vehicletype and vehicle.makeid = make.id
                and vehicle.status = 1
                GROUP BY make.id ";
        //$query .=  " ORDER BY make.title ";
        $db->setQuery($query);
        $vehiclemakes=$db->loadObjectList();
        return $vehiclemakes;

    }
    function getVehiclebyModels(){
        $db = &$this->getDBO();
        $inquery =  " (SELECT COUNT(vehicle.modelid) from `#__js_auto_vehicles` AS vehicle
        WHERE vehicle.modelid = model.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehiclemodel";

        $query =  "SELECT  DISTINCT model.id, model.title, ";
        $query .= $inquery;
        $query .=  " FROM `#__js_auto_models` AS model
        LEFT JOIN `#__js_auto_vehicles`  AS vehicle ON model.id = vehicle.modelid
        WHERE model.status = 1  ";
        $query .=  " ORDER BY model.title ";
        $db->setQuery($query);
        $vehiclemakes=$db->loadObjectList();
        return $vehiclemakes;

    }
    function getVehiclesbyVehicleType(){
        $db = &$this->getDBO();
        $inquery =  " (SELECT COUNT(vehicle.vehicletypeid) from `#__js_auto_vehicles`  AS vehicle
        WHERE vehicle.vehicletypeid = vehicletype.id AND vehicle.addexpiryvalue  >= CURDATE() ) AS totalvehicletype";

        $query =  "SELECT  DISTINCT vehicletype.id, vehicletype.title, ";
        $query .= $inquery;
        $query .=  " FROM `#__js_auto_vehicletypes` AS vehicletype
        LEFT JOIN `#__js_auto_vehicles` AS vehicle ON vehicletype.id = vehicle.vehicletypeid
        WHERE vehicletype.status = 1 ";
        $query .=  " ORDER BY vehicletype.title ";
        $db->setQuery($query);
        $vehicletypes=$db->loadObjectList();
        return $vehicletypes;

    }
    function getVehiclebyCities(){
        $db = &$this->getDBO();
        $inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles` AS vehicle
        WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND city.code = vehicle.loccity ) AS totalvehiclelbycity,";

        $query =  "(SELECT DISTINCT city.id, city.name,city.countrycode,city.statecode,city.countycode, city.code,";
        $query .= $inquery."1 AS citydta";
        $query .=  " FROM `#__js_auto_cities` AS city
        LEFT JOIN `#__js_auto_vehicles`  AS vehicle ON city.code = vehicle.loccity
        WHERE city.enabled=".$db->Quote('Y');
        $query .=  " ORDER BY city.name )";
        $query .= "UNION";
        $query .= "(SELECT vehicle.id,vehicle.loccity,vehicle.loccountry, vehicle.locstate, vehicle.loccounty,vehicle.loccity, count(vehicle.id) AS jobsbycity,2 AS citydta
        FROM `#__js_auto_vehicles` AS vehicle
        WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND vehicle.loccity != ''
        AND NOT EXISTS ( SELECT id FROM`#__js_auto_cities`  WHERE code = vehicle.loccity) GROUP BY vehicle.loccity)   ";
        $db->setQuery($query);
        $vehiclebycity=$db->loadObjectList();
        return $vehiclebycity;
    }
    function getVehiclebyPrice($start,$end,$gap){
		if($start) if(! is_numeric($start)) return false;
		if($end) if(! is_numeric($end)) return false;
        $db = &$this->getDBO();
        for($i=$start;$i<=$end;$i=$i+$gap){
			if($i != $start) $d = $i+1; else $d = $i;
           $query="SELECT count(vehicle.id) AS total,vehicle.price AS totalbyprice
               FROM `#__js_auto_vehicles` AS vehicle
               WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND vehicle.price BETWEEN ".$d." AND ".($i+$gap);
                $db->setQuery($query);
                $array[]=array('pricestart'=>$d,'priceend'=>($i+$gap),'vehicletotal'=>$db->loadResult());
        }
        return $array;
    }
    function getVehicleByModelYear(){
        $db = &$this->getDBO();
        $inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles`  AS vehicle
        WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND modelyear.id = vehicle.modelyearid ) AS totalvehiclelbymodelyear";

        $query =  "SELECT DISTINCT modelyear.id AS modelid, modelyear.title AS modyear,";
        $query .= $inquery;
        $query .=  " FROM `#__js_auto_modelyears` AS modelyear
        LEFT JOIN `#__js_auto_vehicles`  AS vehicle ON modelyear.id = vehicle.modelyearid";
        $query .=  " ORDER BY modyear DESC ";
        $db->setQuery($query);
        $myear = $db->loadObjectList();
        return $myear;
    }
    function &getFieldsOrdering($fieldfor,$checkpublished = 1) {
		if($fieldfor) if(! is_numeric($fieldfor)) return false;
        $db = &$this->getDBO();
        if($checkpublished) $query =  "SELECT  * FROM `#__js_auto_fieldordering` WHERE published = 1 AND fieldfor =  ". $fieldfor." ORDER BY ordering";
        else $query =  "SELECT  * FROM `#__js_auto_fieldordering` WHERE fieldfor =  ". $fieldfor." ORDER BY ordering";
        $db->setQuery($query);
        $fields = $db->loadObjectList();
        return $fields;
    }
    function &getFieldsOrderingForVehicleOverview($fieldfor) {
        $db = &$this->getDBO();
        $query =  "SELECT  field,published FROM `#__js_auto_fieldordering`
                        WHERE fieldfor =  ". $fieldfor." ORDER BY ordering";
        $db->setQuery($query);
        $fields = $db->loadObjectList();
        foreach($fields AS $field){
            $return_fields[$field->field] = $field->published;
        }
        return $return_fields;
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
        if($title)
            $vehicletypes[] =  array('value' => JText::_(''),'text' => $title);
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
        if($title)
                        $makes[] =  array('value' => JText::_(''),'text' => $title);
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
        if($title)
                $models[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                $models[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $models;
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
    function getVehiclesModelsbyMakeId( $title) {
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_models` WHERE status = 1 ORDER BY title ASC ";
        $db->setQuery( $query );
        $rows = $db->loadObjectList();
        $models = array();
        if($title)
                $models[] =  array('value' => JText::_(''),'text' => $title);
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
        if($title)
                        $modelyears[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                        $modelyears[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $modelyears;
    }
    function getVehiclesConditionForFilter( $title ) {
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
                    $conditions [] =  array('value' => -1,'text' => $title);
        foreach($rows  as $row)	{
                    $conditions [] =  array('value' => $row->id,'text' => $row->title);
        }
        return $conditions ;
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
                    $conditions [] =  array('value' => '','text' => $title);
        foreach($rows  as $row)	{
                    $conditions [] =  array('value' => $row->id,'text' => $row->title);
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
        if($title)
                    $fueltypes[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                    $fueltypes[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $fueltypes;
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
        if($title)
                $cylinders[] =  array('value' => JText::_(''),'text' => $title);
        foreach($rows  as $row)	{
                $cylinders[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $cylinders;
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
                $countries[] =  array('value' => JText::_(''),'text' => JText::_('CHOOSE_COUNTRY'));

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
                $states[] =  array('value' => JText::_(''),'text' => JText::_($title));
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

    function getZipCodes($citycode,$title){
        $db =& JFactory::getDBO();
        $query = "SELECT  * FROM `#__js_auto_zips` WHERE enabled = 'Y' AND citycode = '". $citycode ."' ORDER BY code ASC  ";
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

	function getCaptchaForFormForBuyer(){
		$session = JFactory::getSession();
		$rand=$this->randomBuyer();
		//echo '<br>rand='.$rand;
		$session->set('jsautoz_buyerspamcheckid',$rand , 'jsautoz_buyercheckspamcalc');
		$session->set('jsautoz_buyerrot13', mt_rand(0, 1), 'jsautoz_buyercheckspamcalc');
		
		//echo '<br>setid ='.$session->set('jsautoz_buyerspamcheckid',$rand , 'jsautoz_buyercheckspamcalc');
		//echo '<br>getid ='.$session->get('jsautoz_buyerspamcheckid');
		//exit;
		//echo '<br> var '.$rand;	
		//$_SESSION['jsautozvar']=$rand;
		//$_SESSION['jsautozabc']='abc';	
		// Determine operator
		$operator=2;
		if($operator==2){
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
		if($session->get('jsautoz_buyerrot13', null, 'jsautoz_buyercheckspamcalc') == 1) // ROT13 coding
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_buyerspamcheckresult', str_rot13(base64_encode($operend_1 + $operend_2)), 'jsautoz_buyercheckspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_buyerspamcheckresult', str_rot13(base64_encode($operend_1 + $operend_2 + $operend_3)), 'jsautoz_buyercheckspamcalc');
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_buyerspamcheckresult', base64_encode($operend_1 + $operend_2), 'jsautoz_buyercheckspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_buyerspamcheckresult', base64_encode($operend_1 + $operend_2 + $operend_3), 'jsautoz_buyercheckspamcalc');
		    }
		}
		}
		elseif($tcalc == 2) // Subtraction
		{
		if($session->get('jsautoz_buyerrot13', null, 'jsautoz_buyercheckspamcalc') == 1)
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_buyerspamcheckresult', str_rot13(base64_encode($operend_1 - $operend_2)), 'jsautoz_buyercheckspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_buyerspamcheckresult', str_rot13(base64_encode($operend_1 - $operend_2 - $operend_3)), 'jsautoz_buyercheckspamcalc');
		    }
		}
		else
		{
		    if($operand == 2)
		    {
			$session->set('jsautoz_buyerspamcheckresult', base64_encode($operend_1 - $operend_2), 'jsautoz_buyercheckspamcalc');
		    }
		    elseif($operand == 3)
		    {
			$session->set('jsautoz_buyerspamcheckresult', base64_encode($operend_1 - $operend_2 - $operend_3), 'jsautoz_buyercheckspamcalc');
		    }
		}
		}
		$add_string="";
		$add_string .= '<div><label for="'.$session->get('jsautoz_buyerspamcheckid', null, 'jsautoz_buyercheckspamcalc').'">';

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
		$add_string .= '<input type="text" name="'.$session->get('jsautoz_buyerspamcheckid', null, 'jsautoz_buyercheckspamcalc').'" id="'.$session->get('jsautoz_buyerspamcheckid', null, 'jsautoz_buyercheckspamcalc').'" size="3" class="inputbox '.$rand.' validate-numeric required" value="" required="required" />';
		$add_string .= '</div>';
		
		return $add_string;
	}
    private function randomBuyer()	    {

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
    
    
	private function performChecks()
    {
        $request = JRequest::get();
		$session = JFactory::getSession();
        $type_calc=true;
        if($type_calc)
        {
            if($session->get('jsautoz_buyerrot13', null, 'jsautoz_buyercheckspamcalc') == 1)
            {
                $spamcheckresult = base64_decode(str_rot13($session->get('jsautoz_buyerspamcheckresult', null, 'jsautoz_buyercheckspamcalc')));
            }
            else
            {
                $spamcheckresult = base64_decode($session->get('jsautoz_buyerspamcheckresult', null, 'jsautoz_buyercheckspamcalc'));
            }

            $spamcheck = JRequest::getInt($session->get('jsautoz_buyerspamcheckid', null, 'jsautoz_buyercheckspamcalc'), '', 'post');
	
            $session->clear('jsautoz_buyerrot13', 'jsautoz_buyercheckspamcalc');
            $session->clear('jsautoz_buyerspamcheckid', 'jsautoz_buyercheckspamcalc');
            $session->clear('jsautoz_buyerspamcheckresult', 'jsautoz_buyercheckspamcalc');
            

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
        $session->clear('ip', 'jsautoz_buyercheckspamcalc');
        $session->clear('saved_data', 'jsautoz_buyercheckspamcalc');

        return true;
    }

    
    
    function getExtension($str) 
        {
                 $i = strrpos($str,".");
                 if (!$i) { return ""; }
                 $l = strlen($str) - $i;
                 $ext = substr($str,$i+1,$l);
                 return $ext;
        }
	// module and plugin 
	function mpGetNewVehicleByMake(){
		$db = &$this->getDBO();
		$inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles` AS vehicle
		WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND make.id = vehicle.makeid AND vehicle.conditionid = 1 ) AS totalnewusedvehiclelbymake ";

		$query =  "SELECT DISTINCT make.id AS makeid, make.title AS maketitle,";
		$query .= $inquery;
		$query .=  " FROM `#__js_auto_makes` AS make

		LEFT JOIN `#__js_auto_vehicles`  AS vehicle ON make.id = vehicle.makeid";
		$query .=  " ORDER BY maketitle ";
		//echo '<br>'.$query;
		$db->setQuery($query);
		$make = $db->loadObjectList();
		return $make;
	}
	function mpGetUsedVehicleByMake(){
		$db = &$this->getDBO();
		$inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles` AS vehicle
		WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND make.id = vehicle.makeid AND vehicle.conditionid = 2 ) AS totalnewusedvehiclelbymake ";

		$query =  "SELECT DISTINCT make.id AS makeid, make.title AS maketitle,";
		$query .= $inquery;
		$query .=  " FROM `#__js_auto_makes` AS make
		LEFT JOIN `#__js_auto_vehicles` AS vehicle ON make.id = vehicle.makeid";
		$query .=  " ORDER BY maketitle ";
		//echo '<br>'.$query;
		$db->setQuery($query);
		$usemake = $db->loadObjectList();
		return $usemake;
	}
	function mpGetNewUsedVehicleByMake(){
		$db = &$this->getDBO();
		$inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles` AS vehicle
		WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND make.id = vehicle.makeid  ) AS totalnewusedvehiclelbymake ";

		$query =  "SELECT DISTINCT make.id AS makeid, make.title AS maketitle,";
		$query .= $inquery;
		$query .=  " FROM `#__js_auto_makes` AS make
		LEFT JOIN `#__js_auto_vehicles` AS vehicle ON make.id = vehicle.makeid";
		$query .=  " ORDER BY maketitle ";
		//echo '<br>'.$query;
		$db->setQuery($query);
		$newusemake = $db->loadObjectList();
		return $newusemake;
        }
	
	//end module and plugin
						
}
?>

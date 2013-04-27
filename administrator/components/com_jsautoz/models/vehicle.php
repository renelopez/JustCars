<?php
/**
 * @Copyright Copyright (C) 2012 ... Ahmad Bilal
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , ahmad@burujsolutions.com
 * Created on:	April 05, 2012
 ^
 + Project: 	JS Autoz
 ^ 
*/

defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');
jimport('joomla.html.html');

$option = JRequest :: getVar('option', 'com_jsautoz');


class JSAutozModelVehicle extends JModelLegacy
{
	var $_config = null;
        var $_countries = null;
        var $_dfueltype = null; 
        var $_dcylinder = null;
        var $_dadexpiry =  null;
        var $_dcurrency = null;
        var $_dvehicletype = null;
        var $_dmileage = null;
        var $_dmodelyear = null;
        var $_dtransmission = null;
	
            function __construct(){
			parent :: __construct();
			$user	=& JFactory::getUser();
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
                                        $listcity.="<option value=''>".JText::_('CHOOSE_CITY')."</option>";
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
	function getVehicletitle($vehicleid){

            $db = &$this->getDBO();
            if (is_numeric($vehicleid) == false) return false;
            $query = "SELECT vehicle.title
                FROM `#__js_auto_vehicles` AS vehicle
                    WHERE vehicle.id=".$vehicleid;
            //echo $query;
            $db->setQuery($query);
            $result = $db->loadResult();
            return  $result;

	}
        function getVehiclereviewbyid($vehicleid,$reviewid){
            $db = &$this->getDBO();
            if (is_numeric($vehicleid) == false) return false;
            $query = "SELECT review.*
                FROM `#__js_auto_vehiclerankreview` AS review
                    WHERE review.vehicleid=".$vehicleid;
            if(($reviewid!='')&&($reviewid!=0)){
                $query .=" AND review.id=".$reviewid;
            }
            //echo $query;
            $db->setQuery($query);
            $result = $db->loadObject();
            return  $result;
        }
		
         function storeFuelTypes(){                     //store Fuel Type
			$row = &$this->getTable('fueltype');
			$result=array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isFuelTypeExist($data['title']);
				if ($result1 == 1) {
					$result[0]=3;
					return $result;
				}	
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			$result[0]=true;
			$result[1]=$row->id;
			return $result;
	    }
         function storeCurrency(){                     //store Fuel Type
			$row = &$this->getTable('currency');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0] =false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] =false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isCurrencyExist($data['title']);
				if ($result1 == 1){
					$result[0] = 3;
					return $result;
					
				} 
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] =false;
				return $result;
			}
			$result[0] =true;
			$result[1] =$row->id;
			return $result;
	    }
        function storeVehicleTypes() {                //store Vehicle Types
			$row = &$this->getTable('vehicletype');
			$result= array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]= false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]= false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleTypeExist($data['title']);
				if ($result1 == 1) {
					$result[0]= 3;
					return $result;
					}
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]= false;
				return $result;
			}
			$result[0]= true;
			$result[1]= $row->id;
			return $result;
	    }

		function storeMileageTypes(){                 // store Mileage Type
			$row = &$this->getTable('mileagetype');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isMileageTypeExist($data['title']);
				if ($result1 == 1){
					$result[0]= 3;
					return $result;
			    }
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
				$result[0]=true;
				$result[1]=$row->id;
				return $result;
	    }
		function storeVehicleCountry(){                 // store Vehicle Country
			$row = &$this->getTable('country');
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if ($data['id'] == ''){ // only for new
				$result=$this->isVehicleCountryExist($data['name']);
				if ($result == true) return 3;
                                $returnvalue = $this->makeCountryCode($data['name']);
                                if ($returnvalue == false) return false;
                                else $code = $returnvalue;
			}
        		if (!$data['id'])	$row->code = $code;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
	    }
		function storeVehicleState($ct){                 // store Vehicle Country
			$row = &$this->getTable('state');
			$data = JRequest :: get('post');
			$row->countrycode=$ct;
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if ($data['id'] == ''){ // only for new
				$result=$this->isVehicleStateExist($ct,$data['name']);
				if ($result == true) return 3;
                                $returnvalue = $this->makeStateCode($data['name'], $ct);
                                if ($returnvalue == false) return false;
                                else $code = $returnvalue;
			}
        		if (!$data['id'])	$row->code = $code;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
	    }
	    function storeVehicleCounty($country,$statecode){
			$row = &$this->getTable('county');
			$data = JRequest :: get('post');
			$row->countrycode=$country;
			$row->statecode=$statecode;
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if ($data['id'] == ''){ // only for new
				$result=$this->isVehicleCountyExist($country,$statecode,$data['name']);
				if ($result == 1) return 3;
                                $returnvalue = $this->makeCountyCode($data['name'], $statecode);
                                if ($returnvalue == false) return false;
                                else $code = $returnvalue;
			}
        		if (!$data['id'])	$row->code = $code;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
			
		}
	    function storeVehicleCity($country,$statecode,$countycode){
			$row = &$this->getTable('city');
			$data = JRequest :: get('post');
			$row->countrycode=$country;
			$row->statecode=$statecode;
			$row->countycode=$countycode;
                        if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if ($data['id'] == ''){ // only for new
				$result=$this->isVehicleCityExist($country,$statecode,$countycode,$data['name']);
				if ($result == 1) return 3;
                                $returnvalue = $this->makeCityCode($data['name'], $countycode);
                                if ($returnvalue == false) return false;
                                else $code = $returnvalue;
			}
        		if (!$data['id'])	$row->code = $code;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
			
		}
		function storeVehicleMake(){                //store Vehicle Make
			$row = &$this->getTable('vehiclemake');
			$result = array();
			$data = JRequest :: get('post');
                        if($data['id']!=''){
                            if($_FILES['logo']['size'] !=''){
                                $this->deleteVehicleMakeImage($data['id']);
                            }
                        }
                        if($_FILES['logo']['size'] > 0){ // logo
                                $data['logo'] = $_FILES['logo']['name']; // file name
                        }
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;return $result ;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;return $result ;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleMakeExist($data['title']);
				if ($result1 == 1){ $result[0] = 3;return $result;}
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;return $result ;
			}
                        $makeid = $row->id;
                        if($_FILES['logo']['size'] > 0){ // logo
                                $returnvalue = $this->uploadVehicleMakeLogo($makeid, 0);
                                if($returnvalue == 1) {
									$result[0] = True;
									$result[1] = $row->id;
									return $result;
                                }else $result[0] = 5;return $result;
                        }else{
									$result[0] = true;
									$result[1] = $row->id;
									return $result;
							
							}
	    }


		function uploadVehicleMakeLogo($id, $isdeletefile) {      //upload vehicle image
			if (is_numeric($id) == false) return false;
			$result = array();
			$db =& JFactory::getDBO();
			$configs=$this->getConfiginArray('default');
			$datadirectory = $configs['data_directory'];
			$str=JPATH_BASE;
			$base = substr($str, 0,strlen($str)-14); //remove administrator
			$path =$base.'/'.$datadirectory;
			if (!file_exists($path)){ // create user directory
				 $this->makeDir($path);
			}
			$isupload = false;
			$path= $path . '/make';
			if (!file_exists($path)){ // create user directory
				$this->makeDir($path);
			}
			$path= $path . '/logo';
			if (!file_exists($path)){ // create user directory
				$this->makeDir($path);
			}
			if($_FILES['logo']['size'] > 0){
				$file_name = $_FILES['logo']['name']; // file name
				$file_tmp = $_FILES['logo']['tmp_name']; // actual location

				$ext = $this->getExtension($file_name);
				$ext = strtolower($ext);
				if (($ext != "gif") && ($ext != "jpg") && ($ext != "jpeg") && ($ext != "png")) return 6 ; //file type mistmathc

				$isupload = true;
			}
			if ($isupload){
				move_uploaded_file($file_tmp, $path.'/' . $file_name);
				return 1;
			}else { // DELETE FILES
					if ($isdeletefile == 1){ // this code may not use
							$userpath= $path . '/make'.$id . '/logo';
							$files = glob($userpath.'/*.*');
							array_map('unlink', $files); // delete all file in the direcoty
					}
					return 1;
			}
		}

     function makeDir($path){
		if (!file_exists($path)){ 
			mkdir($path, 0755);
			$ourFileName = $path.'/index.html';
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fclose($ourFileHandle);
		}
	}
   function deleteVehicleMakeImage($id) {         //delete vehicle image
        if ($id == -1) return false;
        $db =& JFactory::getDBO();
        $query = "SELECT vehmake.logo AS vehiclelogo FROM `#__js_auto_makes` AS vehmake WHERE vehmake.id = ".$id;
        $db->setQuery($query);
        $vehmake=$db->loadObject();
        $configs=$this->getConfiginArray('default');
        $datadirectory = $configs['data_directory'];
        $str=JPATH_BASE;
        $base = substr($str, 0,strlen($str)-14); //remove administrator
        $file_name=$vehmake->vehiclelogo;
        $path =$base.'/'.$datadirectory;
        $path= $path . '/make';
        $userpath= $path. '/logo';
        $userpath= $userpath.'/' . $file_name;
        //$files = glob($userpath.'/*.*');
        //array_map('unlink', $files); // delete all file in the direcoty
        unlink($userpath);//delete single image in the direetory
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




            function storeVehicleModel(){       //store vehicle models
			$row = &$this->getTable('vehiclemodel');
			$data = JRequest :: get('post');
			$result = array();
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false; return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false; return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleModelExist($data['title']);
				if ($result1 == 1) {$result[0] = 3; return $result;}
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false; return $result;
			}
			$result[0] = true;
			$result[1] = $row->id;
			return $result;
	    }

 	function storeActivate()
	{
		$db = & JFactory :: getDBO();
		$row = & $this->getTable('config');
		$data = JRequest :: get('post');
		$query = "UPDATE `#__js_auto_config` SET `configvalue` = '".$data['activationkey']."' WHERE `configname` = 'zsat';";
		$db->setQuery( $query );$db->query();
		$query = "UPDATE `#__js_auto_config` SET `configvalue` = '0' WHERE `configname` = 'offline';";
		$db->setQuery( $query );$db->query();
		$query = "UPDATE `#__js_auto_config` SET `configvalue` = '1' WHERE `configname` = 'mcgraph';";
		$db->setQuery( $query );$db->query();
		return true;

	}
        function storeVehicleModelyears(){         //store model year 
			$row = &$this->getTable('vehiclemodelyear');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleModelYearExist($data['title']);
				if ($result1 == 1){
						$result[0]= 3;
						return $result;
				} 
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			$result[0]=true;
			$result[1]=$row->id;
			return $result;
	    }
         function storeVehicleTransmission(){       //store vehicle transmisson
			$row = &$this->getTable('transmission');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false; return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false; return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleTransmissionExist($data['title']);
				if ($result1 == 1){
					$result[0] = 3;
					return $result;
				} 
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			$result[0]=true;
			$result[1]=$row->id;
			return $result;
	    }
         function storeVehicleAdexpiry(){         //store vehicle adexpiry
			$row = &$this->getTable('adexpiry');
			$result = array();
			$data = JRequest :: get('post');
                        if (is_numeric($data['title']) == false){
							$result[0] = 5;
							return $result;
							
							} 

			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleAdexpiryExist($data['title']);
				if ($result1 == 1){
						$result[0] = 3;
						return $result;
					} 
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			$result[0] = true;
			$result[1] = $row->id;
			return $result;
	    }
         function storeVehicleCylinder(){      //storeVehicleCylinder
			$row = &$this->getTable('cylinder');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleCylinderExist($data['title']);
				if ($result1 == 1) {
						$result[0]=3;
						return $result;
					}
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			$result[0]=true;
			$result[1]=$row->id;
			return $result;
	    }
         function storeVehicleCondition(){              //storeVehicleCondition
			$row = &$this->getTable('condition');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleConditionExist($data['title']);
				if ($result1 == 1){
					$result[0]=3;
					return $result;

					} 

			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0]=false;
				return $result;
			}
			$result[0]=true;
			$result[1]=$row->id;
			return $result;
	    }
         function storeVehicleCategory(){              //storeVehicleCategory
			$row = &$this->getTable('category');
			$result = array();
			$data = JRequest :: get('post');
			if (!$row->bind($data)){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			if (!$row->check()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			if ($data['id'] == ''){ // only for new
				$result1=$this->isVehicleCategoryExist($data['title']);
				if ($result1 == 1) {
					$result[0] = 3;
					return $result;

					}
			}
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				$result[0] = false;
				return $result;
			}
			$result[0] = true;
			$result[1] = $row->id;
			return $result;
	    }
		function storeUserField(){

			$db =& JFactory::getDBO();
			$row = & $this->getTable('userfield');

			$data = JRequest :: get('post');

			if (!$row->bind($data))	{
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			if (!$row->check()) {
				$this->setError($this->_db->getErrorMsg());
				return 2;
			}
			if (!$row->store())	{
				$this->setError($this->_db->getErrorMsg());
				return false;
			}
			// add in field ordering
			if ($data['id'] == '') { // only for new
				$query ="INSERT INTO #__js_auto_fieldordering
						(field, fieldtitle, ordering, section, fieldfor, published, sys, cannotunpublished)
						VALUES(". $row->id .",'". $data['title'] ."', ( SELECT max(ordering)+1 FROM #__js_auto_fieldordering AS field WHERE fieldfor = " . $data['fieldfor'] . "), ''
						, " . $data['fieldfor'] . "," . $data['published'] . " ,0,0)
				";
				$db->setQuery( $query );
				if (!$db->query()) {
					return false;
				}
			}

			// store values
			$ids = $data['jsIds'];
			$names = $data['jsNames'];
			$values = $data['jsValues'];
			$fieldvaluerow = & $this->getTable('userfieldvalue');

			for ($i=0; $i <= $data['valueCount'];$i++) {

				$fieldvaluedata = array();
                                if(isset($ids[$i])) $fieldvaluedata['id'] = $ids[$i];
                                else $fieldvaluedata['id'] = $data['id'];
				//$fieldvaluedata['id'] = '';
				$fieldvaluedata['field'] = $row ->id;
				$fieldvaluedata['fieldtitle'] = $names[$i];
				$fieldvaluedata['fieldvalue'] = $values[$i];
				$fieldvaluedata['ordering'] = $i + 1;
				$fieldvaluedata['sys'] = 0;

				if (!$fieldvaluerow->bind($fieldvaluedata))	{
					$this->setError($this->_db->getErrorMsg());
					return false;
				}
				if (!$fieldvaluerow->store())	{
					$this->setError($this->_db->getErrorMsg());
					return false;
				}

			}

			return true;
		}
                function storeVehicleUserFields()  {

                        $db =& JFactory::getDBO();

                        $data = JRequest :: get('post');

                        $fieldvaluerow = & $this->getTable('fieldordering');

                        $userfields = $data['userfield'];
                        $titles = $data['title'];
                        $publisheds = $data['published'];
                        $requireds = $data['required'];
                        $id = $data['id'];
                        for ($i=0; $i <= 15;$i++) {

                        $fieldvaluedata = array();
                                $fieldvaluedata['id'] = $id[$i];
                                $fieldvaluedata['field'] = $userfields[$i];;
                                $fieldvaluedata['fieldtitle'] = $titles[$i];
                                $fieldvaluedata['ordering'] = 141+$i;
                                $fieldvaluedata['section'] = 1000;
                                $fieldvaluedata['fieldfor'] = 2;
                                $fieldvaluedata['published'] = $publisheds[$i];
                                $fieldvaluedata['sys'] = 0;
                                $fieldvaluedata['cannotunpublish'] = 0;
                                $fieldvaluedata['required'] = $requireds[$i];


                                if (!$fieldvaluerow->bind($fieldvaluedata))	{
                                        $this->setError($this->_db->getErrorMsg());
                                        echo $this->_db->getErrorMsg();
                                        return false;
                                }
                                if (!$fieldvaluerow->store())	{
                                        $this->setError($this->_db->getErrorMsg());
                                        echo $this->_db->getErrorMsg();
                                        return false;
                                }

                        }

                        return true;

                }
                function & getVehicleUserFields()  {
                        $result = array();
                        $db = & JFactory :: getDBO();
                        $query = "SELECT * FROM #__js_auto_fieldordering
                                                WHERE fieldfor = 2
                                                AND (field = 'section_userfields' OR field = 'userfield1' OR field = 'userfield2'
                                                OR field = 'userfield3' OR field = 'userfield4' OR field = 'userfield5' OR field = 'userfield6'
                                                OR field = 'userfield7' OR field = 'userfield8' OR field = 'userfield9' OR field = 'userfield9'
                                                OR field = 'userfield10' OR field = 'userfield11' OR field = 'userfield12' OR field = 'userfield13'
                                                OR field = 'userfield14' OR field = 'userfield15')";
                        $db->setQuery($query);
                        $result = $db->loadObjectList();

                        return $result;
                }
                function deleteUserField() {
                        $cids = JRequest :: getVar('cid', array (0), 'post', 'array');
                        $row = & $this->getTable('userfield');
                        $deleteall = 1;
                        foreach ($cids as $cid)	{
                                if($this->userFieldCanDelete($cid) == true){
                                        if (!$row->delete($cid)){
                                                $this->setError($row->getErrorMsg());
                                                return false;
                                        }
                                }else $deleteall++ ;
                        }
                        return $deleteall;
                }
                function userFieldCanDelete($field){
                        $db = &$this->getDBO();

                        $query = "SELECT COUNT(id) FROM `#__js_auto_userfieldvalues` WHERE field = ". $country->field."	AS total ";
                        $db->setQuery($query);
                        $total = $db->loadResult();

                        if ($total > 0)
                                return false;
                        else
                                return true;
                }
		function deleteVehicle(){
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$cid=$cids[0];
			$db = &$this->getDBO();
                        if($this->vehicleCanDelete($cid) == true){
                            $query = " Delete vehicles,vehoption,vehimage
                                 FROM `#__js_auto_vehicles` AS vehicles
                                LEFT JOIN `#__js_auto_vehicleoptions` AS vehoption ON vehicles.id= vehoption.vehicleid
                                LEFT JOIN `#__js_auto_vehicleimages` AS vehimage ON vehicles.id= vehimage.vehicleid
                                 WHERE vehicles.id = ". $cid;
                            $db->setQuery($query);
							$db->query(); 
                            return true;
                        }else{
                            return FALSE;
                        }

                }
		function vehicleCanDelete($id){                       // dellerCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = "SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE id = ". $id ;
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteFuelType() {                  //deleteFuelType
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('fueltype');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->fuleTypeCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}
		function deleteCurrency(){
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('currency');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->currencyCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
			
			
		}
		function fuleTypeCanDelete($id){                       //fuleTypeCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_fueltypes` WHERE id = ". $id  ;
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
		function currencyCanDelete($id){                       //fuleTypeCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();
			if($id == 1) return true;
			$query = " SELECT COUNT(id) FROM `#__js_auto_currency` WHERE id = ". $id  ;
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
		
	   	function deleteVehicleType() {                //deleteVehicleType
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('vehicletype');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleTypeCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleTypeCanDelete($id){                 //vehicleTypeCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_vehicletypes` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deletemileageType() {                        //deletemileageType
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('mileagetype');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->mileageTypeCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function mileageTypeCanDelete($id){                 //mileageTypeCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_mileagetypes` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleMakeType() {             //deleteVehicleMakeType
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('vehiclemake');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleMakeTypeCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleMakeTypeCanDelete($id){              //vehicleMakeTypeCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();
			$query = " SELECT COUNT(id) FROM `#__js_auto_makes` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleModel() {                  //deleteVehicleModel
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('vehiclemodel');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleModelCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleModelCanDelete($id){                //vehicleModelCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_models` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleModelYear() {              //deleteVehicleModelYear
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('vehiclemodelyear');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleModelYearCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleModelYearCanDelete($id){           //vehicleModelYearCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_modelyears` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleTransmission() {             //deleteVehicleTransmission
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('transmission');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleTransmissionCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}
		function vehicleTransmissionCanDelete($id){               //vehicleTransmissionCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_transmissions` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleAdexpiry() {               //deleteVehicleAdexpiry
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('adexpiry');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleAdexpiryCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleAdexpiryCanDelete($id){             //vehicleAdexpiryCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();
			if ($id == 1) return true;
			$query = " SELECT COUNT(id) FROM `#__js_auto_adexpiries` WHERE id = ". $id ;
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleCylinder(){                 //deleteVehicleCylinder
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('cylinder');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleCylinderCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleCylinderCanDelete($id){                //vehicleCylinderCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = "SELECT COUNT(id) FROM `#__js_auto_cylinders` WHERE id = ". $id ;		
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleCondition(){              //deleteVehicleCondition
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('condition');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleConditionCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}

		function vehicleConditionCanDelete($id){           //vehicleConditionCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_conditions` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}
	   	function deleteVehicleCategory(){              //deleteVehicleCategory
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('category');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleCategoryCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
		}
                function deleteVehicleCountry(){
			$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
			$row = & $this->getTable('country');
			$deleteall = 1;
			foreach ($cids as $cid)	{
				if($this->vehicleCountryCanDelete($cid) == true){
					if (!$row->delete($cid)){
						$this->setError($row->getErrorMsg());
						return false;
					}
				}else $deleteall++ ;
			}
			return $deleteall;
        }
        function vehicleCountryCanDelete($id){    //vehicleCountryCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT code FROM `#__js_auto_countries` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$country = $db->loadObject();

		$query = "SELECT
                    ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE regcountry = ". $db->Quote($country->code) .")
                    + ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE loccountry = ". $db->Quote($country->code) .")
                    + ( SELECT COUNT(id) FROM `#__js_auto_states` WHERE countrycode = ". $db->Quote($country->code) .")
                    AS total ";
		//echo '<br> SQL '.$query;
		$db->setQuery($query);
		$total = $db->loadResult();

		if ($total > 0)
			return false;
		else
			return true;
        }
	function deleteState()
	{
		$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
		$row = & $this->getTable('state');
		$deleteall = 1;
		foreach ($cids as $cid)	{
			if($this->stateCanDelete($cid) == true){
				if (!$row->delete($cid)){
					$this->setError($row->getErrorMsg());
					return false;
				}
			}else $deleteall++ ;
		}
		return $deleteall;
	}
        
	function stateCanDelete($stateid){
		if (is_numeric($stateid) == false) return false;
		$db = &$this->getDBO();

		$query = "SELECT code FROM `#__js_auto_states` WHERE id = ".$stateid;
		$db->setQuery($query);
		$state = $db->loadObject();

		$query = "SELECT
                    ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE regstate = ". $db->Quote($state->code) .")
                    + ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE locstate = ". $db->Quote($state->code) .")
                    + ( SELECT COUNT(id) FROM `#__js_auto_counties` WHERE statecode = ". $db->Quote($state->code) .")
                    AS total ";
		$db->setQuery($query);
		$total = $db->loadResult();

		if ($total > 0)
			return false;
		else
			return true;
	}
	function deleteCounty()
	{
		$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
		$row = & $this->getTable('county');
		$deleteall = 1;
		foreach ($cids as $cid)	{
			if($this->countyCanDelete($cid) == true){
				if (!$row->delete($cid)){
					$this->setError($row->getErrorMsg());
					return false;
				}
			}else $deleteall++ ;
		}
		return $deleteall;
	}
                
	function countyCanDelete($countyid) {
		if (is_numeric($countyid) == false) return false;
		$db = &$this->getDBO();

		$query = "SELECT code FROM `#__js_auto_counties` WHERE id = ".$countyid;
		$db->setQuery($query);
		$county = $db->loadObject();

		$query = "SELECT
                            ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE regcounty = ". $db->Quote($county->code) .")
                            + ( SELECT COUNT(id) FROM `#__js_auto_vehicles` WHERE loccounty = ". $db->Quote($county->code) .")
                            + ( SELECT COUNT(id) FROM `#__js_auto_cities` WHERE countycode = ". $db->Quote($county->code) .")
                            AS total ";
            //echo '<br> SQL '.$query;
		$db->setQuery($query);
		$total = $db->loadResult();
		if ($total > 0)
			return false;
		else
			return true;
	}
	function deleteCity()
	{
		$cids = JRequest :: getVar('cid', array (0), 'post', 'array');
		$row = & $this->getTable('city');
		$deleteall = 1;
		foreach ($cids as $cid)	{
			if($this->cityCanDelete($cid) == true){
				if (!$row->delete($cid)){
					$this->setError($row->getErrorMsg());
					return false;
				}
			}else $deleteall++ ;
		}
		return $deleteall;
	}
	function cityCanDelete($cityid){
		if (is_numeric($cityid) == false) return false;
		$db = &$this->getDBO();

		$query = "SELECT code FROM `#__js_auto_cities` WHERE id = ".$cityid;
		$db->setQuery($query);
		$city = $db->loadObject();

		$query = "SELECT
                            ( SELECT COUNT(id) FROM `#__js_auto_cities` WHERE regcity = ". $db->Quote($city->code) .")
                            + ( SELECT COUNT(id) FROM `#__js_auto_cities` WHERE loccity = ". $db->Quote($city->code) .")
                            AS total ";
		//echo '<br> SQL '.$query;
		$db->setQuery($query);
		$total = $db->loadResult();

		if ($total > 0)
			return false;
		else
			return true;
	}

                function sellerPackageCanDelete($id){    //sellerPackageCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_sellerpackages` WHERE id = ". $id ;
			
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;



                }
		function vehicleCategoryCanDelete($id){           //vehicleCategoryCanDelete
			if (is_numeric($id) == false) return false;
			$db = &$this->getDBO();

			$query = " SELECT COUNT(id) FROM `#__js_auto_categories` WHERE id = ". $id ;
			$db->setQuery($query);
			$total = $db->loadResult();
			if ($total > 0)	return true;
			else return false;
		}



        function &getVehicleforForm($id ) {         //getVehicleforForm
			$db = &$this->getDBO();
			$yesno = array(
				'0' => array('value' => '','text' => JText::_('MARK_SOLD_UNSOLD')),
				'1' => array('value' => 1,'text' => JText::_('SOLD')),
				'2' => array('value' => 0,'text' => JText::_('NOT_SOLD')),);
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehicle.* FROM `#__js_auto_vehicles` AS vehicle WHERE vehicle.id = ".$id;
				$db->setQuery($query);
				$vehicle = $db->loadObject();
				$query = "SELECT vehicleoptions.* FROM `#__js_auto_vehicleoptions` AS vehicleoptions WHERE vehicleoptions.vehicleid =".$id;
				$db->setQuery($query);
				$vehicleoptions = $db->loadObject();
			}
            $title = "";
			$vehicletypeid_req = ''; $makeid_req = '';	$modelid_req = '';	$modelyearid_req = ''; $conditionid_req = '';	
			$fueltypeid_req = ''; $cylinderid_req = '';	$transmissionid_req = ''; $adexpiryid_req = ''; $mileagetypeid_req = '';
            $categoryid_req='';
					
			$fieldorderings =$this->getFieldsOrdering(1);
			$fieldorderings_options =$this->getFieldsOrdering(2);                
			foreach ( $fieldorderings AS $field ){
				switch ($field->field) {
					case "vehicletypeid": if($field->required == 1)$vehicletypeid_req = ' required';break;
					case "makeid": if($field->required == 1)$makeid_req = ' required';break;
					case "modelid": if($field->required == 1){$modelid_req = ' required'; $model_required = 1; }break;
					case "modelyearid": if($field->required == 1)$modelyearid_req = ' required';break;
					case "conditionid": if($field->required == 1)$conditionid_req = ' required';break;
					case "fueltypeid": if($field->required == 1)$fueltypeid_req = ' required';break;
					case "cylinderid": if($field->required == 1)$cylinderid_req = ' required';break;
					case "transmissionid": if($field->required == 1)$transmissionid_req = ' required';break;
					case "adexpiryid": if($field->required == 1)$adexpiryid_req = ' required';break;
					case "mileagetypeid": if($field->required == 1)$mileagetypeid_req = ' required';break;
					case "categoryid": if($field->required == 1)$categoryid_req = ' required';break;
				}
			}
			$countries = $this->getCountries('');
			if ( isset($vehicle) ){
				 $regstates = $this->getStates($vehicle->regcountry, '');
				 $regcounties = $this->getCounties($vehicle->regstate, '');
				 $regcities = $this->getCities($vehicle->regcounty, '');
				 $locstates = $this->getStates($vehicle->loccountry, '');
                                 $loczip = $this->getZipCodes($vehicle->loczip, '');
				 $loccounties = $this->getCounties($vehicle->locstate, '');
				 $loccities = $this->getCities($vehicle->loccounty, '');
				 $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType($title), 'vehicletypeid', 'class="inputbox'.$vehicletypeid_req.'" '. '', 'value', 'text', $vehicle->vehicletypeid);
				 $lists['makes'] = JHTML::_('select.genericList', $this->getVehiclesMakes($title), 'makeid', 'class="inputbox' .$makeid_req.'" '. 'onChange="getvfmodels(this.value,'.$model_required.')"', 'value', 'text', $vehicle->makeid);
				 $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId($vehicle->makeid,$title), 'modelid', 'class="inputbox'.$modelid_req.'" '. '', 'value', 'text', $vehicle->modelid);
				 $lists['categories'] = JHTML::_('select.genericList', $this->getVehiclesCategory($title), 'categoryid', 'class="inputbox '.$categoryid_req.'" '. '', 'value', 'text', '');
				 $lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear($title), 'modelyearid', 'class="inputbox'.$modelyearid_req.'" '. '', 'value', 'text',$vehicle->modelyearid);
				 $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition($title), 'conditionid', 'class="inputbox'.$conditionid_req.'" '. '', 'value', 'text',$vehicle->conditionid );
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
				 $lists['loccountry'] = JHTML::_('select.genericList', $countries, 'loccountry','class="inputbox    " '.'onChange="getlocaddressdata(\'state\', this.value)"', 'value', 'text', $vehicle->loccountry);
				 if ( isset($locstates[1]) ) if ($locstates[1] != '')$lists['locstate'] = JHTML::_('select.genericList', $locstates, 'locstate', 'class="inputbox" '. 'onChange="getlocaddressdata(\'county\', this.value)"', 'value', 'text',$vehicle->locstate);
				 if ( isset($loccounties[1]) ) if ($loccounties[1] != '')$lists['loccounty'] = JHTML::_('select.genericList', $loccounties, 'loccounty', 'class="inputbox" '. 'onChange="getlocaddressdata(\'city\', this.value)"', 'value', 'text',$vehicle->loccounty);
				 if ( isset($loccities[1]) ) if ($loccities[1] != '')$lists['loccity'] = JHTML::_('select.genericList', $loccities, 'loccity', 'class="inputbox" '. 'onChange="getlocaddressdata(\'zip\', this.value)"', 'value', 'text', $vehicle->loccity);
                                 if ( isset($loczip[1]) ) if ($loczip[1] != '')$lists['zipcode'] = JHTML::_('select.genericList', $loczip, 'loczip', '', 'value', 'text', $vehicle->loczip);

				 $lists['status'] = JHTML::_('select.genericList', $this->getStatusforCombo($title), 'status', 'class="inputbox required" '. '', 'value', 'text', $vehicle->status);
				 $lists['isold'] = JHTML::_('select.genericList', $yesno, 'issold', 'class="inputbox " '. '', 'value', 'text', $vehicle->issold);
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
                                $vehiclemakes = $this->getVehiclesMakes($title);
				if($configs['defaultcountry'])$regstates = $this->getStates($configs['defaultcountry'], '');
				$locstates = $regstates;
				//if($configs['defaultcountry'])$locstates = $this->getStates($configs['defaultcountry'], '');
				$lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType($title), 'vehicletypeid', 'class="inputbox'.$vehicletypeid_req.'" '. '', 'value', 'text', $this->_dvehicletype);
				$lists['makes'] = JHTML::_('select.genericList', $vehiclemakes, 'makeid', 'class="inputbox required" '. 'onChange="getvfmodels(this.value,'.$model_required.')"', 'value', 'text', '');
				$lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId($vehiclemakes[0]['value'],$title), 'modelid', 'class="inputbox'.$modelid_req.'" '. '', 'value', 'text', '');
				$lists['categories'] = JHTML::_('select.genericList', $this->getVehiclesCategory($title), 'categoryid', 'class="inputbox'.$categoryid_req.' " '. '', 'value', 'text', '');
				$lists['modelyears'] = JHTML::_('select.genericList', $this->getVehiclesModelYear($title), 'modelyearid', 'class="inputbox'.$modelyearid_req.'" '. '', 'value', 'text', $this->_dmodelyear);
				$lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition($title), 'conditionid', 'class="inputbox'.$conditionid_req.'" '. '', 'value', 'text', '');
				$lists['fueltypes'] = JHTML::_('select.genericList', $this->getVehiclesFuelType($title), 'fueltypeid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text', $this->_dfueltype);
				$lists['cylinders'] = JHTML::_('select.genericList', $this->getVehiclesCylinders($title), 'cylinderid', 'class="inputbox'.$cylinderid_req.'" '. '', 'value', 'text', $this->_dcylinder);
                                $lists['currency'] = JHTML::_('select.genericList', $this->getCurrency($title), 'currencyid', 'class="inputbox'.$fueltypeid_req.'" '. '', 'value', 'text',$this->_dcurrency);
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
				 $lists['status'] = JHTML::_('select.genericList', $this->getStatusforCombo($title), 'status', 'class="inputbox required" '. '', 'value', 'text', '1');
				 $lists['isold'] = JHTML::_('select.genericList', $yesno, 'issold', 'class="inputbox " '. '', 'value', 'text', '');
			}
			if(isset($vehicle)) $result[0] = $vehicle;
			if(isset($vehicleoptions)) $result[1] = $vehicleoptions;
			$result[2] = $lists;
			$result[3] = $fieldorderings;
			$result[4]= $fieldorderings_options;
			$result[5] = $this->getUserFieldsForForm(1, $id); // job fields , ref id
			return $result;

    }

    function &getUserFieldsForForm($fieldfor, $id) {
            $db = &$this->getDBO();
            //if (isset($id) == false) return false;
            $result;
            //if (is_numeric($id) == false) return $result;
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
        function &getFieldsOrdering($fieldfor) {               //getFieldsOrdering
			$db = &$this->getDBO();
			$query =  "SELECT  * FROM `#__js_auto_fieldordering`
			WHERE published = 1 AND fieldfor =  ". $fieldfor." ORDER BY ordering";
			$db->setQuery($query);
			$fields = $db->loadObjectList();
			return $fields;
		}
		function & getUserFieldbyId($c_id)
		{
			if (is_numeric($c_id) == false) return false;
			$result = array();
			$db = & JFactory :: getDBO();
			$query = "SELECT * FROM #__js_auto_userfields WHERE id = ".$c_id;
			$db->setQuery($query);
			$result[0] = $db->loadObject();

			$query = "SELECT * FROM #__js_auto_userfieldvalues WHERE field = ".$c_id;
			$db->setQuery($query);
			$result[1] = $db->loadObjectList();

			return $result;
		}
        function &getVehicleTypeforForm($id ) {             //getVehicleTypeforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehicletype.*
				FROM `#__js_auto_vehicletypes` AS vehicletype
				WHERE vehicletype.id = ".$id;
				$db->setQuery($query);
				$vehicletype= $db->loadObject();
			}
			return $vehicletype;
		}
		function &getFuelTypeforForm($id ) {             //getFuelTypeforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT fueltype.*
				FROM `#__js_auto_fueltypes` AS fueltype
				WHERE fueltype.id = ".$id;
				$db->setQuery($query);
				$fueltype= $db->loadObject();
			}
			return $fueltype;
		}
		function &getCurrencyforForm($id){
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT currency.*
				FROM `#__js_auto_currency` AS currency
				WHERE currency.id != 1 AND currency.id = ".$id;
				$db->setQuery($query);
				$currency= $db->loadObject();
			}
			return $currency;
		}
        function &getMileageTypeforForm($id ) {             //getMileageTypeforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT mileagetype.*
				FROM `#__js_auto_mileagetypes` AS mileagetype
				WHERE mileagetype.id = ".$id;
				$db->setQuery($query);
				$mileagetype= $db->loadObject();
			}
			return $mileagetype;
		}
        function &getVehicleMakeforForm($id ) {              //getVehicleMakeforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclemake.*
				FROM `#__js_auto_makes` AS vehiclemake
				WHERE vehiclemake.id = ".$id;
				$db->setQuery($query);
				$vehiclemake= $db->loadObject();
			}
			
			return $vehiclemake;
		}
		
        function &getVehicleModelforForm($id ) {             //getVehicleModelforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclemodel.*
				FROM `#__js_auto_models` AS vehiclemodel
				WHERE vehiclemodel.id = ".$id;
				$db->setQuery($query);
				$vehiclemodel= $db->loadObject();
			}
			
			return $vehiclemodel;
		}
        function &getVehicleMake($id) {             //getVehicleModelforForm
			$db = &$this->getDBO();
                        $query = "SELECT make.*
                        FROM `#__js_auto_makes` AS make
                        ORDER BY title ASC ";
                        
                        $db->setQuery($query);
                        $make= $db->loadObjectList();
                        if ($db->getErrorNum()) {
                                echo $db->stderr();
                                return false;
                        }
                        $makes = array();
                                        $makes[] =  array('value' => '','text' => 'ALL');
                        foreach($make  as $row)	{
                                        $makes[] =  array('value' => $row->id,	'text' => $row->title);
                        }
                        if($id){
                            $lists['make'] = JHTML::_('select.genericList', $makes, 'makeid', 'class=inputbox '. '', 'value', 'text', $makes);

                        }else{
                            $lists['make'] = JHTML::_('select.genericList', $makes, 'makeid', 'class=inputbox '. '', 'value', 'text', '');

                        }

			return $lists;
		}
        function &getVehicleMakeTitle($id) {             //getVehicleModelforForm
                        if(!is_numeric($id)) return false;
			$db = &$this->getDBO();
                        $query = "SELECT make.title FROM `#__js_auto_makes` AS make WHERE make.id = ".$id;
                        
                        $db->setQuery($query);
                        $make= $db->loadObject();
                        if(isset($make)) return $make->title;
			else return '';
		}
        function &getVehicleModelyearforForm($id ) {         //getVehicleModelyearforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclemodelyear.*
				FROM `#__js_auto_modelyears` AS vehiclemodelyear
				WHERE vehiclemodelyear.id = ".$id;
				
				$db->setQuery($query);
				$modelyear= $db->loadObject();
			}
			
			return $modelyear;
		}
		function getVehicleAdexpiryforForm($id){               //getVehicleAdexpiryforForm
			$db= &$this->getDBO();
			$result = array();
			$adexpiry=null;

			if($id){
				if (is_numeric($id) == false) return false;
				$query = " SELECT vehicleadexpiry.*
				FROM `#__js_auto_adexpiries` AS vehicleadexpiry
				WHERE vehicleadexpiry.id != 1 AND vehicleadexpiry.id = ".$id;
				$db->setQuery($query);
				$adexpiry = $db->loadObject();
			}
			$adexpirycombo = $this->getAdexpiryForCombo();
			if(isset($adexpiry)){
				$lists['adexpiry'] = JHTML::_('select.genericList', $adexpirycombo, 'type', 'class=inputbox '. '', 'value', 'text', $adexpiry->type);
			}else{        
				$lists['adexpiry'] = JHTML::_('select.genericList', $adexpirycombo, 'type', 'class=inputbox '. '', 'value', 'text', '');
			}
			$result[0] = $adexpiry;
			$result[1] = $lists;
			
			return $result;
		
		}
		function getAdexpiryForCombo(){
			$adexpiry=array(
				'0' => array('value' => 'year','text'=>  JText::_('YEAR')),
				'1' => array('value' => 'month','text'=>  JText::_('MONTH')),
				'2' => array('value' => 'week','text'=> JText::_('WEEK')),
				'3' => array('value' => 'days','text'=> JText::_('DAY') )  );

			return $adexpiry;
		}

        function &getVehicleTransmissionforForm($id ) {          //getVehicleTransmissionforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehicletransmission.*
				FROM `#__js_auto_transmissions` AS vehicletransmission
				WHERE vehicletransmission.id = ".$id;
				
				$db->setQuery($query);
				$transmission= $db->loadObject();
			}
			
			return $transmission;
		}
        function &getVehicleCylinderforForm($id ) {             //getVehicleCylinderforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclecylinder.*
				FROM `#__js_auto_cylinders` AS vehiclecylinder
				WHERE vehiclecylinder.id = ".$id;
				
				$db->setQuery($query);
				$cylinder= $db->loadObject();
			}
			
			return $cylinder;
		}
        function &getVehicleConditionforForm($id ) {              //getVehicleConditionforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclecondition.*
				FROM `#__js_auto_conditions` AS vehiclecondition
				WHERE vehiclecondition.id = ".$id;
				
				$db->setQuery($query);
				$condition= $db->loadObject();
			}
			
			return $condition;
		}
        function &getVehicleCategoryforForm($id ) {              //getVehicleCategoryforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT vehiclecat.*
				FROM `#__js_auto_categories` AS vehiclecat
				WHERE vehiclecat.id = ".$id;
				
				$db->setQuery($query);
				$category= $db->loadObject();
			}
			
			return $category;
		}
        function &getVehicleCountryforForm($id ) {              //getVehicleCountryforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT country.*
				FROM `#__js_auto_countries` AS country
				WHERE country.id = ".$id;
				
				$db->setQuery($query);
				$country= $db->loadObject();
			}

			return $country;
		}
        function &getVehicleStateforForm($id ) {              //getVehicleCountryforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT state.*
				FROM `#__js_auto_states` AS state
				WHERE state.id = ".$id;
				
				$db->setQuery($query);
				$state= $db->loadObject();
			}

			return $state;
		}
        function &getVehicleCountyforForm($id ) {              //getVehicleCountryforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT county.*
				FROM `#__js_auto_counties` AS county
				WHERE county.id = ".$id;
				
				$db->setQuery($query);
				$county= $db->loadObject();
			}

			return $county;
		}
        function &getVehicleCityforForm($id ) {              //getVehicleCountryforForm
			$db = &$this->getDBO();
			if($id){
				if (is_numeric($id) == false) return false;
				$query = "SELECT city.*
				FROM `#__js_auto_cities` AS city
				WHERE city.id = ".$id;
				
				$db->setQuery($query);
				$city= $db->loadObject();
			}

			return $city;
		}
		function changeStatusFuelType($id,$status)	{          //changeStatusFuelType
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('fueltype');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusCurrency($id,$status)	{          //changeStatusFuelType
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('currency');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleType($id,$status)	{            //changeStatusVehicleType
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('vehicletype');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusMileageType($id,$status)	{           //changeStatusMileageType
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('mileagetype');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleMake($id,$status)	{           //changeStatusVehicleMake
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('vehiclemake');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleModel($id,$status)	{              //changeStatusVehicleModel
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('vehiclemodel');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleModelYear($id,$status)	{           //changeStatusVehicleModelYear
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('vehiclemodelyear');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleTransmission($id,$status)	{         //changeStatusVehicleTransmission
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('transmission');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleAdexpiry($id,$status)	{          //changeStatusVehicleAdexpiry
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('adexpiry');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleCylinder($id,$status)	{          //changeStatusVehicleCylinder
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('cylinder');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleCondition($id,$status)	{          //changeStatusVehicleCondition
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('condition');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function changeStatusVehicleCategory($id,$status)	{          //changeStatusVehicleCategory
			if (is_numeric($id) == false) return false;
			if (is_numeric($status) == false) return false;
			$row = &$this->getTable('category');
			$row->id = $id;
			$row->status = $status;
			if (!$row->store()){
				$this->setError($this->_db->getErrorMsg());
				return  false;
			}
			return true;
		}
		function isFuelTypeExist($title){                //isFuelTypeExist
			$db =& JFactory::getDBO();
			
			$query = "SELECT COUNT(id) FROM #__js_auto_fueltypes WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isCurrencyExist($title){                //isFuelTypeExist
			$db =& JFactory::getDBO();
			
			$query = "SELECT COUNT(id) FROM #__js_auto_currency  WHERE id != 1 AND title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleStateExist($countrycode,$title) {          //isVehiclestateExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_states WHERE countrycode=".$db->Quote($countrycode) ." AND name = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return false;
			else return true;
		}
                function makeStateCode($stat, $countrycode)
                {
                        $db =& JFactory::getDBO();
                        $state = str_replace (" ", "", $stat); // remove spaces
                        $totallen = strlen($state);
                        $len = 4;
                        if ($len > $totallen) $len = $totallen;
                        $code = substr($state, 0, $len); 
                        $found = false;
                        $start = 0;
                        while (!$found == true){
                                $query = "SELECT COUNT(id) FROM #__js_auto_states WHERE code = ".$db->Quote($code);
                                $db->setQuery( $query );
                                $result = $db->loadResult();
                                if ($result == 0){
                                        $found = true;
                                        return $code;
                                }else {
                                        $code = substr($state, 0, $len); 
                                        if($len == $totallen) $code .= $countrycode;
                                        if($len > $totallen)	return false;	
                                        $len++;
                                }	
                        }
                }
                
		function isVehicleCountyExist($country,$statecode,$title){
			
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_counties WHERE countrycode=".$db->Quote($country) ."
			AND statecode=".$db->Quote($statecode) ." AND name = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
                function makeCountyCode($count, $statecode)
                {
                        $db =& JFactory::getDBO();
                        $county = str_replace (" ", "", $count); // remove spaces
                        $totallen = strlen($county);
                        $len = 4;
                        if ($len > $totallen) $len = $totallen;
                        $code = substr($county, 0, $len); 
                        $found = false;
                        $start = 0;
                        while (!$found == true){
                                $query = "SELECT COUNT(id) FROM #__js_auto_counties WHERE code = ".$db->Quote($code);
                                $db->setQuery( $query );
                                $result = $db->loadResult();
                                if ($result == 0){
                                        $found = true;
                                        return $code;
                                }else {
                                        $code = substr($county, 0, $len); 
                                        if($len == $totallen){
                                                $county .= $statecode;
                                                $totallen = strlen($county);
                                                $code = substr($county, 0, $len); 
                                        }	
                                        if($len > $totallen)	return false;	
                                        $len++;
                                }	
                        }
                }
                
		function isVehicleCityExist($country,$statecode,$countycode,$title){
			
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_cities WHERE countrycode=".$db->Quote($country) ."
			AND statecode=".$db->Quote($statecode) ."AND countycode=".$db->Quote($countycode) ." AND name = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
			
			
		}
                function makeCityCode($cit, $countycode)
                {
                        $db =& JFactory::getDBO();
                        $city = str_replace (" ", "", $cit); // remove spaces
                        $totallen = strlen($city);
                        $len = 4;
                        if ($len > $totallen) $len = $totallen;
                        $code = substr($city, 0, $len); 
                        $found = false;
                        $start = 0;
                        while (!$found == true){
                                $query = "SELECT COUNT(id) FROM #__js_auto_cities WHERE code = ".$db->Quote($code);
                                $db->setQuery( $query );
                                $result = $db->loadResult();
                                if ($result == 0){
                                        $found = true;
                                        return $code;
                                }else {
                                        $code = substr($city, 0, $len); 
                                        if($len == $totallen){
                                                $city .= $countycode;
                                                $totallen = strlen($city);
                                                $code = substr($city, 0, $len); 
                                        }	
                                        if($len > $totallen)	return false;	
                                        $len++;
                                }	
                        }
                }
                
		function isVehicleCountryExist($title) {          //isVehiclecountryExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_countries WHERE name = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return false;
			else return true;
		}
                function makeCountryCode($country) {
                        
                        $db =& JFactory::getDBO();
                        $code = substr($country, 0, 2); 
                        $found = false;
                        $start = 1;
                        while (!$found == true){
                                $query = "SELECT COUNT(id) FROM #__js_auto_countries WHERE code = ".$db->Quote($code);
                                $db->setQuery( $query );
                                $result = $db->loadResult();
                                if ($result == 0){
                                        $found = true;
                                        return $code;
                                }else {
                                        $code = substr($country, $start, 2); 
                                        $start++;
                                        if($start == strlen($country))	return false;	
                                }	
                        }
                }
		function isVehicleTypeExist($title) {           //isVehicleTypeExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_vehicletypes WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isMileageTypeExist($title) {          //isMileageTypeExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_mileagetypes WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		
		function isVehicleMakeExist($title){        //isVehicleMakeExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_makes WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleModelExist($title){         //isVehicleModelExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_models WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleModelYearExist($title){        //isVehicleModelYearExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_modelyears WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleTransmissionExist($title){             //isVehicleTransmissionExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_transmissions WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleAdexpiryExist($title){              //isVehicleAdexpiryExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_adexpiries WHERE id != 1 AND title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleCylinderExist($title){           //isVehicleCylinderExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_cylinders WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleConditionExist($title){          //isVehicleConditionExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_conditions WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
		function isVehicleCategoryExist($title){          //isVehicleCategoryExist
			$db =& JFactory::getDBO();
			$query = "SELECT COUNT(id) FROM #__js_auto_categories WHERE title = ".$db->Quote($title);
			$db->setQuery( $query );
			$result = $db->loadResult();
			if ($result == 0) return 0;
			else return 1;
		}
        function getCountries( $title ) {                  //getCountries
			if ( !$this->_countries ){
			$db =& JFactory::getDBO();
			$query = "SELECT * FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC ";
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

		function getVehiclesType( $title ) {           //getVehiclesType
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
        function getVehiclesMakes( $title ) {               //getVehiclesMakes
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

        function getVehiclesModel( $title ) {               //getVehiclesModel
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
        function getVehiclesModelsbyMakeId($makeid, $title ){              //getVehiclesModelsbyMakeId
			$db =& JFactory::getDBO();
			$query = "SELECT  id, title FROM `#__js_auto_models` WHERE status = 1 AND makeid = ".$makeid." ORDER BY title ASC ";
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
        function getVehiclesCategory( $title ) {                //getVehiclesCategory
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
        function getVehiclesModelYear( $title ) {                //getVehiclesModelYear
			$db =& JFactory::getDBO();
			$query = "SELECT  id, title FROM `#__js_auto_modelyears` WHERE status = 1 ORDER BY title ASC ";
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
		function getVehiclesCondition( $title ) {          //getVehiclesCondition
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
			foreach($rows  as $row)	{
					$conditions [] =  array('value' => $row->id,	'text' => $row->title);
			}
			return $conditions ;
		}
		function getVehiclesFuelType( $title ) {               //getVehiclesFuelType
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
		function getVehiclesCylinders( $title ) {           //getVehiclesCylinders
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

        function getVehiclesTransmission( $title ) {          //getVehiclesTransmission
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
    function getVehiclesAdexpirie( $title ) { //getVehiclesAdexpirie
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title,type FROM `#__js_auto_adexpiries` WHERE id != 1 AND status = 1 ORDER BY title ASC ";
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

        function getMileagesType( $title ) {           //getMileagesType
			$db =& JFactory::getDBO();
			$query = "SELECT  id, title FROM `#__js_auto_mileagetypes` WHERE status = 1 ORDER BY title ASC ";
			
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
		function &getConfiginArray($configfor) {                  //getConfiginArray
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
		function getStates( $countrycode, $title) {          //getStates
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
				$states[] =  array('value' => JText::_($row->code),	'text' => JText::_($row->name));
			}
			return $states;
		}
		function getCounties( $statecode, $title ) {         //getCounties
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
		function getCities( $countycode, $title ) {           //getCities
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

		function getStatusforCombo( $title ){
			$db =& JFactory::getDBO();
			$status = array();
			if($title)
				$status[] =  array('value' => JText::_(''),'text' => $title);
			$status[] =  array('value' => 1,'text' => JText::_('PUBLISHED'));
			$status[] =  array('value' => 0,'text' => JText::_('UNPUBLISHED'));
			return $status;
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
            function getCurrency( $title ) {
                    $db =& JFactory::getDBO();
                    $query = "SELECT  id, symbol,title FROM `#__js_auto_currency`  WHERE id != 1 AND status = 1 ORDER BY title ASC ";
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
     function getStatus(){

		$values = array();
		$values[] = array('value' => 0,'text' => 'Disable');
		$values[] = array('value' => 1,'text' => 'Enable');
		return $values;
	}


	}
?>


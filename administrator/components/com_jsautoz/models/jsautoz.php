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

$option = JRequest :: getVar('option', 'com_jsautoz');


class JSAutozModelJsautoz extends JModelLegacy
{
    var $_config = null;
    var $_countries = null;

    function __construct(){
            parent :: __construct();
            $user	=& JFactory::getUser();
    }
	function publishedCountry($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_countries` AS country SET country.enabled= 'Y'
				WHERE country.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
		
	}
	function unPublishedCountry($cids){
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_countries` AS country SET country.enabled= 'N'
				WHERE country.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
	}
	function publishedStates($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_states` AS state SET state.enabled= 'Y'
				WHERE state.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
		
	}
	function unPublishedStates($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_states` AS state SET state.enabled= 'N'
				WHERE state.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
	}
	function publishedCounties($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_counties` AS county SET county.enabled= 'Y'
				WHERE county.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
		
	}
	function unpublishedCounties($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_counties` AS county SET county.enabled= 'N'
				WHERE county.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
	}
	function publishedCities($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_cities` AS city SET city.enabled= 'Y'
				WHERE city.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
		
	}
	function unpublishedCities($cids) {
		$db = &$this->getDBO();
		foreach ($cids as $cid)	{
			$query = "UPDATE `#__js_auto_cities` AS city SET city.enabled= 'N'
				WHERE city.id =".$cid;
			$db->setQuery( $query );
			if (!$db->query()) {
					return false;
			}
		}
		return true;
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
	function & getAllUsers($searchname,$searchusername,$searchrole, $limitstart, $limit)
	{
		$db = & JFactory :: getDBO();
		$result = array();

		$query = 'SELECT COUNT(a.id)'
			. ' FROM #__users AS a';
//			. ' LEFT JOIN #__js_job_userroles AS usr ON usr.uid = a.id '
//			. ' LEFT JOIN #__js_job_roles AS role ON role.id = usr.role
//
		$clause=' WHERE ';
		if ($searchname) {
			$query .=  $clause.' LOWER(a.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false );
			$clause='AND';
		}
		if ($searchusername) {
			$query .=  $clause.' LOWER(a.username) LIKE '.$db->Quote( '%'.$db->getEscaped( $searchusername, true ).'%', false );
//			$clause='AND';
		}

                $db->setQuery($query);
		$total = $db->loadResult();
		if ( $total <= $limitstart ) $limitstart = 0;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		$jversion = substr($joomla,0,3);

                if($jversion == '1.5'){
                    $query = 'SELECT a.*'
                            . ' FROM #__users AS a';
                }else{
                    $query = 'SELECT a.*'
                            . ' FROM #__users AS a';
                }
		$clause=' WHERE ';
		if ($searchname) {
			$query .=  $clause.' LOWER(a.name) LIKE '.$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false );
			$clause='AND';
		}
		if ($searchusername) {
			$query .=  $clause.' LOWER(a.username) LIKE '.$db->Quote( '%'.$db->getEscaped( $searchusername, true ).'%', false );
			$clause='AND';
		}
		if ($searchrole)
			$query .=  $clause.' LOWER( role.title) LIKE '.$db->Quote( '%'.$db->getEscaped( $searchrole, true ).'%', false );

		$query .= ' GROUP BY a.id';
		
		$db->setQuery($query,$limitstart, $limit);
		$result[0]= $db->loadObjectList();



		$lists = array();
		if ($searchname) $lists['searchname'] = $searchname;
		if ($searchusername) $lists['searchusername'] = $searchusername;
		if ($searchrole) $lists['searchrole'] = $searchrole;
		$result[1] = $total;
		$result[2] = $lists;
		return $result;
	}

    /* Listing VEHICLE START      */

        function &getVehiclebyIds($id) {
        $db = &$this->getDBO();
        $query = "SELECT vehicles.price,vehicles.created AS created,
			vehicles.id,vehicles.title,
			vehicles.exteriorcolor,vehicles.enginecapacity,vehicletypes.title AS vehicletitle,
			makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
			fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
			conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo
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
			WHERE vehicles.id = ".$id;
        
        $db->setQuery($query);
        $result = $db->loadObject();
        return $result;
    }
    function &getVehicleOverviewbyId($id) {
        if(!is_numeric($id)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleoptions.* FROM `#__js_auto_vehicleoptions` AS vehicleoptions WHERE  vehicleoptions.vehicleid = " . $id;
        $db->setQuery($query);
        $vehicleoptions=$db->loadObject();
        return $vehicleoptions;
    }
    function &getVehicleImagebyId($vehicleid) {
        if(!is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.filename FROM `#__js_auto_vehicleimages` AS vehicleimages
			WHERE vehicleimages.vehicleid = ".$vehicleid." LIMIT 4 " ;
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }
    function &getVehicleSpecificationbyId($id) {
        if(!is_numeric($id)) return false;
        $db = &$this->getDBO();
        $query = "SELECT trans.title AS transmission ,country.name AS regcountry,state.name AS regstate,county.name AS regcounty,city.name AS regcity,
        vehicles.regcounty AS vregcounty,vehicles.regcity AS vregcity,
        vehicles.loccountry AS vloccountry,vehicles.locstate AS vlocstate,vehicles.loccounty AS vloccounty,
        vehicles.loccity AS vloccity,vehicles.created AS created,
        vehicles.price,vehicles.exteriorcolor,vehicles.interiorcolor,vehicles.enginecapacity,
        vehicles.mileages AS mileage,vehicles.id,vehicles.title,vehicles.exteriorcolor,
        vehicletypes.title AS vehicletitle,makes.title maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle , image.filename AS vehiclelogo
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
        LEFT JOIN `#__js_auto_transmissions` AS trans ON vehicles.transmissionid = trans.id
        LEFT JOIN `#__js_auto_countries` AS country ON vehicles.regcountry = country.code
        LEFT JOIN `#__js_auto_states` AS state ON vehicles.regstate = state.code
        LEFT JOIN `#__js_auto_counties` AS county ON vehicles.regcounty = county.code
        LEFT JOIN `#__js_auto_cities` AS city ON vehicles.regcity = city.code
        WHERE vehicles.id = ".$id;
        
        $db->setQuery($query);
        $result = $db->loadObject();
        return $result;
    }
    function &getAllImagebyVehicleId($vehicleid) {
        if(!is_numeric($vehicleid)) return false;
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.filename FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid ;
        
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }

    function checkMakeDefaultImage($data){
        $vehicleid=$data['vehicleid'];
        if(!is_numeric($vehicleid)) return false;
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
    /* LISTING VEHICLE END  */

    function &makeDefaultCurrency($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_currency` AS currency SET currency.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('currency');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
                $this->setError($this->_db->getErrorMsg());
                echo $this->_db->getErrorMsg();
                return false;
        }
        return TRUE;
		
	}
    function &makeFueltypeDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_fueltypes` AS fueltype SET fueltype.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('fueltype');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
                $this->setError($this->_db->getErrorMsg());
                echo $this->_db->getErrorMsg();
                return false;
        }
        return TRUE;
    }
    function &makeVehicletypeDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_vehicletypes` AS vehicletype SET vehicletype.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('vehicletype');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg();
			return false;
        }
        return TRUE;
    }
    function &makeMileageDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_mileagetypes` AS mileagetype SET mileagetype.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('mileagetype');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
                $this->setError($this->_db->getErrorMsg());
                echo $this->_db->getErrorMsg();
                return false;
        }
        return TRUE;
    }
    function &makeModelyearDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_modelyears` AS modelyear SET modelyear.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('vehiclemodelyear');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg();
			return false;
        }
        return TRUE;
    }
    function &makeTransmissionDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_transmissions` AS trans SET trans.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('transmission');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg();
			return false;
        }
        return TRUE;
    }
    function &makeCylinderDefault($id){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_cylinders` AS cylinder SET cylinder.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('cylinder');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg();
			return false;
        }
        return TRUE;
    }
    function &makeAdexpiryDefault($id ){
        $db = &$this->getDBO();
        $query = "UPDATE `#__js_auto_adexpiries` AS adexp SET adexp.isdefault= 0";
        
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        $row = &$this->getTable('adexpiry');
        $row->id=$id;
        $row->isdefault= 1;
        $row->status= 1;
        if (!$row->store()) {
			$this->setError($this->_db->getErrorMsg());
			echo $this->_db->getErrorMsg();
			return false;
        }
        return TRUE;
    }
    function &getAllVehicle($searchtitle,$searchmakeid, $searchmodelid, $searchvehicletypeid , $searchconditionid , $statusid ,$limitstart, $limit){  // get all vehicle
        $db = &$this->getDBO();
        $result = array();
        $status [] =  array('value' => '','text' => JText::_('STATUS'));
        $status [] =  array('value' => 1,'text' => JText::_('APPROVED'));
        $status [] =  array('value' => -1,'text' => JText::_('REJECTED'));

        $lists['title'] = $searchtitle;
        $lists['makes'] = JHTML::_('select.genericList', $this->getVehiclesMakes(JText::_('MAKE')), 'filter_av_makeid', 'class="inputbox" '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', $searchmakeid);
        $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId(1,JText::_('MODEL')), 'filter_av_modelid', 'class="inputbox" '. 'onChange="this.form.submit();"', 'value', 'text', $searchmodelid);
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('TYPES')), 'filter_av_vehicletypeid', 'class="inputbox" '. 'onChange="this.form.submit();"', 'value', 'text', $searchvehicletypeid);
        $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition(JText::_('CONDITION')), 'filter_av_conditionid', 'class="inputbox" '. 'onChange="this.form.submit();"', 'value', 'text',$searchconditionid);
        $lists['status'] = JHTML::_('select.genericList', $status, 'filter_av_statusid', 'class="inputbox" '. 'onChange="this.form.submit();"', 'value', 'text',$statusid);
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicles AS vehicle WHERE vehicle.status <> 0" ;

        if ($searchtitle) $query .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if ($searchmakeid) $query .= " AND vehicle.makeid = ".$searchmakeid;
        if ($searchmodelid) $query .= " AND vehicle.modelid = ".$searchmodelid;
        if ($searchvehicletypeid) $query .=" AND vehicle.vehicletypeid = ".$searchvehicletypeid;
        if ($searchconditionid) $query .=" AND vehicle.conditionid = ".$searchconditionid;
        if ($statusid) $query .=" AND vehicle.status = ".$statusid;
                $db->setQuery($query);
                $total = $db->loadResult();
                if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicle.*,vehicletypes.title AS vehicletitle,
        makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle, currency.symbol
        FROM `#__js_auto_vehicles` AS vehicle
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicle.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicle.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicle.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicle.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicle.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicle.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicle.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicle.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicle.currencyid = currency.id
        WHERE vehicle.status <> 0 AND vehicle.addexpiryvalue >= CURDATE()" ;
        if ($searchtitle) $query .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if ($searchmakeid) $query .= " AND vehicle.makeid = ".$searchmakeid;
        if ($searchmodelid) $query .= " AND vehicle.modelid = ".$searchmodelid;
        if ($searchvehicletypeid) $query .=" AND vehicle.vehicletypeid = ".$searchvehicletypeid;
        if ($searchconditionid) $query .=" AND vehicle.conditionid = ".$searchconditionid;
        if ($statusid) $query .=" AND vehicle.status = ".$statusid;
        $query .=" ORDER BY vehicle.created DESC ";
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        $result[2] = $lists;
        return $result;
    }
    function &getAllUnapprovedVehicle($searchtitle,$searchmakeid, $searchmodelid, $searchvehicletypeid , $searchconditionid , $limitstart, $limit){ //get all unapproved vehicle
        $db = &$this->getDBO();
        $result = array();
        $lists['title'] = $searchtitle;
        $lists['makes'] = JHTML::_('select.genericList', $this->getVehiclesMakes(JText::_('MAKE')), 'filter_av_makeid', 'class="inputbox" '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', $searchmakeid);
        $lists['models'] = JHTML::_('select.genericList', $this->getVehiclesModelsbyMakeId(1,JText::_('MODEL')), 'filter_av_modelid', 'class="inputbox" '. 'onchange="this.form.submit();"', 'value', 'text', $searchmodelid);
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('TYPES')), 'filter_av_vehicletypeid', 'class="inputbox" '. 'onchange="this.form.submit();"', 'value', 'text', $searchvehicletypeid);
        $lists['conditions'] = JHTML::_('select.genericList', $this->getVehiclesCondition(JText::_('CONDITION')), 'filter_av_conditionid', 'class="inputbox" '. 'onchange="this.form.submit();"', 'value', 'text',$searchconditionid);
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicles AS vehicle WHERE vehicle.status = 0" ;
        if ($searchtitle) $query .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if ($searchmakeid) $query .= " AND vehicle.makeid = ".$searchmakeid;
        if ($searchmodelid) $query .= " AND vehicle.modelid = ".$searchmodelid;
        if ($searchvehicletypeid) $query .=" AND vehicle.vehicletypeid = ".$searchvehicletypeid;
        if ($searchconditionid) $query .=" AND vehicle.conditionid = ".$searchconditionid;
                $db->setQuery($query);
                $total = $db->loadResult();
                if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicle.*,vehicletypes.title AS vehicletitle,
        makes.title AS maketitle,models.title AS modeltitle,modelyear.title AS modelyeartitle,
        fueltype.title AS fueltitle,cylinder.title AS cylindertitle ,
        conditions.title AS conditiontitle, cat.title AS cattitle, currency.symbol
        FROM `#__js_auto_vehicles` AS vehicle
        LEFT JOIN `#__js_auto_vehicletypes` AS vehicletypes ON vehicle.vehicletypeid = vehicletypes.id
        LEFT JOIN `#__js_auto_makes` AS makes ON vehicle.makeid =makes.id
        LEFT JOIN `#__js_auto_models` AS models ON vehicle.modelid =  models.id
        LEFT JOIN `#__js_auto_categories` AS cat ON vehicle.categoryid =  cat.id
        LEFT JOIN `#__js_auto_modelyears` AS modelyear ON vehicle.modelyearid = modelyear.id
        LEFT JOIN `#__js_auto_conditions` AS conditions ON vehicle.conditionid = conditions.id
        LEFT JOIN `#__js_auto_fueltypes` AS fueltype ON vehicle.fueltypeid = fueltype.id
        LEFT JOIN `#__js_auto_cylinders` AS cylinder ON vehicle.cylinderid = cylinder.id
        LEFT JOIN `#__js_auto_currency` AS currency ON vehicle.currencyid = currency.id
        WHERE vehicle.status = 0" ;
        if ($searchtitle) $query .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if ($searchmakeid) $query .= " AND vehicle.makeid = ".$searchmakeid;
        if ($searchmodelid) $query .= " AND vehicle.modelid = ".$searchmodelid;
        if ($searchvehicletypeid) $query .=" AND vehicle.vehicletypeid = ".$searchvehicletypeid;
        if ($searchconditionid) $query .=" AND vehicle.conditionid = ".$searchconditionid;
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        $result[2] = $lists;
        return $result;
    }
    function &getAllVehicleTypes($limitstart, $limit){          //get all vehicle types
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_vehicletypes";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_vehicletypes ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllFuelTypes($limitstart, $limit){           //get all fuel types
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_fueltypes";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_fueltypes ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function &getAllCurrency($limitstart, $limit){      //get all currency
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_currency WHERE id != 1";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_currency WHERE id != 1 ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
		
	}
    function & getAllMileAgeTypes($limitstart, $limit){          //get all mile age types
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_mileagetypes";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_mileagetypes ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllMakes($searchtitle,$sortby, $limitstart, $limit){               //get all makes
        $db = & JFactory :: getDBO();
        $result = array();
	$sort = array(
		0=>array('value'=>'','text'=>JText::_('SORT_BY')),
		1=>array('value'=>'ASC','text'=>JText::_('ASCENDING')),
		2=>array('value'=>'DESC','text'=>JText::_('DECENDIND')),
		);

	$lists['sort'] = JHTML::_('select.genericList', $sort, 'sortby', 'class="inputbox" '.'onChange="document.adminForm.submit();"', 'value', 'text', $sortby);
        $query = "SELECT COUNT(id) FROM #__js_auto_makes AS make"  ;
        if ($searchtitle) $query .= " WHERE make.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_makes AS make ";
        if ($searchtitle) $query .= " WHERE make.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if ($sortby)$query .="ORDER BY make.title ".$sortby;
        
        if ($searchtitle) $lists['maketitle']=$searchtitle;
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[2] = $lists;
        $result[1] = $total;
        return $result;
    }
    function & getAllModels($limitstart, $limit){               //get all models
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_models";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_models ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllModelsByMake($mkid,$searchtitle,$sortby,$limitstart, $limit){               //get all models
        $db = & JFactory :: getDBO();
        $result = array();
	$sort = array(
		0=>array('value'=>'','text'=>JText::_('SORT_BY')),
		1=>array('value'=>'ASC','text'=>JText::_('ASCENDING')),
		2=>array('value'=>'DESC','text'=>JText::_('DECENDIND')),
		);

	$lists['sort'] = JHTML::_('select.genericList', $sort, 'sortby', 'class="inputbox" '.'onChange="document.adminForm.submit();"', 'value', 'text', $sortby);
        $query = "SELECT COUNT(id) FROM #__js_auto_models AS model  WHERE model.makeid=".$mkid;
        if ($searchtitle) $query .= " AND model.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_models AS model WHERE model.makeid=".$mkid;
        if ($searchtitle) $query .= " AND model.title LIKE '%".str_replace("'","",$db->quote($searchtitle))."%'";
        if($sortby) $query .="ORDER BY model.title ". $sortby;
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        
        $query = "SELECT title FROM #__js_auto_makes WHERE id=".$mkid;
        $db->setQuery($query);
        if ($searchtitle) $lists['modeltitle']=$searchtitle;
        $result[2] = $db->loadObject();
        $result[3] = $lists;
        return $result;
    }

    function & getAllModelyears($limitstart, $limit){          //get all models year
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_modelyears";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_modelyears ORDER BY title DESC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllTransmissions($limitstart, $limit) {             //get all transmission
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_transmissions";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_transmissions ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllAddExpiries($limitstart, $limit){               //get all adexpires
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_adexpiries WHERE id != 1";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_adexpiries WHERE id != 1 ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllCylinder($limitstart, $limit){       //get all cylinder
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_cylinders";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_cylinders ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllCondition($limitstart, $limit){          // get all condition
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_conditions";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_conditions ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
	function &getInfo(){
		$db = &$this->getDBO();
		$q = "SELECT * FROM `#__js_auto_paymentinfo`";
		$db->setQuery($q);
		$info = $db->loadObject();
		return $info;
	}
    function & getAllCategories($limitstart, $limit){        //get all categories
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_categories";
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT * FROM #__js_auto_categories ORDER BY id ASC";
        
        $db->setQuery($query,$limitstart, $limit);
        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function & getAllCountries($searchname,$limitstart, $limit){          //get all countries
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM #__js_auto_countries";
        if($searchname){
            $wherequery = " WHERE name LIKE '%".$searchname."%' ORDER BY name ASC";
        }else{
            $wherequery = " ORDER BY name ASC";
        }
        $query .= $wherequery;
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;

        $query = "SELECT * FROM #__js_auto_countries ";
        if($searchname){

            $wherequery = " WHERE name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false )." ORDER BY name ASC";
        }else{
            $wherequery = " ORDER BY name ASC";
        }
        $query .= $wherequery;
        $db->setQuery($query,$limitstart, $limit);

        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        if($searchname){
            $lists['searchname'] = $searchname;
            $result[2] = $lists;
        }
        return $result;
    }
    function & getAllCountryStates($searchname,$countrycode, $limitstart, $limit){        //get all country states
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM `#__js_auto_states` WHERE countrycode = ". $db->Quote($countrycode);
        if($searchname){
            $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false );
        }
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;

        $query = "SELECT * FROM `#__js_auto_states` WHERE countrycode = ". $db->Quote($countrycode);
        if($searchname){
            $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false )." ORDER BY name ASC";
        }else{
            $query .= " ORDER BY name ASC";
        }
        $db->setQuery($query,$limitstart, $limit);

        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        if($searchname){
            $lists['searchname'] = $searchname;
            $result[2] = $lists;
        }
        return $result;
    }

    function & getAllStateCounties($searchname,$statecode, $limitstart, $limit)	{         // get all statecounties
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM `#__js_auto_counties` WHERE statecode = ". $db->Quote($statecode);
                if($searchname){
                    $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false );
                }
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;

        $query = "SELECT * FROM `#__js_auto_counties` WHERE statecode = ". $db->Quote($statecode);
                if($searchname){
                    $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false )." ORDER BY name ASC";
                }else{
                    $query .= " ORDER BY name ASC";
                }
         //echo $query;       
        $db->setQuery($query,$limitstart, $limit);

        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        if($searchname){
            $lists['searchname'] = $searchname;
            $result[2] = $lists;
        }
        return $result;
    }
	function & getAllCountyCities($searchname,$countycode, $limitstart, $limit) {          //get all countycities
        $db = & JFactory :: getDBO();
        $result = array();
        $query = "SELECT COUNT(id) FROM `#__js_auto_cities` WHERE countycode = ". $db->Quote($countycode);
                if($searchname){
                    $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false );
                }
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;

        $query = "SELECT * FROM `#__js_auto_cities` WHERE countycode = ". $db->Quote($countycode);
                if($searchname){
                    $query .= " AND name LIKE ".$db->Quote( '%'.$db->getEscaped( $searchname, true ).'%', false )." ORDER BY name ASC";
                }else{
                    $query .= " ORDER BY name ASC";
                }
            //echo $query;       
        $db->setQuery($query,$limitstart, $limit);

        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        if($searchname){
            $lists['searchname'] = $searchname;
            $result[2] = $lists;
        }
        return $result;
    }

 	function getConfigrefer(){
		$db = & JFactory :: getDBO();
		$query = "SELECT * FROM `#__js_auto_config` WHERE configname = 'vehcode' OR configname = 'versioncode' OR configname = 'version' OR configname = 'versioncode' OR configname = 'vtype'";
		$db->setQuery($query);
		$confs = $db->loadObjectList();
                foreach($confs AS $conf){
                    if($conf->configname == 'vehcode') $reference = $conf->configvalue;
                    if($conf->configname == 'versioncode') $vcode = $conf->configvalue;
                    if($conf->configname == 'version') $version = $conf->configvalue;
                    if($conf->configname == 'versioncode') $code = $conf->configvalue;
                    if($conf->configname == 'vtype') $vtype = $conf->configvalue;
                }
		if ($reference == '0'){
			$row  = &$this->getTable('config');
			$reser_med = date('misyHd');
			$reser_med = md5($reser_med);
			$reser_med = md5($reser_med);
			$reser_med = md5($reser_med);
			$reser_med	=	substr($reser_med,3,15);
			$string = md5(time());
			$reser_start	=	substr($string,2,7);
			$reser_end =		substr($reser_med,9,17);
			$value =  $reser_start.$reser_med.$reser_end;

			$query = "UPDATE `#__js_auto_config` SET `configvalue` = '".$value."' WHERE `configname` = 'vehcode';";
			$db->setQuery( $query );$db->query();

		}else $value = 	$reference;

		$result[0] = $value;
		$result[1] = $vcode;
		$result[2] = $version;
		$result[3] = $code;
		$result[4] = $vtype;

		return $result;
	}
    function fieldPublished($val) {
        $cids = JRequest :: getVar('cid', array (0), 'post', 'array');
        $db =& JFactory::getDBO();
        $publishall = 1;
        foreach ($cids as $cid)	{
                    $query = " UPDATE #__js_auto_fieldordering SET published = ".$val." WHERE id = ". $cid." AND cannotunpublished=0" ;
                    $db->setQuery( $query );
                    if (!$db->query()) {
                            return false;
                            //$publishall++ ;
                    }
        }
        return $publishall;
    }

    function fieldOrderingUp($field_id) {
        if (is_numeric($field_id) == false) return false;
        $db =& JFactory::getDBO();
        $query = "UPDATE #__js_auto_fieldordering AS f1, #__js_auto_fieldordering AS f2
							SET f1.ordering = f1.ordering - 1
							WHERE f1.ordering = f2.ordering + 1
							AND f1.fieldfor = f2.fieldfor
							AND f2.id = ". $field_id ." ; " ;
        $db->setQuery( $query );
        if (!$db->query()) { return false;	}
        $query = " UPDATE #__js_auto_fieldordering
							SET ordering = ordering + 1
							WHERE id = ". $field_id .";"
                                ;
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        return true;
    }
    function fieldOrderingDown($field_id) {
        if (is_numeric($field_id) == false) return false;
        $db =& JFactory::getDBO();

        $query = "UPDATE #__js_auto_fieldordering AS f1, #__js_auto_fieldordering AS f2
							SET f1.ordering = f1.ordering + 1
							WHERE f1.ordering = f2.ordering - 1
							AND f1.fieldfor = f2.fieldfor
							AND f2.id = ". $field_id ." ; ";
        $db->setQuery( $query );
        if (!$db->query()) {return false;	}

        $query = " UPDATE #__js_auto_fieldordering
                                SET ordering = ordering - 1
                                WHERE id = ". $field_id .";"	;
        $db->setQuery( $query );
        if (!$db->query()) {
                return false;
        }
        return true;
    }
    function &getSearchOptions() {                     //get search option

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



        $fieldorderings =$this->getFieldsOrdering(1);
        $makes =$this->getVehiclesMakes(JText::_('ALL'));
		$models = array();
        $lists['vehicletypes'] = JHTML::_('select.genericList', $this->getVehiclesType(JText::_('ALL')), 'vehicletypeid', 'class="inputbox" '. '', 'value', 'text', '');
        $lists['makes'] = JHTML::_('select.genericList', $makes, 'makeid', 'class="inputbox " '. 'onChange="getvfsmodels(this.value)"', 'value', 'text', '');
        $lists['models'] = JHTML::_('select.genericList', $models, 'modelid', 'class="inputbox" '. '', 'value', 'text', '');
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

    function &getVehicleSearchResults($searchdata,$limitstart, $limit) {                //get vehicle search result
        $db = &$this->getDBO();
        $wherequery="";
        if ($searchdata['vehicletypeid'] != '') if (is_numeric($searchdata['vehicletypeid']) == false) return false;
        if ($searchdata['vehicletypeid'] != '') $wherequery .= " AND vehicle.vehicletypeid = ".$searchdata['vehicletypeid'];
        if ($searchdata['makeid'] != '') if (is_numeric($searchdata['makeid']) == false) return false;
        if ($searchdata['makeid'] != '') $wherequery .= " AND vehicle.makeid = ".$searchdata['makeid'];
        if (isset($searchdata['conditionid'])) if ($searchdata['conditionid'] != '') if (is_numeric($searchdata['conditionid']) == false) return false;
        if (isset($searchdata['conditionid'])) if ($searchdata['conditionid'] != '') $wherequery .= " AND vehicle.conditionid = ".$searchdata['conditionid'];
        if (isset($searchdata['modelid'])) if ($searchdata['modelid'] != '') if (is_numeric($searchdata['modelid']) == false) return false;
        if (isset($searchdata['modelid'])) if ($searchdata['modelid'] != 0)if ($searchdata['modelid'] != '') $wherequery .= " AND vehicle.modelid = ".$searchdata['modelid'];
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
        if ($searchdata['exteriorcolor'] != '') $wherequery .= " AND vehicle.exteriorcolor LIKE '%".str_replace("'","",$db->quote($searchdata['exteriorcolor']))."%'";
        if (isset($searchdata['title'])) if ($searchdata['title'] != '') $wherequery .= " AND vehicle.title LIKE '%".str_replace("'","",$db->quote($searchdata['title']))."%'";
        if (isset($searchdata['registrationnumber'])) if ($searchdata['registrationnumber'] != '') $wherequery .= " AND vehicle.registrationnumber=".$db->quote($searchdata['registrationnumber']);
        if ($searchdata['regcountry'] != '') $wherequery .= " AND vehicle.regcountry= ".$db->quote($searchdata['regcountry']);
        if ($searchdata['regstate'] != 0) $wherequery .= " AND vehicle.regstate= ".$db->quote($searchdata['regstate']);
        if ($searchdata['regcounty'] != 0) $wherequery .= " AND vehicle.regcounty= ".$db->quote($searchdata['regcounty']);
        if ($searchdata['regcity'] != 0) $wherequery .= " AND vehicle.regcity= ".$db->quote($searchdata['regcity']);
        if ($searchdata['loccountry'] != '') $wherequery .= " AND vehicle.loccountry= ".$db->quote($searchdata['loccountry']);
        if ($searchdata['locstate'] != 0) $wherequery .= " AND vehicle.locstate= ".$db->quote($searchdata['locstate']);
        if ($searchdata['loccounty'] != 0) $wherequery .= " AND vehicle.loccounty= ".$db->quote($searchdata['loccounty']);
        if ($searchdata['loccity'] != 0) $wherequery .= " AND vehicle.loccity= ".$db->quote($searchdata['loccity']);
        if ($searchdata['loczip'] != '') {
            $zipcodes = $this->get_zips_in_range($searchdata['loczip'], $searchdata['radiussearch'], 1, 1); //$zip, $range, $sort=1, $include_base
            $total="";
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
        if (isset($searchdata['enginecapacity'])) if ($searchdata['enginecapacity'] != '') $wherequery .= " AND vehicle.enginecapacity= ".$db->quote($searchdata['enginecapacity']);
        if (isset($searchdata['mileages'])) if ($searchdata['mileages'] != '') $wherequery .= " AND vehicle.mileages BETWEEN ".$db->quote($searchdata['enginecapacity'])." AND ".$db->quote($searchdata['enginecapacity']);
        switch($searchdata['radius_length_type']){
			case "m":$radiuslength = 6378137;break;
			case "km":$radiuslength = 6378.137;break;
			case "mile":$radiuslength = 3963.191;break;
			case "nacmiles":$radiuslength = 3441.596;break;
		}
        $selectdistance = " ";
        if(($searchdata['longitude']!=="")&&($searchdata['latitude']!=="")&&($searchdata['radius']!=="")){
                        $latitude=$searchdata['latitude'];
                        $longitude=$searchdata['longitude'];
                        $radius=$searchdata['radius'];
            
			//$radiussearch = " acos((sin(PI()*$latitude/180)*sin(PI()*job.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*job.latitude/180)*cose(PI()*job.longitude/180 - PI()*$longitude/180)))*$radiuslength <= $radius";
			$radiussearch = " acos((SIN( PI()* $latitude /180 )*SIN( PI()*vehicle.latitude/180 ))+(cos(PI()* $latitude /180)*COS( PI()*vehicle.latitude/180) *COS(PI()*vehicle.longitude/180-PI()* $longitude /180)))* $radiuslength <= $radius";
			$selectdistance = " ,acos((sin(PI()*$latitude/180)*sin(PI()*vehicle.latitude/180))+(cos(PI()*$latitude/180)*cos(PI()*vehicle.latitude/180)*cose(PI()*vehicle.longitude/180 - PI()*$longitude/180)))*$radiuslength AS distance ";
        }
        if(isset($radiussearch) && $radiussearch != '') $wherequery .= " AND ".$radiussearch;
        
        $query = "SELECT count(vehicle.id) FROM `#__js_auto_vehicles` AS vehicle
                WHERE vehicle.status = 1 AND vehicle.addexpiryvalue >= CURDATE()  ";
        $query .= $wherequery;
        
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;
        $query = "SELECT vehicle.*,vehicletypes.title as vehicletypetitle, makes.title as maketitle, models.title as modeltitle,

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
        $query .= $wherequery ." GROUP BY vehicle.id" ;
        
        $db->setQuery($query, $limitstart, $limit);
        $vehicles = $db->loadObjectList();
        $result[0] = $vehicles;
        $result[1] = $total;

        return $result;

    }

    function get_zips_in_range($zip, $range, $sort=1, $include_base) {
                $db =& JFactory::getDBO();
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
    function &getVehiclebyId($id) {          //get vehicle by id
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
    function &getFieldOrdering($fieldfor, $limitstart, $limit){
        $db = &$this->getDBO();
        $result = array();
        $query =  "SELECT  COUNT(fo.id) FROM `#__js_auto_fieldordering` AS fo
                                WHERE published = 1 AND fieldfor = ". $fieldfor;
        $db->setQuery($query);
        $total = $db->loadResult();
        $query =  "SELECT  * FROM `#__js_auto_fieldordering`
                                WHERE published = 1 AND fieldfor = ". $fieldfor;
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        $result[0] = $rows;
        $result[1] = $tatal;
        return  $result;

    }
   function &getUserFieldsForForm($fieldfor, $id)
	{
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
				$query =  "SELECT  * FROM `#__js_auto_userfieldvalues` AS value 
				JOIN `#__js_auto_userfield_data` AS udata ON udata.data = value.id
				WHERE value.field = ". $row->id;
				$db->setQuery($query);
				//echo '<br> sql '.$query;
				$value = $db->loadObject();
				$field[2] = $value;
			}
			$result[] = $field;
			$i++;
		}
		return $result;
	}
    

	function & getUserFields($fieldfor, $limitstart, $limit){
		if (is_numeric($fieldfor) == false) return false;
		$db = & JFactory :: getDBO();
		$result = array();

		$query = 'SELECT COUNT(id) FROM #__js_auto_userfields WHERE fieldfor = '. $fieldfor;
		$db->setQuery($query);
		$total = $db->loadResult();
		if ( $total <= $limitstart ) $limitstart = 0;

		$query = 'SELECT field.* FROM #__js_auto_userfields AS field WHERE fieldfor = '. $fieldfor;
		$query .= ' ORDER BY field.id';

		
		$db->setQuery($query,$limitstart, $limit);
		$this->_application = $db->loadObjectList();

		$result[0] = $this->_application;
		$result[1] = $total;
		return $result;
	}
    function deleteVehicleImages($id, $uid) {             //delete vehicle imsge
        $row = &$this->getTable('vehicleimages');
        $this->deleteVehicleImage($id);
        if (!$row->delete($id))	{
                $this->setError($row->getErrorMsg());
                return false;
        }
        return true;
    }
    function imagesCanDelete($vehicleid, $uid) {          //image can delete
        if (is_numeric($uid) == false) return false;
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
                        return 2;
                else
                        return 1;
        }else return 3; // 	this department is not of this user

    }

    function storeConfig() {
            $row = & $this->getTable('config');
			$db = &$this->getDBO();
            $data = JRequest :: get('post');
            $config = array();
			$query = '';

                foreach ($data as $key=>$value){
					if($key){
						$query = "UPDATE `#__js_auto_config` SET `configvalue` = '".$value."' WHERE `configname` = '".$key."';";
						$db->setQuery( $query );
						$db->query();
					}
				}
			/*
            foreach ($data as $key=>$value){
                    $config['configname'] = $key;
                    $config['configvalue'] = $value;
                    if (!$row->bind($config)){	$this->setError($this->_db->getErrorMsg());	return false;	}
                    if (!$row->store())	{	$this->setError($this->_db->getErrorMsg());	return false;	}
               }
			*/
            return true;

    }
	function storePaymentInfo() {

		$data = JRequest :: get('post');
		$db = &$this->getDBO();
		$query = "DELETE FROM `#__js_auto_paymentinfo`";
		$db->setQuery( $query );
		$db->query();
		
		$query = "INSERT INTO `#__js_auto_paymentinfo` SET transaction =  '".$data['transaction']."', emailaddress = '".$data['emailaddress']."'";
		$db->setQuery( $query );
		if (!$db->query()) {
			return false;
		}

		return true;
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
		if($makedefaultimage==1 OR $for==2) {

				$query = "SELECT vehimg.filename AS filename 
				FROM `#__js_auto_vehicleimages` AS vehimg 
				WHERE vehimg.vehicleid =".$vehid." AND vehimg.isdefault = 1";
				$db->setQuery($query);
				$fileexist = $db->loadObject();
				if($fileexist){
					$configs=$this->getConfiginArray('default');
					$datadirectory = $configs['data_directory'];
					$str=JPATH_BASE;
					$base = substr($str, 0,strlen($str)-14); //remove administrator
					$path =$base.'/'.$datadirectory;
					$vehicleid=$vehid;
					$file_name=$fileexist->filename;
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

    function storeVehicle() {              // check it store vehicle
        $row = &$this->getTable('vehicles');
        $db = &$this->getDBO();
        $data = JRequest :: get('post');
			$adexpid=$data['adexpiryid'];
			$created=$data['created'];
			$date = $created;
			$query ="SELECT adexp.title AS advalue,adexp.type AS adtype
				FROM `#__js_auto_adexpiries` AS adexp
					WHERE adexp.id=".$adexpid;
			$db->setQuery($query);
			$adexp = $db->loadObject();
			$date = strtotime(date("Y-m-d", strtotime($date)) . " +$adexp->advalue $adexp->adtype");
			$row->addexpiryvalue=date("Y-m-d",$date);
			$result=array();
			$configs=$this->getConfiginArray('default');
				$data['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
			if (!$row->bind($data)){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			if (!$row->check()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			if (!$row->store()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			$this->storeUserFieldData($data, $row->id);
			$this->storeVehicleOptions($row->id);
			$result[0]= true;
			$result[1]= $row->id;
			return $result;
    }
    function storeVehicleCopy(){
        $row = &$this->getTable('vehicles');
        $db = &$this->getDBO();
        $data = JRequest :: get('post');
			$data['id']=0;
			$adexpid=$data['adexpiryid'];
			$curdate  =date("Y-m-d H:i:s");
			$data['created'] = $curdate;
			$created=$curdate;
			$date = $created;
			$query ="SELECT adexp.title AS advalue,adexp.type AS adtype
				FROM `#__js_auto_adexpiries` AS adexp
					WHERE adexp.id=".$adexpid;
			$db->setQuery($query);
			$adexp = $db->loadObject();
			$date = strtotime(date("Y-m-d", strtotime($date)) . " +$adexp->advalue $adexp->adtype");
			$row->addexpiryvalue=date("Y-m-d",$date);
			$result=array();
			$configs=$this->getConfiginArray('default');
				$data['description'] = JRequest::getVar('description', '', 'post', 'string', JREQUEST_ALLOWRAW);
			if (!$row->bind($data))	{
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			if (!$row->check()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			if (!$row->store()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					$result[0]= false;
					return $result;
			}
			$this->storeUserFieldData($data, $row->id);
			$this->storeVehicleOptionsCopy($row->id);
			$result[0]= true;
			$result[1]= $row->id;
			return $result;
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
    function storeVehicleOptions($vehicleid) {        //store vehicle option
        $row = &$this->getTable('vehicleoptions');
        $data = JRequest :: get('post');
		$data['id'] = $data['vehicleoptionid'];
		$data['vehicleid'] = $vehicleid;

		if (!$row->bind($data))	{
				$this->setError($this->_db->getErrorMsg());
				echo $this->_db->getErrorMsg();
				return false;
		}
		if (!$row->check())	{
				$this->setError($this->_db->getErrorMsg());
				echo $this->_db->getErrorMsg();
				return false;
		}
		if (!$row->store())	{
				$this->setError($this->_db->getErrorMsg());
				echo $this->_db->getErrorMsg();
				return false;
		}
		return true;
    }
    function storeVehicleOptionsCopy($vehicleid) {        //store vehicle option
        $row = &$this->getTable('vehicleoptions');
        $data = JRequest :: get('post');
			
			$data['id'] = 0;
			$data['vehicleid'] = $vehicleid;

			if (!$row->bind($data))	{
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					return false;
			}
			if (!$row->check()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					return false;
			}
			if (!$row->store()){
					$this->setError($this->_db->getErrorMsg());
					echo $this->_db->getErrorMsg();
					return false;
			}
			return true;
    }

    function storeVehicleImages() {
        $row = &$this->getTable('vehicleimages');
        $data = JRequest :: get('post');
        $row->created=date('Y-m-d H:i:s');
        //while(list($key,$value) = each($_FILES[filename][name]))
        //{
        //if(!empty($value)){   // this will check if any blank field is entered
        $total=count($_FILES['filename']['name']);
          for($i = 0; $i < $total; $i++){
              if($_FILES['filename']['name'][$i] !== ''){
                    if (!$row->bind($data))	{
                            $this->setError($this->_db->getErrorMsg());
                            return false;
                    }
                    if($_FILES['filename']['size'][$i] > 0){ // logo
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
                    if($_FILES['filename']['size'][$i] > 0){ // logo
                            $returnvalue = $this->uploadVehicleImage($i,$imageid, $data['vehicleid'], 0);
                    }
              }

          }

        return $returnvalue;
    }

    function uploadVehicleImage($i,$id, $vehicleid, $isdeletefile) {      //upload vehicle image
        if (is_numeric($id) == false) return false;
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
        $path= $path . '/data';
        if (!file_exists($path)){ // create user directory
			$this->makeDir($path);
        }
        $path= $path . '/vehicle';
        if (!file_exists($path)){ // create user directory
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
					$this->makeDir($userpath);
			}
			$userpath= $userpath. '/images';
			if (!file_exists($userpath)){ // create logo directory
					$this->makeDir($userpath);
			}
			$isupload = true;
        }
        if ($isupload){
			//$files = glob($userpath.'/*.*');
			//array_map('unlink', $files);  //delete all file in directory
			move_uploaded_file($file_tmp, $userpath.'/' . $file_name);
			    $userpath= $userpath. '/thumbs';
			    if (!file_exists($userpath)){ // create logo directory
				$this->makeDir($userpath);
			    }
			//unlink($file_tmp);
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
				$files = glob($userpath.'/*.*');
				array_map('unlink', $files); // delete all file in the direcoty
			}
			return 1;
        }
    }
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
		$file['path_without_file_name_thumb']	= str_replace($file['name'], '', $file['name_original_abs'] . 'thumbs');
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
				if (is_dir($file['path_without_file_name_thumb'])) {

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
		$str=JPATH_BASE;
		$base = substr($str, 0,strlen($str)-14); //remove administrator
		$path =$base.'/'.$datadirectory;
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
				$str=JPATH_BASE;
				$base = substr($str, 0,strlen($str)-14); //remove administrator
				$path =$base.'/'.$datadirectory;
                $path= $path . '/data';
                $path= $path . '/vehicle';
                $userpath= $path . '/vehicle_'.$vehicleid;
                $userpath= $userpath. '/images';
                $userpath= $userpath.'/' . $filename;
		//$title 		= $this->getTitleFromFile($filename , 1);
		$title 		= $filename ;
		$thumbName	= new JObject();

		switch ($size) {
			case 'slideshow':
			$fileNameThumb 	= 'jsautoz_slideshow_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/'. $fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;
			case 'large':
			$fileNameThumb 	= 'jsautoz_l_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/'. $fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;

			case 'medium':
			$fileNameThumb 	= 'jsautoz_m_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' . $fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;
			case 'exmedium':
			$fileNameThumb 	= 'jsautoz_exm_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' . $fileNameThumb, $userpath));
			$thumbName->rel	= str_replace ($title, 'thumbs/' . $fileNameThumb, $userpath);
			break;

			default:
			case 'small':
			$fileNameThumb 	= 'jsautoz_s_'. $title;
			$thumbName->abs	= JPath::clean(str_replace($title, 'thumbs/' . $fileNameThumb, $userpath));
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

		$paramsC = JComponentHelper::getParams('com_jsautoz');
		$enable_thumb_creation = 1;
		$watermarkParams['create'] =  0 ;// Watermark
		$watermarkParams['x'] =  'center' ;
		$watermarkParams['y'] = 'middle' ;
		$crop_thumbnail =  5;// Crop or not
		$crop = 1;

		if ($enable_thumb_creation == 1) {

			$fileResize	= $this->getThumbnailResize($size);

			if (JFile::exists($fileOriginal)) {
				//file doesn't exist, create thumbnail
				if (!JFile::exists($fileThumbnail)) {
					$errorMsg = 'Error4';
					//Don't do thumbnail if the file is smaller (width, height) than the possible thumbnail
					list($width, $height) = GetImageSize($fileOriginal);
					//larger
					//phocagalleryimport('phocagallery.image.imagemagic');
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
		$exmedium_image_width = 150;
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
				$str=JPATH_BASE;
				$base = substr($str, 0,strlen($str)-14); //remove administrator
				//$fileWatermark =$base.'/components/com_jsautoz/images/default_jsautoz50.png';
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

    function makeDir($path){
		if (!file_exists($path)){ 
			mkdir($path, 0755);
			$ourFileName = $path.'/index.html';
			$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
			fclose($ourFileHandle);
		}
	}

    function deleteVehicleImage($id) {         //delete vehicle image
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
        $str=JPATH_BASE;
        $base = substr($str, 0,strlen($str)-14); //remove administrator
        $path =$base.'/'.$datadirectory;
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

        $exmuserpath= $userpath.'/' .'jsautoz_exm_'.$file_name; // for exmedium thumb delete

        unlink($exmuserpath);//delete single image in the direetory
        unlink($muserpath);//delete single image in the direetory
        $luserpath= $userpath.'/' .'jsautoz_l_'.$file_name; // for large thumb delete

        unlink($luserpath);//delete single image in the direetory
        return $vehicleimage;

    }
    function &getVehicleImages($vehicleid) {         //get vehicle image
        $db = &$this->getDBO();
        $query = "SELECT vehicleimages.* FROM `#__js_auto_vehicleimages` AS vehicleimages
        WHERE vehicleimages.vehicleid = ".$vehicleid;
        
        $db->setQuery($query);
        $vehicleimages=$db->loadObjectList();
        return $vehicleimages;;
    }
    function &getFieldsOrdering($fieldfor) {
        $db = &$this->getDBO();
        $query =  "SELECT  * FROM `#__js_auto_fieldordering`
        WHERE published = 1 AND fieldfor =  ". $fieldfor." ORDER BY ordering";
        
        $db->setQuery($query);
        $fields = $db->loadObjectList();
        return $fields;
    }
    function &listModels($val,$req) {               //list models
        $db = &$this->getDBO();
        if($val) if (is_numeric($val) == false) return false;
	$required = '';
        $query  = "SELECT id, title FROM `#__js_auto_models`  WHERE status = 1 AND makeid = ".$val." ORDER BY title ASC";
        $db->setQuery($query);
        $result = $db->loadObjectList();
        if ($req == 1)$required == ' required';
        if (empty($result))	{
			$return_value = "<input class='inputbox".$required."' type='text' name='modelid' size='40' maxlength='100'  />";
        }else {
			$return_value = "<select name='modelid' class='inputbox".$required."' >\n";
			$return_value .= "<option value='0'>". JText::_('SELECT_MODEL') ."</option>\n";
			foreach($result as $row){
				$return_value .= "<option value=\"$row->id\" >$row->title</option> \n" ;
			}
			$return_value .= "</select>\n";
        }
        return $return_value;
    }
    function &listRegAddressData($data,$val) {        //list regaddress data
        $db = &$this->getDBO();
        if ($data=='country') {  // country
			$query  = "SELECT code, name FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC";
			$db->setQuery($query);
			$result = $db->loadObjectList();
			if (empty($result))	{
				$return_value = "<input class='inputbox' type='text' name='regcountry' size='40' maxlength='100'  />";
			}else {
				$return_value = "<select name='regcountry' class='inputbox' geteregaddressdata=\"dochange('state', this.value)\">\n";
				$return_value .= "<option value='0'>". JText::_('CHOOSE_COUNTRY') ."</option>\n";

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
					 $return_value = "<input class='inputbox' type='text' name='regstate' size='40' maxlength='100'  />";
			}else {
				$return_value = "<select name='regstate' class='inputbox' onChange=\"geteregaddressdata('county', this.value)\">\n";
				$return_value .= "<option value='0'>". JText::_('CHOOSE_STATE') ."</option>\n";
				foreach($result as $row){
					$return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
				}
				$return_value .= "</select>\n";
			}
        }else if ($data=='county') {  // county
				$query  = "SELECT code, name from `#__js_auto_counties` WHERE enabled = 'Y' AND statecode= '$val' ORDER BY name ASC";
				$db->setQuery($query);
				$result = $db->loadObjectList();
				if (empty($result))	{
					$return_value = "<input class='inputbox' type='text' name='regcounty' size='40' maxlength='100'  />";
				}else{
					$return_value = "<select name='regcounty' class='inputbox' onChange=\"geteregaddressdata('city', this.value)\">\n";
					$return_value .= "<option value='0'>". JText::_('CHOOSE_COUNTY') ."</option>\n";
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
                                $return_value = "<input class='inputbox' type='text' name='regcity' size='40' maxlength='100'  />";
                }else
                {
                        $return_value = "<select name='regcity' class='inputbox' onChange=\"geteregaddressdata('zipcode', this.value)\">\n";
                        $return_value .= "<option value='0'>". JText::_('CHOOSE_CITY') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->code\" >$row->name</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }

        }
        return $return_value;
    }
    function &listLocAddressData($data, $val) {    // list loc address data
        $db = &$this->getDBO();
        if ($data=='country') {  // country
                $query  = "SELECT code, name FROM `#__js_auto_countries` WHERE enabled = 'Y' ORDER BY name ASC";
                $db->setQuery($query);
                $result = $db->loadObjectList();
                if (empty($result))	{
                        $return_value = "<input class='inputbox' type='text' name='loccountry' id='loccountry' size='40' maxlength='100'  />";
                        }else {
                                $return_value = "<select name='loccountry' id='loccountry' class='inputbox' getlocaddressdata=\"dochange('state', this.value)\">\n";
                                $return_value .= "<option value='0'>". JText::_('CHOOSE_COUNTRY') ."</option>\n";
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
                        $return_value .= "<option value='0'>". JText::_('CHOOSE_STATE') ."</option>\n";
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
                                $return_value .= "<option value='0'>". JText::_('CHOOSE_COUNTY') ."</option>\n";
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
                        $return_value = "<select id='loccity' name='loccity' class='inputbox' onChange=\"getlocaddressdata('zip', this.value)\">\n";
                        $return_value .= "<option value='0'>". JText::_('CHOOSE_CITY') ."</option>\n";
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
                        $return_value = "<input class='inputbox' type='text' name='loczip' size='40' maxlength='100'  />";
                }else
                {
                        $return_value = "<select name='loczip' class='inputbox' onChange=\"getlocaddressdata('', this.value)\">\n";
                        $return_value .= "<option value='0'>". JText::_('CHOOSE_ZIP') ."</option>\n";
                        foreach($result as $row){
                                $return_value .= "<option value=\"$row->id\" >$row->code</option> \n" ;
                        }
                        $return_value .= "</select>\n";
                }
        }
        return $return_value;
    }
    function & getsFieldsOrdering($fieldfor, $limitstart, $limit) {
        $db = & JFactory :: getDBO();
        $result = array();

        $query = 'SELECT COUNT(id) FROM #__js_auto_fieldordering WHERE fieldfor = '. $fieldfor;
        $db->setQuery($query);
        $total = $db->loadResult();
        if ( $total <= $limitstart ) $limitstart = 0;

        $query = 'SELECT field.* 
                    FROM #__js_auto_fieldordering AS field
                    WHERE field.fieldfor = '. $fieldfor;
        $query .= ' ORDER BY field.ordering';

        
        $db->setQuery($query,$limitstart, $limit);

        $result[0] = $db->loadObjectList();
        $result[1] = $total;
        return $result;
    }
    function &getConfig() {
        $db = &$this->getDBO();
        $query = "SELECT * FROM `#__js_auto_config`";
        
        $db->setQuery($query);
        $config = $db->loadObjectList();
        $configs = array();
        foreach($config as $conf)	{
            $configs[$conf->configname] =  $conf->configvalue;
        }
        return $configs;
    }
    function &getConfiginArray($configfor) {          //get configinarray
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
    function getVehiclesType( $title ) {         //get vehicle types
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
    function getVehiclesMakes( $title ) {           //get vehicle makes
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

    function getVehiclesModel( $title ) {        //get vehicle models
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
    function getVehiclesModelsbyMakeId($makeid, $title ){        //get vehicle models by make id
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
    function getVehiclesCategory( $title ) {            //get vehicles category
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
    function getVehiclesModelYear( $title ) {     //get vehicle models year
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
    function getVehiclesCondition( $title ) {          // get vehicle condition
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
    function getVehiclesFuelType( $title ) {        //get vehicle fuel type
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
    function getVehiclesCylinders( $title ) {       //get vehicle cylinders
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

    function getVehiclesTransmission( $title ) {         //get vehicle transmission
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
    function getVehiclesAdexpirie( $title ) {       //get vehicle adexpiries
        $db =& JFactory::getDBO();
        $query = "SELECT  id, title FROM `#__js_auto_adexpiries` WHERE status = 1 AND id != 1 ORDER BY title ASC ";
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
                $adexpiries[] =  array('value' => $row->id,	'text' => $row->title);
        }
        return $adexpiries;
    }

    function getMileagesType( $title ) {             //get mile age type
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


    function getCountries( $title ) {               //get countries
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

    function getStates( $countrycode, $title) {        //get states
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

        foreach($rows as $row){
                $states[] =  array('value' => JText::_($row->code), 'text' => JText::_($row->name));
        }
        return $states;
    }
    function getCounties( $statecode, $title ) {           //get counties
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

        foreach($rows as $row){
                $counties[] =  array('value' => JText::_($row->code),
                                                'text' => JText::_($row->name));
        }
        return $counties;
    }
    function getCities( $countycode, $title ) {             //get cities
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

        foreach($rows as $row){
                $cities[] =  array('value' => JText::_($row->code),
                                                'text' => JText::_($row->name));
        }
        return $cities;
    }

    function loadAddressData() {              //load address data
        $db =& JFactory::getDBO();
        $data = JRequest :: get('post');
        $str=JPATH_BASE;
        $base = substr($str, 0,strlen($str)-14); //remove administrator
        $returncode = 1;
        if ($data['actiontype'] == 1){ // first time
                if($_FILES['loadaddressdata']['size'] > 0){
                        $file_name = $_FILES['loadaddressdata']['name']; // file name
                        $file_tmp = $_FILES['loadaddressdata']['tmp_name']; // actual location
                        $file_size = $_FILES['loadaddressdata']['size']; // file size
                        $file_type = $_FILES['loadaddressdata']['type']; // mime type of file determined by php
                        $file_error = $_FILES['loadaddressdata']['error']; // any error!. get reason here

                        if( !empty($file_tmp)){	// only MS office and text file is accepted.
                                $ext = $this->getExtension($file_name);
                                if (($ext != "txt") && ($ext != "sql") )
                                        return 3; //file type mistmathc
                        }

                        $path =$base.'/components/com_jsautoz/data';
                        if (!file_exists($path)){ // creating data directory
                                //mkdir($path, 0755);
                                $this->makeDir($path);
                        }

                        $path =$base.'/components/com_jsautoz/data/temp';
                        if (!file_exists($path)){ // creating temp directory
                                //mkdir($path, 0755);
                                $this->makeDir($path);
                        }
                        $comp_filename = $path.'/' . $file_name;
                        move_uploaded_file($file_tmp, $path.'/' . $file_name);

                        $myFile = $comp_filename;

                        $fh = fopen($myFile, 'r');
                        $theData = fread($fh, filesize($myFile));
                        fclose($fh);

                        $start = strpos($theData,'###CTYST',0);
                        $end  = strpos($theData,'###CTYED',0);
                        $start = $start + 9;
                        $len  = $end - $start;
                        $country = substr($theData,$start,$len);

                        $prtstart = strpos($theData,'###PRTST',0);
                        $prtend  = strpos($theData,'###PRTED',0);
                        $prtstart = $prtstart + 9;
                        $prtlen  = $prtend - $prtstart;
                        $prt = substr($theData,$prtstart,$prtlen);

                        //if ($country == '' ) return 3;
                        if ($prt == 1){
                                $query = "SELECT count(id) FROM `#__js_auto_country` WHERE countrycode = ".$db->Quote($country);
                                $db->setQuery( $query );
                                $countryresult = $db->loadResult();

                                $query = "SELECT count(id) FROM `#__js_auto_states` WHERE countrycode = ".$db->Quote($country);
                                $db->setQuery( $query );
                                $stateresult = $db->loadResult();
                                if ($stateresult != 0) $returncode = 5;

                                $query = "SELECT count(id) FROM `#__js_auto_counties` WHERE countrycode = ".$db->Quote($country);
                                $db->setQuery( $query );
                                $countyresult = $db->loadResult();
                                if ($countyresult != 0){
                                        if ($returncode != 0) $returncode = 11;
                                        else $returncode = 7;
                                }
                                $query = "SELECT count(id) FROM `#__js_auto_cities` WHERE countrycode = ".$db->Quote($country);
                                $db->setQuery( $query );
                                $cityresult = $db->loadResult();
                                if ($cityresult != 0){
                                        if ($returncode != 0) $returncode = $returncode + 1;
                                        else $returncode = 7;

                                }
                        }
                        if($returncode == 1){
                                $db->setQuery($theData);
                                if ( $result = $db->queryBatch())
                                        return 1;
                                else{
                                        return 2;
                                }
                        }else{
                                $_SESSION['js_address_data_filename'] = $myFile;
                        }
                        return $returncode;
                }

        }elseif($data['actiontype'] == 3){ // delete and insert
                $myFile = $_SESSION['js_address_data_filename'];
                $fh = fopen($myFile, 'r');
                $theData = fread($fh, filesize($myFile));
                fclose($fh);

                $start = strpos($theData,'###CTYST',0);
                $end  = strpos($theData,'###CTYED',0);
                $start = $start + 9;
                $len  = $end - $start;
                $country = substr($theData,$start,$len);

                $countrydata = strpos($theData,'### COUNTRY ###',0);
                $statesdata = strpos($theData,'### STATES ###',0);
                $countiesdata = strpos($theData,'### COUNTIES ###',0);
                $citiesdata = strpos($theData,'### CITIES ###',0);

                if ($countrydata != 0){ // country data exist
                        $query = "DELETE FROM `#__js_auto_country` WHERE countrycode = ".$db->Quote($country);
                        $db->setQuery( $query );
                        $db->query();
                }
                if ($statesdata != 0) { //stats exist
                        $query = "DELETE FROM `#__js_auto_states` WHERE countrycode = ".$db->Quote($country);
                        $db->setQuery( $query );
                        $db->query();
                }
                if ($countiesdata != 0) { //counties exist
                        $query = "DELETE FROM `#__js_auto_counties` WHERE countrycode = ".$db->Quote($country);
                        $db->setQuery( $query );
                        $db->query();
                }
                if ($citiesdata != 0) { //citiesexist
                        $query = "DELETE FROM `#__js_auto_cities` WHERE countrycode = ".$db->Quote($country);
                        $db->setQuery( $query );
                        $db->query();
                }
                $db->setQuery($theData);
                if ( $result = $db->queryBatch())
                        return 1;
                else{
                        return 2;
                }

        }elseif($data['actiontype'] == 4){ // insert
                $myFile = $_SESSION['js_address_data_filename'];
                $fh = fopen($myFile, 'r');
                $theData = fread($fh, filesize($myFile));
                fclose($fh);
                $db->setQuery($theData);
                if ( $result = $db->queryBatch())
                        return 1;
                else{
                        return 2;
                }

        }
    }
    function changeStatusVehicleApprove($id,$status)	{           //cgange status vehicle
        if (is_numeric($id) == false) return false;
        if (is_numeric($status) == false) return false;
        $emailconfigs=$this->getConfiginArray('email');
        $row = &$this->getTable('vehicles');
        $row->id = $id;
        $row->status = $status;
        if (!$row->store()){
                $this->setError($this->_db->getErrorMsg());
                return  false;
        }
        if($emailconfigs['seller_vehicle_approve']==1){
			$this->sendMailToSeller($id,1);

			}
        return true;
    }
    function changeStatusVehicleReject($id,$status)	{           //cgange status vehicle
        if (is_numeric($id) == false) return false;
        if (is_numeric($status) == false) return false;
        $emailconfigs=$this->getConfiginArray('email');
        $row = &$this->getTable('vehicles');
        $row->id = $id;
        $row->status = $status;
        if (!$row->store()){
                $this->setError($this->_db->getErrorMsg());
                return  false;
        }
        if($emailconfigs['seller_vehicle_rejected']==1){
			$this->sendMailToSeller($id,2);

			}
        return true;
    }
    
    function sendMailToSeller($vehicleid,$for){
        $db = &$this->getDBO();
		$emailconfig = $this->getConfiginArray('email');
		$senderName = $emailconfig['mailfromname'];
		$senderEmail = $emailconfig['mailfromaddress'];
		$adminEmail = $emailconfig['adminemailaddress'];
		$vehicleApprove = $emailconfig['seller_vehicle_approve'];
		$vehicleReject = $emailconfig['seller_vehicle_rejected'];
		$paymentApprove = $emailconfig['seller_payment_approve'];
        Switch($for){
                    case 1: // new Vehicle
                        $templatefor = 'vehicle-approval'; $issendemail = $vehicleApprove; break;
                    case 2: // Review admin
                        $templatefor = 'vehicle-rejecting'; $issendemail = $vehicleReject; break;
                    case 3: // Payment Approve
                        $templatefor = 'package-approval'; $issendemail = $paymentApprove; break;
			}
		if ($issendemail == 1){
			$query = "SELECT template.* FROM `#__js_auto_emailtemplates` AS template	WHERE template.templatefor = ".$db->Quote($templatefor);
			$db->setQuery( $query );
			$template = $db->loadObject();
			$msgSubject = $template->subject;
			$msgBody = $template->body;
                    switch($for){
                        case 1: // Approve vehicle
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
							WHERE vehicles.id = ".$vehicleid." AND vehicles.addexpiryvalue >= CURDATE()";
								$db->setQuery($vehiclequery);
								$vehicle = $db->loadObject();
							$comma = '';
							$location="";
							$Email = $vehicle->selleremail;
							$sellerName = $vehicle->sellername;

							if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
							elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
							if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
							elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
							
							if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
							elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
							$location .= $comma.$vehicle->countryname;
							
							if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
							else $vehicletitle=$vehicle->title;


							$msgBody = str_replace('{SELLER_NAME}', $sellerName, $msgBody);
							$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
							$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
							$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
							$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
							$msgBody = str_replace('{LOCATION}', $location, $msgBody);

                        break;
                        case 2: // Reject vehicle
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
							WHERE vehicles.id = ".$vehicleid." AND vehicles.addexpiryvalue >= CURDATE()";
								$db->setQuery($vehiclequery);
								$vehicle = $db->loadObject();
							$comma = '';
							$location="";
							$Email = $vehicle->selleremail;
							$sellerName = $vehicle->sellername;
							if($vehicle->cityname) {$location = $comma.$vehicle->cityname; $comma = ', ';}
							elseif($vehicle->city) {$location = $comma.$vehicle->city; $comma = ', ';}
							if($vehicle->countyname) {$location .= $comma.$vehicle->countyname; $comma = ', ';}
							elseif($vehicle->county) {$location .= $comma.$vehicle->county; $comma = ', ';}
							
							if($vehicle->statename) {$location .= $comma.$vehicle->statename; $comma = ', ';}
							elseif($vehicle->state) {$location .= $comma.$vehicle->state; $comma = ', ';}
							$location .= $comma.$vehicle->countryname;
							
							if($vehicle->title=="")$vehicletitle=$vehicle->maketitle.''.$vehicle->modeltitle;
							else $vehicletitle=$vehicle->title;


							$msgBody = str_replace('{SELLER_NAME}', $sellerName, $msgBody);
							$msgBody = str_replace('{VEHICLE_TITLE}', $vehicletitle, $msgBody);
							$msgBody = str_replace('{MAKE}', $vehicle->maketitle, $msgBody);
							$msgBody = str_replace('{MODEL}', $vehicle->modeltitle, $msgBody);
							$msgBody = str_replace('{MODEL_YEAR}', $vehicle->modelyeartitle, $msgBody);
							$msgBody = str_replace('{LOCATION}', $location, $msgBody);
                        break;
                        case 3:
							$packageid=$vehicleid;
							$query  = "SELECT uid,packageid FROM `#__js_auto_sellerpaymenthistory` WHERE id = ".$packageid ;
							$db->setQuery($query);
							$uid = $db->loadObject();
							if($uid !== ''){
								$query  = "SELECT * FROM `#__js_auto_seller_contact_info` WHERE uid = ".$uid->uid ;
								$db->setQuery($query);
								$sellerdata = $db->loadObject();
							}
							$Email = $sellerdata->email;
							$sellerName = $sellerdata->name;
							$packagequery="SELECT * FROM `#__js_auto_sellerpackages` WHERE id = ".$uid->packageid ;
							$db->setQuery($packagequery);
							$packagequery = $db->loadObject();

							$msgBody = str_replace('{SELLER_NAME}', $sellerName, $msgBody);
							$msgBody = str_replace('{PACKAGE_TITLE}', $packagequery->title, $msgBody);
							$msgBody = str_replace('{PACKAGE_NAME}', $packagequery->title, $msgBody);
							$msgBody = str_replace('{PACKAGE_PRICE}', "$".$packagequery->price, $msgBody);
                        
                        break;
		}
        $message =& JFactory::getMailer();
        $message->addRecipient($Email); //to email
		//echo '<br>Email'.$Email;
		//echo '<br>$senderName'.$senderName;
		//echo '<br>$senderEmail'.$senderEmail;
		//echo '<br> sbj '.$msgSubject;
		//echo '<br> bd '.$msgBody;exit;

        $message->setSubject($msgSubject);
        $message->setBody($msgBody);
        $sender = array( $senderName, $senderEmail );
        $message->setSender($sender);
        $message->IsHTML(true);
        $sent = $message->send();
		return $sent;
		}
        return true;
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



	function & getTemplate($tempfor)
	{
		$db = & JFactory :: getDBO();
		switch($tempfor){
			case 'ew-vh' : $tempatefor = JText::_('vehicle-new'); break;
			case 'vh-ap' : $tempatefor = JText::_('vehicle-approval'); break;
			case 'vh-rj' : $tempatefor = JText::_('vehicle-rejecting'); break;
			case 'pk-by' : $tempatefor = JText::_('package-buy'); break;
			case 'pk-ap' : $tempatefor = JText::_('package-approval'); break;
			case 'by-sl' : $tempatefor = JText::_('buyer-contact-seller'); break;
			case 'ew-rv' : $tempatefor = JText::_('new-review'); break;
			case 'sl-rv' : $tempatefor = JText::_('seller-review'); break;
			case 'vh-al' : $tempatefor = JText::_('vehicle-alert'); break;
			case 'ms-bs' : $tempatefor = JText::_('message-btosemail'); break;
			case 'ms-sb' : $tempatefor = JText::_('message-stobemail'); break;
			case 'tl-fr' : $tempatefor = JText::_('tell-friend'); break;
			case 'vs-vh' : $tempatefor = JText::_('vehicle-visitor'); break;
			case 'dl-ap' : $tempatefor = JText::_('dealer-approval'); break;
		}
		$query = "SELECT * FROM #__js_auto_emailtemplates WHERE templatefor = ".$db->Quote($tempatefor);
		//echo $query;
		$db->setQuery($query);
		$template = $db->loadObject();
		return $template;
	}
	function storeEmailTemplate()
	{
		$row = & $this->getTable('emailtemplate');

		$data = JRequest :: get('post');
		$data['body'] = JRequest::getVar('body', '', 'post', 'string', JREQUEST_ALLOWRAW);

		if (!$row->bind($data))	{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}
		if (!$row->store())	{
			$this->setError($this->_db->getErrorMsg());
			return false;
		}

		return true;

	}

	function & getPaymentMethods(){
            $db = & JFactory :: getDBO();

		$query = "SELECT payment.* FROM #__js_auto_paymentmethods AS payment";
		$db->setQuery($query);
		$package = $db->loadObjectList();

		$result=$package;
		return $result;

	}

    function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
    }
    
    	function &getConfigurationsForForm()
	{
		if (isset($this->_config ) == false){
			$db = &$this->getDBO();

			$query = "SELECT * FROM `#__js_auto_config`";
			$db->setQuery($query);
			$this->_config = $db->loadObjectList();
		}
			foreach($this->_config as $conf)
			{
				if ($conf->configname == "defaultcountry")
					$this->_defaultcountry = $conf->configvalue;
			}
			$countries = $this->getCountries(JText::_('SELECT_COUNTRY'));
			$lists['defaultcountry'] = JHTML::_('select.genericList', $countries, 'defaultcountry', 'class="inputbox" '.'', 'value', 'text', $this->_defaultcountry);

		$result[0] = $this->_config;
		$result[1] = $lists;
		return $result;
	}
	function & makeDefaultTheme($id,$defaultvalue) {
		if (is_numeric($id) == false) return false;
		if (is_numeric($defaultvalue) == false) return false;
		switch($id){
			case '1':$theme = "/black/css/jsautozblack.css";break;
			case '2':$theme = "/pink/css/jsautozpink.css";break;
			case '3':$theme = "/orange/css/jsautozorange.css";break;
			case '4':$theme = "/golden/css/jsautozgolden.css";break;
			case '5':$theme = "/blue/css/jsautozblue.css";break;
			case '6':$theme = "/gray/css/jsautozgray.css";break;
			case '7':$theme = "/green/css/jsautozgreen.css";break;
			case '8':$theme = "/graywhite/css/jsautozgraywhite.css";break;
			case '9':$theme = "/template/css/jsautoztemplate.css";break;
			case '10':$theme = "/red/css/jsautozred.css";break;
		}
		$db = &$this->getDBO();
		$query = "update `#__js_auto_config` as config SET config.configvalue = ".$db->quote($theme)." WHERE config.configname = 'theme'";
		//echo $query;exit;
		$db->setQuery( $query );
		if (!$db->query()) {
			return false;
		}
		return true;
	}
	function markreviewed(){
		$db = $this->getDBO();
		$query = "UPDATE `#__js_auto_config` AS config SET config.configvalue = 1 WHERE config.configname = 'reviewed'";
		$db->setQuery($query);
		if(!$db->query()) return false;
		else return true;
		
	}
	function getTotalVehicle(){
		$db = $this->getDBO();
		$query = "SELECT COUNT(id) FROM `#__js_auto_vehicles`";
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;
	}
    
    
						
}
?>


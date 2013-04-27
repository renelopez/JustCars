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



class JSAutozModelModplug extends JModelLegacy
{
	var $_config = null;
        var $_countries=null;
        var $_stats=null;
	
	function __construct()
	{
		parent :: __construct();

		$user	=& JFactory::getUser();
		
	}

	function mpGetVehicleByMakesModels($condition) { 
		$db = &$this->getDBO();
		switch($condition){
			case 1: $makecondition = "AND makevehicle.conditionid = 1 ";$modelcondition = "AND modelvehicle.conditionid = 1 ";break;
			case 2: $makecondition = "AND makevehicle.conditionid = 2 ";$modelcondition = "AND modelvehicle.conditionid = 2 ";break;
			case 3: $makecondition = "";$modelcondition = "";break;
		}
		$inquery =  " (SELECT COUNT(makevehicle.id) from `#__js_auto_vehicles` AS makevehicle
		WHERE makevehicle.status = 1 AND makevehicle.addexpiryvalue  >= CURDATE() AND make.id = makevehicle.makeid ".$makecondition." ) AS totalvehiclebymake, ";
		
		$inquery .=  " (SELECT COUNT(modelvehicle.id) from `#__js_auto_vehicles` AS modelvehicle
		WHERE modelvehicle.status = 1 AND modelvehicle.addexpiryvalue  >= CURDATE() AND model.id = modelvehicle.modelid ".$modelcondition." ) AS totalvehiclebymodel, ";

		$inquery .=  " (SELECT COUNT(tempmodel.id) from `#__js_auto_models` AS tempmodel WHERE tempmodel.makeid = make.id) AS totalmodelformake ";

		$query =  "SELECT make.id AS makeid, make.title AS maketitle,model.id AS modelid,model.title AS modeltitle,";
		$query .= $inquery;
		$query .=  " FROM `#__js_auto_makes` AS make
					LEFT JOIN `#__js_auto_models` AS model ON make.id = model.makeid";
					
		$query .=  " ORDER BY maketitle ";
		//echo '<br>'.$query;
		$db->setQuery($query);
		$makes = $db->loadObjectList();
		$tempmake = "";
		$totalvehiclebymake = 0;
		$makes_array = array();
		$models_array = array();
		foreach($makes AS $make){
			if($tempmake != $make->maketitle){
				if($tempmake != "") $makes_array[] = array($tempmake,$totalvehiclebymake,$models_array,$tempmakeid);
				$tempmake = $make->maketitle;
				$tempmakeid = $make->makeid;
				$totalvehiclebymake = $make->totalvehiclebymake;
				$models_array = array();
			}	
			$model_temp_array[0] = $make->modeltitle;
			$model_temp_array[1] = $make->totalvehiclebymodel;
			$model_temp_array[2] = $make->modelid;
			$models_array[] = $model_temp_array;
			
		}
		return $makes_array;
	}
	function mpGetNewVehicleByMake() { 
		$db = &$this->getDBO();
		$inquery =  " (SELECT COUNT(vehicle.id) from `#__js_auto_vehicles` AS vehicle
		WHERE vehicle.status = 1 AND vehicle.addexpiryvalue  >= CURDATE() AND make.id = vehicle.makeid AND vehicle.conditionid = 1 ) AS totalnewusedvehiclelbymake ";

		$query =  "SELECT DISTINCT make.id AS makeid, make.title AS maketitle,";
		$query .= $inquery;
		$query .=  " FROM `#__js_auto_makes` AS make

		LEFT JOIN `#__js_auto_vehicles` AS vehicle ON make.id = vehicle.makeid";
		$query .=  " ORDER BY maketitle ";
		//echo '<br>'.$query;
		$db->setQuery($query);
		$make = $db->loadObjectList();
		return $make;
	}
	function mpGetUsedVehicleByMake() {
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
	function mpGetNewUsedVehicleByMake() {
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
	function getExtension($str){
                 $i = strrpos($str,".");
                 if (!$i) { return ""; }
                 $l = strlen($str) - $i;
                 $ext = substr($str,$i+1,$l);
                 return $ext;
	}
	function mpGetJsAutoztheme($theme){
		if ($theme == 1){ // js autoz theme
			$trclass = array("jsautoz_odd", "jsautoz_odd");
			$config = $this->getConfig('default');
			if ($config['theme'] == '/template/css/jsautoztemplate.css') $trclass = array("sectiontableentry1", "sectiontableentry2");
			$document =& JFactory::getDocument();
			$document->addStyleSheet('components/com_jsautoz/themes' . $config['theme']);
		}elseif ($theme == 2){ // template theme
			$trclass = array("sectiontableentry1", "sectiontableentry2");
		}else 	$trclass = array("", ""); //no theme
		return  $trclass ;
	}  
						
}
?>


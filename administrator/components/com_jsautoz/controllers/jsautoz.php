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

jimport('joomla.application.component.controller');

class JSAutozControllerJsautoz extends JControllerLegacy
{

    function __construct() {
            parent :: __construct();

            $this->registerTask('add', 'edit');
    }
    function editvehicle(){                       //editvehicle
            JRequest :: setVar('layout','formvehicle');
            JRequest :: setVar('view','vehicle');
            $this->display();
    }
    function editfeultype()	{                      //editfeultype
            JRequest :: setVar('layout', 'formfueltype');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editcurrency()	{                      //editcurrencys
            JRequest :: setVar('layout', 'formcurrency');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehicletype()	{                  //editvehicletype
            JRequest :: setVar('layout', 'formvehicletype');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }

    function editmileagetype()	{                 //editmileagetype
            JRequest :: setVar('layout', 'formmileagetype');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclemake()	{                 //editvehiclemake
            JRequest :: setVar('layout', 'formvehiclemake');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclemodel()	{               //editvehiclemodel
            JRequest :: setVar('layout', 'formvehiclemodel');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclemodelyear()	{                 //editvehiclemodelyear
            JRequest :: setVar('layout', 'formvehiclemodelyear');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehicletransmission()	{          //editvehicletransmission
            JRequest :: setVar('layout', 'formvehicletransmission');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehicleadexpiry()	{               //editvehicleadexpiry
            JRequest :: setVar('layout', 'formvehicleadexpiry');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecylinder()	{                //editvehiclecylinder
            JRequest :: setVar('layout', 'formvehiclecylinder');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecondition()	{                 //editvehiclecondition
            JRequest :: setVar('layout', 'formvehiclecondition');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecategory(){             //editvehiclecategory
            JRequest :: setVar('layout', 'formvehiclecategory');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function edituserfields()	{                 //edituserfields
            JRequest :: setVar('layout', 'formuserfield');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecountry(){
            JRequest :: setVar('layout', 'formcountry');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclestate   (){
            JRequest :: setVar('layout', 'formstates');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecounty   (){
            JRequest :: setVar('layout', 'formcounty');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }
    function editvehiclecity   (){
            JRequest :: setVar('layout', 'formcity');
            JRequest :: setVar('view', 'vehicle');
            $this->display();
    }

    function makecurrencydefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$currencyid = $cid[0];
		$return_value = $model->makeDefaultCurrency($currencyid);
		if ($return_value == 1)	{
				$msg = JText :: _('CURRENCY_SET_DEFAULT');
		}else{
				$msg = JText :: _('ERROR_IN_CURRENCY_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=currency';
		$this->setRedirect($link, $msg);
	}
    function makevehicletypedefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$vehicletypeid = $cid[0];
		$return_value = $model->makeVehicletypeDefault($vehicletypeid);
		if ($return_value == 1)	{
			$msg = JText::_('VEHICLE_TYPE_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_VEHICLE_TYPE_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
		$this->setRedirect($link, $msg);
    }

    function makemileagedefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$mileageid = $cid[0];
		$return_value = $model->makeMileageDefault($mileageid);
		if ($return_value == 1)	{
			$msg = JText::_('VEHICLE_MILEAGE_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_VEHICLE_MILEAGE_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
		$this->setRedirect($link, $msg);
    }

    function makemodelyeardefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$modelyearid = $cid[0];
		$return_value = $model->makeModelyearDefault($modelyearid);
		if ($return_value == 1)	{
			$msg = JText::_('VEHICLE_MODELYEAR_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_VEHICLE_MODELYEAR_SET_DEFAULT');
		}

		$link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
		$this->setRedirect($link, $msg);
    }
    function maketransmissiondefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$transmissionid = $cid[0];
		$return_value = $model->makeTransmissionDefault($transmissionid);
		if ($return_value == 1)	{
			$msg = JText::_('VEHICLE_TRANSMISSION_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_VEHICLE_TRANSMISSION_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
		$this->setRedirect($link, $msg);
    }

    function makefueltypedefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$fuelid = $cid[0];
		$return_value = $model->makeFueltypeDefault($fuelid);
		if ($return_value == 1)	{
			$msg = JText::_('FUEL_TYPE_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_FUEL_TYPE_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
		$this->setRedirect($link, $msg);
    }
    function makecylinderdefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$cylinderid = $cid[0];
		$return_value = $model->makeCylinderDefault($cylinderid );
		if ($return_value == 1)	{
			$msg = JText::_('CYLINDER_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_CYLINDER_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
		$this->setRedirect($link, $msg);
    }

    function makeadexpirydefault(){
		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
		$adexpid = $cid[0];
		$return_value = $model->makeAdexpiryDefault($adexpid );
		if ($return_value == 1)	{
			$msg = JText::_('AD_EXPIRY_SET_DEFAULT');
		}else{
			$msg = JText::_('ERROR_IN_AD_EXPIRY_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
		$this->setRedirect($link, $msg);
    }

    function listmodels(){              //listmodels
            global $mainframe;
            $mainframe = JFactory::getApplication();
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $val=JRequest::getVar( 'val');
            $req=JRequest::getVar( 'req');
            $model = $this->getModel('jsautoz', 'JSAutozModel');
            $returnvalue = $model->listModels($val,$req);
            echo $returnvalue;
            $mainframe->close();
    }
    function loadaddressdata(){              //loadaddressdata
            $model = & $this->getModel('jsautoz', 'JSAutozModel');
            $data = JRequest :: get('post');
            $return_value = $model->loadAddressData();
            $link = 'index.php?option=com_jsautoz&task=view&layout=loadaddressdata&er=2';
            if ($return_value == 1)	{
                    $msg = JText::_('ADDRESS_DATA_SAVED');
                    $link = 'index.php?option=com_jsautoz&task=view&layout=loadaddressdata';
            }elseif ($return_value == 3){ // file mismatch
                    $msg = JText::_('ADDRESS_DATA_COULD_NOT_SAVE');
            }elseif ($return_value == 3){ // file mismatch
                    $msg = JText::_('FILE_TYPE_ERROR');
            }elseif ($return_value == 5){ // state alredy exist
                    $msg = JText::_('STATES_EXIST');
            }elseif ($return_value == 8){ // county alredy exist
                    $msg = JText::_('COUNTIES_EXIST');
            }elseif ($return_value == 11){ // state and county alredy exist
                    $msg = JText::_('STATES_COUNTIES_EXIST');
            }elseif ($return_value == 7){ // city alredy exist
                    $msg = JText::_('CITIES_EXIST');
            }elseif ($return_value == 6){ // state and city alredy exist
                    $msg = JText::_('STATES_CITIES_EXIST');
            }elseif ($return_value == 9){ // county and city alredy exist
                    $msg = JText::_('COUNTIES_CITIES_EXIST');
            }elseif ($return_value == 12){ // state, counnty and city alredy exist
                    $msg = JText::_('STATES_COUNTIES_CITIES_EXIST');
            }else {
                    $msg = JText::_('ADDRESS_DATA_COULD_NOT_SAVE');
            }
            $this->setRedirect($link, $msg);
    }
    function listregaddressdata() {             //listregaddressdata
                global $mainframe;
                $version = new JVersion;
                $joomla = $version->getShortVersion();
                $jversion = substr($joomla,0,3);
                $mainframe = JFactory::getApplication();
                $data=JRequest::getVar( 'data');
                $val=JRequest::getVar( 'val');
                $model = $this->getModel('jsautoz', 'JSAutozModel');
                $returnvalue = $model->listRegAddressData($data, $val);
                echo $returnvalue;
                $mainframe->close();
	}
    function listdelleraddressdata() {             //listregaddressdata
                global $mainframe;
                $version = new JVersion;
                $joomla = $version->getShortVersion();
                $jversion = substr($joomla,0,3);
                $mainframe = JFactory::getApplication();
                $data=JRequest::getVar( 'data');
                $val=JRequest::getVar( 'val');
                $model = $this->getModel('vehicle');
                $returnvalue = $model->listDellerAddressData($data, $val);
                echo $returnvalue;
                $mainframe->close();
	}
        function getlocmapaddressdata(){
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $val=JRequest::getVar( 'val');
            //echo $val;exit; 
            $model = $this->getModel('vehicle');
            $returnvalue = $model->getLocMapAddressData($val);
            echo json_encode($returnvalue);
            $mainframe->close();
        }

	function saveconf(){

		$model = & $this->getModel('jsautoz', 'JSAutozModel');
		$return_value = $model->storeConfig();

		if ($return_value == 1){
			$msg = JText::_('The Configuration Details have been updated');
		} else {
			$msg = JText::_('ERRORCONFIGFILE');
		}
		$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=configurations';
		$this->setRedirect($link, $msg);

	}
	function listlocaddressdata(){                //listlocaddressdata
			global $mainframe;
			$version = new JVersion;
			$joomla = $version->getShortVersion();
			$jversion = substr($joomla,0,3);
			$mainframe = JFactory::getApplication();
			$data=JRequest::getVar( 'data');
			$val=JRequest::getVar( 'val');
			$model = $this->getModel('jsautoz', 'JSAutozModel');
			$returnvalue = $model->listLocAddressData($data, $val);
			echo $returnvalue;
			$mainframe->close();
	}
	function savevehicle() {              //savevehicle
			global $mainframe;
			$model = $this->getModel('jsautoz', 'JSAutozModel');
			$return_value = $model->storeVehicle(); //check it
			$Itemid = JRequest::getVar( 'Itemid');
			if($return_value[0] == 1){
					$session = JFactory::getSession();
					$session->set('js_autoz_new_vehicleid', $return_value[1]);
					$msg = JText :: _('VEHICLE_SAVE_UPLOAD_IMAGES');
					$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_images&Itemid='.$Itemid;
			}
			$this->setRedirect($link , $msg);
	}
	function savevehiclesave2copy() {              //savevehiclesave2copy
			global $mainframe;
			$model = $this->getModel('jsautoz', 'JSAutozModel');
			$return_value = $model->storeVehicleCopy(); // check it
			$Itemid = JRequest::getVar( 'Itemid');
			if($return_value[0] == 1){
					$session = JFactory::getSession();
					$session->set('js_autoz_new_vehicleid', $return_value[1]);
					$msg = JText :: _('VEHICLE_SAVE_UPLOAD_IMAGES');
					$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_images&Itemid='.$Itemid;
			}
			$this->setRedirect($link , $msg);
	}
	function makedefaultvehicleimage(){
		global $mainframe;
		$model = $this->getModel('jsautoz', 'JSAutozModel');
		$vehid =  JRequest::getVar('vehid');
		$imgid =  JRequest::getVar('imgid');
		$return_value = $model->makeDefaultVehicleImage($vehid, $imgid,2);
		//$return_value = $model->makeDefaultVehicleImage($vehid, $imgid);
		if ($return_value == 1)	{
				$msg = JText :: _('VEHICLE_IMAGE_SET_DEFAULT');
		}else{
				$msg = JText :: _('ERROR_IN_VEHICLE_IMAGE_SET_DEFAULT');
		}
		$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_images&Itemid='.$Itemid;
		$this->setRedirect($link , $msg);
	}


	function savevehiclereview() {

			$model	= &$this->getModel( 'vehicle');
			$return_value = $model->storeVehicleReview();
			if($return_value == true) $msg = JText::_('RECORD_HAS_BEEN_SAVED');
			else $msg = JText::_('RECORD_HAS_NOT_BEEN_SAVED');
			$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=reviewvehicle';
			$this->setRedirect($link, $msg);
	}

	function savefueltype() {                        // Fuel Type
		$redirect=$this->storefueltype('saveclose');
	}
	function savefueltypesave() {                        // savefueltypesave
		$redirect=$this->storefueltype('save');
			
	}
	function savefueltypeandnew() {                        // savefueltypeandnew
		$redirect=$this->storefueltype('saveandnew');
	}
	function storefueltype($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeFuelTypes();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('FUEL_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
				}elseif($callfrom == 'save'){
					$msg = JText::_('FUEL_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formfueltype&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('FUEL_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formfueltype';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formfueltype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('FUEL_TYPE_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formfueltype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_FUEL_TYPE');
				$link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
				$this->setRedirect($link, $msg);
		}
	}
	function savecurrency() {                        // savecurrency
		$redirect=$this->storecurrency('saveclose');
	}
	function savecurrencysave() {                        // savecurrencysave
		$redirect=$this->storecurrency('save');
	}
	function savecurrencyandnew() {                        // savecurrencyandnew
		$redirect=$this->storecurrency('saveandnew');
	}
	function storecurrency($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeCurrency();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('CURRENCY_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=currency';
				}elseif($callfrom == 'save'){
					$msg = JText::_('CURRENCY_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formcurrency&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('CURRENCY_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formcurrency';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formcurrency');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('CURRENCY_TYPE_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formcurrency');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_CURRENCY');
				$link = 'index.php?option=com_jsautoz&task=view&layout=currency';
				$this->setRedirect($link, $msg);
		}
	}

    function savevehicletype() {                     // Vehicle Type
			$redirect=$this->storevehicletype('saveclose');
	}
    function savevehicletypeandnew() {                     // savevehicletypeandnew Type
			$redirect=$this->storevehicletype('saveandnew');
	}
    function savevehicletypesave() {                     // savevehicletypesave 
			$redirect=$this->storevehicletype('save');
	}
    function storevehicletype($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleTypes();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicletype&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_TYPE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicletype';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicletype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_TYPE_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicletype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_VEHICLE_TYPE');
				$link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
				$this->setRedirect($link, $msg);
		}

	}    
    function savemileagetype() {                           //Mileage Type
			$redirect=$this->storemileagetype('saveclose');
	}
    function savemileagetypesave() {                           //savemileagetypesave
			$redirect=$this->storemileagetype('save');
	}
    function savemileagetypeandnew() {                           //savemileagetypeandnew
		$redirect=$this->storemileagetype('saveandnew');
	}
	function storemileagetype($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeMileageTypes();
		if ($return_value[0] == 1)	{
					if($callfrom == 'saveclose'){
                        $msg = JText::_('MILEAGE_TYPE_SAVED');
                        $link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
					}elseif($callfrom == 'save'){
                        $msg = JText::_('MILEAGE_TYPE_SAVED');
                        $link = 'index.php?option=com_jsautoz&view=vehicle&layout=formmileagetype&cid[]='.$return_value[1];
					}elseif($callfrom == 'saveandnew'){
						$msg = JText::_('MILEAGE_TYPE_SAVED');
						$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formmileagetype';
					}
					$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formmileagetype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('MILEAGE_TYPE_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formmileagetype');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_MILEAGE_TYPE');
				$link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
				$this->setRedirect($link, $msg);
		}
	}
	function savevehiclemake() {                          // Vehicle Makes
		$redirect=$this->storesavevehiclemake('saveclose');
	}
	function savevehiclemakeandnew() {                          // savevehiclemakeandnew
		$redirect=$this->storesavevehiclemake('saveandnew');
	}
	function savevehiclemakesave() {                          // savevehiclemakeandnew
		$redirect=$this->storesavevehiclemake('save');
	}
	function storesavevehiclemake($callfrom){
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$return_value = $model->storeVehicleMake();
			
			if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_MAKE_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=makes';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_MAKE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemake&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_MAKE_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemake';
				}
				$this->setRedirect($link, $msg);
			}else if ($return_value[0] == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclemake');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value[0] == 3){
					$msg = JText::_('VEHICLE_MAKE_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclemake');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value[0] == 5){
					$msg = JText::_('ERROR_UPLOAD_MAKE_LOGO');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclemake');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}elseif($return_value[0] == 6){
					$msg = JText::_('IMAGE_TYPE_MISMATCH');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclemake');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else{
					$msg = JText::_('ERROR_SAVING_VEHICLE_MAKE');
					$link = 'index.php?option=com_jsautoz&task=view&layout=makes';
					$this->setRedirect($link, $msg);
			}
	}
	function savevehiclemodel() {          //savevehiclemodel
		$redirect=$this->storevehiclemodel('saveclose');
	}
	function savevehiclemodelandnew() {          //savevehiclemodelandnew
		$redirect=$this->storevehiclemodel('saveandnew');
	}
	function savevehiclemodelsave() {          //savevehiclemodelsave
		$redirect=$this->storevehiclemodel('save');
	}
	function storevehiclemodel($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$data = JRequest :: get('post');
		$makeid =  $data['makeid'];
		$return_value = $model->storeVehicleModel();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_MODEL_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=models&mid='.$makeid;
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_MODEL_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemodel&mid='.$makeid.'&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_MODEL_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemodel&mid='.$makeid;
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclemodel');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_MODEL_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclemodel');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_VEHICLE_MODEL');
				$link = 'index.php?option=com_jsautoz&task=view&layout=models';
				$this->setRedirect($link, $msg);
		}
		
		
	}
	
	function savevehiclemodelyear() {               //savevehiclemodelyear
		$redirect=$this->storevehiclemodelyear('saveclose');
	}
	function savevehiclemodelyearsave() 	{               //savevehiclemodelyearsave
		$redirect=$this->storevehiclemodelyear('save');
	}
	function savevehiclemodelyearandnew() {               //savevehiclemodelyearandnew
		$redirect=$this->storevehiclemodelyear('saveandnew');
	}
	function storevehiclemodelyear($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleModelyears();
		if ($return_value[0] == 1)	{
					if($callfrom == 'saveclose'){
						$msg = JText::_('VEHICLE_MODEL_YEAR_SAVED');
						$link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
					}elseif($callfrom == 'save'){
						$msg = JText::_('VEHICLE_MODEL_YEAR_SAVED');
						$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemodelyear&cid[]='.$return_value[1];
					}elseif($callfrom == 'saveandnew'){
						$msg = JText::_('VEHICLE_MODEL_YEAR_SAVED');
						$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclemodelyear';
					}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclemodelyear');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_MODEL_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclemodelyear');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_VEHICLE_MODEL_YEAR');
				$link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
				$this->setRedirect($link, $msg);
		}
		
		
	}
	function savevehicletransmission() {              //savevehicletransmission
		$redirect=$this->storevehicletransmission('saveclose');
	}
	function savevehicletransmissionsave() {              //savevehicletransmissionsave
		$redirect=$this->storevehicletransmission('save');
	}
	function savevehicletransmissionandnew() {              //savevehicletransmissionandnew
		$redirect=$this->storevehicletransmission('saveandnew');
	}
	function storevehicletransmission($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleTransmission();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_TRANSMISSION_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_TRANSMISSION_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicletransmission&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_TRANSMISSION_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicletransmission';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicletransmission');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_TRANSMISSION_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicletransmission');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_VEHICLE_TRANSMISSION');
				$link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
				$this->setRedirect($link, $msg);
		}
		
		
	}
	function savevehicleadexpiry() {                 //savevehicleadexpiry
		$redirect=$this->storevehicleadexpiry('saveclose');
	}
	function savevehicleadexpirysave() {                 //savevehicleadexpirysave
		$redirect=$this->storevehicleadexpiry('save');
	}
	function savevehicleadexpiryandnew() {                 //savevehicleadexpiryandnew
		$redirect=$this->storevehicleadexpiry('saveandnew');
	}	
	function  storevehicleadexpiry($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleAdexpiry();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_ADEXPIRY_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_ADEXPIRY_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicleadexpiry&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_ADEXPIRY_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicleadexpiry';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicleadexpiry');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_ADEXPIRY_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicleadexpiry');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 5){
				$msg = JText::_('TITLE_MUST_BE_NUMERIC');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehicleadexpiry');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_ADEXPIRY');
				$link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
				$this->setRedirect($link, $msg);
		}
	}
	function saveactivate(){
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeActivate();
		if ($return_value == 1)	{
			$msg = JText::_('JS_AUTOZ_ACTIVATED');
						$session = JFactory::getSession();
						$config = null;
						$session->set('jsautoconfig_deft', $config);
		}elseif ($return_value == 3) {
			$msg = JText::_('JS_INVALID_ACTIVATION_KEY');
		}elseif ($return_value == 4) {
			$msg = JText::_('ERROR_JS_AUTOZ_CAN_NOT_ACTIVATE');
		}else {
			$msg = JText::_('ERROR_JS_AUTOZ_CAN_NOT_ACTIVATE');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=updateactivate';
		$this->setRedirect($link, $msg);
	}
	function savevehiclecylinder() {              //savevehiclecylinder
		$redirect=$this->storevehiclecylinder('saveclose');
	}
	function savevehiclecylindersave() {              //savevehiclecylindersave
		$redirect=$this->storevehiclecylinder('save');
	}
	function savevehiclecylinderandnew() {              //savevehiclecylinderandnew
		$redirect=$this->storevehiclecylinder('saveandnew');
	}
	function storevehiclecylinder($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleCylinder();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_CYLINDER_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_CYLINDER_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecylinder&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_CYLINDER_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecylinder';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclecylinder');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_CYLINDER_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclecylinder');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_CYLINDER');
				$link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
				$this->setRedirect($link, $msg);
		}
	}
	function savevehiclecondition() {               //savevehiclecondition
		$redirect=$this->storevehiclecondition('saveclose');
	}
	function savevehicleconditionsave() {               //savevehicleconditionsave
		$redirect=$this->storevehiclecondition('save');
	}
	function savevehicleconditionandnew() {               //savevehicleconditionandnew
		$redirect=$this->storevehiclecondition('saveandnew');
	}
	function storevehiclecondition($callfrom){
		global $mainframe;
		$model	= &$this->getModel( 'vehicle');
		$return_value = $model->storeVehicleCondition();
		if ($return_value[0] == 1)	{
				if($callfrom == 'saveclose'){
					$msg = JText::_('VEHICLE_CONDTION_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
				}elseif($callfrom == 'save'){
					$msg = JText::_('VEHICLE_CONDTION_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecondition&cid[]='.$return_value[1];
				}elseif($callfrom == 'saveandnew'){
					$msg = JText::_('VEHICLE_CONDTION_SAVED');
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecondition';
				}
				$this->setRedirect($link, $msg);
		}else if ($return_value[0] == 2){
				$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclecondition');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else if ($return_value[0] == 3){
				$msg = JText::_('VEHICLE_CONDITION_ALREADY_EXIST');
				JRequest :: setVar('view', 'vehicle');
				JRequest :: setVar('hidemainmenu', 1);
				JRequest :: setVar('layout', 'formvehiclecondition');
				JRequest :: setVar('msg', $msg);
				$this->display();
		}else{
				$msg = JText::_('ERROR_SAVING_CONDITION');
				$link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
				$this->setRedirect($link, $msg);
		}
	}
	function savevehiclecategory() {           //savevehiclecategory
		$redirect=$this->storevehiclecategory('saveclose');
	}
	function savevehiclecategorysave() {           //savevehiclecategorysave
		$redirect=$this->storevehiclecategory('save');
	}
	function savevehiclecategoryandnew() {           //savevehiclecategoryandnew
		$redirect=$this->storevehiclecategory('saveandnew');
	}
	function storevehiclecategory($callfrom){
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$return_value = $model->storeVehicleCategory();
			//echo '<br>'.$return_value;
			if ($return_value[0] == 1)	{
					if($callfrom == 'saveclose'){
						$msg = JText::_('VEHICLE_CATEGORY_SAVED');
						$link = 'index.php?option=com_jsautoz&task=view&layout=categories';
					}elseif($callfrom == 'save'){
						$msg = JText::_('VEHICLE_CATEGORY_SAVED');
						$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecategory&cid[]='.$return_value[1];
					}elseif($callfrom == 'saveandnew'){
						$msg = JText::_('VEHICLE_CATEGORY_SAVED');
						$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehiclecategory';
					}
					$this->setRedirect($link, $msg);
			}else if ($return_value[0] == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclecategory');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value[0] == 3){
					$msg = JText::_('VEHICLE_CATEGORY_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formvehiclecategory');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else{
					$msg = JText::_('ERROR_SAVING_CATEGORY');
					$link = 'index.php?option=com_jsautoz&task=view&layout=categories';
					$this->setRedirect($link, $msg);
			}
	}
	function savevehiclecountry() {           //savevehiclecountry
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$return_value = $model->storeVehicleCountry();
			if ($return_value == 1)	{
					$msg = JText::_('COUNTRY_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=countries';
					$this->setRedirect($link, $msg);
			}else if ($return_value == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcountry');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value == 3){
					$msg = JText::_('COUNTRY_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcountry');
					JRequest :: setVar('msg', $msg);
					$this->display();   
			}else{
					$msg = JText::_('ERROR_SAVING_COUNTRY');
					$link = 'index.php?option=com_jsautoz&task=view&layout=countries';
					$this->setRedirect($link, $msg);
			}
	}
	function savevehiclecounty() {           //savevehiclecounty
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$session = JFactory::getSession();
			$country= $session->get('countrycode');
			$state= $session->get('statecode');
			$return_value = $model->storeVehicleCounty($country,$state);
			if ($return_value == 1)	{
					$msg = JText::_('COUNTY_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$state;
					$this->setRedirect($link, $msg);
			}else if ($return_value == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcounty');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value == 3){
					$msg = JText::_('COUNTY_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcounty');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else{
					$msg = JText::_('ERROR_SAVING_COUNTY');
					$link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$state;
					$this->setRedirect($link, $msg);
			}
	}
	function savevehiclecity() {           //savevehiclecounty
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$session = JFactory::getSession();
			$country= $session->get('countrycode');
			$state= $session->get('statecode');
			$county= $session->get('countycode');
			$return_value = $model->storeVehicleCity($country,$state,$county);
			if ($return_value == 1)	{
					$msg = JText::_('CITY_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$county;
					$this->setRedirect($link, $msg);
			}else if ($return_value == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcity');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value == 3){
					$msg = JText::_('CITY_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formcity');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else{
					$msg = JText::_('ERROR_SAVING_CITY');
					$link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$county;
					$this->setRedirect($link, $msg);
			}
	}
	function publishcounty(){
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$session = JFactory::getSession();
			//$country= $session->get('countrycode');
			$state= $session->get('statecode');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->publishedCounties($cid);
			$link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$state;
			$this->setRedirect($link, $msg);
	}
	function unpublishcounty(){
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$session = JFactory::getSession();
			//$country= $session->get('countrycode');
			$state= $session->get('statecode');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->unpublishedCounties($cid);
			$link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$state;
			$this->setRedirect($link, $msg);
	}
	function publishcity(){
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$session = JFactory::getSession();
			//$country= $session->get('countrycode');
			//$state= $session->get('statecode');
			$county= $session->get('countycode');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->publishedCities($cid);
                        $link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$county;
			$this->setRedirect($link, $msg);
	}
	function unpublishcity() {
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$session = JFactory::getSession();
			//$country= $session->get('countrycode');
			//$state= $session->get('statecode');
			$county= $session->get('countycode');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->unpublishedCities($cid);
                        $link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$county;
			$this->setRedirect($link, $msg);
	}
	function savevehiclestate() {           //savevehiclestate
			global $mainframe;
			$model	= &$this->getModel( 'vehicle');
			$session = JFactory::getSession();
			$ct= $session->get('countrycode');
			$return_value = $model->storeVehicleState($ct);
			if ($return_value == 1)	{
					$msg = JText::_('STATE_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$ct;
					$this->setRedirect($link, $msg);
			}else if ($return_value == 2){
					$msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formstate');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else if ($return_value == 3){
					$msg = JText::_('STATE_ALREADY_EXIST');
					JRequest :: setVar('view', 'vehicle');
					JRequest :: setVar('hidemainmenu', 1);
					JRequest :: setVar('layout', 'formstate');
					JRequest :: setVar('msg', $msg);
					$this->display();
			}else{
					$msg = JText::_('ERROR_SAVING_STATE');
					$link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$ct;
					$this->setRedirect($link, $msg);
			}
	}
	function publishstate(){
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->publishedStates($cid);
			$session = JFactory::getSession();
			$ct= $session->get('countrycode');
			$link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$ct;
			$this->setRedirect($link, $msg);
	}
	function unpublishstate(){
			$model	= &$this->getModel( 'jsautoz','JSAutozModel');
			$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
			$return_value = $model->unpublishedStates($cid);
			$session = JFactory::getSession();
			$ct= $session->get('countrycode');
			$link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$ct;
			$this->setRedirect($link, $msg);
	}
	function savepaymentinfo(){ // save
			$model = & $this->getModel('jsautoz', 'JSAutozModel');
			$Itemid =  JRequest::getVar('Itemid');
			$return_value = $model->storePaymentInfo();
			if ($return_value){
				$msg = JText::_('RECORD_HAS_BEEN_SAVED');
				$link = 'index.php?option=com_jsautoz&task=view&layout=updateactivate';
			}else{	
				$msg = JText::_('ERROR_RECORD_NOT_SAVE');
				$link = 'index.php?option=com_jsautoz&task=view&layout=updateactivate';
			}
	}
	function savevehicleimages() {               //savevehicleimages
			global $mainframe;
			$model = & $this->getModel('jsautoz', 'JSAutozModel');
			$data = JRequest :: get('post');
			$return_value = $model->storeVehicleImages();
			//if($return_value) $makedefaultimage = $model->checkMakeDefaultImage($data); //must make image default if default image not set
            if($return_value[2]) $makedefaultimage = $model->makeDefaultVehicleImage($return_value[0],$return_value[1],1); //must make image default if default image not set
			$msg = JText::_('VEHICLE_IMAGE_SAVE');
			$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_images&Itemid='.$Itemid;
			$this->setRedirect($link , $msg);
	}
    function saveuserfield(){                //saveuserfield

                $model	= &$this->getModel( 'vehicle');
                $return_value = $model->storeUserField();
                if ($return_value == 1){
                        $msg = JText::_('USER_FIELD_SAVED');
                        $link = 'index.php?option=com_jsautoz&task=view&layout=userfields';
                        $this->setRedirect($link, $msg);
                }else if ($return_value == 2){
                        $msg = JText::_('ALL_FIELD_MUST_BE_ENTERD');
                        JRequest :: setVar('view', 'application');
                        JRequest :: setVar('hidemainmenu', 1);
                                JRequest :: setVar('layout', 'formuserfield');
                                JRequest :: setVar('msg', $msg);

                        // Display based on the set variables
                        parent :: display();
                }else{
                        $msg = JText::_('ERROR_SAVING_USER_FIELD');
                        JRequest :: setVar('view', 'vehicle');
                        JRequest :: setVar('hidemainmenu', 1);
                        JRequest :: setVar('layout', 'formuserfield');
                        JRequest :: setVar('msg', $msg);
                        $this->display();
                }
	}
	function savevehicleuserfields(){
			$model	= &$this->getModel( 'vehicle');
			$return_value = $model->storeVehicleUserFields();
					$link = 'index.php?option=com_jsautoz&view=vehicle&layout=formvehicleuserfield';
			if ($return_value == 1)		{
				$msg = JText::_('VEHICLE_OPTION_CUSTOM_FIELD_SAVED');
			}
			else {
				$msg = JText::_('ERROR_SAVING_VEHICLE_OPTION_CUSTOM__FIELD');
			}
					$this->setRedirect($link, $msg);
	}
	function deletevehicleimages() {         //delete vehicleimages
			global $mainframe,$params ;
			$model = $this->getModel('jsautoz', 'JSAutozModel');
			$session = &JFactory::getSession();
			$user	=& JFactory::getUser();
			$uid=$user->id;
			$Itemid =  JRequest::getVar('Itemid');

			$id =  JRequest::getVar('id');
			$return_value = $model->deleteVehicleImages($id, $uid);
			if ($return_value == 1)	{
					$msg = JText :: _('VEHICLE_IMAGE_DELETED');
			}elseif ($return_value == 2){
					$msg = JText :: _('VEHICLE_IMAGE_CANNOT_DELETE');
			}elseif ($return_value == 3){
					$msg = JText :: _('NOT_YOUR_VEHICLE_IMAGE');
			}else{
					$msg = JText :: _('ERROR_DELETING_VEHICLE_IMAGE');
			}
			$link = 'index.php?option=com_jsautoz&c=jsautoz&view=vehicles&layout=vehicle_images&Itemid='.$Itemid;
			$this->setRedirect($link, $msg);
	}
    function remove(){
               //  echo '<br>remove';
    }
    function removevehicle(){              //removevehicle
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deletevehicle();
                if  ($return_value == 1) $msg = JText::_('VEHICLE_DELETED');
                else $msg = JText::_('ERROR_VEHICLE_COULD_NOT_DELETE');
                $link = 'index.php?option=com_jsautoz&task=view&layout=vehicles';
                $this->setRedirect($link, $msg);

        }
    function removefueltype() {                             //remove Fuel Type
                $model	= &$this->getModel( 'vehicle');
                $return_value = $model->deleteFuelType();
                if ($return_value == 1) $msg = JText::_('FUEL_TYPE_DELETED');
                else $msg = $return_value -1 .' '. JText::_('ERROR_FUEL_TYPE_COULD_NOT_DELETE');

                $link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
                $this->setRedirect($link, $msg);
    }
    function removecurrency() {                             //remove Fuel Type
                $model	= &$this->getModel( 'vehicle');
                $return_value = $model->deleteCurrency();
                if ($return_value == 1) $msg = JText::_('CURRENCY_DELETED');
                else $msg = $return_value -1 .' '. JText::_('ERROR_CURRENCY_COULD_NOT_DELETE');

                $link = 'index.php?option=com_jsautoz&task=view&layout=currency';
                $this->setRedirect($link, $msg);
    }
    function removevehicletype() {                          //Remove Vehicle Type
                $model	= &$this->getModel( 'vehicle');
                $return_value = $model->deleteVehicleType();
                if ($return_value == 1) $msg = JText::_('VEHICLE_TYPE_DELETED');
                else $msg = $return_value -1 .' '. JText::_('ERROR_VEHICLE_TYPE_COULD_NOT_DELETE');

                $link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
                $this->setRedirect($link, $msg);
	}
    function removemileagetype() {                          //Remove Vehicle Type
                $model	= &$this->getModel( 'vehicle');
                $return_value = $model->deleteMileageType();
                if ($return_value == 1) $msg = JText::_('MILEAGE_TYPE_DELETED');
                else $msg = $return_value -1 .' '. JText::_('ERROR_MILEAGE_TYPE_COULD_NOT_DELETE');
                $link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
                $this->setRedirect($link, $msg);
	}
    function removevehiclemake(){                         //Remove Vehicle make
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleMakeType();
                if ($return_value == 1) $msg = JText::_('VEHICLE_MAKE_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_MAKE_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=makes';
                $this->setredirect($link, $msg);
	}
    function removevehiclemodel(){                         //Remove Vehicle make
                $model = &$this->getmodel('vehicle');
                $session = JFactory::getSession();
                $makeid = $session->get('autoz_makeid');
                $return_value = $model->deleteVehicleModel();
                if ($return_value == 1) $msg = JText::_('VEHICLE_MODEL_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_MODEL_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=models&mid='.$makeid;
                $this->setredirect($link, $msg);
	}
    function removevehiclemodelyear(){                         //Remove Vehicle make
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleModelYear();
                if ($return_value == 1) $msg = JText::_('VEHICLE_MODEL_YEAR_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_MODEL_YEAR_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
                $this->setredirect($link, $msg);
	}

    function removevehicletramsmission(){                         //Remove Vehicle transmission
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleTransmission();
                if ($return_value == 1) $msg = JText::_('VEHICLE_TRANSMISSION_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_TRANSMISSION_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
                $this->setredirect($link, $msg);
	}
    function removevehicleadexpiry(){                         //Remove Vehicle adexpiry
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleAdexpiry();
                if ($return_value == 1) $msg = JText::_('VEHICLE_ADEXPIRY_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_ADEXPIRY_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
                $this->setredirect($link, $msg);
	}
    function removevehiclecylinder(){                         //Remove Vehicle cylinder
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleCylinder();
                if ($return_value == 1) $msg = JText::_('VEHICLE_CYLINDER_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_CYLINDER_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
                $this->setredirect($link, $msg);
	}
    function removevehiclecondiotion (){                         //Remove Vehicle condition
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleCondition ();
                if ($return_value == 1) $msg = JText::_('VEHICLE_CONDITION_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_CONDITION_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
                $this->setredirect($link, $msg);
	}
    function removevehiclecategory (){                       //removevehiclecategory
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleCategory ();
                if ($return_value == 1) $msg = JText::_('VEHICLE_CATEGORY_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_CATEGORY_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=categories';
                $this->setredirect($link, $msg);
    }
    function removevehiclecountry(){
                $model = &$this->getmodel('vehicle');
                $return_value = $model->deleteVehicleCountry ();
                if ($return_value == 1) $msg = JText::_('VEHICLE_COUNTRY_DELETED');
                else $msg = $return_value -1 .''.JText::_('ERROR_VEHICLE_COUNTRY_COULD_NOT_DELETED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=countries';
                $this->setredirect($link, $msg);
    }
    function removevehiclestate() {
                $model = &$this->getmodel('vehicle');
                $session=  JFactory::getSession();
                $countrycode=$session->get('countrycode');
		$return_value = $model->deleteState();
		if ($return_value == 1){
			$msg = JText::_('STATE_DELETE');
		} else {
                        $msg = $returnvalue -1 .' '. JText::_('STATE_COULD_NOT_DELETE');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$countrycode;
		$this->setRedirect($link, $msg);
    }
    function removevehiclecounty() { 
                $model = &$this->getmodel('vehicle');
                $session=  JFactory::getSession();
                $statecode=$session->get('statecode');
                $return_value = $model->deleteCounty();
		if ($return_value == 1){
			$msg = JText::_('COUNTY_DELETE');
		} else {
				$msg = $returnvalue -1 .' '. JText::_('COUNTY_COULD_NOT_DELETE');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$statecode;
		$this->setRedirect($link, $msg);
    }
    function removevehiclecity() {
                $model = &$this->getmodel('vehicle');
                $session=  JFactory::getSession();
                $countycode=$session->get('countycode');
		$return_value = $model->deleteCity();
		if ($return_value == 1){
			$msg = JText::_('CITY_DELETE');
		} else {
                        $msg = $returnvalue -1 .' '. JText::_('CITY_COULD_NOT_DELETE');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$countycode;
		$this->setRedirect($link, $msg);
    }

    function removeuserfields(){
                $model = &$this->getmodel('vehicle');
		$return_value = $model->deleteUserField();
		if ($return_value == 1){
			$msg = JText::_('USER_FIELD_DELETE');
		} else {
				$msg = $returnvalue -1 .' '. JText::_('USER_FIELD_COULD_NOT_DELETE');
		}
		$link = 'index.php?option=com_jsautoz&task=view&layout=userfields';
		$this->setRedirect($link, $msg);
	}


	function cancel(){
			$msg = JText::_('OPERATION_CANCELED');
			$link = 'index.php?option=com_jsautoz&view=vehicles&layout=controlpanel';
			$this->setRedirect($link, $msg);
	}
	function canceluserfields(){
			$msg = JText::_('OPERATION_CANCELED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=userfields';
			$this->setRedirect($link, $msg);
	}

	function cancelvehicle(){                       //cancelvehicle
			$msg = JText::_('OPERATION_CANCELED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=vehicles';
			$this->setRedirect($link, $msg);
	}
	function cancelfueltype(){              //cancelfueltype
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
			$this->setRedirect($link, $msg);
	}
	function cancelcurrency(){              //cancelfueltype
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=currency';
			$this->setRedirect($link, $msg);
	}
	function cancelvehicletype(){                //cancelvehicletype
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
			$this->setRedirect($link, $msg);
	}
	function cancelmileagetype(){              //cancelmileagetype
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
			$this->setRedirect($link, $msg);
	}
	function cancelvehiclemake(){           //cancelvehiclemake
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=makes';
			$this->setRedirect($link, $msg);
	}
	function cancelvehiclemodel(){             //cancelvehiclemodel
			$data = JRequest :: get('post');
			$makeid =  $data['makeid'];

			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=models&mid='.$makeid;
			$this->setRedirect($link, $msg);
	}
	function cancelvehiclemodelyear(){           //cancelvehiclemodelyear
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
			$this->setRedirect($link, $msg);
	}
	function cancelvehicletransmission(){          //cancelvehicletransmission
			$msg = JText::_('OPERATION_CANCELLED');
			$link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
			$this->setRedirect($link, $msg);
	}
    function cancelvehicleadexpiry(){             //cancelvehicleadexpiry
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
                $this->setRedirect($link, $msg);
	}
    function cancelvehiclecylinder(){            //cancelvehiclecylinder
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
                $this->setRedirect($link, $msg);
	}
    function cancelvehiclecondition(){             //cancelvehiclecondition
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
                $this->setRedirect($link, $msg);
	}
    function cancelvehiclecategory(){               //cancelvehiclecategory
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=categories';
                $this->setRedirect($link, $msg);
	}
    function cancelvehicleuserfields(){             //cancelvehicleuserfields
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=userfields';
                $this->setRedirect($link, $msg );
	}
    function cancelmodel(){
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=makes';
                $this->setRedirect($link, $msg );
    }
    function cancelvehiclecountry(){
                $msg = JText::_('OPERATION_CANCELED');
                $link = 'index.php?option=com_jsautoz&task=view&layout=countries';
                $this->setRedirect($link, $msg );
    }
    function cancelvehiclestate(){
            $session = JFactory::getSession();
            $ct= $session->get('countrycode');
            $msg = JText::_('OPERATION_CANCELED');
            $link = 'index.php?option=com_jsautoz&task=view&layout=states&ct='.$ct;
            $this->setRedirect($link, $msg );
    }
    function cancelvehiclecounty(){
            $session = JFactory::getSession();
            $state= $session->get('statecode');
            $msg = JText::_('OPERATION_CANCELED');
            $link = 'index.php?option=com_jsautoz&task=view&layout=counties&sd='.$state;
            $this->setRedirect($link, $msg );
    }
    function cancelvehiclecity(){
            $session = JFactory::getSession();
            $county= $session->get('countycode');
            $msg = JText::_('OPERATION_CANCELED');
            $link = 'index.php?option=com_jsautoz&task=view&layout=cities&co='.$county;
            $this->setRedirect($link, $msg );
    }
    function cancelpayment_report(){                       //cancelpayment_report
            $msg = JText::_('OPERATION_CANCELED');
            $link = 'index.php?option=com_jsautoz&task=view&layout=controlpanel';
            $this->setRedirect($link, $msg);
    }
    
    function cancelreviewapprovalque(){                       //cancelreviewapprovalque
            $msg = JText::_('OPERATION_CANCELED');
            $link = 'index.php?option=com_jsautoz&task=view&layout=controlpanel';
            $this->setRedirect($link, $msg);
    }

    function fieldorderingup () {               //fieldorderingup
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $fieldid = $cid[0];
                $return_value = $model->fieldOrderingUp($fieldid);
                $link = 'index.php?option=com_jsautoz&task=view&layout=fieldsordering';
                $this->setRedirect($link, $msg);
	}
    function fieldorderingdown() {               //fieldorderingdown
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $fieldid = $cid[0];
                $return_value = $model->fieldOrderingDown($fieldid);
                $link = 'index.php?option=com_jsautoz&task=view&layout=fieldsordering';
                $this->setRedirect($link, $msg);
	}
	function publishcountry(){
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $return_value = $model->publishedCountry($cid);
                $link = 'index.php?option=com_jsautoz&task=view&layout=countries';
                $this->setRedirect($link, $msg);
	}
	function unpublishcountry(){
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $return_value = $model->unPublishedCountry($cid);
                $link = 'index.php?option=com_jsautoz&task=view&layout=countries';
                $this->setRedirect($link, $msg);
		
		
	}
    function publishvehicle(){                     //publishvehicle
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleApprove($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=vehiclequeue';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehicle(){
                $model	= &$this->getModel( 'jsautoz','JSAutozModel');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleReject($id,-1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=vehiclequeue';
                $this->setRedirect($link, $msg);
	}
    function publishfueltype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusFuelType($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
                $this->setRedirect($link, $msg);
	}
    function unpublishfueltype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusFuelType($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=fueltypes';
                $this->setRedirect($link, $msg);
	}
    function publishcurrency(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusCurrency($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=currency';
                $this->setRedirect($link, $msg);
	}
    function unpublishcurrency(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusCurrency($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=currency';
                $this->setRedirect($link, $msg);
	}
    function publishvehicletype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleType($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehicletype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleType($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=vehicletypes';
                $this->setRedirect($link, $msg);
	}
    function publishmileagetype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusMileageType($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
                $this->setRedirect($link, $msg);
	}
    function unpublishmileagetype(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusMileageType($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=mileagetypes';
                $this->setRedirect($link, $msg);
	}
    function publishvehiclemake(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleMake($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=makes';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehiclemake(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleMake($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=makes';
                $this->setRedirect($link, $msg);
	}
    function publishvehiclemodel(){
                $model	= &$this->getModel( 'vehicle');
                $session = JFactory::getSession();
                $makeid = $session->get('autoz_makeid');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleModel($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=models&mid='.$makeid;
                $this->setRedirect($link, $msg);
	}
    function unpublishvehiclemodel(){
                $model	= &$this->getModel( 'vehicle');
                $session = JFactory::getSession();
                $makeid = $session->get('autoz_makeid');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleModel($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=models&mid='.$makeid;
                $this->setRedirect($link, $msg);
	}
    function publishmodelyear(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleModelYear($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
                $this->setRedirect($link, $msg);
	}
    function unpublishmodelYear(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleModelYear($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=modelyears';
                $this->setRedirect($link, $msg);
	}
    function publishvehicletransmission(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleTransmission($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehicletransmission(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleTransmission($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=transmissions';
                $this->setRedirect($link, $msg);
	}
    function publishvehicleadexpiry(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleAdexpiry($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehicleadexpiry(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleAdexpiry($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=adexpiries';
                $this->setRedirect($link, $msg);
	}
    function publishvehiclecylinder(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCylinder($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehiclecylinder(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCylinder($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=cylinders';
                $this->setRedirect($link, $msg);
	}
    function publishvehiclecondition(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCondition($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehiclecondition(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCondition($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=conditions';
                $this->setRedirect($link, $msg);
	}
    function publishvehiclecategory(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCategory($id,1);
                $link = 'index.php?option=com_jsautoz&task=view&layout=categories';
                $this->setRedirect($link, $msg);
	}
    function unpublishvehiclecategory(){
                $model	= &$this->getModel( 'vehicle');
                $cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                $id = $cid[0];
                $return_value = $model->changeStatusVehicleCategory($id,0);
                $link = 'index.php?option=com_jsautoz&task=view&layout=categories';
                $this->setRedirect($link, $msg);
	}
    function fieldpublished() {
                $model = & $this->getModel('jsautoz', 'JSAutozModel');
                //$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                //$fieldid = $cid[0];
                //$return_value = $model->fieldPublished($fieldid, 1);//published
                $return_value = $model->fieldPublished(1);//published
                $link = 'index.php?option=com_jsautoz&task=view&layout=fieldsordering';
                $this->setRedirect($link, $msg);
	}
    function fieldunpublished() {
                $model = & $this->getModel('jsautoz', 'JSAutozModel');
                //$cid 	= JRequest::getVar( 'cid', array(), ''		, 'array' );
                //$fieldid = $cid[0];
                $return_value = $model->fieldPublished(0); // unpublished
                $link = 'index.php?option=com_jsautoz&task=view&layout=fieldsordering';
                $this->setRedirect($link, $msg);
	}

	function saveemailtemplate(){
				$model = & $this->getModel('jsautoz', 'JSAutozModel');
				$data = JRequest :: get('post');
				$templatefor = $data['templatefor'];
				$return_value = $model->storeEmailTemplate();
				
				switch($templatefor) {

					case 'vehicle-new' : $tempfor = 'ew-vh'; break;
					case 'vehicle-approval' : $tempfor = 'vh-ap'; break;
					case 'vehicle-rejecting' : $tempfor = 'vh-rj'; break;
					case 'package-buy' : $tempfor = 'pk-by'; break;
					case 'package-approval' : $tempfor = 'pk-ap'; break;
					case 'buyer-contact-seller' : $tempfor = 'by-sl'; break;
					case 'new-review' : $tempfor = 'ew-rv'; break;
					case 'seller-review' : $tempfor = 'sl-rv'; break;
					case 'vehicle-alert' : $tempfor = 'vh-al'; break;

					case 'message-btosemail' : $tempfor = 'ms-bs'; break;
					case 'message-stobemail' : $tempfor = 'ms-sb'; break;
					case 'tell-friend' : $tempfor = 'tl-fr'; break;
                			case 'vehicle-visitor' : $tempfor = 'vs-vh';
                			case 'dealer-approval' : $tempfor = 'dl-ap';
				}
				if ($return_value == 1)
				{
					$msg = JText::_('EMAIL_TEMPATE_SAVED');
					$link = 'index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf='.$tempfor;
					$this->setRedirect($link, $msg);
				}else {
					$msg = JText::_('ERROR_SAVING_EMAIL_TEMPLATE');
					$link = 'index.php?option=com_jsautoz&task=view&layout=emailtemplate&tf='.$tempfor;
					$this->setRedirect($link, $msg);
				}
	}        
        function makedefaulttheme() // make default theme
        {
                $cid 	= JRequest::getVar( 'cid', array(), ''	, 'array' );
                $defaultid = $cid[0];
                $model = $this->getModel('jsautoz', 'JSAutozModel');
                $return_value = $model->makeDefaultTheme( $defaultid , 1 );
                if ($return_value == 1)	{ $msg = JText :: _('DEFAULT_THEME_SET'); }
                else{	$msg = JText :: _('ERROR_MAKING_DEFAULT_THEME'); }
                $link = 'index.php?option=com_jsautoz&c=jsautoz&task=view&layout=themes';
                $this->setRedirect($link, $msg);
        }
        function markreviewed(){
			$model = $this->getModel('jsautoz', 'JSAutozModel');
			$return_value = $model->markreviewed();
			return $return_value;
		}
        
	function display(){
			$document = & JFactory :: getDocument();
			$viewName = JRequest :: getVar('view', 'vehicles');
			$layoutName = JRequest :: getVar('layout', 'controlpanel');
			$viewType = $document->getType();
			$view = & $this->getView($viewName, $viewType);
			if($viewName == 'vehicle')	$model	= &$this->getModel( $viewName );
			else $model = & $this->getModel('jsautoz', 'JSAutozModel');
			if (!JError::isError( $model )) {
				$view->setModel( $model, true );
			}
			$view->setLayout($layoutName);
			$view->display();
	}
}
?>






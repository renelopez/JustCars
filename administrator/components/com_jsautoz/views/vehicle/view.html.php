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

jimport('joomla.application.component.view');
jimport('joomla.html.pagination');


class JSAutozViewVehicle extends JViewLegacy
{

    function display($tpl = null)
        {

		global $mainframe, $sorton, $sortorder, $option;
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		$jversion = substr($joomla,0,3);
                $mainframe = JFactory::getApplication();

            $user	=& JFactory::getUser();
            $uid=$user->id;
            $itemid =  JRequest::getVar('Itemid');
            $layout =  JRequest::getVar('layout');
            $msg = JRequest :: getVar('msg');
            $model		= &$this->getModel('vehicle');
            $option='com_jsautoz';
            if($option == '')
            $option='com_jsautoz';
            $viewtype = 'html';
            $isNew = true;
			$config = array();
            if (! $model->getConfiginArray('dafault')){
				$config = $model->getConfiginArray('default');
			}
            if($layout== 'formvehicle'){								// form vehicle
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $result =  $model->getVehicleforForm($c_id);
                $this->assignRef('vehicleid', $c_id);
                $this->assignRef('vehicle', $result[0]);
                $this->assignRef('vehicleoptions', $result[1]);
                $this->assignRef('lists', $result[2]);
                $this->assignRef('fieldorderings', $result[3]);
                $this->assignRef('fieldorderings_options', $result[4]);
                $this->assignRef('userfields', $result[5]);
                if ( isset($result[0]->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
				if ( isset($result[0]->id) ){
					JToolBarHelper::save2copy('savevehiclesave2copy');
				}                
				JToolBarHelper :: title(JText :: _('VEHICLE').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: save('savevehicle','SAVE_VEHICLE_AND_UPLOAD_IMAGE');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehicle'); else JToolBarHelper :: cancel('cancelvehicle', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formfueltype'){								// form fuel type
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $fueltype =  $model->getFuelTypeforForm($c_id);
                $this->assignRef('fueltype', $fueltype);
                if ( isset($fueltype->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('FUEL_TYPES').'<small><small> ['.$text.']</small></small>' );
				JToolBarHelper::apply('savefueltypesave','SAVE');
                //JToolBarHelper :: save('savefueltypesave','JS_SAVE');
                JToolBarHelper :: save2new('savefueltypeandnew');
                JToolBarHelper :: save('savefueltype');
                if ($isNew)	JToolBarHelper :: cancel('cancelfueltype'); else JToolBarHelper :: cancel('cancelfueltype', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formcurrency'){								// form currency
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $currency =  $model->getCurrencyforForm($c_id);
                $this->assignRef('currency', $currency);
                if ( isset($currency->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('CURRENCY').'<small><small> ['.$text.']</small></small>' );
				JToolBarHelper::apply('savecurrencysave','SAVE');
                //JToolBarHelper :: save('savecurrencysave','JS_SAVE');
                JToolBarHelper :: save2new('savecurrencyandnew');
                JToolBarHelper :: save('savecurrency');
                if ($isNew)	JToolBarHelper :: cancel('cancelcurrency'); else JToolBarHelper :: cancel('cancelcurrency', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehicletype'){								// form vehicle type
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $vehicletype=  $model->getVehicleTypeforForm($c_id);
                $this->assignRef('vehicletype', $vehicletype);
                if ( isset($vehicletype->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('VEHICLE_TYPES').'<small><small> ['.$text.']</small></small>' );
				JToolBarHelper::apply('savevehicletypesave','SAVE');
                //JToolBarHelper :: save('savevehicletypesave','JS_SAVE');
                JToolBarHelper :: save2new('savevehicletypeandnew');
                JToolBarHelper :: save('savevehicletype');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehicletype'); else JToolBarHelper :: cancel('cancelvehicletype', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formmileagetype'){								// form mileage type
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $mileagetype =  $model->getMileageTypeforForm($c_id);
                $this->assignRef('mileagetype', $mileagetype);
                if ( isset($mileagetype->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('MILEAGE_TYPES').'<small><small> ['.$text.']</small></small>' );
				JToolBarHelper::apply('savemileagetypesave','SAVE');
                //JToolBarHelper :: save('savemileagetypesave','JS_SAVE');
                JToolBarHelper :: save2new('savemileagetypeandnew');
                JToolBarHelper :: save('savemileagetype');
                if ($isNew)	JToolBarHelper :: cancel('cancelmileagetype'); else JToolBarHelper :: cancel('cancelmileagetype', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclemake'){								// form  Vehicle Make
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $vehiclemake =  $model->getVehicleMakeforForm($c_id);
                $this->assignRef('vehiclemake', $vehiclemake);
                if ( isset($vehiclemake->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('MAKES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehiclemakesave','SAVE');
                JToolBarHelper :: save2new('savevehiclemakeandnew');
                JToolBarHelper :: save('savevehiclemake');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclemake'); else JToolBarHelper :: cancel('cancelvehiclemake', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclemodel'){								// form vehicle model
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $session = JFactory::getSession();
                $makeid = $session->get('autoz_makeid');
                if($makeid) $makeid=$makeid;
                else $makeid = JRequest::getVar('mid');
                //$vehiclemake=$model->getVehicleMake($c_id);
                $maketitle = $model->getVehicleMakeTitle($makeid);
                $vehiclemodel =  $model->getVehicleModelforForm($c_id);
                $this->assignRef('vehiclemodel', $vehiclemodel);
                $this->assignRef('makeid', $makeid);
                //$this->assignRef('list', $vehiclemake);
                if ( isset($vehiclemodel->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title($maketitle.' '.JText :: _('MODEL').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehiclemodelsave','SAVE');
                JToolBarHelper :: save2new('savevehiclemodelandnew');
                JToolBarHelper :: save('savevehiclemodel');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclemodel'); else JToolBarHelper :: cancel('cancelvehiclemodel', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclemodelyear'){								// form vehicle model years
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $modelyear =  $model->getVehicleModelyearforForm($c_id);
                $this->assignRef('vehiclemodelyear', $modelyear);
                if ( isset($modelyear->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('MODEL_YEARS').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehiclemodelyearsave','SAVE');
                JToolBarHelper :: save2new('savevehiclemodelyearandnew');
                JToolBarHelper :: save('savevehiclemodelyear');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclemodelyear'); else JToolBarHelper :: cancel('cancelvehiclemodelyear', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehicletransmission'){								// form vehicle transmission
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $transmission =  $model->getVehicleTransmissionforForm($c_id);
                $this->assignRef('transmission', $transmission );
                if ( isset($transmission ->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('TRANSMISSIONS').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehicletransmissionsave','SAVE');
                JToolBarHelper :: save2new('savevehicletransmissionandnew');
                JToolBarHelper :: save('savevehicletransmission');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehicletransmission'); else JToolBarHelper :: cancel('cancelvehicletransmission', 'Close');
                JHTML::_('behavior.formvalidation');

            }elseif($layout== 'formvehicleadexpiry'){								// form vehicle Adexpiry
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $title = JRequest :: getVar('type');
                $c_id= $cids[0];
                $result=  $model->getVehicleAdexpiryforForm($c_id);
                $this->assignRef('adexpiry', $result[0]);
                $this->assignRef('comboadexpiry', $result[1]);
                if ( isset($result[0]->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('AD_EXPIRIES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehicleadexpirysave','SAVE');
                JToolBarHelper :: save2new('savevehicleadexpiryandnew');
                JToolBarHelper :: save('savevehicleadexpiry');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehicleadexpiry'); else JToolBarHelper :: cancel('cancelvehicleadexpiry', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclecylinder'){								// form vehicle cylinder
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $cylinder=  $model->getVehicleCylinderforForm($c_id);
                $this->assignRef('cylinder', $cylinder);
                if ( isset($cylinder->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('CYLINDERS').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehiclecylindersave','SAVE');
                JToolBarHelper :: save2new('savevehiclecylinderandnew');
                JToolBarHelper :: save('savevehiclecylinder');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecylinder'); else JToolBarHelper :: cancel('cancelvehiclecylinder', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclecondition'){								// form vehicle condition
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $condition=  $model->getVehicleConditionforForm($c_id);
                $this->assignRef('condition', $condition);
                if ( isset($condition->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('CONDITIONS').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehicleconditionsave','SAVE');
                JToolBarHelper :: save2new('savevehicleconditionandnew');
                JToolBarHelper :: save('savevehiclecondition');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecondition'); else JToolBarHelper :: cancel('cancelvehiclecondition', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formvehiclecategory'){								//  formvehiclecategory
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $category=  $model->getVehicleCategoryforForm($c_id);
                $this->assignRef('category', $category);
                if ( isset($category->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('CATEGORIES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: apply('savevehiclecategorysave','SAVE');
                JToolBarHelper :: save2new('savevehiclecategoryandnew');
                JToolBarHelper :: save('savevehiclecategory');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecategory'); else JToolBarHelper :: cancel('cancelvehiclecategory', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formcountry'){								//  formvehiclecategory
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $country=  $model->getVehicleCountryforForm($c_id);
                $this->assignRef('country', $country);
                if ( isset($country->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('COUNTRIES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: save('savevehiclecountry');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecountry'); else JToolBarHelper :: cancel('cancelvehiclecountry', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formstates'){								//  formvehiclecategory
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $state=  $model->getVehicleStateforForm($c_id);
                $this->assignRef('state', $state);
                if ( isset($state->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('STATES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: save('savevehiclestate');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclestate'); else JToolBarHelper :: cancel('cancelvehiclestate', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formcounty'){								//  formvehiclecategory
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $county=  $model->getVehicleCountyforForm($c_id);
                $this->assignRef('county', $county);
                if ( isset($county->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('COUNTIES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: save('savevehiclecounty');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecounty'); else JToolBarHelper :: cancel('cancelvehiclecounty', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formcity'){								//  formvehiclecategory
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                $city=  $model->getVehicleCityforForm($c_id);
                $this->assignRef('city', $city);
                if ( isset($city->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('CITIES').'<small><small> ['.$text.']</small></small>' );
                JToolBarHelper :: save('savevehiclecity');
                if ($isNew)	JToolBarHelper :: cancel('cancelvehiclecity'); else JToolBarHelper :: cancel('cancelvehiclecity', 'Close');
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'formuserfield'){								//  form user field
                $cids = JRequest :: getVar('cid', array (0), '', 'array');
                $c_id= $cids[0];
                if (is_numeric($c_id) == true) $result =  $model->getUserFieldbyId($c_id);
                if (isset($_GET['ff'])) $fieldfor = $_GET['ff']; else $fieldfor = '';
                if ($fieldfor) $_SESSION['ffusr'] = $fieldfor; else $fieldfor = $_SESSION['ffusr'];
                if(isset($result[0]->id)) if ($result[0]->id) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('USER_FIELDS').'<small><small> ['.$text.']</small></small>' );
                $this->assignRef('userfield', $result[0]);
                $this->assignRef('fieldvalues', $result[1]);
                $this->assignRef('fieldfor', $fieldfor);
                if ( isset($result[0]->id) ) $isNew = false;
                $text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: save('saveuserfield');
                if ($isNew)	JToolBarHelper :: cancel('canceluserfields'); else JToolBarHelper :: cancel('canceluserfields', 'Close');
            }elseif ($layout == 'formvehicleuserfield'){						// form resume user fields

			$result =  $model->getVehicleUserFields();
			$this->assignRef('userfields', $result);
			JToolBarHelper :: title(JText :: _('OPTION_CUSTOM_FIELDS'));
			JToolBarHelper :: save('savevehicleuserfields');
			JToolBarHelper :: cancel('cancel', 'Close');
	  }
            $this->assignRef('pagination',	$pagination);
            $this->assignRef('theme', $theme);
            $this->assignRef('option', $option);
            $this->assignRef('config', $config);
            $this->assignRef('uid', $uid);
            $this->assignRef('items', $items);
            $this->assignRef('params', $params);
            $this->assignRef('viewtype', $viewtype);
            $this->assignRef('Itemid', $itemid);
            $this->assignRef('pdflink', $pdflink);
            $this->assignRef('printlink', $printlink);
            $this->assignRef('msg', $msg);
            parent :: display($tpl);
    }
    function getSortArg( $type, $sort ) {
            $mat = array();
            if ( preg_match( "/(\w+)(asc|desc)/i", $sort, $mat ) ) {
                    if ( $type == $mat[1] ) {
                            return ( $mat[2] == "asc" ) ? "{$type}desc" : "{$type}asc";
                    } else {
                            return $type . $mat[2];
                    }
            }
            return "iddesc";
    }


}
?>

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



class JSAutozViewVehicles extends JViewLegacy
{

    function display($tpl = null)
        {
			global $mainframe,$configs, $sorton, $sortorder, $option;
			$version = new JVersion;
			$joomla = $version->getShortVersion();
			$jversion = substr($joomla,0,3);
			$mainframe = JFactory::getApplication();

            $user	=& JFactory::getUser();
            $uid=$user->id;
            $itemid =  JRequest::getVar('Itemid');
            $layout =  JRequest::getVar('layout');
            $model		= &$this->getModel();
			$option='com_jsautoz';
            if($option == '')
                    $option ='com_jsautoz';
            if (! $model->getConfiginArray('dafault')){
				$config=$model->getConfiginArray('default');
			}
            if (!$configs){
				$configs=$model->getConfig();
			}
            $limit	= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
            $limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
            $viewtype = 'html';
            if($layout== 'formvehicle'){								// form vehicle
                $id =  JRequest::getVar('id');
                $result =  $model->getVehicleforForm($id);
                $this->assignRef('vehicle', $result[0]);
                $this->assignRef('vehicleoptions', $result[1]);
                $this->assignRef('lists', $result[2]);
                $this->assignRef('fieldorderings', $result[3]);
                $this->assignRef('fieldorderings_options', $result[4]);
                //if ( isset($vehicle->id) ) $isNew = false;
                //$text = $isNew ? JText :: _('ADD') : JText :: _('EDIT');
                JToolBarHelper :: title(JText :: _('VEHICLES') );
                JToolBarHelper :: addNew();
                JToolBarHelper :: editList();
                JToolBarHelper :: deleteList();
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'controlpanel'){								// form vehicle
                JToolBarHelper :: title(JText :: _('CONTROL_PANEL') );
            }elseif($layout== 'business_version'){								// form vehicle
                JToolBarHelper :: title(JText :: _('BUSINESS_VERSION') );
            }elseif($layout== 'view_vehicle'){							// view vehicle
                if (!isset($id)) $id='';
                $id =  JRequest::getVar('id');
                $result =  $model->getVehiclebyId($id);
                $this->assignRef('vehicle', $result[0]);
                $this->assignRef('vehicleoptions', $result[1]);
                $this->assignRef('fieldorderings', $result[2]);
                $this->assignRef('fieldorderings_options', $result[4]);
                JToolBarHelper :: title(JText :: _('VIEW_VEHICLES') );
                JToolBarHelper :: addNew();
                JToolBarHelper :: editList();
                JToolBarHelper :: deleteList();
            }elseif($layout== 'vehicles'){                          //vehicles
                JToolBarHelper :: title(JText :: _('VEHICLES') );
                $searchtitle = JRequest::getVar('filter_av_title');
                $searchmakeid = $mainframe->getUserStateFromRequest( $option.'filter_av_makeid', 'filter_av_makeid',	'',	'int' );
                $searchmodelid = $mainframe->getUserStateFromRequest( $option.'filter_av_modelid', 'filter_av_modelid',	'',	'int' );
                $searchvehicletypeid = $mainframe->getUserStateFromRequest($option.'filter_av_vehicletypeid', 'filter_av_vehicletypeid', '', 'int');
                $searchconditionid = $mainframe->getUserStateFromRequest($option.'filter_av_conditionid', 'filter_av_conditionid', '', 'int');
                $statusid = $mainframe->getUserStateFromRequest($option.'filter_av_statusid', 'filter_av_statusid', '', 'int');
                $result = $model->getAllVehicle($searchtitle,$searchmakeid, $searchmodelid, $searchvehicletypeid , $searchconditionid , $statusid ,$limitstart, $limit);
                //$items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: addNew('editvehicle');
                JToolBarHelper :: editList('editvehicle');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehicle');
                $this->assignRef('vehicles', $result[0]);
                $this->assignRef('lists', $result[2]);
                $this->assignRef('filter_title', $result[3]);
            }elseif($layout == 'users'){										// users
                JToolBarHelper :: title(JText::_('USERS'));
                JToolBarHelper :: editList();
                $form = 'com_jsautoz.users.list.';
                $searchname	= $mainframe->getUserStateFromRequest( $form.'searchname', 'searchname','', 'string' );
                $searchusername	= $mainframe->getUserStateFromRequest( $form.'searchusername', 'searchusername','', 'string' );
                $searchrole	= $mainframe->getUserStateFromRequest( $form.'searchrole', 'searchrole','', 'string' );
                $result =  $model->getAllUsers($searchname,$searchusername,$searchrole, $limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                $lists = $result[2];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('lists', $lists);
            }elseif($layout== 'vehiclequeue'){                          //vehicle queue
                JToolBarHelper :: title(JText :: _('VEHICLE_APPROVAL_QUEUE') );
                $searchtitle = JRequest::getVar('filter_av_title');
                $searchmakeid = $mainframe->getUserStateFromRequest( $option.'filter_av_makeid', 'filter_av_makeid',	'',	'int' );
                $searchmodelid = $mainframe->getUserStateFromRequest( $option.'filter_av_modelid', 'filter_av_modelid',	'',	'int' );
                $searchvehicletypeid = $mainframe->getUserStateFromRequest($option.'filter_av_vehicletypeid', 'filter_av_vehicletypeid', '', 'int');
                $searchconditionid = $mainframe->getUserStateFromRequest($option.'filter_av_conditionid', 'filter_av_conditionid', '', 'int');
                $result = $model->getAllUnapprovedVehicle($searchtitle,$searchmakeid, $searchmodelid, $searchvehicletypeid , $searchconditionid , $limitstart, $limit);
                //$items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('vehicles', $result[0]);
                $this->assignRef('lists', $result[2]);
                JToolBarHelper :: cancel('cancel');
            }elseif($layout== 'vehicle_images'){                   //vehicleimages
                $session = JFactory::getSession();
                $vehicleid = $session->get('js_autoz_new_vehicleid');
                //echo 'vehicleid'.$vehicleid;
                $vehicleimages =  $model->getVehicleImages($vehicleid);
                $this->assignRef('vehicleimages', $vehicleimages);
                $this->assignRef('vehicleid', $vehicleid);
                JToolBarHelper :: title(JText :: _('VEHICLE_IMAGES') );
                //JToolBarHelper :: addNew();
                //JToolBarHelper :: editList();
                //JToolBarHelper :: deleteList();
            }elseif($layout== 'vehiclesearch'){						// Search vehicle
                JToolBarHelper :: title(JText :: _('VEHICLES_SEARCH') );
                $result =  $model->getSearchOptions();
                $this->assignRef('lists', $result[2]);
                $this->assignRef('fieldorderings', $result[3]);
                JHTML::_('behavior.formvalidation');
            }elseif($layout== 'vehiclesearch_results'){					//  vehicle search results
                $data = JRequest :: get('post');
                $session =& JFactory::getSession();
                if (isset($data['isvehiclesearch'])){
                        if ($data['isvehiclesearch'] == 1){
                                $session->set('jsautoz_vsearchdata', $data);
                        }
                }
                $searchdata = $session->get('jsautoz_vsearchdata' );
                if(isset($searchdata )){
                        $result =  $model->getVehicleSearchResults($searchdata,$limitstart, $limit);
                        $total=$result[1];
                        $this->assignRef('vehicle',$result[0] );
                }

                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: title(JText :: _('VEHICLES_SEARCH_RESULTS') );
            }elseif($layout == 'vehicletypes'){								//vehicle types
                JToolBarHelper :: title(JText::_('VEHICLE_TYPES'));
                $result =  $model->getAllVehicleTypes($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makevehicletypedefault');
                JToolBarHelper :: addNew('editvehicletype');
                JToolBarHelper :: editList('editvehicletype');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehicletype');
            }elseif($layout == 'fueltypes'){								//fuel types
                JToolBarHelper :: title(JText::_('FUEL_TYPES'));
                $result =  $model->getAllFuelTypes($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makefueltypedefault');
                JToolBarHelper :: addNew('editfeultype');
                JToolBarHelper :: editList('editfeultype');
                JToolBarHelper :: deleteList('Are you sure to Delete','removefueltype');
            }elseif($layout == 'currency'){								//currency
                JToolBarHelper :: title(JText::_('CURRENCIES'));
                $result =  $model->getAllCurrency($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makecurrencydefault');
                JToolBarHelper :: addNew('editcurrency');
                JToolBarHelper :: editList('editcurrency');
                JToolBarHelper :: deleteList('Are you sure to Delete','removecurrency');
            }elseif($layout == 'mileagetypes'){								//mileage types
                JToolBarHelper :: title(JText::_('MILEAGE_TYPES'));
                $result =  $model->getAllMileAgeTypes($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makemileagedefault');
                JToolBarHelper :: addNew('editmileagetype');
                JToolBarHelper :: editList('editmileagetype');
                JToolBarHelper :: deleteList('Are you sure to Delete','removemileagetype');
            }elseif($layout == 'makes'){								//vehicle makes
                JToolBarHelper :: title(JText::_('MAKES'));
                $searchtitle = JRequest::getVar('filter_mk_title');
                $sortby = JRequest::getVar('sortby');
                
                $result =  $model->getAllMakes($searchtitle,$sortby,$limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                $this->assignRef('lists', $result[2]);
                JToolBarHelper :: addNew('editvehiclemake');
                JToolBarHelper :: editList('editvehiclemake');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehiclemake');
            }elseif($layout == 'models'){								//vehicle models
                $mkid =  JRequest::getVar('mid');
                $session = JFactory::getSession();
                $makeid = $session->set('autoz_makeid',$mkid);
                $searchtitle = JRequest::getVar('filter_md_title');
                $sortby = JRequest::getVar('sortby');
                $result =  $model->getAllModelsByMake($mkid,$searchtitle,$sortby,$limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                JToolBarHelper :: title($result[2]->title.' '.JText::_('MODELS'));
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                $this->assignRef('lists', $result[3]);
                $this->assignRef('makeid', $mkid);
                JToolBarHelper :: addNew('editvehiclemodel');
                JToolBarHelper :: editList('editvehiclemodel');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehiclemodel');
                JToolBarHelper :: cancel('cancelmodel');
            }elseif($layout == 'modelyears'){								//vehicle modelyears
                JToolBarHelper :: title(JText::_('MODEL_YEARS'));
                $result =  $model->getAllModelyears($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makemodelyeardefault');
                JToolBarHelper :: addNew('editvehiclemodelyear');
                JToolBarHelper :: editList('editvehiclemodelyear');
                JToolBarHelper :: deleteList('Are you sure to Delete', 'removevehiclemodelyear');
            }elseif($layout == 'transmissions'){								// vehicle transmissions
                JToolBarHelper :: title(JText::_('TRANSMISSIONS'));
                $result =  $model->getAllTransmissions($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('maketransmissiondefault');
                JToolBarHelper :: addNew('editvehicletransmission');
                JToolBarHelper :: editList('editvehicletransmission');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehicletramsmission');
            }elseif($layout == 'adexpiries'){								//vehicle adexpiries
                JToolBarHelper :: title(JText::_('ADEXPIRIES'));
                $result =  $model->getAllAddExpiries($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makeadexpirydefault');
                JToolBarHelper :: addNew('editvehicleadexpiry');
                JToolBarHelper :: editList('editvehicleadexpiry');
                JToolBarHelper :: deleteList('Are you sure to Delete','removevehicleadexpiry');
            }elseif($layout == 'cylinders'){								//vehicle cylinders
                JToolBarHelper :: title(JText::_('CYLINDERS'));
                $result =  $model->getAllCylinder($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: makeDefault('makecylinderdefault');
                JToolBarHelper :: addNew('editvehiclecylinder');
                JToolBarHelper :: editList('editvehiclecylinder');
                JToolBarHelper :: deleteList('Are you sure to Delete', 'removevehiclecylinder');
            }elseif($layout == 'conditions'){								//vehicle condition
                JToolBarHelper :: title(JText::_('CONDITIONS'));
                $result =  $model->getAllCondition($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: addNew('editvehiclecondition');
                JToolBarHelper :: editList('editvehiclecondition');
                JToolBarHelper :: deleteList('Are you sure to Delete', 'removevehiclecondiotion');
            }elseif($layout == 'categories'){								//vehicle categories
                JToolBarHelper :: title(JText::_('CATEGORIES'));
                $result =  $model->getAllCategories($limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                $this->assignRef('items', $result[0]);
                JToolBarHelper :: addNew('editvehiclecategory');
                JToolBarHelper :: editList('editvehiclecategory');
                JToolBarHelper :: deleteList('Are you sure to Delete', 'removevehiclecategory');
            }elseif($layout == 'configurations'){
			JToolBarHelper :: title(JText::_('CONFIGURATIONS'));
                        JToolBarHelper :: save('saveconf');
			$result =  $model->getConfigurationsForForm();
			$this->assignRef('lists', $result[1]);
            }elseif($layout == 'fieldsordering'){										// field ordering
                JToolBarHelper :: title(JText::_('FIELDS'));
                $fieldfor =  JRequest::getVar('ff');
                //$fieldfor = $_GET['ff'];
                if ($fieldfor) $_SESSION['fford'] = $fieldfor; else $fieldfor = $_SESSION['fford'];
                $result =  $model->getsFieldsOrdering($fieldfor, $limitstart, $limit);	// 1 for company
                $items = $result[0];
                $total = $result[1];
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper::publish('fieldpublished');
                JToolBarHelper::unpublish('fieldunpublished');
                JToolBarHelper :: cancel('cancel');
            }elseif($layout == 'countries'){										// countries
                JToolBarHelper :: title(JText::_('COUNTRIES'));
                $form = 'com_jsautoz.countries.list.';
                $searchname = $mainframe->getUserStateFromRequest( $form.'searchname', 'searchname','', 'string' );
                $result =  $model->getAllCountries($searchname,$limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if(isset($result[2]))
                $this->assignRef('lists', $result[2]);
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: addNew('editvehiclecountry');
                JToolBarHelper :: editList('editvehiclecountry');
                JToolBarHelper :: publishList('publishcountry');
                JToolBarHelper :: unpublishList('unpublishcountry');
                JToolBarHelper :: deleteList(JText::_('ARE_YOU_SURE_TO_DELETE'), 'removevehiclecountry');
            }elseif($layout == 'states'){										// states
                $countrycode = JRequest::getVar('ct');
                $session = JFactory::getSession();
                if(!$countrycode) $countrycode = $session->set('countrycode');
                $session->set('countrycode', $countrycode);
                $form = 'com_jsautoz.states.list.';
                $searchname = $mainframe->getUserStateFromRequest( $form.'searchname', 'searchname','', 'string' );
                
                JToolBarHelper :: title(JText::_('STATES'));
                if ($layout != 'states'){	$limitstart = 0;	$_SESSION['cur_page'] = 'states';	$mainframe->setUserState( $option.'.limitstart', $limitstart );	}
                $result =  $model->getAllCountryStates($searchname,$countrycode, $limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if(isset($result[2]))
                $this->assignRef('lists', $result[2]);
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: addNew('editvehiclestate');
                JToolBarHelper :: editList('editvehiclestate');
                JToolBarHelper :: publishList('publishstate');
                JToolBarHelper :: unpublishList('unpublishstate');
                JToolBarHelper :: deleteList(JText::_('ARE_YOU_SURE_TO_DELETE'), 'removevehiclestate');
            }elseif($layout == 'counties'){										// counties
                $statecode = JRequest::getVar('sd');
                //$statecode = $_GET['sd'];
                $session = JFactory::getSession();
                $session->set('statecode', $statecode);
                $form = 'com_jsautoz.counties.list.';
                $searchname = $mainframe->getUserStateFromRequest( $form.'searchname', 'searchname','', 'string' );

                //$_SESSION['statecode'] = $statecode;
                JToolBarHelper :: title(JText::_('COUNTIES'));
                $result =  $model->getAllStateCounties($searchname,$statecode, $limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if(isset($result[2]))
                $this->assignRef('lists', $result[2]);
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: addNew('editvehiclecounty');
                JToolBarHelper :: editList('editvehiclecounty');
                JToolBarHelper :: publishList('publishcounty');
                JToolBarHelper :: unpublishList('unpublishcounty');
                JToolBarHelper :: deleteList(JText::_('ARE_YOU_SURE_TO_DELETE'), 'removevehiclecounty');
            }elseif($layout == 'cities'){										// cities
                $countycode = JRequest::getVar('co');
                //$statecode = $_GET['sd'];
                $session = JFactory::getSession();
                $session->set('countycode', $countycode);
                $form = 'com_jsautoz.cities.list.';
                $searchname = $mainframe->getUserStateFromRequest( $form.'searchname', 'searchname','', 'string' );
                JToolBarHelper :: title(JText::_('CITIES'));
                //if ($layout != 'cities'){	$limitstart = 0;	$_SESSION['cur_page'] = 'cities';	$mainframe->setUserState( $option.'.limitstart', $limitstart );	}
                $result =  $model->getAllCountyCities($searchname,$countycode, $limitstart, $limit);
                $items = $result[0];
                $total = $result[1];
                if(isset($result[2]))
                $this->assignRef('lists', $result[2]);
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
                JToolBarHelper :: addNew('editvehiclecity');
                JToolBarHelper :: editList('editvehiclecity');
                JToolBarHelper :: publishList('publishcity');
                JToolBarHelper :: unpublishList('unpublishcity');
                JToolBarHelper :: deleteList(JText::_('ARE_YOU_SURE_TO_DELETE'), 'removevehiclecity');
            }elseif($layout == 'loadaddressdata'){										// load address data
                JToolBarHelper :: title(JText::_('LOAD_ADDRESS_DATA'));
                $error = 0;
                if (isset($_GET['er'])) $error = $_GET['er'];
                $this->assignRef('error', $error);
            }elseif($layout == 'userfields'){										// user field
                JToolBarHelper :: title(JText::_('USER_FIELDS'));
                JToolBarHelper :: addNew('edituserfields');
                JToolBarHelper :: editList('edituserfields');
                JToolBarHelper :: deleteList('Are you sure to Delete','removeuserfields');
        		$fieldfor =  JRequest::getVar('ff');
                if ($fieldfor) $_SESSION['ffusr'] = $fieldfor; else $fieldfor = $_SESSION['ffusr'];
                $result =  $model->getUserFields($fieldfor,  $limitstart, $limit);	
				$items = $result[0];
				$this->assignRef('items', $items);
				$total = $result[1];
                
                
                if ( $total <= $limitstart ) $limitstart = 0;
                $pagination = new JPagination( $total, $limitstart, $limit );
            }elseif($layout== 'vehicle_details'){
                        JToolBarHelper :: title(JText::_('VEHICLE_DETAIL'));
        		$id =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($id);
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleImagebyId($id);
			$this->assignRef('vehicleimages', $result1);
			$result2 = $model->getReviewbyVehicleId($id);
			$this->assignRef('review', $result2);
			$this->assignRef('layout', $layout);
            }elseif($layout== 'vehicle_specification'){
                        JToolBarHelper :: title(JText::_('VEHICLE_SPECIFICATION'));

                        $vehicleid =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($vehicleid);
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleOverviewbyId($vehicleid);
			$this->assignRef('vehicleoptions', $result1);
			$result2 = $model->getVehicleImagebyId($vehicleid);
			$this->assignRef('vehicleimages', $result2);
			$fieldorderings_options =$model->getFieldsOrdering(2);

			$this->assignRef('vehicleoption', $fieldorderings_options);

			$this->assignRef('layout', $layout);
			$this->assignRef('vehicleid', $vehicleid);
            }elseif($layout== 'vehicle_overview'){
                        JToolBarHelper :: title(JText::_('VEHICLE_OVERVIEW'));

			$vehicleid =  JRequest::getVar('id');
			$result = $model->getVehicleSpecificationbyId($vehicleid);
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleImagebyId($vehicleid);
			$this->assignRef('vehicleimages', $result1);
			$userfields = $model->getUserFieldsForForm(1, $vehicleid); // job fields , ref id
			$fieldorderings =$model->getFieldsOrdering(1);

			$this->assignRef('fieldorderings', $fieldorderings);
			$this->assignRef('userfields', $userfields);
			$this->assignRef('layout', $layout);
			$this->assignRef('vehicleid', $vehicleid);



            }elseif($layout== 'vehicle_gallery'){
			JToolBarHelper :: title(JText::_('VEHICLE_GALLERY'));
			$vehicleid =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($vehicleid);
			$this->assignRef('vehicle', $result);
			$result2 = $model->getVehicleImagebyId($vehicleid);
			$this->assignRef('vehicleimages', $result2);
			$result3 = $model->getAllImagebyVehicleId($vehicleid);
			$this->assignRef('vehicleimage', $result3);
			$this->assignRef('layout', $layout);
			$this->assignRef('vehicleid', $vehicleid);

		}elseif($layout == 'updateactivate'){
			JToolBarHelper :: title(JText::_('UPDATE_ACTIVATE'));
            $info =  $model-> getInfo( );	
			$refer =  $model-> getConfigrefer( );	
			$this->assignRef('refer', $refer); 
			$this->assignRef('info', $info); 
		}elseif($layout == 'emailtemplate'){										// email template
			$templatefor = JRequest::getVar('tf');
			switch($templatefor){
				case 'ew-vh' : $text = JText::_('NEW_VEHICLE'); break;
				case 'vh-ap' : $text = JText::_('VEHICLE_APPROVAL'); break;
				case 'vh-rj' : $text = JText::_('VEHICLE_REJECTING'); break;
				case 'pk-by' : $text = JText::_('PACKAGE_PURCHASE'); break;
				case 'pk-ap' : $text = JText::_('PAYMENT_APPROVAL'); break;
				case 'by-sl' : $text = JText::_('BUYER_CONTACT_SELLER'); break;
				case 'ew-rv' : $text = JText::_('VEHICLE_REVIEW'); break;
				case 'sl-rv' : $text = JText::_('SELLER_VEHICLE_REVIEW'); break;
				case 'vh-al' : $text = JText::_('VEHICLE_ALERT_SUBSCRIBER'); break;
				case 'ms-bs' : $text = JText::_('MESSAGE_BUYER_TO_SELLER'); break;
				case 'ms-sb' : $text = JText::_('MESSAGE_SELLER_TO_BUYER'); break;
				case 'tl-fr' : $text = JText::_('TELL_A_FRIEND'); break;
				case 'vs-vh' : $text = JText::_('NEW_VEHICLE_VISITOR'); break;
				case 'dl-ap' : $text = JText::_('DEALER_APPROVAL'); break;
                                
			}
			JToolBarHelper :: title(JText::_('EMAIL_TEMPLATES').' <small><small>['.$text.'] </small></small>');
			JToolBarHelper :: save('saveemailtemplate');
			$template =  $model->getTemplate($templatefor);	
			$this->assignRef('template', $template);
		 }elseif($layout == 'info'){										// employer package info
                        JToolBarHelper :: title(JText::_('INFORMATION'));
		}elseif($layout == 'themes'){
			JToolBarHelper :: title(JText::_('THEMES'));
			JToolBarHelper :: cancel();
		}else{
			JToolBarHelper :: title(JText :: _('CONTROL_PANEL') );
		}
			$totalVehicle = $model->getTotalVehicle();
			
            $this->assignRef('noofvehicles',$totalVehicle);
            $this->assignRef('pagination',$pagination);
            $this->assignRef('theme', $theme);
            $this->assignRef('config', $config);
            $this->assignRef('configs', $configs);
            $this->assignRef('option', $option);
            $this->assignRef('items', $items);
            $this->assignRef('params', $params);
            $this->assignRef('viewtype', $viewtype);
            $this->assignRef('uid', $uid);
            $this->assignRef('id', $id);
            $this->assignRef('Itemid', $itemid);
            $this->assignRef('pdflink', $pdflink);
            $this->assignRef('printlink', $printlink);
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

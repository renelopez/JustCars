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


class JSAutozViewbuyer extends JViewLegacy
{

	function display($tpl = null)
	{
		global $mainframe, $sorton, $sortorder, $option;
		
		$user	=& JFactory::getUser();
		$uid=$user->id;

		$Itemid =  JRequest::getVar('Itemid');
		$layout =  JRequest::getVar('layout');

		$model		= &$this->getModel('buyer');
		if($option == '')
			$option='com_jsautoz';
		$version = new JVersion;
		$joomla = $version->getShortVersion();
		$jversion = substr($joomla,0,3);
		$mainframe = JFactory::getApplication();

		// get configurations
		$config = Array();
		$session = JFactory::getSession();
		$config = $session->get('jsautoconfig_deft');
		$config = Array();
		if (sizeof($config) == 0){
			$results =  $model->getConfiginArray('default');
			if ($results){ //not empty
					$config = $results;
					$session->set('jsautoconfig_deft', $config);
			}
		}
		//print_r($config);
		$needlogin = false;
		switch($layout){
			case 'vehiclelist': if ($config['compare_requiredlogin'] == 1) $needlogin = true; break;
			case 'listvehicles': if ($config['buyer_newlisting_requiredlogin'] == 1) $needlogin = true; break;
			case 'vehicle_review': if ($config['review_requiredpackage'] == 1) $needlogin = true; break;
			case 'package_details': if ($config['review_requiredlogin'] == 1) $needlogin = true; break;
			default : $needlogin = false; break;
		}
		if ($user->guest) { // redirect user if not login
			if($needlogin){
				$redirectUrl = "http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
				$msg = JText::_('LOGIN_DESCRIPTION');

				$redirectUrl = '&amp;return='.base64_encode($redirectUrl);
				if($config['login_redirect']){
					$finalUrl = $config['login_redirect']. $redirectUrl;
				}else{
					if($jversion == '1.5') $finalUrl = 'index.php?option=com_user&view=login'. $redirectUrl;
					else $finalUrl = 'index.php?option=com_users&view=login'. $redirectUrl;
				}
				$mainframe->redirect($finalUrl,$msg);
			}
		}

		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		$limitstart =  JRequest::getVar('limitstart',0);
		$viewtype = 'html';
		$params = & $mainframe->getPageParameters('com_jsautoz');

		$themevalue = $config['theme'];
		if ($themevalue != 'templatetheme.css'){
                        //new css
			$theme['title'] = 'tp_title';
			$theme['heading'] = 'tp_heading';
			$theme['sectionheading'] = 'sectionheadline';
			$theme['sortlinks'] = 'sortlnks';
			$theme['jsautoz_odd'] = 'jsautoz_odd';
			$theme['jsautoz_even'] = 'jsautoz_even';
                        
                        //old

                        /*$theme['title'] = 'jppagetitle';
			$theme['heading'] = 'pageheadline';
			$theme['sectionheading'] = 'sectionheadline';
			$theme['sortlinks'] = 'sortlnks';
			$theme['odd'] = 'odd';
			$theme['even'] = 'even';*/
		}else{
			$theme['title'] = 'componentheading';
			$theme['heading'] = 'contentheading';
			$theme['sectionheading'] = 'sectiontableheader';
			$theme['sortlinks'] = 'sectiontableheader';
			$theme['jsautoz_odd'] = 'sectiontableentry1';
			$theme['jsautoz_even'] = 'sectiontableentry2';
		}
		$link = 'index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid='.$Itemid;
		$buyerlinks [] = array($link, JText::_('CONTROL_PANEL'),1);
		if($config['seperate_new_and_used_vehicle']==0){

                    $link = 'index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=11&Itemid='.$Itemid;
                    $buyerlinks [] = array($link, JText::_('VEHICLES'),0);

                }else{
                    
                    $link = 'index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=20&vtype=1&Itemid='.$Itemid;
                    $buyerlinks [] = array($link, JText::_('NEW_VEHICLES'),0);

                    $link = 'index.php?option=com_jsautoz&view=buyer&layout=listvehicles&cl=20&vtype=2&Itemid='.$Itemid;
                    $buyerlinks [] = array($link, JText::_('USED_VEHICLES'),0);

                }



		$link = 'index.php?option=com_jsautoz&view=buyer&layout=vehiclesearch&Itemid='.$Itemid;
		$buyerlinks [] = array($link, JText::_('SEARCH'),0);


		if($layout== 'controlpannel'){												// form vehicle
			$results =  $model->getConfiginArray('links');
			$this->assignRef('links', $results);
		}elseif($layout== 'vehiclesearch'){												// Search vehicle
			$result =  $model->getSearchOptions();
			$search =  $model->getConfiginArray('search');
			$this->assignRef('search', $search);
			$this->assignRef('lists', $result[2]);
			$this->assignRef('fieldorderings', $result[3]);
			JHTML::_('behavior.formvalidation');
		}elseif($layout== 'vehiclesearch_results'){	                    //  vehicle search results
			$data = JRequest :: get('post');
			$session =& JFactory::getSession();				
			if (isset($data['isvehiclesearch'])){
				if ($data['isvehiclesearch'] == 1){
					$session->set('jsautoz_vsearchdata', $data);
				}
			}
			$searchdata = $session->get('jsautoz_vsearchdata' );
                        $addon =  $model->getConfiginArray('addon');
			if(isset($searchdata )){
				$result =  $model->getVehicleSearchResults($searchdata, $limitstart, $limit );
				$this->assignRef('vehiclesearchresult',$result[0] );
                                $totalresult=$result[1];
                                $pagination = new JPagination($totalresult, $limitstart, $limit );
                                $this->assignRef('pagination', $pagination);
				
			}
                        $this->assignRef('addon', $addon);
                      
                     
		}elseif($layout== 'listvehicles'){
                    $data=JRequest::get('post');

                    $dealerid =  JRequest::getVar('did');
                    $clfrm =  JRequest::getVar('cl');
                    $type =  JRequest::getVar('type'); // car truck van etc 

                    $vehiclecountry =  JRequest::getVar('country');

                    $vehiclestate =  JRequest::getVar('state');
                        if($vehiclestate=="State"){
                            $vehiclestate="";
                        }
                    $vehiclecounty =  JRequest::getVar('county');
                    if($vehiclecounty =="County"){
                        $vehiclecounty="";
                    }
                    $vehiclecity =  JRequest::getVar('city');
                    if($vehiclecity=="City"){
                        $vehiclecity="";
                    }
                    $pricestart =  JRequest::getVar('prs');
                    $priceend =  JRequest::getVar('pre');
                    $modelyear =  JRequest::getVar('mod');
                    $svehiclefilter =  JRequest::getVar('isfilter');
                    
                    $vehicletype =  JRequest::getVar('vtype');
                    $vtype="";
                    if($vehicletype) $vtype=$vehicletype;

                    $makeid =  JRequest::getVar('mk');
                    $modelid =  JRequest::getVar('md');

					$mainframe = &JFactory::getApplication();
					$makeid_filter = $mainframe->getUserStateFromRequest( $option.'fmk', 'fmk',	'',	'int' );
					$modelid_filter = $mainframe->getUserStateFromRequest( $option.'fmd', 'fmd',	'',	'int' );
					$vtypeid_filter = $mainframe->getUserStateFromRequest( $option.'fvtype', 'fvtype',	'',	'int' );
					$modid_filter = $mainframe->getUserStateFromRequest( $option.'fmod', 'fmod',	'',	'int' );
					$longitude_filter = $mainframe->getUserStateFromRequest( $option.'f_lo', 'f_lo',	'',	'string' );
					$latitude_filter = $mainframe->getUserStateFromRequest( $option.'f_la', 'f_la',	'',	'string' );
					$radius_filter = $mainframe->getUserStateFromRequest( $option.'f_r', 'f_r',	'',	'string' );
					$radiuslength_filter = $mainframe->getUserStateFromRequest( $option.'f_r_l_t', 'f_r_l_t',	'',	'string' );
					$country_filter = $mainframe->getUserStateFromRequest( $option.'country', 'country',	'',	'string' );
					$state_filter = $mainframe->getUserStateFromRequest( $option.'state', 'state',	'',	'string' );
					$county_filter = $mainframe->getUserStateFromRequest( $option.'county', 'county',	'',	'string' );
					$city_filter = $mainframe->getUserStateFromRequest( $option.'city', 'city',	'',	'string' );

					if(($state_filter == 'state') || $state_filter == 'State') $state_filter = "";
					if(($county_filter == 'county') || $county_filter == 'County') $county_filter = "";
					if(($city_filter == 'city') || $city_filter == 'City') $city_filter = "";


                    $sortvalue =  $mainframe->getUserStateFromRequest( $option.'lv_sortvalue', 'lv_sortvalue',	'created',	'string' );
                    $sortorder =  $mainframe->getUserStateFromRequest( $option.'lv_sortorder', 'lv_sortorder',	'desc',	'string' );
					
					//if($makeid_filter) $makeid = $makeid_filter;elseif($makeid) $makeid_filter = $makeid;
					//if($modelid_filter) $modelid = $modelid_filter;elseif($modelid) $modelid_filter = $modelid;
					//if($vtypeid_filter != '-1' && !empty($vtypeid_filter)) $vtype = $vtypeid_filter;if($vtype) $vtypeid_filter = $vtype;

					//if(!empty($vtypeid_filter))$vtype = $vtypeid_filter;
/* temp close					
					if($vtype==$vtypeid_filter){
						$vtypeid_filter1=$vtype;
					}elseif($vtype!=$vtypeid_filter){
						$vtypeid_filter1=$vtype;
					}elseif(empty($vtype)){
						$vtypeid_filter1="";
					}
					if(empty($vtypeid_filter1)){
						if($vtypeid_filter !=-1){
							$vtype = $vtypeid_filter;
						}else{
							$vtype = "";
						}
					}else{
							$vtypeid_filter=$vtypeid_filter1;
						
					} 
*/				
					/*elseif($vtypeid_filter !=-1){
						$vtype = $vtypeid_filter;
						$vtypeid_filter=$vtype;
					}*/

					//if($vtypeid_filter != -1) $vtype = $vtypeid_filter; else $vtype = "";
					//echo '<br>vtype'.$vtype;exit;
					//if($vtype) $vtypeid_filter = $vtype;
					
					//if($modid_filter) $modelyear = $modid_filter;elseif($modelyear) $modid_filter = $modelyear;

					if($svehiclefilter!=1){

						if($makeid) $makeid_filter=$makeid;
						else $makeid_filter="";
						if($modelid) $modelid_filter=$modelid;
						else $modelid_filter="";
						
						if($modelyear) $modid_filter=$modelyear;
						else $modid_filter="";
						if($vehiclecountry) $country_filter=$vehiclecountry;
						else $country_filter="";
						if($vehiclestate) $state_filter=$vehiclestate;
						else $state_filter="";
						if($vehiclecounty) $county_filter=$vehiclecounty;
						else $county_filter="";
						if($vehiclecity) $city_filter=$vehiclecity;
						else $city_filter="";
						
						if((empty($vtype)) || ($vtype == -1)){
								$vtype = "";
								$vtypeid_filter = $vtype;
						}else{
							$vtype = $vtype;
							$vtypeid_filter = $vtype;
						}
					}elseif($svehiclefilter==1){ // when call from the filter we should set value according to filter
						$makeid = $makeid_filter;
						$modelid = $modelid_filter;
						
						$modelyear = $modid_filter;
						$vehiclecountry = $country_filter;

						$vehiclestate = $state_filter;

						$vehiclecounty = $county_filter;

						$vehiclecity = $city_filter;
						
						if($vtypeid_filter == -1){
							$vtype = "";
							$vtypeid_filter = "";
						}else{
							$vtype = $vtypeid_filter;
						}
						

					}
					
                    $addon =  $model->getConfiginArray('addon');
                    $filter =  $model->getConfiginArray('filter');
                    $rss =  $model->getConfiginArray('rss');
                    $quicklink=$model->getVehicleQuickLink();

                    $vehiclefilter=$model->getVehicleFilter($makeid_filter,$modelid_filter,$vtypeid_filter,$modid_filter,$country_filter,$state_filter,$county_filter,$city_filter,$radius_filter,$latitude_filter,$longitude_filter);
                    $show_sold_vehicles=$config['show_sold_vehicles'];
                    $maximumgoldvehicles=$config['show_maximum_gold_vehicles_on_vehicles_listing'];
                    $maximumfeaturedvehicles=$config['show_maximum_featured_vehicles_on_vehicles_listing'];

					if($radius_filter == "Coordinates Radius") $radius_filter = '';
					if($latitude_filter == "Latitude") $latitude_filter = '';
					if($longitude_filter == "Longitude") $longitude_filter = '';
                    $result = $model->getAllVehicles($show_sold_vehicles,$type,$vtype,$makeid,$modelid,$dealerid,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$pricestart,$priceend,$modelyear,$radius_filter,$latitude_filter,$longitude_filter,$radiuslength_filter,$sortvalue,$sortorder,$limitstart,$limit);
                    if($vehicletype) $vtypeid_filter = $vehicletype;//reset the filter vtype
                    $this->assignRef('vehiclelist', $result[0]);
                    $totalresult=$result[1];
                    if($makeid){
                                    $maketitle =$model->getVehicleMakeTitle($makeid);
                                    $this->assignRef('maketitle', $maketitle);
                        
                    }
                    if($modelid){
                                    $modeltitle =$model->getVehicleModelTitle($modelid);
                                    $this->assignRef('modeltitle', $modeltitle);
                        
                        
                    }
                    if(($modelyear) AND ($clfrm == 4)){
                            $modelyeartitle =$model->getVehicleYearTitle($modelyear);
                            $this->assignRef('modelyeartitle', $modelyeartitle);
                    }
                    if($type) {
                            $typetitle =$model->getVehicleTypeTitle($type);
                            $this->assignRef('typetitle', $typetitle );
                    }
                     
                    $sort = $model->getVehicleSort($sortvalue);
                    $pagination = new JPagination($totalresult, $limitstart, $limit );
                    $this->assignRef('pagination', $pagination);
                    $this->assignRef('sortvalue', $sortvalue);
                    $this->assignRef('sortorder', $sortorder);
                    $this->assignRef('makeid', $makeid);
                    $this->assignRef('modelid', $modelid);
                    //$this->assignRef('md2', $md2);
                    $this->assignRef('vtype', $vehicletype);
                    $this->assignRef('fvtype', $fvehicletype);
                    $this->assignRef('type', $type);
                    $this->assignRef('showsoldvehicles', $show_sold_vehicles);



                    $this->assignRef('country', $vehiclecountry);
                    $this->assignRef('state', $vehiclestate);
                    $this->assignRef('county', $vehiclecounty);
                    $this->assignRef('city', $vehiclecity);
                    $this->assignRef('txt_state', $txt_state);
                    $this->assignRef('txt_county', $txt_county);
                    $this->assignRef('txt_city', $txt_city);

                    $this->assignRef('fradius', $filter_radius);
                    $this->assignRef('flongitude', $filter_longitude);
                    $this->assignRef('flatitude', $filter_latitude);
                    $this->assignRef('fradiustype', $radiustype);

                    $this->assignRef('pricestart', $pricestart);
                    $this->assignRef('priceend', $priceend);
                    $this->assignRef('myid', $modelyear);
                    $this->assignRef('cl', $clfrm);
                    $this->assignRef('dellerid', $dealerid);
                    $this->assignRef('layout', $layout);

                    $this->assignRef('sort', $sort);
                    $this->assignRef('list', $quicklink);
                    $this->assignRef('vehiclefilter', $vehiclefilter[0]);
                    $this->assignRef('vehiclefiltervalue', $vehiclefilter[1]);

                    $this->assignRef('svehiclefilter', $svehiclefilter); // for handel the current location if vtype=1 or vtype=2 no cahnge in the current location
                
                    $this->assignRef('addon', $addon);
                    $this->assignRef('filter', $filter);
                    $this->assignRef('rss', $rss);
                    
                    
                    /*if($svehiclefilter==1) {
                                    $result = $model->getVehiclesByFilter($show_sold_vehicles,$makeid,$modelid,$vtype,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$modelyear,$sortvalue,$sortorder,$limitstart,$limit);
                                    $this->assignRef('vehiclelist', $result[0]);
                                    $totalresult=$result[1];
                     }elseif($makeid) {
                                    $result = $model->getVehiclesbyMake($show_sold_vehicles,$vtype,$makeid,$sortvalue,$sortorder,$limitstart,$limit);
                                    $this->assignRef('vehiclelist', $result[0]);
                                    $maketitle =$model->getVehicleMakeTitle($makeid);
                                    $this->assignRef('maketitle', $maketitle);
                                    $totalresult=$result[1];

                    }elseif($modelid){
                                    $result = $model->getVehiclesbyModel($show_sold_vehicles,$vtype,$modelid,$sortvalue,$sortorder,$limitstart,$limit);
                                    $this->assignRef('vehiclelist', $result[0]);
                                    $modeltitle =$model->getVehicleModelTitle($modelid);
                                    $this->assignRef('modeltitle', $modeltitle);
                                    $totalresult=$result[1];
                    }elseif($dealerid){
                                    $result = $model->getVehiclesbyDealer($show_sold_vehicles,$dealerid,$sortvalue,$sortorder,$limitstart,$limit);
                                    $this->assignRef('vehiclelist', $result[0]);
                                    $totalresult=$result[1];
                    }else{
                                    $result = $model->getAllVehicle($show_sold_vehicles,$vtype,$vehiclecountry,$vehiclestate,$vehiclecounty,$vehiclecity,$pricestart,$priceend,$modelyear,$sortvalue,$sortorder,$limitstart,$limit);
                                    $this->assignRef('vehiclelist', $result[0]);
                                    $totalresult=$result[1];
                                    if(($modelyear) AND ($clfrm == 4)){
                                            $modelyeartitle =$model->getVehicleYearTitle($modelyear);
                                            $this->assignRef('modelyeartitle', $modelyeartitle);
                                    }	
                    }*/

                }elseif($layout== 'compare_vehicles'){
		}elseif($layout== 'vehicle_details'){
        		$id =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($id);
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleImagebyId($id);
			$this->assignRef('vehicleimages', $result1);
			$this->assignRef('isdeller', $result3);
                        $quicklink=$model->getVehicleQuickLink();
                        $this->assignRef('list', $quicklink);
			$this->assignRef('review', $result2);
			$this->assignRef('layout', $layout);
		}elseif($layout== 'vehicle_specification'){

                        $vehicleid =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($vehicleid);
			$this->assignRef('vehicle', $result);
                        $result1 = $model->getVehicleOverviewbyId($vehicleid);
			$this->assignRef('vehicleoptions', $result1);
			$result2 = $model->getVehicleImagebyId($vehicleid);
			$this->assignRef('vehicleimages', $result2);
			$this->assignRef('isdeller', $result3);
			$this->assignRef('viewdeller', $result5);
                        $quicklink=$model->getVehicleQuickLink();
                        $fieldorderings_options =$model->getFieldsOrdering(2);

			$this->assignRef('vehicleoption', $fieldorderings_options);

                        $this->assignRef('list', $quicklink);
			$this->assignRef('review', $result4);
			$this->assignRef('layout', $layout);
		}elseif($layout== 'vehicle_overview'){
        		$id =  JRequest::getVar('id');
        		$cl =  JRequest::getVar('cl');
        		$vtype =  JRequest::getVar('vtype');
			$result = $model->getVehiclebyIds($id);
			$sethitvalue=$model->setVehicleHitValue($id);
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleImagebyId($id);
			$this->assignRef('vehicleimages', $result1);
			$this->assignRef('review', $result2);
			$this->assignRef('isdeller', $result3);

                        $quicklink=$model->getVehicleQuickLink();
                        $userfields = $model->getUserFields(1, $id); // job fields , ref id
                        $fieldorderings =$model->getFieldsOrdering(1); 
                        
                        $fieldorderings_vehicle =$model->getFieldsOrderingForVehicleOverview(1);

                        $this->assignRef('fieldorderings', $fieldorderings);
                        $this->assignRef('fieldorderings_vehicle', $fieldorderings_vehicle);
                        $this->assignRef('userfields', $userfields);
                        $this->assignRef('list', $quicklink);
			$this->assignRef('layout', $layout);
			$this->assignRef('vehicleid', $id);
			$this->assignRef('cl', $cl);
			$this->assignRef('vtype', $vtype);



		}elseif($layout== 'vehicle_gallery'){
        		$vehicleid =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($vehicleid);
			$this->assignRef('vehicle', $result);
			$result2 = $model->getVehicleImagebyId($vehicleid);
			$this->assignRef('vehicleimages', $result2);
			$this->assignRef('isdeller', $result3);
			$this->assignRef('review', $result4);
			$result5 = $model->getAllImagebyVehicleId($vehicleid);
			$this->assignRef('vehicleimage', $result5);
                        $quicklink=$model->getVehicleQuickLink();

                        $this->assignRef('list', $quicklink);
			$this->assignRef('layout', $layout);
		}elseif($layout== 'formbuyercontact'){	                    //  vehicle search results

                        $vehicleid =  JRequest::getVar('id');
			$result = $model->getVehiclebyIds($vehicleid );
			$this->assignRef('vehicle', $result);
			$result1 = $model->getVehicleImagebyId($vehicleid );
			$this->assignRef('vehicleimages', $result1);
                        $quicklink=$model->getVehicleQuickLink();
			$result3 = $model->checkDealer($result->uid);
			$this->assignRef('isdeller', $result3);

 			if($uid==0) {
				$result5 =  $model->getCaptchaForFormForBuyer();
				$this->assignRef('captcha', $result5);
			}

                        $this->assignRef('list', $quicklink);
			$this->assignRef('review', $result2);
			$this->assignRef('layout', $layout);
                        $this->assignRef('vehicleid', $vehicleid);
		}elseif($layout== 'vehicles'){
			$vehicletype =  JRequest::getVar('vtype');
			$vtype="";
			if($vehicletype) $vtype=$vehicletype;
			if($config['vehiclemakemodel'] == 'mkmdcu' ){
				$result = $model->getVehiclebyMakesModels($vtype);
				$this->assignRef('vehiclemakemodel', $result);
			}else if($config['vehiclemakemodel'] == 'mkmd') {
				$result = $model->getVehiclebyMakesModelsNotTotal($vtype);
				$this->assignRef('vehiclemakemodel', $result);
			}else if($config['vehiclemakemodel'] == 'mk'){
				$result = $model->getVehiclebyMakes($vtype);
				$this->assignRef('vehiclemake', $result);
			}
			$this->assignRef('vehicletype', $vtype);

		}elseif($layout== 'vehicle_models'){
			$result = $model->getVehiclebyModels();
			$this->assignRef('vehiclemodel', $result);
		}elseif($layout== 'vehiclebycity'){
			$result = $model->getVehiclebyCities();
			$this->assignRef('vehiclebycities', $result);
		}elseif($layout== 'vehiclebytypes'){
			$result = $model->getVehiclesbyVehicleType();
			$this->assignRef('vehiclebytypes', $result);
		}elseif($layout== 'vehiclebyprice'){
			$start=$config['pricerangestart'];
			$end=$config['pricerangeend'];
			$gap=$config['pricegap'];
			$result = $model->getVehiclebyPrice($start,$end,$gap);
			$this->assignRef('vehiclebyprice', $result);
		}elseif($layout== 'vehiclebymodelyear'){
			$result = $model->getVehicleByModelYear();
			$this->assignRef('vehiclebymodelyear', $result);
		}

		$this->assignRef('config', $config);
		$this->assignRef('theme', $theme);
		$this->assignRef('option', $option);
		$this->assignRef('params', $params);
		$this->assignRef('viewtype', $viewtype);
		$this->assignRef('uid', $uid);
		$this->assignRef('id', $id);
		$this->assignRef('Itemid', $Itemid);
		$this->assignRef('pdflink', $pdflink);
		$this->assignRef('printlink', $printlink);
		$this->assignRef('buyerlinks', $buyerlinks);

		parent :: display($tpl);	
	}
	

	function getVehicleListOrdering( $sort ) {
		global $sorton, $sortorder;
		switch ( $sort ) {
			case "titledesc": $ordering = "vehicles.title DESC"; $sorton = "title"; $sortorder="DESC"; break;
			case "titleasc": $ordering = "vehicles.title ASC";  $sorton = "title"; $sortorder="ASC"; break;
			case "makedesc": $ordering = "makes.title DESC"; $sorton = "category"; $sortorder="DESC"; break;
			case "makeasc": $ordering = "makes.title ASC";  $sorton = "category"; $sortorder="ASC"; break;
			case "modeldesc": $ordering = "models.title DESC";  $sorton = "jobtype"; $sortorder="DESC"; break;
			case "modelasc": $ordering = "models.title ASC";  $sorton = "jobtype"; $sortorder="ASC"; break;
			case "typedesc": $ordering = "vehicletypes.title DESC";  $sorton = "jobstatus"; $sortorder="DESC"; break;
			case "typeasc": $ordering = "vehicletypes.title ASC";  $sorton = "jobstatus"; $sortorder="ASC"; break;
			case "countrydesc": $ordering = "country.name DESC";  $sorton = "country"; $sortorder="DESC"; break;
			case "countryasc": $ordering = "country.name ASC";  $sorton = "country"; $sortorder="ASC"; break;
			default: $ordering = "job.id DESC";
		}
		return $ordering;
	}
	function getVehicleListSorting( $sort ) {
		$sortlinks['title'] = $this->getSortArg("title",$sort);
		$sortlinks['make'] = $this->getSortArg("make",$sort);
		$sortlinks['model'] = $this->getSortArg("model",$sort);
		$sortlinks['type'] = $this->getSortArg("type",$sort);
		$sortlinks['country'] = $this->getSortArg("country",$sort);
		$sortlinks['created'] = $this->getSortArg("created",$sort);

		return $sortlinks;
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

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

class JSAutozViewSeller extends JViewLegacy
{

	function display($tpl = null)
	{
		global $mainframe, $sorton, $sortorder, $option;
		$user	=& JFactory::getUser();
		$uid=$user->id;
		$Itemid =  JRequest::getVar('Itemid');
                $layout =  JRequest::getVar('layout');
		$model		= &$this->getModel();
                $version = new JVersion;
                $joomla = $version->getShortVersion();
                $jversion = substr($joomla,0,3);
                $mainframe = JFactory::getApplication();
		if($option == '')
                $option='com_jsautoz';
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
		$default_currency =  $model->getDefaultCurrency();
		$params = & $mainframe->getPageParameters('com_jsautoz');
		$page_title = $params->get('page_title');
                $visitor =  $model->getConfiginArray('visitor');
		$needlogin = false;
                switch($layout){
                    case 'purchasehistory': if ($config['purchasehistory_requiredlogin'] == 1) $needlogin = true; break;
                    case 'package_buynow': if ($config['packagebuynow_requiredlogin'] == 1) $needlogin = true; break;
                    //case 'vehiclelist': if ($config['newlisting_requiredlogin'] == 1) $needlogin = true; break;
                    case 'formvehicle':  
                        if($uid==0){
                                $semail =  JRequest::getVar('semail');
                                if((isset($semail))&&($semail!=="")){
                                    if ($config['newlisting_requiredlogin'] == 1) $needlogin = false; 
                                }else{
                                    if ($config['newlisting_requiredlogin'] == 1) $needlogin = true;
                                }
                        }else{
                            if ($config['newlisting_requiredlogin'] == 1) $needlogin = true; 
                            
                        }
                    break;    
                    case 'vehiclelist':  
                    if(!$uid){
                            $needlogin = true;
					}else{
						JRequest::setVar('vedit', 'FALSE'); //visitor cannot edit vehicles please contact administrator
						JRequest::setVar('layout', 'vehiclelist'); 
						$needlogin = false;
					} 
                    break;    
                    case 'my_stats':  $needlogin = true; break;
                    case 'sellermessages':  $needlogin = true; break;
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
                                    if($jversion == '1.5'){
                                    $finalUrl = 'index.php?option=com_user&view=login'. $redirectUrl;
                                }else{
                                    $finalUrl = 'index.php?option=com_users&view=login'. $redirectUrl;
                                }

                            }
                            $mainframe->redirect($finalUrl,$msg);
                    }
                }
		$limit		= $mainframe->getUserStateFromRequest( 'global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int' );
		//$limitstart	= $mainframe->getUserStateFromRequest( $option.'.limitstart', 'limitstart', 0, 'int' );
		$limitstart =  JRequest::getVar('limitstart',0);

		$viewtype = 'html';
		$params = & $mainframe->getPageParameters('com_jsautoz');
		$id = & $this->get('Id');
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
		$link = 'index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid='.$Itemid;
		$sellerlinks [] = array($link, JText::_('CONTROL_PANEL'),1);
		
		if($config['seperate_new_and_used_vehicle']==0){

                    $link = 'index.php?option=com_jsautoz&view=seller&layout=formvehicle&nadtype=1&Itemid='.$Itemid;
                    $sellerlinks [] = array($link, JText::_('NEW_VEHICLE'),0);

                }else{
                    
                    $link = 'index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=1&Itemid='.$Itemid;
                    $sellerlinks [] = array($link, JText::_('ADD_NEW_VEHICLE'),0);
                    
                    $link = 'index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=2&Itemid='.$Itemid;
                    $sellerlinks [] = array($link, JText::_('ADD_USED_VEHICLE'),0);

                }
                if($uid){
                    if($config['seperate_new_and_used_vehicle']==0){ 
                        $link = 'index.php?option=com_jsautoz&view=seller&layout=vehiclelist&nadtype=1&Itemid='.$Itemid;
                        $sellerlinks [] = array($link, JText::_('MY_VEHICLE'),0);

                    }else{
                        $link = 'index.php?option=com_jsautoz&view=seller&layout=vehiclelist&Itemid='.$Itemid;
                        $sellerlinks [] = array($link, JText::_('MY_VEHICLE'),0);

                    }
                }
		$link = 'index.php?option=com_jsjobs&c=jsjobs&view=jobseeker&layout=listnewestjobs&Itemid='.$Itemid;
		$jobseekerlinks [] = array($link, JText::_('NEWEST_JOBS'),0);
	
		$link = 'index.php?option=com_jsjobs&c=jsjobs&view=jobseeker&layout=myresumes&Itemid='.$Itemid;
		$jobseekerlinks [] = array($link, JText::_('MY_RESUMES'),-1);
                $layout =  JRequest::getVar('layout');
		if($layout== 'controlpannel'){												// form vehicle
			$links =  $model->getConfiginArray('links');
			$visitor =  $model->getConfiginArray('visitor');
			$this->assignRef('links', $links);
			$this->assignRef('visitor', $visitor);
		}elseif($layout== 'formvehicle') {												// form vehicle
			$id =  JRequest::getVar('id');
			$adtype =  JRequest::getVar('adtype');
			$semail =  JRequest::getVar('semail');
			$curlocation =  JRequest::getVar('nadtype'); // for handle the current location when not seprate new and used vehicles

            if ($adtype) $handlecaptcha = $adtype; else $handlecaptcha = $curlocation;
                        
			$result =  $model->getVehicleforForm($id,$uid,$adtype,$semail);
			if($uid==0) {
				if(is_numeric($handlecaptcha)){
					$spam_check =  $model->getCaptchaForFormForSeller();
					$this->assignRef('captcha', $spam_check);
				}
			}
			$checkcellerinfo =  $model->checkCellerInfo($uid);
			$this->assignRef('vehicle', $result[0]);
			$this->assignRef('vehicleoptions', $result[1]);
			$this->assignRef('lists', $result[2]);
			$this->assignRef('fieldorderings', $result[3]);
			$this->assignRef('fieldorderings_options', $result[4]);
			$this->assignRef('canaddnewvehicle', $result[5]);
			$this->assignRef('packagedetail', $result[6]);
			$this->assignRef('userfields', $result[7]);
			$this->assignRef('adtype', $adtype);
			$this->assignRef('curloc', $curlocation);
			$this->assignRef('semail', $semail);
			$this->assignRef('cellerinfo', $checkcellerinfo);
			JHTML::_('behavior.formvalidation');
                        //print_r($result[7]);
                        //exit();
	}elseif($layout== 'formagent'){												// form vehicle
			$id =  JRequest::getVar('id');
			$result =  $model->getAgentforForm($id,$uid);
			$this->assignRef('vehicle', $result[0]);
			$this->assignRef('lists', $result[1]);
			$this->assignRef('fieldorderings', $result[2]);
			JHTML::_('behavior.formvalidation');
		}elseif($layout== 'view_vehicle'){ 															// view vehicle
			if (!isset($id)) $id='';
			$id=  JRequest::getVar('id');
			$result =  $model->getVehiclebyId($id);
			$vehicleimages =  $model->getVehicleImages($id);
			$this->assignRef('vehicleimages', $vehicleimages);
			$this->assignRef('vehicleid', $id);
			$this->assignRef('vehicle', $result[0]);
			$this->assignRef('vehicleoptions', $result[1]);
			$this->assignRef('fieldorderings', $result[2]);
			$this->assignRef('fieldorderings_options', $result[4]);
		}elseif($layout== 'vehiclelist'){
			$visitorcaneditvehicle=  JRequest::getVar('vedit'); 
			$visitoremail=  JRequest::getVar('vemail');
			$nadtype=  JRequest::getVar('nadtype');
			$session = JFactory::getSession();
			$session->set('jsautoz_visitoremail',$visitoremail);
			
			//echo '<br>$visitoremail'.$visitoremail;
			$result = $model->getAllVehicle($visitoremail,$uid,$limitstart,$limit);
			$this->assignRef('vehiclelist', $result[0]);
			$this->assignRef('nadtype', $nadtype);
			$totalresult=$result[1];
			$pagination = new JPagination($totalresult, $limitstart, $limit );
			$this->assignRef('pagination', $pagination);
			
		}elseif($layout== 'vehicle_images') {
			$cl =  JRequest::getVar('cl');
			$semail =  JRequest::getVar('semail');
			$curlocation =  JRequest::getVar('nadtype'); // for handle the current location when not seprate new and used vehicles
			
			//$_SESSION['js_autos_new_vehicleid'] =2 ;
			if(isset($_SESSION['js_autos_new_vehicleid'])){
				$vehicleid = $_SESSION['js_autos_new_vehicleid'];
				//echo 'vehicle'.$vehicleid;
			}
			$vehicleimages =  $model->getVehicleImages($vehicleid);
			$totalimage = $model->getVehicleImagesTotal($vehicleid);
			$this->assignRef('totalimages', $totalimage);
			$this->assignRef('cl', $cl);
			$this->assignRef('vehicleimages', $vehicleimages);
			$this->assignRef('vehicleid', $vehicleid);
			$this->assignRef('curloc', $curlocation);
			
		}elseif($layout== 'images'){
			$_SESSION['js_autos_new_vehicleid'] =2 ;
                        $vehicleid = $_SESSION['js_autos_new_vehicleid'];
			/*if(isset($_SESSION['js_autos_new_vehicleid'])){
				$vehicleid = $_SESSION['js_autos_new_vehicleid'];
				echo 'vehicle'.$vehicleid;
			}*/
			$vehicleimages =  $model->getVehicleImages($vehicleid);
			//$vehicle =  $model->getImageData($imagefolder, $imageurl, $label = false);
			$this->assignRef('vehicleimages', $vehicleimages);
			$this->assignRef('vehicleid', $vehicleid);
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
		$this->assignRef('sellerlinks', $sellerlinks);
		$this->assignRef('defaultcurrency', $default_currency);
		
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

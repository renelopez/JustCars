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

	function __construct()
	{
		$user	=& JFactory::getUser();
		$uid = $user->id;
		if ($user->guest) { // redirect user if not login
			$link = 'index.php?option=com_user';
			$this->setRedirect($link);
		} 

		parent :: __construct();
	}
	
	function getmyvehicles(){
		$data = JRequest :: get('post');
		$model = $this->getModel('seller', 'JSAutozModel');
		$Itemid = JRequest :: getVar('Itemid');
		$visitorvehicleid=$data['vehicleid'];
		$visitoremail=$data['email'];
		$return_value = $model->checkVisitorData($visitorvehicleid,$visitoremail);
		if($return_value==1){
			//$msg = JText::_('VEHICLE_MARK_AS_SOLD');
			$link = "index.php?option=com_jsautoz&view=seller&layout=vehiclelist&vemail=".$visitoremail."&Itemid=".$Itemid;  //vemail visitor seller email 
			$this->setRedirect(JRoute::_($link), $msg);
		}elseif($return_value==0){
			$msg = JText::_('INVALID_AUTHENTICATION_VEHICLE_ID');
			$link = "index.php?option=com_jsautoz&view=seller&layout=authenticate&Itemid=".$Itemid;  //vemai visitor seller email 
			$this->setRedirect(JRoute::_($link), $msg);
		}elseif($return_value==2){
			$msg = JText::_('EMAIL_ADDRESS_NOT_MATCH');
			$link = "index.php?option=com_jsautoz&view=seller&layout=authenticate&Itemid=".$Itemid;  //vemai visitor seller email 
			$this->setRedirect(JRoute::_($link), $msg);
			
		}
		
		
	}

	function deletevehicle(){
		$vehicleid = JRequest :: getVar('id');
		$user	=& JFactory::getUser();
		$uid = $user->id;
		$Itemid = JRequest :: getVar('Itemid');
		$model = $this->getModel('seller', 'JSAutozModel');
		$return_value = $model->deleteVehicle($vehicleid,$uid);
		if($return_value == 1) $msg = JText::_('VEHICLE_HAS_BEEN_DELETED');
		elseif($return_value == 2) $msg = JText::_('THIS_IS_NOT_YOUR_VEHICLE');
		elseif($return_value == 3) $msg = JText::_('VEHICLE_IN_USE_YOU_CAN_NOT_DELETE_IT');
		else $msg = JText::_('ERROR_VEHICLE_DELETING');
		$link = "index.php?option=com_jsautoz&view=seller&layout=vehiclelist&Itemid=".$Itemid;
		$this->setRedirect(JRoute::_($link), $msg);
	}

        function sendmailtofriend(){
		$data= JRequest :: get('post');
                $vehicleLink=$data['emaillink'];
		$model = $this->getModel('buyer', 'JSAutozModel');
		$return_value = $model->sendMailToFriend($data);
		if($return_value == 1) {
                    $msg = JText::_('THANKS_FOR_TELLING_A_FRIEND_ABOUT_VEHICLE');
                }else{
                    $msg = JText::_('ERROR_SENDIND_MAIL_TO_FRIEND');
                    
                }
                $this->setRedirect(JRoute::_($vehicleLink), $msg);
                
            
        }
/*	function tellafriend(){
		global $mainframe;
		$model = $this->getModel('buyer', 'JSAutozModel');
		$default_config = $model->getConfiginArray('default');
                $theme=$default_config['theme'];
                if($theme=="/gray/css/jsautozgray.css") {
                    $style ="background-color: #E3E2E4";
                }elseif($theme=="jsautos02.css"){
                    $style ="background-color: #EFE0F1";
                    
                }elseif($theme=="jsautos03.css"){
                    $style ="background-color: #F8F1CA";
                    
                }elseif($theme=="jsautos04.css"){
                    $style ="background-color: #E5F9C9";
                    
                }elseif($theme=="jsautos05.css"){
                    $style ="background-color: #FEEEF4";
                    
                }elseif($theme=="jsautos06.css"){
                    $style ="background-color: #080808";
                    
                }elseif($theme=="jsautos07.css"){
                    $style ="background-color: #CFD1FF";
                    
                }
                $divstyle="margin-bottom: 5px";
		$mainframe = &JFactory::getApplication();
		$vehicleid= JRequest :: getVar('id');
		$vtype= JRequest :: getVar('vtype');
		$call= JRequest :: getVar('call');
                $redirectUrl = "http://" . $_SERVER['HTTP_HOST'];
                //$sitename=strstr($_SERVER['REQUEST_URI'],'&', true);
                $sitename = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&'));
                $link="&view=buyer&layout=vehicle_overview&id=".$vehicleid."&vtype=".$vtype."&cl=".$call;
                $emaillink=$redirectUrl.$sitename.$link;
                $finallink=JRoute::_($emaillink);
                    $return_value ="<form action='index.php?option=com_jsautoz&task=sendmailtofriend' method='post' name='adminForm' id='adminForm' class='form-validate' >";
                    $return_value .= "<table cellpadding='0' style='".$style."' cellspacing='0' border='1' width='99%'>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td width='100%' align='center' ><h1><b>".JText::_('TELL_A_FRIEND')."</b></h1></td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td width='20%' ><b>".JText::_('YOUR_NAME')."</b><font color='red'>*</font></td>\n";
                                $return_value .= "<td width='20%' ><b>".JText::_('YOUR_EMAIL')."</b><font color='red'>*</font></td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td width='20%' ><input class='inputbox required' type='text' name='your_name' id='name' size='20' maxlength='25' value=''></td>\n";
                                $return_value .= "<td width='20%' ><input class='inputbox required validate-email' type='text' name='your_email' id='email' size='31' maxlength='80' value=''></td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td colspan='2'  width='40%' ><b>".JText::_('FRIENDS_EMAIL')."</b><font color='red'>*</font>
                                    <input class='inputbox required validate-email' type='text' name='friend_email' id='name' size='40' maxlength='80' value=''>
                                </td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td colspan='2'  width='40%' ><b>".JText::_('FRIENDS_EMAIL')."</b>
                                    <input class='inputbox validate-email' type='text' name='friend_email1' id='name' size='40' maxlength='80' value=''>
                                </td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td colspan='2'  width='40%' ><b>".JText::_('FRIENDS_EMAIL')."</b>\n
                                    <input class='inputbox validate-email' type='text' name='friend_email2' id='name' size='40' maxlength='80' value=''>
                                </td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td colspan='2'  width='40%' ><b>".JText::_('FRIENDS_EMAIL')."</b>\n
                                    <input class='inputbox validate-email' type='text' name='friend_email3' id='name' size='40' maxlength='80' value=''>
                                </td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td width='20%' ><b>".JText::_('MESSAGE')."</b><font color='red'>*</font></td>\n";
                                $return_value .= "<td width='20%' ><b>".JText::_('MAX_250_CHARACTERS_ALLOWED')."</b></td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                                $return_value .= "<td colspan='2'  width='20%' >\n
                                    <textarea  name='message' id='message' rows='3'  
                                     cols='50' onKeyDown='limitText(this.form.message,this.form.countdown,250);'
                                     onKeyUp='limitText(this.form.message,this.form.countdown,250);'></textarea>\n
                                    ".JText::_('YOU_HAVE')."<input readonly type='text' name='countdown' size='3' value='250'>".JText::_('CHARACTERS_LEFT')."</font></td>";
                            $return_value .= "</tr>\n";
                            $return_value .= "<tr>\n";
                            $return_value .= "<td width='20%' ><input  type='hidden' name='emaillink' id='emaillink'  value='".$finallink."'></td>\n";
                            $return_value .= "<td width='20%' ><input  type='hidden' name='vehicleid' id='vehicleid'  value='".$vehicleid."'></td>\n";
                            $return_value .= "<td align='right' width='65%'><input type='button' class='button' onclick=\"javascript:tellafriendclose('tell_friend');\" value='".JText::_('CLOSE')."'> ";
                            $return_value .= "<input onclick='return myValidate(document.adminForm);' type='submit' name='submit' value='".JText::_('SEND_FRIEND')."'> </td>\n";
                            //$return_value .= "<td align='right' width='65%'><input type='button' class='button' onclick='vehicleshortlistsave("rating_",".$vehicleid.",".$uid.",".$vtype.")' value='".JText::_('SAVE')."'> </td>\n";
                            $return_value .= "</tr>\n";
                            $return_value .= "</table>\n";
                            $return_value .= "<div style='".$divstyle."'>\n";
                            $return_value .= "</div>\n";
                            $return_value .= "</form>\n";

		echo $return_value;
		$mainframe->close();

		
	} */

        function listmodels() {
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $val=JRequest::getVar( 'val');
            //$req=JRequest::getVar( 'req');
            //$model = $this->getModel('seller', 'JSAutozModel');
            $model = $this->getModel('buyer');
            $returnvalue = $model->listModels($val);
            echo $returnvalue;
            $mainframe->close();
        }
        function vehiclequicklistmodels(){
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $val=JRequest::getVar( 'val');
            $model = $this->getModel('buyer');
            $returnvalue = $model->listVehicleQuickModels($val);
            echo $returnvalue;
            $mainframe->close();


        }
        function vehiclefilterlistmodels(){
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $val=JRequest::getVar( 'val');
            $model = $this->getModel('buyer');
            $returnvalue = $model->listVehicleFilterModels($val);
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
            $model = $this->getModel('seller', 'JSAutozModel');
            $returnvalue = $model->getLocMapAddressData($val);
            echo json_encode($returnvalue);
            $mainframe->close();
        }
        
        function listregaddressdata() {
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $data=JRequest::getVar( 'data');
            $val=JRequest::getVar( 'val');
            $model = $this->getModel('seller', 'JSAutozModel');
            $returnvalue = $model->listRegAddressData($data, $val);
            echo $returnvalue;
            $mainframe->close();
        }
       function listlocaddressdata() {
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $data=JRequest::getVar( 'data');
            $val=JRequest::getVar( 'val');
            $model = $this->getModel('seller', 'JSAutozModel');
            $returnvalue = $model->listLocAddressData($data, $val);
            echo $returnvalue;
            $mainframe->close();
        }
       function listfilteraddressdata() {
            global $mainframe;
            $version = new JVersion;
            $joomla = $version->getShortVersion();
            $jversion = substr($joomla,0,3);
            $mainframe = JFactory::getApplication();
            $data=JRequest::getVar( 'data');
            $val=JRequest::getVar( 'val');
            $model = $this->getModel('seller', 'JSAutozModel');
            $returnvalue = $model->listFilterAddressData($data, $val);
            echo $returnvalue;
            $mainframe->close();
        }
        function savevehiclecurrency()	{
            global $mainframe;
            $mainframe = &JFactory::getApplication();
            $model = $this->getModel('buyer');
            $id=JRequest::getVar( 'id');
            $val=JRequest::getVar( 'val');
            $fild=JRequest::getVar( 'fild');

            $return_value = $model->storeVehicleCurrency($id, $val, $fild);
            echo $return_value;
            $mainframe->close();
        }
        function savevehicle() {
            global $mainframe;
            $data = JRequest :: get('post');
            $cl=$data['adtype'];
            $nvtype=$data['curloc'];  // when no seprate new and used vehicles
            $Itemid=$data['Itemid'];
            $model = $this->getModel('seller', 'JSAutozModel');
            $return_value = $model->storeVehicle($data);
            if($return_value[0] == 1 ){
                    $_SESSION['js_autos_new_vehicleid'] = $return_value[1];
                    $msg = JText :: _('VEHICLE_SAVE_UPLOAD_IMAGES');
                    if($nvtype){
                        $link = "index.php?option=com_jsautoz&view=seller&layout=vehicle_images&nadtype=".$nvtype."&rd=1&Itemid=".$Itemid;
                    }else{
                        $link = "index.php?option=com_jsautoz&view=seller&layout=vehicle_images&cl=".$cl."&Itemid=".$Itemid;
                    }
            }elseif($return_value[0] == 2 ){
                    $msg = JText :: _('SPAM_CHECK_FAILD_PLEASE_TRY_AGAIN');
		    $link = "index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=".$cl."&Itemid=".$Itemid;
				
	   }

            $this->setRedirect(JRoute::_($link) , $msg);
        }
        function savevehiclebuyercontact(){
            global $mainframe;
            $data = JRequest :: get('post');
            $vehid =  $data['vehicleid'];
            $vehtypeid =  $data['vtype'];
            $callfrom =  $data['cl'];
            $Itemid=$data['Itemid'];
            //$model = $this->getModel('buyer');
            $model = $this->getModel('buyer', 'JSAutozModel');
            $return_value = $model->storeVehicleBuyerContact($data);
            $link = 'index.php?option=com_jsautoz&view=buyer&layout=formbuyercontact&id='.$vehid.'&vtype='.$vehtypeid.'&cl='.$callfrom.'&Itemid='.$Itemid;
            if($return_value == 1){
                    $msg = JText :: _('MESSAGE_SEND_TO_SELLER');
            }elseif($return_value == 3){
                    $msg = JText :: _('SPAM_CHECK_FAILD_PLEASE_TRY_AGAIN');
            }else{
                    $msg = JText :: _('ERROR_SEND_MESSAGE_TO_SELLER');
            }
            $this->setRedirect($link , $msg);


        }
        function savevehicleimages() {
            global $mainframe;
            $data = JRequest :: get('post');
            $Itemid=$data['Itemid'];
	    $cl = $data['cl'];	
	    $nadtype = $data['nadtype'];	
            $model = $this->getModel('seller', 'JSAutozModel');
            $return_value = $model->storeVehicleImages($data);
            //if($return_value) $makedefaultimage = $model->checkMakeDefaultImage($data); //must make image default if default image not set
            if($return_value[2]) $makedefaultimage = $model->makeDefaultVehicleImage($return_value[0],$return_value[1],1); //must make image default if default image not set
	    $msg = JText::_('VEHICLE_IMAGE_SAVE');
            if($nadtype){
                    $link = "index.php?option=com_jsautoz&view=seller&layout=vehicle_images&nadtype=".$nadtype."&rd=1&Itemid=".$Itemid;
            }else{
                $link = 'index.php?option=com_jsautoz&view=seller&layout=vehicle_images&cl='.$cl.'&Itemid='.$Itemid;
                
            }
            $this->setRedirect(JRoute::_($link), $msg);
        }
        function makedefaultvehicleimage() {
            global $mainframe;
            $model = $this->getModel('seller', 'JSAutozModel');
            $vehid =  JRequest::getVar('vehid');
            $imgid =  JRequest::getVar('imgid');
            $rd =  JRequest::getVar('rd');
            $Itemid=$data['Itemid'];
            if($rd==1){
                $cl =  JRequest::getVar('cl');
                
            }else{
                $nadtype =  JRequest::getVar('nadtype');
                
            }
            
            //echo '<br>$cl'.$cl;
            //echo '<br>nadtype'.$nadtype;
            $return_value = $model->makeDefaultVehicleImage($vehid, $imgid,2);
            if ($return_value == 1)	{
                    $msg = JText :: _('VEHICLE_IMAGE_SET_DEFAULT');
            }else{
                    $msg = JText :: _('ERROR_IN_VEHICLE_IMAGE_SET_DEFAULT');
            }
            if($nadtype){
                    $link = "index.php?option=com_jsautoz&view=seller&layout=vehicle_images&nadtype=".$nadtype."&rd=1&Itemid=".$Itemid;
            }elseif($cl){
                $link = 'index.php?option=com_jsautoz&view=seller&layout=vehicle_images&cl='.$cl.'&Itemid='.$Itemid;
                
            }
            $this->setRedirect(JRoute::_($link), $msg);


        }
        function deletevehicleimages()  {     //delete vehicleimages
            global $mainframe;
            $model = $this->getModel('seller', 'JSAutozModel');
            $session = &JFactory::getSession();
            $user = & JFactory::getUser();
            $uid=$user->id;
            $Itemid =  JRequest::getVar('Itemid');
            $imageid =  JRequest::getVar('id');
            $vehicleid =  JRequest::getVar('vehid');
            $rd =  JRequest::getVar('rd');
            if($rd==1){
                $cl =  JRequest::getVar('cl');
                
            }else{
                $nadtype =  JRequest::getVar('nadtype');
                
            }
            
            //echo '<br>$cl'.$cl;
            //echo '<br>nadtype'.$nadtype;
            $return_value = $model->deleteVehicleImages($vehicleid,$imageid, $uid);
            if ($return_value == 1)	{
                    $msg = JText :: _('VEHICLE_IMAGE_DELETED');
            }elseif ($return_value == 2){
                    $msg = JText :: _('VEHICLE_IMAGE_CANNOT_DELETE');
            }elseif ($return_value == 3){
                    $msg = JText :: _('NOT_YOUR_VEHICLE_IMAGE');
            }else{
                    $msg = JText :: _('ERROR_DELETING_VEHICLE_IMAGE');
            }
            if($nadtype){
                    $link = "index.php?option=com_jsautoz&view=seller&layout=vehicle_images&nadtype=".$nadtype."&rd=1&Itemid=".$Itemid;
            }elseif($cl){
                $link = 'index.php?option=com_jsautoz&view=seller&layout=vehicle_images&cl='.$cl.'&Itemid='.$Itemid;
                
            }
            $this->setRedirect(JRoute::_($link), $msg);
        }
 	function updateaddexpiry()	{
		global $mainframe;
		$mainframe = &JFactory::getApplication();
		$model = $this->getModel('seller', 'JSAutozModel');
	     $id=JRequest::getVar( 'id');
	     $val=JRequest::getVar( 'val');
	    $fild=JRequest::getVar( 'fild');

		$return_value = $model->updateAddExpiry($id, $val, $fild);
		echo $return_value;
		$mainframe->close();
	}
       function display() {
            $document = & JFactory :: getDocument();
            $user =& JFactory::getUser();
            $uid = $user->id;

            $viewName = JRequest :: getVar('view', '');
            $layoutName = JRequest :: getVar('layout', '');
            $viewName = JRequest :: getVar('view', '');
            $layoutName = JRequest :: getVar('layout', '');
            $viewType = $document->getType();
                $view = & $this->getView($viewName, $viewType);
                if($viewName == 'buyer') $model	= &$this->getModel( $viewName );
                elseif($viewName == 'seller') $model = $this->getModel('seller','JSAutozModel');
                else $model = $this->getModel('rss','JSAutozModel');
            $view = & $this->getView($viewName, $viewType);
            if (!JError :: isError($model)){
            $view->setModel($model, true);
            }
            $view->setLayout($layoutName);
            $view->display();
        }

}
?>

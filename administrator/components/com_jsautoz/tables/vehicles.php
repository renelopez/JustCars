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

// our table class for the application data
class Tablevehicles extends JTable
{
/** @var int Primary key */
	var $id=null;
	var $uid=null;
	var $agentid=null;
	var $title=null;
	var $loczip=null;
	var $packageid=null;
	var $paymenthistoryid=null;
	var $vehicletypeid=null;
	var $makeid=null;
	var $modelid=null;
	var $categoryid=null;
	var $modelyearid=null;
	var $conditionid=null;
	var $fueltypeid=null;
	var $currencyid=null;
	var $cylinderid=null;
	var $transmissionid=null;
	var $adexpiryid=null;
	var $regcountry=null;
	var $regstate=null;
	var $regcounty=null;
	var $regcity=null;
	var $loccountry=null;
        var $locstate=null;
	var $loccounty=null;
	var $loccity=null;
	var $mileages=null;
	var $mileagetypeid=null;
	var $price=null;
	var $exteriorcolor=null;
	var $interiorcolor=null;
	var $enginecapacity=null;
	var $cityfuelconsumption=null;
	var $highwayfuelconsumption=null;
	var $map=null;
	var $video=null;
	var $description=null;
	var $status=null;
	var $created=null;
	var $isgoldvehicle=null;
	var $isfeaturedvehicle=null;
	var $addexpiryvalue=null;
	var $hits=null;
	var $issold=null;
	var $solddated=null;
	var $latitude=null;
	var $longitude=null;
	var $registrationnumber=null;
	var $enginennumber=null;
	var $chasisnumber=null;
	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_vehicles', 'id' , $db );
	}
	
	/** 
	 * Validation
	 * 
	 * @return boolean True if buffer is valid
	 * 
	 */
	 function check()
	 {
	 	return true;
	 }
	 	 
}

?>

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
class Tablevehicleoptions extends JTable
{
/** @var int Primary key */
  var $id = null;
  var $vehicleid = null;
  var $door2 = 0;
  var $door3 = 0;
  var $door4 = 0;
  var $covertible = 0;
  var $crewcab = 0;
  var $extendedcab = 0;
  var $longbox = 0;
  var $offroadpackage = 0;
  var $shortbox = 0;
  var $wheeldrive2 = 0;
  var $wheeldrive4 = 0;
  var $allwheeldrive = 0;
  var $rearwheeldrive = 0;
  var $supercharged = 0;
  var $turbo = 0;
  var $alloywheels = 0;
  var $bedliner = 0;
  var $bugshield = 0;
  var $campermirrors = 0;
  var $cargocover = 0;
  var $customwheels = 0;
  var $dualslidingdoors = 0;
  var $foglamps = 0;
  var $heatedwindshield = 0;
  var $immitationconvertibletop = 0;
  var $luggagerack = 0;
  var $metallicpaint = 0;
  var $nerfbars = 0;
  var $newtires = 0;
  var $premiumwheels = 0;
  var $rearwiper = 0;
  var $removeabletop = 0;
  var $ridecontrol = 0;
  var $runningboards = 0;
  var $splashquards = 0;
  var $spoiler = 0;
  var $sunroof = 0;
  var $ttops = 0;
  var $tonneaucover = 0;
  var $towingpackage = 0;
  var $ndrowbucketseats2 = 0;
  var $rdrowseat3 = 0;
  var $adjustablefootpedals = 0;
  var $airconditioning = 0;
  var $autodimisrvmirror = 0;
  var $bucketseats = 0;
  var $centerconsole = 0;
  var $childseat = 0;
  var $cooledseats = 0;
  var $cruisecontrol = 0;
  var $dualclimatecontrol = 0;
  var $heatedmirrirs = 0;
  var $heatedseats = 0;
  var $leatherseats = 0;
  var $power3rdrowseat = 0;
  var $powerdoorlocks = 0;
  var $powermirrors = 0;
  var $powerseats = 0;
  var $powersteering = 0;
  var $powerwindows = 0;
  var $rearairconditioning = 0;
  var $reardefrost = 0;
  var $rearslidingwindow = 0;
  var $tiltsteering = 0;
  var $tintedwindows = 0;
  var $alarm = 0;
  var $amfmradio = 0;
  var $antitheft = 0;
  var $cdchanger = 0;
  var $cdplayer = 0;
  var $dualdvds = 0;
  var $dvdplayer = 0;
  var $handsfreecomsys = 0;
  var $homelink = 0;
  var $informationcenter = 0;
  var $integratedphone = 0;
  var $ipodport = 0;
  var $ipodmp3port = 0;
  var $keylessentry = 0;
  var $memoryseats = 0;
  var $navigationsystem = 0;
  var $onstar = 0;
  var $backupcameraandmirror = 0;
  var $parkassistrear = 0;
  var $powerliftgate = 0;
  var $rearlockingdifferential = 0;
  var $rearstereo = 0;
  var $remotestart = 0;
  var $satelliteradio = 0;
  var $steeringwheelcontrols = 0;
  var $stereotape = 0;
  var $tirepressuremonitorsystem = 0;
  var $trailerbrakesystem = 0;
  var $tripmileagecomputer = 0;
  var $tv = 0;
  var $antilockbrakes = 0;
  var $backupsensors = 0;
  var $cartracker = 0;
  var $driverairbag = 0;
  var $passengerairbag = 0;
  var $rearairbags = 0;
  var $sideairbags = 0;
  var $signalmirrors = 0;
  var $tractioncontrol = 0;
  var $userfield1=0;
  var $userfield2=0;
  var $userfield3=0;
  var $userfield4=0;
  var $userfield5=0;
  var $userfield6=0;
  var $userfield7=0;
  var $userfield8=0;
  var $userfield9=0;
  var $userfield10=0;
  var $userfield11=0;
  var $userfield12=0;
  var $userfield13=0;
  var $userfield14=0;
  var $userfield15=0;

	function __construct(&$db)
	{
		parent::__construct( '#__js_auto_vehicleoptions', 'id' , $db );
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

<?php
/**
 * @Copyright Copyright (C) 2012 ... Ahmad Bilal
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , ahmad@burujsolutions.com
 * Created on:	April 05, 2012
 ^
 + Project: 	JS Autoz
 ^ 
*/

defined('_JEXEC') or die('Restricted access');
 
 
function JSAutozBuildRoute( &$query )
{
       $segments = array();
	   
		//if(isset( $query['c'] )) { $segments[] = $query['c']; unset( $query['c'] );};
		if(isset( $query['view'] )) { 
			$view = $query['view']; 
			unset( $query['view'] ); 
		};
		if(isset( $query['layout'] )) { 
			$value = buildLayout($query['layout'],$view);
			$segments[] = $value; unset( $query['layout'] );
		};

		//task
		if(isset( $query['task'] )) { 
			if(count($segments) == 0) $segments[] = 'tk';
			$segments[] = $query['task']; unset( $query['task'] );
		}

		// listvehicles
		if(isset( $query['cl'] )) {
			$value = buildCL($query['cl']);
			$segments[] = $value; unset( $query['cl'] );
		 };
		if(isset( $query['vtype'] )) {
			$value = buildCondition($query['vtype']);
			$segments[] =$value; unset( $query['vtype']); 
		};
		if(isset( $query['mk'] )) { $segments[] = "m-".$query['mk']; unset( $query['mk'] );};
		if(isset( $query['md'] )) { $segments[] = "d-".$query['md']; unset( $query['md'] );};

			// by city
		if(isset( $query['country'] )) { $segments[] = "cn-".$query['country']; unset( $query['country'] );};
		if(isset( $query['state'] )) { $segments[] = "st-".$query['state']; unset( $query['state'] );};
		if(isset( $query['county'] )) { $segments[] = "ct-".$query['county']; unset( $query['county'] );};
		if(isset( $query['city'] )) { $segments[] = "cy-".$query['city']; unset( $query['city'] );};
			// by price
		if(isset( $query['prs'] )) { $segments[] = "ps-".$query['prs']; unset( $query['prs'] );};
		if(isset( $query['pre'] )) { $segments[] = "pe-".$query['pre']; unset( $query['pre'] );};
			// by model year
		if(isset( $query['mod'] )) { $segments[] = "my-".$query['mod']; unset( $query['mod'] );};
			
		// vehicle_overview, vehicle_specification, vehicle_gallery, vehicle_reviews, formbuyercontact
		if(isset( $query['id'] )) { $segments[] = "12-".$query['id']; unset( $query['id'] );};
		if(isset( $query['did'] )) { $segments[] = "13-".$query['did']; unset( $query['did'] );};

		//vehicle_review
		if(isset( $query['vehicleid'] )) { $segments[] = "14-".$query['vehicleid']; unset( $query['vehicleid'] );};
	

		//vehiclealertunsubscribe
		if(isset( $query['email'] )) { $segments[] = "15-".$query['email']; unset( $query['email'] );};


		//formvehicle
		if(isset( $query['adtype'] )) { $segments[] = "g-".$query['adtype']; unset( $query['adtype'] );};
		if(isset( $query['nadtype'] )) { $segments[] = "h-".$query['nadtype']; unset( $query['nadtype'] );};
                //dummy variable    
		if(isset( $query['rd'] )) { $segments[] = "18-".$query['rd']; unset( $query['rd'] );};
		if(isset( $query['rd1'] )) { $segments[] = "19-".$query['rd1']; unset( $query['rd1'] );};
		// task deletevehicleshortlist
		if(isset( $query['uid'] )) { $segments[] = "20-".$query['uid']; unset( $query['uid'] );};
		
		//package_details
		if(isset( $query['gd'] )) { $segments[] = "p-".$query['gd']; unset( $query['gd'] );};

		//package_buynow
		if(isset( $query['pb'] )) { $segments[] = "nw-".$query['pb']; unset( $query['pb'] );};

		//makedefaultvehicleimage
		if(isset( $query['vehid'] )) { $segments[] = "23-".$query['vehid']; unset( $query['vehid'] );};
		if(isset( $query['imgid'] )) { $segments[] = "24-".$query['imgid']; unset( $query['imgid'] );};

		//addtogoldvehicle, addtofeaturedvehicle
		if(isset( $query['vd'] )) { $segments[] = "25-".$query['vd']; unset( $query['vd'] );};

		if(isset( $query['md2'] )) { $segments[] = "26-".$query['md2']; unset( $query['md2'] );}; // meanless only dist make & model

		if(isset( $query['vm'] )) { $segments[] = "27-".$query['vm']; unset( $query['vm'] );}; 
		if(isset( $query['type'] )) { $segments[] = "tp-".$query['type']; unset( $query['type'] );}; 
		if(isset( $query['format'] )) { $segments[] = "29-".$query['format']; unset( $query['format'] );}; 
       if(isset( $query['Itemid'] )) { 
			$_SESSION['JSAzItemid'] = $query['Itemid'];
	   }
	   
       return $segments;
}

function JSAutozParseRoute( $segments )
{
	
       $vars = array();
	   $count = count($segments);	   
		//echo '<br> count '.$count;print_r($segments);
		
		$menu = &JMenu::getInstance('site');
//       $item = &$menu->getActive();
		$menu	= &JSite::getMenu();
		
		
		$item	= &$menu->getActive();
		

		if(isset($segments[0])){
			$layout = $segments[0];
			//unset($segments[1]);
		}else $layout="";
		if($layout == 'tk'){
			$vars['task'] = $segments[1];
		}else{
			$lresult = parseLayout($layout);
			$vars['view'] = $lresult["view"];
			$vars['layout'] = $lresult["layout"];
		}
		$i=0;
		foreach($segments AS $seg){
			if($i >= 1){
				$array = explode(":",$seg);
				$index = $array[0];
				//unset the current index
				unset($array[0]);
				if(isset($array[1])) $value = implode("-",$array);
				
				switch($index){
					case "from":$vars['cl'] = parseCL($value);break;
					case "cond":$vars['vtype'] = parseCondition($value);break;
					case "m":$vars['mk'] = $value;break;
					case "d":$vars['md'] = $value;break;
					case "cn":$vars['country'] = $value;break;
					case "st":$vars['state'] = $value;break;
					case "ct":$vars['county'] = $value;break;
					case "cy":$vars['city'] = $value;break;
					case "ps":$vars['prs'] = $value;break;
					case "pe":$vars['pre'] = $value;break;
					case "my":$vars['mod'] = $value;break;
					case 12:$vars['id'] = $value;break;
					case 13:$vars['did'] = $value;break;
					case 14:$vars['vehicleid'] = $value;break;
					case 15:$vars['email'] = $value;break;
					case "g":$vars['adtype'] = $value;break;
					case "h":$vars['nadtype'] = $value;break;
					case 18:$vars['rd'] = $value;break;
					case 19:$vars['rd1'] = $value;break;
					case 20:$vars['uid'] = $value;break;
					case "p":$vars['gd'] = $value;break;
					case "nw":$vars['pb'] = $value;break;
					case 23:$vars['vehid'] = $value;break;
					case 24:$vars['imgid'] = $value;break;
					case 25:$vars['vd'] = $value;break;
					case 26:$vars['md2'] = $value;break;
					case 27:$vars['vm'] = $value;break;
					case "tp":$vars['type'] = $value;break;
					case 29:$vars['format'] = $value;break;
					//condition
					case "new": $vars['vtype'] = 1;break;
					case "used":$vars['vtype'] = 2;break;
					case "all":$vars['vtype'] = -1;break;
					//from -cl
					case "make":$vars['cl'] = 1;break;
					case "city":$vars['cl'] = 2;break;
					case "price":$vars['cl'] = 3;break;
					case "modelyear":$vars['cl'] = 4;break;
					case "gold":$vars['cl'] = 5;break;
					case "featured":$vars['cl'] = 6;break;
					case "search":$vars['cl'] = 7;break;
					case "seller":$vars['cl'] = 9;break;
					case "dvehicles":$vars['cl'] = 10;break;
					case "vehicles":$vars['cl'] = 11;break;
					case "model":$vars['cl'] = 12;break;
					case "dealer":$vars['cl'] = 13;break;
					case "type":$vars['cl'] = 16;break;
					case "nuvehicles":$vars['cl'] = 20;break;
					case "list":$vars['cl'] = 8;break;
					case "shortlist":$vars['cl'] = 14;break;
					case "compare":$vars['cl'] = 15;break;
				}
			}
			$i++;
		}
		
       if(isset( $_SESSION['JSAzItemid'] )) { 
		$vars['Itemid'] = $_SESSION['JSAzItemid'];
		}
       return $vars;

}

function buildLayout($value,$view){
	$returnvalue = "";
	switch($value){
		case "buyermessages":$returnvalue = "messages";break;
		case "compare_vehicles":$returnvalue = "compare";break;
		case "controlpannel":
			if($view == 'buyer') $returnvalue = "controlpanel";
			else $returnvalue = "controlpannel";
		break;
		case "dealerlist":$returnvalue = "dealers";break;
		case "featuredvehicles":$returnvalue = "featuredvehicles";break;
		case "formbuyercontact":$returnvalue = "contact";break;
		case "goldvehicles":$returnvalue = "goldvehicles";break;
		case "listvehicles":$returnvalue = "vehicles";break;
		case "newvehiclealerts":$returnvalue = "emailalert";break;
		case "popup":$returnvalue = "popup";break;
		case "send_message":
			if($view == 'buyer') $returnvalue = "sendmessage";
			else $returnvalue = "sendmessages";
		break;
		case "tell_a_friend":$returnvalue = "tellafriend";break;
		case "vehiclealertunsubscribe":$returnvalue = "unsubscribe";break;
		case "vehiclebycity":$returnvalue = "city";break;
		case "vehiclebymodelyear":$returnvalue = "modelyear";break;
		case "vehiclebyprice":$returnvalue = "price";break;
		case "vehiclebytypes":$returnvalue = "types";break;
		case "vehicle_details":$returnvalue = "details";break;
		case "vehicle_filter":$returnvalue = "filter";break;
		case "vehicle_gallery":$returnvalue = "gallery";break;
		case "vehicle_images":
			if($view == 'buyer') $returnvalue = "vimages";
			else $returnvalue = "vehicleimages";
		break;
		case "vehicle_messages":$returnvalue = "vehicle_messages";break;
		case "vehicle_models":$returnvalue = "models";break;
		case "vehicle_overview":$returnvalue = "overview";break;
		case "vehicle_quicklink":$returnvalue = "quicklink";break;
		case "vehicle_reviews":$returnvalue = "reviews";break;
		case "vehicles":$returnvalue = "bymodels";break;
		case "vehiclesearch":$returnvalue = "search";break;
		case "vehiclesearch_results":$returnvalue = "searchresults";break;
		case "vehicle_specification":$returnvalue = "specification";break;
		case "vehicles_shortlist":$returnvalue = "shortlist";break;
		case "viewdealer":$returnvalue = "viewdealer";break;
		case "view_dealer":$returnvalue = "dealer";break;
		case "view_vehicle":
			if($view == 'buyer')$returnvalue = "detail";
			else $returnvalue = "viewvehicle";
		break;
		//seller
		case "authenticate":$returnvalue = "authenticate";break;
		case "formdealer":$returnvalue = "formdealer";break;
		case "formvehicle":$returnvalue = "formvehicle";break;
		case "images":$returnvalue = "images";break;
		case "my_stats":$returnvalue = "stats";break;
		case "package_buynow":$returnvalue = "buynow";break;
		case "package_details":$returnvalue = "packagedetails";break;
		case "packages":$returnvalue = "packages";break;
		case "purchasehistory":$returnvalue = "purchasehistory";break;
		case "sellermessages":$returnvalue = "sellermessages";break;
		case "vehiclelist":$returnvalue = "myvehicles";break;
		case "vehicle_review":$returnvalue = "vehiclereview";break;
		case "vehicle_type":$returnvalue = "vehicletype";break;
		//rss
		case "vehicles":$returnvalue = "rssvehicles";break;
	}
	return $returnvalue;
}
function parseLayout($value){
//	$returnvalue = "";

	switch($value){
		case "messages": $returnvalue["layout"]="buyermessages"; $returnvalue["view"]="buyer";break;
		case "compare": $returnvalue["layout"]="compare_vehicles"; $returnvalue["view"]="buyer";break;
		case "controlpanel": $returnvalue["layout"]="controlpannel"; $returnvalue["view"]="buyer";break;
		case "dealers": $returnvalue["layout"]="dealerlist"; $returnvalue["view"]="buyer";break;
		case "featuredvehicles": $returnvalue["layout"]="featuredvehicles"; $returnvalue["view"]="buyer";break;
		case "contact": $returnvalue["layout"]="formbuyercontact"; $returnvalue["view"]="buyer";break;
		case "goldvehicles": $returnvalue["layout"]="goldvehicles"; $returnvalue["view"]="buyer";break;
		case "vehicles": $returnvalue["layout"]="listvehicles"; $returnvalue["view"]="buyer";break;
		case "emailalert": $returnvalue["layout"]="newvehiclealerts"; $returnvalue["view"]="buyer";break;
		case "popup": $returnvalue["layout"]="popup"; $returnvalue["view"]="buyer";break;
		case "sendmessage": $returnvalue["layout"]="send_message"; $returnvalue["view"]="buyer";break;
		case "tellafriend": $returnvalue["layout"]="tell_a_friend"; $returnvalue["view"]="buyer";break;
		case "unsubscribe": $returnvalue["layout"]="vehiclealertunsubscribe"; $returnvalue["view"]="buyer";break;
		case "city": $returnvalue["layout"]="vehiclebycity"; $returnvalue["view"]="buyer";break;
		case "modelyear": $returnvalue["layout"]="vehiclebymodelyear"; $returnvalue["view"]="buyer";break;
		case "price": $returnvalue["layout"]="vehiclebyprice"; $returnvalue["view"]="buyer";break;
		case "types": $returnvalue["layout"]="vehiclebytypes"; $returnvalue["view"]="buyer";break;
		case "details": $returnvalue["layout"]="vehicle_details"; $returnvalue["view"]="buyer";break;
		case "filter": $returnvalue["layout"]="vehicle_filter"; $returnvalue["view"]="buyer";break;
		case "gallery": $returnvalue["layout"]="vehicle_gallery"; $returnvalue["view"]="buyer";break;
		case "vimages": $returnvalue["layout"]="vehicle_images"; $returnvalue["view"]="buyer";break;
		case "vehicle_messages": $returnvalue["layout"]="vehicle_messages"; $returnvalue["view"]="buyer";break;
		case "models": $returnvalue["layout"]="vehicle_models"; $returnvalue["view"]="buyer";break;
		case "overview": $returnvalue["layout"]="vehicle_overview"; $returnvalue["view"]="buyer";break;
		case "quicklink": $returnvalue["layout"]="vehicle_quicklink"; $returnvalue["view"]="buyer";break;
		case "reviews": $returnvalue["layout"]="vehicle_reviews"; $returnvalue["view"]="buyer";break;
		case "bymodels": $returnvalue["layout"]="vehicles"; $returnvalue["view"]="buyer";break;
		case "search": $returnvalue["layout"]="vehiclesearch"; $returnvalue["view"]="buyer";break;
		case "searchresults": $returnvalue["layout"]="vehiclesearch_results"; $returnvalue["view"]="buyer";break;
		case "specification": $returnvalue["layout"]="vehicle_specification"; $returnvalue["view"]="buyer";break;
		case "shortlist": $returnvalue["layout"]="vehicles_shortlist"; $returnvalue["view"]="buyer";break;
		case "viewdealer": $returnvalue["layout"]="viewdealer"; $returnvalue["view"]="buyer";break;
		case "dealer": $returnvalue["layout"]="view_dealer"; $returnvalue["view"]="buyer";break;
		case "detail": $returnvalue["layout"]="view_vehicle"; $returnvalue["view"]="buyer";break;
		//seller
		case "authenticate": $returnvalue["layout"]="authenticate"; $returnvalue["view"]="seller";break;
		case "controlpannel": $returnvalue["layout"]="controlpannel"; $returnvalue["view"]="seller";break;
		case "formdealer": $returnvalue["layout"]="formdealer"; $returnvalue["view"]="seller";break;
		case "formvehicle": $returnvalue["layout"]="formvehicle"; $returnvalue["view"]="seller";break;
		case "images": $returnvalue["layout"]="images"; $returnvalue["view"]="seller";break;
		case "stats": $returnvalue["layout"]="my_stats"; $returnvalue["view"]="seller";break;
		case "buynow": $returnvalue["layout"]="package_buynow"; $returnvalue["view"]="seller";break;
		case "packagedetails": $returnvalue["layout"]="package_details"; $returnvalue["view"]="seller";break;
		case "packages": $returnvalue["layout"]="packages"; $returnvalue["view"]="seller";break;
		case "purchasehistory": $returnvalue["layout"]="purchasehistory"; $returnvalue["view"]="seller";break;
		case "sellermessages": $returnvalue["layout"]="sellermessages"; $returnvalue["view"]="seller";break;
		case "sendmessages": $returnvalue["layout"]="send_message"; $returnvalue["view"]="seller";break;
		case "vehicleimages": $returnvalue["layout"]="vehicle_images"; $returnvalue["view"]="seller";break;
		case "myvehicles": $returnvalue["layout"]="vehiclelist"; $returnvalue["view"]="seller";break;
		case "vehiclereview": $returnvalue["layout"]="vehicle_review"; $returnvalue["view"]="seller";break;
		case "vehicletype": $returnvalue["layout"]="vehicle_type"; $returnvalue["view"]="seller";break;
		case "viewvehicle": $returnvalue["layout"]="view_vehicle"; $returnvalue["view"]="seller";break;
		//rss
		case "rssvehicles": $returnvalue["layout"]="vehicles"; $returnvalue["view"]="rss";break;
	}
	return $returnvalue;
	
}

function buildCL($value){
	$returnvalue = "";
	switch($value){
		case 1:$returnvalue = "make";break;
		case 2:$returnvalue = "city";break;
		case 3:$returnvalue = "price";break;
		case 4:$returnvalue = "modelyear";break;
		case 5:$returnvalue = "gold";break;
		case 6:$returnvalue = "featured";break;
		case 7:$returnvalue = "search";break;
		case 8:$returnvalue = "list";break;
		case 9:$returnvalue = "seller";break;
		case 10:$returnvalue = "dvehicles";break;
		case 11:$returnvalue = "vehicles";break;
		case 12:$returnvalue = "model";break;
		case 13:$returnvalue = "dealer";break;
		case 14:$returnvalue = "shortlist";break;
		case 15:$returnvalue = "compare";break;
		case 16:$returnvalue = "type";break;
		case 17:$returnvalue = "from-17";break;
		case 18:$returnvalue = "from-18";break;
		case 19:$returnvalue = "from-19";break;
		case 20:$returnvalue = "nuvehicles";break;
		case 21:$returnvalue = "from-21";break;
		case 22:$returnvalue = "from-22";break;
		case 23:$returnvalue = "from-23";break;
		case 24:$returnvalue = "from-24";break;
		case 25:$returnvalue = "from-25";break;

	}
	return $returnvalue;
}
function parseCL($value){
	$returnvalue = "";
	switch($value){
		case "make": $returnvalue = 1;break;
		case "city":$returnvalue = 2;break;
		case "price":$returnvalue = 3;break;
		case "modelyear":$returnvalue = 4;break;
		case "gold":$returnvalue = 5;break;
		case "featured":$returnvalue = 6;break;
		case "search":$returnvalue = 7;break;
		case "list":$returnvalue = 8;break;
		case "seller":$returnvalue = 9;break;
		case "dvehicles":$returnvalue = 10;break;
		case "vehicles":$returnvalue = 11;break;
		case "model":$returnvalue = 12;break;
		case "dealer":$returnvalue = 13;break;
		case "shortlist":$returnvalue = 14;break;
		case "compare":$returnvalue = 15;break;
		case "type":$returnvalue = 16;break;
		case "17":$returnvalue = 17;break;
		case "18":$returnvalue = 18;break;
		case "19":$returnvalue = 19;break;
		case "nuvehicles":$returnvalue = 20;break;
		case "21":$returnvalue = 21;break;
		case "22":$returnvalue = 22;break;
		case "23":$returnvalue = 23;break;
		case "24":$returnvalue = 24;break;
		case "25":$returnvalue = 25;break;
		default :$returnvalue = $value;break;
	}
	return $returnvalue;
	
}
function buildCondition($value){
	$returnvalue = "";
	switch($value){
		case 1:$returnvalue = "new";break;
		case 2:$returnvalue = "used";break;
		case 3:$returnvalue = "all";break;
		default :$returnvalue = "all";break;
	}
	return $returnvalue;
}
function parseCondition($value){
	$returnvalue = "";
	switch($value){
		case "new": $returnvalue = 1;break;
		case "used":$returnvalue = 2;break;
		case "all":$returnvalue = -1;break;
	}
	return $returnvalue;
	
}

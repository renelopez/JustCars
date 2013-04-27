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

$title = $params->get('title');
$shtitle = $params->get('shtitle');


$shownewusedhavevehicles= $params->get('snumhvveh');


$sliding= $params->get('sliding','1');
$consecutivesliding= $params->get('consecutivesliding','3');
$listingstyle= $params->get('listingstyle');
$noofcols= $params->get('noofcols','1');
$noofrecord= $params->get('noofrecord');
if($noofrecord>100) $noofrecord=100;

$itemid= $params->get('itemid');
if($itemid) $itemid= $params->get('itemid');
else $itemid =  JRequest::getVar('Itemid');

$colwidth = round(100 / $noofcols);
$moduleclass_sfx = $params->get('moduleclass_sfx');

$curdate = date('Y-m-d H:i:s');


	$componentAdminPath = JPATH_ADMINISTRATOR . '/components/com_jsautoz';
	$componentPath =  'components/com_jsautoz';
	$trclass=array('odd','even');

        require_once $componentPath . '/models/modplug.php';
	$model = new JSAutozModelModplug();

	//require_once $componentPath . DS . 'models' . DS . 'buyer.php';
	//$model = new JSAutozModelBuyer();
	//$config = $model->getConfiginArray('default');
	
        $lang = & JFactory :: getLanguage();
        $lang->load('com_jsautoz');
        $maketype = $params->get('maketype');
     if($maketype==1){
		$newusedvehiclemake = $model->mpGetNewVehicleByMake();
	 }elseif($maketype==2){
		$newusedvehiclemake = $model->mpGetUsedVehicleByMake();
	 }elseif($maketype==3){
		$newusedvehiclemake = $model->mpGetNewUsedVehicleByMake();
	 }   
        if($maketype==3) {$maketype="";$cl=12;}else $cl=1;
        //if($maketype==3) $maketype=1;
        $config = $model->getConfig('default');
        $document =& JFactory::getDocument();
        $document->addStyleSheet('components/com_jsautoz/themes'.$config['theme']);
if ($newusedvehiclemake) { 
	   $contents = '<table cellpadding="0" cellspacing="0" border="0" width="100%" id="modTable" class="modTable2">';
		$isodd = 1;
		$count = 1;
		$top="";
		if ($shtitle == 1){
			if(!empty($moduleclass_sfx) || $moduleclass_sfx != ''){
				$top .= '<div class="'.$moduleclass_sfx.'"><h3>
							<span>
								<span id="autoz_topheading_text_left"></span>
								<span id="autoz_topheading_text_center">'.$title.'</span>
								<span id="autoz_topheading_text_right"></span>
							</span>
						</h3></div>';
			}else{
				$top .= '<div id="autoz_topheading">
							<span id="autoz_topheading_text">
								<span id="autoz_topheading_text_left"></span>
								<span id="autoz_topheading_text_center">'.$title.'</span>
								<span id="autoz_topheading_text_right"></span>
							</span>
						</div>';
			}
		}	
		$i=1;
		foreach ($newusedvehiclemake as $nuvm) {
			$showvehicle = 0;
			if($shownewusedhavevehicles){
				if($nuvm->totalnewusedvehiclelbymake !=0 && $nuvm->totalnewusedvehiclelbymake !=''){
					$showvehicle = 1;
				}else $showvehicle = 0;
			}else $showvehicle = 1;	
			if(($noofrecord != -1) && ($noofrecord !='')){
				if ($i<=$noofrecord) {
					if($shownewusedhavevehicles){
						if($nuvm->totalnewusedvehiclelbymake !=0 && $nuvm->totalnewusedvehiclelbymake !=''){
							$showvehicle = 1;
							$i++;
						}else $showvehicle = 0;
							
					}else { $showvehicle = 1; $i++;	}
				}else $showvehicle = 0;
			}
						
			if($showvehicle == 1){
					if ($count == 1){
						$isodd = 1 - $isodd;
						$contents .=  '<tr>';
					}
					
					$contents .=  '<td width="'.$colwidth.'%"><div id="modNoVehicles">'
						. '<a  href="index.php?option=com_jsautoz&view=buyer&vtype='.$maketype.'&layout=listvehicles&mk='.$nuvm->makeid.'&cl='.$cl.'&Itemid='.$itemid.'">'
						. $nuvm->maketitle.'</a><span id="modNoShow">'.$nuvm->totalnewusedvehiclelbymake.'</span>';
					$contents .= '</div></td>';
					if ($count == $noofcols){
						$contents .= '</tr>';
						$count = 0;
					}	
					$count = $count + 1;
                                        $arrcontents[] = $contents;
                                        $contents = '';
                                        
				
			}	
			
			
		}
		if ($count-1 < $noofcols){
			for ($i = $count; $i <= $noofcols; $i++){
				$contents .= '<td></td>';
			}	
			$contents .= '</tr>';
		}	

			$contents .= '</table>';
                        $arrcontents[] = $contents;
			//$contents .= '</div>';
			if ($sliding == 1) {
				if($listingstyle==2){
							$tcontents = '<table cellpadding="0" cellspacing="0" border="1" width="100%" id="modTable" class="modTable2"> <tr>';
							$scontents="";
							/*for ($a = 0; $a < $consecutivesliding; $a++){
								$scontents .= '<td>'.$contents.'</td>';
							}*/
                                                        for ($a = 0; $a < $consecutivesliding; $a++){
                                                            foreach($arrcontents AS $content)
                                                                $scontents .= '<td>'.$content.'</td>';
                                                        }                                                                            
							$contents = $tcontents.$scontents.'</tr></table>';
							$contents = $top .'<marquee direction="left"  scrollamount="3" onmouseover="this.stop();" onmouseout="this.start()";>' .$contents . '</marquee>';
							echo $contents;
					
				}elseif($listingstyle==1){
                                            for ($a = 0; $a < $consecutivesliding; $a++){
                                                    $contents .= $contents;
						
					}
					$contents = $top . '<marquee  direction="up" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start()";>'.$contents.'</marquee>';
					//echo $contents;
                                        echo $top;
                                        echo '<marquee  direction="up" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start()";>';
                                        for ($a = 0; $a < $consecutivesliding; $a++){
                                            foreach($arrcontents AS $content){
                                                echo $content;

                                            }

                                        }

                                        echo '</marquee>';
			      }
			}elseif($sliding == 0) {
                                echo  $top;

                                foreach($arrcontents AS $content) { 
                                    echo $content;
                                }
				
				
			}
	
		

 } ?>



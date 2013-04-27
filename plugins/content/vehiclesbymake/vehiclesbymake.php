<?php
/**
 + Created by:	Ahmad Bilal
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , info@burujsolutions.com
				www.joomsky.com, ahmad@joomsky.com
 * Created on:	Nov 28, 2009
 ^
 + Project: 		JS Jobs 
 * File Name:	module/jsfeaturedjobs.php
 ^ 
 * Description: Module for JS Jobs
 ^ 
 * History:		NONE
 ^ 
 */

defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');

class plgContentvehiclesbymake extends JPlugin {


		public function onPrepareContent( &$row, &$params, $page=0 )
        {
                if ( JString::strpos( $row->text, 'vehiclesbymake' ) === false ) {
                        return true;
                }

              // expression to search for
                $regex = '/{vehiclesbymake\s*.*?}/i';
                if ( !$this->params->get( 'enabled', 1 ) ) {
                        $row->text = preg_replace( $regex, '', $row->text );
                        return true;
                }
                preg_match_all( $regex, $row->text, $matches );
                $count = count( $matches[0] );
                if ( $count ) {
                        // Get plugin parameters
                        $style = $this->params->def( 'style', -2 );
                        $this->_process( $row, $matches, $count, $regex, $style );
                }
        }
          //joomla 1.6
    public function onContentPrepare($context, &$row, &$params, $page=0) {
        if (JString::strpos($row->text, 'vehiclesbymake') === false) {
            return true;
        }

        // expression to search for
        $regex = '/{vehiclesbymake\s*.*?}/i';
        if (!$this->params->get('enabled', 1)) {
            $row->text = preg_replace($regex, '', $row->text);
            return true;
        }
        preg_match_all($regex, $row->text, $matches);
        $count = count($matches[0]);
        if ($count) {
            // Get plugin parameters
            $style = $this->params->def('style', -2);
            $this->_process($row, $matches, $count, $regex, $style);
        }
    }

    protected function _process(&$row, &$matches, $count, $regex, $style) {
        for ($i = 0; $i < $count; $i++) {
            $load = str_replace('vehiclesbymake', '', $matches[0][$i]);
            $load = str_replace('{', '', $load);
            $load = str_replace('}', '', $load);
            $load = trim($load);
            $modules = $this->_load($load, $style);
            $row->text = preg_replace('{' . $matches[0][$i] . '}', $modules, $row->text);
        }
        $row->text = preg_replace($regex, '', $row->text);
    }
    protected function _load($position, $style=-2) {
        $document = &JFactory::getDocument();
        $renderer = $document->loadRenderer('module');
        $params = array('style' => $style);

		$title = $this->params->get('title');
		$shtitle = $this->params->get('shtitle');


		$shownewusedhavevehicles= $this->params->get('snumhvveh');


		$sliding= $this->params->get('sliding','1');
		$consecutivesliding= $this->params->get('consecutivesliding','3');
                $listingstyle = $this->params->get('listingstyle',2);
		$noofcols= $this->params->get('noofcols','1');
		$noofrecord= $this->params->get('noofrecord');
                if($noofrecord>100) $noofrecord=100;
		$itemid= $this->params->get('itemid');
		if($itemid) $itemid= $this->params->get('itemid');
		else $itemid =  JRequest::getVar('Itemid');

		$colwidth = round(100 / $noofcols);


		$curdate = date('Y-m-d H:i:s');


		$componentAdminPath = JPATH_ADMINISTRATOR . '/components/com_jsautoz';
		$componentPath =  'components/com_jsautoz';
		$trclass=array('odd','even');

		require_once $componentPath . '/models/buyer.php';
		$model = new JSAutozModelBuyer();
		$config = $model->getConfiginArray('default');
		
			$lang = & JFactory :: getLanguage();
			$lang->load('com_jsautoz');
		$maketype= $this->params->get('maketype');
		if($maketype==1){
			$newusedvehiclemake = $model->mpGetNewVehicleByMake();
		}elseif($maketype==2){
			$newusedvehiclemake = $model->mpGetUsedVehicleByMake();
		}elseif($maketype==3){
			$newusedvehiclemake = $model->mpGetNewUsedVehicleByMake();
		}
        if($maketype==3) {$maketype="";$cl=12;}else $cl=1;

		$document =& JFactory::getDocument();
		$document->addStyleSheet('components/com_jsautoz/themes'.$config['theme']);
		if ($newusedvehiclemake) { 
			   $contents = '<table cellpadding="0" cellspacing="0" border="0" width="100%" id="modTable" class="modTable2">';
				$isodd = 1;
				$count = 1;
				$top="";
				if ($shtitle == 1){
				$top .= '<div id="autoz_topheading">
							<span id="autoz_topheading_text">
								<span id="autoz_topheading_text_left"></span>
								<span id="autoz_topheading_text_center">'.$title.'</span>
								<span id="autoz_topheading_text_right"></span>
							</span>
						</div>';
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
								$contents .=  '<tr class="'.$trclass[$isodd].'">';
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
				}	

				$contents .= '</tr>';
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
									return $contents;
							
                                                }elseif($listingstyle==1){
                                                                for ($a = 0; $a < $consecutivesliding; $a++){
                                                                    foreach($arrcontents AS $content){
                                                                        $contents .= $content;
                                                                    }
                                                                }
                                                                $contents = $top . '<marquee  direction="up" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start()";>'.$contents.'</marquee>';
                                                                return $contents;
                                                }
					}elseif($sliding == 0){
                                                    foreach($arrcontents AS $content){
                                                        $contents .= $content;
                                                    }
                                                    return  $top .$contents;
					}

		 } 

	}
}
?>

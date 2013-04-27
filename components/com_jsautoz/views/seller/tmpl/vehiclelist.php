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
global $mainframe;
jimport('joomla.html.pane');
JHTML::_('behavior.formvalidation');

$document = & JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/themes/' . $this->config['theme']);
// $document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);
$document->addStyleSheet('components/com_jsautoz/css/jsautozrating.css');
JHTML::_('behavior.modal');
?>
<div>
    <?php if ($this->config['offline'] == '1') { ?>
        <div class="contentpane">
            <div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
            <div class="jsautozmsg">
                <?php echo $this->config['offline_text']; ?>
            </div>
        </div>
    <?php } else { ?>
        <div id="jsautoz_toppanel">
            <div id="jsautoz_topsection">
                    <?php if ($this->config['showtitle'] == 1) { ?>
                            <div id="autoz_sitetitle">
                                    <?php echo $this->config['title']; ?>
                            </div>
                    <?php } ?>
                    <?php if ($this->config['navigation'] == 1) { ?>
                            <div class="autoz_topcurloc">
                                <?php if (isset($this->vehicle) && ($this->vehicle->id == '')) { ?>
                                    <?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('NEW_VEHICLE_INFO'); ?>
                                <?php } else { ?>
                                    <?php echo JText::_('CUR_LOC'); ?> : <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > <?php echo JText::_('MY_VEHICLES'); ?>
                                <?php } ?>
                            </div>
                    <?php } ?>
            </div>
            <?php 
                if (sizeof($this->sellerlinks) != 0){
                    echo '<div id="autoz_top_links">';
                    foreach ($this->sellerlinks as $lnk) { ?>
                        <a class="<?php if($lnk[2] == 1)echo 'first'; elseif($lnk[2] == -1)echo 'last';  ?>" href="<?php echo $lnk[0]; ?>"><?php echo $lnk[1]; ?></a>
                    <?php
                    }
                    echo '</div>';
                }
            ?>
            <div id="autoz_topheading">
                    <span id="autoz_topheading_text">
                            <span id="autoz_topheading_text_left"></span>
                            <span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLES_LIST'); ?></span>
                            <span id="autoz_topheading_text_right"></span>
                    </span>
            </div>
        </div>


            <form action="index.php" method="post" name="adminForm" id="adminForm" >
                <table class="" cellpadding="5" cellspacing="0" border="0" width="100%" class="adminForm">
                    <thead >
                        <tr class="jsautoz_subheadline" valign="middle"  >
                            <td width="25%" align="center"><strong><?php echo JText::_('TITLE'); ?></strong></td>
                            <td width="12%" align="center"><b><?php echo JText::_('MAKE'); ?></b></td>
                            <td width="12%" align="center"> <b><?php echo JText::_('MODEL') ?></b></td>
                            <td width="15%" align="center"><b><?php echo JText::_('MODELYEAR'); ?></b></td>
                            <td width="12%" align="center"> <b><?php echo JText::_('CONDITION'); ?></b></td>
                            <td width="12%" align="center"  ><b><?php echo JText::_('PRICE'); ?></b></td>
                            <td width="12%"></td>

                        </tr>
                    </thead>
        <?php
        $trclass = array("jsautoz_odd", "jsautoz_even");
        $i = 0;
        $isodd = 0;
        foreach ($this->vehiclelist AS $vehicle) {
            ?>
                        <?php $isodd = 1 - $isodd; ?>
                            <tr  class="<?php echo $this->theme[$trclass[$isodd]]; ?>" >
                                <td  align="left"><?php echo $vehicle->title; ?>
                                    <?php if ($vehicle->isgoldvehicle) echo'<img src="components/com_jsautoz/images/gold.png" />'; ?>
                                    <?php if ($vehicle->isfeaturedvehicle) echo'<img src="components/com_jsautoz/images/featured.png" />'; ?>
                                </td>
                                <td align="center"><?php echo $vehicle->maketitle; ?></td>
                                <td align="center"><?php echo $vehicle->modeltitle; ?></td>
                                <td align="center"><?php echo $vehicle->modelyeartitle; ?></td>
                                <td align="center"><?php echo $vehicle->conditiontitle; ?></td>
                                <td align="center"><?php echo $vehicle->currency . $vehicle->price; ?></td>
                                <?php if ($this->uid) { ?>
                                    <td nowrap="nowrap"  align="center">
                                        <?php if ($this->nadtype) { ?>
                                            <a id="nobackground" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&nadtype=2&id=<?php echo $vehicle->id; ?>&Itemid=<?php echo $this->Itemid; ?>" title="<?php echo JText::_('EDIT') ?>">
                                                <img width="15"  src="components/com_jsautoz/images/edit.png" />
                                            </a>
                                        <?php } else { ?>
                                            <a id="nobackground" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=<?php echo $vehicle->conditionid; ?>&id=<?php echo $vehicle->id; ?>&Itemid=<?php echo $this->Itemid; ?>" title="<?php echo JText::_('EDIT') ?>">
                                                <img width="15"  src="components/com_jsautoz/images/edit.png" />
                                            </a>
                                        <?php } ?>

                                        <a id="nobackground" href="index.php?option=com_jsautoz&view=buyer&layout=vehicle_overview&id=<?php echo $vehicle->id; ?>&cl=9&Itemid=<?php echo $this->Itemid; ?>" title="<?php echo JText::_('VIEW') ?>" >
                                            <img width="16"  src="components/com_jsautoz/images/view.png" />
                                        </a>
                                        <a id="nobackground" href="index.php?option=com_jsautoz&task=deletevehicle&id=<?php echo $vehicle->id ?>&uid=<?php echo $this->uid; ?>&Itemid=<?php echo $this->Itemid; ?>" onclick="return confirm('<?php echo JText::_('YOU_WANT_TO_DELETE_VEHICE_ARE_YOU_SURE') ?>')" >
                                            <img width="18"  src="components/com_jsautoz/images/close.png" title="<?php echo JText::_('DELETE_VEHICLE') ?>" />
                                        </a>
                                    </td>
                                <?php } ?>
                                <?php
                                $session = JFactory::getSession();
                                $visitoremail = $session->get('jsautoz_visitoremail');
                                if ($visitoremail) {
                                    if ($vehicle->visitorselleremail) {
                                        ?>
                                        <td  align="center">
                                            <a id="nobackground" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=<?php echo $vehicle->conditionid; ?>&id=<?php echo $vehicle->id; ?>&semail=<?php echo $vehicle->visitorselleremail; ?>&Itemid=<?php echo $this->Itemid; ?>" title="<?php echo JText::_('EDIT') ?>">
                                                <img width="20"  src="components/com_jsautoz/images/edit.png" />
                                            </a>
                                        </td>
                                    <?php }
                                }
                                ?>
                            </tr>
        <?php } ?>
                </table>
                <input type="hidden" name="id" id="id" value="" />
                <input type="hidden" name="task" id="task" value="" />
                <input type="hidden" name="uid" id="uid" value="<?php echo $this->uid; ?>" />
                <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
                <script type="text/javascript"   language=Javascript>
                    function actioncall(vehicleid,uid){
                        getvehiclereview('vehiclereview_'+vehicleid,vehicleid);
                    }
                    function getvehiclereview(src,vehicleid){
                        document.getElementById(src).innerHTML="Loading ...";
                        var xhr;
                        try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
                        catch (e)
                        {
                            try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
                            catch (e2)
                            {
                                try {  xhr = new XMLHttpRequest();     }
                                catch (e3) {  xhr = false;   }
                            }
                        }

                        xhr.onreadystatechange = function(){
                            if(xhr.readyState == 4 && xhr.status == 200){
                                document.getElementById(src).innerHTML=xhr.responseText; //retuen value

                            }
                        }
                        //alert('abc');
                        xhr.open("GET","index.php?option=com_jsautoz&task=getvehiclereviews&vehicleid="+vehicleid,true);
                        xhr.send(null);
                    }
                    function savevehiclereview(vehicleid){
                        document.getElementById('id').value=vehicleid;
                        document.getElementById('task').value='savevehiclereviews';
                        document.forms["adminForm"].submit();
                    }
                    function setrating(src,newrating,vehicleid){
                        var xhr;
                        try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
                        catch (e)
                        {
                            try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
                            catch (e2)
                            {
                                try {  xhr = new XMLHttpRequest();     }
                                catch (e3) {  xhr = false;   }
                            }
                        }

                        xhr.onreadystatechange = function(){
                            if(xhr.readyState == 4 && xhr.status == 200){
                                if(xhr.responseText == 1)
                                    document.getElementById(src).style.width=parseInt(newrating*20)+'%';

                            }
                        }

                        xhr.open("GET","index.php?option=com_jsautoz&task=savevehicleranking&vehicleid="+vehicleid+"&newrating="+newrating,true);
                        xhr.send(null);


                    }

                </script>
            </form>
            <div class="auto_pagination">

                <form action="<?php echo JRoute::_('index.php?option=com_jsautoz&view=seller&layout=vehiclelist&vemail=' . $this->email . '&Itemid=' . $this->Itemid); ?>" method="post">
				<div id="jl_pagination">
					<div id="jl_pagination_pageslink">
						<?php //$this->pagination->setAdditionalUrlParam('', $querystring);
								echo $this->pagination->getPagesLinks(); ?>
					</div>
					<div id="jl_pagination_box">
						<?php	
							echo JText::_('DISPLAY_#');
							echo $this->pagination->getLimitBox();
						?>
					</div>
					<div id="jl_pagination_counter">
						<?php echo $this->pagination->getResultsCounter(); ?>
					</div>
				</div>
                </form>	
            </div>




<?php } ?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


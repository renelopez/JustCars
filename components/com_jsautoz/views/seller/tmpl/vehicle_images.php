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
$comma = 0;
$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/themes/'.$this->config['theme']);
$document->addScript('administrator/components/com_jsautoz/include/js/jquery.js');

?>
<div>
<?php if ($this->config['offline'] == '1'){ ?>
<div   class="contentpane">
	<div  class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
	<div class="jsautozmsg">
		<?php echo $this->config['offline_temultipart/form-dataxt']; ?>
	</div>
</div>
<?php }else{ ?>
        <div id="jsautoz_toppanel">
            <div id="jsautoz_topsection">
                    <?php if ($this->config['showtitle'] == 1) { ?>
                            <div id="autoz_sitetitle">
                                    <?php echo $this->config['title']; ?>
                            </div>
                    <?php } ?>
                    <?php if ($this->config['navigation'] == 1) { 
                                $session = JFactory::getSession();
                                $sellerevisitoremail=$session->get('jsautoz_visitoremail'); 
                                $session->clear('jsautoz_visitoremail');		 ?>
                        <div class="autoz_topcurloc">
                                <?php if (isset($this->vehicle) && ($this->vehicle->id == '')){	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('NEW_VEHICLE_INFO'); ?>
                                <?php }elseif($sellerevisitoremail) {	?>
                                                <?php if($this->cl == 1){?>
                                                        <?php echo JText::_('CUR_LOC'); ?> :<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=1&id=<?php echo $this->vehicleid ;?>&semail=<?php echo $sellerevisitoremail; ?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('FORM_NEW_VEHICLE'); ?></a> ><?php echo JText::_('VEHICLE_IMAGES'); ?>

                                                        <?php }elseif($this->cl == 2){?>	 
                                                                <?php echo JText::_('CUR_LOC'); ?> :<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=1&id=<?php echo $this->vehicleid ;?>&semail=<?php echo $sellerevisitoremail; ?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('FORM_USED_VEHICLE'); ?></a> ><?php echo JText::_('VEHICLE_IMAGES'); ?>
                                                            <?php }  ?>
                                <?php }elseif($this->uid == 0) {	
                                        echo JText::_('CUR_LOC').':';  
                                        if(($this->cl == 1)OR($this->cl == 2)) { ?>	
                                            <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > 
                                            <?php echo JText::_('VEHICLE_IMAGES'); ?>
                                        <?php }elseif($this->curloc){?>
                                            <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > 
                                            <?php echo JText::_('VEHICLE_IMAGES'); ?>
                                            <?php }  ?>
                                <?php }elseif($this->cl == 1) {	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :
                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > 
                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=1&id=<?php echo $this->vehicleid ;?>&Itemid=<?php echo $this->Itemid ?>">
                                        <?php echo JText::_('FORM_NEW_VEHICLE'); ?></a> >
                                        <?php echo JText::_('VEHICLE_IMAGES'); ?>
                                <?php }elseif($this->cl == 2) {	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :
                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > 
                                        <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&cl=2&id=<?php echo $this->vehicleid ;?>&Itemid=<?php echo $this->Itemid ?>">
                                        <?php echo JText::_('FORM_USED_VEHICLE'); ?></a> >
                                        <?php echo JText::_('VEHICLE_IMAGES'); ?>
                                <?php }elseif($this->curloc){	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&nadtype=1&id=<?php echo $this->vehicleid ;?>&rd=1&rd1=1&Itemid=<?php echo $this->Itemid ?>">
                                        <?php echo JText::_('FORM_VEHICLE'); ?></a> >
                                        <?php echo JText::_('VEHICLE_IMAGES'); ?>
                                <?php }else{	?>
                                        <?php /* echo JText::_('CUR_LOC'); ?> :<a href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> ><a href="index.php?option=com_jsautoz&view=seller&layout=vehiclelist&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('MY_VEHICLES'); ?></a> ><a href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&id=<?php echo $this->vehicleid ;?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('FORM_VEHICLES'); ?></a> ><?php echo JText::_('VEHICLE_IMAGES'); */ ?>
                                        <?php echo JText::_('CUR_LOC'); ?> :<a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel&Itemid=<?php echo $this->Itemid; ?>"><?php echo JText::_('CONTROL_PANNEL'); ?></a> > <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&id=<?php echo $this->vehicleid ;?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('FORM_VEHICLES'); ?></a> ><?php echo JText::_('VEHICLE_IMAGES'); ?>
                                <?php }	?>
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
                            <span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLE_IMAGES'); ?></span>
                            <span id="autoz_topheading_text_right"></span>
                    </span>
            </div>
        </div>
<?php  $showfilefield=$this->config['maximageperveh']  - $this->totalimages;?>
<?php  $max_no_img=5;
        if($this->cl){
            $cl=$this->cl.'&rd=1';
            $nadtype="";
        }elseif($this->curloc){
            $nadtype=$this->curloc;
            $cl="";
        }


?>
<form action="index.php" method="post" name="adminForm" id="adminForm"  enctype="multipart/form-data" class="form-validate">
	<table cellpadding="5" cellspacing="0" border="1" width="100%" class="adminform">
            <?php $countfield = 0;
            if($showfilefield < $max_no_img ){
                 for($i=1; $i<=$showfilefield; $i++){?>
                 <?php if($countfield == 0){ ?>
					<tr>
				<?php } ?>
                    <td >
						<input type="file" class="inputbox" name="filename[]" id="filename" size="20" maxlenght="30"/>
                   </td>
                <?php $countfield++;
                if($countfield == 2){ ?>
					</tr>
				<?php $countfield = 0;} ?>
                 <?php }
            }else{ ?>
            <?php $countfield = 0;
            for($i=1; $i<=$max_no_img; $i++){ ?>
                 <?php if($countfield == 0){ ?>
					<tr>
				<?php } ?>
                    <td >
                            <input type="file" class="inputbox" name="filename[]" id="filename" size="20" maxlenght="30"/>
                   </td>
                <?php $countfield++;
                if($countfield == 2){ ?>
					</tr>
				<?php $countfield = 0;} ?>
                <?php }
            }?>
            <?php if($countfield != 0){ ?>
            </tr>
			<?php } ?>
			<tr>
                 <td colspan="2" align="center">
                    <?php  if($this->totalimages < $this->config['maximageperveh'])  { ;?>
                        <input type="submit" id="jsautoz_button" class="button padding" value="Save"/>
                <?php } ?>
                </td>
            </tr>
	</table>
		<div id="vehicle_images">
			<?php
				$colcount=0;
					foreach ( $this->vehicleimages AS $vehicleimage ){?>
						<?php if($colcount == $colperrow){ echo '</tr><tr>';  $colcount = 0; } $colcount++; 	?>
							<div id="vehicle_shadowimage">
							<div id="vehicle_image">
								<img  width="100px" height="100px" src="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicleid;?>/images/thumbs/<?php echo 'jsautoz_m_'.$vehicleimage->filename; ?>"  />
								<div id="vehicle_imagebtn">
								<?php  if($vehicleimage->isdefault == 1) {?>
									<span><?php echo JText::_('DEFAULT_IMAGE') ?></span>
									<?php }else{ ?>
									<a anchor="anchor" href="index.php?option=com_jsautoz&task=deletevehicleimages&id=<?php echo $vehicleimage->id;?>&vehid=<?php echo $vehicleimage->vehicleid;?><?php if($cl!=="") { ?>&cl=<?php echo $cl ;?><?php }elseif($nadtype!=="") { ?>&nadtype=<?php echo $nadtype ;?><?php } ?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('REMOVE') ?></a><br>
									<a anchor="anchor" href="index.php?option=com_jsautoz&task=makedefaultvehicleimage&vehid=<?php echo $this->vehicleid;?>&imgid=<?php echo $vehicleimage->id;?><?php if($cl!=="") { ?>&cl=<?php echo $cl ;?><?php }elseif($nadtype!=="") { ?>&nadtype=<?php echo $nadtype ;?> <?php } ?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('MAKE_DEFAULT') ?></a>
								<?php }?>
								</div>
							</div>
							</div>
					<?php } ?>
		</div>
                <input type="hidden" name="vehicleid" value="<?php echo $this->vehicleid; ?>" />
                <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
                <input type="hidden" name="cl" value="<?php echo $this->cl; ?>" />
                <input type="hidden" name="task" value="savevehicleimages" />
                <input type="hidden" name="nadtype" value="<?php echo $this->curloc; ?>" />
                <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
					
</form>
	
<?php }?>	
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>

<script type="text/javascript" language="javascript">
	$("div#vehicle_image img").mouseover(function(){
			$(this).animate("padding-bottom","50px");
		});
</script>

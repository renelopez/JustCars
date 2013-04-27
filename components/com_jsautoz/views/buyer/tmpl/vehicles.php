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
$document =& JFactory::getDocument();
// $document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);
$document->addStyleSheet('components/com_jsautoz/themes/' . $this->config['theme']);
 JHTML::_('behavior.modal');
$colperrow = 2;
$colwidth = Round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$calfrm =  JRequest::getVar('cl');


?>


<div>
<?php if ($this->config['offline'] == '1'){ ?>
<div  class="contentpane">
	<div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
	<div class="jsautozmsg">
		<?php echo $this->config['offline_text']; ?>
	</div>
</div >
<?php }else{ ?>
        <div id="jsautoz_toppanel">
			<div id="jsautoz_topsection">
				<?php if ($this->config['showtitle'] == 1) { ?>
					<div id="autoz_sitetitle">
						<?php echo $this->config['title']; ?>
					</div>
				<?php } ?>
				<?php if ($this->config['navigation'] == 1) { ?>
					<div class="autoz_topcurloc">
						<?php if (isset($this->vehicle) && ($this->vehicle->id == '')){	?>
							<?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('NEW_VEHICLE_INFO'); ?>
						<?php }elseif($this->vehicletype==1){	?>
							<?php echo JText::_('CUR_LOC'); ?> : <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('CONTROL_PANEL'); ?></a> > <?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?>
						<?php }elseif($this->vehicletype==2){	?>
							<?php echo JText::_('CUR_LOC'); ?> : <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('CONTROL_PANEL'); ?></a> > <?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?>
						<?php }elseif($calfrm==12){ ?>
							<?php echo JText::_('CUR_LOC'); ?> : <a anchor="anchor" href="index.php?option=com_jsautoz&view=buyer&layout=controlpannel&Itemid=<?php echo $this->Itemid ; ?>"><?php echo JText::_('CONTROL_PANEL'); ?></a> > <?php echo JText::_('VEHICLES_MAKE_AND_MODEL'); ?>
						<?php }	?>
					</div>
				<?php } ?>
            </div>
			<?php
				if (sizeof($this->buyerlinks) != 0) {
					echo '<div id="autoz_top_links">';
					foreach ($this->buyerlinks as $lnk) {
						?>
						<a class="<?php if($lnk[2] == 1)echo 'first'; elseif($lnk[2] == -1)echo 'last';  ?>" href="<?php echo $lnk[0]; ?>"><?php echo $lnk[1]; ?></a>

					<?php
					}
					echo '</div>';
				}
			?>
			<div id="autoz_topheading">
				<span id="autoz_topheading_text">
					<span id="autoz_topheading_text_left"></span>
					<span id="autoz_topheading_text_center">
						<?php if($this->vehicletype==1){	?>
							 <div  id="tp_headingtext"><?php echo JText::_('NEW_VEHICLES_MAKE_AND_MODEL'); ?></div>
						<?php }elseif($this->vehicletype==2){	?>
							 <div  id="tp_headingtext"><?php echo JText::_('USED_VEHICLES_MAKE_AND_MODEL'); ?></div>
						 <?php } ?>
					</span>
					<span id="autoz_topheading_text_right"></span>
				</span>
			</div>
        </div>

    <?php if($this->vehicletype==1){ ?>
                <?php if ($this->config['vehiclemakemodel'] == 'mkmdcu' OR  $this->config['vehiclemakemodel'] == 'mkmd'){ ?>
                    <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php
                            $makes = "" ; $count = 0;
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
                        ?>

                            <table  cellpadding="0" cellspacing="0" border="0" width="100%" >
                        <tr class="vehiclesby_data_hidden">
                        <?php foreach($this->vehiclemakemodel AS $mkmd) {
                                $count = $count+1 ;     ?>
                                <?php if ($makes!=$mkmd->maketitle) {
                                $isodd = 1 - $isodd;
                                        $makes = $mkmd->maketitle;
                                        for($i = $count; $i <= $colperrow; $i++) echo '<td></td>';
                                        echo '</tr>';
                                        $count = 1; ?>
                                        <tr class="vehiclesby_title" >
                                            <td  colspan="<?php echo $colperrow; ?>" >
                                                <?php $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$mkmd->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><span > <?php echo $mkmd->maketitle?><?php if(isset($mkmd->totalvehiclemake)) { echo '('.$mkmd->totalvehiclemake.')' ; } ?></span></a>
                                            </td>
                                        </tr>
                                        <tr class="vehiclesby_data">
                                <?php } ?>
                                <?php  $mdlnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$mkmd->makeid.'&md='.$mkmd->modelid.'&cl='.$calfrm.'&Itemid='.$this->Itemid; ?>

                                <td  width=<?php echo $colwidth ;?> >
                                    <a anchor="anchor" href="<?php echo $mdlnks  ; ?>" ><?php echo $mkmd->modeltitle?><?php if (isset($mkmd->totalvehiclemodel)) { echo '('.$mkmd->totalvehiclemodel.')';} ?></a>

                                </td>
                                <?php if($count == $colperrow){ echo '</tr><tr class="vehiclesby_data">'; $count = 0; } ?>

                        <?php }

                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>'; ?>

                    </table>

                    </div>

                    </div>
            <?php }else if ($this->config['vehiclemakemodel'] == 'mk'){ // vehicles by make ?>
                        <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php $makes = "" ; $count =1; 
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
                        
                        ?>
                    <table cellpadding="0" cellspacing="0" border="" width="100%" >
                      <tr class="vehiclesby_data">
                        <?php foreach($this->vehiclemake AS $make) { 
                                $isodd = 1 - $isodd; ?>
                            <td class="vehiclesby_title">
                                <?php
                                $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$make->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><?php echo $make->maketitle.'('.$make->totalvehiclemake.')';?></a>
                             </td>
                             <?php
                                if($count == $colperrow){
                                    echo '</tr><tr class="vehiclesby_data">';
                                    $count = 0;
                                }
                            $count++;
                            ?>
                    <?php } $count --;//for dcrease one because it takes after iteration
                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>';        ?>
                    </table>

                    </div>
                        </div>
            <?php }
          }elseif($this->vehicletype==2){ ?>


                    <?php if ($this->config['vehiclemakemodel'] == 'mkmdcu' OR  $this->config['vehiclemakemodel'] == 'mkmd'){ ?>
                    <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php
                            $makes = "" ; $count = 0;
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
                        ?>

                            <table cellpadding="0" cellspacing="0" border="0" width="100%" >
                        <tr class="vehiclesby_data_hidden">
                        <?php foreach($this->vehiclemakemodel AS $mkmd) {
                                $count = $count+1 ;     ?>
                                <?php if ($makes!=$mkmd->maketitle) {
                                $isodd = 1 - $isodd;
                                        $makes = $mkmd->maketitle;
                                        for($i = $count; $i <= $colperrow; $i++) echo '<td></td>';
                                        echo '</tr>';
                                        $count = 1; ?>
                                        <tr class="vehiclesby_title" >
                                            <td  colspan="<?php echo $colperrow; ?>" >
                                                <?php $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$mkmd->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><?php echo $mkmd->maketitle?><?php if(isset($mkmd->totalvehiclemake)) { echo '('.$mkmd->totalvehiclemake.')' ; } ?></a>
                                            </td>
                                        </tr>
                                        <tr class="vehiclesby_data">
                                <?php } ?>
                                <?php  $mdlnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$mkmd->makeid.'&md='.$mkmd->modelid.'&cl='.$calfrm.'&Itemid='.$this->Itemid; ?>
                                <td  width=<?php echo $colwidth ;?> >
                                    <a anchor="anchor" href="<?php echo $mdlnks  ; ?>" ><span ><?php echo $mkmd->modeltitle?><?php if (isset($mkmd->totalvehiclemodel)) { echo '(<b>'.$mkmd->totalvehiclemodel.'</b>)';} ?></span> </a>
                                </td>
                                <?php if($count == $colperrow){ echo '</tr><tr class="vehiclesby_data">'; $count = 0; } ?>

                        <?php }

                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>'; ?>

                    </table>

                    </div>

                    </div>
            <?php }else if ($this->config['vehiclemakemodel'] == 'mk'){ ?>
                        <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php $makes = "" ; $count =1; 
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
						?>
                    <table style="background-color: #F9FAF9 " cellpadding="0" cellspacing="0" border="" width="100%" >
                      <tr class="vehiclesby_data">
                        <?php foreach($this->vehiclemake AS $make) { 
                                $isodd = 1 - $isodd; ?>
                            <td>
                                <?php
                                $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&vtype='.$this->vehicletype.'&mk='.$make->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><?php echo $make->maketitle.'(<b>'.$make->totalvehiclemake.'</b>)';?></a>
                             </td>

                             <?php  if($count == $colperrow){
                                    echo '</tr><tr>';
                                    $count = 0;
                                    ?>
                            <?php }
                            $count++;
                            ?>
                    <?php } $count--; //same reason as above
                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>';        ?>
                    </table>

                    </div>
                        </div>
            <?php }?>

<?php }else{ ?>
                    <?php if ($this->config['vehiclemakemodel'] == 'mkmdcu' OR  $this->config['vehiclemakemodel'] == 'mkmd'){ ?>
                    <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php
                            $makes = "" ; $count = 0;
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
                        ?>

                            <table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane">
                        <tr class="vehiclesby_data_hidden" >
                        <?php foreach($this->vehiclemakemodel AS $mkmd) {
                                $count = $count+1 ;     ?>
                                <?php if ($makes!=$mkmd->maketitle) {
									$isodd = 1 - $isodd;
                                        $makes = $mkmd->maketitle;
                                        for($i = $count; $i <= $colperrow; $i++) echo '<td></td>';
                                        echo '</tr>';
                                        $count = 1; ?>
                                        <tr class="vehiclesby_title"  >
                                            <td  colspan="<?php echo $colperrow; ?>" >
                                                <?php $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&mk='.$mkmd->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><?php echo $mkmd->maketitle?><?php if(isset($mkmd->totalvehiclemake)) { echo '('.$mkmd->totalvehiclemake.')' ; } ?></a>
                                            </td>
                                        </tr>
                                        <tr class="vehiclesby_data">
                                <?php } ?>
                                <?php  $mdlnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&md='.$mkmd->modelid.'&mk='.$mkmd->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid; ?>

                                <td  width=<?php echo $colwidth ;?> >
                                    <a anchor="anchor" href="<?php echo $mdlnks  ; ?>" ><span ><?php echo $mkmd->modeltitle?><?php if (isset($mkmd->totalvehiclemodel)) { echo '('.$mkmd->totalvehiclemodel.')';} ?></span> </a>

                                </td>
                                <?php if($count == $colperrow){ echo '</tr><tr class="vehiclesby_data">'; $count = 0; } ?>

                        <?php }

                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>'; ?>

                    </table>

                    </div>

                    </div>
            <?php }else if ($this->config['vehiclemakemodel'] == 'mk'){ ?>
                        <div id="jsautoz_wraper">
                        <div id="auto_vmakestitle">
                        <?php $makes = "" ; $count =1;
                            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
                            $isodd =1;
                         ?>
                    <table cellpadding="0" cellspacing="0" border="" width="100%" >
                      <tr class="vehiclesby_data">
                        <?php foreach($this->vehiclemake AS $make) { 
                                    $isodd = 1 - $isodd;
							?>
                            <td>
                                <?php
                                $mklnks ='index.php?option=com_jsautoz&view=buyer&layout=listvehicles&mk='.$make->makeid.'&cl='.$calfrm.'&Itemid='.$this->Itemid;?>
                                <a anchor="anchor" href="<?php echo $mklnks ; ?>" ><span style="font-size: large; "> <?php echo $make->maketitle.'(<b>'.$make->totalvehiclemake.'</b>)';?></span> </a>
                             </td>

                             <?php  if($count == $colperrow){
                                    echo '</tr><tr class="vehiclesby_data">';
                                    $count = 0;
                                    ?>
                            <?php }
                            $count++;
                            ?>
                    <?php } $count--; //same reason
                        for($i = $count; $i < $colperrow; $i++) echo '<td></td>';
                        echo '</tr>';        ?>
                    </table>

                    </div>
                        </div>
            <?php }?>
<?php 
        }
 }
 ?>
    <div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


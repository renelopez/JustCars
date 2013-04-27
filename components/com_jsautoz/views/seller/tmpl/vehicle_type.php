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
$document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);
?>
<div>
<?php if ($this->config['offline'] == '1'){ ?>
<div class="contentpane">
	<div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
	<div class="jsautozmsg">
		<?php echo $this->config['offline_text']; ?>
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
                    <?php if ($this->config['navigation'] == 1) { ?>
                            <div class="autoz_topcurloc">
                                <?php if (isset($this->vehicle) && ($this->vehicle->id == '')){	?>
                                        <?php echo JText::_('CUR_LOC'); ?> :  <?php echo JText::_('VEHICLE_INFORMATION'); ?>
                                <?php }else{	?>
                                        <?php echo JText::_('CUR_LOC'); ?> : <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=controlpannel"><?php echo JText::_('CONTROL_PANNEL'); ?></a> ><?php echo JText::_('MY_VEHICLES'); ?>
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
                            <span id="autoz_topheading_text_center"><?php echo JText::_('VEHICLE_INFORMATION'); ?></span>
                            <span id="autoz_topheading_text_right"></span>
                    </span>
            </div>
        </div>
    <div >
        <span class="<?php echo $this->theme['heading']; ?>"><h1 align="center"><?php echo JText::_('ADD_VEHICLE_TYPE'); ?> </h1></span>
    </div>

<div style="float: left;">
<span style="margin-left: 70px">
    <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=1" onclick="window.parent.document.getElementById( 'sbox-window' ).close();"><span style="font-size: large"><?php echo JText::_('NEW_VEHICLE'); ?></span>  </a>
</span>
    <span style="margin-left: 200px">
    <a anchor="anchor" href="index.php?option=com_jsautoz&view=seller&layout=formvehicle&adtype=2" onclick="window.parent.document.getElementById( 'sbox-window' ).close();"><span style="font-size: large"><?php echo JText::_('USED_VEHICLE'); ?></span>  </a>
</span>



    
</div>
<?php } ?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


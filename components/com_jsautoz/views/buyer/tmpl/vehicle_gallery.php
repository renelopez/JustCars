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
require_once 'vehicle_details.php';
?>
                <?php
            $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
            $isodd =1;
        ?>
<div class="<?php echo $divclass[$isodd]; ?>" id="auto_gallerythumbs">
            <div id="jsautoz_sub_heading">
                <?php echo JText::_('GALLERY'); ?>
            </div>
                <?php foreach ( $this->vehicleimage AS $vehicleimage ){
                    $isodd = 1 - $isodd;?>
                    <div id="auto_gallerythumbssetting">
                            <a  rel="lightbox[gallery]"  href="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_l_'.$vehicleimage->filename; ?>"  title="Vehicle Images"  > <img  width="125px"  alt="" src="<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_m_'.$vehicleimage->filename; ?>"  />
                             </a>
                    </div>

                <?php }?>
                   
</div>

<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


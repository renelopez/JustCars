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
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
?>
                <?php
            //$divclass = array('row0', 'row1');
            $divclass = array('even', 'odd');
            $k =0;
        ?>
<div id="auto_adminmenuvehiclewraper">
    <table width="100%">
    	<tr>
            <td align="left" width="175"  valign="top">
                <?php
                include_once('components/com_jsautoz/views/menu.php');
                ?>
            </td>
            <td valign="top" width="100%">
                <?php require_once 'vehicle_details.php'; ?>
                <div class="<?php echo $divclass[$isodd]; ?>" id="auto_gallerythumbs">
                            <div id="sub_heading">
                                <?php echo JText::_('GALLERY'); ?>
                            </div>
                                <?php foreach ( $this->vehicleimage AS $vehicleimage ){
                                    $isodd = 1 - $isodd;?>
                                    <div id="auto_gallerythumbssetting">
                                            <a  rel="lightbox[gallery]"  href="<?php echo '../'.$this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_l_'.$vehicleimage->filename; ?>"  title="Vehicle Images"  > <img  width="125px"  alt="" src="<?php echo '../'.$this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicle->id;?>/images/thumbs/<?php echo 'jsautoz_m_'.$vehicleimage->filename; ?>"  />
                                             </a>
                                    </div>

                                <?php }?>

                </div>
            </td>
        </tr>
    </table>
</div>

<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>


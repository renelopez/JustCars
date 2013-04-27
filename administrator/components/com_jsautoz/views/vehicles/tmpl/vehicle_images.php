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
JRequest :: setVar('layout', 'vehicle_images');
$_SESSION['cur_layout']='vehicle_images';
$comma = 0;
$colperrow=4;
$colwidth = round(100/$colperrow,1);
$colwidth = $colwidth.'%';
$totalimages=0;
if(isset($this->vehicleimages)){
        foreach ( $this->vehicleimages AS $vehicleimage )
            $totalimages++;
}
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
<table width="100%" >
	<tr>
		<td align="left" width="175"  valign="top">
			<table width="100%" ><tr><td style="vertical-align:top;">
			<?php
			include_once('components/com_jsautoz/views/menu.php');
			?>
			</td>
			</tr></table>
		</td>
		<td width="100%" valign="top" align="left">
<?php  $showfilefield=$this->config['maximageperveh']  - $totalimages;  ?>
<?php  $max_no_img=5; ?>
<form action="index.php" method="post" name="adminForm" id="adminForm"  enctype="multipart/form-data" class="form-validate">
	<table cellpadding="5" cellspacing="0" border="1" width="100%" class="adminform">
            <?php if($showfilefield < $max_no_img ){
                 for($i=1; $i<=$showfilefield; $i++){?>
                <tr>
                    <td >
                            <input type="file" class="inputbox" name="filename[]" id="filename" size="20" maxlenght="30"/>
                   </td>
        	</tr>

                 <?php }
            }else{ ?>
            <?php for($i=1; $i<=$max_no_img; $i++){ ?>
                <tr>
                    <td >
                            <input type="file" class="inputbox" name="filename[]" id="filename" size="20" maxlenght="30"/>
                   </td>
        	</tr>
                <?php }
            }?>
            <tr>
                 <td>
                    <?php  if($totalimages < $this->config['maximageperveh'])  { ;?>
                        <input type="submit" class="button" value="save"/>
                <?php } ?>
                </td>
            </tr>
	</table>
	<table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
		<tr> 
			<?php
				$colcount=0;
					foreach ( $this->vehicleimages AS $vehicleimage ){?>
						<?php if($colcount == $colperrow){ echo '</tr><tr>';  $colcount = 0; } $colcount++; 	?>
						<?php echo '<td>'?>
						<div style="max-width: 150px;max-height: 150px;">
								<img  width="100" height="100" src="../<?php echo $this->config['data_directory'];?>/data/vehicle/vehicle_<?php echo $this->vehicleid;?>/images/thumbs/<?php echo 'jsautoz_m_'.$vehicleimage->filename; ?>"  />
						</div>
						<?php  if($vehicleimage->isdefault == 1) {?>
							<a href="index.php?option=com_jsautoz&task=deletevehicleimages&id=<?php echo $vehicleimage->id;?>&vehid=<?php echo $vehicleimage->vehicleid;?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('REMOVE') ?>   </a> /
							<b><?php echo JText::_('DEFAULT_IMAGE') ?></b>
							<?php }else{ ?>
							<a href="index.php?option=com_jsautoz&task=deletevehicleimages&id=<?php echo $vehicleimage->id;?>&vehid=<?php echo $vehicleimage->vehicleid;?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('REMOVE') ?>   </a> /
							<a href="index.php?option=com_jsautoz&task=makedefaultvehicleimage&vehid=<?php echo $this->vehicleid;?>&imgid=<?php echo $vehicleimage->id;?>&Itemid=<?php echo $this->Itemid ?>"><?php echo JText::_('MAKE_DEFAULT') ?>   </a>
						<?php }?>
					
						<?php echo '</td>';
					} ?>
		</tr>
	</table>
        <input type="hidden" name="vehicleid" value="<?php echo $this->vehicleid; ?>" />		
        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
		<input type="hidden" name="task" value="savevehicleimages" />
		<input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
					
</form>
	
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

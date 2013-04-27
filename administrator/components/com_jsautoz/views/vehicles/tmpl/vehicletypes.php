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

<table width="100%">
	<tr>
		<td align="left" width="175" valign="top">
			<table width="100%"><tr><td style="vertical-align:top;">
			<?php
			include_once('components/com_jsautoz/views/menu.php');
			?>
			</td>
			</tr></table>
		</td>
		<td width="100%" valign="top">
			<form action="index.php" method="post" name="adminForm" id="adminForm">
			<table class="adminlist" border="0">
				<thead>
					<tr>
						<th width="20">
							<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
						</th>
						<th  width="60%" class="title"><?php echo JText::_('TITLE'); ?></th>
						<th   class="title"><?php echo JText::_('DEFAULT'); ?></th>
						<th><?php echo JText::_('PUBLISHED'); ?></th>
					</tr>
				</thead>
			<?php
			jimport('joomla.filter.output');
			$k = 0;
			for ($i=0, $n=count( $this->items ); $i < $n; $i++)
				{
					$row =& $this->items[$i];
					$checked = JHTML::_('grid.id', $i, $row->id);
					$link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=editvehicletype&cid[]='.$row->id);
					?>
					<tr valign="top" class="<?php echo "row$k"; ?>">
						<td>
							<?php echo $checked; ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>">
							<?php echo $row->title; ?></a>
						</td>
                                                <td align="center">
                                                    <?php if($row->isdefault == 1 ) { ?>
                                                    <img src="../components/com_jsautoz/images/default.png" width="16" height="16" border="0" alt="Default" />
                                                    <?php }else{ ?>
                                                    <img src="../components/com_jsautoz/images/notdefault.png" width="16" height="16" border="0" alt="Not Default" />
                                                    <?php } ?>
                                                </td>

						<td align="center">
							<?php 
							if($row->status == 1){	?>
								<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','unpublishvehicletype')">
									<img src="../components/com_jsautoz/images/tick.png" width="16" height="16" border="0" alt="<?php echo JText::_( 'PUBLISH' ); ?>" /></a>
							<?php }else{	?>
								<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','publishvehicletype')">
									<img src="../components/com_jsautoz/images/publish_x.png" width="16" height="16" border="0" alt="<?php echo JText::_( 'UNPUBLISH' ); ?>" /></a>
							<?php }	?>
						</td>
					</tr>
					<?php
					$k = 1 - $k;
				}
			?>
			<tr>
				<td colspan="9">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
			</table>
			<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
			<input type="hidden" name="layout" value="vehicletypes" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

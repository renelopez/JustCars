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

$ADMINPATH = JPATH_BASE .'\components\com_jsautoz';
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
?>
<table width="100%" border="0">
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

			<form action="index.php?option=com_jsautoz" method="post" name="adminForm" id="adminForm">

				<table class="adminlist" cellpadding="1">
					<thead>
						<tr>
							<th width="2%" class="title">
								<?php echo JText::_( 'NUM' ); ?>
							</th>
							<th width="3%" class="title"><input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" /></th>
							<th width="25%" class="title" >	<?php echo JHTML::_('grid.sort',   'Field Title', 'a.username', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
							<th width="5%" class="title" nowrap="nowrap"><?php echo JHTML::_('grid.sort',   'Section', 'a.block', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
							<th width="5%" class="title"><?php echo JHTML::_('grid.sort',   'Published', 'groupname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>	</th>
							<th width="10%" class="title" nowrap="nowrap"><?php echo JHTML::_('grid.sort',   'Ordering', 'a.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?></th>
						</tr>
					</thead>
					<tbody>
					<?php
						$k = 0;
						for ($i=0, $n=count( $this->items ); $i < $n; $i++)
						{
							$row =& $this->items[$i];
							$row1 =& $this->items[$i+1];
							$uptask ='fieldorderingup';
							$upimg ='uparrow.png';
							$downtask ='fieldorderingdown';
							$downimg ='downarrow.png';

							$pubtask 	= $row->published ? 'fieldunpublished' : 'fieldpublished';
							$pubimg 	= $row->published ? 'tick.png' : 'publish_x.png';
								
							$alt 	= $row->published ? JText::_( 'Published' ) : JText::_( 'Unpublished' );

							$checked = JHTML::_('grid.id', $i, $row->id);
							$link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=edit&cid[]='.$row->id);

						?>
						<tr class="<?php echo "row$k"; ?>">
							<td>
								<?php echo $i+1+$this->pagination->limitstart;?>
							</td>
							<td align="center">
								<?php echo JHTML::_('grid.id', $i, $row->id ); ?>
							</td>
							<?php 	$sec = substr($row->field, 0,8); //get section_
							if ($sec == 'section_') {
								$newsection = 1; 
								$subsec = substr($row->field, 0,12);
								if ($subsec == 'section_sub_') {	?>
									<td colspan="2" align="center"><strong><?php echo $row->fieldtitle;  ?></strong></td>
								<?php } else { ?>
									<td colspan="2" align="center"><strong><font size="2"><?php echo $row->fieldtitle;  ?></font></strong></td>
								<?php } ?>
								
								<td align="center">
									<?php if ($row->cannotunpublished == 1) { ?>
										<img src="../components/com_jsautoz/images/<?php echo $pubimg;?>" width="16" height="16" border="0" alt="<?php echo JText::_( 'CAN_NOT_UNPUBLISHED' ); ?>" />
									<?php }else { ?>
									<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $pubtask;?>')">
										<img src="../components/com_jsautoz/images/<?php echo $pubimg;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" /></a>
									<?php } ?>
								</td>
								<td></td>
							<?php } else{  ?>
							<!--	<td ><?php //echo $row->name; ?></td> -->
								<td><?php if ($row->fieldtitle) echo $row->fieldtitle; else echo $row->userfieldtitle; ?></td>
								<td><?php echo $row->section; ?></td>
								<td align="center">
									<?php if ($row->cannotunpublished == 1) { ?>
										<img src="../components/com_jsautoz/images/<?php echo $pubimg;?>" width="16" height="16" border="0" alt="<?php echo JText::_( 'CAN_NOT_UNPUBLISHED' ); ?>" />
									<?php }else { ?>
									<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $pubtask;?>')">
										<img src="../components/com_jsautoz/images/<?php echo $pubimg;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" /></a>
									<?php } ?>
								</td>
								<td>
									<?php if ($i != 0 ) { 
											if ($newsection != 1) { ?>		
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $downtask;?>')">
													<img src="../components/com_jsautoz/images/<?php echo $upimg;?>" width="16" height="16" border="0" alt="Order Up" /></a>
										<?php } else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
										} else echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>	
									&nbsp;&nbsp;<?php echo $row->ordering; ?>&nbsp;&nbsp;
									<?php if ($i < $n-1) { 
											if ($row->section == $row1->section) { ?>
												<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i;?>','<?php echo $uptask;?>')">
													<img src="../components/com_jsautoz/images/<?php echo $downimg;?>" width="16" height="16" border="0" alt="Order Down" /></a>
									<?php 	} 
										}	?>	
								</td>
							<?php $newsection = 0; 
							} ?>
						</tr>
						<?php
							$k = 1 - $k;
							}
						?>

					</tbody>
					<tfoot>
						<tr>
							<td colspan="10">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>

				</table>

				<input type="hidden" name="option" value="<?php echo $this->option ; ?>" />
				<input type="hidden" name="task" value="view" />
				<input type="hidden" name="layout" value="fieldsordering" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
				<?php echo JHTML::_( 'form.token' ); ?>
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

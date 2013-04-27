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
		<td width="100%" valign="top">

			<form action="index.php?option=com_jsautoz&view=vehicles&layout=users&tmpl=component" method="post" name="adminForm"  id="adminForm">
				<tr>
					<td width="100%">
						<strong><?php echo JText::_( 'Filter' ); ?></strong>
					</td>
					<td nowrap>
						<?php echo JText::_( 'NAME' ); ?>:
							<input type="text" name="searchname" id="searchname" value="<?php if(isset($this->lists['searchname'])) echo $this->lists['searchname'];?>" class="text_area" onchange="document.adminForm.submit();" />
					&nbsp;</td>
					<td nowrap >
						<?php echo JText::_( 'USER_NAME' ); ?>:
						<input type="text" name="searchusername" id="searchusername" size="15" value="<?php if(isset($this->lists['searchusername'])) echo $this->lists['searchusername'];?>" class="text_area" onchange="document.adminForm.submit();" />
					&nbsp;</td>
					
					<td>
						<button onclick="document.getElementById('searchname').value='';document.getElementById('searchusername').value='';document.getElementById('searchrole').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
					</td>
				</tr>
				<table class="adminlist" cellpadding="1">
					<thead>
						<tr>
							<th width="2%" class="title">
								<?php echo JText::_( 'NUM' ); ?>
							</th>
							<th width="3%" class="title">
								<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
							</th>
							<th width="15%" class="title"><?php echo JText::_('NAME'); ?></th>
							<th width="15%" class="title" ><?php echo JText::_('USER_NAME'); ?></th>
							<th width="4%" class="title" nowrap="nowrap"><?php echo JText::_('Enabled'); ?></th>
							<th width="4%" class="title" nowrap="nowrap"><?php echo JText::_('ID'); ?></th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="10">
								<?php echo $this->pagination->getListFooter(); ?>
							</td>
						</tr>
					</tfoot>
					<tbody>
					<?php
						$k = 0;
						for ($i=0, $n=count( $this->items ); $i < $n; $i++)
						{
							$row 	=& $this->items[$i];
							$img 	= $row->block ? 'publish_x.png' : 'tick.png';
							$task 	= $row->block ? 'unblock' : 'block';
							$alt 	= $row->block ? JText::_( 'Enabled' ) : JText::_( 'Blocked' );
							$link 	= 'index.php?option=com_jsautoz&view=vehicle&layout=formdeller&userid='.$row->id;

						?>
						<tr class="<?php echo "row$k"; ?>">
							<td>
								<?php echo $i+1+$this->pagination->limitstart;?>
							</td>
							<td><?php echo JHTML::_('grid.id', $i, $row->id ); ?></td>
                                                        <td><a onclick="window.parent.setuser('<?php echo $row->username; ?>','<?php echo $row->id;?>'); " ><?php echo $row->name; ?></a></td>
							<td><?php echo $row->username; ?>	</td>
							<td align="center">	<img src="../components/com_jsautoz/images/<?php echo $img;?>" width="16" height="16" border="0" alt="<?php echo $alt; ?>" />					</td>
							<td><?php echo $row->id; ?>	</td>
							</td>
							
						</tr>
						<?php
							$k = 1 - $k;
							}
						?>
					</tbody>
				</table>

				<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
				<input type="hidden" name="task" value="view" />
				<input type="hidden" name="layout" value="users" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php  echo $this->lists['order']; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
				<?php echo JHTML::_( 'form.token' ); ?>
			</form>
		</td>
	</tr>
	
</table>										

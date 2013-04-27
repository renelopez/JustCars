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
JRequest :: setVar('layout', 'userfields');
$_SESSION['cur_layout']='userfields';
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
<!--
			<table width="625">
					<tr>
						<td width="100%">
							<?php echo JText::_( 'Filter' ); ?>:
							<input type="text" name="searchname" id="searchname" value="<?php if(isset($this->lists['searchname'])) echo $this->lists['searchname'];?>" class="text_area" onchange="document.adminForm.submit();" />
							<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
							<button onclick="document.getElementById('searchname').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
						</td>
					</tr>
				</table>
-->
				<table class="adminlist" cellpadding="1">
					<thead>
						<tr>
							<th width="2%" class="title">
								<?php echo JText::_( 'NUM' ); ?>
							</th>
							<th width="3%" class="title">
								<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
							</th>
							<th class="title">
								<?php echo JHTML::_('grid.sort',   'FIELD_NAME', 'a.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
							</th>
							<th width="15%" class="title" >
								<?php echo JHTML::_('grid.sort',   'FIELD_TITLE', 'a.username', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
							</th>
							<th width="5%" class="title" nowrap="nowrap">
								<?php echo JHTML::_('grid.sort',   'FIELD_TYPE', 'a.block', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
							</th>
							<th width="15%" class="title">
								<?php echo JHTML::_('grid.sort',   'REQUIRED', 'groupname', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
							</th>
							<th width="1%" class="title" nowrap="nowrap">
								<?php echo JHTML::_('grid.sort',   'READ_ONLY', 'a.id', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
							</th>
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
							$link 	= 'index.php?option=com_jsautoz&amp;view=user&amp;task=edituserfields&amp;cid[]='. $row->id. '';

						?>
						<tr class="<?php echo "row$k"; ?>">
							<td>
								<?php echo $i+1+$this->pagination->limitstart;?>
							</td>
							<td>
								<?php echo JHTML::_('grid.id', $i, $row->id ); ?>
							</td>
							<td><a href="<?php echo $link; ?>"><?php echo $row->name; ?></a></td>
							<td><?php echo $row->title; ?></td>
							<td><?php echo $row->type; ?></td>
							<td><?php echo $row->required; ?></td>
							<td><?php echo $row->readonly; ?></td>
							
						</tr>
						<?php
							$k = 1 - $k;
							}
						?>

					</tbody>
				</table>

				<input type="hidden" name="option" value="com_jsautoz" />
				<input type="hidden" name="layout" value="userfields" />
				<input type="hidden" name="task" value="view" />
				<input type="hidden" name="boxchecked" value="0" />
				<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
				<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
				<?php echo JHTML::_( 'form.token' ); ?>
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

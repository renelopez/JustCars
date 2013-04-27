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
JRequest :: setVar('layout', 'counties');
$_SESSION['cur_layout']='counties';
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
                        <table>
				<tr>
					<td width="100%">
						<strong><?php echo JText::_( 'Filter' ); ?></strong>
					</td>
					<td nowrap>
						<?php echo JText::_( 'NAME' ); ?>:
							<input type="text" name="searchname" id="searchname" value="<?php if(isset($this->lists['searchname'])) echo $this->lists['searchname'];?>" class="text_area" onchange="document.adminForm.submit();" />
					&nbsp;</td>
					<td nowrap >
						<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
					&nbsp;</td>

					<td>
						<button onclick="document.getElementById('searchname').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
					</td>
				</tr>
			</table>
			<table class="adminlist" border="0">
				<thead>
					<tr><td colspan="4">
					<?php 
				                $session = JFactory::getSession();
						$countrycode=$session->get('countrycode');	
						$statecode=$session->get('statecode');	
						//if (isset($_SESSION['js_countrycode'])) $countrycode = $_SESSION['js_countrycode']; 
					?>
						<a href="index.php?option=com_jsautoz&task=view&layout=countries"><?php echo JText::_('COUNTRIES'); ?></a> >
						<a href="index.php?option=com_jsautoz&task=view&layout=states&ct=<?php echo $countrycode; ?>" ><?php echo JText::_('STATES'); ?></a> 
					</td></tr>
					<tr>
						<th width="20">
							<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
						</th>
						<th  width="60%" class="title"><?php echo JText::_('NAME'); ?></th>
						<th><?php echo JText::_('PUBLISHED'); ?></th>
						<th><?php echo JText::_('CITIES'); ?></th>
					</tr>
				</thead>
			<?php
			jimport('joomla.filter.output');
			$k = 0;
				for ($i=0, $n=count( $this->items ); $i < $n; $i++)
				{
				$row =& $this->items[$i];
				$checked = JHTML::_('grid.id', $i, $row->id);
				//$link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=edit&cid[]='.$row->id);
                                $link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=editvehiclecounty&cid[]='.$row->id);
				?>
				<tr valign="top" class="<?php echo "row$k"; ?>">
					<td>
						<?php echo $checked; ?>
					</td>
					<td>
						<a href="<?php echo $link; ?>">
						<?php echo $row->name; ?></a>
					</td>
					<td align="center">
						<?php
							if ($row->enabled == 'Y')$img 	= 'tick.png'; else $img 	= 'publish_x.png';
						?>
						<img src="../components/com_jsautoz/images/<?php echo $img;?>" width="16" height="16" border="0"  />
					</td>
					<td><a href="index.php?option=com_jsautoz&task=view&layout=cities&co=<?php echo $row->code; ?>"><?php echo JText::_('CITIES'); ?></a></td>
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
			<input type="hidden" name="layout" value="counties">
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="boxchecked" value="0" />
			<input type="hidden" name="sd" value="<?php if($statecode) echo $statecode; ?>" />
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

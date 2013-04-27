<?php
/**
 * @Copyright Copyright (C) 2009-2011
 * @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
 + Created by:	Ahmad Bilal
 * Company:		Buruj Solutions
 + Contact:		www.burujsolutions.com , ahmad@burujsolutions.com
 * Created on:	Jan 11, 2009
 ^
 + Project: 		JS Jobs
 * File Name:	admin-----/views/applications/tmpl/jobs.php
 ^ 
 * Description: Default template for jobs view
 ^ 
 * History:		NONE
 ^ 
 */
 
defined('_JEXEC') or die('Restricted access');

JRequest :: setVar('layout', 'themes');

$status = array(
	'1' => JText::_('APPROVED'),
	'-1' => JText::_('REJECTED'));
function checkDefaultTheme($themeno,$config){
	$img = '<img src="../components/com_jsautoz/images/notdefault.png" width="16" height="16" border="0" alt="Not Default" />';
	switch($themeno){
		case 8:
			if($config['theme'] == '/graywhite/css/jsautozgraywhite.css') $img = '<img src="../components/com_jsautoz/images/default.png" width="16" height="16" border="0" alt="Default" />';
		break;
		case 9:
			if($config['theme'] == '/template/css/jsautoztemplate.css') $img = '<img src="../components/com_jsautoz/images/default.png" width="16" height="16" border="0" alt="Default" />';
		break;
	}
	return $img;
}
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
?>
<table width="100%" >
	<tr>
		<td align="left" width="175"  valign="top">
			<table width="100%"><tr><td style="vertical-align:top;">
			<?php
			include_once('components/com_jsautoz/views/menu.php');
			?>
			</td>
			</tr></table>
		</td>
		<td width="100%" valign="top">

<form action="index.php" method="POST" name="adminForm" id="adminForm">
		<table class="adminlist">
			<thead>
				<tr>
					<th width="5%"></th>
					<th><?php echo JText::_('NAME'); ?></th>
					<th width="10%"><?php echo JText::_('DEFAULT'); ?></th>
				</tr>
			</thead>
				<tr>
					<?php $checked = JHTML::_('grid.id', 8, 8);?>
					<td><?php echo $checked; ?></td>
					<td><?php echo JText::_('GRAYWHITE_THEME');?></td>
					<td align="center"><a href="javascript:void(0);" onclick="return listItemTask('cb8',' makedefaulttheme')"><?php echo checkDefaultTheme(8,$this->config);?></a></td>
				</tr>
				<tr>
					<?php $checked = JHTML::_('grid.id', 9, 9);?>
					<td><?php echo $checked; ?></td>
					<td><?php echo JText::_('TEMPLATE_THEME');?></td>
					<td align="center"><a href="javascript:void(0);" onclick="return listItemTask('cb9',' makedefaulttheme')"><?php echo checkDefaultTheme(9,$this->config);?></a></td>
				</tr>
				</td>
			</tr>
			
		</table>				
</td></tr>			
	<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
</form>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

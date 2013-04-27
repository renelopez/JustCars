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
JRequest :: setVar('layout', 'formvehicleuserfield');
$_SESSION['cur_layout']='formvehicleuserfield';



$yesno = array(
	'0' => array('value' => 1,'text' => JText::_('YES')),
	'1' => array('value' => 0,'text' => JText::_('NO')),);

$fieldtype = array(
	'0' => array('value' => 'checkbox','text' => JText::_('Check Box')),
	//'1' => array('value' => 'checkbox','text' => JText::_('Check Box')),
	//'2' => array('value' => 'date','text' => JText::_('Date')),
	//'3' => array('value' => 'select','text' => JText::_('Drop Down')),
	//'4' => array('value' => 'emailaddress','text' => JText::_('Email Address')),
//	//'5' => array('value' => 'editortext','text' => JText::_('Editor Text Area')),
	//'6' => array('value' => 'textarea','text' => JText::_('Text Area')),
	);
$section = array(
	'0' => array('value' => '10','text' => JText::_('JS_PERSONAL_INFORMATION')),
	'1' => array('value' => '20','text' => JText::_('JS_BASIC_INFORMATION')),
	'2' => array('value' => '31','text' => JText::_('JS_ADDRESS')),
	'3' => array('value' => '32','text' => JText::_('JS_ADDRESS1')),
	'4' => array('value' => '33','text' => JText::_('JS_ADDRESS2')),
	'5' => array('value' => 'editortext','text' => JText::_('JS_ADDRESS3')),
	'6' => array('value' => 'textarea','text' => JText::_('Text Area')),
	);
	
		$lstype = JHTML::_('select.genericList', $fieldtype, 'type[]', 'class="inputbox" '. 'onchange="toggleType(this.options[this.selectedIndex].value);"', 'value', 'text', '');
		//$lsreadonly = JHTML::_('select.genericList', $yesno, 'readonly[]', 'class="inputbox" '. '', 'value', 'text', $this->userfield->readonly);

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
			<form action="index.php" method="POST" name="adminForm" id="adminForm" >
				<table class="adminform">
					<?php 
					foreach($this->userfields as $field){
								$lsrequired = JHTML::_('select.genericList', $yesno, 'required[]', 'class="inputbox" '. '', 'value', 'text', $field->required);
								$lspublished = JHTML::_('select.genericList', $yesno, 'published[]', 'class="inputbox" '. '', 'value', 'text', $field->published);
					?>
						<?php if($field->field != 'section_userfields') { ?>
							<tr class="row0">
								<td width="20%">Field type:</td>
								<td width="20%"><?php echo $lstype; ?>
								</td>
								<td>&nbsp;</td>
							</tr>
						<?php } ?>	
							<input type="hidden" name="userfield[]" class="inputbox" readonly="readonly"  value="<?php echo $field->field; ?>" />

						<tr class="row0">
							<td width="20%"><strong><?php if($field->field != 'section_userfields') echo JText::_( 'FIELD_TITLE'); else echo  JText::_('SECTION_TITLE'); ?></strong>:</td>
							<td width="20%" align="left"><input type="text" name="title[]" class="inputbox" value="<?php echo $field->fieldtitle; ?>" /></td>
							<td>&nbsp;</td>
						</tr>
						<?php if($field->field == 'section_userfields') { ?>
							<tr class="row1" style="display:none">
								<td width="20%">Required?:</td>
								<td width="20%"><?php echo $lsrequired; ?></td>
								<td>&nbsp;</td>
							</tr>
						<?php }else{ ?>
							<tr class="row1">
								<td width="20%">Required?:</td>
								<td width="20%"><?php echo $lsrequired; ?></td>
								<td>&nbsp;</td>
							</tr>

						<?php  } ?>	
						<tr class="row0">
							<td width="20%">Published:</td>
							<td width="20%"><?php echo $lspublished; ?></td>
							<td>&nbsp;</td>
						</tr>
						<tr class="row1"><td colspan="3" height="25"></td></tr>
					<input type="hidden" name="id[]" value="<?php echo $field->id ?>" />

					<?php }?>
					</table>
					<div id="page1"></div>
					

					<input type="hidden" name="section" value="1000" />

					<input type="hidden" name="valueCount" value="<?php echo $i; ?>" />
					<input type="hidden" name="fieldfor" value="2" />
					<input type="hidden" name="view" value="vehicle" />
					<input type="hidden" name="layout" value="formvehicleuserfield" />
					<input type="hidden" name="task" value="savevehicleuserfields" />
					<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
			</form>
			
			
		</td>
	</tr>
	
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

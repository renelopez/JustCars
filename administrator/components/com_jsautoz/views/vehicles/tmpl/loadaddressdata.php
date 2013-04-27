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

//JHTMLBehavior::formvalidation(); 
JHTML::_('behavior.formvalidation');
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
<script language="javascript">
function submitbutton(pressbutton) {
	if (pressbutton) {
		document.adminForm.task.value=pressbutton;
	}
	if(pressbutton == 'save'){
		returnvalue = validate_form(document.adminForm);
	}else returnvalue  = true;
	
	if (returnvalue == true){
		try {
			  document.adminForm.onsubmit();
	        }
		catch(e){}
		document.adminForm.submit();
	}
}

function validate_form(f)
{
        if (document.formvalidator.isValid(f)) {
                f.check.value='<?php if(($jversion == '1.5') || ($jversion == '2.5')) echo JUtility::getToken(); else echo  JSession::getFormToken(); ?>';//send token
        }
        else {
                alert('Some values are not acceptable.  Please retry.');
				return false;
        }
		return true;
}
</script>
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
			<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data" id="adminForm">
			<table class="adminform" border="0">
				<thead>
				<tr valign="center" align="center" style="align:center;">
					<th>
						<?php echo JText::_('LOAD_ADDRESS_TITLE'); ?>
					</th>
				</tr>
				</thead>
				<tr><td height="20"></td></tr>
				<?php if ($this->error != 2){ ?>
				<tr valign="top" >
					<td>
						<?php echo JText::_('FILE'); ?> :&nbsp;<font color="red">*</font>&nbsp;<input type="file" class="inputbox  required" name="loadaddressdata" id="loadaddressdata" size="20" maxlenght='30'/>
					</td>
				</tr>
				<input type="hidden" name="actiontype" value="1" />
				<?php }else { ?>
				<tr valign="top" >
					<td>
						<?php echo JText::_('JS_ACTION'); ?> :&nbsp;<font color="red">*</font>&nbsp;<select name="actiontype" class="inputbox  required">
							<option value="3"><?php echo JText::_('JS_DELETE_OLD_INSERT_THIS'); ?></option>
							<option value="4"><?php echo JText::_('JS_INSERT_THIS'); ?></option>
						
					</td>
				</tr>
				<?php } ?>
				<tr><td height="20"></td></tr>
				<tr>
					<td align="center">
					<input class="button" type="submit" name="submit_app"  value="<?php echo JText::_('LOAD_ADDRESS_DATA'); ?>" />
					</td>
				</tr>
			</table>
			<input type="hidden" name="option" value="<?php echo $option; ?>" />
			<input type="hidden" name="task" value="loadaddressdata" />
			<input type="hidden" name="check" value="" />
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

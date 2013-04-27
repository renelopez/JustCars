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
jimport('joomla.html.pane');
JHTMLBehavior::formvalidation(); 
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>

<script type="text/javascript">
    // for joomla 1.6
Joomla.submitbutton = function(task){
        if (task == ''){
                return false;
        }else{
                if (task == 'savemileagetype' || task == 'savemileagetypesave' || task == 'savemileagetypeandnew' ){
                    returnvalue = validate_form(document.adminForm);
                }else returnvalue  = true;
                if (returnvalue){
                        Joomla.submitform(task);
                        return true;
                }else return false;
        }
}
// for joomla 1.5

function submitbutton(pressbutton) {
	if (pressbutton) {
		document.adminForm.task.value=pressbutton;
	}
	if(pressbutton == 'savemileagetype'  || pressbutton == 'savemileagetypesave' || pressbutton == 'savemileagetypeandnew'){
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
	<form action="index.php" method="POST" name="adminForm" id="adminForm" >
	<table cellpadding="0" cellspacing="0" border="0" width="100%" class="adminform">
	<?php
	if($this->msg != ''){
	?>
	 <tr>
        <td colspan="2" align="center"><font color="red"><strong><?php echo JText::_($this->msg); ?></strong></font></td>
      </tr>
	  <tr><td colspan="2" height="10"></td></tr>	
	<?php
	}
	?>
	<tr class="row0">
		<td width="20%" valign="top"><label id="titleymsg" for="title"><?php echo JText::_('TITLE'); ?></label>&nbsp;<font color="red">*</font></td>
		  <td width="60%"><input class="inputbox required" type="text" name="title" size="40" maxlength="255" value="<?php if(isset($this->mileagetype)) echo $this->mileagetype->title; ?>" />
        </td>
      </tr>
	<tr class="row0">
		<td width="20%" valign="top"><label id="titleymsg" for="title"><?php echo JText::_('SYMBOL'); ?></label>&nbsp;<font color="red">*</font></td>
		  <td width="60%"><input class="inputbox required" type="text" name="symbol" size="40" maxlength="255" value="<?php if(isset($this->mileagetype)) echo $this->mileagetype->symbol; ?>" />
        </td>
      </tr>
      <tr>
	<tr class="row1">
		<td valign="top"><label id="statusmsg" for="status"><?php echo JText::_('PUBLISHED'); ?></label></td>
		  <td><input type="checkbox" name="status" value="1" <?php if(isset($this->mileagetype))  {if ($this->mileagetype->status == '1') echo 'checked';} ?>/>
		  </td>
      </tr>
	<tr><td colspan="2" height="10"></td></tr>
	<tr class="row0">
		<td  colspan="2" align="center">
		<input type="submit" class="button" name="submit_app" onclick="return validate_form(document.adminForm)" value="<?php echo JText::_('SAVE'); ?>" />
		</td>
	</tr>

    </table>
			<input type="hidden" name="id" value="<?php if(isset($this->mileagetype)) echo $this->mileagetype->id; ?>" />
			<input type="hidden" name="check" value="" />
			<input type="hidden" name="task" value="savemileagetype" />
			<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
  </form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

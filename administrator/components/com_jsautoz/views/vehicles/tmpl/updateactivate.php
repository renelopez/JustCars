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
JHTML::_('behavior.formvalidation'); 

$host = $_SERVER['HTTP_HOST'];
$self = $_SERVER['PHP_SELF'];
$url = "http://$host$self";
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

	<table cellpadding="5" cellspacing="0" border="0" width="100%" class="admintable" >
		

			<tr>
				<td>
					<fieldset UPDATE>
						<legend><?php echo JText::_('UPDATE'); ?></legend>
						<form action="http://www.joomsky.com/jsautozsys/checkautozupdate.php" method="POST" name="updateForm" target="_blank">
						<table cellpadding="5" cellspacing="0" border="0" width="100%" class="admintable" >
							<tr>
									 <td class="row0" width="30%" ><?php echo JText::_('TRANSACTION_REFERENCE_NO'); ?></td>
									 <td><input type="text" name="transactionrefno" id="transactionrefno" value="<?php if($this->info) echo $this->info->transaction; ?>" </td>
							</tr>
							<tr>
									 <td class="row1" ><?php echo JText::_('PAYMENT_EMAIL_ADDRESS'); ?></td>
									 <td><input type="text" name="pyemailaddress" id="pyemailaddress" value="<?php if($this->info) echo $this->info->emailaddress; ?>" </td>
							</tr>
							<tr>
									 <td class="row0" colspan="2" align="center" style="text-align:center">
									 <input type="submit" class="button" onclick="return validateUpdates();" value="<?php echo JText::_('CHECK_UPDATES'); ?>"> &nbsp;&nbsp;&nbsp;&nbsp;
									 <input type="button" class="button" onclick="savePaymentInfo();"value="<?php echo JText::_('SAVE_PAYMENT_INFO'); ?>"></td>
							</tr>
						</table>
						<input type="hidden" name="activateipo" value="activate" />
						<input type="hidden" name="referencede" value="<?php echo $this->refer[0]; ?>" />
						<input type="hidden" name="siteaddress" value="<?php echo $url; ?>" />
						<input type="hidden" name="vcode" value="<?php echo $this->refer[1]; ?>" />
						<input type="hidden" name="version" value="<?php echo $this->refer[2]; ?>" />
						<input type="hidden" name="code" value="<?php echo $this->refer[3]; ?>" />
						<input type="hidden" name="vtype" value="<?php echo $this->refer[4]; ?>" />

					</form>

					</fieldset>
												
				</td>
			</tr>
			<tr>
				<td>
					<fieldset ACTIVATE>
						<legend><?php echo JText::_('GET_ACTIVATION_KEY'); ?></legend>
						<form action="http://www.joomsky.com/jsautozsys/getactivationkey.php" method="POST" name="activateForm" target="_blank">
						<table cellpadding="5" cellspacing="0" border="0" width="100%" class="admintable" >
							<tr>
									 <td class="row0" width="30%" ><?php echo JText::_('TRANSACTION_REFERENCE_NO'); ?></td>
									 <td><input type="text" name="transactionrefno" id="transactionrefno" value="<?php if($this->info) echo $this->info->transaction; ?>" </td>
							</tr>
							<tr>
									 <td class="row1" ><?php echo JText::_('PAYMENT_EMAIL_ADDRESS'); ?></td>
									 <td><input type="text" name="pyemailaddress" id="pyemailaddress" value="<?php if($this->info) echo $this->info->emailaddress; ?>" </td>
							</tr>
							<tr>
									 <td class="row0" colspan="2" align="center" style="text-align:center">
									 <input type="submit" class="button" onclick="return validateActivateKey();" value="<?php echo JText::_('ACTIVATE'); ?>"> </td>
							</tr>
						</table>
						<input type="hidden" name="activateipo" value="activate" />
						<input type="hidden" name="referencede" value="<?php echo $this->refer[0]; ?>" />
						<input type="hidden" name="siteaddress" value="<?php echo $url; ?>" />
						<input type="hidden" name="vcode" value="<?php echo $this->refer[1]; ?>" />
						<input type="hidden" name="version" value="<?php echo $this->refer[2]; ?>" />
					</form>

					</fieldset>
												
				</td>
			</tr>
			<tr>
				<td>
			  <form action="index.php" method="POST" name="formAdmin"  >
                                <fieldset class="adminform">
                                   <legend><?php echo JText::_('ACTIVATE'); ?></legend>
                                        <table cellpadding="0" cellspacing="0" border="0" width="100%" class="admintable">
                                        <tr><td height="10" colspan="3"></td></tr>

                                         <tr>
                                        <td class="key" width="30%" ><?php echo JText::_('ACTIVATION_KEY'); ?> :</td>
                                                <td class="textbox" ><input class="inputbox required" type="text" name="activationkey" id="activationkey" size="50" maxlength="255" value="" />   </td>
                                                <td width="15%"></td>
                                      </tr>
                                        <tr><td height="10" colspan="3"></td></tr>
                                          <tr>
                                                <td align="center" colspan="3" nowrap style="text-align:center;">
                                                        <input class="button" onclick="return validateActivate();" type="submit" name="submit_app" value="<?php echo JText::_('ACTIVATE'); ?>" />
                                                </td>
                                        </tr>
                                    </table>
                                   </fieldset>
					<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
					<input type="hidden" name="task" value="saveactivate" />
					<input type="hidden" name="referencede" value="<?php echo $this->refer[0]; ?>" />
					<input type="hidden" name="siteaddress" value="<?php echo $url; ?>" />
					<input type="hidden" name="vcode" value="<?php echo $this->refer[1]; ?>" />
					<input type="hidden" name="version" value="<?php echo $this->refer[2]; ?>" />
					<input type="hidden" name="code" value="<?php echo $this->refer[3]; ?>" />
					<input type="hidden" name="vtype" value="<?php echo $this->refer[4]; ?>" />
			  </form>

				</td>
			</tr>
			</table>
	<form action="index.php" method="POST" name="adminForm">	  
	<input type="hidden" name="transaction" value="">
	<input type="hidden" name="emailaddress" value="">
	<input type="hidden" name="task" value="savepaymentinfo" />
	<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
	
	</form>   
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

<script type="text/javascript">
function savePaymentInfo() {
	var f = document.adminForm;
	var uf = document.updateForm;
	if (validateUpdates()){
		f.transaction.value = uf.transactionrefno.value;
		f.emailaddress.value = uf.pyemailaddress.value;
		f.submit();
	}
	return true;
}

function validateActivate() {
	var f = document.formAdmin;
	if (f.activationkey.value == ""){
		alert("Please enter Activation Key");
		f.activationkey.focus()
		return false;
	}
	return true;
}

function validateActivateKey() {
	var f = document.activateForm;
	if (f.pyemailaddress.value == ""){
		alert("Please enter email address");
		f.pyemailaddress.focus()
		return false;
	}
	if (echeck(f.pyemailaddress.value)==false){
		f.pyemailaddress.focus()
		return false
	}
	if (f.transactionrefno.value == ""){
		alert("Please enter transaction id");
		f.transactionrefno.focus()
		return false;
	}
	return true;
}

function validateUpdates() {
	var f = document.updateForm;
	if (f.pyemailaddress.value == ""){
		alert("Please enter email address");
		f.pyemailaddress.focus()
		return false;
	}
	if (echeck(f.pyemailaddress.value)==false){
		f.pyemailaddress.focus()
		return false
	}
	if (f.transactionrefno.value == ""){
		alert("Please enter transaction id");
		f.transactionrefno.focus()
		return false;
	}
	return true;
}

function echeck(str) {

		var at="@"
		var dot="."
		var lat=str.indexOf(at)
		var lstr=str.length
		var ldot=str.indexOf(dot)
		if (str.indexOf(at)==-1){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		   alert("Invalid E-mail ID")
		   return false
		}

		if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		    alert("Invalid E-mail ID")
		    return false
		}

		 if (str.indexOf(at,(lat+1))!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(dot,(lat+2))==-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

		 if (str.indexOf(" ")!=-1){
		    alert("Invalid E-mail ID")
		    return false
		 }

 		 return true
}

</script>
	     

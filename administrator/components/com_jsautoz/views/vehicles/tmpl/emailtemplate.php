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

$editor = &JFactory::getEditor();
JHTML::_('behavior.calendar');
JHTML::_('behavior.formvalidation'); 
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>

<script language="javascript">
// for joomla 1.6
Joomla.submitbutton = function(task){
        if (task == ''){
                return false;
        }else{
                if (task == 'saveemailtemplate'){
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
	if(pressbutton == 'saveemailtemplate'){
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
                alert('<?php echo JText::_('SOME_VALUES_ARE_NOT_ACCEPTABLE_PLEASE_RETRY');?>');
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


<form action="index.php" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data" >
<input type="hidden" name="check" value="post"/>
    <table cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
				      <tr class="row1">
				        <td width="50" colspan="3" align="right"><label id="subjectmsg" for="subject"><?php echo JText::_('SUBJECT'); ?></label>&nbsp;<font color="red">*</font>&nbsp;:&nbsp;&nbsp;&nbsp;
				          <input class="inputbox required" type="text" name="subject" id="subject" size="135" maxlength="255" value="<?php if(isset($this->template)) echo $this->template->subject; ?>" />
				        </td>
				      </tr>
							<tr><td height="10" colspan="2"></td></tr>
							<tr class="row2">
								<td colspan="3" valign="top" align="center"><label id="descriptionmsg" for="body"><strong><?php echo JText::_('BODY'); ?></strong></label>&nbsp;<font color="red">*</font></td>
							</tr>
							<tr>
								<td colspan="2" align="center" width="600">
								<?php
									$editor =& JFactory::getEditor();
									if(isset($this->template))
										echo $editor->display('body', $this->template->body, '550', '300', '60', '20', false);
									else
										echo $editor->display('body', '', '550', '300', '60', '20', false);
								?>	
								</td>
								<td width="35%" valign="top">
									<table  cellpadding="5" cellspacing="0" border="0" width="100%" class="adminform">
										
										<tr class="row1"><td> <strong><u><?php echo JText::_('PARAMETERS'); ?></u></strong></td>	</tr>
										<?php if(($this->template->templatefor == 'vehicle-approval' ) || ($this->template->templatefor == 'vehicle-rejecting' ) ) { ?>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif(($this->template->templatefor == 'message-btosemail') OR ($this->template->templatefor == 'message-stobemail')) { ?>
											<tr><td>{SELLER} :  <?php echo JText::_('SELLER_NAME'); ?></td></tr>
											<tr><td>{BUYER} :  <?php echo JText::_('BUYER_NAME'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'new-review') { ?>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'vehicle-new' )  { ?>										
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'package-buy' )  { ?>										
											<tr><td>{PACKAGE_TITLE} :  <?php echo JText::_('PACKAGE_TITLE'); ?></td></tr>
											<tr><td>{SELLER_NAME} :  <?php echo JText::_('SELLER_NAME'); ?></td>	</tr>
											<tr><td>{PACKAGE_PRICE} :  <?php echo JText::_('PACKAGE_PRICE'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'package-approval' )  { ?>										
											<tr><td>{PACKAGE_TITLE} :  <?php echo JText::_('PACKAGE_TITLE'); ?></td></tr>
											<tr><td>{SELLER_NAME} :  <?php echo JText::_('SELLER_NAME'); ?></td>	</tr>
											<tr><td>{PACKAGE_PRICE} :  <?php echo JText::_('PACKAGE_PRICE'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'buyer-contact-seller' )  { ?>										
											<tr><td>{SUBJECT} :  <?php echo JText::_('SUBJECT'); ?></td></tr>
											<tr><td>{BUYER_NAME} :  <?php echo JText::_('BUYER_NAME'); ?></td></tr>
											<tr><td>{BUYER_PHONE} :  <?php echo JText::_('BUYER_PHONE'); ?></td>	</tr>
											<tr><td>{BUYER_CELL} :  <?php echo JText::_('BUYER_CELL'); ?></td>	</tr>
											<tr><td>{BUYER_EMAIL} :  <?php echo JText::_('BUYER_EMAIL'); ?></td>	</tr>
											<tr><td>{BUYER_DESCRIPTION} :  <?php echo JText::_('BUYER_DESCRIPTION'); ?></td>	</tr>
											<tr><td>{VEHICLE_DETAIL} :  <?php echo JText::_('VEHICLE_DETAIL'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'seller-review' )  { ?>										
											<tr><td>{SELLER_NAME} :  <?php echo JText::_('SELLER_NAME'); ?></td>	</tr>
											<tr><td>{BUYER_NAME} :  <?php echo JText::_('BUYER_NAME'); ?></td></tr>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'vehicle-alert' )  { ?>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'vehicle-visitor' )  { ?>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										
										<?php } elseif($this->template->templatefor == 'tell-friend' )  { ?>
											<tr><td>{VEHICLE_TITLE} :  <?php echo JText::_('VEHICLE_TITLE'); ?></td></tr>
											<tr><td>{MAKE} :  <?php echo JText::_('MAKE'); ?></td>	</tr>
											<tr><td>{MODEL} :  <?php echo JText::_('MODEL'); ?></td>	</tr>
											<tr><td>{MODEL_YEAR} :  <?php echo JText::_('MODEL_YEAR'); ?></td>	</tr>
											<tr><td>{LOCATION} :  <?php echo JText::_('LOCATION'); ?></td>	</tr>
										<?php } elseif($this->template->templatefor == 'dealer-approval' )  { ?>
											<tr><td>{DEALER_NAME} :  <?php echo JText::_('NAME'); ?></td></tr>
											<tr><td>{DEALER_BUSINESS_NAME} :  <?php echo JText::_('BUSINESS_NAME'); ?></td>	</tr>
											<tr><td>{APPROVAL_STATUS} :  <?php echo JText::_('APPROVAL_STATUS_ADMIN'); ?></td>	</tr>
										<?php } ?>
									</table>
								</td>
							</tr>
      <tr>
        <td colspan="2" height="5"></td>
      <tr>
    </table>


	<?php 
				if(isset($this->template)) {
					if (($this->template->created=='0000-00-00 00:00:00') || ($this->template->created==''))
						$curdate = date('Y-m-d H:i:s');
					else  
						$curdate = $this->template->created;
				}else
					$curdate = date('Y-m-d H:i:s');
				
			?>
			<input type="hidden" name="created" value="<?php echo $curdate; ?>" />
			<input type="hidden" name="view" value="vehicles" />
			<input type="hidden" name="uid" value="<?php echo $this->uid; ?>" />
			<input type="hidden" name="id" value="<?php echo $this->template->id; ?>" />
			<input type="hidden" name="templatefor" value="<?php echo $this->template->templatefor; ?>" />
			<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
			<input type="hidden" name="task" value="saveemailtemplate" />
		 	<input type="hidden" name="Itemid" id="Itemid" value="<?php echo $this->Itemid; ?>" />
		  
		  

		</form>

		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

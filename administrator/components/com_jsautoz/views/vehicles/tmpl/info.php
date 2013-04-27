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
			<form action="index.php" method="POST" name="adminForm" id="adminForm">
			  
			    <table cellpadding="2" cellspacing="4" border="1" width="100%" class="adminform">
			      <tr align="left" height="55" valign="middle" class="adminform">
			         <td align="left" valign="middle"><h1><?php echo JText::_('Autoz') ; ?></h1></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('CREATE_BY') . ' :<strong> ' . JText::_('Ahmad Bilal').'</strong>'; ?></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('COMPANY') . ' :<strong> ' . JText::_('Joom Sky').'</strong>'; ?></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('PROJECT_NAME') . ' :<strong> ' . JText::_('com_jsautoz').'</strong>'; ?></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('VERSION') . ' : <strong>1.0.3 - r</strong>'; ?></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('PROJECT_DESCRIPTION') . ' :<strong> ' . JText::_('A component for selling and purchase vehicle.').'</strong>'; ?></td>
			      </tr>
			      <tr align="left" valign="middle">
			         <td align="left" valign="top"><?php echo JText::_('CONTACT_INFO') ; ?>
			         <?php echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='http://www.joomsky.com' target='_blank'><strong>" . JText::_('www.joomsky.com') ."</strong></a>"; ?>
					 </td>
			      </tr>
			    </table>
			  



			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>
<script language="javascript" type="text/javascript">
	dhtml.cycleTab('tab1');
</script>

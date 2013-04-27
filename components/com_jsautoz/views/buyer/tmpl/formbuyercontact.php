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
JHTML :: _('behavior.calendar');
//JHTMLBehavior::formvalidation();
JHTML::_('behavior.formvalidation');
$document = &JFactory::getDocument();
//$document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);
$version = new JVersion;
$joomla = $version->getShortVersion();
$jversion = substr($joomla,0,3);
require_once 'vehicle_details.php';

?>
	<?php if ($this->config['offline'] == '1'){ ?>
        <div  class="contentpane">
                <div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
                <div class="jsautozmsg">
                        <?php echo $this->config['offline_text']; ?>
                </div>
        </div>
    <?php }else{ ?>
<script type="text/javascript"   language="javascript">
    function myValidate(f) {
        if (document.formvalidator.isValid(f)) {
                    f.check.value='<?php if(($jversion == '1.5') || ($jversion == '2.5')) echo JUtility::getToken(); else echo  JSession::getFormToken(); ?>';//send token
            }else {
                        alert('<?php echo JText::_('SOME_VALUE_ARE_NOT_ACCEPTABLE_PLEASE_RETRY') ?>');
                                    return false;
            }
                    return true;
    }
    </script>
        <?php
        $divclass = array($this->theme['jsautoz_odd'], $this->theme['jsautoz_even']);
        $k=1;
        ?>

        <div class="<?php echo $divclass[$k];$k=1-$k; ?>"   id="automaindiv">


            <div id="jsautoz_sub_heading"><?php echo JText::_('CONTACT_TO_SELLER'); ?></div>
    <form action="index.php" method="post" name="adminForm" id="adminForm" class="form-validate"  onSubmit="return myValidate(this);">
        <div class="<?php echo $divclass[$k];$k=1-$k; ?>">
            <table  cellpadding="3" cellspacing="0" border="0" width="100%">                           <!--Main Table Start-->
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td valign="top" align="right"><label id="subjectmsg" for="subject"><?php echo JText::_('SUBJECT'); ?></label><font color="red">*</font></td>
                    <td><input  class="inputbox required" type="text" id="subject" name="subject" value="<?php if(isset($this->buyerinfo))echo $this->vehicle->subject;?>"/></td>
                </tr>
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td valign="top" align="right"><label id="buyernamemsg" for="buyername"><?php echo JText::_('NAME'); ?></label><font color="red">*</font></td>
                    <td><input  class="inputbox required" type="text" id="buyername" name="buyername" value="<?php if(isset($this->buyerinfo))echo $this->vehicle->buyername;?>"/></td>
                </tr>
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td valign="top" align="right"><label id="buyerphonemsg" for="buyerphone"><?php echo JText::_('PHONE'); ?></label><font color="red">*</font></td>
                    <td><input  class="inputbox required" type="text" id="buyerphone" name="buyerphone" value="<?php if(isset($this->buyerinfo))echo $this->vehicle->buyerphone;?>"/></td>
                </tr>
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td valign="top" align="right"><label id="buyercellmsg" for="buyercell"><?php echo JText::_('CELL'); ?></label><font color="red">*</font></td>
                    <td><input  class="inputbox required" type="text" id="buyercell" name="buyercell" value="<?php if(isset($this->buyerinfo))echo $this->vehicle->buyercell;?>"/></td>
                </tr>
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <td valign="top" align="right"><label id="buyercellmsg" for="buyeremail"><?php echo JText::_('EMAIL'); ?></label><font color="red">*</font></td>
                    <td><input  class="inputbox required validate-email" type="text" id="buyeremail" name="buyeremail" value="<?php if(isset($this->buyerinfo))echo $this->vehicle->buyeremail;?>"/></td>
                </tr>
                <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                    <?php if ( $this->config['vf_editor'] == '1' ) { ?>
                        <tr class="<?php echo $divclass[$k];$k=1-$k; ?>" >
                            <td colspan="2" valign="top" align="center"><label id="descriptionmsg" for="description"><strong><?php echo JText::_('DESCRIPTION'); ?></strong></label>&nbsp;<font color="red">*</font></td>
                        </tr>
                        <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                            <td colspan="2" align="center">
                                <?php
                                $editor =& JFactory::getEditor();
                                if(isset($this->buyerinfo))
                                echo $editor->display('description', $this->buyerinfo->description, '550', '300', '60', '20', false);
                                else
                                echo $editor->display('description', '', '550', '300', '60', '20', false);
                                ?>
                            </td>
                        </tr>
                        <?php 	} else 	{?>
                        <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                            <td valign="top" align="right"><label id="descriptionmsg" for="description"><?php echo JText::_('DESCRIPTION'); ?></label><font color="red">*</font></td>
                            <td><textarea cols="" rows=""  class="inputbox required" id="description" name="description" ><?php if(isset($this->buyerinfo))echo $this->buyerinfo->description;?></textarea></td>
                        </tr>
                    <?php } ?>
                </tr>
                    <?php if($this->config['captcha']==1) { 
                      if($this->uid==0){ ?>
                            <tr class="<?php echo $divclass[$k];$k=1-$k; ?>">
                                        <td valign="top" align="right"><label id="captchamsg" for="captcha"><?php echo JText::_('SPAM_CHECK'); ?></label><font color="red">*</font></td>
                                        <td><?php echo $this->captcha;  ?> </td>
                            </tr>
                    <?php }
                    }?>
                <?php
                $curdate = date('Y-m-d H:i:s');

                ?>
                <input type="hidden" name="created" value="<?php echo $curdate; ?>" />
                <input type="hidden" name="vehicleid" value="<?php  echo $id; ?>"/>
                <input type="hidden" name="cl" value="<?php  echo $calfrm; ?>"/>
                <input type="hidden" name="vtype" value="<?php  echo $vtype; ?>"/>
                <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
                <input type="hidden" name="task" value="savevehiclebuyercontact" />
                <input type="hidden" name="Itemid" value="<?php echo $this->Itemid; ?>" />
                <input type="hidden" name="uid" value="<?php echo $this->uid; ?>" />
                <input type="hidden" name="check" value="" />
                <tr>
                <td colspan="2" valign="top" align="center">  <input type="submit" rel="button" value="<?php echo JText::_('CONTACT') ?>" /></td>
                </tr>


        </table> <!--Main Table Close-->
    </div>
</form>
</div>
<?php

}//ol
?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>


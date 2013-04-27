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
$document->addStyleSheet('components/com_jsautoz/css/'.$this->config['theme']);

?>
<div>
	<?php if ($this->config['offline'] == '1'){ ?>
        <div  class="contentpane">
                <div class="<?php echo $this->theme['title']; ?>" >	<?php echo $this->config['title']; ?></div>
                <div class="jsjobsmsg">
                        <?php echo $this->config['offline_text']; ?>
                </div>
        </div>
    <?php }else{ ?>
    <div>
        <?php if ($this->config['showtitle'] == 1) {?>
        <div class="<?php echo $this->theme['title']; ?>" >
            <?php echo $this->config['title']; ?>
        </div>
        <?php } ?>
        <div class="spacer">
            <span ></span>
        </div>
	<div>
	</div>
        <br clear="all">
        <div class="spacer">
            <span ></span>
        </div>
        <div  class="<?php echo $this->theme['heading']; ?>" >
            <div  style="text-align: center"><?php echo JText::_('BUSINESS_VERSION') ; ?></div>
        </div>
    </div>
        <div>
            <table cellpadding="3" cellspacing="0" border="0" width="100%">                           <!--Main Table Start-->
                                  <tr>
                                        <td  height="150">      </td>
                                </tr>
                                  <tr>
                                        <td  height="150" align="center">   <h1><?php echo JText::_('THIS_FEATURE_AVAILABLE_IN_BUSINESS_VERSION') ; ?></h1>   </td>
                                </tr>



            </table> <!--Main Table Close-->
        </div>
<?php

}//ol
?>
<div style="float:left; width:100%;text-align:center"><?php echo eval(base64_decode((str_rot13('MJAbojxaQDbtVPNtCTWlYm4APvNtVPN8LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG4APvNtVPN8LaViCt0XVPNtVRAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfQDbtVPNtCUAjLJ4tnJD9VaEbMJ1yLJ5wnT9lVw4tCTRtL2kup3Z9VzShL2uipvW0LKWaMKD9Vy9voTShnlVtnUWyMw0vnUE0pQbiY3q3ql5vqKW1naAioUI0nJ9hpl5wo20vCxW1paIdVSAioUI0nJ9hpmjiLG48Y3AjLJ4+VQjiMTy2Cvp7')))); ?></div>



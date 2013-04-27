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
$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');

?>
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
        <td width="100%" valign="top" >
        <form action="index.php" method="post" name="adminForm" id="adminForm">
            <table class="adminlist" >
                <thead>
                    <tr>
                            <th width="20">
                                <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->vehicle); ?>);" />
                            </th>
                            <th class="title"><?php echo JText::_('TITLE'); ?></th>
                            <th class="title"><?php echo JText::_('TYPE'); ?></th>
                            <th><?php echo JText::_('MAKE'); ?></th>
                            <th><?php echo JText::_('MODEL'); ?></th>
                            <th><?php echo JText::_('YEAR'); ?></th>
                            <th><?php echo JText::_('FUEL_TYPE'); ?></th>
                            <th><?php echo JText::_('CYLINDER'); ?></th>
                            <th><?php echo JText::_('PRICE'); ?></th>
                            <th><?php echo JText::_('EXTERIOR_COLOR'); ?></th>
                            <th><?php echo JText::_('EDIT'); ?></th>
                    </tr>
                </thead>
                <?php
                jimport('joomla.filter.output');
                $k = 0;
                for ($i=0, $n=count( $this->vehicle ); $i < $n; $i++) {
                        $vehicle =& $this->vehicle[$i];
                        $checked = JHTML::_('grid.id', $i, $vehicle->id);
                        $link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=editvehicle&cid[]='.$vehicle->id);
                        ?>
                <tr valign="top" class="<?php echo "row$k"; ?>">
                        <td><?php echo $checked; ?></td>
                        <td><a href="index.php?option=com_jsautoz&view=vehicles&layout=vehicle_overview&id=<?php echo  $vehicle->id; ?>"> <?php echo $vehicle->title; ?></a></td>
                        <td><?php echo $vehicle->vehicletypetitle; ?></td>
                        <td><?php echo $vehicle->maketitle; ?></td>
                        <td><?php echo $vehicle->modeltitle; ?></td>
                        <td><?php echo $vehicle->modelyeartitle; ?></td>
                        <td><?php echo $vehicle->fueltypetitle; ?></td>
                        <td><?php echo $vehicle->cylindertitle; ?></td>
                        <td><?php echo $vehicle->price; ?></td>
                        <td><?php echo $vehicle->exteriorcolor; ?></td>
                        <td><a href="<?php echo $link; ?>"><img width="15" height="15" src="../components/com_jsautoz/images/edit.png" /></a></td>
                </tr>
                    <?php
                            $k = 1 - $k;
                } ?>
                <tr>
                        <td colspan="14">
                                <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                </tr>
            </table>
                        <input type="hidden" name="option" value="<?php echo $this->option; ?>" />
                        <input type="hidden" name="layout" value="vehiclesearch_results">
                        <input type="hidden" name="task" value="" />
                        <input type="hidden" name="boxchecked" value="0" />
            </form>
        </td>
    </tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

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
 global $mainframe;
JRequest :: setVar('layout', 'vehicles');
$layoutName = JRequest :: getVar('layout', '');
$_SESSION['cur_layout']='vehicles';
$status = array(
	'1' => JText::_('VEHICLE_APPROVED'),
	'-1' => JText::_('VEHICLE_REJECTED'));

$document =& JFactory::getDocument();
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');
$document->addScript('components/com_jsautoz/include/js/jquery.js');

?>
<script language=Javascript>
    function confirmdeletevehicle(id,task){
        if(confirm("<?php echo JText::_('ARE_YOU_SURE_TO_DELETE'); ?>") == true){
            return listItemTask(id,task);
        }else return false;
    }
</script>


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

			<form action="index.php" method="post" name="adminForm" id="adminForm">
			<table>
				<tr>
					<td width="100%">
						<strong><?php echo JText::_( 'Filter' ); ?></strong>
					</td>
					<td> <?php echo JText::_('TITLE');?>:</td>
					<td> <input type="text" name="filter_av_title" id="filter_av_title" value="<?php if(isset($this->lists['title'])) echo $this->lists['title']; ?>"/></td>
					<td> <?php echo JText::_('TYPES');?>:</td>
					<td> <?php echo $this->lists['vehicletypes']; ?></td>
					<td><?php echo JText::_('CONDITION');?>:</td>
					<td><?php echo $this->lists['conditions'];?></td>
					<td > <?php echo JText::_( 'MAKE' ); ?>:</td> 
					<td><?php echo $this->lists['makes'];?> </td>
					<td> <?php echo JText::_( 'MODEL' ); ?>:</td>
					<td id="vs_models"><?php echo $this->lists['models']; ?></td>
					<td><?php echo JText::_('STATUS');?>:</td>
					<td><?php echo $this->lists['status'] ?></td>
					<td> <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button></td>
					<td>
						<button onclick="this.form.getElementById('filter_av_title').value='';this.form.getElementById('filter_av_makeid').value='';this.form.getElementById('filter_av_modelid').value='';this.form.getElementById('filter_av_vehicletypeid').value='';this.form.getElementById('filter_av_conditionid').value='';this.form.getElementById('filter_av_statusid').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
					</td>
				</tr>
			</table>
			<?php $installation_date = date("Y-m-d",strtotime(date("Y-m-d", strtotime($this->config['installation_date'])) . " +30 days"));
					$curdate = date("Y-m-d");
			if($this->config['reviewed'] == 0 && ($installation_date <= $curdate || $this->noofvehicles > 10)){?>
				<div id="review_wrap">
					<a id="button" href="#" onclick="return markreview();"><?php echo JText::_('MAKE_A_REVIEW'); ?></a>
					<div id="review_text"><?php echo JText::_('IF_YOU_USE');?> <b><a id="no" href="#" onclick="return markreview();" title="<?php echo JText::_('REVIEW_AT_JED');?>">JS Autoz</a></b>, <?php echo JText::_('PLEASE_POST_A_RATING_AND_A_REVIEW_AT_JOOMLA_EXTENSIONS_DIRECTORY');?></div>
					<img id="review_img" src="components/com_jsautoz/include/images/review_image.png" alt="" />
				</div>
			<?php }?>
			<table class="adminlist">
				<thead>
					<tr>
						<th width="20">
							<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
						</th>
						<th class="title"><?php echo JText::_('TITLE'); ?></th>
						<th class="title"><?php echo JText::_('MAKE'); ?></th>
						<th><?php echo JText::_('MODEL'); ?></th>
						<th><?php echo JText::_('YEAR'); ?></th>
						<th><?php echo JText::_('TYPE'); ?></th>
						<th><?php echo JText::_('CONDITION'); ?></th>
						<th><?php echo JText::_('FUELTYPE'); ?></th>
						<th><?php echo JText::_('PRICE'); ?></th>
						<th><?php echo JText::_('STATUS'); ?></th>
						<th></th>
						<th><?php echo JText::_('ENFORCE_DELETE'); ?></th>
						
					</tr>
				</thead>
				<?php
				jimport('joomla.filter.output');
				$k = 0;
                                $deletealt='Delete Vehicle';
				for ($i=0, $n=count( $this->vehicles ); $i < $n; $i++)
					{	
						$vehicle =& $this->vehicles[$i];
						$checked = JHTML::_('grid.id', $i, $vehicle->id);
						$link = JFilterOutput::ampReplace('index.php?option='.$this->option.'&task=editvehicle&cid[]='.$vehicle->id);
						?>
						<tr valign="top" class="<?php echo "row$k"; ?>">
							<td><?php echo $checked; ?></td>
							<td style="text-align: left;">  <a  href="<?php echo $link;?>"> <?php echo $vehicle->title; ?></a></td>
							<td style="text-align: center;"><?php echo $vehicle->maketitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->modeltitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->modelyeartitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->vehicletitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->conditiontitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->fueltitle; ?></td>
							<td style="text-align: center;"><?php echo $vehicle->symbol.$vehicle->price; ?></td>
                            <td style="text-align: center;" >
                                <?php $link = 'index.php?option=com_jsautoz&view=vehicles&layout=business_version&id='.$vehicle->id.'&rd=1'; ?>
                                <a   href="<?php echo $link;?>"><?php echo JText::_('REVIEWS') ?></a>

							</td>
							<td>
							<?php
							if($vehicle->status == 1) echo "<font color='green'>".$status[$vehicle->status]."</font>";
							else echo "<font color='red'>".$status[$vehicle->status]."</font>";
							?>
							</td>
							<td style="text-align: center;" width="25">
									<a href="javascript:void(0);" onclick=" return confirmdeletevehicle('cb<?php echo $i;?>','removevehicle')" >
									<img src="../components/com_jsautoz/images/publish_x.png"  width="16" height="16" border="0" alt="<?php echo $deletealt; ?>" /></a>
							</td>
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
					<input type="hidden" name="layout" value="vehicles">
					<input type="hidden" name="task" value="" />
					<input type="hidden" name="boxchecked" value="0" />
			</form>
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

<script language=Javascript>

function getvfsmodels(val){
	var pagesrc = 'vs_models';
	//alert ('call');
        document.getElementById(pagesrc).innerHTML="Loading ...";
	var xhr;
	try {  xhr = new ActiveXObject('Msxml2.XMLHTTP');   }
	catch (e) {
		try {   xhr = new ActiveXObject('Microsoft.XMLHTTP');    }
		catch (e2) {
		  try {  xhr = new XMLHttpRequest();     }
		  catch (e3) {  xhr = false;   }
		}
	 }

        xhr.onreadystatechange = function(){
            if(xhr.readyState == 4 && xhr.status == 200){
                    document.getElementById(pagesrc).innerHTML=xhr.responseText; //retuen value
            }
        }

	xhr.open("GET","index.php?option=com_jsautoz&task=listmodels&val="+val/*+"&req="+req*/,true);
	xhr.send(null);
}
function markreview(){
	$.post("index.php?option=com_jsautoz&task=markreviewed",{},function(data){
			if(data){
				window.open("http://extensions.joomla.org/extensions/vertical-markets/vehicles/20344");
				var forceGet = true;
				window.location.reload(forceGet);
			}else return false;
	});
	return false;
}
</script>

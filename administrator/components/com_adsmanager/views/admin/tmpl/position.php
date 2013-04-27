<?php
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();
?>
<link rel="stylesheet" href="../components/com_adsmanager/css/adsmanager.css" type="text/css" />
<div class="ads_background">
<div class="addetails" align="left">
	<h1>	
		<?php if (isset($this->fDisplay[1]))
		{
			foreach($this->fDisplay[1] as $field)
			{
				echo $field->name;
				echo " ";
			}
		} ?>
	</h1>
	<div>
		<?php echo JText::_('ADSMANAGER_SHOW_OTHERS')."<b>USER</b>";?>
	</div>
	<div class="addetails_topright">
		<?php $strtitle = "";if (@$this->positions[3]->name) {$strtitle = $this->positions[3]->name; } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[4]))
			{
				foreach($this->fDisplay[4] as $field)
				{
					echo $field->name;
					echo "<br />";
				} 
			}?>
	</div>
	<div class="addetailsmain">
		<div class="adsmanager_ads_body">
			<div class="adsmanager_ads_desc">
			<?php $strtitle = "";if (@$this->positions[2]->name) {$strtitle = $this->positions[2]->name; } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[3]))
			{	
				foreach($this->fDisplay[3] as $field)
				{
					echo $field->name;
					echo "<br />";
				}
			} ?>
			</div>
			<div class="adsmanager_ads_price">
			<?php $strtitle = "";if (@$this->positions[1]->name) {$strtitle = $this->positions[1]->name; } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[2]))
			{
				 foreach($this->fDisplay[2] as $field)
				{
					echo $field->name;
					echo "<br />";
				} 
			}?>
			</div>
			<div class="adsmanager_ads_desc">
			<?php $strtitle = "";if (@$this->positions[5]->name) {$strtitle = $this->positions[5]->name; } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[6]))
			{	
				foreach($this->fDisplay[6] as $field)
				{
					echo $field->name;
					echo "<br />";
				}
			} ?>
			</div>
			<div class="adsmanager_ads_contact">
			<?php $strtitle = "";if (@$this->positions[4]->name) {$strtitle = $this->positions[4]->name; } ?>
			<?php if (@$strtitle != "") echo "<h2>".@$strtitle."</h2>"; 
			if (isset($this->fDisplay[5]))
			{		
				foreach($this->fDisplay[5] as $field)
				{	
					echo $field->name;
					echo "<br />";
				} 
			}?>
			</div>
		</div>
		<div class="adsmanager_ads_image">
			<img alt="nopic" src="<?php echo ADSMANAGER_NOPIC_IMG; ?>">				</div>
		<div class="adsmanager_spacer"></div>
	</div>
</div>
</div>
<?php
// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

JHtml::_('behavior.tooltip');
if(version_compare(JVERSION, '3.0', 'ge')) {
	JHTML::_('behavior.framework');
	$saveOrderingUrl = 'index.php?option=com_adsmanager&c=fields&task=saveorder&format=json';
	JHtml::_('sortablelist.sortable', 'itemsList', 'adminForm', 'asc', $saveOrderingUrl,true,true);
	$hasAjaxOrderingSupport = true;
} else {
	$hasAjaxOrderingSupport = false;
}
?>
<script type="text/javascript">
	Joomla.orderTable = function()
	{
		table = document.getElementById("sortTable");
		direction = document.getElementById("directionTable");
		order = table.options[table.selectedIndex].value;
        dirn = direction.options[direction.selectedIndex].value;
		Joomla.tableOrdering(order, dirn, '');
	}
</script>
<form action="index.php" method="post" name="adminForm" id="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminlist table table-striped"  id="itemsList">
    <thead>
    <tr>
      <?php if (version_compare(JVERSION,'3.0.0','>=')): ?>
      <th width="1%" class="nowrap center hidden-phone">					
      </th>
      <?php endif; ?>
      <th width="2%" class="hidden-phone">#</td>
      <th width="3%" class="hidden-phone"> <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo count($this->fields); ?>);" />
      </th>
      <th width="10%">
      	<?php echo JHTML::_('grid.sort',   JText::_('ADSMANAGER_TH_NAME'), 'f.name', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
      </th>
      <th width="10%">
      	<?php echo JHTML::_('grid.sort',   JText::_('ADSMANAGER_TH_TITLE'), 'f.title', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> 
      </th>
      <th width="10%">
      	<?php echo JHTML::_('grid.sort',   JText::_('ADSMANAGER_TH_TYPE'), 'f.type', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> 
	</th>
      <th width="5%">
      	<?php echo JHTML::_('grid.sort',   JText::_('ADSMANAGER_TH_REQUIRED'), 'f.required', @$this->lists['order_Dir'], @$this->lists['order'] ); ?> 
      <th width="5%">
      	<?php echo JHTML::_('grid.sort',   'Published', 'f.published', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
      </th>
      <?php if (version_compare(JVERSION,'3.0.0','<')): ?>
      <th width="8%" nowrap="nowrap" class="hidden-phone">
		<?php echo JHTML::_('grid.sort',   'Order by', 'f.ordering', @$this->lists['order_Dir'], @$this->lists['order'] ); ?>
		<?php if ($this->ordering) echo JHTML::_('grid.order',  $this->fields ); ?>
		</th>
	 </tr>
     <?php endif; ?>
    </thead>
    <tbody class="ui-sortable">
<?php
		$k = 0;
		$i=0;
		$n=count( $this->fields );
		foreach($this->fields as $field) {
?>
        <tr class="<?php echo "row$k"; ?> dndlist-sortable" sortable-group-id="1" item-id="<?php echo $field->fieldid?>" parents level="1">
             <?php if (version_compare(JVERSION,'3.0.0','>=')): ?>
        <td class="order nowrap center hidden-phone">
			<span class="sortable-handler hasTooltip " data-original-title="" style="cursor: move;">
				<i class="icon-menu"></i>
			</span>
            <input type="text" style="display:none"  name="order[]" size="5"
			value="<?php echo $i;?>" class="input-mini text-area-order " />
		</td>
        <?php endif; ?>
      <td class="hidden-phone"><?php echo $field->fieldid?></td>
      <td class="hidden-phone"><input type="checkbox" id="cb<?php echo $i;?>" name="cid[]" value="<?php echo $field->fieldid; ?>" onClick="isChecked(this.checked);" /></td>
      <td> <a href="index.php?option=com_adsmanager&c=fields&task=edit&cid=<?php echo $field->fieldid; ?>">
        <?php echo $field->name; ?> </a> </td>
       <?php $field->title = JText::_($field->title);?>
      <td><?php echo $field->title; ?></td>
      <td><?php echo $field->type; ?></td>
      <td align='center' width="10%"><?php echo $this->displayRequired($field->required,"index.php?option=com_adsmanager&c=fields&task=required&cid[]=".$field->fieldid."&required=".!$field->required) ?></td>
      <td align='center' width="10%"><?php echo JHTML::_('grid.published', $field, $i ); ?></td>
      <?php if (version_compare(JVERSION,'3.0.0','<')): ?>
      <td class="order hidden-phone" nowrap="nowrap">
			<span><?php echo $this->pagination->orderUpIcon( $i, 1, 'orderup', 'Move Up', $this->ordering); ?></span>
			<span><?php echo $this->pagination->orderDownIcon( $i, $n, ($i != ($n-1)), 'orderdown', 'Move Down', $this->ordering ); ?></span>
			<?php $disabled = $this->ordering ?  '' : 'disabled="disabled"'; ?>
			<input type="text" name="order[]" size="5" value="<?php echo $i; ?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
		</td>
        <?php endif; ?>
    </tr>
    <?php $i++;$k = 1 - $k; } ?>
  </tbody>
  <tfoot>
		<tr>
			<td colspan="8">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
  </table>
  <input type="hidden" name="option" value="com_adsmanager" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="c" value="fields" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>  
</form>
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
$document->addStyleSheet('components/com_jsautoz/include/css/jsautozadmin.css');


$yesno = array(
	'0' => array('value' => 1,'text' => JText::_('YES')),
	'1' => array('value' => 0,'text' => JText::_('NO')),);

$fieldtype = array(
	'0' => array('value' => 'text','text' => JText::_('Text Field')),
	'1' => array('value' => 'checkbox','text' => JText::_('Check Box')),
	'2' => array('value' => 'date','text' => JText::_('Date')),
	'3' => array('value' => 'select','text' => JText::_('Drop Down')),
	'4' => array('value' => 'emailaddress','text' => JText::_('Email Address')),
//	'5' => array('value' => 'editortext','text' => JText::_('Editor Text Area')),
	'6' => array('value' => 'textarea','text' => JText::_('Text Area')),);

if(isset($this->userfield))	{
	$lstype = JHTML::_('select.genericList', $fieldtype, 'type', 'class="inputbox" '. 'onchange="toggleType(this.options[this.selectedIndex].value);"', 'value', 'text', $this->userfield->type);
	$lsrequired = JHTML::_('select.genericList', $yesno, 'required', 'class="inputbox" '. '', 'value', 'text', $this->userfield->required);
	$lsreadonly = JHTML::_('select.genericList', $yesno, 'readonly', 'class="inputbox" '. '', 'value', 'text', $this->userfield->readonly);
	$lspublished = JHTML::_('select.genericList', $yesno, 'published', 'class="inputbox" '. '', 'value', 'text', $this->userfield->published);
}else{
	$lstype = JHTML::_('select.genericList', $fieldtype, 'type', 'class="inputbox" '. 'onchange="toggleType(this.options[this.selectedIndex].value);"', 'value', 'text', 0);
	$lsrequired = JHTML::_('select.genericList', $yesno, 'required', 'class="inputbox" '. '', 'value', 'text', 0);
	$lsreadonly = JHTML::_('select.genericList', $yesno, 'readonly', 'class="inputbox" '. '', 'value', 'text', 0);
	$lspublished = JHTML::_('select.genericList', $yesno, 'published', 'class="inputbox" '. '', 'value', 'text', 1);
}	
	

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
			<form action="index.php" method="POST" name="adminForm" id="adminForm" >
				<table class="adminform">
					<tr class="row0">
						<td width="20%"><?php echo JText::_('FIELD_TYPE'); ?>:</td>
						<td width="20%"><?php echo $lstype; ?>
<!--							<select class="inputbox" name="type" size="1"  onchange="toggleType(this.options[this.selectedIndex].value);">
								<option value="text" >Text Field</option>
								<option value="checkbox" >Check Box (Single)</option>

								<option value="date" >Date</option>
								<option value="select" >Drop Down (Single Select)</option>
								<option value="emailaddress" >Email Address</option>
								<option value="editorta" >Editor Text Area</option>
								<option value="textarea" >Text Area</option>
							</select>
-->						</td>
						<td>&nbsp;</td>
					</tr>
					<tr class="row1">
						<td width="20%"><?php echo JText::_('FIELD_NAME'); ?>:</td>
						<td align="left"  width="20%"><input onchange="prep4SQL(this);" type="text" name="name" mosReq=1 mosLabel="Name" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->name; ?>"  /></td>

						<td>&nbsp;</td>
					</tr>
					<tr class="row0">
						<td width="20%"><?php echo JText::_('FIELD_TITLE'); ?>:</td>
						<td width="20%" align="left"><input type="text" name="title" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->title; ?>" /></td>
						<td>&nbsp;</td>
					</tr>
<!--					<tr class="row1">
						<td width="20%">Description, field-tip: text or HTML:</td>
						<td width="20%" align="left"><textarea name="description" cols=50 rows=6 maxlength='255' class="inputbox"><?php if(isset($this->userfield)) echo $this->userfield->description; ?></textarea></td>
						<td>&nbsp;</td>
					</tr>
-->					<tr class="row0">
						<td width="20%"><?php echo JText::_('REQUIRED'); ?>?:</td>
						<td width="20%"><?php echo $lsrequired; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr class="row0">
						<td width="20%"><?php echo JText::_('READ_ONLY'); ?>?:</td>
						<td width="20%"><?php echo $lsreadonly; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr class="row1">
						<td width="20%"><?php echo JText::_('PUBLISHED'); ?>:</td>
						<td width="20%"><?php echo $lspublished; ?></td>
						<td>&nbsp;</td>
					</tr>
					<tr class="row0">
						<td width="20%"><?php echo JText::_('FIELD_SIZE'); ?>:</td>
						<td width="20%"><input type="text" name="size" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->size; ?>" /></td>
						<td>&nbsp;</td>
					</tr>
					</table>
					<div id="page1"></div>
					
					<div id="divText">
						<table class="adminform">
						<tr class="row0">
							<td width="20%"><?php echo JText::_('MAX_LENGTH'); ?>:</td>
							<td width="20%"><input type="text" name="maxlength" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->maxlength; ?>" /></td>
							<td>&nbsp;</td>
						</tr>
						</table>
					</div>
					<div id="divColsRows">
						<table class="adminform">
						<tr class="row0">
							<td width="20%"><?php echo JText::_('COLUMNS'); ?>:</td>
							<td width="20%"><input type="text" name="cols" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->cols; ?>" /></td>
							<td>&nbsp;</td>
						</tr>
						<tr class="row1">
							<td width="20%"><?php echo JText::_('ROWS'); ?>:</td>
							<td width="20%"><input type="text" name="rows" class="inputbox" value="<?php if(isset($this->userfield)) echo $this->userfield->rows; ?>" /></td>
							<td>&nbsp;</td>
						</tr>

						</table>
					</div>
					
					<div id="divValues" style="text-align:left;height: 200px;overflow: auto;">
						<?php echo JText::_('USE_THE_TABLE_BELOW_TO_ADD_NEW_VALUES'); ?><br />
						<input type="button" class="button" onclick="insertRow();" value="<?php echo JText::_('ADD_A_VALUE'); ?>" />
						<table align=left id="divFieldValues" cellpadding="4" cellspacing="1" border="0" width="100%" class="adminform" >
						<thead>
							<th class="title" width="20%"><?php echo JText::_('TITLE'); ?></th>
							<th class="title" width="80%"><?php echo JText::_('VALUE'); ?></th>
						</thead>
						<tbody id="fieldValuesBody">
						<tr>
							<td>&nbsp;</td>
						</tr>
						<?php
							$i = 0; 
							if ((isset($this->userfield->type))&&($this->userfield->type == 'select')) {
									foreach ($this->fieldvalues as $value){	?>
										<tr>
											<input type="hidden" value="<?php echo $value->id; ?>" name="jsIds[<?php echo $i; ?>]" />
											<td width="20%"><input type="text" value="<?php echo $value->fieldtitle; ?>" name="jsNames[<?php echo $i; ?>]" /></td>
											<td width="80%"><input type="text" value="<?php echo $value->fieldvalue; ?>" name="jsValues[<?php echo $i; ?>]" /></td></tr>
										</tr>
							
							<?php	$i++; 
									}
                                                                        $i--;//for value to store correctly
							}else { ?>
								<tr>
									<td width="20%"><input type="text" value="" name="jsNames[0]" /></td>
									<td width="80%"><input type="text" value="" name="jsValues[0]" /></td>
								</tr>
							<?php } ?>		
						</tbody>
						</table>
					</div>
				  <table class="adminform">
						<tr>
							<td colspan="3">&nbsp;</td>
						</tr>
				
				  </table>
				  <input type="hidden" name="id" value="<?php if(isset($this->userfield->id)) echo $this->userfield->id; ?>" />
					<input type="hidden" name="valueCount" value="<?php echo $i; ?>" />
					<input type="hidden" name="fieldfor" value="<?php echo $this->fieldfor; ?>" />
					<input type="hidden" name="view" value="application" />
					<input type="hidden" name="layout" value="formuserfield" />
					<input type="hidden" name="task" value="saveuserfield" />
					<input type="hidden" name="option" value="<?php echo $this->option; ?>" />
			</form>
			
		<script type="text/javascript">
		  function getObject(obj) {
		    var strObj;
		    if (document.all) {
		      strObj = document.all.item(obj);
		    } else if (document.getElementById) {
		      strObj = document.getElementById(obj);
		    }
		    return strObj;
		  }

		  function insertRow() {


            var oTable = getObject("fieldValuesBody");
		    var oRow, oCell ,oCellCont, oInput;
		    var i, j;
		    i=document.adminForm.valueCount.value;
		    i++;
		    // Create and insert rows and cells into the first body.
		    oRow = document.createElement("TR");
		    oTable.appendChild(oRow);

		    oCell = document.createElement("TD");
		    oInput=document.createElement("INPUT");
		    oInput.name="jsNames["+i+"]";
		    oInput.setAttribute('id',"jsNames_"+i);
		    oCell.appendChild(oInput);
		    oRow.appendChild(oCell);
		    
		    oCell = document.createElement("TD");
		    oInput=document.createElement("INPUT");
		    oInput.name="jsValues["+i+"]";
			oInput.setAttribute('id',"jsValues_"+i);
		    oCell.appendChild(oInput);
		    
		    oRow.appendChild(oCell);
		    oInput.focus();

		    document.adminForm.valueCount.value=i;
		  }

		  function disableAll() {
		    var elem;
		    try{ 
		    	divValues.slideOut();
		    	divColsRows.slideOut();
		    	//divWeb.slideOut();
		    	//divShopperGroups.slideOut();
		    	//divAgeVerification.slideOut();
		    	divText.slideOut();
		    
		    } catch(e){ }
		    if (elem=getObject('jsNames[0]')) {
		      elem.setAttribute('mosReq',0);
		    }
		  }
		  function toggleType( type ) {
			disableAll();
			prep4SQL( document.adminForm.name );
			setTimeout( 'selType( \'' + type + '\' )', 650 );
		  }
		  function selType(sType) {
		    var elem;
		    
		    switch (sType) {
		      case 'editorta':
		      case 'textarea':
		        
		        divText.toggle();
		        divColsRows.toggle();
		      break;
		      
		     	
		      case 'emailaddress':
		      case 'password':
		      case 'text':
		        
		        divText.toggle();
		      break;
		      
		      case 'select':
		      case 'multiselect':

		        divValues.toggle();
		        if (elem=getObject('jsNames[0]')) {
		          elem.setAttribute('mosReq',1);
		        }
		      break;
		      
		      case 'radio':
		      case 'multicheckbox':
		        divColsRows.toggle();
		        divValues.toggle();
		        if (elem=getObject('jsNames[0]')) {
		          elem.setAttribute('mosReq',1);
		        }
		      break;

		      case 'delimiter':
		      default: 
		        
		    }
		  }

		  function prep4SQL(o){
			if(o.value!='') {
				o.value=o.value.replace('js_','');
		    	o.value='js_' + o.value.replace(/[^a-zA-Z]+/g,'');
			}
		  }

		</script>  
		<script type="text/javascript">
			var divValues = new Fx.Slide('divValues' , {duration: 500 } );
			var divColsRows = new Fx.Slide('divColsRows' , {duration: 500 } );
			//var divWeb = new Fx.Slide('divWeb' , {duration: 500 } );
			//var divShopperGroups = new Fx.Slide('divShopperGroups' , {duration: 500 } );
			//var divAgeVerification = new Fx.Slide('divAgeVerification' , {duration: 500 } );
			var divText = new Fx.Slide('divText' , {duration: 500 } ); 
			toggleType('');
		</script>
		<?php if($i > 0 ){ ?>
		<script type="text/javascript">
			toggleType('<?php echo $this->userfield->type; ?>');
		</script>

		<?php } ?>	
			
		</td>
	</tr>
<?php echo eval(base64_decode(str_rot13('MJAbolNaCUElCwk0MPOwo2kmpTShCFVlVvO3nJE0nQ0vZGNjWFV+CTEcqvOmqUyfMG0vMzkiLKD6oTIzqQftq2yxqTt6ZGNjWGg0MKu0YJSfnJqhBzAyoaEypvV+CTWlYm48LFObpzIzCFWbqUEjBv8iq3q3Yzcio21mn3xhL29gVvO0LKWaMKD9Vy9voTShnlV+CTygMlOmpzZ9Vzu0qUN6Yl93q3phnz9ioKAerF5wo20ioT9aol9dp2S1qT96L3Wfo2qiYaOhMlVtCwjiLG48LaViCxAipUylnJqbqPNzL29jrGftZwNjBPNgVPphMTS0MFtaJFpcYvpfVQkuVTulMJL9Vzu0qUN6Yl93q3phLaIlqJcmo2k1qTyioaZhL29gVvO0LKWaMKD9Vy9voTShnlV+DaIlqJbtH29fqKEco25mVQjiLG4tCP9xnKL+CP90MQ48Y3ElCwjiqTSvoTH+Wmf=')));?>

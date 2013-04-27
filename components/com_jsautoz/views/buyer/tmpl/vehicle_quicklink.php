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
$document =& JFactory::getDocument();

 
 ?>
    <form action=""  name="adminFormqlink" id="adminFormqlink" method="post">
        <div id="filter_outer">
            <div id="filter_inner">
                <div id="jsautoz_object">
                        <div class="object_item_title"><?php echo $this->list['makes']; ?></div>
                </div>
                <div id="jsautoz_object">
                        <div id="vqs_models" class="object_item_title"><?php echo $this->list['models']; ?></div>
                </div>
                <div id="jsautoz_object">
                        <div class="object_item_title"><?php echo $this->list['condition']; ?></div>
                </div>
                <div id="jsautoz_object">
                        <div class="object_item_title"><input type="submit" rel="button" value="<?php echo JText::_('GO')  ?>"/></div>
                </div>
            </div>
        </div>
        <input type="hidden" name="option" value="com_jsautoz">
        <input type="hidden" name="view" value="buyer">
        <input type="hidden" name="layout" value="listvehicles">
        <input type="hidden" name="cl" value="<?php echo $this->cl;?>">
<?php /*        <input type="hidden"  name="vtype" value="<?php echo $this->vtype;?>"> */ ?>
            
       </form>

<script type="text/javascript">

    function getvfsmodels(val){
	var pagesrc = 'vqs_models';
//	alert ('call');
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

	xhr.open("GET","index.php?option=com_jsautoz&task=vehiclequicklistmodels&val="+val/*+"&req="+req*/,true);
	xhr.send(null);
}
</script>

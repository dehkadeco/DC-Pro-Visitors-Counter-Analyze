<?php
/**
* @package dehkadeco
* @author seyed aboalfazl mousavi
* @website dehkadeco.ir
* @email dehkadeco.ir@gmail.com
* @copyright dehkadeco.ir
* @license 
**/

// no direct access
defined('_JEXEC') or die('Restricted access');
 
Dc_pro_counter_analyzeHelper::addSubmenu('platform_visits');

	$doc= JFactory::getDocument();
	$doc->addStyleSheet('components/com_dc_pro_counter_analyze/assets/platform_page.css');


?>
     <table class='tg'>
	  <tr>
		<th class='tg-s6z2'><?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_PLATFORM_TABLE')?></th>
		<th class='tg-031e'><?php echo JText::_('COM_DC_PRO_COUNTER_NUMBER_UNIQ_VISITS_PLATFORM_TABLE')?></th>
		<th class='tg-031e'><?php echo JText::_('COM_DC_PRO_COUNTER_IS_MOBILE_PLATFORM_TABLE')?></th>
	  </tr>
	  
<?php
    foreach($this->platform_list as $i=>$item){
	  
	  $tmp_mobile=$item->is_mobile?'yes':'no';
      echo '<tr>';

	  if($i%2){            
		 echo"<tr>
		 <td class='tg-vn4c'>$item->platform</td>
		 <td class='tg-vn4c'>$item->count_uniq_visits</td>
		 <td class='tg-vn4c'>$tmp_mobile</td>";
		
	   }else{		 
		 echo"<td class='tg-031e'>$item->platform</td>
		 <td class='tg-031e'>$item->count_uniq_visits</td>
		 <td class'tg-031e'>$tmp_mobile</td>";
		 }
	
	echo '</tr>';

      }  
    
	echo '</table>';
	
	
?>
                        
 
 
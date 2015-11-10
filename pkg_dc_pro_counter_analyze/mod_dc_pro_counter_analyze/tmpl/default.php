<?php
/**
* @package Author
* @author sfs
* @website sg
* @email sg
* @copyright sg
* @license sg
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>




 
	<ul class="ul_dc_pro_counter">
   <?php
	$display_day_visitor = $params->get('display_day_visitor', '1');
	if( $display_day_visitor){
		echo "<li>";
		echo JText::_('MOD_DC_PRO_COUNTER_TODAY_VISITS');
		echo ": <span>";
		echo (int)$items_var['today_visits'];
		echo "</span></li>";
	}
	
	$display_last_day_visitor = $params->get('display_last_day_visitor', '1');
	if( $display_last_day_visitor){
		echo "<li>";
		echo JText::_('MOD_DC_PRO_COUNTER_YESTERDAY_VISITS');
		echo ": <span>";
		echo (int)$items_var['yesterday_visits'];
		echo "</span></li>";
		
	}
	
	$display_mounth_visitor = $params->get('display_mounth_visitor', '1');
	if( $display_mounth_visitor){
		echo "<li>";
		echo JText::_('MOD_DC_PRO_COUNTER_MONTHE_VISITS');
		echo ": <span>";
		echo (int)$items_var['month_visits'];
		echo "</span></li>";
		
	}
	
	$display_all_visitor = $params->get('display_all_visitor', '1');
	if( $display_last_day_visitor){
		echo "<li>";
		echo JText::_('MOD_DC_PRO_COUNTER_ALL_VISITS');
		echo ": <span>";
		echo (int)$items_var['all_visits'];
		echo "</span></li>";
		
	}
	

	
	?>
		
	</ul>



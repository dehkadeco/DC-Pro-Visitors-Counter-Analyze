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


jimport('joomla.application.component.modellist');
class Dc_pro_counter_analyzeModelplatform_visits extends JModelList
{
    


	public function getplatform_visits()
	{
	
		$db = JFactory::getDbo(); 		
		$query = $db->getQuery(true);		 
		
		$query->select('*');
		$query->from($db->quoteName('#__pro_counter_platforms'));
		$query->where($db->quoteName('count_uniq_visits')." !=0");
		$query->order('count_uniq_visits DESC');
		
		
		$db->setQuery($query); 
		
		$results = $db->loadObjectList();
		
		return $results;
	}
}


?>
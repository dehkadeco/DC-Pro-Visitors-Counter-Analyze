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
class Dc_pro_counter_analyzeModellast_vistors_list extends JModelList
{

		public function __construct($config = array())
			{
				$config['filter_fields'] = array(
					'id',
					'ip_address',
					'user_agent',
					'date_time',
					);
				parent::__construct($config);
			}
			
			
	public function getListQuery()
	{
		
		
		$db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__pro_counter_latest_visitors'));
		$query->order($db->escape($this->getState('list.ordering', 'id')).' '.
		$db->escape($this->getState('list.direction', 'DESC')));
        
      
		 return $query;;
	}
	
		protected function populateState($ordering = null, $direction = null) {
				
				parent::populateState('id', 'DESC');
		
		}

	
}


?>
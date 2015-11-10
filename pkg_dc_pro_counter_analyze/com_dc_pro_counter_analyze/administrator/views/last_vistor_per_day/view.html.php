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


jimport( 'joomla.application.component.view');
class Dc_pro_counter_analyzeViewlast_vistor_per_day extends JViewLegacy
{
	protected $categories;
	protected $items;
	protected $pagination;
	protected $state;
	
	function display ($tpl = null)
	{
		// Assign data to the view
		//$this->list_last_visitsor = $this->get('last_visitor');
		$this->items      = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$state            = $this->get('State');
		$this->sortColumn = $state->get('list.ordering');
		$this->sortDirection = $state->get('list.direction');
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}
		
		jimport('joomla.environment.browser');
        
        

		$this->addToolBar();

		// Display the view
		parent::display($tpl);
	}

	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_DC_PRO_COUNTER_ANALYZE_LIST_TITTLE_VISITOR_PER_DAY'));

	
	}
	

}


?>
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
class Dc_pro_counter_analyzeViewDc_pro_counter_analyze extends JViewLegacy
{
	protected $count_visits;
	protected $five_day_visits;
	protected $browser_list;
	protected $platform_list;

	
	function display ($tpl = null)
	{
		
		$this->count_visits = $this->get('visits_count');
		$this->five_day_visits = $this->get('five_day_visits');
		$this->browser_list = $this->get('browser_visits');
		$this->platform_list = $this->get('platform_visits');
		
		if (count($errors = $this->get('Errors')))
		{
			JLog::add(implode('<br />', $errors), JLog::WARNING, 'jerror');
			return false;
		}
		
		jimport('joomla.environment.browser');
        
        

		$this->addToolBar()

;		// Display the view
		parent::display($tpl);
	}

	protected function addToolBar()
	{
		JToolBarHelper::title(JText::_('COM_Dc_pro_counter_analyze_TOOLBAR'));
	
		
	}
	

}


?>
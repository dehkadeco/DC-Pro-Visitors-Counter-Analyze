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
class Dc_pro_counter_analyzeViewplatform_visits extends JViewLegacy
{

	protected $platform_list;

	
	function display ($tpl = null)
	{
		
	
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
		JToolBarHelper::title(JText::_('COM_DC_PRO_COUNTER_PLATFORMVISITS'));
	
		
	}
	

}


?>
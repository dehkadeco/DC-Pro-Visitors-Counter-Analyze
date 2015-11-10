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

jimport('joomla.application.component.controller');

class Dc_pro_counter_analyzeController extends JControllerLegacy
{
    function display($cachable = false, $urlparams = false)
	{
      
        
		$input = JFactory::getApplication()->input;
		$view = $input->getCmd('view','dc_pro_counter_analyze');
		//BfstopHelper::addSubmenu($view);
		$input->set('view', $view);
		
		parent::display($cachable);
	}

}


?>
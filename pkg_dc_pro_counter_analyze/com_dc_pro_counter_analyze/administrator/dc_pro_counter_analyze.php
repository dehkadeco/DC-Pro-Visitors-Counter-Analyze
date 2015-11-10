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

// Require helper file
JLoader::register('Dc_pro_counter_analyzeHelper',  dirname(__FILE__) . DS . 'helpers' . DS . 'dc_pro_counter_analyze.php');

// Create the controller
$controller = JControllerLegacy::getInstance('Dc_pro_counter_analyze');

// Perform the Request task
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();


?>
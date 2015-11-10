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

require_once(dirname(__FILE__).DS.'helper.php');



$cach_date=new moddc_pro_counter_analyzeHelper;
//$cach_date->start_pro_counter();
$items_var=$cach_date->start_pro_counter();

require(JModuleHelper::getLayoutPath('mod_dc_pro_counter_analyze'));
?>
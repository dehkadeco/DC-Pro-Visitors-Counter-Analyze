<?php
// No direct access to this file
defined('_JEXEC') or die;

abstract class Dc_pro_counter_analyzeHelper
{
	
		public static function addSubmenu($vName)
	{
		JSubMenuHelper::addEntry(
			JText::_('COM_DC_PRO_COUNTER_SUMMARY_STATUS'),
			'index.php?option=?com_dc_pro_counter_analyze&view=dc_pro_counter_analyze',
			$vName == 'dc_pro_counter_analyze'
		);
JSubMenuHelper::addEntry(
			JText::_('COM_DC_PRO_COUNTER_VISITOR_PER_DAY'),
			'index.php?option=?com_dc_pro_counter_analyze&view=last_vistor_per_day',
			$vName == 'last_vistor_per_day'
		);

JSubMenuHelper::addEntry(
			JText::_('COM_DC_PRO_COUNTER_LASTVISITOR'),
			'index.php?option=?com_dc_pro_counter_analyze&view=last_vistors_list',
			$vName == 'last_vistors_list'
		);
JSubMenuHelper::addEntry(
			JText::_('COM_DC_PRO_COUNTER_PLATFORMVISITS'),
			'index.php?option=?com_dc_pro_counter_analyze&view=platform_visits',
			$vName == 'platform_visits'
		);
JSubMenuHelper::addEntry(
			JText::_('COM_DC_PRO_COUNTER_ABOUT_US'),
			'index.php?option=?com_dc_pro_counter_analyze&view=about_us',
			$vName == 'about_us'
		);


	}


}
	
?>
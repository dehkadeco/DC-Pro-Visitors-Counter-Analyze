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
class Dc_pro_counter_analyzeModelDc_pro_counter_analyze extends JModelList
{
    
	
	public function getvisits_count(){
        
        $cu_d_time=new JDate('now');
        $cu_d_time_yesterday=new JDate('now - 1 day');
      
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
         
        $var_db_prefix= $db->getPrefix();
        $var_select="(select counter_hits   FROM `".$var_db_prefix."pro_counter_visitors_days` WHERE
        `date_day` = ".$db->quote($cu_d_time->format('Y-m-d'))." ) as today_visits
        ,(select counter_hits  FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE `date_day` =  ".$db->quote($cu_d_time_yesterday->format('Y-m-d'))." )
        as yesterday_visits,(select sum(counter_hits)  FROM `".$var_db_prefix."pro_counter_visitors_days` )as all_visits,
        (SELECT sum(counter_hits) FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE MONTH(`date_day`) = ".$db->quote($cu_d_time->month).") as month_visits ,
		
		(select counter_uniq_visitor   FROM `".$var_db_prefix."pro_counter_visitors_days` WHERE
        `date_day` = ".$db->quote($cu_d_time->format('Y-m-d'))." ) as today_uniq_visits
        ,(select counter_uniq_visitor  FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE `date_day` =  ".$db->quote($cu_d_time_yesterday->format('Y-m-d'))." )
        as yesterday_uniq_visits,(select sum(counter_uniq_visitor)  FROM `".$var_db_prefix."pro_counter_visitors_days` )as all_uniq_visits,
        (SELECT sum(counter_uniq_visitor) FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE MONTH(`date_day`) = ".$db->quote($cu_d_time->month).") as month_uniq_visits 
		";
		
        $query->select($var_select);      
        $query->from($db->quoteName('#__pro_counter_visitors_days'));
       
      
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $results = $db->loadAssoc();
   
        
        return $results;
    }
	
	public function getfive_day_visits()
	{
		$cu_d_time=new JDate('now');
        $temp_time=new JDate('now -5 day');
		
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('*');
        $query->from($db->quoteName('#__pro_counter_visitors_days'));
        $query->where($db->quoteName('date_day')." BETWEEN ".$db->quote($temp_time->format('Y-m-d'))."AND ".$db->quote($cu_d_time->format('Y-m-d')));
        
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $results = $db->loadObjectList();
		
		return $results;
       
	}
	public function getbrowser_visits()
	{
	
		$db = JFactory::getDbo(); 		
		$query = $db->getQuery(true);		 
		
		$query->select('*');
		$query->from($db->quoteName('#__pro_counter_browsers'));		
		$query->order('count_uniq_visits DESC');
		$query->setLimit('14');
		
		$db->setQuery($query); 
		
		$results = $db->loadObjectList();
		
		return $results;
	}
	
	public function getplatform_visits()
	{
	
		$db = JFactory::getDbo(); 		
		$query = $db->getQuery(true);		 
		
		$query->select('*');
		$query->from($db->quoteName('#__pro_counter_platforms'));		
		$query->order('count_uniq_visits DESC');
		$query->setLimit('5');
		
		$db->setQuery($query); 
		
		$results = $db->loadObjectList();
		
		return $results;
	}
}


?>
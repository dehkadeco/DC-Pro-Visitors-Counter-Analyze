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
    
    class moddc_pro_counter_analyzeHelper
    {
    
        
   
        
        public function mod_counter_get_visits(){
        
        $cu_d_time=new JDate('now');
        $cu_d_time_yesterday=new JDate('now - 1 day');
      
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
          // $app = JFactory::getApplication();
          $var_db_prefix= $db->getPrefix();
        $var_select="(select counter_hits   FROM `".$var_db_prefix."pro_counter_visitors_days` WHERE
        `date_day` = ".$db->quote($cu_d_time->format('Y-m-d'))." ) as today_visits
        ,(select counter_hits  FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE `date_day` =  ".$db->quote($cu_d_time_yesterday->format('Y-m-d'))." )
        as yesterday_visits,(select sum(counter_hits)  FROM `".$var_db_prefix."pro_counter_visitors_days` )as all_visits,
        (SELECT sum(counter_hits) FROM `".$var_db_prefix."pro_counter_visitors_days`
        WHERE MONTH(`date_day`) = ".$db->quote($cu_d_time->month).") as month_visits 
        ";
        
        $query->select($var_select);      
        $query->from($db->quoteName('#__pro_counter_visitors_days'));
       
      
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $results = $db->loadAssoc();
   
        
        return $results;
    }
    
        public function start_pro_counter(){
          

           
           // $results=$this->mod_counter_get_visits($user_agent);
            $results=$this->mod_counter_get_visits();
            $items_var=array();
            $items_var['today_visits']=$results['today_visits'];
            $items_var['yesterday_visits']=$results['yesterday_visits'];
            $items_var['all_visits']=$results['all_visits'];
            $items_var['month_visits']=$results['month_visits'];
            
            //$items_var['operating_system']=$user_agent['operating_system'];
           // $items_var['browserType']=$user_agent['browserType'];
            //$items_var['ismobile']=$user_agent['ismobile'];
           
           return $items_var;
          
        }
    
    
    
    
    
    
    
    }
    
    ?>
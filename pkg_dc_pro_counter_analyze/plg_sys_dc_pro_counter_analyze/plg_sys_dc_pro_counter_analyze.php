<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport( 'joomla.plugin.plugin' );
 
 
class plgSystemplg_sys_dc_pro_counter_analyze extends JPlugin
{
	
	public function __construct( &$subject, $config )
	{
			parent::__construct( $subject, $config );
	}
		
	
	function onAfterRender()
	{
		// Don't run on back-end
		if ( (JPATH_BASE !== JPATH_ROOT) ) return;

		 $user_agent=$this->get_user_agent_info();
         $this->set_user_visitor_info($user_agent);
		
		
		return  true;
	}
	
	
	
	
	public function set_user_visitor_info($user_agent){
        
           $count_visits =$this->set_last_seen_visitor($user_agent['agnetstring']);           
           $this->set_conter_visits_days($count_visits);
           
           //if uniq visits , then add to table platform and table browser
           if(!$count_visits>0){
           $this->set_platform_visits($user_agent);
           $this->set_browser_info($user_agent);
           
           }
           
                 
                Return true;
    }
    
    public function set_last_seen_visitor($str_user_agent){
       
       $tmp_ip_address=$this->get_real_ip();
        $cu_d_time=new JDate('now');
        $cu_d_time2=new JDate('now - 2 hourse');
		
		if($this->params->get('hours_uniq_visits')){
			
				$tmpp=$this->params->get('hours_uniq_visits');
                $cu_d_time2=new JDate("now - $tmpp hourse");
			   
		}
               
      
        // load last seen this user foer latest 2 hourse
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('COUNT(*)');
        $query->from($db->quoteName('#__pro_counter_latest_visitors'));
        $query->where($db->quoteName('ip_address')." = ".$db->quote($tmp_ip_address)."and ".$db->quoteName('date_time')." BETWEEN '".$cu_d_time2->toSql()."' and '".$cu_d_time->toSql()."'");
        
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $count_visits = $db->loadResult();
        
        //if load last seen this user foer latest 2 hourse not unq visitor
        if(!$count_visits>0){
        // Create and populate an object.
         $profile = new stdClass();
       
         $profile->ip_address=$tmp_ip_address;
         $profile->user_agent=$str_user_agent;       
         $profile->date_time=$cu_d_time->toSql();
          
         // Insert the object into the user profile table.
         $result = JFactory::getDbo()->insertObject('#__pro_counter_latest_visitors', $profile);

         	//delete old
         	$last_inserted_id= JFactory::getDbo()->insertid();		
			if(($last_inserted_id % 1000)==0){
				
				$this->delete_old_inserted_visitor_info();
	        
			}

        }
        
        return $count_visits;
                 
    }
    
    public function delete_old_inserted_visitor_info(){
		$cu_d_time2=new JDate('now - 7 day');
		
		$db = JFactory::getDbo();		 
		$query = $db->getQuery(true);		 
		// delete all old visits.
		$conditions = array(
			$db->quoteName('date_time') . ' <'. $db->quote($cu_d_time2->toSql()), 
			
		);		 
		$query->delete($db->quoteName('#__pro_counter_latest_visitors'));
		$query->where($conditions);		 
		$db->setQuery($query);
		 
		$result = $db->execute();	
	}
	
    public function set_conter_visits_days($count_visits) {
        // update table pro_counter_visitors_days
         // load last seen this user foer latest 2 hourse
        $cu_d_time=new JDate('now');
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id,counter_hits,counter_uniq_visitor,COUNT(*) as count');
        $query->from($db->quoteName('#__pro_counter_visitors_days'));
        $query->where($db->quoteName('date_day')." = ".$db->quote($cu_d_time->format('Y-m-d')));
        
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $results = $db->loadAssoc();
       
       
        // insert or update day visits
        if($results['count']>0){
            $tmp_uniq_visit=($count_visits>0)?0:1;
            
            //update
           // Create an object for the record we are going to update.
            $object = new stdClass();
             
            // Must be a valid primary key value.
            $object->id = $results['id'];
            $object->counter_hits =$results['counter_hits']+1 ;
            $object->counter_uniq_visitor =$results['counter_uniq_visitor']+$tmp_uniq_visit;
             
            // Update their details in the users table using id as the primary key.
            $result = JFactory::getDbo()->updateObject('#__pro_counter_visitors_days', $object, 'id');

       
       
     
        }else{
            //insert
            
         // Create and populate an object.
         $profile = new stdClass();
         $profile->date_day=$cu_d_time->format('Y-m-d');
         $profile->counter_hits=1;
         $profile->counter_uniq_visitor=1;
          
         // Insert the object into the user profile table.
         $result = JFactory::getDbo()->insertObject('#__pro_counter_visitors_days', $profile);
            
        }
        
        
    }
    
    public function set_platform_visits($user_agent){
        
       $db = JFactory::getDbo();        
       $query = $db->getQuery(true);
        
       // Fields to update.
       $fields = array(
           $db->quoteName('count_uniq_visits') . " =`count_uniq_visits` +1"
         
       );
        
       // Conditions for which records should be updated.
       $conditions = array(
           $db->quoteName('platform') . '='.$db->quote($user_agent['operating_system'])
       );
        
       $query->update($db->quoteName('#__pro_counter_platforms'))->set($fields)->where($conditions);
        
       $db->setQuery($query);
        
       $result = $db->execute();
       
       
    }
    
    public function set_browser_info($user_agent){
         // update table pro_counter_visitors_days
         // load last seen this user foer latest 2 hourse
        
        
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('id,browser_name,count_uniq_visits');
        $query->from($db->quoteName('#__pro_counter_browsers'));
        $query->where($db->quoteName('browser_name')." = ".$db->quote($user_agent['browserType']));
        $query->where($db->quoteName('is_mobile')." = ".$db->quote($user_agent['ismobile']));
        $query->where($db->quoteName('is_robot')." = ".$db->quote($user_agent['isrobot']));
        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $results = $db->loadAssoc();
     
       
        // insert or update day visits
        if($results['id']>0){
                  
            //update           
            $object = new stdClass();            
          
            $object->id = $results['id'];
            $object->count_uniq_visits =$results['count_uniq_visits']+1 ;          
                    
            $result = JFactory::getDbo()->updateObject('#__pro_counter_browsers', $object, 'id');
                  
        }else{
            //insert
            
         // Create and populate an object.
         $profile = new stdClass();
         $profile->browser_name=$db->escape($user_agent['browserType']);
         $profile->count_uniq_visits=1;
         $profile->is_mobile=$user_agent['ismobile'];
         $profile->is_robot=$user_agent['isrobot'];
          
         // Insert the object into the user profile table.
         $result = JFactory::getDbo()->insertObject('#__pro_counter_browsers', $profile);
            
        }
        
    }
    
	
	public function  get_user_agent_info(){
        
         jimport('joomla.environment.browser');
             $user_agent= array(); 
        
    
         $browser = JBrowser::getInstance();   
        
             $user_agent['agnetstring']=$browser->getAgentString();
             $user_agent['browserVersion'] = $browser->getMajor();
             $user_agent['userplatform']=$browser->getPlatform();
             $user_agent['ismobile']=$browser->isMobile();
             $user_agent['isrobot']=$browser->isRobot();
             $user_agent['operating_system']=$this->get_operating_system_name($browser->getAgentString());
             
             $my_find_browser=$this->get_user_browser_name($user_agent['agnetstring']);
           
                if($my_find_browser !=false && $user_agent['ismobile']<1  ){
                 $user_agent['browserType'] =$my_find_browser;
               
                }else{
                   $user_agent['browserType'] = $browser->getBrowser();
                }
				
				//if browser not found in joomla and my function then
              if( !$user_agent['browserType']){
				
                 $user_agent['browserType']='Not Found Browser';
				}
            

                //is_mobile
                if( $user_agent['ismobile']<1  ){
                 $user_agent['ismobile'] =$this->get_user_browser_is_mobile($user_agent['agnetstring']);
               
                }
                
            
         

        Return $user_agent;
       
        
    }
    
    
  public function get_user_browser_name($full_user_agent){
     $browser_array       =   array(
                                '/Avant/i'     =>  'Avant Browser',
                                '/Firefox/i'     =>  'Firefox',                                                           
                                '/Safari/i'     =>  'Safari',
                                  '/Chrome/i'     =>  'Chrome', 
                                '/Opera/i'     =>  'Opera',
                                '/OPR/i'     =>  'Opera',
                                '/MSIE/i'     =>  'IE',
                                '/Trident/i'         =>  'IE',
                                  '/Edge/i'         =>  'IEEdge',
                                '/Googlebot/i'         =>  'Googlebot',
                                '/Bingbot/i'         =>  'Bingbot',
                                '/Slurp/i'         =>  'yahoobot',
                            );
     $my_find_browser=false;
      foreach ($browser_array as $regex => $value) { 
          
                    if (preg_match($regex, $full_user_agent)) {
                        $my_find_browser    =   $value;
                       //return $my_find_browser;
                    }               
                    
            }
            
            return $my_find_browser;
    
  }
   public function get_user_browser_is_mobile($full_user_agent){
     $browser_is_mobile_array       =   array(
                                '/mobile/i'     =>  '1',
                                '/Opera Mini/i'     =>  '1',
                                '/Opera Mobi/i'     =>  '1'                            
                              
                            );
     $is_mobile=false;
      foreach ($browser_is_mobile_array as $regex => $value) { 
          
                    if (preg_match($regex, $full_user_agent)) {
                        $is_mobile    =   1;
                       return $is_mobile;
                    }               
                    
            }
            
            return $is_mobile;
    
  }
    
    public function get_operating_system_name($full_user_agent){
        
          $os_array       =   array(
                                '/windows nt 10/i'     =>  'Windows 10',
                                '/windows nt 6.3/i'     =>  'Windows 8.1',
                                '/windows nt 6.2/i'     =>  'Windows 8',
                                '/windows nt 6.1/i'     =>  'Windows 7',
                                '/windows nt 6.0/i'     =>  'Windows Vista',
                                '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                                '/windows nt 5.1/i'     =>  'Windows XP',
                                '/windows xp/i'         =>  'Windows XP',
                                '/windows nt 5.0/i'     =>  'Windows 2000',
                                '/windows me/i'         =>  'Windows ME',
                                '/win98/i'              =>  'Windows 98',
                                '/win95/i'              =>  'Windows 95',
                                '/win16/i'              =>  'Windows 3.11',
                                '/macintosh|mac os x/i' =>  'Mac OS X',
                                '/mac_powerpc/i'        =>  'Mac OS 9',
                                '/linux/i'              =>  'Linux',
                                '/ubuntu/i'             =>  'Ubuntu',
								'/Googlebot/i'          =>  'Googlebot',
								'/Bingbot/i'        	=>  'Bingbot',
                                '/Slurp/i'         		=>  'yahoobot',
                                '/iphone/i'             =>  'iPhone',
                                '/ipod/i'               =>  'iPod',
                                '/ipad/i'               =>  'iPad',
                                '/android/i'            =>  'Android',
                                '/blackberry/i'         =>  'BlackBerry',
                                '/webos/i'              =>  'Mobile',
                                 '/Windows Phone/i'              =>  'Windows Phone'
                            );
          
          
            $find_platform=false;
            foreach ($os_array as $regex => $value) { 
          
                    if (preg_match($regex, $full_user_agent)) {
                        $os_platform    =   $value;
                        $find_platform=true;
                    }               
                    
            }
             
            if(  $find_platform ==false){
                 $os_platform='Other Platform';
             }
             
                       
       Return $os_platform;
       
    }
    
  public  function get_real_ip()    {

        $tmp_server_cons=JRequest::get('server');
		
        if (isset($tmp_server_cons["HTTP_CF_CONNECTING_IP"]))
        {
            $ip= $tmp_server_cons["HTTP_CF_CONNECTING_IP"];
        }
        elseif (isset($tmp_server_cons["HTTP_CLIENT_IP"]))
        {
            $ip= $tmp_server_cons["HTTP_CLIENT_IP"];
        }		
		elseif (isset($tmp_server_cons["HTTP_X_FORWARDED_FOR"]))
        {
			$ip=$tmp_server_cons["HTTP_X_FORWARDED_FOR"];
		}
		elseif (isset($tmp_server_cons["HTTP_X_FORWARDED"]))
        {
			$ip= $tmp_server_cons["HTTP_X_FORWARDED"];
		}
		elseif (isset($tmp_server_cons["HTTP_FORWARDED_FOR"]))
        {
			$ip= $tmp_server_cons["HTTP_FORWARDED_FOR"];
		}
		elseif (isset($tmp_server_cons["HTTP_FORWARDED"]))
        {
			$ip= $tmp_server_cons["HTTP_FORWARDED"];
		}
		else
        {
			$ip= $tmp_server_cons["REMOTE_ADDR"];
		}
        
        if($ip=='::1')
        $ip='127.0.0.1';
        
        Return $ip;

	}
    

}

?>
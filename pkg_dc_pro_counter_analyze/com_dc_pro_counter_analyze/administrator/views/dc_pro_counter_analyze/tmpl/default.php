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
 
Dc_pro_counter_analyzeHelper::addSubmenu('dc_pro_counter_analyze');

	$doc= JFactory::getDocument();
	$doc->addStyleSheet('components/com_dc_pro_counter_analyze/assets/summary_page.css');
    $doc->addScript('https://www.google.com/jsapi');
    if(!$this->five_day_visits){
		echo JText::_('COM_DC_PRO_COUNTER_TITTLE_NO_DATA_TO_SHOW');
		goto Not_Exist_Data_To_Show;
	}
    $arr_visits=array();    

    $tmp=array('Days', 'Hits', 'Uniq Hit');

    array_push($arr_visits,$tmp);

   

    foreach($this->five_day_visits as $i=>$item){

        $tmp=array(JHtml::date($input = $item->date_day, 'm/d', false),(int)$item->counter_hits,(int)$item->counter_uniq_visitor);

        array_push($arr_visits,$tmp);

    }

	

	//browser chart              

	  $arr_browser=array( );

	  $tmp=array('Task', 'Hours per Day');   

 	  array_push($arr_browser,$tmp);
	 

	  foreach($this->browser_list as $i=>$item){

		

		if($item->is_mobile)

			$item->browser_name.=" mobile";

		

		  $tmp=array($item->browser_name,(int)$item->count_uniq_visits);

		  array_push($arr_browser,$tmp);

	  }

	  

    //platform chart              

	  $arr_platforms=array( );

	  $tmp=array('platforms', 'uniq visits');    
	  array_push($arr_platforms,$tmp);
	 
	 
	  foreach($this->platform_list as $i=>$item){
		  $tmp=array($item->platform,(int)$item->count_uniq_visits);
		  array_push($arr_platforms,$tmp);
	  }
	                     
    
   
		

?>


  <div id="div_page_summary">
    
    
    <div class='CSSTable_count_visits' >
                <table >
                    <tr>                
                        <td>
                       <?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_VISITS'); ?>
                        </td> <td>
                        <?php echo JText::_('COM_DC_PRO_COUNTER_TODAY_VISITS'); ?>
                        </td> <td>
                        <?php echo JText::_('COM_DC_PRO_COUNTER_YESTERDAY_VISITS'); ?>
                         </td> <td>
                        <?php echo JText::_('COM_DC_PRO_COUNTER_MONTHE_VISITS'); ?>
                         </td> <td>
                        <?php echo JText::_('COM_DC_PRO_COUNTER_ALL_VISITS'); ?>
                        </td>
                    </tr>
                    <tr>
                       <td ><b>
                          <?php echo JText::_('COM_DC_PRO_COUNTER_HITS_VISITS'); ?></b>
                        </td><td> 
                          <?php echo (int)$this->count_visits['today_visits']?>
                        </td><td>                        
                          <?php echo (int)$this->count_visits['yesterday_visits']?>
                        </td><td> 
                         <?php  echo (int)$this->count_visits['month_visits']?>
                       </td><td> 
                        <?php   echo (int)$this->count_visits['all_visits']?>
                        </td>
                    </tr>
                    <tr>
                        <td ><b>
                         <?php echo JText::_('COM_DC_PRO_COUNTER_UNIQUE_VISITS'); ?></b>
                       </td><td> 
                         <?php  echo (int)$this->count_visits['today_uniq_visits']?>
                       </td><td>
                          <?php echo (int)$this->count_visits['yesterday_uniq_visits']?>
                       </td><td>
                           <?php echo (int)$this->count_visits['month_uniq_visits']?>
                       </td><td>
                          <?php echo (int) $this->count_visits['all_uniq_visits'] ?>
                        </td>
                    </tr>
                   
                </table>
            </div>
            
            
            
            <div class="my_chart_space">
				<h3><?php echo JText::_('COM_DC_PRO_COUNTER_CHART_VISITS_TITTLE'); ?></h3>
                <div id="chart_div_days_visit" style="height: 500px;"></div>
            </div>
			
			   <div class="my_chart_space">
				<h3><?php echo JText::_('COM_DC_PRO_COUNTER_CHART_BROWSER_TITTLE'); ?></h3>
             <div id="chart_div_browser" style="height: 500px"></div>
			    </div>
			   <div class="my_chart_space">
				<h3><?php echo JText::_('COM_DC_PRO_COUNTER_CHART_PLATFORM_TITTLE'); ?></h3>
			 <div id="chart_div_platform" style="height: 500px"></div>
			    </div>
			 
			 
			
            </div>




 
    <script type="text/javascript">
		
		//chart visits_day
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart_days_visit);
		function drawChart_days_visit() {
		 var data = google.visualization.arrayToDataTable(<?php echo json_encode( $arr_visits ) ?>);
   
		  var options = {
			title: 'Days Performance!',
			hAxis: {title: 'Days',  titleTextStyle: {color: '#333'}},
			vAxis: {minValue: 0}
		  };
  
		  var chart = new google.visualization.AreaChart(document.getElementById('chart_div_days_visit'));
		  chart.draw(data, options);
		}
		
		//chart browser
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart_browser);
      function drawChart_browser() {

        var data = google.visualization.arrayToDataTable(<?php echo json_encode( $arr_browser ) ?>); 

        var options = {
          title: 'Most browsers detected'
        };

        var chart = new google.visualization.PieChart(document.getElementById('chart_div_browser'));

        chart.draw(data, options);
      }
   
		//chart platform
	   google.load("visualization", "1", {packages:["corechart"]});
	   google.setOnLoadCallback(drawChart_platform);
	   function drawChart_platform() {
		 var data = google.visualization.arrayToDataTable(<?php echo json_encode( $arr_platforms ) ?>);     
   
		 var view = new google.visualization.DataView(data);
		 view.setColumns([0, 1,
						  { calc: "stringify",
							sourceColumn: 1,
							type: "string",
							role: "annotation" },
						  ]);
   
		 var options = {
		   title: "Most platforms detected",
		   
		  
		   bar: {groupWidth: "95%"},
		   legend: { position: "none" },
		 };
		 var chart = new google.visualization.ColumnChart(document.getElementById("chart_div_platform"));
		 chart.draw(view, options);
	 }
	 
	 
	jQuery (document).ready(function($){
		
		$(window).resize(function(){
	    drawChart_days_visit();
		drawChart_browser();
		drawChart_platform();
       });
		
		  });
    </script>
	
	
	<?php
	Not_Exist_Data_To_Show:
	?>
                        
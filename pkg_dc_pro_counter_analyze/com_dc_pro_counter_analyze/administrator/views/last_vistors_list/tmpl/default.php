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
 
Dc_pro_counter_analyzeHelper::addSubmenu('last_vistors_list');

	

?>
<form action="index.php?option=com_dc_pro_counter_analyze&view=last_vistors_list" method="post" name="adminForm" id="adminForm">
	<table class="adminlist table table-striped">
		<thead>
			<tr class="sortable">
				
                <th class="center"><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_TITTLE_ID', 'id', $this->sortDirection, $this->sortColumn); ?></th>			    			
                <th class="center"><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_IP_ADDRESS', 'ip_address', $this->sortDirection, $this->sortColumn); ?></th>
			    <th class="center"><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_USER_AGENT', 'user_agent', $this->sortDirection, $this->sortColumn); ?></th>
			    <th class="center"><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_DATE', 'date_time', $this->sortDirection, $this->sortColumn); ?></th>
				
				<th class="nowrap center"><?php echo JText::_('COM_DC_PRO_COUNTER_DATE'); ?></th>
             
              
			</tr>
		</thead>
		<tbody>
			<?php
				$row  =   0;
				foreach($this->items as $i => $item) :
			?>
			<tr class="row<?php echo $i % 2 ?>">
				
			
				<td class="center"><?php print $item->id; ?></td>
				<td class="center"><?php print $item->ip_address; ?></td>
				
				
				<td class="center"><?php print $item->user_agent; ?></td>
				
				<td class="center"><?php print  JHtml::date($input = $item->date_time, 'm/d/Y', false); ?></td>						
	
	
			<?php  $tmp_href="http://ip-api.com/json/$item->ip_address"; ?>
				<td class="center"><?php print "<a class='who_is_link' 
				 href=$tmp_href>who is </a>"; ?></td>						
					
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->sortColumn; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->sortDirection; ?>" />
	<?php echo JHtml::_('form.token'); ?>
	<?php echo $this->pagination->getListFooter(); ?>
</form>

<script>
jQuery (document).ready(function($){
	
	// analyze ip address
	$(".who_is_link").click(function(){
		
		 var tmp='<ul style="background-color: #D5E9FF;font-family: monospace;">';
		 var tmp_this=$(this);
		 
		 $.getJSON($(this).attr("href"), function(result){
			
            $.each(result, function(i, field){
              tmp=tmp+"<li> <b>"+i+"</b> : "+ field+ " </li>";			  	
            });
			tmp+='</ul>';
			 show_who_is (tmp_this,tmp);
			
			
			   
        });		
	return false;

    });
   
   function show_who_is (item_this,message){
	if (message) {
	;
    var myWindow = window.open("", "who is MsgWindow", "width=400, height=400");
    myWindow.document.write(message);

	}
	
   }
   
   
   
});
</script>





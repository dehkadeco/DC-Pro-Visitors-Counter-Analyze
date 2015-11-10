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
 
Dc_pro_counter_analyzeHelper::addSubmenu('last_vistor_per_day');

//print_r( $this->list_last_visitsor);
?>
<form action="index.php?option=com_dc_pro_counter_analyze&view=last_vistor_per_day" method="post" name="adminForm" id="adminForm">
	<table class="adminlist table table-striped">
		<thead>
			<tr class="sortable">
				<th>    <?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ROW');   ?></th>
                <th><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_TITTLE_ID', 'id', $this->sortDirection, $this->sortColumn); ?></th>			    			
                <th><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_DATE_DAY', 'date_day', $this->sortDirection, $this->sortColumn); ?></th>
			    <th><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_COUNTER_HITS', 'counter_hits', $this->sortDirection, $this->sortColumn); ?></th>
				<th><?php echo JHTML::_( 'grid.sort', 'COM_DC_PRO_COUNTER_COUNTER_UNIQ_VISITOR', 'counter_uniq_visitor', $this->sortDirection, $this->sortColumn); ?></th>

              
			</tr>
		</thead>
		<tbody>
			<?php
				$row  =   0;
				foreach($this->items as $i => $item) :
			?>
			<tr class="row<?php echo $i % 2 ?>">
				<td class="center"> <?php $row = $i; echo ++$row; ?> </td>
			
				<td class="center"><?php print $this->escape($item->id); ?></td>
				<td class="center"><?php print  JHtml::date($input = $item->date_day, 'm/d/Y', false); ?></td>	
				<td class="center"><?php print  (int)$item->counter_hits ?></td>
				<td class="center"><?php print  (int)$item->counter_uniq_visitor; ?></td>
									
	
				
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


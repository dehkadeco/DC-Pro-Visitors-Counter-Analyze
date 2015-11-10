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
 
Dc_pro_counter_analyzeHelper::addSubmenu('about_us');

	$doc= JFactory::getDocument();
	//$doc->addStyleSheet('components/com_dc_pro_counter_analyze/assets/platform_page.css');


?>
<div id="div_about_us" style="text-align: center">
   <?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ABOUTE_US');?>
   
   <br/>
<p dir="rtl"><img  src="components/com_dc_pro_counter_analyze/assets/images/aboute_us.jpg" alt="" width="733" height="415" /></p>
<br/>
<h3> <?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ABOUTE_US_EXTENTION_TITTLE');?></h3>
<h5><?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ABOUTE_US_DESIGN_TITTLE');?> </h5>
<h4><a href="http://dehkadeco.ir" target="_blank"><?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ABOUTE_US_DESIGN_BY');?></a></h4>
<br/>
<p><a href="http://dehkadeco.ir" target="_blank"><img src="components/com_dc_pro_counter_analyze/assets/images/web_sitepng.png" alt="" width="600" height="87" /> </a></p>
<p><a href="mailto:dehkadeco.ir@gmail.com" ><img src="components/com_dc_pro_counter_analyze/assets/images/email_dehkade.png" alt="" width="600" height="87" /></a></p>
<h4> <?php echo JText::_('COM_DC_PRO_COUNTER_TITTLE_ABOUTE_US_COPYRIGHT');?></h4>
<h4 ><a href="http://dehkadeco.ir" target="_blank" >DEHKADECO.IR</a></h4>
</div>
    
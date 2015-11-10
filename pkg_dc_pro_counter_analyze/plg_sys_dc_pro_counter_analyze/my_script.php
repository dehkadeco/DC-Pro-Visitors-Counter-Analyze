<?php 
class PlgSystemplg_sys_dc_pro_counter_analyzeInstallerScript
{
    function postflight( $type, $parent ) {

        // We only need to perform this if the extension is being installed, not updated
        if ( $type == 'install' ) 
        {       
            $db = JFactory::getDbo();
            $query = $db->getQuery(true);

            $fields = array(
                $db->quoteName('enabled') . ' = ' . (int) 1,
               
            );

            $conditions = array(
                $db->quoteName('element') . ' = ' . $db->quote('plg_sys_dc_pro_counter_analyze'), 
                $db->quoteName('type') . ' = ' . $db->quote('plugin')
            );

            $query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);

            $db->setQuery($query);   
            $db->execute();     
        }

    }
}

?>
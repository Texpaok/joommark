<?php
/*
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport('joomla.application.component.helper');
jimport( 'joomla.plugin.plugin' );

// We need the BrowserDetection class; if it's not loaded, we load it
if(!class_exists('BrowserDetection')){
    include_once JPATH_ADMINISTRATOR . '/components/com_joommark/helpers/BrowserDetection.php';
}

class plgSystemTracker extends JPlugin{
	
	
	function plgSystemTracker( &$subject, $config ){
		parent::__construct( $subject, $config );

		/* Load the language of the component */
		$lang = JFactory::getLanguage();
		$lang->load('com_joommark',JPATH_ADMINISTRATOR);		
			
		/* Load the auxiliary methods */
		require_once JPATH_ADMINISTRATOR . '/components/com_joommark/helpers/database.php';
	}
	
	
	
	function onAfterInitialise(){
	
						
		$app = JFactory::getApplication();

        // We store only front-end visits
        if ($app->getName() !== 'site') {	
            return;
        }
		
		// Extract info from BrowserDetection
        $browser_data = new BrowserDetection();
        if (!empty($browser_data)) {
            $this->browser = $browser_data->getBrowser();
			$this->browser_version = $browser_data->getVersion();
			$platform = $browser_data->getPlatform();
			$is_mobile = $browser_data->isMobile();
			$is_robot = $browser_data->isRobot();
			$request_uri = $_SERVER['REQUEST_URI'];			
        } else {
            $this->browser = JText::_('COM_JOOMMARK_UNKNOW');
            $this->browser_version = JText::_('COM_JOOMMARK_UNKNOW');
            $platform = JText::_('COM_JOOMMARK_UNKNOW');
        }

        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != "") {
            $referer = $_SERVER['HTTP_REFERER'];			
        } else {
            $referer = JText::_('COM_CWTRAFFIC_UNKNOWN');
        }
		
		// Let's store the data
        //$store_data = new DatabaseAux();
		
		$kk = DatabaseAux::add_to_database("kk","oo");
		

	}
	
	
	
		
}
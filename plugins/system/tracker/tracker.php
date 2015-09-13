<?php

/*
 * @ author Jose A. Luque
 * @ Copyright (c) 2011 - Jose A. Luque
 * @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.plugin.plugin');

class plgSystemTracker extends JPlugin
{

	function plgSystemTracker(&$subject, $config)
	{
		parent::__construct($subject, $config);
	}

	function onAfterInitialise()
	{
		$db = JFactory::getDbo();
		$app = JFactory::getApplication();

		$uri = JUri::current();

		$user = JFactory::getUser()->name;


		$session = JFactory::getSession();
		$session_id = $session->getId();

		$query = "INSERT INTO #__joommarkt_stats (session_id_person, nowpage, lastupdate_time,  current_name)" .
				"VALUES ( '" . $session_id . "','" . $uri . "',NOW(),'" . $user . "')";
		$db->setQuery($query);
		try
		{
			$db->execute();
		} catch (Exception $e)
		{
			
		}
	}

	function onAfterRoute()
	{
		
	}

}

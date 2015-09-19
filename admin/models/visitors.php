<?php
/**
* Modelo Logs para el Componente Securitycheckpro
* @ author Jose A. Luque
* @ Copyright (c) 2011 - Jose A. Luque
* @license GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
*/

// Chequeamos si el archivo está incluído en Joomla!
defined('_JEXEC') or die();
jimport( 'joomla.application.component.model' );
jimport( 'joomla.access.rule' );
/**
* Modelo Vulninfo
*/
class JoommarksModelVisitors extends JModelList
{


public function __construct($config = array()) {
	
	if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'ip', 'nowpage', 'lastupdate_time', 'current_name'
            );
        }

    parent::__construct($config);		
}

/***/
protected function populateState($ordering = null, $direction = null) 
{
	// Inicializamos las variables
	$app		= JFactory::getApplication();
	
	$visitors_search = $app->getUserStateFromRequest('filter_visitors.search', 'filter_visitors_search');
	$this->setState('filter_visitors.search', $visitors_search);
	
		
	 // List state information.
        parent::populateState('ip', 'desc');
}


/*
* Devuelve todos los componentes almacenados en la BBDD 'securitycheckpro_logs' filtrados según las opciones establecidas por el usuario
*/
public function getListQuery()
{
	// Creamos el nuevo objeto query
	$db = $this->getDbo();
	$query = $db->getQuery(true);
	
	// Sanitizamos la entrada
	$search = $this->state->get('filter_visitors.search');
	$search = $db->Quote('%'.$db->escape($search, true).'%');
		
	$query->select('*');
	$query->from('#__joommark_stats AS a');
	
	
	$query->where('(a.ip LIKE '.$search.' OR a.nowpage LIKE '.$search.' OR a.lastupdate_time LIKE '.$search.' OR a.current_name LIKE '.$search.')');
	
	// Filtramos la descripcion
	/*if ($description = $this->getState('filter.description')) {
		$query->where('a.tag_description = '.$db->quote($description));
	}
	
	// Filtramos el tipo
	if ($log_type = $this->getState('filter.type')) {
		$query->where('a.type = '.$db->quote($log_type));
	}
		
	// Filtramos leido/no leido
	$leido = $this->getState('filter.leido');
	if (is_numeric($leido)) {
		$query->where('a.marked = '.(int) $leido);
	}	
	
	
	// Filtramos el rango de fechas
	JLoader::import('joomla.utilities.date');

	$fltDateFrom = $this->getState('datefrom', null, 'string');
	if($fltDateFrom) {
		$regex = '/^\d{1,4}(\/|-)\d{1,2}(\/|-)\d{2,4}[[:space:]]{0,}(\d{1,2}:\d{1,2}(:\d{1,2}){0,1}){0,1}$/';
		if(!preg_match($regex, $fltDateFrom)) {
			$fltDateFrom = '2000-01-01 00:00:00';
			$this->setState('datefrom', '');
		}
		$date = new JDate($fltDateFrom);
		$query->where($db->quoteName('time').' >= '.$db->Quote($date->toSql()));
	}

	$fltDateTo = $this->getState('dateto', null, 'string');
	if($fltDateTo) {
		$regex = '/^\d{1,4}(\/|-)\d{1,2}(\/|-)\d{2,4}[[:space:]]{0,}(\d{1,2}:\d{1,2}(:\d{1,2}){0,1}){0,1}$/';
		if(!preg_match($regex, $fltDateTo)) {
			$fltDateTo = '2037-01-01 00:00:00';
			$this->setState('dateto', '');
		}
		$date = new JDate($fltDateTo);
		$query->where($db->quoteName('time').' <= '.$db->Quote($date->toSql()));
	}
	
	// Ordenamos el resultado
	$query = $query . ' ORDER BY a.id DESC';*/
	
	// Add the list ordering clause.
    $query->order($db->escape($this->getState('list.ordering', 'ip')) . ' ' . $db->escape($this->getState('list.direction', 'desc')));
	
	return $query;
}

/**
 * Método para cargar todas las vulnerabilidades de los componentes
 */
function getData()
{
	// Cargamos los datos
	if (empty( $this->_data )) {
		$query = $this->_buildQuery();
		$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	}
		
	return $this->_data;
}

/**
 * Método para cargar todas las vulnerabilidades de los componentes especificadas en los términos de búsqueda
 */
function getFilterData()
{
	// Cargamos los datos
	if (empty( $this->_data )) {
		$query = $this->_buildFilterQuery();
		$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));
	}
			
	return $this->_data;
}

}
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampioni extends JModel
{
	var $_campioni;
	var $tableName = '#__campioni_richieste';

	function _buildQuery()
	{
		$query = ' SELECT * FROM ' . $this->tableName . $this->_buildQueryOrderBy();
		return $query;

	}

	function _buildQueryOrderBy()
	{
		global $mainframe, $option;

		// Array of allowable order fields
		$orders = array('registrazione', 'provincia', 'id');
		// get the order field and direction
		$filterOrder = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'registrazione');
		$filterOrderDir = strtoupper($mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'DESC' ));
		// validate the order direction, must be ASC or DESC
		if ($filterOrderDir != 'ASC' && $filterOrderDir != 'DESC')
		{
			$filterOrderDir = 'DESC';
		}
		// if order column is unknown use the default
		if ( !in_array($filterOrder, $orders) )
		{
			$filterOrder = 'registazione';
		}
		// return the ORDER BY clause
		return ' ORDER BY '.$filterOrder.' '.$filterOrderDir;
	}

	/**
	 * Restituisce le richieste per campioni presenti nella tabella
	 * @return array Array of objects containing the data from the database
	 */
	function getCampioni()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_campioni ))
		{			
			$query = $this->_buildQuery();
			$this->_campioni = $this->_getList( $query );
			$provincia = $this->getTable( 'Provincia', 'Table' );
			$regione = $this->getTable( 'Regione', 'Table' );
			foreach ($this->_campioni as $campione) {
				$provincia->loadBySigla( $campione->provincia );
				$regione->id = $provincia->id_regione;
				$regione->load();
				$campione->id_regione = $regione->id;
				$campione->prov_nome = $provincia->provincia;
				$campione->regione = $regione->regione;
			}
			$this->_campioni = $this->_filterByRegione( $this->_campioni );
		}
		return $this->_campioni;
	}

	function _filterByRegione( $campioni )
	{
		global $mainframe, $option;

		$filterRegioneId = $mainframe->getUserStateFromRequest( $option.'filter_regioneid', 'filter_regioneid', 0, 'int' );
		if ( $filterRegioneId === 0 ) {
			return $campioni;
		}
		$campioniFilterd = array();
		foreach ($campioni as $campione) {
			if ( $campione->id_regione !== $filterRegioneId ) {
				continue;
			}
			$campioniFilterd[] = $campione;
		}
		return $campioniFilterd;
	}

	function getRegioni()
	{
		$regione = $this->getTable( 'Regione', 'Table' );
		return $regione->loadAll();
	}
}
?>
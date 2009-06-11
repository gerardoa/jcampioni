<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampioni extends JModel
{
	var $_ids = null;
	var $_campioni;
	
	var $_filteredCampioni;
	var $_allCampioni;
	var $_regioni;
	
	var $tableName;
	var $_pagination;
	var $_total;


	function __construct()
	{
		global $mainframe, $option;
		parent::__construct();
		$table = $this->getTable( 'campione' );
		$this->tableName = $table->getTableName();
		$ids = JRequest::getVar( 'cid', null, 'default', 'array' ); 
		$this->setIds( $ids );
		// Get the pagination request variables
		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'));
		$limitStart = $mainframe->getUserStateFromRequest($option.'limitstart', 'limitstart', 0);
		// set the state pagination variables
		$this->setState('limit', $limit);
		$this->setState('limitstart', $limitStart);
	}
	
	function setIds( $ids )
	{
		$this->_ids = $ids;
		$this->_campioni = null;
	}

	function _buildQuery()
	{
		$query = ' SELECT * FROM ' . $this->tableName . $this->_buildQueryOrderBy();
		return $query;

	}

	function _buildQueryOrderBy()
	{
		global $mainframe, $option;

		// Array of allowable order fields
		$orders = array('registrazione', 'provincia', 'id', 'ip', 'nome', 'cognome', 'eta', 'email', 'citta', 'cap', 'kit', 'figli_num', 'figli_eta_media');
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
			$campioni = $this->getFilteredCampioni();
			$limitStart = $this->getState('limitstart');
			$limit = $this->getState('limit');
			if ( $limit == 0 ) {
				$this->_campioni = $campioni;				
			} else {
				$this->_campioni = array_slice($campioni, $limitStart, $limit);
			}
		}
		return $this->_campioni;
	}
	
	function getFilteredCampioni()
	{
		if (empty( $this->_filteredCampioni ))
		{
			$campioni = $this->getAllCampioni();
			$campioni = $this->_filterByRegione( $campioni );
			$this->_filteredCampioni = $campioni;
		}
		return $this->_filteredCampioni;
	}

	function getAllCampioni()
	{
		if (empty( $this->_allCampioni ))
		{
			$query = $this->_buildQuery();
			$this->_allCampioni = $this->_getList( $query );
			$provincia = $this->getTable( 'Provincia', 'Table' );
			$regione = $this->getTable( 'Regione', 'Table' );
			foreach ($this->_allCampioni as $campione) {
				$provincia->loadBySigla( $campione->provincia );
				$regione->id = $provincia->id_regione;
				$regione->load();
				$campione->id_regione = $regione->id;
				$campione->prov_nome = $provincia->provincia;
				$campione->regione = $regione->regione;
			}
		}
		return $this->_allCampioni;
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

	function _getNumCampioniForRegione($regioni)
	{
		$campioni = $this->getAllCampioni();
		$numCampioni = array();
		foreach ($campioni as $campione) {
			$numCampioni[$campione->id_regione] += 1;
		}
		foreach ($regioni as $regione) {
			$regione->numCampioni = $numCampioni[$regione->id];
		}
		return $regioni;
	}

	// @return ObjectList
	function getRegioni()
	{
		if ( empty($this->_regioni) )
		{
			$regione = $this->getTable( 'Regione', 'Table' );
			$regioni = $regione->loadAll();
			$regioni = $this->_getNumCampioniForRegione($regioni);
			$this->_regioni = $regioni;
		}
		return $this->_regioni;
	}

	function getPagination()
	{
		if (empty($this->_pagination))
		{
			// import the pagination library
			jimport('joomla.html.pagination');
			// prepare the pagination values
			$total = $this->getTotal();
			$limitstart = $this->getState('limitstart');
			$limit = $this->getState('limit');
			// create the pagination object
			$this->_pagination = new JPagination($total, $limitstart, $limit);
		}
		return $this->_pagination;
	}

	function getTotal()
	{
		if (empty($this->_total))
		{
			$this->_total = count($this->getFilteredCampioni());
		}
		return $this->_total;

	}
	
	function delete()
	{
		$row = $this->getTable( 'campione' );
		$cids = $this->_ids;
		foreach ($cids as $cid) {
			if ( !$row->delete($cid) )
			{
				$this->setError( $row->getErrorMsg() );
				return false;
			}
		}
		return true;
	}

}
?>
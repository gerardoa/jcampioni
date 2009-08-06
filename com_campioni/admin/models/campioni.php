<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
JLoader::register('CampioniModelCampione', JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'campione.php' );

class CampioniModelCampioni extends JModel
{
	var $_ids = null;
	var $_campioni;

	var $_filteredCampioni;
	var $_allCampioni;
	var $_regioni;

	var $_tableName;
	var $_pagination;
	var $_total;
	var $_mapNumCampioni = array();


	function __construct()
	{
		global $mainframe, $option;
		parent::__construct();
		$table = $this->getTable( 'campione' );
		$this->_tableName = $table->getTableName();
		$ids = JRequest::getVar( 'cid', null, 'default', 'array' );
		$this->setIds( $ids );
		$this->campioni = array();
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
		$this->_campioni = array();
	}

	function _buildQuery()
	{
		$query = ' SELECT * FROM ' . $this->_tableName . $this->_buildQueryOrderBy();
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
			$this->_loadCampioni( $this->_getList( $query ) );
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
			$provincia = $campione->getProvincia();
			$regione = $provincia->getRegione();
			if ( $regione->getId() !== $filterRegioneId ) {
				continue;
			}
			$campioniFilterd[] = $campione;
		}
		return $campioniFilterd;
	}

	function getNumCampioniByRegione( $regioneArg )
	{
		if ( empty($this->_mapNumCampioni)) {
			$campioni = $this->getAllCampioni();
			foreach ($campioni as $campione) {
				$provincia = $campione->getProvincia();
				$regione = $provincia->getRegione();
				@$this->_mapNumCampioni[$regione->getId()] += 1;
			}
			/*foreach ($regioni as $regione) {
			 $regione->numCampioni = $numCampioni[$regione->id];
			 }*/
		}
		return @$this->_mapNumCampioni[$regioneArg->getId()];
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

	function _loadCampioni( $objList ) {
		$this->_allCampioni = array();
		foreach ( $objList as $obj) {
			$this->_allCampioni[] = $this->_loadCampione($obj);
		}
	}

	function _loadCampione($obj) {
		$campione = new CampioniModelCampione();
		$campione->setId( $obj->id );
		$campione->setIdUtente($obj->id_utente);
		$campione->setRegistrazione( $obj->registrazione);
		$campione->setIp( $obj->ip );
		$campione->setNome( $obj->nome );
		$campione->setCognome( $obj->cognome );
		$campione->setEta( $obj->eta );
		$campione->setEmail( $obj->email );
		$campione->setIndirizzo( $obj->indirizzo );
		$campione->setCitta( $obj->citta );
		$campione->setCap( $obj->cap );
		$campione->setKit( $obj->kit );
		$campione->setRichiestaStato( $obj->richiesta_stato );
		$campione->setDataSpedizione($obj->data_spedizione);
		// Fill private fields
		$table = $campione->getTableCampione();
		$table->provincia = $obj->provincia;
		$table->figli_num = $obj->figli_num;
		$table->figli_eta_media = $obj->figli_eta_media;
		
		return $campione;
	}

	function setDelivered( $bool = true )
	{
		jimport('joomla.utilities.date');
		$campione = new CampioniModelCampione();
		$cids = $this->_ids;
		foreach ($cids as $cid) {
			$campione->setId($cid);
			$date = new JDate();
			$campione->setDataSpedizione($date->toMySQL(true));
			$campione->store();
		}
	}

}
?>
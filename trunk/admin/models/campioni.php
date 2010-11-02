<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
JLoader::register('CampioniModelCampione', JPATH_COMPONENT_ADMINISTRATOR.DS.'models'.DS.'campione.php' );
JLoader::register('Campione', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'campione.php' );
JLoader::register('Provincia', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'provincia.php' );
JLoader::register('Regione', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'regione.php' );

class CampioniModelCampioni extends JModel
{
	var $_ids = null;
	var $_campioni;

	var $_allCampioni;
	var $_regioni;

	var $_tableName;
	var $_pagination;
	var $_total;
	var $_mapNumCampioni = array();
	/**
	 * 
	 * @var TableProvincia
	 */
	var $_tableProvincia;
	/**
	 * 
	 * @var TableRegione
	 */
	var $_tableRegione;


	function __construct()
	{
		global $mainframe, $option;
		parent::__construct();
		$table = $this->getTable( 'campione' );
		$this->_tableProvincia = $this->getTable( 'provincia' );
		$this->_tableRegione = $this->getTable( 'regione' );
		$this->_tableName = $table->getTableName();
		$ids = JRequest::getVar( 'cid', null, 'default', 'array' );
		$this->setIds( $ids );
		$this->campioni = array();
		$filterRegioneId = $mainframe->getUserStateFromRequest( $option.'filter_regioneid', 'filter_regioneid', 0, 'int' );
		$this->setState('filterRegioneId', $filterRegioneId);
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

	function _buildQuery( $all = false )
	{
		$body = $this->_buildQueryBody();
		$where = ($all) ? '' : $this->_buildQueryWhere();
		$orderBy =  $this->_buildQueryOrderBy();
		$query = 'SELECT c.*, p.id AS pid, p.id_regione, p.provincia AS provincianome, p.sigla, r.id AS rid, r.regione' .
		         $body .
				 $where .
		         $orderBy
				 ;
		return $query;

	}
	
	function _buildQueryBody() 
	{
		$province = $this->_tableProvincia->getTableName();
		$regioni = $this->_tableRegione->getTableName();
		return  ' FROM ' . $this->_tableName . ' AS c' . 
				' LEFT JOIN ' . $province . ' AS p ON p.sigla = c.provincia' .
				' LEFT JOIN ' . $regioni . ' AS r ON p.id_regione = r.id';
	}
	
	function _buildQueryWhere() 
	{
		global $mainframe, $option;

		$filterRegioneId = $this->getState('filterRegioneId');
		return ( $filterRegioneId === 0 ) ? '' : ' WHERE r.id = ' . $filterRegioneId;
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
		if (empty( $this->_campioni))
		{
			$query = $this->_buildQuery();
			$limitstart = $this->getState('limitstart');
			$limit = $this->getState('limit');
			$list  = $this->_getList($query, $limitstart, $limit);
			$this->_campioni = $this->_loadCampioni( $list );
		}
		return $this->_campioni;
	}

	function getAllCampioni()
	{
		if (empty( $this->_allCampioni ))
		{
			$query = $this->_buildQuery( true );
			$list  = $this->_getList($query);
			$this->_allCampioni = $this->_loadCampioni( $list );
		}
		return $this->_allCampioni;
	}

	function getNumCampioniByRegione( $regioneArg )
	{
		$map = $this->getMapCampioniPerRegione();
		return @$map[$regioneArg->getId()];
	}

	function getMapCampioniPerRegione()
	{
		if ( empty($this->_mapNumCampioni)) {
			$query = 'SELECT r.id AS rid, COUNT(*) AS numCampioni' .
					 $this->_buildQueryBody() .
					 ' GROUP BY r.id';
			$list = $this->_getList($query);
			foreach ($list as $nCampioni) {
				$this->_mapNumCampioni[$nCampioni->rid] = $nCampioni->numCampioni;
			}
		}
		return $this->_mapNumCampioni;
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
			$filterRegioneId = $this->getState('filterRegioneId');
			if (empty($filterRegioneId)) {
				$query = 'SELECT COUNT(*)' .
						 ' FROM ' . $this->_tableName;
			} else {
				$query = 'SELECT COUNT(*)' .
					 $this->_buildQueryBody() .
					 $this->_buildQueryWhere();
			}
			$this->_db->setQuery($query);
			$this->_total = $this->_db->loadResult();
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
		$campioni = array();
		foreach ( $objList as $obj) {
			$campioni[] = $this->_loadCampione($obj);
		}
		return $campioni;
	}

	function _loadCampione($obj) {
		$campione = new Campione();
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
		if ($obj->pid) {
			$provincia = new Provincia();
			$provincia->setId($obj->pid);
			$provincia->setNome($obj->provincianome);
			$provincia->setSigla($obj->sigla);
			if ($obj->rid) {
				$regione = new Regione();
				$regione->setId($obj->rid);
				$regione->setNome($obj->regione);
				$provincia->setRegione($regione);
			}
			$campione->setProvincia($provincia);
		} else {
			$campione->_siglaProvincia = $obj->provincia;
		}
		$campione->_figliNum = $obj->figli_num;
		$campione->_figliEtaMedia = $obj->figli_eta_media;
		$campione->_codiceCommento = $obj->codice_commento;

		return $campione;
	}

	function setDelivered( $bool = true )
	{
		jimport('joomla.utilities.date');
		$campione = new CampioniModelCampione();
		$cids = $this->_ids;
		/*$config =& JFactory::getConfig();
		 $tzoffset = $config->getValue('config.offset');
		 //the offset is applied when doing this:
		 $offsetdate = JFactory::getDate();
		 $offsetdate->toMySQL(true);
		 $offsetdate->setOffset($tzoffset);*/
		$date = date("Y-m-d - H:i:s");
		foreach ($cids as $cid) {
			$campione->setId($cid);
			$campione->setDataSpedizione($date);
			$campione->store();
		}
	}

	function isPresentJoomlaUser($id)
	{
		$db = $this->getDBO();
		$query = 'SELECT id FROM ' . $this->_tableName . ' WHERE id_utente = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);
		$result = $db->loadResult();
		if ( !empty($result) )  {
			return true;
		} else {
			return false;
		}
	}

	function getCampioneByUserId($id)
	{
		$db = $this->getDBO();
		$query = 'SELECT * FROM ' . $this->_tableName . ' WHERE id_utente = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);
		$result = $db->loadObject();
		if ( !empty($result) )  {
			return $this->_loadCampione($result);
		} else {
			return false;
		}
	}		
	
}
?>
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelProvincia extends JModel
{
	/**
	 *
	 * @var TableProvincia
	 */
	var $_provincia;
	/**
	 *
	 * @var CampioniModelRegione
	 */
	var $_regione;

	function __construct()
	{
		parent::__construct();
		$this->_provincia = $this->getTable( 'Provincia', 'Table' );
		$this->_regione = $this->getInstance( 'regione', 'CampioniModel' );
	}

	function setId( $id ) {
		$this->_provincia->id = $id;
	}

	function getId() {
		return $this->_provincia->id;
	}
	
	function setNome( $nome ) {
		$this->_provincia->provincia;
	}
	
	function getNome() {
		return $this->_provincia->provincia;
	}

	function setSigla( $sigla ) {
		$this->_provincia->sigla = $sigla;
	}

	function getSigla() {
		return $this->_provincia->sigla;
	}

	function setRegione( $regione ) {
		$this->_regione = $regione;
	}

	function getRegione() {
		if ( !$this->_regione->getId() ) {
			$this->_regione->setId( $this->_provincia->id_regione );
			$this->_regione->load();
		}
		return $this->_regione;
	}

	function load() {
		if ( $this->_provincia->id) {
			$this->_provincia->load();
		} else if ( $sigla = $this->_provincia->sigla) {
			$db = $this->_provincia->getDBO();
			$query = "SELECT * FROM " . $this->_provincia->getTableName() ." WHERE sigla = " . $db->Quote($sigla);
			$db->setQuery( $query );
			$prov = $db->loadObject();
			if ( empty( $prov ) ) {
				$this->setError( 'Sigla non trovata' );
				return false;
			}
			$this->_provincia->id = $prov->id;
			$this->_provincia->id_regione = $prov->id_regione;
			$this->_provincia->provincia = $prov->provincia;
			$this->_provincia->sigla = $prov->sigla;
			return true;
		}
		if ( _regione != null ) {
			$this->_regione->load();
		}
	}

	function bind() {
		$this->_provincia->bind( JRequest::get('post') );
	}
}
?>
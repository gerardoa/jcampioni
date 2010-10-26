<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
JLoader::register('Provincia', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'provincia.php' );

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
		$this->setId(0);
	}

	function getSigla() {
		return $this->_provincia->sigla;
	}

	function setRegione( $regione ) {
		$this->_regione = $regione;
	}

	function getRegione() {
		if ( !$this->_regione ) {
			$this->_regione = $this->getInstance( 'regione', 'CampioniModel' );
			$this->_regione->setId( $this->_provincia->id_regione );
			$this->_regione->load();
		}
		return $this->_regione;
	}

	function load() {
		$provincia = null;
		if ( $this->_provincia->id) {
			$this->_provincia->load();
			$provincia = new Provincia();
			$provincia->setId($this->_provincia->id);
			$provincia->_idRegione = $this->_provincia->id_regione;
			$provincia->setNome($this->_provincia->provincia);
			$provincia->setSigla($this->_provincia->sigla);	
		} else if ( $sigla = $this->_provincia->sigla) {
			$db = $this->_provincia->getDBO();
			$query = "SELECT * FROM " . $this->_provincia->getTableName() ." WHERE sigla = " . $db->Quote($sigla);
			$db->setQuery( $query );
			$prov = $db->loadObject();
			if ( empty( $prov ) ) {
				$this->setError( 'Sigla non trovata' );
				return null;
			}
			$provincia = new Provincia();
			$this->_provincia->id = $prov->id;
			$provincia->setId($prov->id);
			$this->_provincia->id_regione = $prov->id_regione;
			$provincia->_idRegione = $prov->id_regione;
			$this->_provincia->provincia = $prov->provincia;
			$provincia->setNome($prov->provincia);
			$this->_provincia->sigla = $prov->sigla;
			$provincia->setSigla($prov->sigla);			
		}
		return $provincia;
	}

	function bind() {
		$this->_provincia->bind( JRequest::get('post') );
	}
}
?>
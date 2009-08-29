<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');
JLoader::register('Regione', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'regione.php' );

class CampioniModelRegione extends JModel
{
	/**
	 *
	 * @var TableRegione
	 */
	var $_regione;

	function __construct()
	{
		parent::__construct();
		$this->_regione = $this->getTable( 'Regione', 'Table' );
	}

	function setId( $id ) {
		$this->_regione->id = $id;
	}

	function getId() {
		return $this->_regione->id;
	}

	function setNome( $regione ) {
		$this->_regione->regione = $regione;
	}

	function getNome() {
		return $this->_regione->regione;
	}

	function load() {
		$this->_regione->load();
		$regione = new Regione();
		$regione->setId($this->_regione->id);
		$regione->setNome($this->_regione->regione);
		return $regione;
	}

}
?>
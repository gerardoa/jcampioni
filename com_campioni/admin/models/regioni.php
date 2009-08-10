<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelRegioni extends JModel
{

	var $_regioni;
	var $_regioneTableName;

	function __construct()
	{
		parent::__construct();
		$regioneTable = $this->getTable( 'regione' );
		$this->_regioneTableName = $regioneTable->getTableName();
	}

	function findAll()
	{
		$db = $this->getDBO();
		$query = 'SELECT * FROM ' . $this->_regioneTableName . ' ORDER BY regione';
		$db->setQuery( $query );
		$this->_loadRegioni( $db->loadObjectList() );
		return $this->_regioni;
	}

	function _loadRegioni( $objList )
	{
		$this->_regioni = array();
		foreach ($objList as $obj) {
			$regione = $this->getInstance( 'regione', 'CampioniModel' );
			$regione->setId( $obj->id );
			$regione->setNome( $obj->regione );
			$this->_regioni[] = $regione;
		}
	}
	
	function getRegioneById($id) 
	{
		if(empty($this->_regioni)) 
		{
			$this->findAll();
		}
		foreach ($this->_regioni as $regione) {
			if ($regione->getId() == $id) {
				return $regione;
			}
		}
		return null;
	}
}
?>
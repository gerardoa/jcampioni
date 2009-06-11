<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class TableRegione extends JTable
{
	var $id = null;
	var $regione = null;
	
	function __construct(&$db)
	{
		parent::__construct( 'regioni', 'id', $db );
	}
	
	function loadAll()
	{
		$db = $this->getDBO();
		$query = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY regione';
		$db->setQuery( $query );
		return $db->loadObjectList();
	}
	
}
?>
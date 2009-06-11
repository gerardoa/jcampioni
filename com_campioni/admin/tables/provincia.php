<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class TableProvincia extends JTable
{
	var $id = null;
	var $id_regione = null;
	var $provincia = null;
	var $sigla = null;
	
		
	function __construct(&$db)
	{
		parent::__construct( 'province', 'id', $db );
	}
	
	function loadBySigla($sigla)
	{
		$this->reset();
		$this->id = null;
		$db = $this->getDBO();
		$query = "SELECT * FROM province WHERE sigla = " . $db->Quote($sigla); 
		$db->setQuery( $query );
		$prov = $db->loadObject();
		if ( empty( $prov ) ) {
			$this->setError( 'Sigla non trovata' );
			return false;
		}
		$this->id = $prov->id;
		$this->id_regione = $prov->id_regione;
		$this->provincia = $prov->provincia;
		$this->sigla = $prov->sigla;
		return true;
	}
}
?>
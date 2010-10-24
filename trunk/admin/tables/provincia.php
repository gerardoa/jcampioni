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
		parent::__construct( '#__province', 'id', $db );
	}	
	
}
?>
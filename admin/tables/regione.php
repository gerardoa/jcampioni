<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class TableRegione extends JTable
{
	var $id = null;
	var $regione = null;
	var $region_code = null;
	
	function __construct(&$db)
	{
		parent::__construct( '#__regioni', 'id', $db );
	}	
}
?>
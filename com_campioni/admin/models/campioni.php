<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampioni extends JModel
{
	var $_campioni;

	
	function _buildQuery() 
	{
		$tableName = '#__campioni_richieste';
		$query = ' SELECT * FROM ' . $tableName;
		return $query;
		
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
	        $query = $this->_buildQuery();
	        $this->_campioni = $this->_getList( $query );
	        $provincia = $this->getTable( 'Provincia', 'Table' );
	        foreach ($this->_campioni as $campione) {
	        	$provincia->loadBySigla( $campione->provincia );
	        	$campione->prov_nome = $provincia->provincia;
	        }
	    }
	    return $this->_campioni;
	}	
}
?>
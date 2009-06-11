<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampione extends JModel
{
	var $_id = null;
	var $_campione = null;
	
	function __construct()
	{
		parent::__construct();
		$id = JRequest::getVar( 'cid', null, 'default', 'array' );
		$this->_id = $id[0];
	}
	
	function getCampione()
	{
		$campione = $this->getTable();
		$campione->load($this->_id);
		$user = new JUser();
		if ( $user->load($campione->id_utente) )
		{
			$campione->username = $user->username;
		}
		$this->_campione = $campione;
		return $this->_campione;
	}
	
	function save()
	{
		$campione = $this->getTable();
		if ( !$campione->save( JRequest::get( 'post' ) ) ) {
			$this->setError( $campione->getError() );
			return false;
		}
		return true;
	}
}
?>
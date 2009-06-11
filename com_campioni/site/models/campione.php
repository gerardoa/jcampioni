<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioneModelCampione extends JModel
{
	var $tableRichieste = '#__campioni_richieste';
	var $_numOrder = null;
	
	function save() 
	{
		$err = false;
		//Getting data
		$user = JFactory::getUser();
		JRequest::setVar( "registrazione", date("Y-m-d")." - ".date("H:i:s") );
		JRequest::setVar( "ip", $_SERVER["REMOTE_ADDR"] );
		JRequest::setVar( "id_utente", $user->id );
		JRequest::setVar( 'email', $user->email );
		if ( !$this->_bindFigli() ) {
			$err = true;
		}
		$kitMap = $this->getKitMap();
		$kitName = $kitMap[ JRequest::getVar( 'kit' ) ];
		if ( !$kitName ) {
			$this->setError( JText::_('Kit non valido') );
			$err = true;
		} else {
			JRequest::setVar( 'kit', $kitName );
		}
		$campione = $this->getTable();
		
		if ( !$campione->bind(JRequest::get('post')) )
		{
			$this->setError( $campione->getErrors() );
			return false;
		}
		
		if ( !$campione->check() )
		{
			$this->setError( $campione->getErrors() );
			$err = true;
		}
		
		if ( $err ) {
			return false;
		}
			
		if ( !$campione->store() ) {
			$this->setError( $campione->getErrors() );
			return false;
		}
		
		$this->_numOrder = $campione->id;
		return true;
		
	}
	
	function getKitMap() 
	{
		$kit = array( 
			'1' => 'Benessere gambe',
			'2' => 'Igiene intima',
		    '3' => 'Bambino'
		);
		return $kit;
	}
	
	function getNumOrder()
	{
		return $this->_numOrder;
	}
	
	function _bindFigli() 
	{
		$figli_eta_media = 0;
		$figliDirty = JRequest::getVar( 'figli', array(), 'post', 'array' );
		$figli = array();
		foreach ($figliDirty as $etaD) {
			if ( $etaD != '') {
				$figli[] = $etaD;
			}
		}
		$figli_num = count($figli);
		if ( $figli_num !== 0 ) {			
			foreach ($figli as $eta) 
			{
				if ( !preg_match( '/[0-9]{1,2}/', $eta ) ) {
					$this->setError( JText::_('L\'eta dei figli deve essere un numero di max 2 cifre') );
					return false;
				}				
				$figliEtaTot += $eta;
			}
			$figli_eta_media = $figliEtaTot / $figli_num;			
		}
		JRequest::setVar( 'figli_eta_media', $figli_eta_media );
		JRequest::setVar( 'figli_num', $figli_num );
		return true;
	}
	
	function isPresentJoomlaUser($id)
	{
		$db = $this->getDBO();
		$query = 'SELECT id FROM ' . $this->tableRichieste . ' WHERE id_utente = ' . $db->Quote($id);
		$db->setQuery($query, 0, 1);
		$result = $db->loadResult();
		if ( !empty($result) )  {
			return true;
		} else {
			return false;
		}
	}
}
?>
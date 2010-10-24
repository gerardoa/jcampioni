<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
class TableCampione extends JTable
{
	var $id = null;
	var $id_utente = null;
	var $registrazione = null;
	var $ip = null;
	var $nome = null;
	var $cognome = null;
	var $eta = null;
	var $email = null;
	var $indirizzo = null;
	var $provincia = null;
	var $citta = null;
	var $cap = null;
	var $kit = null;
	var $richiesta_stato = null;
	var $figli_num = null;
	var $figli_eta_media = null;
	var $data_spedizione = null;
	var $codice_commento = null;
	var $data_commento = null;
	var $testo_commento = null;
	var $voto_commento = null;
	
	
	function __construct(&$db)
	{
		parent::__construct( '#__campioni_richieste', 'id', $db );
	}
	
	function check()
	{
		$err = false;
		if ( ($this->id_utente == null)|| ($this->registrazione == null) || ($this->ip == null) ) {
			$this->setError( JText::_('Non valid internal field') );
			$err = true;
		}
		if ( ! preg_match("/^[a-z][a-z ]{2,25}$/i", $this->nome) ) {
			$this->setError( JText::_('Il nome deve essere di almeno 3 caratteri e massimo 25') );
			$err = true;
		}
		$this->nome = ucwords( strtolower( $this->nome) );
		if ( ! preg_match("/^[a-z][a-z ']{2,25}$/i", $this->cognome) ) {
			$this->setError( JText::_('Il cognome deve essere di almeno 3 caratteri e massimo 25') );
			$err = true;
		}
		$this->cognome = ucwords( strtolower( $this->cognome) );
		if ( (!preg_match("/^[0-9]+$/i", $this->eta)) || (!preg_match("/^[0-9]+$/i", $this->figli_num) ) ) {
			$this->setError( JText::_('Eta\' propria o dei figli non valida/e') );
			$err = true;
		}
		if ( !preg_match("/^[0-9]{5,5}$/i", $this->cap) ) {
			$this->setError( JText::_('Il CAP deve essere di 5 cifre.') );
			$err = true;
		}
		//can be float
		if ( !preg_match("/^[0-9\.]+$/i", $this->figli_eta_media) ) {
			$this->setError( JText::_('Eta media non valida') );
			$err = true;
		}
		jimport('joomla.mail.helper');
		if ( !JMailHelper::isEmailAddress( $this->email ) ) {
			$this->setError( JText::_('Non valid email address') );
			$err = true;
		}
		if ( !preg_match("/^[a-z][a-z]$/i", $this->provincia) ) {
			$this->setError( JText::_('La provincia deve essere di sole 2 lettere.') );
			$err = true;
		}
		$this->indirizzo = ucwords( strtolower( $this->indirizzo) );
		$this->provincia = strtoupper( $this->provincia);
		$this->citta = ucwords( strtolower( $this->citta) );
		if ( $err )
			return false;
		return true;
	}
	
	function getStatoDefault()
	{
		return 0;
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
}
?>
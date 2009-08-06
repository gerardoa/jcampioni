<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampione extends JModel
{
	/**
	 *
	 * @var TableCampione
	 */
	var $_campione = null;
	/**
	 *
	 * @var CampioniModelProvincia
	 */
	var $_provincia = null;
	/**
	 *
	 * @var CampioniModelRegione
	 */
	var $_regione = null;

	var $_username = null;

	function __construct()
	{
		parent::__construct();
		$id = JRequest::getVar( 'cid', null, 'default', 'array' );
		$this->_campione = $this->getTable();
		$this->_campione->id = $id[0];
	}

	function getTableCampione(){
		return $this->_campione;
	}

	function getRegione() {
		return $this->_regione;
	}

	function setId( $id ) {
		$this->_campione = $this->getTable();
		$this->_campione->id = $id;
	}

	function getId() {
		return $this->_campione->id;
	}


	function setIdUtente( $idUtente ) {
		$this->_campione->id_utente = $idUtente;
	}

	function getIdUtente() {
		return $this->_campione->id_utente;
	}

	function setRegistrazione( $registrazione ) {
		$this->_campione->registrazione = $registrazione;
	}

	function getRegistrazione() {
		return $this->_campione->registrazione;
	}


	function setIp( $ip ) {
		$this->_campione->ip = $ip;
	}

	function getIp() {
		return $this->_campione->ip;
	}

	function setNome( $nome ) {
		$this->_campione->nome = $nome;
	}

	function getNome() {
		return $this->_campione->nome;
	}

	function  setCognome( $cognome ) {
		$this->_campione->cognome = $cognome;
	}

	function getCognome() {
		return $this->_campione->cognome;
	}

	function setEta( $eta ) {
		$this->_campione->eta = $eta;
	}

	function getEta() {
		return $this->_campione->eta;
	}

	function setEmail( $email ) {
		$this->_campione->email = $email;
	}

	function getEmail() {
		return $this->_campione->email;
	}

	function setIndirizzo( $indirizzo ) {
		$this->_campione->indirizzo = $indirizzo;
	}

	function getIndirizzo() {
		return $this->_campione->indirizzo;
	}

	function setProvincia( $provincia ) {
		$this->_provincia = $provincia;
	}

	/**
	 * 
	 * @return CampioniModelProvincia
	 */
	function getProvincia() {
		if ($this->_provincia) {
			return $this->_provincia;
		}
		// Try to load
		if ($this->_campione->provincia) {
			$provincia = $this->getInstance( 'provincia', 'CampioniModel' );
			$provincia->setSigla($this->_campione->provincia);
			$provincia->load();
			return $this->_provincia = $provincia;
		}
		return null;
	}

	function setCitta( $citta ) {
		$this->_campione->citta = $citta;
	}

	function getCitta() {
		return $this->_campione->citta;
	}

	function setCap( $cap ) {
		$this->_campione->cap = $cap;
	}

	function getCap() {
		return $this->_campione->cap;
	}

	function setKit( $kit ) {
		$this->_campione->kit = $kit;
	}

	function getKit() {
		return $this->_campione->kit;
	}

	function setRichiestaStato( $richiestaStato ) {
		$this->_campione->richiesta_stato = $richiestaStato;
	}

	function getRichiestaStato() {
		return $this->_campione->richiesta_stato;
	}

	function setUserName( $username ) {
		$this->username = $username;
	}

	function getUserName() {
		return $this->username;
	}

	function addEtaFiglio( $etaFiglio ) {
		$etaMedia = $this->getFigliEtaMedia();
		$numFigli = $this->getFigliNum();
		if ($etaMedia != 0 && $numFigli != 0) {
			$s1 = ($etaMedia * $numFigli) / ($numFigli + 1);
			$s2 = $etaFiglio / ($numFigli + 1);
			$this->_campione->figli_num = $numFigli + 1;
			$this->_campione->figli_eta_media = $s1 + $s2;
		} else {
			$this->_campione->figli_num = 1;
			$this->_campione->figli_eta_media = $etaFiglio;
		}

	}

	function getFigliNum() {
		return $this->_campione->figli_num;
	}

	function getFigliEtaMedia() {
		return $this->_campione->figli_eta_media;
	}

	function getNumOrder()
	{
		return $this->_campione->id;
	}
	
	function setDataSpedizione($data) {
		$this->_campione->data_spedizione = $data;
	}
	
	function getDataSpedizione() {
		return $this->_campione->data_spedizione;
	}
	
	function bind() {
		$err = false;
		$user = JFactory::getUser();

		$this->setRegistrazione( date("Y-m-d")." - ".date("H:i:s") );
		$this->setIp( $_SERVER["REMOTE_ADDR"] );
		$this->setIdUtente( $user->id );
		$this->setEmail( $user->email );
		$this->setRichiestaStato( $this->_campione->getStatoDefault() );
		if ( !$this->_bindFigli() ) {
			$err = true;
		}
		$kitMap = $this->getKitMap();
		$kitName = $kitMap[ JRequest::getVar( 'kit' ) ];
		if ( !$kitName ) {
			$this->setError( JText::_('Kit non valido') );
			$err = true;
		} else {
			$this->setKit( $kitName );
		}
		//all other implicit fields
		$binded = $this->_campione->bind(JRequest::get('post'));
		if ( !$binded  ) {
			$this->setError( $this->_campione->getErrors() );
			return false;
		}

		if ( !$this->_campione->check() )
		{
			$this->setError( $this->_campione->getErrors() );
			$err = true;
		}

		if ( $err ) {
			return false;
		}
		return true;
	}

	function _bindFigli()
	{
		$figliDirty = JRequest::getVar( 'figli', array(), 'post', 'array' );
		$figli = array();
		foreach ($figliDirty as $etaD) {
			if ( $etaD != '') {
				if ( !preg_match( '/[0-9]{1,2}/', $eta ) ) {
					$this->setError( JText::_('L\'eta dei figli deve essere un numero di max 2 cifre') );
					return false;
				}
				$this->addEtaFiglio($etaD);
			}
		}
		return true;
	}

	function getKitMap()
	{
		return $this->_campione->getKitMap();
	}
	
	function toArrayValues()
	{
		$provincia = $this->getProvincia();
		$values = array($this->getId(), $this->getIp(), $this->getNome(), $this->getCognome(),
		$this->getEta(), $this->getEmail(), $this->getIndirizzo(), $provincia->getNome(), $provincia->getSigla(),
		$this->getCitta(), $this->getCap(), $this->getKit(), $this->getFigliNum(), $this->getFigliEtaMedia(),
		$this->getRegistrazione(), $this->getDataSpedizione()
		);
		return $values;
	}

	function load()
	{
		$this->_campione->load($this->_id);
		$this->_loadUserName();
		return $this;
	}

	function _loadUserName()
	{
		if ( $userId = $this->getIdUtente()) {
			$user = new JUser();
			if ( $user->load($userId) )
			{
				$this->setUserName($user->username);
			}
		}
	}

	function store()
	{
		if ( !$this->_campione->store() ) {
			$this->setError( $this->_campione->getError() );
			return false;
		}
		return true;
	}

	function save()
	{
		if ($this->bind()) {
			$this->store();
			return true;
		}
		return false;
	}

	function isPresentJoomlaUser($id)
	{
		$db = $this->getDBO();
		$query = 'SELECT id FROM ' . $this->_campione->getTableName() . ' WHERE id_utente = ' . $db->Quote($id);
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
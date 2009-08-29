<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class Provincia
{
	var $_id = null;
	var $_idRegione;
	var $_provincia = null;
	var $_sigla = null;
	
	/**
	 *
	 * @var Regione
	 */
	var $_regione;

	function setId( $id ) {
		$this->_id = $id;
	}

	function getId() {
		return $this->_id;
	}
	
	function setNome( $nome ) {
		$this->_provincia = $nome;
	}
	
	function getNome() {
		return $this->_provincia;
	}

	function setSigla( $sigla ) {
		$this->_sigla = $sigla;
	}

	function getSigla() {
		return $this->_sigla;
	}

	function setRegione( $regione ) {
		$this->_regione = $regione;
	}

	function getRegione() {
		static $regioneModel;
		if ( !$this->_regione ) {
			if (!$regioneModel) {
				$regioneModel = JModel::getInstance( 'regione', 'CampioniModel' );
			}			
			$regioneModel->setId( $this->_idRegione );
			$this->_regione = $regioneModel->load();
		}
		return $this->_regione;
	}
}
?>
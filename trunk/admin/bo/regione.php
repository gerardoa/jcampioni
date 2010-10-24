<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class Regione
{
	var $_id;
	var $_regione;
	
	function setId( $id ) {
		$this->_id = $id;
	}

	function getId() {
		return $this->_id;
	}

	function setNome( $regione ) {
		$this->_regione = $regione;
	}

	function getNome() {
		return $this->_regione;
	}
}
?>
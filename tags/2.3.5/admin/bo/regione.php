<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

class Regione
{
	var $_id;
	var $_regione;
	var $_regionCode;

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

	function setRegionCode( $regionCode ) {
		$this->_regionCode = $regionCode;
	}

	function getRegionCode() {
		return $this->_regionCode;
	}
}
?>
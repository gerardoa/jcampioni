<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JLoader::register( 'CampioniViewBaseCampione', JPATH_COMPONENT_ADMINISTRATOR.DS.'views'.DS.'campione'.DS.'campione.php');

class CampioneViewCampione extends CampioniViewBaseCampione
{

	function display( $tpl = null )
	{
		$this->_showCampione();
		parent::display( $tpl );
	}

	
}
?>
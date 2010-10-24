<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
JLoader::register( 'CampioniViewBaseCampione', JPATH_COMPONENT_ADMINISTRATOR.DS.'views'.DS.'campione'.DS.'campione.php');

class CampioniViewCampione extends CampioniViewBaseCampione
{
	function display( $tpl = null )
	{
		$this->_showCampione();
		$campione = $this->getModel();
		$isNew = ( $campione->getId() < 1 );
		$text = ($isNew) ? JText::_( 'New' ) : JText::_( 'Edit' );
		
		JToolBarHelper::title( JText::_('Campione') . ':<small>[ ' . $text . ' ]</small>');
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		$this->assignRef( 'isNew', $isNew );
		parent::display( $tpl );		
	}
}
?>
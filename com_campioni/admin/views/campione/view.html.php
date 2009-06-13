<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewCampione extends JView
{
	function display( $tpl = null )
	{
		$campione = $this->getModel();
		$isNew = ( $campione->id < 1 );
		$text = ($isNew) ? JText::_( 'New' ) : JText::_( 'Edit' );
		
		JToolBarHelper::title( JText::_('Campione') . ':<small>[ ' . $text . ' ]</small>');
		JToolBarHelper::save();
		JToolBarHelper::cancel();
		

		$this->assignRef( 'campione', $campione );
		parent::display( $tpl );
	}
}
?>
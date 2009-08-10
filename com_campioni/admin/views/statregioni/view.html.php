<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewStatRegioni extends JView
{
	function display( $tpl = null )
	{
		global $mainframe, $option;
		JToolBarHelper::title( JText::_('Statistica Regioni') );
		JToolBarHelper::cancel();

		$this->assignRef( 'campioniModel', $this->getModel() );
		$this->assignRef( 'regioniModel', $this->getModel( 'regioni' ) );

		parent::display( $tpl );
	}
}
?>
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewCampioni extends JView
{
	function display( $tpl = null )
	{
		JToolBarHelper::title( JText::_('Campioni') );
		//JToolBarHelper::addNew();
		//JToolBarHelper::editList();
		JToolBarHelper::trash();
		
		$campioni = $this->get( 'Campioni' );
		$this->assignRef( 'campioni', $campioni );
		
		parent::display( $tpl );
	}
}
?>
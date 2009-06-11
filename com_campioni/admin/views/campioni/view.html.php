<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewCampioni extends JView
{
	function display( $tpl = null )
	{
		global $mainframe, $option;
		JToolBarHelper::title( JText::_('Campioni') );
		//JToolBarHelper::addNew();
		//JToolBarHelper::editList();
		JToolBarHelper::deleteListX( JText::_('Vuoi davvero eliminarlo/i?') );
		
		$lists = array();
		$filterOrder = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'registrazione' );
		$filterOrderDir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'DESC' );
		$lists['order'] = $filterOrder; 
		$lists['order_Dir'] = $filterOrderDir;
		
		$filterRegioneId = $mainframe->getUserStateFromRequest( $option.'filter_regioneid', 'filter_regioneid' );
		$regioni = $this->get( 'Regioni' );
		$options = array();
		$options[] = JHTML::_( 'select.option', '0', '- '.JText::_('Tutte le Regioni').' -', 'id', 'regione' );
		// append database results
		$options = array_merge( $options, $regioni );
		$js = 'onchange="document.adminForm.submit();"';
		$lists['regioneid'] = JHTML::_( 'select.genericlist', $options, 'filter_regioneid', 'class="inputbox" size="1" '.$js, 'id', 'regione', $filterRegioneId);
		
		
		$this->assignRef( 'lists', $lists );
		$campioni = $this->get( 'Campioni' );
		$this->assignRef( 'campioni', $campioni );
		
		parent::display( $tpl );
	}
}
?>
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewCampioni extends JView
{
	function __construct()
	{
		parent::__construct();
	}
	function display( $tpl = null )
	{
		global $mainframe, $option;
		JToolBarHelper::title( JText::_('Campioni') );
		JToolBarHelper::addNew();
		//JToolBarHelper::editList();
		JHTML::_('stylesheet', 'campioni.css', 'administrator/components/com_campioni/css/');
		JToolBarHelper::customX( 'delivered', 'letter', 'spedito', JText::_('Spedito') );
		JToolBarHelper::customX( 'statisticaregioni', 'italyflag', 'statistica regioni', JText::_('Statistica Regioni'), false);
		JToolBarHelper::customX('exportToCVS', 'export', 'esporta', JText::_('Esporta'), false);
		JToolBarHelper::customX( 'testConfirmEmail', 'emailserver', 'test email', JText::_('Test Email di Conferma'), false );
		JToolBarHelper::deleteListX( JText::_('Vuoi davvero eliminarlo/i?') );
		JToolBarHelper::preferences( 'com_campioni', 600, 700 );		

		$lists = array();
		$lists['order'] = $mainframe->getUserStateFromRequest( $option.'filter_order', 'filter_order', 'registrazione' );
		$lists['order_Dir'] = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'DESC' );

		$lists['regioneid'] = $this->_regioniToSelectList();

		$this->assignRef( 'pageNav', $this->get( 'Pagination') );
		$this->assignRef( 'lists', $lists );
		$campioni = $this->get( 'Campioni' );
		$this->assignRef( 'campioni', $campioni );

		parent::display( $tpl );
	}

	function _regioniToSelectList()
	{
		global $mainframe, $option;
		$campioni = $this->getModel();
		$modelRegioni = $this->getModel( 'regioni' );
		$regioni = $modelRegioni->findAll();
		$regioniSelect = array();
		foreach ($regioni as $regione) {
			$regioneSelect = new stdClass();
			$regioneSelect->id = $regione->getId();
			$regioneSelect->optionText = $regione->getNome() . ' (' . $campioni->getNumCampioniByRegione($regione) . ')';
			$regioniSelect[] = $regioneSelect;
		}
		$options = array();
		$options[] = JHTML::_( 'select.option', '0', '- '.JText::_('Tutte le Regioni').' -', 'id', 'optionText' );
		// append database results
		$options = array_merge( $options, $regioniSelect );
		$js = 'onchange="document.adminForm.submit();"';
		$filterRegioneId = $mainframe->getUserStateFromRequest( $option.'filter_regioneid', 'filter_regioneid' );
		return JHTML::_( 'select.genericlist', $options, 'filter_regioneid', 'class="inputbox" size="1" '.$js, 'id', 'optionText', $filterRegioneId);
	}
}
?>
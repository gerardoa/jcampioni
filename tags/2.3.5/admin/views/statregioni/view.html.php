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
	
	function regionThematicMap() {
		$campioniModel = $this->getModel();
		$regioniModel  = $this->getModel( 'regioni' );
		$map = $campioniModel->getMapCampioniPerRegione();
		$max = 0;
		foreach ($map as $idRegione => $numCampioni) {
			$regione = $regioniModel->getRegioneById($idRegione);
			if(!empty($regione)) {
				$regionCodes[] = $regione->getRegionCode();
				$campioni[] = $numCampioni;
				if ($numCampioni > $max) $max = $numCampioni;
			}
		}
		$host = 'http://chart.apis.google.com/chart?';
		$p = array();
		$p[] = 'cht=map'; //:auto=40,40,40,40;
		$p[] = 'chs=600x500';
		$p[] = 'chld=' . implode('|', $regionCodes);
		$p[] = 'chd=t:'  . implode(',', $campioni);
		$p[] = 'chds=' . '0,' . $max;
		$p[] = 'chco=' . 'CCCCCC,FFFFFF,FF0000';
		//$p[] = 'chm=fLazio,000000,0,0,10';
		$p[] = 'chtt=Regione';
		return $host . implode('&', $p);
	}
}
?>
<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioneViewOrdineInviato extends JView
{
	function display( $tpl = null )
	{
		$numOrder = $this->get( 'NumOrder' );
		$this->assignRef( 'numOrder', $numOrder );
		parent::display( $tpl );
	}
}
?>
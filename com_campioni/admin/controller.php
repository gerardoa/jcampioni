<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class CampioniController extends JController
{
	function display()
	{
		parent::display();
	}
	
	function remove()
	{
		$model = $this->getModel( 'campione' );
		if ( $model->delete() )
		{
			$msg = JText::_( 'Campione eliminao(i)' );
		}
		else 
		{
			$msg = JText::_( 'Errore durante l\'eliminazione dei records' );
		}
		$link = 'index.php?option=com_campioni';
		$this->setRedirect($link, $msg);
	}
}
?>
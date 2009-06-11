<?php
//Editing Model, not working
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
		$model = $this->getModel( 'campioni' );
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
	
	function edit() 
	{
		$view = $this->getView( 'campione', 'html' );		
		$view->setModel( $this->getModel( 'campione' ), true );
		$view->display();
	}
	
	function save()
	{
		$model = $this->getModel( 'campione' );
		if ( $model->save() )
		{
			$msg = JText::_( 'Campione salvato' );
		    $link = 'index.php?option=com_campioni';
		    $this->setRedirect($link);
		} 
		else 
		{
			$msg = JText::_( 'Salvataggio fallito<p><ol>' . $model->getError() . '</ol></p>' );
			JError::raiseWarning( 'DATI INVALIDI', $msg );
			$this->edit();
		}	
	}
	
	function add() 
	{
		
		$viewSite->setModel( $modelSite, true );
		$viewSite->display();
	}

}
?>
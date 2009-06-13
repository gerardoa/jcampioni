<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class CampioniController extends JController
{
	function display()
	{
		$view = $this->getView( 'campioni', 'html' );
		$view->setModel( $this->getModel( 'campioni' ), true);
		$view->setModel( $this->getModel( 'regioni' ) );
		$view->display();
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
		$link = JRoute::_( 'index.php?option=com_campioni' );
		$this->setRedirect($link, $msg);
	}

	function edit()
	{
		$view = $this->getView( 'campione', 'html' );
		$model = $this->getModel( 'campione' );
		$model->load();
		$view->setModel( $model, true );
		$view->display();
	}

	function save()
	{
		$model = $this->getModel( 'campione' );
		if ( $model->save() )
		{
			$msg = JText::_( 'Campione salvato' );
			$link = JRoute::_('index.php?option=com_campioni');
			$this->setRedirect($link, JText::_('Salvataggio eseguito') );
		}
		else
		{
			$msg = JText::_( 'Salvataggio fallito<p><ol>' . $model->getError() . '</ol></p>' );
			JError::raiseWarning( 'DATI INVALIDI', $msg );
			$view = $this->getView( 'campione', 'html' );
			$view->setModel( $model, true );
			$view->display();
		}
	}

	function add()
	{
		$view = $this->getView( 'campione', 'html' );
		$model = $this->getModel( 'campione' );
		$view->setModel( $model, true );
		$view->display();
	}
	
	function delivered()
	{
		$campioni = $this->getModel( 'campioni' );
		$campioni->SetDelivered( true );
		$view = $this->getView( 'campioni', 'html' );
		$view->setModel( $campioni, true );
		$view->display();
	}

}
?>
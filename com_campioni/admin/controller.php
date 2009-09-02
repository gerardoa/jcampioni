<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class CampioniController extends JController
{
	function display()
	{		
		$this->_displayCampioni( $this->getModel( 'campioni' ) );
	}
	
	function _displayCampioni($campioni) 
	{
		$view = $this->getView( 'campioni', 'html' );
		$view->setModel( $campioni, true);
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
		$campione = $this->getModel( 'campione' );
		$view->setModel( $campione, true );
		$view->display();
	}
	
	function delivered()
	{
		$campioni = $this->getModel( 'campioni' );
		$campioni->setDelivered( true );
		$this->_displayCampioni($campioni);
	}
	
	function exportToCVS()
	{
		//header("Content-type: text/x-csv");
		//header("Content-Disposition: attachment; filename=search_results.csv");
		$campioni = $this->getModel( 'campioni' );
		$view = $this->getView('campioni', 'raw');
		$view->setModel( $campioni, true );
		$view->display();
		/*$document = JFactory::getDocument();
		$document->setMimeEncoding('text/x-csv');
		$document->setType('raw');
		$document->setBuffer('Export');	
		JRequest::setVar('format', 'raw');	*/
	}
	
	function statisticaRegioni()
	{
		$campioni = $this->getModel( 'campioni' );
		$regioni = $this->getModel( 'regioni' );
		$view = $this->getView( 'statregioni', 'html' );
		$view->setModel( $campioni, true);
		$view->setModel( $regioni );
		$view->display();
	}
	
	function testConfirmEmail()
	{
		JLoader::register('CampioneController', JPATH_COMPONENT_SITE.DS.'controller.php' );
		JLoader::register('Campione', JPATH_COMPONENT_ADMINISTRATOR.DS.'bo'.DS.'campione.php' );
		$frontController = new CampioneController();
		$campione = new Campione();
		$campione->setNome( 'Gerardo' );
		$campione->setCognome( 'Adelizzi' );
		$campione->setIndirizzo( 'Via Santa Lucia, 12' );
		$campione->setCap( '80067' );
		$campione->setCitta( 'Sorrento' );
		$user = JFactory::getUser();
		$frontController->_sendMail( $user->email, $campione );
		$link = JRoute::_('index.php?option=com_campioni');
		$this->setRedirect($link, JText::_('Email Inviata a:') . ' ' . $user->email );
	}

}
?>
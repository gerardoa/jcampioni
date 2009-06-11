<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class CampioneController extends JController
{
	function display()
	{
		parent::display();
	}
	
	function salva()
	{
		$user = JFactory::getUser();
		$model = $this->getModel();
		if ( ($user->gid < 19) && $model->isPresentJoomlaUser($user->id) ) {
			JError::raiseWarning( '', 'Hai gia richiestro un campione' );
			return false;
		}
		if ( !$model->save() ) {
			$view = $this->getView( 'campione', 'html' );
  			$view->setModel( $model, true );
			$view->display();
			return false;
		}
		$numOrder = $model->getNumOrder();
		$config = JFactory::getConfig();
 		$mailfrom = $config->getValue( 'config.mailfrom' );
			
		$message =& JFactory::getMailer();
  		$message->addRecipient( array($user->email, $mailfrom, 'info@sakuraitalia.it') );
  		$message->setSubject('Richiesta Campioni Gratuiti');
  		$message->setBody("La tua richiestra e' stata ricevuta correttamente, e il codice associato e' " . $numOrder );
  		$sender = array( 'info@sakuraitalia.it', 'Sakuraitalia' );
  		$message->setSender($sender);
  		$sent = $message->send();
  		//if ($sent != 1) echo 'Error sending email';
		
  		$view = $this->getView( 'ordineinviato', 'html' );
  		$view->setModel( $model, true );
		$view->display();
		return true;
	}
	
}
?>
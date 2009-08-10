<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.controller');

class CampioneController extends JController
{
	function __construct()
	{
		parent::__construct();
		$this->addModelPath(JPATH_COMPONENT_ADMINISTRATOR.DS."models");
	}
	
	function display()
	{
		$user = JFactory::getUser();
		$model = $this->getModel('Campione', 'CampioniModel');
		$campioni = $this->getModel( 'campioni' );
		if ( ($user->gid < 19) && $campioni->isPresentJoomlaUser($user->id) ) {
			JError::raiseWarning( '', 'Hai gia richiestro un campione' );
			return false;
		}
		$view = $this->getView( 'campione', 'html' );
		$view->setModel( $model, true );
		$view->display();
	}

	function salva()
	{
		$user = JFactory::getUser();
		$campione = $this->getModel('Campione', 'CampioniModel');
		$campioni = $this->getModel( 'campioni' );
		if ( ($user->gid < 19) && $campioni->isPresentJoomlaUser($user->id) ) {
			JError::raiseWarning( '', 'Hai gia richiestro un campione' );
			return false;
		}
		if ( !$campione->save() ) {
			$view = $this->getView( 'campione', 'html' );
			$view->setModel( $campione, true );
			$view->display();
			return false;
		}
		$numOrder = $campione->getNumOrder();
		
		$this->_sendMail( $user, $numOrder );

		$view = $this->getView( 'ordineinviato', 'html' );
		$view->setModel( $campione, true );
		$view->display();
		return true;
	}

	function _sendMail( $user, $numOrder )
	{
		$config = JFactory::getConfig();
		$mailfrom = $config->getValue( 'config.mailfrom' );
		$fromname = $config->getValue( 'config.fromname' );
		$sender = array( $mailfrom, $fromname );
		$recipients = array($user->email);
		//get all super administrator
		$db = JFactory::getDBO();
		$query = 'SELECT name, email, sendEmail' .
				' FROM #__users' .
				' WHERE LOWER( usertype ) = "super administrator"';
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		// get superadministrators id
		foreach ( $rows as $row )
		{
			if ($row->sendEmail)
			{
				$recipients[] = $row->email;
			}
		}
			
		$message =& JFactory::getMailer();
		$message->addRecipient( $recipients );
		$message->setSubject('Richiesta Campioni Gratuiti');
		$message->setBody("La tua richiestra e' stata ricevuta correttamente, e il codice associato e' " . $numOrder );
		$message->setSender($sender);
		$sent = $message->send();
		if ($sent != 1) return false;
		return true;
	}
	
	function writeComment()
	{
		$commentView = $this->getView( 'comment', 'html' );
		$commentView->display();
	}

}
?>
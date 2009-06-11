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
		
		$this->_sendMail( $user, $numOrder );

		$view = $this->getView( 'ordineinviato', 'html' );
		$view->setModel( $model, true );
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

}
?>
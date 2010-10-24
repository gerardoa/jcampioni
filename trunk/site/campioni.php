<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'controller.php' );

$classname = 'CampioneController';
$controller = new $classname();
$user = JFactory::getUser();
if ( !$user->guest ) {
	$controller->execute($task);
} else {
	$link = JRoute::_('index.php?option=com_user&task=register');
	$msg = JText::_('Per richiedere campioni gratuiti è necessario registrarsi ed effettuare il LogIn dalla Home');
	$controller->setRedirect( $link, $msg );
}
$controller->redirect();
?>
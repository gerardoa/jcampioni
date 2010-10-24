<?php
// no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'controller.php' );

$classname = 'CampioniController';
$controller = new $classname();
$controller->execute($task);
$controller->redirect();
?>
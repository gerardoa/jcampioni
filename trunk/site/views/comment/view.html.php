<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioneViewComment extends JView
{
	function display( $tpl = null )
	{
		JHTML::_('behavior.mootools');
		JHTML::_('stylesheet', 'star-rating.css', 'components/com_campioni/css/');
		parent::display( $tpl );
	}
}
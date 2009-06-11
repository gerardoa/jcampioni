<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.model');

class CampioniModelCampione extends JModel
{
	function delete()
	{
		$row = $this->getTable();
		$cids = JRequest::getVar('cid', array(), 'default', 'array');
		foreach ($cids as $cid) {
			if ( !$row->delete($cid) )
			{
				$this->setError( $row->getErrorMsg() );
				return false;
			}
		}
		return true;
	}
}
?>
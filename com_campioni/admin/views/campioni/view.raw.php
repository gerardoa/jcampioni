<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');
JLoader::register('JDocumentRAW', JPATH_LIBRARIES.DS.'joomla'.DS.'document'.DS.'raw'.DS.'raw.php');

class CampioniViewCampioni extends JView
{
	function display( $tpl = null )
	{
		$document =& JFactory::getDocument();
		$rawDoc = new JDocumentRAW();
		$document = $rawDoc;
		$rawDoc->setMimeEncoding('text/x-csv');
		/*$headers = array(
		 'Content-Disposition' => 'attachment; filename=search_results.csv'
		);
		$rawDoc->setHeadData($headers);*/
		// Unable to load renderer class
		//$document->setType('raw');

		//$document->setMimeEncoding('text/x-csv');
		//$document->setType('raw');
		//$document->setBuffer('Export');
		//JRequest::setVar('format', 'raw');
		echo "Raw";
		echo "Raw";
	}
}
?>
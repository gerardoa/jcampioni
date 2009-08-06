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
		$rawDoc->setMimeEncoding('application/csv');
		header('Content-Disposition: attachment; filename=richieste_campioni.csv');
		header('Expires: 0');
    	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    	header('Pragma: public');
    
		$campioniModel = $this->getModel();
		$campioni = $campioniModel->getAllCampioni();
		$fileName = 'campioni.csv';
		$fp = fopen($fileName, 'w');
		foreach ($campioni as $campione) {
			$line = $campione->toArrayValues();
			fputcsv($fp, $line);
		}
		fclose($fp);
		header('Content-Length: ' . filesize($fileName));
		ob_clean();
		flush();
		readfile($fileName);
		
		// Unable to load renderer class
		//$document->setType('raw');

		//$document->setMimeEncoding('text/x-csv');
		//$document->setType('raw');
		//$document->setBuffer('Export');
		//JRequest::setVar('format', 'raw');
		
	}
}
?>
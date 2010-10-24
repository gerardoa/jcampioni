<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.view');

class CampioniViewBaseCampione extends JView
{

	function _showCampione()
	{
		$campione = $this->getModel();
		$errors = $campione->getErrors();
		if ( !empty($errors) ) {
			$errorsHtml = $this->_listErrors( $errors );
			JError::raiseWarning( '', $errorsHtml );
		}
		$kitMap = $campione->getKitMap();
		$kit = array ( array( 'value' => '', 'text' => 'Seleziona qui') );
		foreach ($kitMap as $value => $text) {
			$kit[] = array( 'value' => $value, 'text' => $text );
		}
		if ($campione->getKit()) {
			$campioneKit = array_keys($kitMap, $campione->getKit());
			$selectedKit = $campioneKit[0];
		} else {
			$selectedKit = '';
		}

		$lists['kit'] = JHTML::_( 'select.genericlist', $kit, 'kit', null, 'value', 'text', $selectedKit );
		// Load the form validation behavior
		JHTML::_('behavior.formvalidation');
		$document = JFactory::getDocument();
		$document->addScriptDeclaration("
                        var greeting;
                        window.onload = function() {
                                greeting = new Fx.Slide('greetingContainer', {height: true, opacity: true, duration: 500});
                                greeting.hide();
                                addFigli();
                        }       
                ");
		$document->addScriptDeclaration("
	function appendFiglio(testo) {
	 var row = $('figliHolder').insertRow(-1);
	 row.setAttribute( 'id', 'figlio' );
	 
	 var cell1 = row.insertCell(0);
     cell1.setAttribute( 'height', '40' );    
	 var label = document.createElement( 'label' );
	 label.setAttribute( 'id', 'figlio1msg' );
	 label.setAttribute( 'for', 'figlio1' );
	 var labelText = document.createTextNode( testo );
	 label.appendChild( labelText );
	 cell1.appendChild( label );
	 
	 var cell2 = row.insertCell(1);
	 var input = document.createElement( 'input' );
	 input.setAttribute('class', 'inputbox');
	 input.setAttribute('type', 'text');
	 input.setAttribute('id', 'figlio');
	 input.setAttribute('name', 'figli[]');
	 input.setAttribute('size', '4');
	 input.setAttribute('maxlength', '2');
	 //input.setAttribute('value', '');
	 cell2.appendChild( input );
}

function addFigli() {
 	var testi = new Array('Età primo figlio', 'Età secondo figlio','Età terzo figlio');
	if ( $('figliHolder').rows.length < 1 ) {
		for (var i = 0; i < 3; i++) {
			appendFiglio( testi[i] );
		}		
	}
	if ( typeof this.count == 'undefined' ) {
		$('sceltaFigli').innerHTML = $('sceltaFigli').innerHTML + '<a href=\"javascript:appendFiglio(\'Età figlio\');\">Aggiungi figlio</a>';
		this.count = 1;
	}
}

function removeFigli() {
	var table = document.getElementById( 'figliHolder' );
	var rows = table.rows;
	for (var i = rows.length; i > 0 ; i--) {
		table.deleteRow(i-1);
	}
} ");
		$this->assignRef( 'campione', $campione );
		$this->assignRef( 'lists', $lists );
	}

	function _listErrors( $errors )
	{
		if ( empty($errors) ) {
			return '';
		}
		$html = '';
		foreach ($errors as $content) {
			if ( is_array( $content ) ) {
				$html .= $this->_listErrors( $content );
			} else {
				$html .= '<li>' . $content . '</li>';
			}
		}
		//$html .= '</ul>';
		return $html;
	}
}
?>
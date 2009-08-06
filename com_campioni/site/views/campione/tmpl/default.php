<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$campione = $this->campione;
?>

<form action="<?php echo JRoute::_( 'index.php?option=com_campioni' ); ?>" method="post" id="josForm" name="josForm" class="form-validate">

<div class="componentheading">Richiesta Campione Gratuito</div>

<table cellpadding="0" cellspacing="0" border="0" width="100%" class="contentpane" >
<tr>
	<td colspan="2" height="40">
		<?php echo JText::_( 'I campi con il simbolo (*) sono obbligatori. ' ); ?>
	</td>
</tr>
<tr>
	<td width="15%" height="40">
		<label id="nomemsg" for="nome">
			<?php echo JText::_( 'Nome' ); ?>:
		</label>
	</td>
  	<td>
  		<input type="text" name="nome" id="nome" size="30" value="<?php echo $campione->getNome();?>" class="inputbox required" maxlength="25" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="cognomemsg" for="cognome">
			<?php echo JText::_( 'Cognome' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="cognome" name="cognome" size="30" value="<?php echo $campione->getCognome();?>" class="inputbox required" maxlength="25" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="etaemsg" for="eta">
			<?php echo JText::_( 'Età' ); ?>:
		</label>
	</td>
	<td>
		<input type="text" id="eta" name="eta" size="5" value="<?php echo $campione->getEta();?>" class="inputbox required" maxlength="3" /> *
	</td>
</tr>
<tr>
	<td height="40">
		<label id="indirizzomsg" for="indirizzo">
			<?php echo JText::_( 'Indirizzo' ); ?>:
		</label>
	</td>
  	<td>
  		<input class="inputbox required" type="text" id="indirizzo" name="indirizzo" size="40" maxlength="40" value="<?php echo $campione->getIndirizzo();?>" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="provinciamsg" for="provincia">
			<?php echo JText::_( 'Provincia' ); ?>:
		</label>
	</td>
  	<td>
  		<input class="inputbox required" type="text" id="provincia" name="provincia" size="4" maxlength="2" value="<?php if ($provincia = $campione->getProvincia()){ echo $provincia->getSigla();}?>" /> * <span>2 Lettere</span>
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="cittamsg" for="citta">
			<?php echo JText::_( 'Città' ); ?>:
		</label>
	</td>
  	<td>
  		<input class="inputbox required" type="text" id="citta" name="citta" size="25" maxlength="20" value="<?php echo $campione->getCitta();?>" /> *
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="capmsg" for="cap">
			<?php echo JText::_( 'CAP' ); ?>:
		</label>
	</td>
  	<td>
  		<input class="inputbox required" type="text" id="cap" name="cap" size="10" maxlength="5" value="<?php echo $campione->getCap();?>" /> * <span>5 Cifre</span>
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="kitmsg" for="kit">
			<?php echo JText::_( 'KIT' ); ?>:
		</label>
	</td>
  	<td>
  		<?php echo $this->lists['kit']; ?>
  	</td>
</tr>
<tr>
	<td height="40">
		<label id="figlimsg" for="figli">
			<?php echo JText::_( 'Hai figli?' ); ?>:
		</label>
	</td>
  	<td id="sceltaFigli">
  		SI <input type="radio" id="figliC" name="figliC"  value="" onclick="addFigli();" checked="checked"/>
  		<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
  		NO <input type="radio" id="figliC" name="figliC"  value="" onclick="removeFigli();"/>
  	</td>
</tr>
<tr><td colspan="2">
<table id="figliHolder"></table>
</td></tr>

<tr><td colspan="2">
	<div id="greetingClicker"  style="text-decoration: underline; cursor: pointer;" onclick="greeting.toggle();">Informativa sulla privacy</div><div>Accetto<input class="required" type="checkbox" checked="checked" /></div>
	<div id="greetingContainer" class="informativa" style="background:#F3F3F3 none repeat scroll 0 0; border-color:#999999 #DDDDDD #DDDDDD #999999; border-style:solid; border-width:1px; color:#666666; padding:5px;"> <code>IMPEGNO DI RISERVATEZZA (Decreto Legislativo 196/03, Tutela dei dati personali)<br/>
	
	        I dati che ci fornirai saranno raccolti, registrati , elaborati anche con strumenti informatici ed utilizzati in operazioni di raffronto o integrazione con altre fonti, sempre con la massima riservatezza, da parte di Sakura Italia Srl del trattamento.<br/>
	        Inoltre, previo tuo consenso, i dati forniti potranno essere trattati da Sakura Italia Srl al fine di inviarti prodotti gratuiti, pubblicazioni, materiale informativo, questionari e per sondaggi statistici.<br/>
	        Ai sensi dell'art. 7, D.lgs. 196/03 potrai esercitare i relativi diritti, fra cui consultare, modificare e cancellare i dati od opporti al loro utilizzo e potrai, inoltre, conoscere l'elenco aggiornato dei responsabili del trattamento, rivolgendoti a: Sakura Italia Srl, via Secchi, 14 – Desenzano del garda (BS) e-mail: info@sakuraitalia.it.</code>
	</div>
</td></tr>

</table>
	<button class="button validate" type="submit"><?php echo JText::_('Richiedi'); ?></button>
	<input type="hidden" name="task" value="salva" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
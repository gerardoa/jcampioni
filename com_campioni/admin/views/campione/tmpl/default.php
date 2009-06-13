<?php defined('_JEXEC') or die('Restricted access');
global $option;
$campione = $this->campione;
?>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col100">
<fieldset class="adminform"><legend><?php echo JText::_( 'Details' ); ?></legend>

<table class="admintable">
	<tr>
		<td width="100" align="right" class="key"><label for="nome_utente"> <?php 
		if ( $userName = $campione->getUserName() ) {
			$link = JRoute::_( 'index.php?option=com_users&task=edit&cid[]='. $campione->getIdUtente() );
			echo '<a href="' . $link . '">' . JText::_( 'Nome Utente' ) . ':</a>';
		} else {
			echo '<div>'.JText::_( 'Nome Utente' ).':</div>';
			$userName = JText::_( 'Utente Joomla '. $campione->getIdUtente() .' Non presente' );
		}
		?> </label></td>
		<td>
		<div class="text_area" id="nome_utente"><?php echo $userName;?></div>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="email"> <?php echo JText::_( 'E-Mail' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="email" id="email"
			size="40" maxlength="250" value="<?php echo $campione->getEmail();?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="nome"> <?php echo JText::_( 'Nome' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="nome" id="nome"
			size="32" maxlength="250" value="<?php echo $campione->getNome();?>" /></td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="cognome"> <?php echo JText::_( 'Cognome' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="cognome" id="cognome"
			size="32" maxlength="250" value="<?php echo $campione->getCognome();?>" />
		</td>
	</tr>
	<tr>
		<td><label id="etaemsg" for="eta"> <?php echo JText::_( 'Età' ); ?>: </label></td>
		<td><input type="text" id="eta" name="eta" size="5"
			value="<?php echo $campione->getEta();?>" class="inputbox required"
			maxlength="3" /> *</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="indirizzo"> <?php echo JText::_( 'Indirizzo' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="indirizzo"
			id="indirizzo" size="32" maxlength="250"
			value="<?php echo $campione->getIndirizzo();?>" /></td>
	</tr>
	<tr>
		<td><label id="provinciamsg" for="provincia"> <?php echo JText::_( 'Provincia' ); ?>:
		</label></td>
		<td><input class="inputbox required" type="text" id="provincia"
			name="provincia" size="4" maxlength="2"
			value="<?php echo $campione->getProvincia();?>" /> * <span>2 Lettere</span>
		</td>
	</tr>
	<tr>
		<td width="100" align="right" class="key"><label for="citta"> <?php echo JText::_( 'Città' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="citta" id="citta"
			size="32" maxlength="250" value="<?php echo $campione->getCitta();?>" /></td>
	</tr>
	<tr>
		<td height="40"><label id="capmsg" for="cap"> <?php echo JText::_( 'CAP' ); ?>:
		</label></td>
		<td><input class="inputbox required" type="text" id="cap" name="cap"
			size="10" maxlength="5" value="<?php echo $campione->getCap();?>" /> * <span>5
		Cifre</span></td>
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
		<td width="100" align="right" class="key"><label for="recordtime"> <?php echo JText::_( 'Data di registrazione' ); ?>:
		</label></td>
		<td><input class="text_area" type="text" name="registrazione"
			id="registrazione" size="32" maxlength="250"
			value="<?php echo $campione->getRegistrazione();?>" /></td>
	</tr>
</table>
</fieldset>
</div>


<input type="hidden" name="option" value="<?php echo $option; ?>" /> <input
	type="hidden" name="cid" value="<?php echo $campione->getId(); ?>" /> <input
	type="hidden" name="task" value="" /></form>

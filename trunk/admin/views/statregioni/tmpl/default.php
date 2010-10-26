<?php defined('_JEXEC') or die('Restricted access');
?>
<form action="index.php" method="post" name="adminForm">
<table class="adminlist" style="float: left; width: 30%;">
	<thead>
		<tr>
			<th width="200"><?php echo JText::_( 'Nome Regione' ); ?></th>
			<th><?php echo JText::_( 'Numero campioni' ); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$campioniModel = $this->campioniModel;
	$map = $campioniModel->getMapCampioniPerRegione();
	$regioniModel = $this->regioniModel;
	arsort($map);
	$k = 0;
	foreach ($map as $idRegione => $numCampioni) {
		$regione = $regioniModel->getRegioneById($idRegione);
		?>
		<tr class="<?php echo "row$k"; ?>">
			<td><?php if ($regione ) {
				echo $regione->getNome();
			} else {
				echo '<span style="color:red;">'.JText::_( 'Provincia non trovata nel Data Base.' ). '</span>';
			} ?></td>
			<td><?php echo $numCampioni; ?></td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
</table>
<div style="display: inline-block; margin-left: 50px;">
	<img src="<?php echo $this->regionThematicMap(); ?>" />
</div>
<input type="hidden" name="option" value="com_campioni" /> <input
	type="hidden" name="task" value="" /> <input type="hidden"
	name="boxchecked" value="0" /> <?php echo JHTML::_( 'form.token' ); ?>
</form>

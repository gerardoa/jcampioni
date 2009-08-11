<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$campione = $this->getModel();
$user = JFactory::getUser();
?>
<h1>Inserisci il tuo commento</h1>
<form action="index.php" method="post">
<table>
	<tr>
		<td><strong>Name:</strong></td>
		<td>
		<div class="text_area"><?php echo $user->username; ?></div>
		</td>
	</tr>
	<tr>
		<td><strong>Vota:</strong></td>
		<td>
		<ul id="1001" class="rating twostar">
			<li id="1" class="rate one"><a href="#" title="1 Star">1</a></li>
			<li id="2" class="rate two"><a href="#" title="2 Stars">2</a></li>
			<li id="3" class="rate three"><a href="#" title="3 Stars">3</a></li>
			<li id="4" class="rate four"><a href="#" title="4 Stars">4</a></li>
			<li id="5" class="rate five"><a href="#" title="5 Stars">5</a></li>
		</ul>
		<script>
$$('.rate').each(function(element,i){
	element.addEvent('click', function(){
		var myStyles = ['nostar', 'onestar', 'twostar', 'threestar', 'fourstar', 'fivestar'];
		myStyles.each(function(myStyle){
			if(element.getParent().hasClass(myStyle)){
				element.getParent().removeClass(myStyle)
			}
		});		
		myStyles.each(function(myStyle, index){
			if(index == element.id){
				element.getParent().toggleClass(myStyle);
				$('voto').value = element.id;
				//alert('Clicked '+element.id);
				
				exit;
			}
		});		
		
	});
});

</script></td>
	</tr>
	<tr>
		<td><strong>Commento:</strong></td>
		<td><textarea class="text_area" cols="20" rows="4"
			name="testo_commento" id="testo_commento" style="width: 500px"></textarea>
		</td>
	</tr>
</table>
<input type="hidden" name="id" value="<?php echo $campione->getId(); ?>" />
<input type="hidden" name="task" value="saveComment" />
<input type="hidden" id="voto" name="voto_commento" value="" /> 
<input type="hidden" name="option" value="<?php echo 'com_campioni'; ?>" /> 
<input type="submit" class="button" id="button" value="Invia" />
</form>

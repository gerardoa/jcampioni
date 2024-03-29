<?php defined('_JEXEC') or die('Restricted access'); 
$rows = $this->campioni;
?>
	  <form action="index.php" method="post" name="adminForm">
	  <table>
    	<tr>
         <td align="left" width="100%">
         </td>
         <td nowrap="nowrap">
             <?php echo $this->lists['regioneid']; ?>
         </td>
    	</tr>
	</table>
	   
	  <table class="adminlist"> 
	    <thead> 
	      <tr> 
	        <th width="20"> 
	          <input type="checkbox" name="toggle" 
	               value="" onclick="checkAll(<?php echo 
	               count( $rows ); ?>);" /> 
	        </th>
	        <th><?php echo JHTML::_('grid.sort', 'ID', 'id', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'IP', 'ip', $this->lists['order_Dir'], $this->lists['order']); ?></th> 
	        <th><?php echo JHTML::_('grid.sort', 'Nome', 'nome', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Cognome', 'cognome', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Età', 'eta', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'E-Mail', 'email', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th>Indirizzo</th>
	        <th><?php echo JHTML::_('grid.sort', 'Provincia', 'provincia', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Città', 'citta', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'CAP', 'cap', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Kit', 'kit', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'N. Figli', 'figli_num', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Figli eta media', 'figli_eta_media', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Data Richiesta', 'registrazione', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	        <th><?php echo JHTML::_('grid.sort', 'Data Spedizione', 'data_spedizione', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	      	<th>Codice Commento</th>
	      </tr> 
	    </thead>
	    <tfoot>
			<tr>
				<td colspan="17">
					<?php echo $this->pageNav->getListFooter(); ?>
				</td>
			</tr>
		</tfoot> 
		<tbody>
	    <?php
	    $k = 0;
	    for ($i=0, $n=count( $rows ); $i < $n; $i++) 
	    {
			$row = &$rows[$i]; 
			$checked = JHTML::_('grid.id', $i, $row->getId() );
			$link = JRoute::_( 'index.php?option=' . 'com_campioni' . '&task=edit&cid[]='. $row->getId() );
	      ?> 
	      <tr class="<?php echo "row$k"; ?>"> 
	        <td> 
	          <?php echo $checked; ?> 
	        </td>
	        <td>
	          <?php echo $row->getId(); ?>
	        </td>
	        <td>
	          <?php echo $row->getIp(); ?>
	        </td> 
	        <td>
			<a href="<?php echo $link; ?>"> 
	          <?php echo $row->getNome(); ?></a>
	        </td> 
	        <td> 
	          <?php echo $row->getCognome(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getEta(); ?> 
	        </td>
	        <td> 
	          <a href="mailto:<?php echo $row->getEmail(); ?>"><?php echo $row->getEmail(); ?></a> 
	        </td>
	        <td> 
	          <?php echo $row->getIndirizzo(); ?> 
	        </td>
	        <td> 
	          <?php 
	          $provincia = $row->getProvincia();
	          
	          if ( !$provincia->getId() ) {
	          	$testoProvincia = $provincia->getSigla() . ' provincia non presente nel db';
	          } else {
	          	$regione = $provincia->getRegione();
	          	$testoProvincia = $provincia->getSigla() . ' (' . $provincia->getNome() . ' | ' . $regione->getNome() .')';
	          }      
	          echo $testoProvincia; ?> 
	        </td>
	        <td> 
	          <?php echo $row->getCitta(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getCap(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getKit(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getFigliNum(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getFigliEtaMedia(); ?> 
	        </td>	   
	        <td> 
	          <?php echo $row->getRegistrazione(); ?> 
	        </td>
	        <td> 
	          <?php echo $row->getDataSpedizione(); ?> 
	        </td>      
	        <td> 
	          <?php echo $row->getCodiceCommento(); ?> 
	        </td>        
	      </tr> 
	      <?php 
	      $k = 1 - $k; 
	    } 
	    ?> 
	  </tbody>
	  </table> 
	  <input type="hidden" name="option" value="com_campioni" /> 
	  <input type="hidden" name="task" value="" /> 
	  <input type="hidden" name="boxchecked" value="0" /> 
	  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	  <?php echo JHTML::_( 'form.token' ); ?>
	  </form> 
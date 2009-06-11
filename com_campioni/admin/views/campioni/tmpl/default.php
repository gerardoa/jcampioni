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
	        <th>Id</th>
	        <th>IP</th> 
	        <th>Nome</th>
	        <th>Cognome</th>
	        <th>Età</th>
	        <th>E-Mail</th>
	        <th>Indirizzo</th>
	        <th>Provincia</th>
	        <th>Città</th>
	        <th>CAP</th>
	        <th>Kit</th>
	        <th>N. Figli</th>
	        <th>Figli eta media</th>
	        <th><?php echo JHTML::_('grid.sort', 'Data Richiesta', 'registrazione', $this->lists['order_Dir'], $this->lists['order']); ?></th>
	      </tr> 
	    </thead>
	    <tfoot>
			<tr>
				<td colspan="16">
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
			$checked = JHTML::_('grid.id', $i, $row->id );
			$link = JRoute::_( 'index.php?option=' . 'com_campioni' . '&task=edit&cid[]='. $row->id );
	      ?> 
	      <tr class="<?php echo "row$k"; ?>"> 
	        <td> 
	          <?php echo $checked; ?> 
	        </td>
	        <td>
	          <?php echo $row->id; ?>
	        </td>
	        <td>
	          <?php echo $row->ip; ?>
	        </td> 
	        <td>
			<a href="<?php echo $link; ?>"> 
	          <?php echo $row->nome; ?></a>
	        </td> 
	        <td> 
	          <?php echo $row->cognome; ?> 
	        </td>
	        <td> 
	          <?php echo $row->eta; ?> 
	        </td>
	        <td> 
	          <?php echo $row->email; ?> 
	        </td>
	        <td> 
	          <?php echo $row->indirizzo; ?> 
	        </td>
	        <td> 
	          <?php 
	          if ( !$row->prov_nome ) {
	          	$row->prov_nome = 'sigla non trovata';
	          }       
	          echo $row->provincia . ' (' . $row->prov_nome . ' | ' .$row->regione .')'; ?> 
	        </td>
	        <td> 
	          <?php echo $row->citta; ?> 
	        </td>
	        <td> 
	          <?php echo $row->cap; ?> 
	        </td>
	        <td> 
	          <?php echo $row->kit; ?> 
	        </td>
	        <td> 
	          <?php echo $row->figli_num; ?> 
	        </td>
	        <td> 
	          <?php echo $row->figli_eta_media; ?> 
	        </td>	   
	        <td> 
	          <?php echo $row->registrazione; ?> 
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
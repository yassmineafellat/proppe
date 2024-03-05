<h3> Ajout d'une nouvelle prestation </h3>
<form method="post">
	<table>
		<tr>
			<td> Nom de la prestation </td>
            <td> <input type="text" name="libelleprestation" value="<?= ($laPrestation != null) ? $laPrestation['libelleprestation'] : '' ?>"> </td>
		</tr>
		
		<tr>
			<td> Le Service associé  : </td>
			<td> <select name ="idservice"> 
			<?php
				foreach ($lesServices as $unServices){
					echo "<option value ='".$unServices['idservice']."'>"; 
					echo $unServices['libelleservice']; 
					echo "</option>"; 
				}
				?>
				 </select>
			</td>
		</tr>
		<tr>
			
				 </select>
			</td>
		</tr>
		<tr>
			<td>  </td>
			<td> 
			<input type="submit"  name="Valider" value="Valider"  >

			<input type="reset" name="Annuler" value="Annuler">
			</td>
		</tr>
	</table>
	<br>
	<br>
	<br>
	<br>
	
</form>


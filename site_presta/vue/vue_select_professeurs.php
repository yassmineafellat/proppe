<h3> Liste des Professeurs </h3>
<form method="post">
	Filtrer par : <input type="text" name="filtre">
	<input type="submit" name="Filtrer" value="Filtrer">
</form>
<br/>
<table border="1">
	<tr>
		<td> Id Professeur </td>
		<td> Nom Prof </td>
		<td> Prénom Prof </td>
		<td> Email Prof </td>
		<td> Diplôme préparé </td>
		<?php
		if (isset($_SESSION['role']) && $_SESSION['role']=='admin'){
			echo '<td> Opérations </td>'; 
		} ?>

	</tr>
	<?php
	if (isset($lesProfesseurs)){
		foreach ($lesProfesseurs as $unProfesseur) {
			echo "<tr>"; 
			echo "<td>" . $unProfesseur['idprofesseur'] ."</td>"; 
			echo "<td>" . $unProfesseur['nom'] ."</td>"; 
			echo "<td>" . $unProfesseur['prenom'] ."</td>"; 
			echo "<td>" . $unProfesseur['email'] ."</td>"; 
			echo "<td>" . $unProfesseur['diplome'] ."</td>"; 
	if (isset($_SESSION['role']) && $_SESSION['role']=='admin'){
			echo "<td>";
			echo "<a href='index.php?page=3&action=sup&idprofesseur=".$unProfesseur['idprofesseur']."'><img src='images/supprimer.png' height='30' width='30'></a>"; 
			echo "<a href='index.php?page=3&action=edit&idprofesseur=".$unProfesseur['idprofesseur']."'><img src='images/editer.png' height='30' width='30'></a>";

			echo "</td>";
		}
			echo "</tr>";
		}
	}
	?>

</table>

<br/>
<br/>
<br/>

















<footer class="footer">
  <div class="footer-content">
    <div class="footer-section about">
      <h2>À propos de nous</h2>
      <p>Nous sommes une entreprise dédiée à fournir des services de haute qualité à nos clients. Notre mission est de satisfaire vos besoins et de vous offrir une expérience exceptionnelle.</p>
    </div>
    <div class="footer-section contact">
      <h2>Contactez-nous</h2>
      <p><i class="fas fa-phone"></i> +123 456 789</p>
      <p><i class="fas fa-envelope"></i> info@example.com</p>
    </div>
    
  </div>
  <div class="footer-bottom">
    &copy; 2024 Nom de votre entreprise. Tous droits réservés.
  </div>
</footer>

</body>
</html>

<style>

/* Styles pour le footer */
.footer {
	margin-top:70px;
  background-color: black; /* Couleur de fond */
  color: #fff; /* Couleur du texte */
  padding: 50px 0; /* Espacement intérieur en haut et en bas */
}

/* Styles pour la section de contenu */
.footer-content {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}

/* Styles pour chaque section du footer */
.footer-section {
  width: 30%; /* Largeur de chaque section */
  padding: 0 20px; /* Espacement intérieur */
}

/* Styles pour les titres des sections */
.footer-section h2 {
  color: #fff; /* Couleur du texte */
  font-size: 20px;
  margin-bottom: 20px; /* Espacement en bas */
}


/* Styles pour le bas du footer */
.footer-bottom {
  text-align: center; /* Alignement du texte au centre */
  margin-top: 30px; /* Espacement en haut */
  padding-top: 10px; /* Espacement intérieur en haut */
  border-top: 1px solid #666; /* Bordure supérieure */
}

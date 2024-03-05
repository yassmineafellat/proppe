<h2> Gestion des Client </h2>

<?php
if (isset($_SESSION['role']) && $_SESSION['role']=='admin'){
	$leClient = null; 
	if (isset($_GET['action']) && isset($_GET['idClient'])){
		$action = $_GET['action']; 
		$idClient = $_GET['idClient']; 
		switch ($action)
		{
			case "sup" : $unControleur->deleteClient($idClient); 
						 break; 
			case "edit" : $leClient = $unControleur->selectWhereClient ($idClient); 
				break; 
		}
	}

	require_once ("vue/vue_insert_client.php");

	if (isset($_POST['Valider'])){
		$unControleur->insertClient ($_POST);
	}
	if (isset($_POST['Modifier'])){
		$unControleur->updateClient ($_POST);
		//on va actualiser la page 
		header("Location: index.php?page=3");
	}
}
	if (isset($_POST['Filtrer'])){
		$lesClient = $unControleur->selectLikeClient ($_POST['filtre']);
	} else {
			//recuperation de tous les Client 
			$lesClient = $unControleur->selectAllClients (); 
		}
	
	require_once ("vue/vue_select_clients.php");
?>







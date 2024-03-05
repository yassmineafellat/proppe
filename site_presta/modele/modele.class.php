<?php

	class Modele {
		private $unPDO ; 

		public function  __construct (){
			try{
				$url ="mysql:host=localhost;dbname=Bricool"; 
				$user = "root"; 
				$mdp = ""; // PC : $mdp =""; 
				$this->unPDO = new PDO ($url, $user, $mdp); 
			}
			catch (PDOException $exp){
				echo "<br> Erreur de connexion à la BDD"; 
			}
		}

		/*************  GESTION DES services ******************/
		public function insertService($tab) {
			$nom_image = null;
			if(isset($_FILES['nom_image']) && $_FILES['nom_image']['error'] == 0) {  
				if ($_FILES['nom_image']['size'] <= 3000000) {
					$informationsImage = pathinfo($_FILES['nom_image']['name']);
					$extensionImage = strtolower($informationsImage['extension']);
					$extensionsArray = array('png', 'gif', 'jpg', 'jpeg'); 
		
					if(in_array($extensionImage, $extensionsArray)) {
						// Utilisez le nom d'origine de l'image pour éviter d'écraser les fichiers
						$address = 'uploads/' . $_FILES['nom_image']['name'];
						move_uploaded_file($_FILES['nom_image']['tmp_name'], $address); 
						$nom_image = $_FILES['nom_image']['name'];
					}
				}
			}
		
			// Préparer et exécuter la requête SQL
			$requete = "INSERT INTO services (libelleservice, nom_image) VALUES (:libelleservice, :nom_image)";
			$donnees = array(
				":libelleservice" => $tab['libelleservice'],
				":nom_image" => $nom_image
			);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
		}
		
		
		public function selectAllService() {
			$requete = "SELECT * FROM services; ";
			$select = $this->unPDO->prepare($requete);
			$select->execute();
			return $select->fetchAll();
		}
		
		public function deleteService($idservice) {
			$requete = "DELETE FROM services WHERE idservice = :idservice";
			$donnees = array(":idservice" => $idservice);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
		}
		
		public function selectWhereService($idservice) {
			$requete = "SELECT * FROM services WHERE idservice = :idservice";
			$donnees = array(":idservice" => $idservice);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetch();
		}
		
		public function updateService($tab) {
			$requete = "UPDATE services SET libelleservice = :nom   WHERE idservice = :idservice";
			$donnees = array(
				":nom" => $tab['libelleservice'],
				":idservice" => $tab['idservice']
			);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
		}
		
		public function selectLikeService($filtre) {
			$requete = "SELECT * FROM services WHERE libelleservice LIKE :filtre";
			$donnees = array(":filtre" => "%" . $filtre . "%");
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
			return $select->fetchAll();
		}
		

		/*************  GESTION DES Clients ******************/
		public function insertClients ($tab){
			$requete ="insert into client values (null, :nom, :prenom, :email, :diplome); ";
			$donnees = array(":nom" => $tab['nom'],
							 ":prenom" => $tab['prenom'],
							 ":email" => $tab['email'],
							 ":diplome" => $tab['diplome']
							);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
		}

		public function selectAllClients (){
			$requete = "select * from client ;"; 
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ();
			return $select->fetchAll(); 
		}
		public function deleteClient ($idClient){
			$requete = "delete from client where idClient = :idClient;"; 
			$donnees= array(":idClient"=>$idClient);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
		}
		public function selectWhereClient ($idClient){
			$requete ="select * from client where idClient=:idClient";
			$donnees= array(":idClient"=>$idClient);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
			return $select->fetch (); 
		}
		public function updateClient ($tab){
			$requete ="update client set nom=:nom, prenom =:prenom, email = :email, diplome =:diplome where idClient=:idClient";
			$donnees= array(
							":nom"=>$tab['nom'],
							":prenom"=>$tab['prenom'],
							":email"=>$tab['email'],
							":diplome"=>$tab['diplome'],
							":idClient"=>$tab['idClient']
							);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
		}
		public function selectLikeClients ($filtre){
			$requete = "select * from client where nom like :filtre or prenom like :filtre or email like :filtre or diplome like :filtre ;";
			$donnees= array( ":filtre"=>"%".$filtre."%"); 
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
			return $select->fetchAll(); 			 
		}

		/*************  GESTION DES prestataire ******************/
	
		




		public function selectAllPrestataires  (){
			$requete = "SELECT p.*, s.libelleservice
			FROM prestataire p
			INNER JOIN services s ON p.idservice = s.idservice;
			"; 
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ();
			return $select->fetchAll(); 
		}
		public function deletePrestataire ($idprestataire){
			$requete = "delete from prestataire  where idprestataire  = :idprestataire ;"; 
			$donnees= array(":idprestataire"=>$idprestataire );
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
		}
		public function selectWherePrestataire  ($idprestataire){
			$requete ="select * from service  where idprestataire=:idprestataire";
			$donnees= array(":idprestataire"=>$idprestataire);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
			return $select->fetch (); 
		}
		public function updatePrestataire  ($tab){
			$requete ="update service set nom=:nom, prenom =:prenom, email = :email, dateNais =:dateNais, idservice =:idservice where idservice=:idservice;";
			$donnees= array(
							":nom"=>$tab['nom'],
							":prenom"=>$tab['prenom'],
							":email"=>$tab['email'],
							":dateNais"=>$tab['dateNais'],
							":idservice"=>$tab['idservice'],
							":idservice"=>$tab['idservice']
							);
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
		}
		public function selectLikePrestataires  ($filtre){
			$requete = "select * from prestataire where zone_couverture like :filtre or idservice like :filtre  ;";
			$donnees= array( ":filtre"=>"%".$filtre."%"); 
			$select = $this->unPDO->prepare ($requete); 
			$select->execute ($donnees);
			return $select->fetchAll(); 			 
		}





       /***********  Gestion des prestations******* */

	   public function insertPrestation($tab) {
		$requete = "INSERT INTO prestations (libelleprestation, idservice) VALUES (:libelleprestation, :idservice)";
		$donnees = array(
			":libelleprestation" => $tab['libelleprestation'],
			":idservice" => $tab['idservice'],
		);
		$insertion = $this->unPDO->prepare($requete);
		$insertion->execute($donnees);
	}
	
	
	public function selectAllPrestation() {
		$requete = "SELECT s.*, p.*
		FROM services s
		INNER JOIN prestations p ON s.idservice = p.idservice;
		";
		$select = $this->unPDO->prepare($requete);
		$select->execute();
		return $select->fetchAll();
	}
	
	public function deletePrestation($idprestation) {
		$requete = "DELETE FROM prestations WHERE idprestation = :idprestation";
		$donnees = array(":idprestation" => $idprestation);
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}
	
	public function selectWherePrestation($idprestation) {
		$requete = "SELECT * FROM prestations WHERE idprestation = :idprestation";
		$donnees = array(":idprestation" => $idprestation);
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
		return $select->fetch();
	}
	
	public function updatePrestation($tab) {
		$requete = "UPDATE prestations SET libelleprestation = :libelleprestation, idservice = :idservice WHERE idprestation = :idprestation";
		$donnees = array(
			":libelleprestation" => $tab['libelleprestation'],
			":idservice" => $tab['idservice'],
			":idprestation" => $tab['idprestation'],
		);
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}
	
	public function selectLikePrestation($filtre) {
		$requete = "SELECT * FROM prestations WHERE libelleprestation LIKE :filtre";
		$donnees = array(":filtre" => "%" . $filtre . "%");
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
		return $select->fetchAll();
	}
	





/************reservation*************** */
public function selectReservationsByClientId($iduser) {
    $requete = "SELECT r.idreservation, r.idclient, r.idprestataire, r.idservice, r.date_reservation, r.heure_reservation, nbr_heure,
    tarif_total , r.etat, r.commentaire,
        p.nomprestataire, p.numero_telephone, s.libelleservice, ps.libelleprestation
        FROM reservation r
        INNER JOIN prestataire p ON r.idprestataire = p.idprestataire
        INNER JOIN services s ON r.idservice = s.idservice
        INNER JOIN prestations ps ON r.idservice = ps.idservice
        WHERE r.idclient = :idclient"; // Utilisation d'un paramètre de liaison
    $select = $this->unPDO->prepare($requete);
    $select->bindParam(':idclient', $idClient, PDO::PARAM_INT); // Liaison du paramètre
    $select->execute();
    return $select->fetchAll();
}


public function selectAllReservations() {
    $requete = "SELECT r.idreservation, r.idclient, r.idprestataire, r.idprestation, r.date_reservation, r.heure_reservation, r.nbr_heure, r.tarif_total, r.etat, r.commentaire,
                p.nomprestataire, p.numero_telephone, ps.libelleprestation, s.libelleservice
                FROM reservation r
                INNER JOIN prestataire p ON r.idprestataire = p.idprestataire
                INNER JOIN prestations ps ON r.idprestation = ps.idprestation
                INNER JOIN services s ON ps.idservice = s.idservice";

    $select = $this->unPDO->prepare($requete);
    $select->execute();
    return $select->fetchAll();
}


    public function insertReservation($tab) {
        $requete= "INSERT INTO reservation (idclient, idprestataire, idprestation, date_reservation, heure_reservation, nbr_heure, tarif_total, etat, commentaire) 
           
		        VALUES (:idclient, :idprestataire, :idprestation, :date_reservation, :heure_reservation, :nbr_heure, :tarif_total, :etat, :commentaire)";
        $tab['etat'] = 'en_attente';

    $donnees = array(
	":idclient" => $tab['idclient'],
	":idprestataire" => $tab['idprestataire'],
	":idprestation" => $tab['idprestation'],
	":date_reservation" => $tab['date_reservation'],
	":heure_reservation" => $tab['heure_reservation'],
	":nbr_heure" => $tab['nbr_heure'],
	":tarif_total" => $tab['tarif_total'],
	":etat" => $tab['etat'],
	":commentaire" => $tab['commentaire']
	
    );   
     $select = $this->unPDO->prepare($requete);
     $select->execute($donnees);

    }




    public function deleteReservation($idreservation) {
		$requete = "DELETE FROM reservation WHERE idreservation = :idreservation";
		$donnees = array(":idreservation" => $idreservation);
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}
	
    

	public function validerReservation($etat, $idreservation) {
		$requete = "UPDATE reservation SET etat = :etat   WHERE idreservation = :idreservation";
		$donnees = array(
			":etat" => $etat,
			":idreservation" => $idreservation
		);
		echo $requete;
		$select = $this->unPDO->prepare($requete);
		$select->execute($donnees);
	}





























      /**************Inscription **************/
	  public function verifConnexionClient ($email, $mdp){
		$requete="select * from client where email = :email and mdp = :mdp; "; 
		$select = $this->unPDO->prepare ($requete);
		$donnees= array( ":email"=>$email, ":mdp"=>$mdp);
		$select->execute ($donnees);
		return $select->fetch();
	}
	  public function insertClient($tab) {
        $requete = "INSERT INTO client (nom, prenom, email, mdp) VALUES (:nom, :prenom, :email, :mdp)";
        $insertion = $this->unPDO->prepare($requete);
        $insertion->execute(array(
		":nom" => $tab['nom'],
            ":prenom" => $tab['prenom'],
            ":email" => $tab['email'],
            ":mdp" => $tab['mdp']
        ));
         
    }


     





	/*****************Inscription prestataire********* */

	public function verifConnexionPrestataire($email, $mdp) {
        $requete = "SELECT * FROM prestataire WHERE email = :email AND mdp = :mdp";
        $select = $this->unPDO->prepare($requete);
        $donnees = array(":email" => $email, ":mdp" => $mdp);
        $select->execute($donnees);
        return $select->fetch();
    }


	public function insertPrestataire($tab) {
		$requete = "INSERT INTO prestataire (nomprestataire, adresse, numero_telephone, email, mdp, competences, experience, tarifs, disponibilite, zone_couverture, evaluations, certifications, idservice) VALUES (:nomprestataire, :adresse, :numero_telephone, :email, :mdp, :competences, :experience, :tarifs, :disponibilite, :zone_couverture, :evaluations, :certifications, :idservice)";
		$insertion = $this->unPDO->prepare($requete);
		$donnees = array(
			":nomprestataire" => $tab['nomprestataire'],
			":adresse" => $tab['adresse'],
			":numero_telephone" => $tab['numero_telephone'],
			":email" => $tab['email'],
			":mdp" => $tab['mdp'],
			":competences" => $tab['competences'],
			":experience" => $tab['experience'],
			":tarifs" => $tab['tarifs'],
			":disponibilite" => $tab['disponibilite'],
			":zone_couverture" => $tab['zone_couverture'],
			":evaluations" => $tab['evaluations'],
			":certifications" => $tab['certifications'],
			":idservice" => $tab['idservice']
		);
		$select = $this->unPDO->prepare ($requete); 
		$select->execute ($donnees);
	}
	







		/*********** Table User ***************/

		public function verifConnexion ($email, $mdp){
			$requete="select * from user where email = :email and mdp = :mdp; "; 
			$select = $this->unPDO->prepare ($requete);
			$donnees= array( ":email"=>$email, ":mdp"=>$mdp);
			$select->execute ($donnees);
			return $select->fetch();
		}
		
	}
?>

















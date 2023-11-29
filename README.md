# Cine-Donkey

Header : -barre de navigation(Accueil, Mes réservations(si connecter), Mon panier, se connecter ou se déconnecter et/ou s'inscrire)
	 -barre de recherche (titre, date)
	 -en-tête : logo et phrase d'accroche
	 -option: Admin dans barre de navigation
	 - gestion en ob-start()


Page d'accueil : - liste de tous les films disponibles (période d'un mois à partit de NOW())
		 -lien vers page détail de tous les films présents
		 -options : pagination


Page de détail film : -tous les détails du film(affiche, résumé, titre , genre, classification)
		      -ajout des select pour choisir la séance.(date et heure et quantité) (bouton réserver)
		      -partie intermédiaire avant panier (connexion obligatoire -> affichage de page de login)
			 

Panier : affichage de quantité avec option de suppression et d'ajout
		
	 

Page login: login par mail, et proposition d'inscription (si compte non existant)
	   
Page Inscription :  formulaire (nom, prénom, email, téléphone (null), mot de passe et confirmation)
		            lien vers login si isset compte  


Page espace client : affichage des réservations (tri des réservations)

bonus: suppression avec demande de confirmation en modal
	   admin dans la barre de navigation
	   pagination
	   carrousel d'affiche de film
	   diminution et augmentation des quantités avec JS


footer: - 

lien vers la maquette : https://excalidraw.com/#json=JPtigKQPXSzYDTS0BU6eq,wPCK6nToVyjFEuj704eL9w

ressource : Thème Vapor from bootswatch
			bootstrap
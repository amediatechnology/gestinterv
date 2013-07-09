  --------------------------------------
 / "Gestion des fiches d'intervention " \
+----------------------------------------+
| Initialement créé le 24/03/2011...
+=====================================================================

 Révision du code le : [14/04/2013]

+=====================================================================
    _____ _    _          _   _  _____ ______   _      ____   _____ 
    / ____| |  | |   /\   | \ | |/ ____|  ____| | |    / __ \ / ____|
   | |    | |__| |  /  \  |  \| | |  __| |__    | |   | |  | | |  __ 
   | |    |  __  | / /\ \ | . ` | | |_ |  __|   | |   | |  | | | |_ |
   | |____| |  | |/ ____ \| |\  | |__| | |____  | |___| |__| | |__| |
    \_____|_|  |_/_/    \_\_| \_|\_____|______| |______\____/ \_____|
                                                               
- 29/09/2012 - | VERSION BETA |

``````````````````````````````````````````````````````````````````````
 * Ajout d'un kit graphique
 * Adaptation du code PHP pour le kit
 * Adaptation du kit graphique (emplacements, blocs...)
 * Intégration des pages en un seul "index.php"
 |---> Les pages ne sont plus indépendantes les unes aux autres


- 29/10/2012 - | VERSION 1.0 |
``````````````````````````````````````````````````````````````````````

SORTIE INITIALE DU PROJET !

 * Ajout terminé des pages administration
 |--->	Techniciens / Types d'intervention / Matériel
 * La plupart des gros bugs ont été corrigés

- 02/11/2012 - | VERSION 1.0.1 |
``````````````````````````````````````````````````````````````````````
 
 * Modification de la page des statistiques
 |--->	Refonte des requêtes SQL & du code d'affichage PHP

- 15/02/2013 - | VERSION 1.1 |
``````````````````````````````````````````````````````````````````````

[Partie ADMINISTRATION]

 * Refonte totale de la page "Administration"
 |--->	Ajout d'iframes pour un affichage des 4 pages* d'admin'
     * Type interv - technicien - matériel - logiciels
     * Ajout catégorie "Logiciels" à installer / ou mettre à jour

[Partie CLIENTS]
 * MàJ page "ajout" + "modification" client (traitement + redirection)
 * MàJ page formulaire d'ajout client & modification client
 * MàJ page affichage de la liste des clients
 |--->	Suppression alphabet (en attente)
	Troncature liste clients (Affichage des 25 derniers ajoutés)		
	Recherche client : ajout recherche sur telFixe & telPortable

[Partie INTERVENTIONS]
 * MàJ formulaire ajout & formulaire modification d'une intervention
 |---> Ajout des parties manquantes (observations, détails install, date du jour, logiciels à installer / mettre à jour...)
 * Création page "add.php" : Ajouter une intervention
 |---> Page indépendante de "affichageclients.php" (ce n'était pas le cas avant)
 * Remodelage page "affichageinterv.php" (Supression cellules inutiles + ajout informations)

[Partie STATISTIQUES]
 * MàJ page (Correction SQL + Ajout stats Solène)

[DIVERS]
 * MàJ code SQL (nombreuses erreurs de syntaxe...)
 * Ajout commentaires dans fichiers pour une meilleure compréhension

- 06/03/2013 - | VERSION 1.2 |
``````````````````````````````````````````````````````````````````````
 * -- Nouvelle partie -- "Pré-interventions"
 |---> Création d'une fiche pour préparer la future intervention.

+=====================================================================

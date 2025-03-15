README: Quizhub - Projet File Rouge
À propos du projet
Le projet Quizhub est une application web développée dans le cadre de ma formation à Youcode , une formation professionnelle qui vise à préparer les étudiants aux métiers du développement web. Ce projet représente l'évaluation finale qui déterminera si je passe l'année et atteins la prochaine étape de ma formation.

L’objectif principal de ce projet est de concevoir une plateforme interactive permettant aux étudiants, enseignants et administrateurs de collaborer efficacement autour de la création et la gestion de quiz. Cette plateforme combine des fonctionnalités modernes comme les notifications en temps réel, la gestion des utilisateurs et des rôles, ainsi que des interfaces intuitives pour chaque type d'utilisateur.

Pourquoi ce projet ?
Ce projet a été conçu pour répondre à plusieurs objectifs pédagogiques :

Mettre en pratique les compétences acquises :
Utilisation avancée de Laravel pour le backend.
Création d'interfaces utilisateur dynamiques avec Blade et JavaScript.
Gestion des bases de données avec MySQL/PostgreSQL.
Implémentation de fonctionnalités sécurisées (hachage des mots de passe, validation des données).
Développer une application complète :
Une architecture modulaire avec des rôles distincts (étudiant, enseignant, administrateur).
Des fonctionnalités interactives comme les notifications en temps réel et les tableaux de bord personnalisés.
Résoudre un problème réel :
Faciliter l'apprentissage des étudiants grâce à des quiz interactifs.
Offrir aux enseignants des outils pour gérer leurs classes et suivre les performances de leurs élèves.
Fournir à l’administrateur un contrôle total sur le système pour garantir son bon fonctionnement.
Montrer ma capacité à travailler sur un projet complet :
De la conception initiale jusqu’à la livraison finale.
En respectant les exigences techniques et fonctionnelles.
Fonctionnalités principales
1. Pour les étudiants :
S’inscrire et se connecter.
Consulter la liste des quiz publics.
Demander à rejoindre une classe d’un enseignant.
Recevoir des notifications sur le site :
Lorsque leur demande est acceptée.
Lorsqu’un nouveau quiz est créé dans leur classe.
Participer à des quiz publics ou privés.
Voir leurs résultats après chaque quiz.
Commenter sur les quiz (optionnel).
2. Pour les enseignants :
S’inscrire et attendre la validation de leur compte par l’administrateur.
Créer des quiz avec différents types de questions (choix multiples, vrai/faux).
Gérer les demandes des étudiants pour rejoindre leur classe (accepter/refuser).
Accéder à un tableau de bord après chaque session de quiz :
Liste des participants (leaderboard).
Scores moyens et statistiques de réussite.
Notifier les étudiants lorsqu’un nouveau quiz est créé.
3. Pour les administrateurs :
Valider ou refuser les comptes des enseignants.
Bannir ou réactiver des comptes (étudiants ou enseignants).
Consulter la liste de tous les utilisateurs.
Supprimer des quiz inappropriés.
Technologies utilisées
Frontend :
Blade : Utilisé pour créer les interfaces utilisateur (liste des quiz, formulaires de connexion, tableaux de bord).
JavaScript : Ajout de logique interactive (participation aux quiz, affichage des résultats).
Backend :
Laravel : Framework PHP utilisé pour gérer les utilisateurs, les quiz, et les sessions.
Sessions PHP : Pour gérer les utilisateurs connectés.
Base de données :
MySQL/PostgreSQL : Stockage des données des utilisateurs, des quiz, des résultats, et des commentaires.
Sécurité :
Validation des données côté serveur avec Laravel.
Hachage des mots de passe avec Bcrypt.
Workflow général
Étudiant :
Se connecte à la plateforme.
Consulte les quiz disponibles.
Participe à un quiz.
Vérifie ses résultats après chaque participation.
Enseignant :
Crée un compte et attend sa validation par l’administrateur.
Crée des quiz pour ses classes.
Gère les demandes des étudiants pour rejoindre sa classe.
Consulte le leaderboard après chaque session de quiz.
Administrateur :
Valide ou refuse les comptes des enseignants.
Bannit ou réactive des comptes problématiques.
Gère les quiz inappropriés.
Résultats attendus
À la fin de ce projet, une application web fonctionnelle sera opérationnelle localement. Elle inclura :

Un système de quiz simple et interactif.
Une gestion des classes et des notifications en temps réel.
Un tableau de bord pour les enseignants.
Un panneau d’administration pour superviser l’ensemble du système.
Conclusion
Ce projet représente une étape cruciale dans ma formation à Youcode. Il me permet de démontrer mes compétences techniques tout en répondant à des besoins spécifiques. J’ai hâte de voir le résultat final et de prouver que je suis prêt à passer à la prochaine étape de mon parcours professionnel.

Remerciements
Je tiens à remercier toute l’équipe de Youcode pour leur soutien et leur encadrement tout au long de cette formation. Merci également à mes camarades pour leur collaboration et leurs conseils précieux.

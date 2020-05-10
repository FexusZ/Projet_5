# Projet_5 <br/>

## Projet n°5 de la formation OC DA PHP <br/>
Réalisation d'un blog en PHP orienté objet.

### Objectifs
* Pages front-office :
    * Page d'accueil
    * Page listant les posts
    * Page de création/modification/suppression de post
    * Page d'affichage d'un post
    * Rédaction de commentaire sur un post
    * Page de connexion sign-in/sign-up/ peut être oublie de mot de passe
* Pages back-office :
    * Page de gestion des différents comptes
    * Page de gestion des commentaires
    * Sécurisation de l'accès aux pages administrateurs
* Eviter les failles :
    * XSS
    * CSRF
    * SQL injection
    * Session hijacking
    * Upload possible de script PHP

### Langages utilisés ?
* HTML5, CSS3
* PHP 7.4.0, MySQL

### Comment utilisé le projet ?
* Installation :
    * Importer le projet sur votre serveur
    * Télécharger composer, et faite un 'composer install', pour generer le vendor et l'autoloadeur de composer.
    * Créé un dossier private, puis un fichier config.php pour définir les constante de connexion a la base de données.
        * DB_NAME : Nom de la base de données
        * DB_HOST : Localisation du serveur (adresse IP/Nom de domaine)
        * DB_USER : Nom d'utilisateur de connexion
        * DB_PASS : Mot de passe
    * Créé une nouvelle base de données, puis télécharger le fichier sql les tables utiles au projet.
* Explication :
    * Le projet suis une architecture MVC :
        * Modèle : Va chercher les données brute.
        * Vue : Affiche les données
        * Contrôleur : Gère la liaison entre Modèles et Vues, et gère toute la logique.
    * Les classes parentes qui regroupes les méthode redondante se trouve  dans le fichier Core\MVC, et les classes enfants se trouve dans le dossier APP dans un dossier nommées.
    * Le fichiers Config dans APP, va permettre d'utiliser les variables SuperGlobal (GET/POST/SESSION) grace a des setters et getters.
    * La classe App va permettre de faire appel a la base de données automatiquement grace a une methode (en faisant appel a la classe Database dans Core\Database), ainsi que s'occuper de generer le menu header.
    * Les autres dossiers dans le dossier APP, sons les classes qui vont permettent de traiter les différentes données envoyé par l'utilisateur.

### Lien Codacy
* https://app.codacy.com/manual/FexusZ/Projet_5/dashboard?bid=17711610

### V.1.0.0
* Initial release

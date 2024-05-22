# Projet-fleurs

Prérequis Technologiques 
Pour faire fonctionner le site, voici les prérequis technologiques nécessaires : 
> pour l’environnement de développement : PHP (version 7.4 ou supérieure), 
> Composer (gestionnaire de dépendances pour PHP) 
> Symfony CLI (pour démarrer le serveur Symfony) 
>MySQL (ou tout autre SGBD compatible) 
> pour les bibliothèques et dépendances : Symfony Framework, Doctrine ORM, Twig (pour 
le templating) et Autres dépendances gérées via Composer (listées dans composer.json) 
Déploiement et Utilisation 
Pour déployer et utiliser le site web, suivez ces étapes : 
- Installation des dépendances 
- Téléchargez le projet et extrayez-le. 
- Ouvrez un terminal dans le répertoire du projet. 
- Exécutez « composer install » pour installer toutes les dépendances. 
Configuration de l'environnement : 
- Copiez le fichier .env et configurez les paramètres de connexion à la base de données. : 
DATABASE_URL=« mysql://root:CHANGEZ_MOT_DE_PASSE127.0.0.1:3306/
flower?serverVersion=8.0.28-0ubuntu4&charset=utf8mb4 » 
- Créez la base de données en exécutant : php bin/console doctrine:database:create. 
- Dans mysql exécutez le fichier backup_file.sql dans une base de données nommée flower 
- Mettez à jour le schéma de la base de données en exécutant php bin/console 
doctrine:schema:update —force. 
- Pour démarrer le serveur Symfony, exécutez symfony serve dans le terminal. 
- Ouvrez un navigateur web et accédez à l'URL fournie (généralement http://
localhost:8000). 
- Une fois le serveur démarré, le site sera accessible via l'URL spécifiée. 
Pour se connecter au compte admin : nom d’utilisateur : admin@admin.com
 mot de passe : admin 
compte quelconque : se créer un compte avec une adresse mail viable 
pour le mailer

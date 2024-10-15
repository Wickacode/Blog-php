# 📄 OpenclassRooms - Formation PHP/Symfony
**Projet 5 - Développement d'un blog PHP**




## 📝 Description du projet
Ce projet consiste en la création d'un blog professionnel à l'aide de PHP et Symfony. Il comprend à la fois des pages accessibles aux visiteurs et une partie dédiée à l'administration du blog.

## ⚙️ Prérequis
**Avant de commencer, assurez-vous que votre environnement dispose des éléments suivants :**

* PHP (version 7.3.21 ou supérieure)
* Composer (gestionnaire de dépendances PHP)
* Un serveur local (ex: WAMP, MAMP, XAMPP)

## 🚀 Installation
- **Clonez le dépôt :**

`git clone https://github.com/Wickacode/Blog-php.git`

- **Accédez au dossier du projet par le terminal, puis installez les dépendances :**

`composer install`

- **Créez la base de données :**

  - **Importez le fichier bdd.sql qui se trouve à la racine du projet.**
Cela configurera la structure de la BDD et ajoutera des données fictives (comptes administrateurs, utilisateurs, articles, commentaires).
  - **Configurez la base de données :**
Mettez à jour le fichier repository.php dans le dossier Repository avec vos informations d'accès à la base de données.

Accedez au site via l'url suivante:
➡️ http://localhost/BLOG-PHP/public/index.php

##### 📂 Fonctionnalités :
##### 🏠 Page d'accueil : Accès aux articles du blog.
##### 📝 Gestion des articles : Ajout, modification, suppression d'articles.
##### 🛠 Espace d'administration : Accessible uniquement aux utilisateurs authentifiés.
##### 🔒 Système de connexion : Avec comptes administrateurs et utilisateurs.

## Pages accessibles au public :
- Page d'accueil
- Liste des articles
- Détails d'un article
- Formulaire de contact
- Formulaire d'inscription
- Liens vers les réseaux sociaux
- Pages réservées aux administrateurs :
  - Gestion des articles
  - Gestion des utilisateurs

## 📑 Connexion au blog

| Type d'utilisateur | Identifiant | Mot de passe |
|--------------------|-------------|--------------|
| Administrateur      | `jess@gmail.com`     | `blogphp2024` |
| Utilisateur         | `user@gmail.com`     | `user2024` |

## 🛠️ Librairies et outils utilisées
- **Twig** : Moteur de template pour PHP.
- **Mailhog** : Serveur de messagerie local.

## 📚 Contexte
Ce projet fait partie de la formation PHP/Symfony d'Openclassrooms, visant à démontrer la capacité à développer un blog complet en PHP en utilisant les technologies web modernes.

## 👩‍💻 Auteur
Développé par **Jessica Garrido**, dans le cadre de la formation **Développeur d’application PHP/Symfony** chez OpenClassrooms.

Pour toute question ou suggestion, n'hésitez pas à me contacter.

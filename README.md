# 🍽️ Carnet De Recettes -

Bienvenue sur **Carnet De Recettes**, une plateforme de gestion de recettes développée en **Symfony**.  
Ce projet permet aux utilisateurs de **créer, gérer, rechercher et liker des recettes**.

---

## ✨ Fonctionnalités

✅ **Authentification et rôles utilisateurs**
- Inscription et connexion sécurisées
- Gestion des rôles (utilisateur & administrateur)

✅ **Gestion des Recettes**
- Ajout, modification et suppression de recettes
- Upload et gestion des images avec **VichUploaderBundle**

- Association des recettes avec des **ingrédients dynamiques**

✅ **Système de Recherche & Filtrage**
- Recherche par titre de recette
- **Filtrage avancé** : ingrédients, temps de préparation

✅ **Système de Likes**
- Les utilisateurs peuvent **liker** leurs recettes préférées
- Affichage des recettes les plus aimées

✅ **Tableau de Bord Admin**
- Gestion des utilisateurs et des recettes
- Suppression sécurisée avec gestion des relations (Cascade Delete)

---

## 🛠️ Installation & Configuration

### 1️⃣ **Cloner le projet**
```sh
git clone https://github.com/Baltore/Ymmersion.git
cd Ymmersion
```
### 2️⃣ Installer les dépendances
```sh
composer install
npm install
```
### 3️⃣ Configurer l'environnement
Modifier les paramètres de connexion à la base de données :
```sh
DATABASE_URL="mysql://root:password@127.0.0.1:3306/mon_projet_recettes?serverVersion=8.0"
```
### 4️⃣ Créer la base de données et les migrations
```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
### 5️⃣ Lancer le serveur Symfony
```sh
symfony server:start
```

---

## ⚡ Technologies Utilisées
- Symfony 6 - Framework PHP
- Doctrine ORM - Gestion de la base de données
- Twig - Moteur de templates
- VichUploaderBundle - Gestion des uploads d’images
- Bootstrap / CSS Custom - Interface utilisateur
- JavaScript (AJAX) - Interaction dynamique (likes)

---

##  👨‍💻 Contributeurs

@Qays @Matthis @Hamed @Kalidou

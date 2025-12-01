# 💈 Barbershop Reservation System

[![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

> Système moderne de gestion de réservations en ligne pour salon de coiffure pour hommes.

![Barbershop Banner](https://via.placeholder.com/1200x300/1F2937/FFFFFF?text=Barbershop+Reservation+System)

---

## 📋 Table des Matières

- [À Propos](#-à-propos)
- [Fonctionnalités](#-fonctionnalités)
- [Technologies](#-technologies)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Configuration](#-configuration)
- [Utilisation](#-utilisation)
- [Structure du Projet](#-structure-du-projet)
- [API Routes](#-api-routes)
- [Base de Données](#-base-de-données)
- [Tests](#-tests)
- [Déploiement](#-déploiement)
- [Contribution](#-contribution)
- [Licence](#-licence)

---

## 🎯 À Propos

**Barbershop Reservation System** est une application web complète permettant aux clients de réserver des rendez-vous en ligne dans un salon de coiffure, et aux administrateurs de gérer efficacement leurs opérations quotidiennes.

### Problématique Résolue

- ❌ Appels téléphoniques constants
- ❌ Conflits de rendez-vous
- ❌ Gestion manuelle des réservations
- ❌ Pas de visibilité sur les disponibilités

### Solution Apportée

- ✅ Réservation en ligne 24/7
- ✅ Gestion automatique des créneaux
- ✅ Dashboard administrateur complet
- ✅ Notifications et confirmations

---

## ✨ Fonctionnalités

### 👤 Espace Client

- 📅 **Réservation en ligne**
  - Choix du service
  - Sélection de la date
  - Créneaux horaires disponibles en temps réel
  - Notes et préférences
  
- 📊 **Gestion des réservations**
  - Historique complet
  - Annulation possible
  - Statuts en temps réel
  - Détails des rendez-vous

### 👨‍💼 Espace Administrateur

- 🎛️ **Dashboard**
  - Statistiques en temps réel
  - Réservations du jour
  - Revenu mensuel
  - Métriques clés

- 📝 **Gestion des réservations**
  - Liste complète
  - Filtres avancés
  - Modification du statut
  - Suppression

- 💼 **Gestion des services**
  - CRUD complet
  - Prix et durée
  - Activation/Désactivation
  - Description détaillée

### 🔐 Système d'Authentification

- Inscription/Connexion
- Réinitialisation mot de passe
- Gestion de profil
- Rôles et permissions

---

## 🛠️ Technologies

### Backend

```
├── Laravel 11.x          # Framework PHP
├── PHP 8.2+              # Langage
├── SQLite                # Base de données
├── Eloquent ORM          # ORM
└── Laravel Breeze        # Authentification
```

### Frontend

```
├── Blade Templates       # Moteur de templates
├── Tailwind CSS          # Framework CSS
├── Alpine.js             # JavaScript léger
├── Font Awesome          # Icônes
└── Axios                 # Requêtes HTTP
```

### Outils de Développement

```
├── Composer              # Gestionnaire de dépendances PHP
├── NPM                   # Gestionnaire de dépendances JS
├── Vite                  # Build tool
└── Git                   # Contrôle de version
```

---

## 📦 Prérequis

Avant de commencer, assurez-vous d'avoir installé:

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x
- **NPM** >= 9.x
- **Git**
- **SQLite** (inclus avec PHP)

### Vérification des Prérequis

```bash
# Vérifier PHP
php -v

# Vérifier Composer
composer --version

# Vérifier Node.js
node -v

# Vérifier NPM
npm -v
```

---

## 🚀 Installation

### 1. Cloner le Projet

```bash
git clone https://github.com/votre-username/barbershop.git
cd barbershop
```

### 2. Installer les Dépendances PHP

```bash
composer install
```

### 3. Installer les Dépendances JavaScript

```bash
npm install
```

### 4. Configuration de l'Environnement

```bash
# Copier le fichier .env
cp .env.example .env

# Générer la clé d'application
php artisan key:generate
```

### 5. Configuration de la Base de Données

```bash
# Créer la base de données SQLite
touch database/database.sqlite

# Exécuter les migrations
php artisan migrate

# Insérer les données de démonstration
php artisan db:seed
```

### 6. Compiler les Assets

```bash
# Pour le développement
npm run dev

# Pour la production
npm run build
```

### 7. Lancer le Serveur

```bash
php artisan serve
```

L'application sera accessible à: `http://localhost:8000`

---

## ⚙️ Configuration

### Configuration de la Base de Données (.env)

```env
DB_CONNECTION=sqlite
DB_DATABASE=/chemin/absolu/vers/database/database.sqlite
```

### Configuration de l'Application

```env
APP_NAME="Barbershop"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000
```

### Configuration du Mail (Optionnel)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
```

---

## 📖 Utilisation

### Comptes de Démonstration

#### Administrateur
```
Email: admin@barbershop.com
Mot de passe: password
```

#### Client Test
```
Email: client@test.com
Mot de passe: password
```

### Workflow Client

1. **Inscription** → Créer un compte
2. **Connexion** → Se connecter
3. **Réservation** → Choisir service, date, heure
4. **Confirmation** → Recevoir confirmation
5. **Gestion** → Consulter/Annuler réservations

### Workflow Administrateur

1. **Connexion** → Se connecter avec compte admin
2. **Dashboard** → Consulter statistiques
3. **Réservations** → Gérer les rendez-vous
4. **Services** → Ajouter/Modifier services
5. **Validation** → Confirmer/Compléter réservations

---

## 📁 Structure du Projet

```
barbershop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/           # Contrôleurs admin
│   │   │   ├── Auth/            # Authentification
│   │   │   └── ReservationController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Service.php
│       └── Reservation.php
├── database/
│   ├── migrations/              # Migrations
│   └── seeders/                 # Données de test
├── resources/
│   ├── views/
│   │   ├── admin/              # Vues admin
│   │   ├── client/             # Vues client
│   │   ├── auth/               # Vues auth
│   │   └── layouts/            # Layouts
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php                 # Routes web
│   └── auth.php                # Routes auth
└── public/
    └── index.php
```

---

## 🛣️ API Routes

### Routes Publiques

```php
GET  /                          # Page d'accueil
GET  /login                     # Page de connexion
POST /login                     # Connexion
GET  /register                  # Page d'inscription
POST /register                  # Inscription
```

### Routes Client (Auth Required)

```php
GET  /reservation               # Formulaire de réservation
POST /reservation               # Créer réservation
GET  /reservation/slots         # Créneaux disponibles
GET  /mes-reservations          # Liste réservations
POST /reservation/{id}/cancel   # Annuler réservation
```

### Routes Admin (Auth + Admin Required)

```php
GET  /admin/dashboard                    # Dashboard
GET  /admin/reservations                 # Liste réservations
POST /admin/reservations/{id}/status     # Modifier statut
DELETE /admin/reservations/{id}          # Supprimer
GET  /admin/services                     # Liste services
GET  /admin/services/create              # Créer service
POST /admin/services                     # Enregistrer service
GET  /admin/services/{id}/edit           # Modifier service
PUT  /admin/services/{id}                # Mettre à jour
DELETE /admin/services/{id}              # Supprimer service
```

---

## 🗄️ Base de Données

### Schéma

#### Table: users
| Colonne | Type | Description |
|---------|------|-------------|
| id | bigint | Clé primaire |
| name | varchar | Nom complet |
| email | varchar | Email unique |
| password | varchar | Mot de passe hashé |
| is_admin | boolean | Rôle administrateur |
| phone | varchar | Téléphone (nullable) |

#### Table: services
| Colonne | Type | Description |
|---------|------|-------------|
| id | bigint | Clé primaire |
| name | varchar | Nom du service |
| description | text | Description |
| price | decimal | Prix (DT) |
| duration | integer | Durée (minutes) |
| is_active | boolean | Statut actif |

#### Table: reservations
| Colonne | Type | Description |
|---------|------|-------------|
| id | bigint | Clé primaire |
| user_id | bigint | FK vers users |
| service_id | bigint | FK vers services |
| date | date | Date du RDV |
| time | time | Heure du RDV |
| status | enum | pending/confirmed/cancelled/completed |
| notes | text | Notes client |

### Relations

```
User ──1:N──> Reservation
Service ──1:N──> Reservation
```

---

## 🧪 Tests

### Exécuter les Tests

```bash
# Tous les tests
php artisan test

# Tests spécifiques
php artisan test --filter=ReservationTest

# Avec couverture
php artisan test --coverage
```

### Types de Tests

- ✅ Tests unitaires
- ✅ Tests d'intégration
- ✅ Tests de fonctionnalités
- ✅ Tests d'authentification

---

## 🚢 Déploiement

### Préparation Production

```bash
# Optimiser l'autoloader
composer install --optimize-autoloader --no-dev

# Mettre en cache les configurations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Compiler les assets
npm run build
```

### Variables d'Environnement Production

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-domaine.com
```

### Serveurs Compatibles

- ✅ Apache
- ✅ Nginx
- ✅ Shared Hosting
- ✅ VPS
- ✅ Cloud (AWS, DigitalOcean, Heroku)

---

## 🤝 Contribution

Les contributions sont les bienvenues!

### Comment Contribuer

1. **Fork** le projet
2. **Créer** une branche (`git checkout -b feature/AmazingFeature`)
3. **Commit** les changements (`git commit -m 'Add AmazingFeature'`)
4. **Push** vers la branche (`git push origin feature/AmazingFeature`)
5. **Ouvrir** une Pull Request

### Standards de Code

- Suivre PSR-12
- Commenter le code complexe
- Écrire des tests
- Mettre à jour la documentation

---

## 📝 Changelog

### Version 1.0.0 (2024-12-01)

#### Ajouté
- ✨ Système de réservation en ligne
- 👨‍💼 Panel administrateur
- 📊 Dashboard avec statistiques
- 🔐 Authentification complète
- 💼 Gestion des services
- 📱 Design responsive

---

## 🐛 Bugs Connus

Aucun bug critique connu. Pour signaler un bug:
- Ouvrir une [issue](https://github.com/votre-username/barbershop/issues)
- Décrire le problème en détail
- Inclure les étapes de reproduction

---

## 📞 Support

- 📧 Email: support@barbershop.com
- 📖 Documentation: [Wiki](https://github.com/votre-username/barbershop/wiki)
- 💬 Discord: [Rejoindre](https://discord.gg/barbershop)
- 🐛 Issues: [GitHub Issues](https://github.com/votre-username/barbershop/issues)

---

## 👥 Auteurs

- **Votre Nom** - *Travail Initial* - [GitHub](https://github.com/votre-username)

Voir aussi la liste des [contributeurs](https://github.com/votre-username/barbershop/contributors).

---

## 📄 Licence

Ce projet est sous licence MIT - voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

## 🙏 Remerciements

- Laravel Framework
- Tailwind CSS
- Font Awesome
- La communauté open source

---

## 📊 Statistiques du Projet

![GitHub stars](https://img.shields.io/github/stars/votre-username/barbershop)
![GitHub forks](https://img.shields.io/github/forks/votre-username/barbershop)
![GitHub issues](https://img.shields.io/github/issues/votre-username/barbershop)

---

**Développé avec ❤️ pour moderniser la gestion des barbershops**

---

## 🔗 Liens Utiles

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [Font Awesome](https://fontawesome.com)

---

⭐ Si ce projet vous a aidé, n'hésitez pas à lui donner une étoile!

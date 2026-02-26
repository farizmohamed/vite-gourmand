# 🍴 Projet Vite & Gourmand - ECF 2026

Ce projet est une application web de traiteur permettant de consulter des menus et de passer des commandes. Il a été réalisé dans le cadre de la validation du titre professionnel.

## 🛠️ Technologies utilisées
- Frontend : HTML5, CSS3 (Custom), Bootstrap 5 pour le responsive.
- Backend: PHP 8.x avec architecture modulaire (includes).
- Base de données : MySQL via l'interface PDO.
- **Design : Maquettes Wireframes et MCD réalisés sur Figma.

## 🛡️ Sécurité & Bonnes Pratiques
Suite aux retours de formation, une attention particulière a été portée sur :
- Protection XSs: Utilisation systématique de `htmlspecialchars()` sur toutes les sorties de données.
- Sécurité SQL : Utilisation de requêtes préparées via PDO.
- Architecture : Séparation stricte du CSS, de la logique PHP et du rendu HTML.

## 📂 Contenu du dépôt
- `/assets`: Fichiers CSS et Images.
- `/includes`: Logique de connexion et composants réutilisables (Header/Footer).
- `/design`: Maquettes Figma et schéma de base de données (MCD).

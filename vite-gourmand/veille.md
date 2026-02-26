Veille Technologique : La Sécurité en PHP 
Introduction
La sécurité est devenue le pilier central du développement Web. Pour mon projet "Vite & Gourmand", 
j'ai concentré ma veille sur la prévention des attaques les plus courantes : XSS et Injections SQL.

 1. La Faille XSS (Cross-Site Scripting)
En 2026, l'injection de scripts malveillants reste une menace. 
La bonne pratique apprise et appliquée est le **filtrage en sortie**. En PHP, l'utilisation de `htmlspecialchars()` 
permet de transformer les caractères spéciaux en entités HTML, empêchant ainsi l'exécution de scripts cachés dans la base de données.

 2. Les Injections SQL et PDO
Pour protéger l'accès aux données, l'utilisation de l'extension **PDO (PHP Data Objects)** est indispensable.
Les requêtes préparées (`prepare()` et `execute()`) permettent de séparer l'instruction SQL des données envoyées, 
rendant impossible toute manipulation de la base par un utilisateur malveillant.

 3. Évolutions récentes
Ma veille montre que l'utilisation de types stricts en PHP 8.x (comme le forçage d'ID en entier `(int)`) 
renforce la robustesse du code et facilite la maintenance en évitant les erreurs de type inattendues.

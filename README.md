# TP_Web_php_dockerized by me
 **HOW TO USE IT**  
Make sure you have Docker installed, and docker engine running.  
Just run `./start_containers.sh`  in the root directory.  
if you use Windows, you can start the script using the gitBash shell 😎  

**PHP-myadmin** : `http://localhost:8080`  
**PHP developpement server** : `http://localhost:2024`  
**Apache server** : `http://localhost:80` or `http://localhost`  
**MariaDB** : `http://localhost:3306`  

About it : 
Ceci est un TP de dev web sur le php, de base on était sensé installer apache, php, php-myadmin, et mariadb sur nos machines et faire le tp comme ça. Je me suis dit que cela serait plus intéressant de proposer une version dockerisé "plug and play", pour ne plus avoir la lourdeur de l'installation de tout les services, et proposer une uniformisation de la configuration des services (genre éviter les problème de mdp par exemple). 😉

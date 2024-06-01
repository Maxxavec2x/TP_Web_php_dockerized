#!/bin/sh

docker-compose up --build -d
echo "Containers initialized :)"
echo "Check those URI :"
echo "PHP-myadmin : http://localhost:8080"
echo "PHP developpement server : http://localhost:2024"
echo "Apache server : http://localhost:80 or http://localhost"
echo "MariaDB : http://localhost:3306"
echo "Default login:password for PHP-myadmin = root:rootpassword"
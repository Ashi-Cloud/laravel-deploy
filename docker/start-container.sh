#!/bin/bash
useradd -u1000 deploy_app
adduser www-data deploy_app
chmod -R ug+rwx storage
chmod -R ug+rwx bootstrap
chown -R www-data:www-data storage
composer install
service supervisor start
php-fpm
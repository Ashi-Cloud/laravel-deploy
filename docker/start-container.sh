#!/bin/bash
useradd -u1000 sms_app
adduser www-data sms_app
chmod -R ug+rwx storage
chmod -R ug+rwx bootstrap
composer install
service supervisor start
php-fpm
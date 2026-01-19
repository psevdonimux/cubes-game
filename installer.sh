#!/bin/bash
apt update && apt upgrade -y
apt install git php php-pdo mariadb -y
mysql_install_db
git clone https://github.com/psevdonimux/cubes-game.git
cd cubes-game
cp .env.example .env


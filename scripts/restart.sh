#!/bin/bash

cd ../docker
docker-compose stop nginx mariadb redis laravel-horizon
docker-compose up -d nginx mariadb redis laravel-horizon

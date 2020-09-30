#!/bin/bash

cd docker
docker-compose up -d nginx mariadb redis laravel-horizon

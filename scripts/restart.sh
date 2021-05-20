#!/bin/bash

cd docker
docker-compose stop nginx mariadb redis
docker-compose up -d nginx mariadb redis

#!/bin/bash
# Build docker container

cd docker
docker-compose up -d --build nginx mariadb redis

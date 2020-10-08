#!/bin/bash

cd ../docker
docker-compose exec mariadb bash -c "mysql -udefault -psecret default"

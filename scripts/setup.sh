#!/bin/bash
#Initial laravel project setup.
#Make sure the .env files for both Docker and Laravel directories, exist.

read -p "Are you sure? " -n 1 -r
echo
if [[ $REPLY =~ ^[Yy]$ ]]
then 
  cd docker

  docker-compose stop
  #We're expecting no containers are running. So use sleep instead of docker-compose restart.
  sleep 10
  docker-compose up -d nginx mariadb redis

  laravel_dir="cd be"
  artisan="${laravel_dir} && php artisan"

  docker-compose exec workspace bash -c "${laravel_dir} && cp .env.example .env"

  docker-compose exec workspace bash -c "${laravel_dir} && composer install --optimize-autoloader"

  docker-compose exec workspace bash -c "${artisan} key:generate"
  docker-compose exec workspace bash -c "${artisan} migrate:install"
  docker-compose exec workspace bash -c "${artisan} migrate --seed"
  docker-compose exec workspace bash -c "${artisan} storage:link"
  docker-compose exec workspace bash -c "${artisan} passport:install"
  docker-compose exec workspace bash -c "${artisan} passport:client --password"
  docker-compose exec workspace bash -c "${artisan} horizon:install"
  docker-compose exec workspace bash -c "${artisan} vendor:publish --provider=\"Rebing\GraphQL\GraphQLServiceProvider\""
  docker-compose exec workspace bash -c "${artisan} optimize"
fi


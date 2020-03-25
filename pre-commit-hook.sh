#!/usr/bin/env bash
docker-compose run php php-cs-fixer fix &
disown

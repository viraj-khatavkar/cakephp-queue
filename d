#!/usr/bin/env bash

if [ $# -gt 0 ]; then

    if [ "$1" == "start" ]; then
        docker-compose up -d

    elif [ "$1" == "stop" ]; then
        docker-compose down

    elif [ "$1" == "cake" ] || [ "$1" == "art" ]; then
        shift 1
        docker-compose exec \
            app \
            bin/cake "$@"

    elif [ "$1" == "bake" ] || [ "$1" == "art" ]; then
        shift 1
        docker-compose exec \
            app \
            bin/cake bake "$@"

    elif [ "$1" == "migrate" ] || [ "$1" == "art" ]; then
        shift 1
        docker-compose exec \
            app \
            bin/cake migrations migrate "$@"

    elif [ "$1" == "migration" ] || [ "$1" == "art" ]; then
        shift 1
        docker-compose exec \
            app \
            bin/cake bake migration "$@"

    elif [ "$1" == "composer" ] || [ "$1" == "comp" ]; then
        shift 1
        docker-compose exec \
            app \
            composer "$@"

    elif [ "$1" == "test" ]; then
        shift 1
        docker-compose exec \
            app \
            ./vendor/bin/phpunit "$@"

    elif [ "$1" == "npm" ]; then
        shift 1
        docker-compose run --rm \
            node \
            npm "$@"

    elif [ "$1" == "yarn" ]; then
        shift 1
        docker-compose run --rm \
            node \
            yarn "$@"

    elif [ "$1" == "gulp" ]; then
        shift 1
        docker-compose run --rm \
            node \
            ./node_modules/.bin/gulp "$@"
    else
        docker-compose "$@"
    fi

else
    docker-compose ps
fi

#!/bin/sh
docker-compose ps -a | tail -n +3 | awk '{print $1}' | xargs docker inspect |  jq '.[].LogPath' | sudo xargs rm 
IF_EXECED_DOCKER=`docker-compose ps`
if [ -n "$$IF_EXECED_DOCKER" ]; then
    make docker-restart
fi

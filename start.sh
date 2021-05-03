#!/bin/bash
app="geneo"

docker build -t $app .

if docker ps | awk -v app="app" 'NR>1{  ($(NF) == app )  }'; then
    docker stop "$app" && docker rm -f "$app"
fi

chmod -R 775 $PWD/storage

docker run -d --restart=always -p 50505:80 \
    --name=$app $app

#!/bin/sh

app=${DOCKER_APP:-app}

if [ "$app" = "app" ]; then

    echo "Running the app..."
    /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

elif [ "$app" = "queue" ]; then

    echo "Running the queue..."
    php artisan queue:work database --tries=5 --queue=high,default

else
    echo "Could not match the container app \"$app\""
    exit 1
fi
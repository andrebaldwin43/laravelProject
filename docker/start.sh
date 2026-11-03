#!/bin/bash
php-fpm -F &
nginx -g 'daemon off;' &

# Exit as soon as either process dies so the platform restarts the container
wait -n
exit 1

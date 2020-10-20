#!/bin/bash

set -e

sleep 5
php /app/bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration

exec "$@"
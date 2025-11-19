#!/bin/bash
# filepath: /home/danillo/www/valet/flap-api/entrypoint.sh

# Aguarda o MySQL ficar disponível
until mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SHOW DATABASES;" > /dev/null 2>&1; do
  echo "Aguardando o banco de dados..."
  sleep 2
done

php artisan migrate --seed --force

exec php-fpm
FROM php:7.4-fpm

WORKDIR /var/www

COPY . .

RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

COPY . /var/www

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

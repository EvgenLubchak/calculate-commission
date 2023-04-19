FROM php:8.2-fpm-alpine
ENV COMPOSER_ALLOW_SUPERUSER=1
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer
COPY ./app/composer.* ./

RUN composer install --prefer-dist --no-scripts --no-progress --no-interaction
COPY ./app .

RUN composer dump-autoload --optimize

FROM php:8.0-apache
WORKDIR /var/www/html
COPY src/public/index.php .
RUN apt-get update && \
    apt-get install -y libpq-dev libxml2-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql
RUN docker-php-ext-install soap
RUN a2enmod rewrite
EXPOSE 80
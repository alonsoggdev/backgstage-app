FROM php:8.2-apache

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install \
    intl \
    mysqli \
    pdo \
    pdo_mysql \
    zip

RUN a2enmod rewrite

RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Ajustar UID/GID de www-data al del host
RUN usermod -u ${USER_ID} www-data
RUN groupmod -g ${GROUP_ID} www-data

WORKDIR /var/www/html

USER www-data

CMD ["apache2-foreground"]

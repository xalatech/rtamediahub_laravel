FROM php:7.4-fpm

ARG APP_USER=www
RUN groupadd -r ${APP_USER} && useradd --no-log-init -r -g ${APP_USER} ${APP_USER}

# Copy composer.lock and composer.json
COPY ./composer.lock ./composer.json /var/www/

# Set working directory
WORKDIR /var/www

# Install dependencies
RUN apt-get update && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    ffmpeg \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-source delete

# Install composer
#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Copy existing application directory contents
COPY . /var/www

COPY php.ini /usr/local/etc/php/conf.d

# Copy existing application directory permissions
COPY --chown=${APP_USER}:${APP_USER} ./ /var/www

# Change current user to www
#USER ${APP_USER}

RUN composer install
#RUN php artisan migrate

EXPOSE 80
CMD ["php-fpm"]

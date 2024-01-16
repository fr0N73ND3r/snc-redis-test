FROM composer:2.1.9 AS composer
FROM php:7.4.33-zts-alpine3.16

# Install dependencies
RUN apk update && apk add --no-cache \
    bash \
    git \
    curl \
    zip \
    unzip \
    autoconf
#    make \
#    g++ \

#RUN apk update && apk add --no-cache libfcgi0ldbl redis-tools

# PHP extensions
RUN apk add --no-cache pcre-dev $PHPIZE_DEPS \
&& pecl install redis \
&& docker-php-ext-enable redis.so
#RUN docker-php-ext-enable opcache

# xdebug extensions
#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug

#RUN apk add --no-cache $PHPIZE_DEPS \
#    && pecl install xdebug \
#    && docker-php-ext-enable xdebug

# Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony


# Set working directory
WORKDIR /var/www/app

# Expose port 9000 and start php-fpm server
EXPOSE 80

CMD ["symfony", "serve:start", "--port=80"]

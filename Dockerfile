FROM nginx:stable-alpine
LABEL Maintainer="Richard Tichý <richard.tichy@mensa.cz>"
WORKDIR /var/www-marks

RUN apk update --no-cache

RUN apk add --no-cache \
      curl \
      nginx \
      php81 \
      php81-ctype \
      php81-curl \
      php81-dom \
      php81-fpm \
      php81-gd \
      php81-intl \
      php81-mbstring \
      php81-mysqli \
      php81-opcache \
      php81-openssl \
      php81-phar \
      php81-session \
      composer

COPY config/nginx/nginx.conf /etc/nginx/nginx.conf

COPY config/php/fmp-pool.conf /etc/php81/php-fpm.d/www.conf
COPY config/php/php.ini /etc/php81/conf.d/custom.ini

COPY . /var/www-marks

EXPOSE 80

ENTRYPOINT php-fpm81 -F -R& nginx -g 'daemon off;'& wait

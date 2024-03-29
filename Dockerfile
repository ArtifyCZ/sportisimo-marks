FROM php:fpm-bullseye
LABEL Maintainer="Richard Tichý <richard.tichy@mensa.cz>"
WORKDIR /var/www-marks

RUN apt update

RUN apt install git zip nodejs npm default-mysql-client curl -y

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

COPY composer.json composer.json
COPY composer.lock composer.lock

RUN docker-php-ext-install pdo pdo_mysql

RUN php composer.phar install

COPY . /var/www-marks

RUN npm install

ENV DEBUG="FALSE"

RUN mkdir /var/log/www-marks

RUN chmod -R a+rw /var/log/www-marks

ENTRYPOINT npm run build &&\
    mysql -hdb -uroot -proot < /var/www-marks/db/migrations/20221027-initial.sql &&\
    mysql -hdb -uroot -proot < /var/www-marks/db/seed/marks.sql &&\
    rm -rf /tmp/www-marks &&\
    mkdir /tmp/www-marks /tmp/www-marks/nette-temp &&\
    chmod -R a+rw /var/log/www-marks /tmp/www-marks &&\
    php-fpm -R

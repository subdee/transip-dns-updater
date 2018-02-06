FROM alpine:3.7

RUN apk update && apk add curl php7 php7-soap php7-json php7-phar php7-mbstring php7-openssl php7-zlib
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
RUN mkdir /app
WORKDIR /app
COPY composer.json /app
COPY composer.lock /app
COPY transip.key /app
COPY src/ /app/src
COPY index.php /app
RUN composer install
ADD docker/crontab /crontab
COPY docker/entry.sh /entry.sh
RUN chmod 755 /entry.sh
RUN /usr/bin/crontab /crontab

CMD ["/entry.sh"]

FROM php:8.2-zts

RUN apt update && \
	apt install $PHPIZE_DEPS gdb --yes && \
	pecl install parallel && \
	docker-php-ext-install opcache && \
	docker-php-ext-enable parallel

COPY ./php.ini        /usr/local/etc/php/php.ini
COPY ./               /src

WORKDIR /src
CMD ["/src/repeat.sh", "/src/run.php"]

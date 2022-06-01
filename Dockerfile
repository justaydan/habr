FROM php:8.0-cli

RUN apt-get update -y && apt-get install -y libmcrypt-dev

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


WORKDIR /app
COPY . /app

RUN composer install --optimize-autoloader --no-dev

CMD php artisan serve --host=0.0.0.0 --port=$PORT
EXPOSE $PORT


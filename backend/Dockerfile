FROM prooph/php:7.3-zts

WORKDIR /backend

COPY . .

RUN apk add --no-cache --virtual .persistent-deps \
    php7-dev \
    libc-dev \
    make \
    gcc \
    g++ \
    git \
    unzip \
    openssh \
    libzip-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install

EXPOSE 9090

CMD ["./rr-grpc", "serve", "-v", "-d"]
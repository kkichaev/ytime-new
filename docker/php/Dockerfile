FROM php:8.2-fpm

ARG USER_ID
ARG GROUP_ID

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    mc \
    libxml2-dev \
    && pecl install xdebug \
    && apt-get clean && rm -rf /var/lib/apt/lists/*  \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl \
    && docker-php-ext-install sockets \
    && docker-php-ext-install soap \
    && docker-php-ext-install gd

RUN apt install -y curl
RUN groupadd -g $GROUP_ID www && useradd -g $GROUP_ID -u $USER_ID -ms /bin/bash www

WORKDIR /var/www/laravel
COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.1/install.sh | bash
ENV NVM_DIR=/root/.nvm
ENV NODE_VERSION=20.18.1
RUN . "$NVM_DIR/nvm.sh" &&  nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}
ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"
RUN node --version
RUN npm --version

COPY *.bash_aliases /home/www/.bash_aliases

EXPOSE 9000

CMD ["php-fpm"]




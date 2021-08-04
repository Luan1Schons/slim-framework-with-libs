FROM php:7.3-apache

COPY ./000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add -
RUN echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && apt-get install -y --no-install-recommends \
  apt-utils \
  software-properties-common \
  autoconf \
  build-essential \
  zlib1g-dev \
  libzip-dev \
  unzip \
  zip \
  libpq-dev \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  git \
  wget \
  vim \
  nodejs \
  yarn

RUN docker-php-ext-configure gd \
  --with-png-dir=/usr/include/ \
  --with-jpeg-dir=/usr/include/ \
  --with-freetype-dir=/usr/include/

RUN docker-php-ext-configure zip --with-libzip

RUN docker-php-ext-install gd pdo_mysql mysqli zip

RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Clear package lists
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR /var/www/html

RUN a2enmod rewrite

EXPOSE 80
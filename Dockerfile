FROM php:7

WORKDIR /app
COPY . /app

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install
CMD php artisan serve --host=0.0.0.0 --port=8002
RUN php artisan config:cache
EXPOSE 8002


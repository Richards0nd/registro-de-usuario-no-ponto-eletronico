FROM php:8.1-fpm

# Dependências necessárias para o funcionamento correto do PHP
RUN apt-get update && apt-get install -y \
        libonig-dev \
        libxml2-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libzip-dev \
        zip \
        unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Limpar o cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Diretório onde o projeto será executado
WORKDIR /var/www

# Remover o conteúdo pré-existente criado pelo nginx
RUN rm -rf /var/www/html

# Copiar o conteúdo atual da aplicação para a pasta WORKDIR
COPY . /var/www

EXPOSE 9000
CMD ["php-fpm"]

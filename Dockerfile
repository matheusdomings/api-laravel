# Use a imagem base do PHP 8.0 com Apache
FROM php:8.0-apache

# Atualize os pacotes e instale as dependências necessárias
RUN apt-get update -y && apt-get install -y libonig-dev openssl zip unzip git

# Instale o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale as extensões PHP necessárias
RUN docker-php-ext-install pdo_mysql mbstring

# Copie os arquivos do projeto para o diretório do container
COPY . /var/www/html

# Instale as dependências do Composer, ignorando requisitos de plataforma
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --ignore-platform-reqs

# Configure o Apache para o Laravel
COPY docker/apache2.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Ajuste permissões do diretório
RUN chown -R www-data:www-data storage bootstrap/cache

# Exponha a porta 80 do container
EXPOSE 80

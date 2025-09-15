FROM php:8.2-apache

# Install system dependencies & CA certs
RUN apt-get update && apt-get install -y \
    git unzip zip curl gnupg \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev libsodium-dev \
    default-mysql-client \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo_mysql sodium zip \
    && a2enmod rewrite \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Node.js 18.x (for Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure Composer reliability
RUN composer config -g process-timeout 2000 \
    && composer config -g preferred-install dist

# Set working directory for VS Code Devcontainer
WORKDIR /workspace

# Make sure /workspace is owned by vscode user
RUN useradd -ms /bin/bash vscode \
    && chown -R vscode:vscode /workspace /var/www \
    && chmod -R 775 /workspace

USER vscode

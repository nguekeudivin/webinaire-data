# syntax=docker/dockerfile:1

# Stage 1: Build frontend assets
FROM node:22-alpine AS node-builder

WORKDIR /app

COPY package*.json ./
RUN npm ci --ignore-scripts

COPY . .
RUN npm run build

# Stage 2: PHP application
FROM dunglas/frankenphp:1.5-php8.4-alpine

# Install system dependencies
RUN apk add --no-cache curl

# Install PHP extensions
RUN install-php-extensions \
    pdo_mysql \
    pdo_pgsql \
    intl \
    opcache

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy application files
COPY --chown=www-data:www-data . .

# Copy built assets
COPY --chown=www-data:www-data --from=node-builder /app/public/build ./public/build

# Install PHP dependencies (no dev)
RUN composer install --no-dev --no-interaction --optimize-autoloader

# Set proper permissions for Laravel
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENV SERVER_NAME=":80"

# Healthcheck
HEALTHCHECK --interval=30s --timeout=5s --start-period=5s --retries=3 \
    CMD curl -f http://localhost:80/up || exit 1

EXPOSE 80

#!/bin/bash

# Cod Xpert Invoice Generator - Automatic Server Deployment & Optimization Script
# Target Directory: /var/www/harmonioushe_usr/data/www/invoice.codxpert.com

echo "=========================================================="
echo "🚀 Cod Xpert Invoice Generator Server Deployment Script"
echo "=========================================================="

# 1. Detect PHP 8.2+ for execution to bypass CLI PHP 8.1 limitations
PHP_BIN="php"
if command -v php8.2 &> /dev/null; then
    PHP_BIN="php8.2"
    echo "💡 PHP 8.2 binary detected! Using '$PHP_BIN' for executions..."
elif command -v php8.3 &> /dev/null; then
    PHP_BIN="php8.3"
    echo "💡 PHP 8.3 binary detected! Using '$PHP_BIN' for executions..."
else
    echo "⚠️ Warning: php8.2 or php8.3 not found globally in path. Falling back to default: $(php -v | head -n 1)"
fi

# 2. Directory permissions optimization
echo "📂 Optimizing directory permissions..."
mkdir -p storage/framework/{cache/data,sessions,views} storage/logs bootstrap/cache
chmod -R 775 storage bootstrap/cache
chown -R harmonioushe_usr:harmonioushe_usr storage bootstrap/cache 2>/dev/null || chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || echo "⚠️ Warning: chown failed. Running without root privileges."

# 3. Detect and run Composer using PHP 8.2+
COMPOSER_PATH=$(which composer 2>/dev/null)
if [ -z "$COMPOSER_PATH" ]; then
    COMPOSER_PATH="/usr/local/bin/composer"
fi

echo "📦 Installing production composer dependencies..."
if [ -f "$COMPOSER_PATH" ] || command -v composer &> /dev/null; then
    # Run composer phar using php8.2/8.3 binary
    $PHP_BIN $COMPOSER_PATH install --no-dev --optimize-autoloader --no-interaction || \
    $PHP_BIN $(which composer) install --no-dev --optimize-autoloader --no-interaction || \
    composer install --no-dev --optimize-autoloader --no-interaction
else
    echo "⚠️ Warning: Composer binary not found at typical path. Attempting global call..."
    composer install --no-dev --optimize-autoloader --no-interaction
fi

# 4. Environment configuration setups
if [ ! -f .env ]; then
    echo "⚠️ Warning: .env file not found. Copying .env.example..."
    cp .env.example .env
fi

# 5. Generate App Encryption Key
if grep -q "APP_KEY=base64:invoice_placeholder" .env || grep -q "APP_KEY=$" .env; then
    echo "🔑 Generating secure app encryption key..."
    $PHP_BIN artisan key:generate
fi

# 6. Database migrations
echo "🗄️ Running secure database migrations..."
$PHP_BIN artisan migrate --force

# 7. Optimized caching for production
echo "⚡ Warming up application configuration cache..."
$PHP_BIN artisan config:cache
$PHP_BIN artisan route:cache
$PHP_BIN artisan view:cache

# 8. Setup public storage symbolic link
echo "🔗 Setting up public storage symbolic link..."
$PHP_BIN artisan storage:link --force

# 9. Check for node/frontend compilation
if command -v npm &> /dev/null; then
    echo "🎨 Node detected! Building production frontend assets..."
    npm install
    npm run build
else
    echo "ℹ️ Note: npm command not found on server. Ensure public/build/ is compiled locally and uploaded."
fi

echo "=========================================================="
echo "✅ Deployment completed successfully!"
echo "🔗 Domain: https://invoice.codxpert.com"
echo "📂 Root path: /var/www/harmonioushe_usr/data/www/invoice.codxpert.com"
echo "=========================================================="

#!/bin/bash

# Install composer dependencies && setup app
if [ ! -d "vendor" ] && [ -f "composer.json" ]; then #&& [ "$APP_ENV" == "production" ]; then
    composer config --global process-timeout 6000
    composer install
    composer dump-autoload

    php artisan key:generate
fi

# Install npm dependencies
# if [ ! -d "node_modules" ] && [ -f "package.json" ] && [ "$APP_ENV" == "production" ]; then
if [ ! -d "node_modules" ] && [ -f "package.json" ]; then
    npm install --global yarn
    yarn add vite
    yarn install
    yarn build
fi

outdated=$(yarn outdated)
if [[ $outdated == *"Package"* ]]; then
    echo "Updates found. Running yarn install..."
    yarn install
    echo "Yarn install completed."
else
    echo "No updates found. Your dependencies are up to date."
fi

# Run apache foreground
apachectl -D FOREGROUND

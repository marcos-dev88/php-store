apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nano \

rm -rf /var/cache/apk/*

cd /php_store_app

composer install --ignore-platform-reqs || composer update

composer dump-autoload
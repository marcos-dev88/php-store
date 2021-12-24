apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    nano \

rm -rf /var/cache/apk/*

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
FROM alicfeng/newlink_php7.2_runtime:develop

# project environment including test,production,testing,dev(default)
ARG env=prod

COPY --chown=www . /var/www/app

WORKDIR /var/www/app

RUN chown www:www -R /var/www \
    && mv /var/www/app/.env.${env} /var/www/app/.env \
    && composer config repo.packagist composer https://mirrors.aliyun.com/composer/ \
    && COMPOSER_MEMORY_LIMIT=-1 /usr/local/bin/composer install --optimize-autoloader -vvv \
    && composer clear-cache \
    && php artisan storage:link \
    && composer dump-autoload

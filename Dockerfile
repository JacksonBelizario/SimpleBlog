FROM chialab/php:7.2-apache

# Enable apache mod rewrite..
RUN a2enmod rewrite

# Enable apache mod ssl..
RUN a2enmod ssl

# Enable default site
COPY ./.deploy/000-default.conf /etc/apache2/sites-available/000-default.conf

VOLUME /var/www/html/api /var/www/html/api/storage

WORKDIR /var/www/html/api
COPY ./api ./

RUN chown -R www-data:www-data /var/www/html/api && chmod -R 775 /var/www/html/api/storage

RUN rm -rf /var/www/html/api/storage/logs/*

EXPOSE 80

CMD /usr/sbin/apache2ctl -D FOREGROUND

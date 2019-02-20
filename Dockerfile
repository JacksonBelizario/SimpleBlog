FROM chialab/php:7.2-apache

# Enable apache mod rewrite..
RUN a2enmod rewrite

# Enable apache mod ssl..
RUN a2enmod ssl

# Enable default site
COPY ./.deploy/000-default.conf /etc/apache2/sites-available/000-default.conf

VOLUME /var/www/html /var/www/html/storage

RUN chown -R www-data:www-data /var/www/html && chmod -R 775 /var/www/html/storage

WORKDIR /var/www/html

EXPOSE 80

CMD /usr/sbin/apache2ctl -D FOREGROUND

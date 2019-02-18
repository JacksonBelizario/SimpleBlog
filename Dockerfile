FROM chialab/php:7.2-apache

# Enable apache mod rewrite..
RUN a2enmod rewrite

# Enable apache mod ssl..
RUN a2enmod ssl

RUN chown -R www-data:www-data /var/www/html
VOLUME /var/www/html

WORKDIR /var/www/html
ADD api /var/www/html

# Enable default site
COPY ./.deploy/000-default.conf /etc/apache2/sites-available/000-default.conf
RUN service apache2 start

RUN chmod -R 775 /var/www/html/storage

# Run composer
RUN cd /var/www/html && composer install --prefer-dist --no-dev --no-scripts --no-suggest

CMD /usr/sbin/apache2ctl -D FOREGROUND

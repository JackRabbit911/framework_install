<?php

return <<<FILE
FROM jackrabbit911/apache_php8.1_plus_extensions:latest

RUN mkdir -p /var/www/$docroot
COPY default.conf /etc/apache2/sites-available/000-default.conf
FILE;

FROM phpdockerio/php73-fpm

USER root

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && \
    mkdir -p /usr/share/man/man1mkdir /usr/share/man/man1 && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && \
    apt-get install -y python3-pip sqlite3 libsqlite3-dev nodejs ant git yarn vim-tiny zsh php7.3-xdebug php7.3-mysql php7.4-mysql && \
    pip3 install sqlitebiter && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN echo "xdebug.remote_host=docker.for.mac.host.internal" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo 'xdebug.file_link_format="phpstorm://open?url=file://%%f&line=%%l"' >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_enable=1" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_autostart=1" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_connect_back=0" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.idekey=PHPSTORM" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_port=9090" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.max_nesting_level=10000" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_handler=dbgp" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini && \
        echo "xdebug.remote_mode=req" >> /etc/php/7.3/fpm/conf.d/20-xdebug.ini

RUN npm i -g npm-upgrade

WORKDIR /srv/www/
USER www-data

# note that all dependencies should be installed before this (composer install)
ADD --chown=www-data:www-data . /srv/www/

USER root

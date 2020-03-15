FROM phpdockerio/php73-fpm

WORKDIR /srv/www/
USER www-data

# note that all dependencies should be installed before this (composer install)
ADD --chown=www-data:www-data . /srv/www/

ARG GIT_COMMIT
ARG GIT_BRANCH
ARG APP_VERSION

ENV GIT_COMMIT=${GIT_COMMIT} \
    GIT_BRANCH=${GIT_BRANCH} \
    APP_VERSION=${APP_VERSION}

LABEL description="This is php container" \
      container_git_commit=${GIT_COMMIT} \
      container_git_branch=${GIT_BRANCH} \
      app_version=${APP_VERSION}

USER root

RUN apt-get update \
    && apt-get install -y php7.3-mysql php7.4-mysql

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - && \
    mkdir -p /usr/share/man/man1mkdir /usr/share/man/man1 && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list

RUN apt-get update && \
    apt-get install -y python3-pip sqlite3 libsqlite3-dev nodejs ant git yarn vim-tiny zsh && \
    pip3 install sqlitebiter && \
    apt-get clean

RUN apt-get install -y nodejs && \
    npm i -g npm-upgrade && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*



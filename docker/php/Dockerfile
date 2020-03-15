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

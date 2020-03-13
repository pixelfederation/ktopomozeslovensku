FROM docker.pixelfederation.com/docker/php-fpm:7.3.10

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

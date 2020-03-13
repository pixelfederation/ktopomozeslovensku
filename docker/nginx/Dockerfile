FROM docker.pixelfederation.com/docker/nginx/nginx-1.14.2:latest

ADD --chown=www-data:www-data public /srv/www/public

ARG GIT_COMMIT
ARG GIT_BRANCH
ARG APP_VERSION

ENV GIT_COMMIT=${GIT_COMMIT} \
    GIT_BRANCH=${GIT_BRANCH} \
    APP_VERSION=${APP_VERSION}

LABEL description="This is nginx container" \
      container_git_commit=${GIT_COMMIT} \
      container_git_branch=${GIT_BRANCH} \
      app_version=${APP_VERSION}